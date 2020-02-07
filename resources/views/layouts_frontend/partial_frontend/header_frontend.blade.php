<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
<![endif]-->
<!--[if !IE]><!-->
<html lang="en" ng-app="laravelApp">

<?php
$user_info      = \App\Core\Check::getInfo();
$companyName    = \App\Core\Check::companyName();
$companyLogo    = \App\Core\Check::companyLogo();
?>

<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>Digital Order</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Digital Order">
    <meta name="description" content="Digital Order : Digital Order Service System by Digital Tree">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel='shortcut icon' type='image/x-icon' href='/images/logo_favicon.png' />
    <!-- Font CSS -->
    <link href="/frontend/shared/css/font-awesome.min.css" rel="stylesheet" />

    <!-- JQuery -->
    <link href="/frontend/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" media="all" type="text/css"
        rel="stylesheet">
    <script src="/frontend/shared/js/jquery.js"></script>
    <script src="/frontend/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <!-- <script src="/frontend/js/jquery-3.3.1.js"></script> -->

    <!-- Jquery Validation -->
    <script src="/frontend/shared/js/validation/jquery.validate.js"></script>
    <script src="/frontend/shared/js/validation/additional-methods.js"></script>

    <!-- Sweet Alert -->
    <link href="/frontend/css/sweetalert.css" media="all" type="text/css" rel="stylesheet">
    <script src="/frontend/js/sweetalert-dev.js"></script>

    <!-- for select box with search function -->
    <link href="/frontend/css/select2.min.css" media="all" type="text/css" rel="stylesheet">

    <!-- Bootstrap V3 Core CSS -->
    {{-- <link href="/frontend/shared/css/bootstrap.min.css" rel="stylesheet">
    <script src="/frontend/shared/js/bootstrap.min.js"></script> --}}

    <!-- Bootstrap V3 Core CSS -->

    <link href="/frontend/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="/frontend/bootstrap/4.3.1/js/jquery-3.2.1.slim.min.js"></script> --}}
    <script src="/frontend/bootstrap/4.3.1/js/popper.min.js"></script>
    <script src="/frontend/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    <!-- Bootstrap Date-Picker Plugin -->
    <script src="/frontend/shared/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

    <!-- for jssor slider -->
    <script src="/frontend/shared/js/jssor.slider-23.1.5.min.js" type="text/javascript"></script>

    <!-- Custom CSS -->
    <link href="/frontend/shared/css/style.min.css" rel="stylesheet">
    {{-- <link href="/frontend/shared/css/createacc.css" rel="stylesheet"> --}}
    <link href="/frontend/mine/css/my_styles.css" rel="stylesheet">

</head>

<style>
    .myModal {
        z-index: 1500;
        /*transform: translate(0, -50%);
        top: 50%;
        margin: 0 auto; */
    }
</style>

<body>

    @include('frontend.login')

    <header>
        <nav class="navbar navbar-expand-lg  sticky-top navbar-light bg-white">
            <a class="navbar-brand" href="#"><img class="frontend-header-logo" src="{{$companyLogo}}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- <li>
                    <a href="/service">Service</a>
                </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="/item">Item</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="/category">Category</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/brand">Brand</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/article">Article</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/gallery">Gallery</a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="/faq_information">Q & A</a>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link" href="/about_us">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/contact_us">Contact Us</a>
                    </li>

                    {{-- @if(!\Illuminate\Support\Facades\Session::has('customer'))
                <li class="nav-item">
                    <a href="/register">Register</a>
                </li>
                @endif --}}

                    {{-- <li class="nav-item">
                    <div class="login">
                        <ul>
                            <li class="nav-item">
                                @if(\Illuminate\Support\Facades\Session::has('customer'))
                                
                                <div class="dropdown login">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="/images/user1.png">
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/profile">{{trans('frontend_header.profile')}}</a></li>
                    <li><a href="/orders">Order List</a></li>
                    <li><a href="\logout">{{trans('frontend_header.logout')}}</a></li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

            </div>
            @else
            <a href="#" data-toggle="modal" data-target="#loginModal">
                {{trans('frontend_header.login')}}
            </a>

            @endif
            </li>
            </ul>
            </div>
            </li> --}}
            </ul>


            </div>
        </nav>
    </header>


<script>
    $(document).ready(function(){
        $('.nav a').on('click', function(){
            $('.btn-navbar').click(); //bootstrap 2.x
            $('.navbar-toggle').click(); //bootstrap 3.x by Richard
            $('.navbar-toggler').click(); //bootstrap 4.x
        });

    });
</script>