<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherHonour;
use Illuminate\Http\Request;

class HonourController extends TeacherController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $honours = TeacherHonour::where('teacher_id', $this->teacher_id)->orderBy('id', 'DESC')->take(10)->get();
        return view('teacher.honour.index', ['honours' => $honours]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.honour.create');
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
            'description' => 'required|between:20,255',
            'photos' => 'required|array'
        ]);

        $honour = TeacherHonour::where('teacher_id', $this->teacher_id)->where('description', $request->description)->first();
        if (!empty($honour)) {
            return response()->json(['msg' => '已添加无需重复添加'], 400);
        }

        $honour = new TeacherHonour();
        $honour->description = $request->description;
        $honour->teacher_id = $this->teacher_id;
        $honour->photos = json_encode($request->photos);
        $honour->save();

        return response()->json(['msg' => '保存成功', 'honour' => $honour]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(TeacherHonour::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $honour = TeacherHonour::find($id);
        if (empty($honour)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        return view('teacher.honour.edit', ['honour' => $honour]);
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
            'description' => 'required|between:20,255',
            'photos' => 'required|array'
        ]);

        $honour = TeacherHonour::find($id);
        if (empty($honour)) {
            return response()->json(['msg' => '非法ID'], 400);
        }

        $honour->description = $request->description;
        $honour->teacher_id = $this->teacher_id;
        $honour->photos = json_encode($request->photos);
        $honour->save();

        return response()->json(['msg' => '保存成功']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $honour = TeacherHonour::find($id);
        if (empty($honour)) {
            return response()->json(['msg' => '非法ID'], 400);
        }
        $honour->delete();
        return response()->json(['msg' => '删除成功']);
    }
}
