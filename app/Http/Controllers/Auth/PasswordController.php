<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware());
    }
    
    protected function validateSendResetLinkEmail(Request $request)
    {
        $validators = [
            'email' => 'required|email',
            ];
        if(config('app.captcha')){
            array_add($validators, 'g-recaptcha-response', 'required|captcha');
        }
        $this->validate($request, $validators);
    }
    
    protected function getResetValidationRules()
    {
        $validators = [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
        if(config('app.captcha')){
            array_add($validators, 'g-recaptcha-response', 'required|captcha');
        }
        return $validators;
    }
}
