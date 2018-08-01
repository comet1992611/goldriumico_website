@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">BitCoin Withdraw Requests</span>
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
                        	Action
                        </th>
                  	 </tr>
                </thead>
                <tbody>
		 	@foreach($withd as $wd)
                     <tr>
                     	<td>
                        	{{$wd->wdid}}  	
                        </td>
                        <td>
                             {{$wd->user->username}}
                        </td> 
                        <td>
                             {{$wd->amount}} BTC
                        </td>
                        <td>
                        	BitCoin
                        </td>
                        <td>
                        	{!! $wd->details !!}
                        </td>
                        <td>
                        	{{$wd->created_at}}
                        </td>
                        <td>
                        	<a href="" class="btn btn-outline btn-circle btn-sm green" data-toggle="modal" data-target="#Modal{{$wd->id}}">
                             <i class="fa fa-check"></i> Approve </a>
                             <a href="" class="btn btn-outline btn-circle btn-sm red" data-toggle="modal" data-target="#rModal{{$wd->id}}">
                             <i class="fa fa-share"></i> Refund </a>
                        </td>

                     </tr>
                    
                     <!--Approve Modal -->
					  <div class="modal fade" id="Modal{{$wd->id}}" role="dialog">
						    <div class="modal-dialog">
						    
						      <!-- Modal content-->
							      <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title">Are You Sure?</h4>
								        </div>
								        
								        	<div class="modal-body">
								        		<form role="form" method="POST" action="{{route('withdraw.approve', $wd->id)}}" enctype="multipart/form-data">
								        	{{ csrf_field() }}
											{{method_field('put')}}
												<h3>Approve <b>{{$wd->wdid}}</b> Withdraw Request?</h3>
												 <button type="submit" class="btn btn-lg btn-success btn-block">Approve</button>
                           </form>
												 </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
												
											
											</div>
							         
										
							      </div>
						    </div>
					  </div>

                      <!--Refund Modal -->
                      <div class="modal fade" id="rModal{{$wd->id}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                                  <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Are You Sure?</h4>
                                        </div>
                                        
                                            <div class="modal-body">
                                                <form role="form" method="POST" action="{{route('withdraw.refund', $wd->id)}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{method_field('put')}}
                                                <input type="hidden" name="status" value="2">
                                                <h3>Refund <b>{{$wd->wdid}}</b> Withdraw ?</h3>
                                                 <button type="submit" class="btn btn-lg btn-success">Refund</button>
                                                 </div>
                                                
                                                 </form>
                                            </div>
                                     
                                        
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