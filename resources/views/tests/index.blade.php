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
                    <h3 class="mb-0">Tests</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tests</li>
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
                <div class="col-md-10"> 
                    <div class="card card-primary card-outline mb-4"> 
                        <div class="card-header">
                            <div class="card-title">Tests List</div>
                        </div> 
                        <div class="card-body">
                            <a href="{{ route('tests.create') }}" class="btn btn-primary mb-3">Add New Test</a>
                            
                            {{-- نفترض أن المتغير $groupedTests تم تجميعه في الـ Controller بواسطة groupBy --}}
                            @foreach($groupedTests as $family => $tests)
                                <h4 class="mt-4">{{ $family }}</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Normal Range</th>
                                            <th>Unit</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tests as $test)
                                            <tr>
                                                <td>{{ $test->name }}</td>
                                                <td>{{ number_format($test->price, 2) }} EGP</td>
                                                <td>{{ $test->normal_range }}</td>
                                                <td>{{ $test->Unit }}</td>
                                                <td>
                                                    <a href="{{ route('tests.edit', $test->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('tests.destroy', $test->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this test?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
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
