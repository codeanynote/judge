<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Libraries\ControllerHelper;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['jabber' => 'required|email',
            'username' => 'required',
            'captcha' => 'required|captcha',
        ]);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $user = User::where('username', $request['username'])->first();
        if($user == null){
            $errors = array("There is no that User");
            return redirect()->back()
                ->withInput($request->except('password'))
                ->withErrors($errors);
        }
        $newpassword = ControllerHelper::genPassword(10);
        $userModel = new User();
        $userModel->resetPassword($user['userId'], $newpassword);
        $messageU = "Hello, " . $userModel['username'] . ". You new password: \"" . $newpassword . "\"     |||     Login: " . route('auth.showlogin');

        Mail::send('auth.login', ['user' => $user], function ($m) use ($user, $messageU) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->jabber, $user->username)->subject($messageU);
        });

        return back()->with('status', 'Password have been sent your email!')
            ->withInput($request->except('password'));
    }
}
