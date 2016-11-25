<?php

namespace App\Http\Controllers\Admin;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return view('worker.site.index');
    }

    public function login(Request $request)
    {
        // 拦截
        $this->validate($request, [
            'tel' => 'bail|required|digits:11',
            'password' => 'bail|required',
        ]);
        $input = $request->all();

        // 过滤
        // 用户是否存在
        $worker = Worker::where('tel', $input['tel'])->first();
        if (empty($worker)) {
            return response()->json(['msg' => '用户不存在'], 403);
        }

        // 用户密码是否存在
        if (!$worker->isPasswordMatched($input['password'])) {
            return response()->json(['msg' => '密码错误'], 403);
        }

        // 执行
        $worker->iLoginSoIamVeryHappy();

        // session
        $worker->iLoginSoINeedSetSession($request);

        // 发送
        return response()->json([
            'msg' => '登录成功',
        ]);
    }

    public function logout(Request $request)
    {
        // 执行
        // 删除session记录
        $request->session()->clear();

        // 发送
        return response()->json(['msg' => 'ok']);
    }
}
