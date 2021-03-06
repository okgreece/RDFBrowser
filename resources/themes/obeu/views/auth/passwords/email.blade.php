@extends('auth.skin')

<!-- Main Content -->
@section('content')
<h1>Reset Password</h1>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form class="form-horizontal" role="form" method="POST" action="{{ url('RDFBrowser/password/email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
        <div class="col-md-6 col-md-offset-4">
            {!! Captcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
            @endif
        </div>                                
    </div> 
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
            </button>
        </div>
    </div>

</form>

@endsection
{!! Captcha::script() !!}