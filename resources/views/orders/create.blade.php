@extends('home')
@section('body')
</aside> <!--end::Sidebar-->
<!--begin::App Main-->
<main class="app-main">
    <!-- App Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Order</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- App Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Add New Order</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                                @csrf
                                <!-- Patient Search Dropdown -->
                                <div class="mb-3">
                                    <label for="patient_id" class="form-label">Patient</label>
                                    <select name="patient_id" id="patient_id" class="form-control select2" required>
                                        <option value="">Select Patient</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Order Date -->
                                <div class="mb-3">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" name="order_date" id="order_date" class="form-control" required>
                                </div>
                                
                                <!-- Tests Section: Display tests grouped by family -->
                                <div class="mb-3">
                                    <h3>Select Tests:</h3>
                                    @foreach($tests as $family => $testList)
                                        <div class="mb-2">
                                            <h4>{{ $family }}</h4>
                                            @foreach($testList as $test)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input test-checkbox" 
                                                           name="test_ids[]" value="{{ $test->id }}" 
                                                           data-price="{{ $test->price }}" id="test_{{ $test->id }}">
                                                    <label class="form-check-label" for="test_{{ $test->id }}">
                                                        {{ $test->name }} ({{ $test->price }} EGP)
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Total Price (Client-side Calculation) -->
                                <div class="mb-3">
                                    <label for="total_price" class="form-label">Total Price (EGP)</label>
                                    <input type="text" name="total_price" id="total_price" class="form-control" readonly>
                                </div>
                                
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Add Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Flatpickr CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Include jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Initialize Select2 for patient search
    $(document).ready(function() {
        $('#patient_id').select2({
            placeholder: 'Select Patient',
            allowClear: true
        });
        
        // Initialize Flatpickr (if needed for other fields)
        flatpickr("#order_date", {
            dateFormat: "Y-m-d",
            allowInput: true
        });
        
        // Client-side calculation for total price
        const checkboxes = document.querySelectorAll('.test-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', calculateTotal);
        });
        
        function calculateTotal() {
            let total = 0;
            checkboxes.forEach(function(cb) {
                if (cb.checked) {
                    total += parseFloat(cb.dataset.price);
                }
            });
            document.getElementById('total_price').value = total.toFixed(2);
        }
    });
</script>
@endsection
