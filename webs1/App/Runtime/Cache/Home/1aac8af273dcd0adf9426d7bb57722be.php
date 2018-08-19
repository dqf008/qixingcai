<?php if (!defined('THINK_PATH')) exit();?><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>七星彩四码销售系统</title>
<style type="text/css">
<!--
body,td,th {
	font-family: 宋体;
	font-size: 14px;
	color: #333;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a.BtnStyle:link, a.BtnStyle:visited, a.BtnStyle:active
{
	color: #FFF;
	display:block;
	width:70px;
	height:28px;
	line-height:30px;
	text-decoration:none;
	background:url(/Public/index/btntop.png) no-repeat left top;
	text-align:center;
	font-family: 黑体;
	font-size: 15px;
}
a.BtnStyle:hover
{
	color: #FFF;
	background-position:right top;
	font-family: 黑体;
	font-size: 15px;
}
.TimeText {
	font-family: "宋体";
	font-size: 16px;
	font-weight: bold;
	color: #FF0;
}
a {
	font-family: 宋体;
	font-size: 14px;
	color: #FFF;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: underline;
	color: #FF0;
}
a:active {
	text-decoration: none;
	color: #FFF;
}

</style>

</head>
<script src="/Public/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<body>
<!--头部  开始-->

<!-- 会员公共头部  结束-->
<style>
a.BtnFind:link, a.BtnFind:visited, a.BtnFind:active
{
  color: #EEE;
  display:block;
  width:24px;
  height:24px;
  line-height:30px;
  text-decoration:none;
  background:url(/Public/index/Find.png) no-repeat left top;
  text-align:center;
  font-family: 黑体;
  font-size: 15px;
}
a.BtnFind:hover
{
  color: #EEE;
  background-position:right top;
  font-family: 黑体;
  font-size: 15px;
}
.TitleColor {
  font-family: "宋体";
  font-size: 14px;
  color: #FFF;
}
-->
</style>
<script language="javascript">
// function FindOrder()
// {
//   var str = document.getElementById("EditOrder").value;
//   if (str=="")
//   {
//     alert("请先输入要查找的订单！");
//     return;
//   }
//   window.location='Sell.asp?period=' + 82 + '&type=' + 0 + '&order=' + str;
// }
// function EnterFindOrder()
// {
//   var key = event.keyCode;
//   if(key==13) //回车键提交搜索
//   {
//     FindOrder();
//     }
// }
// function FindNumber()
// {
//   var str = document.getElementById("EditNumber").value;
//   if (str=="")
//   {
//     alert("请先输入要查找的号码！");
//     return;
//   }
//   window.location='Sell.asp?period=' + 82 + '&type=' + 0 + '&number=' + str;
// }
// function EnterFindNumber()
// {
//   var key = event.keyCode;
//   if(key==13) //回车键提交搜索
//   {
//     FindNumber();
//     }
// }
// function FindScale()
// {
//   var str1 = document.getElementById("EditScale1").value;
//   var str2 = document.getElementById("EditScale2").value;
//   if (str1=="")
//   {
//     str1 = "0";
//   }
//   if (str2=="")
//   {
//     str2 = "10000";
//   }
//   window.location='Sell.asp?period=' + 82 + '&type=' + 0 + '&scale1=' + str1 + '&scale2=' + str2;
// }
// function EnterFindScale()
// {
//   var key = event.keyCode;
//   if(key==13) //回车键提交搜索
//   {
//     FindScale();
//     }
// }
// function FindMoney()
// {
//   var str1 = document.getElementById("EditMoney1").value;
//   var str2 = document.getElementById("EditMoney2").value;
//   if (str1=="")
//   {
//     str1 = "0";
//   }
//   if (str2=="")
//   {
//     str2 = "10000";
//   }
//   window.location='Sell.asp?period=' + 82 + '&type=' + 0 + '&money1=' + str1 + '&money2=' + str2;
// }
// function EnterFindMoney()
// {
//   var key = event.keyCode;
//   if(key==13) //回车键提交搜索
//   {
//     FindMoney();
//     }
// }
 </script>


 <script language="javascript">
function CheckColA()
{
  var e = document.getElementsByTagName('input');
  var len = e.length;
 // document.form1.ChkColA.checked;
    //console.log($('#ChkColA').attr('checked'));
  for(var i=0; i<len; i++)
  {
    if((e[i].id.substr(0,4)=="NumA"))
    {
      if($('#ChkColA').attr('checked')){
        e[i].checked = $('#ChkColA').attr('checked',true);
      }else{
        $('#ChkColA').attr('checked',false);
        $('.NumIDA').attr('checked',false);    
      }
     
    }
    // if((e[i].type=="checkbox") && (e[i].id.substr(0,4)=="NumA") && e[i].disabled!=true)
    // {
    //   e[i].checked = document.form1.ChkColA.checked;
    // }
  }
}
function CheckColB()
{
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
    if((e[i].id.substr(0,4)=="NumB"))
    {
      //alert('111');
      if($('#ChkColB').attr('checked')){
        e[i].checked = $('#ChkColB').attr('checked',true);
      }else{
        $('#ChkColB').attr('checked',false);
        $('.NumIDB').attr('checked',false);    
      }
     
    }
    // if((e[i].type=="checkbox") && (e[i].id.substr(0,4)=="NumB") && e[i].disabled!=true)
    // {
    //   e[i].checked = document.form1.ChkColB.checked;
    // }
  }
}
function CheckColC(form)
{
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
    if((e[i].id.substr(0,4)=="NumC"))
    {
      if($('#ChkColC').attr('checked')){
        e[i].checked = $('#ChkColC').attr('checked',true);
      }else{
        $('#ChkColC').attr('checked',false);
        $('.NumIDC').attr('checked',false);    
      }
     
    }
    // if((e[i].type=="checkbox") && (e[i].id.substr(0,4)=="NumC") && e[i].disabled!=true)
    // {
    //   e[i].checked = document.form1.ChkColC.checked;
    // }
  }
}
function CheckColD(form)
{
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
     if((e[i].id.substr(0,4)=="NumD"))
    {
      if($('#ChkColD').attr('checked')){
        e[i].checked = $('#ChkColD').attr('checked',true);
      }else{
        $('#ChkColD').attr('checked',false);
        $('.NumIDD').attr('checked',false);    
      }
     
    }
    // if((e[i].type=="checkbox") && (e[i].id.substr(0,4)=="NumD") && e[i].disabled!=true)
    // {
    //   e[i].checked = document.form1.ChkColD.checked;
    // }
  }
}
function CheckColE(form)
{
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
     if((e[i].id.substr(0,4)=="NumE"))
    {
      if($('#ChkColE').attr('checked')){
        e[i].checked = $('#ChkColE').attr('checked',true);
      }else{
        $('#ChkColE').attr('checked',false);
        $('.NumIDE').attr('checked',false);    
      }
     
    }
    // if((e[i].type=="checkbox") && (e[i].id.substr(0,4)=="NumE") && e[i].disabled!=true)
    // {
    //   e[i].checked = document.form1.ChkColE.checked;
    // }
  }
}



   function finds(){
      var qishu=$('select[name="ComboPeriod"] option:selected').val();
      var type=$('select[name="ComboType"] option:selected').val();
      var ComboSort=$('select[name="ComboSort"] option:selected').val();
      var ComboShow=$('select[name="ComboShow"] option:selected').val();
      window.location='/Index/odds?period=' + qishu + '&type=' +type + '&sort=' + ComboSort+ '&show=' + ComboShow; 
    }





