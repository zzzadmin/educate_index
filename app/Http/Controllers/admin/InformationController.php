<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Information;
/**
 * 咨询模块
 */
class InformationController extends Controller
{
    // 咨询添加视图
    public function information_add(Request $request){
        $date=$request->all();
        $date['info_time'] = time();
        if(empty($date['info_title'])){
        	echo ("<script>alert('请输入完整信息');location='/admin/information/info_add'</script>");
        }
        $res = Information::insert($date);
        if($res){
    		echo ("<script>alert('添加成功,跳转到列表页面');location='/admin/information/info_list'</script>");
    	}else{
    		echo ("<script>alert('添加失败,系统错误');location='/admin/information/info_add'</script>");
    	}
    }

    public function information_list(){
    	// 访问次数(热度、浏览次数)
        $redis = new \redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('info_hot');
        $info_hot = $redis->get('info_hot');
        // echo "访问次数".$info_hot;
        $date = Information::where(['is_del'=>1])->paginate(2);
        // dd($date);
        return view('admin.information.list',['date'=>$date,'info_hot'=>$info_hot]);
    }
    
    // 咨询删除(软删除)
    public function information_del(Request $request){
        $info_id = $request->all()['info_id'];
        //修改状态
        $date = Information::where(['info_id'=>$info_id])->update(['is_del'=>2]);
        if($date){
            header("Refresh:2,url=/admin/information/info_list");
            die("删除成功,2秒后自动跳到展示页面");
        }else{
        	echo ("<script>alert('添加失败,系统错误');location='/admin/information/info_list'</script>");
        }
    }

    // 咨询修改
    public function information_update(Request $request){
    	$data = $request->all();
    	$info = Information::where(['info_id'=>$data['info_id']])->first();
    	return view('admin.information.info_update',['info'=>$info]);
    }

    // 咨询修改执行
    public function information_update_do(Request $request){
    	$data = $request->all();
    	$res = Information::where(['info_id'=>$data['info_id']])->update([
    		'info_title' => $data['info_title'],
    		'info_content' => $data['info_content']
    	]);
    	if($res){
            echo ("<script>alert('修改成功');location='/admin/information/info_list'</script>");
        }else{
            echo ("<script>alert('添加失败,系统错误');location='/admin/information/info_list'</script>");
        }
    }
}
