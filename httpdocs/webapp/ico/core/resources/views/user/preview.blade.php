@extends('layouts.user')

@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2">
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Preview of Buying ICO</h4>
    </div>
    <div class="panel-body table-responsive text-center">
       <ul class="list-group">
       		<li class="list-group-item">{{$gnl->cur}} Amount: <strong>{{$amount}}</strong> {{$gnl->cursym}}</li>
       		<li class="list-group-item">{{$gnl->cur}} Price: <strong>{{$ico->price}}</strong> USD</li>
       		@if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8) 
       		<li class="list-group-item">Total Payable: <strong>{{$btc}}</strong> BTC</li>
       		<li class="list-group-item">Payment Gateway: <strong>{{$gate->name}}</strong></li>
           @else
       		<li class="list-group-item">Total Payable: <strong>{{$usd}}</strong> USD</li>
       		<li class="list-group-item">Payment Gateway: <strong>{{$gate->name}}</strong></li>
       		@endif
       </ul>
   </div>
   <div class="panel-footer">
   	<a class="btn btn-success btn-lg btn-block" href="{{route('buy.confirm')}}">
   		Pay Now
   	</a>
   </div>
 </div>
</div> 
</div>
@endsection