function NumberFind()
{
  var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var str = document.getElementById("FindNumber").value;
  if (str=="")
  {
    alert("请先输入要查找的号码！");
    return;
  }
  window.location='/Index/odds/?period=' + qishu + '&type=' + type + '&find=' + str;
}
function findOdds(){

  var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var ComboSort=$('select[name="ComboSort"] option:selected').val();
  var ComboShow=$('select[name="ComboShow"] option:selected').val();
  var p=$('select[name="SelectPage"] option:selected').val();
    var str = document.getElementById("FindNumber").value;
  window.location='/Index/odds?period=' + qishu + '&type=' +type + '&sort=' + ComboSort+ '&show=' + ComboShow+ '&find=' + str+ '&p=' + p;;
}

function EnterSubmit()
{
  var key = event.keyCode;
  if(key==13) //回车键提交搜索
  {
    NumberFind();
    }
}

function NumberActive()
{
  var n ='';
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
    if((e[i].type=="checkbox") && (e[i].name.substr(0,3)=="Num") && e[i].disabled!=true)
    {
      if(e[i].checked == true)
      {
        //n++;
        n+=(e[i].value)+',';
      }
    }
  }
  if (n==0)
  {
    alert("请先选择要修改的号码！");
    return;
  }
  //alert(n);
  var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var ComboSort=$('select[name="ComboSort"] option:selected').val();
  var ComboShow=$('select[name="ComboShow"] option:selected').val();
  var page='';
  // window.location.href="/Index/odds/?period=" + qishu + "&type=" + type + "&sort=" + ComboSort + "&show=" + ComboShow + "&page=&haoma="+n;
   $.ajax({
      type: "post",
      url: "/Index/forbid",
      dataType: "json",
      data: {
        period:qishu,
        type:type,
        sort:ComboSort,
        show:ComboShow,
        page:page,
        haoma:n,
      },
      success: function(msg){
        if(msg.code==200){
          $(".notic").html('修改成功');
          $(".notic").fadeIn().delay(1000).fadeOut();
          setTimeout("window.location.href='/Index/odds/?period=" + qishu + "&type=" + type + "&sort=" + ComboSort + "&show=" + ComboShow + "&page=';",3000);
          return false; 
        }
           
      }
    });

}
function NumberActive1()
{
  var n ='';
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
    if((e[i].type=="checkbox") && (e[i].name.substr(0,3)=="Num") && e[i].disabled!=true)
    {
      if(e[i].checked == true)
      {
        //n++;
        n+=(e[i].value)+',';
      }
    }
  }
  if (n==0)
  {
    alert("请先选择要修改的号码！");
    return;
  }
  //alert(n);
  var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var ComboSort=$('select[name="ComboSort"] option:selected').val();
  var ComboShow=$('select[name="ComboShow"] option:selected').val();
  var page='';
  // window.location.href="/Index/odds/?period=" + qishu + "&type=" + type + "&sort=" + ComboSort + "&show=" + ComboShow + "&page=&haoma="+n;
   $.ajax({
      type: "post",
      url: "/Index/forbid1",
      dataType: "json",
      data: {
        period:qishu,
        type:type,
        sort:ComboSort,
        show:ComboShow,
        page:page,
        haoma:n,
      },
      success: function(msg){
        if(msg.code==200){
          $(".notic").html('修改成功');
          $(".notic").fadeIn().delay(1000).fadeOut();
          setTimeout("window.location.href='/Index/odds/?period=" + qishu + "&type=" + type + "&sort=" + ComboSort + "&show=" + ComboShow + "&page=';",3000);
          return false; 
        }
           
      }
    });

}
function NumberPrice()
{
  var n = '';
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
    if((e[i].type=="checkbox") && (e[i].name.substr(0,3)=="Num") && e[i].disabled!=true)
    {
      if(e[i].checked == true)
      {
         n+=(e[i].value);
         break;
      }
    }
  }
  if (n==0)
  {
    alert("请先选择要修改的号码！");
    return;
  }

  var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var url='/Index/sales?haoma='+n+'&qishu='+qishu+'&type='+type;
  layer_show('修改限售',url,'600','300');
  // var url='http://lanren111.a74.cnaaa16.com/webs2/index.php/Index/numbers';
  // var data=n;
  // var msg='';
  // var type=$('select[name="ComboType"] option:selected').val();
  // var id=1;
  // PostSubmit(url, data, qishu,type,id);
}

