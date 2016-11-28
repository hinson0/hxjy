<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    public function show()
    {
        $feature = TeacherFeature::where('teacher_id', $this->teacher_id)->first();
        return view('teacher.feature.show', ['feature' => $feature]);
    }
    public function save(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|between:20,255'
        ]);

        $feature = TeacherFeature::where('teacher_id', $this->teacher_id)->first();
        if (empty($feature)) {
            $feature = new TeacherFeature();
        }
        $feature->teacher_id = $this->teacher_id;
        $feature->description = $request->input('description');
        $feature->save();

        return response()->json(['msg' => '保存成功']);
    }
}
