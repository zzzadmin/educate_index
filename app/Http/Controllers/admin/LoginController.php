<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
/**
 * 注册登录模块---何帅奇
 */
class LoginController extends Controller
{
    /**
     * 后台登录
     */
    public function login()
    {
        return view('admin.h_login.login');
    }
    public function login_do(Request $request)
    {
        $data = $request->input();
        $u_email=request()->u_email;
        $u_pwd=request()->u_pwd;
        $where=[
            'u_email'=>$u_email
        ];
        $userinfo = User::where($where)->first();
        $u_id = $userinfo['u_id'];
        $u_email = $userinfo->u_email;
        if(empty($userinfo)){
            $data=[
                'code'=>'402',
                'message'=>'用户名或者密码错误,请重新登录',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);

        }else{
            if($userinfo->u_pwd==$u_pwd){
                session(['u_id'=>$u_id]);
                $data=[
                    'code'=>'200',
                    'message'=>'欢迎登录',
                    'data'=>[]
                ];
                // $id = session()->all()['u_id'];//uid
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                $data=[
                    'code'=>'401',
                    'message'=>'用户名或密码错误',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }


        }

    }

    public function register(Request $request){
        return view('admin.h_login.register');
    }

    public function register_do(Request $request){
        $data = $request->input();
        $userinfo =User::where(['u_email'=>$data['u_email']])->first();
        if($data['u_email']==$userinfo['u_email']){
            $data = [
                'code'=>'401',
                'message'=>'用户已存在,请直接登录',
                'data'=>[],
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
//            $data['pwd']=md5($data['pwd']);
            $res = User::insert($data);
            $data = [
                'code'=>'200',
                'message'=>'注册成功，请去登录！',
                'data'=>[],
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }

    public function quit(Request $request){
        request()->session()->forget('u_email');
        request()->session()->forget('u_pwd');
        return view('admin.h_login.login');
    }

    /**
     * 后台首页
     */
    public function index()
    {
        return view('admin.index');
    }
}
