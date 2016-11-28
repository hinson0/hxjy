<!doctype html>
<html lang="cn">

<head>
    <meta charset="UTF-8"/>
    <title>教师登录</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="/image/admin/14.ico" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="/third/css/teach.css"/>
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>


</head>
<body>

<div class="box">
    <div class="login-box">
        <div class="login-title">
            <span class="back">

            </span>
            <h1>
                <span>教师注册</span>
            </h1>
        </div>
        {{--<div class="login-class">--}}
        {{--<span>--}}
        {{--账号密码登录--}}
        {{--</span>--}}
        {{--</div>--}}
        <div class="login-content ">
            <div class="form">
                <form action="#" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <i></i>
                        <input type="text" id="tel" name="username" placeholder="输入手机号码">
                        <span class="tel">
                        </span>
                    </div>
                    <div class="input-group">
                        <i></i>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="输入密码（6-20位数字或者英语字符）">
                        <span class="passw"></span>
                    </div>
                    <div class="butt">
                        <button type="button" id="sub" class="btn btn-sm btn-info"><span
                                    class="glyphicon glyphicon-off"></span> 确认注册
                        </button>
                    </div>

                </form>
            </div>
            <div class="lost">
                {{--<span id="lostpass">忘记密码？</span>--}}
            </div>
        </div>
    </div>
</div>
</body>
{{--src="/third/js/reg.js"--}}
<script type="text/javascript">
    $(document).ready(function(){
        $(".back").click(function(){
            window.history.back();
        });
        $("input[type='text']").focusin(function(){
            $(".tel").html(" ");
        });
        $("input[type='password']").focusin(function(){
            $(".passw").html(" ");
        });
        $("#sub").click(function () {
            if ($("#tel").val() == "") {
                $(".tel").html("请输入手机号码");
            }
            else if ($("#password").val() == "") {
                $(".passw").html("请输入密码");
            }
            else {
                var JSon = {
                    tel: $("#tel").val(),
                    _token: $("input[name='_token']").val(),
                    password: $("#password").val(),
                };
                $.ajax({
                    url: '/doreg',
                    type: 'post',
                    data: JSon,
                    datatype: 'json',
                    statusCode: {
                        500:function (data) {
                          console.log(data);
                        },
                        422: function () {
                            $(".tel").html("账号格式错误");
                        },
                        404: function () {
                            alert('页面加载失败，请稍后再试');
                        }, 403: function (data) {
                            if (data.responseJSON.msg == '密码错误') {
                                $(".passw").html(data.responseJSON.msg+"请注意大小写");
                            }
                            else if (data.responseJSON.msg == '账号不存在') {
                                $(".tel").html(data.responseJSON.msg);
                            }
                            else {
                                console.log(data)
                            }

                        }
                    },
                    success: function (data, textStatus) {
                        console.log(data);
                        if (data.msg == "用户不存在") {
                            $(".tel").html(data.msg);
                        }
                        else if (data.msg == "密码错误") {
                            $(".passw").val(data.msg);
                        }
                        else if (data.msg == "登录成功") {
//                            window.location.href = "/home";
                        }
                        else {
                            alert("登录失败");
                        }
                    }
                })
            }
        })
    })


</script>
</html>
