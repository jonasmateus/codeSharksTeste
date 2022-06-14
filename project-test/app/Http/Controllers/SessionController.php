<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function beginSession() {
        
        $attributes = request()->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($attributes)) {
            redirect('/')->with('sucess', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials!']);
    }

    public function endSession() {

        auth()->logout();
        return redirect('/')->with('sucess', 'See you next time!');
    }
}
