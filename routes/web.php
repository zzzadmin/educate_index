<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 用户模块
Route::prefix('admin')->group(function(){
    Route::any('index','admin\LoginController@index');//后台首页
    Route::any('register','admin\LoginController@register');    //后台注册页面
    Route::any('register_do','admin\LoginController@register_do');    //后台注册执行
    Route::any('login','admin\LoginController@login');    //后台登录页面
    Route::any('login_do','admin\LoginController@login_do');//后台登录执行
    Route::any('quit','admin\LoginController@quit');//退出登录

});

// 讲师模块
Route::middleware(['AdminLogin'])->prefix('admin')->group(function(){
    Route::any('addinsert', function () {
        return view('admin.lecturer.addinsert');//讲师模块
    });
    Route::any('lect/index','admin\LecturerController@index');//后台讲师列表
    Route::any('lect/list','admin\LecturerController@list');//后台讲师列表
    Route::any('addinsert_do','admin\LecturerController@addinsert');//后台添加讲师
    Route::any('lect_update_view',function (){
        return view('admin.lecturer.update');//讲师修改
    });
    Route::any('lect_update','admin\LecturerController@update');//后台修改讲师
    Route::any('lect_update_do','admin\LecturerController@update_do');//后台修改讲师
    Route::any('lect_delete','admin\LecturerController@delete');//后台删除讲师
});

// 课程问答模块
Route::middleware(['AdminLogin'])->prefix('admin')->group(function(){
    Route::any('get_course','admin\QuestionController@gteCourse');//后台获取课程
    Route::any('question/index', function () {
        return view('admin.question.index');//问答首页
    });
    Route::any('question/ask', function () {
        return view('admin.question.ask');//提问
    });
    Route::any('question/ask_question','admin\QuestionController@askQuestion');//后台提问
    Route::any('question/reply', function () {
        return view('admin.question.reply');//查看提问
    });
    Route::any('question/reply_do','admin\QuestionController@reply_do');//回答首页
    // Route::any('question/response',function(){
    //     return view('admin.question.response');//回答问题
    // });

    Route::any('question/response','admin\QuestionController@response');//回答问题
    Route::any('question/response_do','admin\QuestionController@response_do');//回答问题
});

// 咨询模块
Route::middleware(['AdminLogin'])->prefix('admin')->group(function(){
    Route::any('information/info_add',function(){
        return view('admin.information.add');// 咨询添加
    });
    Route::any('information/info_add_do','admin\InformationController@information_add');// 咨询添加
    Route::any('information/info_list','admin\InformationController@information_list');// 咨询列表
    Route::any('information/info_del','admin\InformationController@information_del');// 咨询删除
    Route::any('information/info_update','admin\InformationController@information_update');// 咨询删除
    Route::any('information/info_update_do','admin\InformationController@information_update_do');// 咨询删除
});


// 笔记模块
Route::middleware(['AdminLogin'])->prefix('admin')->group(function(){
    Route::any('note/note_add',function(){
        return view('admin.note.add');// 笔记添加
    });
    Route::any('note/note_add_do','admin\NoteController@note_add_do');// 笔记添加
    Route::any('note/note_list','admin\NoteController@note_list');// 笔记列表
    Route::any('note/note_del','admin\NoteController@note_del');// 笔记列表
    Route::any('note/note_update','admin\NoteController@note_update');// 笔记修改
    Route::any('note/note_update_do','admin\NoteController@note_update_do');// 笔记修改
});

// 作业模块
Route::middleware(['AdminLogin'])->prefix('admin')->group(function(){
    Route::any('job/job_add',function(){
        return view('admin.job.add');// 作业添加
    });
    Route::any('job/job_add_do','admin\JobController@job_add_do');// 作业添加
    Route::any('job/job_list','admin\JobController@job_list');// 作业列表
    Route::any('job/job_del','admin\JobController@job_del');// 作业列表
    Route::any('job/job_update','admin\JobController@job_update');// 作业修改
    Route::any('job/job_update_do','admin\JobController@job_update_do');// 作业修改
});


Route::get('catelog/index','admin\CatelogController@index');  //文章添加
Route::get('catelog/list','admin\CatelogController@cate_list');  //文章列表
Route::any('catelog/catelog_add','admin\CatelogController@catelog_add');  //添加执行
Route::any('catelog/catalog_list','admin\CatelogController@catalog_list');//列表数据

Route::any('catelog/catelog_del','admin\CatelogController@catelog_del');//文章删除
Route::any('catelog/catelog_upd','admin\CatelogController@catelog_upd');//文章修改
Route::any('catelog/catelog_upd_do','admin\CatelogController@catelog_upd_do');//文章修改执行

Route::prefix('admin')->middleware(['apiheader'])->group(function(){
    Route::get('course_add','admin\CourseController@course_add');//课程添加
    Route::post('course_add_do','admin\CourseController@add_do');//课程执行添加
    Route::get('course_list','admin\CourseController@course_list');//课程列表
    Route::any('course_del','admin\CourseController@course_del');//课程删除
    Route::get('course_update','admin\CourseController@course_update');//课程修改
    Route::post('course_update_do','admin\CourseController@course_update_do');//课程执行修改

    Route::post('give_or_take','admin\CourseController@give_or_take');//课程点击上下架
    Route::get('course_cate','admin\CourseController@course_cate');//分类添加
    Route::post('course_cate_do','admin\CourseController@course_cate_do');//分类执行添加
    Route::any('course_cate_list','admin\CourseController@course_cate_list');//分类列表
    Route::post('course_cate_del','admin\CourseController@course_cate_del');//分类禁用
    Route::get('course_cate_update','admin\CourseController@course_cate_update');//分类修改
    Route::post('course_cate_update_do','admin\CourseController@course_cate_update_do');//分类执行修改
});

Route::prefix('index')->group(function(){
    Route::get('slide','index\SlideController@slide');// 轮播图
    Route::get('limit','index\SlideController@limit');// 轮播图
    
});


