@extends('admin.layouts.master')

@section('content')
<div class="row">
		<div class="col-md-12">
			<h2>Set SMS API</h2>
			<hr/>
		</div>
	</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-bookmark"></i>Short Code</div>

				</div>
				<div class="portlet-body">
					<div class="table-scrollable">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th> # </th>
									<th> CODE </th>
									<th> DESCRIPTION </th>
								</tr>
							</thead>
							<tbody>


								<tr>
									<td> 1 </td>
									<td> <pre>&#123;&#123;message &#125;&#125;</pre> </td>
									<td> Details Text From Script</td>
								</tr>

								<tr>
									<td> 2 </td>
									<td> <pre> &#123;&#123; number &#125;&#125; </pre> </td>
									<td> Users Name. Will Pull From Database and Use in EMAIL text</td>
								</tr>



							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">SMS API</span>
				</div>
			</div>
			<form role="form" method="POST" action="{{url('admin/gsettings/sms')}}/{{$gsettings->id}}">
				{{ csrf_field() }}
					{{method_field('put')}}
			  <div class="form-group">
			    <textarea class="form-control" name="smsApi" rows="10">
			    	{{$gsettings->smsApi}}
			    </textarea>
			  </div>
			  <button class="btn blue">Update</button>
			</form>
		</div>
	</div>
	</div>
	@endsection