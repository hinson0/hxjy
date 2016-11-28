<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends TeacherController
{
    public function index(Request $request)
    {
        return view('teacher.home.index');
    }
}
