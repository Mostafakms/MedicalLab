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
                    <h3 class="mb-0">Stool Analysis Report</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Stool Report</li>
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
                            <div class="card-title">Enter Stool Analysis Report for Order #{{ $order->id }}</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.saveStoolReport', ['orderId' => $order->id, 'orderDetailId' => $orderDetail->id]) }}" method="POST">
                                @csrf
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Parameter</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Consistency</td>
                                            <td><input type="text" name="consistency" class="form-control" value="{{ old('consistency', $report->consistency ?? 'Formed') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Mucus</td>
                                            <td><input type="text" name="mucus" class="form-control" value="{{ old('mucus', $report->mucus ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Blood</td>
                                            <td><input type="text" name="blood" class="form-control" value="{{ old('blood', $report->blood ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Odour</td>
                                            <td><input type="text" name="odour" class="form-control" value="{{ old('odour', $report->odour ?? 'Fecal') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Colour</td>
                                            <td><input type="text" name="colour" class="form-control" value="{{ old('colour', $report->colour ?? 'Brown') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Worms</td>
                                            <td><input type="text" name="worms" class="form-control" value="{{ old('worms', $report->worms ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Red Blood Cells (RBCs)</td>
                                            <td><input type="text" name="rbc" class="form-control" value="{{ old('rbc', $report->rbc ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Pus Cells</td>
                                            <td><input type="text" name="pus_cells" class="form-control" value="{{ old('pus_cells', $report->pus_cells ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Starch Granules</td>
                                            <td><input type="text" name="starch_granules" class="form-control" value="{{ old('starch_granules', $report->starch_granules ?? '++') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Fat Globules</td>
                                            <td><input type="text" name="fat_globules" class="form-control" value="{{ old('fat_globules', $report->fat_globules ?? '+') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Muscle Fibers</td>
                                            <td><input type="text" name="muscle_fibers" class="form-control" value="{{ old('muscle_fibers', $report->muscle_fibers ?? 'Few') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Vegetable Cells</td>
                                            <td><input type="text" name="vegetable_cells" class="form-control" value="{{ old('vegetable_cells', $report->vegetable_cells ?? '+') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Ova</td>
                                            <td><input type="text" name="ova" class="form-control" value="{{ old('ova', $report->ova ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Larva</td>
                                            <td><input type="text" name="larva" class="form-control" value="{{ old('larva', $report->larva ?? 'Nil') }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Protozoa</td>
                                            <td><input type="text" name="protozoa" class="form-control" value="{{ old('protozoa', $report->protozoa ?? 'Nil') }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success">Save Stool Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>
@endsection
