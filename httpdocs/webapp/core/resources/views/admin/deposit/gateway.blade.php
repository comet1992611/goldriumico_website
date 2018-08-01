@extends('admin.layouts.master')

@section('content')
<div class="row">
<div class="col-md-12">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-red-sunglo">
<i class="icon-settings font-red-sunglo"></i>
<span class="caption-subject bold uppercase">Payment Gateway</span>
</div>
</div>
<div class="portlet-body form">
		<form role="form" method="POST" action="{{url('admin/gateway/update')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-body">
				<div class="form-group">
<img src="{{ asset('assets/images/gateway') }}/{{$gateway->gateimg}}" style="width: 100px; height: 100px; margin: 0 auto;">
					<span class="btn green fileinput-button">
						<i class="fa fa-plus"></i>
						<span> Change Logo </span>
						<input type="file" name="gateimg" class="form-control input-lg"> 
					</span>
				</div>
				<div class="form-group">
					<label for="name">Name of Gateway</label>
					<input type="text" value="{{$gateway->name}}" class="form-control" id="name" name="name" >
				</div>

				@if($gateway->id==1)

				<div class="form-group">
					<label for="val1">PAYPAL BUSINESS EMAIL</label>
					<input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
				</div>
				@elseif($gateway->id==2)
				<div class="form-group">
					<label for="val1">PM USD ACCOUNT</label>
					<input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
				</div>
				<div class="form-group">
					<label for="val2">ALTERNATE PASSPHRASE</label>
					<input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
				</div>
				@elseif($gateway->id==3)
				<div class="form-group">
					<label for="val1">API KEY</label>
					<input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
				</div>
				<div class="form-group">
					<label for="val2">XPUB CODE</label>
					<input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
				</div>
				@elseif($gateway->id==4)
				<div class="form-group">
					<label for="val1">SECRET KEY</label>
					<input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
				</div>
				<div class="form-group">
					<label for="val2">PUBLISHABLE KEY</label>
					<input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
				</div>
				@elseif($gateway->id=='5')
				<div class="form-group">
					<label for="val1">Merchant ID</label>
					<input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
				</div>
				<div class="form-group">
					<label for="val2">Secret KEY</label>
					<input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
				</div>
				@else
				<div class="form-group">
					<label for="val1">Payment Details</label>
					<input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
				</div>								
				@endif
				<hr/>
				<div class="form-group">
					<label for="status">Status</label>
					<select class="form-control" name="status">
						<option value="1" {{ $gateway->status == "1" ? 'selected' : '' }}>Active</option>
						<option value="0" {{ $gateway->status == "0" ? 'selected' : '' }}>Deactive</option>
					</select>

				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-success btn-block">Update</button>
			</div>

		</form>

</div>

</div><!-- row -->
</div>
</div>

@endsection