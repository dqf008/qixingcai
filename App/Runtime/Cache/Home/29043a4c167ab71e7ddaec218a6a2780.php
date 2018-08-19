<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>欢迎登陆</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="shortcut icon" href="/Public/images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon-precomposed" href="/Public/assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/Public/assets/css/amazeui.min.css" />
  <link rel="stylesheet" href="/Public/assets/css/admin.css">
  <link rel="stylesheet" href="/Public/assets/css/app.css">
</head>

<body data-type="login">

  <div class="am-g myapp-login">
	<div class="myapp-login-logo-block  tpl-login-max">
		<div class="myapp-login-logo-text">
			<div class="myapp-login-logo-text">
				<span> 非凡想象 • 引发无限可能</span>
				
			</div>
		</div>

		<div class="login-font">

		</div>
		<div class="am-u-sm-10 login-am-center">
			<form class="am-form"  method="post" id="loginfrm" name="loginfrm">
				<input type="hidden" id="sid" name="sid" value="HHZsNR">
				<input type="hidden" name="loginaction" value="1">
				<input type="hidden" name="Hrand" value="174757993">
				<fieldset>
					<div class="am-form-group">
						<input type="email" id="username" name="username"  placeholder="请输入您的账号"  required="required">
					</div>
					<div class="am-form-group">
						<input type="password" id="password" name="password" placeholder="密码" placeholder="在此输入密码"  required="required">
					</div>
					<p><button type="button" class="am-btn am-btn-default" onclick="userlogin()">登  录</button></p>
				</fieldset>
			</form>
		</div>
		<div class="myapp-login-logo-text" style="font-size: large;">
			<div class="notic"></div>
		</div>
	</div>
</div>

  <script src="/Public/assets/js/jquery.min.js"></script>
  <script src="/Public/assets/js/amazeui.min.js"></script>
  <script src="/Public/assets/js/app.js"></script>
  <script>

      function userlogin(){
          var uname,upassword
          uname=$('input[name="username"]').val();
          upassword=$('input[name="password"]').val();
          //alert(uname+'===>'+upassword);
          if(uname==''){
              $(".notic").html("请填写账号");
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
</body>

</html>