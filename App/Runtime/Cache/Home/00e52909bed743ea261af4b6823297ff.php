<?php if (!defined('THINK_PATH')) exit();?><html><head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="viewport" content="height=720,width=device-width,initial-scale=0.4, minimum-scale=0.1, maximum-scale=2.0, user-scalable=yes">
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta name="theme-color" content="#920783">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>会员</title>
    <link rel="stylesheet" type="text/css" href="/Public/css/mystyle.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/css/jquery.alerts.css"/>
	<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
	<script type="text/javascript" src="/Public/js/appcg.min.js?if=444"></script>
	<style type="text/css" media="screen">#sound {visibility:hidden}</style>
  	<link type="text/css" rel="stylesheet" href="/Public/css/mystyle7.css">
	<style type="text/css"> body {display : none;}</style>
	</head>
  <body>
	<script>
		document.addEventListener("DOMContentLoaded", function(){
			document.body.style.display = "block";
		});
	</script>
	<div class="topbj top_bj_7">
		<div class="top top_7">
			<div class="topleft"></div>
			<div class="topright">
			<div class="topmenu topright2">
				<ul class="nav nav_top">
					<!-- <li><a href="JavaScript:;" rel="tab_luxian">换线路</a></li> -->
					<li><a href="JavaScript:;" rel="tab_detail">下注明细</a></li>
					<li><a href="JavaScript:;" rel="tab_bill">历史账单</a></li>
					<li><a href="JavaScript:;" rel="tab_member">会员资料</a></li>
					<li><a href="JavaScript:;" rel="tab_award">开奖号码</a></li>
					<li><a href="JavaScript:;" rel="tab_rule">规则说明</a></li>
					<li><a href="/index.php/api/load">聚宝盆APP</a></li>
					<li><a href="https://www.baidu.com/from=844b/s?word=chrome+dev&ts=9290406&t_kt=61&ie=utf-8&fm_kl=021394be2f&rsv_iqid=0884866759&rsv_t=c7c7cva81Nbq%252BSlswqMOPs5d19LWd%252BzOB7WQBCOkMQo1kMxsmDp4sWDtEw&sa=is_1&ms=1&rsv_pq=0884866759&rsv_sug4=4662&ss=101&tj=1&inputT=1303&rq=c">官方指定手机浏览器</a></li>
					<li><a href="JavaScript:;" rel="tab_pass">修改密码</a></li>
					<li><a href="/Login/retreats">退出</a></li>
					<!-- <li id="cgchat_num" class="cgchat_emain_no"></li> -->
				</ul>
				<ul class="top_gun">
					<li class="gun_name">七星彩</li>
					<li class="gun"><marquee scrolldelay="400" style="height:15px;line-height:15px"> <span id="news"><?php echo ($news2['n_content']); ?></span></marquee></li>
					<!-- <span>离停盘时间：</span><li id="timeTag">22小时56分31秒</li> -->

				<?php if($status1 == 1): ?><!-- <span id="TimeLabel1">离封盘时间还有：</span>
	            <li id="TimeLabel2">8小时48分38秒</li> -->
	            <span id="TimeLabel1"></span><li id="TimeLabel2"></li>
	            <?php else: ?>
	            <li id="jnkc"></li>
					<script>setInterval("jnkc.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);
 
					</script><?php endif; ?>
				</ul>

<script language="javascript">


 $(function(){
 	if(<?php echo ($status1); ?> ==1){
	var t1,t2;
  //var nCounts = <?php echo ($time1); ?>;
  	t1='<?php echo ($titles); ?>';
 	var f_stime = <?php echo ($time); ?>;
 	 ShowCountDown(f_stime,'TimeLabel2');
    }
  //  var f_o_state = 1;

  // var o_stime = <?php echo ($o_stime); ?>;
  // var f_stime = <?php echo ($f_stime); ?>;


 var interval = 1000;
function ShowCountDown(leftsecond,divname){
  var day1=Math.floor(leftsecond/(60*60*24));
  var hour=Math.floor((leftsecond-day1*24*60*60)/3600);
  var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60);
  var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60);
  var cc = document.getElementById(divname);
  var dd = document.getElementById('TimeLabel1');
  dd.innerHTML=t1;
  if(day1>0){
    cc.innerHTML = day1+"天"+hour+"小时"+minute+"分"+second+"秒";
  }else{
    cc.innerHTML = hour+"小时"+minute+"分"+second+"秒";
  }
    if(hour==0 && minute==0 && second==0){
      window.location.reload();
    }
    //if (f_o_state ==1) {
       f_stime = f_stime-1;
    // }else{
    //    o_stime = o_stime-1;
    // }

}
  //if (f_o_state == 1) {  //距离封盘时间
      window.setInterval(function(){ShowCountDown(f_stime,'TimeLabel2');}, interval);
  // }else{   //距离开盘时间
  //     window.setInterval(function(){ShowCountDown(o_stime,'timeTag');}, interval);
  // }

})

function findIndex(){
	window.location.href="/Index/index";
}
// var ut='<?php echo ($ustatus); ?>';
// if(parseInt(ut)==1){	
// 	$("#aa").text('该账号异地登陆了，被迫下线！');
// 	//alert("该账号异地登陆了，被迫下线！");
// 	window.location.href="/index.php/Login/retreats";
	
