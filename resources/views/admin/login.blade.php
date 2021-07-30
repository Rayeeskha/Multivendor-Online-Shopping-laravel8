<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>ECommerce Laraval8</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin_assets/img/favicon.png')}}">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets(css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/fonts/flaticon.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/animate.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('admin_assets/js/modernizr-3.6.0.min.js')}}"></script>
     <style type="text/css">
        #btn_style{text-decoration: underline; }
        #btn_style:hover{color: red}
    </style>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Login Page Start Here -->
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <a href="#">
                       <!--  <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="CoolAdmin"> -->
                        {{Config::get('constants.SITE_NAME')}}
                    </a>
                </div>
                 @php 
                    if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])){
                        $login_email = $_COOKIE['login_email'];
                        $login_pwd = $_COOKIE['login_pwd'];
                        $is_remember = "checked='checked'";
                    }else{
                        $login_email = "";
                        $login_pwd   = "";
                        $is_remember = "";
                    }
                 @endphp
                 <span style="color: red;font-weight: 800;font-size: 20px">{{session('error')}}</span>

                 <form action="{{route('admin.auth')}}" method="post" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label>Email </label>
                        <input class="form-control" type="text" name="email" placeholder="Enter Email" value="{{$login_email}}" style="width: 80%;height: 30px">
                        <i class="far fa-envelope"></i>
                       
                    </div>
                    @error('email')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password" value="{{$login_pwd}}" style="width: 80%;height: 30px">
                         <i class="fas fa-lock"></i>
                            
                    </div>
                    @error('password')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="rememberme" id="remember-me" {{$is_remember}}>
                            <label for="remember-me" class="form-check-label" >Remember Me</label>
                        </div>
                        <a href="#" class="forgot-btn">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-btn">Login</button>
                    </div>
                    <div class="form-group">
                        <a href="{{url('/selleraccount')}}" id="btn_style">Create your Account</a>
                        <!-- <button type="submit" class="login-btn">Register Account</button> -->
                    </div>
                </form>
                
            </div>
         </div>
    </div>
    <!-- Login Page End Here -->


    <!-- jquery-->
    <script src="{{asset('admin_assets/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('admin_assets/js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('admin_assets/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('admin_assets/js/bootstrap.min.js')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{asset('admin_assets/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('admin_assets/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->