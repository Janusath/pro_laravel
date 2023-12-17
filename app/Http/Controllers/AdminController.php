<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;

use App\Models\EntrepreneurUser;

class AdminController extends Controller
{
    public function index()
    {
        $data['TotalAdminCount'] = AdminUser::count();
        $data['TotalEntrepreneurUserCount'] = EntrepreneurUser::count();

        $id = auth()->guard('admin_user')->user()->id;
        $admin = AdminUser::find($id);
        return view('admin.admin_dashboard', compact('admin', 'data'));
    }



}