// }
</script>


				<ul class="top_kaida">
					<li><a href="JavaScript:;" rel="tab_erziding">二字定</a></li>
					<li class="active"><a href="JavaScript:;" rel="tab_kuaida">快打</a></li>
					<li><a href="JavaScript:;" rel="tab_kuaixuan">快选</a></li>
					<li><a href="JavaScript:;" rel="tab_frank">赔率变动表</a></li>
					<li><a href="JavaScript:;" rel="tab_import">txt导入</a></li>
					<!-- <li><a href="http://www.jiangcho.com" target="_BLANK">（奖虫）APP</a></li> -->
				</ul>
			</div>
			</div>
			
		</div>
	</div>
	<div class="clear"></div>
	<div class="main_main">
		<div class="fixPos"></div>
		<div class="main_left">
			<span id="credits_remaining" style="display:none">5000</span>
			<iframe frameborder="0" marginwidth="0" marginheight="0" id="leftprint" name="leftprint" scrolling="yes" src="/Index/appprint"></iframe>
		</div>
		<div class="clear"></div>
		<!-- main_left end -->
		<!-- 快打 -->
		<div id="tab_main">
		<ol>
		<li id="tab_detail" style="display:none">
			<div class="main_center main_center_erziding"><!-- 下注明细 -->
				<div class="detailsearch">
					<ul>
						<li class="detailsearchimg"> &nbsp;</li>
						<li>查号码:<input type="text" id="detailsearchnumber" name="detailsearchnumber" pattern="\d" maxlength="4/"></li>
						<li></li>
						<li><label class="checkbox">现 <input id="detailsearchsendsizi" type="checkbox" name="detailsearchsendsizi" value="1" /></label></li>
						<li>列出:<select id="soclass1" name="soclass" class="chosen-select" data-placeholder="列出"><option value="0">赔率</option><option value="1">金额</option><option value="2">退码</option></select><input type="text" id="ds_s_money" name="ds_s_money" maxlength="8/"></li>					
						<li>至:<input type="text" id="ds_s_money_end" name="ds_s_money_end" maxlength="8/"></li>
						<li>分类:<select id="so_s_classid" name="so_s_classid" class="chosen-select" data-placeholder="分类"><option value="0">全部</option><option value="1">二定位</option><option value="口口XX">口口XX</option><option value="口X口X">口X口X</option><option value="口XX口">口XX口</option><option value="X口X口">X口X口</option><option value="X口口X">X口口X</option><option value="XX口口">XX口口</option><option value="三定位">三定位</option><option value="口口口X">口口口X</option><option value="口口X口">口口X口</option><option value="口X口口">口X口口</option><option value="X口口口">X口口口</option><option value="四定位">四定位</option><option value="二字现">二字现</option><option value="三字现">三字现</option><option value="四字现">四字现</option><!-- <option value="10001">二定</option><option value="10002">快打</option><option value="10003">快选</option> --></select></li>
						<li><button class="btn" id="detailsearch1" onclick="getPages('1')" type="button">搜索</button></li>
						<li><button class="btn" id="detailprint" type="button">打印</button></li>
						<li><button class="btn" id="detailhitaward1" onclick="getPages('2')"  type="button">中奖明细</button></li>
						<input type="hidden" name="qishu" value="" />
					</ul>
				</div>
				<span id="ds_s_issueno" style="display:none"></span>
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="11" id="ds_title">本期下注明细</th>
					</tr>

					<tr class="xiazhukuang2">
						<th width="7%">彩种</th>
						<th width="11%">注单编号</th>
						<th width="16%">下单时间</th>
						<th width="8%">号码</th>
						<th width="8%">金额</th>
						<th width="6%">赔率</th>
						<th width="11%">中奖</th>
						<th width="8%">回水</th>
						<th width="*">盈亏</th>
						<th width="7%">状态</th>
						<th width="7%"><label class="checkbox">全选<input id="DetailcheckboxALLID" type="checkbox"></label><button class="btn btnTuima" id="detailtuima" type="button">退码</button></th>
					</tr>
				</thead>
				<tbody id="DetailList">
				<!-- <tr><td>七星彩</td><td>44649102014155160</td><td>10-20 14:15:52</td><td class="number">11<span>现</span></td><td class="money">1</td><td class="frank">12.6</td><td>--</td><td>0.069</td><td>-0.931</td><td>成功</td><td><input id="checkboxID845119" type="checkbox" value="845119"></td></tr>
				<tr class="tuima"><td>七星彩</td><td>44649102011363852</td><td>10-20 11:36:48<br>退10-20 11:36:55</td><td class="number">99XX<span></span></td><td class="money">1</td><td class="frank">92.1</td><td>--</td><td>0.06</td><td>-0.94</td><td>退码</td><td>--</td></tr> -->
				</tbody>
				</table>
				<div id="DetailListPager" class="pagination"></div><div class="clear"></div>
			</div>
			<script type="text/javascript">
			function getPages(e){
				//var xian=0;
				var p=$('input[name="pageinput"]').val();
				// var haoma=$('#detailsearchnumber').val();
				// 	xian=$('input[name="detailsearchsendsizi"]:checked').val();
				// var type=$('select[name="soclass"] option:selected').val();
				// var types=$('select[name="so_s_classid"] option:selected').val();
				// var ks1=$('input[name="ds_s_money"]').val();
				// var ks2=$('input[name="ds_s_money_end"]').val();
				getPage(p,e);
				//alert(xian);
			}
			function getPage(p,e){
				var p=p;
				var e=e;
				var xian=0;
				var haoma=$('#detailsearchnumber').val();
					xian=$('input[name="detailsearchsendsizi"]:checked').val();
				var type=$('select[name="soclass"] option:selected').val();
				var types=$('select[name="so_s_classid"] option:selected').val();
				var ks1=$('input[name="ds_s_money"]').val();
				var ks2=$('input[name="ds_s_money_end"]').val();
				var qishu=$('input[name="qishu"]').val();
				//下注
				$.ajax({
		          type: "get",
		          url: "/Index/xiazhumingxi",
		          dataType: "json",
		          data: {action:'detail',p:p,type1:e,haoma:haoma,type:type,xian:xian,types:types,ks1:ks1,ks2:ks2,qishu:qishu},
		          success: function(msg){
		             // console.log(msg['data']);
		             // console.log(msg['sum']);
		             var data=msg['data'];
		             var code=msg['code'];
		             var html='',moneys=0,sum=0,wins2=0,wins3=0,moneys1=0,wins1=0;
		            if(code==200){
		            	for(var i=0;i<data.length;i++){
		            		if(data[i]['mingxi_1']=='4现'){
		            			data[i]['mingxi_3']='现';
		            		}else{
		            			data[i]['mingxi_3']='';
		            		}
		            		if(data[i]['js']==0){
		            			
		            			html+='<tr><td>七星彩</td><td>'+data[i]['did']+'</td><td>'+data[i]['addtime']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="money">'+data[i]['money']+'</td><td class="frank">'+data[i]['odds']+'</td>';
		            			  
		            			if(data[i]['status']==1){
		            				html+='<td>'+data[i]['zj']+'</td>';
		            			}else{
		            				html+='<td>--</td>';
		            			}
		            			html+='<td>'+data[i]['win']+'</td><td>'+data[i]['yingkui']+'</td><td>成功</td><td>';
		            			if(data[i]['t_status']==1){
		            			html+='<input id="checkboxID'+data[i]['id']+'" class="chebox" type="checkbox" value="'+data[i]['id']+'">';
		            		   }else{
		            		   	  html+='--';
		            		   }

		            			html+='</td></tr>';
		            			

		            			moneys+=parseFloat(data[i]['money']);
			            		wins2+=parseFloat(data[i]['win']);
			            		moneys1+=parseFloat(data[i]['zj']);
			            		wins3+=parseFloat(data[i]['yingkui']);
			            		sum+=1;
		            		}else{
		            			var wins=data[i]['money']-data[i]['win'];
		            			html+='<tr class="tuima"><td>七星彩</td><td>'+data[i]['did']+'</td><td>10-20 11:36:48<br>退'+data[i]['addtime']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="money">'+data[i]['money']+'</td><td class="frank">'+data[i]['odds']+'</td><td>--</td><td>'+data[i]['win']+'</td><td>-'+wins+'</td><td>退码</td><td>--</td></tr>';
		            		}
		            	}

		            	html+='<tr id="detailheji"><td colspan="2">合计</td><td>'+sum+'</td><td> </td><td>'+moneys.toFixed(2)+'</td><td> </td><td>'+moneys1.toFixed(2)+'</td><td>'+wins2.toFixed(3)+'</td><td>'+wins3.toFixed(3)+'</td><td> </td><td> </td></tr>';
		            	
		            	$('#DetailList').html(html);
		            	$('#DetailListPager').html(msg['show']);
		            }else{
		            	$('#DetailList').html('<tr><td>没有数据</td></tr>');
		            	$('#DetailListPager').html('');
		            }
		          }
		        });
			}
			</script>
		</li><li id="tab_bill" style="display:none">
			<div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="11">历史账单</th>
					</tr>
					<tr class="xiazhukuang2">
						<th>日期</th>
						<th>期号</th>
						<th>笔数</th>
						<th>金额</th>
						<th>回水</th>
						<th>中奖</th>
						<th>盈亏</th>
					</tr>
				</thead>
				<tbody id="billList"><!-- <tr><td>2017-10-20</td><td class="red"><a href="JavaScript:;" onclick="cgBill.listclick(17123)">17123</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr><td>2017-10-17</td><td><a href="JavaScript:;" onclick="cgBill.listclick(17122)">17122</a></td><td>2</td><td>2</td><td>0.51</td><td>0</td><td>-2</td></tr><tr><td>2017-10-15</td><td><a href="JavaScript:;" onclick="cgBill.listclick(17121)">17121</a></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr><tr class="xiazhukuang2"><th colspan="2">合计</th><th>2</th><th>2</th><th>0.51</th><th></th><th>-2</th></tr> --></tbody>
				</table>
				<div id="billListPager" class="pagination"></div><div class="clear"></div>
			</div>
		</li>
		<li id="tab_member" style="display:none">
			<div class="main_center main_center_erziding">
				<div class="memberleft">
					<table class="table table-bordered table-condensed table-hover">
					<thead>
						<tr class="xiazhukuang">
							<th colspan="2">会员资料</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>账　　号:<?php echo (session('unames')); ?></td><td id="m_username"></td>
						</tr>
						<tr>
							<td>姓　　名:</td><td id="m_nickname"></td>
						</tr>
						<tr>
							<td>信用额度:<?php echo (session('umoneys')); ?></td><td id="m_credits"></td>
						</tr>
					</tbody>
					</table>
				</div>
				<div class="memberright">
					<table class="table table-bordered table-condensed table-hover">
					<thead>
						<tr class="xiazhukuang">
							<th colspan="3">会员资料</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>自动:<input type="radio" name="entermode" value="0" checked></td>
							<td>小票打印:<input type="radio" name="sendmode" value="1" checked></td>
							<td>实际赔率:<input type="radio" name="isfpfrankhotzhuan" value="1" checked></td>
						</tr>
						<tr>
							<td>回车:<input type="radio" name="entermode" value="1"></td>
							<td>显示彩种:<input type="radio" name="sendmode" value="0"></td>
							<td>转换赔率:<input type="radio" name="isfpfrankhotzhuan" value="0"></td>
						</tr>
						<tr>
							<td colspan="3">打印备注:<input type="text" name="about" value="<?php echo ($about); ?>" maxlength="26" style="width:360px" placeholder="备注信息字数在26字左右"></td>
						</tr>
					</tbody>
					</table>
				</div>
				<table class="table-member">
				<tbody>
				<tr>
					<td width="47%">&nbsp;1、小票打印请使用系统自带浏览器&nbsp;&nbsp;<img src="/Public/images/ie7.png" width="35"></td>
					<td width="53%" rowspan="2">&nbsp;<button class="btn" id="memberbuts" type="button">提交</button></td>
				</tr>
				<tr>
					<td>&nbsp;2、提示:+号代表x号</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;3、小票打印处，增加了分页，每页显示500笔。</td>
				</tr>
				<tr>
				<td colspan="2">&nbsp;4、下注明细里，颜色（<font color="#ff0000" size="4">●</font>）或（<font color="#339900" size="4">●</font>）连在一起的，代表是在同一张小票上。</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;5、小票打印处内容超过500笔，再次下单后，系统会自动清空之前小票打印内容，请注意使用。</td>
				</tr>
				</tbody>
				</table>
				<!-- <table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="9">会员资料</th>
					</tr>
					<tr class="xiazhukuang2">
						<th>类别</th>
						<th>最小下注</th>
						<th>赔率上限(多个用/分开)</th>
						<th>单注上限</th>
						<th>单项上限</th>
						<th>交易回水</th>
						<th>赔率</th>

					</tr>
				</thead>
				<tbody id="memberList">
				</tbody>
				</table> -->
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="9">会员资料</th>
					</tr>
					<tr class="xiazhukuang2">
						<th>类别</th>
						<th>最小下注</th>
						<th>赔率上限(多个用/分开)</th>
						
						<th>单项上限</th>
						<th>单注上限</th>
						<th>交易回水/赔率</th>
						<!-- <th>赔率</th> -->

					</tr>
				</thead>
				<tbody id="memberList">
				<tr><td class="mred">直码</td>
				<td><span><?php echo ($market->ding43); ?></span></td>
				<td><span><?php echo ($loss->ding41); ?></span></td>
				<td><?php echo ($market->ding41); ?></td>
				<td><?php echo ($market->ding42); ?></td>

				<td><select name="hs_1" id="hs_5" data-pid="0" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j1); ?></select></td></tr>


				<tr class="xiazhukuang2"><th class="mred">两同</th><th> </th><th> </th><th> </th><th> </th><th><select name="hs_1" id="hs_1" style="display:none"><option value="0">0</option></select></th><th> </th></tr>
				<tr>
				  <td>数字不同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong23); ?></td>
					<td class="altbg2" width="20%"><?php echo ($loss->tong211); ?></td>
					<td class="altbg1" width="12%"><?php echo ($market->tong21); ?></td>
					<td class="altbg2" width="12%"><?php echo ($market->tong22); ?></td>
				  <td>
				    <select name="hs_2" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j2); ?></select>
				  </td>
				</tr>
				<tr>
				  <td>两数相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong23); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong221); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong21); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong22); ?></td>
				  <td>
				    <select name="hs_3" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j3); ?></select>
				  </td>
				</tr>
				<tr class="xiazhukuang2"><th class="mred">三同</th><th> </th><th> </th><th> </th><th> </th><th><select name="" id="hs_4" style="display:none"><option value="0">0</option></select></th><th> </th></tr>

				<tr>
				  <td>数字不同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong33); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong311); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong31); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong32); ?></td>
				  <td>
				    <select name="hs_4" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j4); ?></select>
				  </td>
				</tr>
				<tr>
				  <td>两数相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong33); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong321); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong31); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong32); ?></td>
				  <td>
				    <select name="hs_5" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j5); ?></select>
				  </td>
				</tr>
				<tr>
				  <td>三数相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong33); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong331); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong31); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong32); ?></td>
				  <td>
				    <select name="hs_6" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j6); ?></select>
				  </td>
				</tr>
				<tr class="xiazhukuang2"><th class="mred">四同</th><th> </th><th> </th><th> </th><th> </th><th><select name="hs" id="hs_4" style="display:none"><option value="0">0</option></select></th><th> </th></tr>
				<tr>
				  <td>数字不同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong43); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong411); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong41); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong42); ?></td>
				  <td>
				    <select name="hs_7" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j7); ?></select>
				  </td>
				</tr>
				
				<tr>
				  <td>两数相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong43); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong421); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong41); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong42); ?></td>
				  <td>
				    <select name="hs_8" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j8); ?></select>
				  </td>
				</tr>
				<tr>
				  <td>两两相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong43); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong431); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong41); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong42); ?></td>
				  <td>
				    <select name="hs_9" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j9); ?></select>
				  </td>
				</tr>
				<tr>
				  <td>三数相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong43); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong441); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong41); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong42); ?></td>
				  <td>
				    <select name="hs_10" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j10); ?></select>
				  </td>
				</tr>
				<tr>
				  <td>四数相同</td>
				  <td class="altbg2" width="12%"><?php echo ($market->tong43); ?></td>
			<td class="altbg2" width="20%"><?php echo ($loss->tong451); ?></td>
			<td class="altbg1" width="12%"><?php echo ($market->tong41); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->tong42); ?></td>
				  <td>
				    <select name="hs_11" id="hs_102" data-pid="1" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j11); ?></select>
				  </td>
				</tr>
				
				<tr><td class="mred">二定</td>

				<td class="altbg2"><span><?php echo ($market->ding23); ?></span></td>
			<td class="altbg2"><span><?php echo ($loss->ding21); ?></span></td>
			<td class="altbg1" width="12%"><?php echo ($market->ding21); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->ding22); ?></td>

			<td>
				<select name="hs_12" id="hs_5" data-pid="0" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j12); ?></select></td>
				</tr>


				<tr><td class="mred">三定</td>

				<td class="altbg2"><span><?php echo ($market->ding33); ?></span></td>
			<td class="altbg2"><span><?php echo ($loss->ding31); ?></span></td>
			<td class="altbg1" width="12%"><?php echo ($market->ding31); ?></td>
			<td class="altbg2" width="12%"><?php echo ($market->ding32); ?></td>

				<td><select name="hs_13" id="hs_5" data-pid="0" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><?php echo ($j13); ?></select></td>

				</tr>

				<!-- <tr><td class="mred">四字现</td><td>0.2</td><td>9550</td><td>100</td><td>1701</td><td><select name="hs_5" id="hs_5" data-pid="0" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><option value="0.255" selected="">0.255</option></select></td><td><select name="hs_5" id="hs_5" data-pid="0" class="chosen-select" data-placeholder="交易回水" style="width:100px;"><option value="0.255" selected="">0.255</option></select></td></tr> -->
				</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</li>
		<script type="text/javascript">
			$('#memberbuts').click(function(){
				var hs_1=$('select[name="hs_1"] option:selected').val();
				var hs_2=$('select[name="hs_2"] option:selected').val();
				var hs_3=$('select[name="hs_3"] option:selected').val();
				var hs_4=$('select[name="hs_4"] option:selected').val();
				var hs_5=$('select[name="hs_5"] option:selected').val();
				var hs_6=$('select[name="hs_6"] option:selected').val();
				var hs_7=$('select[name="hs_7"] option:selected').val();
				var hs_8=$('select[name="hs_8"] option:selected').val();
				var hs_9=$('select[name="hs_9"] option:selected').val();
				var hs_10=$('select[name="hs_10"] option:selected').val();
				var hs_11=$('select[name="hs_11"] option:selected').val();
				var hs_12=$('select[name="hs_12"] option:selected').val();
				var hs_13=$('select[name="hs_13"] option:selected').val();
				var about=$('input[name="about"]').val();
				 $.ajax({
			      type: "post",
			      url: "/Index/user1",
			      dataType: "json",
			      data: {action:'ajax_odd',hs_1:hs_1,hs_2:hs_2,hs_3:hs_3,hs_4:hs_4,hs_5:hs_5,hs_6:hs_6,hs_7:hs_7,hs_8:hs_8,hs_9:hs_9,hs_10:hs_10,hs_11:hs_11,hs_12:hs_12,hs_13:hs_13,about:about},
			      success: function(msg){
			      	if(msg.code==200){
			      		jAlert("保存成功", "提示框",function() {});
			            return false;
			      		// $(".notic").html('保存成功');
			        //     $(".notic").fadeIn().delay(1000).fadeOut();
			        //     return false;	
			      	}else{
			      		jAlert("保存失败", "提示框",function() {});
			            return false;
			      	}
			       		
			      }
			    });
			});
		</script>
		<li id="tab_award" style="display:none">
			<div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="9">开奖号码</th>
					</tr>
					<tr id="awardnumberstr" class="xiazhukuang2">
						<th>开奖时间</th>
						<th>期号</th>
						<th>仟</th>
						<th>佰</th>
						<th>拾</th>
						<th>个</th>
						<th>球5</th>
						<th style="display: none;">球6</th>
						<th style="display: none;">球7</th>
					</tr>
				</thead>
				<tbody id="awardList">
				<?php if($data2): if(is_array($data2)): $i = 0; $__LIST__ = $data2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['status'] == 1): ?><tr><td>--</td><td><?php echo ($vo["qishu"]); ?></td><td><div class="periodImg periodImg_5"></div></td><td><div class="periodImg periodImg_5"></div></td><td><div class="periodImg periodImg_5"></div></td><td><div class="periodImg periodImg_5"></div></td><td><div class="periodImg periodImg_5"></div></td><td><div class="periodImg periodImg_5"></div></td><td><div class="periodImg periodImg_5"></div></td></tr>
					<?php else: ?>
						<tr><td><?php echo ($vo["kaijiang"]); ?></td><td><?php echo ($vo["qishu"]); ?></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball1"]); ?></div></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball2"]); ?></div></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball3"]); ?></div></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball4"]); ?></div></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball5"]); ?></div></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball6"]); ?></div></td><td><div class="periodImg periodImg_1"><?php echo ($vo["m_ball7"]); ?></div></td></tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
				<?php else: endif; ?>
				
				
				</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</li>
		<li id="tab_kuaida">
		<?php if($status != 1): ?><div class="main_center main_center_kuaida" style="display:block">
				<table class="table table-bordered table-condensed tablecenter">
				<thead><tr class="xiazhukuang"><th>系统提示</th></tr></thead>
				<tbody><tr><td style="height: 100px">已经关盘，正在结算中...</td></tr></tbody>
				</table>
			</div><?php endif; ?>
		<?php if($status == 1): ?><div class="main_center main_center_kuaida" style="display:block">
			<table class="table table-bordered table-condensed table-hover tablecenter">
			<thead>
				<tr class="xiazhukuang">
					<th colspan="7">下注框</th>
				</tr>
				<tr class="xiazhukuang2">
					<th width="12%">彩种</th>
					<th width="22%">注单编号</th>
					<th width="16%">号码</th>
					<th width="15%">赔率</th>
					<th width="15%">金额</th>
					<th width="10%">状态</th>
					<th width="10%"><label class="checkbox">全选<input id="checkboxALLID" type="checkbox"></label><button class="btn btnTuima" id="xiazhutuima" type="button">退码</button></th>
				</tr>
			</thead>
			<tbody id="SoonOrder"><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr><tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr></tbody>
			</table>
			<form name="loginform" id="loginform" method="post">
			<div class="xiazhu_main">
				<ul class="xiazhu_title">
					<li><label class="checkbox">四字现 <input id="sendsizi" name="sendsizi" type="checkbox" onclick="statusNum()" value="1"></label></li>
					<li><label class="checkbox">全转 <input id="sendqz" type="checkbox" name="sendqz" onclick="statusNum()" value="1"></label></li>
				</ul>
				<ul class="xiazhu_xia">
					<li>号码</li>
					<li><input type="text" onpaste="return false" id="sendnumber" name="number" autocomplete="off" pattern="\d" maxlength="4/"  style="height:40px;width:95px" onkeypress="if(event.keyCode==13) focusNextInput(this);"> </li>
					<li class="xian" id="sendxian" style="display: none;">现</li>
					<li>金额</li><!--onkeyup="findMoney()"-->
					<li><input type="text" id="sendmoney" name="money" autocomplete="off" pattern="\d" maxlength="5/"  style="height:40px"> </li>
					<li><button id="sendxiazhu1" class="btn" type="button">确定下注</button></li>
					<li id="aa"></li>
					<li class="frankmoney" style="display: none;">赔率:<span class="frank" id="sfrank"></span> 可下:<span class="money" id="smoney"></span>
					  <input type="hidden" name="odds" value="">
				      <input type="hidden" name="limit" value="">
				      <input type="hidden" name="moneys" value="">
					</li>
				</ul>
			</div>
			</form>
			<div class="IE6height"></div>
		</div><?php endif; ?>
