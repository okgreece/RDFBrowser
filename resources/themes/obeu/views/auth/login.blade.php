<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AnRDFBrowser Admin</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon-96x96.png">
        <link rel="stylesheet" href="{{ asset('/browser_assets/css/admin/vendor.css') }}">
        <link rel="stylesheet" href="{{ asset('/browser_assets/css/admin/auth.css') }}">
    </head>
    <body>
        <main class="auth-main">
            <div class="auth-block">
                <h1>Sign in to RDFBrowser</h1>
                @if(config('app.registration'))
                <a href="RDFBrowser/register" class="auth-link">New to RDFBrowser? Sign up!</a>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('RDFBrowser/login') }}">
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
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
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('RDFBrowser/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                        
                    </form>
                {!! Captcha::script() !!}
<!--                <div class="auth-sep">
                    <span>
                        <span>or Sign in with one click</span>
                            
                    </span>
                </div>
                <div class="al-share-auth">
                    <ul class="al-share clearfix">
                        <li><i class="socicon socicon-facebook" title="Share on Facebook"></i></li>
                        <li><i class="socicon socicon-twitter" title="Share on Twitter"></i></li>
                        <li><i class="socicon socicon-google" title="Share on Google Plus"></i></li>
                    </ul>
                </div>-->
            </div>
        </main>
    </body>
</html>