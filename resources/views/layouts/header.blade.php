<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Inves System - PT. Dasa Windu Agung (DWA)</title>        

        <link rel="icon" href="{{ asset('images/icon.png') }}">

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> 

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/css.min.css') }}">
    </head>

    <style>
        .font_unapprove {
            font-weight: bold;
            color: red;
        }

        .font_approve {
            font-weight: bold;
            color: green;
        }

        .font_process {
            font-weight: bold;
            color: blue;
        }
    </style>

    <script>
        var format_date_display_1 = 'dd-mm-yyyy';
        var format_date_display_2 = 'DD-MM-YYYY';
        var format_date_display_3 = 'YYYY-MM-DD';

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.date').datepicker({
                format: format_date_display_1,
                todayBtn: "linked",
                todayHighlight : true,
                autoclose: true,
            });

            $(".select2").select2();            

            $(document).on('input', '.only-number', function (event) {
                $(this).val($(this).val().replace(/[^0-9\.]/g,''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                $(this).val(currencyFormat($(this).val()));
            });
        });

        function currencyFormat(num, decimal = 0) {
            return accounting.formatMoney(num, "", decimal, ",", ".");
        }

        function amountToFloat(amount) {
            return parseFloat(accounting.unformat(amount));
        }
    </script>

    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">&nbsp;{{ Session::get('sess_username') }}&nbsp;</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div style="color:#6777ef" class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            &nbsp; &nbsp;{{ Session::get('sess_fullname') }}
                                        </div>
                                        <div class="col-md-12">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            &nbsp; &nbsp;{{ Session::get('sess_email') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('setting') }}" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div style="margin-top:10px" class="sidebar-brand">
                            <a href="/dashboard">
                                <img width="220px" src="{{ asset('images/logo-fix.png') }}" />
                            </a>
                            {{-- <p style="padding-top:30px;color:#4a5ad8;font-size:30px"><b>INVES System</b></p> --}}
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="/dashboard">INVES</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="menu-header">Controlling</li>
                            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('dashboard') }}">
                                    <i class="fas fa-chart-bar"></i><span>Dashboard</span>
                                </a>
                            </li>
                            @if(Session('sess_jabatan')=='Admin')
                            <li class="menu-header">Account</li>
                            <li class="{{ Request::is('menu-user') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('menu-user') }}">
                                    <i class="fas fa-columns"></i><span>Master User Supplier</span>
                                </a>
                            </li>
                            @endif
                            @if(Session('sess_rr')=='1')
                            <li class="menu-header">Receiving</li>
                            <li class="{{ Request::is('receiving-report') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('receiving-report') }}">
                                    <i class="fas fa-cubes"></i><span>Receiving Report</span>
                                </a>
                            </li>
                            @endif
                            @if(Session('sess_coi')=='1')
                            <li class="menu-header">Invoice</li>
                            <li class="{{ Request::is('certificate-of-invoice') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('certificate-of-invoice') }}">
                                    <i class="fas fa-list-ul"></i> <span>Certificate of Invoice</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </aside>
                </div>