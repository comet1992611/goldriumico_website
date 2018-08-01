@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Navigation Menus</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle  btn-success" href="{{route('menu.create')}}">
                           <i class="icon-plus"></i> New Menu
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Menu Name </th>
                                <th> Order </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td> {{$menu->id}} </td>
                                <td> {{$menu->name}} </td>
                                <td> {{$menu->order}} </td>
                                <td>
                                    <a class="btn btn-circle btn-icon-only  btn-default"  data-toggle="modal" data-target="#{{$menu->id}}Modal">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-warning" href="{{route('menu.edit',$menu->id )}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-circle btn-icon-only btn-danger"  href="{{ route('menu.destroy', $menu)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Menu?">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div id="{{$menu->id}}Modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"> {{$menu->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{!! $menu->content !!}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection