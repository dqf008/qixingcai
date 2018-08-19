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
<title>下级管理列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 下级管理 <span class="c-gray en">&gt;</span> 下级管理列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="mt-20">

  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

  <div class="cl pd-5 bg-1 bk-gray">
  <span class="l">
  <?php if($utype == 'admin'): ?><a href="javascript:void(0);" onclick="admin_role_add('添加<?php echo ($utype1); ?>','/User/addUser','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont"></i> 添加<?php echo ($utype1); ?></a> &nbsp;<a href="javascript:void(0);" onclick="article_del()" class="btn btn-primary radius"><i class="Hui-iconfont"></i>批量删除<?php echo ($utype1); ?></a>
  <?php elseif($utype): ?>
    <a href="javascript:void(0);" onclick="admin_role_add('添加<?php echo ($utype1); ?>','/User/addUser','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont"></i> 添加<?php echo ($utype1); ?></a> &nbsp;
    <!-- <a href="javascript:void(0);" onclick="article_del()" class="btn btn-primary radius"><i class="Hui-iconfont"></i>批量删除<?php echo ($utype1); ?></a> -->
    <a class="btn btn-primary radius" title="批量添加信用积分" href="javascript:void(0);" onclick="dataAudit()" style="text-decoration:none"><i class="Hui-iconfont"></i> 批量添加信用积分</a>&nbsp;<a class="btn btn-primary radius" title="积分批量清零" href="javascript:void(0);" onclick="dataAudit1()" style="text-decoration:none"><i class="Hui-iconfont"></i> 积分批量清零</a><?php endif; ?>

  </span> 
  <?php if(($utype == 'agencys') OR ($utype == 'agency') ): ?>&nbsp;&nbsp;总信用额度：<?php echo ($user['au_money']-0); ?>；     可分配信用额度：<?php echo ($user['au_money']-$user['au_moneys']-0); ?>；     已分配信用额度：<?php echo ($user['au_moneys']-0); ?>；<?php endif; ?>
  <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> 
  </div>
  
  <?php if($user['au_type'] != 'agency'): ?><table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
        <?php if($utype): ?><th width="25"><input type="checkbox" name="" value=""></th><?php endif; ?>
          <th width="80">名称</th>
          <th width="80">用户类型</th>
          <?php if($user['au_type'] != 'admin'): ?><th width="80">可用信用额度</th><?php endif; ?>
          <?php if($utype == 'admin'): ?><th width="60">占成</th><?php endif; ?>
          <?php if($utype == 'agencys'): ?><th width="60">拦货占成</th><?php endif; ?>
          <th width="120">联系电话</th>
          <th width="60">创建时间</th>
          <?php if($user['au_type'] != 'agency'): ?><th width="60">下级</th><?php endif; ?>
          <th width="60">状态</th>
          <?php if($utype): ?><th width="120">操作</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <?php if($utype): ?><td><input type="checkbox" value="<?php echo ($vo["au_id"]); ?>" name="userid"></td><?php endif; ?>
          <td><a href="javascript:void(0);" onclick="getUser('<?php echo ($vo['au_id']); ?>')" class="btn btn-primary radius"><?php echo ($vo["au_name"]); ?></a></td>
           <td>
          <?php if($vo["au_type"] == 'partner'): ?>股东
          <?php elseif($vo["au_type"] == 'agencys'): ?>
            总代理
          <?php elseif($vo["au_type"] == 'agency'): ?>
            代理
          <?php else: ?>
            会员<?php endif; ?>
        
          </td>
          <?php if($user['au_type'] != 'admin'): ?><td><?php echo ($vo['au_money']-$vo['au_moneys']); ?></td><?php endif; ?>
          <?php if($utype == 'admin'): ?><td><?php echo ($vo['au_proportion']); ?>%</td><?php endif; ?>
          <?php if($utype == 'agency'): ?><td width="60">
            <a class="btn btn-primary radius" title="占成配置" href="javascript:void(0);" onclick="addConfig('<?php echo ($vo['au_id']); ?>')">占成配置</a>
            </td>
          <?php elseif($utype == 'agencys'): ?>
              <td><?php echo ($vo['au_proportion']); ?>%</td><?php endif; ?>
          <td><?php echo ($vo["au_phone"]); ?></td>
          <td><?php echo ($vo["au_time"]); ?></td>
          <?php if($user['au_type'] != 'agency'): ?><td><?php echo ($vo["au_sum"]); ?></td><?php endif; ?>
          <td class="td-status">
              <?php if($vo["au_status"] == '1'): ?><span class="label label-success radius">启用</span>
              <?php elseif($vo["au_status"] == '2'): ?>
                <span class="label label-success radius">停用</span><?php endif; ?>
          </td> 
          <?php if($utype): ?><td class="f-14 td-manage">
            <?php if($vo["au_status"] == '2'): ?><a style="text-decoration:none" onclick="member_start(this,'<?php echo ($vo["au_id"]); ?>')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>
            <?php elseif($vo["au_status"] == '1'): ?>
              <a style="text-decoration:none" onclick="member_starts(this,'<?php echo ($vo["au_id"]); ?>')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont"></i></a><?php endif; ?>
           <a style="text-decoration:none" class="ml-5" onclick="admin_role_add('编辑操作','/User/addUser?uid=<?php echo ($vo["au_id"]); ?>','800','500')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
           <!-- <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'<?php echo ($vo["au_id"]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a> -->
           </td><?php endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
        <tr><td  colspan="10" style="text-align: center;">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table>
    <?php else: ?>
      <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="80">名称</th>
          <th width="80">用户类型</th>
          <th width="80">可用信用额度</th>
          <th width="120">联系电话</th>
          <th width="60">创建时间</th>
          <th width="60">状态</th>
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
          <td><?php echo ($vo["username"]); ?></td>
           <td>会员</td>
          <td><?php echo ($vo["money"]); ?></td>
          <td><?php echo ($vo["mobile"]); ?></td>
          <td><?php echo ($vo["reg_date"]); ?></td>
          <td class="td-status">
              <?php if($vo["status"] == '1'): ?><span class="label label-success radius">启用</span>
              <?php elseif($vo["status"] == '2'): ?>
                <span class="label label-success radius">停用</span><?php endif; ?>
          </td> 
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
        <tr><td  colspan="6" style="text-align: center;">没有数据</td></tr><?php endif; ?>
      </tbody>
    </table><?php endif; ?>
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
// $('.table-sort').dataTable({
//   "aaSorting": [[ 1, "desc" ]],//默认第几个排序
//   "bStateSave": true,//状态保存
//   "aoColumnDefs": [
//     //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//     {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
//   ]
// });
function addConfig(uid){
  // var obj = document.getElementsByName("userid");
  // var check_val = [];
  // var uid = '';
  // for(k in obj){
  //     if(obj[k].checked)
  //       // check_val.push(obj[k].value);
  //       uid+=obj[k].value+',';
  // }
  // //var uid=check_val;
  if(uid.length==''){
    alert('参数错误！');
    return false;
  }else{
    var title='代理添加分成拦货配置';
    var url='/User/addConfig?uid='+uid;
    var w=800;
    var h=500;
     layer_show(title,url,w,h);
  }
  
}
function getUser(e){
  if(e.length!=''){
    window.location.href="/User/index?uid="+e;
  }
}
function dataAudit(){
  var obj = document.getElementsByName("userid");
  var check_val = [];
  var uid = '';
  for(k in obj){
      if(obj[k].checked)
        // check_val.push(obj[k].value);
        uid+=obj[k].value+',';
  }
  //var uid=check_val;
  if(uid.length==''){
    alert('请选择你要添加信用积分账号');
    return false;
  }else{
    var title='添加信用积分';
    var url='/User/addMoenys?uid='+uid;
    var w=800;
    var h=500;
     layer_show(title,url,w,300);
  }
  
}
function dataAudit1(){
  var obj = document.getElementsByName("userid");
  var check_val = [];
  var uid = '';
  for(k in obj){
      if(obj[k].checked)
        // check_val.push(obj[k].value);
        uid+=obj[k].value+',';
  }
  //var uid=check_val;
  if(uid.length==''){
    alert('请选择你要清零信用积分账号');
    return false;
  }else{
    // var title='清零信用积分';
    // var url='/User/addMoenys1?uid='+uid;
    // var w=800;
    // var h=500;
    //  layer_show(title,url,w,h);
    layer.confirm('确认要清零信用积分吗？',function(index){
        var urls='/User/delsMoenys';
        //alert(id)
        $.ajax({
            type: 'POST',
            url: urls,
            data:{
            'uid':uid,
            },
            dataType: 'json',
            success: function(data){
                if(data.code==true){
                  $(".notic").html(data.titles);
                  $(".notic").fadeIn().delay(1000).fadeOut(); 
                }else{
                  $(".notic").html(data.titles);
                  $(".notic").fadeIn().delay(1000).fadeOut();     
                }
                //location.replace(location.href);
                setTimeout('location.replace(location.href)',3000);
            },
            error:function(data) {
                console.log(data.msg);
            },
        });     
    });
  }
  
}
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
/*用户-启用*/

