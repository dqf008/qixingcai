<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	$utype=utype();
    	$data=news();
    	$this->assign('data',$data);
        $this->display();
    }
    //期号管理
	 public function mission(){
		//开奖任务配置信息
		$data=M('opentime')->order('id desc')->select();
		if($data){
			foreach($data as $k=>$v){
				$v['m_sales1']=json_decode($v['m_sales']);
				$v['m_loss1']=json_decode($v['m_loss']);
				$data[$k]=$v;
				$data[$k]['fengpan']=strtotime($v['fengpan']);
			}
			$status=$data[0]['m_status'];
		}

		$time=time();
		$this->assign('time',$time);
		$this->assign('data',$data);
		$this->assign('status',$status);
	 	$this->display();
	 }

	public function addMission(){
		$number=I('get.number');
		if(empty($number)){//修改操作
			$where['id']=$number;
		}else{
			$where['id']=$number;
		}
		//开奖任务配置信息
		$mission=M('opentime')->where($where)->find();

		if($mission){//1.开盘时间 2.封盘时间 3.开奖时间 
			$m_opening=explode(' ',$mission['kaipan']);
			$m_openings=explode('-',$m_opening[0]);
			$m_openings1=explode(':',$m_opening[1]);
			$m_seal=explode(' ',$mission['fengpan']);
			$m_seals=explode('-',$m_seal[0]);
			$m_seals1=explode(':',$m_seal[1]);
			$m_savetime=explode(' ',$mission['kaijiang']);
			$m_savetimes=explode('-',$m_savetime[0]);
			$m_savetimes1=explode(':',$m_savetime[1]);
			if($mission['m_sales']){
				$data2=json_decode($mission['m_sales']);
			}
			
			if($mission['m_loss']){
				$data3=json_decode($mission['m_loss']);
			}
			$mission['zt_status']=1;
		}else{//新建操作
			//1.得到上一期 2.得到当前时间
			$qishu=M('opentime')->field('qishu,m_sales,m_loss,4ding_xiane,2xian_xiane,3xian_xiane,4xian_xiane,2ding_xiane,3ding_xiane,m_odds')->order('id desc')->find();
			$m_opening=date('Y-m-d-H-i',time());
			$m_openings=explode('-',$m_opening);
			$m_seal=date('Y-m-d-H-i',time()+86400);
			$m_seals=explode('-',$m_seal);
			$m_savetime=date('Y-m-d-H-i',time()+170000);
			$m_savetimes=explode('-',$m_savetime);
			if($qishu['m_sales']){
				$data2=json_decode($qishu['m_sales']);
			}
			
			if($qishu['m_loss']){
				$data3=json_decode($qishu['m_loss']);
			}
			$qishu['qishu']=$qishu['qishu']+1;
			$qishu['zt_status']=2;
			$mission=$qishu;
		}
		$m=array(1,2,3,4,5,6,7,8,9,10,11,12);
		$d=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
		$h=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
		$f=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59);
		//$s=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59);
		//dump($f);

		$this->assign('m_openings',$m_openings);//开盘时间
		$this->assign('m_openings1',$m_openings1);//开盘时间
		$this->assign('m_seals',$m_seals);//封盘时间
		$this->assign('m_seals1',$m_seals1);//封盘时间
		$this->assign('m_savetimes',$m_savetimes);//开奖时间
		$this->assign('m_savetimes1',$m_savetimes1);//开奖时间
		$this->assign('data1',$mission);
		$this->assign('data2',$data2);
		$this->assign('data3',$data3);
		$this->assign('m',$m);
		$this->assign('d',$d);
		$this->assign('h',$h);
		$this->assign('f',$f);
		$this->assign('s',$s);
		$this->display();
	}
 //保存开奖任务信息
public function saveTask(){
	$mid=I('post.PeriodID');//任务ID
	//var_dump($_POST);exit;
	$m_opening1=I('post.StartYear');//年
	$m_opening2=I('post.StartMonth');//月
	$m_opening3=I('post.StartDay');//日
	$m_opening4=I('post.StartHour');//时
	$m_opening5=I('post.StartMinute');//分
	$data['kaipan']=($m_opening1.'-'.$m_opening2.'-'.$m_opening3.' '.$m_opening4.':'.$m_opening5);//（期号）开盘时间
	$m_openings1=I('post.CloseYear');//年
	$m_openings2=I('post.CloseMonth');//月
	$m_openings3=I('post.CloseDay');//日
	$m_openings4=I('post.CloseHour');//时
	$m_openings5=I('post.CloseMinute');//分
	$data['fengpan']=($m_openings1.'-'.$m_openings2.'-'.$m_openings3.' '.$m_openings4.':'.$m_openings5);//封盘时间
	$m_openin1=I('post.AwardYear');//年
	$m_openin2=I('post.AwardMonth');//月
	$m_openin3=I('post.AwardDay');//日
	$m_openin4=I('post.AwardHour');//时
	$m_openin5=I('post.AwardMinute');//分	
	$data['kaijiang']=($m_openin1.'-'.$m_openin2.'-'.$m_openin3.' '.$m_openin4.':'.$m_openin5);;//开奖时间
	//dump($data);exit;
	$weekarray=array("日","一","二","三","四","五","六"); //先定义一个数组
	//echo "星期".$weekarray[date("w")];
	$data['m_week']="星期".$weekarray[date("w",strtotime($data['kaijiang']))];//开奖星期
	// $weekarray=array("日","一","二","三","四","五","六");
	// echo "星期".$weekarray[date("w",strtotime("2011-11-11"))];
	$data['m_retreat']=I('post.DelMinute');//退码时间
	$data['m_remark']=I('post.Remark');//备注
	$uid=session('auid');//操作用户
	$data['au_id']=$uid;//操作用户
	$data['m_time']=time();
	//销售限制添加
	$TLimit1=I('post.TLimit1');//类型1（每码）
	$ALimit1=I('post.ALimit1');//类型1（单注）
	$TLimit2=I('post.TLimit2');//类型2（每码）
	$ALimit2=I('post.ALimit2');//类型2（单注）
	$TLimit3=I('post.TLimit3');//类型3（每码）
	$ALimit3=I('post.ALimit3');//类型3（单注）
	$TLimit4=I('post.TLimit4');//类型4（每码）
	$ALimit4=I('post.ALimit4');//类型4（单注）
	$TLimit5=I('post.TLimit5');//类型5（每码）
	$ALimit5=I('post.ALimit5');//类型5（单注）
	$TLimit6=I('post.TLimit6');//类型6（每码）
	$ALimit6=I('post.ALimit6');//类型6（单注）
	//最低下注金额
	$ALimits1=I('post.ALimits1');//类型1（单注）
	$ALimits2=I('post.ALimits2');//类型2（单注）
	$ALimits3=I('post.ALimits3');//类型3（单注）
	$ALimits4=I('post.ALimits4');//类型4（单注）
	$ALimits5=I('post.ALimits5');//类型5（单注）
	$ALimits6=I('post.ALimits6');//类型6（单注）

	//限售 1每码，2单注
    $sales['ding41']=$TLimit1;
    $sales['ding42']=$ALimit1;//四定
    $sales['ding43']=$ALimits1;//四定
    $sales['tong21']=$TLimit2;
    $sales['tong22']=$ALimit2;//二同
    $sales['tong23']=$ALimits2;//二同
    $sales['tong31']=$TLimit3;
    $sales['tong32']=$ALimit3;//三同
    $sales['tong33']=$ALimits3;//三同
    $sales['tong41']=$TLimit4;
    $sales['tong42']=$ALimit4;//四同
    $sales['tong43']=$ALimits4;//四同
    $sales['ding21']=$TLimit5;
    $sales['ding22']=$ALimit5;//二定
    $sales['ding23']=$ALimits5;//二定
    $sales['ding31']=$TLimit6;
    $sales['ding32']=$ALimit6;//三定
    $sales['ding33']=$ALimits6;//三定
    $data['m_sales']=json_encode($sales);

    //赔率调整添加
	$BScale1=I('post.BScale1');//类型1（初始赔率）
	$BValue1=I('post.BValue1');//类型1（赔率下降阀值）
	$BInc1=I('post.BInc1');//类型1（销售增量）
	$BStep1=I('post.BStep1');//类型1（赔率下调步长）

	$BScale21=I('post.BScale21');//类型2-1（初始赔率）
	$BValue21=I('post.BValue21');//类型2（赔率下降阀值）
	$BInc21=I('post.BInc21');//类型2-1（销售增量）
	$BStep21=I('post.BStep21');//类型2-1（赔率下调步长）
	$BScale22=I('post.BScale22');//类型2-2（初始赔率）
	$BValue22=I('post.BValue22');//类型2-2（赔率下降阀值）
	$BInc22=I('post.BInc22');//类型2-2（销售增量）
	$BStep22=I('post.BStep22');//类型2-2（赔率下调步长）

	$BScale31=I('post.BScale31');//类型3-1（初始赔率）
	$BValue31=I('post.BValue31');//类型3-1（赔率下降阀值）
	$BInc31=I('post.BInc31');//类型3-1（销售增量）
	$BStep31=I('post.BStep31');//类型3-1（赔率下调步长）
	$BScale32=I('post.BScale32');//类型3-2（初始赔率）
	$BValue32=I('post.BValue32');//类型3-2（赔率下降阀值）
	$BInc32=I('post.BInc32');//类型3-2（销售增量）
	$BStep32=I('post.BStep32');//类型3-2（赔率下调步长）
	$BScale33=I('post.BScale33');//类型3-3（初始赔率）
	$BValue33=I('post.BValue33');//类型3-3（赔率下降阀值）
	$BInc33=I('post.BInc33');//类型3-3（销售增量）
	$BStep33=I('post.BStep33');//类型3-3（赔率下调步长）

	$BScale41=I('post.BScale41');//类型4-1（初始赔率）
	$BValue41=I('post.BValue41');//类型4-1（赔率下降阀值）
	$BInc41=I('post.BInc41');//类型4-1（销售增量）
	$BStep41=I('post.BStep41');//类型4-1（赔率下调步长）
	$BScale42=I('post.BScale42');//类型4-2（初始赔率）
	$BValue42=I('post.BValue42');//类型4-2（赔率下降阀值）
	$BInc42=I('post.BInc42');//类型4-2（销售增量）
	$BStep42=I('post.BStep42');//类型4-2（赔率下调步长）
	$BScale43=I('post.BScale43');//类型4-3（初始赔率）
	$BValue43=I('post.BValue43');//类型4-3（赔率下降阀值）
	$BInc43=I('post.BInc43');//类型4-3（销售增量）
	$BStep43=I('post.BStep43');//类型4-3（赔率下调步长）
	$BScale44=I('post.BScale44');//类型4-4（初始赔率）
	$BValue44=I('post.BValue44');//类型4-4（赔率下降阀值）
	$BInc44=I('post.BInc44');//类型4-4（销售增量）
	$BStep44=I('post.BStep44');//类型4-4（赔率下调步长）
	$BScale45=I('post.BScale45');//类型4-5（初始赔率）
	$BValue45=I('post.BValue45');//类型4-5（赔率下降阀值）
	$BInc45=I('post.BInc45');//类型4-5（销售增量）
	$BStep45=I('post.BStep45');//类型4-5（赔率下调步长）

	$BScale5=I('post.BScale5');//类型5（初始赔率）
	$BValue5=I('post.BValue5');//类型5（赔率下降阀值）
	$BInc5=I('post.BInc5');//类型5（销售增量）
	$BStep5=I('post.BStep5');//类型5（赔率下调步长）

	$BScale6=I('post.BScale6');//类型6（初始赔率）
	$BValue6=I('post.BValue6');//类型6（赔率下降阀值）
	$BInc6=I('post.BInc6');//类型6（销售增量）
	$BStep6=I('post.BStep6');//类型6（赔率下调步长）

	 //赔率 1初始赔率2赔率下降阀值3销售增量4赔率下调步长
        $loss['ding41']=$BScale1;
        $loss['ding42']=$BValue1;
        $loss['ding43']=$BInc1;
        $loss['ding44']=$BStep1;//四定

        $loss['tong211']=$BScale21;
        $loss['tong212']=$BValue21;
        $loss['tong213']=$BInc21;
        $loss['tong214']=$BStep21;
        $loss['tong221']=$BScale22;
        $loss['tong222']=$BValue22;
        $loss['tong223']=$BInc22;
        $loss['tong224']=$BStep22;//二同

        $loss['tong311']=$BScale31;
        $loss['tong312']=$BValue31;
        $loss['tong313']=$BInc31;
        $loss['tong314']=$BStep31;
        $loss['tong321']=$BScale32;
        $loss['tong322']=$BValue32;
        $loss['tong323']=$BInc32;
        $loss['tong324']=$BStep32;
        $loss['tong331']=$BScale33;
        $loss['tong332']=$BValue33;
        $loss['tong333']=$BInc33;
        $loss['tong334']=$BStep33;//三同

        $loss['tong411']=$BScale41;
        $loss['tong412']=$BValue41;
        $loss['tong413']=$BInc41;
        $loss['tong414']=$BStep41;
        $loss['tong421']=$BScale42;
        $loss['tong422']=$BValue42;
        $loss['tong423']=$BInc42;
        $loss['tong424']=$BStep42;
        $loss['tong431']=$BScale43;
        $loss['tong432']=$BValue43;
        $loss['tong433']=$BInc43;
        $loss['tong434']=$BStep43;
        $loss['tong441']=$BScale44;
        $loss['tong442']=$BValue44;
        $loss['tong443']=$BInc44;
        $loss['tong444']=$BStep44;
        $loss['tong451']=$BScale45;
        $loss['tong452']=$BValue45;
        $loss['tong453']=$BInc45;
        $loss['tong454']=$BStep45;//四同

        $loss['ding21']=$BScale5;
        $loss['ding22']=$BValue5;
        $loss['ding23']=$BInc5;
        $loss['ding24']=$BStep5;//二定
        $loss['ding31']=$BScale6;
        $loss['ding32']=$BValue6;
        $loss['ding33']=$BInc6;
        $loss['ding34']=$BStep6;//三定
       $data['m_loss']=json_encode($loss);

       $data['2ding_xiane']=I('post.CheckType5');//开启销售
       $data['3ding_xiane']=I('post.CheckType6');
       $data['4ding_xiane']=I('post.CheckType1');
       $data['2xian_xiane']=I('post.CheckType2');
       $data['3xian_xiane']=I('post.CheckType3');
       $data['4xian_xiane']=I('post.CheckType4');
       $data['m_odds']=I('post.CheckAutoScale');//自动降赔率

	//开奖任务添加
	if(empty($mid)){
		$data['m_year']=I('post.Year');//年份
		$number=I('post.Period');//（期号）开奖期数
		$data['qishu']=$number;//（期号）开奖期数
		//dump($data);exit;
		$mission=M('opentime')->add($data);
	}else{
		$mission=M('opentime')->where(array('id'=>$mid))->save($data);
		$mission=1;	
	}
	if($mission){
      $arr=array('code'=>true,'titles'=>'保存成功','urls'=>'/Index/mission');
      $stats=json_encode($arr);   
    }else{
      $arr=array('code'=>false,'titles'=>'保存失败','urls'=>'/Index/mission');
      $stats=json_encode($arr);
          
	}
	echo $stats;
	//dump($data);exit;
	//$this->redirect('/Index/task',array('number'=>$mid));
	//$this->redirect('/Index/index');
}
//删除操作
public function dels(){
	$where['id']=I('post.inID');
	$opentime=M('opentime');
	$data=$opentime->where($where)->find();
	$mission=$opentime->where($where)->delete();
	if($mission){
		//删除下注号码
		$where1['qishu']=$data['qishu'];
		$dd=M('bet')->where($where1)->delete();
		$arr['code']=true;
	}else{
		$arr['code']=false;
	}
	$this->ajaxReturn($arr);
}
//开启
public function openStatus(){
	$where['id']=I('post.inID');
	$data['m_status']=1;
	$mission=M('opentime')->where($where)->save($data);
	if($mission){
		$arr['code']=true;
	}else{
		$arr['code']=false;
	}
	$this->ajaxReturn($arr);	
}
//关闭
public function openStatus1(){
	$where['id']=I('post.inID');
	$data['m_status']=2;
	$mission=M('opentime')->where($where)->save($data);
	if($mission){
		$arr['code']=true;
	}else{
		$arr['code']=false;
	}
	$this->ajaxReturn($arr);	
}
//退码页面
public function tuima(){
	$where['id']=I('get.id');
	$data=M('opentime')->field('qishu,id,m_retreat')->where($where)->find();

	$this->assign('data',$data);
	$this->display();
}
public function saveTuima(){
	$where['id']=I('post.mid');
	$data['m_retreat']=I('post.time');
	$dd=M('opentime')->where($where)->save($data);	
	//if(empty($dd)){
		$arr['code']=true;
		$arr['titles']='成功';
	// }else{
	// 	$arr['code']=false;
	// 	$arr['titles']='失败';
	// }
	$arr['urls']='/Index/mission';
	$this->ajaxReturn($arr);
}
//开奖页面
public function kaijiang(){
	$where['id']=I('get.id');
	$data=M('opentime')->field('qishu,id,m_ball1,m_ball2,m_ball3,m_ball4,m_ball5,m_ball6,m_ball7')->where($where)->find();

	$where1['qishu']=$data['qishu'];
	$where1['js']=0;
	$count=M('bet')->where($where1)->count('id');
	$sums=ceil($count/200000);
	$this->assign('sums',$sums);
	$this->assign('data',$data);
	$this->assign('haoma',$data['m_ball1'].$data['m_ball2'].$data['m_ball3'].$data['m_ball4'].$data['m_ball5'].$data['m_ball6'].$data['m_ball7']);
	$this->display();
}
public function saveKaijiang(){
	// $utype=session('utype');
	// dump($utype);exit;
	// if($utype!='admin' || $utype!='partner'){
	// 	echo '没有权限';exit;
	// }
	$where['id']=I('post.mid');
	$haoma=trim(I('post.haoma'));
	$sums1=I('post.sums');
	//dump($_POST);
	$haoma1=substr($haoma,0,1);
	$haoma2=substr($haoma,1,1);
	$haoma3=substr($haoma,2,1);
	$haoma4=substr($haoma,3,1);
	$haoma5=substr($haoma,4,1);
	$haoma6=substr($haoma,5,1);
	$haoma7=substr($haoma,6,1);
	$data['m_ball1']=$haoma1;
	$data['m_ball2']=$haoma2;
	$data['m_ball3']=$haoma3;
	$data['m_ball4']=$haoma4;
	$data['m_ball5']=$haoma5;
	$data['m_ball6']=$haoma6;
	$data['m_ball7']=$haoma7;
	if(strlen($haoma)<4){
		$arr['code']=true;
		$arr['titles']='开奖失败';
		$arr['urls']='/Index/mission';
		$this->ajaxReturn($arr);
		exit;
	}

	$data['m_status']=3;
	$opentimes=M('opentime');
	$mission=$opentimes->where($where)->save($data);
	$missions=$opentimes->field('qishu')->where($where)->find();
	//
	set_time_limit(0);
	//开奖下注号码出来
	$where1['qishu']=$missions['qishu'];
	$where1['js']=0;
	$bets=M('bet');
	//echo date('Y-m-d H:i:s').'<br/>';
	//$bet=$bets->field('id,mingxi_1,mingxi_2')->where($where1)->group('id')->select();
	//$count      = $bets->where($where1)->count('id');
	////////
	//echo $haoma1.'-->'.$haoma2.'-->'.$haoma3.'-->'.$haoma4;

	//开奖的同时算出中奖号码
	//二定匹配数组
	$ding2=array(
		0=>$haoma1.$haoma2.'XX',
		1=>$haoma1.'X'.$haoma3.'X',
		2=>$haoma1.'XX'.$haoma4,
		3=>'X'.$haoma2.$haoma3.'X',
		4=>'X'.$haoma2.'X'.$haoma4,
		5=>'XX'.$haoma3.$haoma4,
		);

	$ding3=array(
		0=>$haoma1.$haoma2.$haoma3.'X',
		1=>$haoma1.$haoma2.'X'.$haoma4,	
		2=>$haoma1.'X'.$haoma3.$haoma4,
		3=>'X'.$haoma2.$haoma3.$haoma4,
		);
	$xian21=$this->strings($haoma1.$haoma2);
	$xian22=$this->strings($haoma1.$haoma3);
	$xian23=$this->strings($haoma1.$haoma4);
	$xian24=$this->strings($haoma2.$haoma3);
	$xian25=$this->strings($haoma2.$haoma4);
	$xian26=$this->strings($haoma3.$haoma4);
	$xian2=array(
		0=>$xian21,
		1=>$xian22,
		2=>$xian23,
		3=>$xian24,
		4=>$xian25,
		5=>$xian26,
		);
	// $xian2=array(
	// 	0=>$haoma1.$haoma2,
	// 	1=>$haoma1.$haoma3,
	// 	2=>$haoma1.$haoma4,
	// 	3=>$haoma2.$haoma3,
	// 	4=>$haoma2.$haoma4,
	// 	5=>$haoma3.$haoma4,
	// 	);
	$xian31=$this->strings($haoma1.$haoma2.$haoma3);
	$xian32=$this->strings($haoma1.$haoma2.$haoma4);
	$xian33=$this->strings($haoma1.$haoma3.$haoma4);
	$xian34=$this->strings($haoma2.$haoma3.$haoma4);
	$xian3=array(
		0=>$xian31,
		1=>$xian32,
		2=>$xian33,
		3=>$xian34,
		);
	// $xian3=array(
	// 	0=>$haoma1.$haoma2.$haoma3,
	// 	1=>$haoma1.$haoma2.$haoma4,
	// 	2=>$haoma1.$haoma3.$haoma4,
	// 	3=>$haoma2.$haoma3.$haoma4,
	// 	);
	$arrs4=$haoma1.$haoma2.$haoma3.$haoma4;
	///////
	$page1=10;
	if($page1>1){
		switch ($sums1) {
			case '1':
				$sums=0;
				$sums2=20000;
				break;
			case '2':
				$sums=200000;
				$sums2=20000;
				break;
			case '3':
				$sums=400000;
				$sums2=20000;
				break;
			case '4':
				$sums=600000;
				$sums2=20000;
				break;
			case '5':
				$sums=800000;
				$sums2=20000;
				break;
			default:
				# code...
				break;
		}
		
		for($a=0;$a<$page1;$a++){
			
			if($a==0){
				$firstRow=$sums;
				$listRows=$sums2;
			}else{
				$firstRow=$sums+($a*$sums2);
				$listRows=$sums2;
			}
			
			$bet=$bets->field('id,mingxi_1,mingxi_2')->where($where1)->limit($firstRow.','.$listRows)->select();

			if(empty($bet)){
				break;
			}else{
				foreach($bet as $k=>$v){
					if($v['id']){
						$id=$this->kaijiangs($v['mingxi_1'],$v['mingxi_2'],$v['id'],$ding2,$ding3,$xian2,$xian3,$arrs4);
						if(!empty($id)){
						  $arrID.=$id.',';	
						}
						
					}
				}
				
				if(!empty($arrID)){
					$where2['id']=array('in',$arrID);
					$data2['status']=1;
					$bets->where($where2)->save($data2);
				}
				unset($bet);
			}
		}
		//$m=memory_get_usage(); //获取当前占用内存
	}

	// echo date('Y-m-d H:i:s').'==>'.$m;
	// exit;
	// if(!empty($bet)){
	// 	foreach($bet as $k=>$v){
	// 		if($v['id']){
	// 			$id=$this->kaijiangs($v['mingxi_1'],$v['mingxi_2'],$v['id'],$haoma);
	// 			if(!empty($id)){
	// 			  $arrID.=$id.',';	
	// 			}
				
	// 		}
	// 	}
		
	// 	if(!empty($arrID)){
	// 		$where2['id']=array('in',$arrID);
	// 		$data2['status']=1;
	// 		$bets->where($where2)->save($data2);
	// 	}
	// }
	



	$arr['code']=true;
	$arr['titles']='开奖成功';
	//$arr['urls']='/Index/mission';
	$this->ajaxReturn($arr);
}
//转换
   function strings($str){
     $str1=substr($str,0,1);
        $str2=substr($str,1,1);
        $str3=substr($str,2,1);
        $str4=substr($str,3,1);
        if(!empty($str1) || $str1=='0'){
            $arr[]=$str1;
        }
        if(!empty($str2) || $str2=='0'){
            $arr[]=$str2;
        }
        if(!empty($str3) || $str3=='0'){
            $arr[]=$str3;
        }
        if(!empty($str4) || $str4=='0'){
            $arr[]=$str4;
        }
        asort($arr);
        $string=implode('',$arr);
        return $string;
   }
