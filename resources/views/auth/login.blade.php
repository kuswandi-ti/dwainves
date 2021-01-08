<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script
            src="https://kit.fontawesome.com/64d58efce2.js"
            crossorigin="anonymous">
        </script>
        <link rel="shortcut icon" href="{{ asset('images/icon.png') }}"/>
        <link rel="stylesheet" href="{{ asset('auth-assets/style.css') }}"/>
        <title>Welcome to Inves System</title>
    </head>
    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <img style="position:absolute;left:500px;top:-100px;width:100px" src="{{ asset('auth-assets/img/logo.jpg') }}"/>
                    <form method="POST" action="{{ route('postlogin') }}" class="sign-in-form">
                        {{ csrf_field() }}

                        <h2 class="title">LOGIN</h2>

                        <img style="padding-bottom:20px" width="400px" src="{{ asset('images/logo-fix.png') }}" />

                        <br>

                        @if(\Session::has('alert-success'))
                        <div style="text-align:center" class="alert alert-success">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-success') }}
                        </div>
                        <br>
                        @endif
                        @if(\Session::has('alert-akses'))
                        <div style="text-align:center" class="alert alert-warning">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-akses') }}
                        </div>
                        <br>
                        @endif
                        @if(\Session::has('alert-verifikasi'))
                        <div style="text-align:center" class="alert alert-warning">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-verifikasi') }}
                        </div>
                        <br>
                        @endif
                        @if(\Session::has('alert-login'))
                        <div style="text-align:center" class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-login') }}
                        </div>
                        <br>
                        @endif
                        @if(\Session::has('alert-error'))
                        <div style="text-align:center" class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-error') }}
                        </div>
                        <br>
                        @endif
                        @if(\Session::has('alert-non'))
                        <div style="text-align:center" class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert-non') }}
                        </div>
                        <br>
                        @endif
                        @if(\Session::has('alert'))
                        <div style="text-align:center" class="alert alert-info">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{ Session::get('alert') }}
                        </div>
                        <br>
                        @endif
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input name="username" type="text" placeholder="Username" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Password" />
                        </div>
                        <button type="submit" class="btn solid">
                            LOGIN
                        </button>
                    </form>
                    <form action="#" class="sign-up-form">
                        <h2 class="title">REGISTRASI</h2>
                        <img style="padding-bottom:20px" width="400px" src="{{ asset('images/logo-fix.png') }}"/>
                        <div style="text-align: left">
                            <p style="font-size:14px;font-weight:bold">Untuk melakukan registrasi silahkan ikuti langkah sebagai berikut :</p>
                            <ol style="padding-left:15px;text-align: left">
                                <li>Silahkan mendownload file <b>Form Registrasi</b> dibawah ini :<br>
                                    <i style="color:blue" class="fa fa-file-pdf-o" aria-hidden="true"></i> <a style="color:blue" href="{{ asset('file/register-form.pdf') }}" target="_blank">Form Registrasi</a></li>
                                <li>Isi form registrasi tersebut, sesuai dengan data user yang akan anda buat <i>ex : Nama, Email, Username, Password</i></li>
                                <li>Kirim <b>Form Registrasi</b> melalui email ke : <b>email@dwa.co.id</b></li>
                                <li>Jika anda sudah menerima balasan email maka login kembali dengan username dan password yang anda isi pada form registrasi</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="panels-container">
                    <div class="panel left-panel">
                    <div class="content">
                        <h3>Belum Memiliki Account ?</h3>
                        <p>Silahkan anda registrasi terlebih dahulu klik tombol REGISTER</p>
                        <button class="btn transparent" id="sign-up-btn">REGISTER</button>
                    </div>
                    <img src="{{ asset('auth-assets/img/log.svg') }}" class="image" alt="" />
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>Sudah memiliki akun ?</h3>
                        <p>Silahkan melakukan login dengan klik tombol LOGIN</p>
                        <button class="btn transparent" id="sign-in-btn">LOGIN</button>
                    </div>
                    <img src="{{ asset('auth-assets/img/register.svg') }}" class="image" alt="" />
                </div>
            </div>
        </div>
        <script src="{{ asset('auth-assets/app.js') }}"></script>
    </body>
</html>
