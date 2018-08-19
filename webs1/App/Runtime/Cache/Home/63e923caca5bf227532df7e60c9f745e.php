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
<title>销售统计</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 销售统计 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="mt-20">

  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
    <div class="text-c">
        <span class="select-box inline">期号：
          <select name="qishu" class="select">
            <?php if(is_array($qishu)): $i = 0; $__LIST__ = $qishu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu1 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
              <?php else: ?>
                <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span> 
        <button class="btn btn-success" onclick="findDatas('1')"><i class="Hui-iconfont">&#xe665;</i> 销售盈亏统计</button>
        <button class="btn btn-success" onclick="findDatas('2')"><i class="Hui-iconfont">&#xe665;</i> 会员结算</button>
        <button class="btn btn-success" onclick="findDatas('3')"><i class="Hui-iconfont">&#xe665;</i> 股东分成结算</button>
       <!--  <button class="btn btn-success" ><i class="Hui-iconfont">&#xe665;</i> 查看会员销量</button> -->
        <button class="btn btn-success" onclick="findDatas('4')"><i class="Hui-iconfont">&#xe665;</i> 查看中奖详情</button>
      <!--<button name="" id="" class="btn btn-success" type="submit">下载</button>
       <button name="" id="" class="btn btn-success" type="submit"> 打印</button> -->
    </div>
  <div class="cl pd-5 bg-1 bk-gray">
  <span class="l">

  <?php echo ($title); ?>
  </span> 

<!--   <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span>  -->
  </div>
  <?php if($type == '1'): ?><table class="table table-border table-bordered table-bg table-hover table-sort">
  <?php else: ?>
    <table class="table table-border table-bordered table-bg table-hover table-sort" style="display:none"><?php endif; ?>
      <thead>
        <tr class="text-c">
         <th>期号</th>
        <th>销售总额</th>
        <th>佣金总额</th>
        <th>中奖总额</th>
        <!-- <th>股东吃码</th>
        <th>股东中奖</th>
        <th>转购总额</th>
        <th>转购中奖</th> -->
        <th>合计盈亏</th>
        </tr>
      </thead>
      <tbody>
      <?php if($data): ?><tr>
        <!-- <td>第<?php echo ($data['qishu']); ?>期</td>
        <td><?php echo ($data['money']); ?></td>
        <td><?php echo ($data['win']); ?></td>
        <td><?php echo ($data['moneys']); ?></td>
        <td><?php echo ($data['yingkui']); ?></td> -->
         <td>第<?php echo ($data['qishu']); ?>期</td>
        <td><?php echo ($data['money']); ?></td>
        <td><?php echo ($data['win']); ?></td>
        <td><?php echo ($data['moneys']); ?></td>
        <td><?php echo ($data['yingkui']); ?></td>
      </tr>
      <?php else: ?>
        <tr><td  colspan="10" style="text-align: center;">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>
<?php if($type == '2'): ?><table class="table table-border table-bordered table-bg table-hover table-sort">
  <?php else: ?>
    <table class="table table-border table-bordered table-bg table-hover table-sort" style="display:none"><?php endif; ?>
      <thead>
        <tr class="text-c">
         
    <th background="Images/TitleBar.png" bgcolor="#FFFFFF" class="TitleColor">会员</th>
    <th background="Images/TitleBar.png" bgcolor="#FFFFFF" class="TitleColor">直码</th>
    <th background="Images/TitleBar.png" class="TitleColor">两同</th>
    <th background="Images/TitleBar.png" class="TitleColor">三同</th>
    <th background="Images/TitleBar.png" class="TitleColor">四同</th>
    <th background="Images/TitleBar.png" class="TitleColor">两定</th>
    <th background="Images/TitleBar.png" class="TitleColor">三定</th>
    <th background="Images/TitleBar.png" class="TitleColor">合计</th>
    <th background="Images/TitleBar.png" class="TitleColor">佣金</th>
    <th background="Images/TitleBar.png" class="TitleColor">中奖</th>
<!--     <th background="Images/TitleBar.png" class="TitleColor">支付</th>
    <th background="Images/TitleBar.png" bgcolor="#FFFFFF" class="TitleColor">充值</th> -->
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["uname"] != ''): ?><tr bgcolor="#FFFFFF" onmouseover="this.bgColor='#F8E8C6'" onmouseout="this.bgColor='#FFFFFF'">
        <td><?php echo ($vo["uname"]); ?></td>
        <td><?php echo ($vo["ding4"]); ?></td>
        <td><?php echo ($vo["dingxian2"]); ?></td>
        <td><?php echo ($vo["dingxian3"]); ?></td>
        <td><?php echo ($vo["dingxian4"]); ?></td>
        <td><?php echo ($vo["ding2"]); ?></td>
        <td><?php echo ($vo["ding3"]); ?></td>
        <td><?php echo ($vo["money"]); ?></td>
        <td><?php echo ($vo["win"]); ?></td>
        <td><?php echo ($vo["moneys"]); ?></td>
        <!-- <td>0.00</td>
        <td></td> -->
        </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
         <tr >
        <td>(合计)</td>
        <td><?php echo ($data1['ding4']); ?></td>
        <td><?php echo ($data1['dingxian2']); ?></td>
        <td><?php echo ($data1['dingxian3']); ?></td>
        <td><?php echo ($data1['dingxian4']); ?></td>
        <td><?php echo ($data1['ding2']); ?></td>
        <td><?php echo ($data1['ding3']); ?></td>
        <td><?php echo ($data1['money']); ?></td>
        <td><?php echo ($data1['win']); ?></td>
        <td><?php echo ($data1['moneys']); ?></td>
       <!--  <td>0.00</td>
        <td></td> -->
        </tr>
      <?php else: ?>
        <tr><td colspan="10">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>


