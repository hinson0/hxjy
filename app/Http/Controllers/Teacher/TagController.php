<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherTag;
use Illuminate\Http\Request;

class TagController extends TeacherController
{
    public function show()
    {
        $tags = TeacherTag::where('teacher_id', $this->teacher_id)->take(10)->get();
        return view('teacher.tag.show', ['tags' => $tags]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'tags' => 'required|array'
        ]);

        $tags = array_unique($request->tags);
        foreach ($tags as $name) {
            $tag = TeacherTag::where('teacher_id', $this->teacher_id)->where('name', $name)->first();
            if (!empty($tag)) {
                continue;
            }
            $tag = new TeacherTag();
            $tag->teacher_id = $this->teacher_id;
            $tag->name = $name;
            $tag->save();
        }

        return response()->json(['msg' => '保存成功']);
    }
}
