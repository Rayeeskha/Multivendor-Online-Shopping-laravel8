<!doctype html>
<html class="no-js" lang="">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin_assets/img/favicon.png')}}">
 
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/fonts/flaticon.css')}}">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/fullcalendar.min.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/animate.min.css')}}">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/jquery.dataTables.min.css')}}">
   <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/select2.min.css')}}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('admin_assets/js/modernizr-3.6.0.min.js')}}"></script>
</head>
<?php $orders =  get_all_orders();?>
  <!-- Preloader Start Here -->
<div id="preloader"></div>
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
   <!-- Header Menu Area Start Here -->
    <div class="navbar navbar-expand-md header-menu-one bg-light">
        <div class="nav-bar-header-one">
            <div class="header-logo">
                <a href="{{url('admin/dashboard')}}">
                    <img src="{{asset('admin_assets/images/logo.jpg')}}" alt="logo" style="width: 60px;border-radius: 50%" >
                </a>
            </div>
             <div class="toggle-button sidebar-toggle">
                <button type="button" class="item-link">
                    <span class="btn-icon-wrap">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="d-md-none mobile-nav-bar">
           <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                <i class="far fa-arrow-alt-circle-down"></i>
            </button>
            <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
            <ul class="navbar-nav"> </ul>
            <ul class="navbar-nav">
                <li class="navbar-item dropdown header-admin">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="admin-title">
                            <h5 class="item-title"><?php $users =  get_user_details(session()->get('ADMIN_ID')); 
                                if ($users) {
                                    echo $users[0]->fname;
                                }else{
                                    echo "Khan Rayees";
                                }
                            ?></h5>
                            <span><?= session()->get('ADMIN_ROLE'); ?></span>
                        </div>
                        <div class="admin-img">
                            <img src="{{asset('admin_assets/img/figure/admin.jpg')}}" alt="Admin">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">Khan Rayees</h6>
                        </div>
                        <div class="item-content">
                            <ul class="settings-list">
                                <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                               
                                <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                <li><a href="logout"><i class="flaticon-turn-off"></i>Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                

                 @if(session()->get('ADMIN_ROLE') == 'admin')
                <li class="navbar-item dropdown header-message">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="far fa-envelope"></i>
                        <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                        <span>
                            <?php $seller =  get_seller_verification(); 
                                if($seller){
                                    echo count($seller);
                                }else{
                                    echo "0";
                                }
                            ?>
                           

                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">Seller  Verification</h6>
                        </div>
                        <div class="item-content">
                            <table class="table table-responsive">
                                <thead>
                                    <th>Seller Id</th>
                                    <th>Seller Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                            </table>
                            <tbody>
                                

                                @if($seller)
                                @foreach($seller as $sellers)
                                <tr>
                                    <td>{{$sellers->seller_id}}</td>
                                    <td>{{$sellers->fname}}</td>
                                    <td><span class="badge badge-danger">{{$sellers->status}}</span></td>
                                    <td><a href="{{url('admin/verifyselleraccount')}}">View</a></td>
                                </tr>
                                @endforeach

                                @else
                                <h6 style="color: red">Records Not Found</h6>
                                @endif
                            </tbody>   
                        </div>
                    </div>
                </li>
                @endif

                
                <li class="navbar-item dropdown header-notification">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <div class="item-title d-md-none text-16 mg-l-10">Orders</div>
                        <span>
                            <?php 
                                if ($orders) {
                                    echo count($orders);
                                }else{
                                    echo "0";
                                }
                            ?>
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">New Orders</h6>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Order Id</th>
                                <th>Order Type</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                            @if($orders)
                            @foreach($orders as $ord)
                            <tr>
                                <td>{{$ord->order_id}}</td>
                                <td>{{$ord->payment_type}}</td>
                                <td>{{number_format($ord->total_amount)}}</td>
                                <td><a href="{{url('admin/Orders')}}">View</a></td>
                            </tr>
                            @endforeach
                            @else
                            <h6 style="color: red">Not any Orders</h6>
                            @endif
                        </table>
                        
                    </div>
                </li>
                 <li class="navbar-item dropdown header-language">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" 
                    data-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe-americas"></i>EN</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Arbic</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- Header Menu Area End Here -->

