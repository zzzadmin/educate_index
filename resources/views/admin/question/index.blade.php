@extends('layout.common')

@section('body')
    <fieldset class="layui-elem-field layui-field-title" style:margin-top: 20px;>
        <legend align="center">问答模块</legend>
    </fieldset>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>课程id</th>
                <th>课程名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            	
            </tbody>
        </table>
        <div id="page">

        </div>
    </div>
    <script>
        //发送ajax请求调用展示接口
        $.ajax({
            url:'/admin/get_course',
            type:"GET",
            dataType:"json",
            success:function(res){
                console.log(res);
                $.each(res.data,function(k,v){
                    var tr = $("<tr></tr>");
                    tr.append("<td>"+v.course_id+"</td>");
                    tr.append("<td>"+v.course_name+"</td>");
                    tr.append("<td>" +"<a href='javascript:;' course_id='"+v.course_id+"' class='ask layui-btn'>提问</a>" +"<a href='javascript:;' course_id='"+v.course_id+"' class='see layui-btn'>查看提问</a></td>");
                    $('#list').append(tr);
                })
                // 构建页码
                var page = "";
                for(var i=1;i<=res.data.last_page;i++){
                    page += "<a href='#' page='"+i+"'>第"+i+"页</a>";
                }
                $('#page').html(page);
            }
        })

        // 提问首页
	    $(document).on('click',".ask",function(){
	    	var course_id = $(this).attr('course_id');
	    	location.href = "/admin/question/ask/?course_id="+course_id;
	    })

	    // 查看提问
	    $(document).on('click',".see",function(){
	    	var course_id = $(this).attr('course_id');
	    	location.href = "/admin/question/reply/?course_id="+course_id;
	    })

        // 分页
        $(document).on('click','#page a',function(){
            // 获取当前点击的页码
            var page = $(this).attr('page');
            $.ajax({
                url:"/admin/lect/list",
                type:"GET",
                data:{page:page},
                dataType:"json",
                success:function(res){
                    // 渲染页面
                    mypage(res);
                }
            })
        });

        function mypage(res){
            // 清空之前内容
            $("#list").empty();
            // 通过js循环res里的数据 进行页面渲染
            $.each(res.data.data,function(k,v){
                var tr = $("<tr></tr>");
                tr.append("<td>"+v.lect_id+"</td>");
                tr.append("<td>"+v.lect_name+"</td>");
                tr.append("<td>"+v.lect_resume+"</td>");
                tr.append("<td>"+v.lect_style+"</td>");
                tr.append("<td>" +"<a href='javascript:;' lect_id='"+v.lect_id+"' class='del layui-btn'>删除</a>" +"<a href='javascript:;' lect_id='"+v.lect_id+"' class='upd layui-btn'>修改</a></td>");
                $('#list').append(tr);
            })
            // 构建页码
            var page = "";
            for(var i=1;i<=res.data.last_page;i++){
                if( i == res.data.current_page){
                    page += "<a href='javascript:;' page='"+i+"' style='color:red'>第"+i+"页</a>";
                }else{
                    page += "<a href='javascript:;' page='"+i+"'>第"+i+"页</a>";
                }

            }
            $('#page').html(page);
        }

        // 删除
        $(document).on('click','.del',function (){
            var lect_id = $(this).attr('lect_id');
            $.ajax({
                url:"/admin/lect_delete",
                data:{lect_id:lect_id},
                dataType:'json',
                method:'post',
                success(res){
                    if(res.code == 200){
                        alert(res.msg);
                        location.reload();
                    }else{
                        alert(res.msg);
                    }
                }
            });
            return false;
        });
        // 修改
        $(document).on('click',".upd",function(){
            var lect_id = $(this).attr('lect_id');
            location.href = "/admin/lect_update_view?lect_id="+lect_id;
        })
    </script>
@endsection
