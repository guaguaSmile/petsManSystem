<?php
/**
 * Created by PhpStorm.
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午1:53
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TreatmentController extends Controller
{
    public function index(int $id)
    {
        return view('admin.treatment.index');
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