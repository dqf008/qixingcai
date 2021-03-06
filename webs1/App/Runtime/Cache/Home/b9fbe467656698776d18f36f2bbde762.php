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
<title>号码销售统计</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>销售统计<span class="c-gray en">&gt;</span> 号码销售统计 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container" style="margin:30px 5%">
  <div class="text-c">
    期号：
   <span class="select-box inline">
    <select name="qishu1" class="select">
      <?php if(is_array($qishu)): $i = 0; $__LIST__ = $qishu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu1 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
        <?php else: ?>
          <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </span>
    <span class="select-box inline">
    <select name="types" class="select">
      <option value="2" <?php if($type==2){ echo 'selected';}?>>二定</option>
      <option value="3" <?php if($type==3){ echo 'selected';}?>>三定</option>
      <option value="4" <?php if($type==4){ echo 'selected';}?>>四定</option>
    </select>
    </span>
    <?php if($type == '2'): ?><span id="erding">
    <?php else: ?>
      <span id="erding" style="display:none"><?php endif; ?>
    <button class="btn btn-success" onclick="findDatas('91')"><i class="Hui-iconfont"></i> 口口XX</button>
    <button class="btn btn-success" onclick="findDatas('92')"><i class="Hui-iconfont"></i> 口X口X </button>
    <button class="btn btn-success" onclick="findDatas('93')"><i class="Hui-iconfont"></i> 口XX口 </button>
    <button class="btn btn-success" onclick="findDatas('94')"><i class="Hui-iconfont"></i> X口X口 </button>
    <button class="btn btn-success" onclick="findDatas('95')"><i class="Hui-iconfont"></i> X口口X </button>
    <button class="btn btn-success" onclick="findDatas('96')"><i class="Hui-iconfont"></i> XX口口 </button>
    </span>
    <?php if($type == '3'): ?><span id="sanding">
    <?php else: ?>
       <span id="sanding" style="display:none"><?php endif; ?>
   
    <button class="btn btn-success" onclick="findDatas('97')"><i class="Hui-iconfont"></i> 口口口X </button>
    <button class="btn btn-success" onclick="findDatas('98')"><i class="Hui-iconfont"></i> 口口X口 </button>
    <button class="btn btn-success" onclick="findDatas('99')"><i class="Hui-iconfont"></i> 口X口口 </button>
    <button class="btn btn-success" onclick="findDatas('100')"><i class="Hui-iconfont"></i> X口口口 </button>
    
  </span>
   <?php if($type == '4'): ?><span id="siding">
    <?php else: ?>
       <span id="siding" style="display:none"><?php endif; ?>
  
   <!--  <button class="btn btn-success" onclick="findDatas('101')"><i class="Hui-iconfont"></i> 四定位 </button> -->

    <button class="btn btn-success" onclick="findDatas('101')"><i class="Hui-iconfont"></i>0000~0999</button>
    <button class="btn btn-success" onclick="findDatas('102')"><i class="Hui-iconfont"></i> 1000~1999</button>
    <button class="btn btn-success" onclick="findDatas('103')"><i class="Hui-iconfont"></i> 2000~2999</button>
    <button class="btn btn-success" onclick="findDatas('104')"><i class="Hui-iconfont"></i> 3000~3999</button>
    <button class="btn btn-success" onclick="findDatas('105')"><i class="Hui-iconfont"></i> 4000~4999</button>
   <div style="margin-top:10px">
    <button class="btn btn-success" onclick="findDatas('106')"><i class="Hui-iconfont"></i> 5000~5999</button>
    <button class="btn btn-success" onclick="findDatas('107')"><i class="Hui-iconfont"></i> 6000~6999</button>
    <button class="btn btn-success" onclick="findDatas('108')"><i class="Hui-iconfont"></i> 7000~7999</button>
    <button class="btn btn-success" onclick="findDatas('109')"><i class="Hui-iconfont"></i> 8000~8999</button>
    <button class="btn btn-success" onclick="findDatas('110')"><i class="Hui-iconfont"></i> 9000~9999</button>
    </div>
  </span>
  </div>
   <div class="text-c">
    </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20" style="height:20px"><!--  <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加资讯" data-href="article-add.html" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span>  --><!-- <span class="r">共有数据：<strong>54</strong> 条</span> --> 
