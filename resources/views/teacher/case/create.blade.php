<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/third/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/third/css/top.css"/>
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
                    标题 <input type="text" class="title-inp" placeholder="请输入标题，20字以内">
                </div>
                <div class="msg">
                    <textarea name="" id="" minlength="20" maxlength="200" class="textarea"
                              placeholder="描述您曾经任职的学校及岗位 具体的教学内容，教研成果等（25-200字）"></textarea>
                </div>
            </form>
        </div>
    </section>

</div>
</body>
<script type="text/javascript" src="/third/js/case-cre.js"></script>

</html>
