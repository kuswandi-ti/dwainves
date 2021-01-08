@include('layouts.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate of Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">List Certificate of Invoice</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">List Certificate of Invoice</h2>
            <p class="section-lead">Menampilkan dokumen Certificate of Invoice yang sudah pernah dibuat</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="padding-top:20px" class="form-group">
                                <div class="button">
                                    <a href="{{ route('input_certificate_of_invoice') }}" class="btn btn-icon icon-left btn-primary" id="btn_new_coi"><i class="fas fa-plus-circle"></i> Buat COI Baru</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable_certificate_of_invoice_hdr" class="table text-nowarp table-striped table-bordered">
                                    <thead style="text-align:center;background:#6777ef;color:white">                               
                                        <tr>
                                            <th style="color: white" class="align-middle text-center">ID</th>
                                            <th style="color: white" class="align-middle text-center">No.</th>
                                            <th style="color: white" class="align-middle text-center">Certificate No</th>
                                            <th style="color: white" class="align-middle text-center">Certificate Date</th>
                                            <th style="color: white" class="align-middle text-center">PLO No</th>
                                            <th style="color: white" class="align-middle text-center">Total</th>
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

<script type="text/javascript" src="{{ URL::to('js/coi-list.min.js') }}"></script>

@include('layouts.footer')