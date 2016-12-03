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
                <a href="/schools"><i class="back">

                    </i></a>
                <span class="title">
                       毕业院校
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
                <div class="center-title">
                    <span>学校名称</span> <input type="text" id="title" placeholder="请输入学校名称"/>
                </div>
                <div class="center-date">
                    <span>开始时间</span> <input type="month" class="date-star" />
                </div>
                <div class="center-date">
                    <span>结束时间</span><input type="month" class="date-over"/>
                </div>
                <div class="center-date">
                    <span>最高学历</span> <select  id="degree"  style="width: 60%; height: 2.5em;line-height: 2.5em;border: none;outline: none;">
                        <option value="1">
                            专科
                        </option>
                        <option value="2">
                            本科
                        </option>
                        <option value="3">
                            硕士
                        </option>
                        <option value="4">
                            博士
                        </option>
                    </select>
                </div>
                <div class="center-date">
                    <span>专业</span> <input type="text" id="major" placeholder="专业" />
                </div>
            </form>
        </div>
    </section>

</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $(".button").click(function(){
            var school={
                name:$("#title").val(),
                start_time:$(".date-star").val(),
                end_time:$(".date-over").val(),
                _token:$("input[name='_token']").val(),
                major:$("#major").val(),
                degree:$("#degree").val()
            };
           console.log(school);
            $.ajax({
                url:'/schools',
                type:'post',
                datatype:'json',
                data:school,
                success:function(data){
                    if(data.msg=='保存成功'){
                        window.location.href="/schools";
                    }
                }
            })
        });
    });
</script>
</html>