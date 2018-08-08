<?php
/**
 * Created by PhpStorm.
 * User: collegedaily
 * Date: 2018/8/8
 * Time: 上午10:31
 */

namespace App\Http\Middleware;

use Closure;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->get('admin.login')) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'请登录']);
        }

        return $next;
    }
}