

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>注册界面</title>
    <link href="{{asset('layui-login/css/default.css')}}" rel="stylesheet" type="text/css" />
    <!--必要样式-->
    <link href="{{asset('layui-login/css/styles.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('layui-login/css/demo.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('layui-login/css/loaders.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class='login'>
    <div class='login_title'>
        <span>注册！</span>
    </div>
    <div class='login_fields'>
        <div class='login_fields__user'>
            <div class='icon'>
                <img alt="" src="{{asset('layui-login/img/user_icon_copy.png')}}">
            </div>
            <input name="u_email" placeholder='邮箱' maxlength="16" type='text' autocomplete="off">
            <div class='validation'>
                <img alt="" src="{{asset('layui-login/img/tick.png')}}">
            </div>
        </div>
        <div class='login_fields__password'>
            <div class='icon'>
                <img alt="" src="{{asset('layui-login/img/lock_icon_copy.png')}}">
            </div>
            <input name="u_pwd" placeholder='密码' maxlength="16" type='text' autocomplete="off">
            <div class='validation'>
                <img alt="" src="{{asset('layui-login/img/tick.png')}}">
            </div>
        </div>
        <div class='login_fields__password'>
            <div class='icon'>
                <img alt="" src="{{asset('layui-login/img/lock_icon_copy.png')}}">
            </div>
            <input name="u_pwd1" placeholder='请确认密码' maxlength="16" type='text' autocomplete="off">
            <div class='validation'>
                <img alt="" src="{{asset('layui-login/img/tick.png')}}">
            </div>
        </div>

        <div class='login_fields__password'>

            <div class='validation' style:opacity: 1; right: -5px;top: -3px>
                <canvas class="J_codeimg" id="myCanvas" onclick="Code();">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
            </div>
        </div>
        <div class='login_fields__submit'>
            <input type='button'  value='登录'>
        </div>
    </div>
    <div class='success'>
    </div>
    <div class='disclaimer'>

    </div>
</div>
<div class='authent'>
    <div class="loader" style="height: 44px;width: 44px;margin-left: 28px;">
        <div class="loader-inner ball-clip-rotate-multiple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <p>认证中...</p>
</div>
<div class="OverWindows"></div>

<link href="{{asset('layui-login/layui/css/layui.css')}}" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="{{asset('layui-login/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('layui-login/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('layui-login/js/stopExecutionOnTimeout.js?t=1')}}"></script>
<script type="text/javascript" src="{{asset('layui-login/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('layui-login/js/Particleground.js')}}"></script>
<script type="text/javascript" src="{{asset('layui-login/js/Treatment.js')}}"></script>
<script type="text/javascript" src="{{asset('layui-login/js/jquery.mockjax.js')}}"></script>
<script type="text/javascript">
    var canGetCookie = 0;//是否支持存储Cookie 0 不支持 1 支持
    // var ajaxmockjax = 1;//是否启用虚拟Ajax的请求响 0 不启用  1 启用
    //默认账号密码



    // var truelogin = "admin";
    // var truepwd = "123";


    function showCheck(a) {

        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, 1000, 1000);
        ctx.font = "80px 'Hiragino Sans GB'";
        ctx.fillStyle = "#E8DFE8";

    }
    // $(document).keypress(function (e) {
    //     // 回车键事件
    //     if (e.which == 13) {
    //         $('input[type="button"]').click();
    //     }
    // });
    //粒子背景特效
    $('body').particleground({
        dotColor: '#E8DFE8',
        lineColor: '#133b88'
    });
    $('input[name="u_pwd"]').focus(function () {
        $(this).attr('type', 'password');
    });
    $('input[name="u_pwd1"]').focus(function () {
        $(this).attr('type', 'password');
    });
    $('input[type="text"]').focus(function () {
        $(this).prev().animate({ 'opacity': '1' }, 200);
    });
    $('input[type="text"],input[type="password"]').blur(function () {
        $(this).prev().animate({ 'opacity': '.5' }, 200);
    });

    $('input[name="u_email"],input[name="u_pwd"]').keyup(function () {
        var Len = $(this).val().length;
        if (!$(this).val() == '' && Len >= 5) {
            $(this).next().animate({
                'opacity': '1',
                'right': '30'
            }, 200);
        } else {
            $(this).next().animate({
                'opacity': '0',
                'right': '20'
            }, 200);
        }
    });
    var open = 0;
    layui.use('layer', function () {
        var msgalert = '注册页面！';
        var index = layer.alert(msgalert, { icon: 6, time: 4000, offset: 't', closeBtn: 0, title: '', btn: [], anim: 2, shade: 0 });
        layer.style(index, {
            color: '#777'
        });
        //非空验证
        $('input[type="button"]').click(function () {
            var u_email = $('input[name="u_email"]').val();
            var u_pwd = $('input[name="u_pwd"]').val();
            var u_pwd1 = $('input[name="u_pwd1"]').val();
            var reg=/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
            if (u_email == '') {
                ErroAlert('请输入您的注册的邮箱');
            }else if(!reg.test(u_email)){
                ErroAlert('请输入正确的邮箱格式');
            }else if (u_pwd == '') {
                ErroAlert('请输入密码');
            }else if(u_pwd1!=u_pwd){
                ErroAlert('请保证两次密码一致');
            }else {
                // //认证中..
                $('.login').addClass('test'); //倾斜特效
                setTimeout(function () {
                    $('.login').addClass('testtwo'); //平移特效
                }, 300);
                setTimeout(function () {
                    $('.authent').show().animate({ right: -320 }, {
                        easing: 'easeOutQuint',
                        duration: 600,
                        queue: false
                    });
                    $('.authent').animate({ opacity: 1 }, {
                        duration: 200,
                        queue: false
                    }).addClass('visible');
                }, 200);

                //登录
                var JsonData = { u_email: u_email, u_pwd: u_pwd };
                //此处做为ajax内部判断

                var url = "";
                var u_email=JsonData.u_email;
                var u_pwd=JsonData.u_pwd;

                $.ajax({
                    url:"{{url('/admin/register_do')}}",
                    type:"get",
                    data:{u_email:u_email,u_pwd:u_pwd},
                    dataType:"json",
                    success:function(res){
                        if (res.code==200) {
                            alert(res.message);
                            location.href='http://www.educate.com/admin/login';
                            {{--// url = "{{url('admin/login')}}";--}}
                        }else{
                            alert(res.message);
                            location.href='http://www.educate.com/admin/login';
                        }

                    }
                });
            }
        })
    });



</script>

</body>
</html>
