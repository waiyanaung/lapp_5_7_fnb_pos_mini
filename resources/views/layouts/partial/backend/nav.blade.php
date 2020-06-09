<?php
$user_info = \App\Core\Check::getInfo();
$user_role_id = $user_info['userRoleId'];
?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend_app/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                
                @if($user_role_id == 1)

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-shopping-cart m-r-5 m-l-5"></i><span class="hide-menu">Stock Management</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">  
                            
                            <li class="sidebar-item"><a href="/backend_app/transaction" class="sidebar-link"><i class="ti-list m-r-5 m-l-5"></i><span class="hide-menu">Stock Out / Invoice</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/transaction_order" class="sidebar-link"><i class="ti-list m-r-5 m-l-5"></i><span class="hide-menu">Pre-Order</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Product Mangement</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/item" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Item</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/brand" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Brand</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/category" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Category</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense Mangement</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/expense" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/expense_type" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense Type</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Report Mangement</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/salesummaryreport" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Sale Summary</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Frontend</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">                        
                            
                            <li class="sidebar-item"><a href="/backend_app/about_us" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">About Us</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/article" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Article</span></a></li> 

                            <li class="sidebar-item"><a href="/backend_app/contact_us" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Contact Us</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/contact_us/address" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Contact Us Address</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/faq_information" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">FAQ</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/gallery" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Gallery</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/team" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Site Team Members</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/service" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Site Services</span></a></li>                        

                            <!-- <li class="sidebar-item"><a href="/backend_app/slider" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Slider Image</span></a></li> -->

                            <li class="sidebar-item"><a href="/backend_app/terms_and_conditions" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Terms and Conditions</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Settings</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/country" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu"> Country</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/city" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">City</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/township" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Township</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/role" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Role</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/permission" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Permission</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/user" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">User</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/config" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Site Configuration</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/activities" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Activity Log</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/reference" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">System Reference</span></a></li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Samples</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            
                            <li class="sidebar-item"><a href="/backend_app/sample/dynamic_form" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Dynamic Form</span></a></li>
                            
                        </ul>
                    </li>
                @elseif ($user_role_id == 2)

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-shopping-cart m-r-5 m-l-5"></i><span class="hide-menu">Stock Management</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">  
                            
                            <li class="sidebar-item"><a href="/backend_app/transaction" class="sidebar-link"><i class="ti-list m-r-5 m-l-5"></i><span class="hide-menu">Stock Out / Invoice</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/transaction_order" class="sidebar-link"><i class="ti-list m-r-5 m-l-5"></i><span class="hide-menu">Pre-Order</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Product Management</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/item" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Product</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/brand" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Brand</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/category" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Category</span></a></li>
                            
                        </ul>
                    </li>```

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense Mangement</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/expense" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/expense_type" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense Type</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Report Mangement</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/salesummaryreport" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Sale Summary</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/report/expense" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Expense Summary</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Frontend Website</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">                        
                            
                            <li class="sidebar-item"><a href="/backend_app/about_us" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">About Us</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/article" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Article</span></a></li>                        

                            <li class="sidebar-item"><a href="/backend_app/contact_us" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Contact Us</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/contact_us/address" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Contact Us Address</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/faq_information" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">FAQ</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/gallery" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Gallery</span></a></li> 

                            <li class="sidebar-item"><a href="/backend_app/terms_and_conditions" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Terms and Conditions</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Settings</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="/backend_app/country" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu"> Country</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/user" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">User</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/config" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Site Configuration</span></a></li>
                            
                            <li class="sidebar-item"><a href="/backend_app/activities" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Activity Log</span></a></li>
                            
                        </ul>
                    </li>

                @else
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Frontend</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">                        
                            
                            <li class="sidebar-item"><a href="/backend_app/about_us" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">About Us</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/article" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Article</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/contact_us" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Contact Us</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/contact_us/address" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Contact Us Address</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/faq_information" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">FAQ</span></a></li>

                            <li class="sidebar-item"><a href="/backend_app/gallery" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Gallery</span></a></li> 

                            <li class="sidebar-item"><a href="/backend_app/terms_and_conditions" class="sidebar-link"><i class="ti-settings m-r-5 m-l-5"></i><span class="hide-menu">Terms and Conditions</span></a></li>
                        </ul>
                    </li>

                @endif
                
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->



<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
<!-- ============================================================== -->

@if (session('status'))
    <div class="row">                
        <div class="col-md-12 text-center">
            <div class="alert">
                <div class="card">
                    <div class="card-body border-top">
                        <?php 
                        $raw_status = strtolower(session('status'));
                        $status = str_replace(' ','',$raw_status);
                        ?>

                        @if($status == "success")
                            <span class="text-weight-bold text-primary">                      
                                {{ session('status') }} - {{ session('body') }}
                            </span>
                        @else
                            <span class="text-weight-bold text-danger">                      
                                    {{ session('status') }} - {{ session('body') }}
                                </span>
                        @endif
                    </div>
                </div> 
            </div>                    
        </div>
    </div>
@endif