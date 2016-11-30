<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<link rel="stylesheet" href="/third/css/my.css" />--}}
    {{--<link rel="stylesheet" href="/third/css/bottom.css"/>--}}
    <title>个人主页</title>
    <style type="text/css">
        .header{
            width:100%;
            background-color: #24b5ff;
            height:3em;
        }
    </style>
</head>
<body>
<div class="box">
            <div class="header">
               <i></i><span>教学经历</span>
                <a href="/cases/create">新增</a>
            </div>
    @foreach($cases as $case)
        <div>
            <span>{{$case->title}}</span>
        </div>
        @endforeach
</div>
</body>

</html>
