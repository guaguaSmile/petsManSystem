<?php
/**
 * 用户模块
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午12:57
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pets.index');
    }

    public function store()
    {

    }

    public function edit(int $id)
    {

    }

    public function delete($id)
    {

    }
}