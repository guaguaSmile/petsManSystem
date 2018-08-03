<?php
/**
 * 宠物信息模块
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午12:58
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Pets;
use App\Model\Category;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    private $request;
    private $petsModel;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->petsModel = new Pets();
    }

    public function index()
    {
        return view('admin.pets.index');
    }

    public function store()
    {
        return view('admin.pets.store');
    }

    public function detail()
    {
        return view('admin.pets.detail');
    }

    public function edit(int $id)
    {

    }

    public function delete($id)
    {

    }
}