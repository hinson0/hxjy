<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherCase;
use Illuminate\Http\Request;

class CaseController extends TeacherController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = TeacherCase::where('teacher_id', $this->teacher_id)->orderBy('id', 'DESC')->take(10)->get();
        return view('teacher.case.index', ['cases' => $cases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.case.create');
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
            'description' => 'required|between:20,255',
        ]);

        $case = TeacherCase::where('teacher_id', $this->teacher_id)->where('title', $request->input('title'))->first();
        if (!empty($case)) {
            return response()->json(['msg' => '案例已经存在,无需提交'], 400);
        }
        $case = new TeacherCase();
        $case->teacher_id = $this->teacher_id;
        $case->title = $request->input('title');
        $case->description = $request->input('description');
        $case->save();

        return response()->json(['msg' => '保存成功', 'case' => $case]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $case = TeacherCase::find($id);
        return response()->json($case);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case = TeacherCase::find($id);
        if (empty($case)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        return view('teacher.case.edit', ['case' => $case]);
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
            'description' => 'required|between:20,255',
        ]);

        $case = TeacherCase::find($id);
        if (empty($case)) {
            return response()->json(['msg' => '案例不存在'], 400);
        }

        $case->title = $request->title;
        $case->description = $request->description;
        $case->save();

        return response()->json(['msg' => '保存成功', 'case' => $case]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $case = TeacherCase::find($id);
        if (empty($case)) {
            return response()->json(['msg' => '案例不存在'], 400);
        }

        $case->delete();

        return response()->json(['msg' => '删除成功']);
    }
}
