<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Models\TeacherExperience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExperienceController extends TeacherController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exps = TeacherExperience::where('teacher_id', $this->teacher_id)->simplePaginate(10);
        return view('teacher.exp.index', ['exps' => $exps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.exp.create');
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

        return response()->json(['msg' => '保存成功', 'exp' => $exp]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exp = TeacherExperience::find($id);
        return response()->json($exp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exp = TeacherExperience::find($id);
        if (empty($exp)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        return view('teacher.case.edit', ['exp' => $exp]);
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
            'title' => 'required|between:2,20',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'description' => 'required|between:20,255',
        ]);

        if (strtotime($request->input('end_time')) < strtotime($request->input('start_time'))) {
            return response()->json(['msg' => '起始时间应小于结束时间'], 400);
        }
        $exp = TeacherExperience::find($id);
        if (empty($exp)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        $exp->title = $request->input('title');
        $exp->start_time = strtotime($request->input('start_time'));
        $exp->end_time = strtotime($request->input('end_time'));
        $exp->description = $request->input('description');
        $exp->save();

        return response()->json(['msg' => '保存成功', 'exp' => $exp]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exp = TeacherExperience::find($id);
        if (empty($exp)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        $exp->delete();
        return response()->json(['msg' => '删除成功']);
    }
}
