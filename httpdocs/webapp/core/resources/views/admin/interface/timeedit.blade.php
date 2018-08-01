@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Edit Timeline</span>
                    </div>
                </div>
                <div class="portlet-body">
                   <form role="form" method="POST" action="{{route('timeline.update', $time->id)}}" >
                                     {{ csrf_field() }}
                                      {{method_field('put')}}
                                        <div class="form-group">
                                            <label for="title">Timeline Title</label>
                                            <input type="text" value="{{$time->title}}" class="form-control" id="icon" name="title" >
                                        </div>
                                         <div class="form-group">
                                            <label for="desc">Timeline Details</label>
                                              <textarea class="form-control" name="desc" rows="6">
                                                  {!! $time->desc !!}
                                              </textarea>
                                        </div>
                                         <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Timeline Date</label>
                                           <div class="input-group">
                                            <input type="text" class="form-control form-control-inline input-medium date-picker" readonly name="date" value="{{$time->date}}">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                        </div>
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-lg btn-success" >Update</button>
                                    </div>
                                </form> 
                </div>
            </div>
        </div>
    </div>
@endsection