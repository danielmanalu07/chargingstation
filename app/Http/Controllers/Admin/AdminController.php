<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            $messages = [
                'username.required' => 'Username is required',
                'password.required' => 'Password is required',
            ];

            $this->validate($request, $rules, $messages);

            if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password']])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        }
        return view('admin.auth.login');
    }

    public function Dashboard()
    {
        return view('admin.layout.dashboard');
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
