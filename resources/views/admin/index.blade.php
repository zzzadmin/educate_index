@extends('layout.common')
    @section('content')
    <div class="layui-header">
        @include('public.header')
    </div>
    <div class="layui-side layui-bg-black">
    <!--左侧导航开始-->
         @include('public.left')
         <!--左侧导航结束-->
    </div>

@endsection