//Post方式提交表单  
// function PostSubmit(url, data, msg,type,id) {  
//     var postUrl = url;//提交地址  
//     var postData = data;//第一个数据  
//     var msgData = msg;//第二个数据  
//     var types = type;//第二个数据  
//     var id = id;//第二个数据  
//     var ExportForm = document.createElement("FORM");  
//     document.body.appendChild(ExportForm);  
//     ExportForm.method = "POST";  
//     var newElement = document.createElement("input");  
//     newElement.setAttribute("name", "sn");  
//     newElement.setAttribute("type", "hidden");  
//     var newElement2 = document.createElement("input");  
//     newElement2.setAttribute("name", "no");  
//     newElement2.setAttribute("type", "hidden"); 
//      var newElement3 = document.createElement("input");  
//     newElement3.setAttribute("name", "type");  
//     newElement3.setAttribute("type", "hidden");
//      var newElement4 = document.createElement("input");  
//     newElement4.setAttribute("name", "id");  
//     newElement4.setAttribute("type", "hidden");  
//     ExportForm.appendChild(newElement);  
//     ExportForm.appendChild(newElement2);  
//     ExportForm.appendChild(newElement3);  
//     ExportForm.appendChild(newElement4);  
//     newElement.value = postData;  
//     newElement2.value = msgData;  
//     newElement3.value = types;  
//     newElement4.value = id;  
//     ExportForm.action = postUrl;  
//     ExportForm.submit();  
// };  
function NumberScale()
{
  var n = 0
  var e = document.getElementsByTagName('input');
  var len = e.length;
  for(var i=0; i<len; i++)
  {
    if((e[i].type=="checkbox") && (e[i].name.substr(0,3)=="Num") && e[i].disabled!=true)
    {
      if(e[i].checked == true)
      {
        //n++;
        n+=(e[i].value);
         break;
      }
    }
  }
  if (n==0)
  {
    alert("请先选择要修改的号码！");
    return;
  }

  // var qishu=$('select[name="ComboPeriod"] option:selected').val();
  // var types=2;
  // var type=$('select[name="ComboType"] option:selected').val();
  // var url='http://lanren111.a74.cnaaa16.com/webs2/index.php/Index/numbers';
  // var data=n;
  //  PostSubmit(url, data, qishu,type,types);
    var qishu=$('select[name="ComboPeriod"] option:selected').val();
    var type=$('select[name="ComboType"] option:selected').val();
    var url='/Index/findOdd?haoma='+n+'&qishu='+qishu+'&type='+type;
    layer_show('修改赔率',url,'600','300');
}
function PriceAll(){
  var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var url='/Index/priceAll?qishu='+qishu+'&type='+type+'&types=3';
  layer_show('批量修改限售',url,'1000','500');
}
function ScaleAll(){
   var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var url='/Index/priceAll?qishu='+qishu+'&type='+type+'&types=5';
  layer_show('批量修改赔率',url,'1000','500');
}
 function forbidAll(){
   var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var url='/Index/priceAll?qishu='+qishu+'&type='+type+'&types=1';
  layer_show('批量禁售',url,'1000','500');
}
 function allowAll(){
   var qishu=$('select[name="ComboPeriod"] option:selected').val();
  var type=$('select[name="ComboType"] option:selected').val();
  var url='/Index/priceAll?qishu='+qishu+'&type='+type+'&types=2';
  layer_show('批量许售',url,'1000','500');
}
</script>
<p></p>
<div style="width:95%;margin:15px 40px">

