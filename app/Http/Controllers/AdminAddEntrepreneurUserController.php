<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\EntrepreneurUser;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AdminAddEntrepreneurUserController extends Controller
{
    public function index()
    {

        $id = auth()->guard('admin_user')->user()->id;
        $admin = AdminUser::find($id);
        return view('admin.adminAddEnterpreneurUser.adminAddEnterpreneurUser', compact('admin'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ownerName' => 'required',
            'shopName' => 'required',
            'location' => 'required',
            'category' => 'required',
            'businessReNo' => 'required|unique:entrepreneur_users,businessReNo',
            'email' => 'required|email|unique:entrepreneur_users,email',
            'phoneNo' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);

        // If validation fails, redirect back with error messages and input data

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }


        // If validation passes, proceed with creating the user
        $registerData = [
            'userName' => $request->userName,
            'location' => $request->location,
            'other' => $request->other,
            'email' => $request->email,
            'phoneNo' => $request->phoneNo,
            'password' => $request->password,
            'confirmPassword' => $request->confirmPassword,

        ];

        EntrepreneurUser::create($registerData);
            return response()->json([
                'status' => 200,
            ]);
    }

    public function show()
    {
        $entrepreneurUser = EntrepreneurUser::all();
        $output = '';
        if ($entrepreneurUser->count() > 0) {
            $output .= ' <div class="table-responsive"> <table class="table table-striped table-sm text-center align-middle">

            <thead >
              <tr>
                <th>ID</th>
                <th>user Name</th>
                <th>Location</th>
                <th>Other</th>
                <th>Email</th>
                <th>Phone No</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($entrepreneurUser as $register) {
                $output .= '<tr>
                <td>' . $register->id . '</td>
                <td>' . $register->userName . '</td>
                <td>' . $register->location . '</td>
                <td>' . $register->other . '</td>
                <td>' . $register->email . '</td>
                <td>' . $register->phoneNo . '</td>
              </tr>';
            }
            $output .= '</tbody></table></div>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
}
