<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        echo '老师登录后的个人首页';exit;
        return view('teacher.home.index');
    }
}
