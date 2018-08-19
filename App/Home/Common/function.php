<?php
function ustatus(){
  $uIP=session('uIP');//登入标示
    $where['uid']=session('userid');
    $user=M('user')->field('usession')->where($where)->find();
    if($uIP!=$user['usession']){
      $t=1;
    }else{
      $t=2;
    }
    return $t;
}
function mStatus1(){
	 //最后一期是关闭销售状态
    $where['qishu']=session('qishu');
    $mission=M('opentime')->field('m_status,fengpan,kaijiang')->where($where)->order('id desc')->find();

    if(empty($mission)){
      $status=2;
      $arr=array($status);
      return $arr;exit;
    }

    if($mission['m_status']==3 || $mission['m_status']==2){//状态开奖了
      $titles='已封盘，尚未开盘';
      $titles1='已关盘，正在结算中...';
      $status=2;
      $status1=$status;
    }elseif($mission['m_status']==1){
         $status=1;
         $status1=$status;
      if(strtotime($mission['fengpan'])>time()){//封盘时间减去当前时间==离开盘时间
        $titles1='离停盘还有:';
        $time1=strtotime($mission['fengpan'])-time(); 
       //  $titles2='离开奖还有:';
       // // $titles1='已停盘';
       //  $time2=strtotime($mission['kaijiang'])-time(); 
        
       }elseif(time()<strtotime($mission['kaijiang'])){////封盘时间减去当前时间==离开盘时间
        //$status=3;
         $titles1='离开奖还有:';
       // $titles1='已停盘';
        $time1=strtotime($mission['kaijiang'])-time(); 
         $status1=2;
      }else{
          $status=2;
           $status1=$status;
      }

    }
    $arr=array($status,$time1,$titles1,$time2,$titles2,$status1);
    return $arr;
    //未开始销售状态
    // if($mission['ok']==1){
    //     $status=5;
    // }else{
    //     $status=3;
    //     //$time=intval($mission['m_seal'])-intval(time());
    //     if(strtotime($mission['fengpan'])>time()){
    //     //  echo '过了封盘时间，等待开奖';
    //     // }else{//开奖时间实时更新
    //         $status=1;
    //         $time=strtotime($mission['fengpan'])-time();    
    //     }
    // }
    // $arr=array($status,$time);
    // return $arr;
	
}
function user(){
	$where['uid']=session('userid');
	$data=M('user')->field('money')->where($where)->find();

	$money=$data['money'];
	return $money;
}
function opentime(){
	$where['qishu']=session('qishu');
	$data=M('opentime')->where($where)->order('id desc')->find();

	return $data;
}
function getData(){

  $data=M('opentime')->order('id desc')->select();

  return $data;
}
//赔率换算
function get_odd2($num,$weishu,$types,$data,$data1){//号码，数，类型
  //global $db_config;
   //判断该号码是否限售
   $qishu=$_SESSION['qishu'];
   // $where3['qishu']=$qishu;
   // $where3['numbers']=$num;
    $where3['qishu']=$qishu;
   $where3['p_type']=5;
   $where3['name']=$num;

   $prohibit=M('prohibit')->where($where3)->find();

   if($prohibit){
    $arr=array('code'=>400);
    return $arr;
    exit;
   }
   // //得到用户下的赔率配置
   // $uid=$_SESSION['uid'];
   // $where['uid']=$uid;
   // $data=M('k_uloss' , $db_config)->where($where)->limit(1)->find();//用户赔率
   // $where1['qishu']=$qishu;
   // $data1=M('k_opentime' , $db_config)->where($where1)->limit(1)->find();//原始赔率
   if($data1['2ding_xiane']!=1 || empty($data1)){
    $arr=array('code'=>400);
    return $arr;
    exit;
   }
    $loss2=json_decode($data1['m_loss']);//原始赔率和下滑值
    $market=json_decode($data1['m_sales']);//单注上限
     //得到改号码股东是否修改赔率和销售上限
      $where4['qishu']=$qishu;
      $where4['name']=$num;
      $where4['type']=5;
      $markets=M('markets')->where($where4)->find();

   if(!empty($data)){
    //得到改号码是否销售
    // $where2['qishu']=$qishu;
    // $where2['mingxi_1']='2定';
    // $where2['mingxi_2']=$num;
    $where2['qishu']=$qishu;
    $where2['mingxi_1']='2定';
    $where2['mingxi_2']=$num;
    $where2['js']='0';
    $money=M('bet')->field('money')->where($where2)->sum('money');//该号码销售
    $loss1=json_decode($data['loss']);//用户赔率配置

   
      
    if($money){//存在从新算赔率
      //通过销售汇总得到赔率的下滑值
      // foreach($bets as $k=>$v){
      //     $money+=$v['money'];
      // }
      $loss3=$loss1[4]->ding2;//赔率
      $loss4=$loss1[4]->loss2;//回水
      $xhz1=$loss2->ding22;//下滑基数
      $xhz2=$loss2->ding23;//每增加数
      $xhz3=$loss2->ding24;//下滑值
      $market1=$market->ding21;
      $market2=$market->ding22;
      $market3=$market->ding23;

        //股东修改赔率和单注上限
        if($markets){
          $c_loss=$markets['loss'];
          $c_markets=$markets['markets'];
          if(!empty($c_loss)){
            $loss3=$c_loss;
          }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
      

        if(!empty($money)){
          
        if($money>=$market1){//判断总数是否超过每码销售值 
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss3=$loss3-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss3=$loss3-($money2*$xhz3);
              if(($loss3+$xhz3) < $xhz3 ){
                  $arrs=array('code'=>400);
                  return $arrs;
                  exit;
              }
            }
          }
          //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
          if(($market1-$money)<$market2){
              $market2=$market1-$money;
          }

       }
        $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
    
    }else{//走用户赔率
      $market1=$market->ding21;
      $market2=$market->ding22;
      $market3=$market->ding23;
      $loss3=$loss1[4]->ding2;
      $loss4=$loss1[4]->loss2;
      $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
    }

    

   }else{//不存在走股东赔率
      $loss3=$loss2->ding21;
      $loss4=0;
      $market1=$market->ding21;
      $market2=$market->ding22;
      $market3=$market->ding23;
      $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
   }
    //return $loss3;exit;
   return $arrs;
   exit;
   //$qishu=$_SESSION['qishu'];
   //判断该号码的下注的赔率换算
   //返回状态，赔率和回水

}


