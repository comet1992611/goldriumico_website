@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Service Section</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                    <form role="form" method="POST" action="{{route('service.update')}}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><h3>Heading</h3></label>
                                            <input type="text" class="form-control input-lg" value="{{$service->heading}}" name="heading" >
                                        </div>
                                    </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn blue btn-lg btn-block">Update</button>
                            </div>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Service Items</span>
                    </div>
                     <div class="actions">
                        <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addtest">
                           <i class="icon-plus"></i> New Items
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                     <div class="row">
                    @foreach($testims as $testim)
                        <div class="col-md-3">
                            <div class="panel panel-primary">
                              <div class="panel-heading">{{$testim->company}}</div>
                              <div class="panel-body">
                                  <img src="{{ asset('assets/images/testimonial') }}/{{$testim->photo}}" class="img-responsive" width="100%">
                                  <p>
                                      {{$testim->comment}}
                                  </p>
                              </div>
                               <div class="panel-footer">
                                    <a class="btn btn-circle btn-warning" data-toggle="modal" data-target="#edittestim{{$testim->id}}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a class="btn btn-circle btn-danger"  href="{{ route('testim.destroy', $testim)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This testim?">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                              </div>
                            </div>
                        </div>

                        <!-- Edit testim -->
                        <div id="edittestim{{$testim->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit {{$testim->company}}</h4>
                          </div>
                          <div class="modal-body">
                            <form role="form" method="POST" action="{{route('testim.update',$testim->id)}}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             {{method_field('put')}}
                                <div class="form-group">
                                    <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload Image </span>
                                                <input type="file" name="photo" class="form-control input-lg">
                                            </span>
                                            <span class="btn-danger">Standard Image Size: 300 x 400 px</span>
                                </div>
                                     
                            <div class="form-group">
                                <label for="company">Item Name</label>
                                <input type="text" class="form-control" value="{{$testim->company}}"  id="company" name="company" >
                            </div>
                            <div class="form-group">
                                <label for="comment" >Details</label>
                                <input type="text" name="comment" value="{{$testim->comment}}" class="form-control">
                            </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-success" >Update</button>
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
                            <!-- Add Test -->
    <div id="addtest" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Item</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="POST" action="{{route('testim.store')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                    <div class="form-group">
                        <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload Client Photo </span>
                                                <input type="file" name="photo" class="form-control input-lg">
                                            </span>
                                             <span class="btn-danger">Standard Image Size: 300 x 400 px</span>
                    </div>
                    <div class="form-group">
                        <label for="company">Item Name</label>
                        <input type="text" class="form-control" id="company" name="company" >
                    </div> 
                    <div class="form-group">
                        <label for="comment" >Details</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success" >Save</button>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
@endsection