<table width="1146" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="90" height="28">
    <select name="ComboPeriod" id="ComboPeriod" onchange="finds()">
    <?php if(is_array($qishu)): $i = 0; $__LIST__ = $qishu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['qishu'] == $qishu1): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?>期</option>
      <?php else: ?>
        <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?>期</option><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
    </select>
    </td>

    <td width="72" height="28">
    <select name="ComboType" id="ComboType" onchange="finds()">
     <!--  <option value="1" selected="">直码</option>
      <option value="2">两同</option>
      <option value="3">三同</option>
      <option value="4">四同</option>
      <option value="5">两定</option>
      <option value="6">三定</option> -->
      <option value="1" <?php if($type==1){ echo 'selected';} ?>>直码</option>
      <option value="2" <?php if($type==2){ echo 'selected';} ?>>两同</option>
      <option value="3" <?php if($type==3){ echo 'selected';} ?>>三同</option>
      <option value="4" <?php if($type==4){ echo 'selected';} ?>>四同</option>
      <option value="5" <?php if($type==5){ echo 'selected';} ?>>两定</option>
      <option value="6" <?php if($type==6){ echo 'selected';} ?>>三定</option>
    </select>
    </td>
    <td width="110" height="28">
    <select name="ComboSort" id="ComboSort" onchange="finds()">
      <option value="1" <?php if($sort==1){ echo 'selected';} ?>>按号码排序</option>
      <option value="2" <?php if($sort==2){ echo 'selected';} ?>>按销售排序</option>
      <option value="3" <?php if($sort==3){ echo 'selected';} ?>>按赔率排序</option>
	  <!--<option value="4" <?php if($sort==4){ echo 'selected';} ?>>按拦货排序</option>-->
    </select>
    </td>
    <td width="100" height="28">
    <select name="ComboShow" id="ComboShow" onchange="finds()">
      <option value="0">全部号码</option>
      <option value="1" <?php if($shows==1){ echo 'selected';} ?>>许售号码</option>
      <option value="2" <?php if($shows==2){ echo 'selected';} ?>>禁售号码</option>
      <option value="3" <?php if($shows==3){ echo 'selected';} ?>>已售号码</option>
      <option value="4" <?php if($shows==4){ echo 'selected';} ?>>未售号码</option>
      <option value="5" <?php if($shows==5){ echo 'selected';} ?>>修改赔率和销售号码</option>
	  <option value="6" <?php if($shows==6){ echo 'selected';} ?>>拦货号码</option>
      <!-- <option value="5" <?php if($shows==5){ echo 'selected';} ?>>特殊赔率</option> -->
    </select>
    </td>
    <td width="86" height="28" align="right">查找：</td>
    <td width="66" height="28" align="left"><input name="FindNumber" type="text" id="FindNumber" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" value="<?php echo ($find); ?>" size="6" maxlength="4" onkeydown="EnterSubmit();"></td>
    <td width="106" height="28" align="left"><a href="JavaScript:NumberFind();" class="BtnFind" onfocus="this.blur()"></a></td>
    <td width="86" height="28"><a href="JavaScript:NumberActive();" class="BtnStyle" onfocus="this.blur()">禁售</a></td>
    <td width="86" height="28"><a href="JavaScript:NumberActive1();" class="BtnStyle" onfocus="this.blur()">许售</a></td>
    <td width="86" height="28"><a href="JavaScript:NumberPrice();" class="BtnStyle" onfocus="this.blur()">修改限售</a></td>
    <td width="86" height="28"><a href="JavaScript:NumberScale();" class="BtnStyle" onfocus="this.blur()">修改赔率</a></td>
    <td width="86" height="28">&nbsp;</td>
    <td width="86" height="28"><a href="JavaScript:forbidAll();" class="BtnStyle" onfocus="this.blur()">批量禁售</a></td>
    <td width="86" height="28"><a href="JavaScript:allowAll();" class="BtnStyle" onfocus="this.blur()">批量许售</a></td>
    <td width="86" height="28"><a href="JavaScript:PriceAll();" class="BtnStyle" onfocus="this.blur()">批量限售</a></td>
    <td width="86" height="28"><a href="JavaScript:ScaleAll();" class="BtnStyle" onfocus="this.blur()">批量赔率</a></td>
    
  </tr>
