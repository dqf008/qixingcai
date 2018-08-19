 /**
 * jQuery JorderPirnt  2017-4-19 
 */
function LeftPrintInit (t,data){
	$('#'+t).JOP(data);
}
(function($,window) {

    $.fn.JOP = function(options) {
        var settings = {
            data       : {},
            title   : "",
            swidth           : 178,
            _sid           : "",
            _ziyou           : "",
            IN_WAPCG       : 0,
            getIsPC       : 0,
            caizhong       : 1,
            container       : window
        };
                
        if(options) {
            $.extend(settings, options);
        }
		$.JOP.bodyhtml(this,settings);
		$.JOP.iniPage(0,settings.data);
		return this;
    };

	$.JOP = {
		_my_print:"",
		ajaxurl:"",
		IN_WAPCG:0,
        printnum:0,//0时候在js中控制清空小票
        caizhong : 1,
		orderlistID:"#JOPTab #orderlist",
		bodyhtml:function(t,settings){
			//this._my_print = settings._ziyou + "_my_print";
			this.IN_WAPCG=settings.IN_WAPCG;
			this.getIsPC=settings.getIsPC;
			this.ajaxurl=this.IN_WAPCG==1?"wap_ajax.php":"ajax.php";
			
			var setwidth=settings.swidth;
			var _sid='';
			var html='';
			onclick1=' ';
			onclick2=' ';
			html += '<table id="JOPTab" width="'+setwidth+'" border="0" style="text-align: left;  background: #FFFFFF;"  cellpadding="0" cellspacing="0" >';
			html += '<tr><td >';
			if(this.IN_WAPCG==1){
				//html += '<input type=button value="关闭打印" name="printclose" id="printclose" class="Noprint">';
			}else{
				html += '<input type=button value="设置图示" name="printpre" id="printpre" class="printbut Noprint">';
			}
			html += '<input type="hidden" name="printstat" id="printstat" class="Noprint">';
			html += '<input type="hidden" name="sorderid" id="sorderid" class="Noprint">';
			html += '<input type="hidden" name="_oidstr" id="_oidstr" class="Noprint">';
			html += '<table width="100%" border="0" cellspacing="0" cellpadding="0">'; 
			html += '<tr><td style="text-align:right;font-size:15px;">单位：元</td></tr>';
			html += '</table>';
			var strcaizhong="";
			if(settings.caizhong==2){
				strcaizhong = "排列5";
			}else{
				strcaizhong = "七星彩";
			}
			html += '<table  align="center" width="'+setwidth+'" cellpadding="0" cellspacing="0" class="tablebprint4" style="margin-bottom: 2px !important;">';
			html += '  <tr><td colspan=3 class="print2" style="text-align:center;color:red;font-size:18px;">'+strcaizhong+'</td></tr>';
			html += '  <tr><td colspan=3 class="print3">时间:<span id="_datetime"></span><br>会员:<span id="_user"></span><br>编号:<span id="_orderid"></span></td></tr>';
			html += '  <tr class="print2"><td style="text-align:center;">号码</td><td style="text-align:center;">赔率</td><td style="text-align:center;">金额</td></tr>';
			html += '   <tbody id="orderlist"></tbody>';
			html += '   <tr class="print5">';
			html += '    <td colspan=3 >笔数<span id="_bscount"></span> 总金额<span id="_allmoney"></span></td>';
			html += '  </tr>'; 
			if(this.IN_WAPCG!=1){
			html += '  <tr>';
			html += '    <td align=center style="text-align:center;" class="Noprint" colspan=3 >';
			html += ' <input  class="printbut Noprint" type=button name="numClear" id="numClear" value="清 空">';
			html += ' &nbsp;&nbsp;&nbsp;&nbsp;';
			html += ' <input  class="printbut Noprint" type=button name="numprint" id="numprint" value="打 印"></td>';//'+onclick1+'
			html += '     </tr>';
			}
			html += '</table><span style="font-size:15px;">第 <span id="_issueno_now"></span> 期,3天內有效!!</span>';
			html += '	</td><tr>';
			html += '   <tbody id="orderpage" style="display:none;">';
			html += '<tr class="Noprint" ><td style="font-size:15px;" colspan=3><b>总笔数<font color=red><span id="_z_bscount"></span></font> 总金额<font color=red><span id="_z_allmoney"></span></font><b></td><tr>';
			html += '<tr class="Noprint" ><td style="font-size:15px;" colspan=3><span id="_z_page"></span></td><tr></tbody>';
			html += '</table> <br><span id="testdate" class="Noprint" style="display:none;"></span>';

			t.append(html);
			


			$("#printpre").unbind('click').click(function(){ 
				if($.JOP.IN_WAPCG==9){
					window.parent.setprint();
				}else
				parent.main.location='index.php?action=membersetprint';
				return false;
			});
			$("#numClear").unbind('click').click(function(){ //清空
				$.JOP.PrintAjax("清空","./"+$.JOP.ajaxurl+"?action=soonprintstat",{inajax:1,sid:settings._sid},function (){ 
					$($.JOP.orderlistID).empty(); 
					$("#_datetime").text('');
					$("#_orderid").text('');
					$("#_bscount").text(0);
					$("#_allmoney").text(0);
					$("#sorderid").val('');
					$("#orderpage").hide();
					$("#_z_page").html('');
					$("#_z_bscount").text('');
					$("#_z_allmoney").text('');
					$("#printstat").val(0);
					$.JOP.printnum=0;
					$.JOP.focusnumber();
					
				});
				return false;
			});
			$("#numprint").unbind('click').click(function(){ //点击打印 
				var strid = $("#sorderid").val();
				var _oidstr = $("#_oidstr").val();
				var _printstat = $("#printstat").val();
				var _bscount = ($("#_bscount").text()-0);
				var orderpagestat=0;
				if($("#orderpage").is(":visible")){
					orderpagestat=1;
				}
				if(_printstat==1){
					if(window.confirm("你已经打印过该票，还要打印吗？")){
						$.JOP.PrintAjax("打印",'./'+$.JOP.ajaxurl+'?action=memberprintstat'+_oidstr+'',{"inajax":1,"sid":""+settings._sid+"","strid":""+strid+"","bscount":""+_bscount+"","orderpagestat":""+orderpagestat+""},function (){ 							
							//$.cookie($.JOP._my_print,1);
							$("#printstat").val(1);
							$.JOP.setprint();
							$.JOP.focusnumber();
							//if(orderpagestat==1)setTimeout("window.location.href='./index.php?action=left';",1000);
							return false;
						});
					}else{
						$.JOP.focusnumber();
						return false;
					}
				}else{ 
					$.JOP.PrintAjax("打印",'./'+$.JOP.ajaxurl+'?action=memberprintstat'+_oidstr+'',{"inajax":1,"sid":""+settings._sid+"","strid":""+strid+"","bscount":""+_bscount+"","orderpagestat":""+orderpagestat+""},function (){ 	
						//$.cookie($.JOP._my_print,1);
						$("#printstat").val(1);
						$.JOP.setprint();
						$.JOP.focusnumber();
						//if(orderpagestat==1)setTimeout("window.location.href='./index.php?action=left';",1000);
						return false;
					});
				}
				$.JOP.printnum=0;
				return false;
			});
		},
		focusnumber:function(){

		    if ($.JOP.IN_WAPCG === 0) {
		    	if(window.parent.frames["main"].frames["soonorder"])window.parent.frames["main"].frames["soonorder"].document.getElementById("number").select();
		    	setTimeout("window.document.body.scrollTop=window.document.body.scrollHeight;",300);
		    }else if ($.JOP.IN_WAPCG == 9) {
		    	setTimeout("$.JOP.Pload();",200);
		    	setTimeout('$.JOP.Pobj().find("#sendnumber").focus().select()',300);
		    	//setTimeout('$("#sendnumber").focus().select()',300);
		    }		
		},
		setprint:function(){
			/*if(this.IN_WAPCG==9){//appweb
				//$('#orderprint').jqprint({ operaSupport: true });  
			}else{
			}*/
			if(navigator.userAgent.indexOf('Firefox') >= 0){
				window.print();//在IE11上会小，只在火狐上用
			}else{
				document.execCommand("print", false, null);
			}			
			return false;

		},
		orderdata:function(){
			var joinstr={};
			joinstr=this._data;
			var str=joinstr['p'];
			var _orderid=str['o'];
			var _oid=str['oid'];
			var _datetime=str['d'];
			var _user=str['u'];
			var _sid=str['s'];
			var _issueno_now=str['i'];
			var _tradstat=str['t'];
			var setwidth=_tradstat==1?'181':'178';
			var _oidstr=_oid>0?'&oid='+_oid:'&orid='+_orderid;
			var nummoney=str['n'];
			var printstat=str['ps'];
			var strid='';
			var comm='';
			var html='';
			var Olist = $(this.orderlistID);
			
			var newstat=joinstr['s'];
			var pages=joinstr['pages'];
			var pagenum=str['n'][0];
			var gj='';//
			if($.JOP.printnum==0&&pagenum==1&&joinstr['j']!=null||newstat==0){
				Olist.empty();
				$("#_bscount").text('');//累加的 新操作要清空
				$("#_allmoney").text('');
				$("#sorderid").val('');
			}
			
			var getgj=str['j'];//打印内存中
			if(getgj==0||getgj==null||getgj==''||typeof(getgj) == 'undefined'){
				getgj=joinstr['j'];//获取单个快打放在打印中显示
			}
			gj=getgj;
			var strid='';
			var comm='';
			var _bscount = 0;
			var _allmoney = 0;
			var getstrid = $("#sorderid").val();
			for(j in gj){
				val=gj[j];
				if(getstrid.indexOf(val['id'])!=-1)continue;
				if(val['stattuima']==1)continue;
				statsizi = val['statsizi']==1  || val['classid']==6 || val['classid']==7 ? "<span class=\"soon_b_f3\" style=\"FONT-SIZE:15px;color:red;\">现</span>":"";
				var n = val['number']+statsizi;
				var f = val['frank'];
				var m = (val['money']-0);
				var seto ='';
				if(this.IN_WAPCG==9){
					seto = '<dd>'+val['orderid']+'</dd>';
					seto += '<dd>'+val['datetime']+'</dd>';
				}
				html += '    <tr id="o_'+val['id']+'" bgcolor="#ffffff" class="print2"  style="height:28px;line-height:19px;"> ';
				html += '       <td style="text-align:center;">'+n+'</td><td style="text-align:center;">1:'+f+'</td><td style="text-align:center;">'+m+''+seto+'</td>';
				html += '      </tr>  ';
				strid+=comm+''+val['id'];
				comm=',';
				_bscount++;
				$.JOP.printnum++;
				_allmoney=$.JOP.FloatAdd(_allmoney,m);
				
			}
			//console.log(newstat+'=' + $.JOP.printnum+'=');
			if(_bscount>0){
				Olist.append(html);	
				
				getstrid=getstrid!=''?getstrid+","+strid:strid;
				$("#sorderid").val(getstrid);//打印用
				$("#_oidstr").val(_oidstr);//打印用
				
				
				$("#_datetime").text(_datetime);
				$("#_orderid").text(_orderid);
				
				
				var get_bscount =  ($("#_bscount").text()-0) + (_bscount-0);
				var get_allmoney = $("#_allmoney").text()-0;
				get_allmoney = $.JOP.FloatAdd(_allmoney,get_allmoney);
				
				/*$(Olist).find("tr").each(function(i,d){
					var j = $(this).find("td:eq(2)").text()-0;
					_bscount ++;
					_allmoney = $.JOP.FloatAdd(_allmoney,j);

				});*/
				$("#_bscount").text(get_bscount);
				$("#_allmoney").text(get_allmoney);
				$("#_z_bscount").text(nummoney[0]);
				$("#_z_allmoney").text(nummoney[1]);
				$("#printstat").val(printstat);
			}
			$("#_issueno_now").text(_issueno_now);
			$("#_user").text(_user);
			if($.JOP.printnum>=500||$.JOP.iCurrPage>1||$("#printstat").val()==1)$.JOP.printnum=0;
			if(this.IN_WAPCG==9){//app_index_ajax
				setTimeout("$.JOP.Pload();",300);
				//setTimeout("window.document.body.scrollTop=window.document.body.scrollHeight;",300);
			 	//setTimeout("$('.main_left').scrollTop( $('.main_left')[0].scrollHeight )",300);
			}else{
				setTimeout("window.document.body.scrollTop=window.document.body.scrollHeight;",300);
			}

		},
		Pobj:function (){
			var o = $(window.parent.document);
			return o;
		},
		IsPC:function (){
			flag=0;
			var ua = navigator.userAgent.toLowerCase();	
			if (/iphone|ipad|ipod/.test(ua)) {
				flag=1;	
			}else if (/android/.test(ua)) {
				flag=2;	
			}
			return flag;
		},
		//iphone使用  main_left 滚动条
	   Pload:function (){
	   		if($.JOP.getIsPC==1){
			    var main = $.JOP.Pobj().find("#leftprint");
			    var thisheight = $('.main_left_print').height() - 0;//iframe高度
			    //thisheight =thisheight<300 ? 300 : thisheight;
			    //var mlheight = window.document.body.scrollHeight-0;
			    main.height(thisheight);
			    window.document.body.scrollTop=thisheight;//iframe指定到底部
			    $.JOP.Pobj().find('.main_left').scrollTop(thisheight);//滚动条指定到底部
			}else{
				window.document.body.scrollTop=window.document.body.scrollHeight;
			}

		    //console.log(thisheight + '=' + mlheight);
		},
		iniPage:function (iCurrPage,data){
			var type = $.type(data);
			this._data = type=='string'?eval('('+data+')'):data;
			 var iPageSize = 500;
			 if (this._data['p']==null||typeof(this._data['p']) == 'undefined') return false;
			 if (this._data['p']['n']==null||typeof(this._data['p']['n']) == 'undefined') return false;
			 var iProCount = this._data['p']['n'][0];
			 var b = ((iProCount%iPageSize)!=0);
			 var iPageCount = parseInt(iProCount/iPageSize)+(b?1:0);//页
			 if(iCurrPage==0)iCurrPage=iPageCount;
			 if (iCurrPage > iPageCount) return false;
			 iCurrPage = parseInt(iCurrPage);
			 this.pagestr='';
			 this.iCurrPage=iCurrPage;
			 
			 $("#orderpage").hide();
			 if(iPageCount==1){
			 }else if(iPageCount>1){
				 this.pagestr += "第";
				 for(var i=1;i<=iPageCount;i++){
				 	var css= (iCurrPage==i?"class=meunpage":"");
				 	this.pagestr += " <a href='Javascript:(function ($){$.JOP.PrintPage("+i+")})(jQuery)' "+css+">["+i+"]</a>";
				 }
				 this.pagestr += " 页";
				 $("#orderpage").show();
				 $("#_z_page").html(this.pagestr);
			 }
			 this.orderdata();

		},
		PrintPage:function (p){
			$.JOP.PrintPageAjax(p, "./"+$.JOP.ajaxurl+"?action=printshow&iCurrPage="+p);
		},
		PrintPageAjax:function (iCurrPage , url ){//点击分页
			$.ajax( {  
				 url:url,
			     data:{  inajax : 1},  
			     type:'get',
			     cache:false,  
			     dataType:'json',  
			     success:function(data) { 
			    	$($.JOP.orderlistID).empty();
			    	$($.JOP.orderlistID).html('');
					$("#_bscount").text('');//累加的 新操作要清空
					$("#_allmoney").text('');
					$("#sorderid").val('');
			    	 $.JOP.iniPage(iCurrPage,data);
			      },  
			      error : function() {  
			           alert("网络超时，请重新操作！");  
			      }  
			 });
		},//data : {  inajax : 1}
		PrintAjax:function (tit, url ,data ,callbackFunction){
			$.ajax( {  
				 url:url,
			     data:data,  
			     type:'post',
			     dataType:'json',
			     success:function(data) { 
			    	 
			    	 if(data[2]==1){
						 //alert("小票内容和明细内容不对等,请退码后重新下单再打印！");  
						 if($.JOP.IN_WAPCG==9){
							 location.href="./appprint.html";
						 }else{
							location.href="/?action=left";
						 }
				     }else if(data[0]==1){
			    		 callbackFunction();
			    		 $("#testdate").text(data[1]);
			    	 }else{
			    		 alert(tit+"失败，请重新操作！");  
			    	 }
			    	 
			      },  
			      error : function() {  
			           alert("网络超时，请重新操作！");  
			      }  
			 });
		},
		FloatAdd :function (arg1,arg2){  
			var r1,r2,m;  
			try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}  
			try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
			m=Math.pow(10,Math.max(r1,r2))  
			return (arg1*m+arg2*m)/m;
		}
	}
})(jQuery,window);
