<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticatedLogin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    
        $credentials = $request->only('email', 'password');

        if (Session::has('login_attempts') && Session::get('login_attempts') >= 3) {
            $last_attempt = Session::get('last_login_attempt');
            $diff_seconds = time() - $last_attempt;
    
            if ($diff_seconds < 30) {
                $remaining_seconds = 30 - $diff_seconds;
                return back()->withErrors([
                    'loginError' => 'You have reached the maximum number of login attempts. Please try again in '.$remaining_seconds.' seconds'
                ]);
            } else {
                Session::forget('login_attempts');
                Session::forget('last_login_attempt');
            }
        }
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Session::forget('login_attempts');
            Session::forget('last_login_attempt');
            
            return redirect('/dashboard');
        }
    
        $login_attempts = Session::get('login_attempts', 0) + 1;
        Session::put('login_attempts', $login_attempts);
        Session::put('last_login_attempt', time());
    
        return back()->withErrors([
            'loginError' => 'You have entered invalid credentials'
        ]);
    
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticatedRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'confirmed'],
        ], [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 10 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);
        
        $validator->after(function ($validator) use ($request) {
            $password = $request->input('password');
            if (!preg_match('/[a-z]/', $password)) {
                $validator->errors()->add('password', 'The password must contain at least one lowercase letter.');
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $validator->errors()->add('password', 'The password must contain at least one uppercase letter.');
            }
            if (!preg_match('/[0-9]/', $password)) {
                $validator->errors()->add('password', 'The password must contain at least one number.');
            }
            if (!preg_match('/[\^$.*+\[\]{}()?\-!"#%&\/:;<=>@\\_`|~]/', $password)) {
                $validator->errors()->add('password', 'The password must contain at least one symbol.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect('/login');
    }

    
}