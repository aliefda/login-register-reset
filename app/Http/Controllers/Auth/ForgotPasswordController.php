<?php 
  
namespace App\Http\Controllers\Auth; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
  
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'password' => ['required', 'string', 'min:10', 'confirmed'],
            'password_confirmation' => ['required'],
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
  
        $passwordReset = DB::table('password_resets')
        ->where('token', $request->token)
        ->first();
  
        if (!$passwordReset) {
            return redirect()->back()->withErrors(['email' => 'Invalid token'])->withInput();
        }
  
        $user = User::where('email', $passwordReset->email)->first();
        
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Invalid email'])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $passwordReset->email)->delete();
  
        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}