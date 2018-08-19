<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0041)http://60.13.73.42:800/QManage/Period.asp -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>七星彩四码销售系统</title>
<style type="text/css">
<!--
body,td,th {
    font-family: 宋体;
    font-size: 14px;
    color: #333;
}
body {
    margin-left: 10px;
    margin-top: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
}
a.BtnStyle:link, a.BtnStyle:visited, a.BtnStyle:active
{
    color: #EEE;
    display:block;
    width:80px;
    height:28px;
    line-height:30px;
    text-decoration:none;
    background:url(/Public/index/btnfunc.png) no-repeat left top;
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

</head>

<body>
<table width="946" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="86" height="28">
    <!-- <?php if($status == 1): ?><a href="javascript:void(0)" onclick="alert('上期还没有开奖')" class="BtnStyle">新建一期</a>
    <?php else: ?> -->
       <!--  <a href="/Index/task" class="BtnStyle" onfocus="this.blur()">新建一期</a> -->
     <!--<?php endif; ?> -->
    <?php if($status == 1): ?><a href="javascript:void(0)" onclick="alert('上期还没有关闭销售')" class="BtnStyle">新建一期</a>
    <?php else: ?>
        <a href="javascript:void(0);" onclick="admin_role_add('添加<?php echo ($utype1); ?>','/Index/addMission','960','500')" class="BtnStyle"> 新建一期</a><?php endif; ?>
 
    </td>
    <td width="86" height="28"><a href="javascript:void(0);" onclick="admin_role_add1('修改一期','/Index/addMission','960','500')" class="BtnStyle" > 修改一期</a></td>
    
    <td width="86" height="28"><a href="javascript:void(0);" onclick="member_dels(this)" title="删除" class="BtnStyle" onfocus="this.blur()">删除一期</a></td>
    <td width="86" height="28">&nbsp;</td>
    <td width="86" height="28"><a href="javascript:void(0);" onclick="member_starts(this)" class="BtnStyle" onfocus="this.blur()">开启销售</a></td>
    <td width="86" height="28"><a href="javascript:void(0);" onclick="member_starts1(this)" class="BtnStyle" onfocus="this.blur()">关闭销售</a></td>
    <td width="86" height="28">&nbsp;</td>
    <td width="86" height="28"><a href="javascript:void(0);" onclick="admin_role_tuima('退码分钟','','600','300')"class="BtnStyle" onfocus="this.blur()">退码分钟</a></td>
    <td width="86" height="28"><a href="javascript:void(0);" onclick="admin_role_kaijiang('设置开奖','','600','300')"class="BtnStyle" onfocus="this.blur()">设置开奖</a></td>

    <td width="86" height="28">&nbsp;</td>
    <td width="86" height="28">&nbsp;</td>
  </tr>
</tbody></table>
<br>
<table width="2033" border="0" cellspacing="1" cellpadding="0" bgcolor="#663366">
  <tbody><tr>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="24" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png">&nbsp;</td>
    <td width="50" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">状态</td>
    <td width="50" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">年份</td>
    <td width="65" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">期号</td>
    <td width="60" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">星期</td>
    <td width="130" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">开盘时间</td>
    <td width="130" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">封盘时间</td>
    <td width="130" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">开奖时间</td>
    <td width="180" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">开奖号码</td>
    <td width="70" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">退码分钟</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">直码</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">两同</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">三同</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">四同</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">两定</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">三定</td>
    <td width="40" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">限售</td>
    <td width="80" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">销售总额</td>
    <td width="80" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">佣金总额</td>
    <td width="80" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">中奖总额</td>
    <td width="80" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">走码总额</td>
    <td width="80" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">走码中奖</td>
    <td width="80" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">盈亏</td>
    <td width="180" height="28" align="center" bgcolor="#FFFFFF" background="/Public/index/TitleBar.png" class="TitleColor">备注</td>
  </tr>
<form id="form1" name="form1" method="post" action=""></form>
    <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr bgcolor="#FFFFFF" onmouseover="this.bgColor=&#39;#F8E8C6&#39;" onmouseout="this.bgColor=&#39;#FFFFFF&#39;">
                <td width="24" height="28" align="center"><input type="radio" name="PeriodID" id="PeriodID" value="<?php echo ($vo["id"]); ?>"></td>
                <td width="24" height="28" align="center">
               <!--  <?php if($vo["m_status"] == 1): ?><img src="/Public/index/Period1.png" width="20" height="20">
                <?php else: ?>
                    <img src="/Public/index/Period0.png" width="20" height="20"><?php endif; ?> -->
                <?php if($vo["m_status"] == 1): ?><img src="/Public/index/Period1.png" width="20" height="20">
                <?php else: ?>
                    <img src="/Public/index/Period0.png" width="20" height="20"><?php endif; ?> 
                </td>
                <td width="60" height="28" align="center">
                    <?php if(($vo["m_status"] == 1) AND ($vo["fengpan"] < $time)): ?>销售完成
                    <?php elseif($vo["m_status"] == 1): ?>
                        销售中
                    <?php else: ?>
                        销售完成<?php endif; ?>
                   <!--  <?php if($vo["m_status"] == 1): ?>已开奖
                    <?php elseif($vo["m_status"] == 3): ?>
                        开始销售
                    <?php elseif($vo["m_status"] == 5): ?>
                        已开奖
                    <?php elseif($vo["m_status"] == 4): ?>
                        暂停销售
                    <?php elseif($vo["m_status"] == 2): ?>
                        待开奖
                    <?php else: ?>
                        已开奖<?php endif; ?> -->
                </td>
                <td width="50" height="28" align="center"><?php echo (date('Y',$vo["fengpan"])); ?></td>
                <td width="65" height="28" align="center"><?php echo ($vo["qishu"]); ?></td>
                <td width="60" height="28" align="center">星期五</td>
                <td width="130" height="28" align="center"><!-- <?php echo (date('Y-m-d H:i',$vo["m_opening"])); ?> --><?php echo ($vo["kaipan"]); ?></td>
                <td width="130" height="28" align="center"><?php echo (date('Y-m-d H:i',$vo["fengpan"])); ?></td>
                <td width="130" height="28" align="center"><?php echo ($vo["kaijiang"]); ?></td>
                <td width="180" height="28" align="center"><?php echo ($vo["m_ball1"]); ?>&nbsp;<?php echo ($vo["m_ball2"]); ?>&nbsp;<?php echo ($vo["m_ball3"]); ?>&nbsp;<?php echo ($vo["m_ball4"]); ?></td>
                <td width="70" height="28" align="center"><?php echo ($vo["m_retreat"]); ?></td>
                <td width="40" height="28" align="center"><img src="/Public/index/PCheck1.png" width="16" height="16"></td>
                <td width="40" height="28" align="center"><?php echo ($vo['m_sales1']->ding41); ?></td>
                <td width="40" height="28" align="center"><img src="/Public/index/PCheck1.png" width="16" height="16"></td>
                <td width="40" height="28" align="center"><?php echo ($vo['m_sales1']->tong21); ?></td>
                <td width="40" height="28" align="center"><img src="/Public/index/PCheck1.png" width="16" height="16"></td>
                <td width="40" height="28" align="center"><?php echo ($vo['m_sales1']->tong31); ?></td>
                <td width="40" height="28" align="center"><img src="/Public/index/PCheck1.png" width="16" height="16"></td>
                <td width="40" height="28" align="center"><?php echo ($vo['m_sales1']->tong41); ?></td>
                <td width="40" height="28" align="center"><img src="/Public/index/PCheck1.png" width="16" height="16"></td>
                <td width="40" height="28" align="center"><?php echo ($vo['m_sales1']->ding21); ?></td>
                <td width="40" height="28" align="center"><img src="/Public/index/PCheck1.png" width="16" height="16"></td>
                <td width="40" height="28" align="center"><?php echo ($vo['m_sales1']->ding31); ?></td>
                <td width="80" height="28" align="center">0.0</td>
                <td width="80" height="28" align="center">0.0</td>
                <td width="80" height="28" align="center">0.0</td>
                <td width="80" height="28" align="center">0.0</td>
                <td width="80" height="28" align="center">0.0</td>
                <td width="80" height="28" align="center">0.0</td>
                <td width="180" height="28" align="center"><?php echo ($vo["m_remark"]); ?></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?>
        <tr bgcolor="#FFFFFF" onmouseover="this.bgColor=&#39;#F8E8C6&#39;" onmouseout="this.bgColor=&#39;#FFFFFF&#39;">
            <td width="24" height="28" align="center"  colspan="30">没有数据</td>
        </tr><?php endif; ?>

</tbody></table>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
<script type="text/javascript">
    function admin_role_add1(title,url,w,h){
       
        var bChecked = false;
        var a = document.getElementsByName("PeriodID");
        for (var i=0; i<a.length; i++)
        {
            if(a[i].checked)
            {
                var number=a[i].value;
                bChecked = true;
                break;
            }
        }
        if (bChecked==false)
        {
            alert("请先选择一期！");
            return;
        }
        var urls=url+'?number='+number;
    layer_show(title,urls,w,h);

}
function admin_role_add(title,url,w,h){

  layer_show(title,url,w,h);

}
/*删除*/

function member_dels(obj,id){
 var bChecked = false;
    var a = document.getElementsByName("PeriodID");
    for (var i=0; i<a.length; i++)
    {
        if(a[i].checked)
        {
            var number=a[i].value;
            bChecked = true;
            break;
        }
    }
    if (bChecked==false)
    {
        alert("请先选择一期！");
        return;
    }
  layer.confirm('确认要删除吗？',function(index){
    var urls='/Index/dels';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':number,
      },
      dataType: 'json',
      success: function(data){
        if(data.code==true){
          $(".notic").html(data.titles);
          $(".notic").fadeIn().delay(1000).fadeOut(); 
        }else{
          $(".notic").html(data.titles);
          $(".notic").fadeIn().delay(1000).fadeOut();     
        }
        location.replace(location.href);
                    //setTimeout('location.replace(location.href)',3000);

      },

      error:function(data) {
        console.log(data.msg);
      },
    });
  });
}
/*开启-关闭*/

