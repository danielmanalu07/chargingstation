<?php

namespace App\Http\Controllers\User;

use App\Models\ChargingSession;
use App\Models\Password_Reset;
use App\Models\User;
use App\Models\verify_user;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:password',
            ];
            $message = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email has already been taken',
                'email.email' => 'Email Invalid',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be minimum 6 characters',
                'confirm_password.required' => 'Confirm Password is required',
                'confirm_password.min' => 'Confirm Password must be minimum 6 characters',
                'confirm_password.same' => 'Password and Confirm Password must match',
            ];
            $this->validate($request, $rules, $message);

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            $token = Str::random(64);
            $verifyUrl = route('user.verify', ['token' => $token]);

            verify_user::create([
                'user_id' => $user->id,
                'token' => $token,
            ]);

            $mail_data = [
                'recipient' => $data['email'],
                'fromEmail' => env('MAIL_FROM_ADDRESS'),
                'fromName' => env('MAIL_FROM_NAME'),
                'subject' => 'Email Verification',
                'body' => 'Dear ' . $data['name'] . ',<br>Thanks for signing up. Please verify your email address to complete setting up your account.',
                'actionLink' => $verifyUrl,
            ];

            Mail::send('Mail.signup-email', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
            });

            return redirect('user/login')->with('success', 'Registration successful. Please check your email to verify your account.');
        }

        return view('user.auth.signup');
    }

    public function Verify(Request $request)
    {
        $token = $request->token;
        $verifyUser = verify_user::where('token', $token)->first();
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_verified) {
                $user->is_verified = 1;
                $user->email_verified_at = time();
                $user->remember_token = $token;
                $user->save();

                return redirect('user/login')->with('info', 'Your email is verified successfully. You can now login.');
            } else {
                return redirect('user/login')->with('info', 'Your email is already verified. You can now login.');
            }
        } else {
            return redirect('user/login')->with('error', 'Invalid verification link.');
        }
    }

    public function FormValidation(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|exists:users,email',
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
                'email.exists' => 'Email does not exist in our records',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user->is_verified == 1) {
                if ($user->name !== $request->name) {
                    return redirect()->back()->with('error', 'The name does not match the email');
                }

                $token = Str::random(64);
                $code = rand(100000, 999999);

                $passwordReset = Password_Reset::where('email', $request->email)->first();

                if ($passwordReset) {
                    // Update the existing record
                    $passwordReset->update([
                        'user_id' => $user->id,
                        'name' => $request->name,
                        'email' => $request->email,
                        'token' => $token,
                        'verification_code' => $code,
                        'verification_date' => Carbon::now(),
                    ]);
                } else {
                    // Create a new record
                    Password_Reset::create([
                        'user_id' => $user->id,
                        'name' => $request->name,
                        'email' => $request->email,
                        'token' => $token,
                        'verification_code' => $code,
                        'verification_date' => Carbon::now(),
                    ]);
                }

                $mailData = [
                    'recipient' => $request->email,
                    'fromEmail' => env('MAIL_FROM_ADDRESS'),
                    'fromName' => env('MAIL_FROM_NAME'),
                    'subject' => 'Verification Code',
                    'body' => 'Dear ' . $request->name . '<br>' . 'Your verification code is: ' . $code,
                ];

                Mail::send('Mail.verification-code', $mailData, function ($message) use ($mailData) {
                    $message->to($mailData['recipient'])
                        ->from($mailData['fromEmail'], $mailData['fromName'])
                        ->subject($mailData['subject']);
                });

                return redirect('/user/form-verification-code')->with('info', 'Your Verification Code Has Been Sent to Your Email Address. Please Check and Fill in Field Verification Code');
            } else {
                return redirect()->back()->with('error', 'This account has not been verified on your email address');
            }
        }
        return view('user.password.form_validation_forgot_password');
    }

    public function VerificationCode(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'verification_code' => 'required|numeric',
            ], [
                'verification_code.required' => 'Verification code is required',
                'verification_code.numeric' => 'Verification code must be a number',
            ]);

            $passwordReset = Password_Reset::where('verification_code', $request->verification_code)
                ->first();

            if (!$passwordReset) {
                return back()->withErrors(['verification_code' => 'Invalid verification code'])->withInput();
            }

            $verificationDate = Carbon::parse($passwordReset->verification_date);
            if ($verificationDate->diffInMinutes(Carbon::now()) > 2) {
                return back()->withErrors(['verification_code' => 'Verification code has expired'])->withInput();
            }

            return redirect('/user/reset-password');
        }
        return view('user.password.form_verify_code');
    }

    public function ResetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ], [
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 6 characters',
                'password.confirmed' => 'Password and Confirm Password must match',
            ]);

            $passwordReset = Password_Reset::first();
            if (!$passwordReset) {
                return back()->withErrors(['error' => 'Invalid reset request']);
            }

            $user = $passwordReset->user;
            if ($user->is_verified == 1) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect('/user/login')->with('success', 'Password reset successful. You can now log in with your new password.');
            } else {
                return back()->withErrors(['error' => 'User is not verified']);
            }
        }

        return view('user.password.reset_password');
    }

    public function Login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6',
            ];

            $message = [
                'email.required' => "Email is required",
                'email.email' => 'Email Invalid',
                'email.exists' => 'Email has no already',
                'password.required' => 'Password is required',
            ];
            $this->validate($request, $rules, $message);
            if (Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('/user/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid Login');
            }

        }
        return view('user.auth.login');
    }

    public function Dashboard()
    {
        return view('user.dashboard');
    }

    public function Logout()
    {
        Auth::guard('user')->logout();
        return redirect('/user/login');
    }

    public function MyCharging()
    {
        $user = Auth::guard('user')->user()->id;
        $my_charges = ChargingSession::where('user_id', $user)->get();
        return view('user.chargingsession.mycharging', compact('my_charges'));
    }

    public function CancelCharging($id)
    {
        $my_charges = ChargingSession::find($id);
        if ($my_charges->status != 0) {
            return redirect()->back()->with('error', 'tidak dapat dibatlkan');
        }
        $my_charges->delete();
        return redirect()->back()->with('success', 'Pemesanan berhasil dihapus.');
    }
}
