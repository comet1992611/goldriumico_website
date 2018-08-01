@extends('layouts.app')

@section('content')
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/logo/bc.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="contact-form-wrapper">
       @if (Auth::user()->status != '1')
                    <h3 style="color: #cc0000;">Your account is Deactivated</h3>

       @elseif(Auth::user()->emailv != '1')
       <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-title text-center">Please verify your Email</div>
          <div class="card-body">
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
         <div class="card">
          <div class="card-title text-center">Verify Code</div>
          <div class="card-body">
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
       </div>
       @elseif(Auth::user()->smsv != '1')
             <div class="row">
        <div class="col-md-6">
        <div class="card">
          <div class="card-title text-center">Please verify your Mobile</div>
          <div class="card-body">
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
         <div class="card">
          <div class="card-title text-center">Verify Code</div>
          <div class="card-body">
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
    </div>
       @elseif(Auth::user()->tfver != '1')
      <div class="col-md-12">
         <div class="card">
          <div class="card-title text-center">Verify Google Authenticator Code</div>
          <div class="card-body">
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
    </div>
</section>

@endsection
         
            
         