//处理开奖
public function  kaijiangs($mingxi1,$mingxi2,$id,$ding2,$ding3,$xian2,$xian3,$arrs4){

	// $haoma1=substr($haoma,0,1);
	// $haoma2=substr($haoma,1,1);
	// $haoma3=substr($haoma,2,1);
	// $haoma4=substr($haoma,3,1);
	// $haoma5=substr($haoma,4,1);
	// $haoma6=substr($haoma,5,1);
	// $haoma7=substr($haoma,6,1);
	// //echo $haoma1.'-->'.$haoma2.'-->'.$haoma3.'-->'.$haoma4;

	// //开奖的同时算出中奖号码
	// //二定匹配数组
	// $ding2=array(
	// 	0=>$haoma1.$haoma2.'XX',
	// 	1=>$haoma1.'X'.$haoma3.'X',
	// 	2=>$haoma1.'XX'.$haoma4,
	// 	3=>'X'.$haoma2.$haoma3.'X',
	// 	4=>'X'.$haoma2.'X'.$haoma4,
	// 	5=>'XX'.$haoma3.$haoma4,
	// 	);

	// $ding3=array(
	// 	0=>$haoma1.$haoma2.$haoma3.'X',
	// 	1=>$haoma1.$haoma2.'X'.$haoma4,	
	// 	2=>$haoma1.'X'.$haoma3.$haoma4,
	// 	3=>'X'.$haoma2.$haoma3.$haoma4,
	// 	);
	// $xian21=$this->strings($haoma1.$haoma2);
	// $xian22=$this->strings($haoma1.$haoma3);
	// $xian23=$this->strings($haoma1.$haoma4);
	// $xian24=$this->strings($haoma2.$haoma3);
	// $xian25=$this->strings($haoma2.$haoma4);
	// $xian26=$this->strings($haoma3.$haoma4);
	// $xian2=array(
	// 	0=>$xian21,
	// 	1=>$xian22,
	// 	2=>$xian23,
	// 	3=>$xian24,
	// 	4=>$xian25,
	// 	5=>$xian26,
	// 	);
	// // $xian2=array(
	// // 	0=>$haoma1.$haoma2,
	// // 	1=>$haoma1.$haoma3,
	// // 	2=>$haoma1.$haoma4,
	// // 	3=>$haoma2.$haoma3,
	// // 	4=>$haoma2.$haoma4,
	// // 	5=>$haoma3.$haoma4,
	// // 	);
	// $xian31=$this->strings($haoma1.$haoma2.$haoma3);
	// $xian32=$this->strings($haoma1.$haoma2.$haoma4);
	// $xian33=$this->strings($haoma1.$haoma3.$haoma4);
	// $xian34=$this->strings($haoma2.$haoma3.$haoma4);
	// $xian3=array(
	// 	0=>$xian31,
	// 	1=>$xian32,
	// 	2=>$xian33,
	// 	3=>$xian34,
	// 	);
	// // $xian3=array(
	// // 	0=>$haoma1.$haoma2.$haoma3,
	// // 	1=>$haoma1.$haoma2.$haoma4,
	// // 	2=>$haoma1.$haoma3.$haoma4,
	// // 	3=>$haoma2.$haoma3.$haoma4,
	// // 	);
	// $arrs4=$haoma1.$haoma2.$haoma3.$haoma4;

		// if(empty($id) || empty($haoma)){
		// 	exit;
		// }
		// if(empty($id)){
		// 	exit;
		// }

		if($mingxi1=='2现'){
			if(in_array($this->strings($mingxi2),$xian2)){
				$mid=$id;
				return $mid;
			}
		}elseif($mingxi1=='3现'){
			if(in_array($this->strings($mingxi2),$xian3)){
				$mid=$id;
				return $mid;
			}
		}elseif($mingxi1=='2定'){
			if(in_array($mingxi2,$ding2)){
				$mid=$id;
					return $mid;
			}
		}elseif($mingxi1=='3定'){
			if(in_array($mingxi2,$ding3)){
				$mid=$id;
				return $mid;
			}
		}elseif($mingxi1=='4现'){
			if($this->strings($mingxi2)==$this->strings($arrs4)){
				$mid=$id;
				return $mid;
			}
		}elseif($mingxi1=='4定'){
			if($mingxi2==$arrs4){
				$mid=$id;
				return $mid;
			}
		}
	// unset($ding2);
	// unset($ding3);
	// unset($xian2);
	// unset($xian3);
	// unset($arrs4);
//switch ($mingxi1) {
		// 	case '2现':
		// 		if(in_array($this->strings($mingxi2),$xian2)){
		// 			$mid=$id;
		// 		}
		// 		break;
		// 	case '3现':
		// 		if(in_array($this->strings($mingxi2),$xian3)){
		// 			$mid=$id;
		// 		}
		// 		break;
		// 	case '2定':
		// 		if(in_array($mingxi2,$ding2)){
		// 			$mid=$id;
		// 		}
		// 		break;
		// 	case '3定':
		// 		if(in_array($mingxi2,$ding3)){
		// 			$mid=$id;
		// 		}
		// 		break;
		// 	case '4现':
		// 		if($this->strings($mingxi2)==$this->strings($arrs4)){
		// 			$mid=$id;
		// 		}
		// 		break;
		// 	case '4定':
		// 		if($mingxi2==$arrs4){
		// 			$mid=$id;
		// 		}
		// 		break;
		// 	default:
		// 		# code...
		// 		break;
		// }
		// return $mid;
}


