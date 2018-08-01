@extends('admin.layouts.master')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">General Settings</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" method="POST" action="{{url('admin/gsettings')}}/{{$gsettings->id}}">
					{{ csrf_field() }}
					{{method_field('put')}}
					<div class="row">
						<div class="col-md-4">
							<h4>Website Title</h4>
							<input type="text" class="form-control input-lg" value="{{$gsettings->webTitle}}" name="webTitle" >
						</div>
						<div class="col-md-4">
							<h4>Website Sub-Title</h4>
							<input type="text" class="form-control input-lg" value="{{$gsettings->subtitle}}" name="subtitle" >
						</div>
						<div class="col-md-3">
							<h4>Website Start Date</h4>
                            <div class="input-group">
                            	<input type="text" class="form-control form-control-inline input-medium date-picker" readonly name="startdate" value="{{$gsettings->startdate}}">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                           
						</div>
					</div>
					<div class="row">
						<hr/>
						<div class="col-md-4">
							<h4>BASE COLOR CODE</h4>
							<input type="text" class="form-control input-lg "  value="{{$gsettings->colorCode}}" name="colorCode"  >
						</div>

						<div class="col-md-4">
							<h4>BASE CURRENCY TEXT</h4>
							<input type="text" class="form-control input-lg" value="{{$gsettings->curCode}}" name="curCode" >
						</div>
						<div class="col-md-4">
							<h4>BASE CURRENCY SYMBOL</h4>
							<input type="text" class="form-control input-lg" value="{{$gsettings->curSymbol}}" name="curSymbol" >
						</div>
					</div>

					<hr/>
					<div class="row">
						<hr/>
						<div class="col-md-4">
							<h4>Registration</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="registration" {{ $gsettings->registration == "1" ? 'checked' : '' }}>
						</div>

						<div class="col-md-4">
							<h4>EMAIL VERIFICATION</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="emailVerify" {{ $gsettings->emailVerify == "0" ? 'checked' : '' }}>
						</div>
						<div class="col-md-4">
							<h4>SMS VERIFICATION</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="smsVerify"  {{ $gsettings->smsVerify == "0" ? 'checked' : '' }}>
						</div>
					</div>


					<div class="row">
						<hr/>
						<div class="col-md-4">
							<h4>DECIMAL AFTER POINT</h4>
							<input type="number" value="{{$gsettings->decimalPoint}}" name="decimalPoint" class="form-control input-lg" >
						</div>

						<div class="col-md-4">
							<h4>EMAIL NOTIFICATION</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="emailNotify"  {{ $gsettings->emailNotify == "1" ? 'checked' : '' }}>
						</div>
						<div class="col-md-4">
							<h4>SMS NOTIFICATION</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="smsNotify" {{ $gsettings->smsNotify == "1" ? 'checked' : '' }}>
						</div>

                </div>
            </div>
					</div>
					<div class="row">
						<hr/>
						<div class="col-md-4 col-md-offset-4">
							<button class="btn blue btn-block btn-lg">Update</button>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection
