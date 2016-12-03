<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherInformation;
use App\Models\TeacherStatistics;
use Illuminate\Http\Request;

class HomeController extends TeacherController
{
    public function index(Request $request)
    {
        return view('teacher.home.index');
    }

    public function my()
    {
        return view('teacher.home.my');
    }

    public function personal()
    {
        $info = TeacherInformation::where('teacher_id', $this->teacher_id)->first();
        $statistics = TeacherStatistics::where('teacher_id', $this->teacher_id)->first();
        // 触发自动更新
        if (empty($statistics)) {
            $statistics = TeacherStatistics::autoUpdateWhenEmpty($this->teacher_id);
        } else {
            $statistics->autoUpdate();
        }
        return view('teacher.home.personal', ['info' => $info, 'statistics' => $statistics]);
    }
}
