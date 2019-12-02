@extends('layout.common')

@section('body')
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">问题标题</label>
            <div class="layui-input-block">
                <input type="text" name="q_title" lay-verify="title" autocomplete="off" placeholder="请输入问题标题" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">问题正文</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入问题正文" name="q_content" class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button id="ask" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提问</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script>
    	var course_id = getUrlParam('course_id');
		// 获取状态栏id
    	function getUrlParam(name) {
		  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
		  var r = window.location.search.substr(1).match(reg);  //匹配目标参数
		  if (r != null) return decodeURI(r[2]); return null; //返回参数值
		}

		// 请求提问控制器
        $(document).on('click','#ask',function(){
            var q_title = $("[name='q_title']").val();
            var q_content = $("[name='q_content']").val();

            $.ajax({
                url:"/admin/question/ask_question",
                type:"POST",
                data:{course_id:course_id,q_title:q_title,q_content:q_content},
                dataType:'json',
                success(res){
                    alert(res.msg);
	                if(res.code==200){
	                    location.href = '/admin/question/index';
	                }
                }
            });
            return false;
        })
    </script>
@endsection
