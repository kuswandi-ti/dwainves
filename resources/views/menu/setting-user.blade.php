@include('layouts.header')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Setting Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">Setting Profile</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card input_user">
                        <div class="card-body">
                            <div class="card-body">
                                @if(\Session::has('alert-update'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-update') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <form method="POST" action="">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <a href="{{ route('ubah-password') }}" class="btn btn-warning"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp;Ubah Password</a>
                                            </div>
                                        </div>
                                        <div style="text-align:center" class="col-md-12">
                                            <div class="form-group">
                                                <img style="width:150px" alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Vendor Name</label>
                                            <input value="{{ $vendor_name }}" type="text" class="form-control" id="vendor_name" name="vendor_name" tabindex="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Username</label>
                                            <input value="{{ $username }}" type="text" class="form-control" id="username" name="username" tabindex="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">E-Mail</label>
                                            <input value="{{ $email }}" type="email" class="form-control" id="email" name="email" tabindex="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Password</label>
                                            <input value="{{ $password }}" type="password" class="form-control" id="password" name="password" tabindex="1" readonly>
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