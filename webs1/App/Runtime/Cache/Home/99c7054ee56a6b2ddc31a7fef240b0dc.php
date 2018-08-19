<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>账号 - 个人设置</title>
<meta name="">
<meta name="description" content="">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号：</label>
		<div class="formControls col-xs-8 col-sm-9"><?php echo ($data['au_name']); ?></div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>信用积分：</label>
		<div class="formControls col-xs-8 col-sm-9"><?php echo ($data['au_money']); ?></div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>联系方式：</label>
		<div class="formControls col-xs-8 col-sm-9"><input type="text" name="phone"  value="<?php echo ($data['au_phone']); ?>" /></div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>修改密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text"  name="password"  value="" placeholder="" >
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<button class="btn btn-primary radius" type="button" id="submits">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
<!--请在下方写此页面业务相关的脚本-->

<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script> 

<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script> 

<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script>  -->

<script type="text/javascript">
$(function(){
	//提交
	$('#submits').click(function(){
		var phone,password;
		phone=$('input[name="phone"]').val();
		password=$('input[name="password"]').val();
        if(password.length!=''){
            if(!isRegisterUserPwds(password)){
              $(".notic").html("密码小写字母开头4~18长度以内的字母、数字的组合");
              $(".notic").fadeIn().delay(1000).fadeOut();
              return false; 
            }
        }
    	var urls="/User/saveAdmins";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'phone':phone,
                'password':password,
            },
            async: false,
            dataType:'json',
            success: function (data) {
                if(data.code==true){
                  $(".notic").html(data.titles);
                  $(".notic").fadeIn().delay(1000).fadeOut(); 
                }
   				setTimeout('parent.window.location.href="'+data.urls+'";',3000);
            }

          });

	});
});

function isRegisterUserPwds(s){//密码验证   
        var patrn=/^[a-z0-9]{4,18}$/;   
        if (!patrn.exec(s))return false 
        return true 
    }
</script> 

<!--/请在上方写此页面业务相关的脚本-->
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
</body>
</html>