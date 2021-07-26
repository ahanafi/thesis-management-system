<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return void
     *
     */
    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /*
     * Change email to username
     * Default laravel is email
     * */
    public function username(): string
    {
        return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = $this->redirectTo();

    protected function redirectTo()
    {
        $redirectPath = RouteServiceProvider::HOME;

        if (auth()->user()->level === User::STUDENT) {
            $redirectPath = route('student.index');
        } else if (auth()->user()->level === User::STUDY_PROGRAM_LEADER) {
            $redirectPath = route('leader.index');
        } else if (auth()->user()->level === User::LECTURER) {
            $redirectPath = route('lecturer.index');
        } else if (auth()->user()->level === User::ACADEMIC_STAFF) {
            $redirectPath = route('academic-staff.index');
        }

        return $redirectPath;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
