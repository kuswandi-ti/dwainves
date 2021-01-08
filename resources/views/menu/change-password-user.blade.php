@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Password</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('setting') }}">Setting Profile</a></div>
                <div class="breadcrumb-item active">Ubah Password</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Ubah Password</h2>
            <p class="section-lead">Memperbarui Password</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="card input_user">
                        <div class="card-body">
                            <div class="card-body">
                                @if(\Session::has('alert-null'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-null') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if(\Session::has('alert-nosame'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-nosame') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if(\Session::has('alert-length'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-length') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <form method="POST" action="{{ route('update-password') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Password Lama</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password Lama" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Password Baru</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Masukan Password Baru" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Ulangi Password</label>
                                            <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Ulangi Password Baru" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-info" type="submit">SUBMIT</button>
                                                <a class="btn btn-danger" href="{{ route('setting') }}">CANCEL</a>
                                            </div>
                                        </div>    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>   
    </section>
</div>
@include('layouts.footer')