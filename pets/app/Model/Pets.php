<?php
/**
 * 宠物表
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午1:34
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $table = 'pets';
    protected $fillable = ['name', 'user_id', 'gender', 'category_id', 'color', 'treatment_record_id'];

    protected $hidden = ['updated_at'];
    public $timestamps = true;
//    protected $dateFormat = 'U';


    public function category()
    {
        return $this->belongsTo('App\Model\Category')
            ->where('pid', null);
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');

    }

    public function treatment()
    {
        return $this->hasMany('App\Model\TreatmentRecord', 'id', 'pets_id');
    }
}