<?php switch($types): case "91": ?>口口XX<?php break;?>
      <?php case "92": ?>口X口X<?php break;?>
      <?php case "93": ?>口XX口<?php break;?>
      <?php case "94": ?>X口X口<?php break;?>
      <?php case "95": ?>X口口X<?php break;?>
      <?php case "96": ?>XX口口<?php break;?>
      <?php case "97": ?>口口口X<?php break;?>
      <?php case "98": ?>口口X口<?php break;?>
      <?php case "99": ?>口X口口<?php break;?>
      <?php case "100": ?>X口口口<?php break;?>
      <?php case "101": ?>四定位<?php break;?>
      <?php case "102": ?>四定位<?php break;?>
      <?php case "103": ?>四定位<?php break;?>
      <?php case "104": ?>四定位<?php break;?>
      <?php case "105": ?>四定位<?php break;?>
      <?php case "106": ?>四定位<?php break;?>
      <?php case "107": ?>四定位<?php break;?>
      <?php case "108": ?>四定位<?php break;?>
      <?php case "109": ?>四定位<?php break;?>
      <?php case "110": ?>四定位<?php break;?>
      <?php default: ?>口口XX<?php endswitch;?>

  </div>
  <div>

    <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead> 
    <tr class="bg2 tc">  
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 
    <td>---</td> 
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 
    <td>--</td> 

    </tr> </thead> 
    <tbody id="tbody"> 
        <?php echo ($html); ?>
    </tbody>
    </table>
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
<script type="text/javascript">
    $(function(){
      $('select[name="types"]').change(function(){
          if($(this).val()=='2'){
            $('#erding').show();
            $('#sanding').hide();
            $('#siding').hide();
          }else if($(this).val()=='3'){
            $('#erding').hide();
            $('#sanding').show();
            $('#siding').hide();
          }else{
            $('#erding').hide();
            $('#sanding').hide();
            $('#siding').show();
          }
      });
        $('.displays').click(function(){
            var t=$('.tables').css('display');
            if(t=='none'){
                $('.tables').show();
            }else{
                $('.tables').hide();   
            }
          
        });
    });
    function display(e){
      var t=$('.tables'+e).css('display');
       if(t=='none'){
            $('.tables'+e).show();
        }else{
            $('.tables'+e).hide();   
        }
    }
    
    function findDatas(e){
    
      // switch (e) {
      //     case 91:
      //       $('.mt-20').text('口口XX');
      //     break;
      //     case 92:
      //       $('.mt-20').text('口X口X');
      //     //$where['types']='口X口X'; 
      //     break;
      //     case 93:
      //      $('.mt-20').text('口XX口');
      //     //$where['types']='口XX口'; 
      //     break;
      //     case 94:
      //      $('.mt-20').text('X口X口');
      //     //$where['types']='X口X口'; 
      //     break;
      //     case 95:
      //     $('.mt-20').text('X口口X');
      //     //$where['types']='X口口X'; 
      //     break;
      //     case 96:
      //      $('.mt-20').text('XX口口');
      //     //$where['types']='XX口口'; 
      //     break;
      //     default:
      //       $('.mt-20').text('口口XX');
      //     break;
      // }
      var types=$('select[name="types"] option:selected').val();
      var qishu=$('select[name="qishu1"] option:selected').val();
      window.location.href="/Datas/haomaData?type="+types+"&types="+e+'&qishu='+qishu;
    }
</script>  
<style>
  td {
    text-align: left;
}
</style>
</body>
</html>