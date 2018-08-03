<?php
/**
 * 处理用户登录
 * User: collegedaily
 * Date: 2018/8/2
 * Time: 下午4:09
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    private $request;
    private $auth;
    public function __construct(Request $request, Guard $auth)
    {
        $this->request = $request;
        $this->auth = $auth;
    }

    public function login()
    {
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        if (!$username || !$password) {
            return response()->json(['code' => 1, 'data'=>[], 'msg' => '请填写用户名或密码' ]);
        }
        // 查询用户是否存在
        $credentails = [
            'username' => $username,
            'password' => $password
        ];
        if (!$this->auth->attempt($credentails)) {
            return response()->json(['code' => 1, 'data'=>[], 'msg' => '用户不存在' ]);
        }
        // 设置登录状态为 bool=>true
        session()->put('admin.login', true);
        return response()->json(['code' => 0, 'data' => [], 'msg' => '']);
    }

    public function logout()
    {
        session()->forget('admin.login');
        return response()->json(['code' => 0, 'data' => [], 'msg' => '']);
    }
}