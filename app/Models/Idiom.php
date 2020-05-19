<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idiom extends Model
{
    protected $table = 'dt_idiom';

    protected $primaryKey = 'id';

    // 不自动维护created_at 和 updated_at 字段
    public $timestamps = false;

    /**
     * 允许修改和批量插入的属性
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 查询结果时 被隐藏的属性
     *
     * @var array
     */
    protected $hidden = [];
}
