You have requested to reset your password for your user account at {{env("APP_URL")}}. 

If it wasn't you, please ignore this message and nothing will happen. 

Click here to reset your password: <a href="{{ $link = url('RDFBrowser/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>