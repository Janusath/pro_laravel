<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.admin_dashboard');
    }
    public function register()
    {
        return view('admin.register');
    }
    public function login()
    {
        return view('admin.login');
    }


    public function register_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:admin_users,email',
            'password' => 'required|confirmed',
        ]);


        // If validation fails, redirect back with error messages and input data
        if ($validator->fails()) {
            return redirect()->route('admin_register')->withErrors($validator)->withInput();
        }

        $registerData = $request->all();
        $user = AdminUser::create($registerData);
        Auth::guard('admin_user')->login($user);
        $this->showSweetAlert('success', 'Register Successful', 'Successfully Registered');
        return view('admin.login');

    }

    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Attempt to authenticate using the 'web' guard (admin_users provider)
        if (Auth::guard('admin_user')->attempt(['email' => $email, 'password' => $password])) {
            $adminUser = AdminUser::where('email', $email)->first();
            Auth::guard('admin_user')->login($adminUser);
            $this->showSweetAlert('success', 'Login Successful', 'Successfully Logined');
            return redirect('/admin_dashboard');
        } else {
            return back()->withErrors(['login' => 'Invalid credentials. Please try again.']);
        }
    }


            public function logout()
        {
            auth()->guard('admin_user')->logout();

            $this->showSweetAlert('success', 'Logout Successful', 'Successfully Logout');
            return redirect('/admin_login');
        }

        public function admin_profile()
        {
            $admin = auth()->guard('admin_user')->user();
            return view('admin.profile.profile', compact('admin'));
        }

        public function admin_profile_update(Request $request)
        {
            $id = auth()->guard('admin_user')->user()->id;
            $data = AdminUser::find($id);
            $data->firstName = $request->firstName;
            $data->lastName = $request->lastName;
            $data->fullName = $request->fullName;
            $data->userName = $request->userName;
            

            if ($request->file('picture')) {
                $file = $request->file('picture');
                $filename = now()->format('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('images/admin_images'), $filename);
                $data['picture'] = $filename;
            }

            $data->save();
            return redirect('/admin_profile');
        }


       // Helper method to show SweetAlert notification
       private function showSweetAlert($type, $title, $message, $timer = 3000)
       {
           $alert = [
               'type' => $type,
               'title' => $title,
               'text' => $message,
               'timer' => $timer,
               'timerProgressBar' => true,
           ];

           Session::flash('sweet_alert', $alert);
       }

}
