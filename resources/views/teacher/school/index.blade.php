<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/exp.css"/>
    <link rel="stylesheet" href="/third/css/top.css"/>
    <title>个人主页</title>
</head>
<body>
<div class="box">
    <header>
        <div class="header">
            <div class="top">
                <a href="/personal"><i class="back">

                    </i></a>
                <span class="title">
                       毕业院校
                    </span>
                <a href="/schools/create">

                 <span class="button">
                    增加
                </span></a>
            </div>
        </div>
    </header>
    <section>
        @foreach($schools as $school)
            <div class="center" data-id="{{$school -> id}}">
                <div class="reveal">
                    <div class="revaal-header-date">
                        <span class="header-date-star">{{$school->start_time}}</span>至<span
                                class="header-date-end">{{$school -> end_time}}</span>
                    </div>
                    <div class="edit">
                        <span>编辑</span><i></i>
                    </div>
                </div>
                <div class="content">
                    <h4>{{$school -> name}}</h4>
                    <div class="content-c">
<span class="content-b">
    {{$school -> degree}}
</span>-<span class="content-b">
    {{$school -> major}}
</span>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

</div>
</body>
<script type="text/javascript" src="/third/js/mom.js"></script>
<script type="text/javascript">
    $("document").ready(function () {
        $(".header-date-star").each(function () {
            moment.locale('zh-cn');
            var time = this.innerHTML;
            var k = time * 1000;
            var thistime = moment(k).format('YYYY-MM');
            this.innerHTML = thistime;
        });
        $(".header-date-end").each(function () {
            moment.locale('zh-cn');
            var time = this.innerHTML;
            var k = time * 1000;
            var thistime = moment(k).format('YYYY-MM');
            this.innerHTML = thistime;
        });
        $(".center").click(function () {
            var id = $(this).attr("data-id");
            url = "/schools/" + id + "/edit";
            window.location.href = url;

        });

    });
</script>
</html>