<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherInformation;
use Illuminate\Http\Request;

class InformationController extends TeacherController
{
    public function show()
    {
        $info = TeacherInformation::where('teacher_id', $this->teacher_id)->first();
        return view('teacher.info.show', ['info' => $info]);
    }

    public function save(Request $request)
    {
        // 拦截
        $this->validate($request, [
            'avatar' => 'required',
            'name' => 'required|between:2,6',
            'nickname' => 'required|between:2,6',
            'onjob' => 'required|integer',
            'teaching_age' => 'required|integer',
            'gender' => 'required|integer',
        ]);

        // 执行
        $info = TeacherInformation::where('teacher_id', $this->teacher_id)->first();
        if (empty($info)) {
            $info = new TeacherInformation();
        }
        $info->teacher_id = $this->teacher_id;
        $info->avatar = $request->input('avatar');
        $info->name = $request->input('name');
        $info->nickname = $request->input('name');
        $info->onjob = $request->input('onjob');
        $info->teaching_age = $request->input('teaching_age');
        $info->gender = $request->input('gender');
        $info->save();

        // 提示
        return response()->json([
            'msg' => '保存成功'
        ]);
    }
}