/////////////////////////////////////////////////
public function findMarkets($arr,$id){
	if(!empty($arr) && !empty($id)){
		foreach($arr as $k=>$v){
			if($v['name']==$id){
				$status=$v['markets'];
				break;
			}
		}
	}
	return $status;
}
public function findMarkets1($arr,$id){
	if(!empty($arr) && !empty($id)){
		foreach($arr as $k=>$v){
			if($v['name']==$id){
				$status=$v['loss'];
				break;
			}
		}
	}
	return $status;
}


//号码赔率
public function odds(){
	//搜索条件 1.期号 2.类型


	//搜索条件 期数
    //搜索条件 1.类型2.号码排序 3.号码状态 4.号码全文搜索 
    $qishus=I('get.period');//期数ID
	$type=I('get.type');//号码类型
	$sort=I('get.sort');//号码排序
	$shows=I('get.show');//号码显示(状态)
	$find=I('get.find');//号码搜索
	$haoma=I('get.haoma');//号码
	$p=I('get.p');//号码
	
	$prohibit=M('prohibit');
	if($type==1){//四定
		$types='4定';
	}elseif($type==2){//两同
		$types='2现';
	}elseif($type==3){//三同
		$types='3现';
	}elseif($type==4){//四同
		$types='4现';
	}elseif($type==5){//两定
		$types='2定';
	}elseif($type==6){//三定
		$types='3定';
	}else{
		$types='4定';
	}
	
	//得到所有期数
	$qishu=qishus();//期数
	if(!empty($qishus)){
	  $where1['qishu']=$qishus;
	  $qishu1=$qishus;	
	}else{
	  $where1['qishu']=$qishu[0]['qishu'];
	  $qishu1=$qishu[0]['qishu'];			
	}

	// $wheres1['qishu']=$qishu1;
	// $wheres1['mingxi_1']=$types;
	// $wheres1['js']=0;
    //得到赔率和销售数
    $demo=M('opentime')->field('qishu,m_loss,m_sales')->where($where1)->find();
    if($demo){
    	$loss=json_decode($demo['m_loss']);
    	$market=json_decode($demo['m_sales']);
    	if(empty($type) || $type==1){//四定
			$market1=$market->ding41;
		}elseif(!empty($type) && $type==2){//二现
		    $market1=$market->tong21;
		}elseif(!empty($type) && $type==3){//三现
			$market1=$market->tong31;
		}elseif(!empty($type) && $type==4){//四现
		    $market1=$market->tong41;
		}elseif(!empty($type) && $type==5){//二定
		    $market1=$market->ding21;
		}elseif(!empty($type) && $type==6){//三定
		    $market1=$market->ding31;
		}
    }

	if(!empty($find)){//号码搜索是期数和类型存在
		$where['numbers']=array('like','%'.$find.'%');
		$sort1='';//号码排序
		$show1='';//号码显示(状态)
	}

	// if($sort==1){
	// 	$orders='id desc';
	// }else{
		//$orders='id asc';
	//}
   
    if($status){
        $status='';
    }
    if($haoma){
        $haoma='';
    }

    if(empty($type)){//默认号码类型
    	$where['type']=1;
    	$type=1;
    }else{
    	$where['type']=$type;	
    }


 	$bets=M('bet');
     //禁止销售
		$where12['qishu']=$qishu1;
     	$where12['p_type']=$type;
		$prohibit11=$prohibit->field('name')->where($where12)->select();
		if($prohibit11){
			foreach($prohibit11 as $k11=>$v11){
				$status11[]=$v11['name'];//数组
				$status1.=$v11['name'].',';
			}
		}
		//dump($prohibit11);
	//已销售的号码
	$wheres1['qishu']=$qishu1;
	$wheres1['mingxi_1']=$types;
	$wheres1['js']=0;
	$money=$bets->field('sum(money) as moneys,sum(topmoney) as topmoneys,mingxi_2')->where($wheres1)->group('mingxi_2')->select();
	if($money){
		foreach($money as $k22=>$v22){
			//$mingxi_2[]=$v11['mingxi_2'];//数组
			$mingxi_2.=$v22['mingxi_2'].',';
		}
	}
	//得到赔率和限售表(manters)
    $where11['qishu']=$qishu1;
    $where11['type']=$type;
    $markets=M('markets');
	$markets11=$markets->where($where11)->select();
	//dump($where11);
	if($markets11){
		foreach($markets11 as $k2=>$v2){
			//$mingxi_2[]=$v11['mingxi_2'];//数组
			$status2.=$v2['name'].',';
		}
	}
	// $orderid=I('get.orderid');
	// if(empty($orderid)){
	// 	$orders1='id';
	// 	$orders='id asc';
	// }else{
	// 	if($orderid=='asc'){
	// 		$orderid='desc';
	// 	}elseif($orderid=='desc'){
	// 		$orderid='asc';	
	// 	}
		

	// 	$orders=''.$orders1.$orderid.'';
	// }

 


	 //号码查询
    if($shows==1){//许售号码
      //得到改类型下所有禁止销售号码（除去这些号码）
      	
		$where['numbers']=array('not in',rtrim($status1,','));
    }elseif($shows==2){//禁售号码
    	$where['numbers']=array('in',rtrim($status1,','));
    }elseif($shows==3){//已售号码
    	$where['numbers']=array('in',rtrim($mingxi_2,','));
    	
    }elseif($shows==4){//未售号码
    	$where['numbers']=array('not in',rtrim($mingxi_2,','));
    }elseif($shows==5){//
    	$where['numbers']=array('in',rtrim($status2,','));
    }

    if($sort==2){//销售排序
    	$where['numbers']=array('in',rtrim($mingxi_2,','));
    }	

    //分页
    $numbers=M('number');
    $count      = $numbers->where($where)->count();
    $Page->parameter .= "&period=".$qishus; 
    $Page->parameter .= "&type=".$type; 
    $Page->parameter .= "&sort=".$sort; 
    $Page->parameter .= "&show=".$show; 
    $Page->parameter .= "&find=".$find; 
    $Page->parameter .= "&haoma=".$haoma; 

    $Page       = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    $show       = $Page->show();// 分页显示输出
    $pages=$count/500;
  
    //->order($orders)
    $number=$numbers->where($where)->order($orders)->limit($Page->firstRow.','.$Page->listRows)->select();

  	//号码排序，号码类型
    if($sort==1){//号码排序

    }elseif($sort==2){//销售排序
	if($shows==6){
		foreach($number as $k4=>$v4){
			$v4['topmoneys']=0;
			foreach($money as $k5=>$v5){
				if($v4['numbers']==$v5['mingxi_2']){
					$v4['topmoneys']=$v5['topmoneys'];
				}
				$number[$k4]=$v4;
			}
			 $id[$k4] = $v4['id'];
			 $price[$k4] = $v4['topmoneys'];
		}

		array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
	}else{
		foreach($number as $k4=>$v4){
			$v4['moneys']=0;
			foreach($money as $k5=>$v5){
				if($v4['numbers']==$v5['mingxi_2']){
					$v4['moneys']=$v5['moneys']-$v5['topmoneys'];
				}
				$number[$k4]=$v4;
			}
			 $id[$k4] = $v4['id'];
			 $price[$k4] = $v4['moneys'];
		}
		array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
		
	}
    	

			
    }elseif($sort==3){//赔率排序
    		foreach($number as $k4=>$v4){
	    			//$v4['moneys']=0;
	    			if($v4['type']==1){
			    		$loss1=$loss->ding41;
			    	}elseif($v4['type']==2){
			    		if($v4['types']==2){
			    			$loss1=$loss->tong211;
			    		}else{
			    			$loss1=$loss->tong221;
			    		}
			    	}elseif($v4['type']==3){
			    		if($v4['types']==2){
			    			$loss1=$loss->tong321;
			    		}elseif($v4['types']==3){
			    			$loss1=$loss->tong331;
			    		}else{
			    			$loss1=$loss->tong311;
			    		}
			    	}elseif($v4['type']==4){
			    		if($v4['types']==2){
			    			$loss1=$loss->tong411;
			    		}elseif($v4['types']==3){
			    			$loss1=$loss->tong421;
			    		}elseif($v4['types']==4){
			    			$loss1=$loss->tong431;
			    		}elseif($v4['types']==5){
			    			$loss1=$loss->tong441;
			    		}else{
			    			$loss1=$loss->tong451;
			    		}
			    	}elseif($v4['type']==5){
			    		$loss1=$loss->ding21;
			    	}elseif($v4['type']==6){
			    		$loss1=$loss->ding31;
			    		
			    	}
	    			$v4['loss']=$loss1;
	    			foreach($markets11 as $k15=>$v5){
	    				if($v4['numbers']==$v5['name'] && !empty($v5['loss'])){
	    					$v4['loss']=$v5['loss'];
	    				}
	    				$number[$k4]=$v4;
	    			}
	    			 $id[$k4] = $v4['id'];
	  				 $price[$k4] = $v4['loss'];
	    		}

			array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
    }elseif($sort==4){//销售排序
    		foreach($number as $k4=>$v4){
	    			$v4['topmoneys']=0;
	    			foreach($money as $k5=>$v5){
	    				if($v4['numbers']==$v5['mingxi_2']){
	    					$v4['topmoneys']=$v5['topmoneys'];
	    				}
	    				$number[$k4]=$v4;
	    			}
	    			 $id[$k4] = $v4['id'];
	  				 $price[$k4] = $v4['topmoneys'];
	    		}

			array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
			
    }





 //    if(!empty($number)){
 //    	// foreach($number as $k2=>$v2){
 //    	// 	$arrid.=$v2['numbers'].',';
 //    	// }
 //    	// $wheres1['mingxi_2']=array('in',rtrim($arrid,','));
	// 	$money=$bets->field('sum(money) as moneys,mingxi_2')->where($wheres1)->group('mingxi_2')->select();
	// 	//dump($money);
	// 	//得到赔率和限售表(manters)
 //     $where11['qishu']=$qishu1;
 //     $where11['type']=$where['type'];
 //    $markets=M('markets');
	// $markets11=$markets->where($where11)->select();
	// //禁止销售
	// $where12['qishu']=$qishu1;
 //     $where12['p_type']=$where['type'];
	// $prohibit11=$prohibit->where($where12)->select();
	// if($prohibit11){
	// 	foreach($prohibit11 as $k11=>$v11){
	// 		$status11[]=$v11['numbers'];
	// 	}

	// }

	// 	if(!empty($money) && $sort==2){//销售排序
	//     	//两个数组合并一个数组
	//     	//在(销售)排序在输出 
	//     	//判断1.禁止销售2.修改赔率和限售
	//     		foreach($number as $k4=>$v4){
	//     			$v4['moneys']=0;
	//     			foreach($money as $k5=>$v5){
	//     				if($v4['numbers']==$v5['mingxi_2']){
	//     					$v4['moneys']=$v5['moneys'];
	//     				}
	//     				$number[$k4]=$v4;
	//     			}
	//     			 $id[$k4] = $v4['id'];
	//   				 $price[$k4] = $v4['moneys'];
	//     		}

	// 		array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
	// 	}elseif(!empty($markets11) && $sort==3){
	// 		foreach($number as $k4=>$v4){
	//     			//$v4['moneys']=0;
	//     			if($v4['type']==1){
	// 		    		$loss1=$loss->ding41;
	// 		    	}elseif($v4['type']==2){
	// 		    		if($v4['types']==2){
	// 		    			$loss1=$loss->tong211;
	// 		    		}else{
	// 		    			$loss1=$loss->tong221;
	// 		    		}
	// 		    	}elseif($v4['type']==3){
	// 		    		if($v4['types']==2){
	// 		    			$loss1=$loss->tong311;
	// 		    		}elseif($v4['types']==3){
	// 		    			$loss1=$loss->tong321;
	// 		    		}else{
	// 		    			$loss1=$loss->tong331;
	// 		    		}
	// 		    	}elseif($v4['type']==4){
	// 		    		if($v4['types']==2){
	// 		    			$loss1=$loss->tong411;
	// 		    		}elseif($v4['types']==3){
	// 		    			$loss1=$loss->tong421;
	// 		    		}elseif($v4['types']==4){
	// 		    			$loss1=$loss->tong431;
	// 		    		}elseif($v4['types']==5){
	// 		    			$loss1=$loss->tong441;
	// 		    		}else{
	// 		    			$loss1=$loss->tong451;
	// 		    		}
	// 		    	}elseif($v4['type']==5){
	// 		    		$loss1=$loss->ding21;
	// 		    	}elseif($v4['type']==6){
	// 		    		$loss1=$loss->ding31;
			    		
	// 		    	}
	//     			$v4['loss']=$loss1;
	//     			foreach($markets11 as $k15=>$v5){
	//     				if($v4['numbers']==$v5['name'] && !empty($v5['loss'])){
	//     					$v4['loss']=$v5['loss'];
	//     				}
	//     				$number[$k4]=$v4;
	//     			}
	//     			 $id[$k4] = $v4['id'];
	//   				 $price[$k4] = $v4['loss'];
	//     		}

	// 		array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);

	// 	}
 //    }

    
   //  if(!empty($prohibit11) && $shows==1){//许售号码
   //  	foreach($number as $k6=>$v6){
	  //   			$v6['name']=0;
	  //   			foreach($prohibit11 as $k7=>$v7){
	  //   				if($v6['numbers']==$v7['name']){
	  //   					$v6['name']=$v6['name'];
	  //   				}
	  //   				$number[$k6]=$v6;
	  //   			}
	  //   			 $id[$k6] = $v6['id'];
	  // 				 $price[$k6] = $v6['name'];
	  //   		}

			// array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_DESC,$number);
   //  }elseif(!empty($prohibit11) && $shows==2){//禁售号码
   //  	foreach($number as $k6=>$v6){
	  //   			$v6['name']=0;
	  //   			foreach($prohibit11 as $k7=>$v7){
	  //   				if($v6['numbers']==$v7['name']){
	  //   					$v6['name']=$v7['name'];
	  //   				}
	  //   				$number[$k6]=$v6;
	  //   			}
	  //   			 $id[$k6] = $v6['id'];
	  // 				 $price[$k6] = $v6['name'];
	  //   		}

			// array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
   //  }elseif(!empty($money) && $shows==3){//已售号码
   //  	//两个数组合并一个数组
	  //   	//在(销售)排序在输出 
	  //   	//判断1.禁止销售2.修改赔率和限售
	  //   		foreach($number as $k6=>$v6){
	  //   			$v6['moneys']=0;
	  //   			foreach($money as $k7=>$v7){
	  //   				if($v6['numbers']==$v7['mingxi_2']){
	  //   					$v6['moneys']=$v7['moneys'];
	  //   				}
	  //   				$number[$k6]=$v6;
	  //   			}
	  //   			 $id[$k6] = $v6['id'];
	  // 				 $price[$k6] = $v6['moneys'];
	  //   		}

			// array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_ASC,$number);
   //  }elseif(!empty($money) && $shows==4){//未售号码
   //  	foreach($number as $k6=>$v6){
	  //   			$v6['moneys']=0;
	  //   			foreach($money as $k7=>$v7){
	  //   				if($v6['numbers']==$v7['mingxi_2']){
	  //   					$v6['moneys']=$v7['moneys'];
	  //   				}
	  //   				$number[$k6]=$v6;
	  //   			}
	  //   			 $id[$k6] = $v6['id'];
	  // 				 $price[$k6] = $v6['moneys'];
	  //   		}

			// array_multisort($price,SORT_NUMERIC,SORT_DESC,$id,SORT_STRING,SORT_DESC,$number);
   //  }elseif(!empty($money) && $shows==5){//特殊赔率

   //  }

    

	
	// dump($prohibit11);
 foreach(array_chunk($number, 5) as $val)
    {
    	$html.='<tr>';
        foreach($val as $v=>$a)
        {
        	//echo $v;
          switch ($v)
        {
        case 0:
          $id='A';
          break;
        case 1:
          $id='B';
          break;
        case 2:
          $id='C';
          break;
        case 3:
          $id='D';
          break;
        case 4:
          $id='E';
          break;
        default:
          //echo "No number between 1 and 3";
        }
        //echo $id;
    		$html.='<td width="24" height="28" align="center" bgcolor="#DDDDDD"><input name="NumID" type="checkbox" id="Num'.$id.$a['id'].'" class="NumID'.$id.'" value="'.$a['id'].'"></td>';
  			
    		$html.='<td width="24" height="28" align="center" bgcolor="#DDDDDD">';
    		if (in_array($a['id'], $status11))
			  {
			 $html.='<img src="/Public/index/PCheck0.png" width="16" height="16">';
			  }
			else
			  {
			  $html.='<img src="/Public/index/Num1B.png" width="16" height="16">';
			  }
    		

    		$html.='</td>';
    
    		$html.='<td width="55" height="28" align="center" bgcolor="#DDDDDD">'.$a['numbers'].'</td>';
    		$markets12=$this->findMarkets($markets11,$a['numbers']);
    		if($markets12){
    			$html.='<td width="45" height="28" align="center" bgcolor="#FFFFFF">'.$markets12.'</td>';
    		}else{
    			$html.='<td width="45" height="28" align="center" bgcolor="#FFFFFF">'.$market1.'</td>';
    		}
    		// $wheres1['mingxi_2']=$a['numbers'];
    		// $money=$bets->where($wheres1)->sum('money');
    		if(!empty($money)){
    			foreach($money as $k1=>$v1){
    			if($v1['mingxi_2']==$a['numbers']){
					if($shows==6){
    					$moneys=$v1['topmoneys'];	
    				}else{
    					$moneys=$v1['moneys']-$v1['topmoneys'];
    				}
    				//$moneys=$v1['moneys']-$v1['topmoneys'];
    			}
    		}
    		}
    		
    		if(!empty($moneys)){
    		$html.='<td width="45" height="28" align="center" bgcolor="#FFFFFF">'.$moneys.'</td>';
    		}else{
    		$html.='<td width="45" height="28" align="center" bgcolor="#FFFFFF">0</td>';	
    		}
    		$moneys='';
    	if($a['type']==1){
    		$loss1=$loss->ding41;
    	}elseif($a['type']==2){
    		if($a['types']==2){
    			$loss1=$loss->tong211;
    		}else{
    			$loss1=$loss->tong221;
    		}
    		
    	}elseif($a['type']==3){
    		if($a['types']==2){
    			$loss1=$loss->tong321;
    		}elseif($a['types']==3){
    			$loss1=$loss->tong331;
    		}else{
    			$loss1=$loss->tong311;
    		}
    		
    	}elseif($a['type']==4){
    		if($a['types']==2){
    			$loss1=$loss->tong421;
    		}elseif($a['types']==3){
    			$loss1=$loss->tong441;
    		}elseif($a['types']==4){
    			$loss1=$loss->tong431;
    		}elseif($a['types']==5){
    			$loss1=$loss->tong451;
    		}else{
    			$loss1=$loss->tong411;
    		}
    		
    	}elseif($a['type']==5){
    		$loss1=$loss->ding21;
    		
    	}elseif($a['type']==6){
    		$loss1=$loss->ding31;
    		
    	}
    	$markets13=$this->findMarkets1($markets11,$a['numbers']);
    		if($markets13){
    			$html.='<td width="55" height="28" align="center" bgcolor="#FFFFFF">'.$markets13.'</td>';
    		}else{
    			$html.='<td width="55" height="28" align="center" bgcolor="#FFFFFF">'.$loss1.'</td>';
    		}

    		
        
        	//$html.='<td>'.$a['numbers'].'</td>';
        	// $html.='<td>';
            //echo $a['numbers'],"\t";
            $arr[][$v]=$a;
        }
        //echo '<br/>';
        $html.='</tr>';
    }

    //var_dump($where);
	///echo '<table>'.$html.'</table>'; 
	
	$this->assign('sort',$sort);//排序
	$this->assign('shows',$shows);//号码类型
	$this->assign('find',$find);//号码类型
	$this->assign('type',$type);//号码类型
	$this->assign('qishu',$qishu);//所有期数
	$this->assign('qishu1',$qishu1);//搜索默认期数ID
	$this->assign('data',$html);//页面数据显示
	$this->assign('count',$count);//数据count$pages
	$this->assign('show',$show);//分页显示
	$this->assign('pages',$pages);//所有页数
	$this->assign('p',$p);//所有页数
	$this->display();
}
 //禁止销售
 public function forbid(){
 	//搜索条件 1.类型2.号码排序 3.号码状态 4.号码全文搜索 
    $qishus=I('post.period');//期数ID
	$type=I('post.type');//号码类型
	$sort=I('post.sort');//号码排序
	$shows=I('post.show');//号码显示(状态)
	$find=I('post.find');//号码搜索
	$haoma=I('post.haoma');//sort
	//先删除
	$where['numbers']=array('in',$haoma);
	$where['qishus']=$qishus;
	$where['p_type']=$type;
	// var_dump($haoma);
	// var_dump($qishus);
	// exit;
    //删除号码操作
	if(!empty($haoma) && !empty($qishus)){
		//在添加
	     $prohibit=M('prohibit');
	    // $dd=$prohibit->where($where)->delete();

		//$haoma1=explode(',',rtrim($haoma,','));
		$where1['id']=array('in',rtrim($haoma,','));
		$where1['type']=$type;
	    $number=M('number')->field('id,numbers,type')->where($where1)->select();
		$data1['qishu']=$qishus;
		$data1['p_type']=$type;
		$data1['au_id']=session('auid');
		$data1['p_time']=time();
		//$data1['name']=1;
		//dump($haoma1);
		// for($a1=0;$a1<count($haoma1);$a1++){
		// 	if($haoma1[$a1]){
		// 		$data1['numbers']=$haoma1[$a1];
		// 		$dd=$prohibit->add($data1);	
		// 	}		
		// }
		if($number){
			foreach($number as $k=>$v){
				if($v['id']){
					$data1['numbers']=$v['id'];
					$data1['name']=$v['numbers'];
					$dd=$prohibit->add($data1);	
				}
			}
		}
	}
	$arr['urls']='/Index/odds';
	$arr['code']=200;
	$this->ajaxReturn($arr);
 }
 //允许销售
 public function forbid1(){
 	//搜索条件 1.类型2.号码排序 3.号码状态 4.号码全文搜索 
    $qishus=I('post.period');//期数ID
	$type=I('post.type');//号码类型
	$sort=I('post.sort');//号码排序
	$shows=I('post.show');//号码显示(状态)
	$find=I('post.find');//号码搜索
	$haoma=I('post.haoma');//sort
	//先删除

    //删除号码操作
	if(!empty($haoma) && !empty($qishus)){
		$where['id']=array('in',rtrim($haoma,','));
		$where1['p_type']=$type;
		$where1['qishu']=$qishus;
		$number=M('number')->field('numbers')->where($where)->select();
		if(!empty($number)){
			foreach($number as $k=>$v){
				$name.=$v['numbers'].',';
			}
			$where1['name']=array('in',rtrim($name,','));
			//var_dump($where1);exit;
			$dd=M('prohibit')->where($where1)->delete();
		}
	    
	
	}
	$arr['urls']='/Index/odds';
	$arr['code']=200;
	$this->ajaxReturn($arr);
 }
 //修改号码销售
 public function sales(){
 	$where['id']=I('get.haoma');
 	$qishu=I('get.qishu');
 	$data=M('number')->where($where)->find();
 	$this->assign('haoma',$data['numbers']);
 	$this->assign('nid',$data['id']);
 	$this->assign('type',$data['type']);
 	$this->assign('qishu',$qishu);
 	$this->display();
 }
  //修改号码销售
 public function findOdd(){
 	$where['id']=I('get.haoma');
 	$qishu=I('get.qishu');
 	$data=M('number')->where($where)->find();
 	$this->assign('haoma',$data['numbers']);
 	$this->assign('nid',$data['id']);
 	$this->assign('type',$data['type']);
 	$this->assign('qishu',$qishu);
 	$this->display();
 }
 //保存操作
 public function saveSales(){
 	$qishu=I('post.qishu');
 	$haoma=I('post.haoma');
 	$sum=I('post.sum');
 	$type=I('post.type');
 	$nid=I('post.nid');
 	$where['name']=$haoma;//号码
 	$where['qishu']=$qishu;//期数
	$where['type']=$type;//号码类型
	//$where['n_id']=$nid;//号码类型
	$markets=M('markets');
	$markets1=$markets->where($where)->find();
	if($type==5){
 		$types=$this->findHaoma($haoma);
 		$data1['types']=$types[1];
 	}elseif($type==6){
 		$types=$this->findHaoma($haoma);
 		$data1['types']=$types[1];
 	}
 	if(!empty($markets1)){
 		$data['markets']=$sum;//该码销售数
 		$markets1=$markets->where($where)->save($data);
 	}else{
 		$data1['qishu']=$qishu;//期数
		$data1['type']=$type;//号码类型
		$data1['n_id']=$nid;//号码类型
		// $data1['auid']=session('auid');
		$data1['time']=time();
	 	$data1['markets']=$sum;//该码销售数
	 	$data1['name']=$haoma;//号码
		$dd=$markets->add($data1);
 	}
	
 	$arr['urls']='/Index/odds';
 	$arr['code']=200;
	$this->ajaxReturn($arr);
 }
 //保存操作
 public function saveOdds(){
 	$qishu=I('post.qishu');
 	$haoma=I('post.haoma');
 	$sum=I('post.sum');
 	$type=I('post.type');
 	$nid=I('post.nid');
 	$where['name']=$haoma;//号码
 	$where['qishu']=$qishu;//期数
	$where['type']=$type;//号码类型
	//$where['n_id']=$nid;//号码类型
	$markets=M('markets');
	$markets1=$markets->where($where)->find();
	if($type==5){
 		$types=$this->findHaoma($haoma);
 		$data1['types']=$types[1];
 	}elseif($type==6){
 		$types=$this->findHaoma($haoma);
 		$data1['types']=$types[1];
 	}
 	if(!empty($markets1)){
 		$data['loss']=$sum;//该码销售数
 		$markets1=$markets->where($where)->save($data);
 	}else{
 		$data1['qishu']=$qishu;//期数
		$data1['type']=$type;//号码类型
		$data1['n_id']=$nid;//号码类型
		// $data1['auid']=session('auid');
		$data1['time']=time();
	 	$data1['loss']=$sum;//该码销售数
	 	$data1['name']=$haoma;//号码
                $data1['types'] = '';
		$dd=$markets->add($data1);
 	}
	
 	$arr['urls']='/Index/odds';
 	$arr['code']=200;
	$this->ajaxReturn($arr);
 }

