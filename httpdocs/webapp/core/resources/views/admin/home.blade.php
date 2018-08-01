@extends('admin.layouts.master')

@section('content')

                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                        
                    </div>

                    <h3 class="page-title"> Dashboard 
                        <small>dashboard & statistics </small>
                    </h3>

                    <div class="clearfix"></div>

                     <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$totalusers}}">0</span>
                                    </div>
                                    <div class="desc"> Total User </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                       <span data-counter="counterup" 
                                        data-value="{{$depositreq}}">0</span>
                                    </div>
                                    <div class="desc"> Deposit Request</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{$withdrawreq}}">0</span>
                                    </div>
                                    <div class="desc"> Withdraw Request </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection