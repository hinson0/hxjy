<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/top.css" />
    <link rel="stylesheet" href="/third/css/cases-cre.css"/>
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
                <span class="button">
                        保存
                    </span>
            </div>
        </div>
    </header>

    <section>
        <div class="form">
            <form action="">
                {{ csrf_field() }}
                <div class="body-title">
                    标题 <input type="text" class="title-inp" placeholder="请输入标题，20字以内" value="<?php echo $case->title; ?>">
                </div>
                <input type="hidden" value="<?php echo $case->id; ?>" id="caseid">
                <div class="msg">
                    <textarea name="" id="" minlength="20" maxlength="200"  class="textarea" placeholder="描述您曾经任职的学校及岗位 具体的教学内容，教研成果等（25-200字）"><?php echo $case->description; ?></textarea>
                </div>
            </form>
        </div>
        <div class="dele">
            <botton id="del">删除</botton>
        </div>

    </section>

</div>
</body>
<script type="text/javascript">
            $(document).ready(function() {
                $(".back").click(function(){
                   window.location.href="/cases";
                });
                $(".button").click(function () {
                    var id;
                    id = $("#caseid").val();
                    var url = "/cases/" + id;
                    var caseJson={
                      title:$(".title-inp").val(),
                        description:$(".textarea").val(),
                        _token:$("input[name='_token']").val()
                    };
                    $.ajax({
                        url: url,
                        type: 'put',
                        data:caseJson,
                        datatype: 'json',
                        success: function (data) {
                            if(data.msg=='保存成功'){
                                window.location.href="/cases";
                            }
                        }
                    });

                });
                $("#del").click(function(){
                    var id;
                    id = $("#caseid").val();
                    var url = "/cases/" + id;
                    $.ajax({
                        url: url,
                        type: 'delete',
                        datatype: 'json',
                        data:{
                          _token:$("input[name='_token']").val()
                        },
                        success: function (data) {
                            if(data.msg=='删除成功'){
                                window.location.href="/cases";
                            }

                        }
                    });
                });
            });


</script>

</html>