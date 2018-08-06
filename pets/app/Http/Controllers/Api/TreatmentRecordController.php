<?php
/**
 * 治疗记录
 * User: collegedaily
 * Date: 2018/8/6
 * Time: 下午12:57
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\TreatmentRecord;
use App\Model\Pets;
use Illuminate\Http\Request;

class TreatmentRecordController extends Controller
{
    private $request;
    private $treatmentModel;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->treatmentModel = new TreatmentRecord();
    }

    public function store()
    {
        $id = $this->request->input('id');
        $nextTreatmentTime = $this->request->input('next_treatment_time');
        $treatmentTime = $this->request->input('treatment_time');
        $content = $this->request->input('content');
        if(!Pets::find($id)) {
            return response()->json(['code' => 1, 'data' => [], 'msg' => '数据不存在']);
        }

        if (!$nextTreatmentTime || !$treatmentTime || !$content) {
            return response()->json(['code' => 1, 'data' => [], 'msg' => '治疗信息填写不完整']);
        }
        $time = date('Y-m-d H:i:s');
        $this->treatmentModel->next_treatment_time = $nextTreatmentTime;
        $this->treatmentModel->treatment_time = $treatmentTime;
        $this->treatmentModel->content = $content;
        $this->treatmentModel->pets_id = (int) $id;
        $this->treatmentModel->created_at = $time;
        $this->treatmentModel->updated_at = $time;
        if ($this->treatmentModel->save()) {
            return response()->json(['code' => 0, 'data' => [], 'msg' => '']);
        }

        return response()->json(['code' => 1, 'data' => [], 'msg' => '程序异常']);
    }

    public function delete($id)
    {
        if ($this->treatmentModel->destroy($id)) {
            return response()->json(['code' => 0, 'data' => [], 'msg' => '']);
        }

        return response()->json(['code' => 1, 'data' => [], 'msg' => '程序异常']);
    }
}