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
                    <h3 class="mb-0">Orders</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header-->
    
    <!--begin::Filter Form-->
    <div class="container-fluid mb-3">
        <form action="{{ route('orders.index') }}" method="GET" class="d-flex align-items-center">
            <label for="status" class="me-2">Filter by Status:</label>
            <select name="status" id="status" class="form-select me-2" style="width: 200px;">
                <option value="">All</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
    <!--end::Filter Form-->
    
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4 d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Orders List</div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->patient->name ?? 'N/A' }}</td>
                                            <td>{{ number_format($order->total_amount, 2) }} EGP</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ ucfirst($order->status) }}</td>
                                            <td>
                                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('orders.results', $order->id) }}" class="btn btn-sm btn-primary">Enter Results</a>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#appointmentDate", {
            dateFormat: "m/d/Y",
            allowInput: true
        });
    });
</script>
@endsection
