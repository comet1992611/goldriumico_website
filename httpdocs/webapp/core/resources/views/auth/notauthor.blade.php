@extends('front.layouts.master')

@section('content')
  <div class="clearfix"></div>
  <div class="clearfix"></div>
  <section  class="circle-section section-padding section-background">
      <div class="container">
        <div class="row">
  
  <div class="col-md-12">
       @if (Auth::user()->status != '1')
              <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-danger text-center">
                  <div class="panel-heading">
                    <h3 style="color: #cc0000;">Your account is Deactivated</h3>
                  </div>                   
                </div>               
              </div> 
       @elseif(Auth::user()->emailv != '1')
      <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Please verify your Email</div>
          <div class="panel-body">
             <p>Your Email address:</p>
            <h3>{{Auth::user()->email}}</h3>
            <form action="{{route('sendemailver')}}" method="POST">
              {{csrf_field()}}
              <button type="submit" class="btn btn-lg btn-block btn-primary">Send Verification Code</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
         <div class="panel panel-primary">
          <div class="panel-heading">Verify Code</div>
          <div class="panel-body">
            <form action="{{route('emailverify') }}" method="POST">
              {{csrf_field()}}
              <div class="form-group">
                <input type="text"  name="code" placeholder="Enter Verification Code">
              </div>
               <div class="form-group">
                <button type="submit" class="btn btn-lg btn-block btn-success">Verify</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       @elseif(Auth::user()->smsv != '1')
        <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Please verify your Mobile</div>
          <div class="panel-body">
             <p>Your Mobile no:</p>
            <h3>{{Auth::user()->mobile}}</h3>
            <form action="{{route('sendsmsver')}}" method="POST">
              {{csrf_field()}}
              <button type="submit" class="btn btn-lg btn-block btn-primary">Send Verification Code</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
         <div class="panel panel-primary">
          <div class="panel-heading">Verify Code</div>
          <div class="panel-body">
            <form action="{{route('smsverify') }}" method="POST">
              {{csrf_field()}}
              <div class="form-group">
                <input type="text"  name="code" placeholder="Enter Verification Code">
              </div>
               <div class="form-group">
                <button type="submit" class="btn btn-block btn-lg btn-success">Verify</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       @elseif(Auth::user()->tfav != '1')
      <div class="col-md-8 col-md-offset-2">
         <div class="panel panel-primary">
          <div class="panel-heading">Verify Google Authenticator Code</div>
          <div class="panel-body">
            <form action="{{route('go2fa.verify') }}" method="POST">
              {{csrf_field()}}
              <div class="form-group">
                <input type="text" name="code" placeholder="Enter Google Authenticator Code"> 
              </div>
               <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success btn-block">Verify</button>
              </div>
            </form>
          </div>
        </div>
      </div>
          @endif
</div>
</div>
</div>
</section>

@endsection
         
            
         