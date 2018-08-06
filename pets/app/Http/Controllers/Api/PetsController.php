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
use App\Model\TreatmentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

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
        $page = $this->request->input('page');
        $page = is_numeric($page) ? $page : 0;
        $limit = 10;
        $skip = ($page -1 > 0) ? ($page -1)*$limit : 0;

        if ($hasKeyword) {
            $keyword = $this->request->input('keyword');
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('gender', $keyword);
        }
        if ($hasCategory) {
            $category = $this->request->input('category');
            $query->with(['category' => function ($sub) use ($category) {
                return $sub->where('id', $category);
            }]);
        }
        $category = Category::all();
        $pets = $query->with(['treatment'])->skip($skip)->limit($limit)->get();
        $count = ceil($query->count()/$limit);
        $count = ($count <= 0)? 1 : $count;
        return response()->json([
            'pets' => $pets,
            'category' => $category,
            'count' => $count,
        ]);
    }

    public function store()
    {
        $this->verify();
        $name = $this->request->input('name');
        $color = $this->request->input('color');
        $content = $this->request->input('content');
        $gender = $this->request->input('gender');
        $nextTreatmentTime = $this->request->input('next_treatment_time');
        $treatmentTime = $this->request->input('treatment_time');
        $user = $this->request->input('user');
        $categoryId = $this->request->input('category_id');

        $time = date('Y-m-d H:i:s');
        $treatmentRecordModel = new TreatmentRecord();
        $insertData = [
            'name' => $name,
            'color' => $color,
            'gender' => $gender,
            'user' => $user,
            'category_id' => $categoryId ?: null,
            'created_at' => $time,
            'updated_at' => $time,
        ];
        DB::beginTransaction();
        try {
            // 添加宠物信息
            $id = $this->petsModel->insertGetId($insertData);
            // 添加宠物治疗信息
            $treatmentRecordModel->pets_id = $id;
            $treatmentRecordModel->next_treatment_time = $nextTreatmentTime;
            $treatmentRecordModel->treatment_time = $treatmentTime;
            $treatmentRecordModel->created_at = $time;
            $treatmentRecordModel->content = $content;
            $treatmentRecordModel->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['code' => 1, 'data' => [], 'msg' => '程序异常']);
        }
        return response()->json(['code' => 0, 'data' => [], 'msg' => '']);
    }

    private function verify()
    {
        foreach ($this->request->all() as $field => $value) {
            if (!$value) {
                return response()->json(['code' => 1, 'data' => [], 'msg' => '信息填写不完整']);
            }
        }
    }

    public function detail(int $id)
    {
        $pet = $this->petsModel->with(['treatments'])->find($id);
        if (!$pet) {
            return response()->json(['code' => 1, 'data' => [], 'msg' => '非法请求']);
        }

        return response()->json(['code' => 0, 'data' => ['pet' => $pet], 'msg'=>'']);
    }

    public function edit($id)
    {
//        print_r($id);
//        print_r($this->request->all());die;
        $pet = $this->petsModel->find($id);
        if (!$pet) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'非法请求']);
        }
        // 获取治疗信息
        $treatomentRecord = (new TreatmentRecord())->getOneByPetsId($pet->id);
        if ($this->request->isMethod('get')) {
            $response = [
                'name' => $pet->name,
                'color' => $pet->color,
                'user' => $pet->user,
                'gender' => $pet->gender,
                'next_treatment_time' => $treatomentRecord->next_treatment_time,
                'treatment_time' => $treatomentRecord->treatment_time,
                'content' => $treatomentRecord->content,
            ];
            return response()->json(['code'=>0, 'data'=>$response, 'msg'=>'']);
        }
        // 更新pets，treatment
        $time = date('Y-m-d H:i:s');
        $pet->name = $this->request->input('name');
        $pet->color = $this->request->input('color');
        $pet->user = $this->request->input('user');
        $pet->gender = $this->request->input('gender');
        $pet->updated_at = $time;

        $treatomentRecord->next_treatment_time = $this->request->input('next_treatment_time');
        $treatomentRecord->treatment_time = $this->request->input('treatment_time');
        $treatomentRecord->content = $this->request->input('content');
        $treatomentRecord->updated_at = $time;
        DB::beginTransaction();
        try {
            $pet->save();
            $treatomentRecord->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('更新宠物信息失败', [$e->getFile(), $e->getLine(), $e->getMessage()]);
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'程序异常']);
        }

        return response()->json(['code'=>0, 'data'=>[], 'msg'=> '']);
    }

    public function delete(int $id)
    {
        $num = $this->petsModel->destroy($id);
        $num1 = (new TreatmentRecord())->where('pets_id', $id)->delete();
        if (!$num || !$num1) {
            return response()->json(['code'=>1, 'data'=>[], 'msg'=>'删除失败']);
        }
        return response()->json(['code'=>0, 'data'=>[], 'msg'=>'']);
    }
}