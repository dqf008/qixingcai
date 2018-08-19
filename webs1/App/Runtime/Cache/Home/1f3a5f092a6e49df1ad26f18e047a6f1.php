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
<form action="/Datas" method="get">
  <div class="text-c">
    <!-- <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button> -->
   期号：
   <span class="select-box inline">
    <select name="qishu" class="select">
      <!-- <option value="0">全部开奖期号</option> -->
      <?php if(is_array($qishu)): $i = 0; $__LIST__ = $qishu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu1 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
        <?php else: ?>
          <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </span>
   日期范围：

    <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" name="stime" value="<?php echo ($stime); ?>" style="width:120px;">

    -

    <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate"  name="etime" value="<?php echo ($etime); ?>" style="width:120px;">
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
    <td>  日期  </td> 
    <td>会员</td> 
    <td>占成金额</td> 
    <td>占成总金额</td> 
    <td>占成总盈亏</td> 
    <td>百分比占成盈亏</td> 
    <td>实际占成盈亏</td> 
    <td>占成百分比</td> 
    <td>贡献度</td> 
    </tr> </thead> 
    <tbody id="tbody"> 
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr> 
   <!--  <tr class="fn-hover">
     <td class="bg3 fb red"> 总合计 </td> 
     <td>
     <a class="blue"><span class="ico-open"></span></a>
     <a href="javascript:void(0)" class="fn-getledger getTotal" _target="17086170831" ledger_level="10">总货合计</a></td> 
     <td class="bg3 fb f14"><?php echo ($data2['sums']); ?></td> 
     <td class="fb f14"><?php echo ($data2['moenys']); ?></td> 
     <td class="bg3 fb f14">0</td> 
     <td class="fb f14">0</td> 
     <td class="bg3 fb f14">0</td> 
     </tr>
      <tr class="hide"> <td id="17086170831" colspan="7" class="no-padding"></td> </tr> <tr class="fn-hover"> <td class="bg3 fb red"></td> <td class="blue"><span class="ico-open"></span><a href="javascript:void(0)" class="fn-getledger getTotal" _target="17086170832" ledger_level="20">占成合计</a></td> <td class="bg3 fb f14">0</td> <td class="fb f14">0</td> <td class="bg3 fb f14">0</td> <td class="fb f14">0</td> <td class="bg3 fb f14">0</td> </tr> <tr class="hide"> <td id="17086170832" colspan="7" class="no-padding"></td> </tr>    
      <?php if(is_array($data1)): $i = 0; $__LIST__ = $data1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="fn-hover"> <td class="bg3">   <a href="#!reportclass?level=2&amp;period_no=17084"><?php echo ($vo["md"]); ?></a>   </td> <td><span class="ico-open"></span><a href="javascript:void(0)" class="fn-getledger" _target="1708410t855" period_no="17084" member_id="31565" ledger_level="10">总货合计</a></td> <td class="bg3 fb f14"><?php echo ($vo["sum"]); ?></td> <td class="fb f14"><?php echo ($vo["money"]); ?></td> <td class="bg3 fb f14">0</td> <td class="fb f14">0</td> <td class="bg3 fb f14">0</td> </tr>  <tr class="hide"> <td id="1708410t855" colspan="7" class="no-padding"></td> </tr>   <tr class="hide"> <td id="1708420t855" colspan="7" class="no-padding"></td> </tr><?php endforeach; endif; else: echo "" ;endif; ?> -->
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
</body>
</html>