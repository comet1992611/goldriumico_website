@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Social Accounts</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle  btn-primary"  data-toggle="modal" data-target="#addsocial">
                           <i class="icon-plus"></i> New Social Account
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> Social Account Icon </th>
                                <th> Account Link</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($social as $social)
                            <tr>
                                <td><i class="fa fa-{{$social->facode}}"></i></td>
                                <td> {{$social->faurl}} </td>
                                <td>
                                  <a class="btn btn-circle btn-icon-only btn-warning"  data-toggle="modal" data-target="#social{{$social->id}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-danger"  href="{{ route('social.destroy', $social)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Social Account?">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <!--Edit Modal -->
                <div id="social{{$social->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit <i class="{{$social->facode}}"></i> Account Info</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action="{{route('social.update', $social->id)}}" >
                                     {{ csrf_field() }}
                                      {{method_field('put')}}
                                        <div class="form-group">
                                            <label for="facode">Social Icon Font Awesome Code</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon input-circle-left">fa fa-</span>
                                                   <input type="text" value="{{$social->facode}}" class="form-control" id="icon" name="facode" >
                                                   </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="faurl">Social Account URL</label>
                                            <input type="text" class="form-control" id="faurl" name="faurl" value="{{$social->faurl}}">
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
                            <tr>
                                <td>
                                    <a class="btn btn-circle  btn-success" target="_blank" href="http://fontawesome.io/icons">
                                    <i class="fa fa-font-awesome"></i>Font Awesome Icon
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
                <div id="addsocial" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Social Account</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action="{{route('social.store')}}" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="facode">Social Icon Font Awesome Code</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon input-circle-left">fa fa-</span>
                                                   <input type="text" class="form-control" id="icon" name="facode" >
                                                   </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="faurl">Social Account URL</label>
                                            <input type="text" class="form-control" id="faurl" name="faurl" >
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