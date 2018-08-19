<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>风控导出</title>
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
.jequote1 {
   /* max-width: 100%;
    margin:10px 100px;
    padding: 15px;*/
  /*  line-height: 22px;*/
  margin:10px 200px;
    border: 4px solid #00A080;
    border-radius: 4px;
    background-color: #f5f5f5;
    font-size: 15px;
}
</style>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>风控导出 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container text-c">
<div class="text-c" style="width:100%">
<div class="jequote1" style="text-align: center;">
        <p style="text-align: center;font-size:24px;padding-bottom: 15px;">须知</p>
      <br><p style="text-align: center;color: red">  超额导出金额是1元以上。格式：号码=（下注金额-超额）</p><p style="text-align: center;color: red">  金额导出金额是1元以上。格式：号码=下注金额</p> 
        <span style="color: red"></span>&nbsp;&nbsp; <br><br>
    </div>
</div>
  <form action="/Index/excels1" method="post">
    <div class="text-c" style="margin:50px 0px">
        <span class="select-box inline">期号
          <select name="qishu" class="select">
            <?php if(is_array($qishu)): $i = 0; $__LIST__ = $qishu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu1 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
                <?php else: ?>
                  <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>&nbsp;&nbsp;
        <span class="select-box inline">类型
          <select name="qtypes" class="select">
                <option value="1" <?php if($qtypes==1){ echo 'selected';} ?> >超额</option>
                <option value="2" <?php if($qtypes==2){ echo 'selected';} ?> >金额</option>
                <option value="3" <?php if($qtypes==3){ echo 'selected';} ?> >赔率</option>
          </select>
        </span>&nbsp;
        <?php if($qtypes != '1'): ?><span id="types1" style="display:none">
        <?php else: ?>
          <span id="types1"><?php endif; ?>
       <input type="text" name="moneys" value="<?php echo ($moneys); ?>" placeholder="1元以上" style="width:100px" class="input-text">&nbsp;&nbsp;
       </span>
       <!-- <span class="select-box inline">搜索
          <select name="types" class="select">
                <option value="1">赔率</option>
                <option value="2">金额</option>
          </select>
        </span>  :-->
      <?php if($qtypes == '1'): ?><span id="types2" style="display:none">  
      <?php else: ?>
        <span id="types2"><?php endif; ?>
     
    <input type="text" name="start" value="<?php echo ($start); ?>" placeholder="" style="width:100px" class="input-text">至
    <input type="text" name="finish" value="<?php echo ($finish); ?>" placeholder="" style="width:100px" class="input-text">
    </span>
     <!-- <div class="jeitem"> -->
    开始时间:
    <input type="text" class="input-text" style="width:160px" id="test04" name="stime" value="<?php echo ($stime); ?>" placeholder="YYYY-MM-DD hh:mm:ss">
    结束时间:
    <input type="text" class="input-text" style="width:160px" id="test05" name="etime" value="<?php echo ($etime); ?>" placeholder="YYYY-MM-DD hh:mm:ss">
     
             <!-- <div class="">
                <label class="jelabel">年月日时分秒选择</label>
                <div class="jeinpbox"><input type="text" class="input-text" id="test05" placeholder="YYYY-MM-DD hh:mm:ss"></div>
            </div> -->
         <span class="select-box inline">
          <select name="type" class="select">
            <option value="0">全部类型</option>
      <option value="1" <?php if($type==1){ echo 'selected';} ?>>二定位</option>
      <option value="口口XX" <?php if($type=='口口XX'){ echo 'selected';} ?>>口口XX</option>
      <option value="口X口X" <?php if($type=='口X口X'){ echo 'selected';} ?>>口X口X</option>
      <option value="口XX口" <?php if($type=='口XX口'){ echo 'selected';} ?>>口XX口</option>
      <option value="X口X口" <?php if($type=='X口X口'){ echo 'selected';} ?>>X口X口</option>
      <option value="X口口X" <?php if($type=='X口口X'){ echo 'selected';} ?>>X口口X</option>
      <option value="XX口口" <?php if($type=='XX口口'){ echo 'selected';} ?>>XX口口</option>
      <option value="三定位" <?php if($type=='三定位'){ echo 'selected';} ?>>三定位</option>
      <option value="口口口X" <?php if($type=='口口口X'){ echo 'selected';} ?>>口口口X</option>
      <option value="口口X口" <?php if($type=='口口X口'){ echo 'selected';} ?>>口口X口</option>
      <option value="口X口口" <?php if($type=='口X口口'){ echo 'selected';} ?>>口X口口</option>
      <option value="X口口口" <?php if($type=='X口口口'){ echo 'selected';} ?>>X口口口</option>
      <option value="四定位" <?php if($type=='四定位'){ echo 'selected';} ?>>四定位</option>
      <option value="二字现" <?php if($type=='二字现'){ echo 'selected';} ?>>二字现</option>
      <option value="三字现" <?php if($type=='三字现'){ echo 'selected';} ?>>三字现</option>
      <option value="四字现" <?php if($type=='四字现'){ echo 'selected';} ?>>四字现</option>
            <!-- <option value="1">直码</option>
            <option value="2">两同</option>
            <option value="3">三同</option>
            <option value="4">四同</option>
            <option value="5">两定</option>
            <option value="6">三定</option> -->
          </select>
        </span> 
       <!--  <button class="btn btn-success" type="button" onclick="findData()"><i class="Hui-iconfont"></i> 搜索</button> -->
     <!--  <button class="btn btn-success" type="buttom" onclick="finds()">搜索</button> -->
      <button name="" id="" class="btn btn-success" type="submit">导出</button>
    </div>
  </form>
      <form action="/Index/excels2" method="post">
    <div class="text-c" style="margin:50px 0px">
        <span class="select-box inline">期号
          <select name="qishu" class="select">
            <?php if(is_array($qishu)): $i = 0; $__LIST__ = $qishu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($qishu1 == $vo['qishu']): ?><option value="<?php echo ($vo["qishu"]); ?>" selected><?php echo ($vo["qishu"]); ?></option>
                <?php else: ?>
                  <option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>&nbsp;&nbsp;
        <span class="select-box inline">类型
          <select name="qtypes2" class="select">
                <option value="1" <?php if($qtypes==1){ echo 'selected';} ?> >超额</option>
                <option value="2" <?php if($qtypes==2){ echo 'selected';} ?> >金额</option>
                <option value="3" <?php if($qtypes==3){ echo 'selected';} ?> >赔率</option>
          </select>
        </span>&nbsp;
        <?php if($qtypes != '1'): ?><span id="types11" style="display:none">
        <?php else: ?>
          <span id="types11"><?php endif; ?>
       <input type="text" name="moneys" value="<?php echo ($moneys); ?>" placeholder="1元以上" style="width:100px" class="input-text">&nbsp;&nbsp;
       </span>
       <!-- <span class="select-box inline">搜索
          <select name="types" class="select">
                <option value="1">赔率</option>
                <option value="2">金额</option>
          </select>
        </span>  :-->
      <?php if($qtypes == '1'): ?><span id="types21" style="display:none">  
      <?php else: ?>
        <span id="types21"><?php endif; ?>
     
    <input type="text" name="start" value="<?php echo ($start); ?>" placeholder="" style="width:100px" class="input-text">至
    <input type="text" name="finish" value="<?php echo ($finish); ?>" placeholder="" style="width:100px" class="input-text">
    </span>
     <!-- <div class="jeitem"> -->
    开始时间:
    <input type="text" class="input-text" style="width:160px" id="test04" name="stime" value="<?php echo ($stime); ?>" placeholder="YYYY-MM-DD hh:mm:ss">
    结束时间:
    <input type="text" class="input-text" style="width:160px" id="test05" name="etime" value="<?php echo ($etime); ?>" placeholder="YYYY-MM-DD hh:mm:ss">
     
             <!-- <div class="">
                <label class="jelabel">年月日时分秒选择</label>
                <div class="jeinpbox"><input type="text" class="input-text" id="test05" placeholder="YYYY-MM-DD hh:mm:ss"></div>
            </div> -->
         <span class="select-box inline">
          <select name="type" class="select">
            <option value="0">全部类型</option>
      <option value="1" <?php if($type==1){ echo 'selected';} ?>>二定位</option>
      <option value="口口XX" <?php if($type=='口口XX'){ echo 'selected';} ?>>口口XX</option>
      <option value="口X口X" <?php if($type=='口X口X'){ echo 'selected';} ?>>口X口X</option>
      <option value="口XX口" <?php if($type=='口XX口'){ echo 'selected';} ?>>口XX口</option>
      <option value="X口X口" <?php if($type=='X口X口'){ echo 'selected';} ?>>X口X口</option>
      <option value="X口口X" <?php if($type=='X口口X'){ echo 'selected';} ?>>X口口X</option>
      <option value="XX口口" <?php if($type=='XX口口'){ echo 'selected';} ?>>XX口口</option>
      <option value="三定位" <?php if($type=='三定位'){ echo 'selected';} ?>>三定位</option>
      <option value="口口口X" <?php if($type=='口口口X'){ echo 'selected';} ?>>口口口X</option>
      <option value="口口X口" <?php if($type=='口口X口'){ echo 'selected';} ?>>口口X口</option>
      <option value="口X口口" <?php if($type=='口X口口'){ echo 'selected';} ?>>口X口口</option>
      <option value="X口口口" <?php if($type=='X口口口'){ echo 'selected';} ?>>X口口口</option>
      <option value="四定位" <?php if($type=='四定位'){ echo 'selected';} ?>>四定位</option>
      <option value="二字现" <?php if($type=='二字现'){ echo 'selected';} ?>>二字现</option>
      <option value="三字现" <?php if($type=='三字现'){ echo 'selected';} ?>>三字现</option>
      <option value="四字现" <?php if($type=='四字现'){ echo 'selected';} ?>>四字现</option>
            <!-- <option value="1">直码</option>
            <option value="2">两同</option>
            <option value="3">三同</option>
            <option value="4">四同</option>
            <option value="5">两定</option>
            <option value="6">三定</option> -->
          </select>
        </span> 
       <!--  <button class="btn btn-success" type="button" onclick="findData()"><i class="Hui-iconfont"></i> 搜索</button> -->
     <!--  <button class="btn btn-success" type="buttom" onclick="finds()">搜索</button> -->
      <button name="" id="" class="btn btn-success" type="submit">拦货导出</button>
    </div>
  </form>
  <div class="cl pd-5 bg-1 bk-gray mt-20" style="height:20px"></div>

  <!--   <table class="table table-border table-bordered table-bg table-hover table-sort"> <thead>  <tr class="tc"> <td rowspan="2" class="bg2" width="150">  日期  </td> <td colspan="3" class="bg-yellow">会员</td>   <td colspan="4" class="bg-orange">  代理  </td>  <td colspan="2" class="bg-pink">  总代理   </td> </tr> <tr class="tc"> <td class="bg-yellow">笔数</td> <td class="bg-yellow">总投</td> <td class="bg-yellow">盈亏</td>   <td class="bg-orange">  占成金额  </td> <td class="bg-orange">  占成盈亏  </td> <td class="bg-deeporg">   赚水   </td> <td class="bg-deeporg">总盈亏</td>  <td class="bg-pink">总投</td> <td class="bg-pink">盈亏</td> </tr> </thead> <tbody class="fn-hover">   <tr> <td> <strong class="blue">[1]</strong>   <a href="#!report?period_no=17084&amp;level=2" class="gray">  <strong class="red">07-21(17084)</strong>  </a>   </td> <td class="bg-yellow">0</td> <td class="bg-yellow">0</td>  <td class="bg-yellow"> 0 </td>  <td class="bg-orange">0</td> <td class="bg-orange">0</td> <td class="bg-deeporg">0</td>   <td class="bg-deeporg">0</td>    <td class="bg-pink">0</td> <td class="bg-pink">0</td>   </tr>  <tr class="tfoot"> <td class="tc"><span class="fb">合计</span> </td>  <td class="fb">0</td> <td class="fb">0</td>  <td class="fb">0</td>  <td class="fb">0</td> <td class="fb">0</td> <td class="fb">0</td>   <td class="fb">0</td>    <td class="fb">0</td> <td class="fb">0</td>    </tr>  </tbody>  </table> -->
  </div>
