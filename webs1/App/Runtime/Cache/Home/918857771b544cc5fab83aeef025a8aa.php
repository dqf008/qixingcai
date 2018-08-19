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

<link rel="stylesheet" type="text/css" href="/webs1/Public/static/h-ui/css/H-ui.min.css" />

<link rel="stylesheet" type="text/css" href="/webs1/Public/static/h-ui.admin/css/H-ui.admin.css" />

<link rel="stylesheet" type="text/css" href="/webs1/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />

<link rel="stylesheet" type="text/css" href="/webs1/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />

<link rel="stylesheet" type="text/css" href="/webs1/Public/static/h-ui.admin/css/style.css" />

<!--[if IE 6]>

<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>

<script>DD_belatedPNG.fix('*');</script>

<![endif]-->

<title>添加下级 - 下级管理</title>

<meta name="">

<meta name="description" content="">

</head>

<body>

<article class="page-container">

	<form class="form form-horizontal">

	<div class="row cl">

		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号：</label>

		<div class="formControls col-xs-8 col-sm-9"><?php echo ($data); ?></div>

	</div>

	<div class="row cl">

		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>添加信用积分：</label>

		<div class="formControls col-xs-8 col-sm-9">

			<input type="text" class="input-text integral" autocomplete="off" name="money"  value="" placeholder="" >
			<input type="hidden" name="moneys"  value="<?php echo ($moneys); ?>" />
			<input type="hidden" name="uid"  value="<?php echo ($uid); ?>" />
			<input type="hidden" name="count"  value="<?php echo ($count); ?>" />
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

<script type="text/javascript" src="/webs1/Public/lib/jquery/1.9.1/jquery.min.js"></script> 

<script type="text/javascript" src="/webs1/Public/lib/layer/2.4/layer.js"></script>

<script type="text/javascript" src="/webs1/Public/static/h-ui/js/H-ui.min.js"></script> 

<script type="text/javascript" src="/webs1/Public/static/h-ui.admin/js/H-ui.admin.js"></script>

<!--/_footer 作为公共模版分离出去-->



<!--请在下方写此页面业务相关的脚本-->

<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script> 

<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script> 

<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script>  -->

<script type="text/javascript">

$(function(){
	$('.integral').keyup(function(){
      if($(this).val()=='0'){
        $(this).val('');
      }else{
        $(this).val($(this).val().replace(/[^\d]/g, ""));
      }

    });
	//提交
	$('#submits').click(function(){

		var uid,money,moneys,count;
		uid=$('input[name="uid"]').val();
		money=$('input[name="money"]').val();
		moneys=$('input[name="moneys"]').val();
		count=$('input[name="count"]').val();
		if(uid.length=='') {
            $(".notic").html("账号名称不能空");
	        $(".notic").fadeIn().delay(1000).fadeOut();
            return false;    
        }
        if(money.length!=''){
        	var money1=count*money;
        	//alert(money1);
        	if(money<1){
				$(".notic").html("信用积分大于1");
	        	$(".notic").fadeIn().delay(1000).fadeOut();
            	return false; 
			}else if(money1>moneys){
				$(".notic").html("填写的信用积分不能大于你的账号信用积分");
	        	$(".notic").fadeIn().delay(1000).fadeOut();
            	return false; 
			}
        }

        	var urls="/webs1/index.php/User/saveMoneys1";
	        $.ajax({
	            url: urls,
	            type:"POST",
	            data:{
	                'uid':uid,
	                'money':money,
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