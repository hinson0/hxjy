<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/expcre.css"/>
    <link rel="stylesheet" href="/third/css/top.css"/>
    <title>个人主页</title>
</head>
<body>
<div class="box">
    <header>
        <div class="header">
            <div class="top">
                <a href="/exps"><i class="back">

                    </i></a>
                <span class="title">
                       教学经历
                    </span>
                <span class="button">
                        保存
                </span>
            </div>
        </div>
    </header>
    <section>
        <div class="center">
            <form action="#">
                {{ csrf_field() }}
                <div class="center-title" data-id="<?php echo $exp->id; ?>">
                    <span>标题</span> <input type="text" id="title" value="<?php echo $exp->title;?>" placeholder="请输入标题，20字以内"/>
                </div>
                <div class="center-date">
                    <span>开始时间</span> <input type="month" class="date-star" value="<?php echo $exp->start_time; ?>" />
                </div>
                <div class="center-date">
                    <span>结束时间</span><input type="month" class="date-over" value="<?php echo $exp->end_time; ?>"/>
                </div>
                <div class="textarea">
                    <textarea maxlength="200" class="des" placeholder="描述您曾经任职的学校和岗位 具体的教学内容，科研成果等 20-255字之间"><?php echo $exp->description; ?></textarea>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <button type="button" id="del">删除</button>
    </footer>

</div>
</body>
<script type="text/javascript" src="/third/js/mom.js"></script>
<script type="text/javascript">
    $("document").ready(function() {
        startime();
        endtime();
        Ajax();
        $("#del").click(function(){
            var id=$(".center-title").attr("data-id");
            var url="/exps/"+id;
            $.ajax({
                url:url,
                type:'delete',
                datatype:'json',
                data:{
                  _token:$("input[name='_token']").val()
                },
                success:function(data){
                    if(data.msg=='删除成功'){
                        window.location.href="/exps";
                    }
                }
            })
        });

    });
    function startime(){
        moment.locale('zh-cn');
            var time = $(".date-star")[0].defaultValue;
            var k = time * 1000;
            var thistime = moment(k).format('YYYY-MM');
            $(".date-star")[0].defaultValue = thistime;
        };
    function endtime(){
        var time = $(".date-over")[0].defaultValue;
        var k = time * 1000;
        var thistime = moment(k).format('YYYY-MM');
        $(".date-over")[0].defaultValue = thistime;
    }
    function Ajax(){
            $(".button").click(function(){
                var id=$(".center-title").attr("data-id");
                var url="/exps/"+id;
                console.log(id);
                var exp={
                    title:$("#title").val(),
                    start_time:$(".date-star").val(),
                    end_time:$(".date-over").val(),
                    _token:$("input[name='_token']").val(),
                    description:$(".des").val()
                };
                $.ajax({
                    url:url,
                    type:'put',
                    datatype:'json',
                    data:exp,
                    success:function(data){
                        if(data.msg=='保存成功'){
                            window.location.href="/exps";
                        }
                        console.log(data);
                    }
                })
            });
    };
</script>

</html>