<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/cases.css" />
    <link rel="stylesheet" href="/third/css/cases-cre.css"/>
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
                       成功案例
                    </span>
                <span class="button">
                        <a href="/cases/create">新增</a>
                    </span>
            </div>
        </div>
    </header>
    <section>
        <div class="content">
            @foreach($cases as $case)
            <div class="content-header">
                <input type="hidden" value="{{$case->id}}">
                <div class="content-title">
                    <span class="content-title-font">
{{$case->title}}
                    </span>
                    <span class="content-tilte-up">

                       编辑 <i>

                        </i>
                    </span>

                </div>
                <div class="content-cont">
                <span class="content-content">
{{$case->description}}
                </span>
                    <input type="hidden" id="caseid" value="{{$case->id}}">
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $(".back").click(function(){
            window.location.href="/personal";
        });
        $(".content-header").click(function () {
            var id;
            var url;
            id = $(this).find("#caseid").val();
            url = "/cases/" + id+"/edit";
           window.location.href=url;

        });
    });


</script>
</html>
