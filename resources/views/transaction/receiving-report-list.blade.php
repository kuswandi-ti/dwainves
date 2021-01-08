@include('layouts.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Receiving Report</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">List Receiving Report</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">List Receiving Report</h2>
            <p class="section-lead">Menampilkan dokumen Receiving Report yang sudah pernah dibuat</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="padding-top:20px" class="form-group">
                                <div class="button">
                                    <a href="{{ route('input_receiving_report') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus-circle"></i> Buat RR Baru</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable_receiving_report_hdr" class="table text-nowarp table-striped table-bordered">
                                    <thead style="text-align:center;background:#6777ef;color:white">                               
                                        <tr>
                                            <th style="color: white" class="align-middle text-center">ID</th>
                                            <th style="color: white" class="align-middle text-center">No.</th>
                                            <th style="color: white" class="align-middle text-center">RR No</th>
                                            <th style="color: white" class="align-middle text-center">RR Date</th>
                                            <th style="color: white" class="align-middle text-center">DI No</th>
                                            <th style="color: white" class="align-middle text-center">DI Date</th>
                                            <th style="color: white" class="align-middle text-center">Delivery Date</th>
                                            <th style="color: white" class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="{{ URL::to('js/rr.min.js') }}"></script>

@include('layouts.footer')