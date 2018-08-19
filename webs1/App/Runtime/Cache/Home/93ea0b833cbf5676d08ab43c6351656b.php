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
<title>通知公告</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 通知公告 <span class="c-gray en">&gt;</span> 通知公告列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="mt-20">

  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

      <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="80">类型</th>
          <th width="80">标题</th>
          <th width="80">内容</th>
          <th width="60">创建时间</th>
          <th width="60">状态</th>
          <th width="60">操作</th>
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
          <td>
          <?php if($vo["n_type"] == 2): ?>导航滚动信息
          <?php else: ?>
            底部窗口信息<?php endif; ?>
          </td>
          <td><?php echo ($vo["n_title"]); ?></td>
          <td><?php echo ($vo["n_content"]); ?></td>
          <td><?php echo (date("Y-m-d",$vo["n_time"])); ?></td>
          <td class="td-status">
              <?php if($vo["n_status"] == '1'): ?><span class="label label-success radius">启用</span>
              <?php elseif($vo["n_status"] == '2'): ?>
                <span class="label label-success radius">停用</span><?php endif; ?>
          </td> 
           <td class="f-14 td-manage">
            <?php if($vo["n_status"] == '2'): ?><a style="text-decoration:none" onclick="member_start(this,'<?php echo ($vo["n_id"]); ?>')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>
            <?php elseif($vo["n_status"] == '1'): ?>
              <a style="text-decoration:none" onclick="member_starts(this,'<?php echo ($vo["n_id"]); ?>')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont"></i></a><?php endif; ?>
           <a style="text-decoration:none" class="ml-5" onclick="admin_role_add('编辑操作','/Index/addNews?nid=<?php echo ($vo["n_id"]); ?>','700','400')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
           <!-- <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'<?php echo ($vo["au_id"]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a> -->
           </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
        <tr><td  colspan="6" style="text-align: center;">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>


  <!--   <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">共 <?php echo ($count); ?> 条</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><?php echo ($show); ?></div> -->
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
// function article_del(obj,id){
//     layer.confirm('确认要删除吗？',function(index){
//         var urls='/User/delsUser';
//         //alert(id)
//         $.ajax({
//             type: 'POST',
//             url: urls,
//             data:{
//             'id':id,
//             'status':1,
//             },
//             dataType: 'json',
//             success: function(data){
//                 $(obj).parents("tr").remove();
//                 layer.msg('已删除!',{icon:1,time:1000});
//             },
//             error:function(data) {
//                 console.log(data.msg);
//             },
//         });     
//     });
// }
/*用户-启用*/

function member_start(obj,id){
  layer.confirm('确认要启用吗？',function(index){
    var urls='/Index/auditUser';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'nid':id,
        'status':1,

      },
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onclick="member_starts(this,'+id+')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont"></i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">启用</span>');
        $(obj).remove();
        layer.msg('启用!',{icon: 6,time:1000});

      },
      error:function(data) {
        console.log(data.msg);

      },

    });

  });

}

/*用户-启用*/

function member_starts(obj,id){
  layer.confirm('确认要停用吗？',function(index){
    var urls='/Index/auditUser';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'nid':id,
        'status':2,
      },
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onclick="member_start(this,'+id+')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>');
        
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">停用</span>');
        $(obj).remove();
        layer.msg('停用!',{icon: 6,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },

    });

  });

}
function admin_role_add(title,url,w,h){

  layer_show(title,url,w,h);

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