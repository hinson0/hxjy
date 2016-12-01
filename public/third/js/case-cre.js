 $(document).ready(function(){
        $(".back").click(function(){
            window.history.back();
        });
        $(".button").click(function(){
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


