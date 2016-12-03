<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/infoshow.css"/>
    <link rel="stylesheet" href="/third/css/top.css"/>
    <title>个人主页</title>
</head>
<body>
<div class="box">
    <header>
        <div class="header">
            <div class="top">
                <a href="/honours">
                <i class="back">

                </i></a>
                <span class="title">
                       奖励荣誉
                    </span>
                <span class="button">
                        保存
                </span>
            </div>
        </div>
    </header>
    <section>
        <form action="#">
            {{ csrf_field() }}
            <div class="honour-box">
                <div class="honour-content">
                    <div class="honour-con-box">
                        <textarea minlength="20" maxlength="255" class="present" placeholder="请输入相关荣誉介绍，20字-255字"></textarea>


                    </div>
                    <div class="honour-img">
                        <span class="create-img"></span>
                    </div>
                    <div class="create-span">
                        最多上传5张
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $(".button").click(function(){
           var hon={
               description:$(".present").val(),
               _token:$("input[name='_token']").val(),
               photos:['dddd','dddddd']
           };
           $.ajax({
             url:'/honours',
               type:'post',
               datatype:'json',
               data:hon,
               success:function(data){
                 if(data.msg=='保存成功'){
                     window.location.href='/honours'
                 }
               },
           });
        });
    });
</script>
</html>