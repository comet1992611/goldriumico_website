@extends('layouts.user')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="panel panel-inverse">
                <div class="panel-heading">
                   <h4 class="panel-title">ICO Calender</h4>
                </div>
            <div class="panel-body">
        @foreach($nexts as $next)
            <div class="col-md-4">
                <div class="panel panel-{{$next->status == 1? 'success': 'inverse'}}">
                        <div class="panel-heading">
                           <h4 class="panel-title">{{$next->status == 1? 'Runing': 'Upcoming'}} ICO 
                           </h4>
                        </div>
                        <div class="panel-body text-center">
                            <ul class="list-group">
                                <li class="list-group-item">Price: <strong>{{$next->price}} USD</strong></li>
                                <li class="list-group-item">Start At: <strong>{{$next->start}}</strong></li>
                                <li class="list-group-item">End At: <strong>{{$next->end}}</strong></li>
                                <li class="list-group-item">Total Quantity: <strong>{{$next->quant}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">Sold: <strong>{{$next->sold}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">
                                      <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{round(($next->sold/$next->quant)*100,2)}}"
                                      aria-valuemin="0" aria-valuemax="100" style="width:{{round(($next->sold/$next->quant)*100,2)}}%">
                                      </div>
                                    </div>
                                    <span style="color:#0066cc;">{{round(($next->sold/$next->quant)*100,2)}}% Sold</span>
                                </li>
                            </ul>
                        </div>
                         @if($next->status==1)
                          <div class="panel-footer text-center">
                                <a class="btn btn-success btn-lg btn-block" href="{{route('buy.ico')}}">Buy Now</a>
                            </div>
                          @else
                          <div class="panel-footer text-center">
                                <a class="btn btn-warning btn-lg btn-block disabled" href="#">Coming...</a>
                            </div>
                        @endif
                    </div>
            </div>
        @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
