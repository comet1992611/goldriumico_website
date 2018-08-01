@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">About Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('about.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group col-md-6">
                                <label for="about_title" style="font-size: 20px;">About Title</label>
                                <input type="text" value="{{$frontend->about_title}}" name="about_title" class="form-control">
                            </div>
                            <div class="form-group col-md-6" style="font-size: 20px;">
                                <label for="video">About Video URL</label>
                                <input type="text" value="{{$frontend->video}}" name="video" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="about_content" style="font-size: 20px;">About Content</label>
                               <textarea name="about_content" class="form-control" rows="8">
                                   {!!$frontend->about_content!!}
                               </textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 30px;">Upload White Paper (PDF)</label>
                                <input type="file" name="whitepaper" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 30px;">View White Paper</label>
                               <a href="{{url('assets/files/white-paper.pdf')}}" class="btn btn-lg btn-warning form-control" target="_blank"><i class="fa fa-eye"></i>View</a>
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