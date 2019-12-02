<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
        <script src="/layui/layui.js"></script>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/js/bootstrap.min.js">
    <script src="{{asset('jquery.js')}}"></script>

</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">layui 后台布局</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">商品管理</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    贤心
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="/admin/quit">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">管理员模块</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/register">用户注册</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="javascript:;">讲师模块</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/addinsert">添加讲师</a></dd>
                        <dd><a href="/admin/lect/index">讲师列表</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                  <a href="javascript:;">课程管理</a>
                  <dl class="layui-nav-child">
                    <dd><a href="/admin/course_add">课程添加</a></dd>
                    <dd><a href="/admin/course_list">课程列表</a></dd>
                    <dd><a href="/admin/course_update">课程修改</a></dd>
                    <dd><a href="/admin/course_cate">分类添加</a></dd>
                    <dd><a href="/admin/course_cate_list">课程分类</a></dd>
                    <dd><a href="/admin/course_cate_update">分类修改</a></dd>
                  </dl>
                </li>
                
                <li class="layui-nav-item">
                  <a href="javascript:;">文章管理</a>
                  <dl class="layui-nav-child">
                    <dd><a href="/catelog/index">文章添加</a></dd>
                    <dd><a href="/catelog/list">文章列表</a></dd>
                  </dl>
                </li>


                <li class="layui-nav-item">
                    <a href="javascript:;">问答模块</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/question/index">问答首页</a></dd>
                        <dd><a href="javascript:;">添加问题</a></dd>
                        <dd><a href="javascript:;">删除问题</a></dd>
                        <dd><a href="javascript:;">回答问题</a></dd>
                    </dl>
                </li>


                <li class="layui-nav-item">
                    <a href="javascript:;">咨询管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/information/info_add">添加咨询</a></dd>
                        <dd><a href="/admin/information/info_list">咨询展示</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item">
                    <a href="javascript:;">笔记</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/note/note_add">添加笔记</a></dd>
                        <dd><a href="/admin/note/note_list">笔记列表</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item">
                    <a href="javascript:;">作业</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/job/job_add">添加作业</a></dd>
                        <dd><a href="/admin/job/job_list">作业列表</a></dd>
                    </dl>
                </li>

                {{--<li class="layui-nav-item"><a href="">云市场</a></li>--}}
                {{--<li class="layui-nav-item"><a href="">发布商品</a></li>--}}
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style:padding: 15px>
            @section('body')

            @show
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © layui.com - 底部固定区域
    </div>
</div>

<script>
    layui.use('form',function(){
        var form = layui.form;
        //刷新界面 所有元素
        form.render();
    });
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;

    });
</script>
</body>
</html>