<script type="text/javascript">
	//停押号码
	function arrHaoma(){
		var urls="/Index/arrhaoma";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
            	type:'arrhaoma',
            },
            async: false,
            dataType:'json',
          success: function (data) {
          	var html='';
          	if(data.code==200){
          		var datas=data.data;
          		var sum=0,moneys=0;
          		for(var i=0;i<datas.length;i++){
          			html+='<tr><td>'+datas[i]['mingxi_2']+'</td><td>'+datas[i]['money']+'</td><td><input id="checkboxID'+datas[i]['id']+'" type="checkbox" value="'+datas[i]['id']+'"></td></tr>';
          			sum+=1;
          			moneys+=parseFloat(datas[i]['money']);
          		}
          		html+='<tr><td colspan="3" class="heji">笔数:'+sum+'  总金额:'+moneys.
toFixed(2)+'</td></tr>';
			$('#sotpnumber').html(html);
          	}else{
          		html='<tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr>';
          		$('#sotpnumber').html(html);
          	}
          	

            }

          });
	}
	
	$(function(){//停押号码全选反选
		$("#stopnumberBox").attr("checked", !1),
	    $("#stopnumberBox").click(function() {
	    	1 == this.checked ? $("#sotpnumber input[type=checkbox]").checkBox("all") : $("#sotpnumber input[type=checkbox]").checkBox("none")
	    });
	     $("#stopnumberBtnDel").click(function() {
              stopnumbeBtnDel();
            }) 
	}); 
	function stopnumbeBtnDel(){
		 var _self = this,
            delid = "";
            if (delid = $("#sotpnumber input[type=checkbox]").checkedValue(), "" == delid) return jAlert("请选择要删除的停押号码！", "提示框",
            function() {}),
            !1;
            jsonAjax("./delHaoma", "POST", "action=stopnumberdel&delid=" + delid + "&s_issueno=" + $("#s_issueon").val(), "json", '');
            arrHaoma();
            delHaoma();
	}
	function delHaoma(){
		var urls="/Index/delsHaoma";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
            	type:'arrhaoma',
            },
            async: false,
            dataType:'json',
          success: function (data) {
          	var html='';
          	if(data.code==200){
          		var datas=data.data;
          		var sum=0,moneys=0;
          		for(var i=0;i<datas.length;i++){
          			html+='<tr><td>'+datas[i]['mingxi_2']+'</td><td>'+datas[i]['money']+'</td></tr>';
          			
          		}
			$('#sotpnumberdel').html(html);
          	}
          	

            }

          });
	}
    //jQuery实现在一个输入框按回车键后光标跳到下一个输入框  
    function focusNextInput(thisInput)  
    {   
        var inputs = document.getElementsByTagName("input");   
        for(var i = 0;i<inputs.length;i++){   
            // 如果是最后一个，则焦点回到第一个   
            if(i==(inputs.length-1)){   
                inputs[0].focus(); break;   
            }else if(thisInput == inputs[i]){ 
            	getStatus();  
                inputs[i+1].focus(); break;   
            }   
        }   
    }   
