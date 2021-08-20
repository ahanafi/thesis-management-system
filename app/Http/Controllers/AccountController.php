<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function profile()
    {
        $student = null;
        if (auth()->user()->level === User::STUDENT) {
            $student = auth()->user()->studentProfile;
        }
        return view('account.profile', compact('student'));
    }

    public function changePassword()
    {
        return view('account.change-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validated = $request->validated();
        $user = auth()->user();
        $user->password = Hash::make($validated['new_password']);

        if ($user->save()) {
            $message = setFlashMessage('success', 'update', 'password');
        } else {
            $message = setFlashMessage('error', 'update', 'password');
        }

        return redirect()->route('account.profile')->with('message', $message);
    }
}
