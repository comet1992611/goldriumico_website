@extends('front.layouts.admaster')
@section('content')    	
<div class="row">
<div class="col-md-12">
<h3 class="text-bold text-center">Verify Document</h3>
<div class="panel panel-info">
<div class="panel-body">
<div class="jumborton">
	<form role="form" method="POST" action="{{ route('doc.verify') }}" enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="form-group">
			<label>Document Name</label>
			<input type="text" name="name" class="form-control input-lg input-sz">
		</div>
		<div class="form-group">
			<label>Document Photo</label>
            <input type="file" name="photo" class="form-control input-lg"> 
           <span style="color: #ff6600;">Standard Image Size: 400 x 300 px</span>
        </div>
		
		<div class="form-group">
			<label for="details">Account Details</label>
			<textarea class="form-control"  id="details" name="details" rows="5">					
			</textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-block btn-lg btn-primary">Send Verify Request</button>
		</div>
	</form>
</div>
</div>
</div>

</div>
</div>
@endsection