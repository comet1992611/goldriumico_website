@extends('layouts.app')

@section('content')
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/logo/bc.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h2 class="text-uppercase text-center">Sign In</h2>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                    @if(isset($reference))
                        <input type="hidden" name="refer" value="{{$reference}}">
                    @endif
                     <div class="row">
                            <div class="col-lg-12">
                                <input id="name" type="text" placeholder="Your Name" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
       

                       
                                <input id="username" type="text" placeholder="Username" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                          
                                <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <input id="mobile" type="text" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}" required>

                                @if($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                        
                                <input id="password" type="password" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                       
                                <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                            </div>
                        </div>

                        <input type="submit" value="Sign Up">
                    </form>
               </div>
            </div>
        </div>
    </div>
</section>
@endsection
