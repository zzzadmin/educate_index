<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Lect;
/**
 * 讲师模块---左海涛
 */
class LecturerController extends Controller
{
    //讲师列表
    public function list(Request $request){
        $data = Lect::paginate(2);
        return json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
    }
    // 添加讲师
    public function addinsert(Request $request){
        $data = $request->all();
//        if(is_set($data)){
//            echo "请输入完整数据";
//        }
        $res = Lect::insert($data);
        if ($res){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'添加失败']);
        }
    }
    // 讲师列表
    public function index(){
        $data = Lect::get();
        return view('admin.lecturer.index',['data'=>$data]);
    }

    // 删除讲师
    public function delete(Request $request){
        $data = $request->all();
        if(empty($data['lect_id'])){
            return json_encode(['code'=>201,'msg'=>'系统错误']);
        }
        $res = Lect::where(['lect_id'=>$data['lect_id']])->delete();
        if ($res){
            return json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'删除失败']);
        }
    }
    // 修改
    public function update(Request $request){
        $lect_id = $request->all()['lect_id'];
        if(empty($lect_id)){
            return json_encode(['code'=>201,'msg'=>"未传id"]);
        }
        // 查询数据库
        $data = Lect::where(['lect_id'=>$lect_id])->first();
        return json_encode(['data'=>$data]);
    }
    // 讲师修改件
    public function update_do(Request $request){
        $data = $request->all();
        $res = Lect::where(['lect_id'=>$data['lect_id']])->update([
            'lect_name' => $data['lect_name'],
            'lect_resume' => $data['lect_resume'],
            'lect_style'=>$data['lect_style']
        ]);
        if($res){
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'修改失败,请联系管理人员']);
        }
    }


}
