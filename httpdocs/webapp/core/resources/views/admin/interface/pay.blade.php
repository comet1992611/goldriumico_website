@extends('admin.layouts.master')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Payment Method Section</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                    <form role="form" method="POST" action="{{route('payin.update',$payin->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('put')}}
                            <div class="form-body">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><h3>Heading</h3></label>
                                            <input type="text" class="form-control input-lg" value="{{$payin->heading}}" name="heading" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><h3>Details</h3></label>
                                           <textarea name="details" class="form-control" rows="3">
                                               {{$payin->details}}
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Payment Methods</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <form role="form" method="POST" action="{{route('paymethod.store')}}" enctype="multipart/form-data" class="form-inline">
                            {{ csrf_field() }}
                            <div class="form-body">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                            <span> Upload Payment Method Logo (300x300 px)</span>
                                            <input type="file" name="payment" class="form-control input-lg"> </span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn blue btn-lg">Save</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                     </div>
                      <div class="row">
                        <div class="col-md-12">
                            <hr/>
                            <div class="panel panel-primary">
                              <div class="panel-heading">Payment Methods</div>
                              <div class="panel-body">
                            @foreach($payment as $pay)
                                <div class="col-md-2 col-md-offset-1 well">
                                     <img src="{{ asset('assets/images/paymethod') }}/{{$pay->payment}}" class="img-responsive" width="100%" >
                                     <hr/>
                                     <a class="btn btn-circle  btn-danger"  href="{{ route('paymethod.destroy', $pay->id)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Payment Icon?">
                                        <i class="fa fa-trash"></i> Delete
                                </a>
                                </div>

                            @endforeach
                              </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
