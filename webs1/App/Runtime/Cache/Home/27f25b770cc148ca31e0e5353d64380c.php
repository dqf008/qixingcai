<?php if (!defined('THINK_PATH')) exit();?><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>七星彩</title>
<style type="text/css">
<!--
body,td,th {
	font-family: 宋体;
	font-size: 14px;
	color: #333;
}
body {
	margin-left: 20px;
	margin-top: 20px;
	margin-right: 20px;
	margin-bottom: 20px;
}
a.BtnStyle:link, a.BtnStyle:visited, a.BtnStyle:active
{
	color: #EEE;
	display:block;
	width:72px;
	height:28px;
	line-height:30px;
	text-decoration:none;
	background:url(/Public/index/BtnForm.png) no-repeat left top;
	text-align:center;
	font-family: 黑体;
	font-size: 15px;

}
a.BtnStyle:hover
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
<script src="/Public/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript">
function ModifySubmit()
{
	var str,strNumText,strSelItem,TheRadios,qishu;
	var strNumText = document.getElementById("NumText").value;
  var qishu=$('input[name="qishu"]').val();
  var type1=$('input[name="type"]').val();
	if(strNumText == "")
	{
		alert("请粘贴要修改的号码到编辑框。");
		return;
	}
	else
	{
		//var strSelItem;
		TheRadios = document.getElementsByName("radio");
		for (var i=0; i<TheRadios.length; i++)
		{
			if(TheRadios[i].checked)
			{
				strSelItem = TheRadios[i].value;
				break;
			}
		}
		if(strSelItem=="3")
		{
			 str = document.getElementById("Money").value;
			if (str=="")
			{
				alert("请先输入限售金额！");
				return;
			}
		}
		else if(strSelItem=="5")
		{
			 str = document.getElementById("Scale").value;
			if (str=="")
			{
				alert("请先输入限售赔率！");
				return;
			}
		}
	}

	// strTemp = document.form1.action;
	// document.form1.action="/Index/saveData";
	// document.form1.submit();
	// document.form1.action=strTemp;
	 $.ajax({
      type: "post",
      url: "/Index/saveData",
      dataType: "json",
      data: {
        type:strSelItem,
        qishu:qishu,
        type1:type1,
        sum:str,
        strNumText:strNumText,
      },
      success: function(msg){
        if(msg.code==200){
          $(".notic").html(msg.titles);
          $(".notic").fadeIn().delay(1000).fadeOut();
          setTimeout('parent.window.location.href="'+msg.urls+'";',3000);
        }
           
      }
    });
}
</script>
</head>

<body>
<table width="980" border="0" cellspacing="0" cellpadding="0">
<form id="form1" name="form1" method="post" action="#"></form>
  <input type="hidden" name="qishu" value="<?php echo ($qishu); ?>" />
  <input type="hidden" name="type" value="<?php echo ($type); ?>" />
  <tbody><tr>
    <td height="28" align="center" background="Images/TitleBar.png" class="TitleColor">批量修改限售</td>
    </tr>
  <tr>
    <td height="30">输入号码：（支持多种格式）</td>
    </tr>
  <tr>
    <td height="240"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="600" height="240"><textarea name="NumText" id="NumText" style="border-color: #009966; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" cols="70" rows="14"></textarea></td>
        <td width="380" height="240"><table width="380" border="0" cellspacing="0" cellpadding="0">
          <tbody>
          <tr>
            <td width="25" height="40" align="center"><input name="radio" type="radio" id="Oper1" value="1" <?php if($types==1){ echo 'checked';} ?>></td>
            <td width="75" height="40" align="left">禁售</td>
            <td width="80" height="40" align="right">&nbsp;</td>
            <td width="200" height="40" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td width="25" height="40" align="center"><input name="radio" type="radio" id="Oper1" value="2" <?php if($types==2){ echo 'checked';} ?>></td>
            <td width="75" height="40" align="left">许售</td>
            <td width="80" height="40" align="right">&nbsp;</td>
            <td width="200" height="40" align="left">&nbsp;</td>
          </tr>
          <!-- <tr>
            <td width="25" height="40" align="center"><input type="radio" name="radio" id="Oper2" value="2"></td>
            <td width="75" height="40" align="left">限售</td>
            <td width="80" height="40" align="right">输入格式：</td>
            <td width="200" height="40" align="left">号码=限售金额</td>
          </tr> -->
          <tr>
            <td width="25" height="40" align="center"><input type="radio" name="radio" id="Oper3" value="3" <?php if($types==3){ echo 'checked';} ?> ></td>
            <td width="75" height="40" align="left">限售金额</td>
            <td width="80" height="40" align="right">指定金额：</td>
            <td width="200" height="40" align="left"><input name="Money" type="text" id="Money" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" size="10" maxlength="5"></td>
          </tr>
          <!-- <tr>
            <td width="25" height="40" align="center"><input type="radio" name="radio" id="Oper4" value="4"></td>
            <td width="75" height="40" align="left">赔率</td>
            <td width="80" height="40" align="right">输入格式：</td>
            <td width="200" height="40" align="left">号码=限售赔率</td>
          </tr> -->
          <tr>
            <td width="25" height="40" align="center"><input type="radio" name="radio" id="Oper5" value="5"  <?php if($types==5){ echo 'checked';} ?> ></td>
            <td width="75" height="40" align="left">限售赔率</td>
            <td width="80" height="40" align="right">指定赔率：</td>
            <td width="200" height="40" align="left"><input name="Scale" type="text" id="Scale" style="border-color: #270740; border-style: solid; border-width: 1px; font-family:宋体; font-size: 16px" size="10" maxlength="4"></td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
    </tr>
  <tr>
    <td height="30">
      </td>
  </tr>
  <tr>
    <td height="30" align="center"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="300" height="30" align="center"><a href="JavaScript:ModifySubmit();" class="BtnStyle" onfocus="this.blur()">确定</a></td>
        <td width="300" height="30" align="center"><a href="JavaScript:history.go(0);" class="BtnStyle" onfocus="this.blur()">取消</a></td>
      </tr>
    </tbody></table></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    </tr>

</tbody></table>

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
  z-index: 198910566;
}

</style> 
</body></html>