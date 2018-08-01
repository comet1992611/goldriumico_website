@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> User List</span>
                </div>

            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                <thead>
                    <tr>
                      	<th>
                            Withdraw ID 
                        </th>
                        <th>
                            User
                        </th>
                        <th>
                            Amount
                        </th>
                       	<th>
                       		Method
                       	</th>
                       	<th>
                       		Details
                       	</th>
                       	
                        <th>
                        	Requested on
                        </th>
                        <th>
                            Refunded on
                        </th>
                  	 </tr>
                </thead>
                <tbody>
		 	@foreach($refund as $wd)
                     <tr>
                     	<td>
                        	{{$wd->wdid}}  	
                        </td>
                        <td>
                             {{$wd->user->firstname}} {{$wd->user->lastname}} 
                        </td> 
                        <td>
                             {{$wd->amount}} {{$gset->curSymbol}}
                        </td>
                        <td>
                        	<img src="{{ asset('assets/images/wdmethod') }}/{{$wd->wdmethod->logo}}" width="50">
                        </td>
                        <td>
                        	{{$wd->details}}
                        </td>
                        <td>
                        	{{$wd->created_at}}
                        </td>
                         <td>
                            {{$wd->updated_at}}
                        </td>
                     </tr>
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