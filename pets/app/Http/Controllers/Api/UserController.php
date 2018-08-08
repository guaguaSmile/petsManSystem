<?php
/**
 * Created by PhpStorm.
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午3:30
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $requet;
    private $userModel;
    public function __construct(Request $request)
    {
        $this->requet = $request;
        $this->userModel = new User();
    }
    public function auth()
    {
        if (!Auth::check()) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'']);
        }
        $user = Auth::user();

        return response()->json(['code'=>0, 'data'=>$user->toArray(), 'msg'=>'']);
    }
    public function getData()
    {
        $page = $this->requet->input('page');
        $limit = 10;
        $skip = ($page - 1) > 0 ? ($page - 1)*$limit : 0;
        DB::enableQueryLog();
        $users = $this->userModel->orderBy('id', 'desc')->skip($skip)->limit($limit)->get();
//        print_r(DB::getQueryLog());die;
        return response()->json(['data'=> $users->toArray()]);
    }

    public function delete($id)
    {
        if ($this->userModel->destroy(intval($id))) {
            return response()->json(['code' => 0, 'data'=> [], 'msg'=> '']);
        }

        return response()->json(['code' => 1, 'data'=> [], 'msg'=> '程序异常']);
    }
}