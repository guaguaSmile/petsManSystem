<?php
/**
 * Created by PhpStorm.
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午1:38
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TreatmentRecord extends Model
{
    protected $table = 'treatment_record';
    protected $fillable = ['pets_id', 'next_treatment_time', 'created_at', 'content', '_extra'];

    protected $hidden = ['updated_at'];
    public $timestamps = true;
//    protected $dateFormat = 'U';
}