//赔率换算
function get_odd3($num,$weishu,$types,$data,$data1,$qishu,$prohibits,$markets1,$bets){//号码，数，类型,用户赔率，期数据
  //判断该号码是否限售
  $where3['qishu']=$qishu;
  $where3['p_type']=5;
  $where3['name']=$num;

  $prohibit=$prohibits->field('p_id')->where($where3)->find();
   if(!empty($prohibit)){//判断该号码是否限售
    $arr=array('code'=>400);
    return $arr;
    exit;
   }
  
   //没有期号赔率或者改号码禁止销售
   // if($data1['2ding_xiane']!=1 || empty($data1)){
   //  $arr=array('code'=>400);
   //  return $arr;
   //  exit;
   // }
    $loss2=json_decode($data1['m_loss']);//原始赔率和下滑值
    $market=json_decode($data1['m_sales']);//单注上限
    //得到改号码股东是否修改赔率和销售上限
      $where4['qishu']=$qishu;
      $where4['name']=$num;
      $where4['type']=5;
      $markets=$markets1->field('loss,markets')->where($where4)->find();
     
    //会员赔率了回水
    //改号码有销售-->相对应修改赔率
    $where2['qishu']=$qishu;
    $where2['mingxi_1']='2定';
    $where2['mingxi_2']=$num;
    $where2['js']='0';
    $money=$bets->field('money')->where($where2)->sum('money');//该号码销售
     //dump($data);exit;
   if(!empty($data) && !empty($data['loss'])){
   
    $loss1=json_decode($data['loss']);//用户赔率配置
    $loss3=$loss1[4]->ding2;//赔率
    $loss4=$loss1[4]->loss2;//回水
    // $loss3=$loss2->ding21;//赔率
    // $loss4=$loss1[4]->loss2;//回水
    $xhz1=$loss2->ding22;//下滑基数
    $xhz2=$loss2->ding23;//每增加数
    $xhz3=$loss2->ding24;//下滑值
    $market1=$market->ding21;//号码(总)销售
    $market2=$market->ding22;//号码(最多下注)销售
    $market3=$market->ding23;//号码(最新下注)销售
    if(!empty($money) && $data1['m_odds']==1){//存在从新算赔率
        //股东修改赔率和单注上限
        if($markets){
          $c_loss=$markets['loss'];
          $c_markets=$markets['markets'];
          if(!empty($c_loss)){
            $loss3=$c_loss;
          }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
          
        if($money>=$market1){//判断总数是否超过每码销售值 
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss3=$loss3-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss3=$loss3-($money2*$xhz3);
              if(($loss3+$xhz3) < $xhz3 ){
                  $arrs=array('code'=>400);
                  return $arrs;
                  exit;
              }
            }
          }
          //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
          if(($market1-$money)<$market2){
              $market2=$market1-$money;
          }
        $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
    
    }else{//走用户赔率
      $market1=$market->ding21;
      $market2=$market->ding22;
      $market3=$market->ding23;
      $loss3=$loss2->ding21;
      $loss4=$loss1[4]->loss2;
       $pl=$loss2->ding21;
        for($i=0;$i<=250;$i++){
            if($i<10){
                $g='0.00'.$i;
            }elseif($i>=10 && $i<=99){
                $g='0.0'.$i;
            }else{
               $g='0.'.$i; 
            }
            if($g=='0.000'){
                $g=0;
            }
           $f[]= $g; 
        }
        for($a14=0;$a14<count($f);$a14++){
            $arr14=$a14;
            if($a14<=9){
                $c14=$pl-('0.'.substr($arr14,-1,1));
            }elseif($a14>9 && $a14<=99){
                $c14=$pl-(substr($arr14,-2,1).'.'.substr($arr14,-1,1));
            }else{
                $c14=$pl-(substr($arr14,-3,2).'.'.substr($arr14,-1,1));
            }
            if($c14<1){
             $c14=0;
            }
            $d14[]=$c14; 
        }
        for($h=0;$h<count($d14);$h++){
          if($loss4==$f[$h]){
            $loss3=$d14[$h];
          }
 
        }


      if(!empty($money)){
        if($money>=$market1){//判断总数是否超过每码销售值 
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if(($market1-$money)<$market2){
          $market2=$market1-$money;
        }
      }
      $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
    }

    

   }else{//不存在走股东赔率
    $loss3=$loss2->ding21;//赔率
    $loss4=0;//回水
    $xhz1=$loss2->ding22;//下滑基数
    $xhz2=$loss2->ding23;//每增加数
    $xhz3=$loss2->ding24;//下滑值
    $market1=$market->ding21;//号码(总)销售
    $market2=$market->ding22;//号码(最多下注)销售
    $market3=$market->ding23;//号码(最新下注)销售
    if(!empty($money) && $data1['m_odds']==1){//存在从新算赔率
        //股东修改赔率和单注上限
        if($markets){
          $c_loss=$markets['loss'];
          $c_markets=$markets['markets'];
           if(!empty($c_loss)){
             $loss3=$c_loss;
           }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
         
        if($money>=$market1){//判断总数是否超过每码销售值 
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss3=$loss3-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss3=$loss3-($money2*$xhz3);
              if(($loss3+$xhz3) < $xhz3 ){
                  $arrs=array('code'=>400);
                  return $arrs;
                  exit;
              }
            }
          }
          //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
          if(($market1-$money)<$market2){
              $market2=$market1-$money;
          }
        $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
    
    }else{
      $loss3=$loss2->ding21;
      $loss4=0;
      $market1=$market->ding21;
      $market2=$market->ding22;
      $market3=$market->ding23;
      if(!empty($money)){
        if($money>=$market1){//判断总数是否超过每码销售值 
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if(($market1-$money)<$market2){
          $market2=$market1-$money;
        }
      }
      $arrs=array('code'=>200,$loss3,$loss4,$market2,$market3);//赔率，回水，可以下注金额、最小下注金额
    }
      
   }
    //return $loss3;exit;
   return $arrs;
   exit;
   //$qishu=$_SESSION['qishu'];
   //判断该号码的下注的赔率换算
   //返回状态，赔率和回水

}




?>