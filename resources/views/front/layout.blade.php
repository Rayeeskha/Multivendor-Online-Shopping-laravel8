<!DOCTYPE html>
<?php 
  $lang = session()->get('locale');
?>
<?php 
  if (session()->get('locale') == "" || session()->get('locale') == "en") {
    $position = "ltr";
    $language = "en";
  }else{
    $language= 'ar';
    $position = "rtl";
  }
?>
<html dir="<?= $position; ?>" lang="{{$language}}">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />   
    <title>@yield('page_title')</title>
    <link href="{{asset('front_assets/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/bootstrap.css')}}" rel="stylesheet">   
    <link href="{{asset('front_assets/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/jquery.simpleLens.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/nouislider.css')}}">
    <link id="switcher" href="{{asset('front_assets/css/theme-color/default-theme.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('front_assets/css/style.css')}}" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
 <style type="text/css">
   #successmodel, #errormodel{margin-top: 3%;}
 </style>
  </head>
  <body class="productPage"> 
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <div class="aa-language">
                  <select class="form-control changeLang">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arbic</option>
                </select>
                  
                </div>
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>
                    <a href="tel:9554540271">+00-62-658-658</a></p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                 
                  
                  <li class="hidden-xs"><a href="{{url('/carts')}}">
                    @lang('auth.mycart')
                  </a></li>
                  <li class="hidden-xs"><a href="javascript:void(0)">@lang('auth.Checkout')</a></li>
                  @if(session()->has('FRONT_USER_LOGIN') != null)
                   <li><a href="{{url('/order')}}">My Order</a></li>
                  <li><a href="{{url('/logout')}}">Logout</a></li>
                  @else
                  <li><a href="" data-toggle="modal" data-target="#login-modal">@lang('auth.login')</a></li>
                  @endif
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom" style="background: #ffffff">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{url('/')}}"> 
                  <span class="fa fa-shopping-cart" style="color: #2874f0"></span>
                  <p>@lang('auth.khan')<strong style="color: #2874f0">@lang('auth.shop')</strong> <span>@lang('auth.partner')</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="javascript:void(0)"><img src="img/logo.jpg" alt="logo img"></a> -->

                
              </div>
              <!-- / logo  -->
               <!-- cart box -->
               @php 
                  $getAddtoCartTotalItem =  getAddtoCartTotalItem();
                 $totalcartItem =  count($getAddtoCartTotalItem);
                 $totalCartPrice = 0;
               @endphp
              <div class="aa-cartbox" >
                <a class="aa-cart-link" href="javascript:void(0)" id="cartBox">
                  <span class="fa fa-shopping-basket"style="color: black"></span>
                  <span class="aa-cart-title">@lang('auth.ShoppingCart')</span>
                  <span class="aa-cart-notify" style="color: black">
                    {{$totalcartItem}}
                    
                  </span>
                </a>
                <div class="aa-cartbox-summary">
                @if($totalcartItem > 0)
                 <ul>
                    @foreach($getAddtoCartTotalItem as $data)
                    @php 
                      $totalCartPrice += $data->qty * $data->price;
                      @endphp
                    <li>
                      <a class="aa-cartbox-img" href="javascript:void(0)"><img src="{{asset('storage/products/'.$data->image)}}" alt="{{$data->name}}" style="width: 100px;height: 50px"></a>
                      <div class="aa-cartbox-info">
                        <h4><a class="aa-cart-title" href="{{url('product/'.$data->slug)}}" target="_blank">{{$data->name}}</a></h4>
                        <p>{{$data->qty}} * <span class="fa fa-inr">&nbsp;{{number_format($data->price)}}</span></p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>
                    
                    @endforeach
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price ">
                        <span class="fa fa-inr"></span>&nbsp;{{number_format($totalCartPrice)}}
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="{{url('/carts')}}">Cart</a>
                
                @endif
                </div>
              </div>

              <!-- / cart box -->
              <!-- search box -->
             <!-- search box -->
              <div class="aa-search-box">
                <form action="">
                  <input type="text" id="search_str" placeholder="@lang('auth.Searchhere')">
                  <button type="button" onclick="funSearch()" style="background: #2874f0"><span class="fa fa-search" ></span></button>
                </form>
              </div>
              <!-- / search box --> 
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu" style="background: #2874f0">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation" >
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          
         <div class="navbar-collapse collapse">
          <!-- Left nav -->
            {!! getTopNavCat() !!}
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->
  <!-- Start slider -->
  
  @section('container')
  @show      
  
  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3> @lang('auth.Mainmenu')</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">@lang('auth.Home')</a></li>
                    <li><a href="#">@lang('auth.OurServices')</a></li>
                    <li><a href="#">@lang('auth.OurProducts')</a></li>
                    <li><a href="#">@lang('auth.AboutUs')</a></li>
                    <li><a href="#">@lang('auth.ContactUs')</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>@lang('auth.KnowledgeBase')</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">@lang('auth.Delivery')</a></li>
                      <li><a href="#">@lang('auth.Returns')</a></li>
                      
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>@lang('auth.UsefulLinks')</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="{{url('admin')}}">@lang('auth.SellerAccount')</a></li>
                      <li><a href="javascript:void(0)">@lang('auth.AdvancedSearch')</a></li>
                      <li><a href="javascript:void(0)">@lang('auth.Suppliers')</a></li>
                      <li><a href="javascript:void(0)">@lang('auth.FAQ')</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>@lang('auth.ContactUs')</h3>
                    <address>
                      <p> @lang('auth.Lucknow')  @lang('auth.add_title')</p>
                      <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                      <p><span class="fa fa-envelope"></span>rayeesinfotech@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="javascript:void(0)"><span class="fa fa-facebook"></span></a>
                      <a href="javascript:void(0)"><span class="fa fa-twitter"></span></a>
                      <a href="javascript:void(0)"><span class="fa fa-google-plus"></span></a>
                      <a href="javascript:void(0)"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Designed & developed by  <a href="javascript:void(0)">Khan Rayees</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->

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

  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div id="popup_login">
            <h4>Login or Register</h4>
            <form class="aa-login-form" id="frmLogin">
              <label for="">Email address<span>*</span></label>
              <input type="email" placeholder="Email address" name="str_login_email" value="{{$login_email}}" required>
              <label for="">Password<span>*</span></label>
              <input type="password" placeholder="Password" name="str_login_password" value="{{$login_pwd}}" required>
              <button class="aa-browse-btn" type="submit" id="btnLogin">Login</button>
              <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme" name="rememberme" {{$is_remember}}> Remember me </label>
              <p class="aa-lost-password"><a href="javascript:void(0)" onclick="forgot_password()">Lost your password?</a></p>
              <div class="aa-register-now">
                Don't have an account?<a href="{{url('registration')}}">Register now!</a>
              </div>
              @csrf
            </form>
          </div>
          <!------Forgot Password Div ----->
          <div id="popup_forgot" style="display: none;">
             <h4>Forgot Password</h4>
              <form class="aa-login-form" id="frmForgot">
                <label for="">Email address<span>*</span></label>
                <input type="email" placeholder="Email address" name="str_forgot_email"  required>
                <button class="aa-browse-btn" type="submit" id="btnForgot">Forgot</button>
                <br/><br/><br/>
                <div class="aa-register-now">
                  Login Form ?<a href="javascript:void(0)" onclick="show_login_popup()">Login Now!</a><br><br>
                </div>
                @csrf
              </form>
          </div>
          <!------Forgot Password Div ----->
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>    


