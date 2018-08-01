@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Subscription Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('subsc.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                            <label for="subs_title">Subscription Section Title</label>
                                <input type="text" value="{{$frontend->subs_title}}" name="subs_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="subs_details">Subscription Section Details</label>
                               <textarea name="subs_details" class="form-control">
                                   {!!$frontend->subs_details!!}
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
@endsection