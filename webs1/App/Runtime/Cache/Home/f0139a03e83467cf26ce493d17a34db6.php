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
<title>分类账管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类账管理 <span class="c-gray en">&gt;</span> 月分类账 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
<form action="/Datas/monthDatas" method="get">
  <div class="text-c">
    <!-- <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button> -->
   期号：
   <span class="select-box inline">
    <select name="qishu1" class="select">
      <!-- <option value="0">全部开奖期号</option> -->
      <?php if(is_array($qishu3)): $i = 0; $__LIST__ = $qishu3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu1 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
        <?php else: ?>
          <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </span>
    ~
    <span class="select-box inline">
    <select name="qishu2" class="select">
      <!-- <option value="0">全部开奖期号</option> -->
      <?php if(is_array($qishu4)): $i = 0; $__LIST__ = $qishu4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu2 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
        <?php else: ?>
          <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </span>
    <input type="hidden" name="uid" value="<?php echo ($userID); ?>" />
    <?php if($_SESSION['autype']!= 'agency' AND $userID == ''): ?><span class="select-box inline">
        <select name="userid" class="select">
          <option value="0">全部<?php echo ($titles); ?></option>
          <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($userid == $vo['au_id']): ?><option value="<?php echo ($vo["au_id"]); ?>" selected><?php echo ($vo["au_name"]); ?></option>
            <?php else: ?>
              <option value="<?php echo ($vo["au_id"]); ?>"><?php echo ($vo["au_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </span><?php endif; ?>
   <!-- 日期范围：

    <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" name="stime" value="<?php echo ($stime); ?>" style="width:120px;">

    -

    <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate"  name="etime" value="<?php echo ($etime); ?>" style="width:120px;"> -->
    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    <!-- <button name="" id="" class="btn btn-success" type="submit">下载</button> -->
   <!--  <button name="" id="" class="btn btn-success" type="submit"> 打印</button> -->
  </div>
  </form>
  <div class="cl pd-5 bg-1 bk-gray mt-20" style="height:20px"><!--  <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加资讯" data-href="article-add.html" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span>  --><!-- <span class="r">共有数据：<strong>54</strong> 条</span> --> </div>
  <div>

    <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead> 
    <tr class="bg2 tc">  
    <td width="14%">日期</td> 
    <td width="14%">类别</td> 
    <td width="14%">笔数</td> 
    <td width="14%">下注金额</td> 
    <!-- <td width="14%">回水</td>  -->
    <td width="14%">中奖</td> 
    <td width="14%">盈亏</td> 

    </tr> </thead> 
    <tbody id="tbody"> 
    <?php if($data): ?><tr>
        <td width="14%" class="bg6">总合计</td>
        <td style="cursor: pointer; color: #FF6600;" width="14%" class="displays">总货合计</td>
        <td width="14%" class="bg3 f14 bold"><?php if($data2['sum']): echo ($data2['sum']); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($data2['money']): echo ($data2['money']); else: ?>0<?php endif; ?></td>
        <!-- <td data-bind="text:Math.ceil(TotalBackComm)"><?php if($win): echo ($win); else: ?>0<?php endif; ?></td> -->
        <td width="14%" class="bg3 f14 bold"><?php if($data2['money1']): echo ($data2['money1']); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($data2['money']): echo intval($data2['money']-$data2['money1']-$data2['win']); else: ?>0<?php endif; ?></td>
    </tr>
    <tr class="tables" style="display:none"> 
    <td colspan="6" style="padding:0px;border:0px"> 
    <table class="t-1">
    <tbody class="fn-hover">     
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">二定位</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2['ding23']): echo ($data2['ding23']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2['ding21']): echo ($data2['ding21']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2['ding24']): echo ($data2['ding24']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2['ding23']): echo intval($data2['ding21']-$data2['ding24']-$data2['ding22']); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口口XX</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[1][2]): echo ($data2[1][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[1][0]): echo ($data2[1][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[1][3]): echo ($data2[1][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[1][0]): echo intval($data2[1][0]-$data2[1][3]-$data2[1][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>   
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口X口X</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[2][2]): echo ($data2[2][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[2][0]): echo ($data2[2][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[2][3]): echo ($data2[2][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[2][0]): echo intval($data2[2][0]-$data2[2][3]-$data2[2][1]); else: ?>0<?php endif; ?></td>  
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口XX口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[3][2]): echo ($data2[3][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[3][0]): echo ($data2[3][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[3][3]): echo ($data2[3][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[3][0]): echo intval($data2[3][0]-$data2[3][3]-$data2[3][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">X口X口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[4][2]): echo ($data2[4][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[4][0]): echo ($data2[4][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[4][3]): echo ($data2[4][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[4][0]): echo intval($data2[4][0]-$data2[4][3]-$data2[4][1]); else: ?>0<?php endif; ?></td>  
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">X口口X</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[5][2]): echo ($data2[5][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[5][0]): echo ($data2[5][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[5][3]): echo ($data2[5][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[5][0]): echo intval($data2[5][0]-$data2[5][3]-$data2[5][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">XX口口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[6][2]): echo ($data2[6][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[6][0]): echo ($data2[6][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[6][3]): echo ($data2[6][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[6][0]): echo intval($data2[6][0]-$data2[6][3]-$data2[6][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">三定位</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2['ding33']): echo ($data2['ding33']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2['ding31']): echo ($data2['ding31']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2['ding34']): echo ($data2['ding34']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2['ding31']): echo intval($data2['ding31']-$data2['ding34']-$data2['ding32']); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td>
    <td width="14%">口口口X</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[7][2]): echo ($data2[7][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[7][0]): echo ($data2[7][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[7][3]): echo ($data2[7][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[7][0]): echo intval($data2[7][0]-$data2[7][3]-$data2[7][1]); else: ?>0<?php endif; ?></td>
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口口X口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[8][2]): echo ($data2[8][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[8][0]): echo ($data2[8][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[8][3]): echo ($data2[8][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[8][0]): echo intval($data2[8][0]-$data2[8][3]-$data2[8][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口X口口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[9][2]): echo ($data2[9][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[9][0]): echo ($data2[9][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[9][3]): echo ($data2[9][3]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data2[9][0]): echo intval($data2[9][0]-$data2[9][3]-$data2[9][1]); else: ?>0<?php endif; ?></td>  
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">X口口口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[10][2]): echo ($data2[10][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[10][0]): echo ($data2[10][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[10][3]): echo ($data2[10][3]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[10][0]): echo intval($data2[10][0]-$data2[10][3]-$data2[10][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">四定位</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[11][2]): echo ($data2[11][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[11][0]): echo ($data2[11][0]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="bg3 f14 bold"><?php if($data2[11][3]): echo ($data2[11][3]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[11][0]): echo intval($data2[11][0]-$data2[11][3]-$data2[11][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">二字现</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[12][2]): echo ($data2[12][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[12][0]): echo ($data2[12][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[12][3]): echo ($data2[12][3]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[12][0]): echo intval($data2[12][0]-$data2[12][3]-$data2[12][1]); else: ?>0<?php endif; ?></td>
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
     </tr> 
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">三字现</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[13][2]): echo ($data2[13][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[13][0]): echo ($data2[13][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[13][3]): echo ($data2[13][3]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[13][0]): echo intval($data2[13][0]-$data2[13][3]-$data2[13][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>   
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">四字现</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[14][2]): echo ($data2[14][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[14][0]): echo ($data2[14][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data2[14][3]): echo ($data2[14][3]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data2[14][0]): echo intval($data2[14][0]-$data2[14][3]-$data2[14][1]); else: ?>0<?php endif; ?></td> 
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    </tbody> </table> </td> </tr>
    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="bg6"><a href="/Datas/index?qishu=<?php echo ($vo["qishu"]); ?>" style="color:blue"><strong class="blue"><?php echo ($vo["name"]); ?></strong></a></td>
        <?php else: ?>
             <td width="14%" class="bg6"><a href="/Datas/index?qishu=<?php echo ($vo["qishu"]); ?>" style="color:red"><strong class="red"><?php echo ($vo["name"]); ?></strong></a></td><?php endif; ?>
            
            <td style="cursor: pointer; color: #FF6600;" width="14%" onclick="display('<?php echo ($vo["qishu"]); ?>')">总货合计</td>
            <td width="14%" class="bg3 f14 bold"><?php if($vo['sum']): echo ($vo['sum']); else: ?>0<?php endif; ?></td>
            <td width="14%" class="f14 bold"><?php if($vo['money']): echo ($vo['money']); else: ?>0<?php endif; ?></td>
            <!-- <td data-bind="text:Math.ceil(TotalBackComm)"><?php if($win): echo ($win); else: ?>0<?php endif; ?></td> -->

            <td width="14%" class="bg3 f14 bold"><?php if($vo['money1']): echo ($vo['money1']); else: ?>0<?php endif; ?></td>
            <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo['money']): echo ($vo['money']-$vo['money1']-$vo['win']); else: ?>0<?php endif; ?></td>
                
            <?php else: ?>
                <td width="14%" class="f14 bold">0</td><?php endif; ?>
            
        </tr>
        <tr class="tables<?php echo ($vo["qishu"]); ?>" style="display:none"> 
        <td colspan="6" style="padding:0px;border:0px"> 
        <table class="t-1">
        <tbody class="fn-hover">     
        <tr class=""> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">二定位</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo['ding23']): echo ($vo['ding23']); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo['ding21']): echo ($vo['ding21']); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo['ding24']): echo ($vo['ding24']); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo['ding23']): echo ($vo['ding21']-$vo['ding24']-$vo['ding22']); else: ?>0<?php endif; ?></td>  
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?>
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr> 
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">口口XX</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[1][2]): echo ($vo[1][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[1][0]): echo ($vo[1][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[1][3]): echo ($vo[1][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[1][0]): echo ($vo[1][0]-$vo[1][1]-$vo[1][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?>
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
        </tr>   
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">口X口X</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[2][2]): echo ($vo[2][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[2][0]): echo ($vo[2][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[2][3]): echo ($vo[2][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[2][0]): echo ($vo[2][0]-$vo[2][1]-$vo[2][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?>
         
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
        </tr>  
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">口XX口</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[3][2]): echo ($vo[3][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[3][0]): echo ($vo[3][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[3][3]): echo ($vo[3][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[3][0]): echo ($vo[3][0]-$vo[3][1]-$vo[3][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?>
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr> 
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">X口X口</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[4][2]): echo ($vo[4][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[4][0]): echo ($vo[4][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[4][3]): echo ($vo[4][3]); else: ?>0<?php endif; ?></td>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[4][0]): echo ($vo[4][0]-$vo[4][1]-$vo[4][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
          
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
        </tr> 
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">X口口X</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[5][2]): echo ($vo[5][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[5][0]): echo ($vo[5][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[5][3]): echo ($vo[5][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[5][0]): echo ($vo[5][0]-$vo[5][1]-$vo[5][3]); else: ?>0<?php endif; ?></td>  
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr>  
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">XX口口</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[6][2]): echo ($vo[6][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[6][0]): echo ($vo[6][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[6][3]): echo ($vo[6][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[6][0]): echo ($vo[6][0]-$vo[6][1]-$vo[6][3]); else: ?>0<?php endif; ?></td>
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
         
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
        </tr>  
        <tr class=""> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">三定位</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo['ding33']): echo ($vo['ding33']); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo['ding31']): echo ($vo['ding31']); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo['ding34']): echo ($vo['ding34']); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo['ding31']): echo ($vo['ding31']-$vo[ding34]-$vo['ding32']); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr>  
       <tr class="bg5"> 
        <td width="14%" class="bg6"></td>
        <td width="14%">口口口X</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[10][2]): echo ($vo[10][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[10][0]): echo ($vo[10][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[10][3]): echo ($vo[10][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[10][0]): echo ($vo[10][0]-$vo[10][1]-$vo[10][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr>  
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">口口X口</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[9][2]): echo ($vo[9][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[9][0]): echo ($vo[9][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[9][3]): echo ($vo[9][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[9][0]): echo ($vo[9][0]-$vo[9][1]-$vo[9][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
         
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
        </tr>  
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">口X口口</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[8][2]): echo ($vo[8][2]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="f14 bold"><?php if($vo[8][0]): echo ($vo[8][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[8][3]): echo ($vo[8][3]); else: ?>0<?php endif; ?></td> 
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[8][0]): echo ($vo[8][0]-$vo[8][1]-$vo[8][3]); else: ?>0<?php endif; ?></td>  
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
         
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr> 
        <tr class="bg5"> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">X口口口</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[7][2]): echo ($vo[7][2]); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($vo[7][0]): echo ($vo[7][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[7][3]): echo ($vo[7][3]); else: ?>0<?php endif; ?></td>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[7][0]): echo ($vo[7][0]-$vo[10][1]-$vo[7][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
       
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr>    
        <tr class=""> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">四定位</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[11][2]): echo ($vo[11][2]); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($vo[11][0]): echo ($vo[11][0]); else: ?>0<?php endif; ?></td>
        <td width="14%" class="bg3 f14 bold"><?php if($vo[11][3]): echo ($vo[11][3]); else: ?>0<?php endif; ?></td>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[11][0]): echo ($vo[11][0]-$vo[11][1]-$vo[11][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
        </tr>  
        <tr class=""> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">二字现</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[12][2]): echo ($vo[12][2]); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($vo[12][0]): echo ($vo[12][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[12][3]): echo ($vo[12][3]); else: ?>0<?php endif; ?></td>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[12][0]): echo ($vo[12][0]-$vo[12][1]-$vo[12][3]); else: ?>0<?php endif; ?></td> 
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
         </tr> 
        <tr class=""> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">三字现</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[13][2]): echo ($vo[13][2]); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($vo[13][0]): echo ($vo[13][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[13][3]): echo ($vo[13][3]); else: ?>0<?php endif; ?></td>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[13][0]): echo ($vo[13][0]-$vo[13][1]-$vo[13][3]); else: ?>0<?php endif; ?></td>  
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
        
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr>   
        <tr class=""> 
        <td width="14%" class="bg6"></td> 
        <td width="14%">四字现</td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[14][2]): echo ($vo[14][2]); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($vo[14][0]): echo ($vo[14][0]); else: ?>0<?php endif; ?></td> 
        <td width="14%" class="bg3 f14 bold"><?php if($vo[14][3]): echo ($vo[14][3]); else: ?>0<?php endif; ?></td>
        <?php if($vo['status'] == '3'): ?><td width="14%" class="f14 bold"><?php if($vo[14][0]): echo ($vo[14][0]-$vo[14][1]-$vo[14][3]); else: ?>0<?php endif; ?></td>  
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?> 
         
        <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
        </tr> 
        </tbody> </table> </td> </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?>
    <tr><td>没有数据</td></tr><?php endif; ?>
       </tbody> </table>
  </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript">
    $(function(){
        $('.displays').click(function(){
            var t=$('.tables').css('display');
            if(t=='none'){
                $('.tables').show();
            }else{
                $('.tables').hide();   
            }
          
        });
    });
    function display(e){
      var t=$('.tables'+e).css('display');
       if(t=='none'){
            $('.tables'+e).show();
        }else{
            $('.tables'+e).hide();   
        }
    }
</script>  
</body>
</html>