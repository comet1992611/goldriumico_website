@extends('front.layouts.master')
@section('content')

     <style>
#chartdiv {
  width : 100%;
  height  : 300px;
}                  
</style>

<!-- Chart code -->
<script>
var chartData = generateChartData();

var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 80,
    "dataProvider": chartData,
    "valueAxes": [{
        "position": "left",
        "title": "Price History"
    }],
    "graphs": [{
        "id": "g1",
        "fillAlphas": 0.4,
        "valueField": "visits",
         "balloonText": "<div style='margin:5px; font-size:19px;'><b>$ [[value]]</b></div>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "scrollbarHeight": 20,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount": true,
        "color": "#333"
    },
    "chartCursor": {
        "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
        "cursorPosition": "mouse"
    },
    "categoryField": "date",
    "categoryAxis": {
        "minPeriod": "mm",
        "parseDates": true
    },
    "export": {
        "enabled": true,
         "dateFormat": "YYYY-MM-DD HH:NN:SS"
    }
});

chart.addListener("dataUpdated", zoomChart);

function zoomChart() {

    chart.zoomToIndexes(chartData.length - 250, chartData.length - 100);
}

function generateChartData() {
    var chartData = [];

@foreach ($allprice as $pri)




var newDate = new Date('{{$pri->created_at}}');


        chartData.push({
            date: newDate,
            visits: {{$pri->price}}
        });

@endforeach
    return chartData;
}
</script>

   <!--Header section start-->
   <section id="particles-js" class="header-area header-bg">
       <div class="container">
           <div class="row">
               <div class="col-md-8 col-md-offset-2 text-center">
                   <div class="header-section-wrapper">
                       <div class="header-section-top-part">
                           <h1>{!!$banner->bold!!}</h1>
                           <p style="font-size: 1.5em;">{!!$banner->small!!}</p>
                       </div>
                       <div class="header-section-bottom-part">
                           <div class="domain-search-from">
                               <form action="{{route('search')}}" method="POST">
                                {{csrf_field()}}
                                   <input type="text" name="search" placeholder="Enter Wallet Address or Hash">
                                   <input type="submit" value="Search">
                               </form>
                           </div>
                           
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <!--Header section end-->

  <div class="clearfix"></div>

  <!-- Admin section start -->
  <div class="admin-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- admin content start -->
          <div class="admin-content">
            <!-- admin text start -->
            <div class="admin-text">
              <p>Get access to Your account</p>
            </div>
            <!-- admin text end -->
            <!-- admin user start -->
            <div class="admin-user">
              <a href="{{url('login')}}"><button type="submit" name="login">sign in</button></a>
              <a href="{{url('register')}}"><button type="submit" name="register">register now</button></a>
            </div>
            <!-- admin user end -->
          </div>
          <!-- admin-content end -->
        </div>
      </div>
    </div>
  </div>
  <!-- Admin section end -->

  <div class="clearfix"></div>

    <!-- Circle Section Start -->
    <section  class="circle-section section-padding section-background">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="section-header">
            <h3><span>{{$service}}</span> {{$gset->webTitle}}</h3>
            <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
          </div>
        </div>
      </div>

        <div class="row">
          @foreach($items as $item)
          <div class="col-md-3">
            <div class="circle-item">
              <img src="{{ asset('assets/images/testimonial') }}/{{$item->photo}}" alt="items">
              <div class="circle-content">
                <h6>{{$item->company}}</h6>
                <p>{{$item->comment}}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- Circle Section End -->
    <div class="clearfix"></div>

<div class="clearfix"></div>
<!-- Sale Section Start -->
<section class="sale-section section-padding" id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Sale Header Start -->
          <div class="sale-header">
            <h2>{{$about->heading}} <span>{{$gset->webTitle}}</span></h2>
          </div>
          <!-- Sale header End -->
          <!-- Sale Content Start -->
          <div class="sale-content">
      <div class="row">
        <div class="col-md-6">
         
<p>{!! $about->video !!}</p>
        </div>
        <div class="col-md-6">
        <p>{!! $about->details !!}</p>
        </div>

      </div>

          </div>
          <!-- Sale content end -->
      </div>
    </div>
  </div>
</section>
<!-- Sale Section End -->
  <div class="clearfix"></div>


    <!-- Popular Plans Start -->
    <section class="popular-plan-section section-padding" id="graph">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <!-- section header start -->
          <div class="section-header">
            <h3><span>Price Graph of </span> {{$gset->webTitle}}</h3>
            <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
          </div>
        <!-- section header end -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="popular-plan-content">
<div class="col-md-12" id="chartdiv"></div> 
            <ul class="text-center">
              <li>
                <i class="fa fa-area-chart"></i>
                <p>CURRENT PRICE</p>
                <span>{{number_format(floatval($price->price) , $gset->decimalPoint, '.', '')}} USD/{{$gset->curCode}}</span>
              </li>
              <li>
                <i class="fa fa-bar-chart"></i>
                <p>SUPPLY</p>
                <span>{{number_format(floatval($supply) , 2, '.', '')}}M {{$gset->curCode}}</span>
              </li>
              <li>
                <i class="fa fa-pie-chart"></i>
                <p>REMAIN</p>
                <span>{{number_format(floatval($mval) , 2, '.', '')}}M {{$gset->curCode}}</span>
              </li>
            </ul>
          </div>
        
        </div>
      </div>
  
          

      </div>
    </section>
    <!-- Popular Plans End -->

<div class="clearfix"></div>

<!-- Newsletter Section Start -->
<section class="newsletter-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <!-- Newsletter Text Start -->
        <div class="newsletter-text">
          <h3>subscribe to Price Updates</h3>
        </div>
        <!-- newsletter Text End -->
      </div>
      <div class="col-md-6">
        <!-- Newsletter form Start -->
        <div class="newsletter-form">
          <form action="#">
            <input type="text" name="email" id="subemail" placeholder="Email">
            <button type="button" id="subsc">
              subscribe
            </button>
          </form>
        </div>
        <!-- Newsletter Form End -->
      </div>
    </div>
  </div>
</section>
<!-- Newsletter Section End -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Ajax Post Data -->
<script>
  $(document).ready(function(){
    $(document).on('click','#subsc',function(){
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

<div class="clearfix"></div>

<!-- Online Section Start -->
<section class="online-section section-padding" id="timeline">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
           <!-- section header start -->
          <div class="section-header">
            <h3>{{$gset->webTitle}} <span>TIMELINE</span> </h3>
            <p><img src="{{asset('assets/images/logo/icon.png') }}" alt="icon"></p>
          </div>
        <!-- section header end -->
        </div>
      </div>
     
    <div class="row">
      <div class="col-md-12">
  <section id="cd-timeline" class="cd-container">
@foreach($times as $time)
    <div class="cd-timeline-block">
      <div class="cd-timeline-img cd-picture">
    <i class="fa fa-calendar"></i>
      </div> <!-- cd-timeline-img -->
      <div class="cd-timeline-content">
        <h2>{{$time->title}}</h2>
        <p>{!! $time->desc !!}</p>
        <span class="cd-date">{{$time->date}}</span>
      </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->
@endforeach

  </section> <!-- cd-timeline -->



      </div>
    </div>
  </div>
</section>
<!-- Online Section End -->
@endsection
