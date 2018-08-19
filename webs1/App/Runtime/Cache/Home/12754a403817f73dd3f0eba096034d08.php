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
 </head> 
 <body> 
  <article class="page-container"> 
   <form class="form form-horizontal"> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号：</label> 
     <div class="formControls col-xs-8 col-sm-9"><?php echo ($data['au_name']); ?></div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级分配：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
     <?php echo ($data['au_proportion']); ?>%
     <input type="hidden" name="uproportion" value="<?php echo ($data['au_proportion']); ?>" >
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>拦货分成：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
        <select name="zancheng">
        <option value="0" <?php if(empty($data1['percent'])){ echo 'selected';} ?> >0</option>
       
          <option value="10" <?php if($data1['percent']==10){ echo 'selected';} ?> >10</option>
          <option value="20" <?php if($data1['percent']==20){ echo 'selected';} ?> >20</option>
          <option value="30" <?php if($data1['percent']==30){ echo 'selected';} ?> >30</option>
          <option value="40" <?php if($data1['percent']==40){ echo 'selected';} ?> >40</option>
          <option value="50" <?php if($data1['percent']==50){ echo 'selected';} ?> >50</option>
          <option value="60" <?php if($data1['percent']==60){ echo 'selected';} ?> >60</option>
          <option value="70" <?php if($data1['percent']==70){ echo 'selected';} ?> >70</option>
          <option value="80" <?php if($data1['percent']==80){ echo 'selected';} ?> >80</option>
          <option value="90" <?php if($data1['percent']==90){ echo 'selected';} ?> >90</option>
          <option value="100" <?php if($data1['percent']==100){ echo 'selected';} ?> >100</option>
        </select>&nbsp;&nbsp;不得超出上级分配的占成比
     </div> 
    </div> 
      <div class="row cl"> 
       <label class="form-label col-xs-4 col-sm-3">拦货配置：</label> 
       <div class="formControls col-xs-8 col-sm-9"> 
        <table width="400" border="1" cellspacing="0" cellpadding="0" style="solid 1px #ddd"> 
         <tbody>
          <tr> 
           <td width="50" height="28" align="center" bgcolor="#FFFFFF">类型</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">说明</td> 
          <!--  <td width="80" height="28" align="center" bgcolor="#FFFFFF">上级给的基本赔率</td>  -->
           <td width="100" height="28" align="center" bgcolor="#FFFFFF">拦货金额</td> 
          </tr> 
          <tr> 
           <td width="50" height="28" align="center" bgcolor="#FFFFFF">二定</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"></td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding21" value="<?php echo ($data1['ding21']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <!-- <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">口X口X</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding22" value="<?php echo ($data1['ding22']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">X口X口</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding23" value="<?php echo ($data1['ding23']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">X口口X</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding24" value="<?php echo ($data1['ding24']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">XX口口</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding25" value="<?php echo ($data1['ding25']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">口口XX</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding26" value="<?php echo ($data1['ding26']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr>  -->
          <tr> 
           <td width="50" height="28" align="center" bgcolor="#FFFFFF">三定</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"></td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding31" value="<?php echo ($data1['ding31']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
         <!--  <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">口口X口</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding32" value="<?php echo ($data1['ding32']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">口X口口</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding33" value="<?php echo ($data1['ding33']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> 
          <tr>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">X口口口</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding34" value="<?php echo ($data1['ding34']); ?>" onkeyup="keyups(this)" /> </td>  
          </tr> -->
          <tr> 
           <td width="50" align="center" bgcolor="#FFFFFF">四定位</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="ding41" value="<?php echo ($data1['ding41']); ?>" onkeyup="keyups(this)" /> </td> 
          </tr>
          <tr> 
           <td width="50" align="center" bgcolor="#FFFFFF">二字现</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="xian21" value="<?php echo ($data1['xian21']); ?>" onkeyup="keyups(this)" /> </td> 
          </tr>
          <tr> 
           <td width="50" align="center" bgcolor="#FFFFFF">三字现</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="xian31" value="<?php echo ($data1['xian31']); ?>" onkeyup="keyups(this)" /> </td> 
          </tr>
          <tr> 
           <td width="50" align="center" bgcolor="#FFFFFF">四字现</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td>
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">￥<input type="text" name="xian41" value="<?php echo ($data1['xian41']); ?>" onkeyup="keyups(this)" /> </td> 
          </tr>
         </tbody>
        </table> 
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
    // $('.skin-minimal input').iCheck({

    //  checkboxClass: 'icheckbox-blue',

    //  radioClass: 'iradio-blue',

    //  increaseArea: '20%'

    // });

    //提交

    $('#submits').click(function(){

        var ding21,ding22,ding23,ding24,ding25,ding26,ding31,ding32,ding33,ding34,ding41,xian21,xian31,xian41,uid,percent;
        ding21=$('input[name="ding21"]').val();
        // ding22=$('input[name="ding22"]').val();
        // ding23=$('input[name="ding23"]').val();
        // ding24=$('input[name="ding24"]').val();
        // ding25=$('input[name="ding25"]').val();
        // ding26=$('input[name="ding26"]').val();
        ding31=$('input[name="ding31"]').val();
        // ding32=$('input[name="ding32"]').val();
        // ding33=$('input[name="ding33"]').val();
        // ding34=$('input[name="ding34"]').val();
       var uproportion=$('input[name="uproportion"]').val();
        ding41=$('input[name="ding41"]').val();
        xian21=$('input[name="xian21"]').val();
        xian31=$('input[name="xian31"]').val();
        xian41=$('input[name="xian41"]').val();
        uid=$('input[name="uid"]').val();
        var zancheng=$('select[name="zancheng"] option:selected').val();
        if(parseInt(zancheng) > parseInt(uproportion)){
          $(".notic").html('大于上级给的占成！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }
        if(parseInt(ding21) < 1){
          $(".notic").html('二定拦货金额不能为空！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }
        if(parseInt(ding31) < 1){
          $(".notic").html('三定拦货金额不能为空！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }
        if(parseInt(ding41) < 1){
          $(".notic").html('四定拦货金额不能为空！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }
        if(parseInt(xian21) < 1){
          $(".notic").html('二现拦货金额不能为空！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }
        if(parseInt(xian31) < 1){
          $(".notic").html('三现拦货金额不能为空！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }
        if(parseInt(xian41) < 1){
          $(".notic").html('四现拦货金额不能为空！');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
          return false;
        }

            var urls="/User/saveUpercent";
            $.ajax({
                url: urls,
                type:"POST",
                data:{
                    'uid':uid,
                    'percent':zancheng,
                    'ding21':ding21,
                    // 'ding22':ding22,
                    // 'ding23':ding23,
                    // 'ding24':ding24,
                    // 'ding25':ding25,
                    // 'ding26':ding26,
                    'ding31':ding31,
                    // 'ding32':ding32,
                    // 'ding33':ding33,
                    // 'ding34':ding34,
                    'ding41':ding41,
                    'xian21':xian21,
                    'xian31':xian31,
                    'xian41':xian41,
                },
                async: false,
                dataType:'json',
                success: function (data) {
                      if(data.code==true){
                        $(".notic").html('保存成功！');
                        $(".notic").fadeIn().delay(1000).fadeOut(); 
                      }else{
                        $(".notic").html('保存失败！');
                        $(".notic").fadeIn().delay(1000).fadeOut();
                      }
                    //setTimeout('parent.window.location.href="'+data.urls+'";',3000);
                }

              });

    });
});

    /*

    *是否存在

     */

    function  inputFinds(name,uid){
        var returns=true;
        var urls="/User/findUser1";
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
.col-sm-3 {
    width: 15%;
}
</style>  
 </body>
</html>