<?php if($type == '3'): ?><table class="table table-border table-bordered table-bg table-hover table-sort">
  <?php else: ?>
    <table class="table table-border table-bordered table-bg table-hover table-sort" style="display:none"><?php endif; ?>
      <thead>
        <tr class="text-c">
           <td  background="Images/TitleBar.png" bgcolor="#FFFFFF" class="TitleColor">股东</td>
    <td background="Images/TitleBar.png" bgcolor="#FFFFFF" class="TitleColor">吃码数量</td>
    <td bgcolor="#FFFFFF" background="Images/TitleBar.png" class="TitleColor">吃码金额</td>
    <td bgcolor="#FFFFFF" background="Images/TitleBar.png" class="TitleColor">中奖金额</td>
    <td bgcolor="#FFFFFF" background="Images/TitleBar.png" class="TitleColor">盈亏</td>
        </tr>
      </thead>
      <tbody>
      <?php if($data1): if(is_array($data1)): $i = 0; $__LIST__ = $data1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr bgcolor="#FFFFFF" onmouseover="this.bgColor='#F8E8C6'" onmouseout="this.bgColor='#FFFFFF'">
        <td ><?php echo ($vo["au_name"]); ?></td>
        <td><?php echo ($vo["sum"]); ?></td>
        <td><?php echo ($vo["money"]); ?></td>
        <td><?php echo ($vo["moneys"]); ?></td>
        <td><?php echo ($vo["yingkui"]); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         <tr >
        <td>(合计)</td>
        <td><?php echo ($data['sum']); ?></td>
        <td><?php echo ($data['money']); ?></td>
        <td><?php echo ($data['moneys']); ?></td>
        <td><?php echo ($data['yingkui']); ?></td>
        </tr>
      <?php else: ?>
        <tr><td colspan="5">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>


<?php if($type == '4'): ?><table class="table table-border table-bordered table-bg table-hover table-sort">
  <?php else: ?>
    <table class="table table-border table-bordered table-bg table-hover table-sort" style="display:none"><?php endif; ?>
      <thead>
        <tr class="text-c">
          <th width="180">注单编号</th>
          <th width="80">会员</th>
          <th width="180">下单时间</th>
          <th width="80">类型</th>
          <th width="80">号码</th>
          <th width="120">下注金额</th>
          <th width="75">赔率</th>
          <th width="60">中奖</th>
          <th width="60">亏盈</th>
          <!--<th width="60">下线回水</th>
          <th width="60">实收下线</th>
          <th width="60">自己回水</th>    
          <th width="60">实付上线</th>
          <th width="60">赚水</th>
           <th width="60">包牌</th>
          <th width="60">路径</th>
          <th width="120">IP</th> -->
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo["did"]); ?></td> 
          <td><?php echo ($vo["username"]); ?></td> 
          <td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td> 
          <td><?php echo ($vo["mingxi_1"]); ?></td> 
          <td><?php echo ($vo["mingxi_2"]); ?></td> 
          <td><?php echo ($vo["money"]); ?></td> 
          <td><?php echo ($vo["odds"]); ?></td> 
          <td><?php echo ($vo['moneys']); ?></td> 
          <td><?php echo ($vo['yingkui']); ?></td> 
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        
        <tr>
        <td >(合计)</td>
        <td colspan="4">(笔数)<?php echo ($data1['sum']); ?></td>
        <td><?php echo ($data1['money']); ?></td>
        <td>--</td>
        <td><?php echo ($data1['moneys']); ?></td>
        
        <td><?php echo ($data1['yingkui']); ?></td>
        </tr>
      <?php else: ?>
      <tr><td colspan="9" style="text-align: center;">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>




  </div>
</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<!-- <script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>  -->
<!-- <script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layp/Public/ge/1.2/laypage.js"></script> -->
<script type="text/javascript">
function findDatas(e){
  var qishu=$('select[name="qishu"] option:selected').val();
  //alert(qishu);
  window.location.href="/Index/statistics?type="+e+'&qishu='+qishu;
}

</script> 

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
    z-index: 29891015;
}
.table th {
    text-align: center;
}
.table td {
    text-align: center;
}
</style>
</body>
</html>