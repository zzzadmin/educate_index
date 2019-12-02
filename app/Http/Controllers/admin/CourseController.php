<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Model\Course;
/**
 * 课程模块---刘博
 */
class CourseController extends Controller
{
    //课程添加
    public function course_add()
    {
        $category=new Category();
        $data =$category->get()->toArray();
        $infinitus=$this->getCateInfo($data);
        return view('admin.course.course_add',compact('infinitus'));
    }

    //课程执行添加
    public function add_do(Request $request)
    {

            $post = request()->all();
            //dd($post);
            //dd($_FILES);
            if($_FILES['course_page']['error']==0){
            $file = $_FILES['course_page'];
            $course_page = $this->file($file);
            }else{
                $course_page = '';
            }
            //dd($course_page);
            $create = time();
            $data = [
                'lect_id' => 1,
                'course_name'=>$post['course_name'],
                'is_del' => 1,
                'create_time'=>$create,
                'status'=>(int)$post['status'],
                'course_page'=>$course_page,
                'introduce'=>$post['introduce'],
                'is_free'=>(int)$post['is_free'],
                'price'=>(int)$post['price'],
                'close'=>(int)$post['close'],
                'cate_id'=>(int)$post['cate_id']
            ];
            //dd($data);
            $data = Course::insert($data);
            if ($data) {
                return json_encode(['code'=>1,'msg'=>'添加成功']);
            }else{
                return json_encode(['code'=>2,'msg'=>'添加失败']);
            }
    }

    //课程列表
    public function course_list()
    {

        $query = request()->all();
        $course_name=$query['course_name']??'';
        //var_dump($course_name);
        $where =[];
        if ($course_name) {
            $where[]=['course_name','like',"%$course_name%"];
        }
        //$where[] = ['is_del','=','1'];
        //dd($where);
        //$is_del=(int)1;
        $pageSize=config('app.pageSize');
        $data = Course::join("Category","Course.cate_id","=","Category.cate_id")->where(['Course.is_del'=>1])->whereOr($where)->paginate($pageSize);
        $name = $_SERVER['SERVER_NAME'];
        //print_r($data);die;
        //dd($data);
        return view('admin.course.course_list',compact('data','query','course_name','name'));
    }

    //课程删除
    public function course_del()
    {
        $course_id = request()->course_id;
        if(empty($course_id)){
            echo"<script>alert('参数为空');location.href='/admin/course_list'</script>";die;
        }
        $course = Course::where(['course_id'=>$course_id])->update(['is_del'=>2]);
        if($course){
            echo"<script>alert('删除成功');location.href='/admin/course_list'</script>";
        }else{
            echo"<script>alert('删除失败');location.href='/admin/course_list'</script>";
        }
        //dd($post);
    }

    //课程修改
    public function course_update()
    {
        $course_id = request()->course_id;
        if(empty($course_id)){
            echo"<script>alert('参数为空');location.href='/admin/course_list'</script>";die;
        }
        $data = Course::join("Category","Course.cate_id","=","Category.cate_id")->where(['Course.course_id'=>$course_id])->get()->toArray();
        //dd($data);
        $category=new Category();
        $date =$category->get()->toArray();
        $infinitus=$this->getCateInfo($date);
        return view('admin.course.course_update',compact('data','infinitus'));
    }

    //课程执行修改
    public function course_update_do()
    {
        $post = request()->all();
        //dd($post);
        //dd($_FILES);
        if($_FILES['course_page']['error']==0){
        $file = $_FILES['course_page'];
        $course_page = $this->file($file);
        }else{
            $course_page = '';
        }
        //dd($course_page);
        $create = time();
        $data = [
            'lect_id' => 1,
            'course_name'=>$post['course_name'],
            'is_del' => 1,
            'create_time'=>$create,
            'status'=>(int)$post['status'],
            'course_page'=>$course_page,
            'introduce'=>$post['introduce'],
            'is_free'=>(int)$post['is_free'],
            'price'=>(int)$post['price'],
            'close'=>(int)$post['close'],
            'cate_id'=>(int)$post['cate_id']
        ];
        //dd($data);
        $data = Course::where(['course_id'=>$post['course_id']])->update($data);
        if ($data) {
                return json_encode(['code'=>0,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'修改失败']);
        }
    }