//批量操作页面
public function priceAll(){
	$type=I('get.type');
	$types=I('get.types');
	$qishu=I('get.qishu');

	$this->assign('qishu',$qishu);
	$this->assign('type',$type);
	$this->assign('types',$types);
	$this->display();
}
//保存批量操作数据
public function saveData(){
	$type=I('post.type');
	$type1=I('post.type1');
	$qishu=I('post.qishu');
	$sum=I('post.sum');
	$haoma=I('post.strNumText');
	$arr=explode("\n",$haoma);
	$data=$this->getArrs($arr);
	//dump($data);exit;

	$haoma1=explode(',',rtrim($data,','));
	if($type1==1 || $type1==4){
		$type2=4;
	}else{
		$type2=$type1;
	}
	//var_dump($haoma1);exit;
	if($haoma1){
		for($e=0;$e<count($haoma1);$e++){
			//$array.=$this->findHaoma($haoma1[$e]).'===>'.$type1.'<br/>';
			$name.=$haoma1[$e].',';
		 	$types=$this->findHaoma($haoma1[$e]);

			if($types[0]!=$type2){
				$status=1;
				break;
					
			}		
		}
	}
	if(!empty($status)){
		$arr1['titles']='类型不对,请从新填写!';
		$arr1['urls']='/Index/odds';
 		$arr1['code']=200;
		$this->ajaxReturn($arr1);exit;
	}
	$where['qishu']=$qishu;
	//echo $data;exit;
	if($type==1){//禁售
		$prohibit=M('prohibit');
		$wheres11['qishu']=	$qishu;
		$wheres11['p_type']= $type1;
		$data1['qishu']=$qishu;
		$data1['p_type']=$type1;
		$data1['au_id']=session('auid');
		$data1['p_time']=time();
		$data1['numbers']=1;
		for($a1=0;$a1<count($haoma1);$a1++){
			if($haoma1[$a1]){
				$wheres11['name']=$haoma1[$a1];
				$dd1=$prohibit->where($wheres11)->find();
				if(empty($dd1)){
					$data1['name']=$haoma1[$a1];
					$dd=$prohibit->add($data1);
				}
					
			}		
		}
	}elseif($type==2){//允许销售
		$prohibit=M('prohibit');	
		$where1['qishu']=$qishu;
		$where1['p_type']=$type1;
		$where1['name']=array('in',rtrim($name,','));
		$dd=$prohibit->where($where1)->delete();
		//$data1['au_id']=session('auid');
		//$data1['p_time']=time();
		//$data1['numbers']=1;
		// for($a1=0;$a1<count($haoma1);$a1++){
		// 	if($haoma1[$a1]){
		// 		$data1['name']=$haoma1[$a1];
		// 		$dd=$prohibit->add($data1);	
		// 	}		
		// }
	}elseif($type==3){//限售
		  	//$where['name']=array('in',$data);//号码

			$markets=M('markets');
			
		 		$data1['qishu']=$qishu;//期数
				$data1['type']=$type1;//号码类型
				
				$data1['n_id']=1;//号码类型
				// $data1['auid']=session('auid');
				$data1['time']=time();
			 	$data1['markets']=$sum;//该码销售数
			 	$where['type']=$type1;//号码类型
			 	for($a1=0;$a1<count($haoma1);$a1++){
					if($haoma1[$a1]){
						if($type1==5){
					 		$types=$this->findHaoma($haoma1[$a1]);
					 		$data1['types']=$types[1];
					 	}elseif($type1==6){
					 		$types=$this->findHaoma($haoma1[$a1]);
					 		$data1['types']=$types[1];
					 	}
						$where['name']=$haoma1[$a1];//号码
						$markets1=$markets->where($where)->find();
					 	if(!empty($markets1)){
					 		$data2['markets']=$sum;//该码销售数
					 		$dd=$markets->where($where)->save($data2);
					 	}else{
					 		$data1['name']=$haoma1[$a1];//号码
							$dd=$markets->add($data1);	
					 	}
					 	
					}
				}
		
	}elseif($type==5){//赔率
			
			$markets=M('markets');
			

		 		$data1['qishu']=$qishu;//期数
				$data1['type']=$type1;//号码类型
				$data1['n_id']=1;//号码类型
				// $data1['auid']=session('auid');
				$data1['time']=time();
			 	$data1['loss']=$sum;//该码销售数
			 	$where['type']=$type1;//号码类型
			 	for($a1=0;$a1<count($haoma1);$a1++){
				if($haoma1[$a1]){
					if($type1==5){
				 		$types=$this->findHaoma($haoma1[$a1]);
				 		$data1['types']=$types[1];
				 	}elseif($type1==6){
				 		$types=$this->findHaoma($haoma1[$a1]);
				 		$data1['types']=$types[1];
				 	}
					$where['name']=$haoma1[$a1];//号码
					$markets1=$markets->where($where)->find();
				 	if(!empty($markets1)){
				 		$data2['loss']=$sum;//该码销售数
				 		$markets1=$markets->where($where)->save($data2);
				 	}else{
				 		$data1['name']=$haoma1[$a1];//号码
						$data1['types'] = '';
						$dd=$markets->add($data1);	
				 	}
				 	
				}}
		 
	}
	$arr1['titles']='成功';
	$arr1['urls']='/Index/odds';
 	$arr1['code']=200;
	$this->ajaxReturn($arr1);
}
		
	//处理数组
	public function getArrs($data){
		if(count($data)){
			for($a=0;$a<count($data);$a++){
				$arr=explode('	',$data[$a]);
				if(is_array($arr)){
					for($a1=0;$a1<count($arr);$a1++){
						if($arr[$a1]){
							$arr1.=$arr[$a1].',';
						}
						
					}
				}
				
			}
		}
		return $arr1;
	}

