<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="pixelstrap" />
        <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon" />
        <title>Library</title>
        <!-- Google font-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
        <!-- Font Awesome-->
        <link rel="stylesheet" type="text/css" href="/assets/css/fontawesome.css" />
        <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="/assets/css/icofont.css" />
        <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="/assets/css/themify.css" />
        <!-- Flag icon-->
        <link rel="stylesheet" type="text/css" href="/assets/css/flag-icon.css" />
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="/assets/css/feather-icon.css" />
        <!-- Plugins css start-->
        @yield('css')
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css" />
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
        <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen" />
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <body>
        <!-- Loader starts-->
        <div class="loader-wrapper">
            <div class="theme-loader">
                <div class="loader-p"></div>
            </div>
        </div>
        <!-- Loader ends-->
        <!-- page-wrapper Start-->
        <div class="page-wrapper" id="pageWrapper">
            <!-- Page Header Start-->
            <div class="page-main-header">
                <div class="main-header-right row m-0">
                    <div class="main-header-left">
                        <div class="logo-wrapper">
                            <a href="index.html"><img class="img-fluid" src="/assets/images/logo/logo.png" alt="" /></a>
                        </div>
                        <div class="dark-logo-wrapper">
                            <a href="index.html"><img class="img-fluid" src="/assets/images/logo/dark-logo.png" alt="" /></a>
                        </div>
                        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
                    </div>

                    <div class="nav-right col pull-right right-menu p-0">
                        <ul class="nav-menus">
                            <li>
                                <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a>
                            </li>

                            <li class="onhover-dropdown p-0">
                                <form  method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-primary-light" type="button">
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <i data-feather="log-out"></i>Keluar</a>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
                </div>
            </div>
            <!-- Page Header Ends                              -->
            <!-- Page Body Start-->
            <div class="page-body-wrapper horizontal-menu">
                <!-- Page Sidebar Start-->
                <header class="main-nav">
                    @if(Auth::guard('admin')->check())
                    <div class="sidebar-user text-center">
                        <a class="setting-primary" href="/profile"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="/assets/images/dashboard/1.png" alt="" />
                        <!-- <div class="badge-bottom"><span class="badge badge-primary">New</span></div> -->
                        <a href="/profile"> <h6 class="mt-3 f-14 f-w-600">{{ucfirst(Auth::guard('admin')->user()->name)}}</h6></a>
                        <p class="mb-0 font-roboto">{{Auth::guard('admin')->user()->email}} </p>
                    </div>
                    @include('layouts.sidebar.admin')
                    @elseif(Auth::guard('member')->check())
                    <div class="sidebar-user text-center">
                        <a class="setting-primary" href="/profile"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="/assets/images/dashboard/1.png" alt="" />
                        <!-- <div class="badge-bottom"><span class="badge badge-primary">New</span></div> -->
                        <a href="/member/profile"> <h6 class="mt-3 f-14 f-w-600">{{ucfirst(Auth::guard('member')->user()->name)}}</h6></a>
                        <p class="mb-0 font-roboto">{{Auth::guard('member')->user()->email}} </p>
                    </div>
                    @include('layouts.sidebar.user')
                    @endif
                </header>
                <!-- Page Sidebar Ends-->
                <div class="page-body">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                @yield('header')
                                
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid starts-->
                    <div class="container-fluid">
                        <div class="row">
                            @yield('body')
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
                <!-- footer start-->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 footer-copyright">
                                <p class="mb-0">Copyright 2022 © All rights reserved.</p>
                            </div>
                            <div class="col-md-6">
                                <p class="pull-right mb-0">Aplikasi by Me with <i class="fa fa-heart font-secondary"></i></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="/assets/js/jquery-3.5.1.min.js"></script>
        <!-- feather icon js-->
        <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- Sidebar jquery-->
        <script src="/assets/js/sidebar-menu.js"></script>
        <script src="/assets/js/config.js"></script>
        <!-- Bootstrap js-->
        <script src="/assets/js/bootstrap/popper.min.js"></script>
        <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
        <!-- Plugins JS start-->
        @yield('script')
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="/assets/js/script.js"></script>
        <!-- login js-->
        <!-- Plugin used-->
        <script src="{{asset('/assets/js/sweetalert.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        <script>
            function errorToast(err) {
                if (err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        toastr["error"](error[0]);
                    });
                }
            }
        </script>
        @if(session('success'))
            <script>
                toastr["success"]("{{session('success')}}");
            </script>
        @elseif(session('error'))
            <script>
                toastr["error"]("{{session('error')}}");
            </script>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr["error"]("{{$error}}");
                </script>
            @endforeach
        @endif
        
    </body>
</html>
