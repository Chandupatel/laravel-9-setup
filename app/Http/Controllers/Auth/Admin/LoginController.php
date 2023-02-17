<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        return redirect()->route('admin.dashboard')->with('success', trans('backend_messages.auth.admin.login.login_success'));
    }

    public function forgotPassword()
    {
        return view('auth.admin.forgot-password');
    }

    public function submitForgotPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user = Admin::where('email', $request->email)->first();
        if ($user) {
            $token = Str::random(50);
            $user->remember_token = $token;

            $mail_data = [
                'email' => $user->email,
                'link' => route('admin.reset-password', $token),
                'to_name' => $user->name,
                'subject' => 'Reset Password Request.',
            ];
            $this->sendMail('emails.auth.admin-forgot-password', $mail_data);
            if ($user->save()) {
                return redirect()->route('admin.login')->with('success', trans('backend_messages.auth.admin.forgot_password.forgot_password_success'));
            } else {
                return redirect()->back()->with('error', trans('backend_messages.something_has_went_wrong'));
            }
        } else {
            return redirect()->back()->with('error', trans('backend_messages.something_has_went_wrong'));
        }
    }

    public function resetPassword($token)
    {
        return view('auth.admin.reset-password', compact('token'));
    }

    public function submitResetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Admin::where('remember_token', $request->token)->first();
        if ($user) {
            $user->remember_token = null;
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return redirect()->route('admin.login')->with('success', trans('backend_messages.auth.admin.reset_password.reset_password_success'));
            } else {
                return redirect()->back()->with('error', trans('backend_messages.something_has_went_wrong'));
            }
        } else {
            return redirect()->back()->with('error', trans('backend_messages.something_has_went_wrong'));
        }
    }
}
