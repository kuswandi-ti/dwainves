<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>REGISTER - INVES</title>

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
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <h1 style="color: #424da1">INVES SYSTEM</h1>
                            {{-- <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 style="font-size: 30px">REGISTRASI</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('postregister') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label style="font-weight:bold;font-size:16px" for="company">Nama Perusahaan</label>
                                            <input id="company" type="text" class="form-control" name="company" autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-weight:bold;font-size:16px" for="first_name">Nama User</label>
                                            <input id="first_name" type="text" class="form-control" name="name" autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-weight:bold;font-size:16px" for="jabatan">Jabatan</label>
                                            <input id="jabatan" type="text" class="form-control" name="jabatan">
                                            <div class="invalid-feedback"></div>
                                        </div>   
                                        <div class="form-group col-6">
                                            <label style="font-weight:bold;font-size:16px" for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label style="font-weight:bold;font-size:16px" for="last_name">Username</label>
                                            <input id="last_name" type="text" class="form-control" name="username">
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-weight:bold;font-size:16px" for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label style="font-weight:bold;font-size:16px" for="password2" class="d-block">Konfirmasi Password</label>
                                            <input id="password2" type="password" class="form-control" name="confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTER</button>
                                    </div>
                                    <div class="form-group col-6">
                                        Sudah memeliki account ? <a href="/">Masuk</a>
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

  <!-- Page Specific JS File -->
  <script src="{{ asset('login-assets/auth-register.js') }}"></script>
</body>
</html>
