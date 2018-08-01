<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$gset->webTitle}} | {{$gset->subtitle}}</title>
        <!--Favicon add-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo/icon.png') }}">
        <!--bootstrap Css-->
        <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
        <!--font-awesome Css-->
        <link href="{{ asset('assets/front/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Lightcase  Css-->
        <link href="{{ asset('assets/front/css/lightcase.css') }}" rel="stylesheet">
        <!--Slick Slider Css-->
        <link href="{{ asset('assets/front/css/slick.css') }}" rel="stylesheet">
        <!--Slick Nav Css-->
        <link href="{{ asset('assets/front/css/slicknav.min.css') }}" rel="stylesheet">
        <!--Swiper  Css-->
        <link href="{{ asset('assets/front/css/swiper.min.css') }}" rel="stylesheet">
        <!--Style Css-->
        <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
        <!--Responsive Css-->
        <link href="{{ asset('assets/front/css/responsive.css') }}" rel="stylesheet">
         <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

  <link rel="stylesheet" href="{{ asset('assets/front/2/css/style.css')}}">
  <script src="{{ asset('assets/front/2/js/modernizr.js')}}"></script>

       <!-- Chart -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

   
        
    </head>

<body  data-spy="scroll">
            <!-- Start Pre-Loader-->
  
<div id="preloader">
    <div data-loader="circle-side"></div>

  </div>
  <!-- End Preload -->
  
  <!-- End Pre-Loader -->
    <!--support bar  top start-->
    <div class="support-bar-top" id="raindrops-green">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                  <div class="contact-info">
                    <a href="mailto:{{$contact->email}}"> <i class="fa fa-envelope email" aria-hidden="true"></i>{{$contact->email}}</a>
                  </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="contact-admin">
                    @auth
                      <a href="{{route('home')}}"><i class="fa fa-user"></i> HOME </a>
                    @else
                      <a href="{{route('login')}}"><i class="fa fa-user"></i> LOGIN </a>
                      <a href="{{route('register')}}"><i class="fa fa-user-plus"></i> REGISTER</a>
                    @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--support bar  top end-->
 <!--main menu section start-->   
<nav class="main-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-md-9 text-right">
                <ul id="header-menu" class="header-navigation">
                    <li><a class="page-scroll" href="{{url('/')}}/#body"> Home</a></li>
                    <li><a class="page-scroll" href="{{url('/')}}/#about"> about</a></li>
                    <li><a class="page-scroll" href="{{url('/')}}/#graph"> Price Graph</a></li>
                    <li><a class="page-scroll" href="{{url('/')}}/#timeline"> Timeline</a></li>

                    
                    
                    <li><a class="page-scroll" href="#"> Account <span class="fa fa-angle-down"></span></a>
                        <ul class="mega-menu mega-menu1 mega-menu2">
                          <li class="mega-list mega-list1 ">
                            <a class="page-scroll" href="{{ url('login') }}"> Login </a>
                            <a class="page-scroll" href="{{ url('register') }}"> Register </a>
                          </li>
                        </ul>  
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>
  <!--main menu section end-->
@include('front.layouts.message')
@yield('content')

<!-- Online Section End -->

<div class="clearfix"></div>
 

<div class="clearfix"></div>
@include('front.layouts.footer')

<style type="text/css">
  li.export-main {
    visibility: hidden;
}
</style>
    <!--jquery script load-->
{{--     <script src="{{ asset('assets/front/js/jquery.js') }}"></script> --}}
    <!--Bootstrap v3 script load here-->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <!-- Highlight script load-->
    <script src="{{ asset('assets/front/js/highlight.min.js') }}"></script>
    <!--Jquery Ui Slider script load-->
    <script src="{{ asset('assets/front/js/jquery-ui-slider.min.js') }}"></script>
    <!--Circleful Js File Load-->
    <script src="{{ asset('assets/front/js/jquery.circliful.js') }}"></script>
    <!--CounterUp script load-->
    <script src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
    <!-- Ripples  script load-->
    <script src="{{ asset('assets/front/js/jquery.ripples-min.js') }}"></script>
    <!--Slick Nav Js File Load-->
    <script src="{{ asset('assets/front/js/jquery.slicknav.min.js') }}"></script> 
    <!--Lightcase Js File Load-->
    <script src="{{ asset('assets/front/js/lightcase.js') }}"></script>
    <!--particle Js File Load-->
    <script src="{{ asset('assets/front/js/particles.min.js') }}"></script>
    <!--particle custom Js File Load-->
    <script src="{{ asset('assets/front/js/particles-custom.js') }}"></script>
    <!--RainDrops script load-->
    <script src="{{ asset('assets/front/js/raindrops.js') }}"></script>
    <!--Easing script load-->
    <script src="{{ asset('assets/front/js/easing-min.js') }}"></script>
    <!--Slick Slider Js File Load-->
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
     <!--Swiper script load-->
    <script src="{{ asset('assets/front/js/swiper.min.js') }}"></script>
    <!--WayPoints script load-->
    <script src="{{ asset('assets/front/js/waypoints.min.js') }}"></script>
    <!--Main js file load-->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    <script src="{{ asset('assets/front/2/js/main.js') }}"></script>
    </body>
</html>



















