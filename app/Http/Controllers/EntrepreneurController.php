<?php

namespace App\Http\Controllers;
use App\Models\EntrepreneurUser;

use Illuminate\Http\Request;

class EntrepreneurController extends Controller
{
    public function index()
    {
        $id = auth()->guard('entrepreneur')->user()->id;
        $user = EntrepreneurUser::find($id);
        return view('entrepreneur.entrepreneur_dashboard', compact('user'));

    }
}
