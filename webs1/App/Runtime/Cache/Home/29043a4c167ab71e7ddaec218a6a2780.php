<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!-- <script src="js/32bd2eb79b1644afa5e01978c6fa46a9.js" defer></script>  -->                        
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目管理系统后台登录界面模板</title>

<style type="text/css">
*{padding:0px;margin:0px;}
body{font-family:Arial, Helvetica, sans-serif;background:url(/Public/images/grass.jpg) no-repeat 50% 0;font-size:12px;}
img{border:0;}
.lg{width:468px;height:468px;margin:100px auto;background:url(/Public/images/login_bg.png) no-repeat;}
.lg_top{ height:200px;width:468px;}
.lg_main{width:400px;height:180px;margin:0 25px;}
.lg_m_1{width:290px;height:100px;padding:60px 55px 20px 55px;}
.ur{height:37px;line-height:37px;border:0;color:#666;width:236px;margin:4px 28px;background:url(/Public/images/user.png) no-repeat;padding-left:10px;font-size:12px;font-family:Arial, Helvetica, sans-serif;}
.pw{height:37px;line-height:37px;border:0;color:#666;width:236px;margin:4px 28px;background:url(/Public/images/password.png) no-repeat;padding-left:10px;font-size:12px;font-family:Arial, Helvetica, sans-serif;}
.bn{width:330px;height:72px;background:url(/Public/images/enter.png) no-repeat;border:0;display:block;font-size:18px;color:#FFF;font-family:Arial, Helvetica, sans-serif;font-weight:bolder;cursor:pointer;}
.lg_foot{height:80px;width:330px;padding: 6px 68px 0 68px;}
</style>
<script language="javascript" src="/Public/js/jquery-1.7.2.min.js"></script>
</head>

<body>

<div class="lg">
<form>
    <div class="lg_top"></div>
    <div class="lg_main">
        <div class="lg_m_1">
        
        <input name="uname" placeholder="用户名" value="" class="ur" />
        <input name="upwds" placeholder="密码" type="password" value="" class="pw" />
        
        </div>
    </div>
    <div class="lg_foot">
    <input type="button" onclick="userlogin()" value="登录" class="bn" /></div>
</form>
</div>
<!-- <div style="text-align:center;">

</div>
 -->
</body>
<script>
  
  function userlogin(){
    var uname,upassword
    uname=$('input[name="uname"]').val();
    upassword=$('input[name="upwds"]').val();
     //alert(uname+'===>'+upassword);
    if(uname==''){
      $(".notic").html("请填写用户名");
      $(".notic").fadeIn().delay(1000).fadeOut();
      return false;
    }
    if(upassword==''){
      $(".notic").html("请填写密码");
      $(".notic").fadeIn().delay(1000).fadeOut();
      return false;
    }else{
      var urls='/Login/register';
      $.ajax({
        url: urls,
        type:"POST",
        data:{
            'uname':uname,
            'upassword':upassword,
        },
        cache: false,
        dataType:'json',
        success: function (data) {
          
          if(data.code==true){
            window.location.href=data.urls;
          }else{
            $(".notic").html(data.titles);
            $(".notic").fadeIn().delay(1000).fadeOut();
            return false;
          }
            
           
        },
        error: function () {
            alert('网络有问题,请重新提交',"cancel");
        }
      });


    }

  }

</script>

<div class="notic"></div>

<style>

.notic {

    position: fixed;

    top: 40%;

    left: 30%;

    width: 40%;

    box-sizing: border-box;

    margin: 0 auto;

    text-align: center;

    background-color: #000;

    color: #fff;

    padding: 30px;

    opacity: 0.6;

    border-radius: 10px;

    display: none;

    z-index: 999;

}

</style>
</html>