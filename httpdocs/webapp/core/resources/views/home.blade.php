@extends('front.layouts.admaster')
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
<div class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-bitcoin"></i></div>
            <div class="stats-info">
              <h4>BTC RATE</h4>
              <p>${{number_format(floatval($currentRate) , $gset->decimalPoint, '.', '')}}</p>  
            </div>
          </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-blue">
            <div class="stats-icon"> <img src="{{ asset('assets/images/logo/icon.png') }}" style="width: 100%; "></div>
            <div class="stats-info">
              <h4>{{$gset->curCode}} RATE</h4>
              <p>${{number_format(floatval($price->price) , $gset->decimalPoint, '.', '')}}</p> 
            </div>
          </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><img src="{{ asset('assets/images/coin/btc.png') }}" style="width: 100%;  "></div>
            <div class="stats-info">
              <h4>BitCoin BALANCE</h4>
              <p>{{number_format(floatval(Auth::user()->bitcoin) ,  $gset->decimalPoint, '.', '')}}</p>  
            </div>
          </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-red">
            <div class="stats-icon"> <img src="{{ asset('assets/images/logo/icon.png') }}" style="width: 100%; "></div>
            <div class="stats-info">
              <h4>{{$gset->curCode}} BALANCE</h4>
              <p>{{number_format(floatval(Auth::user()->balance) ,  $gset->decimalPoint, '.', '')}}</p> 
            </div>
          </div>
        </div>
        <!-- end col-3 -->
      </div>
  <div class="row">
    <div class="col-md-4">
      <div class="col-md-12">
         <div class="panel panel-inverse" data-sortable-id="ui-buttons-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">MAKE TRANSACTION</h4>
                        </div>
                        <div class="panel-body">
                              <button type="button" class="btn btn-inverse btn-lg" data-toggle="modal" data-target="#sendmoney"><i class="fa fa-upload" aria-hidden="true"></i> Send </button>
                              <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#request" id="request-button"><i class="fa fa-download" aria-hidden="true"></i> Request </button>
                        </div>
                    </div>
      </div>
      <div class="col-md-12">
          <div class="panel panel-inverse" data-sortable-id="ui-buttons-3">
             <div class="panel-heading">
                  <h4 class="panel-title">YOUR ACCOUNT BALANCE</h4>
              </div>
                     <div class="panel-body">
                  <table class="table table-responsive">
                  <tr>
                    <td>My {{$gset->curCode}} Wallet</td>
                    <td>
                      {{number_format(floatval(Auth::user()->balance) ,  $gset->decimalPoint, '.', '')}} <br/>  $ {{number_format(floatval($nusd) ,  $gset->decimalPoint, '.', '')}}
                    </td>
                  </tr>
                  <tr>
                     <td>My BitCoin Wallet</td>
                    <td>
                      {{number_format(floatval(Auth::user()->bitcoin) ,  $gset->decimalPoint, '.', '')}} <br/> $ {{number_format(floatval($btusd) ,  $gset->decimalPoint, '.', '')}}
                    </td>
                  </tr>
                   <tr class="text-center">
                    <td colspan="2">$ <b>{{number_format(floatval($totusd) , $gset->decimalPoint, '.', '')}}</b></td>
                  </tr>
                </table>
              </div>
          </div>

    </div>
      </div>
        <div class="col-md-8">
          <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
              <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              </div>
              <h4 class="panel-title">Rate Analytics</h4>
            </div>
            <div class="panel-body">
               <div class="col-md-12" id="chartdiv"></div> 
            </div>
          </div>
      </div>   
  </div>

    <!--Send Modal-->
<div id="sendmoney" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('send.money')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label>Currency </label>
            <select class="form-control" id="myselect" name="curn">
               <option id="ncoin" value="1" selected>{{$gset->curCode}}</option>
              <option id="bitcoin" value="2">BitCoin</option>
            </select>
          </div>
          <div class="form-group">
            <label>To</label>
            <input type="text" name="code" class="form-control input-sz" placeholder="Enter Wallet Address" required>
          </div>
          <div class="form-group">
            <label>Amount</label>
            <table>
              <tr>
                <td> <div class="input-group">
                  <input type="text" name="amount" class="form-control" id="amount" required>
                  <span class="input-group-addon" id="btc"  style="display: none;">BitCoin</span>
                  <span class="input-group-addon" id="ncc">
                    {{$gset->curCode}}</span>
                  </div></td>
                  <td>
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                  </td>
                  <td>
                   <div class="input-group">
                    <input type="text" name="" id="usd" class="form-control">
                    <span class="input-group-addon">USD</span>
                  </div>
                </td>
              </tr>
            </table>
          </div>
           <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="desc">
            </textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block">
              Send Money
            </button>
          </div>
        </form>
        
      </div>
      
    </div>

  </div>
