@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Contac Information</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                    <form role="form" method="POST" action="{{route('contac.update',$contac->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('put')}}
                            <div class="form-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><h3>Email</h3></label>
                                            <input type="email" class="form-control input-lg" value="{{$contac->email}}" name="email" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><h3>Mobile</h3></label>
                                            <input type="text" class="form-control input-lg" value="{{$contac->mobile}}" name="mobile" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><h3>Location</h3></label>
                                           <textarea name="location" class="form-control" rows="10">
                                                {{$contac-> location}}
                                            </textarea>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn blue btn-lg">Update</button>
                            </div>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection