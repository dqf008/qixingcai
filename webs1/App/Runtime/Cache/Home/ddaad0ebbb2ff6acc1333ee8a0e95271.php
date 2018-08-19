<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="renderer" content="webkit|ie-comp|ie-stand" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
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
  <title>添加下级 - 下级管理</title> 
  <meta name="" /> 
  <meta name="description" content="" /> 
  <style>
    .col-sm-3{
      width:20%;
    }
  </style>
 </head> 
 <body> 
  <article class="page-container"> 
   <form class="form form-horizontal"> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text" value="<?php echo ($data['au_name']); ?>" placeholder="" id="adminName" name="adminName" /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号密码：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password" /> 
     </div> 
    </div> 
  <?php if(($_SESSION['autype']== 'admin') OR ($_SESSION['autype']== 'partner')): ?><div class="row cl" style="display:none"> 
  <?php else: ?>
    <div class="row cl"><?php endif; ?> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>信用积分：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text integral" id="integral" name="integral"  value="<?php echo ($data['au_money']-$data['au_moneys']); ?>" placeholder=""  /> 
     </div> 
    </div>
    <?php if($_SESSION['autype']== 'admin'): ?><div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>占成：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text" value="<?php echo ($data['au_proportion']); ?>" placeholder="" id="adminName" name="proportion" onkeyup="keyups(this)" /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>操作权限：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="checkbox" value="1" name="qishu" <?php if($data['au_qishu']==1){ echo 'checked';} ?> /> 期号管理&nbsp;&nbsp;&nbsp;
      <input type="checkbox" value="1" name="market" <?php if($data['au_market']==1){ echo 'checked';} ?> /> 销售统计 
     </div> 
    </div>  
    <?php else: ?>
      <input type="hidden" value="<?php echo ($data['au_proportion']); ?>" placeholder="" id="adminName" name="proportion" /> 
      <input type="hidden" value="<?php echo ($data['au_qishu']); ?>" name="qishu" /> 
      <input type="hidden" value="<?php echo ($data['au_market']); ?>" name="market" /><?php endif; ?>

    <?php if($_SESSION['autype']== 'agencys'): ?><div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>拦货占成：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
        <select name="zancheng" style="padding:4px 10px">
          <option value="0" <?php if(empty($data['au_proportion'])){ echo 'selected';} ?> >0</option>
          <option value="10" <?php if($data['au_proportion']==10){ echo 'selected';} ?> >10</option>
          <option value="20" <?php if($data['au_proportion']==20){ echo 'selected';} ?> >20</option>
          <option value="30" <?php if($data['au_proportion']==30){ echo 'selected';} ?> >30</option>
          <option value="40" <?php if($data['au_proportion']==40){ echo 'selected';} ?> >40</option>
          <option value="50" <?php if($data['au_proportion']==50){ echo 'selected';} ?> >50</option>
          <option value="60" <?php if($data['au_proportion']==60){ echo 'selected';} ?> >60</option>
          <option value="70" <?php if($data['au_proportion']==70){ echo 'selected';} ?> >70</option>
          <option value="80" <?php if($data['au_proportion']==80){ echo 'selected';} ?> >80</option>
          <option value="90" <?php if($data['au_proportion']==90){ echo 'selected';} ?> >90</option>
          <option value="100" <?php if($data['au_proportion']==100){ echo 'selected';} ?> >100</option>
        </select>
     </div> 
    </div><?php endif; ?>
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text" value="<?php echo ($data['au_phone']); ?>" placeholder="" id="phone" name="phone" /> 
      <input type="hidden" name="uid" value="<?php echo ($data['au_id']); ?>" /> 
      <input type="hidden" name="umoney" value="<?php echo ($data['au_money']-$data['au_moneys']); ?>" /> 
      <input type="hidden" name="money" value="<?php echo ($data1['au_money']-$data1['au_moneys']); ?>" /> 
      <input type="hidden" name="status" value="<?php echo ($status); ?>" /> 
      <input type="hidden" name="status1" value="<?php echo ($status1); ?>" /> 
      <input type="hidden" name="uproportion" value="<?php echo ($users); ?>" /> 
      <input type="hidden"name="proportions"  value="<?php echo ($data['au_proportion']); ?>"  /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3">备注：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <textarea name="content" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="$.Huitextarealength(this,100)"><?php echo ($data['au_remark']); ?></textarea> 
      <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p> 
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
 function keyups(Obj){
     if($(Obj).val()=='0'){
        $(Obj).val('');
      }else{
        $(Obj).val($(Obj).val().replace(/[^\d]/g, ""));
      }
  }
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
    		var name,password,password2,phone,email,type,integral,uid,money,status,umoney,proportion;
    		name=$('input[name="adminName"]').val();
    		password=$('input[name="password"]').val();
    		phone=$('input[name="phone"]').val();
    		integral=$('input[name="integral"]').val();
    		uid=$('input[name="uid"]').val();
        money=$('input[name="money"]').val();
        umoney=$('input[name="umoney"]').val();
        status=$('input[name="status"]').val();
    		var status1=$('input[name="status1"]').val();
        content=$('textarea[name="content"]').val();
        proportion=$('input[name="proportion"]').val();
       var  proportions=$('input[name="proportions"]').val();
       var  uproportion=$('input[name="uproportion"]').val();
        market=$('input[name="market"]:checked').val();
        qishu=$('input[name="qishu"]:checked').val();
    		var zancheng=$('select[name="zancheng"] option:selected').val();

    		if(name.length=='') {
            $(".notic").html("账号名称不能空");
            $(".notic").fadeIn().delay(1000).fadeOut();
            return false;    
        }else if(!isRegisterUserName(name)){
            	$(".notic").html("账号名称小写字母开头5~18长度以内的字母、数字和下划线的组合");
    	        $(".notic").fadeIn().delay(1000).fadeOut();
              return false; 
        }else{
           		var dataStatus=inputFinds(name,uid);
    			if(dataStatus==true){
    				$(".notic").html("账号名称存在");
    	      $(".notic").fadeIn().delay(1000).fadeOut();
            return false; 
    			}
        }
        if(uid.length==''){
            if(password.length=='') {
              $(".notic").html("密码不能空");
              $(".notic").fadeIn().delay(1000).fadeOut();
              return false;    
            }else if(!isRegisterUserPwds(password)){
              $(".notic").html("密码小写字母开头4~18长度以内的字母、数字的组合");
              $(".notic").fadeIn().delay(1000).fadeOut();
              return false; 
            }
        }
     
        if(status.length!='' ){
          if((integral-umoney)> money){
            $(".notic").html("填写的信用积分不能大于你的账号信用积分");
            $(".notic").fadeIn().delay(1000).fadeOut();
            return false;
          }
        }
        if(status1>=1){
          if((proportion+uproportion-proportions)> 100){
            $(".notic").html("填写的分成比不能大于100");
            $(".notic").fadeIn().delay(1000).fadeOut();
            return false;
          }
        }
        	var urls="/User/saveUser";
	        $.ajax({
	            url: urls,
	            type:"POST",
	            data:{
	                'name':name,
	                'phone':phone,
	                'integral':integral,
	                 'uid':uid,
	                'password':password,
                  'content':content,
                  'proportion':proportion,
                  'qishu':qishu,
                  'market':market,
	                'zancheng':zancheng,
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

    /*

    *是否存在

     */

    function  inputFinds(name,uid){
        var returns=true;
        var urls="/User/findUser";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'uid':uid,
                'name':name,
            },
            async: false,
            dataType:'json',
            success: function (data) {
             if(data.code==true){
                returns=true;
              }else{
                returns=false;
              }
            }
          });
        return returns;
      }

     function isRegisterUserName(s){//账号验证   
		var patrn=/^[a-z]{1}([a-z0-9]|[._]){4,19}$/;   
		if (!patrn.exec(s))return false 
		return true 
	}
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