</script> 
		<script type="text/javascript">
		var tijiaos='';
		$("#loginform").keydown(function(e){
			//alert('111');
			var number,money,moneys;
		  money = $("#sendmoney").val();
		  moneys=$('input[name="moneys"]').val();
		  number=$('input[name="number"]').val();
		 if(money.length!='' && moneys!=0){
		 	 var e = e || event,
			 keycode = e.which || e.keyCode;
			 //alert(keycode);
			 if (keycode==13) {//&& tijiaos!=2
			 	getStatus();
				//console.log(tijiaos);
			 	$("#sendxiazhu1").trigger("click");
			 	  //$("#sendmoney").val(' ');
				  $('input[name="moneys"]').val(' ');
				  $('input[name="number"]').val(' ');

			 // 	$('input[name="moneys"]').val('');
				// $('input[name="number"]').val('');
			 	
			}
		 }

});
			//下注
			$('#sendxiazhu1').click(function(){
				//判断号码
				
				//alert('1111');
				//findMoney();
				
				var number,money,sizixian,limit,moneys,odds;
				number=$('input[name="number"]').val();
				money=$('input[name="money"]').val();
				limit=$('input[name="limit"]').val();
				  var money = $("#sendmoney").val();
			   var moneys=$('input[name="moneys"]').val();
		
				if(number==''){
		       	jAlert("号码必须为数字！", "提示框",function() {});
		       	$('input[name="number"]').val('');
		          //alert('金额必须为数字！');
		          return false;
		       }
		       if(money==''){
		       	jAlert("金额必须为数字！", "提示框",function() {});
		       	$("#sendmoney").value='';
		          //alert('金额必须为数字！');
		          return false;
		       }else if(parseFloat(money) < parseFloat(moneys)){
		       	jAlert("下注金额不能低于"+moneys+"！", "提示框",function() {});
		       	$("#sendmoney").value='';
		          //alert('下注金额不能低于'+moneys+'！');
		          return false;
		       }
		       if(parseFloat(money)>parseFloat(limit)){
		       	jAlert("单注不能超过"+limit+"！", "提示框",function() {});
		       	$("#sendmoney").value='';
		          //alert('单注不能超过'+limit+'！');
		          return false;
		       }
				// if($("#sendsizi").attr('checked') == 'checked'){
			 //     sizixian = 1; //四字现
			 //  	}
				var sizixian=$('input[name="sendsizi"]:checked').val();
				var sendqz=$('input[name="sendqz"]:checked').val();//全转
				//下注
				$.ajax({
		          type: "post",
		          url: "/Index/xiazhu",
		          dataType: "json",
		          data: {sendqz:sendqz,number:number,action:'xiazhu',money:money,sizixian:sizixian,odds:odds,limit:limit},
		          success: function(msg){
		          	tijiaos=2;
		          	playmsg();
		            // console.log(msg);
		            if(msg == -2){
		              //alert("非法提交！");
		              jAlert('非法提交！', "提示框", function() {});
		               return false;
		            }else if(msg == -3){
		               //alert("下注金额超过上限！");
		               jAlert('下注金额超过上限！', "提示框", function() {});
		                return false;
		            }else if(msg == -31){
		               //alert("下注金额不能低于"+moneys+"！");
		               jAlert("注金额不能低于"+moneys+"！", function() {});
		                return false;
		            }else if(msg == -4){
		               //alert("余额不足！");
		               jAlert("余额不足！", function() {});
		                return false;
		            }else if(msg == -5){
		               //alert("下注失败！");
		               jAlert("下注失败！", function() {});
		                return false;
		            }else if(msg == -6){
		               //alert("该号码暂停销售！");
		               jAlert("该号码暂停销售！", function() {});
		                return false;
		            }else if(msg == -19){
		               //alert("管理员已关闭下注功能！");
		               jAlert("管理员已关闭下注功能！", function() {});
		                return false;
		            }else{
		              $(".frankmoney").hide();
		              $("#smoney").text('');
		              $("input[name='limit']").val('');
		              $("input[name='odds']").val('');
		              $("input[name='moneys']").val('');
		              $("#sendnumber").val('');
		              $("#money").val('');
		              //$("#sendmoney").val('');
					  $('input[name="moneys"]').val('');
					  $('input[name="number"]').val('');
		              //$("#sendnumber").focus();
		            }
		             arrHaoma();
		             $(".frankmoney").hide();
		             jsonAjax("/Index/xiazhukuang","get", "action=soonorder"+ "&time=" + new Date().getMilliseconds(), "json", cgOrber.GetSoonOrder);
		             //leftprint.location.reload(); 	//zc xiugai
					leftprint.jsonAjax("/Index/appindexajax","get", "action=printrefresh"+ "&time=" + new Date().getMilliseconds(), "json", leftprint.cgPrint.GetPrint);
		            $('#sendnumber').focus();

		            //window.location.reload();

		          }
		        });
		        return false;
				//leftprint.location.reload();
				//LeftPintIframe.refresh()
			});
			$('#sendnumber').blur(function(){
				var val=$(this).val();
				if(val.length!=''){
					getStatus();
				}
				//alert(val);
			});
			function findMoney(){
			   getStatus();
			   var money = $("#sendmoney").val();
			   var moneys=$('input[name="moneys"]').val();
		       var limit=$("input[name='limit']").val();

		       // if(money==''){
		       // 	jAlert("金额必须为数字！", "提示框",function() {});
		       // 	$("#sendmoney").value='';
		       //    //alert('金额必须为数字！');
		       //    return false;
		       // }else if(parseFloat(money) < parseFloat(moneys)){
		       // 	jAlert("下注金额不能低于"+moneys+"！", "提示框",function() {});
		       // 	$("#sendmoney").value='';
		       //    //alert('下注金额不能低于'+moneys+'！');
		       //    return false;
		       // }
		       // if(parseFloat(money)>parseFloat(limit)){
		       // 	jAlert("单注不能超过"+limit+"！", "提示框",function() {});
		       // 	$("#sendmoney").value='';
		       //    //alert('单注不能超过'+limit+'！');
		       //    return false;
		       // }
			}
			function statusNum(){
			 var num = $('#sendnumber').val();
			  if($("#sendsizi").attr('checked') == 'checked'){
			    var sizixian = 1; //四字现
			  }
			  if($("#sendqz").attr('checked') == 'checked'){
			    var zhuan24 = 1;  //全转
			  }
			  if(num.length != 0){
			   	getStatus(num,sizixian,zhuan24);
			  }
			}
			// $('#sendmoney').focus(function(){
			// 	getStatus();
			// });

			
			function getStatus(num,sizixian,zhuan24){

				var num = $('#sendnumber').val();
				var val1=num.replace(/[^0-9]/ig,"X");
				//alert(num);
				//var val1=num.replace(/[^0-9.xX]/g, "");
				//alert(val1);
				// var val1=num.replace(/[^0-9]/ig,"X"); 
				$('#sendnumber').val(val1); 
				num =val1;
					//var sizixian=$("#sendsizi :checked").val();
					var sizixian=$('input[name="sendsizi"]:checked').val();
				 // if($("#sendsizi").attr('checked') == 'checked'){
				 //    var sizixian = 1; //四字现
				 //  }
				  if($("#sendqz").attr('checked') == 'checked'){
				    var zhuan24 = 1;  //全转
				  }
				  if(num.length>1){

				  var sendqz=$('input[name="sendqz"]:checked').val();//全转
				  //alert(sizixian);
				 $.ajax({
			      type: "post",
			      url: "/Index/ajax_odd",
			      dataType: "json",
			      data: {sendqz:sendqz,num:num,action:'ajax_odd',sizixian:sizixian,zhuan24:zhuan24},
			      success: function(msg){
			      		// console.log(msg);
			        if(msg == -999){
			          $(".frankmoney").hide();
			          $("#aa").text('错误：信用额度不足！');
			          return false;
			        }else if(msg == -2){
			          $(".frankmoney").hide();
			          $("#aa").text('没有该号码(号码最多2个X号)！');
			          return false;
			        }else if(msg == -3){
			          $(".frankmoney").hide();
			          $("#aa").text('没有该号码没有赔率！');
			          return false;
			        }else if(msg == -4){
			          $(".frankmoney").hide();
			          $("#aa").text('没有该号码类型！');
			          return false;
			        }else if(msg == -19){
			          $(".frankmoney").hide();
			          $("#aa").text('管理员已关闭下注功能！');
			          return false;
			        }else if(msg == -5){
			        	$("#aa").text('');
			            $(".frankmoney").show();
			            $("#smoney").text('0');//下注上限
			            $("#sfrank").text('0');//赔率
			             $("input[name='limit']").val('0');//上限
			             $("input[name='moneys']").val('0');//下限
			          // $(".frankmoney").hide();
			          // $("#aa").text('该号码禁止销售！');
			          return false;
			        }else if(msg == -6){
			          // $(".frankmoney").hide();
			          // $("#aa").text('该号码销售已达上限！');
			          $("#aa").text('');
			            $(".frankmoney").show();
			            $("#smoney").text('0');//下注上限
			            $("#sfrank").text('0');//赔率
			             $("input[name='limit']").val('0');//上限
			             $("input[name='moneys']").val('0');//下限
			          return false;
			        }else{
			    //赔率，每码上限，单注上限，最小下注上限，会员回水,号码
			           $("#aa").text('');
			           $(".frankmoney").show();
			          $("#smoney").text(msg[1]);//下注上限
			          $("#sfrank").text(msg[0]);//赔率

			          $("input[name='limit']").val(msg[2]);//上限
			          $("input[name='odds']").val(msg[0]);//赔率
			          $("input[name='moneys']").val(msg[3]);//下限
			          //下注金额上线和下线
			        }
			       
			      }
			    });

				}
			}
		</script>
		<!-- main_center end -->
		<div class="main_right  main_right_kuaida">
			<div class="main_right2">
				<table class="table table-bordered table-condensed table-hover tablecenter">
					<thead>
						<tr class="xiazhukuang">
							<th colspan="3">目前停押号码
							<select name="s_issueon" id="s_issueon" class="chosen-select" data-placeholder="期号" style="width:100px;">
							<?php if(is_array($getData)): $i = 0; $__LIST__ = $getData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["qishu"]); ?>"><?php echo ($vo["qishu"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							</th>
						</tr>
						<tr class="xiazhukuang2">
							<th>号码</th>
							<th>金额</th>
							<th><label class="checkbox">全选<input id="stopnumberBox" type="checkbox"></label></th>
						</tr>
					</thead>
					<tbody id="sotpnumber" class="sotpnumber">
						<tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td></tr>
					
					<tr><td colspan="3" class="heji">笔数:0  总金额:0</td></tr></tbody>

				</table>
				<div id="stopnumberPager" class="pagination" style="display: none;"></div><div class="clear"></div>
				<div class="right_print">
				<button class="btn" id="stopnumberBtnPrint" type="button">打印</button> <button class="btn" id="stopnumberBtnDel" type="button">删除</button>
				</div>
				<table class="table table-bordered table-condensed table-hover tablecenter">
					<thead>
						<tr class="xiazhukuang">
							<th colspan="2">删除停押号码保留区</th>
						</tr>
						<tr class="xiazhukuang2">
							<th>号码</th>
							<th>金额</th>
						</tr>
					</thead>
					<tbody id="sotpnumberdel" class="sotpnumberdel"><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td></tr><tr><td colspan="2" class="heji">笔数:0  总金额:0</td></tr></tbody>
				</table>
				<div id="stopnumberdelPager" class="pagination" style="display: none;"></div><div class="clear"></div>
			</div>
			
		</div>
		<!-- main_right end -->
		</li>
		<li id="tab_kuaixuan" style="display:none">
			<!-- 快选 start -->
			<?php if($status != 1): ?><div class="main_center select_stop">
				<table class="table table-bordered table-condensed tablecenter">
				<thead><tr class="xiazhukuang"><th>系统提示</th></tr></thead>
				<tbody><tr><td style="height: 100px">已经关盘，正在结算中...</td></tr></tbody>
				</table>
			</div><?php endif; ?>
			<?php if($status == 1): ?><div class="main_center main_center_select main_center_kuaida">
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="8">生成号码框</th>
					</tr>
				</thead>
				<tbody id="showselectnumber"><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr><tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr></tbody>
				</table>
				<div class="boltsoonselect" style="display:none">发送中断，请继续下注或者点（复位），才可以操作功能。</div>
				<div class="xiazhu_main">
					<ul class="xiazhu_title">
						<li>发送框</li>
					</ul>
					<ul class="xiazhu_xia">
						<li>金额</li>
						<li><input type="text" id="selectmoney" name="selectmoney" pattern="\d" maxlength="5/"> </li>
						<li><button id="sendsoonselect_buts" class="btn" type="button">下注</button></li>
						<li class="soonselectBM">笔数:<span id="selectnumbertotal"></span><br>金额:<span id="selectnumbermoney">0</span></li>
					</ul>
				</div>
			</div><?php endif; ?>
			<script type="text/javascript">
				$('#sendsoonselect_buts').click(function(){
					//判断金额
					var money=$('#selectmoney').val();//下注金额
					var haoma=$('#selectnumber').val();//号码
					var sum=$('#selectnumbertotal_hidden').val();//笔数
					var type=$('#selectlogsclassid').val();//类型
					var moneys=$('#selectnumbermoney').text();
					//alert(haoma);
					if(haoma.length==''){
						jAlert("请在右边生成号码！", "提示框",function(){});
						 return false;
					}
					if(money.length==''){
						jAlert("填写金额！", "提示框",function(){});
						 return false;
					}
					//$(".notic").html("已下载请等待提交完成！");
					jAlert("请等待提交完成！", "提示框",function(){});
					//alert();
					//判断积分
					//sum*selectmoney
					//判断类型的下注、上限和下限
					playmsg();
					 $.ajax({
			          type: "post",
			          url: "/Index/xiazhu_kuaixuan",
                         time:120000,
			          dataType: "json",
			          data: {haoma:haoma,action:'erding',types:type,money:money,moneys:moneys},
			          success: function(msg){

			            //console.log(msg);
			            if(msg == -2){
			              //alert("非法提交！");
			              jAlert("非法提交！", "提示框",function() {});
			               return false;
			            }else if(msg == -3){
			              // alert("下注金额超过上限！");
			               jAlert("下注金额超过上限！", "提示框",function() {});
			                return false;
			            }else if(msg == -4){
			               //alert("余额不足！");
			               jAlert("余额不足！", "提示框",function() {});
			                return false;
			            }else if(msg == -5){
			               //alert("下注失败！");
			                jAlert("下注失败！", "提示框",function() {});
			                 return false;
			            }else if(msg == -7){
			               //alert("下注失败！");
			                jAlert("下注失败！该号码类型禁止销售！", "提示框",function() {});
			                 return false;
			            }else if(msg == -19){
			               //alert("管理员已关闭下注功能！");
			               jAlert("管理员已关闭下注功能！", "提示框",function() {});
			                return false;
			            }else if(msg == -9){
			               //alert("下注失败！");
			                jAlert("下注失败！下注金额不能小于最小限制！", "提示框",function() {});
			                 return false;
			            }else if(msg == -10){
			               //alert("下注失败！");
			                jAlert("下注失败！下注金额不能大于最大限制！", "提示框",function() {});
			                 return false;
			            }else{
			             // leftprint.location.reload();
			              window.location.reload();
			            }
			             //$("#showamt").hide();

			          }
			        });
			        return false;

				});
			</script>
			<div class="main_right main_right_select">
	<form name="selectForm" id="selectForm" onsubmit="return false;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-condensed table-hover table-soonselect" style="font-size:12px">
	<tbody><tr class="center"><td colspan="4">
		<table border="0" width="100%" cellpadding="0" cellspacing="0" class="menusoonselect"><tbody><tr>
		  <td class="active"><a href="JavaScript:;" rel="tabss_1">二字定</a></td>
		  <td><a href="JavaScript:;" rel="tabss_2">三字定</a></td>
		  <td><a href="JavaScript:;" rel="tabss_3">四字定</a></td>                          
		  <td><a href="JavaScript:;" rel="tabss_4">二字现</a></td>                          
		  <td><a href="JavaScript:;" rel="tabss_5">三字现</a></td>                          
		  <td><a href="JavaScript:;" rel="tabss_6">四字现</a></td> 
		</tr><tr></tr></tbody></table>
	</td></tr>	
	<tr id="s1" class="soon_head center">
	<td colspan="2"><dl>定位置</dl><input type="checkbox" name="__dingwei_chu" id="__dingwei_chu" onclick="__ss.__showdis(this,'__dingwei_qu');">除<input type="checkbox" name="__dingwei_qu" id="__dingwei_qu" onclick="__ss.__showdis(this,'__dingwei_chu');" checked="">取</td>
	<td colspan="2"><dl>配数全转</dl><input type="checkbox" name="__peishu_chu" id="__peishu_chu" onclick="__ss.__showdis(this,'__peishu_qu');">除<input type="checkbox" name="__peishu_qu" id="__peishu_qu" onclick="__ss.__showdis(this,'__peishu_chu');">取
	</td>
	</tr>
	
	<tr id="s13" class="soon_head center">
	<td colspan="4"><dl>配数</dl><input type="checkbox" name="__peishu_chu2" id="__peishu_chu2" onclick="__ss.__showdis(this,'__peishu_qu2');">除<input type="checkbox" name="__peishu_qu2" id="__peishu_qu2" onclick="__ss.__showdis(this,'__peishu_chu2');" checked="">取
	</td>
	</tr>
	<tr id="s12" class="center">
		<td colspan="4">
		<span id="ps1"><input type="text" name="__peishu_1" id="__peishu_1" class="soonselect_w soonselect_w74" maxlength="10"></span>
		<span id="ps2"> 配,<input type="text" name="__peishu_2" id="__peishu_2" class="soonselect_w soonselect_w74" maxlength="10"></span>
		<span id="ps3"> 配,<input type="text" name="__peishu_3" id="__peishu_3" class="soonselect_w soonselect_w74" maxlength="10"></span>
		<span id="ps4"> 配,<input type="text" name="__peishu_4" id="__peishu_4" class="soonselect_w soonselect_w74" maxlength="10"></span></td>
	</tr>
	<tr id="s2" class="center">
		<td>仟</td><td>佰</td><td>拾</td><td>个</td>
	</tr>
	<tr id="s3" class="center">
		<td><input type="text" name="__dingwei_1" id="__dingwei_1" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="limitrepeat(this)"></td>
		<td><input type="text" name="__dingwei_2" id="__dingwei_2" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="limitrepeat(this)"></td>
		<td><input type="text" name="__dingwei_3" id="__dingwei_3" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="limitrepeat(this)"></td>
		<td><input type="text" name="__dingwei_4" id="__dingwei_4" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>
	<tr id="s4" class="soon_head center"><td colspan="4"><dl>合　分</dl><input type="checkbox" name="__hefen_chu" id="__hefen_chu" onclick="__ss.__showdis(this,'__hefen_qu');">除<input type="checkbox" name="__hefen_qu" id="__hefen_qu" onclick="__ss.__showdis(this,'__hefen_chu');" checked="">取</td></tr>
	<tr id="s5" class="center">
	<td>
	1.
	<input type="checkbox" id="__hefenzhide_w_11" name="__hefenzhide_w_11">
	<input type="checkbox" id="__hefenzhide_w_21" name="__hefenzhide_w_21">
	<input type="checkbox" id="__hefenzhide_w_31" name="__hefenzhide_w_31">
	<input type="checkbox" id="__hefenzhide_w_41" name="__hefenzhide_w_41">
	<input type="text" name="__hefenzhide_1" class="soonselect_w soonselect_w74" id="__hefenzhide_1" maxlength="10" onkeyup="limitrepeat(this)">
   </td><td>
	2.
	<input type="checkbox" id="__hefenzhide_w_12" name="__hefenzhide_w_12">
	<input type="checkbox" id="__hefenzhide_w_22" name="__hefenzhide_w_22">
	<input type="checkbox" id="__hefenzhide_w_32" name="__hefenzhide_w_32">
	<input type="checkbox" id="__hefenzhide_w_42" name="__hefenzhide_w_42">
	<input type="text" name="__hefenzhide_2" class="soonselect_w soonselect_w74" id="__hefenzhide_2" maxlength="10" onkeyup="limitrepeat(this)">
   </td><td>
	3.
	<input type="checkbox" id="__hefenzhide_w_13" name="__hefenzhide_w_13">
	<input type="checkbox" id="__hefenzhide_w_23" name="__hefenzhide_w_23">
	<input type="checkbox" id="__hefenzhide_w_33" name="__hefenzhide_w_33">
	<input type="checkbox" id="__hefenzhide_w_43" name="__hefenzhide_w_43">
	<input type="text" name="__hefenzhide_3" class="soonselect_w soonselect_w74" id="__hefenzhide_3" maxlength="10" onkeyup="limitrepeat(this)">
   </td><td>
	4.
	<input type="checkbox" id="__hefenzhide_w_14" name="__hefenzhide_w_14">
	<input type="checkbox" id="__hefenzhide_w_24" name="__hefenzhide_w_24">
	<input type="checkbox" id="__hefenzhide_w_34" name="__hefenzhide_w_34">
	<input type="checkbox" id="__hefenzhide_w_44" name="__hefenzhide_w_44">
	<input type="text" name="__hefenzhide_4" class="soonselect_w soonselect_w74" id="__hefenzhide_4" maxlength="10" onkeyup="limitrepeat(this)">
    </td>
	</tr>
	<tr id="s6">
		<td colspan="2"><span id="bdwhefen1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 0px;">
		<tbody><tr><td width="220" style="border: 0px;">
		<dl>不定位合分</dl>
		<span id="bd1"><input type="checkbox" id="__bdwhefen_1" name="__bdwhefen_1" onclick="__ss.__showdis(this,'__bdwhefen_2');">两数合</span>
		<span id="bd2"><input type="checkbox" id="__bdwhefen_2" name="__bdwhefen_2" onclick="__ss.__showdis(this,'__bdwhefen_1');">三数合</span>
		</td><td width="*" style="border: 0px;">
		<input type="text" name="__bdwhefen" id="__bdwhefen" class="soonselect_w soonselect_w20" style="width:80px" maxlength="8" onkeyup="limitrepeat(this)">
		
		</td></tr></tbody></table></span>
		</td>
		<td class="center" colspan="2"><span id="zfw1">&nbsp;&nbsp;<dl>值 范 围</dl>&nbsp;&nbsp;从<input type="text" name="__zhifanwei_start" id="__zhifanwei_start" onkeyup="__ss.__keyup_zhifanwei();" class="soonselect_w soonselect_w35" maxlength="8">值&nbsp;至&nbsp;&nbsp;<input type="text" name="__zhifanwei_end" id="__zhifanwei_end" onkeyup="__ss.__keyup_zhifanwei();" class="soonselect_w soonselect_w35" maxlength="8">值</span></td>
	</tr>

	<tr id="s7">
		<td colspan="4">
		<span id="quandao"><dl>全转</dl>&nbsp;<input type="text" name="__quandao" id="__quandao" class="soonselect_w soonselect_w55" maxlength="9"></span>
		<span id="shangjiang"><dl>上奖</dl>&nbsp;<input type="text" name="__shangjiang" id="__shangjiang" class="soonselect_w soonselect_w55" maxlength="9"></span>
		<span id="paichu">&nbsp;<dl>排除</dl>&nbsp;<input type="text" name="__paichu" id="__paichu" class="soonselect_w soonselect_w55" maxlength="9" onkeyup="limitrepeat(this)"></span><span id="changyong"><input type="checkbox" name="__changyong" id="__changyong" style="display:none"></span>
		&nbsp;<span id="ch1"><dl>乘号位置</dl></span>
	<span id="ch2"><input type="checkbox" name="__chenghao_1" id="__chenghao_1">
	<input type="checkbox" name="__chenghao_2" id="__chenghao_2">
	<input type="checkbox" name="__chenghao_3" id="__chenghao_3">
	<input type="checkbox" name="__chenghao_4" id="__chenghao_4"></span>
	<span id="psgdstr"><dl>固定位置</dl><input type="checkbox" name="__gd1" id="__gd1">
	<input type="checkbox" name="__gd2" id="__gd2">
	<input type="checkbox" name="__gd3" id="__gd3">
	<input type="checkbox" name="__gd4" id="__gd4"></span>
		</td>
	</tr>
	<tr id="han1">
		<td colspan="4"><input type="checkbox" name="__chu_1" id="__chu_1" onclick="__ss.__showdis(this,'__qu_1');">除<input type="checkbox" name="__qu_1" id="__qu_1" onclick="__ss.__showdis(this,'__chu_1');">取&nbsp;二字定含&nbsp;<input type="text" name="__han_1" id="__han_1" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;二字定复式<input type="text" name="__fushi_1" id="__fushi_1" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>
	<tr id="han2">
		<td colspan="4"><input type="checkbox" name="__chu_2" id="__chu_2" onclick="__ss.__showdis(this,'__qu_2');">除<input type="checkbox" name="__qu_2" id="__qu_2" onclick="__ss.__showdis(this,'__chu_2');">取&nbsp;三字定含&nbsp;<input type="text" name="__han_2" id="__han_2" class="soonselect_w soonselect_w25" maxlength="2">&nbsp;三字定复式<input type="text" name="__fushi_2" id="__fushi_2" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>
	<tr id="han3">
		<td colspan="4"><input type="checkbox" name="__chu_3" id="__chu_3" onclick="__ss.__showdis(this,'__qu_3');">除<input type="checkbox" name="__qu_3" id="__qu_3" onclick="__ss.__showdis(this,'__chu_3');">取&nbsp;四字定<dl>含</dl>&nbsp;<input type="text" name="__han_3" id="__han_3" class="soonselect_w soonselect_w25" maxlength="3">&nbsp;四字定<dl>复式</dl><input type="text" name="__fushi_3" id="__fushi_3" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>
	<tr id="han4">
		<td colspan="4"><input type="checkbox" name="__chu_4" id="__chu_4" onclick="__ss.__showdis(this,'__qu_4');">除<input type="checkbox" name="__qu_4" id="__qu_4" onclick="__ss.__showdis(this,'__chu_4');">取&nbsp;二字现<dl>含</dl>&nbsp;<input type="text" name="__han_4" id="__han_4" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;二字现<dl>复式</dl><input type="text" name="__fushi_4" id="__fushi_4" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>
	<tr id="han5">
		<td colspan="4"><input type="checkbox" name="__chu_5" id="__chu_5" onclick="__ss.__showdis(this,'__qu_5');">除<input type="checkbox" name="__qu_5" id="__qu_5" onclick="__ss.__showdis(this,'__chu_5');">取&nbsp;三字现<dl>含</dl>&nbsp;<input type="text" name="__han_5" id="__han_5" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;三字现<dl>复式</dl><input type="text" name="__fushi_5" id="__fushi_5" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>
	<tr id="han6">
		<td colspan="4"><input type="checkbox" name="__chu_6" id="__chu_6" onclick="__ss.__showdis(this,'__qu_6');">除<input type="checkbox" name="__qu_6" id="__qu_6" onclick="__ss.__showdis(this,'__chu_6');">取&nbsp;四字现<dl>含</dl>&nbsp;<input type="text" name="__han_6" id="__han_6" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;四字现<dl>复式</dl><input type="text" name="__fushi_6" id="__fushi_6" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)"></td>
	</tr>


	<tr id="s8">
		<td colspan="4">
		<span id="ss1">    <input type="checkbox" name="__chu_chong_1" id="__chu_chong_1" onclick="__ss.__showdis(this,'__qu_chong_1');">除<input type="checkbox" name="__qu_chong_1" id="__qu_chong_1" onclick="__ss.__showdis(this,'__chu_chong_1');">取(<dl>双重</dl>)&nbsp;</span>

		<span id="ss2"><input type="checkbox" name="__chu_chong_2" id="__chu_chong_2" onclick="__ss.__showdis(this,'__qu_chong_2');">除<input type="checkbox" name="__qu_chong_2" id="__qu_chong_2" onclick="__ss.__showdis(this,'__chu_chong_2');">取(<dl>双双重</dl>)&nbsp;</span>
		<span id="ss3">    <input type="checkbox" name="__chu_chong_3" id="__chu_chong_3" onclick="__ss.__showdis(this,'__qu_chong_3');">除<input type="checkbox" name="__qu_chong_3" id="__qu_chong_3" onclick="__ss.__showdis(this,'__chu_chong_3');">取(<dl>三重</dl>)&nbsp;</span>
		<span id="ss4"><input type="checkbox" name="__chu_chong_4" id="__chu_chong_4" onclick="__ss.__showdis(this,'__qu_chong_4');">除<input type="checkbox" name="__qu_chong_4" id="__qu_chong_4" onclick="__ss.__showdis(this,'__chu_chong_4');">取(<dl>四重</dl>)</span>
		</td>
	</tr>
	<tr id="s9">
		<td colspan="4">
		<span id="ss5">    <input type="checkbox" name="__chu_xiongdi_1" id="__chu_xiongdi_1" onclick="__ss.__showdis(this,'__qu_xiongdi_1');">除<input type="checkbox" name="__qu_xiongdi_1" id="__qu_xiongdi_1" onclick="__ss.__showdis(this,'__chu_xiongdi_1');">取(<dl>二兄弟</dl>)&nbsp;</span>
		<span id="ss6"><input type="checkbox" name="__chu_xiongdi_2" id="__chu_xiongdi_2" onclick="__ss.__showdis(this,'__qu_xiongdi_2');">除<input type="checkbox" name="__qu_xiongdi_2" id="__qu_xiongdi_2" onclick="__ss.__showdis(this,'__chu_xiongdi_2');">取(<dl>三兄弟</dl>)&nbsp;</span>
		<span id="ss7">    <input type="checkbox" name="__chu_xiongdi_3" id="__chu_xiongdi_3" onclick="__ss.__showdis(this,'__qu_xiongdi_3');">除<input type="checkbox" name="__qu_xiongdi_3" id="__qu_xiongdi_3" onclick="__ss.__showdis(this,'__chu_xiongdi_3');">取(<dl>四兄弟</dl>)</span>
		
		</td>
	</tr>
	<tr id="s10">
		<td colspan="4">
		<span id="ss8">    <input type="checkbox" name="__chu_duishu" id="__chu_duishu" onclick="__ss.__showdis(this,'__qu_duishu');">除<input type="checkbox" name="__qu_duishu" id="__qu_duishu" onclick="__ss.__showdis(this,'__chu_duishu');">取(<dl>对数</dl>)</span>&nbsp;
		<input type="text" name="__duishu_1" id="__duishu_1" class="soonselect_w soonselect_w55" maxlength="2" onkeyup="limitrepeat(this)">&nbsp;
		<input type="text" name="__duishu_2" id="__duishu_2" class="soonselect_w soonselect_w55" maxlength="2" onkeyup="limitrepeat(this)">&nbsp;
		<input type="text" name="__duishu_3" id="__duishu_3" class="soonselect_w soonselect_w55" maxlength="2" onkeyup="limitrepeat(this)">&nbsp;		
		
		</td>
	</tr>
	<tr id="s11">
		<td colspan="4"> 
		<span id="dan1">
		<span id="ss9">    <input type="checkbox" name="__dan_chu" id="__dan_chu" onclick="__ss.__showdis(this,'__dan_qu');">除<input type="checkbox" name="__dan_qu" id="__dan_qu" onclick="__ss.__showdis(this,'__dan_chu');">取(<dl>单</dl>)</span>&nbsp;

	<span id="dsd1"><input type="checkbox" name="__dan_1" id="__dan_1"></span>
	<span id="dsd2"><input type="checkbox" name="__dan_2" id="__dan_2"></span>
	<span id="dsd3"><input type="checkbox" name="__dan_3" id="__dan_3"></span>
	<span id="dsd4"><input type="checkbox" name="__dan_4" id="__dan_4"></span>
	</span><span id="dan2"></span><br>
		<span id="shuang1">
		<span id="ss10">    <input type="checkbox" name="__shuang_chu" id="__shuang_chu" onclick="__ss.__showdis(this,'__shuang_qu');">除<input type="checkbox" name="__shuang_qu" id="__shuang_qu" onclick="__ss.__showdis(this,'__shuang_chu');">取(<dl>双</dl>)</span>&nbsp;
		
	<span id="dss1"><input type="checkbox" name="__shuang_1" id="__shuang_1"></span>
	<span id="dss2"><input type="checkbox" name="__shuang_2" id="__shuang_2"></span>
	<span id="dss3"><input type="checkbox" name="__shuang_3" id="__shuang_3"></span>
	<span id="dss4"><input type="checkbox" name="__shuang_4" id="__shuang_4"></span></span>&nbsp;<span id="shuang2"></span>
		</td>
	</tr>

	</tbody></table>
