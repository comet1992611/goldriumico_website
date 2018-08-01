@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Edit {{$page-> name}} Menu</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle  btn-default" href="{{route('menu.index')}}">
                            <i class="fa fa-backward"></i> Back
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form role="form" method="POST" action="{{route('menu.update', $page->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('put')}}
                        <div class="form-body">
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input type="text" class="form-control input-lg" name="name" value="{{$page-> name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Menu Order</label>
                            <select class="form-control" name="order">
                                @for ($i = 1; $i < 50; $i++)
                                    <option value="{{$i}}" {{ $page->order == $i ? 'selected' : '' }}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Page Content</label>
                            <textarea name="content" class="form-control" rows="10">
                                {{$page-> content}}
                            </textarea>
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn blue btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection