<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherExperience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Experience extends TeacherController
{
    public function show()
    {
        return view('teacher.exp.show');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|between:2,20',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'description' => 'required|between:20,255',
        ]);

        if (strtotime($request->input('end_time')) < strtotime($request->input('start_time'))) {
            return response()->json(['msg' => '起始时间应小于结束时间'], 400);
        }
        $exp = TeacherExperience::where('teacher_id', $this->teacher_id)->where('title', $request->input('title'))->first();
        if (!empty($exp)) {
            return response()->json(['msg' => '您已经发布过了,无需重新发布'], 400);
        }

        $exp = new TeacherExperience();
        $exp->teacher_id = $this->teacher_id;
        $exp->title = $request->input('title');
        $exp->start_time = strtotime($request->input('start_time'));
        $exp->end_time = strtotime($request->input('end_time'));
        $exp->description = $request->input('description');
        $exp->save();

        return response()->json(['msg' => '保存成功']);
    }
}
