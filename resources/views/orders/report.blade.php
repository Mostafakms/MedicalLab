@extends('home')

@section('body')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Enter Report for {{ $test->name }}</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4 d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form action="{{ route('orders.saveReport', ['orderId' => $order->id, 'testId' => $test->id]) }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label">Report Details</label>
                                    <textarea name="report_details" class="form-control" rows="5" required>{{ old('report_details', $order->orderDetails->where('test_id', $test->id)->first()?->report_details) }}</textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Save Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</main>
@endsection
