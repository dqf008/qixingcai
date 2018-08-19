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
 <div class="mt-20">

  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
<div class="page-container">
<!--   <div class="cl pd-5 bg-1 bk-gray mt-20">
  <span class="l">
  <a href="javascript:void(0);" onclick="admin_role_add('添加下级','/User/addUser1','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont"></i> 添加下级</a>&nbsp;
  <a class="btn btn-primary radius" title="批量添加信用积分" href="javascript:void(0);" onclick="dataAudit()" style="text-decoration:none"><i class="Hui-iconfont"></i> 批量添加信用积分</a>&nbsp;<a class="btn btn-primary radius" title="积分批量清零" href="javascript:void(0);" onclick="dataAudit1()" style="text-decoration:none"><i class="Hui-iconfont"></i> 积分批量清零</a>&nbsp;</span> &nbsp;&nbsp;总信用额度：<?php echo ($user['au_money']); ?>；     可分配信用额度：<?php echo ($user['au_money']-$user['au_moneys']); ?>；     已分配信用额度：<?php echo ($user['au_moneys']); ?>； <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> 
  </div> -->
  <div>
    <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="80">名称</th>
          <th width="80">用户类型</th>
          
          <th width="80">可用信用额度</th>
          <th width="120">联系电话</th>
          <th width="60">创建时间</th>
          <!-- <th width="80">赔率配置</th> -->
          <?php if($_SESSION['autype']== 'admin'): ?><th width="60">锁定状态</th><?php endif; ?>
          <th width="60">状态</th>
          <th width="80">查看报表</th>
          <?php if($_SESSION['autype']== 'agency'): ?><th width="120">操作</th>
          <?php elseif($_SESSION['autype']== 'admin'): ?>
            <th width="120">操作</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
          <td><a href="javascript:void(0);" onclick="getData('<?php echo ($vo['username']); ?>')" class="btn btn-primary radius"><?php echo ($vo["username"]); ?></a></td>
          <td>会员</td>
          <td><?php echo ($vo['money']-0); ?></td>
          <td><?php echo ($vo["mobile"]); ?></td>
          <td><?php echo (date('Y-m-d H:i:s',$vo["utime"])); ?></td>

          <?php if($_SESSION['autype']== 'admin'): ?><td class="td-status1">
            <?php if($vo["lock"] == '1'): ?><span class="label label-success radius">启用</span>
            <?php elseif($vo["lock"] == '2'): ?>
              <span class="label label-success radius">锁定</span><?php endif; ?>
          </td><?php endif; ?>
          <td class="td-status">
              <?php if($vo["status"] == '1'): ?><span class="label label-success radius">启用</span>
              <?php elseif($vo["status"] == '2'): ?>
                <span class="label label-success radius">停用</span><?php endif; ?>
          <!-- {$vo.if_shenhe} -->
          </td> 
          <td><a href="javascript:void(0);" onclick="getDatas('<?php echo ($vo['uid']); ?>')" class="btn btn-primary radius">月报表</a></td>
          <?php if($_SESSION['autype']== 'agency'): ?><td class="f-14 td-manage">
            <?php if($vo["status"] == '2'): ?><a style="text-decoration:none" onclick="member_start(this,'<?php echo ($vo["uid"]); ?>')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>
            <?php elseif($vo["status"] == '1'): ?>
              <a style="text-decoration:none" onclick="member_starts(this,'<?php echo ($vo["uid"]); ?>')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont"></i></a><?php endif; ?>
           <a style="text-decoration:none" class="ml-5" onclick="admin_role_add('编辑用户','/User/addUser1?uid=<?php echo ($vo["uid"]); ?>','800','500')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
          </td>
          <?php elseif($_SESSION['autype']== 'admin'): ?>
            <td class="f-14 td-manage">
            <?php if($vo["lock"] == '2'): ?><a style="text-decoration:none" onclick="member_start1(this,'<?php echo ($vo["uid"]); ?>')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>
            <?php elseif($vo["lock"] == '1'): ?>
              <a style="text-decoration:none" onclick="member_starts1(this,'<?php echo ($vo["uid"]); ?>')" href="javascript:void(0);" title="锁定"><i class="Hui-iconfont"></i></a><?php endif; ?>
            </td><?php endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
        <tr><td colspan="9" style="text-align: center;">没有数据</td></tr><?php endif; ?>
       <!--  <tr class="text-c">
          <td><input type="checkbox" value="" name=""></td>
          <td>10002</td>
          <td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看">资讯标题</u></td>
          <td>行业动态</td>
          <td>H-ui</td>
          <td>2014-6-11 11:11:42</td>
          <td>21212</td>
          <td class="td-status"><span class="label label-success radius">草稿</span></td>
          <td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this,'10001')" href="javascript:;" title="审核">审核</a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
        </tr> -->
      </tbody>
    </table>
    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">共 <?php echo ($count); ?> 条</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><?php echo ($show); ?></div>
 
  </div>
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
<script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
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
function getData(e){
  if(e.length!=''){
    window.location.href="/Data/index?uname="+e;
  }
}
function getDatas(e){
  if(e.length!=''){
    window.location.href="/Datas/monthDatas?uid="+e;
    
  }
}
function dataAudit(){
  var obj = document.getElementsByName("userid");
  //var check_val = [];
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
    var url='/User/addMoenys1?uid='+uid;
    var w=800;
    var h=300;
     layer_show(title,url,w,h);
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
        var urls='/User/delsMoenys1';
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
    layer.confirm('确认要删除吗？',function(index){
        var urls='/User/delsUser1';
        //alert(id)
        $.ajax({
            type: 'POST',
            url: urls,
            data:{
            'id':id,
            'status':1,
            },
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
/*用户-启用*/

function member_start(obj,id){

  layer.confirm('确认要启用吗？',function(index){
    var urls='/User/auditUser1';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':id,
        'status':1,
      },
      dataType: 'json',
      success: function(data){

        // $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,'+id+')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');

        // $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">启用</span>');

        // $(obj).remove();
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
    var urls='/User/auditUser1';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':id,
        'status':2,
      },
      dataType: 'json',
      success: function(data){
        // $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,'+id+')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
        // $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">停用</span>');
        // $(obj).remove();
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


//锁定
function member_start1(obj,id){
  layer.confirm('确认要启用吗？',function(index){
    var urls='/User/lockUser1';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':id,
        'status':1,
      },
      dataType: 'json',
      success: function(data){
         $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onclick="member_starts(this,'+id+')" href="javascript:void(0);" title="停用"><i class="Hui-iconfont"></i></a>');
        $(obj).parents("tr").find(".td-status1").html('<span class="label label-success radius">启用</span>');
        $(obj).remove();
        layer.msg('启用!',{icon: 6,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },
    });
  });
}

function member_starts1(obj,id){
  layer.confirm('确认要锁定吗？',function(index){
    var urls='/User/lockUser1';
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        'inID':id,
        'status':2,
      },
      dataType: 'json',
      success: function(data){
         $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onclick="member_start(this,'+id+')" href="javascript:void(0);" title="启用"><i class="Hui-iconfont"></i></a>');
        $(obj).parents("tr").find(".td-status1").html('<span class="label label-success radius">锁定</span>');
        $(obj).remove();
        layer.msg('锁定!',{icon: 6,time:1000});
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