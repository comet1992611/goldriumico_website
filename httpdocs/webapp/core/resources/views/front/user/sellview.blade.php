@extends('front.layouts.admaster')
@section('content')
<div class="row">
<div class="col-md-12">
<div class="panel panel-inverse">
	<div class="panel-heading">
		<h3 class="panel-title">Confirm Sell {{$gset->curCode}}</h3>
	</div>
	<div class="panel-body">

		<div class="row">
		<div  class="col-md-8 col-md-offset-2 text-center">
			 <h1><img src="{{ asset('assets/images/logo/icon.png') }}"> {{$amount}}
					 <i class="fa fa-exchange"></i> <i class="fa fa-bitcoin"></i>{{ $btc }}</h1>

		<form method="POST" action="{{route('sell.now')}}">
			{{ csrf_field() }}
			<input type="hidden" name="amount" value="{{$amount}}">
			<button type="submit" class="btn btn-lg btn-primary btn-block">
			Sell Now
		</button>
		</form>
		
		</div>
		</div>
		

	</div>
</div>
</div>
</div>

@endsection