//轮动新闻
public function news(){
	$data=M('news')->select();
	//dump($data);
	$this->assign('data',$data);
	$this->display();
}
//编辑操作
public function addNews(){
	$where['n_id']=I('get.nid');
	$data=M('news')->where($where)->find();
	//dump($data);
	$this->assign('data',$data);
	$this->display();
}
//保存操作
public function saveNews(){
	$where['n_id']=I('post.nid');
	$data['n_content']=I('post.contents');
	$dd=M('news')->where($where)->save($data);

	$arr['titles']='成功';
	$arr['urls']='/Index/news';
 	$arr['code']=true;
	$this->ajaxReturn($arr);

}
//修改状态
public function auditUser(){
   $where['n_id']=I('post.nid');
   $status=I('post.status');
   if(!empty($status)){
   	$data['n_status']=$status;
	$dd=M('news')->where($where)->save($data);
   }
   $arr['titles']='成功';
	$arr['urls']='/Index/news';
 	$arr['code']=true;
	$this->ajaxReturn($arr);

}
        //公共方法得到改号码类型
  function findHaoma($num){
        $num1 = preg_replace("/X/", "", $num);//正则匹配替换
        $num_arr_x = explode('X' , $num);//分割
        $status=strstr($num,'X');//是否包含x
        //存在x,是定1.判断长度，2.除了x还有几位数，3.规整类型
        //现,1.判断长度，2.规整类型
        if((empty($status))){//现类型、不包含x
                $len=strlen($num);
                $type='现';
                if($len.$type=='4现'){
                  $types=4;
                }elseif($len.$type=='3现'){
                  $types=3;
                }elseif($len.$type=='2现'){
                  $types=2;
                }elseif($len.$type=='4定'){
                  $types=1;
                }
            }elseif((empty($status)) && (strlen($num) <=4)){//不包含x、长度4
                if(strlen($num) <4){
                  $type='现';
                }else{
                  $type='定';
                }
                $len=strlen($num1);
                 if($len.$type=='4现'){
                  $types=4;
                }elseif($len.$type=='3现'){
                  $types=3;
                }elseif($len.$type=='2现'){
                  $types=2;
                }elseif($len.$type=='4定'){
                  $types=1;
                }
                $type22=$type1;
            }elseif((!empty($status)) && (strlen($num) ==4)){//包含x、长度4
                $type='定';
                $len=strlen($num1);
                $haoma1=substr($num,0,1);
                $haoma2=substr($num,1,1);
                $haoma3=substr($num,2,1);
                $haoma4=substr($num,3,1);
                if($len==2){//赔率类型判断--6种
                  $types=5;
                }elseif($len==3){//赔率类型判断--4种
                    $types=6;
                }
                if($len==2){//赔率类型判断--6种
                    if($haoma1=='X' && $haoma2=='X'){ 
                        $type1='XX口口';
                    }elseif($haoma3=='X' && $haoma4=='X'){
                        $type1='口口XX';
                    }elseif($haoma1=='X' && $haoma4=='X'){
                        $type1='X口口X'; 
                    }elseif($haoma2=='X' && $haoma3=='X'){
                        $type1='口XX口';
                    }elseif($haoma2=='X' && $haoma4=='X'){
                        $type1='口X口X';
                    }elseif($haoma1=='X' && $haoma3=='X'){
                        $type1='X口X口';
                    }   
                    
                }elseif($len==3){//赔率类型判断--4种
                  $type11='3定';
                    if($haoma1=='X'){
                        $type1='X口口口';
                    }elseif($haoma2=='X'){
                        $type1='口X口口';
                    }elseif($haoma3=='X'){
                        $type1='口口X口';
                    }elseif($haoma4=='X'){
                        $type1='口口口X';
                    }
                }
            }

            $arr=array($types,$type1);//状态1类型2类型3号码
            return $arr;
            exit;

  }

  //统计
  public function statistics(){
  	$qishu=qishus();//得到期数
  	$type=I('get.type');
  	$qishu1=I('get.qishu');
  	if(empty($qishu1)){
  		$where['qishu']=$qishu[0]['qishu'];
  		$where1['qishu']=$qishu[0]['qishu'];
  		$opentime=M('opentime')->field('m_status')->where($where1)->find();
  	}else{
  		$where['qishu']=$qishu1;
  		$where1['qishu']=$qishu1;
  		$opentime=M('opentime')->field('m_status')->where($where1)->find();
  	}
  	$where['js']=0;
  	$bets=M('bet');
  	if(empty($type) || $type==1){//销售亏盈统计
  		$type=1;
  		$title='销售亏盈统计';

  		//$data=$bets->field('money,qishu,status,odds,win')->where($where)->select();
  		 $field='qishu,win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';

        $data=$bets->field($field)->where($where)->select();
        

  		if(!empty($data)){
  			// $lanhuo=M('ubet')->select();
     //        if($lanhuo){
                $data1=$this->process($data,$opentime); 
                //dump($data1); 
                $datas['moneys']=0;
  				$datas['money']=0;
  				$datas['yingkui']=0;
  				$datas['win']=0;
  				foreach($data1 as $k=>$v){
  					$datas['qishu']=$v['qishu'];
  					$datas['win']+=$v['win'];
  					$datas['moneys']+=$v['moneys'];
	  				$datas['money']+=$v['money'];
	  				$datas['yingkui']+=$v['yingkui'];
  				}
            //}
            //dump($datas);
  		}
  		//dump($datas);
  	}elseif($type==2){//
  		$title='会员结算';
  		$arrs=users();//所有下级会员ID（搜索下级用户ID）

  		$where['uid']=array('in',$arrs[0]);

  		$field='uid,win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';
        $data=$bets->field($field)->where($where)->select();
  		if(!empty($data)){
  			$data1=$this->process($data,$opentime); 

  			$uidarr=explode(',',$arrs[0]);
  			foreach($uidarr as $k1=>$v1){
  				$datas[$k1]['ding2']='0.00';
	  			$datas[$k1]['ding3']='0.00';
	  			$datas[$k1]['ding4']='0.00';
	  			$datas[$k1]['dingxian2']='0.00';
	  			$datas[$k1]['dingxian3']='0.00';
	  			$datas[$k1]['dingxian4']='0.00';
	  			$datas[$k1]['moneys']='0.00';
	  			$datas[$k1]['money']='0.00';
	  			$datas[$k1]['uname']='';
	  			foreach($data1 as $k=>$v){
	  				if($v['uid']==$v1){
	  					$datas[$k1]['uname']=$v['username'];
	  					$money+=$v['money'];
	  					$datas[$k1]['money']=intval($money);
	  					$win+=$v['win'];
	  					$datas[$k1]['win']=intval($win);
	  					if($v['status']==1){
		  					$moneys+=$v['money']*$v['odds'];
		  					$datas[$k1]['moneys']=intval($moneys);
		  				}
		  				if($v['mingxi_1']=='4定'){
		  					$ding4+=$v['money'];
		  					$datas[$k1]['ding4']=intval($ding4);
		  				}elseif($v['mingxi_1']=='3定'){
		  					$ding3+=$v['money'];
		  					$datas[$k1]['ding3']=intval($ding3);
		  				}elseif($v['mingxi_1']=='2定'){
		  					$ding2+=$v['money'];
		  					$datas[$k1]['ding2']=intval($ding2);
		  				}elseif($v['mingxi_1']=='2现'){
		  					$dingxian2+=$v['money'];
		  					$datas[$k1]['dingxian2']=intval($dingxian2);
		  				}elseif($v['mingxi_1']=='3现'){
		  					$dingxian3+=$v['money'];
		  					$datas[$k1]['dingxian3']=intval($dingxian3);
		  				}elseif($v['mingxi_1']=='4现'){
		  					$dingxian4+=$v['money'];
		  					$datas[$k1]['dingxian4']=intval($dingxian4);
		  				}
	  				}	
	  			}
	  			$win='';
	  			$money='';
	  			$moneys='';
	  			$ding4='';
	  			$ding3='';
	  			$ding2='';
	  			$dingxian2='';
	  			$dingxian3='';
	  			$dingxian4='';

  			}
  			//dump($datas);
  			if($datas){
  				$datas1['ding2']='0.00';
	  			$datas1['ding3']='0.00';
	  			$datas1['ding4']='0.00';
	  			$datas1['dingxian2']='0.00';
	  			$datas1['dingxian3']='0.00';
	  			$datas1['dingxian4']='0.00';
	  			$datas1['moneys']='0.00';
	  			$datas1['money']='0.00';
	  			$datas1['win']='0.00';
	  			foreach($datas as $k2=>$v2){
	  				if($v2['uname']){
	  					if($v2['win']!='0.00'){
	  						$datas1['win']+=$v2['win'];
	  					}
	  					if($v2['ding2']!='0.00'){
	  						$datas1['ding2']+=$v2['ding2'];
	  					}
	  					if($v2['ding3']!='0.00'){
	  						$datas1['ding3']+=$v2['ding3'];
	  					}
	  					if($v2['ding4']!='0.00'){
	  						$datas1['ding4']+=$v2['ding4'];
	  					}
	  					if($v2['dingxian2']!='0.00'){
	  						$datas1['dingxian2']+=$v2['dingxian2'];
	  					}
	  					if($v2['dingxian3']!='0.00'){
	  						$datas1['dingxian3']+=$v2['dingxian3'];
	  					}
	  					if($v2['money']!='0.00'){
	  						$datas1['money']+=$v2['money'];
	  					}
	  					if($v2['moneys']!='0.00'){
	  						$datas1['moneys']+=$v2['moneys'];
	  					}
	  					
			  			
			  			
			  			// $datas1['dingxian2']+=$v2['dingxian2'];
			  			// $datas1['dingxian3']+=$v2['dingxian3'];
			  			// $datas1['dingxian4']+=$v2['dingxian4'];
			  			// $datas1['money']+=$v2['money'];
			  			// $datas1['moneys']+=$v2['moneys'];
	  				}
	  							
		  		}
  			}

  		}
  	}elseif($type==3){//股东分成结算
  		$title='股东分成结算';
  		$arrs=users();
  		$uwhere['au_type']='partner';
  		$uwhere['qishu']=array('lt',$where['qishu']);
 		$proportion=M('admin')->where($uwhere)->sum('au_proportion');	
 		// dump($proportion);
 		// dump($uwhere);
 		// exit;
 		if($proportion==100){


       	$field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';
        $data=$bets->field($field)->where($where)->select();
       

  		if(!empty($data)){
  			// $lanhuo=M('ubet')->select();
     //        if($lanhuo){
                $data1=$this->process($data,$opentime);

                $datas['moneys']=0;
  				$datas['money']=0;
  				$datas['yingkui']=0;
  				$datas['win']=0;
  				foreach($data1 as $k=>$v){
  					$datas['win']+=$v['win'];
  					$datas['moneys']+=$v['moneys'];
	  				$datas['money']+=$v['money'];
	  				$datas['yingkui']+=$v['yingkui'];
  				}
            //}
            //dump($datas);
             $datas['sum']=count($data);
  		}
        //得到所有股东
         $datas1=users1($where['qishu']);
        
        if(!empty($datas) && !empty($datas1)){
        	foreach($datas1 as $k3=>$v3){
        		if($v3['au_proportion'] > 0){
        			$datas1[$k3]['sum']=$v3['au_proportion']/100*count($data);
        			$datas1[$k3]['money']=$v3['au_proportion']/100*intval($datas['money']);
        			$datas1[$k3]['moneys']=$v3['au_proportion']/100*intval($datas['moneys']);
        			$datas1[$k3]['yingkui']=$v3['au_proportion']/100*intval($datas['yingkui']);
        		}else{
        			$datas1[$k3]['sum']=0;
        			$datas1[$k3]['money']=0;
        			$datas1[$k3]['moneys']=0;
        			$datas1[$k3]['yingkui']=0;
        		}
        		
        	}
        }else{
        	foreach($datas1 as $k3=>$v3){
        		$datas1[$k3]['sum']=0;
        		$datas1[$k3]['money']=0;
        		$datas1[$k3]['moneys']=0;
        		$datas1[$k3]['yingkui']=0;
        	}
        } 

    	}//百分比

  	}elseif($type==4){//查看中奖
  		$title='查看中奖详情';
  		$arrs=users();//所有下级会员ID（搜索下级用户ID）
  		$where['uid']=array('in',$arrs[0]);
  		$where['status']=1;
  		$where['js']=0;
  		$field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';
        $data=$bets->field($field)->where($where)->select();
        
  		 if($data){
            //加工数据-->1得到所有代理配置拦货数据
            $datas=$this->process($data,$opentime); 
         
            $datas1['sum']=count($data);
            $datas1['moneys']='0.00';
            $datas1['win']='0.00';
            foreach($datas as $k=>$v){
                $datas1['money']+=$v['money'];
                if($v['status']==1){
                   $datas1['moneys']+=$v['moneys']; 
                }
                $datas1['win']+=$v['win'];
                $datas1['yingkui']+=$v['yingkui'];
            }
        }
  	}
  	
  	//dump($data);
  	$this->assign('title',$title);
  	$this->assign('data',$datas);
  	$this->assign('data2',$data2);
  	$this->assign('data1',$datas1);
  	$this->assign('type',$type);
  	$this->assign('qishu',$qishu);
  	$this->assign('qishu1',$qishu1);
  	$this->display();
  }
