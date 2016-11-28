<?php

namespace App\Http\Middleware;

use Closure;

class AuthTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $teacher_role = $request->session()->get('teacher_role');
        if (!$teacher_role) {
            return redirect(route('teacher.login'));
        }
        return $next($request);
    }
}
