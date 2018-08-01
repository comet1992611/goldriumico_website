@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Policy and Terms</span>
				</div>
			</div>
			<form role="form" method="POST" action="{{url('admin/policy/1')}}" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{method_field('put')}}
				<h2>Policy:</h2>
			  <div class="form-group">
			    <textarea class="form-control" name="privacy" rows="10">
			    	{{$policy->privacy}}
			    </textarea>
			  </div>
				<h2>Terms:</h2>
				<div class="form-group">
			    <textarea class="form-control" name="terms" rows="10">
			    	{{$policy->terms}}
			    </textarea>
				</div>
			  <button class="btn btn-success btn-lg btn-block">Update</button>
			</form>
		</div>
	</div>
	</div>
@endsection