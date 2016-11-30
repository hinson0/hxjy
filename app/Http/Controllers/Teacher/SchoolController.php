<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends TeacherController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = TeacherSchool::where('teacher_id', $this->teacher_id)->orderBy('id', 'DESC')->take(10)->get();
        return view('teacher.school.index', ['schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.school.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'degree' => 'required',
            'major' => 'required',
        ]);

        if (strtotime($request->input('end_time')) < strtotime($request->input('start_time'))) {
            return response()->json(['msg' => '起始时间应小于结束时间'], 400);
        }
        $school = TeacherSchool::where('teacher_id', $this->teacher_id)->where('name', $request->name)->first();
        if (!empty($school)) {
            return response()->json(['msg' => '已经添加了,无需重复添加'], 400);
        }

        $school = new TeacherSchool();
        $school->teacher_id = $this->teacher_id;
        $school->name = $request->name;
        $school->start_time = strtotime($request->start_time);
        $school->end_time = strtotime($request->end_time);
        $school->major = $request->major;
        $school->degree = $request->degree;
        $school->save();

        return response()->json(['msg' => '保存成功', 'school' => $school]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(TeacherSchool::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = TeacherSchool::find($id);
        if (empty($school)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        return view('teacher.school.edit', ['school' => $school]);
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
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'degree' => 'required',
            'major' => 'required',
        ]);

        if (strtotime($request->input('end_time')) < strtotime($request->input('start_time'))) {
            return response()->json(['msg' => '起始时间应小于结束时间'], 400);
        }
        $school = TeacherSchool::find($id);
        if (empty($school)) {
            return response()->json(['msg' => '非法ID'], 400);
        }

        $school->name = $request->name;
        $school->start_time = strtotime($request->start_time);
        $school->end_time = strtotime($request->end_time);
        $school->major = $request->major;
        $school->degree = $request->degree;
        $school->save();

        return response()->json(['msg' => '保存成功', 'school' => $school]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = TeacherSchool::find($id);
        if (empty($school)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        $school->delete();
        return response()->json(['msg' => '删除成功']);
    }
}
