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
<title>总货明细列表</title>
<style>
.bg3 td, .bg3 {
    background: #F1F5F8;
}
  tbody td.bg4, tbody tr.bg4 td {
    background: #DEDEBC;
    height: 30px;
    padding: 4px;
    color: red;
}
.table td {
    text-align: center;
}
td {
  text-align:center;
   /* border: 1px solid #bababa;
    height: 22px;
    border-width: 0 1px 1px 0;
    padding: 4px;
    outline: none;*/
}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 总货明细 <span class="c-gray en">&gt;</span> 总货明细列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
<form action="/Data/download" method="post">
  <div class="text-c">
  期号：
   <span class="select-box inline">
    <select name="qishu" class="select">
      <!-- <option value="0">全部开奖期号</option> -->
      <?php if(is_array($qishus)): $i = 0; $__LIST__ = $qishus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
        <?php else: ?>
          <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </span>
    <input type="text" name="uname" value="<?php echo ($uname); ?>" placeholder="查账号" style="width:100px" class="input-text">
    <input type="text" name="number" value="<?php echo ($number); ?>" placeholder="查号码" style="width:100px" class="input-text">
    现 <input type="checkbox" name="xian" <?php if(!empty($xian) && $xian==1){echo 'checked';} ?> value="1" />
    <span class="select-box inline">
      <select name="condition" class="select">
        <option value="pl" <?php if($condition=='pl'){echo 'selected';;} ?>>赔率</option>
        <option value="je" <?php if($condition=='je'){echo 'selected';;} ?>>金额</option>
        <option value="tm" <?php if($condition=='tm'){echo 'selected';;} ?>>退码</option>
      </select>
    </span>
    <input type="text" name="start"  value="<?php echo ($start); ?>" placeholder="" style="width:100px" class="input-text"> 至
    <input type="text" name="finish" value="<?php echo ($finish); ?>" placeholder="" style="width:100px" class="input-text">
    &nbsp;&nbsp;分类：
    <span class="select-box inline">
      <select name="category" id="category" class="select"> 
      <option value="0">全部</option>
      <option value="1" <?php if($category==1){ echo 'selected';} ?>>二定位</option>
      <option value="口口XX" <?php if($category=='口口XX'){ echo 'selected';} ?>>口口XX</option>
      <option value="口X口X" <?php if($category=='口X口X'){ echo 'selected';} ?>>口X口X</option>
      <option value="口XX口" <?php if($category=='口XX口'){ echo 'selected';} ?>>口XX口</option>
      <option value="X口X口" <?php if($category=='X口X口'){ echo 'selected';} ?>>X口X口</option>
      <option value="X口口X" <?php if($category=='X口口X'){ echo 'selected';} ?>>X口口X</option>
      <option value="XX口口" <?php if($category=='XX口口'){ echo 'selected';} ?>>XX口口</option>
      <option value="三定位" <?php if($category=='三定位'){ echo 'selected';} ?>>三定位</option>
      <option value="口口口X" <?php if($category=='口口口X'){ echo 'selected';} ?>>口口口X</option>
      <option value="口口X口" <?php if($category=='口口X口'){ echo 'selected';} ?>>口口X口</option>
      <option value="口X口口" <?php if($category=='口X口口'){ echo 'selected';} ?>>口X口口</option>
      <option value="X口口口" <?php if($category=='X口口口'){ echo 'selected';} ?>>X口口口</option>
      <option value="四定位" <?php if($category=='四定位'){ echo 'selected';} ?>>四定位</option>
      <option value="二字现" <?php if($category=='二字现'){ echo 'selected';} ?>>二字现</option>
      <option value="三字现" <?php if($category=='三字现'){ echo 'selected';} ?>>三字现</option>
      <option value="四字现" <?php if($category=='四字现'){ echo 'selected';} ?>>四字现</option>
       <!--  <option value="0">全部分类</option> 
        <option value="20">二定位</option> 
        <option value="1">口口XX</option> 
        <option value="2">口X口X</option> 
        <option value="3">口XX口</option> 
        <option value="4">X口X口</option> 
        <option value="5">X口口X</option> 
        <option value="6">XX口口</option> 
        <option value="30">三定位</option> 
        <option value="7">口口口X</option> 
        <option value="8">口口X口</option> 
        <option value="9">口X口口</option> 
        <option value="10">X口口口</option> 
        <option value="11">四定位</option> 
        <option value="12">二字现</option> 
        <option value="13">三字现</option> 
        <option value="14">四字现</option> 
        <option value="101">快打</option> 
        <option value="102">快选</option>  -->
      </select>
    </span>
    <!-- &nbsp;&nbsp;类型：
    <span class="select-box inline">
      <select name="types" class="select"> 
        <option value="all">全部</option>
        <option value="1"<?php if($types=='1'){echo 'selected';;} ?> >散货</option>
        <option value="2"<?php if($types=='2'){echo 'selected';;} ?> >包牌</option>
      </select>
    </span> -->
    <button class="btn btn-success" type="button" onclick="findData()"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
  <!--   <button class="btn btn-success" type="submit">下载</button> -->
   <!--  <button name="" id="" class="btn btn-success" type="submit"> 打印</button> -->
  </div>
  </form>
  <script>
  function findData(){
    var qishu=$('select[name="qishu"] option:selected').val();
    var uname=$('input[name="uname"]').val();
    var number=$('input[name="number"]').val();
    var xian='';
    $('input[name="xian"]:checked').each(function(){  
      xian=$(this).val();//向数组中添加元素  
    });
    //var xian=$('input[name="xian"]checked').val();
    var condition=$('select[name="condition"] option:selected').val();
    var start=$('input[name="start"]').val();
    var finish=$('input[name="finish"]').val();
    var category=$('select[name="category"] option:selected').val();
    var types=$('select[name="types"] option:selected').val();

    window.location.href="/Data?qishu="+qishu+'&uname='+uname+'&number='+number+'&xian='+xian+'&condition='+condition+'&start='+start+'&finish='+finish+'&category='+category+'&types='+types;
  }
  </script>
   <div class="mt-20">

  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
  <div class="cl pd-5 bg-1 bk-gray mt-20" style="height:20px"></div>
  <div>
    <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="180">注单编号</th>
          <th width="80">会员</th>
          <th width="180">下单时间</th>
          <th width="80">类型</th>
          <th width="80">号码</th>
          <th width="120">下注金额</th>
          <th width="75">赔率</th>
          <th width="60">下线回水</th>
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
      <?php if($data): ?><!--  <tr class="bg4 text-c" title="已退码" >  <td>  283258761131322712  </td> <td class="bg3"> xiaohui </td> <td>  11-24 20:17:56 退 11-24 20:18:00  </td> <td class="bg3 fb">0199</td> <td>20</td> <td class="bg3">8800</td>  <td>--</td>  <td class="bg3">1.6</td> <td>18.4</td>   </tr> -->
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["js"] == '2'): ?><!-- <tr class="text-c"   style="text-decoration:line-through;"> -->
          <tr class="bg4 text-c" title="已退码" >
          <?php else: ?>
          <tr class="text-c"><?php endif; ?>
          <td><?php echo ($vo["did"]); ?></td>
          <td class="bg3"> <?php echo ($vo["username"]); ?></td>
          <?php if($vo["js"] == '2'): ?><td><?php echo (date('m-d H:i:s',$vo["addtime"])); ?> 退 <?php echo (date('Y-m-d H:i:s',$vo["tuima_time"])); ?>  </td>
          <?php else: ?>
             <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td><?php endif; ?>
          <td class="bg3"> <?php echo ($vo["mingxi_1"]); ?></td>
          <td><?php echo ($vo["mingxi_2"]); ?></td>
          <td class="bg3"> <?php echo ($vo["money"]); ?></td>
          <td><?php echo ($vo["odds"]); ?></td>
          <td class="td-status"><?php echo ($vo["win"]); ?></td>
          <td class="bg3">
            <?php if($vo["status"] == '1'): echo ($vo['moneys']); ?>
            <?php else: ?>
              --<?php endif; ?>
          </td>
          <?php if($opentime == '3'): if($vo["status"] == '1'): ?><td><?php echo ($vo['yingkui']); ?></td>
            <?php else: ?>
               <td><?php echo ($vo['money']-$vo['win']); ?></td><?php endif; ?>
          
          <?php else: ?>
            <td>0</td><?php endif; ?>

          <!--<td class="td-status"></td>
          <td class="td-status"></td>
          <td class="td-status"></td>
          <td class="td-status"></td>
           <td class="td-status"></td>
          <td class="td-status"></td>
          <td class="td-status"></td>
          <td class="td-status"></td> -->
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
          <td>合计</td>
          <td colspan="4">笔数(<?php echo ($data1['sum']); ?>)</td>
          <td><?php echo ($data1['money']); ?></td>
          <td>--</td>
          <td><?php echo ($data1['win']); ?></td>
          <td><?php echo ($data1['moneys']); ?></td>
          <?php if($opentime == '3'): ?><td><?php echo ($data1['money']-$data1['moneys']-$data1['win']); ?></td>
          <?php else: ?>
            <td>0</td><?php endif; ?>
          
        </tr>
      <?php else: ?>
        <tr><td  colspan="9" style="text-align: center;">没有数据</td></tr><?php endif; ?>
        
      </tbody>
    </table>
    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">共 <?php echo ($count); ?> 条</div>

    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate" style="margin-bottom:10px">

    <?php echo ($show); ?>
    <?php if($page1 > '1'): ?><input type="text" name="pages" value="" style="width:60px;padding:3px 0px;" /><button style="padding:3px 0px;" id="pages">搜索</button><?php endif; ?>
    </div>
    </div>
  <!--   <table class="table table-border table-bordered table-bg table-hover table-sort"> <thead>  <tr class="tc"> <td rowspan="2" class="bg2" width="150">  日期  </td> <td colspan="3" class="bg-yellow">会员</td>   <td colspan="4" class="bg-orange">  代理  </td>  <td colspan="2" class="bg-pink">  总代理   </td> </tr> <tr class="tc"> <td class="bg-yellow">笔数</td> <td class="bg-yellow">总投</td> <td class="bg-yellow">盈亏</td>   <td class="bg-orange">  占成金额  </td> <td class="bg-orange">  占成盈亏  </td> <td class="bg-deeporg">   赚水   </td> <td class="bg-deeporg">总盈亏</td>  <td class="bg-pink">总投</td> <td class="bg-pink">盈亏</td> </tr> </thead> <tbody class="fn-hover">   <tr> <td> <strong class="blue">[1]</strong>   <a href="#!report?period_no=17084&amp;level=2" class="gray">  <strong class="red">07-21(17084)</strong>  </a>   </td> <td class="bg-yellow">0</td> <td class="bg-yellow">0</td>  <td class="bg-yellow"> 0 </td>  <td class="bg-orange">0</td> <td class="bg-orange">0</td> <td class="bg-deeporg">0</td>   <td class="bg-deeporg">0</td>    <td class="bg-pink">0</td> <td class="bg-pink">0</td>   </tr>  <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  <td class="fb">0</td> <td class="fb">0</td>  <td class="fb">0</td>  <td class="fb">0</td> <td class="fb">0</td> <td class="fb">0</td>   <td class="fb">0</td>    <td class="fb">0</td> <td class="fb">0</td>    </tr>  </tbody>  </table> -->
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
   $('input[name="pages"]').keyup(function(){
      // if($(this).val()=='0'){
      //   $(this).val('');
      // }else{
        $(this).val($(this).val().replace(/[^\d]/g, ""));
      //}

    });
  $('#pages').click(function(){
    var page1=$('input[name="pages"]').val();
    var uname=$('input[name="uname"]').val();
    var number=$('input[name="number"]').val();
    //var number=.val();
    var xian=0;
    xian=$('input[type=checkbox]:checked').val();
    var condition=$('select[name="condition"] option:selected').val();
    var qishu=$('select[name="qishu"] option:selected').val();
    var start=$('input[name="start"]').val();
    var finish=$('input[name="finish"]').val();
    var category=$('select[name="category"] option:selected').val();
    window.location.href="/Data/index?uname="+uname+"&number="+number+"&xian="+xian+"&condition="+condition+"&start="+start+"&finish="+finish+"&category="+category+"&qishu="+qishu+"&p="+page1;
  });



});
// $('.table-sort').dataTable({
//   "aaSorting": [[ 1, "desc" ]],//默认第几个排序
//   "bStateSave": true,//状态保存
//   "aoColumnDefs": [
//     //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//     {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
//   ]
// });

