<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Printable Order Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h3, h4 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 8px; text-align: left; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <h1>Order #{{ $order->id }} - Test Results</h1>
    <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
    <p><strong>Patient:</strong> {{ $order->patient->name }}</p>
    <hr>
    
    <table>
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Normal Range</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->test?->name ?? 'Test not found' }}</td>
                    <td>{{ $detail->test?->normal_range ?? 'N/A' }}</td>
                    <td>
                        {{ $detail->result }}
                        @if(str_contains(strtolower($detail->test?->name ?? ''), 'stool'))
                            <br><br>
                            <strong>Stool Detailed Report:</strong>
                            <ul style="list-style: none; padding-left: 0;">
                                <li><strong>Consistency:</strong> {{ $detail->report->consistency ?? 'N/A' }}</li>
                                <li><strong>Mucus:</strong> {{ $detail->report->mucus ?? 'N/A' }}</li>
                                <li><strong>Blood:</strong> {{ $detail->report->blood ?? 'N/A' }}</li>
                                <li><strong>Odour:</strong> {{ $detail->report->odour ?? 'N/A' }}</li>
                                <li><strong>Colour:</strong> {{ $detail->report->colour ?? 'N/A' }}</li>
                                <li><strong>Worms:</strong> {{ $detail->report->worms ?? 'N/A' }}</li>
                                <li><strong>RBC:</strong> {{ $detail->report->rbc ?? 'N/A' }}</li>
                                <li><strong>Pus Cells:</strong> {{ $detail->report->pus_cells ?? 'N/A' }}</li>
                                <li><strong>Starch Granules:</strong> {{ $detail->report->starch_granules ?? 'N/A' }}</li>
                                <li><strong>Fat Globules:</strong> {{ $detail->report->fat_globules ?? 'N/A' }}</li>
                                <li><strong>Muscle Fibers:</strong> {{ $detail->report->muscle_fibers ?? 'N/A' }}</li>
                                <li><strong>Vegetable Cells:</strong> {{ $detail->report->vegetable_cells ?? 'N/A' }}</li>
                                <li><strong>Ova:</strong> {{ $detail->report->ova ?? 'N/A' }}</li>
                                <li><strong>Larva:</strong> {{ $detail->report->larva ?? 'N/A' }}</li>
                                <li><strong>Protozoa:</strong> {{ $detail->report->protozoa ?? 'N/A' }}</li>
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="no-print" style="text-align: center;">
        <button onclick="window.print();" style="padding:10px 20px; font-size:16px;">Print Order</button>
    </div>
</body>
</html>
