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
                <!-- Your Page Content Here -->
                @yield('content')
            </div>
        </main>
    </body>
</html>