</tbody></table>
<br>
<table width="1271" border="0" cellspacing="1" cellpadding="0" bgcolor="#663366">
<form id="form1" name="form1" method="post" action="#"></form>
  <tbody><tr>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png"><input name="ChkColA" type="checkbox" id="ChkColA" value="1" onclick="CheckColA();"></td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">号码</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">已售</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">赔率</td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png"><input name="ChkColB" type="checkbox" id="ChkColB" value="2" onclick="CheckColB();"></td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">号码</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">已售</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">赔率</td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png"><input name="ChkColC" type="checkbox" id="ChkColC" value="3" onclick="CheckColC();"></td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">号码</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">已售</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">赔率</td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png"><input name="ChkColD" type="checkbox" id="ChkColD" value="4" onclick="CheckColD();"></td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">号码</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">已售</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">赔率</td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png"><input name="ChkColE" type="checkbox" id="ChkColE" value="5" onclick="CheckColE();"></td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">号码</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="45" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">已售</td>
    <td width="55" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">赔率</td>
  </tr>
  <?php echo ($data); ?>



  <tr>
    <td height="28" colspan="30" align="center" bgcolor="#FFFFFF">共<?php echo ($count); ?>个号码<!-- &nbsp;&nbsp;&nbsp;&nbsp;首页&nbsp;&nbsp;上页&nbsp;&nbsp;<a href="http://lanren111.a74.cnaaa16.com/webs2/index.php/Index/odds/?period=82&amp;type=1&amp;sort=1&amp;show=0&amp;page=2">下页</a>&nbsp;&nbsp;<a href="http://lanren111.a74.cnaaa16.com/webs2/index.php/Index/odds/?period=82&amp;type=1&amp;sort=1&amp;show=0&amp;page=20">尾页</a>&nbsp;&nbsp;&nbsp;&nbsp;页数:1/20页&nbsp;&nbsp;&nbsp;&nbsp; -->
    <?php echo ($show); ?>
    转到：
      <!-- <select name="SelectPage" onchange="javascript:window.location='http://lanren111.a74.cnaaa16.com/webs1/index.php/Index/odds/?period=' + 82 + '&amp;type=' + 1 + '&amp;sort=' + 1 + '&amp;show=' + 0 + '&amp;p='+this.options[this.selectedIndex].value;"> -->
     <!--  <select name="SelectPage" onchange="javascript:window.location='http://lanren111.a74.cnaaa16.com/webs1/index.php/Index/odds/?period=<?php echo ($qishu1); ?>&type=<?php echo ($type); ?>&sort=<?php echo ($sort); ?>&show=<?php echo ($shows); ?>&p='+this.options[this.selectedIndex].value;">
        <option value="1" selected="">第1页</option><option value="2">第2页</option><option value="3">第3页</option><option value="4">第4页</option><option value="5">第5页</option><option value="6">第6页</option><option value="7">第7页</option><option value="8">第8页</option><option value="9">第9页</option><option value="10">第10页</option><option value="11">第11页</option><option value="12">第12页</option><option value="13">第13页</option><option value="14">第14页</option><option value="15">第15页</option><option value="16">第16页</option><option value="17">第17页</option><option value="18">第18页</option><option value="19">第19页</option><option value="20">第20页</option>
      </select> -->
      <!-- <?php if($pages > 1): ?><select name="SelectPage" onchange="javascript:window.location='http://lanren111.a74.cnaaa16.com/webs1/index.php/Index/odds/?period=<?php echo ($qishu1); ?>&type=<?php echo ($type); ?>&sort=<?php echo ($sort); ?>&show=<?php echo ($shows); ?>&p='+this.options[this.selectedIndex].value;">
        <?php if(is_array($pages)): $i = 0; $__LIST__ = $pages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>
      </select><?php endif; ?> -->
      <?php
 if($pages >1){ echo '<select name="SelectPage" onchange="findOdds()">'; for($a=0;$a<$pages;$a++){ $a1=$a+1; if($p==$a1){ echo "<option value='".$a1."' selected>第".$a1."页</option>"; }else{ echo "<option value='".$a1."'>第".$a1."页</option>"; } } echo '</select>'; } ?>

      </td>
    </tr>
</tbody></table>



</div>

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
.row {
    margin-left: 40px;
}
 .form-label{
  text-align:center; 
}
.col-sm-3{
  width:20%;
}
</style> 
</body></html>