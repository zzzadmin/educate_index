@extends('layout.common')

@section('body')
<h3 align="center">添加作业</h3>
<form class="layui-form" action="/admin/job/job_add_do" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">作业名称</label>
        <div class="layui-input-block">
            <input type="text" name="job_name" lay-verify="title" autocomplete="off" placeholder="请输入咨询标题" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">作业内容</label>
        <div class="layui-input-block">
            <input type="text" name="job_content" lay-verify="title" autocomplete="off" placeholder="请输入咨询标题" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button id="add" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection