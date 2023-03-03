<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService{

    public function create($email,$password,$username){

        $user_id = Str::uuid();
        $user = new User;
        $user->id = $user_id;
        $user->email = $email;
        $user->first_name="Anynomous";
        $user->last_name="Anynomous";
        $user->username=$username;
        $user->password = Hash::make($password);
        $user->save();
        return $user;
    }

    public function verifyUser($email,$password){
        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::attempt($credentials)) {
            // User exists with given email and password
            return true;
        } else {
            // User doesn't exist with given email and password
            return false;
        }
    }
}