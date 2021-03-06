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
<title>规则说明</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 规则说明 <span class="c-gray en">&gt;</span> 规则说明 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

  <div>
   
    <table class="table table-border table-bordered table-bg table-hover table-sort"><thead> <tr class="bg1"> <td>规则说明</td> </tr> </thead> <tbody> <tr> <td> <div class="bd"> <h1 class="f16">本站销售<span class="pink">七星彩</span>电脑体育彩票游戏规则</h1> <h3>第一章 总 则</h3> <p>第一条 根据财政部《彩票发行与销售管理暂行规定》和国家体育总局《体育彩票发行与销售管理暂行办法》以及《计算机销售体育彩票管理暂行办法》，制定本游戏规则。</p> <p>第二条 本站彩票实行自愿购买,量力而行；凡下注者即被视为同意并遵守本规则。</p> <h3>第二章 游戏方法</h3> <p>第三条 “七位数”的每注彩票由0000000-9999999中的任意7位自然数排列而成。 <strong class="pink">本站取前面4位做为游戏规则！</strong></p> <h2>假设下列为开奖结果:</h2> <table class="rule-ball"> <tbody><tr> <td width="14%">仟</td> <td width="14%">佰</td> <td width="14%">拾</td> <td width="14%">个</td> <td width="14%">球5</td> <td width="14%">球6</td> <td width="14%">球7</td> </tr> <tr class="fb pink f16"> <td>1</td> <td>2</td> <td>3</td> <td>4</td> <td>5</td> <td>6</td> <td>7</td> </tr> </tbody></table> <h3> 依照开奖结果，中奖范例如下： </h3> <h3> 四字定中奖： </h3> <h2> 1234 </h2> <h3> 二字定中奖： </h3> <h2> 12xx； 1x3x； 1xx4； x23x； x2x4； xx34 </h2> <h3> 三字定中奖： </h3> <h2> 123x； 12x4； 1x34； x234 </h2> <h3> 二字现中奖： </h3> <h2> 12；13；14；23；24；34 </h2> <h3> 三字现中奖： </h3> <h2> 123；124；134；234 </h2> <h3> 四字现中奖： </h3> <h2> 1234 现； </h2> <h3> 第三章 开奖及公告 </h3> <p> 第四条 “ <span class="pink">七星彩</span>”每周开奖三次 ，摇奖过程在公证人员监督下进行，通过电视台播出。 </p> <p> 第五条 每期开奖后，以国家体育总局体育彩票管理中心公布的开奖号码为准。 </p> <h3> 第四章 附 则 </h3> <p> 第六条 本游戏规则最终解释权归本公司。 </p> </div> </td> </tr> </tbody> </table>
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
$('.table-sort').dataTable({
  "aaSorting": [[ 1, "desc" ]],//默认第几个排序
  "bStateSave": true,//状态保存
  "aoColumnDefs": [
    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
  ]
});

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