</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
<script>
//搜索
function findData(){
  var qishu=$('select[name="qishu"] option:selected').val();//选中的值
  var qtypes=$('select[name="qtypes"] option:selected').val();//选中的值
  var moneys=$('input[name="moneys"]').val();//
  var start=$('input[name="start"]').val();//
  var finish=$('input[name="finish"]').val();//
  var stime=$('input[name="stime"]').val();//
  var etime=$('input[name="etime"]').val();//
  var  type=$('select[name="type"] option:selected').val();//选中的值
 // alert('22');
  window.location.href="/Index/excels?qishu="+qishu+"&qtypes="+qtypes+"&moneys="+moneys+"&start="+start+"&finish="+finish+"&stime="+stime+"&etime="+etime+"&type="+type;
}
  $('input[name="moneys"]').keyup(function(){
      //console.log($(this).val());
      if($(this).val()=='0'){
        $(this).val('');
      }else{
        $(this).val($(this).val().replace(/[^\d]/g, ""));
      }

     });
  $('select[name="qtypes"]').change(function(){
    var id=$(this).val();
    if(id==1){
      $('#types1').show();
      $('#types2').hide();
      
    }else{
     $('#types2').show();
     $('#types1').hide();
    }
    //alert('11')
  });
    $('select[name="qtypes2"]').change(function(){
    var id=$(this).val();
    if(id==1){
      $('#types11').show();
      $('#types21').hide();
      
    }else{
     $('#types21').show();
     $('#types11').hide();
    }
    //alert('11')
  });
</script>
<!--时间-->
<link type="text/css" rel="stylesheet" href="/Public/shijian/css/jedate-test.css">
    <link type="text/css" rel="stylesheet" href="/Public/shijian/css/jedate.css">
    <script src="/Public/shijian/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/Public/shijian/js/jquery.jedate.js"></script>
    <script type="text/javascript" src="/Public/shijian/js/jedate-test.js"></script>
<!--请在下方写此页面业务相关的脚本-->
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