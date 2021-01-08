@include('layouts.header')

<?php
    use App\Helper\InvesHelper;
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Receiving Report</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('receiving_report_index') }}">Receiving Report</a></div>
                <div class="breadcrumb-item active">Input Receiving Report</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Input Receiving Report</h2>
            <p class="section-lead">Membuat dokumen Receiving Report baru yang akan dikirimkan ke PT. DWA</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="form_input_rr" method="post">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label>Nomor RR</label>
                                                <input type="text" value="AUTO" id="no_rr" name="no_rr" class="form-control" readonly>
                                                <input type="hidden" value="" id="id_rr" name="id_rr" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label>Tanggal RR (d-m-y)</label>
                                                <input type="text" value="{{ date(InvesHelper::FORMAT_DATE_TO_DISPLAY_1) }}" id="tgl_rr" name="tgl_rr" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label>Nomor DI <span class="text-danger">*</span></label>
                                                <select name="cbo_nomor_rdi" id="cbo_nomor_rdi" class="form-control select2">
                                                    <option value="0" data-id="0">-- Pilih Nomor DI --</option>
                                                    @foreach($os_gr as $r)
                                                        <option value="{{ $r->DI_No }}" data-id="{{ (int)$r->DI_Id }}" data-date="{{ $r->DI_Date }}">{{ $r->DI_No }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label>Tanggal DI (d-m-y)</label>
                                                <div class="input-group">
                                                    <input type="text" value="AUTO" id="tgl_rdi" name="tgl_rdi" class="form-control" readonly>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="form-group">
                                                <label>Nomor SJ Vendor <span class="text-danger">*</span></label>
                                                <input type="text" value="" id="no_sj_vendor" name="no_sj_vendor" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label>Tanggal SJ Vendor (d-m-y)</label>
                                                <div class="input-group">
                                                    <input type="text" value="{{ date(InvesHelper::FORMAT_DATE_TO_DISPLAY_1) }}" id="tgl_sj_vendor" name="tgl_sj_vendor" class="form-control date">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                            <div class="form-group">
                                                <label>Tanggal Pengiriman (d-m-y)</label>
                                                <div class="input-group">
                                                    <input type="text" value="{{ date(InvesHelper::FORMAT_DATE_TO_DISPLAY_1) }}" id="tgl_pengiriman" name="tgl_pengiriman" class="form-control" readonly>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    
                                    <div class="row">
                                        <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">
                                            <div class="custom-control custom-checkbox text-center">
                                                <!-- <input type="checkbox" class="custom-control-input" id="check_all">
                                                <label class="custom-control-label" for="check_all">&nbsp;</label> -->
                                                <input type="checkbox" id="check_all">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2 text-center">
                                            <label class="font-weight-bold">Part Number</label>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                            <label class="font-weight-bold">Part Name</label>
                                        </div>
                                        <div class="col-xs-12 col-md-1 col-lg-1 col-xl-1 text-center">
                                            <label class="font-weight-bold text-center">Satuan</label>
                                        </div>
                                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2 text-right">
                                            <label class="font-weight-bold">Qty RR (Input)</label>
                                        </div>
                                        <div class="col-xs-12 col-md-2 col-lg-2 col-xl-2 text-right">
                                            <label class="font-weight-bold">Qty RR (OS)</label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div id="detail_input_rr"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="{{ URL::to('js/rr.min.js') }}"></script>

@include('layouts.footer')