function member_starts(obj,id){
     var bChecked = false;
    var a = document.getElementsByName("PeriodID");
    for (var i=0; i<a.length; i++)
    {
        if(a[i].checked)
        {
            var number=a[i].value;
            bChecked = true;
            break;
        }
    }
    if (bChecked==false)
    {
        alert("请先选择一期！");
        return;
    }
  layer.confirm('确认要开启吗？',function(index){
    var urls='/Index/openStatus';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':number,
        'status':2,
      },
      dataType: 'json',
      success: function(data){
         if(data.code==true){
          $(".notic").html('成功');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
        }else{
          $(".notic").html('失败');
          $(".notic").fadeIn().delay(1000).fadeOut();     
        }
        //location.replace(location.href);
        setTimeout('location.replace(location.href)',3000);
      },
      error:function(data) {
        console.log(data.msg);
      },
    });
  });
}
/*开启-关闭*/

function member_starts1(obj,id){
     var bChecked = false;
    var a = document.getElementsByName("PeriodID");
    for (var i=0; i<a.length; i++)
    {
        if(a[i].checked)
        {
            var number=a[i].value;
            bChecked = true;
            break;
        }
    }
    if (bChecked==false)
    {
        alert("请先选择一期！");
        return;
    }
  layer.confirm('确认要关闭吗？',function(index){
    var urls='/Index/openStatus1';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':number,
        'status':2,
      },
      dataType: 'json',
      success: function(data){
         if(data.code==true){
          $(".notic").html('成功');
          $(".notic").fadeIn().delay(1000).fadeOut(); 
        }else{
          $(".notic").html('失败');
          $(".notic").fadeIn().delay(1000).fadeOut();     
        }
        //location.replace(location.href);
        setTimeout('location.replace(location.href)',3000);
      },
      error:function(data) {
        console.log(data.msg);
      },
    });
  });
}
//退码
function admin_role_tuima(title,url,w,h){
    var bChecked = false;
    var a = document.getElementsByName("PeriodID");
    for (var i=0; i<a.length; i++)
    {
        if(a[i].checked)
        {
            var number=a[i].value;
            bChecked = true;
            break;
        }
    }
    if (bChecked==false)
    {
        alert("请先选择一期！");
        return;
    }
    var url='/Index/tuima?id='+number;
  layer_show(title,url,w,h);

}
//开奖
function admin_role_kaijiang(title,url,w,h){
    var bChecked = false;
    var a = document.getElementsByName("PeriodID");
    for (var i=0; i<a.length; i++)
    {
        if(a[i].checked)
        {
            var number=a[i].value;
            bChecked = true;
            break;
        }
    }
    if (bChecked==false)
    {
        alert("请先选择一期！");
        return;
    }
    var url='/Index/kaijiang?id='+number;
  layer_show(title,url,w,h);

}

</script>
</body></html>