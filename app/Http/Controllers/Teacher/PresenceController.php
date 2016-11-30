<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherPresence;
use Illuminate\Http\Request;

class PresenceController extends TeacherController
{
    public function show()
    {
        $presences = TeacherPresence::where('teacher_id', $this->teacher_id)->take(10)->get();
        return view('teacher.presence.show', ['presences' => $presences]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'photos' => 'required|array'
        ]);

        $photos = array_unique($request->photos);

        foreach ($photos as $photo) {
            $presence = TeacherPresence::where('teacher_id', $this->teacher_id)->where('photo', $photo)->first();
            if (!empty($presence)) {
                continue;
            }
            $presence = new TeacherPresence();
            $presence->teacher_id = $this->teacher_id;
            $presence->photo = $photo;
            $presence->save();
        }

        return response()->json(['msg' => '保存成功']);
    }
}
