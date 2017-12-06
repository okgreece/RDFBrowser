<!DOCTYPE html>
<html lang="en">
    @section('htmlheader')
        @include('auth.partials.head')
    @show
    <body>
        <main class="auth-main">
            <div class="auth-block">
                <h1>Sign in to RDFBrowser</h1>
                @if(config('app.registration'))
                    <a href="RDFBrowser/register" class="auth-link">New to RDFBrowser? Sign up!</a>
                @endif
                @include('auth.partials.login_form')
            </div>
        </main>
    </body>
</html>