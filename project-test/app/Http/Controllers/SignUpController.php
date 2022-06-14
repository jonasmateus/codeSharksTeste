<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignUpController extends Controller
{

    public function show() {

        return view('sign-up');
    }

    public function createUser() {
                
        $attributes = request()->validate([
            'name'        => 'required|min:3|max:255|unique:users,name',
            'email'       => 'required|email|max:255|unique:users,email',
            'password'    => 'required|min:7|max:255'/* ,
            're-password' => 'required|min:7|max:255' */
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
/*         $repassword = bcrypt($attributes['re-password']);
 */
        /* if(strcmp($attributes['password'], $repassword) !== 0){
            return redirect('/')->with('fail', 'Passwords does NOT mache!');
        } */
        
        $isCreated =  User::create($attributes);

        if($isCreated) {
            return redirect('/')->with('success', 'Your account has been created.');
        }
        else {
            return redirect('/')->with('fail', 'Your account has NOT been created.');
        }
    }
}
