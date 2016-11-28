<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Teacher extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $dateFormat = 'U';

    public function isPasswordMatched($password)
    {
        return $this->password === $password; // 后期可以考虑增加salt字段的验证
    }

    public function iLoginSoIamVeryHappy() // 我登录成功啦
    {
        $this->last_activity_time = time();
        $this->login_times += 1;
        $this->save();
    }

    public function IamATeacher(Request $request) // 记录session
    {
        $request->session()->set('teacher_role', true);
        $request->session()->set('teacher_id', $this->id);
    }

}
