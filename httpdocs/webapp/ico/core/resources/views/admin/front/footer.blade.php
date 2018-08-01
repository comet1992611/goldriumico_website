@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Footer Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('footer.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                                <h4 for="footer1">Left Footer Section</h4>
                               <textarea name="footer1" class="form-control">
                                   {!!$frontend->footer1!!}
                               </textarea>
                            </div> 
                            <div class="form-group">
                                <h4 for="footer2">ICO Calendar Heading</h4>
                               <textarea name="footer2" class="form-control">
                                   {!!$frontend->footer2!!}
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