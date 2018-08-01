@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Price Timeline</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle  btn-primary"  href="{{route('timeline.add')}}">
                           <i class="icon-plus"></i> New Price Timeline
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> Timeline Title </th>
                                <th> Timeline Details</th>
                                <th> Timeline Date </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($times as $time)
                            <tr>
                                <td>{{$time->title}}</td>
                                <td> {!! $time->desc !!} </td>
                                <td> {{$time->date}} </td>
                                <td>
                                  <a class="btn btn-circle btn-icon-only btn-warning" href="{{ route('timeline.edit', $time->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-danger"  href="{{ route('timeline.destroy', $time)}}" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Timeline?">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                  
@endsection