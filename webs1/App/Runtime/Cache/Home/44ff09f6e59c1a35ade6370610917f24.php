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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 报表 <span class="c-gray en">&gt;</span> 日报表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
<!-- <?php if($utype != 'agency'): ?><form action="/Data/reports" method="get">
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
  
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="r"><button  class="btn btn-success" style="margin-right:10px"> 打印</button></span>
  </div>
  <div>
      <table class="table table-border table-bordered table-bg table-hover table-sort"><thead>
    <tr class="tc"> 
    <?php if($utype == 'admin'): ?><td rowspan="2" class="bg2" width="150"> 股东 </td> 
        <td colspan="3" class="bg-yellow">股东</td>
    <?php elseif($utype == 'partner'): ?>
       <td rowspan="2" class="bg2" width="150"> 总代理 </td> 
       <td colspan="4" class="bg-yellow">总代理</td> 
       <td colspan="2" class="bg-orange">  股东  </td>
        <td colspan="2" class="bg-pink">  超级管理员  </td>
    <?php elseif($utype == 'agencys'): ?>
       <td rowspan="2" class="bg2" width="150"> 代理 </td> 
        <td colspan="4" class="bg-yellow">  代理  </td> 
      <td colspan="4" class="bg-orange">  总代理  </td>  
      <td colspan="2" class="bg-pink">  股东  </td>
    <?php elseif($utype == 'agency'): ?>
       <td rowspan="2" class="bg2" width="150"> 会员 </td> 
       <td colspan="3" class="bg-yellow">  会员  </td> 
      <td colspan="4" class="bg-orange">  代理  </td>  
      <td colspan="2" class="bg-pink">  总代理  </td><?php endif; ?>
      
    <!-- <td colspan="4" class="bg-orange">  代理  </td>  
    <td colspan="2" class="bg-pink">  总代理   </td>  -->
    </tr> 
     <?php if($utype == 'admin'): ?><tr class="tc"> 
          <td class="bg-yellow">笔数</td> 
          <td class="bg-yellow">总投</td> 
          <td class="bg-yellow">盈亏</td>
        </tr>
    <?php elseif($utype == 'partner'): ?>
         <tr class="tc"> 
          <td class="bg-yellow">笔数</td> 
          <td class="bg-yellow">总投</td> 
          <td class="bg-yellow">盈亏</td>
          <td class="bg-yellow">   赚水   </td> 
          <td class="bg-orange">   总投   </td> 
        <td class="bg-orange">总盈亏</td> 
           <td class="bg-pink">总投</td> 
        <td class="bg-pink">盈亏</td> 
        </tr>
    <?php elseif($utype == 'agencys'): ?>
      <tr class="tc"> 
        <td class="bg-yellow">笔数</td> 
        <td class="bg-yellow">总投</td> 
        <td class="bg-yellow">盈亏</td>  
        <td class="bg-yellow">   赚水   </td>  
        <td class="bg-orange">  占成金额  </td> 
        <td class="bg-orange">  占成盈亏  </td> 
        <td class="bg-deeporg">   赚水   </td> 
        <td class="bg-deeporg">总盈亏</td>  
        <td class="bg-pink">总投</td> 
        <td class="bg-pink">盈亏</td> 
      </tr>
    <?php elseif($utype == 'agency'): ?>
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
 
   
  <?php if(($utype == 'admin') ): if(is_array($datas)): $k = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
      <?php if($utype == 'agency'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data?uname=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td> 
      <?php else: ?>
        <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?unames=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td><?php endif; ?>
      <td class="bg-yellow">
        <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
      </td> 
      <td class="bg-yellow"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
      <td class="bg-yellow"><?php if($vo.yingkui): echo ($vo["yingkui"]); else: ?>0<?php endif; ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
   <td class="fb"><?php if($data['sum']): echo ($data['sum']); else: ?>0<?php endif; ?></td> 
    <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
    <td class="fb"><?php if($data['yingkui']): echo ($data['yingkui']); else: ?>0<?php endif; ?></td> 
    </tr>
  <?php elseif($utype == 'partner'): ?>
       <?php if(is_array($datas)): $k = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
      <?php if($utype == 'agency'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data?uname=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td> 
      <?php else: ?>
        <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?unames=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td><?php endif; ?>
      <td class="bg-yellow">
        <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
      </td> 
      <td class="bg-yellow"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
      <td class="bg-yellow"><?php if($vo["yingkuis"] ): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td> 
      <td class="bg-yellow"><?php if($vo.huishui): echo ($vo["huishui"]); else: ?>0<?php endif; ?></td>
      <!-- <td class="bg-yellow">0</td>  -->
      <td class="bg-orange"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-orange"><?php if($vo["yingkuis"] ): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td> 
       <td class="bg-pink"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-pink"><?php if($vo["yingkui"] ): echo ($vo["yingkui"]); else: ?>0<?php endif; ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
   <td class="fb"><?php if($data['sum']): echo ($data['sum']); else: ?>0<?php endif; ?></td> 
    <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
    <td class="fb"><?php if($data['yingkui']): echo -$data['yingkui']; else: ?>0<?php endif; ?></td> 
    <td class="fb">0</td>
    <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
    <td class="fb"><?php if($data['yingkui']): echo -$data['yingkui']; else: ?>0<?php endif; ?></td> 

    <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
    <td class="fb"><?php if($data['yingkui']): echo ($data['yingkui']); else: ?>0<?php endif; ?></td> 

    </tr>
    <?php elseif($utype == 'agencys'): ?>
         <?php if(is_array($datas)): $k = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
        <?php if($utype == 'agency'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data?uname=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td> 
      <?php else: ?>
        <td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data/ureports?unames=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td><?php endif; ?>
        <td class="bg-yellow">
          <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
        </td> 
        <td class="bg-yellow"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-yellow"><?php if($vo.yingkuis): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td> 
        <td class="bg-yellow"><?php if($vo.huishui): echo ($vo["huishui"]); else: ?>0<?php endif; ?></td>
        <!-- <td class="bg-orange">0</td> 
        <td class="bg-orange">0</td>  -->
        <td class="bg-orange"><?php if($vo.money): ?>0<?php else: ?>0<?php endif; ?></td>  
        <td class="bg-orange"><?php if($vo.yingkuis): ?>0<?php else: ?>0<?php endif; ?></td> 
        <td class="bg-deeporg">0</td>  
        <td class="bg-deeporg"><?php if($vo.yingkuis): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td>   
        <td class="bg-pink"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-pink"><?php if($vo.yingkui): echo ($vo["yingkui"]); else: ?>0<?php endif; ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
       <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td> 
        <td class="fb"><?php if($data['sum']): echo ($data['sum']); else: ?>0<?php endif; ?></td> 
        <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($data['yingkui']): echo -$data['yingkui']; else: ?>0<?php endif; ?></td>
         <td class="fb">0</td> 
        <td class="fb"><?php if($data['money']): ?>0<?php else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($data['yingkui']): ?>0<?php else: ?>0<?php endif; ?></td>
        <td class="fb">0</td> 
        <td class="fb"><?php if($data['yingkui']): echo -$data['yingkui']; else: ?>0<?php endif; ?></td> 

        <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($data['yingkui']): echo ($data['yingkui']); else: ?>0<?php endif; ?></td>     
    </tr>
    <?php elseif($utype == 'agency'): ?>
      <?php if(is_array($datas)): $k = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
      <?php if($utype == 'agency'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data?uname=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td> 
      <?php else: ?>
        <td> <strong class="blue">[<?php echo ($k); ?>]</strong><?php echo ($vo["au_name"]); ?></td><?php endif; ?>
        <td class="bg-yellow">
          <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
        </td> 
        <td class="bg-yellow"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  
        <td class="bg-yellow"><?php if($vo.yingkuis): echo ($vo["yingkuis"]); else: ?>0<?php endif; ?></td> 

        <td class="bg-orange"><?php if($vo.umoney): echo ($vo["umoney"]); else: ?>0<?php endif; ?></td> 
        <td class="bg-orange"><?php if($vo.uyingkui): echo ($vo["uyingkui"]); else: ?>0<?php endif; ?></td> 
        <td class="bg-deeporg"><?php if($vo.huishui): echo ($vo["huishui"]); else: ?>0<?php endif; ?></td>
        <td class="bg-deeporg"><?php if($vo.uyingkui): echo ($vo["uyingkui"]); else: ?>0<?php endif; ?></td>  

        <td class="bg-pink"><?php if($vo.money): echo ($vo['money']-$vo['umoney']); else: ?>0<?php endif; ?></td>  
        <td class="bg-pink"><?php if($vo.yingkui): echo ($vo['yingkui']-$vo['uyingkui']); else: ?>0<?php endif; ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
      <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
        <td class="fb"><?php if($data['sum']): echo ($data['sum']); else: ?>0<?php endif; ?></td> 
        <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($data['yingkui']): echo ($data['yingkuis']); else: ?>0<?php endif; ?></td>  
       
        <td class="fb"><?php if($data['umoney']): echo ($data['umoney']); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($data['uyingkui']): echo ($data['uyingkui']); else: ?>0<?php endif; ?></td>
        <td class="fb">0</td>
        <td class="fb"><?php if($data['uyingkui']): echo ($data['uyingkui']); else: ?>0<?php endif; ?></td>   
  
        <td class="fb"><?php if($data['money']): echo ($data['money']-$data['umoney']); else: ?>0<?php endif; ?></td>  
        <td class="fb"><?php if($data['yingkui']): echo ($data['yingkui']-$data['uyingkui']); else: ?>0<?php endif; ?></td> 
    </tr><?php endif; ?>



  </tbody>  
  </table>
 <!--    <table class="table table-border table-bordered table-bg table-hover table-sort"><thead>
    <tr class="tc"> 
    <td rowspan="2" class="bg2" width="150">  名称  </td> 
    <td colspan="3" class="bg-yellow">
    <?php if($utype == 'admin'): ?>股东
    <?php elseif($utype == 'partner'): ?>
      总代理
    <?php elseif($utype == 'agencys'): ?>
      代理
    <?php elseif($utype == 'agency'): ?>
      会员<?php endif; ?>
    </td>   
    <td colspan="4" class="bg-orange">  代理  </td>  
    <td colspan="2" class="bg-pink">  总代理   </td> 
    </tr> 
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
    </tr> 
    </thead> 
    <tbody class="fn-hover">  
    <?php if($datas): if(is_array($datas)): $k = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr> 
      <?php if($utype == 'agency'): ?><td> <strong class="blue">[<?php echo ($k); ?>]</strong><a href="/Data?uname=<?php echo ($vo["au_name"]); ?>&qishu=<?php echo ($qishu1); ?>" ><?php echo ($vo["au_name"]); ?></a></td> 
      <?php else: ?>
        <td> <strong class="blue">[<?php echo ($k); ?>]</strong><?php echo ($vo["au_name"]); ?>  </td><?php endif; ?>
      <td class="bg-yellow">
        <?php if($vo.sum): echo ($vo["sum"]); else: ?>0<?php endif; ?>
      </td> <td class="bg-yellow"><?php if($vo.money): echo ($vo["money"]); else: ?>0<?php endif; ?></td>  <td class="bg-yellow"><?php if($vo.yingkui): echo ($vo["yingkui"]); else: ?>0<?php endif; ?></td> </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  
    <td class="fb"><?php if($data['sum']): echo ($data['sum']); else: ?>0<?php endif; ?></td> 
    <td class="fb"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>  
    <td class="fb"><?php if($data['yingkui']): echo ($data['yingkui']); else: ?>0<?php endif; ?></td>  
    </tr>
    <?php else: ?>
      <tr><td colspan='4'>没有数据</td></tr><?php endif; ?>
  </tbody>  
  </table> -->
  </div>
</div>
<style>
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