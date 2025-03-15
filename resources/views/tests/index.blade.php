@extends('home')
@section('body')
</aside> <!--end::Sidebar--> <!--begin::App Main-->
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tests</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tests
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row g-4 d-flex justify-content-center"> <!--begin::Col-->
                <div class="col-md-6"> <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Tests</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        

                        <h1>Tests List</h1>
                        <a href="{{ route('tests.create') }}">Add New Test</a>
                        <table border="1">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Normal Range</th>
                                <th>Family</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($tests as $test)
                                <tr>
                                    <td>{{ $test->name }}</td>
                                    <td>{{ $test->price }}</td>
                                    <td>{{ $test->normal_range }}</td>
                                    <td>{{ $test->family }}</td>
                                    <td>
                                        <a href="{{ route('tests.edit', $test->id) }}">Edit</a>
                                        <form action="{{ route('tests.destroy', $test->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </body>
                    </html>
















                    </div> <!--end::Quick Example-->
                </div> <!--end::Col-->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>

<!-- Required Scripts for Flatpickr Datepicker -->
<!-- Flatpickr CSS and JS -->
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