//处理数据
    private function process($data,$qishus){
        foreach($data as $k1=>$v1){
            // $data[$k1]['lmoney']=0;
            // $data[$k1]['lmoneys']=0;
            // $data[$k1]['lyingkui']=0;
            // $data[$k1]['umoneys']=0;
            // $data[$k1]['uyingkui']=0;
            $win=$v1['win']-$v1['topwin'];
            $money=$v1['money']-$v1['topmoney'];
            if($v1['status']==1){//中奖
                $data[$k1]['moneys']=($v1['money']-$v1['topmoney'])*$v1['odds'];//中奖
                //$lmoneys=$v1['topmoney']*$v1['odds'];//中奖
            } 
            //中奖金额+回水-下注 下注-中奖金额-回水
            if($qishus['m_status']==3){//期号开奖
               $data[$k1]['yingkui']=($v1['money']-$v1['topmoney'])-$data[$k1]['moneys']-($v1['win']-$v1['topwin']);
                //$lyingkui=$v1['topmoney']-$lmoneys-$v1['topwin'];
            }
            // $data[$k1]['umoneys']=$umoneys;//中奖
            // $data[$k1]['uyingkui']=$uyingkui;//盈亏
          
            // $data[$k1]['lmoney']=$v1['topmoney'];
            // $data[$k1]['lmoneys']=$lmoneys;
            // $data[$k1]['lhuishui']=$v1['topwin'];
            // $data[$k1]['lyingkui']=$lyingkui;
            $data[$k1]['money']=$v1['money']-$v1['topmoney'];//下注
            //$data[$k1]['moneys']=$umoneys;//中奖
           // $data[$k1]['yingkui']=$uyingkui;//盈亏
            $data[$k1]['win']=$v1['win']-$v1['topwin'];//回水
            $win='';
            $money='';
            $umoneys='';
            $uyingkui='';
        }//循环

        return $data;
    }
    //处理数据
    private function process1($data){
        foreach($data as $k1=>$v1){
            // $data[$k1]['lmoney']=0;
            // $data[$k1]['lmoneys']=0;
            // $data[$k1]['lyingkui']=0;
            // $data[$k1]['umoneys']=0;
            // $data[$k1]['uyingkui']=0;
            // if($v1['status']==1){//中奖
            //     $umoneys=$v1['moneys']*$v1['odds'];//中奖
            //     $lmoneys=$v1['topmoney']*$v1['odds'];//中奖
            // } 
            //中奖金额+回水-下注 下注-中奖金额-回水
            // if($qishus['m_status']==3){//期号开奖
            //     $uyingkui=$v1['moneys']-$umoneys-$v1['win'];
            //     $lyingkui=$v1['topmoney']-$lmoneys-$v1['topwin'];
            // }
            // $data[$k1]['umoneys']=$umoneys;//中奖
            // $data[$k1]['uyingkui']=$uyingkui;//盈亏
          
            // $data[$k1]['lmoney']=$v1['topmoney'];
            // $data[$k1]['lmoneys']=$lmoneys;
            // $data[$k1]['lhuishui']=$v1['topwin'];
            // $data[$k1]['lyingkui']=$lyingkui;
            $data[$k1]['moneys']=$v1['moneys']-$v1['topmoneys'];//下注
            // $data[$k1]['moneys']=$data[$k1]['umoneys']-$lmoneys;//中奖
            // $data[$k1]['yingkui']=$data[$k1]['uyingkui']-$lyingkui;//盈亏
            //$data[$k1]['win']=$v1['win']-$v1['topwin'];//回水

        }//循环

        return $data;
    }
  //风控导出
  public function excels(){
  	$qishu=qishus();//得到期数
  	$qishu1=I('get.qishu');//期数
  	$types=I('get.qtypes');//类型 1超额2金额3.赔率
  	$qtypes=I('get.qtypes');//类型 1超额2金额3.赔率
  	$moneys=I('get.moneys');//超额
  	$start=I('get.start');//开始
	$finish=I('get.finish');//结束
	$stime=I('get.stime');//开始时间
	$etime=I('get.etime');//结束时间
	$type=I('get.type');//号码类型
	//exit;
	if(empty($qishu1)){
		$where['qishu']=$qishu[0]['qishu']; 
		$qishu1=$qishu[0]['qishu']; 
	}else{
		$where['qishu']=$qishu1; 
	}
	
	if(empty($qtypes)){
		$qtypes=1;
	}
	$where['js']=0;
	if($types==1){//类型 1超额2金额3.赔率

	}elseif($types==2){//类型 1超额2金额3.赔率
		if(!empty($start) && !empty($finish)){
			$where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	      
	    }
	}elseif($types==3){//类型 1超额2金额3.赔率
		if(!empty($start) && !empty($finish)){
	     	 $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	    }
	}
	//时间
	if(!empty($stime) && !empty($etime)){
       $where['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
    }
    //号码类型
	if(!empty($type)){
        if($type=='1'){
          //$where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
           $where['mingxi_1']='2定';
        }elseif($type=='三定位'){
          //$where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
           $where['mingxi_1']='3定';
        }elseif($type=='四定位'){
          $where['mingxi_1']='4定';
        }elseif($type=='四字现'){
          $where['mingxi_1']='4现';
        }elseif($type=='三字现'){
          $where['mingxi_1']='3现';
        }elseif($type=='二字现'){
          $where['mingxi_1']='2现';
        }else{
          $where['types']=$type;
        }
    }

		$bets=M('bet');
        $count      = $bets->where($where)->count();
        $page1=$count/72;
        $Page       = new \Think\Page($count,72);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->parameter .= "&qishu=".$where['qishu'];
        $Page->parameter .= "&qtypes=".$qtypes;
        $Page->parameter .= "&moneys=".$moneys; 
        $Page->parameter .= "&start=".$start;
        $Page->parameter .= "&finish=".$finish;
        $Page->parameter .= "&type=".$type;
        $Page->parameter .= "&stime=".$stime;
        $Page->parameter .= "&etime=".$etime;
        $show       = $Page->show();// 分页显示输出
        
        $field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topmoney,topwin';

        $data=$bets->field($field)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();


  	$this->assign('data',$data);
  	$this->assign('count',$count);
  	$this->assign('show',$show);
  	$this->assign('qishu',$qishu);
  	$this->assign('qishu1',$qishu1);//
  	$this->assign('qtypes',$qtypes);//
  	$this->assign('moneys',$moneys);//
  	$this->assign('start',$start);//赔率、金额退码
    $this->assign('finish',$finish);//赔率、金额退码
    $this->assign('stime',$stime);//
    $this->assign('etime',$etime);//
    $this->assign('type',$type);//
  	$this->display();	
  }
 //  //风控导出
 //  public function excels1(){
 //  	$qishu=I('post.qishu');
	// $type=I('post.type');
	// if(!empty($type) && $type=='1'){
	// 	$where['mingxi_1']='4定';
	// }elseif(!empty($type) && $type=='2'){
	// 	$where['mingxi_1']='2字现';
	// }elseif(!empty($type) && $type=='3'){
	// 	$where['mingxi_1']='3字现';
	// }elseif(!empty($type) && $type=='4'){
	// 	$where['mingxi_1']='4字现';
	// }elseif(!empty($type) && $type=='5'){
	// 	$where['mingxi_1']='2定';
	// }elseif(!empty($type) && $type=='6'){
	// 	$where['mingxi_1']='3定';
	// }
	// $where['qishu']=$qishu;
	// $data=M('bet')->where($where)->select();
	// $dd=D('Download')->getDate($data);
 // //    $xlsCell  = array(
 // //    	array('id','ID'),
 // //    	array('qishu','期数'),
 // //        array('did','订单号'),
 // //        array('username','用户名称'),
 // //        array('mingxi_1','玩法类型'),
 // //        array('mingxi_2','号码'),
 // //        array('money','下注金额'),
 // //        array('addtime','下注时间'),
       
 // //    );    
	// // $xlsName='下注数据导出';
 // //    $this->exportExcel($xlsName,$xlsCell,$data);//$xlsName(文件名称) $xlsCell(文件要导出的字段) 

	// }
	// 
	// 
	// 
	//风控导出
  public function excels1(){
  	$qishu=I('post.qishu');//期数
  	$types=I('post.qtypes');//类型 1超额2金额3.赔率
  	$moneys=I('post.moneys');//超额
  	$start=I('post.start');//开始
	$finish=I('post.finish');//结束
	$stime=I('post.stime');//开始时间
	$etime=I('post.etime');//结束时间
	$type=I('post.type');//号码类型
	//exit;
	$where['qishu']=$qishu;
	$where1['qishu']=$qishu;
	$where2['qishu']=$qishu;
	$where3['qishu']=$qishu;
	$where4['qishu']=$qishu;
	$where5['qishu']=$qishu;
	$where6['qishu']=$qishu;
	$where['js']=0;
	$where1['js']=0;
	$where2['js']=0;
	$where3['js']=0;
	$where4['js']=0;
	$where5['js']=0;
	$where6['js']=0;
	if($types==1){//类型 1超额2金额3.赔率

	}elseif($types==2){//类型 1超额2金额3.赔率
		if(!empty($start) && !empty($finish)){
			$where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where1['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where2['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where3['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where4['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where5['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where6['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	      
	    }
	}elseif($types==3){//类型 1超额2金额3.赔率
		if(!empty($start) && !empty($finish)){
	     	 $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where1['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where2['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where3['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where4['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where5['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where6['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	    }
	}
	//时间
	if(!empty($stime) && !empty($etime)){
       $where['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where1['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where2['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where3['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where4['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where5['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where6['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
    }
    //号码类型
	if(!empty($type)){
        if($type=='1'){
          //$where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
           $where['mingxi_1']='2定';
        }elseif($type=='三定位'){
          //$where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
           $where['mingxi_1']='3定';
        }elseif($type=='四定位'){
          $where['mingxi_1']='4定';
        }elseif($type=='四字现'){
          $where['mingxi_1']='4现';
        }elseif($type=='三字现'){
          $where['mingxi_1']='3现';
        }elseif($type=='二字现'){
          $where['mingxi_1']='2现';
        }else{
          $where['types']=$type;
        }
    }
    if(!empty($type)){//有号码类型条件
    	//所有本期所有类型下的号码
	    $field='mingxi_1,mingxi_2,sum(money) as moneys,sum(topmoney) as topmoneys';
	    $data2=M('bet')->field($field)->where($where)->group('mingxi_2')->select();
	    //dump($data2);exit;
	    $sum=0;
	    $moneys1=0;
	    //有超额
	    if($types==1 && !empty($moneys)){
	    	if($data2){
	    		foreach($data2 as $k=>$v){
	    			if($v['mingxi_1']=='4现'){
	    				$v['mingxi_2']='a'.$v['mingxi_2'];
	    			}
	    			//去掉揽货
	    			if($v['moneys']){
	    				$moneys2=($v['moneys']-$v['topmoneys'])-$moneys;
	    				if($moneys2>0){
	    					//$v['moneys']=$moneys;
	    					$sum+=1;
	    					$moneys1+=$moneys2;
	    					$mingxi2.=$v['mingxi_2'].'='.($moneys2).',';
	    				}
	    			}
	    			$moneys2=0;
	    			//$data[]=$v;
	    		}
	    	}
	    }else{
	    	$data=$this->process1($data2);
	    	foreach($data as $k1=>$v1){
	    			if($v1['mingxi_1']=='4现'){
	    				$v1['mingxi_2']='a'.$v1['mingxi_2'];
	    			}
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v1['moneys']>=$start && $v1['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v1['moneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v1['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v1['moneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
		    			}
	    			}
	    			
	    		}
	    }
    }else{
    	//每个类型数据下-->1.号码下注金额汇总 2.减去揽货 （3.超额）
    	$where1['mingxi_1']='2定';
    	$where2['mingxi_1']='3定';
    	$where3['mingxi_1']='4定';
    	$where4['mingxi_1']='2现';
    	$where5['mingxi_1']='3现';
    	$where6['mingxi_1']='4现';
    	$bet=M('bet');
    	$field='mingxi_1,mingxi_2,sum(money) as moneys,sum(topmoney) as topmoneys';
	    $data1=$bet->field($field)->where($where1)->group('mingxi_2')->select();
	    $data2=$bet->field($field)->where($where2)->group('mingxi_2')->select();
	    $data3=$bet->field($field)->where($where3)->group('mingxi_2')->select();
	    $data4=$bet->field($field)->where($where4)->group('mingxi_2')->select();
	    $data5=$bet->field($field)->where($where5)->group('mingxi_2')->select();
	    $data6=$bet->field($field)->where($where6)->group('mingxi_2')->select();
	    $sum=0;
	    $moneys1=0;
	    if($data1){
		    $datas1=$this->process1($data1);
		   	 //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas1 as $k1=>$v1){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v1['moneys']){
	    				$moneys2=($v1['moneys']-$v1['topmoneys'])-$moneys;
	    				if($moneys2>0){
	    					$sum+=1;
	    					$moneys1+=$moneys2;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v1['mingxi_2'].'='.($moneys2).',';
	    				}
	    			}
	    			$moneys2=0;
	    		}
	    	}else{
	    		foreach($datas1 as $k1=>$v1){
	    			//去掉揽货
	    			// if($v1['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v1['moneys'];
	    			// 	$mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v1['moneys']>=$start && $v1['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v1['moneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v1['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v1['moneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
		    			}
	    			}
	    		}
	    	} 


	    }
	    if($data2){
		    $datas2=$this->process1($data2);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas2 as $k2=>$v2){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v2['moneys']){
	    				$moneys3=($v2['moneys']-$v2['topmoneys'])-$moneys;
	    				if($moneys2>0){
	    					$sum+=1;
	    					$moneys1+=$moneys3;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v2['mingxi_2'].'='.($moneys3).',';
	    				}
	    			}
	    			$moneys3=0;
	    		}
	    	}else{
	    		foreach($datas2 as $k2=>$v2){
	    			//去掉揽货
	    			// if($v2['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v2['moneys'];
	    			// 	$mingxi2.=$v2['mingxi_2'].'='.($v2['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v2['moneys']>=$start && $v2['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v2['moneys'];
		    				$mingxi2.=$v2['mingxi_2'].'='.($v2['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v2['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v2['moneys'];
		    				$mingxi2.=$v2['mingxi_2'].'='.($v2['moneys']).',';
		    			}
	    			}
	    		}
	    	} 

	    }
	    if($data3){
		    $datas3=$this->process1($data3);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas3 as $k3=>$v3){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v3['moneys']){
	    				$moneys4=($v3['moneys']-$v3['topmoneys'])-$moneys;
	    				if($moneys4>0){
	    					$sum+=1;
	    					$moneys1+=$moneys4;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v3['mingxi_2'].'='.($moneys4).',';
	    				}
	    			}
	    			$moneys4=0;
	    		}
	    	}else{
	    		foreach($datas3 as $k3=>$v3){
	    			//去掉揽货
	    			// if($v3['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v3['moneys'];
	    			// 	$mingxi2.=$v3['mingxi_2'].'='.($v3['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v3['moneys']>=$start && $v3['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v3['moneys'];
		    				$mingxi2.=$v3['mingxi_2'].'='.($v3['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v3['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v3['moneys'];
		    				$mingxi2.=$v3['mingxi_2'].'='.($v3['moneys']).',';
		    			}
	    			}
	    		}
	    	} 
	    }
	    if($data4){
		    $datas4=$this->process1($data4);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas4 as $k4=>$v4){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v4['moneys']){
	    				$moneys5=($v4['moneys']-$v4['topmoneys'])-$moneys;
	    				if($moneys5>0){
	    					$sum+=1;
	    					$moneys1+=$moneys5;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v4['mingxi_2'].'='.($moneys5).',';
	    				}
	    			}
	    			$moneys5=0;
	    		}
	    	}else{
	    		foreach($datas4 as $k4=>$v4){
	    			//去掉揽货
	    			// if($v4['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v4['moneys'];
	    			// 	$mingxi2.=$v4['mingxi_2'].'='.($v4['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v4['moneys']>=$start && $v4['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v4['moneys'];
		    				$mingxi2.=$v4['mingxi_2'].'='.($v4['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v4['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v4['moneys'];
		    				$mingxi2.=$v4['mingxi_2'].'='.($v4['moneys']).',';
		    			}
	    			}
	    		}
	    	} 
	    }
	    if($data5){
		    $datas5=$this->process1($data5);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas5 as $k5=>$v5){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v5['moneys']){
	    				$moneys6=($v5['moneys']-$v5['topmoneys'])-$moneys;
	    				if($moneys6>0){
	    					$sum+=1;
	    					$moneys1+=$moneys6;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v5['mingxi_2'].'='.($moneys6).',';
	    				}
	    			}
	    			$moneys6=0;
	    		}
	    	}else{
	    		foreach($datas5 as $k5=>$v5){
	    			//去掉揽货
	    			// if($v5['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v5['moneys'];
	    			// 	$mingxi2.=$v5['mingxi_2'].'='.($v5['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v5['moneys']>=$start && $v5['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v5['moneys'];
		    				$mingxi2.=$v5['mingxi_2'].'='.($v5['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v5['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v5['moneys'];
		    				$mingxi2.=$v5['mingxi_2'].'='.($v5['moneys']).',';
		    			}
	    			}
	    		}
	    	} 
	    }
	    if($data6){
		    $datas6=$this->process1($data6);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas6 as $k6=>$v6){
	    			if($v6['mingxi_1']=='4现'){
	    				$v6['mingxi_2']='a'.$v6['mingxi_2'];
	    			}
	    			//去掉揽货
	    			if($v6['moneys']>0){
	    				$moneys7=($v6['moneys']-$v6['topmoneys'])-$moneys;
	    				if($moneys7){
	    					$sum+=1;
	    					$moneys1+=$moneys7;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v6['mingxi_2'].'='.($moneys7).',';
	    				}
	    			}
	    			$moneys7=0;
	    		}
	    	}else{
	    		foreach($datas6 as $k6=>$v6){
	    			if($v6['mingxi_1']=='4现'){
	    				$v6['mingxi_2']='a'.$v6['mingxi_2'];
	    			}
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v6['moneys']>=$start && $v6['moneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v6['moneys'];
		    				$mingxi2.=$v6['mingxi_2'].'='.($v6['moneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v6['moneys']){
		    				$sum+=1;
		    				$moneys1+=$v6['moneys'];
		    				$mingxi2.=$v6['mingxi_2'].'='.($v6['moneys']).',';
		    			}
	    			}
	    			//去掉揽货
	    			// if($v6['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v6['moneys'];
	    			// 	$mingxi2.=$v6['mingxi_2'].'='.($v6['moneys']).',';
	    			// }
	    		}
	    	} 
	    }
	    //dump($datas6);
	    // $sum='';//总笔数
	    // $moneys1='';//总金额

	   // echo "\r\n".'总笔数('.$sum.')/总金额('.$moneys1.')';	
	   // dump($mingxi2);exit;


    }
     