<!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
           <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="{{url('admin/dashboard')}}"><img src="{{asset('admin_assets/images/logo.jpg')}}" alt="logo" style="width: 50px;border-radius: 50%"></a>
                </div>
           </div>
            <div class="sidebar-menu-content">
                <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                    <li class="@yield('category_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-list"></i><span>Category Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/category')}}" class="nav-link"><i class="fas fa-angle-right"></i>Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@yield('coupon_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-tag"></i><span>Coupons Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/coupon')}}" class="nav-link"><i class="fas fa-angle-right"></i>Manage Coupons</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="@yield('size_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                                class="fa fa-tree"></i><span>Size Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/size')}}" class="nav-link"><i class="fas fa-angle-right"></i>Size Master</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="@yield('color_select')  nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-palette"></i><span>Color Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/colors')}}" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Color Master</a>
                            </li>
                           
                        </ul>
                    </li>
                     <li class="@yield('brand_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-books"></i><span>Brand Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/brand')}}" class="nav-link"><i class="fas fa-angle-right"></i>Brand master</a>
                            </li>
                            
                        </ul>
                    </li>
                    @if(session()->get('ADMIN_ROLE') == 'admin')
                      <li class="@yield('tax_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-books"></i><span>Tax Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/tax')}}" class="nav-link"><i class="fas fa-angle-right"></i>Tax Master</a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif
                    <li class="@yield('product_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fab fa-product-hunt"></i><span>Product Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/products')}}" class="nav-link"><i class="fas fa-angle-right"></i>Product master</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="@yield('orders_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fab fa-jedi-order"></i><span>Orders</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/Orders')}}" class="nav-link"><i class="fab fa-jedi-order"></i>Orders</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    @if(session()->get('ADMIN_ROLE') == 'admin')
                     <li class="@yield('customer_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-users"></i><span>Customers Master</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/customers')}}" class="nav-link"><i class="fas fa-users"></i>Customers master</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="@yield('banner_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-images"></i><span>Home Banner</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/home_banner')}}" class="nav-link"><i class="fas fa-users"></i>Banner</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="@yield('seller_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-users"></i><span>Sellers</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/verifyselleraccount')}}" class="nav-link"><i class="fa fa fa-users"></i>Verify Seller Account</a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif
                    <li class="@yield('review_select') nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-star"></i><span>Product Review</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{url('admin/product_review')}}" class="nav-link"><i class="fas fa-star"></i>Product Review</a>
                            </li>
                            
                        </ul>
                    </li>

                   
                   
                </ul>
            </div>
        </div>


    <!-------Dashboard Wrapper Section Start ---->
    <!-- Sidebar Area End Here -->
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
           
        <!-- Breadcubs Area End Here -->
        <!-- Dashboard summery Start Here -->
         @section('container')
                

        @show

    </div>

<!-------Dashboard Wrapper Section End ---->

    </div>
</div>

<!-- jquery-->
<script src="{{asset('admin_assets/js/jquery-3.3.1.min.js')}}"></script>
<!-- Plugins js -->
<script src="{{asset('admin_assets/js/plugins.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('admin_assets/js/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{asset('admin_assets/js/bootstrap.min.js')}}"></script>
<!-- Counterup Js -->
<script src="{{asset('admin_assets/js/jquery.counterup.min.js')}}"></script>
<!-- Moment Js -->
<script src="{{asset('admin_assets/js/moment.min.js')}}"></script>
 <!-- Data Table Js -->
<script src="{{asset('admin_assets/js/jquery.dataTables.min.js')}}"></script>
  <!-- Select 2 Js -->
<script src="{{asset('admin_assets/js/select2.min.js')}}"></script>
<!-- Waypoints Js -->
<script src="{{asset('admin_assets/js/jquery.waypoints.min.js')}}"></script>
<!-- Scroll Up Js -->
<script src="{{asset('admin_assets/js/jquery.scrollUp.min.js')}}"></script>
<!-- Full Calender Js -->
<script src="{{asset('admin_assets/js/fullcalendar.min.js')}}"></script>
<!-- Chart Js -->
<script src="{{asset('admin_assets/js/Chart.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('admin_assets/js/main.js')}}"></script>


<!--Chart js file --->
<!-- <script type="text/javascript" src="{{asset('admin_assets/chart/chart.js')}}"></script>
 -->
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<?php $chart_data =  dashboardchart(); 
    $chart_data_second = getsellerandbuyerchart();

?>
</body>


<script type="text/javascript">

    var chartdata1 = new CanvasJS.Chart("chartContainer",{
    animationEnabled: true,
    exportEnabled: true,
    theme: "light2", 
    title :{
        text: "Last 7days Orders",
    },
    data: [{
    // type: "column", //change type to bar, line, area, pie, etc
        type: "area",
        //indexLabel: "{y}", //Shows y value on all Data Points
        indexLabelFontColor: "#5A5757",
        indexLabelFontSize: 16,
        indexLabelPlacement: "outside",
        dataPoints: [
            { label : 'Today',     y: <?= $chart_data['ch_today_order']; ?> },
            { label : 'Yesterday', y: <?= $chart_data['ch_yesterday_order']; ?> },
            { label : '3rd Days',  y: <?= $chart_data['ch_last_3_days_order']; ?> },
            { label : '4rd Days',  y: <?= $chart_data['ch_last_4_days_order']; ?> },
            { label : '5rd Days',  y: <?= $chart_data['ch_last_5_days_order']; ?> },
            { label : '6rd Days',  y: <?= $chart_data['ch_last_6_days_order']; ?> },
            { label : '7rd Days',  y: <?= $chart_data['ch_last_7_days_order']; ?> },
            
        ]   
    }]
});
chartdata1.render();

 window.onload = function () {
    var options = {
    animationEnabled: true,
    title: {
         text: "Sellers & Buyers Account"
    },
    data: [{
        type: "doughnut",
        innerRadius: "30%",
        showInLegend: true,
        legendText: "{label}",
        indexLabel: "{label}:",
        dataPoints: [
            { label : 'Buyers Account', y: <?= $chart_data_second['ch_buyers']; ?> },
            { label : 'Sellers Account', y: <?= $chart_data_second['ch_sellers']; ?> },
        ]
    }]
};
$("#sellerandbuyeraccount").CanvasJSChart(options);

}     
</script>
</html>
<!-- end document-->