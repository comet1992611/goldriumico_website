@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Background Images </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('background.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-6">
                        <label style="font-size: 30px;">Banner Section</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('assets/images/section') }}/{{$frontend->secbg1}}" alt="" style="max-height: 200px; max-width: 100%;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 200px; max-width: 100%;"> </div>
                                <div class="col-md-12">
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Photo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="secbg1"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                               <label style="font-size: 30px;">Video Section</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('assets/images/section') }}/{{$frontend->secbg2}}" alt="" style="max-height: 200px; max-width: 100%;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 200px; max-width: 100%;"> </div>
                                <div class="col-md-12">
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Photo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="secbg2"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="form-group col-md-6">
                                <label style="font-size: 30px;">Contact Section</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('assets/images/section') }}/{{$frontend->secbg3}}" alt="" style="max-height: 200px; max-width: 100%;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 200px; max-width: 100%;"> </div>
                                <div class="col-md-12">
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Photo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="secbg3"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 30px;">Subscription Section</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('assets/images/section') }}/{{$frontend->secbg4}}" alt="" style="max-height: 200px; max-width: 100%;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 200px; max-width: 100%;"> </div>
                                <div class="col-md-12">
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Photo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="secbg4"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


@endsection