@extends('layouts.app')

@section('content')
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/logo/bc.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h2 class="text-uppercase text-center">Sign In</h2>
                   <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                 <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                
                                <input id="password" type="password" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <a href="{{route('password.request')}}">Forgot Password?</a>
                            </div>
                        </div>
                        <input type="submit" value="Log In">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
