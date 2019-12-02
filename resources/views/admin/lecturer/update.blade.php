@extends('layout.common')

@section('body')
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">讲师名字</label>
            <div class="layui-input-block">
                <input type="text" name="lect_name" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">讲师个人简历</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="lect_resume" class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">讲师授课风格</label>
            <div class="layui-input-block">
                <input type="text" name="lect_style" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button id="upd" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即修改</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script>
        var lect_id = getUrlParam('lect_id');
        // 获取默认信息
        $.ajax({
            url:'/admin/lect_update',
            type:"POST",
            data:{lect_id:lect_id},
            dataType:"json",
            success:function(res){
                // 页面赋值
                $("[name='lect_name']").val(res.data.lect_name);
                $("[name='lect_resume']").val(res.data.lect_resume);
                $("[name='lect_style']").val(res.data.lect_style);
            }
        });
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return decodeURI(r[2]); return null; //返回参数值
        }

        $(document).on('click','#upd',function(){
            var lect_name = $("[name='lect_name']").val();
            var lect_resume = $("[name='lect_resume']").val();
            var lect_style = $("[name='lect_style']").val();
            $.ajax({
                url:"/admin/lect_update_do",
                type:"POST",
                data:{lect_id:lect_id,lect_name:lect_name,lect_resume:lect_resume,lect_style:lect_style},
                dataType:'json',
                success(res){
                    alert(res.msg);
                    location.href = "/admin/lect/index";
                }
            });
            return false;
        })
    </script>
@endsection
