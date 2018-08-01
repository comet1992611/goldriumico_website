@extends('admin.layout.master')
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-red-sunglo">
<i class="icon-settings font-red-sunglo"></i>
<span class="caption-subject bold uppercase">ICO Management</span>
</div>
                     <div class="actions">
                        <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addico">
                           <i class="icon-plus"></i> New ICO
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                      <table class="table table-striped table-bordered table-hover order-column">
                      	<tr>
                          <th>Start Date</th>
                      		<th>End Date</th>
                      		<th>{{$gnl->cur}} Token</th>
                          <th>Price (USD)</th>
                      		<th>Sold</th>
                      		<th>Status</th>
                      		<th>Action</th>
                      	</tr>
                      	@foreach($icos as $ico)
						<tr>
              <td>{{$ico->start}}</td>
							<td>{{$ico->end}}</td>
							<td>{{$ico->quant}} {{$gnl->cur}}</td>
              <td>{{$ico->price}} USD</td>
							<td>{{$ico->sold}} <br/>
                <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{($ico->sold/$ico->quant)*100}}"
                  aria-valuemin="0" aria-valuemax="100" style="width:{{($ico->sold/$ico->quant)*100}}%">
                    {{($ico->sold/$ico->quant)*100}}%
                  </div>
                </div>
              </td>
							<td>
            
            @if($ico->status == 1)
            <span style="background-color:#ffcc66; color: #fff; padding:5px;">Runing</span>
            @elseif($ico->status == 0)
            <span style="background-color:#00ccff; color: #fff; padding:5px;">Upcoming</span>
            @else
            <span style="background-color:red; color: #fff; padding:5px;">Completed</span>
            @endif
							                  </td>
							<td>
								 <a class="btn btn-circle btn-icon-only btn-warning" data-toggle="modal" data-target="#edit{{$ico->id}}">
		                           <i class="fa fa-edit"></i>
		                        </a>
								
							</td>
						</tr>
	<div id="edit{{$ico->id}}" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit ICO</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="POST" action="{{route('ico.update', $ico)}}">
                 {{ csrf_field() }}
                 {{method_field('put')}}
                 <div class="form-group">
                        <label>ICO Start Date</label>
                        <div class="input-group">
                          <input type="text" name="start" data-date-format="yyyy-mm-dd" class="form-control form-control-inline  date-picker" value="{{$ico->start}}" readonly />
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label>ICO End Date</label>
                        <div class="input-group">
                        	<input type="text" name="end" data-date-format="yyyy-mm-dd" class="form-control form-control-inline  date-picker" value="{{$ico->end}}" readonly />
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="quant" >{{$gnl->cur}} Token (Total Quantity to Sell)</label>
                        <input type="text" value="{{$ico->quant}}" name="quant" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" value="{{$ico->price}}" name="price" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="sold">Sold</label>
                        <input type="text" value="{{$ico->sold}}" name="sold" class="form-control">
                    </div>
                    <div class="form-group">
                    	<label>Status</label>
                    	<select class="form-control" name="status">
                    		<option value="1" {{$ico->status == 1 ? 'selected' : ''}}>Runing</option>
                        <option value="0" {{$ico->status == 0 ? 'selected' : ''}}>Upcoming</option>
                        <option value="3" {{$ico->status == 3 ? 'selected' : ''}}>Completed</option>
                    	</select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Save</button>
                    </div>
                </form>
              </div>
            </div>

          </div>
        </div>
                      	@endforeach
                      </table>
                </div>
            </div>
        </div>
    </div>
      <!-- Add Test -->
    <div id="addico" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New ICO</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="POST" action="{{route('ico.store')}}">
                 {{ csrf_field() }}
                  <div class="form-group">
                        <label>ICO Start Date</label>
                        <div class="input-group">
                          <input type="text" name="start" data-date-format="yyyy-mm-dd" class="form-control form-control-inline  date-picker" readonly />
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label>ICO End Date</label>
                        <div class="input-group">
                        	<input type="text" name="end" data-date-format="yyyy-mm-dd" class="form-control form-control-inline  date-picker" readonly />
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="quant" >{{$gnl->cur}} Token (Total Quantity to Sell)</label>
                        <input type="text" name="quant" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                    	<label>Status</label>
                    	<select class="form-control" name="status">
                        <option value="0" selected>Upcoming</option>
                    		<option value="1">Running</option>
                    	</select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Save</button>
                    </div>
                </form>
              </div>
            </div>

          </div>
        </div>
@endsection