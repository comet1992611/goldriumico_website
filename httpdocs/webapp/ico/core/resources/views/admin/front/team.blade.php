@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Team Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('team.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="team_title">Team Section Title</label>
                                <input type="text" value="{{$frontend->team_title}}" name="team_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="team_details">Team Section Details</label>
                               <textarea name="team_details" class="form-control">
                                   {!!$frontend->team_details!!}
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
                    <span class="caption-subject bold uppercase">Team Peoples </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addRoad">
                        <i class="icon-plus"></i> New Team People
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column">
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                    @foreach($teams as $team)
                    <tr>
                        <td><img src="{{asset('assets/images/team') }}/{{$team->photo}}" class="img-responsive" style="max-width: 100px;"></td>
                        <td>{{$team->title}}</td>
                        <td>{{$team->details}}</td>
                        <td>
                            <a class="btn btn-circle btn-icon-only btn-warning" data-toggle="modal" data-target="#edit{{$team->id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('teams.destroy', $team)}}" method="POST" style="display: inline-block;">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-circle btn-icon-only btn-danger"  type="submit" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This People?">
                                    <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <div id="edit{{$team->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Team People</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="POST" action="{{route('teams.update', $team)}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{method_field('put')}}
                                             <div class="form-group">
                                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                      <img src="{{ asset('assets/images/team') }}/{{$team->photo}}" alt="" /> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                      <div>
                        <span class="btn btn-success btn-file">
                          <span class="fileinput-new"> Change Photo </span>
                          <span class="fileinput-exists"> Change </span>
                          <input type="file" name="photo"> </span>
                          <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                      </div>
                                </div>
                                            <div class="form-group">
                                                <label for="title">Name</label>
                                                <input type="text" value="{{$team->title}}" name="title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <input type="text" value="{{$team->details}}" name="details" class="form-control">
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
                    <h4 class="modal-title">New Team People</h4>

                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('teams.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                                 <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                      <img src="http://via.placeholder.com/200x200" alt="" /> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                      <div>
                        <span class="btn btn-success btn-file">
                          <span class="fileinput-new"> Change Photo </span>
                          <span class="fileinput-exists"> Change </span>
                          <input type="file" name="photo"> </span>
                          <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                      </div>
                    </div>

                        <div class="form-group">
                            <label for="title">Name</label>
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