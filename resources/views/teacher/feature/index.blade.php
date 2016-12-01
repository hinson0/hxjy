<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    {{--<link rel="stylesheet" href="/third/css/infoshow.css"/>--}}
    <link rel="stylesheet" href="/third/css/top.css"/>
    <title>个人主页</title>
</head>
<body>
<div class="box">
    <header>
        <div class="header">
            <div class="top">
                <i class="back">

                </i>
                <span class="title">
                       教学特点
                    </span>
                <span class="button">
                        编辑
                </span>
            </div>
        </div>
    </header>
    <section>
        <form action="#">
            {{ csrf_field() }}


        </form>
    </section>
</div>
</body>
</html>