<div class="butcenter"><button onclick="cgSelect.loging();return false;" type="button" id="setsoonclass1" name="setsoonclass1" class="btn">生成</button>
<button type="reset" onclick="cgSelect.__reset(1);" id="setsoonclass2" name="setsoonclass2" class="btn">复位</button>
</div>
<input type="hidden" name="lujingstat" value="3"> 
<input type="hidden" name="selectlogsclassid" id="selectlogsclassid">
<input type="hidden" name="selectnumber" id="selectnumber" value="">
<input type="hidden" name="selectnumbertotal_hidden" id="selectnumbertotal_hidden" value="0">
<input type="hidden" name="selectlogs" id="selectlogs" value="">
<input type="hidden" name="selectnumberqiehuan" id="selectnumberqiehuan" value="0">
<input type="hidden" name="zjzc" id="zjzc" value="0">
</form>
			</div>
			<!-- 快选 end -->
		</li>
		<li id="tab_erziding" style="display:none">
		<?php if($status != 1): ?><div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed tablecenter">
				<thead><tr class="xiazhukuang"><th>系统提示</th></tr></thead>
				<tbody><tr><td style="height: 100px">已经关盘，正在结算中...</td></tr></tbody>
				</table>
			</div><?php endif; ?>
		<?php if($status == 1): ?><div class="main_center main_center_erziding">		
			    <table class="table table-bordered table-condensed table-rzd-hover table-rd-so">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="11"><button class="btn" id="moshi1" type="button" value="2">模式2</button>  类别 <span id="rdclassname"><a href="JavaScript:childclick(102)" id="102">口口XX</a>&nbsp;&nbsp;<a href="JavaScript:childclick(101)" class="active" id="101">口X口X</a>&nbsp;&nbsp;<a href="JavaScript:childclick(100)" id="100">口XX口</a>&nbsp;&nbsp;<a href="JavaScript:childclick(99)" id="99">X口X口</a>&nbsp;&nbsp;<a href="JavaScript:childclick(98)" id="98">X口口X</a>&nbsp;&nbsp;<a href="JavaScript:childclick(97)" id="97">XX口口</a>&nbsp;&nbsp;</span>笔数：<span id="rdcount">0</span> 总金额：<span id="rdmoney1">0</span> 单注上限：<span id="market1"><?php echo ($market2); ?></span> 单注最小值：<span id="market2"><?php echo ($market3); ?></span></th>
					</tr>
					<tr class="rdrow">
						<td> </td><th></th><th> </th><th> </th><th> </th><th> </th><th> </th><th> </th><th> </th><th> </th><th> </th>
					</tr>
					<tr class="rdImgtitle">
						<td id="types1"> </td>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
						<th><div class="rdL">号码</div><div class="rdR">赔率</div></th>
					</tr>

				</thead>
				<tbody id="erzidingList">
				</tbody>
			    <table id="erzidingcanshu" class="table table-bordered table-condensed table-rd-so">
				<tbody>
					<tr>
						<td rowspan="2" class="tl">定位置</td>
						<td id="erziding_qian"><span id="rzd_qian">仟</span><button class="btn b" id="dw0" data="0" type="button" onclick="cgErZiDing.ezdJ(this);">0</button><button class="btn b" id="dw1" data="1" type="button" onclick="cgErZiDing.ezdJ(this);">1</button><button class="btn b" id="dw2" data="2" type="button" onclick="cgErZiDing.ezdJ(this);">2</button><button class="btn b" id="dw3" data="3" type="button" onclick="cgErZiDing.ezdJ(this);">3</button><button class="btn b" id="dw4" data="4" type="button" onclick="cgErZiDing.ezdJ(this);">4</button><button class="btn b" id="dw5" data="5" type="button" onclick="cgErZiDing.ezdJ(this);">5</button><button class="btn b" id="dw6" data="6" type="button" onclick="cgErZiDing.ezdJ(this);">6</button><button class="btn b" id="dw7" data="7" type="button" onclick="cgErZiDing.ezdJ(this);">7</button><button class="btn b" id="dw8" data="8" type="button" onclick="cgErZiDing.ezdJ(this);">8</button><button class="btn b" id="dw9" data="9" type="button" onclick="cgErZiDing.ezdJ(this);">9</button><button class="btn b" id="dw10" data="10" type="button" onclick="cgErZiDing.ezdJ(this);">单</button><button class="btn b" id="dw11" data="11" type="button" onclick="cgErZiDing.ezdJ(this);">双</button><button class="btn b" id="dw12" data="12" type="button" onclick="cgErZiDing.ezdJ(this);">大</button><button class="btn b" id="dw13" data="13" type="button" onclick="cgErZiDing.ezdJ(this);">小</button></td>
						<td rowspan="2" class="tl">合分</td>
						<td id="erziding_hf0"><button class="btn b" id="hf0" data="0" type="button" onclick="cgErZiDing.ezdJ(this);">0</button><button class="btn b" id="hf1" data="1" type="button" onclick="cgErZiDing.ezdJ(this);">1</button><button class="btn b" id="hf2" data="2" type="button" onclick="cgErZiDing.ezdJ(this);">2</button><button class="btn b" id="hf3" data="3" type="button" onclick="cgErZiDing.ezdJ(this);">3</button><button class="btn b" id="hf4" data="4" type="button" onclick="cgErZiDing.ezdJ(this);">4</button><button class="btn b" id="ct44" type="button" onclick="cgErZiDing.ezdJ(this);">单</button></td>
						<td rowspan="2" class="rdmoney">
						金额
						<input type="text" id="erzidingmoney1" name="erzidingmoney" maxlength="5" value="" />
						<button id="serziding_buts" class="btn" type="button" style="height:40px">下注</button>
						<button id="serziding_quxiao" class="btn" type="button">取消</button>

						</td>
					</tr>
					<style>
						#erzidingmoney1 {
						    width: 100px;
						    font: 28px Arial, Helvetica, sans-serif;
						    font-weight: bold;
						    line-height: 30px;
						    height: 30px;
						}
					</style>
					<tr>
						<td id="erziding_shi"><span id="rzd_shi">拾</span><button class="btn b" id="dw0" data="0" type="button" onclick="cgErZiDing.ezdJ(this);">0</button><button class="btn b" id="dw1" data="1" type="button" onclick="cgErZiDing.ezdJ(this);">1</button><button class="btn b" id="dw2" data="2" type="button" onclick="cgErZiDing.ezdJ(this);">2</button><button class="btn b" id="dw3" data="3" type="button" onclick="cgErZiDing.ezdJ(this);">3</button><button class="btn b" id="dw4" data="4" type="button" onclick="cgErZiDing.ezdJ(this);">4</button><button class="btn b" id="dw5" data="5" type="button" onclick="cgErZiDing.ezdJ(this);">5</button><button class="btn b" id="dw6" data="6" type="button" onclick="cgErZiDing.ezdJ(this);">6</button><button class="btn b" id="dw7" data="7" type="button" onclick="cgErZiDing.ezdJ(this);">7</button><button class="btn b" id="dw8" data="8" type="button" onclick="cgErZiDing.ezdJ(this);">8</button><button class="btn b" id="dw9" data="9" type="button" onclick="cgErZiDing.ezdJ(this);">9</button><button class="btn b" id="dw10" data="10" type="button" onclick="cgErZiDing.ezdJ(this);">单</button><button class="btn b" id="dw11" data="11" type="button" onclick="cgErZiDing.ezdJ(this);">双</button><button class="btn b" id="dw12" data="12" type="button" onclick="cgErZiDing.ezdJ(this);">大</button><button class="btn b" id="dw13" data="13" type="button" onclick="cgErZiDing.ezdJ(this);">小</button></td>
						<td id="erziding_hf1"><button class="btn b" id="hf5" data="5" type="button" onclick="cgErZiDing.ezdJ(this);">5</button><button class="btn b" id="hf6" data="6" type="button" onclick="cgErZiDing.ezdJ(this);">6</button><button class="btn b" id="hf7" data="7" type="button" onclick="cgErZiDing.ezdJ(this);">7</button><button class="btn b" id="hf8" data="8" type="button" onclick="cgErZiDing.ezdJ(this);">8</button><button class="btn b" id="hf9" data="9" type="button" onclick="cgErZiDing.ezdJ(this);">9</button><button class="btn b" id="ct55" type="button" onclick="cgErZiDing.ezdJ(this);">双</button></td>
					</tr>
				</tbody>
				</table>
			    <table id="erzidingqueding" class="table table-bordered table-condensed table-rd-so" style="display:none">
				<tbody>
					<tr>
						<td>
						<center><button id="serziding_buts1" class="btn" type="button">下注</button></center>
						</td>
					</tr>
				</tbody>
				</table>
				<div class="clear"></div>
			</div><?php endif; ?>
			<script>
				$(".rdrow").find("th").each(function() {
            $(this).unbind("click").click(function() {
                var ii = $(this).index();
                $("#" + cgErZiDing.divname + " tr").find("td:eq(" + ii + ")").each(function() {
                    $(this).is(".rdcol") || $(this).click()
                })
            })
        })
				$("#" + cgErZiDing.divname).find(".rdcol").each(function() {
            $(this).unbind("click").click(function() {
                $(this).parent("tr").find("td").each(function() {
                    $(this).is(".rdcol") || $(this).click()
                })
            })
        })
			</script>
			<script type="text/javascript">
				$('#erzidingmoney1').keyup(function(){
					var market1=$('#market1').text();
            		var market2=$('#market2').text();
            		var regu = "^[0-9]+\.?[0-9]*$";
				//    var regu = "^[0-9]*$";
				    var re = new RegExp(regu);
				    if (re.test(this.value)) 
				    {
				        //return true;
				    } 
				    else 
				    {
				        this.value = ''; 
				    }
            		// console.log($(this).val());
            		// $(this).val().replace(/[^0-9.]/g, " ");
		             if(parseInt(this.value)>parseInt(market1)){
		              this.value = ''; 
		             }
		             if(parseInt(this.value)<parseInt(market2)){
		              this.value = '';  
		             }
		             var num=$('#rdcount').text();
		             //alert(num);
		             if(num>0){
		             	 var m = $("#erzidingmoney1").val();
		             	$('#rdmoney1').text(m*num);
		             }
				});
				$('#erzidingmoney1').keydown(function(e){
					var e = e || event,
 					keycode = e.which || e.keyCode;
					if (keycode==13) {
						$("#serziding_buts").trigger("click");
					}
				});
				$('#selectmoney').keydown(function(e){
					var e = e || event,
 					keycode = e.which || e.keyCode;
					if (keycode==13) {
						$("#sendsoonselect_buts").trigger("click");
					}
				});
				function inputs(Obj){
		            //判断下注金额是否超过上限
		            var market1=$('#market1').text();
		            var market2=$('#market2').text();
		            if(Obj.value>market1){
		              Obj.value = '';
		            }
		            if(Obj.value<market2){
		              Obj.value = '';  
		            }
		            var sum=getIputs();
		            var arr=sum.split('|');
		           // alert(arr[0])
		            // var moeny=getIputs1();
		            if(arr[0]>0){
		              $('#rdcount').text(arr[0]);
		              $('#rdmoney1').text(parseFloat(arr[1])-1);
		            }else{
		              $('#rdcount').text('');
		              $('#rdmoney1').text(''); 
		            }
		            // 
		          
		        }
		        //获取input填写数sum += parseInt(inputs[i].value);
		        function getIputs(n) {
		           var classElements1=0,classElements2=1;
		             $("#erzidingList input").each(function(){
					    if ($(this).val() != '' ) {
					    	classElements2++;
		                   classElements1 += parseInt($(this).val());
		                }
					  });
		             return classElements1+'|'+classElements2;
		        }
		        //下注
		        $('#serziding_buts').click(function(){
		        	//判断积分是否
		        	var haoma=$('.success .rdL').text();
		        	var moneys=$('#rdmoney1').text();
      				var types=$('#rdclassname').find('.active').text();
      				var money=$('#erzidingmoney1').val();
		        	//判断选择的内容是否存在
		        	if(haoma.length==''){
		        		jAlert("请选择下注号码", "提示框", function() {});
		        		return false;
		        	}
		        	//金额不能为空
		        	if(money.length==''){
		        		jAlert("请填写金额，再次下注！", "提示框", function() {});
		        		return false;
		        	}
		        	var market1=$('#market1').text();
			      	var market2=$('#market2').text();
			       	if(parseInt(money)> parseInt(market1)){
			          //alert('单注金额不能大于'+market1);
			          jAlert('单注金额不能大于'+market1, "提示框", function() {});
			          return false;
			       	}
			       	if(parseInt(money)<parseInt(market2)){
			          //alert('单注金额不能小于'+market2);
			          jAlert('单注金额不能小于'+market2, "提示框", function() {});
			          return false;
			       	}else{
			       			playmsg();
		       		  $.ajax({
				          type: "post",
				          url: "/Index/xiazhu_erding",
				          dataType: "json",
				          data: {haoma:haoma,action:'erding',money:money,types:types,moneys:moneys},
				          success: function(msg){
				          
				            //console.log(msg);
				            if(msg == -2){
				              //alert("非法提交！");
				              jAlert('非法提交！', "提示框", function() {});
				               return false;
				            }else if(msg == -3){
				              // alert("下注金额超过上限！");
				               jAlert('下注金额超过上限！', "提示框", function() {});
				                return false;
				            }else if(msg == -4){
				               //alert("余额不足！");
				               jAlert('余额不足！', "提示框", function() {});
				                return false;
				            }else if(msg == -5){
				               //alert("下注失败！");
				               jAlert('下注失败！', "提示框", function() {});
				                return false;
				            }else if(msg == -7){
				               //alert("下注失败！");
				               jAlert('该类型号码禁止销售！', "提示框", function() {});
				                return false;
				            }else if(msg == -19){
				              // alert("管理员已关闭下注功能！");
				               jAlert('管理员已关闭下注功能！', "提示框", function() {});
				                return false;
				            }else{
				              // $("#showamt").hide();
				              // $("#rdcount").text(' ');
				              // $("#rdmoney").text(' ');
				              // $("#erzidingmoney").val(' ');
				     
				              //leftprint.location.reload();
				              window.location.reload()
				            }
				             //$("#showamt").hide();

				          }
				        });
				        return false;
			       	}		    
		        });
		        //下注
		        $('#serziding_buts1').click(function(){
		        	//判断积分是否
		        	var haoma=getIput();

      				var moneys=$('#rdmoney1').text();
      				var types=$('#rdclassname').find('.active').text();
		        	//判断选择的内容是否存在
		        	if(haoma.length==''){
		        		jAlert("请填写金额，再次下注！", "提示框", function() {});
		        		return false;
		        	}
		    			playmsg();
	       		    $.ajax({
			          type: "post",
			          url: "/Index/xiazhu_erding1",
			          dataType: "json",
			          data: {haoma:haoma,action:'erding',types:types,moneys:moneys},
			          success: function(msg){
			          	
			            //console.log(msg);
			            // if(msg == -2){
			            //   alert("非法提交！");
			            // }else if(msg == -3){
			            //    alert("下注金额超过上限！");
			            // }else if(msg == -4){
			            //    alert("余额不足！");
			            // }else if(msg == -5){
			            //    alert("下注失败！");
			            // }else if(msg == -19){
			            //    alert("管理员已关闭下注功能！");
			            // }
			            if(msg == -2){
				              //alert("非法提交！");
				              jAlert('非法提交！', "提示框", function() {});
				               return false;
				            }else if(msg == -3){
				              // alert("下注金额超过上限！");
				               jAlert('下注金额超过上限！', "提示框", function() {});
				                return false;
				            }else if(msg == -4){
				               //alert("余额不足！");
				               jAlert('余额不足！', "提示框", function() {});
				                return false;
				            }else if(msg == -5){
				               //alert("下注失败！");
				               jAlert('下注失败！', "提示框", function() {});
				                return false;
				            }else if(msg == -7){
				               //alert("下注失败！");
				               jAlert('该类型号码禁止销售！', "提示框", function() {});
				                return false;
				            }else if(msg == -19){
				              // alert("管理员已关闭下注功能！");
				               jAlert('管理员已关闭下注功能！', "提示框", function() {});
				                return false;
				            }else{
			              //leftprint.location.reload();
			              window.location.reload()
			            }
			             //$("#showamt").hide();

			          }
			        });
			        return false;
			    		    
		        });
		    function getIput(n) {
			    var classElements ='';
	             $("#erzidingList input").each(function(){
				    if ($(this).val() != '' ) {
				    	classElements+= $(this).attr('id')+',';
		           		classElements+= $(this).val()+'|';
	                }
				  });
		        return classElements;
			}
			</script>
		</li>
		<li id="tab_frank" style="display:none">
			<div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="10">赔率变动表 <span id="frankhotname"><a href="JavaScript:;" onclick="findOdds(5)">二定位</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="findOdds(6)">三定位</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="findOdds(1)" class="active">四定位</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="findOdds(2)">二字现</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="findOdds(3)">三字现</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="findOdds(4)">四字现</a>&nbsp;&nbsp;</span></th>
					</tr>
				</thead>
				<tbody id="frankList">
				</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</li>
		<li id="tab_import" style="display:none">
			<div class="main_center main_center_erziding main_import">
			<form method="post" id="fileinfo" name="fileinfo">
				<table class="table table-bordered table-condensed table-hover">
				<thead>
					<tr class="xiazhukuang">
						<th>txt导入</th>
					</tr>
				</thead>
				<tbody class="filecss">
				<tr>
					<td><b>文件路径：</b><input type="file" name="fileinput" id="fileinput"> <button id="fileinput_but1" class="btn" type="button" onclick="alert('该功能关闭！')">提交</button></td>
					
				</tr>
				<tr>
					<td><b>格式A：</b>号码，号码，号码　　<b>格式B：</b>号码=金额，号码=金额，号码=金额 <font color="Red">(逗号也可以用空格代表)</font>　　<b>四字现格式：</b>例如1234现=a1234</td>
				</tr>
				<tr>
					<td><b>说明：</b>由于各会员使用的（txt文件）的格式不一样，如果不符合网站上要求的格式，有可能导入到网站（没有下注之前）的号码内容和自己（txt文件）里号码内容不一致，操作时请认真检查，如果出现内容不一致，请不要下注。
				</td>
				</tr>
				</tbody>
				</table>
			</form>
				<table class="table table-bordered table-condensed table-hover tablecenter">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="12">文件明细</th>
					</tr>
				</thead>
				<tbody id="importList">
				</tbody>
				</table>

				<table id="import_t" class="table table-bordered table-condensed table-rd-so" style="display:none">
				<tbody>
					<tr><td class="rdmoney"><center>
						<span class="import_sntxt" style="display:none">
						发送中断，请再次下注。
						</span>
						<span id="import_t1" style="display:none">
						<button id="import_but1" class="btn importbut" type="button">下注</button>
						</span>
						<span id="import_t2" style="display:none">
						金额<input type="text" id="importmoney" name="importmoney" maxlength="5/"> <button id="import_but2" class="btn importbut" type="button">下注</button>
						</span>
						<span class="import_sntxt" style="display:none">
						<button id="importprint_but" class="btn importbut" type="button">打印</button> <button id="importreset_but" class="btn importbut" type="button">清空</button>
						</span>
						</center></td></tr>
				</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</li>
		<li id="tab_rule" style="display:none">
			<div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed table-rule1">
				<tbody>
				<tr>
					<td><br><br><h3 align="center">本站销售<span class="rule1" id="rule_name"></span>电脑体育彩票游戏规则</h3>
					  <p><b>第一章　总　则</b><br><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>第一条</b>　根据财政部《彩票发行与销售管理暂行规定》和国家体育总局《体育彩票发行与销售管理暂行办法》以及《计算机销售体育彩票管理暂行办法》，制定本游戏规则。<br><br>  　　 
						  <b>第二条</b>　本站彩票实行自愿购买,量力而行；凡下注者即被视为同意并遵守本规则。          <b></b><br>
						  <b><br>
						  第二章　游戏方法</b><br><br>    　　 
						  <b>第三条</b>　
						  <span id="rule_name_0"></span>
						  <span class="rule1"><strong>本站取前面4位做为游戏规则！</strong></span><br>
					  　　 <span class="text-03"></span><br>
					  　　          <br>
					  <b>         <span class="rule1">假设下列为开奖结果</span></b><font color="#FF0000">:</font></p>
					  <table class="table table-bordered table-condensed table-rule1" style="width:50%">
						<thead>
						  <tr class="xiazhukuang2">
							<th>仟</th>
							<th>佰</th>
							<th>拾</th>
							<th>个</th>
							<th>球5</th>
							<th id="rule_w6">球6</th>
							<th id="rule_w7">球7</th>
						  </tr>
						 </thead>
						<tbody>
						  <tr>
							<td><b><font color="#cc0000">1</font></b></td>
							<td><b><font color="#cc0000">2</font></b></td>
							<td><b><font color="#cc0000">3</font></b></td>
							<td><b><font color="#cc0000">4</font></b></td>
							<td><b><font color="#cc0000">5</font></b></td>
							<td id="rule_6"><b><font color="#cc0000">6</font></b></td>
							<td id="rule_7"><b><font color="#cc0000">7</font></b></td>
						  </tr>
						</tbody>
					  </table><br>     
					  <p><strong>依照开奖结果，中奖范例如下：</strong></p><br> 
					  <p><strong>四字定中奖：</strong></p><br> 
					  <p class="rule1">1234</p><br> 
					  <p><strong>二字定中奖：</strong></p><br> 
					  <p><span class="rule1">12xx； 1x3x； 1xx4； x23x； x2x4； xx34 </span></p><br> 
					  <p><strong>三字定中奖：</strong></p><br> 
					  <p><span class="rule1">123x； 12x4； 1x34； x234 </span></p><br> 
					  <p><strong>二字现中奖：</strong></p><br> 
					  <p><span class="rule1"><strong>12；13；14；23；24；34</strong></span></p><br> 
					  <p><strong>三字现中奖：</strong></p><br> 
					  <p><span class="rule1"><strong>123；124；134；234</strong></span></p><br> 
					  <p><strong>四字现中奖：</strong></p><br> 
					  <p><span class="rule1"><strong>1234 现；</strong></span></p><br> 
					  <b>第三章　开奖及公告</b><br>
					  <br>      　　
					  <b>第四条</b>　“<span id="rule_name"><span class="rule1" id="rule_name2"></span>
					  ，摇奖过程在公证人员监督下进行，通过电视台播出。<br>
					  <br>      　　
					  <b>第五条</b>　每期开奖后，以国家体育总局体育彩票管理中心公布的开奖号码为准。<br>
					  <br>
					  <br>
					  <b>第四章　附　则</b><br>
					  <br>      　　
					  <b>第六条</b>　本游戏规则最终解释权归本公司。<p></p><br> 
					  </span></td>
				  </tr>
				</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</li>
		<li id="tab_logs" style="display:none">
			<div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed table-hover">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="6">日志 <span id="logsclass" class="title_a"><a href="JavaScript:;" onclick="cgLogs.LogsClass(this,1);">二定位</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,2);">三定位</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,3);">四定位</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,4);">二字现</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,5);">三字现</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,6);">四字现</a>&nbsp;&nbsp;<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,0);">全部</a>&nbsp;&nbsp;</span></th>
					</tr>
					<tr class="xiazhukuang2">
						<th width="50">笔数</th>
						<th width="50">金额</th>
						<th width="*">操作内容(日志是记录操作条件，方便核对，实际下单内容已下注明细为准）</th>
						<th width="90">操作时间</th>
						<th width="50" class="center">再次生成</th>
						<th width="40" class="center"><button class="btn btnTuima" id="LogsCy" type="button">常用</button></th>

					</tr>
				</thead>
				<tbody id="logsList">
				</tbody>
				</table>
				<div id="logsListPager" class="pagination"></div><div class="clear"></div>
			</div>
		</li>
		<li id="tab_pass" style="display:none">
			<div class="main_center main_center_erziding">
				<table class="table table-bordered table-condensed table-hover table-pass">
				<thead>
					<tr class="xiazhukuang">
						<th colspan="2">&nbsp;&nbsp;帐户修改密码</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>原密码:</td><td><input type="password" name="oldpassword" id="oldpassword" size="25" tabindex="1" value='' /></td>
					</tr>
					<tr>
						<td>新密码:</td><td class="passstr2"><input type="password" name="newpassword" id="newpassword" size="25" tabindex="2" value='' />新密码不能跟账号和原密码相同。</td>
					</tr>
					<tr>
						<td>确认新密码:</td><td class="passstr2"><input type="password" name="newpassword2" id="newpassword2" size="25" tabindex="3" value='' />必须是数字和字母组合，至少4位以上。</td>
					</tr>
					<tr>
					<td class="span2">系统禁止不可用密码:</td><td class="passstr"><span id="passList"></span>&nbsp;&nbsp;</td></tr>
				</tbody>
				</table>
				<center><button class="btn" id="editpass1" type="button">提交</button></center>
				<div class="clear"></div>
			</div>
		</li>
		</ol>
		</div>
	</div>

	<audio id="sound" autoplay="autoplay"></audio>
  	<script type="text/javascript">
  	
  	function playmsg(c) {
		document.getElementById("sound").src="/Public/4204.mp3";
	}
  	//修改密码
  	$('#editpass1').click(function(){
  		var oldpassword,newpassword,newpassword2;
  		var oldpassword=$('#oldpassword').val();
  		var newpassword=$('#newpassword').val();
  		var newpassword2=$('#newpassword2').val();
  		//判断是否为空
  		if(oldpassword.length==''){
  			jAlert("原密码不能为空！", "提示框",function() {});
  			 return false; 
  		}else{
  			var dataStatus=inputFinds(oldpassword);
			if(dataStatus==true){
				jAlert("原密码不正确！", "提示框",function() {});
  			 return false
			}
  			
  		}
  		if(newpassword.length==''){
  			jAlert("新密码不能为空！", "提示框",function() {});
  			 return false; 
  		}else if(!isRegisterUserPwds(newpassword)){
	        jAlert("密码小写字母开头4~18长度以内的字母、数字的组合！", "提示框",function() {});
            return false; 
        }
  		if(newpassword2.length==''){
  			jAlert("确认新密码不能为空！", "提示框",function() {});
  			 return false; 
  		}else if(!isRegisterUserPwds(newpassword2)){
	        jAlert("确认密码小写字母开头4~18长度以内的字母、数字的组合！", "提示框",function() {});
            return false; 
        }
  		//判断新密码是否一致
  		if(newpassword!=newpassword2){
  			jAlert("两次密码填写不一致！", "提示框",function() {});
  			 return false; 
  		}
  		var urls="/Index/saveUser";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'newpassword':newpassword,
                'newpassword2':newpassword2,
            },
            async: false,
            dataType:'json',
            success: function (data) {
             	if(data.code==200){
             		jAlert("密码修改成功", "提示框",function() {
             			window.location.href=data.urls;
             		});
             	}else{
             		jAlert("密码修改失败！", "提示框",function() {});	
             		 return false;
             	}
            }
          });

  	});
  	function isRegisterUserPwds(s){//密码验证   
		var patrn=/^[a-z0-9]{4,18}$/;   
		if (!patrn.exec(s))return false 
		return true 
	}
	    /*

    *是否存在

     */

    function  inputFinds(name){
        var returns;
        var urls="/Index/findUser";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'name':name,
            },
            async: false,
            dataType:'json',
            success: function (data) {
             if(data.code==true){
                returns=true;
              }else{
                returns=false;
              }
            }
          });
        return returns;
      }
  	</script>
	<script type="text/javascript">
	function ustatus(){
		var status=2;
		$.ajax({
              type: "post",
              url: "/Index/ustatus1",
              dataType: "json",
              data: {
              },
              success: function(msg){
              	//console.log(msg);
              	status=msg;
              }
            });
            return status;	
	}
	var _soonset = {};
	//$(document).ready(function(){
	$(window).load(function(){ 

		/*菜单*/
		$('.topmenu').on('click', 'li a', function() 
		{

		var ut=ustatus();
		//console.log('<?php echo (session('uIP')); ?>');
		//console.log(ut);
		if(parseInt(ut)==1){	
			//$("#aa").text('该账号异地登陆了，被迫下线！');
			alert("您的账号在其他地登录，如有异常请联系上级！");
			window.location.href="/index.php/Login/retreats";
			
		}
			$(".topmenu").children("ul").children("li").removeClass("active");
			$(this).parent().addClass("active");
			var activeTab = $(this).attr("rel");
			if(activeTab!=''&&activeTab!=undefined){

				if(activeTab=='tab_luxian') {
					var dArr = cgOrber.xianlu;
					var fn = Math.floor(Math.random() * dArr.length + 1)-1; 
					jConfirm('\n您是使用时感觉卡了，才选择（换线路），系统会给您分配另外一条线路，是否换线路?','提示框',function(s){if(s)window.top.location.href='http://'+dArr[fn]+'/?action=fast&inter_username='+cgOrber.faststr;else return false;});
				}else{
					$("#tab_main ol").children("li").hide(); 
					$(".main_main").removeClass("main_main_kuaixuan");
					$(".main_main").removeClass("main_main_no");
					if(cgOrber.isnumbermoney==1){
						if(activeTab=='tab_pass'){
							if($(activeTab)) $("#"+activeTab).show();
						}else{
							$(".nav_top li [rel=tab_pass]").click();//点击修改密码
						}
						
					}else{
						if(activeTab=='tab_kuaida') {
							$("#sendmoney").val('');
							$("#sendnumber").val('');
							$("#sendsizi").attr("checked",false);
							$("#sendqz").attr("checked",false);
							$("#stopnumberBox").attr("checked",false);
							$("#sotpnumber input[type=checkbox]").checkBox("none");
							$("#checkboxALLID").attr("checked",false);
							$("#SoonOrder input[type=checkbox]").checkBox("none");
							$(".frankmoney").hide();
							setTimeout('$("#sendnumber").focus()',200);
							setTimeout("$('.main_right').scrollTop(0)",100);
							//getData();
							jsonAjax("/Index/xiazhukuang","get", "action=soonorder"+ "&time=" + new Date().getMilliseconds(), "json", cgOrber.GetSoonOrder);
						}else if(activeTab=='tab_detail') {
							$("#DetailcheckboxALLID").attr("checked",false);
							$(".main_main").addClass("main_main_no");
							cgDetail.setValInit();
							//jsonAjax("/Index/xiazhumingxi","get", "action=detail", "json", cgDetail.GetDetail);
							getPage();
							
						}else if(activeTab=='tab_member') {
							$(".main_main").addClass("main_main_no");
							//jsonAjax("appindexajax.php","get", "action=member", "json", cgMember.GetMember);
						}else if(activeTab=='tab_bill') {
							$(".main_main").addClass("main_main_no");
							//jsonAjax("appindexajax.php","get", "action=bill", "json", cgBill.GetBill);
							var urls="/Index/getQishu";
					        $.ajax({
					            url: urls,
					            type:"POST",
					            data:{data:'getDatas'},
					            async: false,
					            dataType:'json',
					            success: function (data) {
					           
					            var html='';
					            	if(data.code=200){
					            		var datas=data.data;
					            		
					            		 var sum1=0,sum=0,money=0,win=0,moneys=0;
					            		if(datas.length!=''){
					            			for(var i=0;i<datas.length;i++){
					            				//var win1=parseFloat(datas[i]['win']);
					            				html+='<tr><td>'+datas[i]['md']+'</td>';
					            				if(datas[i]['status']==3){
					            					html+='<td><a href="JavaScript:;" onclick="cgBill.listclick('+datas[i]['qishu']+')">'+datas[i]['qishu']+'</a></td>';
					            				}else{
					            					html+='<td><a href="JavaScript:;" onclick="cgBill.listclick('+datas[i]['qishu']+')" style="color:red">'+datas[i]['qishu']+'</a></td>';
					            				}
					            				
					            				html+='<td>'+datas[i]['sum']+'</td><td>'+datas[i]['money']+'</td>';
					            					// if(datas[i]['moneys']){
					            					// 	html+='<td>'+datas[i]['moneys']+'</td>';
					            					// 	//moneys+=parseFloat(datas[i]['moneys']);
					            					// }else{
					            					// 	html+='<td>0</td>';	
					            					// }
					            					if(datas[i]['win']>0){
					            						html+='<td>'+datas[i]['win']+'</td>';
					            					}else{
					            						html+='<td>0</td>';
					            					}
					            					if(datas[i]['status']==3){
					            						//html+='<td>'+datas[i]['win']+'</td>';
					            						if(datas[i]['moneys']){
					            							html+='<td>'+datas[i]['moneys']+'</td>';
						            					}else{
						            						html+='<td>0</td>';	
						            					}
					            						html+='<td>'+datas[i]['yingkui']+'</td>';

					            					}else{
					            						html+='<td>--</td><td>--</td>';
					            						//html+='<td>--</td>';		
					            					}
					            				

					            				html+='</tr>';

					            				// if(datas[i]['sum']){
					            				// 	sum+=datas[i]['sum'];
					            				// }
					            				// if(datas[i]['money']){
					            				// 	money+=parseFloat(datas[i]['money']);
					            				// }
					            				// if(datas[i]['win']){
					            				// 	win+=parseFloat(datas[i]['win']);
					            				// }
					            				// sum1+=1;
					            				
					            				
					            				
					            			}
					            			// console.log(sum1);
					            			html+='<tr class="xiazhukuang2"><th>合计</th><th>'+data['sums1']+'</th><th>'+data['sum1']+'</th><th>'+data['money1']+'</th><th>'+data['win1']+'</th><th>'+data['moneys1']+'</th><th>'+data['yingkui1']+'</th></tr>';
					            			// if(moneys){
					            			// 	html+='<th>'+moneys.toFixed(2)+'</th><th>'+moneys.toFixed(2)+'</th>';
					            			// }else{
					            			// 	html+='<th></th><th></th>';
					            			// }
					            			

					            			//html+='</tr>';
					            		}
					            		$('#billList').html(html);
					            	}else{
					            		$('#billList').html(html);
					            	}
					            }

					        });
						}else if(activeTab=='tab_award') {
							$(".main_main").addClass("main_main_no");
							//jsonAjax("appindexajax.php","get", "action=numberaward", "json", cgAward.GetAward);
						}else if(activeTab=='tab_logs') {
							$(".main_main").addClass("main_main_no");
							$('#logsclass').find("a").removeClass("active");
							$('#logsclass').find("a:eq(6)").addClass("active");
							//jsonAjax("appindexajax.php","get", "action=logs", "json", cgLogs.GetLogs);
						}else if(activeTab=='tab_pass') {
							$(".main_main").addClass("main_main_no");
							//jsonAjax("appindexajax.php","get", "action=pass&doaction=init", "json", cgPass.GetPass);
						}else if(activeTab=='tab_erziding') {
							$(".main_main").addClass("main_main_no");
							// $('#erzidingList').html('');
							// cgErZiDing.childid=0;
							// cgErZiDing.moshi(cgOrber.erzimode,0);
							var urls="/Index/findTypes1";
					        $.ajax({
					            url: urls,
					            type:"POST",
					            data:{
					                'types':100,
					                'type':2,
					            },
					            async: false,
					            dataType:'json',
					            success: function (data) {
					            //console.log(data);
					            $('#erzidingList').html(data);
					             $('.rdcol').click(function(){
					              var hover_index = $(this).parent().index();
					              var hover_indexs = $(this).index();
					              //alert(hover_indexs)
					              //$("#erzidingList").find("tr:eq("+hover_index+") td").addClass("hover");
					       
					              $(this).parent("tr").find("td").each(function() {
					                if(($(this).attr('class')=='success') || ($(this).attr('class')=='rdcol success')){
					                  $(this).removeClass("success")
					                }else{

					                  $(this).addClass("success")
					                }
					                        
					              })

					              $("#erzidingList tr").find("td:eq(0)").removeClass("success");
					              // var sums=getElementsByClassName("success");
					              //   sums=sums.length;
					              var m = $("#erzidingmoney").val();
					              if(m>0){
					                //$("#rdmoney").text(sums * m)
					              }
					               // $("#rdcount").text(sums)
					            });

					            }

					        });
						}else if(activeTab=='tab_frank') {
							$(".main_main").addClass("main_main_no");

							var urls="/Index/findOdds";
					        $.ajax({
					            url: urls,
					            type:"POST",
					            data:{
					                'types':'findOdds',
					            },
					            async: false,
					            dataType:'json',
					            success: function (data) {
					            //console.log(data);
					            	var html='';
					       			if(data.code==200){
					       				html+='<tr class="xiazhukuang2"><td>号码</td><td>赔率</td><td class="fh">号码</td><td class="fh">赔率</td><td>号码</td><td>赔率</td><td class="fh">号码</td><td class="fh">赔率</td><td>号码</td><td>赔率</td></tr>';
					       				html+=data.data;
					       			}
					       			$('#frankList').html(html);
					            }

					        });
						}else if(activeTab=='tab_import') {
							$(".main_main").addClass("main_main_no");
							$("#fileinput").val("");
							var sfile = $("#fileinput");
							sfile.after(sfile.clone().val("")); 
							sfile.remove();
							//jsonAjax("appindexajax.php","get", "action=import&doaction=init", "json", cgImport.GetImport);
						}else if(activeTab=='tab_rule') {
							$(".main_main").addClass("main_main_no");
							if(cgOrber.caizhongselect==2){
								$("#rule_w6").hide();
								$("#rule_w7").hide();
								$("#rule_6").hide();
								$("#rule_7").hide();
								$("#rule_name").text(cgOrber.caizhongarr[2]);
								$("#rule_name_0").text("“五位数”的每注彩票由00000-99999中的任意5位自然数排列而成。");
								$("#rule_name2").text("“"+cgOrber.caizhongarr[2]+"”每天开奖一次");
							}else{
								$("#rule_name").text(cgOrber.caizhongarr[1]);
								$("#rule_name_0").text(" “七位数”的每注彩票由0000000-9999999中的任意7位自然数排列而成。");
								$("#rule_name2").text("“"+cgOrber.caizhongarr[1]+"”每周开奖三次");
							}
						}else if(activeTab=='tab_kuaixuan') {
							$(".main_main").addClass("main_main_kuaixuan");
							setTimeout("$('#selectlogsclassid').val(1);",100);
							setTimeout("cgSelect.__showmeun(1);",100);
							setTimeout("$('.main_right').scrollTop(0)",100);

							//jsonAjax("appindexajax.php","get", "action=soonselect&logid="+cgSelect.logid, "json", cgSelect.GetSoonSelect);
						}else if(activeTab!='tab_kuaida') {
							$(".main_main").addClass("main_main_no"); 
						}
						setTimeout("$('.main_center').scrollTop(0)",100);
						if($(activeTab)) $("#"+activeTab).show();//$("#"+activeTab).fadeIn();
					}

				}
				
			}


		});
		/*滚动事件
		$('.gun').unbind('click').click(function(){
			jsonAjax("appnews.php","get", "action=newsread", "json", cgOrber.GetNews);
		});*/
		$('#stopnumberBtnPrint').unbind('click').click(function(){
			var s_issueon=$("#s_issueon").val();
			jsonAjax("appindexajax.php","get", "action=stopnumberrefresh&doaction=print&s_issueon="+s_issueon, "json", cgStopNumber.getPrintData);
		});


		/*下注框事件 全选*/
		cgOrber.init();
		/*下注事件*/
		cgCheckSend.init();
		/*快选*/
		cgSelect.init();
		/*明细*/
		cgDetail.init();
		/*会员*/
		cgMember.init();
		/*密码*/
		cgPass.init();
		/*二字定*/
		cgErZiDing.init();
		/*导入*/
		cgImport.init();
		cgLogs.init();
		/*main*/
		//本期停押号码
		arrHaoma();
		delHaoma();
		jsonAjax("/Index/xiazhukuang","get", "action=soonorder"+ "&time=" + new Date().getMilliseconds(), "json", cgOrber.GetSoonOrder);
		 //startTime();//newsinfo();
		//setInterval("newsinfo()",60000);
		 PageSetup_Null();

	});

  </script>
