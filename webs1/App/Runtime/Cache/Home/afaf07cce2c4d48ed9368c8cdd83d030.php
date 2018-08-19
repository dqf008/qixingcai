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
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text" value="<?php echo ($data['username']); ?>" placeholder="" id="adminName" name="adminName" /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号密码：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password" /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>积分：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text integral" value="<?php echo ($data['money']); ?>" placeholder="" id="integral" name="integral" /> 
     </div> 
    </div> 
    <div class="row cl"> 
     <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label> 
     <div class="formControls col-xs-8 col-sm-9"> 
      <input type="text" class="input-text" value="<?php echo ($data['mobile']); ?>" placeholder="" id="phone" name="phone" /> 
      <input type="hidden" name="uid" value="<?php echo ($data['uid']); ?>" /> 
      <input type="hidden" name="moneys" value="<?php echo ($data['money']); ?>" /> 
      <input type="hidden" name="money" value="<?php echo ($data1['au_money']-$data1['au_moneys']); ?>" /> 
     </div> 
    </div> 
   <!--  <?php if($data['uid']): ?><div class="row cl"> 
    <?php else: ?> 
      <div class="row cl" style="display:none"><?php endif; ?>
       <label class="form-label col-xs-4 col-sm-3">赔率配置：</label> 
       <div class="formControls col-xs-8 col-sm-9"> 
        <table width="400" border="1" cellspacing="0" cellpadding="0" style="solid 1px #ddd"> 
         <tbody>
          <tr> 
           <td width="50" height="28" align="center" bgcolor="#FFFFFF">类型</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">说明</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">上级给的基本赔率</td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF">上级要获取的佣金/剩余赔率</td> 
          </tr> 
          <tr> 
           <td width="50" height="28" align="center" bgcolor="#FFFFFF">直码</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->ding41); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select1" id="Select1" style="width:120px;"><?php echo ($j1); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="50" rowspan="2" align="center" bgcolor="#FFFFFF">两同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">数字不同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong211); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select21" id="Select21" style="width:120px;"><?php echo ($j2); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">两数相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong221); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select22" id="Select22" style="width:120px;"><?php echo ($j3); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="50" rowspan="3" align="center" bgcolor="#FFFFFF">三同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">数字不同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong311); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select31" id="Select31" style="width:120px;"><?php echo ($j4); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">两数相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong321); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select32" id="Select32" style="width:120px;"><?php echo ($j5); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">三数相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong331); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select33" id="Select33" style="width:120px;"><?php echo ($j6); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="50" rowspan="5" align="center" bgcolor="#FFFFFF">四同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">数字不同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong411); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select41" id="Select41" style="width:120px;"><?php echo ($j7); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">两数相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong421); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select42" id="Select42" style="width:120px;"><?php echo ($j8); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">两两相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong431); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select43" id="Select43" style="width:120px;"><?php echo ($j9); ?> </select></td> 
          </tr> 
          <tr> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF">三数相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong441); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select44" id="Select44" style="width:120px;"><?php echo ($j10); ?> </select></td> 
          </tr> 
          <tr> 
           <td height="28" align="center" bgcolor="#FFFFFF">四数相同</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->tong451); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select45" id="Select45" style="width:120px;"><?php echo ($j11); ?> </select></td> 
          </tr> 
          <tr> 
           <td height="28" align="center" bgcolor="#FFFFFF">两定</td> 
           <td height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->ding21); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select5" id="Select5" style="width:120px;"><?php echo ($j12); ?> </select></td> 
          </tr> 
          <tr> 
           <td height="28" align="center" bgcolor="#FFFFFF">三定</td> 
           <td height="28" align="center" bgcolor="#FFFFFF">&nbsp;</td> 
           <td width="80" height="28" align="center" bgcolor="#FFFFFF"><?php echo ($loss->ding31); ?></td> 
           <td width="100" height="28" align="center" bgcolor="#FFFFFF"><select name="Select6" id="Select6" style="width:120px;"><?php echo ($j13); ?> </select></td> 
          </tr> 
         </tbody>
        </table> 
       </div> 
      </div>  -->
      <div class="row cl"> 
       <label class="form-label col-xs-4 col-sm-3">备注：</label> 
       <div class="formControls col-xs-8 col-sm-9"> 
        <textarea name="content" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="$.Huitextarealength(this,100)"><?php echo ($data['about']); ?></textarea> 
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p> 
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

