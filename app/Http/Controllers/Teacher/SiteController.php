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

    public function doreg(Request $request)
    {
        // input
        $this->validate($request, [
            'tel' => ['required', 'regex:/^(1[\d]{10})$/'],
            'password' => 'bail|required',
        ]);

        $input = $request->all();

        // 校验
        $teacher = Teacher::where('tel', $input['tel'])->first();
        if (!empty($teacher)) {
            return response()->json(['msg' => '手机号已经注册,请更换手机号或者找回密码']);
        }

        // 执行
        $teacher = new Teacher();
        $teacher->tel = $input['tel'];
        $teacher->password = $input['password'];
        $teacher->save();

        $teacher->iLoginSoIamVeryHappy();
        $teacher->IamATeacher($request);

        // 提示
        return response()->json([
            'msg' => '注册成功'
        ]);
    }

    public function login(Request $request)
    {
        if ($request->session()->get('teacher_role')) {
            return redirect(route('teacher.home'));
        }

        return view('teacher.site.login');
    }

    public function dologin(Request $request)
    {
        if ($request->session()->get('teacher_role')) {
            return response()->json(['msg' => '登录成功']);
        }

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
