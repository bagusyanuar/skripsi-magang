<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <title>Document</title>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<nav class="main-header navbar navbar-expand elevation-1">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link navbar-link-item" data-widget="pushmenu" href="#" role="button"><i
                    class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/logout" class="nav-link navbar-link-item">Logout</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <div class="sidebar">
        <a href="/" class="brand-link">
            <img src="{{ asset('assets/icon/logo-wonogiri.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image"
            >
            <span class="brand-text font-weight-light">Kab. Wonogiri</span>
        </a>
        <div class="my-sidebar-menu">
            <ul class="nav nav-sidebar nav-pills flex-column">
                <nav class="mt-2 nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                    <li class="nav-item">
                        <a href="/"
                           class="nav-link">
                            <i class="fa fa-tachometer nav-icon" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-header" style="padding: 0.5rem 1rem 0.5rem 1rem;">
                            Master Data
                        </li>
                        <li class="nav-item">
                            <a href="/karyawan"
                               class="nav-link">
                                <i class="fa fa-vcard nav-icon" aria-hidden="true"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/divisi"
                               class="nav-link">
                                <i class="fa fa-tags nav-icon" aria-hidden="true"></i>
                                <p>Divisi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/peserta"
                               class="nav-link">
                                <i class="fa fa-group nav-icon" aria-hidden="true"></i>
                                <p>Peserta Magang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pengajuan"
                               class="nav-link">
                                <i class="fa fa-sticky-note nav-icon" aria-hidden="true"></i>
                                <p>Pengajuan Magang</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>
                                <p>
                                    Laporan
                                    <i class="right fa fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/laporan-pengajuan"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Pengajuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laporan-peserta"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Peserta Magang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laporan-kegiatan"
                                       class="nav-link">
                                        <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                        <p>Kegiatan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @elseif(auth()->user()->role == 'peserta')

                        <li class="nav-item">
                            <a href="/pengajuan-magang"
                               class="nav-link">
                                <i class="fa fa-sticky-note nav-icon" aria-hidden="true"></i>
                                <p>Pengajuan Magang</p>
                            </a>
                        </li>
                        @if(auth()->user()->peserta->status != 'menunggu' && auth()->user()->peserta->status != 'mengajukan')
                            <li class="nav-item">
                                <a href="/kegiatan"
                                   class="nav-link">
                                    <i class="fa fa-tags nav-icon" aria-hidden="true"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                        @endif
                    @elseif(auth()->user()->role == 'karyawan')
                        <li class="nav-item">
                            <a href="/peserta-bimbingan"
                               class="nav-link">
                                <i class="fa fa-tags nav-icon" aria-hidden="true"></i>
                                <p>Peserta Bimbingan</p>
                            </a>
                        </li>
                    @endif

                </nav>
            </ul>
        </div>
    </div>
</aside>
<div class="content-wrapper p-3">
    @yield('content-title')
    @yield('content')
</div>
<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset ('/adminlte/js/adminlte.js') }}"></script>
<script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>
@yield('js')
</body>
</html>
