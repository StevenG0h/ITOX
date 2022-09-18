<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('image/LogoITO_1.png') }}" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/adminTemplate/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/adminTemplate/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .nav-link{
            background: transparent;
            border: none;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ITO X Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Lomba
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('teamsView') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Tim</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('AdminDashboard') }}">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Peserta</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('paymentsView') }}">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Pembayaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('showCompetitions') }}">
                    <i class="fas fa-fw fa-trophy"></i>
                    <span>Cabang Lomba</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('userView') }}">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Users</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Akun
            </div>

            <!-- Nav Item - Charts -->

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <form action="{{route('logout')}}" method="post">
                    <button class="nav-link" type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span></button>
                    </form>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- End of Topbar -->
                <div>
                    @yield('admin')
                </div>
            </body>
</html>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>