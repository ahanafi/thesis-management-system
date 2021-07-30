<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $userType = $user->level;
    }

    public function change_password()
    {
        return view('auth.passwords.change');
    }
}
