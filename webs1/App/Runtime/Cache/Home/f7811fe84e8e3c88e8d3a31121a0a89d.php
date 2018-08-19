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
<style>
/* td.reportNow_z, .reportNow_z.td, .reportNow_z td {
    background-color: #FFC184;
}
.tableborder td {
    border-bottom: 1px solid #F6D3BC;
    border-right: 1px solid #F6D3BC;
    line-height: 1.5em;
    height: 2em;
    padding: 4px;
    background: #fff;
}*/
/*.t-1 tr td.bg6 {
    background: #F1F5F8;
}
.t-1 tr.bg5 td, .t-1 td.bg5 {
    background: #FFC184;
}
*/
</style>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类账管理 <span class="c-gray en">&gt;</span> 日分类账 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
<?php if($_SESSION['autype']!= 'agency'): ?><form action="/Datas/index" method="get">
    <div class="text-c">
        <span class="select-box inline">
          <select name="userid" class="select">
            <option value="0">全部<?php echo ($titles); ?></option>
            <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($userid == $vo['au_id']): ?><option value="<?php echo ($vo["au_id"]); ?>" selected><?php echo ($vo["au_name"]); ?></option>
              <?php else: ?>
                <option value="<?php echo ($vo["au_id"]); ?>"><?php echo ($vo["au_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span> 
        <input type="hidden" name="qishu" value="<?php echo ($qishu1); ?>" />
        <button class="btn btn-success" ><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
      <!--<button name="" id="" class="btn btn-success" type="submit">下载</button>
       <button name="" id="" class="btn btn-success" type="submit"> 打印</button> -->
    </div>
  </form><?php endif; ?>
  <div class="cl pd-5 bg-1 bk-gray mt-20" style="height:20px"></div>
  <div>
 
    <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead>
    <tr class="bg2 tc"> 
    <td width="14%"> <?php echo ($utitle); ?> </td> 
    <td width="14%">类别</td> 
    <td width="14%">笔数</td> 
    <td width="14%">下注金额</td> 
    <!-- <td width="14%">回水</td>  -->
    <td width="14%">中奖</td> 
    <td width="14%">盈亏</td> 
    </tr> </thead> 
    <tbody id="tbody">  
      
    <tr>
        <td width="14%" class="bg6"><?php echo (session('auname')); ?></td>
        <td style="cursor: pointer; color: #FF6600;" width="14%" class="displays">总货合计</td>
        <td width="14%" class="bg3 f14 bold"><?php if($data['sum']): echo ($data['sum']); else: ?>0<?php endif; ?></td>
        <td width="14%" class="f14 bold"><?php if($data['money']): echo ($data['money']); else: ?>0<?php endif; ?></td>
        <!-- <td data-bind="text:Math.ceil(TotalBackComm)"><?php if($win): echo ($win); else: ?>0<?php endif; ?></td> -->
        <td width="14%" class="bg3 f14 bold"><?php if($data['money1']): echo ($data['money1']); else: ?>0<?php endif; ?></td>
        <!--<?php echo ($data['money1']+$data['win']-$data['money']); ?>-->
        <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data['money']): echo intval($data['money']-$data['money1']-$data['win']); else: ?>0<?php endif; ?></td>
        <?php else: ?>
            <td width="14%" class="f14 bold">0</td><?php endif; ?>
        
    </tr>
    <tr class="tables" style="display:none"> 
    <td colspan="6" style="padding:0px;border:0px"> 
    <table class="t-1">
    <tbody class="fn-hover">     
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">二定位</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data['ding23']): echo ($data['ding23']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data['ding21']): echo ($data['ding21']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data['ding24']): echo ($data['ding24']); else: ?>0<?php endif; ?></td> 
    <!--<?php echo ($data['money1']+$data['win']-$data['money']); ?>-->
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data['ding23']): echo intval($data['ding21']-$data['ding24']-$data['ding22']); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口口XX</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[1][2]): echo ($data[1][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[1][0]): echo ($data[1][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[1][3]): echo ($data[1][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[1][0]): echo intval($data[1][0]-$data[1][3]-$data[1][1]); else: ?>0<?php endif; ?></td>  
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
   
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>   
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口X口X</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[2][2]): echo ($data[2][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[2][0]): echo ($data[2][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[2][3]): echo ($data[2][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[2][0]): echo intval($data[2][0]-$data[2][3]-$data[2][1]); else: ?>0<?php endif; ?></td>  
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口XX口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[3][2]): echo ($data[3][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[3][0]): echo ($data[3][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[3][3]): echo ($data[3][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[3][0]): echo intval($data[3][0]-$data[3][3]-$data[3][1]); else: ?>0<?php endif; ?></td>   
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
   
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">X口X口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[4][2]): echo ($data[4][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[4][0]): echo ($data[4][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[4][3]): echo ($data[4][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[4][0]): echo intval($data[4][0]-$data[4][3]-$data[4][1]); else: ?>0<?php endif; ?></td>   
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
     
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">X口口X</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[5][2]): echo ($data[5][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[5][0]): echo ($data[5][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[5][3]): echo ($data[5][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[5][0]): echo intval($data[5][0]-$data[5][3]-$data[5][1]); else: ?>0<?php endif; ?></td>   
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">XX口口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[6][2]): echo ($data[6][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[6][0]): echo ($data[6][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[6][3]): echo ($data[6][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[6][0]): echo intval($data[6][0]-$data[6][3]-$data[6][1]); else: ?>0<?php endif; ?></td>   
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">三定位</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data['ding33']): echo ($data['ding33']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data['ding31']): echo ($data['ding31']); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data['ding34']): echo ($data['ding34']); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data['ding31']): echo intval($data['ding31']-$data['ding34']-$data['ding32']); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
     
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td>
    <td width="14%">口口口X</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[7][2]): echo ($data[7][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[7][0]): echo ($data[7][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[7][3]): echo ($data[7][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[7][0]): echo intval($data[7][0]-$data[7][3]-$data[7][1]); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口口X口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[9][2]): echo ($data[9][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[9][0]): echo ($data[9][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[9][3]): echo ($data[9][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[9][0]): echo intval($data[9][0]-$data[9][3]-$data[9][1]); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">口X口口</td> 
    
    <td width="14%" class="bg3 f14 bold"><?php if($data[8][2]): echo ($data[8][2]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="f14 bold"><?php if($data[8][0]): echo ($data[8][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[8][3]): echo ($data[8][3]); else: ?>0<?php endif; ?></td> 
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[8][0]): echo intval($data[8][0]-$data[8][3]-$data[8][1]); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
     
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    <tr class="bg5"> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">X口口口</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[10][2]): echo ($data[10][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data[10][0]): echo ($data[10][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[10][3]): echo ($data[10][3]); else: ?>0<?php endif; ?></td>
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[10][0]): echo intval($data[10][0]-$data[10][3]-$data[10][1]); else: ?>0<?php endif; ?></td>  
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>  
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">四定位</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[11][2]): echo ($data[11][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data[11][0]): echo ($data[11][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[11][3]): echo ($data[11][3]); else: ?>0<?php endif; ?></td>
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[11][0]): echo intval($data[11][0]-$data[11][3]-$data[11][1]); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  --> 
    </tr>  
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">二字现</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[12][2]): echo ($data[12][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data[12][0]): echo ($data[12][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[12][3]): echo ($data[12][3]); else: ?>0<?php endif; ?></td>
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[12][0]): echo intval($data[12][0]-$data[12][3]-$data[12][1]); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
     </tr> 
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">三字现</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[13][2]): echo ($data[13][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data[13][0]): echo ($data[13][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[13][3]): echo ($data[13][3]); else: ?>0<?php endif; ?></td>
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[13][0]): echo intval($data[13][0]-$data[13][3]-$data[13][1]); else: ?>0<?php endif; ?></td> 
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
    
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr>   
    <tr class=""> 
    <td width="14%" class="bg6"></td> 
    <td width="14%">四字现</td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[14][2]): echo ($data[14][2]); else: ?>0<?php endif; ?></td>
    <td width="14%" class="f14 bold"><?php if($data[14][0]): echo ($data[14][0]); else: ?>0<?php endif; ?></td> 
    <td width="14%" class="bg3 f14 bold"><?php if($data[14][3]): echo ($data[14][3]); else: ?>0<?php endif; ?></td>
    <?php if($opentime == '3'): ?><td width="14%" class="f14 bold"><?php if($data[14][0]): echo intval($data[14][0]-$data[14][3]-$data[14][1]); else: ?>0<?php endif; ?></td>
    <?php else: ?>
        <td width="14%" class="f14 bold">0</td><?php endif; ?>
     
    <!-- <td width="14%" class="bg3 f14 bold">--</td>  -->
    </tr> 
    </tbody> </table> </td> </tr>
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
<!-- <script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layp/Public/ge/1.2/laypage.js"></script> -->
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
</script> 
</body>
</html>