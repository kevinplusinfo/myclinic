<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showHashedPassword()
    {
        $hashedPassword = Hash::make('kevin');


        return view('admin.auth.login');
    }
}
