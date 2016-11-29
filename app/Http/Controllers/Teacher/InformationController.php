<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherInformation;
use Illuminate\Http\Request;

class InformationController extends TeacherController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = TeacherInformation::where('teacher_id', $this->teacher_id)->first();
        return view('teacher.info.index', ['info' => $info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 拦截
        $this->validate($request, [
            'avatar' => 'required',
            'name' => 'required|between:2,6',
            'nickname' => 'required|between:2,6',
            'onjob' => 'required|boolean',
            'teaching_age' => 'required|integer',
            'gender' => 'required|boolean',
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
            'msg' => '保存成功',
            'info' => $info
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = TeacherInformation::find($id);
        return response()->json($info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required',
            'name' => 'required|between:2,6',
            'nickname' => 'required|between:2,6',
            'onjob' => 'required|boolean',
            'teaching_age' => 'required|integer',
            'gender' => 'required|boolean',
        ]);

        $info = TeacherInformation::find($id);
        if (empty($info)) {
            return response()->json(['msg' => '非法ID']);
        }

        $info->avatar = $request->input('avatar');
        $info->name = $request->input('name');
        $info->nickname = $request->input('name');
        $info->onjob = $request->input('onjob');
        $info->teaching_age = $request->input('teaching_age');
        $info->gender = $request->input('gender');
        $info->save();

        return response()->json([
            'msg' => '保存成功',
            'info' => $info
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = TeacherInformation::find($id);
        if (empty($info)) {
            return response()->json(['msg' => '非法ID']);
        }
        $info->delete();
        return response()->json(['msg' => '删除成功']);
    }
}
