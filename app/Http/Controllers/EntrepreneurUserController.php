<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\EntrepreneurUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class EntrepreneurUserController extends Controller
{
    public function register()
    {
        return view('entrepreneur.register');
    }
    public function login()
    {
        return view('entrepreneur.login');
    }

    public function register_user(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:entrepreneur_users,email',
        'password' => 'required',
    ]);

        // If validation fails, redirect back with error messages and input data
        if ($validator->fails()) {
            return redirect()->route('entrepreneur_register')->withErrors($validator)->withInput();

        }
        $registerData = [
            'userName' => $request->userName,
            'location' => $request->location,
            'phoneNo' => $request->phoneNo,
            'email' => $request->email,
            'other' => $request->other,
            'password' => $request->password,
            'confirmPassword' => $request->confirmPassword,
        ];
        EntrepreneurUser::create($registerData);
        $this->showSweetAlert('success', 'Register Successful', 'Successfully Registered');
        return view('entrepreneur.login');

    }

    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Attempt to authenticate using the 'entrepreneur' guard
        if (Auth::guard('entrepreneur')->attempt(['email' => $email, 'password' => $password])) {
            $entrepreneurUser = EntrepreneurUser::where('email', $email)->first();
            Auth::guard('entrepreneur')->login($entrepreneurUser);
            $this->showSweetAlert('success', 'Login Successful', 'Successfully Logined');
            return redirect('entrepreneur_dashboard');
        } else {
            return back()->withErrors(['login' => 'Invalid credentials. Please try again.']);
        }
    }

            public function logout()
        {
            auth()->guard('entrepreneur')->logout();

            $this->showSweetAlert('success', 'Logout Successful', 'Successfully Logout');
            return redirect('/entrepreneur_login');
        }

        public function entrepreneur_profile()
        {
            $id = auth()->guard('entrepreneur')->user()->id;
            $user = EntrepreneurUser::find($id);
            return view('entrepreneur.profile.profile', compact('user'));
        }

        public function entrepreneur_profile_update(Request $request)
        {
            $id = auth()->guard('entrepreneur')->user()->id;
            $data = EntrepreneurUser::find($id);
            $data->userName = $request->userName;
            $data->location = $request->location;
            $data->phoneNo = $request->phoneNo;
            $data->email = $request->email;
            $data->other = $request->other;
            $data->password = $request->password;

            if ($request->file('picture')) {
                $file = $request->file('picture');
                $filename = now()->format('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('images/enterpreneur_images/'), $filename);
                $data['picture'] = $filename;
            }

            $data->save();
            return redirect('/entrepreneur_profile');
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
