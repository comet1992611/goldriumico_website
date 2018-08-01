@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Banner Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('banner.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group col-md-6">
                        <label for="ban_title" style="font-size: 20px;">ICO Title</label>
                        <input type="text" value="{{$frontend->ban_title}}" name="ban_title" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ban_subtitle" style="font-size: 20px;">ICO Sub-Title</label>
                        <input type="text" value="{{$frontend->ban_subtitle}}" name="ban_subtitle" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ban_price" style="font-size: 20px;">ICO Price</label>
                        <input type="text" value="{{$frontend->ban_price}}" name="ban_price" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ban_sold" style="font-size: 20px;">ICO Sold</label>
                        <div class="input-group">
                        <input type="text" value="{{$frontend->ban_sold}}" name="ban_sold" class="form-control">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ban_date" style="font-size: 20px;">ICO End Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-inline input-medium date-picker" readonly name="ban_date" data-date-format="yyyy-mm-dd" value="{{$frontend->ban_date}}">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
  
                    <div class="form-group">
                        <label style="font-size: 20px;">Banner Details</label>
                        <textarea name="ban_details" class="form-control" rows="8">
                            {!!$frontend->ban_details!!}
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