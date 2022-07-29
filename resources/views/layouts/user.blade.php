<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STTP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <link href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-user.css') }}">
    <script>
        $(document).ready(function() {
            setInterval(function(){ 
                $('.notification').css("display", "none");
            }, 5000);
        });
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link text-center">
                <span class="brand-text font-weight-light">Pendaftaran</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
                    <div class="info">
                        <div class="profile-photo">
                            @if (Auth::user()->photo == null)
                            <img src="{{ asset('assets/images/user-profile.webp') }}" alt="photo-profile" class="img-fluid">
                            @else
                            <img src="{{ asset('/storage') }}/{{ Auth::user()->photo }}" alt="photo-profile" class="img-fluid">
                            @endif
                        </div>
                        <a href="{{ route('user.profile.index') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('user.dashboard.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-laptop"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.biodata.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Biodata
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->nim == null)
                        @else
                        <li class="nav-item">
                            <a href="{{ route('user.pembayaran.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Pembayaran Pendaftaran
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('user.profile.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.auth.logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Keluar
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page_title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            @yield('breadcrumb')
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="notification">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('danger') }}
                            </div>
                        @endif
                    </div>

                    @yield('content')
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }}</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
    
    @stack('scripts')
</body>

</html>
