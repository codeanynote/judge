<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\User;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';
    protected $userModel;

    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
        $userModel = new User();
    }

    public function username() {
        return 'email';
    }

    public function showLoginForm() {
        $page_title = 'Sign In';
        return view('auth.login', compact('page_title'));
    }

    protected function validateLogin(Request $request) {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ]);
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $userField = User::where($this->username(), '=', $request['email'])->first();

        if (!isset($userField)) {
            return redirect()->back()
                            ->withInput($request->only($this->username(), 'remember'))
                            ->withErrors([$this->username() => Lang::get('auth.approve_error'),
            ]);
        }
//
//        if ($userField->approve == 0) {
//            return redirect()->back()
//                            ->withInput($request->only($this->username(), 'remember'))
//                            ->withErrors([$this->username() => Lang::get('auth.approve_error'),
//            ]);
//        }
//        if ($userField != null && $userField->typeId == 1) {
//            return redirect()->back()
//                            ->withInput($request->only($this->username(), 'remember'))
//                            ->withErrors([$this->username() => Lang::get('auth.permission_error'),
//            ]);
//        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

}
