<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$gnl->title}} | {{$gnl->subtitle}} </title>
        <!--Favicon add-->
        <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logo/icon.png') }}">
        <!--bootstrap Css-->
        <link href="{{asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
        <!--font-awesome Css-->
        <link href="{{asset('assets/front/css/font-awesome.min.css') }}" rel="stylesheet">
        <!--owl.carousel Css-->
        <link href="{{asset('assets/front/css/owl.carousel.min.css') }}" rel="stylesheet">
        <!--Slick Nav Css-->
        <link href="{{asset('assets/front/css/slicknav.min.css') }}" rel="stylesheet">
        <!--Animate Css-->
        <link href="{{asset('assets/front/css/animate.css') }}" rel="stylesheet">
        <!--Magnitic popup Css-->
        <link href="{{asset('assets/front/css/magnific-popup.css') }}" rel="stylesheet">
        <!--Style Css-->
        <link href="{{asset('assets/front/css/style.css') }}" rel="stylesheet">
        <link href="{{asset('assets/front/css/color.css') }}" rel="stylesheet">
        <link href="{{asset('assets/front/css/color.php?color=') }}{{$gnl->color}}" rel="stylesheet">
        <!--Responsive Css-->
        <script src="{{ asset('assets/admin/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <link href="{{asset('assets/front/css/responsive.css') }}" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    </head>
    <body>
	
    <!--navbar area start-->
    <nav class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 ">
                    <a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/logo/logo.png') }}" alt="logo image"></a>
                </div>   
                <div class="col-lg-9 text-right ">     
                    <ul id="main-menu" >
                        <li><a href="#map">Road map</a></li>
                        <li><a href="#ico">Ico Calendar</a></li>
                        <li><a href="{{url('assets/files/white-paper.pdf')}}" target="_blank">White Paper</a></li>
                        @auth
                        <li><a href="{{route('home')}}">{{Auth::user()->name}}</a></li>
                         <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            <span>SIGN OUT</span>
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                          </form>
                        </li>
                        @else
                        <li><a href="{{route('login')}}">Sign In</a></li>
                        <li><a href="{{route('register')}}">Sign Up</a></li>
                        @endauth
                    </ul>
                </div>   
            </div>
        </div>
    </nav>
    <!--navbar area end-->

<!--header area start-->
<header class="header-area header-bg" id="home" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg1}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-text">
                    <div class="header-right-content" style="border:none;">
                        <img src="{{asset('assets/images/logo/bc.jpg')}}" style="width:100%; margin-bottom:20px;" />
                            <p class="whitecolor" style="margin-bottom:0;">{!!$front->ban_details!!}</p>
                    </div>
                </div>
            </div>
            <!--countdown start-->
            <div class="col-lg-6 text-center">
                <div class="header-right-content full-border">
                    <div class="header-text">
                        <h1 style="margin-bottom:0;">{{$front->ban_title}}</h1>
                        <h5 style="color: #fff;" class="text-uppercase">{{$front->ban_subtitle}}</h5>
                        <div id="clockdiv">
                            <div>
                                <span class="days" data-days="{{$day}}"></span>
                                <div class="smalltext">Days</div>
                            </div>
                            <div>
                                <span class="hours" data-hours="24"></span>
                                <div class="smalltext">Hours</div>
                            </div>
                            <div>
                                <span class="minutes" data-minutes="60"></span>
                                <div class="smalltext">Minutes</div>
                            </div>
                            <div>
                                <span class="seconds" data-seconds="60"></span>
                                <div class="smalltext">Seconds</div>
                            </div>
                        </div>

                       <div class="row">
                           <div class="col-lg-12">
                              <h6 class="whitecolor" style="padding-top: 30px;">Current Price <strong>{{$front->ban_price}}</strong> USD</h6>
                               <div class="progress">
                                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$front->ban_sold}}"
                                      aria-valuemin="0" aria-valuemax="100" 
                                      style="width:{{$front->ban_sold}}%">
                                </div>
                            </div>
                                <!--{{$front->ban_sold}}% Sold-->
                           </div>
                           <div class="col-md-12">
                                <a href="{{url('login')}}" class="boxed-btn white animated-btn" style="padding: 10px 30px;margin-top: 30px;">Get Now</a>
                           </div>
                       </div>
                    </div>
                    
                </div>
            </div>
            <!--countdown end-->
        </div>
    </div>
</header>
<!--header area end-->
  <!--about us area start-->
  <section class="about-us" id="about">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 col-md-12">
                  <div class="about-img">
                      <img src="{{asset('assets/images/section')}}/{{$front->secbg2}}" alt="about us image">
                      <div class="hover justify-content-center">
                          <span class="play-btn"><a href="{{$front->video}}" class="mfp-iframe video-play-btn"><i class="fa fa-play" aria-hidden="true"></i></a></span>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6 col-md-12">
                  <div class="content">
                      <h2>{{$front->about_title}} <span>{{$gnl->title}}</span></h2>
                      <p>{!!$front->about_content!!}</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!--about us area end-->
