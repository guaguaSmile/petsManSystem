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
        $hasKeyword = $this->request->input('keyword');
        $query = $this->categoryModel->newQuery();
        if ($hasKeyword) {
            $query->where('name', 'like', '%'.$hasKeyword.'%');
        }
        $limit = 10;
        $skip = ($page - 1) > 0 ? ($page - 1)*$limit : 0;

        $categorys = $query->orderBy('id', 'desc')
            ->skip($skip)->limit($limit)->get();
        $count = $query->count();
        $count = $count/$limit > 0 ? ceil($count/$limit) : 0;
        return response()->json([
            'data' => $categorys,
            'count' => $count
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        // 获取pid=null的分类
        if ($this->request->isMethod('get')) {
            $categorys = $this->categoryModel->getCategory();
            return response()->json(['code'=>0, 'data'=> $categorys, 'msg'=>'']);
        }
        $name = $this->request->input('name');
        $pid = $this->request->input('pid');
        if (!$name) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'请填写分类名']);
        }
        $time = date('Y-m-d H:i:s');
        $this->categoryModel->name = $name;
        $this->categoryModel->pid = $pid ? : null;
        $this->categoryModel->created_at = $time;
        $this->categoryModel->updated_at = $time;
        if (!$this->categoryModel->save()) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'程序异常']);
        }

        return response()->json(['code'=>0, 'data'=>[], 'msg'=>'']);
    }

    public function edit(int $id)
    {

    }

    public function delete(int $id)
    {
        $num = $this->categoryModel->destroy($id);
        if (!$num) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'删除失败']);
        }

        return response()->json(['code'=>0, 'data'=>[], 'msg'=>'']);
    }

    public function getParentCategory()
    {
        $categorys = $this->categoryModel->getParentCategory();

        return response()->json(['code'=>0, 'data'=>$categorys->toArray(), 'msg'=>'']);
    }

    public function getSubCategory()
    {
        $id = $this->request->input('id');

        $subCategorys = $this->categoryModel->getSubCategoryById($id);
        return response()->json(['code'=>0, 'data'=>$subCategorys, 'msg'=>'']);
    }

}