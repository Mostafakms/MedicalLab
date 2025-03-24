@extends('home')
@section('body')
</aside> <!--end::Sidebar-->
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Enter Test Results</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Enter Results</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->
    
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4 d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Enter Test Results for Order #{{ $order->id }}</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.saveResults', $order->id) }}" method="POST">
                                @csrf
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Test Name</th>
                                            <th>Normal Range</th>
                                            <th>Result</th>
                                            <th>Indication</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->test?->name ?? 'Test not found' }}</td>
                                            <td>{{ $detail->test?->normal_range ?? 'N/A' }}</td>
                                            <td>
                                                <input type="text" name="results[{{ $detail->test_id }}]" 
                                                       value="{{ $detail->result }}" 
                                                       class="form-control result-input" 
                                                       placeholder="Enter result"
                                                       data-normal-range="{{ $detail->test?->normal_range ?? '' }}">
                                            </td>
                                            <td>
                                                <span class="result-indicator"></span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <!-- Dropdown for Order Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Order Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Save Results</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>

<!-- Optional: Required Scripts for Flatpickr Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Listen for changes on each result input and update indication
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll('.result-input');
        
        inputs.forEach(input => {
            checkResult(input);
            input.addEventListener('input', function() {
                checkResult(input);
            });
        });
        
        function checkResult(input) {
            const normalRange = input.getAttribute('data-normal-range').trim();
            const enteredResult = input.value.trim();
            const indicator = input.parentElement.nextElementSibling;
            
            // For numeric range: "min-max"
            if(normalRange.includes('-')) {
                const parts = normalRange.split('-').map(x => parseFloat(x));
                const entered = parseFloat(enteredResult);
                if(isNaN(entered)) {
                    indicator.textContent = "";
                    indicator.style.color = "";
                } else if(entered >= parts[0] && entered <= parts[1]) {
                    indicator.textContent = "Normal";
                    indicator.style.color = "green";
                } else {
                    indicator.textContent = "Abnormal";
                    indicator.style.color = "red";
                }
            } else {
                // If normalRange is not numeric, compare as string
                if(enteredResult === normalRange) {
                    indicator.textContent = "Normal";
                    indicator.style.color = "green";
                } else {
                    indicator.textContent = "Abnormal";
                    indicator.style.color = "red";
                }
            }
        }
    });
</script>
@endsection
