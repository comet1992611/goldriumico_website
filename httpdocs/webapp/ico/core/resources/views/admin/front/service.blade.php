@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Service Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('service.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     <div class="form-group">
                                <label for="serv_title">Service Title</label>
                                <input type="text" value="{{$frontend->serv_title}}" name="serv_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="serv_details">Service Details</label>
                               <textarea name="serv_details" class="form-control">
                                   {!!$frontend->serv_details!!}
                               </textarea>
                            </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                    </div>
                </form>
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
                    <span class="caption-subject bold uppercase">Services </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addRoad">
                        <i class="icon-plus"></i> New Service
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column">
                    <tr>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                    @foreach($services as $service)
                    <tr>
                        <td><i class="fa fa-{{$service->icon}}" style="font-size: 30px;"></i> </td>
                        <td>{{$service->title}}</td>
                        <td>{{$service->details}}</td>
                        <td>
                            <a class="btn btn-circle btn-icon-only btn-warning" data-toggle="modal" data-target="#edit{{$service->id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('services.destroy', $service)}}" method="POST" style="display: inline-block;">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-circle btn-icon-only btn-danger"  type="submit" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Service?">
                                    <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <div id="edit{{$service->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Service</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="POST" action="{{route('services.update', $service)}}">
                                            {{ csrf_field() }}
                                            {{method_field('put')}}
                                             <div class="form-group">
                                                <label for="title">Icon</label>
                                                <a class="pull-right bold uppercase" href="http://fontawesome.io/icons/" target="_blank">Fontawesome Icon </a>
                                                <div class="input-group">
                                                   <span class="input-group-addon">fa fa-</span> 
                                                <input type="text" value="{{$service->icon}}" name="icon" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" value="{{$service->title}}" name="title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <input type="text" value="{{$service->details}}" name="details" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
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
    <div id="addRoad" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Service</h4>

                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('services.store')}}">
                        {{ csrf_field() }}
                         <div class="form-group">
                            <label for="icon">Icon</label>
                            <a class="pull-right bold uppercase" href="http://fontawesome.io/icons/" target="_blank">Fontawesome Icon </a>
                            <div class="input-group">
                                <span class="input-group-addon">fa fa-</span>
                            <input type="text" name="icon" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <input type="text"  name="details" class="form-control">
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