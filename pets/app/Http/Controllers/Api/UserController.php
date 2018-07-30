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
}