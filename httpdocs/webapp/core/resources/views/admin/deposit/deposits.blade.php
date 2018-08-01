@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Deposit List</span>
                </div>

            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                <thead>
                    <tr>
                      	<th>
                            Deposit ID 
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
                            Processed on
                        </th>
                  	 </tr>
                </thead>
                <tbody>
		 	@foreach($deposits as $dep)
                     <tr>
                     	<td>
                        	{{$dep->trxid}}  	
                        </td>
                        <td>
                          <a href="{{route('user.single', $dep->user->id)}}">
                             {{$dep->user->firstname}}
                             {{$dep->user->lastname}} 
                          </a>
                        </td> 
                        <td>
                             {{$dep->amount}} {{$gset->curSymbol}}
                        </td>
                        <td>
                        	<img src="{{ asset('assets/images/gateway') }}/{{$dep->gateway->gateimg}}" width="50">
                        </td>
                        <td>
                        	{{$dep->updated_at}}
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