@extends('admin.layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Statistics Data</span>
				</div>
				<div class="actions">
                    <a class="btn btn-circle  btn-success" target="_blank" href="http://fontawesome.io/icons">
                        <i class="fa fa-font-awesome"></i>Font Awesome Icon
                    </a>
                 </div>
			</div>
<div class="portlet-body form">
	<div class="row">
		<div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover table-responsive">
                <thead>
                    <tr>
                      	<th>
                          Font Awesome Icon 
                        </th>
                        <th>
                           Bold Text
                        </th>
                        <th>
                             Small Text
                        </th>
                        <th>
                        	Action
                        </th>
                  	 </tr>
                </thead>
                <tbody>
		 	@foreach($stats as $stat)
                     <tr>
                        <td>
                             <i class="fa fa-{{$stat->icon}}"></i> {{$stat->icon}} 	
                        </td> 
                        <td>
                           {{$stat->bold}}
                        </td>
                        <td>
                        	{{$stat->small}}
                        </td>
                        <td>
                        	<a href="" class="btn btn-outline btn-circle btn-sm purple" data-toggle="modal" data-target="#Modal{{$stat->id}}">
                             <i class="fa fa-edit"></i> Edit </a>
                        </td>

                     </tr>
                    
                     <!--Edit Modal -->
					  <div class="modal fade" id="Modal{{$stat->id}}" role="dialog">
						    <div class="modal-dialog">
						    
						      <!-- Modal content-->
							      <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title">Edit Statistics Information</h4>
								        </div>
								        <form role="form" method="POST" action="{{url('admin/statistics')}}/{{$stat->id}}" enctype="multipart/form-data">
								        	{{ csrf_field() }}
											{{method_field('put')}}
								        	<div class="modal-body">
												 
												 <div class="form-group">
												   <label for="icon">Font Awesome Icon</label>
												   <div class="input-group">
												   	<span class="input-group-addon input-circle-left">fa fa-</span>
												   <input type="text" value="{{$stat->icon}}" class="form-control" id="icon" name="icon" >
												   </div>
												   
												 </div>
												 <div class="form-group">
												   <label for="bold">Bold Text</label>
												   <input type="text" value="{{$stat->bold}}" class="form-control" id="bold" name="bold" >
												 </div>

												 <div class="form-group">
												   <label for="small">Small Text</label>
												   <input type="text" value="{{$stat->small}}" class="form-control" id="small" name="small" >
												 </div>
												
											</div>

										        <div class="modal-footer">
										          <button type="submit" class="btn btn-success">Update</button>
										        </div>
							         
										</form>
							      </div>
						    </div>
					  </div>
 			@endforeach 
 			<tbody>
           </table>
        </div>
			
				</div><!-- row -->
			</div>
		</div>
	</div>		
</div>
@endsection