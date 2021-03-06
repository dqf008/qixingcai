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
  <title>期号管理 - 修改限售操作</title> 
  <meta name="" /> 
  <meta name="description" content="" /> 
 </head> 
 <body> 
  <article class="page-container"> 
   <form class="form form-horizontal"> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>号码:</label> 
     <div class="formControls col-xs-8 col-sm-9"><?php echo ($haoma); ?>
      <input type="hidden" name="qishu" value="<?php echo ($qishu); ?>" /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>号码限售:</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text" name="name" value="" maxlength="6"  onkeyup="num(this)"/> 
      <input type="hidden" name="haoma" value="<?php echo ($haoma); ?>" /> 
      <input type="hidden" name="type" value="<?php echo ($type); ?>" /> 
      <input type="hidden" name="nid" value="<?php echo ($nid); ?>" /> 
     </div> 
    </div> 
      <div class="row cl"> 
       <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3"> 
        <button class="btn btn-primary radius" type="button" id="submits">&nbsp;&nbsp;提交&nbsp;&nbsp;</button> 
       </div> 
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
  <script type="text/javascript">
  function num(obj){
      if(obj.value=='0'){
        obj.value='';
      }else{
        obj.value = obj.value.replace(/[^\d.]/g,""); //清除"数字"和"."以外的字符
      }
    
  }
$(function(){
    //提交
    $('#submits').click(function(){
      var urls="/Index/saveSales";
      var qishu=$('input[name="qishu"]').val();
      var haoma=$('input[name="haoma"]').val();
      var name=$('input[name="name"]').val();
      var type=$('input[name="type"]').val();
      var nid=$('input[name="nid"]').val();
      $.ajax({
          url: urls,
          type:"POST",
          data:{
              'qishu':qishu,
              'haoma':haoma,
              'sum':name,
              'nid':nid,
              'type':type,
          },
          async: false,
          dataType:'json',
          success: function (data) {
              if(data.code==200){
                $(".notic").html('成功');
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
.form-horizontal .form-label{
  text-align:right;
}
.col-sm-3 {
    width: 20%;
}
</style>  
 </body>
</html>