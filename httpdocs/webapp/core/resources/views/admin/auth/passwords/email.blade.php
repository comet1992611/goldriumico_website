@extends('admin.layouts.admin')

<!-- Main Content -->
@section('content')

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="login-form" role="form" method="POST" action="{{ url('/admin/password/email') }}">
                        {{ csrf_field() }}
                    <h3 class="font-green">Enter Email Address</h3>


                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
                   <input id="email"  class="form-control placeholder-no-fix" type="text" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" autofocus>
                </div>
                  <div class="form-actions">
                    <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Send Password Reset Link</button>
                </div>
</form>

@endsection
