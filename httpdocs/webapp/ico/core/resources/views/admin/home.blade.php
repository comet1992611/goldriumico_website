@extends('admin.layout.master')

@section('content')
@php
   $totalusers = \App\User::where('status',1)->count();
   $banusers = \App\User::where('status',0)->count();
   $sell = \App\Sell::where('status',1)->sum('amount');
   $icos = \App\Ico::where('status','!=',3)->get();
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users"></i> USERS STATISTICS </div>
                </div>
                <div class="portlet-body text-center">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$totalusers}}">{{$totalusers}}</span>
                                    </div>
                                    <div class="desc"> Total User </div>
                                </div>
                                <a class="more" href="{{route('users')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                       
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$banusers}}">{{$banusers}}</span>
                                    </div>
                                    <div class="desc"> Banned Users </div>
                                </div>
                                <a class="more" href="{{route('users')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$sell}}">{{$sell}}</span>
                                    </div>
                                    <div class="desc"> Total Sell </div>
                                </div>
                                <a class="more" href="{{route('sellLog')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-calendar"></i>ICO Calendar</div>
                </div>
 
               <div class="portlet-body text-center">
                        <div class="row">
        @foreach($icos as $ico)
            <div class="col-md-4">
                <div class="panel panel-{{$ico->status == 1? 'success': 'warning'}}">
                        <div class="panel-heading">
                           <h4 class="panel-title">{{$ico->status == 1? 'Runing': 'Upcoming'}} ICO 
                           </h4>
                        </div>
                        <div class="panel-body text-center">
                            <ul class="list-group">
                                <li class="list-group-item">Price: <strong>{{$ico->price}} USD</strong></li>
                                <li class="list-group-item">Start At: <strong>{{$ico->start}}</strong></li>
                                <li class="list-group-item">End At: <strong>{{$ico->end}}</strong></li>
                                <li class="list-group-item">Total Quantity: <strong>{{$ico->quant}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">Sold: <strong>{{$ico->sold}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">
                                      <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{round(($ico->sold/$ico->quant)*100,2)}}"
                                      aria-valuemin="0" aria-valuemax="100" style="width:{{round(($ico->sold/$ico->quant)*100,2)}}%">
                                      </div>
                                    </div>
                                    <span style="color:#0066cc;">{{round(($ico->sold/$ico->quant)*100,2)}}% Sold</span>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        @endforeach
                             
        </div>   
                </div>

        </div>
    </div>
</div>
@endsection