    //课程点击上下架
    public function give_or_take()
    {
       $post = request()->all();
        //dd($post);
        if (empty($post['course_id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $data = Course::where(['course_id'=>$post['course_id']])->update(['close'=>$post['close']]);
            return json_encode(['code'=>2,'msg'=>'修改成功']);
        }
    }


    //分类添加
    public function course_cate()
    {
        $category=new Category();
        $data =$category->get()->toArray();
        $infinitus=$this->getCateInfo($data);
        //dd($infinitus);
        return view('admin.course.course_cate',compact('infinitus'));
    }

    //分类执行添加
    public function course_cate_do()
    {
        $post = Request()->all();

        $cate = Category::where(['cate_id'=>$post['cate_id']])->get()->toArray();
        //dd($post);
        $leavel = $cate[0]['leavel']+1;
        //dd($leavel);
        $data = Category::insert([
            'cate_name'=>$post['cate_name'],
            'cate_describe'=>$post['cate_describe'],
            'leavel'=>$leavel,
            'pid'=>$post['cate_id']
        ]);
        if ($data) {
            return json_encode(['code'=>0,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'添加失败']);
        }
    }

    //分类列表
    public function course_cate_list()
    {
        $query = request()->all();
        $cate_name=$query['cate_name']??'';
        //var_dump($fodder_name);die;
        $where=[];
        if ($cate_name) {
            $where[]=['cate_name','like',"%$cate_name%"];
        }
        $pageSize=config('app.pageSize');
        $data = Category::where($where)->paginate($pageSize);
        //dd($data);
        return view('admin.course.course_cate_list',compact('data','query','cate_name'));
    }

    //分类禁用
    public function course_cate_del()
    {

        $post = request()->all();
        //dd($post);
        if (empty($post['cate_id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $course = Course::where(['cate_id'=>$post['cate_id']])->get()->toArray();
            if(!empty($course) && $post['is_del'] == 2){
                return json_encode(['code'=>3,'msg'=>'请先去清空课程']);
            }
            //dd($course);
            $data = Category::where(['cate_id'=>$post['cate_id']])->update(['is_del'=>$post['is_del']]);
            return json_encode(['code'=>2,'msg'=>'状态修改成功']);
        }


        //dd($post);
    }

    //分类修改
    public function course_cate_update()
    {
        $cate_id = request()->cate_id;
        if(empty($cate_id)){
            echo"<script>alert('参数为空');location.href='/admin/course_cate_list'</script>";
        }
        $data = Category::where(['cate_id'=>$cate_id])->get()->toArray();
        //dd($data);
        return view('admin.course.course_cate_update',compact('data'));
    }

    //分类执行修改
    public function course_cate_update_do()
    {
        $post = request()->all();
        //dd($post);
        $cate_id = $post['cate_id'];
        $update = [
            'cate_name' => $post['cate_name'],
            'cate_describe' => $post['cate_describe']
        ];
        $data = Category::where(['cate_id'=>$cate_id])->update($update);
        if ($data) {
            return json_encode(['code'=>0,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'修改失败']);
        }
    }

    //文件上传
    function file($file)
    {

        // var_dump($file);die;
        //文件上传是否错误
        if($file['error']!=0){
            echo json_encode(['code'=>201,'msg'=>"文件上传异常"]);die;
        }
        if($file['size']>1024*1024*2){
            echo json_encode(['code'=>202,'msg'=>"文件太大"]);
        }
        $type = ['image/png','image/jpg','image/jpeg','image/gif','video/mp4'];
        if(!in_array($file['type'],$type)){
            echo json_encode(['code'=>203,'msg'=>"文件类型错误"]);
        }
        $name = $file['name'];
        $ext = pathinfo($name,PATHINFO_EXTENSION);
        //var_dump($ext);die;
        $date = date("Y-n-j");
        //dd($date);
        if(!file_exists("img/".$date)){
            mkdir("img/".$date,777);
        }

        $det = "img/".$date."/".md5(time().rand(1000,9999)).'.'.$ext;
        //dd($det);
        $res = move_uploaded_file($file['tmp_name'],$det);
        return $det;
       // dd($res);
    }

    //无限极分类
    function getCateInfo($cateInfo,$pid=0){
        static $arr=[];
        foreach ($cateInfo as $k=>$v){
            if($v['pid']==$pid){
                //$v['level']=$level;
                $arr[]=$v;
                $this->getCateInfo($cateInfo,$v['cate_id']);
            }
        }
        return $arr;
    }
}