$(function(){
    // $('.integral').keyup(function(){
    //   // if($(this).val()=='0'){
    //   //   $(this).val('');
    //   // }else{
    //     $(this).val($(this).val().replace(/[^\d]/g, ""));
    //   //}

    // });
    // $('.skin-minimal input').iCheck({

    //  checkboxClass: 'icheckbox-blue',

    //  radioClass: 'iradio-blue',

    //  increaseArea: '20%'

    // });

    //提交

    $('#submits').click(function(){

        var name,password,password2,phone,email,type,integral,uid,money,select1,moneys;
        name=$('input[name="adminName"]').val();
        password=$('input[name="password"]').val();
        phone=$('input[name="phone"]').val();
        integral=$('input[name="integral"]').val();
        uid=$('input[name="uid"]').val();
        money=$('input[name="money"]').val();
        moneys=$('input[name="moneys"]').val();
        //email=$('input[name="email"]').val();
        content=$('textarea[name="content"]').val();
        select1=$('select[name="Select1"] option:selected').val();
        var select21=$('select[name="Select21"] option:selected').val();
        var select22=$('select[name="Select22"] option:selected').val();
        var select31=$('select[name="Select31"] option:selected').val();
        var select32=$('select[name="Select32"] option:selected').val();
        var select33=$('select[name="Select33"] option:selected').val();
        var select41=$('select[name="Select41"] option:selected').val();
        var select42=$('select[name="Select42"] option:selected').val();
        var select43=$('select[name="Select43"] option:selected').val();
        var select44=$('select[name="Select44"] option:selected').val();
        var select45=$('select[name="Select45"] option:selected').val();
        var select5=$('select[name="Select5"] option:selected').val();
        var select6=$('select[name="Select6"] option:selected').val();

        //alert(name+'---'+password+'---'+password2+'---'+phone+'---'+email+'---'+type);
        if(name=='') {
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
        //alert(integral+'==>'+money);
        //alert(integral+'==>'+money);
        if(integral!=''){
   //       if(integral<1){
            //  $(".notic").html("账号积分大于1");
      //        $(".notic").fadeIn().delay(1000).fadeOut();
   //           return false; 
            // }else 
            if(uid.length==''){
                if(parseInt(integral)> parseInt(money)){
                    $(".notic").html("填写的信用积分不能大于你的账号信用积分");
                    $(".notic").fadeIn().delay(1000).fadeOut();
                    return false; 
                }
            }else{
               if((integral-moneys)> money){
                    $(".notic").html("填写的信用积分不能大于你的账号信用积分");
                    $(".notic").fadeIn().delay(1000).fadeOut();
                    return false; 
                }
            }
          
        }
        if(uid==''){
            if(password=='') {
                $(".notic").html("密码不能空");
                $(".notic").fadeIn().delay(1000).fadeOut();
                return false;    
            }else if(!isRegisterUserPwds(password)){
                $(".notic").html("密码小写字母开头4~18长度以内的字母、数字的组合");
                $(".notic").fadeIn().delay(1000).fadeOut();
                return false; 

            }
        }
            var urls="/User/saveUser1";
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
                    'select1':select1,
                    'select21':select21,
                    'select22':select22,
                    'select31':select31,
                    'select32':select32,
                    'select33':select33,
                    'select41':select41,
                    'select42':select42,
                    'select43':select43,
                    'select44':select44,
                    'select45':select45,
                    'select5':select5,
                    'select6':select6,
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