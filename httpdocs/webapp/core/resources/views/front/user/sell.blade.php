@extends('front.layouts.admaster')
@section('content')       
<div class="row text-center">
      <div class="col-md-8">
            <div class="panel panel-inverse">
                  <div class="panel-heading">
                        <h4 class="panel-title">Sell {{$gset->curCode}}</h4>
                  </div>
                  <div class="panel-body">
                        <form role="form" method="post" action="{{ route('sell.view') }}" >
                              {{ csrf_field() }}
                              <div class="form-group">
                                    <label for="amount">Amount</label>
                                     <div class="input-group">
                                          <input type="text" class="form-control" id="amount" name="amount" required>
                                           <span class="input-group-addon">{{$gset->curSymbol}}</span>
                                    </div>
                              </div>
                              <button type="submit" class="btn btn-lg btn-primary btn-block">Next</button>
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

@endsection



