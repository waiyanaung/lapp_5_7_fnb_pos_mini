<?php
$user_info = \App\Core\Check::getInfo();
$user_id = $user_info['userId'];
$companyName = \App\Core\Check::companyName();
$companyLogo = \App\Core\Check::companyLogo();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="/backend/matrix_admin/assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title> -->
    
    <link rel='shortcut icon' type='image/x-icon' href='/images/logo_favicon.png' />
    <title>Digital Tree Backend</title>
    <!-- Custom CSS -->
    <link href="/backend/matrix_admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="/backend/matrix_admin/assets/extra-libs/multicheck/multicheck.css" rel="stylesheet" type="text/css">
    <link href="/backend/matrix_admin/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/backend/matrix_admin/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/backend/martix_admin/assets/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="/backend/martix_admin/assets/respond.js/1.4.2/respond.min.js"></script>
     <!-- Sweet Alert -->
    <link href="/backend/plugins/sweetalert/sweetalert.css" media="all" type="text/css" rel="stylesheet">
    <link href="/backend/mine/css/my_styles.css" media="all" type="text/css" rel="stylesheet" >    
    <link  href="/backend/plugins/jasny/css/jasny-bootstrap.css" media="all" type="text/css" rel="stylesheet">

    <script src="/backend/matrix_admin/assets/libs/jquery/dist/jquery.min.js"></script>    
    <script src="/backend/matrix_admin/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/backend/matrix_admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/backend/matrix_admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/backend/matrix_admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/backend/matrix_admin/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="/backend/matrix_admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/backend/matrix_admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/backend/matrix_admin/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="/backend/matrix_admin/dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    
    <script src="/backend/matrix_admin/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot/excanvas.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot/jquery.flot.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="/backend/matrix_admin/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="/backend/matrix_admin/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="/backend/matrix_admin/assets/extra-libs/multicheck/jquery.multicheck.js"></script>

    <!-- my css and js file-->
    {{-- <script src="/backend/plugins/sweetalert/sweetalert-dev.js"></script> --}}
    <script src="/backend/plugins/sweetalert/sweetalert.2.1.2.min.js"></script>
    

    {{--For summernote editor--}}
    <link rel="stylesheet" href="/backend/plugins/summernote/summernote.css" type="text/css" media="all" />
    <script src="/backend/plugins/summernote/summernote.min.js"></script>
    
    <!-- for image upload modal jquery -->
    <script src="/backend/plugins/jasny/js/jasny-bootstrap.js"></script>
    
    
<![endif]-->
<style>

.error {
    color: red;
    font-weight: bold;
 }


    .font_white{
        color: white;
    }
</style>

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu tiin-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="/backend_app">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            {{-- <img src="/backend/matrix_admin/assets/images/logo-icon.png" alt="homepage" class="light-logo" /> --}}
                           
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             {{-- <img src="/backend/matrix_admin/assets/images/logo-text.png" alt="homepage" class="light-logo" /> --}}
                            
                             <?php                       
                                $companyName    = \App\Core\Check::companyName();
                                $companyLogo    = \App\Core\Check::companyLogo();
                                ?>
                                <span class="font_white"><h4><?php //echo $companyName; ?></h4></span>
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="/backend/matrix_admin/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/backend/matrix_admin/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="/backend_app/user/profile/{{ $user_id}}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="/backend_app/user/password/{{ $user_id}}"><i class="ti-user m-r-5 m-l-5"></i> Change Password</a>
                                <a class="dropdown-item" href="/backend_app/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->


