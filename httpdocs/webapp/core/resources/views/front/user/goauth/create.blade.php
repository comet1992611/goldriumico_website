@extends('front.layouts.admaster')
@section('content')    	
<div class="row">
<div class="col-md-8 col-md-offset-2">
<h3 class="text-bold text-center">Two Factor Authenticator
</h3>
		
@if(Auth::user()->gtfa == '1')
<div class="panel panel-primary">
  <div class="panel-body text-center">
  	<form role="form" method="POST" action="{{route('disable.2fa')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label style="text-transform: capitalize;">use google authenticator to scan the QR code below or use the below code</label>
<a class="btn btn-success btn-md" href="" target="_blank">DOWNLOAD APP</a>

			<div class="input-group">
			<input type="text" value="{{$prevcode}}" class="form-control input-lg" id="code" readonly>
				<span class="input-group-addon btn btn-success" id="copybtn">Copy</span>
			</div>	
		</div>
		<div class="form-group">
             <img src="{{$prevqr}}">
        </div>
		<button type="submit" class="btn btn-block btn-lg btn-danger">Disable Two Factor Authenticator</button>	
		</form>	
  </div>
</div>
@else
<div class="panel panel-info">
<div class="panel-body text-center">
	<form role="form" method="POST" action="{{route('go2fa.create')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label style="text-transform: capitalize;">use google authenticator to scan the QR code below or use the below code</label><br/>
<a class="btn btn-success btn-md" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">DOWNLOAD APP</a>
<hr/>
			<div class="input-group">
			<input type="text" name="key" value="{{$secret}}" class="form-control input-lg" id="code" readonly>
				<span class="input-group-addon btn btn-success" id="copybtn">Copy</span>
			</div>	
		</div>
		<div class="form-group">
             <img src="{{$qrCodeUrl}}">
        </div>
		<button type="submit" class="btn btn-block btn-lg btn-primary">Enable Two Factor Authenticator</button>	
		</form>	
</div>
</div>
@endif
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

@endsection