ob_end_clean();
header("Content-type:application/octet-stream");
//header("Content-Type:application/force-download");
header("Accept-Ranges:bytes");

//header("Content-Disposition:attachment;filename=".'id列表_'.date("YmdHis").".txt");
header("Content-Disposition:attachment;filename=".'数据_'.date("Y_m_d_H").".txt");

header("Expires: 0");

header("Cache-Control:must-revalidate,post-check=0,pre-check=0");

header("Pragma:public");
 if(!empty($mingxi2)){
 	$data7=explode(',',rtrim($mingxi2,','));
	foreach($data7 as $k7=>$v7){
		if(($k7+1)%200==0 && $k7>1){
			echo $v7.','."\r\n";
		}else{
			echo $v7.',';
		}
	}
}
echo "\r\n".'总笔数('.$sum.')/总金额('.$moneys1.')';	

   // dump($data7);exit;



 
//   	$qishu=I('post.qishu');
// 	$moneys=I('post.moneys');//超额
// 	$qtypes=I('post.qtypes');//超额类型
// 	$start=I('post.start');//开始赔率
// 	$finish=I('post.finish');//结束赔率
// 	$stime=I('post.stime');//开始时间
// 	$etime=I('post.etime');//结束时间
// 	$type=I('post.type');
// 	$types=I('post.types');
// 	dump($_POST);exit;
// 	$where['qishu']=$qishu;
// 	//$opentime=M('opentime')->field('m_status')->where($where)->find();
// 	if(!empty($type)){
//         if($type=='1'){
//           $where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
//         }elseif($type=='三定位'){
//           $where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
//         }elseif($type=='四定位'){
//           $where['types']='4定';
//         }elseif($type=='四字现'){
//           $where['types']='4现';
//         }elseif($type=='三字现'){
//           $where['types']='3现';
//         }elseif($type=='二字现'){
//           $where['types']='2现';
//         }else{
//           $where['types']=$type;
//         }
//     }
	

// 	$where['js']=0;
// 	//赔率
// 	if($types==1){
// 		if(!empty($start) && !empty($finish)){
// 	       $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
// 	    }
// 	}else{
// 		if(!empty($start) && !empty($finish)){
// 	       $where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
// 	    }
// 	}
	
// 	//时间
// 	if(!empty($stime) && !empty($etime)){
//        $where['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
//     }

//     if(!empty($moneys)){
//     	$field='mingxi_2,sum(money) as moneys,sum(topmoney) as topmoneys';

//         $data2=M('bet')->field($field)->where($where)->group('mingxi_2')->select();
        
//     	//$data=M('bet')->field('mingxi_3,mingxi_2,sum(money) as moneys')->where($where)->group('mingxi_2')->select();
//     }else{
//     	//$field='win,mingxi_1,mingxi_2,odds,money as moneys,js,status,topmoney,topwin';
//     	$field='mingxi_2,money as moneys,topmoney as topmoneys';
//     	$data2=M('bet')->field($field)->where($where)->select();
//     }
	
// 	if(empty($data2)){
// 		//echo '<script>alert("没有数据");parent.location.reload();</script>';exit;
// 		echo '没有数据！';
// 	}else{
//         $data=$this->process1($data2); 
// 	}
// ob_end_clean();
// header("Content-type:application/octet-stream");
// //header("Content-Type:application/force-download");
// header("Accept-Ranges:bytes");

// //header("Content-Disposition:attachment;filename=".'id列表_'.date("YmdHis").".txt");
// header("Content-Disposition:attachment;filename=".'数据_'.date("Y_m_d_H").".txt");

// header("Expires: 0");

// header("Cache-Control:must-revalidate,post-check=0,pre-check=0");

// header("Pragma:public");
// if(!empty($moneys) && $moneys>=1){
// 	if($qtypes==2){
// 			foreach($data as $k=>$v){
// 			$v['moneys']+=0;
// 			if(($v['moneys']-$moneys)>=1){
// 				//echo($v['mingxi_2'].$t1.'='.($v['moneys']-$moneys).',');
// 				$data1[]=$v['mingxi_2'].$t1.'='.$v['moneys'].',';
// 				//$counts+=$v['counts'];//笔数
// 				$moneys1+=$v['moneys'];//金额
// 				$sum+=1;//号码数
// 			}
// 			// if(($k+1)%200==0 && $k>1){
// 			// 	echo($v['mingxi_2'].$t1.'='.$v['moneys'].',')."\r\n";
// 			// }else{
// 			// 	echo($v['mingxi_2'].$t1.'='.$v['moneys'].',');
// 			// }
// 		}
// 	}else{
// 		foreach($data as $k=>$v){
// 			$v['moneys']+=0;
// 			if(($v['moneys']-$moneys)>=1){
// 				//echo($v['mingxi_2'].$t1.'='.($v['moneys']-$moneys).',');
// 				$data1[]=$v['mingxi_2'].$t1.'='.($v['moneys']-$moneys).',';
// 				//$counts+=$v['counts'];//笔数
// 				$moneys1+=$v['moneys']-$moneys;//金额
// 				$sum+=1;//号码数
// 			}
// 			// if(($k+1)%200==0 && $k>1){
// 			// 	echo($v['mingxi_2'].$t1.'='.$v['moneys'].',')."\r\n";
// 			// }else{
// 			// 	echo($v['mingxi_2'].$t1.'='.$v['moneys'].',');
// 			// }
// 		}
// 	}
	
