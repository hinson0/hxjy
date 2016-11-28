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
<script type="text/javascript" src="/third/js/teach.js"></script>
</html>
