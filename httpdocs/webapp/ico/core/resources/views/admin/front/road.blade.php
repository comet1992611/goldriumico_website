@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Road Map Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('roadmap.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <label for="road_title">Road Map Title</label>
                                <input type="text" value="{{$frontend->road_title}}" name="road_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="road_details">Road Map Details</label>
                               <textarea name="road_details" class="form-control">
                                   {!!$frontend->road_details!!}
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
                    <span class="caption-subject bold uppercase">Road Map</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addRoad">
                        <i class="icon-plus"></i> New Road Map
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column">
                    <tr>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                    @foreach($roads as $road)
                    <tr>
                        <td>{{$road->title}}</td>
                        <td>{{$road->details}}</td>
                        <td>
                            <a class="btn btn-circle btn-icon-only btn-warning" data-toggle="modal" data-target="#edit{{$road->id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('road.destroy', $road)}}" method="POST" style="display: inline-block;">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-circle btn-icon-only btn-danger"  type="submit" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Road?">
                                    <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <div id="edit{{$road->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Road Map</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="POST" action="{{route('road.update', $road)}}">
                                            {{ csrf_field() }}
                                            {{method_field('put')}}
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" value="{{$road->title}}" name="title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <input type="text" value="{{$road->details}}" name="details" class="form-control">
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
                    <h4 class="modal-title">New Road</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('road.store')}}">
                        {{ csrf_field() }}
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