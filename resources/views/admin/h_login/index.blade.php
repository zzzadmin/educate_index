<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>🐇 - @yield('title')</title>
  <link rel="stylesheet" href="/admin/css/layui.css">
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<script src="/admin/layui.js"></script>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">后台模块❤</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台🐕</a></li>
      <li class="layui-nav-item"><a href="">商品管理🐱</a></li>
      <li class="layui-nav-item"><a href="">用户🦁</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统🐺</a>
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
           <img src="http://t.cn/RCzsdCq" class="layui-nav-img">贤心

        </a>
        <dl class="layui-nav-child">
          <dd><a href="{:url('admin/updatePass')}">修改密码</a></dd>

        </dl>
      </li>
      <li class="layui-nav-item"><a href="http://www.educate.com/admin/quit">退出</a></li>
    </ul>
  </div>

  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">用户管理😊</a>
          <dl class="layui-nav-child">
            <dd><a href="/admin/login">用户登录</a></dd>
            <dd><a href="/admin/login_index">用户列表</a></dd>
          </dl>
        </li>

       <li class="layui-nav-item">
          <a href="javascript:;">随便写</a>
          <dl class="layui-nav-child">
            <dd><a href="#">添加</a></dd>
            <dd><a href="#">列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">讲师</a>
          <dl class="layui-nav-child">
            <dd><a href="/lect/index">添加讲师</a></dd>
            <dd><a href="/lect/list">讲师列表</a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
      @section('sidebar')

      @show
      <div class="container">
            @yield('content')
        </div>
    </div>
  </div>

  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>

<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
});
</script>
</body>
</html>

