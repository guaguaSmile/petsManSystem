<?php
/**
 * 宠物信息模块
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午12:58
 */

namespace App\Http\Controllers\Api;

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

    public function getData()
    {
        $query = Pets::query();
        $hasKeyword = $this->request->has('keyword');
        $hasCategory = $this->request->has('category');
        if ($hasKeyword) {
            $keyword = $this->request->input('keyword');
            $query->where('name', 'like', '%'.$keyword.'%')
                ->orWhere('gender', $keyword);
        }
        if ($hasCategory) {
            $category = $this->request->input('category');
            $query->with(['category' => function($sub) use($category) {
                return $sub->where('id', $category);
            }]);
        }
        $category = Category::all();
        $pets = $query->with(['treatment', 'user'])->get();
        return response()->json([
            'pets' => $pets,
            'category' => $category,
        ]);
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