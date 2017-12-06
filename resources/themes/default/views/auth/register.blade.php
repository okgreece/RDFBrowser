<!DOCTYPE html>
<html lang="en">
    @section('htmlheader')
        @include('auth.partials.head')
    @show
    <body>
        <main class="auth-main">
            <div class="auth-block">
                <h1>Sign up to RDFBrowser</h1>
                <a href="/login" class="auth-link">Already have a RDFBrowser? Sign in!</a>
                @include('auth.partials.register_form')
            </div>
        </main>
    </body>
</html>