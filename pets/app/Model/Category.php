<?php
/**
 * 宠物表
 * User: collegedaily
 * Date: 2018/7/26
 * Time: 下午1:34
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Varieties extends Model
{
    protected $table = 'varieties';
    protected $fillable = ['name', 'pid'];

    protected $hidden = ['updated_at'];
    public $timestamps = true;
    protected $dateFormat = 'U';
}