</div>


<!-- Request Modal -->
<div id="request" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request</h4>
      </div>
      <div class="modal-body text-center">
        <p>Copy and share this code to Request Money</p>
        <p id="qrcode" style="color:#3366cc; font-size: 20px;"></p>
        <div class="form-group">
          <div class="input-group">
          <input id="code" class="form-control input-lg">
          <span class="btn btn-success input-group-addon" id="copybtn">Copy</span>
        </div>
        </div>

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 



<!--Copy Data -->
<script type="text/javascript">
  document.getElementById("copybtn").onclick = function() 
  {
    document.getElementById('code').select();
    document.execCommand('copy');
  }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Ajax Get Data -->
<script>
  $(document).ready(function(){
    $(document).on('click','#request-button',function(){
        $.ajax({
               type:'get',
               url:'{{ route('money.requests') }}',
               data:'',
               success:function(data){
                  $('#qrcode').html(data.code);
                  $('#code').val(data.accnum);
               }
            });
    });
  }); 
</script>

<!--Currrency change Valu -->
<script type="text/javascript">
         $(document).ready(function(){

           $("#myselect").change(function(){
             var a = $( "#myselect option:selected" ).val();
             if(a == '1')
             {
               $("#ncc").show();
               $("#btc").hide();

                 var data = $("#amount").val();
                 var rate = {{$price->price}};
                 var total = data*rate;
                 $("#usd").val(total);
               
             }
             else
             {
                $("#ncc").hide();
                 $("#btc").show();

                 var data = $("#amount").val();
                 var rate = {{$currentRate}};
                 var total = data*rate;
                 $("#usd").val(total);
             }

           });


          $("#amount").keypress(function(){

var a = $( "#myselect option:selected" ).val();
             if(a == '1')
             {
               $("#ncc").show();
               $("#btc").hide();

               $("#amount").keyup(function(){
                 var data = $("#amount").val();
                 var rate = {{$price->price}};
                 var total = data*rate;
                 $("#usd").val(total);
                 });

               $("#usd").keyup(function(){
                 var data = $("#usd").val();
                 var rate = {{$price->price}};
                 var total = data/rate;
                 $("#amount").val(total);
                 });
               
             }
             else
             {
                $("#ncc").hide();
                 $("#btc").show();

                 $("#amount").keyup(function(){
                 var data = $("#amount").val();
                 var rate = {{$currentRate}};
                 var total = data*rate;
                 $("#usd").val(total);
                 });
                                 $("#usd").keyup(function(){
                 var data = $("#usd").val();
                 var rate = {{$currentRate}};
                 var total = data/rate;
                 $("#amount").val(total);
                 });
             }

          });

          $("#usd").keypress(function(){

var a = $( "#myselect option:selected" ).val();
             if(a == '1')
             {
               $("#ncc").show();
               $("#btc").hide();

               $("#amount").keyup(function(){
                 var data = $("#amount").val();
                 var rate = {{$price->price}};
                 var total = data*rate;
                 $("#usd").val(total);
                 });

               $("#usd").keyup(function(){
                 var data = $("#usd").val();
                 var rate = {{$price->price}};
                 var total = data/rate;
                 $("#amount").val(total);
                 });
               
             }
             else
             {
                $("#ncc").hide();
                 $("#btc").show();

                 $("#amount").keyup(function(){
                 var data = $("#amount").val();
                 var rate = {{$currentRate}};
                 var total = data*rate;
                 $("#usd").val(total);
                 });
                                 $("#usd").keyup(function(){
                 var data = $("#usd").val();
                 var rate = {{$currentRate}};
                 var total = data/rate;
                 $("#amount").val(total);
                 });
             }

          });


         });
       </script>



@endsection