<!------success model Script Start --------->
<div class="container" >
    <div class="modal" id="successmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 300px;margin-left: 20%">
      <div class="modal-body" style="padding: 0px; ">
        <center>
          <h4 style="padding: 5px;font-size: 22px;font-weight: 500;color: green">
            <span class="fa fa-check"></span>&nbsp;Successfully</h4>
        </center>
        <center>
            <img src="{{asset('front_assets/img/succ.gif')}}" alt="fashion banner img" style="height: 150px;">

            <h4 id="success_model_heading" style="margin-top: 0px;font-weight: 500"></h4>  
        </center>
         </div>
      
     <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
</div>
<!------success model Script End --------->

<!-------Error Modal Script ------>
<div class="container">
    <div class="modal" id="errormodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 300px;margin-left: 20%">
      <div class="modal-body" style="padding: 0px;">
        <center>
          <h4 style="padding: 5px;font-size: 22px;font-weight: 500;color: red">Error</h4>
        </center>
        <center>
            <img src="{{asset('front_assets/img/error.gif')}}" alt="fashion banner img" style="height: 150px;">

            <h4 id="errormodel_heading" style="margin-top: 0px;font-weight: 500"></h4>  
        </center>
         </div>
      
     <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-------Error Modal End ------>







  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="{{asset('front_assets/js/bootstrap.js')}}"></script>  
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.bootstrap.js')}}"></script>  
  <script src="{{asset('front_assets/js/sequence.js')}}"></script>
  <script src="{{asset('front_assets/js/sequence-theme.modern-slide-in.js')}}"></script>  
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.simpleGallery.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.simpleLens.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/nouislider.js')}}"></script>
  <script src="{{asset('front_assets/js/custom.js')}}"></script> 
<script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    let PRODUCT_IMAGE = "{{asset('storage/products/')}}";
  </script>

  <script type="text/javascript">
  
    var url = "{{ url('lang/change') }}";
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
  
  $(document).ready( function () {
    $('#datatabels').DataTable();
} );
</script>
  </body>
</html>