// 		if(!empty($data1)){
// 			foreach($data1 as $k1=>$v1){
// 				if(($k1+1)%200==0 && $k1>1){
// 					echo $v1."\r\n";
// 				}else{
// 					echo $v1;
// 				}
// 			}
// 		}
// 		 echo "\r\n".'总笔数('.$sum.')/总金额('.$moneys1.')';	
// 	}else{
// 		foreach($data as $k=>$v){
// 			$v['moneys']+=0;
// 			if(($k+1)%200==0 && $k>1){
// 				echo($v['mingxi_2'].$t1.'='.$v['moneys'].',')."\r\n";
// 			}else{
// 				echo($v['mingxi_2'].$t1.'='.$v['moneys'].',');
// 			}
// 			$moneys1+=$v['moneys'];//金额
// 			if($v['moneys']>0){
// 				$sum+=1;//号码数
// 			}
			
// 		}

// 		//echo "\r\n".'总笔数'.$sum.'/总金额'.$moneys1;	
// 		 echo "\r\n".'总笔数('.$sum.')/总金额('.$moneys1.')';	
// 	}


	}

	//风控导出
  public function excels2(){
  	$qishu=I('post.qishu');//期数
  	$types=I('post.qtypes2');//类型 1超额2金额3.赔率
  	$moneys=I('post.moneys');//超额
  	$start=I('post.start');//开始
	$finish=I('post.finish');//结束
	$stime=I('post.stime');//开始时间
	$etime=I('post.etime');//结束时间
	$type=I('post.type');//号码类型
	//exit;
	$where['qishu']=$qishu;
	$where1['qishu']=$qishu;
	$where2['qishu']=$qishu;
	$where3['qishu']=$qishu;
	$where4['qishu']=$qishu;
	$where5['qishu']=$qishu;
	$where6['qishu']=$qishu;
	$where['js']=0;
	$where1['js']=0;
	$where2['js']=0;
	$where3['js']=0;
	$where4['js']=0;
	$where5['js']=0;
	$where6['js']=0;
	if($types==1){//类型 1超额2金额3.赔率

	}elseif($types==2){//类型 1超额2金额3.赔率
		if(!empty($start) && !empty($finish)){
			$where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where1['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where2['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where3['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where4['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where5['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where6['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	      
	    }
	}elseif($types==3){//类型 1超额2金额3.赔率
		if(!empty($start) && !empty($finish)){
	     	 $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where1['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where2['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where3['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where4['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where5['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	       $where6['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
	    }
	}
	//时间
	if(!empty($stime) && !empty($etime)){
       $where['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where1['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where2['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where3['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where4['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where5['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
       $where6['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)),'and'); 
    }
    //号码类型
	if(!empty($type)){
        if($type=='1'){
          //$where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
           $where['mingxi_1']='2定';
        }elseif($type=='三定位'){
          //$where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
           $where['mingxi_1']='3定';
        }elseif($type=='四定位'){
          $where['mingxi_1']='4定';
        }elseif($type=='四字现'){
          $where['mingxi_1']='4现';
        }elseif($type=='三字现'){
          $where['mingxi_1']='3现';
        }elseif($type=='二字现'){
          $where['mingxi_1']='2现';
        }else{
          $where['types']=$type;
        }
    }
    $where['topmoney']=array('gt',0);
    $where1['topmoney']=array('gt',0);
    $where2['topmoney']=array('gt',0);
    $where3['topmoney']=array('gt',0);
    $where4['topmoney']=array('gt',0);
    $where5['topmoney']=array('gt',0);
    $where6['topmoney']=array('gt',0);
    if(!empty($type)){//有号码类型条件
    	//所有本期所有类型下的号码
	    $field='mingxi_1,mingxi_2,sum(money) as moneys,sum(topmoney) as topmoneys';
	    $data2=M('bet')->field($field)->where($where)->group('mingxi_2')->select();
	    //dump($data2);exit;
	    $sum=0;
	    $moneys1=0;
	    //有超额
	    if($types==1 && !empty($moneys)){
	    	if($data2){
	    		foreach($data2 as $k=>$v){
	    			if($v['mingxi_1']=='4现'){
	    				$v['mingxi_2']='a'.$v['mingxi_2'];
	    			}
	    			//去掉揽货
	    			if($v['topmoneys']){
	    				$moneys2=($v['topmoneys'])-$moneys;
	    				if($moneys2>0){
	    					//$v['moneys']=$moneys;
	    					$sum+=1;
	    					$moneys1+=$moneys2;
	    					$mingxi2.=$v['mingxi_2'].'='.($moneys2).',';
	    				}
	    			}
	    			$moneys2=0;
	    			//$data[]=$v;
	    		}
	    	}
	    }else{
	    	$data=$this->process1($data2);
	    	foreach($data as $k1=>$v1){
	    			if($v1['mingxi_1']=='4现'){
	    				$v1['mingxi_2']='a'.$v1['mingxi_2'];
	    			}
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v1['topmoneys']>=$start && $v1['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v1['topmoneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v1['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v1['topmoneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['topmoneys']).',';
		    			}
	    			}
	    			
	    		}
	    }
    }else{
    	//每个类型数据下-->1.号码下注金额汇总 2.减去揽货 （3.超额）
    	$where1['mingxi_1']='2定';
    	$where2['mingxi_1']='3定';
    	$where3['mingxi_1']='4定';
    	$where4['mingxi_1']='2现';
    	$where5['mingxi_1']='3现';
    	$where6['mingxi_1']='4现';
    	$bet=M('bet');
    	$field='mingxi_1,mingxi_2,sum(money) as moneys,sum(topmoney) as topmoneys';
	    $data1=$bet->field($field)->where($where1)->group('mingxi_2')->select();
	    $data2=$bet->field($field)->where($where2)->group('mingxi_2')->select();
	    $data3=$bet->field($field)->where($where3)->group('mingxi_2')->select();
	    $data4=$bet->field($field)->where($where4)->group('mingxi_2')->select();
	    $data5=$bet->field($field)->where($where5)->group('mingxi_2')->select();
	    $data6=$bet->field($field)->where($where6)->group('mingxi_2')->select();
	    $sum=0;
	    $moneys1=0;
	    if($data1){
		    $datas1=$this->process1($data1);
		   	 //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas1 as $k1=>$v1){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v1['topmoneys']){
	    				$moneys2=($v1['topmoneys'])-$moneys;
	    				if($moneys2>0){
	    					$sum+=1;
	    					$moneys1+=$moneys2;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v1['mingxi_2'].'='.($moneys2).',';
	    				}
	    			}
	    			$moneys2=0;
	    		}
	    	}else{
	    		foreach($datas1 as $k1=>$v1){
	    			//去掉揽货
	    			// if($v1['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v1['moneys'];
	    			// 	$mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v1['topmoneys']>=$start && $v1['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v1['topmoneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v1['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v1['topmoneys'];
		    				$mingxi2.=$v1['mingxi_2'].'='.($v1['topmoneys']).',';
		    			}
	    			}
	    		}
	    	} 


	    }
	    if($data2){
		    $datas2=$this->process1($data2);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas2 as $k2=>$v2){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v2['topmoneys']){
	    				$moneys3=($v2['topmoneys'])-$moneys;
	    				if($moneys2>0){
	    					$sum+=1;
	    					$moneys1+=$moneys3;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v2['mingxi_2'].'='.($moneys3).',';
	    				}
	    			}
	    			$moneys3=0;
	    		}
	    	}else{
	    		foreach($datas2 as $k2=>$v2){
	    			//去掉揽货
	    			// if($v2['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v2['moneys'];
	    			// 	$mingxi2.=$v2['mingxi_2'].'='.($v2['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v2['topmoneys']>=$start && $v2['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v2['topmoneys'];
		    				$mingxi2.=$v2['mingxi_2'].'='.($v2['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v2['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v2['topmoneys'];
		    				$mingxi2.=$v2['mingxi_2'].'='.($v2['topmoneys']).',';
		    			}
	    			}
	    		}
	    	} 

	    }
	    if($data3){
		    $datas3=$this->process1($data3);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas3 as $k3=>$v3){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v3['topmoneys']){
	    				$moneys4=($v3['topmoneys'])-$moneys;
	    				if($moneys4>0){
	    					$sum+=1;
	    					$moneys1+=$moneys4;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v3['mingxi_2'].'='.($moneys4).',';
	    				}
	    			}
	    			$moneys4=0;
	    		}
	    	}else{
	    		foreach($datas3 as $k3=>$v3){
	    			//去掉揽货
	    			// if($v3['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v3['moneys'];
	    			// 	$mingxi2.=$v3['mingxi_2'].'='.($v3['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v3['topmoneys']>=$start && $v3['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v3['topmoneys'];
		    				$mingxi2.=$v3['mingxi_2'].'='.($v3['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v3['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v3['topmoneys'];
		    				$mingxi2.=$v3['mingxi_2'].'='.($v3['topmoneys']).',';
		    			}
	    			}
	    		}
	    	} 
	    }
	    if($data4){
		    $datas4=$this->process1($data4);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas4 as $k4=>$v4){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v4['topmoneys']){
	    				$moneys5=($v4['topmoneys'])-$moneys;
	    				if($moneys5>0){
	    					$sum+=1;
	    					$moneys1+=$moneys5;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v4['mingxi_2'].'='.($moneys5).',';
	    				}
	    			}
	    			$moneys5=0;
	    		}
	    	}else{
	    		foreach($datas4 as $k4=>$v4){
	    			//去掉揽货
	    			// if($v4['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v4['moneys'];
	    			// 	$mingxi2.=$v4['mingxi_2'].'='.($v4['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v4['topmoneys']>=$start && $v4['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v4['topmoneys'];
		    				$mingxi2.=$v4['mingxi_2'].'='.($v4['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v4['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v4['topmoneys'];
		    				$mingxi2.=$v4['mingxi_2'].'='.($v4['topmoneys']).',';
		    			}
	    			}
	    		}
	    	} 
	    }
	    if($data5){
		    $datas5=$this->process1($data5);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas5 as $k5=>$v5){
	    			// if($v['mingxi_1']=='4现'){
	    			// 	$v['mingxi_2']='a'.$v['mingxi_2'];
	    			// }
	    			//去掉揽货
	    			if($v5['topmoneys']){
	    				$moneys6=($v5['topmoneys'])-$moneys;
	    				if($moneys6>0){
	    					$sum+=1;
	    					$moneys1+=$moneys6;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v5['mingxi_2'].'='.($moneys6).',';
	    				}
	    			}
	    			$moneys6=0;
	    		}
	    	}else{
	    		foreach($datas5 as $k5=>$v5){
	    			//去掉揽货
	    			// if($v5['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v5['moneys'];
	    			// 	$mingxi2.=$v5['mingxi_2'].'='.($v5['moneys']).',';
	    			// }
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v5['topmoneys']>=$start && $v5['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v5['topmoneys'];
		    				$mingxi2.=$v5['mingxi_2'].'='.($v5['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v5['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v5['topmoneys'];
		    				$mingxi2.=$v5['mingxi_2'].'='.($v5['topmoneys']).',';
		    			}
	    			}
	    		}
	    	} 
	    }
	    if($data6){
		    $datas6=$this->process1($data6);
		     //有超额
	    	if($types==1 && !empty($moneys)){
	    		foreach($datas6 as $k6=>$v6){
	    			if($v6['mingxi_1']=='4现'){
	    				$v6['mingxi_2']='a'.$v6['mingxi_2'];
	    			}
	    			//去掉揽货
	    			if($v6['topmoneys']>0){
	    				$moneys7=($v6['topmoneys'])-$moneys;
	    				if($moneys7){
	    					$sum+=1;
	    					$moneys1+=$moneys7;
	    					//$v1['moneys']=$moneys;
	    					$mingxi2.=$v6['mingxi_2'].'='.($moneys7).',';
	    				}
	    			}
	    			$moneys7=0;
	    		}
	    	}else{
	    		foreach($datas6 as $k6=>$v6){
	    			if($v6['mingxi_1']=='4现'){
	    				$v6['mingxi_2']='a'.$v6['mingxi_2'];
	    			}
	    			if($types==2){ 
	    				//去掉揽货
		    			if($v6['topmoneys']>=$start && $v6['topmoneys']<=$finish){
		    				$sum+=1;
		    				$moneys1+=$v6['topmoneys'];
		    				$mingxi2.=$v6['mingxi_2'].'='.($v6['topmoneys']).',';
		    			}
	    			}else{
	    				//去掉揽货
		    			if($v6['topmoneys']){
		    				$sum+=1;
		    				$moneys1+=$v6['topmoneys'];
		    				$mingxi2.=$v6['mingxi_2'].'='.($v6['topmoneys']).',';
		    			}
	    			}
	    			//去掉揽货
	    			// if($v6['moneys']){
	    			// 	$sum+=1;
	    			// 	$moneys1+=$v6['moneys'];
	    			// 	$mingxi2.=$v6['mingxi_2'].'='.($v6['moneys']).',';
	    			// }
	    		}
	    	} 
	    }
	    //dump($datas6);
	    // $sum='';//总笔数
	    // $moneys1='';//总金额

	   // echo "\r\n".'总笔数('.$sum.')/总金额('.$moneys1.')';	
	   // dump($mingxi2);exit;


    }
     
ob_end_clean();
header("Content-type:application/octet-stream");
//header("Content-Type:application/force-download");
header("Accept-Ranges:bytes");

//header("Content-Disposition:attachment;filename=".'id列表_'.date("YmdHis").".txt");
header("Content-Disposition:attachment;filename=".'拦货数据_'.date("Y_m_d_H").".txt");

header("Expires: 0");

header("Cache-Control:must-revalidate,post-check=0,pre-check=0");

header("Pragma:public");
 if(!empty($mingxi2)){
 	$data7=explode(',',rtrim($mingxi2,','));
	foreach($data7 as $k7=>$v7){
		if(($k7+1)%200==0 && $k7>1){
			echo $v7.','."\r\n";
		}else{
			echo $v7.',';
		}
	}
}
echo "\r\n".'总笔数('.$sum.')/总金额('.$moneys1.')';	

	}



}
