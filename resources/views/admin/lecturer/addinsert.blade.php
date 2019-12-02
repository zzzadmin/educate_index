@extends('layout.common')

@section('body')
    <form class="layui-form">
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
                <button id="add" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script>
        $(document).on('click','#add',function(){
            var lect_name = $("[name='lect_name']").val();
            var lect_resume = $("[name='lect_resume']").val();
            var lect_style = $("[name='lect_style']").val();

            $.ajax({
                url:"/admin/addinsert_do",
                type:"POST",
                data:{lect_name:lect_name,lect_resume:lect_resume,lect_style:lect_style},
                dataType:'json',
                success(res){
                    alert(res.msg);
                    if(res.code==200){
                        location.href = '/admin/lect/index';
                    }
                }
            });
            return false;
        })
    </script>
@endsection
