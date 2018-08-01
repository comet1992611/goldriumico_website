@extends('front.layouts.admaster')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Convert Currency</h4>
      </div>
      <div class="panel-body text-center">
        <form action="{{route('convert.money')}}" method="POST">
          {{csrf_field()}}

        <div class="form-group">
                <label>From</label>
                <div class="input-group">
                  <input type="text" name="framo" class="form-control" id="framo">
                  <span class="input-group-addon"></span>
                    <select class="form-control" id="fromc" name="fromc">
                      <option id="ncoin" value="1">{{$gset->curCode}}</option>
                      <option id="bitcoin" value="2" selected>BitCoin</option>
                    </select>
                </div>
              </div>

  <div class="form-group">
                <i class="fa fa-arrows-v" aria-hidden="true"></i>
              </div>

           <div class="form-group">
                  <label>To</label>
                   <div class="input-group">
                      <input type="text" name="toamo" class="form-control" id="toamo" readonly>
                      <span class="input-group-addon" id="btcn" style="display: none;">BitCoin</span>
                      <span class="input-group-addon" id="ncn" >
                        {{$gset->curCode}}</span>
                    </div>
                </div>

        
       
          <div class="form-group text-center">
            <button class="btn btn-primary btn-lg btn-block">
              Convert Money
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
    <div class="col-md-4">
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


<!--Currrency Converter -->
<script type="text/javascript">
          $(document).ready(function(){

            $("#fromc").change(function(){
              var a = $( "#fromc option:selected" ).val();
              if(a == '1')
              {
                $("#btcn").show();
                $("#ncn").hide();
                $("#framo").keyup(function(){
                  var data = $("#framo").val();
                  var rate = {{$price->price}};
                  var btc = data*rate/{{$currentRate}};
                  $("#toamo").val(btc);
                  });
                 
              }
              else
              {
                 $("#btcn").hide();
                 $("#ncn").show();

                 $("#framo").keyup(function(){
                  var data = $("#framo").val();
                  var rate = {{$currentRate}};
                  var ndt = data*rate/{{$price->price}};
                  $("#toamo").val(ndt);
                  });
              }

            });

            $("#framo").keypress(function(){
              var a = $( "#fromc option:selected" ).val();
              if(a == '1')
              {
                $("#btcn").show();
                $("#ncn").hide();
                $("#framo").keyup(function(){
                  var data = $("#framo").val();
                  var rate = {{$price->price}};
                  var btc = data*rate/{{$currentRate}};
                  $("#toamo").val(btc);
                  });
                 
              }
              else
              {
                 $("#btcn").hide();
                 $("#ncn").show();

                 $("#framo").keyup(function(){
                  var data = $("#framo").val();
                  var rate = {{$currentRate}};
                  var ndt = data*rate/{{$price->price}};
                  $("#toamo").val(ndt);
                  });
              }

            });
          });
        </script>
@endsection