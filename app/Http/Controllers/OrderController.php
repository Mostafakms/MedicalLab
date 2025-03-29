<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Test;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\Pdf;
class OrderController extends Controller


{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
    
        if ($status && in_array($status, ['pending', 'completed', 'cancelled'])) {
            $orders = \App\Models\Order::where('status', $status)->get();
        } else {
            $orders = \App\Models\Order::all();
        }
    
        return view('orders.index', compact('orders'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $tests = Test::all()->groupBy('family');
        return view('orders.create',compact('patients','tests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         // Validate the request data
    $data = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'order_date' => 'required|date',
        'test_ids'   => 'required|array',
       // 'test_ids.*' => 'exists:tests,id',
        // Optional: if results are provided as an array where key is test_id
        'results'    => 'sometimes|array',
    ]);

    // Create the Order record with a placeholder for total_price
    $order = \App\Models\Order::create([
        'patient_id'  => $data['patient_id'],
        'order_date'  => $data['order_date'],
        'total_amount' => 0, // Will be updated after creating order details
    ]);

    // Create an OrderDetail record for each selected test.
    // If a test result is provided, store it as well.
    foreach ($data['test_ids'] as $testId) {
        \App\Models\OrderDetail::create([
            'order_id' => $order->id,
            'test_id'  => $testId,
            'result'   => $data['results'][$testId] ?? null,
        ]);
    }

    // Recalculate the total price by summing the prices of all selected tests.
    $totalAmount = \App\Models\Test::whereIn('id', $data['test_ids'])->sum('price');


    // Update the order record with the calculated total price
    $order->update(['total_amount' => $totalAmount]);


    return redirect()->route('orders.index')->with('success', 'Order added successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

         // Retrieve the order along with its order details
    $order = \App\Models\Order::with('orderDetails')->findOrFail($id);

    // Get all patients for the patient dropdown
    $patients = \App\Models\Patient::all();

    // Get all tests and group them by family
    $tests = \App\Models\Test::all()->groupBy('family');

    // Pass the data to the edit view
    return view('orders.edit', compact('order', 'patients', 'tests'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Order $order)
    {
        //
         // Validate the incoming data.
    $data = $request->validate([
        'patient_id'  => 'required|exists:patients,id',
        'order_date'  => 'required|date',
        'status'      => 'required|in:pending,completed,cancelled',
        'test_ids'    => 'required|array',
        'test_ids.*'  => 'exists:tests,id',
        'results'     => 'sometimes|array'
    ]);

    // Update the order's basic information.
    $order->update([
        'patient_id' => $data['patient_id'],
        'order_date' => $data['order_date'],
        'status'     => $data['status'],
        // 'total_amount' will be recalculated after updating order details.
    ]);

    // Get current test IDs from the order details.
    $currentTestIds = $order->orderDetails->pluck('test_id')->toArray();

    // Determine which tests to remove (present before but not in the new data).
    $testsToRemove = array_diff($currentTestIds, $data['test_ids']);
    if (!empty($testsToRemove)) {
        \App\Models\OrderDetail::where('order_id', $order->id)
            ->whereIn('test_id', $testsToRemove)
            ->delete();
    }

    // Determine which tests to add (newly selected tests).
    $testsToAdd = array_diff($data['test_ids'], $currentTestIds);
    foreach ($testsToAdd as $testId) {
        \App\Models\OrderDetail::create([
            'order_id' => $order->id,
            'test_id'  => $testId,
            'result'   => $data['results'][$testId] ?? null,
        ]);
    }

   /* // For tests that are already present, update their result if provided.
    foreach ($order->orderDetails as $orderDetail) {
        if (in_array($orderDetail->test_id, $data['test_ids'])) {
            if (isset($data['results'][$orderDetail->test_id])) {
                $orderDetail->update([
                    'result' => $data['results'][$orderDetail->test_id]
                ]);
            }
        }
    }*/

    // Recalculate the total amount by summing the prices of all selected tests.
    $totalAmount = \App\Models\Test::whereIn('id', $data['test_ids'])->sum('price');


    // Update the order with the new total amount.
    $order->update(['total_amount' => $totalAmount]);

    return redirect()->route('orders.index')->with('success', 'Order updated successfully');


        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function showResultsForm(Order $order)
    {
        
    return view('orders.results', compact('order'));
    }



    public function saveResults(Request $request, \App\Models\Order $order)
    {
        $data = $request->validate([
            'results' => 'required|array',
            'results.*' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
        ]);
    
        // تحديث نتائج الفحوصات لكل OrderDetail
        foreach ($order->orderDetails as $detail) {
            if (isset($data['results'][$detail->test_id])) {
                $detail->update([
                    'result' => $data['results'][$detail->test_id]
                ]);
            }
        }
    
        // تحديث حالة الطلب بناءً على الاختيار الجديد
        $order->update(['status' => $data['status']]);
    
        return redirect()->route('orders.index')->with('success', 'Results and status updated successfully');
    }



    public function showReportForm($orderId, $testId)
{
    $order = Order::findOrFail($orderId);
    $test = Test::findOrFail($testId);

    return view('orders.report', compact('order', 'test'));
}


public function test()
{

    return view('orders.test');
}


public function saveReport(Request $request, $orderId, $testId)
{
    $orderDetail = OrderDetail::where('order_id', $orderId)->where('test_id', $testId)->firstOrFail();
    
    $orderDetail->report_details = $request->input('report_details');
    $orderDetail->save();

    return redirect()->route('orders.index')->with('success', 'Report saved successfully!');
}


public function showStoolReportForm($orderId, $orderDetailId)
{
    $order = Order::findOrFail($orderId);
    $orderDetail = OrderDetail::findOrFail($orderDetailId);
    // لو كان التقرير موجود بالفعل، يمكنك جلبه
    $report = $orderDetail->report;
    
    return view('orders.enter_stool_report', compact('order', 'orderDetail', 'report'));
}

public function saveStoolReport(Request $request, $orderId, $orderDetailId)
{
    $validated = $request->validate([
        'consistency' => 'required|string',
        'mucus' => 'required|string',
        'blood' => 'required|string',
        'odour' => 'required|string',
        'colour' => 'required|string',
        'worms' => 'required|string',
        'rbc' => 'required|string',
        'pus_cells' => 'required|string',
        'starch_granules' => 'required|string',
        'fat_globules' => 'required|string',
        'muscle_fibers' => 'required|string',
        'vegetable_cells' => 'required|string',
        'ova' => 'required|string',
        'larva' => 'required|string',
        'protozoa' => 'required|string',
    ]);

    // إيجاد سجل تفاصيل الطلب
    $orderDetail = OrderDetail::findOrFail($orderDetailId);
    
    // تحديث التقرير إذا كان موجوداً أو إنشاؤه جديداً
    $orderDetail->report()->updateOrCreate(
        ['order_detail_id' => $orderDetail->id],
        $validated
    );

    return redirect()->route('orders.index')->with('success', 'Stool report saved successfully!');
}



public function print(Order $order)
{
    $order->load(['patient', 'orderDetails.test', 'orderDetails.report']); // تأكد من تحميل العلاقات الضرورية
    return view('orders.print_order', compact('order'));
}



public function generateOrderPdf(Order $order)
{
    $order->load(['patient', 'orderDetails.test', 'orderDetails.report']);
    
    // توليد ملف PDF من صفحة Blade، مثلاً: orders.pdf_order
    $pdf = Pdf::loadView('orders.pdf_order', compact('order'))
              ->setPaper('A4');

    return $pdf->download("order-{$order->id}.pdf");
}



}
