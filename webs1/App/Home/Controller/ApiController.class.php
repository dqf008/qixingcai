<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
        public function apiNumber(){
            $opentime=M('opentime')->field('id,qishu')->order('id desc')->find();
            if(!empty($opentime)){
                  $qishu=$opentime['qishu'];//期数   
            }else{
                 $qishu='-1';//期数
            }
   

    $types=I('get.qtypes');//类型 1超额2金额3.赔率
    $moneys=I('get.moneys');//超额
    $start=I('get.start');//开始
    $finish=I('get.finish');//结束
    $stime=I('get.stime');//开始时间
    $etime=I('get.etime');//结束时间
    $type=I('get.type');//号码类型
    
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
       $where['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
       $where1['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
       $where2['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
       $where3['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
       $where4['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
       $where5['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
       $where6['addtime']=array(array('egt',($stime)),array('elt',($etime)),'and'); 
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
                        $moneys2=$v['moneys']-$moneys;
                        if($moneys2>0){
                            $sum+=1;
                            $moneys1+=$moneys2;
                            $mingxi2.=$v['mingxi_2'].'='.($moneys2).',';
                        }
                    }
                    $moneys2=0;
                }
            }
        }else{
            $data=$data2;
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
            $datas1=$data1;
             //有超额
            if($types==1 && !empty($moneys)){
                foreach($datas1 as $k1=>$v1){
                    // if($v['mingxi_1']=='4现'){
                    //  $v['mingxi_2']='a'.$v['mingxi_2'];
                    // }
                    //去掉揽货
                    if($v1['moneys']){
                        $moneys2=$v1['moneys']-$moneys;
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
                    //  $sum+=1;
                    //  $moneys1+=$v1['moneys'];
                    //  $mingxi2.=$v1['mingxi_2'].'='.($v1['moneys']).',';
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
            $datas2=$data2;
             //有超额
            if($types==1 && !empty($moneys)){
                foreach($datas2 as $k2=>$v2){
                    // if($v['mingxi_1']=='4现'){
                    //  $v['mingxi_2']='a'.$v['mingxi_2'];
                    // }
                    //去掉揽货
                    if($v2['moneys']){
                        $moneys3=$v2['moneys']-$moneys;
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
                    //  $sum+=1;
                    //  $moneys1+=$v2['moneys'];
                    //  $mingxi2.=$v2['mingxi_2'].'='.($v2['moneys']).',';
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
            $datas3=$data3;
             //有超额
            if($types==1 && !empty($moneys)){
                foreach($datas3 as $k3=>$v3){
                    // if($v['mingxi_1']=='4现'){
                    //  $v['mingxi_2']='a'.$v['mingxi_2'];
                    // }
                    //去掉揽货
                    if($v3['moneys']){
                        $moneys4=$v3['moneys']-$moneys;
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
                    //  $sum+=1;
                    //  $moneys1+=$v3['moneys'];
                    //  $mingxi2.=$v3['mingxi_2'].'='.($v3['moneys']).',';
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
            $datas4=$data4;
             //有超额
            if($types==1 && !empty($moneys)){
                foreach($datas4 as $k4=>$v4){
                    // if($v['mingxi_1']=='4现'){
                    //  $v['mingxi_2']='a'.$v['mingxi_2'];
                    // }
                    //去掉揽货
                    if($v4['moneys']){
                        $moneys5=$v4['moneys']-$moneys;
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
                    //  $sum+=1;
                    //  $moneys1+=$v4['moneys'];
                    //  $mingxi2.=$v4['mingxi_2'].'='.($v4['moneys']).',';
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
            $datas5=$data5;
             //有超额
            if($types==1 && !empty($moneys)){
                foreach($datas5 as $k5=>$v5){
                    // if($v['mingxi_1']=='4现'){
                    //  $v['mingxi_2']='a'.$v['mingxi_2'];
                    // }
                    //去掉揽货
                    if($v5['moneys']){
                        $moneys6=$v5['moneys']-$moneys;
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
                    //  $sum+=1;
                    //  $moneys1+=$v5['moneys'];
                    //  $mingxi2.=$v5['mingxi_2'].'='.($v5['moneys']).',';
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
            $datas6=$data6;
             //有超额
            if($types==1 && !empty($moneys)){
                foreach($datas6 as $k6=>$v6){
                    if($v6['mingxi_1']=='4现'){
                        $v6['mingxi_2']='a'.$v6['mingxi_2'];
                    }
                    //去掉揽货
                    if($v6['moneys']>0){
                        $moneys7=$v6['moneys']-$moneys;
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
                    //  $sum+=1;
                    //  $moneys1+=$v6['moneys'];
                    //  $mingxi2.=$v6['mingxi_2'].'='.($v6['moneys']).',';
                    // }
                }
            } 
        }
 


    }
     if(!empty($mingxi2)){
         $this->ajaxReturn($mingxi2);
     }
       

        }

}