/*资讯-添加*/
function article_add(title,url,w,h){
  var index = layer.open({
    type: 2,
    title: title,
    content: url
  });
  layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
  var index = layer.open({
    type: 2,
    title: title,
    content: url
  });
  layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
  layer.confirm('确认要删除吗？',function(index){
    $.ajax({
      type: 'POST',
      url: '',
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").remove();
        layer.msg('已删除!',{icon:1,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },
    });   
  });
}

/*资讯-审核*/
function article_shenhe(obj,id){
  layer.confirm('审核文章？', {
    btn: ['通过','不通过','取消'], 
    shade: false,
    closeBtn: 0
  },
  function(){
    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
    $(obj).remove();
    layer.msg('已发布', {icon:6,time:1000});
  },
  function(){
    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
    $(obj).remove();
      layer.msg('未通过', {icon:5,time:1000});
  }); 
}
/*资讯-下架*/
function article_stop(obj,id){
  layer.confirm('确认要下架吗？',function(index){
    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
    $(obj).remove();
    layer.msg('已下架!',{icon: 5,time:1000});
  });
}

/*资讯-发布*/
function article_start(obj,id){
  layer.confirm('确认要发布吗？',function(index){
    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
    $(obj).remove();
    layer.msg('已发布!',{icon: 6,time:1000});
  });
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
  $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
  $(obj).parents("tr").find(".td-manage").html("");
  layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

</script> 
</body>
</html>