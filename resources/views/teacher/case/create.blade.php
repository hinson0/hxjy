<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/top.css" />
    {{--<link rel="stylesheet" href="/third/css/bottom.css"/>--}}
    <title>教学经历</title>
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
                    <span class="buttom">
                        保存
                    </span>
                </div>
            </div>
    </header>











    <span class="of">确定</span>










<section>
    <div class="form">
        <form action="">
            {{ csrf_field() }}
            <div class="title">

               标题 <input type="text" class="title-inp">
            </div>
            <div class="text">
                <textarea rows="25" cols="50" placeholder="教学经历" class="textarea">

                </textarea>
            </div>
        </form>
    </div>
</section>
</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
$(".of").click(function(){
   var Json={
       title:$(".title-inp").val(),
       description:$(".textarea").val(),
       _token:$("input[name='_token']").val()
   };
   $.ajax({
       url:'/cases',
       type:'post',
       datatype:"json",
       data:Json,
       success:function(data){
          if(data.msg=="保存成功"){
              window.location.href = "/cases";
          }
       }
   })
});
});

</script>

</html>