<!--what we do area start-->
<section class="what-we-do" id="service">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>{{$front->serv_title}}</h2>
                     <p>{!!$front->serv_details!!}</p>
                </div>
            </div>
        </div>
        <div class="row">
        @foreach($services as $serv)
            <div class="col-lg-4 col-md-6">
                <div class="single-what-we-do">
                    <div class="icon">
                        <i class="fa fa-{{$serv->icon}}"></i>
                    </div>
                    <div class="content">
                        <h4>{{$serv->title}}</h4>
                        <p>{{$serv->details}}</p>
                    </div>
                </div>
            </div>       
        @endforeach
        </div>
    </div>
</section>
<!--what we do area end-->
<!--road map start-->
<section class="road-map" id="map">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>{{$front->road_title}}</h2>
                    <p>{!!$front->road_details!!}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="road-map-wrapper">
                    <div class="timeline">
                        <div class="timeline-items">
                        @foreach($roads as $road)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="item">
                                        <div class="item-content">
                                            <div class="item-icon">
                                            </div>
                                            <div class="content">
                                                <p class="paragraph">
                                                    {{$road->details}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="author">
                                            <h4>
                                                {{$road->title}}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </div>
                    </div>
                    <!--end time line-->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="road-2-map road-map-bg" id="ico" style="background-image: url({{asset('assets/images/logo/bc.jpg') }});">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>ICO Calendar</h2>
                    <p>
                    {!!$front->footer2!!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <table class="table table-hover table-dark">
                  <thead>
                    <tr>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Price</th>
                      <th scope="col">Sold</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($icos as $ico)
                    <tr>
                      <td data-label="Start Date">{{$ico->start}}</td>
                      <td data-label="End Date">{{$ico->end}}</td>
                      <td data-label="Quantity">{{$ico->quant}} {{$gnl->cur}}</td>
                      <td data-label="Price">{{$ico->price}} USD</td>
                      <td data-label="Sold"> 
                            <div class="progress">
                                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{round(($ico->sold/$ico->quant)*100,2)}}"
                                      aria-valuemin="0" aria-valuemax="100" 
                                      style="width:{{round(($ico->sold/$ico->quant)*100,2)}}%">
                                </div>
                            </div><span style="color:#66ff33;">{{round(($ico->sold/$ico->quant)*100,2)}}%</span>
                     </td>
                     <td data-label="Status">
                        @if($ico->status == 1)
                            <span style="color:#ffcc66">Runing</span>
                        @elseif($ico->status == 0)
                            <span style="color:#00ccff">Upcoming</span>
                        @else
                            <span style="color:red">Completed</span>
                        @endif
                     </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--road map end-->
<!--our team section start-->
<section class="our-team-area" id="team">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>{{$front->team_title}}</h2>
                    <p>{!!$front->team_details!!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
        @foreach($teams as $team)
            <div class="col-lg-4 col-md-6">
                <div class="single-team-member">
                        <div class="team_img">
                            <img src="{{asset('assets/images/team') }}/{{$team->photo}}" alt="team memeber">
                        </div>
                        <div class="team-content">
                            <h4>{{$team->title}}</h4>
                            <span>{{$team->details}}</span>
                        </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
<!--our team section end-->
<!--testimonial area start-->
<section class="testimonial-area">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>{{$front->testm_title}}
                    </h2>
                    <p>{!!$front->testm_details!!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-carousel">
                @foreach($testims as $tm)    
                    <div class="single-testimonial-carousel">
                        <div class="content">
                            <p>{{$tm->comment}}</p>
                        </div>
                        <div class="author-details">
                            <div class="thumbnai">
                                <img src="{{asset('assets/images/testimonial') }}/{{$tm->photo}}" alt="testimonial image" style="max-width: 80px;">
                            </div>
                            <div class="autor-name">
                                <h4>{{$tm->name}}</h4>
                                <span>{{$tm->company}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--testimonial area end-->

<!--contact section start-->
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg3}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h2 class="text-uppercase text-center">Contact <span>Us</span></h2>
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="firstname" id="firstname" placeholder="First Name*">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="lastname" id="lastname" placeholder="Last Name*">
                            </div>
                            <div class="col-lg-12">
                                <input type="email" name="email" id="email" placeholder="Your Email*">
                                <textarea name="message" id="message" cols="30" rows="5" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <input type="submit" id="conEmail" value="Send Now">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  $(document).ready(function(){
    $(document).on('click','#conEmail',function(e){
        e.preventDefault();
      var fname = $('#firstname').val();
      var lname = $('#lastname').val();
      var email = $('#email').val();
      var message = $('#message').val();
      $.ajax({
       type:'GET',
       url:'{{ route('contactEmail') }}',
       data:{email:email,fname:fname, lname:lname, message:message},
       success:function(data){
        swal('success','Successfully Sent Email','success');
        console.log(data);
      },
      error:function (error) {
        var message = JSON.parse(error.responseText);
        swal('error',message.errors.email,'error');
        console.log(message.errors.email);

      }
    });
    });
  }); 
</script>
<!--contact section end-->
<!--faq section start -->
<section class="faq-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>{{$front->faq_title}}
                    </h2>
                    <p>{!!$front->faq_details!!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="accordion-wrapper">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="row">
                    @foreach($faqs as $faq)
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{$faq->id}}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapseOne">
                                    {{$faq->title}}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{$faq->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$faq->id}}">
                                <div class="panel-body">
                                    <p> {{$faq->details}}</p>
                                </div>
                            </div>
                        </div>
                    </div>       
                @endforeach     

                </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--faq section end-->
<!--subscription section start-->
<section class="subscription-section subscription-bg" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg4}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h2>{{$front->subs_title}}</h2>
                    <p>{!!$front->subs_details!!}
                    </p>
                </div>
                <div class="subscription-form">
                    <form class="form-inline">
                        <input type="text" id="subemail" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Your Email">
                        <button type="submit" id="subsc" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  $(document).ready(function(){
    $(document).on('click','#subsc',function(e){
        e.preventDefault();
      var email = $('#subemail').val();
      $.ajax({
       type:'GET',
       url:'{{ route('subscribe') }}',
       data:{email:email},
       success:function(data){
        swal('success','Successfully Subscribed','success');
        console.log(data);
      },
      error:function (error) {
        var message = JSON.parse(error.responseText);
        swal('error',message.errors.email,'error');
        console.log(message.errors.email);

      }
    });
    });
  }); 
</script>
<!--subscription section end-->
<!--footer section start-->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <p class="copyright-text">{!!$front->footer1!!}</p>
            </div>
        </div>
    </div>
</footer>
<!--footer section end-->

<!--preloader start-->
<div class="preloader">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img src="{{asset('assets/images/logo/icon.png') }}" alt="*">
        </div>
    </div>
</div>
<!--preloader end-->

    <!--back to top start-->
    <div class="back-to-top">
        <i class="fa fa-angle-up"></i>
    </div>
    <!--back to top end-->
	    <!--jquery script load-->
        <script src="{{asset('assets/front/js/jquery.js') }}"></script>
        <!--Owl carousel script load-->
		<script src="{{asset('assets/front/js/owl.carousel.min.js') }}"></script>
        <!--Propper script load here-->
        <script src="{{asset('assets/front/js/popper.min.js') }}"></script>
        <!--Bootstrap v4 script load here-->
        <script src="{{asset('assets/front/js/bootstrap.min.js') }}"></script>
        <!--Slick Nav Js File Load-->
        <script src="{{asset('assets/front/js/jquery.slicknav.min.js') }}"></script>
        <!--Scroll Spy File Load-->
        <script src="{{asset('assets/front/js/scrollspy.min.js') }}"></script>
        <!--Wow Js File Load-->
        <script src="{{asset('assets/front/js/wow.min.js') }}"></script>
        <!--Magnific popup Js File Load-->
        <script src="{{asset('assets/front/js/jquery.magnific-popup.js') }}"></script>
        <!--Main js file load-->
        <script src="{{asset('assets/front/js/main.js') }}"></script>

        <script type="text/javascript">
             /*countdown start*/
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
        var dayData = $('#clockdiv').children().children('.days').data('days');
        var hourData = $('#clockdiv').children().children('.hours').data('hours');
        var minutesData = $('#clockdiv').children().children('.minutes').data('minutes');
        var secondsData = $('#clockdiv').children().children('.seconds').data('seconds');

        var deadline = new Date(Date.parse(new Date()) + dayData * hourData * minutesData * secondsData * 1000);
        initializeClock('clockdiv', deadline);
 /*countdown end*/


         /*--window Scroll functions--*/
    $(window).on('scroll', function () {
      /*--show and hide scroll to top --*/
         var ScrollTop = $('.back-to-top');
            if ($(window).scrollTop() > 500) {
                    ScrollTop.fadeIn(1000);
            } else {
                    ScrollTop.fadeOut(1000);
           }
       /*--sticky menu activation--*/
            var mainMenuTop = $('.navbar-area');
            if ($(window).scrollTop() > 300) {
                mainMenuTop.addClass('nav-fixed');
            } else {
                mainMenuTop.removeClass('nav-fixed');
            }
        /*--sticky Mobile menu activation--*/
            var mobileMenuTop = $('.slicknav_menu');
            if ($(window).scrollTop() > 300) {
                mobileMenuTop.addClass('nav-fixed');
            } else {
                mobileMenuTop.removeClass('nav-fixed');
            }
    });
        </script>
    </body>
</html>




