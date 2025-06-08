<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\data_member; // Import model data_member
class MemberController extends Controller
{
    public function index()
    {
        $data = data_member::all();
        return view('member', compact('data'));
    }
}
