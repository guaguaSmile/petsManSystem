<?php
/**
 * 宠物分类
 * User: collegedaily
 * Date: 2018/7/30
 * Time: 下午5:10
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $request;
    private $categoryModel;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->categoryModel = new Category();
    }

    public function getData()
    {
        $page = $this->request->input('page');
        $limit = 10;
        $skip = ($page - 1) > 0 ? ($page - 1)*$limit : 0;

        $categorys = $this->categoryModel->orderBy('id', 'desc')->skip($skip)->limit($limit)->get();

        return response()->json(['data' => $categorys]);
    }
}