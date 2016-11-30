<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherFeature;
use Illuminate\Http\Request;

class FeatureController extends TeacherController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = TeacherFeature::where('teacher_id', $this->teacher_id)->simplePaginate(10);
        return view('teacher.feature.index', $features);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.feature.create');
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
            'description' => 'required|between:20,255'
        ]);
        $feature = TeacherFeature::where('teacher_id', $this->teacher_id)->first();
        if (!empty($feature)) {
            return response()->json(['msg' => '已添加无需重复添加'], 400);
        }

        $feature = new TeacherFeature();
        $feature->teacher_id = $this->teacher_id;
        $feature->description = $request->input('description');
        $feature->save();

        return response()->json(['msg' => '保存成功', 'feature' => $feature]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feature = TeacherFeature::find($id);
        return response()->json($feature);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = TeacherFeature::find($id);
        if (empty($feature)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        return view('teacher.feature.edit', ['feature' => $feature]);
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
            'description' => 'required|between:20,255'
        ]);

        $feature = TeacherFeature::find($id);
        if (empty($feature)) {
            return response()->json(['msg' => '非法ID'], 400);
        }

        $feature->description = $request->description;
        $feature->save();

        return response()->json(['msg' => '保存成功', 'feature' => $feature]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 不提供删除功能

//        $feature = TeacherFeature::find($id);
//        if (empty($feature)) {
//            return response()->json(['msg' => '非法ID'], 400);
//        }
//
//        $feature->delete();
//
//        return response()->json(['msg' => '删除成功']);
    }
}
