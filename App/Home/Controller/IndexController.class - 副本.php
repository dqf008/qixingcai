<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

     $opentimes= M('opentime');
        // 查询是否开盘
      $now_time = date("Y-m-d H:i:s",time());
      $where['qishu']=session('qishu');
      //$where['ok']=1;
      //$where = "ok ='0' and fengpan > '" . $now_time . "'";
      $data_time = M('opentime')->where($where)->find();
      // if($data_time){
      //     $now_time_day = date("d");//当前的号
      //     $f_t = $data_time['fengpan'];//封盘时间
      //     $o_t = $data_time['kaipan'];//开盘时间
      //     $f_t_day = explode('-', $o_t);
      //     $f_t_day = $f_t_day[2];//开盘的日
      //     $left_hours = ($f_t_day - $now_time_day) * 24 * 60 * 60; // 距离下次开盘的天数换成秒
      //     $f_stime = strtotime($f_t) - strtotime($now_time); // 距离封盘的时间
      //     $o_stime = (strtotime($o_t) - strtotime($now_time)) + $left_hours; // 距离开盘的时间
      //     $f_state = $data_time['fengpan']; // 封盘状态判断时间
      //     $o_state = $data_time['kaipan']; // 开盘状态判断时间 
      // }


      // $this->assign('f_stime',$f_stime);
      // $this->assign('o_stime',$o_stime);
      // $this->assign('now_time',$now_time);
      // $this->assign('f_state',$f_state);
      // $this->assign('o_state',$o_state);    



        $opentime=opentime();
        $market=json_decode($opentime['m_sales']);//单注上限
        $market1=$market->ding21;
        $market2=$market->ding22;
        $market3=$market->ding23;

        $bets=M('bet');
        //滚动信息
        $wher['n_status']=1;
        $news=M('news')->where($wher)->select();
        if($news){
          foreach($news as $k=>$v){
            if($v['n_type']==1){
              $news1=$v;
            }else{
              $news2=$v;  
            }
          }
        }
        //var_dump($news2);
         $this->assign('news1',$news1); 
         $this->assign('news2',$news2); 
        //禁止下注号码
        $qishu=session('qishu');
        $uid=session('userid');

        $where1['uid']=$uid;
        $where1['qishu']=$qishu;
        $where1['js']=4;
        $data=$bets->where($where1)->select();
        //开奖号码
        $data2=$opentimes->order('id desc')->limit(10)->select(); 
        //会员资料
        //赔率和单注上限（1直码/2两同/3三同/4四同/5两定/6三定）
      if($data_time['m_loss']){
        $loss=json_decode($data_time['m_loss']);
        $market=json_decode($data_time['m_sales']);
      }
      $wheres2['uid']=$uid;
      $configs=M("uloss")->where($wheres2)->find();
      if($configs){
        $uloss=json_decode($configs['loss']);
        //四定
        $uloss1=$uloss[0]->loss4;
        $uloss2=$uloss[1]->loss21;
        $uloss3=$uloss[1]->loss22;
        //var_dump($uloss3);
        $uloss4=$uloss[2]->loss31;
        $uloss5=$uloss[2]->loss32;
        $uloss6=$uloss[2]->loss33;

        $uloss7=$uloss[3]->loss41;
        $uloss8=$uloss[3]->loss42;
        $uloss9=$uloss[3]->loss43;
        $uloss10=$uloss[3]->loss44;
        $uloss11=$uloss[3]->loss45;
        $uloss12=$uloss[4]->loss2;
        $uloss13=$uloss[5]->loss3;
      }
      if($loss){
        /////////四定
        $pl3=$loss->ding41;
        if($pl3>3000){
          $pl13=$loss->ding41-2500;
          $sums3=($pl3)-($pl13);
          for($i3=0;$i3<=$sums3;$i3++){
              if($i3<10){
                  $g3='0.00'.$i3;
              }elseif($i3>=10 && $i3<=99){
                  $g3='0.0'.$i3;
              }else{
                 $g3='0.'.$i3; 
              }
              if($g3=='0.000'){
                  $g3=0;
              }
             $f3[]= $g3; 
             
          }
          for($a3=$pl3;$a3>$pl13;$a3--){
            if($a3==10000 ||$a3==9900 ||$a3==9800 || $a3==9700 || $a3==9600 || $a3==9500 || $a3==9400 || $a3==9300 || $a3==9200 || $a3==9100 || $a3==9000 || $a3==8900 || $a3==8800 || $a3==8700 || $a3==8600 || $a3==8500 || $a3==8400 || $a3==8300 || $a3==8200 || $a3==8100 || $a3==8000 || $a3==7900 || $a3==7800 || $a3==7700 || $a3==7600 || $a3==7500 || $a3==7400 || $a3==7300 || $a3==7200 || $a3==7100 || $a3==7000 || $a3==6900 || $a3==6800 || $a3==6700 || $a3==6600 || $a3==6500 || $a3==6400 || $a3==6300 || $a3==6200 || $a3==6100 || $a3==6000 || $a3==5900 || $a3==5800 || $a3==5700 || $a3==5600 || $a3==5500 || $a3==5400 || $a3==5300 || $a3==5200 || $a3==5100 || $a3==5000 || $a3==4900 || $a3==4800 || $a3==4700 || $a3==4600 || $a3==4500 || $a3==4400 || $a3==4300 || $a3==4200 || $a3==4100 || $a3==4000 || $a3==3900 || $a3==3800 || $a3==3700 || $a3==3600 || $a3==3500 || $a3==3400 || $a3==3300 || $a3==3200 || $a3==3100 || $a3==3000 ){
              for($b3=0;$b3<10;$b3++){
                  $c3= $a3-($b3.'0');
                  $d3[]=$c3;
              }   
            }   
          }
          $d3[]=$pl13;
          for($h3=0;$h3<count($d3);$h3++){
            if($uloss1==$f3[$h3]){
              $j1.= '<option value="'.$f3[$h3].'/'.$d3[$h3].'" selected>'.$f3[$h3].'/'.$d3[$h3].'</option>';
            }else{
              $j1.= '<option value="'.$f3[$h3].'/'.$d3[$h3].'">'.$f3[$h3].'/'.$d3[$h3].'</option>';
            }
          }

      }
        /////////二现
            
        $pl6=$loss->tong211;
        if($pl6>3){
        for($i6=0;$i6<=250;$i6++){
            if($i6<10){
                $g6='0.00'.$i6;
            }elseif($i6>=10 && $i6<=99){
                $g6='0.0'.$i6;
            }else{
               $g6='0.'.$i6; 
            }
            if($g6=='0.000'){
                $g6=0;
            }
           $f6[]= $g6; 
           
        }
         for($a6=0;$a6<count($f6);$a6++){

            $arr='0.'.$a6;
            $arr6=explode(".",$arr);
          if($a6>9 && $a6<=99){
              //echo $arr[3];
              $c6= $pl6-('0.'.$arr6[1]);
          }elseif($a6>99 && $a6<=199){
            $c6= $pl6-('1.'.substr($arr6[1],-2));
          }elseif($a6>199){
            $c6= $pl6-('2.'.substr($arr6[1],-2));
          }else{
            $c6= $pl6-('0.0'.$a6);
          }
              
            $d6[]=$c6; 
        }
        for($h6=0;$h6<count($d6);$h6++){
          if($uloss2==$f6[$h6]){
              $j2.= '<option value="'.$f6[$h6].'/'.$d6[$h6].'" selected>'.$f6[$h6].'/'.$d6[$h6].'</option>';
           }else{
             $j2.= '<option value="'.$f6[$h6].'/'.$d6[$h6].'">'.$f6[$h6].'/'.$d6[$h6].'</option>'; 
          }
        }

       }

        $pl7=$loss->tong221;
        for($i7=0;$i7<=250;$i7++){
            if($i7<10){
                $g7='0.00'.$i7;
            }elseif($i7>=10 && $i7<=99){
                $g7='0.0'.$i7;
            }else{
               $g7='0.'.$i7; 
            }
            if($g7=='0.000'){
                $g7=0;
            }
           $f7[]= $g7; 
           
        }
        for($a7=0;$a7<count($f7);$a7++){

            $arr='0.'.$a7;
            $arr7=explode(".",$arr);
          if($a7>9 && $a7<=99){
              //echo $arr[3];
              $c7= $pl7-(('0.'.$arr7[1])*2);
          }elseif($a7>99 && $a7<=199){
            $c7= $pl7-(('1.'.substr($arr7[1],-2))*2);
          }elseif($a7>199){
            $c7= $pl7-(('2.'.substr($arr7[1],-2))*2);
          }else{
            $c7= $pl7-(('0.0'.$a7)*2);
          }
              
            $d7[]=$c7; 
        }
        for($h7=0;$h7<count($d7);$h7++){
          if($uloss3==$f7[$h7]){
             $j3.= '<option value="'.$f7[$h7].'/'.$d7[$h7].'" selected>'.$f7[$h7].'/'.$d7[$h7].'</option>';
           }else{
             $j3.= '<option value="'.$f7[$h7].'/'.$d7[$h7].'">'.$f7[$h7].'/'.$d7[$h7].'</option>'; 
          }
         
        }
        /////////三现

        $pl4=$loss->tong311;
        $pl14=$loss->tong311-2.5;
       // $pl14=35;
        $sums4=($pl4.'0')-($pl14.'0');
        for($i4=0;$i4<=250;$i4++){
            if($i4<10){
                $g4='0.00'.$i4;
            }elseif($i4>=10 && $i4<=99){
                $g4='0.0'.$i4;
            }else{
               $g4='0.'.$i4; 
            }
            if($g4=='0.000'){
                $g4=0;
            }
           $f4[]= $g4;  
        }

        for($a4=0;$a4<count($f4);$a4++){
            $arr='0.'.$a4;
            $arr1=explode(".",$arr);
          if($a4>9 && $a4<99){
              //echo $arr[3];
              $c4= $pl4-(('0.'.$arr1[1])*5);
          }elseif($a4>99 && $a4<199){
            $c4= $pl4-(('1.'.substr($arr1[1],-2))*5);
          }elseif($a4>199){
            $c4= $pl4-(('2.'.substr($arr1[1],-2))*5);
          }else{
            $c4= $pl4-(('0.0'.$a4)*5);
          }
              
            $d4[]=$c4; 
        }

        for($h4=0;$h4<count($d4);$h4++){

          if($uloss4==$f4[$h4]){
            $j4.= '<option value="'.$f4[$h4].'/'.$d4[$h4].'" selected>'.$f4[$h4].'/'.$d4[$h4].'</option>';
          }else{
            $j4.= '<option value="'.$f4[$h4].'/'.$d4[$h4].'">'.$f4[$h4].'/'.$d4[$h4].'</option>';
          }
         
        }

      $pl8=$loss->tong321;
        $pl18=$loss->tong321-2.5;
        $sums8=($pl8.'0')-($pl18.'0');
        for($i8=0;$i8<=250;$i8++){
            if($i8<10){
                $g8='0.00'.$i8;
            }elseif($i8>=10 && $i8<=99){
                $g8='0.0'.$i8;
            }else{
               $g8='0.'.$i8; 
            }
            if($g8=='0.000'){
                $g8=0;
            }
           $f8[]= $g8; 
           
        }
        for($a8=0;$a8<count($f8);$a8++){
            $arr8=$a8;
            if($a8<=9){
                $c8=$pl8-('0.'.substr($arr8,-1,1));
            }elseif($a8>9 && $a8<=99){
                $c8=$pl8-(substr($arr8,-2,1).'.'.substr($arr8,-1,1));
            }else{
                $c8=$pl8-(substr($arr8,-3,2).'.'.substr($arr8,-1,1));
            }
              
            $d8[]=$c8; 
        }
        for($h8=0;$h8<count($d8);$h8++){
   
          if($uloss5==$f8[$h8]){
            $j5.= '<option value="'.$f8[$h8].'/'.$d8[$h8].'" selected>'.$f8[$h8].'/'.$d8[$h8].'</option>';
          }else{
            $j5.= '<option value="'.$f8[$h8].'/'.$d8[$h8].'">'.$f8[$h8].'/'.$d8[$h8].'</option>';
          }
         
        }
         $pl9=$loss->tong331;
        $pl19=35;
        $sums9=($pl9.'0')-($pl19.'0');
        for($i9=0;$i9<=250;$i9++){
            if($i9<10){
                $g9='0.00'.$i9;
            }elseif($i9>=10 && $i9<=99){
                $g9='0.0'.$i9;
            }else{
               $g9='0.'.$i9; 
            }
            if($g9=='0.000'){
                $g9=0;
            }
           $f9[]= $g9; 
           
        }
         for($a9=0;$a9<count($f9);$a9++){

            $arr='0.'.$a9;
            $arr9=explode(".",$arr);
          if($a9>9 && $a9<99){
              //echo $arr[3];
              $c9= $pl9-(('0.'.$arr9[1])*2);
          }elseif($a9>99 && $a9<199){
            $c9= $pl9-(('1.'.substr($arr9[1],-2))*2);
          }elseif($a9>199){
            $c9= $pl9-(('2.'.substr($arr9[1],-2))*2);
          }else{
            $c9= $pl9-(('0.'.$a9)*2);
          }
              
            $d9[]=$c9; 
        }
        for($h9=0;$h9<count($d9);$h9++){

          if($uloss6==$f9[$h9]){
            $j6.= '<option value="'.$f9[$h9].'/'.$d9[$h9].'" selected>'.$f9[$h9].'/'.$d9[$h9].'</option>';
          }else{
            $j6.= '<option value="'.$f9[$h9].'/'.$d9[$h9].'">'.$f9[$h9].'/'.$d9[$h9].'</option>';
          }
         
        }
        /////////四现
        $pl5=$loss->tong411;
        $pl15=320;
        $sums5=$pl5-$pl15;
        for($i5=0;$i5<=250;$i5++){
            if($i5<10){
                $g5='0.00'.$i5;
            }elseif($i5>=10 && $i5<=99){
                $g5='0.0'.$i5;
            }else{
               $g5='0.'.$i5; 
            }
            if($g5=='0.000'){
                $g5=0;
            }
           $f5[]= $g5; 
           
        }

        for($a5=0;$a5<count($f5);$a5++){

            $arr='0.'.$a5;
            $arr5=explode(".",$arr);
          if($a5>9 && $a5<100){
              $c5= $pl5-(('0.'.$arr5[1])*4);
          }elseif($a5>100 && $a5<200){
            $c5= $pl5-(('1.'.substr($arr5[1],-2))*4);
          }elseif($a5>200){
            $c5= $pl5-(('2.'.substr($arr5[1],-2))*4);
          }else{
            $c5= $pl5-(('0.'.$arr5[1])*4);
          }
              
            $d5[]=$c5; 
        }
        for($h5=0;$h5<count($d5);$h5++){
          if($uloss7==$f5[$h5]){
             $j7.= '<option value="'.$f5[$h5].'/'.$d5[$h5].'" selected>'.$f5[$h5].'/'.$d5[$h5].'</option>'; 
          }else{
            $j7.= '<option value="'.$f5[$h5].'/'.$d5[$h5].'">'.$f5[$h5].'/'.$d5[$h5].'</option>';
          }

        }

        $pl10=$loss->tong421;
        $pl110=580;
        $sums10=$pl10-$pl110;
        for($i10=0;$i10<=250;$i10++){
            if($i10<10){
                $g10='0.00'.$i10;
            }elseif($i10>=10 && $i10<=99){
                $g10='0.0'.$i10;
            }else{
               $g10='0.'.$i10; 
            }
            if($g10=='0.000'){
                $g10=0;
            }
           $f10[]= $g10; 
        }
         for($a10=0;$a10<count($f10);$a10++){

            $arr='0.'.$a10;
            $arr10=explode(".",$arr);
          if($a10>9 && $a10<99){
              $c10= $pl10-(('0.'.$arr10[1])*8);
          }elseif($a10>99 && $a10<199){
            $c10= $pl10-(('1.'.substr($arr10[1],-2))*8);
          }elseif($a10>199){
            $c10= $pl10-(('2.'.substr($arr10[1],-2))*8);
          }else{
            $c10= $pl10-(('0.'.$a10)*8);
          }
            $d10[]=$c10; 
        }    
        for($h10=0;$h10<count($d10);$h10++){

          if($uloss8==$f10[$h10]){
             $j8.= '<option value="'.$f10[$h10].'/'.$d10[$h10].'" selected>'.$f10[$h10].'/'.$d10[$h10].'</option>'; 
          }else{
            $j8.= '<option value="'.$f10[$h10].'/'.$d10[$h10].'">'.$f10[$h10].'/'.$d10[$h10].'</option>';
          }

        }

        $pl11=$loss->tong431;
        $pl111=580;
        $sums11=$pl11-$pl111;
        for($i11=0;$i11<=250;$i11++){
            if($i11<11){
                $g11='0.00'.$i11;
            }elseif($i11>=11 && $i11<=99){
                $g11='0.0'.$i11;
            }else{
               $g11='0.'.$i11; 
            }
            if($g11=='0.000'){
                $g11=0;
            }
           $f11[]= $g11;  
        }
        for($a11=0;$a11<count($f11);$a11++){

            $arr='0.'.$a11;
            $arr11=explode(".",$arr);
          if($a11>9 && $a11<99){
              //echo $arr[3];
              $c11= $pl11-(($arr11[1])*2);
          }elseif($a11>99 && $a11<199){
            $c11= $pl11-(('1'.substr($arr11[1],-2))*2);
          }elseif($a11>199){
            $c11= $pl11-(('2'.substr($arr11[1],-2))*2);
          }else{
            $c11= $pl11-($a11*2);
          } 
            $d11[]=$c11; 
        }
        for($h11=0;$h11<count($d11);$h11++){
          if($uloss9==$f11[$h11]){
             $j9.= '<option value="'.$f11[$h11].'/'.$d11[$h11].'" selected>'.$f11[$h11].'/'.$d11[$h11].'</option>'; 
          }else{
            $j9.= '<option value="'.$f11[$h11].'/'.$d11[$h11].'">'.$f11[$h11].'/'.$d11[$h11].'</option>';
          }
        }
        $pl12=$loss->tong441;
        $pl121=1110;
        $sums12=$pl12-$pl121;
        for($i12=0;$i12<=250;$i12++){
            if($i12<12){
                $g12='0.00'.$i12;
            }elseif($i12>=12 && $i12<=99){
                $g12='0.0'.$i12;
            }else{
               $g12='0.'.$i12; 
            }
            if($g12=='0.000'){
                $g12=0;
            }
           $f12[]= $g12;   
        }
        for($a12=0;$a12<count($f12);$a12++){
            $arr='0.'.$a12;
            $arr12=explode(".",$arr);
          if($a12>9 && $a12<99){
            $c12= $pl12-(($arr12[1])*2);
          }elseif($a12>99 && $a12<199){
            $c12= $pl12-(('1'.substr($arr12[1],-2))*2);
          }elseif($a12>199){
            $c12= $pl12-(('2'.substr($arr12[1],-2))*2);
          }else{
            $c12= $pl12-($a12*2);
          } 
            $d12[]=$c12; 
        }
        
        for($h12=0;$h12<count($d12);$h12++){
          if($uloss10==$f12[$h12]){
             $j10.= '<option value="'.$f12[$h12].'/'.$d12[$h12].'" selected>'.$f12[$h12].'/'.$d12[$h12].'</option>'; 
          }else{
            $j10.= '<option value="'.$f12[$h12].'/'.$d12[$h12].'">'.$f12[$h12].'/'.$d12[$h12].'</option>';
          }
        }

        $pl13=$loss->tong451;
        for($i13=0;$i13<=250;$i13++){
            if($i13<12){
                $g13='0.00'.$i13;
            }elseif($i13>=12 && $i13<=99){
                $g13='0.0'.$i13;
            }else{
               $g13='0.'.$i13; 
            }
            if($g13=='0.000'){
                $g13=0;
            }
           $f13[]= $g13;  
        }
        for($a13=0;$a13<count($f13);$a13++){
            $arr='0.'.$a13;
            $arr13=explode(".",$arr);
          if($a13>9 && $a13<99){
              $c13= $pl13-(($arr13[1])*10);
          }elseif($a13>99 && $a13<199){
            $c13= $pl13-(('1'.substr($arr13[1],-2))*10);
          }elseif($a13>199){
            $c13= $pl13-(('2'.substr($arr13[1],-2))*10);
          }else{
            $c13= $pl13-($a13*10);
          } 
          $d13[]=$c13; 
        }
        for($h13=0;$h13<count($d13);$h13++){
          if($uloss11==$f13[$h13]){
             $j11.= '<option value="'.$f13[$h13].'/'.$d13[$h13].'" selected>'.$f13[$h13].'/'.$d13[$h13].'</option>'; 
          }else{
            $j11.= '<option value="'.$f13[$h13].'/'.$d13[$h13].'">'.$f13[$h13].'/'.$d13[$h13].'</option>';
          }
        }
        /////////////二定
        $pl=$loss->ding21;
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
            $d14[]=$c14; 
        }
        for($h=0;$h<count($d14);$h++){
          if($uloss12==$f[$h]){
            $j12.= '<option value="'.$f[$h].'/'.$d14[$h].'" selected>'.$f[$h].'/'.$d14[$h].'</option>';
          }else{
            $j12.= '<option value="'.$f[$h].'/'.$d14[$h].'">'.$f[$h].'/'.$d14[$h].'</option>';
          }
 
        }
        /////////三定
        $pl2=$loss->ding31;
        for($i2=0;$i2<=250;$i2++){
            if($i2<10){
                $g2='0.00'.$i2;
            }elseif($i2>=10 && $i2<=99){
                $g2='0.0'.$i2;
            }else{
               $g2='0.'.$i2; 
            }
            if($g2=='0.000'){
                $g2=0;
            }
           $f2[]= $g2; 
           
        }
        for($a2=0;$a2<count($f2);$a2++){
            $arr='0.'.$a2;
            $arr2=explode(".",$arr);
          if($a2>9 && $a2<99){
              $c2= $pl2-(($arr2[1])*1);
          }elseif($a2>99 && $a2<199){
            $c2= $pl2-(('1'.substr($arr2[1],-2))*1);
          }elseif($a2>199){
            $c2= $pl2-(('2'.substr($arr2[1],-2))*1);
          }else{
            $c2= $pl2-($a2*1);
          }
          $d2[]=$c2; 
        }
        for($h2=0;$h2<count($d2);$h2++){
          if($uloss13==$f2[$h2]){
            $j13.= '<option value="'.$f2[$h2].'/'.$d2[$h2].'" selected>'.$f2[$h2].'/'.$d2[$h2].'</option>';
          }else{
            $j13.= '<option value="'.$f2[$h2].'/'.$d2[$h2].'">'.$f2[$h2].'/'.$d2[$h2].'</option>';
          }

        }
   }
      // var_dump($market);
      // var_dump($loss);
      //二定
      $this->assign("j1",$j1);
      $this->assign("j2",$j2);
       $this->assign("j3",$j3);
      $this->assign("j4",$j4);
      $this->assign("j5",$j5);
      $this->assign("j6",$j6);
      $this->assign("j7",$j7);
      $this->assign("j8",$j8);
      $this->assign("j9",$j9);
      $this->assign("j10",$j10);
      $this->assign("j11",$j11);
      $this->assign("j12",$j12);
      $this->assign("j13",$j13);

      $this->assign("loss",$loss);
      $this->assign("market",$market);
        //使用期数
        $getData=getData();
            
        $this->assign('getData',$getData);//所有期数
        $this->assign('data3',$data3);//本期下注明细
        $this->assign('data2',$data2);//开奖号码
        $this->assign('data',$data);//禁止下注号码
        $this->assign('market2',$market2);//下注上限
        $this->assign('market3',$market3);//下注下限
        $this->display();
    }
    //会员资料
    public function appprint(){
    	//编号
    	// $did = date("ymd") . mt_rand("10000", "99999");
    	// $time=date('Y-m-d H:i:s');
    	
    	// $this->assign('did',$did);
    	// $this->assign('time',$time);
    	 $this->display();
    }
    //打印区
    public function appindexajax(){
        //$where['uid']=session('userid');
       // $user=M('user')->where($where)->find();
        $where['uid']=session('userid'); 
       $where['qishu']=session('qishu');
       $where['js']=0;
       $where['index_id']=2;
        $bets=M('bet');
        $dd=$bets->where($where)->order('id desc')->find();
        $where1['uid']=session('userid'); 
          $where1['qishu']=session('qishu');
          $where1['js']=0;
          $data1=$bets->where($where1)->select();
          if($data1){
            foreach($data1 as $k1=>$v1){
                $data['money']+=$v1['money'];
            }
            
          }
          $data['moneys']=user();//用户总积分
        if(!empty($dd)){
          $data['data']=$bets->where($where)->order('id desc')->select();
            $data['code']=200;
            foreach($data['data'] as $k=>$v){
                $data['data'][$k]['money']=intval($v['money']);
                $money+=$v['money'];
            }
            
            $count=count($data['data']);//笔数
            //$data['moneys']=user();//用户总积分
            $data['count']=$count;//笔数
            $data['money1']=$money;//总金额
            $data['time']=date('Y-m-d H:i',$data['data'][$count-1]['addtime']);//下注时间
            $data['did']=$data['data'][$count-1]['did'];//下注编号
        }else{

            $data['code']=400;
        }
        echo json_encode($data);exit;
    }

    //下注框
    public function xiazhukuang(){
        $where['uid']=session('userid');
        $where['qishu']=session('qishu');
        $where['js']=array('not in','4');

        $data['data']=M('bet')->where($where)->order('id desc')->limit(10)->select();
        if(!empty($data['data'])){
            $data['code']=200;
        }else{
            $data['code']=400;
        }

        echo json_encode($data);exit;
    }
    //退码
    public function tuima(){
        //得到退码时间
        $where1['qishu']=session('qishu');
        $time=M('opentime')->where($where1)->find();
        $id=explode('|',I('post.tuimaid'));
        $uid=session('userid');
        // $where['qishu']=session('qishu');
        //$id=I('post.id');
        $where['id']=array('in',$id);
        $where['uid']=$uid;
        $bets=M('bet');
        $data=$bets->where($where)->select();
        if($data){
            foreach($data as $k=>$v){
                if((time()-($v['addtime']))<= ($time['m_retreat']*60)){
                    $idArr.=$v['id'].',';
                }
            }
            if(!empty($idArr)){
                $where2['id']=array('in',$idArr);
                $where2['uid']=$uid;
                $data1['js']=2;
                $data1['tuima_time']=time();
                $dd=$bets->where($where2)->save($data1);
                $datas=$bets->field('money')->where($where2)->select($data1);
                foreach($datas as $k1=>$v1){
                    if($v1['money']){
                      $moneys+=$v1['money'];
                    }
                }
                $where3['uid']=$uid;
                $data2['money']=user()+$moneys;
                $dd=M('user')->where($where3)->save($data2);
            }
            
        }
        
       // var_dump($_GET);exit;
        $status['code']=200;
        echo json_encode($status);exit;
    }
    //用户赔率
    public function userloss(){

      $where['uid']=session('userid');
      $data=M('uloss')->where($where)->limit(1)->find();
      if($data['loss']){
        $loss=json_decode($data['loss']); 
        $loss1=$loss[4]->ding2;
      }else{
        $where1['qishu']=session('qishu');
        $data1=M('opentime')->where($where1)->limit(1)->find();
        $loss=json_decode($data1['m_loss']);
        $loss1=$loss->ding21;
      }
      return $loss1;
    }
    //二定类型判断
    public function findTypes1(){
        $types=$_POST['types'];
        $type1=$_POST['type'];
        //var_dump($_POST);exit;
       $loss=$this->userloss();
       //修改赔率表
       // if($types==102){
       //  $where['types']='口口XX';
       // }elseif($types==101){
       //  $where['types']='口X口X';
       // }elseif($types==100){
       //  $where['types']='口XX口';
       // }elseif($types==99){
       //  $where['types']='X口X口';
       // }elseif($types==98){
       //  $where['types']='X口口X';
       // }elseif($types==97){
       //  $where['types']='XX口口';
       // }
       $where['type']=5;
       $where['qishu']=session('qishu');
       $data=M('markets')->field('loss,name')->where($where)->select();
         if(!empty($data)){
          foreach($data as $k1=>$v1){
            $arrs[]=$v1['name'];
            $arr[''.$v1['name'].'']=$v1['loss'];
          } 
       }
       //dump($arr);exit;
        if($types==102){
            for ($i=0;$i<=9;$i++){ 
                if($type1==2){
                    $html.='<tr><td class="rdcol"></td>';
                    for ($j=0;$j<=9;$j++){
                      if(in_array($i.$j.'XX',$arrs)){
                          $loss1=$i.$j.'XX';
                           $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">'.$i.$j.'XX</div><div class="rdR h">'.$arr[''.$loss1.''].'</div></td>';
                      }else{
                         $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">'.$i.$j.'XX</div><div class="rdR h">'.$loss.'</div></td>';
                      }
                       
                    } 
                    $html.='</tr>';
                }else{
                     $html.='<tr>';
                    for ($j=0;$j<=9;$j++){
                        if(in_array($i.$j.'XX',$arrs)){
                          $loss1=$i.$j.'XX';
                          $html.='<td><div class="rdL"><span class=" h">'.$arr[''.$loss1.''].'</span><br>'.$i.$j.'XX</div><div class="rdR"><input type="text" id="ezdm'.$i.$j.'XX" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }else{
                           $html.='<td><div class="rdL"><span class=" h">'.$loss.'</span><br>'.$i.$j.'XX</div><div class="rdR"><input type="text" id="ezdm'.$i.$j.'XX" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }
                    } 
                    $html.='</tr>';
                }
                

                    //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
            } 
      
        }elseif($types==101){
            for ($i=0;$i<=9;$i++){ 
                if($type1==2){
                $html.='<tr><td class="rdcol"></td>';
                for ($j=0;$j<=9;$j++){
                  if(in_array($i.'X'.$j.'X',$arrs)){
                    $loss1=$i.'X'.$j.'X';
                    $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">'.$i.'X'.$j.'X</div><div class="rdR h">'.$arr[''.$loss1.''].'</div></td>';
                  }else{
                    $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">'.$i.'X'.$j.'X</div><div class="rdR h">'.$loss.'</div></td>';
                  }
                } 
                    $html.='</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
                }else{
                     $html.='<tr>';
                    for ($j=0;$j<=9;$j++){
                      if(in_array($i.'X'.$j.'X',$arrs)){
                        $loss1=$i.'X'.$j.'X';
                        $html.='<td><div class="rdL"><span class=" h">'.$arr[''.$loss1.''].'</span><br>'.$i.'X'.$j.'X</div><div class="rdR"><input type="text" id="ezdm'.$i.'X'.$j.'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }else{
                          $html.='<td><div class="rdL"><span class=" h">'.$loss.'</span><br>'.$i.'X'.$j.'X</div><div class="rdR"><input type="text" id="ezdm'.$i.'X'.$j.'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }
                    } 
                    $html.='</tr>';
                }
            } 
        }elseif($types==100){
            for ($i=0;$i<=9;$i++){ 
                if($type1==2){
                $html.='<tr><td class="rdcol"></td>';
                for ($j=0;$j<=9;$j++){
                  if(in_array($i.'XX'.$j,$arrs)){
                    $loss1=$i.'XX'.$j;
                    $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">'.$i.'XX'.$j.'</div><div class="rdR h">'.$arr[''.$loss1.''].'</div></td>';
                  }else{
                    $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">'.$i.'XX'.$j.'</div><div class="rdR h">'.$loss.'</div></td>'; 
                  }
                } 
                    $html.='</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
                }else{
                     $html.='<tr>';
                    for ($j=0;$j<=9;$j++){
                      if(in_array($i.'XX'.$j,$arrs)){
                        $loss1=$i.'XX'.$j;
                        $html.='<td><div class="rdL"><span class=" h">'.$arr[''.$loss1.''].'</span><br>'.$i.'XX'.$j.'</div><div class="rdR"><input type="text" id="ezdm'.$i.'XX'.$j.'" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }else{
                        $html.='<td><div class="rdL"><span class=" h">'.$loss.'</span><br>'.$i.'XX'.$j.'</div><div class="rdR"><input type="text" id="ezdm'.$i.'XX'.$j.'" onkeyup="inputs(this)" maxlength="4" /></div></td>';  
                      }
                    } 
                    $html.='</tr>';
                }
            } 
        }elseif($types==99){
            for ($i=0;$i<=9;$i++){ 
                if($type1==2){
                $html.='<tr><td class="rdcol"></td>';
                for ($j=0;$j<=9;$j++){
                   if(in_array('X'.$i.'X'.$j,$arrs)){
                      $loss1='X'.$i.'X'.$j;
                      $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X'.$i.'X'.$j.'</div><div class="rdR h">'.$arr[''.$loss1.''].'</div></td>';
                    }else{
                        $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X'.$i.'X'.$j.'</div><div class="rdR h">'.$loss.'</div></td>'; 
                    }
                } 
                    $html.='</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
                }else{
                     $html.='<tr>';
                    for ($j=0;$j<=9;$j++){
                      if(in_array('X'.$i.'X'.$j,$arrs)){
                        $loss1='X'.$i.'X'.$j;
                        $html.='<td><div class="rdL"><span class=" h">'.$arr[''.$loss1.''].'</span><br>X'.$i.'X'.$j.'</div><div class="rdR"><input type="text" id="ezdmX'.$i.'X'.$j.'" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }else{
                          $html.='<td><div class="rdL"><span class=" h">'.$loss.'</span><br>X'.$i.'X'.$j.'</div><div class="rdR"><input type="text" id="ezdmX'.$i.'X'.$j.'" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }
                    } 
                    $html.='</tr>';
                }
            } 
        }elseif($types==98){
            for ($i=0;$i<=9;$i++){ 
                if($type1==2){
                $html.='<tr><td class="rdcol"></td>';
                for ($j=0;$j<=9;$j++){
                   if(in_array('X'.$i.$j.'X',$arrs)){
                      $loss1='X'.$i.$j.'X';
                      $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X'.$i.$j.'X</div><div class="rdR h">'.$arr[''.$loss1.''].'</div></td>';
                    }else{
                        $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X'.$i.$j.'X</div><div class="rdR h">'.$loss.'</div></td>';
                    }
                } 
                    $html.='</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
                }else{
                     $html.='<tr>';
                    for ($j=0;$j<=9;$j++){
                      if(in_array('X'.$i.$j.'X',$arrs)){
                        $loss1='X'.$i.$j.'X';
                        $html.='<td><div class="rdL"><span class=" h">'.$arr[''.$loss1.''].'</span><br>X'.$i.$j.'X</div><div class="rdR"><input type="text" id="ezdmX'.$i.$j.'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }else{
                        $html.='<td><div class="rdL"><span class=" h">'.$loss.'</span><br>X'.$i.$j.'X</div><div class="rdR"><input type="text" id="ezdmX'.$i.$j.'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                      }
                    } 
                    $html.='</tr>';
                }
            } 
        }elseif($types==97){
            
            for ($i=0;$i<=9;$i++){ 
                if($type1==2){
                $html.='<tr><td class="rdcol"></td>';
                for ($j=0;$j<=9;$j++){
                    $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">XX'.$i.$j.'</div><div class="rdR h">'.$loss.'</div></td>';
                } 
                    $html.='</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
                }else{
                     $html.='<tr>';
                    for ($j=0;$j<=9;$j++){
                        $html.='<td><div class="rdL"><span class=" h">'.$loss.'</span><br>XX'.$i.$j.'</div><div class="rdR"><input type="text" id="ezdmXX'.$i.$j.'" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                    } 
                    $html.='</tr>';
                }
            } 
        }

        //$arrs=array('datas'=>$html);
        echo json_encode($html);
    }

    //下注得到赔率和可下数
    function ajax_odd(){
        $uid=session('userid');
        $where['uid']=$uid;
        //判断账号余额
        $yue = M('user')->field('money')->where($where)->find();
        if(!floatval($yue['money'])  > 0 ){
            echo -999;
            exit;
        }
        $num=I('post.num');//号码
        $sizixian=I('post.sizixian');
        if(empty($num)){
            echo -2;
            exit;
        }
        //判断并得到改号码类型
        $data=$this->haoma($num,$sizixian);//0(数字)类型1类型2号码
        // var_dump($data);exit;
        if($data['code']==400){
          echo $data['status'];
          exit;
        }
   
        $qishu=session('qishu');
        //判断改号码是否禁止购买
        $where['qishu']=$qishu;
        $where['p_type']=$types;
        $where['name']=$num;

        $prohibit=M('prohibit')->field('p_id')->where($where)->find();
          if($prohibit){
            echo -5; //该号码禁止销售
            exit;
          }
            
            //得到这期该号码购买情况
            $where1['qishu']=$qishu;
            $where1['mingxi_1']=$data[3];
            $where1['mingxi_2']=$data[2];
            $where1['js']='0';
            $bets=M('bet')->field('money')->where($where1)->sum('money');

            // echo json_encode($where2);exit;
            //会员赔率和股东原始赔率
            $where2['uid']=$uid;
            $loss=M('uloss')->where($where2)->find();
            $datas=M('opentime')->where('qishu = "'.$qishu.'"')->find();
            if(empty($loss) && empty($datas)){
              echo -2;
              exit;
            }

            //得到改号码股东是否修改赔率和销售上限
            $where3['qishu']=$qishu;
            $where3['name']=$data[2];
            $where3['type']=$data[0];
            $markets=M('markets')->where($where3)->find();
            if(empty($markets) && empty($bets)){//股东没有限制(赔率和销售上限)
                if(empty($loss) || empty($loss['loss'])){//用户配置为空-->走股东
                  $arrs=$this->haomas($datas,$data[0],$data[2],$markets,$bets);
                }else{//赔率，每码上限，单注上限，会员回水,号码
                  $arrs=$this->haomas1($datas,$loss,$data[0],$data[2],$markets,$bets);
                }
            }else{
              if(empty($loss) || empty($loss['loss'])){//用户配置为空-->走股东
                  $arrs=$this->haomas($datas,$data[0],$data[2],$markets,$bets);
                }else{//赔率，每码上限，单注上限，会员回水,号码
                  $arrs=$this->haomas1($datas,$loss,$data[0],$data[2],$markets,$bets);

                }
            }
            if($arrs['code']==400){
              echo -5;
              exit;
            }
            //返回 赔率，每码上限，单注上限，最小下注上限，会员回水,号码
            echo json_encode($arrs);exit;//["49", "1", "1", "1", "0", "123"]
    }
        //公共方法得到改号码类型
  function haoma($num,$sizixian){
        $num1 = preg_replace("/X/", "", $num);//正则匹配替换
        $num_arr_x = explode('X' , $num);//分割
        $status=strstr($num,'X');//是否包含x
        //存在x,是定1.判断长度，2.除了x还有几位数，3.规整类型
        //现,1.判断长度，2.规整类型
        //echo $num1;exit;
        if((strlen($num) <=4) && (strlen($num1) >1)){
            if(($sizixian==1) && (empty($status))){//现类型、不包含x
                $len=strlen($num);
                $type='现';
                if($len.$type=='4现'){
                  $type1='4现';
                  $num=$this->strings($num);
                  $types=4;
                }elseif($len.$type=='3现'){
                  $type1='3现';
                  $num=$this->strings($num);
                  $types=3;
                }elseif($len.$type=='2现'){
                  $type1='2现';
                  $num=$this->strings($num);
                  $types=2;
                }elseif($len.$type=='4定'){
                   $type1='4定';
                  $types=1;
                }
                $type22=$type1;
            }elseif((empty($status)) && (strlen($num) <=4)){//不包含x、长度4
                if(strlen($num) <4){
                  $type='现';
                }else{
                  $type='定';
                }
                $len=strlen($num1);
                 if($len.$type=='4现'){
                  $type1='4现';
                  $num=$this->strings($num);
                  $types=4;
                }elseif($len.$type=='3现'){
                  $type1='3现';
                  $num=$this->strings($num);
                  $types=3;
                }elseif($len.$type=='2现'){
                  $type1='2现';
                  $num=$this->strings($num);
                  $types=2;
                }elseif($len.$type=='4定'){
                  $type1='4定';
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
                  $type11='2定';
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
              $type22=$type11;
            }else{
                $arr=array('code'=>400,'status'=>'-2');
                return $arr;
                exit;
            }
          }else{
              $arr=array('code'=>400,'status'=>'-2');
              return $arr;
              exit;
          }
            if(empty($types) || empty($type1)){//没有该号码类型
              $arr=array('code'=>400,'status'=>'-4');
              return $arr;
              exit;
            }else{//得到改号码是否禁止销售
              $qishu=session('qishu');
              $data=M('opentime')->where('qishu = "'.$qishu.'"')->find();
              if(empty($data)){
                $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
              }
               if(($type22=='2定') && ($data['2ding_xiane']!=1)){
                  $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
                }elseif(($type22=='3定') && ($data['3ding_xiane']!=1)){
                  $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
                }elseif(($type22=='4定') && ($data['4ding_xiane']!=1)){
                  $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
                }elseif(($type22=='2现') && ($data['2xian_xiane']!=1)){
                  $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
                }elseif(($type22=='3现') && ($data['3xian_xiane']!=1)){
                  $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
                }elseif(($type22=='4现') && ($data['4xian_xiane']!=1)){
                  $arr=array('code'=>400,'status'=>'-5');
                  return $arr;
                  exit;
                }
            }
            $type2=$len.$type;
            $arr=array('code'=>200,$types,$type1,$num,$type2,$type);//状态1类型2类型3号码
            return $arr;
            exit;

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
  //公共方法得到号码的赔率
   function haomas($datas,$types,$num,$data2,$bets){//股东赔率/单注上限
      $loss=json_decode($datas['m_loss']);//赔率
      $market=json_decode($datas['m_sales']);//单注上限

      if($bets){//得到该号码的销售总数
        //foreach($bets as $k=>$v){
          $money=$bets;
        //}
      }
      //得到该号码类型
      $where3['numbers']=$num;
      $where3['type']=$types;
      $number=M('number')->where($where3)->find();
        if($types==1){
          $loss1=$loss->ding41;
          $xhz1=$loss->ding42;//下滑基数
          $xhz2=$loss->ding43;//每增加数
          $xhz3=$loss->ding44;//下滑值
          $market1=$market->ding41;
          $market2=$market->ding42;
          $market3=$market->ding43;
        }elseif($types==2){
          $market1=$market->tong21;
          $market2=$market->tong22;
          $market3=$market->tong23;
          if($number['types']==1){
            $loss1=$loss->tong211;
            $xhz1=$loss->tong212;//下滑基数
            $xhz2=$loss->tong213;//每增加数
            $xhz3=$loss->tong214;//下滑值
            //$market1=$market->tong22;
          }elseif($number['types']==2){
            $loss1=$loss->tong221;
            $xhz1=$loss->tong222;//下滑基数
            $xhz2=$loss->tong223;//每增加数
            $xhz3=$loss->tong224;//下滑值
            //$marke1t=$market->tong22;
          }
          
        }elseif($types==3){
            $market1=$market->tong31;
            $market2=$market->tong32;
            $market3=$market->tong33;
            if($number['types']==1){
              $loss1=$loss->tong311;
              $xhz1=$loss->tong312;//下滑基数
              $xhz2=$loss->tong313;//每增加数
              $xhz3=$loss->tong314;//下滑值
              //$market1=$market->tong32;
            }elseif($number['types']==2){
              $loss1=$loss->tong321;
              $xhz1=$loss->tong322;//下滑基数
              $xhz2=$loss->tong323;//每增加数
              $xhz3=$loss->tong324;//下滑值
              //$market1=$market->tong32;
            }elseif($number['types']==3){
              $loss1=$loss->tong331;
              $xhz1=$loss->tong332;//下滑基数
              $xhz2=$loss->tong333;//每增加数
              $xhz3=$loss->tong334;//下滑值
              //$market1=$market->tong32;
            }
        }elseif($types==4){
            $market1=$market->tong41;
            $market2=$market->tong42;
            $market3=$market->tong43;
            if($number['types']==1){
              $loss1=$loss->tong411;
              $xhz1=$loss->tong412;//下滑基数
              $xhz2=$loss->tong413;//每增加数
              $xhz3=$loss->tong414;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==2){
              $loss1=$loss->tong421;
              $xhz1=$loss->tong422;//下滑基数
              $xhz2=$loss->tong423;//每增加数
              $xhz3=$loss->tong424;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==3){
              $loss1=$loss->tong441;
              $xhz1=$loss->tong442;//下滑基数
              $xhz2=$loss->tong443;//每增加数
              $xhz3=$loss->tong444;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==4){
              $loss1=$loss->tong431;
              $xhz1=$loss->tong432;//下滑基数
              $xhz2=$loss->tong433;//每增加数
              $xhz3=$loss->tong434;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==5){
              $loss1=$loss->tong451;
              $xhz1=$loss->tong452;//下滑基数
              $xhz2=$loss->tong453;//每增加数
              $xhz3=$loss->tong454;//下滑值
             // $market1=$market->tong42;
            }
        }elseif($types==5){
          $loss1=$loss->ding21;
          $xhz1=$loss->ding22;//下滑基数
          $xhz2=$loss->ding23;//每增加数
          $xhz3=$loss->ding24;//下滑值
          $market1=$market->ding21;
          $market2=$market->ding22;
          $market3=$market->ding23;
        }elseif($types==6){
          $loss1=$loss->ding31;
          $xhz1=$loss->ding32;//下滑基数
          $xhz2=$loss->ding33;//每增加数
          $xhz3=$loss->ding34;//下滑值
          $market1=$market->ding31;
          $market2=$market->ding32;
          $market3=$market->ding33;
        }
        //股东修改赔率和单注上限
        if($data2){
          $c_loss=$data2['loss'];
          $c_markets=$data2['markets'];
          if(!empty($c_loss)){
            $loss1=$c_loss;
          }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
       //判断总数是否超过每码销售值 
       //
       //
      
       // if(!empty($money)){
       //  if($money==$market1){
       //    $arrs=array('code'=>400);
       //    return $arrs;
       //    exit;
       //  }
      // if(!empty($money) && ($datas['m_odds']==1)){
       if(!empty($money)){
        if($money>=$market1){
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss1=$loss1-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss1=$loss1-($money2*$xhz3);
              if(($loss1+$xhz3) < $xhz3 ){
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

        $loss3=0;
        $arr=array($loss1,$market1,$market2,$market3,$loss3,$num);//赔率，每码上限，单注上限，会员回水,号码
        return $arr;
  } 
  //用户配置赔率
  function haomas1($datas,$loss1,$types,$num,$data2,$bets){

      $loss=json_decode($loss1['loss']);
      $loss4=json_decode($datas['m_loss']);//赔率
      $market=json_decode($datas['m_sales']);//单注上限
      if($bets){//得到该号码的销售总数
        //foreach($bets as $k=>$v){
          $money=$bets;
        //}
      }
      //得到该号码类型
      $where3['numbers']=$num;
      $where3['type']=$types;
      $number=M('number')->where($where3)->find();

        if($types==1){
          $loss3=$loss[0]->loss4;
          $loss2=$loss[0]->ding4;
          $market1=$market->ding41;
          $market2=$market->ding42;
          $market3=$market->ding43;
          $xhz1=$loss4->ding42;//下滑基数
          $xhz2=$loss4->ding43;//每增加数
          $xhz3=$loss4->ding44;//下滑值
        }elseif($types==2){
          // //得到该号码类型
           $market1=$market->tong21;
           $market2=$market->tong22;
           $market3=$market->tong23;
          if($number['types']==1){
            $loss3=$loss[1]->loss21;
            $loss2=$loss[1]->tong21;
            $xhz1=$loss4->tong212;//下滑基数
            $xhz2=$loss4->tong213;//每增加数
            $xhz3=$loss4->tong214;//下滑值
            // $market2=$market->tong22;
          }elseif($number['types']==2){
            $loss3=$loss[1]->loss22;
            $loss2=$loss[1]->tong22;
            $xhz1=$loss4->tong222;//下滑基数
            $xhz2=$loss4->tong223;//每增加数
            $xhz3=$loss4->tong224;//下滑值
            //$market2=$market->tong22;
          }
          
        }elseif($types==3){
            $market1=$market->tong31;
            $market2=$market->tong32;
            $market3=$market->tong33;
            if($number['types']==1){
              $loss3=$loss[2]->loss31;
              $loss2=$loss[2]->tong31;
              $xhz1=$loss4->tong312;//下滑基数
              $xhz2=$loss4->tong313;//每增加数
              $xhz3=$loss4->tong314;//下滑值
              //$market2=$market->tong32;
            }elseif($number['types']==2){
              $loss3=$loss[2]->loss32;
              $loss2=$loss[2]->tong32;
              $xhz1=$loss4->tong322;//下滑基数
              $xhz2=$loss4->tong323;//每增加数
              $xhz3=$loss4->tong324;//下滑值
              //$market2=$market->tong32;
            }elseif($number['types']==3){
              $loss3=$loss[2]->loss33;
              $loss2=$loss[2]->tong33;
              $xhz1=$loss4->tong332;//下滑基数
              $xhz2=$loss4->tong333;//每增加数
              $xhz3=$loss4->tong334;//下滑值
              //$market2=$market->tong32;
            }
        }elseif($types==4){
            $market1=$market->tong41;
            $market2=$market->tong42;
            $market3=$market->tong43;
            if($number['types']==1){
              $loss3=$loss[3]->loss41;
              $loss2=$loss[3]->tong41;
              $xhz1=$loss4->tong412;//下滑基数
              $xhz2=$loss4->tong413;//每增加数
              $xhz3=$loss4->tong414;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==2){
              $loss3=$loss[3]->loss42;
              $loss2=$loss[3]->tong42;
              $xhz1=$loss4->tong422;//下滑基数
              $xhz2=$loss4->tong423;//每增加数
              $xhz3=$loss4->tong424;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==3){
              $loss3=$loss[3]->loss44;
              $loss2=$loss[3]->tong44;
              $xhz1=$loss4->tong442;//下滑基数
              $xhz2=$loss4->tong443;//每增加数
              $xhz3=$loss4->tong444;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==4){
              $loss3=$loss[3]->loss43;
              $loss2=$loss[3]->tong43;
              $xhz1=$loss4->tong432;//下滑基数
              $xhz2=$loss4->tong433;//每增加数
              $xhz3=$loss4->tong434;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==5){
              $loss3=$loss[3]->loss45;
              $loss2=$loss[3]->tong45;
              $xhz1=$loss4->tong452;//下滑基数
              $xhz2=$loss4->tong453;//每增加数
              $xhz3=$loss4->tong454;//下滑值
              //$market2=$market->tong42;
            }
        }elseif($types==5){
          $loss2=$loss[4]->ding2;
          $loss3=$loss[4]->loss2;
          $market1=$market->ding21;
          $market2=$market->ding22;
          $market3=$market->ding23;
          $xhz1=$loss4->ding22;//下滑基数
          $xhz2=$loss4->ding23;//每增加数
          $xhz3=$loss4->ding24;//下滑值
        }elseif($types==6){
          $loss2=$loss[5]->ding3;
          $loss3=$loss[5]->loss3;
          $market1=$market->ding31;
          $market2=$market->ding32;
          $market3=$market->ding33;
          $xhz1=$loss4->ding32;//下滑基数
          $xhz2=$loss4->ding33;//每增加数
          $xhz3=$loss4->ding34;//下滑值

        }
        if($data2){
          $c_loss=$data2['loss'];
          $c_markets=$data2['markets'];
          if(!empty($c_loss)){
            $loss2=$c_loss;
          }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
         //判断总数是否超过每码销售值 
          //echo $money.'==>'.$datas['m_odds'];exit;
       //if(!empty($money) && ($datas['m_odds']==1)){
       if(!empty($money)){
        if($money>=$market1){
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss2=$loss2-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss2=$loss2-($money2*$xhz3);
              if(($loss2+$xhz3) < $xhz3 ){
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

       //$arr=array($money,$market1);
        $arr=array($loss2,$market1,$market2,$market3,$loss3,$num);//赔率，每码上限，单注上限，会员回水,号码
        return $arr;

  } 

    //检查号码规则
     function findOrder1(){
      
      if(!empty($_POST['action']) && $_POST['action'] == 'findOrder1'){

        $uid=session('userid');
        $where['uid']=$uid;
        //判断账号余额
        $yue = M('user')->field('money')->where($where)->find();
        if(!floatval($yue['money'])  > 0 ){
            echo -999;
            exit;
        }

        $num = (string)$_POST['num'];//号码
        $sizixian=$_POST['sizixian'];
        $num1 = preg_replace("/X/", "", $num);//正则匹配替换
        $num_arr_x = explode('X' , $num);//分割

        $status=strstr($num,'X');//是否包含x
        //存在x,是定1.判断长度，2.除了x还有几位数，3.规整类型
        //现,1.判断长度，2.规整类型
        //echo strlen($num).'===>'.strlen($num1).'<br/>';
        if((strlen($num) <=4) && (strlen($num1) >1)){
            if(($sizixian==1) && (empty($status))){//现类型、不包含x
                $len=strlen($num);
                $type='现';
                $where['co_types']=$len.$type; 
            }elseif((empty($status)) && (strlen($num) <=4)){//不包含x、长度4
                if(strlen($num) <4){
                  $type='现';
                }else{
                  $type='定';
                }
                $len=strlen($num1);
                
                $where['co_types']=$len.$type;
                
            }elseif((!empty($status)) && (strlen($num) ==4)){//包含x、长度4
                $len=strlen($num1);
                $haoma1=substr($num,0,1);
                $haoma2=substr($num,1,1);
                $haoma3=substr($num,2,1);
                $haoma4=substr($num,3,1);
                if($len==2){//赔率类型判断--6种
                    if($haoma1=='x' && $haoma2=='x'){
                        $type='XX口口';
                        $where['co_types']=$type;  
                    }elseif($haoma3=='x' && $haoma4=='x'){
                        $type='口口XX';
                        $where['co_types']=$type;
                    }elseif($haoma1=='x' && $haoma4=='x'){
                        $type='X口口X';
                        $where['co_types']=$type;
                    }elseif($haoma2=='x' && $haoma3=='x'){
                        $type='口XX口';
                        $where['co_types']=$type;
                    }elseif($haoma2=='x' && $haoma4=='x'){
                        $type='口X口X';
                        $where['co_types']=$type;
                    }elseif($haoma1=='x' && $haoma3=='x'){
                        $type='X口X口';
                        $where['co_types']=$type;
                    }   
                    
                }elseif($len==3){//赔率类型判断--4种
                    if($haoma1=='x'){
                        $type='X口口口';
                        $where['co_types']=$type;  
                    }elseif($haoma2=='x'){
                        $type='口X口口';
                        $where['co_types']=$type;
                    }elseif($haoma3=='x'){
                        $type='口口X口';
                        $where['co_types']=$type;
                    }elseif($haoma4=='x'){
                        $type='口口口X';
                        $where['co_types']=$type;
                    }
                }
              
            }else{
                echo -2; 
                exit;
            }
            //得到用户的赔率
            //判断该号码买了多少、这期的类型限制购买多少
            // $data=M('config')->where($where)->find();
            // echo json_encode($data);exit;
            echo 1;
            exit;
        }else{
            echo -2; 
            exit;
        }

    }else{
      echo -2; 
      exit;
    }

     }

function unm2($num,$type){
        $haoma1=substr($num,0,1);
        $haoma2=substr($num,1,1);
        $haoma3=substr($num,2,1);
        $haoma4=substr($num,3,1);
         if($type=='2定'){//赔率类型判断--6种
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
            
        }elseif($type=='3定'){//赔率类型判断--4种
            if($haoma1=='X'){
                $type1='X口口口';
            }elseif($haoma2=='X'){
                $type1='口X口口';
            }elseif($haoma3=='X'){
                $type1='口口X口';
            }elseif($haoma4=='X'){
                $type1='口口口X';
            }
        }else{
           $type1=$type;
        }
        return $type1;
    }

      function haomas2($data,$types,$num,$leixing){
          
          

          $uid=session('userid');
          $qishu=session('qishu');
          //判断改号码是否禁止购买
           $where['qishu']=$qishu;
           $where['p_type']=$types;
           $where['name']=$num;

            $prohibit=M('prohibit')->field('p_id')->where($where)->find();
            //return $prohibit;exit;
            if($prohibit){
              $arrs=array('code'=>400);
              return $arrs;
              exit;
            }
            
          //得到这期该号码购买情况
            $where1['qishu']=$qishu;
            $where1['mingxi_1']=$leixing;
            $where1['mingxi_2']=$num;
            
            $where1['js']='0';
            $bets=M('bet')->field('money')->where($where1)->select();
          //得到改号码股东是否修改赔率和销售上限
            $where2['qishu']=$qishu;
            $where2['name']=$num;
            $where2['type']=$types;
            $markets=M('markets')->where($where2)->find();


      $loss=json_decode($data['m_loss']);//赔率
      $market=json_decode($data['m_sales']);//单注上限

      if($bets){//得到该号码的销售总数
        foreach($bets as $k=>$v){
          $money+=$v['money'];
        }
      }
      //得到该号码类型
      $where3['numbers']=$num;
      $where3['type']=$types;
      $number=M('number')->where($where3)->find();
        if($types==1){
          $loss1=$loss->ding41;
          $xhz1=$loss->ding42;//下滑基数
          $xhz2=$loss->ding43;//每增加数
          $xhz3=$loss->ding44;//下滑值
          $market1=$market->ding41;
          $market2=$market->ding42;
          $market3=$market->ding43;
        }elseif($types==2){
          $market1=$market->tong21;
          $market2=$market->tong22;
          $market3=$market->tong23;
          if($number['types']==1){
            $loss1=$loss->tong211;
            $xhz1=$loss->tong212;//下滑基数
            $xhz2=$loss->tong213;//每增加数
            $xhz3=$loss->tong214;//下滑值
            //$market1=$market->tong22;
          }elseif($number['types']==2){
            $loss1=$loss->tong221;
            $xhz1=$loss->tong222;//下滑基数
            $xhz2=$loss->tong223;//每增加数
            $xhz3=$loss->tong224;//下滑值
            //$marke1t=$market->tong22;
          }
          
        }elseif($types==3){
            $market1=$market->tong31;
            $market2=$market->tong32;
            $market3=$market->tong33;
            if($number['types']==1){
              $loss1=$loss->tong311;
              $xhz1=$loss->tong312;//下滑基数
              $xhz2=$loss->tong313;//每增加数
              $xhz3=$loss->tong314;//下滑值
              //$market1=$market->tong32;
            }elseif($number['types']==2){
              $loss1=$loss->tong321;
              $xhz1=$loss->tong322;//下滑基数
              $xhz2=$loss->tong323;//每增加数
              $xhz3=$loss->tong324;//下滑值
              //$market1=$market->tong32;
            }elseif($number['types']==3){
              $loss1=$loss->tong331;
              $xhz1=$loss->tong332;//下滑基数
              $xhz2=$loss->tong333;//每增加数
              $xhz3=$loss->tong334;//下滑值
              //$market1=$market->tong32;
            }
        }elseif($types==4){
            $market1=$market->tong41;
            $market2=$market->tong42;
            $market3=$market->tong43;
            if($number['types']==1){
              $loss1=$loss->tong411;
              $xhz1=$loss->tong412;//下滑基数
              $xhz2=$loss->tong413;//每增加数
              $xhz3=$loss->tong414;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==2){
              $loss1=$loss->tong421;
              $xhz1=$loss->tong422;//下滑基数
              $xhz2=$loss->tong423;//每增加数
              $xhz3=$loss->tong424;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==3){
              $loss1=$loss->tong441;
              $xhz1=$loss->tong442;//下滑基数
              $xhz2=$loss->tong443;//每增加数
              $xhz3=$loss->tong444;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==4){
              $loss1=$loss->tong431;
              $xhz1=$loss->tong432;//下滑基数
              $xhz2=$loss->tong433;//每增加数
              $xhz3=$loss->tong434;//下滑值
              //$market1=$market->tong42;
            }elseif($number['types']==5){
              $loss1=$loss->tong451;
              $xhz1=$loss->tong452;//下滑基数
              $xhz2=$loss->tong453;//每增加数
              $xhz3=$loss->tong454;//下滑值
             // $market1=$market->tong42;
            }
        }elseif($types==5){
          $loss1=$loss->ding21;
          $xhz1=$loss->ding22;//下滑基数
          $xhz2=$loss->ding23;//每增加数
          $xhz3=$loss->ding24;//下滑值
          $market1=$market->ding21;
          $market2=$market->ding22;
          $market3=$market->ding23;
        }elseif($types==6){
          $loss1=$loss->ding31;
          $xhz1=$loss->ding32;//下滑基数
          $xhz2=$loss->ding33;//每增加数
          $xhz3=$loss->ding34;//下滑值
          $market1=$market->ding31;
          $market2=$market->ding32;
          $market3=$market->ding33;
        }
        //股东修改赔率和单注上限
        if($markets){
          $c_loss=$markets['loss'];
          $c_markets=$markets['markets'];
          if(!empty($c_loss)){
            $loss1=$c_loss;
          }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
        //if(!empty($money) && ($data['m_odds']==1)){
        if(!empty($money)){

        if($money>=$market1){
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss1=$loss1-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss1=$loss1-($money2*$xhz3);
              if(($loss1+$xhz3) < $xhz3 ){
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
        $loss3=0;
        $arr=array('code'=>200,$loss1,$market1,$market2,$market3,$loss3,$num);//赔率，每码上限，单注上限，会员回水,号码
        return $arr;


      }
      function haomas3($data,$types,$num,$leixing,$loss1){
          
          

          $uid=session('userid');
          $qishu=session('qishu');
          //判断改号码是否禁止购买
           $where['qishu']=$qishu;
           $where['p_type']=$types;
           $where['name']=$num;

            $prohibit=M('prohibit')->field('p_id')->where($where)->find();
            if($prohibit){
              $arrs=array('code'=>400);
              return $arrs;
              exit;
            }
            
          //得到这期该号码购买情况
            $where1['qishu']=$qishu;
            $where1['mingxi_1']=$leixing;
            $where1['mingxi_2']=$num;
            
            $where1['js']='0';
            $bets=M('bet')->field('money')->where($where1)->select();
            // return $bets;
            // exit;
          //得到改号码股东是否修改赔率和销售上限
            $where2['qishu']=$qishu;
            $where2['name']=$num;
            $where2['type']=$types;
            $markets=M('markets')->where($where2)->find();

      $loss=json_decode($loss1['loss']);
      $loss4=json_decode($data['m_loss']);//赔率
      $market=json_decode($data['m_sales']);//单注上限
      if($bets){//得到该号码的销售总数
        foreach($bets as $k=>$v){
          $money+=$v['money'];
        }
      }
      //得到该号码类型
      $where3['numbers']=$num;
      $where3['type']=$types;
      $number=M('number')->where($where3)->find();
        if($types==1){
          $loss3=$loss[0]->loss4;
          $loss2=$loss[0]->ding4;
          $market1=$market->ding41;
          $market2=$market->ding42;
          $market3=$market->ding43;
          $xhz1=$loss4->ding42;//下滑基数
          $xhz2=$loss4->ding43;//每增加数
          $xhz3=$loss4->ding44;//下滑值
        }elseif($types==2){
          // //得到该号码类型
           $market1=$market->tong21;
           $market2=$market->tong22;
           $market3=$market->tong23;
          if($number['types']==1){
            $loss3=$loss[1]->loss21;
            $loss2=$loss[1]->tong21;
            $xhz1=$loss4->tong212;//下滑基数
            $xhz2=$loss4->tong213;//每增加数
            $xhz3=$loss4->tong214;//下滑值
            // $market2=$market->tong22;
          }elseif($number['types']==2){
            $loss3=$loss[1]->loss22;
            $loss2=$loss[1]->tong22;
            $xhz1=$loss4->tong222;//下滑基数
            $xhz2=$loss4->tong223;//每增加数
            $xhz3=$loss4->tong224;//下滑值
            //$market2=$market->tong22;
          }
          
        }elseif($types==3){
            $market1=$market->tong31;
            $market2=$market->tong32;
            $market3=$market->tong33;
            if($number['types']==1){
              $loss3=$loss[2]->loss31;
              $loss2=$loss[2]->tong31;
              $xhz1=$loss4->tong312;//下滑基数
              $xhz2=$loss4->tong313;//每增加数
              $xhz3=$loss4->tong314;//下滑值
              //$market2=$market->tong32;
            }elseif($number['types']==2){
              $loss3=$loss[2]->loss32;
              $loss2=$loss[2]->tong32;
              $xhz1=$loss4->tong322;//下滑基数
              $xhz2=$loss4->tong323;//每增加数
              $xhz3=$loss4->tong324;//下滑值
              //$market2=$market->tong32;
            }elseif($number['types']==3){
              $loss3=$loss[2]->loss33;
              $loss2=$loss[2]->tong33;
              $xhz1=$loss4->tong332;//下滑基数
              $xhz2=$loss4->tong333;//每增加数
              $xhz3=$loss4->tong334;//下滑值
              //$market2=$market->tong32;
            }
        }elseif($types==4){
            $market1=$market->tong41;
            $market2=$market->tong42;
            $market3=$market->tong43;
            if($number['types']==1){
              $loss3=$loss[3]->loss41;
              $loss2=$loss[3]->tong41;
              $xhz1=$loss4->tong412;//下滑基数
              $xhz2=$loss4->tong413;//每增加数
              $xhz3=$loss4->tong414;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==2){
              $loss3=$loss[3]->loss42;
              $loss2=$loss[3]->tong42;
              $xhz1=$loss4->tong422;//下滑基数
              $xhz2=$loss4->tong423;//每增加数
              $xhz3=$loss4->tong424;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==3){
              $loss3=$loss[3]->loss44;
              $loss2=$loss[3]->tong44;
              $xhz1=$loss4->tong442;//下滑基数
              $xhz2=$loss4->tong443;//每增加数
              $xhz3=$loss4->tong444;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==4){
              $loss3=$loss[3]->loss43;
              $loss2=$loss[3]->tong43;
              $xhz1=$loss4->tong432;//下滑基数
              $xhz2=$loss4->tong433;//每增加数
              $xhz3=$loss4->tong434;//下滑值
              //$market2=$market->tong42;
            }elseif($number['types']==5){
              $loss3=$loss[3]->loss45;
              $loss2=$loss[3]->tong45;
              $xhz1=$loss4->tong452;//下滑基数
              $xhz2=$loss4->tong453;//每增加数
              $xhz3=$loss4->tong454;//下滑值
              //$market2=$market->tong42;
            }
        }elseif($types==5){
          $loss2=$loss[4]->ding2;
          $loss3=$loss[4]->loss2;
          $market1=$market->ding21;
          $market2=$market->ding22;
          $market3=$market->ding23;
          $xhz1=$loss4->ding22;//下滑基数
          $xhz2=$loss4->ding23;//每增加数
          $xhz3=$loss4->ding24;//下滑值
        }elseif($types==6){
          $loss2=$loss[5]->ding3;
          $loss3=$loss[5]->loss3;
          $market1=$market->ding31;
          $market2=$market->ding32;
          $market3=$market->ding33;
          $xhz1=$loss4->ding32;//下滑基数
          $xhz2=$loss4->ding33;//每增加数
          $xhz3=$loss4->ding34;//下滑值

        }
        //股东修改赔率和单注上限
        // $c_loss=$data2['loss'];
        // $c_markets=$data2['markets'];
        // if(!empty($c_loss)){
        //   $loss2=$c_loss;
        // }
        // if(!empty($c_markets)){
        //   $market2=$c_markets;
        // }
        // if($data2){
        //   $c_loss=$data2['loss'];
        //   $c_markets=$data2['markets'];
        //   if(!empty($c_loss)){
        //     $loss2=$c_loss;
        //   }
        //   if(!empty($c_markets)){
        //     $market1=$c_markets;
        //   }
        // }
         //股东修改赔率和单注上限
        if($markets){
          $c_loss=$markets['loss'];
          $c_markets=$markets['markets'];
          if(!empty($c_loss)){
            $loss2=$c_loss;
          }
          if(!empty($c_markets)){
            $market1=$c_markets;
          }
        }
         //判断总数是否超过每码销售值 
        //if(!empty($money) && ($data['m_odds']==1)){
        if(!empty($money)){
        if($money>=$market1){
          $arrs=array('code'=>400);
          return $arrs;
          exit;
        }
        if($money>=$xhz1){
         $loss2=$loss2-$xhz3;
        }
        //销售数
         if($money>=($xhz1+$xhz2)){//得到该号码的下滑值
            $money1=$money-$xhz1;
            $money2=floor($money1/$xhz2);
            if($money2>=1){
              $loss2=$loss2-($money2*$xhz3);
              if(($loss2+$xhz3) < $xhz3 ){
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
        $arr=array('code'=>200,$loss2,$market1,$market2,$market3,$loss3,$num);//赔率，每码上限，单注上限，会员回水,号码
        return $arr;
      }

//下注
    function xiazhu(){
        $xiazhu=I('post.action');
        if($xiazhu != 'xiazhu'){
         echo -2;//方法提交
         exit();
        }
         $qishu=session('qishu');
         $status=mStatus1();
         if($status[0]!=1){
          echo -19;//管理员已关闭下注功能！
         exit();
         }
        // $data = M('opentime')->where($where)->find();
        // if($data['status'] == 0){
        //  echo -19;//管理员已关闭下注功能！
        //  exit();
        // }
        $number=I('post.number');
        $money=I('post.money');
        $limit=I('post.limit');
        $zhuan24=I('post.zhuan24');
        //$limit=I('post.limit');
        if(empty($number) || empty($money) ){
         echo -2;//方法提交
         exit();
        }
        if($money > $limit){
         echo -3;//下注金额超过上限！
         exit();
        }
        $uid=session('userid');
        $username=session('unames');
        
        $num = $number;
        $sizixian=I('post.sizixian');
        $moneys=user();//当前用户的积分
        if($money > $moneys){//下注积分大于
            echo -4;
            exit();
        }
        //判断并得到改号码类型
        $data=$this->haoma($num,$sizixian);//0(数字)类型1类型2号码
        if($data['code']==400){
          echo -2;
          exit;
        }
  
        //判断改号码是否禁止购买
         $where['qishu']=$qishu;
         $where['p_type']=$data[0];
         $where['name']=$data[2];

          $prohibit=M('prohibit')->field('p_id')->where($where)->find();
          //dump($prohibit);exit;
          if(!empty($prohibit)){
            echo -6; //该号码禁止销售
            exit;
          }
            
            //得到这期该号码购买情况
            $where1['qishu']=$qishu;
            $where1['mingxi_1']=$data[3];
            $where1['mingxi_2']=$data[2];
            $where1['js']='0';
            $bets=M('bet')->field('money')->where($where1)->sum('money');
            
            // echo json_encode($where2);exit;
            //会员赔率和股东原始赔率
            $where2['uid']=$uid;
            $loss=M('uloss')->where($where2)->find();
            $datas=M('opentime')->where('qishu = "'.$qishu.'"')->order("id DESC")->find();
            // var_dump($datas);
            // var_dump($bets);exit;
            if(empty($datas)){
              echo -2;
              exit;
            }
            //得到改号码股东是否修改赔率和销售上限
            $where3['qishu']=$qishu;
            $where3['name']=$data[2];
            $where3['type']=$data[0];
            $markets=M('markets')->where($where3)->find();
            if(empty($markets) && empty($bets)){//股东没有限制(赔率和销售上限)
                if(empty($loss) || empty($loss['loss'])){//用户配置为空-->走股东
                  $arrs=$this->haomas($datas,$data[0],$data[2],$markets,$bets);
                }else{//赔率，每码上限，单注上限，会员回水,号码
                  $arrs=$this->haomas1($datas,$loss,$data[0],$data[2],$markets,$bets);
                }
            }else{
              if(empty($loss) || empty($loss['loss'])){//用户配置为空-->走股东
                  $arrs=$this->haomas($datas,$data[0],$data[2],$markets,$bets);
                }else{//赔率，每码上限，单注上限，会员回水,号码
                  $arrs=$this->haomas1($datas,$loss,$data[0],$data[2],$markets,$bets);
                }
            }
            if($arrs['code']==400){
              echo -6;
              exit;
            }
            //返回 赔率，每码上限，单注上限，最小下注上限，会员回水,号码

            //$moneys=$money;
            if($money < $arrs[3]){
                echo -31;
                exit;
            }
            $qishu=session('qishu');
            
            $did = date("YmdHis") . mt_rand("1000", "9999");
            $bet['uid'] = $uid;
            $bet['username']  = $username;
            $bet['did'] = $did;
            $bet['addtime'] = time();
            $bet['qishu'] = $qishu;
            $bet['money'] = $money;
            $bet['js']  = 0;
            $bet['index_id']  = 2;
            $bet['mingxi_1'] = $data[3];
            $bet['mingxi_2'] = $data[2];
            $bet['mingxi_3'] = $data[4];
            $bet['types']=$data[1];

          $bet['odds'] = $arrs[0];
          $bet['loss'] = $arrs[4];
          $bet['win']  = $money * $arrs[4];
          $bet['assets']  = $moneys;
        //下注添加操作
         $dd=M('bet')->add($bet);
        if(!empty($dd)){
            //k_user扣钱
            $where4['uid']=$uid;
            $data1['money']=$moneys-$money;
            $dd = M('user')->where($where4)->save($data1);
            //echo 6;exit;
        }
        
        echo 6;exit;
    }




   function unm1($num){
        $haoma1=substr($num,0,1);
        $haoma2=substr($num,1,1);
        $haoma3=substr($num,2,1);
        $haoma4=substr($num,3,1);
        //if($len==2){//赔率类型判断--6种
            if($haoma1=='X' && $haoma2=='X'){
                $type='XX口口';
            }elseif($haoma3=='X' && $haoma4=='X'){
                $type='口口XX';
            }elseif($haoma1=='X' && $haoma4=='X'){
                $type='X口口X';
            }elseif($haoma2=='X' && $haoma3=='X'){
                $type='口XX口';
            }elseif($haoma2=='X' && $haoma4=='X'){
                $type='口X口X';
            }elseif($haoma1=='X' && $haoma3=='X'){
                $type='X口X口';
            }   
            
        //}
        return $type;
    }

 //下注_二定模式二
    function xiazhu_erding(){
        //判断是否停止下注
        //判断参数来源
        //下注金额的上限和下限
      // if(empty($_POST['haoma'])  || empty($_POST['money']) || empty($_POST['action'])){
      //     echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
      // }
       $status=mStatus1();
        if($status[0]!=1){
          echo -19;//管理员已关闭下注功能！
         exit();
         }
        $uid=session('userid');
        $uname=session('unames');
        $qishu=session('qishu');
        $money=I('post.money');
        $haoma=I('post.haoma');//下注号码
        $moneys2=I('post.moneys');
        $moneys1=user();
        if($moneys2 > $moneys1){
         echo -4;
         exit;
        }
      $did = date("YmdHis") . mt_rand("1000", "9999");
      $bet['uid'] = $uid;
      $bet['username']  = $uname;
      $bet['did'] = $did;
      $bet['addtime'] = time();
      $bet['qishu'] = $qishu;
      $bet['money'] = $money;
      $bet['js']  = 0;
      $bet['index_id']  = 2;

      $bet['mingxi_3']='定';//类型
      $bet['mingxi_1']='2定';//类型
      $weishu=2;

      //得到用户下的赔率配置
       $where['uid']=$uid;
       $data=M('uloss' )->where($where)->find();//用户赔率

       $where1['qishu']=$qishu;
       $data1=M('opentime')->where($where1)->find();//原始赔率
     
       if($data1['2ding_xiane']!=1 || empty($data1)){
          echo -7;
          exit;
       }
       $bets=M('bet');
       $moneys1=user();//当前用户的积分
        if(strlen($haoma)==4){
            //$sum1=1;
            $bet['mingxi_2'] = $haoma;
            $bet['types']  =$this->unm1($haoma);
              
            $odds = get_odd3($haoma,$weishu,$bet['mingxi_3'],$data,$data1,$qishu);
            // var_dump($haoma);
            // var_dump($weishu);
           
            if($odds['code']!=400 && $money<=$odds[2] && $money>=$odds[3]){
              if($money > $moneys1){//下注积分大于
                  $bet['js'] = 4;
                  $bet['odds'] =0;
                  $bet['loss'] = 0;
                  $bet['win']  =0;
              }else{
                $bet['odds'] = $odds[0];
                $bet['loss'] = $odds[1];
                $bet['win']  = $money * $odds[1];
                $moneys+=$money;
              }
               
            }else{
                $bet['js'] = 4;
                $bet['odds'] =0;
                $bet['loss'] = 0;
                $bet['win']  =0;
            }
            //   var_dump($bet);
            // exit;
            $dd =$bets->add($bet);//插入k_bet

             
            
        }elseif(strlen($haoma)>4){
           for ($i=0;$i<strlen($haoma);$i++){
            if($cc=substr($haoma,$i*4,4)){
                $bet['mingxi_2'] = $cc;
                $bet['types']  =$this->unm1($cc);
                //分别查赔率
                $odds = get_odd3($cc,$weishu,$bet['mingxi_3'],$data,$data1,$qishu);
                //$datas[]=$odds;
                if($odds['code']!=400 && $money<=$odds[2] && $money>=$odds[3]){
                  $bet['js'] = 0;
                   $bet['odds'] = $odds[0];
                   $bet['loss'] = $odds[1];
                   $bet['win']  = $money * $odds[1];
                    $moneys+=$money;
                }else{
                    $bet['js'] = 4;
                    $bet['odds'] =0;
                    $bet['loss'] = 0;
                    $bet['win']  =0;
                }
              $dd = $bets->add($bet);//插入k_bet 
              $odds='';               
             }
              
           } 
        }
        
        //var_dump($datas);exit;
        //k_user扣钱
       // $moneys=$sum1*$money;
        if(!empty($moneys)){
          $umoney=user();
            //k_user扣钱
            $where4['uid']=$uid;
            $udata['money']=$umoney-$moneys;
            $dd = M('user')->where($where4)->save($udata);
            //echo 6;exit;
        }
       // $res = $betmodel->setTable('k_user')->where("uid = '".$uid."'")->update('money =  money -'.$moneys);


        echo 6;
    }
 //下注_二定模式一
    function xiazhu_erding1(){
        //判断是否停止下注
        //判断参数来源
        //下注金额的上限和下限
      // if(empty($_POST['haoma'])  || empty($_POST['money']) || empty($_POST['action'])){
      //     echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
      // }
      $status=mStatus1();
      if($status[0]!=1){
          echo -19;//管理员已关闭下注功能！
         exit();
         }
        $uid=session('userid');
        $uname=session('unames');
        $qishu=session('qishu');
        $haoma=I('post.haoma');//下注号码
        $moneys2=I('post.moneys');
        $moneys1=user();
        if($moneys2 > $moneys1){
         echo -4;
         exit;
        }
      $did = date("YmdHis") . mt_rand("1000", "9999");
      $bet['uid'] = $uid;
      $bet['username']  = $uname;
      $bet['did'] = $did;
      $bet['addtime'] = time();
      $bet['qishu'] = $qishu;
     
      $bet['js']  = 0;
      $bet['index_id']  = 2;

      $bet['mingxi_3']='定';//类型
      $bet['mingxi_1']='2定';//类型
      
      $weishu=2;
      
      //得到用户下的赔率配置
       $where['uid']=$uid;
       $data=M('uloss')->where($where)->find();//用户赔率
       $where1['qishu']=$qishu;
       $data1=M('opentime')->where($where1)->find();//原始赔率
       if($data1['2ding_xiane']!=1 || empty($data1)){
          echo -7;
          exit;
       }
       // $moneys=user();
       $bets = M('bet');
        if(strlen($haoma)>11){
            $strs=explode('|',$haoma);
            for($a=0;$a<count($strs);$a++){
                $strs1=explode(',',$strs[$a]);
                if($strs1[0] && $strs1[1]){
                    $haoma1=str_replace('ezdm','',$strs1[0]);//下注号码
                    $bet['mingxi_2'] = $haoma1;
                    $money=$strs1[1];//下注金额
                    $bet['money'] = $money;
                   
                    //分别查赔率
                    $odds = get_odd3($haoma1,$weishu,$bet['mingxi_3'],$data,$data1,$qishu);
                if($odds['code']!=400 && $money<=$odds[2] && $money>=$odds[3]){
                  if($money > $moneys1){//下注积分大于
                    $bet['js'] = 4;
                    $bet['odds'] =0;
                    $bet['loss'] = 0;
                    $bet['win']  =0;
                  }else{
                     $bet['types']  = $this->unm1($haoma1);
                     $bet['odds'] = $odds[0];
                     $bet['loss'] = $odds[1];
                     $bet['win']  = $money * $odds[1];
                      $moneys+=$strs1[1];//下注总金额
                  }
                  
                }else{
                    $bet['js'] = 4;
                    $bet['odds'] =0;
                    $bet['loss'] = 0;
                    $bet['win']  =0;
                }
  
                    $result = $bets->add($bet);//插入k_bet
                }
            }
        }    

        //k_user扣钱
        if(!empty($moneys)){
            //k_user扣钱
            $umoney=user();
            $where4['uid']=$uid;
            $udata['money']=$umoney-$moneys;
            $dd = M('user')->where($where4)->save($udata);
            //echo 6;exit;
        }
        echo 6;
    }





        //下注_快选
    function xiazhu_kuaixuan(){


      // if(empty($_POST['post_number_money']) || empty($_POST['post_money']) || empty($_POST['money']) || empty($_POST['selectlogsclassid'])){
      //     echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
      // }
      // $datah = M('k_message',$db_config)->where('id = 95')->limit(1)->find();
      // if($datah['is_delete'] == 0){
      //   echo "<script>alert('管理员已关闭下注功能！');history.go(-1);</script>";exit;
      // }
      // if($_POST['alltotalmoney'] > $_SESSION['money']){
      //   echo "<script>alert('下注金额超过上限！');history.go(-1);</script>";exit;
      // }
      $status=mStatus1();
      if($status[0]!=1){
          echo -19;//管理员已关闭下注功能！
         exit();
         }
        $uid=session('userid');
        $uname=session('unames');
        $qishu=session('qishu');
        $types=I('post.types');
        $money=I('post.money');
        $moneys2=I('post.moneys');
        $haoma=I('post.haoma');//下注号码
        $moneys1=user();
        if($moneys2 > $moneys1){
         echo -4;
        exit;
        }

      $did = date("YmdHis") . mt_rand("1000", "9999");
      $bet['uid'] = $uid;
      $bet['username']  = $uname;
      $bet['did'] = $did;
      $bet['addtime'] = time();
      $bet['qishu'] = $qishu;
      $bet['money'] = $money;
      $bet['js']  = 0;
      $bet['index_id']  = 2;

      switch ($types) {
        case '1':
          $bet['mingxi_3'] = '定';
          $weishu =5;
          $bet['mingxi_1'] = '2定';
          $liexings='2ding_xiane';
          break;
        case '2':
          $bet['mingxi_3'] = '定';
          $weishu = 6;
          $bet['mingxi_1'] = '3定';
           $liexings='3ding_xiane';
          break;
        case '3':
          $bet['mingxi_3'] = '定';
          $weishu = 1;
          $bet['mingxi_1'] = '4定';
           $liexings='4ding_xiane';
          break;
        case '4':
          $bet['mingxi_3'] = '现';
          $weishu = 2;
          $bet['mingxi_1'] = '2现';
           $liexings='2xian_xiane';
          break;
        case '5':
          $bet['mingxi_3'] = '现';
          $weishu = 3;
          $bet['mingxi_1'] = '3现';
          $liexings='3xian_xiane';
          break;
        case '6':
          $bet['mingxi_3'] = '现';
          $weishu = 4;
          $bet['mingxi_1'] = '4现';
          $liexings='4xian_xiane';
          break;
      }
  
       
        
        //会员赔率和股东原始赔率
        $where2['uid']=$uid;
        $loss=M('uloss')->where($where2)->find();
        $datas=M('opentime')->where('qishu = "'.$qishu.'"')->order("id DESC")->find();


        if(empty($datas) || $datas[''.$liexings.'']!=1){
          echo -7;
          exit;
          //echo '<script type="text/javascript">alert("下注失败！该类型号码禁止销售！");</script>';exit();
        }
        
        $bets = M('bet');
        $data=explode(',',$haoma);
        // if(empty($loss) || empty($loss['loss'])){//用户配置为空-->走股东
        //     $arrs=$this->haomas2($datas,$weishu,$data[0],$bet['mingxi_1']);
        //     echo '11';
        //   }else{//赔率，每码上限，单注上限，会员回水,号码
        //     $arrs=$this->haomas3($datas,$weishu,$data[0],$bet['mingxi_1'],$loss);
        //     echo '221';
        //   }
        //    if($arrs['code']!=400 && $money<=$arrs[2] && $money>=$arrs[3]){
        //      echo '333';
        //    }else{
        //        echo '444';
        //    }
          
           //$arrs=$this->haomas3($datas,$weishu,$data[0],$bet['mingxi_1'],$loss);
           // dump($arrs);exit;
        foreach ($data as $k => $v) {
           $bet['types']=$this->unm2($v,$bet['mingxi_1']);
           $bet['mingxi_2'] = $v;
          if(empty($loss) || empty($loss['loss'])){//用户配置为空-->走股东
            $arrs=$this->haomas2($datas,$weishu,$v,$bet['mingxi_1']);
          }else{//赔率，每码上限，单注上限，会员回水,号码
            $arrs=$this->haomas3($datas,$weishu,$v,$bet['mingxi_1'],$loss);
          }
           if($arrs['code']!=400 && $money<=$arrs[2] && $money>=$arrs[3]){
              // if($money > $moneys1){
              //   $bet['js'] = 4;
              //   $bet['odds'] =1;
              //   $bet['loss'] = 1;
              //   $bet['win']  =1;
              // }else{
                $bet['js'] = 0;
                $moneys+=$money;
                $bet['odds'] =$arrs[0];
                $bet['loss'] = $arrs[4];
                $bet['win']  =$money * $arrs[4];
              //}
                
            }else{
                $bet['js'] = 4;
                $bet['odds'] =0;
                $bet['loss'] = 0;
                $bet['win']  =0;
            }
            
          $dd = $bets->add($bet);//插入k_bet
        }

          //$moneys=$sum1*$money;
        if(!empty($moneys)){
            //k_user扣钱
            $umoney=user();
            $where4['uid']=$uid;
            $udata['money']=$umoney-$moneys;
            $dd = M('user')->where($where4)->save($udata);
            //echo 6;exit;
        }
        echo 6;exit;
    }


    //下注明细
    public function xiazhumingxi(){
      $qishu=I('get.qishu');
      $uid=session('userid');
      $where['uid']=$uid;
       if(empty($qishu)){
        $where['qishu']=session('qishu');
        
      }else{
        $where['qishu']=$qishu;  
      }
      $haoma=I('get.haoma');
      $xian=I('get.xian');
      $type=I('get.type');
      $types=I('get.types');
      $ks1=I('get.ks1');
      $ks2=I('get.ks2');
      $where['js']=array('not in','4,5');
      //号码搜索
      if(!empty($haoma)){
        $where['mingxi_2']=array('like','%'.$haoma.'%');
      }
      if(!empty($xian) && $xian==1){
        $where['mingxi_3']='现';
      }
      if(!empty($ks1) && !empty($ks2)){
        if($type=='1'){
          $where['money']=array(array('egt',($ks1)),array('elt',($ks2)),'and');
        }elseif($type=='2'){
          $where['js']=2;
        }else{
           $where['odds']=array(array('egt',($ks1)),array('elt',($ks2)),'and');
        }
      }
      if(!empty($types)){
        if($types=='1'){
          $where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
        }elseif($types=='三定位'){
          $where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
        }elseif($types=='四定位'){
          $where['types']='4定';
        }elseif($types=='四字现'){
          $where['types']='4现';
        }elseif($types=='三字现'){
          $where['types']='3现';
        }elseif($types=='二字现'){
          $where['types']='2现';
        }else{
          $where['types']=$types;
        }
      }
      //dump($where);exit;
      $bets=M('bet');
      $count      = $bets->where($where)->count();
      $Page       = new \Think\Page1($count,50);// 实例化分页类 传入总记录数和每页显示的记录数(25)
      $show       = $Page->show();// 分页显示输出
      $field='did,username,addtime,mingxi_1,mingxi_2,odds,money,js,status';

      $data1=$bets->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      //dump($data1);exit;
      if($data1){
        foreach($data1 as $k=>$v){
          $data1[$k]['addtime']=date('Y-m-d H:i',$v['addtime']);
          
        }
        $data['data']=$data1;
        $data['code']=200;
      }else{
         $data['code']=400;
      }
      $data['sum']=$count;
      $data['show']=$show;
      $data['qishu']=$qishu;

      $this->ajaxReturn($data);
    }


    //历史订单
    public function getQishu(){
        $data1=M('opentime')->field('qishu')->select();
        if($data1){
          foreach($data1 as $k=>$v){
            $qishu.=$v['qishu'].',';
          }
          $where2['qishu']=array('in',rtrim($qishu,','));
        }
        $where2['uid']=session('userid');
        
        $where2['js']=array('in','0,1');
        $data=M('bet')->where($where2)->order('id desc')->select();
        //var_dump();
        if(!empty($data) && !empty($data1)){
            // foreach($data as $k=>$v){   
            //     $datas[date('md',$v['addtime'])]='';//分组
            // }  
            // if($datas){
            //     foreach($datas as $k1=>$v1){ 
            //         foreach($data as $k2=>$v2){ 
            //             if($k1==date('md',$v2['addtime'] ) && ($v2['js']==0 || $v2['js']==1)){
            //                 $data1['money']+=$v2['money'];
            //                 $data1['sum']+=1;
            //                 $data1['md']=date('Y-m-d',($v2['addtime']));
            //                 $data1['qishu']=$v2['qishu'];
            //                 $data1['win']+=$v2['win'];
            //                 if($v2['js']==1){
            //                   $data1['moneys']+=$v2['money'];  
            //                 }
            //                 // $data21['sums']+=1;
            //                 // $data21['moneys']+=$v2['money'];
            //                 // $data21['win']+=$v2['win'];
                            
            //             } 
                        
            //         }  
            //        $data2['data'][]=$data1;  
            //     } 
            //     $data2['code']=200;
            // }
            // 
            foreach($data1 as $k=>$v){   
                $datas[$v['qishu']]='';//分组
            }  
            if($datas){
                foreach($datas as $k1=>$v1){ 
                    foreach($data as $k2=>$v2){ 
                        if($k1==$v2['qishu']){
                            $data1['money']+=$v2['money'];
                            $data1['sum']+=1;
                            $data1['md']=date('Y-m-d',($v2['addtime']));
                            $data1['qishu']=$v2['qishu'];
                            $data1['win']+=$v2['win'];
                            if($v2['status']==1){
                              $data1['moneys']+=$v2['money'];  
                            }
                            // $data21['sums']+=1;
                            // $data21['moneys']+=$v2['money'];
                            // $data21['win']+=$v2['win'];
                            
                        } 
                        
                    }  
                    if($data1){
                        $data2['data'][]=$data1;  
                     $data1=''; 
                    }
                  
                  
                } 
                $data2['code']=200;
            }
        }else{
          $data2['code']=400;
          $data2['data']=''; 
        } 


            $this->ajaxReturn($data2); 
    }

    //密码修改
    public function findUser(){
      $where['uid']=session('userid');
      $password=I('post.name');
      $data=M('user')->where($where)->find();
      if(!empty($data)){
        if($data['password']==MD5(MD5($password))){
          $status['code']=false;
        }else{
          $status['code']=true;
        }
      }else{
        $status['code']=true;
      }

      $this->ajaxReturn($status);
    }
    //修改密码
    public function saveUser(){
      $where['uid']=session('userid');
      $psw1=I('post.newpassword');
      $psw2=I('post.newpassword2');
      if($psw1==$psw2){
        $data['password']=MD5(MD5($psw1));
        $dd=M('user')->where($where)->save($data);
        if(empty($dd)){
          $status['code']=4001;
        }else{
          $status['code']=200;
          $status['urls']='/index.php/Login/retreats'; 
        }
        
      }else{
        $status['code']=4002;
      }
      $this->ajaxReturn($status);
    }

    //赔率保存
    public function user1(){
       
        //同时修改当前用户的赔率
        $ding41=explode('/',I('post.hs_1'));
        $tong21=explode('/',I('post.hs_2'));
        $tong22=explode('/',I('post.hs_3'));

        $tong31=explode('/',I('post.hs_4'));
        $tong32=explode('/',I('post.hs_5'));
        $tong33=explode('/',I('post.hs_6'));

        $tong41=explode('/',I('post.hs_7'));
        $tong42=explode('/',I('post.hs_8'));
        $tong43=explode('/',I('post.hs_9'));
        $tong44=explode('/',I('post.hs_10'));
        $tong45=explode('/',I('post.hs_11'));


        $ding21=explode('/',I('post.hs_12'));
        $ding31=explode('/',I('post.hs_13'));

        $data2[0]['loss4']=$ding41[0];
        $data2[0]['ding4']=$ding41[1];


        $data2[1]['loss21']=$tong21[0];
        $data2[1]['loss22']=$tong22[0];
        $data2[1]['tong21']=$tong21[1];
        $data2[1]['tong22']=$tong22[1];

        $data2[2]['loss31']=$tong31[0];
        $data2[2]['loss32']=$tong32[0];
        $data2[2]['loss33']=$tong33[0];
        $data2[2]['tong31']=$tong31[1];
        $data2[2]['tong32']=$tong32[1];
        $data2[2]['tong33']=$tong33[1];

        $data2[3]['loss41']=$tong41[0];
        $data2[3]['loss42']=$tong42[0];
        $data2[3]['loss43']=$tong43[0];
        $data2[3]['loss44']=$tong44[0];
        $data2[3]['loss45']=$tong45[0];
        $data2[3]['tong41']=$tong41[1];
        $data2[3]['tong42']=$tong42[1];
        $data2[3]['tong43']=$tong43[1];
        $data2[3]['tong44']=$tong44[1];
        $data2[3]['tong45']=$tong45[1];

        $data2[4]['loss2']=$ding21[0];
        $data2[5]['loss3']=$ding31[0];
        $data2[4]['ding2']=$ding21[1];
        $data2[5]['ding3']=$ding31[1];
        $data3['loss']=json_encode($data2);

       // var_dump($data3);exit;
        $uid=session('userid');
        $where['uid']=$uid;
        $uloss=M("uloss");
        $loss1=$uloss->where($where)->find();
        if(empty($loss1)){
          $data3['uid']=$uid;
          $loss2=$uloss->add($data3);
        }else{
          $loss2=$uloss->where($where)->save($data3);
        }
        $arr['code']=200;
        $this->ajaxReturn($arr);
    }
    //清空打印数据
    public function dataEmpty(){
       $where['uid']=session('userid'); 
       $where['qishu']=session('qishu');
       $where['js']=0;
       $data['index_id']=1;
        $dd=M('bet')->where($where)->save($data);
      echo 1;

    }

    //删除号码
    public function delHaoma(){
      $id=I('post.delid');
      $uid=session('userid');
      
      if($id){
        $ids=strtr($id,'|',',');
        $where['id']=array('in',$ids);
        $where['uid']=$uid;
        $data['js']=5;
        $bets=M('bet');
        $dd=$bets->where($where)->save($data);
      }
     echo '111';
    }
     //删除号码
     public function delsHaoma(){
       $qishu=session('qishu');
        $uid=session('userid');
        $where['uid']=$uid;
        $where['qishu']=$qishu;
        $where['js']=5;

        $bets=M('bet');
        $data=$bets->where($where)->select();

      if($data){
           $data1['code']=200; 
           $data1['data']=$data; 
        }else{
          $data1['code']=400; 
        }
        $this->ajaxReturn($data1);
    }
    //本期停押所有的号码
    public function arrhaoma(){
        $qishu=session('qishu');
        $uid=session('userid');
        $where['uid']=$uid;
        $where['qishu']=$qishu;
        $where['js']=4;
        $bets=M('bet');
        $data=$bets->where($where)->select();
        if($data){
           $data1['code']=200; 
           $data1['data']=$data; 
        }else{
          $data1['code']=400; 
        }
        $this->ajaxReturn($data1);
    }

    //赔率页面显示
    public function findOdds(){
      $type=I('post.type');
      $where['qishu']=session('qishu');
      if(empty($type)){
        $where['type']=1;
      }else{
        $where['type']=$type;
      }

      $data=M('markets')->field('loss,name')->where($where)->select();
      if(!empty($data)){
        foreach($data as $k=>$v){
          if($v['loss']){
            $data1[]=$v;
          }
        }
        if(!empty($data1)){
          foreach(array_chunk($data1, 5) as $val)
          {
          $html.='<tr>';
            foreach($val as $k1=>$v1)
            {
             
              if($k1%2!=0){
                $html.='<td class="fh">'.$v1['name'].'</td><td class="fh">'.$v1['loss'].'</td>';
              }else{
                $html.='<td>'.$v1['name'].'</td><td>'.$v1['loss'].'</td>';
              } 
               
            }
            if(5-count($val)!=0){
                for($a=0;$a<(5-count($val));$a++){
                  if($a%2!=0){
                    $html.='<td class="fh">--</td><td class="fh">--</td>';
                  }else{
                    $html.='<td>--</td><td>--</td>';
                  } 
                }
               
              } 
          $html.='</tr>';
          }
        
          $data2['code']=200;
          $data2['data']=$html;
        }
      }else{
        $data2['code']=400;
      }
     
      $this->ajaxReturn($data2);

    }

}