<script>
	  //类型
  function childclick(e){
  	 cgErZiDing.mBiShu = 0;
     $('#rdcount').text('0');//笔数
      $('#rdmoney').text('0');//金额
    var type1=$('#moshi1').val();
    //quxiao();
    $('#rdclassname a').removeClass('active');
    $('#'+e).attr('class','active');
    if(e ==102){
      $('#rzd_qian').text('千');
      $('#rzd_shi').text('百');
    }else if(e ==101){
      $('#rzd_qian').text('千');
      $('#rzd_shi').text('十');
    }else if(e ==100){
      $('#rzd_qian').text('千');
      $('#rzd_shi').text('个');
    }else if(e ==98){
      $('#rzd_qian').text('百');
      $('#rzd_shi').text('十');
    }else if(e ==99){
      $('#rzd_qian').text('百');
      $('#rzd_shi').text('个');
    }else if(e ==97){
      $('#rzd_qian').text('十');
      $('#rzd_shi').text('个');
    }
     //console.log(cc);
    // alert(hover_indexs);
    // $('#rdclassname').find("a:eq("+hover_indexs+")").addClass('active');
     if(type1==1){
        $('.rdrow').hide();
      }else{
        $('.rdrow').show();
      }
    var urls="/Index/findTypes1";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'types':e,
                'type':type1,
            },
            async: false,
            dataType:'json',
          success: function (data) {
            //console.log(data);
            $('#erzidingList').html(data);

            $('.rdcol').click(function(){
              var hover_index = $(this).parent().index();
              var hover_indexs = $(this).index();
              //alert(hover_indexs)
              //$("#erzidingList").find("tr:eq("+hover_index+") td").addClass("hover");
       
              $(this).parent("tr").find("td").each(function() {
                if(($(this).attr('class')=='success') || ($(this).attr('class')=='rdcol success')){
                  $(this).removeClass("success")
                }else{

                  $(this).addClass("success")
                }
                        
              })

              $("#erzidingList tr").find("td:eq(0)").removeClass("success");
              // var sums=getElementsByClassName("success");
              //   sums=sums.length;
              var m = $("#erzidingmoney").val();
              if(m>0){
                //$("#rdmoney").text(sums * m)
              }
               // $("#rdcount").text(sums)
            });

              // if(data.code==true){
              //   returns=true;
              // }else{
              //   returns=false;
              //   $('#odds').text(data.datas.co_loss1);
              //   $('#kexia').text(data.datas.co_limit);
              //   $('input[name="odds"]').val(data.datas.co_loss1);
              //   $('input[name="limit"]').val(data.datas.co_limit);

              // }
            }

          });
  }



  //模式选择
    $('#moshi1').click(function(){
    	 cgErZiDing.mBiShu = 0;
      //quxiao();
      $('#rdcount').text('0');//笔数
      $('#rdmoney').text('0');//金额
      var types=$(this).val();
      if(types==1){
        $(this).val('2');
        $(this).text('模式2');
        var types1=$('#rdclassname .active').attr('id');
        //types1=types1.slice(3);
        types=2;
        $('.rdrow').show();
        $('#erzidingcanshu').show();
        $('#erzidingqueding').hide();
        $('.rdImgtitle').html('<td> </td><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th><th><div class="rdL">号码</div><div class="rdR">赔率</div></th></tr>');
        $('.rdmoney').html('金额<input type="text" id="erzidingmoney" name="erzidingmoney" onkeyup="moneys(this)" maxlength="4"><button id="serziding_but" class="btn" type="button">下注</button><button id="serziding_quxiao" class="btn" type="button">取消</button>');
        
      }else{
        $(this).val('1');
        $(this).text('模式1');
        var types1=$('#rdclassname .active').attr('id');
        //types1=types1.slice(3);
       
        types=1;
        $('.rdrow').hide();
        $('#erzidingcanshu').hide();
        $('#erzidingqueding').show();
        $('.rdImgtitle').html('<th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th><th><div class="rdL">号码</div><div class="rdR">金额</div></th></tr>');
        $('.rdmoney').html('');
      }
      var urls="/Index/findTypes1";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'types':types1,
                'type':types,
            },
            async: false,
            dataType:'json',
          success: function (data) {
            //console.log(data);
            $('#erzidingList').html(data);

            }

          });
        //选项
            // $('.rdcol').click(function(){
            //   var hover_index = $(this).parent().index();
            //   var hover_indexs = $(this).index();
            //   //alert(hover_indexs)
            //   //$("#erzidingList").find("tr:eq("+hover_index+") td").addClass("hover");
              
            //   $(this).parent("tr").find("td").each(function() {
            //     if(($(this).attr('class')=='success') || ($(this).attr('class')=='rdcol success')){
            //       $(this).removeClass("success")
            //     }else{

            //       $(this).addClass("success")
            //     }
                        
            //   })
            //   $("#erzidingList tr").find("td:eq(0)").removeClass("success");
            //   var sums=getElementsByClassName("success");
            //     sums=sums.length;
            //   var m = $("#erzidingmoney").val();
            //   if(m>0){
            //     $("#rdmoney").text(sums * m)
            //   }
            //     $("#rdcount").text(sums)
            // });



    });
    function findOdds(e){
    	 $('#frankhotname a').removeClass('active');
    	// $(this).addclass('active');
    	var urls="/Index/findOdds";
        $.ajax({
            url: urls,
            type:"POST",
            data:{
                'types':'findOdds',
                'type':e,
            },
            async: false,
            dataType:'json',
            success: function (data) {
            //console.log(data);
            	var html='';
       			if(data.code==200){
       				html+='<tr class="xiazhukuang2"><td>号码</td><td>赔率</td><td class="fh">号码</td><td class="fh">赔率</td><td>号码</td><td>赔率</td><td class="fh">号码</td><td class="fh">赔率</td><td>号码</td><td>赔率</td></tr>';
       				html+=data.data;
       			}
       			$('#frankList').html(html);
            }

        });
    }
