@extends('layout.common')

@section('body')
    <fieldset class="layui-elem-field layui-field-title" style:margin-top: 20px;>
        <legend align="center">回答首页</legend>
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
                <th>问题id</th>
                <th>课程名称</th>
                <th>问题标题</th>
                <th>问题内容</th>
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
    	var course_id = getUrlParam('course_id');
        //发送ajax请求调用展示接口
        $.ajax({
            url:'/admin/question/reply_do',
            type:"GET",
            data:{course_id:course_id},
            dataType:"json",
            success:function(res){
                console.log(res);
                $.each(res.data,function(k,v){
                    var tr = $("<tr></tr>");
                    tr.append("<td>"+v.q_id+"</td>");
                    tr.append("<td>"+v.course_name+"</td>");
                    tr.append("<td>"+v.q_title+"</td>");
                    tr.append("<td>"+v.q_content+"</td>");
                    tr.append("<td>" +"<a href='/admin/question/response/?q_id="+v.q_id+"'   q_id='"+v.q_id+"' class='ask layui-btn'>回答</a>" +"<a href='javascript:;' q_id='"+v.q_id+"' class='see layui-btn'>查看提问</a></td>");
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
        // 获取状态栏的id
        function getUrlParam(name) {
		  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
		  var r = window.location.search.substr(1).match(reg);  //匹配目标参数
		  if (r != null) return decodeURI(r[2]); return null; //返回参数值
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
