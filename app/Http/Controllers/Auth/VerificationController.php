<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify($id)
    {
        $user = User::findorFail($id);

        $user->update([
            'email_verified_at' => now()
        ]);

        return redirect('/home');
    } 
}
