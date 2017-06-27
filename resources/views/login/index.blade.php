<!DOCTYPE html>
<html lang="en">
<head>
    <title>资芽早报</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/unicorn.login.css')}}" />
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/unicorn.login.js')}}"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<style>
    .login-class{display:inline-block;vertical-align: 10px }
    .user-limit{color: red;display: none}
    .pwd-limit{color: red;display: none}
    .tit-tac{text-align:center;}
    .del-tac{text-align: left;padding-left:54px;}
</style>
<body>
<div id="logo">
    <img src="{{asset('img/logo.png')}}" alt="" />
</div>
<div id="loginbox">
    <p class="tit-tac">请输入用户名和密码</p>
    <div class="control-group del-tac">
        <div class="controls login-class">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span><input type="text" id="user" placeholder="用户名" />
            </div>
        </div>
        <span class="user-limit" >*必填</span>
    </div>
    <div class="control-group del-tac">
        <div class="controls login-class">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" placeholder="密码" />
            </div>
        </div>
        <span class="pwd-limit">*必填</span>
    </div>
    <div class="form-actions">
        {{--  <span class="pull-left"><a href="#" class="flip-link" id="to-recover">Lost password?</a></span>--}}
        <span class="pull-right"><input type="submit" class="btn btn-inverse" value="登录" /></span>
    </div>
</div>
</body>
<script>
    $(".btn").on("click",function(){
        var user=$("#user").val();
        var password=$("#password").val();
        if(!user){
            $(".user-limit").show();
            return false;
        };
        if(!password){
            $(".pwd-limit").show();
            return false;
        };
        $.ajax({
            url:"{{asset('login/handle')}}",
            data:{"user":user,"password":password},
            dataType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="user"){
                    $(".user-limit").show();
                    $(".user-limit").html(res['msg']);
                }else if(res['code']=="pwd"){
                    $(".pwd-limit").show();
                    $(".pwd-limit").html(res['msg']);
                }else{
                    url=res['lds_url'];
                    window.location.href="http://paper.com/"+url;
                }
            }
        });
    });
</script>
</html>

