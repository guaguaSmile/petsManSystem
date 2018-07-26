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
    protected $fillable = ['name', 'gender', 'varieties', 'colour'];

    protected $hidden = ['updated_at'];
    public $timestamps = true;
    protected $dateFormat = 'U';
}