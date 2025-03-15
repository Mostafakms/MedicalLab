@extends('home')
@section('body')
</aside> <!--end::Sidebar--> <!--begin::App Main-->
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Patient Data</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Patient Data
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
                            <div class="card-title">Enter Patient Data</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form> <!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name">
                                </div>

                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="text" class="form-control" id="age">
                                </div>

                                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                        <label class="form-check-label" for="male"> Male </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                        <label class="form-check-label" for="female"> Female </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" id="phone">
                                </div>

                                <div class="mb-3">
                                    <label for="doctor" class="form-label">Doctor</label>
                                    <input type="text" class="form-control" id="doctor">
                                </div>

                                <!-- Date of Appointment Field -->
                                <div class="mb-3">
                                    <label for="appointmentDate" class="form-label">Date of Appointment</label>
                                    <input type="text" class="form-control" id="appointmentDate" placeholder="Select date">
                                </div>
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="form-check">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> <!--end::Footer-->
                        </form> <!--end::Form-->
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
