<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Course;
use App\Http\Model\Question;
/**
 * 问答模块---左海涛
 */
class QuestionController extends Controller
{
	// 获取课程
    public function gteCourse(){
    	$data = Course::get()->toArray();
    	return json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
    }

    // 提问
    public function askQuestion(Request $request){
    	$data = $request->all();
    	if(empty($data['q_title']) || empty($data['q_content']) ){
    		return json_encode(['code'=>202,'msg'=>'参数不能为空'],JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODE解析中文
    	}
    	$res = Question::insert([
    		'cou_id' => $data['course_id'],
    		'q_title' => $data['q_title'],
    		'q_content' => $data['q_content'],
    		'q_time'=>time()
    	]);
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'添加成功'],JSON_UNESCAPED_UNICODE);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'添加失败,请联系管理人员']);
    	}
    }

    // 回答首页
    public function reply_do(Request $request){
    	$course_id = $request->all()['course_id'];
    	$data = Course::join('Question','Course.course_id','=','Question.cou_id')
    	->where(['course_id'=>$course_id])
    	->get()
    	->toArray();
    	if($data){
    		return json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'添加失败,请联系管理人员']);
    	
            }
        }

    public function response(Request $request){
        $q_id = $request->all()['q_id'];
        return view('admin.question.response',['q_id'=>$q_id]);
    }

    // 回答问题
    public function response_do(Request $request){
        $q_id = $request->all()['q_id'];
        dd($q_id);
    }
}
