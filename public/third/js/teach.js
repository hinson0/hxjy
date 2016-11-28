$(document).ready(function () {
    $(".back").click(function(){
        window.history.back();
    });
    $("input[type='text']").focusin(function(){
        $(".tel").html(" ");
    });
    $("input[type='password']").focusin(function(){
        $(".passw").html(" ");
    });
    $("#sub").click(function () {
        if ($("#tel").val() == "") {
            $(".tel").html("请输入手机号码");
        }
        else if ($("#password").val() == "") {
            $(".passw").html("请输入密码");
        }
        else {
            var JSon = {
                tel: $("#tel").val(),
                _token: $("input[name='_token']").val(),
                password: $("#password").val(),
            };
            $.ajax({
                url: '/dologin',
                type: 'post',
                data: JSon,
                datatype: 'json',
                statusCode: {
                    422: function () {
                        $(".tel").html("账号格式错误");
                    },
                    404: function () {
                        alert('页面加载失败，请稍后再试');
                    }, 403: function (data) {
                        if (data.responseJSON.msg == '密码错误') {
                            $(".passw").html(data.responseJSON.msg+"请注意大小写");
                        }
                        else if (data.responseJSON.msg == '账号不存在') {
                            $(".tel").html(data.responseJSON.msg);
                        }
                        else {
                            console.log(data)
                        }

                    }
                },
                success: function (data, textStatus) {
                    console.log(data);
                    if (data.msg == "用户不存在") {
                        $(".tel").html(data.msg);
                    }
                    else if (data.msg == "密码错误") {
                        $(".passw").val(data.msg);
                    }
                    else if (data.msg == "登录成功") {
                        window.location.href = "/home";
                    }
                    else {
                        alert("登录失败");
                    }
                }
            })
        }
    })
})
