<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function __get($key)
    {
        if (empty(session($key))) {
            throw new \Exception('获取不到的属性值');
        }
        return session($key);
    }
}