</script>
  
<div id="xp" style="position: absolute; z-index: 9000; overflow: hidden; border: 0px solid rgb(255, 0, 0); width: 260px; height: 190px; left: 1087px; top: 500px;"><div id="xp_content" style="position: absolute; z-index: 1; overflow: hidden; border-width: 0px; width: 260px; height: 190px; left: 0px; top: 0px;"><a id="closeButton" href="#" style="position: absolute; z-index: 2; font-size: 0px; line-height: 0px; left: 240px; top: 6px; width: 15px; height: 15px; background-image: url(&quot;/Public/images/close.gif&quot;);"></a><a id="switchButton" href="#" style="position: absolute; z-index: 2; font-size: 0px; line-height: 0px; left: 220px; top: 6px; width: 15px; height: 15px; background-image: url(&quot;/Public/images/min.gif&quot;);"></a><div class="blogrecommend"><div class="BR_title"></div><div class="BR_conts"><?php echo ($news1['n_content']); ?></div></div></div></div>
<script type="text/javascript">
	$('#closeButton').click(function(){
		$('#xp').hide();
	});
	$('#switchButton').click(function(){
		//alert($('#xp').css('top'));
		if($('#xp').css('top')=='500px'){
			$('#xp').css('top','630px');
		}else{
			$('#xp').css('top','500px');
		}
		
	});
	   var maxTime =3600;// seconds
        var time = maxTime;
        $('body').on('keydown mousemove mousedown',function(e){
        time = maxTime;// reset
        });
        var intervalId = setInterval(function(){
        time--;
        if(time <=0){
        ShowInvalidLoginMessage();
        clearInterval(intervalId);
        }
        },1000)
        function ShowInvalidLoginMessage(){
        // 清除cookie
        // 提示用户
        // 该干嘛干嘛
        //alert('那么长时间没动弹，退出喽！');
            tuichu();
            alert('长时间没有操作，退出系统！');
            //$(".notic").html('长时间没有操作，退出系统！');
            //$(".notic").fadeIn().delay(1000).fadeOut();
            window.location.href="/Login/index"; 
        }
        function tuichu(){
        	$.ajax({
              type: "post",
              url: "/Login/retreats1",
              dataType: "json",
              data: {
              },
              success: function(msg){
              	
              }
            });	
        }
        
</script>
<style>
	.table {
    font-size: 12px;
	}
</style>

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
  z-index: 999;
}
</style>  
</body></html>