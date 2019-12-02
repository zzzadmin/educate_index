<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * 与模型关联的表名
     * @var string
     */
    protected $table = 'job';

    // 设置主键id
    protected $primaryKey = "job_id";

    /**
     * 指示模型是否自动维护时间戳
     * @var bool
     */
    public $timestamps = false;

    /**
     * 模型的连接名称
     *
     * @var string
     */
    protected $connection = 'educate';
}
