@extends('front.layouts.master')

@section('content')

     <div class="clearfix"></div>
  <div class="clearfix"></div>
 <section  class="circle-section section-padding section-background">
      <div class="container">
        <div class="row">
  
  <div class="col-md-6 col-md-offset-3">
          <div class="login-admin login-admin1">
            <div class="login-header text-center">
              <h6>Enter Email to Reset Password</h6>
            </div>
            <div class="login-form">

                    <form class="form-horizontal" method="POST" action="{{ route('forgot.pass') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <input id="email" type="email" placeholder="Enter Your Email" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                             <input value="Send Password Reset Link" type="submit">
                        </div>
                    </form>
                 </div>
          </div>
        </div>
</div>
</div>
</section>
@endsection
