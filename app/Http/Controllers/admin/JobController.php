<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Job;
use App\Http\Model\Course;
use App\Http\Model\Catelog;
class JobController extends Controller
{
    // 添加作业
	public function job_add_do(Request $request){
    	$date=$request->all();
        $date['cou_id'] = 1;//课程id
        $date['catelog_id'] = 1;//章节id
        $date['create_time'] = time();
        if(empty($date['job_name']) || empty($date['job_content'])){
        	echo ("<script>alert('请输入完整信息');location='/admin/job/job_add'</script>");
        }
        $res = Job::insert($date);
        if($res){
    		echo ("<script>alert('添加成功,跳转到列表页面');location='/admin/job/job_list'</script>");
    	}else{
    		echo ("<script>alert('添加失败,系统错误');location='/admin/job/job_add'</script>");
    	}
    }
    // 作业列表
    public function job_list(){
        $date = Job::join('Course','Job.cou_id','=','Course.course_id')
        ->join('Catalog','Job.catelog_id','=','Catalog.catelog_id')
        ->where(['Job.cou_id'=>1])
        ->where(['Job.catelog_id'=>1])
        ->where(['Job.job_del'=>1])
        ->paginate(2);
        return view('admin.job.list',['date'=>$date]);
    }
    // 删除作业(软删除)
    public function job_del(Request $request){
        $job_id = $request->all()['job_id'];
        //修改状态
        $date = Job::where(['job_id'=>$job_id])->update(['job_del'=>2]);
        if($date){
            header("Refresh:2,url=/admin/job/job_list");
            die("删除成功,2秒后自动跳到展示页面");
        }else{
            echo ("<script>alert('添加失败,系统错误');location='/admin/job/job_list'</script>");
        }
    }
    // 作业修改
    public function job_update(Request $request){
        $job_id = $request->all()['job_id'];
        $info = Job::where(['job_id'=>$job_id])->first();
        return view('admin.job.update',['info'=>$info]);
    }

    // 作业修改执行
    public function job_update_do(Request $request){
        $data = $request->all();
        $res = Job::where(['job_id'=>$data['job_id']])->update([
            'job_name' => $data['job_name'],
            'job_content' => $data['job_content'],
        ]);
        if(!empty($res)){
            echo ("<script>alert('修改成功');location='/admin/job/job_list'</script>");
        }else{
            echo ("<script>alert('添加失败,系统错误');location='/admin/job/job_update'</script>");
        }
    }
}
