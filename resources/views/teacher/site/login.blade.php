<!doctype html>
<html lang="cn">

<head>
    <meta charset="UTF-8"/>
    <title>后台管理</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="/image/admin/14.ico" type="image/x-icon"/>
    {{--<link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.min.css"/>--}}
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .box{
            width:100%;
            height:100%;
            background:#efefef;
        }
        .login-title {
            width: 100%;
            height: 55px;
            font-size: 0.55em;
            line-height: 55px;
            background: #fffcfc;
            color: #666666;
            position: relative;
            text-align: center;
            border-bottom: 1px solid #efefef;
        }

        .input-group {
            width: 100%;
            height: 3em;
            text-align: center;
            position: relative;
            background: #ffffff;

        }

        .input-group input {
            width: 96%;
            height: 3.5em;
            line-height: 3.5em;
            border: none;
            outline: medium;
            background: #ffffff;
            text-indent: 12%;
        }

        .form form .input-group:nth-child(2) i{
            display: block;
            width:1em;
            height:1.4em;
            top:8px;
            position: absolute;
            left:5%;
            background: #666666;
            background: url(/third/img/tel.png);
            background-size:100% 100%;
        }
        .form form .input-group:nth-child(3) i{
            display: block;
            width:0.85em;
            height:1.2em;
            top:10px;
            position: absolute;
            left:5%;
            background: #666666;
            background: url(/third/img/pass.png);
            background-size:100% 100%;
        }
        #tel{
            border-bottom: 0.2em solid #efefef;
        }
        .butt{
            width:100%;
            margin-top:1em;
            text-align: center;
        }
        #sub{
            width:80%;
            height:2.2em;
            border:none;
            color: #ffffff;
            font-size: 1em;

        }
        .back{
            width:1.2em;
            height:1.2em;
            display: block;
            border-top:0.2em solid #a7a7a7;
            border-left:0.2em solid #a7a7a7;
            transform: rotate(-45deg);
            position: absolute;
            top:1.5em;
            left:2em;
        }
        .lost{
            width:98%;
            margin:0 auto;
            margin-top:1.2em;
            padding-right:2em;
            text-align: right;
        }
        #lostpass{
            font-size: 0.8em;
            color: #666666;
        }
        .input-group span{
            display: block;
            height:2em;
            line-height: 2em;
            width:auto;
            position: absolute;
            top:0.8em;
            right:5%;
            color: #ff0000;
            font-size:0.8em;
        }
    </style>


</head>
<body>

<div class="box">
    <div class="login-box">
        <div class="login-title">
            <span class="back">

            </span>
            <h1>
                <span>教师登录</span>
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
                        <input type="text" id="tel" name="username" placeholder="输入手机号码或者邮箱账号">
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
                                    class="glyphicon glyphicon-off"></span> 登录
                        </button>
                    </div>

                </form>
            </div>
            <div class="lost">
                    <span id="lostpass">忘记密码？</span>
            </div>
        </div>
    </div>
</div>
</body>
{{--<script type="text/javascript" src="/js/admin/bootstrap.min.js"></script>--}}
<script type="text/javascript">
    $(document).ready(function () {
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
                alert("请输入手机号码");
            }
            else if ($("#password").val() == "") {
                alert("请输入密码");
            }
            else {
                var JSon = {
                    tel: $("#tel").val(),
                    _token: $("input[name='_token']").val(),
                    password: $("#password").val(),
                };
                $.ajax({
                    url: '/dologin',
                    type: 'post',
                    data: JSon,
                    datatype: 'json',
                    statusCode: {
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
                            window.location.href = "/home";
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
