<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ForgotController extends Controller
{
    public function show() {

        return view('forgot');
    }

    public function sendVerificationLink(Request $request) {

        $attributes = $request->validate([
            'email' => 'required|email'
        ]);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('sucess', 'Verification link sent')
            : back()->withErrors(['email' => 'Wrong email!']);
    }

    public function resetPasswordPage($code) {
        
        return view('reset-password', [
            'code' => $code
        ]);
    }

    public function resetPassword(Request $request) {

        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:7|max:255|confirmed'
        ]);
     
        $status = Password::reset(
            $request->only('password'),
            function ($user, $password) {

                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
            ? redirect('/')->with('sucess', 'Password reseted!')
            : back()->withErrors(['email' => 'Password NOT reseted!']);
    }
}
