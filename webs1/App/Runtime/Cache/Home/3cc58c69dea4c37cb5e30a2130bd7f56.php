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
<title>报表列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 报表 <span class="c-gray en">&gt;</span> 月报表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
<!-- <?php if($_SESSION['autype']!= 'agency'): ?><form action="/Data/reports" method="get">
    <div class="text-c">
        <span class="select-box inline">
          <select name="userid" class="select">
            <option value="0">全部<?php echo ($titles); ?></option>
            <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($userid == $vo['au_id']): ?><option value="<?php echo ($vo["au_id"]); ?>" selected><?php echo ($vo["au_name"]); ?></option>
              <?php else: ?>
                <option value="<?php echo ($vo["au_id"]); ?>"><?php echo ($vo["au_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span> 
        <button class="btn btn-success" ><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
      <button name="" id="" class="btn btn-success" type="submit">下载</button>
       <button name="" id="" class="btn btn-success" type="submit"> 打印</button> 
    </div>
  </form><?php endif; ?> -->
  <form action="/Data/ureports1" method="get">
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
   <!-- 日期范围：

    <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" name="stime" value="<?php echo ($stime); ?>" style="width:120px;">

    -

    <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate"  name="etime" value="<?php echo ($etime); ?>" style="width:120px;"> -->
    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    <!-- <button name="" id="" class="btn btn-success" type="submit">下载</button> -->
   <!--  <button name="" id="" class="btn btn-success" type="submit"> 打印</button> -->
  </div>
  </form>
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="r"><button  class="btn btn-success" style="margin-right:10px"> 打印</button></span>
  </div>
  <div>
  
   <?php if($_SESSION['autype']== 'partner'): elseif($_SESSION['autype']== 'agencys'): ?>

    <?php else: endif; ?>



    <table class="table table-border table-bordered table-bg table-hover table-sort"><thead>
    <tr class="tc"> 
    <td rowspan="2" class="bg2" width="150">日期</td> 
  
    <?php if($_SESSION['autype']== 'admin'): ?><td colspan="3" class="bg-yellow">股东</td>
    <?php elseif($_SESSION['autype']== 'partner'): ?>
       <td colspan="4" class="bg-yellow">总代理</td> 
       <td colspan="2" class="bg-orange">  股东  </td>
       <td colspan="2" class="bg-pink">  超级管理员  </td>
    <?php elseif($_SESSION['autype']== 'agencys'): ?>
        <td colspan="4" class="bg-yellow">  代理  </td> 
      <td colspan="4" class="bg-orange">  总代理  </td>  
      <td colspan="2" class="bg-pink">  股东  </td>
    <?php elseif($_SESSION['autype']== 'agency'): ?>
       <td colspan="3" class="bg-yellow">  会员  </td> 
      <td colspan="4" class="bg-orange">  代理  </td>  
      <td colspan="2" class="bg-pink">  总代理  </td><?php endif; ?>
      
    <!-- <td colspan="4" class="bg-orange">  代理  </td>  
    <td colspan="2" class="bg-pink">  总代理   </td>  -->
    </tr> 
     <?php if($_SESSION['autype']== 'admin'): ?><tr class="tc"> 
          <td class="bg-yellow">笔数</td> 
          <td class="bg-yellow">总投</td> 
          <td class="bg-yellow">盈亏</td>
        </tr>
    <?php elseif($_SESSION['autype']== 'partner'): ?>
         <tr class="tc"> 
          <td class="bg-yellow">笔数</td> 
          <td class="bg-yellow">总投</td> 
          <td class="bg-yellow">盈亏</td>
          <td class="bg-yellow">赚水</td>
          <td class="bg-orange">总投</td> 
          <td class="bg-orange">盈亏</td>
          <td class="bg-pink">总投</td> 
          <td class="bg-pink">盈亏</td> 
        </tr>
    <?php elseif($_SESSION['autype']== 'agencys'): ?>
      <tr class="tc"> 
        <td class="bg-yellow">笔数</td> 
        <td class="bg-yellow">总投</td> 
        <td class="bg-yellow">盈亏</td>  
        <td class="bg-yellow">赚水</td> 
        <td class="bg-orange">  占成金额  </td> 
        <td class="bg-orange">  占成盈亏  </td> 
        <td class="bg-deeporg">   赚水   </td> 
        <td class="bg-deeporg">总盈亏</td>  
        <td class="bg-pink">总投</td> 
        <td class="bg-pink">盈亏</td> 
      </tr>
    <?php elseif($_SESSION['autype']== 'agency'): ?>
        <tr class="tc"> 
        <td class="bg-yellow">笔数</td> 
        <td class="bg-yellow">总投</td> 
        <td class="bg-yellow">盈亏</td>   
        <td class="bg-orange">  占成金额  </td> 
        <td class="bg-orange">  占成盈亏  </td> 
        <td class="bg-deeporg">   赚水   </td> 
        <td class="bg-deeporg">总盈亏</td>  
        <td class="bg-pink">总投</td> 
        <td class="bg-pink">盈亏</td> 
      </tr><?php endif; ?>
    
    </thead> 
    <tbody class="fn-hover">  
 
   
  <?php if(($_SESSION['autype']== 'admin') ): if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
      <?php if($vo["status"] == '1'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><strong class="red"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</strong></a></td>
      <?php else: ?>
        <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</a></td><?php endif; ?>
      <td class="bg-yellow">
        <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
      </td> 
      <!-- <td class="bg-yellow"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
      <td class="bg-yellow"><?php if($vo.yingkui): echo ($vo["yingkui"]); else: ?>0<?php endif; ?></td>  -->
      <td class="bg-yellow"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
      <td class="bg-yellow"><?php if($vo.yingkui): echo ($vo['yingkui']); else: ?>0<?php endif; ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  <td class="fb"><?php if($sum): echo ($sum); else: ?>0<?php endif; ?></td> 
    <td class="fb"><?php if($money): echo ($money); else: ?>0<?php endif; ?></td>  
    <td class="fb"><?php if($yingkui): echo ($yingkui); else: ?>0<?php endif; ?></td>  
    </tr>

    <?php elseif($_SESSION['autype']== 'partner'): ?>
       <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
        <?php if($vo["status"] == '1'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><strong class="red"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</strong></a></td>
        <?php else: ?>
          <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</a></td><?php endif; ?>
        <td class="bg-yellow">
          <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
        </td> 
        <td class="bg-yellow"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
        <td class="bg-yellow"><?php if($vo.yingkuis): echo ($vo['yingkuis']); else: ?>0<?php endif; ?></td> 
        <td class="bg-yellow"><?php if($vo.huishui): echo ($vo["huishui"]); else: ?>0<?php endif; ?></td> 

        <!-- <td class="bg-orange">0</td> <td class="bg-orange">0</td> <td class="bg-deeporg">0</td>   <td class="bg-deeporg">0</td>  -->  
      <!--   <td class="bg-orange"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-orange"><?php if($vo.yingkui): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td>  -->
        <td class="bg-orange"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
        <td class="bg-orange"><?php if($vo.yingkuis): echo ($vo['yingkuis']); else: ?>0<?php endif; ?></td> 
        <td class="bg-pink"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
        <td class="bg-pink"><?php if($vo.yingkui): echo ($vo['yingkui']); else: ?>0<?php endif; ?></td> 
        <!-- <td class="bg-pink"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-pink"><?php if($vo.yingkui): echo ($vo["yingkui"]); else: ?>0<?php endif; ?></td>  --><?php endforeach; endif; else: echo "" ;endif; ?>
       <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
       <td class="fb"><?php if($sum): echo ($sum); else: ?>0<?php endif; ?></td> 

       <!-- <td class="fb"><?php if($money): echo ($money); else: ?>0<?php endif; ?></td> 
        <td class="fb"><?php if($yingkui): echo ($yingkuis); else: ?>0<?php endif; ?></td>   --> 
        <td class="fb"><?php if($money): echo ($money-$umoney); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkuis): echo ($yingkuis); else: ?>0<?php endif; ?></td>
        <td class="fb"><?php if($huishui): ?>--<?php else: ?>--<?php endif; ?></td>   
          
        <!-- <td class="fb">0</td> <td class="fb">0</td> <td class="fb">0</td>   <td class="fb">0</td> -->   
        <td class="fb"><?php if($money): echo ($money); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkui): echo ($yingkui); else: ?>0<?php endif; ?></td>
        <td class="fb"><?php if($money): echo ($money-$umoney); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkui): echo ($yingkui); else: ?>0<?php endif; ?></td>      
    </tr>
    <?php elseif($_SESSION['autype']== 'agencys'): ?>
         <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
        <?php if($vo["status"] == '1'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><strong class="red"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</strong></a></td>
        <?php else: ?>
          <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</a></td><?php endif; ?>
        <td class="bg-yellow">
          <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
        </td> 
        <td class="bg-yellow"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
        <td class="bg-yellow"><?php if($vo.yingkuis): echo ($vo['yingkuis']); else: ?>0<?php endif; ?></td> 
        <td class="bg-yellow"><?php if($vo.huishui): echo ($vo["huishui"]); else: ?>0<?php endif; ?></td>

        <!-- <td class="bg-orange">0</td> <td class="bg-orange">0</td>  -->
        <td class="bg-orange"><?php if($vo.money): ?>0<?php else: ?>0<?php endif; ?></td>  
        <td class="bg-orange"><?php if($vo.yingkuis): ?>0<?php else: ?>0<?php endif; ?></td> 

        <td class="bg-deeporg"><?php if($vo.huishui1): echo ($vo["huishui1"]); else: ?>0<?php endif; ?></td> 
        <td class="bg-deeporg"><?php if($vo.yingkuis): echo ($vo['yingkuis']); else: ?>0<?php endif; ?></td>  
        <!-- <td class="bg-deeporg"><?php if($vo.yingkui): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td>    -->
        <td class="bg-pink"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
        <td class="bg-pink"><?php if($vo.yingkui): echo ($vo['yingkui']); else: ?>0<?php endif; ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
       <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
       <td class="fb"><?php if($sum): echo ($sum); else: ?>0<?php endif; ?></td> 
       <td class="fb"><?php if($money): echo ($money); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkuis): echo ($yingkuis); else: ?>0<?php endif; ?></td>
        <td class="fb">--</td>
        <td class="fb"><?php if($money): ?>0<?php else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkuis): ?>0<?php else: ?>0<?php endif; ?></td>
         <td class="fb">--</td>   
         <td class="fb"><?php if($yingkuis): echo ($yingkuis); else: ?>0<?php endif; ?></td>   
        <td class="fb"><?php if($money): echo ($money); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkui): echo ($yingkui); else: ?>0<?php endif; ?></td>      
    </tr>
    <?php elseif($_SESSION['autype']== 'agency'): ?>
         <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
        <?php if($vo["status"] == '1'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><strong class="red"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</strong></a></td>
        <?php else: ?>
          <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?qishu=<?php echo ($vo["qishu"]); ?>" class="gray"><?php echo ($vo["md"]); ?>(<?php echo ($vo["qishu"]); ?>)</a></td><?php endif; ?>
        <td class="bg-yellow">
          <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
        </td> 
        <td class="bg-yellow"><?php if($vo.money): echo ($vo['money']); else: ?>0<?php endif; ?></td>  
        <td class="bg-yellow"><?php if($vo.yingkuis): echo ($vo['yingkuis']); else: ?>0<?php endif; ?></td> 

        <td class="bg-orange"><?php if($vo.umoney): echo ($vo['umoney']); else: ?>0<?php endif; ?></td>  
        <td class="bg-orange"><?php if($vo.uyingkui): echo ($vo['uyingkui']); else: ?>0<?php endif; ?></td> 
     
      <td class="bg-deeporg"><?php if($vo.huishui): echo ($vo["huishui"]); else: ?>0<?php endif; ?></td>   
     <td class="bg-deeporg"><?php if($vo.uyingkui): echo ($vo['uyingkui']); else: ?>0<?php endif; ?></td>    
      <td class="bg-pink"><?php if($vo.money): echo ($vo['money']-$vo['umoney']); else: ?>0<?php endif; ?></td>  
      <td class="bg-pink"><?php if($vo.yingkui): echo ($vo['yingkui']-$vo['uyingkui']); else: ?>0<?php endif; ?></td> 
      <tr><?php endforeach; endif; else: echo "" ;endif; ?>

  
       <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
        <td class="fb"><?php if($sum): echo ($sum); else: ?>0<?php endif; ?></td> 
        <td class="fb"><?php if($money): echo ($money); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkuis): echo ($yingkuis); else: ?>0<?php endif; ?></td>   
        <td class="fb"><?php if($umoney): echo ($umoney); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($uyingkuis): echo ($uyingkui); else: ?>0<?php endif; ?></td> 
        <td class="fb">--</td>   
         <td class="fb"><?php if($uyingkuis): echo ($uyingkui); else: ?>0<?php endif; ?></td>    
        <td class="fb"><?php if($money): echo ($money-$umoney); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($yingkui): echo ($yingkui-$uyingkui); else: ?>0<?php endif; ?></td>  
    </tr><?php endif; ?>



  </tbody>  
  </table>



  </div>
</div>
<style>
.red{
  color:red;
}
.tfoot td {
    background: #CEFFE7;
}
.table tr,.table td{
    text-align: center;
}
.bg-yellow{
  background: #FFCC66;
}
 .bg-orange{
    background: #FFDDAA
 }     
.bg-deeporg{
  background: #FFC184;
}
.bg-pink{
      background: #FFD7EB;
}
.blue{
  color:blue;
}
</style>
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