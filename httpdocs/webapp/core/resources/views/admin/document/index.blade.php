@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Document Verification Requests</span>
                </div>
                 <div class="actions">
                      <form method="POST" action="{{route('tran.limit')}}" class="form-inline">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-group">
                          <label>Transaction Limit for Unverified User</label>
                          <div class="input-group">
                            <input type="text" name="coin" class="form-control" value="{{$tranl->coin}}">
                            <span class="input-group-addon">Coin</span>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                          </div>
                          
                        </div>
                      </form>
                  </div>

            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                      	<th>
                            User ID
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Document Name
                        </th>
                         <th>
                            Requested Time
                        </th>
                        <th>
                        	Action
                        </th>
                  	 </tr>
                </thead>
                <tbody>
		 	@foreach($docs as $doc)
                     <tr>
                     	<td>
                        	{{$doc->user_id}}  	
                        </td>
                        <td>
                             {{$doc->user->username}}
                        </td> 
                        <td>
                             {{$doc->name}}
                        </td>
                         <td>
                             {{$doc->created_at}}
                        </td>
                  
                        <td>
                        	<a href="" class="btn btn-outline btn-circle btn-sm green" data-toggle="modal" data-target="#Modal{{$doc->id}}">
                             <i class="fa fa-eye"></i> View </a>
                        </td>

                     </tr>
 			@endforeach 
 			<tbody>
           </table>
           <?php echo $docs->render(); ?>
        </div>
			
				</div><!-- row -->
			</div>
		</div>
	</div>		
</div>

@foreach($docs as $doc)
  <div class="modal fade" id="Modal{{$doc->id}}" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Document of {{$doc->user->username}}</h4>
          </div>
          
            <div class="modal-body">
              <table class="table-striped table table-hover">
                  <tr>
                    <td>Username:</td>
                    <td>{{$doc->user->username}}</td>
                  </tr>   
                  <tr>
                    <td>Document Name:</td>
                    <td>{{$doc->name}}</td>
                  </tr> 
                  <tr>
                    <td>Document Photo:</td>
                    <td> 
                      <img src="{{ asset('assets/images/document') }}/{{$doc->photo}}" class="img-responsive" style="max-width: 70%; padding: 5px;"> 
                    </td>
                  </tr>   
                  <tr>
                    <td>Document Details:</td>
                    <td> 
                      {!! $doc->details !!}
                    </td>
                  </tr>   
              </table>


              <form role="form" method="POST" action="{{route('document.approve', $doc->user->id)}}" >
                  {{ csrf_field() }}
                  {{method_field('put')}}
              <div class="form-group">
                <label>Approve</label>
                <input data-toggle="toggle" data-onstyle="success" data-on="Approved" data-off="Not Approved" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="docv" {{ $doc->user->docv == "1" ? 'checked' : '' }}>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                  Update
                </button>
              </div>
          
          </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          
        
        </div>
                       
                    
                    </div>
                </div>
@endforeach
@endsection