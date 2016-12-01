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
                <i class="back">

                </i>
                <span class="title">
                       基本信息
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
            <div class="head">
                <span class="head-left">
                头像
                </span>
                <span class="head-right">

                </span>
                <i class="arrow">

                </i>
            </div>
            <ul class="msg">
                <li class="head">
                     <span class="head-left">
                姓名
                </span>
                    <span class="head_right">
              <input type="text" class="name" value="黄子义" />
                </span>
                </li>
                <li class="head">
                <span class="head-left">
               昵称
                </span>
                    <span class="head_right">
                      <input type="text" class="nickname" value="二师兄">
                </span>
                </li>
                <li class="head">
 <span class="head-left">
                性别
                </span>
                    <span class="head_right">
               <select  id="sex">
                   <option value="男">男</option>
                   <option value="女">女</option>
               </select>
                </span>
                </li>
                <li class="head">
 <span class="head-left">
                是否在职
                </span>
                    <span class="head_right">
               <select  id="online">
                   <option value="是">是</option>
                   <option value="否">否</option>
               </select>
                </span>
                </li>
                <li class="head">
 <span class="head-left">
                教龄
                </span>
                    <span class="head_right">
                        <select id="old">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
               年
                </span>
                </li>
            </ul>
        </form>
    </section>
</div>
</body>
</html>