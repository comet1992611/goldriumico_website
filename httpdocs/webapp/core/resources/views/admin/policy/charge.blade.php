@extends('admin.layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings"></i>
					<span class="caption-subject bold uppercase">Charge / Commision</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form class="form-horizontal" action="{{url('admin/charges')}}/{{$charges->id}}" method="POST" role="form">
					{{ csrf_field() }}
					{{method_field('put')}}

					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<h5>Money Transfer Charge(Fixed)</h5>
							<div class="form-body">
								<div class="form-group">
									
									<div class="input-group mb15">
										<input class="form-control input-lg" name="trancharge" value="{{$charges->trancharge}}" type="text">
										<span class="input-group-addon">{{$gset->curSymbol}}</span>
									</div>
								</div>
							</div>                    

						</div>

						<div class="col-md-4 col-md-offset-1">
								<h5>Money Transfer Charge (Percentage) </h5>
							<div class="form-body">
								<div class="form-group">
									<div class="input-group mb15">
										<input class="form-control input-lg" name="trncrgp" value="{{$charges->trncrgp}}" type="text">
										<span class="input-group-addon">%</span>
									</div>
								</div>  
							</div>
						</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<h5>Base Price</h5>
							<div class="form-body">
								<div class="form-group">
									
									<div class="input-group mb15">
										<input class="form-control input-lg" name="basep" value="{{$charges->basep}}" type="text">
										<span class="input-group-addon">$</span>
									</div>
								</div>
							</div>                    

						</div>

						<div class="col-md-4 col-md-offset-1">
								<h5>Variable Price</h5>
							<div class="form-body">
								<div class="form-group">
									<div class="input-group mb15">
										<input class="form-control input-lg" name="varp" value="{{$charges->varp}}" type="text">
										<span class="input-group-addon">%</span>
									</div>
								</div>  
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<h5>Covertion Charge</h5>
							<div class="form-body">
								<div class="form-group">									
									<div class="input-group mb15">
										<input class="form-control input-lg" name="convcrg" value="{{$charges->convcrg}}" type="text">
										<span class="input-group-addon">%</span>
									</div>
								</div>
							</div>                    

						</div>
						<div class="col-md-4 col-md-offset-1">
							<h5>Total {{$gset->curCode}} Supply</h5>
							<div class="form-body">
								<div class="form-group">									
									<div class="input-group mb15">
										<input class="form-control input-lg" name="supply" value="{{$charges->supply}}" type="text">
										<span class="input-group-addon">{{$gset->curSymbol}}</span>
									</div>
								</div>
							</div>                    

						</div>
						</div>

			
	<div class="row">
						<hr/>
						<div class="col-md-4 col-md-offset-4">
							<button class="btn btn-lg btn-success btn-block">Update</button>
						</div>
					</div>
				</form>
			</div>
	</div>
</div>
</div>
@endsection