@extends('front.layouts.master')
@section('content')
   <section class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- breadcrumb Section Start -->
            <div class="breadcrumb-content">
              <h5>Log In</h5>
            </div>
            <!-- Breadcrumb section End -->
          </div>
        </div>
      </div>
    </section>



  <div class="clearfix"></div>


  <div class="clearfix"></div>



    <section  class="circle-section section-padding section-background">
      <div class="container">
        <div class="row">
  
  <div class="col-md-6 col-md-offset-3">
          <div class="login-admin login-admin1">
            <div class="login-header text-center">
              <h6>Login Form</h6>
            </div>
            <div class="login-form">
              <form method="POST" action="{{ route('postLogin') }}">
                  {{ csrf_field() }}

                  @if ($errors->has('username'))
                    <span class="help-block">
                      <strong>{{ $errors->first('username') }}</strong>
                  </span>
                  @endif
                  
                <input name="username" placeholder="Username" type="text" required>
                <input name="password" placeholder="Password" type="password">
                <input value="Login" type="submit">
              </form>
<div class="text-center" style="text-transform: uppercase;">
  <br><br>
                <a href="{{ route('password.request') }}">Forgot Password</a> | <a href="{{ route('register') }}">Register</a>
                <br><br>
</div>

            </div>
          </div>
        </div>
</div>
</div>
</section>


@endsection    
  