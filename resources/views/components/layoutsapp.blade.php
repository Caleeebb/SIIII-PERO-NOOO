<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('MiProyectoLaravel/public/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('MiProyectoLaravel/public/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('MiProyectoLaravel/public/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('MiProyectoLaravel/public/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="#"><img src="{{ asset('MiProyectoLaravel/public/images/logo.svg') }}" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('MiProyectoLaravel/public/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="ti-view-list"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">                    
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset('MiProyectoLaravel/public/images/faces/no.png') }}" alt="profile" />
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                document.getElementById('logOutForm').submit();
                                ">
                                <i class="ti-power-off text-primary"></i>
                                Cerrar sesión
                                <form id="logOutForm" action="{{ route('logOut') }}" method="post" style="display:none;">
                                    @csrf()
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="ti-view-list"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="ti-shield menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="ti-palette menu-icon"></i>
                            <span class="menu-title">Reportes</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('resumen')}}">General</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('reporte.cliente')}}">Por cliente</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('entre_fechas') }}">Entre Fechas</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('clientes.index')}}">
                            <i class="ti-layout-list-post menu-icon"></i>
                            <span class="menu-title">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cobros.index')}}">
                            <i class="ti-pie-chart menu-icon"></i>
                            <span class="menu-title">Cobros</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('prestamos.index')}}">
                            <i class="ti-view-list-alt menu-icon"></i>
                            <span class="menu-title">Prestamos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cuotas.index')}}">
                            <i class="ti-star menu-icon"></i>
                            <span class="menu-title">Cuotas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">Usuario</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="#"> Login </a></li>
                                <li class="nav-item"> <a class="nav-link" href="#"> Login 2 </a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('formRegister') }}"> Register </a></li>
                                <li class="nav-item"> <a class="nav-link" href="#"> Register 2 </a></li>
                                <li class="nav-item"> <a class="nav-link" href="#"> Lockscreen </a></li>
                            </ul>
                        </div>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.templatewatch.com/" target="_blank">Templatewatch</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('MiProyectoLaravel/public/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('MiProyectoLaravel/public/vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('MiProyectoLaravel/public/js/off-canvas.js') }}"></script>
    <script src="{{ asset('MiProyectoLaravel/public/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('MiProyectoLaravel/public/js/template.js') }}"></script>
    <script src="{{ asset('MiProyectoLaravel/public/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('MiProyectoLaravel/public/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
</body>

</html>
