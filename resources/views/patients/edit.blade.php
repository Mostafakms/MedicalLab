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
                        





                        <body>
    <h1>Edit Patient</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $patient->name }}" required> <br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob"  value="{{ $patient->dob }}" required><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ $patient->phone }}" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" value="{{ $patient->address }}" name="address"> <br>

        <button type="submit">Submit Edit</button>
    </form>
</body>













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