function member_start(obj,id){

  layer.confirm('确认要启用吗？',function(index){
    var urls='/User/auditUser';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':id,
        'status':1,

      },
      dataType: 'json',
      success: function(data){
        //$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_starts(this,'+id+')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont"></i></a>');
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
    var urls='/User/auditUser';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':id,
        'status':2,
      },
      dataType: 'json',
      success: function(data){
         //$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>');
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


/*资讯-添加*/
// function article_add(title,url,w,h){
//   var index = layer.open({
//     type: 2,
//     title: title,
//     content: url
//   });
//   layer.full(index);
// }
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
// function article_del(obj,id){
//   layer.confirm('确认要删除吗？',function(index){
//     $.ajax({
//       type: 'POST',
//       url: '',
//       dataType: 'json',
//       success: function(data){
//         $(obj).parents("tr").remove();
//         layer.msg('已删除!',{icon:1,time:1000});
//       },
//       error:function(data) {
//         console.log(data.msg);
//       },
//     });   
//   });
// }

// /*资讯-审核*/
// function article_shenhe(obj,id){
//   layer.confirm('审核文章？', {
//     btn: ['通过','不通过','取消'], 
//     shade: false,
//     closeBtn: 0
//   },
//   function(){
//     $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
//     $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
//     $(obj).remove();
//     layer.msg('已发布', {icon:6,time:1000});
//   },
//   function(){
//     $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
//     $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
//     $(obj).remove();
//       layer.msg('未通过', {icon:5,time:1000});
//   }); 
// }
// /*资讯-下架*/
// function article_stop(obj,id){
//   layer.confirm('确认要下架吗？',function(index){
//     $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
//     $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
//     $(obj).remove();
//     layer.msg('已下架!',{icon: 5,time:1000});
//   });
// }

// /*资讯-发布*/
// function article_start(obj,id){
//   layer.confirm('确认要发布吗？',function(index){
//     $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
//     $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
//     $(obj).remove();
//     layer.msg('已发布!',{icon: 6,time:1000});
//   });
// }
// /*资讯-申请上线*/
// function article_shenqing(obj,id){
//   $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
//   $(obj).parents("tr").find(".td-manage").html("");
//   layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
// }

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