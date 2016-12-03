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
                <a href="/personal"><i class="back">

                </i></a>
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
              <input type="text" class="name" value="<?php if(!empty($info))echo $info->name ?>" />
                </span>
                </li>
                <li class="head">
                <span class="head-left">
               昵称
                </span>
                    <span class="head_right">
                      <input type="text" class="nickname" value="<?php if(!empty($info))echo $info->nickname ?>">
                </span>
                </li>
                <li class="head">
 <span class="head-left">
                性别
                </span>
                    <span class="head_right">
               <select  id="sex">
                   <option value="1" <?php if(!empty($info))if($info->gender==1)echo "selected"?>>男</option>
                   <option value="2" <?php if(!empty($info))if($info->gender==2)echo "selected"?>>女</option>
               </select>
                </span>
                </li>
                <li class="head">
 <span class="head-left">
                是否在职
                </span>
                    <span class="head_right">
               <select  id="online">
                   <option value="1" <?php if(!empty($info))if($info->onjob==1)echo "selected"?>>是</option>
                   <option value="0" <?php if(!empty($info))if($info->onjob==0)echo "selected"?>>否</option>
               </select>
                </span>
                </li>
                <li class="head">
 <span class="head-left">
                教龄
                </span>
                    <span class="head_right">
                        <select id="old" >
                            <option value="0" <?php if(!empty($info))if($info->teaching_age==0)echo "selected"?>>0</option>
                            <option value="1"<?php if(!empty($info))if($info->teaching_age==1)echo "selected"?>>1</option>
                            <option value="2"<?php if(!empty($info))if($info->teaching_age==2)echo "selected"?>>2</option>
                            <option value="3"<?php if(!empty($info))if($info->teaching_age==3)echo "selected"?>>3</option>
                        </select>
               年
                </span>
                </li>
            </ul>
        </form>
    </section>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
       $(".button").click(function(){
//           var onjob;
//           var gender;
//           if($("#online").val()=="是"){
//              onjob=1;
//           }else if($("#online").val()=="否"){
//                onjob=0;
//           };
//           if($("#sex").val()=="男"){
//                gender=1;
//           }else if($("#sex").val()=="女"){
//                gender=2;
//           };

           var info={
               name:$(".name").val(),
               nickname:$(".nickname").val(),
               teaching_age:$("#old").val(),
               onjob:$("#online").val(),
               avatar:"ddd",
               gender:$("#sex").val(),
               _token:$("input[name='_token']").val()
           };
//           console.log(info)
           $.ajax({
               url:'/info/save',
               type:'post',
               data:info,
               datatype:'json',
               success:function(data){
                   if(data.msg=="保存成功"){
                       window.location.reload();
                   }
               }
           });
       });
    });
</script>
</html>
