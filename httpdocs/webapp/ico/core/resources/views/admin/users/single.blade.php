@extends('admin.layout.master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="col-md-6">
         <div class="caption">
          <i class="icon-list font-blue"></i>
          <span class="caption-subject font-green bold uppercase">User information</span> 
          <h3>{{ $user->name }}</h3> 
          <h5>Username: <b>{{ $user->username }}</b></h5>
        </div>
      </div>   
      <div class="col-md-3 pull-right">
       <div class="dashboard-stat purple">
        <div class="visual">
          <i class="fa fa-money"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="{{number_format(floatval($user->balance), $gnl->decimal, '.', '')}}">0</span> {{$gnl->cursym}} </div>
            <div class="desc">Balance</div>
          </div>
        </div>
      </div>
    </div>
    <div class="portlet-body">
      <div class="row">
        <div class="portlet box blue-ebonyclay">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-cogs"></i>Operations
            </div>
          </div>
          <div class="portlet-body">
                   <div class="row">
              <div class="col-md-6">
                <a href="{{route('email',$user->id)}}" class="btn btn-lg btn-block btn-primary" style="margin-bottom:10px;">Send Email</a>
              </div>
               <div class="col-md-6"> 
                <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#changepass">Change Password</button>        
              </div>

            </div> 

          </div>
        </div>
      </div>

      <div class="row">
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-user"></i>Update Profile</div>
            </div>
            <div class="portlet-body">
              <form id="form" method="POST" action="{{route('user.status', $user->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('put')}}
                <div class="form-group col-md-4">
                  <label>Users Name</label>
                  <input type="text" name="name" class="form-control input-sz" value="{{$user->name}}">
                </div>
                <div class="form-group col-md-4">
                  <label>Phone</label>
                  <input type="text" name="mobile" class="form-control input-sz" value="{{$user->mobile}}">
                </div>
                <div class="form-group col-md-4">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control input-sz" value="{{$user->email}}">
                </div>

                <div class="form-group col-md-3">
                  <label>User Status</label>
                  <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Deactive" type="checkbox" value="1" name="status" {{ $user->status == "1" ? 'checked' : '' }}> 
                </div> 
                <div class="form-group col-md-3">
                  <label>Google Authentication</label>
                  <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Deactive" type="checkbox" value="1" name="tauth" {{ $user->tauth == "1" ? 'checked' : '' }}> 
                </div> 
                <div class="form-group col-md-3">
                  <label>Email Verification</label>
                  <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No" type="checkbox" value="1" name="emailv" {{ $user->emailv == "1" ? 'checked' : '' }}> 
                </div>   
                <div class="form-group col-md-3">
                  <label>SMS Verification</label>
                  <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No" type="checkbox" value="1" name="smsv" {{ $user->smsv == "1" ? 'checked' : '' }}> 
                </div> 
                <hr/>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--Change Pass Modal -->
<div id="changepass" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
       <form role="form" method="POST" action="{{route('user.passchange', $user->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field('put')}}
       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>


                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group">

                                <button type="submit" class="btn btn-primary btn-block">
                                    Change Password
                                </button>
                        </div>
      </form>
    </div>

  </div>

</div>
</div>
@endsection

