@extends('home')
@section('body')
</aside> <!--end::Sidebar--> <!--begin::App Main-->
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Patients</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Patients
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
                            <div class="card-title">Patients</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        

                        <h1>Patients List</h1>
                        <a href="{{ route('patients.create') }}">Add New Patient</a>
                        <table border="1">
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>{{ $patient->phone }}</td>
                                    <td>
                                        <a href="{{ route('patients.edit', $patient->id) }}">Edit</a>
                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
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
