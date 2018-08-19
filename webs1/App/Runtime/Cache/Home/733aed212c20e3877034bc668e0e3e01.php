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
  <title>添加赚水</title> 
  <meta name="" /> 
  <meta name="description" content="" /> 
 </head> 
 <body> 
  <article class="page-container"> 
   <form class="form form-horizontal"> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号：</label> 
     <div class="formControls col-xs-8 col-sm-9">
        <select name="user" class="select">
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['au_id'] == $data1['au_id']): ?><option value="<?php echo ($vo["au_id"]); ?>" selected><?php echo ($vo["au_name"]); ?></option> 
            <?php else: ?> 
              <option value="<?php echo ($vo["au_id"]); ?>"><?php echo ($vo["au_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
         
        </select>
     </div> 
    </div> 
     <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>期号：</label> 
     <div class="formControls col-xs-8 col-sm-9">
        <select name="qishu" class="select">
          <?php if(is_array($qishus)): $i = 0; $__LIST__ = $qishus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $data1['qid']): ?><option value="<?php echo ($vo["id"]); ?>,<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option> 
            <?php else: ?> 
             <option value="<?php echo ($vo["id"]); ?>,<?php echo ($vo["qishu"]); ?>" ><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
         
        </select>
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>添加赚水：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text integral" autocomplete="off" name="sums" value="<?php echo ($data1['sums']); ?>" placeholder="" /> 
      <input type="hidden" name="mid" value="<?php echo ($data1['id']); ?>" /> 
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
  $('.integral').keyup(function(){
      if($(this).val()=='0'){
        $(this).val('');
      }else{
        $(this).val($(this).val().replace(/[^\d]/g, ""));
      }

    });
	//提交
	$('#submits').click(function(){

		var mid,auid,qishu,sums;
		mid=$('input[name="mid"]').val();
    auid=$('select[name="user"] option:selected').val();
		qishu=$('select[name="qishu"] option:selected').val();
    sums=$('input[name="sums"]').val();
		if(auid==''){
      $(".notic").html("用户不能空");
      $(".notic").fadeIn().delay(1000).fadeOut();
      return false;    
    }
    if(qishu==''){
      $(".notic").html("期数不能空");
      $(".notic").fadeIn().delay(1000).fadeOut();
      return false;    
    }
    if(sums==''){
      $(".notic").html("赚水不能空");
      $(".notic").fadeIn().delay(1000).fadeOut();
      return false;    
    }


        	var urls="/Data/saveBackwater";
	        $.ajax({
	            url: urls,
	            type:"POST",
	            data:{
	                'mid':mid,
                  'auid':auid,
                  'qishu':qishu,
	                'sums':sums
	            },
	            async: false,
	            dataType:'json',
	            success: function (data) {
	                if(data.code==true){
	                  $(".notic").html(data.titles);
	                  $(".notic").fadeIn().delay(1000).fadeOut(); 
	                }else{
	                  $(".notic").html(data.titles);
	                  $(".notic").fadeIn().delay(1000).fadeOut(); 		
	                }
	   				      //setTimeout('parent.window.location.href="'+data.urls+'";',3000);
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
.select{
  width:200px;
  padding:5px;
}
.form-horizontal .form-label {
    text-align:right;
}
.col-xs-4{
  width:25%;
  
}
</style>  
 </body>
</html>