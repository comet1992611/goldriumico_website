@extends('layouts.app')

@section('content')
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/logo/bc.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h2 class="text-uppercase text-center">Reset Password</h2>
                    <form  method="POST" action="{{ route('reset.passw') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $reset->token }}">
                                <input id="email" type="email" name="email" value="{{ $reset->email }}" required autofocus readonly>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    
                                <input id="password" type="password" placeholder="New Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        
                                <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                <input type="submit" value="Reset Password">
                            </form>
                 </div>
            </div>
        </div>
    </div>
</section>
@endsection
