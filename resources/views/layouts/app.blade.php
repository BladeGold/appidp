<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title'){{ config('app.name') }} </title>

    <!-- Scripts offline-->

    <script src="{{asset('dist/js/adminlte.min.js')}}" defer></script>
    <script src="{{asset('dist/js/bootstrap.min.js')}}" defer></script>
    <script src="{{asset('dist/js/jquery.min.js')}}"></script> 
    <script src="{{asset('dist/js/popper.min.js')}}"></script>
    <script  src="{{asset('dist/js/jquery.dataTables.min.js')}}" defer></script>
    <script  src="{{asset('dist/js/dataTables.responsive.min.js')}}" defer></script>
    <script src="{{asset('dist/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dist/js/reponsive.bootstrap.min.js')}}"> </script>

    @stack('scripts')

    <!-- Scripts online -->
    
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script  src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
    <script  src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap.min.js"> </script>
-->

<!-- Font Awesome Icons -->
    <!--<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">-->
    <script src="https://kit.fontawesome.com/ada267d788.js" crossorigin="anonymous"></script>
    <!-- Fonts Online-->
    <link href="{{asset('dist/css/font.min.css')}}"
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

    <!-- Styles -->


    <link href="{{ asset('dist/css/adminlte.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('dist/img/favicon/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/jquery.dataTables.min.css')}}" >
    <link rel="stylesheet" href="{{asset('dist/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/buttons.dataTables.min.css')}}">


    <!-- Styles Online
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap.min.js">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">
    -->


</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">
    <!-- Navbar -->

        <nav class="main-header navbar navbar-expand-md navbar-light " style="background: linear-gradient(135deg, rgba(73,155,234,1) 0%, rgba(73,155,234,1) 13%, rgba(25,105,179,1) 37%, rgba(224,20,20,1) 100%);">

                <a class="navbar-toggler order-1 " type="button" data-toggle="collapse" @auth() data-widget="pushmenu" @endauth data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{ asset('dist/img/logo1.png') }}" alt=" Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light text-white">{{ config('app.name') }}</span>
                </a>


                <div class="collapse navbar-collapse order-3" @auth() id=""@endauth  @guest() id="navbarCollapse" @endguest>
                    <!-- Left navbar links -->
                    <ul class="navbar-nav align-content-center">
                       @auth()
                            <li class="nav-item col-xs-1">
                                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-2x"></i></a>
                            </li>
                       @endauth
                          @guest()

                               <li class="nav-item" >
                                   <a href="{{url('/')}}" class="nav-link  text-white border elevation-2" style="border-radius: 10px">Inicio</a>
                               </li>
                               <li class="p-1">

                               </li>
                               <li class="nav-item ">
                                   <a href="#" class="nav-link  text-white border elevation-2 "  style="border-radius: 10px;">Contacto</a>
                               </li>
                          @endguest

                    </ul>

                    <!-- SEARCH FORM -->

                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto ">
                   @auth()
                        <form class="form-inline ml-0 ml-md-3">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                   @endauth
                       @guest
                           <li class="nav-item">
                               <a class="nav-link  text-white border elevation-2" id="login" style="border-radius: 10px" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                           </li>
                           <li class="p-1">

                           </li>
                           @if (Route::has('register'))
                               <li class="nav-item " >
                                   <a class="nav-link p2 text-white border elevation-2" style="border-radius: 10px;" id="registro"  href="{{ route('register') }}">{{ __('Registro') }}</a>
                               </li>
                           @endif
                                @else
                       @endguest

                </ul>
            </div>
        </nav>

        <!-- /.navbar -->
@auth()
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ asset('dist/img/logo1.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <p style="font-size: x-small"><span class="font-weight-light">{{ config('app.name')}}</span></p>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('imgprofile/').'/'.Auth::user()->imagen}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('users.show', Auth::id() ) }}" class="d-block">{{Auth::user()->name}} {{ Auth::user()->last_name }}
                            <a class="btn btn-block btn-danger btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style=display:none;">
                                @csrf
                            </form>
                        </a>

                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a @can('Administrador') href="{{ route('admin.dashboard') }}" @endcan
                            @can('Usuario' || 'Pastor' || 'Tesorera' || 'Maestro') href="{{ route('users.index') }}" @endcan class="    nav-link">
                                <i class="nav-icon fa fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @can('Administrador')
                            <li class="nav-item">
                                <a href="{{route('admin.show_users')}}"
                                   class="nav-link nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        Usuarios
                                        <?php $users_count= DB::table('users')->count(); ?>
                                        <span class="right badge badge-danger">{{ $users_count ?? '0' }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('roles.index')}}"
                                   class="nav-link nav-link">
                                    <i class="nav-icon fa fa-user-tag"></i>
                                    <p>
                                        Roles de Usuarios
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('iglesias.index')}}"
                                   class="nav-link nav-link">
                                    <i class="nav-icon fa fa-church"></i>
                                    <p>
                                        Iglesias
                                        <?php $iglesias_count= DB::table('iglesias')->count(); ?>
                                        <span class="right badge badge-danger">{{ $iglesias_count ?? '0' }}</span>
                                    </p>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    @endauth



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">

                    @include('mensaje')
                    @yield('content')
                    @include('script')
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


</body>
</html>

