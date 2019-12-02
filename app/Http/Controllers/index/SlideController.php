<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// use Illuminate\Support\Facades\Cache;
use \Cache;

class SlideController extends Controller
{
    //轮播图
    public function slide(){
    	$this->limit();
    	$data = DB::table('slide')->where(['is_show'=>1])->orderBy('s_weight','DESC')->get()->toArray();
    	return json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
    }

    // 接口防刷
    public function limit(){
    	// 同一个ip 一分钟只能调用60次
    	// 获取客户端ip
    	$ip = $_SERVER['REMOTE_ADDR'];
    	// 从缓冲读取次数 key ：pass_time_ip    1   缓冲时间 60s
        $cache_key = "pass_time_".$ip;
        $num = Cache::get($cache_key);
        if(!$num){
            $num = 0;
        }
        if($num >= 60){
            // 次数如果大于60 报错
            echo json_encode(['msg'=>"您的访问频繁"],JSON_UNESCAPED_UNICODE);die;
        }else{
            //不大于60 次数累加 正常访问
            $num += 1;
            Cache::put($cache_key,$num,60);
        }
        // return $num;
    }
}
