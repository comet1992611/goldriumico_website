@extends('front.layouts.master')

@section('content')
<div class="container section-padding" style="min-height: 80%;">
    <div class="row">
  <div class="col-md-8 col-md-offset-2">
          <div class="login-admin login-admin1">
            <div class="login-header text-center">
              <h6>Reset Password</h6>
            </div>
            <div class="login-form">
                <form class="form-horizontal" method="POST" action="{{ route('reset.passw') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $reset->token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" value="{{ $reset->email }}" required readonly>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password"  name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                             <input value="Submit" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
