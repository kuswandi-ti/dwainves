@include('layouts.header')

<?php
    use App\Helper\InvesHelper;
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate of Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('certificate_of_invoice_index') }}">Certificate of Invoice</a></div>
                <div class="breadcrumb-item active">Input Certificate of Invoice</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Input Certificate of Invoice</h2>
            <p class="section-lead">Membuat dokumen Certificate of Invoice baru yang akan dikirimkan ke PT. DWA</p>

            <form id="form_input_coi" method="post">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="far fa-arrow-alt-circle-right"></i> Langkah 1 - Pilih Dokumen DI</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label>Pilih Nomor PLO <span class="text-danger">*</span></label>
                                            <div id="detail_input_plo"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                        <div id="detail_input_rdi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card" id="card_faktur_pajak">
                            <div class="card-header">
                                <h4><i class="far fa-arrow-alt-circle-right"></i> Langkah 2 - Scan Faktur Pajak</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label>Scan Nomor Faktur Pajak <span class="text-danger">*</span></label>
                                            <input type="text" value="" id="no_faktur_pajak" name="no_faktur_pajak" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>Kode Jenis Transaksi</label>
                                            <input type="text" value="" id="kode_jenis_transaksi" name="kode_jenis_transaksi" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>FG Pengganti</label>
                                            <input type="text" value="" id="fg_pengganti" name="fg_pengganti" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>Nomor Faktur</label>
                                            <input type="text" value="" id="nomor_faktur" name="nomor_faktur" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>Tanggal Faktur</label>
                                            <input type="text" value="" id="tanggal_faktur" name="tanggal_faktur" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>DPP</label>
                                            <input type="text" value="" id="dpp_faktur" name="dpp_faktur" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>PPN</label>
                                            <input type="text" value="" id="ppn_faktur" name="ppn_faktur" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                        <div id="detail_input_faktur_pajak"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="far fa-arrow-alt-circle-right"></i> Langkah 3 - Input Nomor Invoice Supplier</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-9 col-lg-9 col-xl-9">
                                        <div class="form-group">
                                            <label>No. Invoice Supplier <span class="text-danger">*</span></label>
                                            <input type="text" value="" id="no_invoice_supplier" name="no_invoice_supplier" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                        <div class="form-group">
                                            <label>Tanggal Invoice Supplier</label>
                                            <div class="input-group">
                                                <input type="text" value="{{ date(InvesHelper::FORMAT_DATE_TO_DISPLAY_1) }}" id="tanggal_invoice_supplier" name="tanggal_invoice_supplier" class="form-control date" readonly>
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
                                        <div class="button">
                                            <button type="button" class="btn btn-icon icon-left btn-lg btn-primary font-weigh-bold" id="tambah_coi"><i class="fas fa-angle-double-down"></i> Tambahkan</button>
                                            <button type="button" class="btn btn-icon icon-left btn-lg btn-danger font-weigh-bold" id="reset_coi"><i class="fas fa-ban"></i> Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="far fa-arrow-alt-circle-right"></i> Langkah 4 - Create Dokumen Certificate of Invoice</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tabel_invoice_tmp">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No. PLO</th>
                                                <th class="text-center">No. Invoice</th>
                                                <th class="text-center">Tgl. Invoice</th>
                                                <th class="text-center">No. Faktur</th>
                                                <th class="text-center">Tgl. Faktur</th>
                                                <th class="text-right">DPP</th>
                                                <th class="text-right">PPN</th>
                                                <th class="text-right">Total</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detail_invoice_tmp">
                                        </tbody>
                                    </table>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="button">
                                            <button type="button" class="btn btn-icon icon-left btn-lg btn-warning font-weigh-bold" id="create_coi"><i class="far fa-check-circle"></i> Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_detail_invoice_tmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal_detail_invoice_tmp"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel_modal_invoice_detail_tmp">
                        <thead>
                            <tr>
                                <th class="text-center">No. DI</th>
                                <th class="text-center">Tgl DI</th>
                            </tr>
                        </thead>
                        <tbody id="detail_modal_invoice_tmp">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_detail_rdi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:95%!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal_detail_rdi"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <hr>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel_modal_rdi">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Part Number</th>
                                <th class="text-left">Part Name</th>
                                <th class="text-center">Unit</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody id="detail_modal_rdi">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::to('js/coi-input.min.js') }}"></script>

@include('layouts.footer')