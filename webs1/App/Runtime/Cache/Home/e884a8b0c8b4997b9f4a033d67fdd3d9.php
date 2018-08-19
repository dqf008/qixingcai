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
<title>赚水设置列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 报表 <span class="c-gray en">&gt;</span> 赚水设置列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="mt-20">

  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

  <div class="cl pd-5 bg-1 bk-gray">
  <span class="l">
  <?php if(($_SESSION['autype']!= 'agency') AND ($_SESSION['autype']!= 'admin')): ?><a href="javascript:void(0);" onclick="admin_role_add('添加赚水','/Data/addBackwater','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont"></i>添加赚水</a> &nbsp;<?php endif; ?>
  </span>
  <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> 
  </div>
  
  <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="80">ID</th>
          <th width="80">期数</th>
          <th width="80">用户</th>
          <th width="80">赚水</th>
          <th width="60">创建时间</th>
          <th width="60">操作</th>
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
          <td><?php echo ($vo["id"]); ?></td>
           <td><?php echo ($vo["qishu"]); ?></td>
          <td><?php echo ($vo["au_name"]); ?></td>
          <td><?php echo ($vo["sums"]); ?></td>
          <td><?php echo (date('Y-m-d H:i:s',$vo["time"])); ?></td>
          <td>
            <a title="编辑" href="javascript:void(0)" onclick="admin_role_add('编辑','/Data/addBackwater?mid=<?php echo ($vo["id"]); ?>','1')" style="text-decoration:none" class="ml-5"><i class="Hui-iconfont"></i></a> 
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
        <tr><td  colspan="6" style="text-align: center;">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>
    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">共 <?php echo ($count); ?> 条</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><?php echo ($show); ?></div>
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
/*-删除*/
function article_del(obj,id){
  var obj = document.getElementsByName("userid");
  var check_val = [];
  var uid = '';
  for(k in obj){
      if(obj[k].checked)
        // check_val.push(obj[k].value);
        uid+=obj[k].value+',';
  }
  //var uid=check_val;
  //alert(uid);
  if(uid.length==''){
    alert('请选择账号');
    return false;
  }else{
    layer.confirm('确认要删除吗？',function(index){
        var urls='/User/delsUser';
        //alert(id)
        $.ajax({
            type: 'POST',
            url: urls,
            data:{
            'uid':uid,
            'status':1,
            },
            dataType: 'json',
            success: function(data){
               if(data.code==200){
                    $(".notic").html('删除成功！');
                    $(".notic").fadeIn().delay(1000).fadeOut(); 
                }else{
                  $(".notic").html('删除失败！');
                  $(".notic").fadeIn().delay(1000).fadeOut(); 
                }
                  setTimeout('window.location.href="/User/index";',3000);
                // $(obj).parents("tr").remove();
                // layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });     
    });
  }
}

function admin_role_add(title,url,w,h){

  layer_show(title,url,500,300);

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
</style>
</body>
</html>