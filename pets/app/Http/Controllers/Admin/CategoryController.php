<?php
/**
 * 品种综合
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午1:43
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function store()
    {
        return view('admin.category.store');
    }

    public function edit(int $id)
    {

    }

    public function delete($id)
    {

    }
}