@include('layouts.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Akun Supplier</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">Management Akun Supplier</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Management Akun Supplier</h2>
            <p class="section-lead">Management akun supplier berfungsi untuk menambahkan , mengubah, serta menghapus data akun supplier</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="padding-top:20px" class="form-group">
                                
                                @if(\Session::has('alert-register'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-register') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if(\Session::has('alert-update'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-update') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                <div class="buttons">
                                    <a href="{{ route('add_data_user') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus-circle"></i> Tambah Akun</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="data-user" class="table text-nowarp table-striped table-bordered">
                                    <thead style="text-align:center;background:#6777ef;color:white">
                                        <tr>
                                            <th style="color:white" class="align-middle">No.</th>
                                            <th style="color:white" class="align-middle">Nama Supplier</th>
                                            <th style="color:white" class="align-middle">Username</th>
                                            <th style="color:white" class="align-middle">E-Mail</th>
                                            <th style="color:white" class="align-middle">Jabatan</th>
                                            <th style="color:white" class="align-middle">Tanggal Registrasi</th>
                                            <th style="color:white" class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center">
                                        <tr>
                                        </tr>
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
<script type="text/javascript" src="{{ URL::to('js/user.min.js') }}"></script>
@include('layouts.footer')