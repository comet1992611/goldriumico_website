@extends('layouts.app')

@section('content')
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/logo/bc.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <h2 class="text-uppercase text-center">Reset Password</h2>
                    <form method="POST" action="{{ route('forgot.pass') }}">
                        {{ csrf_field() }}
                                <input id="email" type="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
        
                              <input type="submit" value="Send Reset Link">
                    </form>
                       </div>
            </div>
        </div>
    </div>
</section>
@endsection
