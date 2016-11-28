<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    protected $id = 0;
    protected $tel = 0;
    protected $name = '';
    protected $information = [];

    public function id()
    {
        $this->id = session('teacher_id');
        return $this->id;
    }

    public function tel()
    {
    }

}

