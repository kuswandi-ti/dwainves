<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>LOGIN - INVES</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('login-assets/style.css') }}">
  <link rel="stylesheet" href="{{ asset('login-assets/components.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <h1 style="color: #424da1 ">INVES SYSTEM</h1>
              {{-- <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
            </div>

            <div class="card card-primary">
              <div class="card-header">
                  <h4 style="font-size: 30px">LOGIN</h4>
                </div>

              <div class="card-body">
                <form method="POST" action="{{ route('postlogin') }}" class="needs-validation" novalidate="">
                    {{ csrf_field() }}
                    @if(\Session::has('alert-success'))
                    <div class="alert alert-success">
                        <i class="fa fa-info-circle" aria-hidden="true"></i><b>&nbsp; {{ Session::get('alert-success') }}</b>
                    </div>
                    @endif
                    @if(\Session::has('alert-verifikasi'))
                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle" aria-hidden="true"></i><b>&nbsp; {{ Session::get('alert-verifikasi') }}</b>
                    </div>
                    @endif
                    @if(\Session::has('alert-login'))
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b>&nbsp; {{ Session::get('alert-login') }}</b>
                    </div>
                    @endif
                    @if(\Session::has('alert-error'))
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b>&nbsp; {{ Session::get('alert-error') }}</b>
                    </div>
                    @endif
                    @if(\Session::has('alert'))
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle" aria-hidden="true"></i><b>&nbsp; {{ Session::get('alert') }}</b>
                    </div>
                    @endif
                    {{-- <div class="alert alert-info">
                        <i class="fa fa-info-circle" aria-hidden="true"></i><b>&nbsp; Selamat anda sudah Register</b>
                    </div> --}}
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Masukan Username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        Masukan Password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button style="font-size:16px" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      LOGIN
                    </button>
                  </div>
                  <div class="form-group">
                    Anda Belum Memiliki Akun ? Silahkan Melakukan Proses <u><a href="/register">Registrasi</a></u>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; PT. Dasa Windu Agung 2020
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('login-assets/stisla.js') }}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('login-assets/scripts.js') }}"></script>
  <script src="{{ asset('login-assets/custom.js') }}"></script>
</body>
</html>
