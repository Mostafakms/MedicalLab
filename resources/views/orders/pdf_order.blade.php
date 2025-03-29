<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #{{ $order->id }} - Test Results</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        h1, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        /* فاصل صفحات */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- القسم العام للأوردر -->
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
                    @php $testName = strtolower($detail->test?->name ?? ''); @endphp
                    @if(!str_contains($testName, 'stool'))
                    <tr>
                        <td>{{ $detail->test?->name ?? 'Test not found' }}</td>
                        <td>{{ $detail->test?->normal_range ?? 'N/A' }}</td>
                        <td>{{ $detail->result }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        
        <!-- فاصل صفحة -->
        <div class="page-break"></div>
        
        <!-- قسم تقرير تحليل البراز -->
        <h1>Stool Analysis Detailed Report</h1>
        @foreach($order->orderDetails as $detail)
            @php $testName = strtolower($detail->test?->name ?? ''); @endphp
            @if(str_contains($testName, 'stool'))
                <h3>{{ $detail->test->name }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Normal Range</td>
                            <td>{{ $detail->test?->normal_range ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Result</td>
                            <td>{{ $detail->result }}</td>
                        </tr>
                        @if($detail->report)
                        <tr>
                            <td colspan="2"><strong>Detailed Report:</strong></td>
                        </tr>
                        <tr>
                            <td>Consistency</td>
                            <td>{{ $detail->report->consistency ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Mucus</td>
                            <td>{{ $detail->report->mucus ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Blood</td>
                            <td>{{ $detail->report->blood ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Odour</td>
                            <td>{{ $detail->report->odour ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Colour</td>
                            <td>{{ $detail->report->colour ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Worms</td>
                            <td>{{ $detail->report->worms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>RBC</td>
                            <td>{{ $detail->report->rbc ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Pus Cells</td>
                            <td>{{ $detail->report->pus_cells ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Starch Granules</td>
                            <td>{{ $detail->report->starch_granules ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Fat Globules</td>
                            <td>{{ $detail->report->fat_globules ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Muscle Fibers</td>
                            <td>{{ $detail->report->muscle_fibers ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Vegetable Cells</td>
                            <td>{{ $detail->report->vegetable_cells ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Ova</td>
                            <td>{{ $detail->report->ova ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Larva</td>
                            <td>{{ $detail->report->larva ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Protozoa</td>
                            <td>{{ $detail->report->protozoa ?? 'N/A' }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <hr>
            @endif
        @endforeach
    </div>
</body>
</html>
