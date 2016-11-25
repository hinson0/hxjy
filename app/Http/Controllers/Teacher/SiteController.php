<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return view('teacher.site.index');
    }

    public function reg()
    {
        return view('teacher.site.reg');
    }

    public function login()
    {
        return view('teacher.site.login');
    }

    public function dologin(Request $request)
    {
        // 拦截
        $this->validate($request, [
            'tel' => 'bail|required|digits:11',
            'password' => 'bail|required',
        ]);
        $input = $request->all();

        // 过滤
        // 用户是否存在
        $teacher = Teacher::where('tel', $input['tel'])->first();
        if (empty($teacher)) {
            return response()->json(['msg' => '账号不存在'], 403);
        }

        // 用户密码是否存在
        if (!$teacher->isPasswordMatched($input['password'])) {
            return response()->json(['msg' => '密码错误'], 403);
        }

        // 执行
        $teacher->iLoginSoIamVeryHappy();

        // session
        $teacher->IamATeacher($request);

        // 发送
        return response()->json([
            'msg' => '登录成功',
        ]);
    }

    public function dologout(Request $request)
    {
        // 执行
        // 删除session记录
        $request->session()->forget('teacher_role');

        // 发送
        return response()->json(['msg' => 'ok']);
    }

    public function test(Request $request)
    {
//        $request->session()->clear();
        var_dump($request->session()->all());exit;
    }

}
