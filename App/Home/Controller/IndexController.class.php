<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        $opentimes = M('opentime');
        // 查询是否开盘
        $now_time = date("Y-m-d H:i:s", time());
        $where['qishu'] = session('qishu');
        $data_time = $opentimes->where($where)->find();
        $market = json_decode($data_time['m_sales']); //单注上限
        $market1 = $market->ding21;
        $market2 = $market->ding22;
        $market3 = $market->ding23;
        $bets = M('bet');
        //滚动信息
        $wher['n_status'] = 1;
        $news = M('news')->where($wher)->select();
        if ($news) {
            foreach ($news as $k => $v) {
                if ($v['n_type'] == 1) {
                    $news1 = $v;
                } else {
                    $news2 = $v;
                }
            }
        }
		  //禁止下注号码
        $qishu = session('qishu');
        $uid = session('userid');
		$user=M('user')->where(array('uid'=>$uid))->find();
        $user_loss_m = json_decode($user['loss']);
        $this->assign('news1', $news1);
        $this->assign('news2', $news2);
		$this->assign('about', $user['about']);
      
        $where1['uid'] = $uid;
        $where1['qishu'] = $qishu;
        $where1['js'] = 4;
        $data = $bets->where($where1)->select();
        //开奖号码
        $data2 = $opentimes->order('id desc')->limit(10)->select();
        //会员资料
        //赔率和单注上限（1直码/2两同/3三同/4四同/5两定/6三定）
        $data_time['m_loss']=$user['m_loss'];
        if ($data_time['m_loss']) {
            $loss = json_decode($data_time['m_loss']);
            $market = json_decode($data_time['m_sales']);
        }
        $wheres2['uid'] = $uid;
        $configs = M("uloss")->where($wheres2)->find();
        if ($configs) { //用户回水赔率配置
            $uloss = json_decode($configs['loss']);
            //四定
            $uloss1 = $uloss[0]->loss4;
            $uloss2 = $uloss[1]->loss21;
            $uloss3 = $uloss[1]->loss22;
            //var_dump($uloss3);
            $uloss4 = $uloss[2]->loss31;
            $uloss5 = $uloss[2]->loss32;
            $uloss6 = $uloss[2]->loss33;
            $uloss7 = $uloss[3]->loss41;
            $uloss8 = $uloss[3]->loss42;
            $uloss9 = $uloss[3]->loss43;
            $uloss10 = $uloss[3]->loss44;
            $uloss11 = $uloss[3]->loss45;
            $uloss12 = $uloss[4]->loss2;
            $uloss13 = $uloss[5]->loss3;
        }
        if ($loss) { //开奖号码配置赔率
            /////////四定
            $pl3 = $loss->ding41;
            if ($pl3 > 3000) {
                $pl13 = $loss->ding41 - 2500;
                $sums3 = ($pl3) - ($pl13);
                for ($i3 = 0;$i3 <= $sums3;$i3++) {
                    if ($i3 < 10) {
                        $g3 = '0.00' . $i3;
                    } elseif ($i3 >= 10 && $i3 <= 99) {
                        $g3 = '0.0' . $i3;
                    } else {
                        $g3 = '0.' . $i3;
                    }
                    if ($g3 == '0.000') {
                        $g3 = 0;
                    }
                    $f3[] = $g3;
                }
                $a41 = 250;
                for ($a41a = 0;$a41a < $a41;$a41a++) {
                    $c3 = $pl3 - ($a41a . '0');
                    if ($c3 < 1) {
                        $c3 = 0;
                    }
                    $d3[] = $c3;
                }
                $d3[] = $pl13;
                for ($h3 = 0;$h3 < count($d3);$h3++) {
                    if ($uloss1 == $f3[$h3]) {
                        $j1.= '<option value="' . $f3[$h3] . '/' . $d3[$h3] . '" selected>' . $f3[$h3] . '/' . $d3[$h3] . '</option>';
                    } else {
                        $j1.= '<option value="' . $f3[$h3] . '/' . $d3[$h3] . '">' . $f3[$h3] . '/' . $d3[$h3] . '</option>';
                    }
                }
            }
            /////////二现
            $pl6 = $loss->tong211;
            if ($pl6 > 3) {
                for ($i6 = 0;$i6 <= 250;$i6++) {
                    if ($i6 < 10) {
                        $g6 = '0.00' . $i6;
                    } elseif ($i6 >= 10 && $i6 <= 99) {
                        $g6 = '0.0' . $i6;
                    } else {
                        $g6 = '0.' . $i6;
                    }
                    if ($g6 == '0.000') {
                        $g6 = 0;
                    }
                    $f6[] = $g6;
                }
                for ($a6 = 0;$a6 < count($f6);$a6++) {
                    $arr = '0.' . $a6;
                    $arr6 = explode(".", $arr);
                    if ($a6 > 9 && $a6 <= 99) {
                        //echo $arr[3];
                        $c6 = $pl6 - ('0.' . $arr6[1]);
                    } elseif ($a6 > 99 && $a6 <= 199) {
                        $c6 = $pl6 - ('1.' . substr($arr6[1], -2));
                    } elseif ($a6 > 199) {
                        $c6 = $pl6 - ('2.' . substr($arr6[1], -2));
                    } else {
                        $c6 = $pl6 - ('0.0' . $a6);
                    }
                    if ($c6 < 1) {
                        $c6 = 0;
                    }
                    $d6[] = $c6;
                }
                for ($h6 = 0;$h6 < count($d6);$h6++) {
                    if ($uloss2 == $f6[$h6]) {
                        $j2.= '<option value="' . $f6[$h6] . '/' . $d6[$h6] . '" selected>' . $f6[$h6] . '/' . $d6[$h6] . '</option>';
                    } else {
                        $j2.= '<option value="' . $f6[$h6] . '/' . $d6[$h6] . '">' . $f6[$h6] . '/' . $d6[$h6] . '</option>';
                    }
                }
            }
            $pl7 = $loss->tong221;
            for ($i7 = 0;$i7 <= 250;$i7++) {
                if ($i7 < 10) {
                    $g7 = '0.00' . $i7;
                } elseif ($i7 >= 10 && $i7 <= 99) {
                    $g7 = '0.0' . $i7;
                } else {
                    $g7 = '0.' . $i7;
                }
                if ($g7 == '0.000') {
                    $g7 = 0;
                }
                $f7[] = $g7;
            }
            for ($a7 = 0;$a7 < count($f7);$a7++) {
                $arr = '0.' . $a7;
                $arr7 = explode(".", $arr);
                if ($a7 > 9 && $a7 <= 99) {
                    //echo $arr[3];
                    $c7 = $pl7 - (('0.' . $arr7[1]) * 2);
                } elseif ($a7 > 99 && $a7 <= 199) {
                    $c7 = $pl7 - (('1.' . substr($arr7[1], -2)) * 2);
                } elseif ($a7 > 199) {
                    $c7 = $pl7 - (('2.' . substr($arr7[1], -2)) * 2);
                } else {
                    $c7 = $pl7 - (('0.0' . $a7) * 2);
                }
                if ($c7 < 1) {
                    $c7 = 0;
                }
                $d7[] = $c7;
            }
            for ($h7 = 0;$h7 < count($d7);$h7++) {
                if ($uloss3 == $f7[$h7]) {
                    $j3.= '<option value="' . $f7[$h7] . '/' . $d7[$h7] . '" selected>' . $f7[$h7] . '/' . $d7[$h7] . '</option>';
                } else {
                    $j3.= '<option value="' . $f7[$h7] . '/' . $d7[$h7] . '">' . $f7[$h7] . '/' . $d7[$h7] . '</option>';
                }
            }
            /////////三现
            $pl4 = $loss->tong311;
            $pl14 = $loss->tong311 - 2.5;
            // $pl14=35;
            $sums4 = ($pl4 . '0') - ($pl14 . '0');
            for ($i4 = 0;$i4 <= 250;$i4++) {
                if ($i4 < 10) {
                    $g4 = '0.00' . $i4;
                } elseif ($i4 >= 10 && $i4 <= 99) {
                    $g4 = '0.0' . $i4;
                } else {
                    $g4 = '0.' . $i4;
                }
                if ($g4 == '0.000') {
                    $g4 = 0;
                }
                $f4[] = $g4;
            }
            for ($a4 = 0;$a4 < count($f4);$a4++) {
                $arr4 = '0.' . $a4;
                $arr4 = explode(".", $arr4);
                if ($a4 > 9 && $a4 < 99) {
                    //echo $arr[3];
                    $c4 = $pl4 - (('0.' . $arr4[1]) * 5);
                } elseif ($a4 > 99 && $a4 < 199) {
                    $c4 = $pl4 - (('1.' . substr($arr4[1], -2)) * 5);
                } elseif ($a4 > 199) {
                    $c4 = $pl4 - (('2.' . substr($arr4[1], -2)) * 5);
                } else {
                    $c4 = $pl4 - (('0.0' . $a4) * 5);
                }
                $d4[] = $c4;
            }
            for ($h4 = 0;$h4 < count($d4);$h4++) {
                if ($uloss4 == $f4[$h4]) {
                    $j4.= '<option value="' . $f4[$h4] . '/' . $d4[$h4] . '" selected>' . $f4[$h4] . '/' . $d4[$h4] . '</option>';
                } else {
                    $j4.= '<option value="' . $f4[$h4] . '/' . $d4[$h4] . '">' . $f4[$h4] . '/' . $d4[$h4] . '</option>';
                }
            }
            $pl8 = $loss->tong321;
            $pl18 = $loss->tong321 - 2.5;
            $sums8 = ($pl8 . '0') - ($pl18 . '0');
            for ($i8 = 0;$i8 <= 250;$i8++) {
                if ($i8 < 10) {
                    $g8 = '0.00' . $i8;
                } elseif ($i8 >= 10 && $i8 <= 99) {
                    $g8 = '0.0' . $i8;
                } else {
                    $g8 = '0.' . $i8;
                }
                if ($g8 == '0.000') {
                    $g8 = 0;
                }
                $f8[] = $g8;
            }
            // for($a8=0;$a8<count($f8);$a8++){
            //     $arr8=$a8;
            //     if($a8<=9){
            //         $c8=$pl8-('0.'.substr($arr8,-1,1));
            //     }elseif($a8>9 && $a8<=99){
            //         $c8=$pl8-(substr($arr8,-2,1).'.'.substr($arr8,-1,1));
            //     }else{
            //         $c8=$pl8-(substr($arr8,-3,2).'.'.substr($arr8,-1,1));
            //     }
            //     if($c8<1){
            //      $c8=0;
            //     }
            //     $d8[]=$c8;
            // }
            for ($a8 = 0;$a8 < count($f8);$a8++) {
                $ar8 = '0.' . $a8;
                $arr8 = explode(".", $ar8);
                if ($a8 > 9 && $a8 < 99) {
                    //echo $arr[3];
                    $c8 = $pl8 - (('0.' . $arr8[1]) * 8);
                } elseif ($a8 > 99 && $a8 <= 199) {
                    $c8 = $pl8 - (('1.' . substr($arr8[1], -2)) * 8);
                } elseif ($a8 > 199) {
                    $c8 = $pl8 - (('2.' . substr($arr8[1], -2)) * 8);
                } else {
                    $c8 = $pl8 - (('0.0' . $a8) * 8);
                }
                $d8[] = $c8;
            }
            for ($h8 = 0;$h8 < count($d8);$h8++) {
                if ($uloss5 == $f8[$h8]) {
                    $j5.= '<option value="' . $f8[$h8] . '/' . $d8[$h8] . '" selected>' . $f8[$h8] . '/' . $d8[$h8] . '</option>';
                } else {
                    $j5.= '<option value="' . $f8[$h8] . '/' . $d8[$h8] . '">' . $f8[$h8] . '/' . $d8[$h8] . '</option>';
                }
            }
            $pl9 = $loss->tong331;
            $pl19 = 35;
            $sums9 = ($pl9 . '0') - ($pl19 . '0');
            for ($i9 = 0;$i9 <= 250;$i9++) {
                if ($i9 < 10) {
                    $g9 = '0.00' . $i9;
                } elseif ($i9 >= 10 && $i9 <= 99) {
                    $g9 = '0.0' . $i9;
                } else {
                    $g9 = '0.' . $i9;
                }
                if ($g9 == '0.000') {
                    $g9 = 0;
                }
                $f9[] = $g9;
            }
            for ($a9 = 0;$a9 < count($f9);$a9++) {
                //   $ar9='0.'.$a9;
                //   $arr9=explode(".",$ar9);
                // if($a9>9 && $a9<99){
                //     //echo $arr[3];
                //     $c9= $pl9-(('0.'.$arr9[1])*5);
                // }elseif($a9>99 && $a9<199){
                //   $c9= $pl9-(('1.'.substr($arr9[1],-2))*5);
                // }elseif($a9>199){
                //   $c9= $pl9-(('2.'.substr($arr9[1],-2))*5);
                // }else{
                //   $c9= $pl9-(('0.'.$a9)*5);
                // }
                // if($c9<1){
                //    $c9=0;
                // }
                $arr9 = $a9 * 1;
                if ($a9 <= 9) {
                    $c9 = $pl9 - ('0.' . substr($arr9, -1, 1));
                } elseif ($a9 > 9 && $a9 <= 99) {
                    $c9 = $pl9 - (substr($arr9, -2, 1) . '.' . substr($arr9, -1, 1));
                } else {
                    $c9 = $pl9 - (substr($arr9, -3, 2) . '.' . substr($arr9, -1, 1));
                }
                if ($c9 < 1) {
                    $c9 = 0;
                }
                $d9[] = $c9;
            }
            for ($h9 = 0;$h9 < count($d9);$h9++) {
                if ($uloss6 == $f9[$h9]) {
                    $j6.= '<option value="' . $f9[$h9] . '/' . $d9[$h9] . '" selected>' . $f9[$h9] . '/' . $d9[$h9] . '</option>';
                } else {
                    $j6.= '<option value="' . $f9[$h9] . '/' . $d9[$h9] . '">' . $f9[$h9] . '/' . $d9[$h9] . '</option>';
                }
            }
            /////////四现
            $pl5 = $loss->tong411;
            // $pl15=320;
            // $sums5=$pl5-$pl15;
            for ($i5 = 0;$i5 <= 250;$i5++) {
                if ($i5 < 10) {
                    $g5 = '0.00' . $i5;
                } elseif ($i5 >= 10 && $i5 <= 99) {
                    $g5 = '0.0' . $i5;
                } else {
                    $g5 = '0.' . $i5;
                }
                if ($g5 == '0.000') {
                    $g5 = 0;
                }
                $f5[] = $g5;
            }
            for ($a5 = 0;$a5 < count($f5);$a5++) {
                $ar5 = '0.' . $a5;
                $arr5 = explode(".", $ar5);
                if ($a5 < 10) {
                    $as5 = 0;
                    $c5 = $pl5 - (('0.' . $arr5[1]) * 4);
                } elseif ($a5 >= 10 && $a5 <= 19) {
                    $c5 = $pl5 - (('1.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 20 && $a5 <= 29) {
                    $c5 = $pl5 - (('2.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 30 && $a5 <= 39) {
                    $c5 = $pl5 - (('3.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 40 && $a5 <= 49) {
                    $c5 = $pl5 - (('4.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 50 && $a5 <= 59) {
                    $c5 = $pl5 - (('5.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 60 && $a5 <= 69) {
                    $c5 = $pl5 - (('6.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 70 && $a5 <= 79) {
                    $c5 = $pl5 - (('7.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 80 && $a5 <= 89) {
                    $c5 = $pl5 - (('8.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 90 && $a5 <= 99) {
                    $c5 = $pl5 - (('9.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 100 && $a5 <= 109) {
                    $c5 = $pl5 - (('10.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 110 && $a5 <= 119) {
                    $c5 = $pl5 - (('11.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 120 && $a5 <= 129) {
                    $c5 = $pl5 - (('12.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 130 && $a5 <= 139) {
                    $c5 = $pl5 - (('13.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 140 && $a5 <= 149) {
                    $c5 = $pl5 - (('14.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 150 && $a5 <= 159) {
                    $c5 = $pl5 - (('15.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 160 && $a5 <= 169) {
                    $c5 = $pl5 - (('16.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 170 && $a5 <= 179) {
                    $c5 = $pl5 - (('17.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 180 && $a5 <= 189) {
                    $c5 = $pl5 - (('18.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 190 && $a5 <= 199) {
                    $c5 = $pl5 - (('19.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 200 && $a5 <= 209) {
                    $c5 = $pl5 - (('20.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 210 && $a5 <= 219) {
                    $c5 = $pl5 - (('21.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 220 && $a5 <= 229) {
                    $c5 = $pl5 - (('22.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 230 && $a5 <= 239) {
                    $c5 = $pl5 - (('23.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 240 && $a5 <= 249) {
                    $c5 = $pl5 - (('24.' . substr($arr5[1], -1)) * 4);
                } elseif ($a5 >= 250 && $a5 <= 259) {
                    $c5 = $pl5 - (('25.' . substr($arr5[1], -1)) * 4);
                }
                $d5[] = $c5;
            }
            //dump($d5);exit;
            for ($h5 = 0;$h5 < count($d5);$h5++) {
                if ($uloss7 == $f5[$h5]) {
                    $j7.= '<option value="' . $f5[$h5] . '/' . $d5[$h5] . '" selected>' . $f5[$h5] . '/' . $d5[$h5] . '</option>';
                } else {
                    $j7.= '<option value="' . $f5[$h5] . '/' . $d5[$h5] . '">' . $f5[$h5] . '/' . $d5[$h5] . '</option>';
                }
            }
            $pl10 = $loss->tong421;
            $pl110 = 580;
            $sums10 = $pl10 - $pl110;
            for ($i10 = 0;$i10 <= 250;$i10++) {
                if ($i10 < 10) {
                    $g10 = '0.00' . $i10;
                } elseif ($i10 >= 10 && $i10 <= 99) {
                    $g10 = '0.0' . $i10;
                } else {
                    $g10 = '0.' . $i10;
                }
                if ($g10 == '0.000') {
                    $g10 = 0;
                }
                $f10[] = $g10;
            }
            for ($a10 = 0;$a10 < count($f10);$a10++) {
                $ar5 = '0.' . $a10;
                $arr10 = explode(".", $ar5);
                if ($a10 < 10) {
                    $as5 = 0;
                    $c10 = $pl10 - (('0.' . $arr10[1]) * 2);
                } elseif ($a10 >= 10 && $a10 <= 19) {
                    $c10 = $pl10 - (('1.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 20 && $a10 <= 29) {
                    $c10 = $pl10 - (('2.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 30 && $a10 <= 39) {
                    $c10 = $pl10 - (('3.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 40 && $a10 <= 49) {
                    $c10 = $pl10 - (('4.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 50 && $a10 <= 59) {
                    $c10 = $pl10 - (('5.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 60 && $a10 <= 69) {
                    $c10 = $pl10 - (('6.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 70 && $a10 <= 79) {
                    $c10 = $pl10 - (('7.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 80 && $a10 <= 89) {
                    $c10 = $pl10 - (('8.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 90 && $a10 <= 99) {
                    $c10 = $pl10 - (('9.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 100 && $a10 <= 109) {
                    $c10 = $pl10 - (('10.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 110 && $a10 <= 119) {
                    $c10 = $pl10 - (('11.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 120 && $a10 <= 129) {
                    $c10 = $pl10 - (('12.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 130 && $a10 <= 139) {
                    $c10 = $pl10 - (('13.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 140 && $a10 <= 149) {
                    $c10 = $pl10 - (('14.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 150 && $a10 <= 159) {
                    $c10 = $pl10 - (('15.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 160 && $a10 <= 169) {
                    $c10 = $pl10 - (('16.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 170 && $a10 <= 179) {
                    $c10 = $pl10 - (('17.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 180 && $a10 <= 189) {
                    $c10 = $pl10 - (('18.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 190 && $a10 <= 199) {
                    $c10 = $pl10 - (('19.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 200 && $a10 <= 209) {
                    $c10 = $pl10 - (('20.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 210 && $a10 <= 219) {
                    $c10 = $pl10 - (('21.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 220 && $a10 <= 229) {
                    $c10 = $pl10 - (('22.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 230 && $a10 <= 239) {
                    $c10 = $pl10 - (('23.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 240 && $a10 <= 249) {
                    $c10 = $pl10 - (('24.' . substr($arr10[1], -1)) * 2);
                } elseif ($a10 >= 250 && $a10 <= 259) {
                    $c10 = $pl10 - (('25.' . substr($arr10[1], -1)) * 2);
                }
                $d10[] = $c10;
            }
            for ($h10 = 0;$h10 < count($d10);$h10++) {
                if ($uloss8 == $f10[$h10]) {
                    $j8.= '<option value="' . $f10[$h10] . '/' . $d10[$h10] . '" selected>' . $f10[$h10] . '/' . $d10[$h10] . '</option>';
                } else {
                    $j8.= '<option value="' . $f10[$h10] . '/' . $d10[$h10] . '">' . $f10[$h10] . '/' . $d10[$h10] . '</option>';
                }
            }
            $pl11 = $loss->tong431;
            $pl111 = 580;
            $sums11 = $pl11 - $pl111;
            for ($i11 = 0;$i11 <= 250;$i11++) {
                if ($i11 < 11) {
                    $g11 = '0.00' . $i11;
                } elseif ($i11 >= 11 && $i11 <= 99) {
                    $g11 = '0.0' . $i11;
                } else {
                    $g11 = '0.' . $i11;
                }
                if ($g11 == '0.000') {
                    $g11 = 0;
                }
                $f11[] = $g11;
            }
            for ($a11 = 0;$a11 < count($f11);$a11++) {
                $ar11 = '0.' . $a11;
                $arr11 = explode(".", $ar11);
                if ($a11 < 10) {
                    $c11 = $pl11 - (('0.' . $arr11[1]) * 4);
                } elseif ($a11 >= 10 && $a11 <= 19) {
                    $c11 = $pl11 - (('1.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 20 && $a11 <= 29) {
                    $c11 = $pl11 - (('2.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 30 && $a11 <= 39) {
                    $c11 = $pl11 - (('3.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 40 && $a11 <= 49) {
                    $c11 = $pl11 - (('4.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 50 && $a11 <= 59) {
                    $c11 = $pl11 - (('5.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 60 && $a11 <= 69) {
                    $c11 = $pl11 - (('6.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 70 && $a11 <= 79) {
                    $c11 = $pl11 - (('7.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 80 && $a11 <= 89) {
                    $c11 = $pl11 - (('8.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 90 && $a11 <= 99) {
                    $c11 = $pl11 - (('9.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 100 && $a11 <= 109) {
                    $c11 = $pl11 - (('10.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 110 && $a11 <= 119) {
                    $c11 = $pl11 - (('11.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 120 && $a11 <= 129) {
                    $c11 = $pl11 - (('12.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 130 && $a11 <= 139) {
                    $c11 = $pl11 - (('13.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 140 && $a11 <= 149) {
                    $c11 = $pl11 - (('14.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 150 && $a11 <= 159) {
                    $c11 = $pl11 - (('15.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 160 && $a11 <= 169) {
                    $c11 = $pl11 - (('16.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 170 && $a11 <= 179) {
                    $c11 = $pl11 - (('17.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 180 && $a11 <= 189) {
                    $c11 = $pl11 - (('18.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 190 && $a11 <= 199) {
                    $c11 = $pl11 - (('19.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 200 && $a11 <= 209) {
                    $c11 = $pl11 - (('20.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 210 && $a11 <= 219) {
                    $c11 = $pl11 - (('21.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 220 && $a11 <= 229) {
                    $c11 = $pl11 - (('22.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 230 && $a11 <= 239) {
                    $c11 = $pl11 - (('23.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 240 && $a11 <= 249) {
                    $c11 = $pl11 - (('24.' . substr($arr11[1], -1)) * 4);
                } elseif ($a11 >= 250 && $a11 <= 259) {
                    $c11 = $pl11 - (('25.' . substr($arr11[1], -1)) * 4);
                }
                $d11[] = $c11;
            }
            for ($h11 = 0;$h11 < count($d11);$h11++) {
                if ($uloss9 == $f11[$h11]) {
                    $j9.= '<option value="' . $f11[$h11] . '/' . $d11[$h11] . '" selected>' . $f11[$h11] . '/' . $d11[$h11] . '</option>';
                } else {
                    $j9.= '<option value="' . $f11[$h11] . '/' . $d11[$h11] . '">' . $f11[$h11] . '/' . $d11[$h11] . '</option>';
                }
            }
            $pl12 = $loss->tong441;
            $pl121 = 1110;
            $sums12 = $pl12 - $pl121;
            for ($i12 = 0;$i12 <= 250;$i12++) {
                if ($i12 < 12) {
                    $g12 = '0.00' . $i12;
                } elseif ($i12 >= 12 && $i12 <= 99) {
                    $g12 = '0.0' . $i12;
                } else {
                    $g12 = '0.' . $i12;
                }
                if ($g12 == '0.000') {
                    $g12 = 0;
                }
                $f12[] = $g12;
            }
            for ($a12 = 0;$a12 < count($f12);$a12++) {
                $ar12 = '0.' . $a12;
                $arr12 = explode(".", $ar12);
                if ($a12 < 10) {
                    $c12 = $pl12 - (('0.' . $arr12[1]) * 4);
                } elseif ($a12 >= 10 && $a12 <= 19) {
                    $c12 = $pl12 - (('1.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 20 && $a12 <= 29) {
                    $c12 = $pl12 - (('2.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 30 && $a12 <= 39) {
                    $c12 = $pl12 - (('3.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 40 && $a12 <= 49) {
                    $c12 = $pl12 - (('4.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 50 && $a12 <= 59) {
                    $c12 = $pl12 - (('5.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 60 && $a12 <= 69) {
                    $c12 = $pl12 - (('6.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 70 && $a12 <= 79) {
                    $c12 = $pl12 - (('7.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 80 && $a12 <= 89) {
                    $c12 = $pl12 - (('8.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 90 && $a12 <= 99) {
                    $c12 = $pl12 - (('9.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 100 && $a12 <= 109) {
                    $c12 = $pl12 - (('10.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 110 && $a12 <= 119) {
                    $c12 = $pl12 - (('11.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 120 && $a12 <= 129) {
                    $c12 = $pl12 - (('12.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 130 && $a12 <= 139) {
                    $c12 = $pl12 - (('13.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 140 && $a12 <= 149) {
                    $c12 = $pl12 - (('14.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 150 && $a12 <= 159) {
                    $c12 = $pl12 - (('15.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 160 && $a12 <= 169) {
                    $c12 = $pl12 - (('16.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 170 && $a12 <= 179) {
                    $c12 = $pl12 - (('17.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 180 && $a12 <= 189) {
                    $c12 = $pl12 - (('18.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 190 && $a12 <= 199) {
                    $c12 = $pl12 - (('19.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 200 && $a12 <= 209) {
                    $c12 = $pl12 - (('20.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 210 && $a12 <= 219) {
                    $c12 = $pl12 - (('21.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 220 && $a12 <= 229) {
                    $c12 = $pl12 - (('22.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 230 && $a12 <= 239) {
                    $c12 = $pl12 - (('23.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 240 && $a12 <= 249) {
                    $c12 = $pl12 - (('24.' . substr($arr12[1], -1)) * 4);
                } elseif ($a12 >= 250 && $a12 <= 259) {
                    $c12 = $pl12 - (('25.' . substr($arr12[1], -1)) * 4);
                }
                $d12[] = $c12;
            }
            for ($h12 = 0;$h12 < count($d12);$h12++) {
                if ($uloss10 == $f12[$h12]) {
                    $j10.= '<option value="' . $f12[$h12] . '/' . $d12[$h12] . '" selected>' . $f12[$h12] . '/' . $d12[$h12] . '</option>';
                } else {
                    $j10.= '<option value="' . $f12[$h12] . '/' . $d12[$h12] . '">' . $f12[$h12] . '/' . $d12[$h12] . '</option>';
                }
            }
            $pl13 = $loss->tong451;
            for ($i13 = 0;$i13 <= 250;$i13++) {
                if ($i13 < 12) {
                    $g13 = '0.00' . $i13;
                } elseif ($i13 >= 12 && $i13 <= 99) {
                    $g13 = '0.0' . $i13;
                } else {
                    $g13 = '0.' . $i13;
                }
                if ($g13 == '0.000') {
                    $g13 = 0;
                }
                $f13[] = $g13;
            }
            for ($a13 = 0;$a13 < count($f13);$a13++) {
                $ar13 = '0.' . $a13;
                $arr13 = explode(".", $ar13);
                if ($a13 < 10) {
                    $c13 = $pl13 - (('0.' . $arr13[1]) * 4);
                } elseif ($a13 >= 10 && $a13 <= 19) {
                    $c13 = $pl13 - (('1.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 20 && $a13 <= 29) {
                    $c13 = $pl13 - (('2.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 30 && $a13 <= 39) {
                    $c13 = $pl13 - (('3.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 40 && $a13 <= 49) {
                    $c13 = $pl13 - (('4.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 50 && $a13 <= 59) {
                    $c13 = $pl13 - (('5.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 60 && $a13 <= 69) {
                    $c13 = $pl13 - (('6.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 70 && $a13 <= 79) {
                    $c13 = $pl13 - (('7.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 80 && $a13 <= 89) {
                    $c13 = $pl13 - (('8.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 90 && $a13 <= 99) {
                    $c13 = $pl13 - (('9.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 100 && $a13 <= 109) {
                    $c13 = $pl13 - (('10.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 110 && $a13 <= 119) {
                    $c13 = $pl13 - (('11.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 120 && $a13 <= 129) {
                    $c13 = $pl13 - (('12.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 130 && $a13 <= 139) {
                    $c13 = $pl13 - (('13.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 140 && $a13 <= 149) {
                    $c13 = $pl13 - (('14.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 150 && $a13 <= 159) {
                    $c13 = $pl13 - (('15.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 160 && $a13 <= 169) {
                    $c13 = $pl13 - (('16.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 170 && $a13 <= 179) {
                    $c13 = $pl13 - (('17.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 180 && $a13 <= 189) {
                    $c13 = $pl13 - (('18.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 190 && $a13 <= 199) {
                    $c13 = $pl13 - (('19.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 200 && $a13 <= 209) {
                    $c13 = $pl13 - (('20.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 210 && $a13 <= 219) {
                    $c13 = $pl13 - (('21.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 220 && $a13 <= 229) {
                    $c13 = $pl13 - (('22.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 230 && $a13 <= 239) {
                    $c13 = $pl13 - (('23.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 240 && $a13 <= 249) {
                    $c13 = $pl13 - (('24.' . substr($arr13[1], -1)) * 4);
                } elseif ($a13 >= 250 && $a13 <= 259) {
                    $c13 = $pl13 - (('25.' . substr($arr13[1], -1)) * 4);
                }
                $d13[] = $c13;
            }
            for ($h13 = 0;$h13 < count($d13);$h13++) {
                if ($uloss11 == $f13[$h13]) {
                    $j11.= '<option value="' . $f13[$h13] . '/' . $d13[$h13] . '" selected>' . $f13[$h13] . '/' . $d13[$h13] . '</option>';
                } else {
                    $j11.= '<option value="' . $f13[$h13] . '/' . $d13[$h13] . '">' . $f13[$h13] . '/' . $d13[$h13] . '</option>';
                }
            }
            /////////////二定
            $pl = $loss->ding21;
            for ($i = 0;$i <= 250;$i++) {
                if ($i < 10) {
                    $g = '0.00' . $i;
                } elseif ($i >= 10 && $i <= 99) {
                    $g = '0.0' . $i;
                } else {
                    $g = '0.' . $i;
                }
                if ($g == '0.000') {
                    $g = 0;
                }
                $f[] = $g;
            }
            for ($a14 = 0;$a14 < count($f);$a14++) {
                $arr14 = $a14;
                if ($a14 <= 9) {
                    $c14 = $pl - ('0.' . substr($arr14, -1, 1));
                } elseif ($a14 > 9 && $a14 <= 99) {
                    $c14 = $pl - (substr($arr14, -2, 1) . '.' . substr($arr14, -1, 1));
                } else {
                    $c14 = $pl - (substr($arr14, -3, 2) . '.' . substr($arr14, -1, 1));
                }
                if ($c14 < 1) {
                    $c14 = 0;
                }
                $d14[] = $c14;
            }
            for ($h = 0;$h < count($d14);$h++) {
                if ($uloss12 == $f[$h]) {
                    $j12.= '<option value="' . $f[$h] . '/' . $d14[$h] . '" selected>' . $f[$h] . '/' . $d14[$h] . '</option>';
                } else {
                    $j12.= '<option value="' . $f[$h] . '/' . $d14[$h] . '">' . $f[$h] . '/' . $d14[$h] . '</option>';
                }
            }
            /////////三定
            $pl2 = $loss->ding31;
            for ($i2 = 0;$i2 <= 250;$i2++) {
                if ($i2 < 10) {
                    $g2 = '0.00' . $i2;
                } elseif ($i2 >= 10 && $i2 <= 99) {
                    $g2 = '0.0' . $i2;
                } else {
                    $g2 = '0.' . $i2;
                }
                if ($g2 == '0.000') {
                    $g2 = 0;
                }
                $f2[] = $g2;
            }
            for ($a2 = 0;$a2 < count($f2);$a2++) {
                $arr = '0.' . $a2;
                $arr2 = explode(".", $arr);
                if ($a2 > 9 && $a2 < 99) {
                    $c2 = $pl2 - (($arr2[1]) * 1);
                } elseif ($a2 > 99 && $a2 < 199) {
                    $c2 = $pl2 - (('1' . substr($arr2[1], -2)) * 1);
                } elseif ($a2 > 199) {
                    $c2 = $pl2 - (('2' . substr($arr2[1], -2)) * 1);
                } else {
                    $c2 = $pl2 - ($a2 * 1);
                }
                if ($c2 < 1) {
                    $c2 = 0;
                }
                $d2[] = $c2;
            }
            for ($h2 = 0;$h2 < count($d2);$h2++) {
                if ($uloss13 == $f2[$h2]) {
                    $j13.= '<option value="' . $f2[$h2] . '/' . $d2[$h2] . '" selected>' . $f2[$h2] . '/' . $d2[$h2] . '</option>';
                } else {
                    $j13.= '<option value="' . $f2[$h2] . '/' . $d2[$h2] . '">' . $f2[$h2] . '/' . $d2[$h2] . '</option>';
                }
            }
        }
        // var_dump($market);
        // var_dump($loss);
        //二定
        $this->assign("j1", $j1);
        $this->assign("j2", $j2);
        $this->assign("j3", $j3);
        $this->assign("j4", $j4);
        $this->assign("j5", $j5);
        $this->assign("j6", $j6);
        $this->assign("j7", $j7);
        $this->assign("j8", $j8);
        $this->assign("j9", $j9);
        $this->assign("j10", $j10);
        $this->assign("j11", $j11);
        $this->assign("j12", $j12);
        $this->assign("j13", $j13);
        $this->assign("loss", $loss);
        $this->assign("market", $market);
        //使用期数
        $getData = getData();
        $this->assign('getData', $getData); //所有期数
        $this->assign('data3', $data3); //本期下注明细
        $this->assign('data2', $data2); //开奖号码
        $this->assign('data', $data); //禁止下注号码
        $this->assign('market2', $market2); //下注上限
        $this->assign('market3', $market3); //下注下限
        $this->assign("user_loss_m", $user_loss_m);
        $this->display();
    }
    //会员资料
    public function appprint() {
        //编号
        // $did = date("ymd") . mt_rand("10000", "99999");
        // $time=date('Y-m-d H:i:s');
        // $this->assign('did',$did);
        // $this->assign('time',$time);
        $this->display();
    }
    //打印区
    public function appindexajax() {
        $userid = session('userid');
        $qishu = session('qishu');
        $where['uid'] = $userid;
		$user=M('user')->where($where)->find();
        $data['about']=$user['about'];
        $where['qishu'] = $qishu;
        $where['js'] = 0;
        //$where['index_id']=2;
        $bets = M('bet');
        // $where1['js']=0;
        // $where1['qishu']=$qishu;
        // $umoney=$bets->where($where1)->sum('money');
        //dump($umoney);exit;
        //$data['moneys']=user();//用户总积分
        $dd = $bets->field('id,did,money,addtime,mingxi_1,mingxi_2,mingxi_3,odds,index_id')->where($where)->order('id asc')->select();
        //dump($dd);exit;
        // $where1['uid']=$userid;
        // $where1['qishu']=$qishu;
        // $where1['js']=0;
        // $data['money']=$bets->where($where1)->sum('money');
        // if($data1){
        //   foreach($data1 as $k1=>$v1){
        //         $data['money']+=$v1['money'];
        //   }
        // }
        if (!empty($dd)) {
            foreach ($dd as $k => $v) {
                $data['moneys1']+= $v['money'];
                if ($v['index_id'] == 2) {
                    $data1['odds'] = $v['odds'];
                    $data1['mingxi_1'] = $v['mingxi_1'];
                    $data1['mingxi_2'] = $v['mingxi_2'];
                    $data1['mingxi_3'] = $v['mingxi_3'];
                    $data1['addtime'] = $v['addtime'];
                    $data1['did'] = $v['did'];
                    $money11 = explode('.', $v['money']);
                    if ($money11[1] > 1) {
                        $data1['money'] = sprintf("%.1f ", $v['money']);
                    } else {
                        $data1['money'] = intval($v['money']);
                    }
                    //
                    $data1['id'] = $v['id'];
                    $data['data'][] = $data1;
                    $money+= $v['money'];
                }
            }
            $data['code'] = 200;
            if ($data['data']) {
                $count = count($data['data']); //笔数
                //$data['moneys']=user();//用户总积分
                $data['count'] = $count; //笔数
                $data['money'] = $money; //总金额
                $data['time'] = date('Y-m-d H:i', $data['data'][$count - 1]['addtime']); //下注时间
                $data['did'] = $data['data'][$count - 1]['did']; //下注编号
                
            } else {
                $data['code'] = 400;
            }
        } else {
            $data['moneys1'] = 0;
            $data['money'] = 0;
            $data['code'] = 400;
        }
        //$data['moneys']=user()+$money;//用户总积分
        $data['moneys'] = user() + $data['moneys1']; //用户总积分
        if ($data['moneys'] - $data['moneys1'] > 0) {
            $data['moneys2'] = $data['moneys'] - $data['moneys1'];
        } else {
            $data['moneys2'] = 0;
        }
        // if(!empty($dd)){
        //   //$data['data']=$bets->field('id,did,money,addtime,mingxi_2,mingxi_3,odds')->where($where)->order('id desc')->select();
        //     $data['data']=$dd;
        //     $data['code']=200;
        //     foreach($data['data'] as $k=>$v){
        //         $data['data'][$k]['money']=intval($v['money']);
        //         $money+=$v['money'];
        //     }
        //     $count=count($data['data']);//笔数
        //     //$data['moneys']=user();//用户总积分
        //     $data['count']=$count;//笔数
        //     $data['money1']=$money;//总金额
        //     $data['time']=date('Y-m-d H:i',$data['data'][$count-1]['addtime']);//下注时间
        //     $data['did']=$data['data'][$count-1]['did'];//下注编号
        // }else{
        //     $data['code']=400;
        // }
        echo json_encode($data);
        exit;
    }
    //下注框
    public function xiazhukuang() {
        $where['uid'] = session('userid');
        $where['qishu'] = session('qishu');
        $where['js'] =array('not in','4,5');
        $data['data'] = M('bet')->field('js,id,addtime,money,did,mingxi_1,mingxi_2,mingxi_3,odds')->where($where)->where('js!=2')->order('id desc')->limit(10)->select();
        $times=M('opentime')->where(array('qishu'=>$where['qishu']))->find();
		if (!empty($data['data'])) {
			foreach($data['data'] as $k=>$v){
                $v['t_status']=1;
                if($v['addtime']+($times['m_retreat']*60) <time()){
                     $v['t_status']=2;
                }
                $data['data'][$k]=$v;
            }
            $data['data'] =array_reverse($data['data']);
            $data['code'] = 200;
        } else {
            $data['code'] = 400;
        }
        echo json_encode($data);
        exit;
    }
    //退码
    public function tuima() {
        //得到退码时间
        $where1['qishu'] = session('qishu');
        $time = M('opentime')->where($where1)->find();
        $id = explode('|', I('post.tuimaid'));
        $uid = session('userid');
        // $where['qishu']=session('qishu');
        //$id=I('post.id');
        $where['id'] = array('in', $id);
        $where['uid'] = $uid;
        $bets = M('bet');
        $data = $bets->where($where)->select();
        if ($data) {
            foreach ($data as $k => $v) {
                if ((time() - ($v['addtime'])) <= ($time['m_retreat'] * 60)) {
                    $idArr.= $v['id'] . ',';
                }
            }
            if (!empty($idArr)) {
                $where2['id'] = array('in', $idArr);
                $where2['uid'] = $uid;
                $data1['js'] = 2;
                $data1['tuima_time'] = time();
                $dd = $bets->where($where2)->save($data1);
                $datas = $bets->field('money')->where($where2)->select($data1);
                foreach ($datas as $k1 => $v1) {
                    if ($v1['money']) {
                        $moneys+= $v1['money'];
                    }
                }
                $where3['uid'] = $uid;
                $data2['money'] = user() + $moneys;
                $dd = M('user')->where($where3)->save($data2);
            }
        }
        // var_dump($_GET);exit;
        $status['code'] = 200;
        echo json_encode($status);
        exit;
    }
    //用户赔率
    public function userloss() {
        $where['uid'] = session('userid');
        $data = M('uloss')->where($where)->limit(1)->find();
        $where1['qishu'] = session('qishu');
        $data_time = M('opentime')->where($where1)->find();
        if ($data_time['m_loss']) {
            $loss4 = json_decode($data_time['m_loss']);
            //$market=json_decode($data_time['m_sales']);
            
        }
        if ($data['loss']) {
            $loss = json_decode($data['loss']);
            $loss1 = $loss[4]->ding2;
            $loss3 = $loss[4]->loss2;
            $pl = $loss4->ding21;
            for ($i = 0;$i <= 250;$i++) {
                if ($i < 10) {
                    $g = '0.00' . $i;
                } elseif ($i >= 10 && $i <= 99) {
                    $g = '0.0' . $i;
                } else {
                    $g = '0.' . $i;
                }
                if ($g == '0.000') {
                    $g = 0;
                }
                $f[] = $g;
            }
            for ($a14 = 0;$a14 < count($f);$a14++) {
                $arr14 = $a14;
                if ($a14 <= 9) {
                    $c14 = $pl - ('0.' . substr($arr14, -1, 1));
                } elseif ($a14 > 9 && $a14 <= 99) {
                    $c14 = $pl - (substr($arr14, -2, 1) . '.' . substr($arr14, -1, 1));
                } else {
                    $c14 = $pl - (substr($arr14, -3, 2) . '.' . substr($arr14, -1, 1));
                }
                if ($c14 < 1) {
                    $c14 = 0;
                }
                $d14[] = $c14;
            }
            for ($h = 0;$h < count($d14);$h++) {
                if ($loss3 == $f[$h]) {
                    $loss1 = $d14[$h];
                }
            }
        } else {
            $where1['qishu'] = session('qishu');

            $user = M('user')->where($where)->find();
            if($user){
                $loss = json_decode($user['loss']);
            }else{
                $data1 = M('opentime')->where($where1)->limit(1)->find();
                $loss = json_decode($data1['m_loss']);
            }
            $loss1 = $loss->ding21;
        }
        return $loss1;
    }
    //二定类型判断
    public function findTypes1() {
        $types = $_POST['types'];
        $type1 = $_POST['type'];
        //var_dump($_POST);exit;
        $loss = $this->userloss();
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
        $where['type'] = 5;
        $where['qishu'] = session('qishu');
        $data = M('markets')->field('loss,name')->where($where)->select();
        if (!empty($data)) {
            foreach ($data as $k1 => $v1) {
                $arrs[] = $v1['name'];
                $arr['' . $v1['name'] . ''] = $v1['loss'];
            }
        }
        //dump($arr);exit;
        if ($types == 102) {
            for ($i = 0;$i <= 9;$i++) {
                if ($type1 == 2) {
                    $html.= '<tr><td class="rdcol"></td>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array($i . $j . 'XX', $arrs)) {
                            $loss1 = $i . $j . 'XX';
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">' . $i . $j . 'XX</div><div class="rdR h">' . $arr['' . $loss1 . ''] . '</div></td>';
                        } else {
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">' . $i . $j . 'XX</div><div class="rdR h">' . $loss . '</div></td>';
                        }
                    }
                    $html.= '</tr>';
                } else {
                    $html.= '<tr>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array($i . $j . 'XX', $arrs)) {
                            $loss1 = $i . $j . 'XX';
                            $html.= '<td><div class="rdL"><span class=" h">' . $arr['' . $loss1 . ''] . '</span><br>' . $i . $j . 'XX</div><div class="rdR"><input type="text" id="ezdm' . $i . $j . 'XX" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        } else {
                            $html.= '<td><div class="rdL"><span class=" h">' . $loss . '</span><br>' . $i . $j . 'XX</div><div class="rdR"><input type="text" id="ezdm' . $i . $j . 'XX" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }
                    }
                    $html.= '</tr>';
                }
                //echo "$i*$j=".$i*$j." "; echo "<br>\n";
                
            }
        } elseif ($types == 101) {
            for ($i = 0;$i <= 9;$i++) {
                if ($type1 == 2) {
                    $html.= '<tr><td class="rdcol"></td>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array($i . 'X' . $j . 'X', $arrs)) {
                            $loss1 = $i . 'X' . $j . 'X';
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">' . $i . 'X' . $j . 'X</div><div class="rdR h">' . $arr['' . $loss1 . ''] . '</div></td>';
                        } else {
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">' . $i . 'X' . $j . 'X</div><div class="rdR h">' . $loss . '</div></td>';
                        }
                    }
                    $html.= '</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n";
                    
                } else {
                    $html.= '<tr>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array($i . 'X' . $j . 'X', $arrs)) {
                            $loss1 = $i . 'X' . $j . 'X';
                            $html.= '<td><div class="rdL"><span class=" h">' . $arr['' . $loss1 . ''] . '</span><br>' . $i . 'X' . $j . 'X</div><div class="rdR"><input type="text" id="ezdm' . $i . 'X' . $j . 'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        } else {
                            $html.= '<td><div class="rdL"><span class=" h">' . $loss . '</span><br>' . $i . 'X' . $j . 'X</div><div class="rdR"><input type="text" id="ezdm' . $i . 'X' . $j . 'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }
                    }
                    $html.= '</tr>';
                }
            }
        } elseif ($types == 100) {
            for ($i = 0;$i <= 9;$i++) {
                if ($type1 == 2) {
                    $html.= '<tr><td class="rdcol"></td>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array($i . 'XX' . $j, $arrs)) {
                            $loss1 = $i . 'XX' . $j;
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">' . $i . 'XX' . $j . '</div><div class="rdR h">' . $arr['' . $loss1 . ''] . '</div></td>';
                        } else {
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">' . $i . 'XX' . $j . '</div><div class="rdR h">' . $loss . '</div></td>';
                        }
                    }
                    $html.= '</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n";
                    
                } else {
                    $html.= '<tr>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array($i . 'XX' . $j, $arrs)) {
                            $loss1 = $i . 'XX' . $j;
                            $html.= '<td><div class="rdL"><span class=" h">' . $arr['' . $loss1 . ''] . '</span><br>' . $i . 'XX' . $j . '</div><div class="rdR"><input type="text" id="ezdm' . $i . 'XX' . $j . '" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        } else {
                            $html.= '<td><div class="rdL"><span class=" h">' . $loss . '</span><br>' . $i . 'XX' . $j . '</div><div class="rdR"><input type="text" id="ezdm' . $i . 'XX' . $j . '" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }
                    }
                    $html.= '</tr>';
                }
            }
        } elseif ($types == 99) {
            for ($i = 0;$i <= 9;$i++) {
                if ($type1 == 2) {
                    $html.= '<tr><td class="rdcol"></td>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array('X' . $i . 'X' . $j, $arrs)) {
                            $loss1 = 'X' . $i . 'X' . $j;
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X' . $i . 'X' . $j . '</div><div class="rdR h">' . $arr['' . $loss1 . ''] . '</div></td>';
                        } else {
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X' . $i . 'X' . $j . '</div><div class="rdR h">' . $loss . '</div></td>';
                        }
                    }
                    $html.= '</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n";
                    
                } else {
                    $html.= '<tr>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array('X' . $i . 'X' . $j, $arrs)) {
                            $loss1 = 'X' . $i . 'X' . $j;
                            $html.= '<td><div class="rdL"><span class=" h">' . $arr['' . $loss1 . ''] . '</span><br>X' . $i . 'X' . $j . '</div><div class="rdR"><input type="text" id="ezdmX' . $i . 'X' . $j . '" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        } else {
                            $html.= '<td><div class="rdL"><span class=" h">' . $loss . '</span><br>X' . $i . 'X' . $j . '</div><div class="rdR"><input type="text" id="ezdmX' . $i . 'X' . $j . '" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }
                    }
                    $html.= '</tr>';
                }
            }
        } elseif ($types == 98) {
            for ($i = 0;$i <= 9;$i++) {
                if ($type1 == 2) {
                    $html.= '<tr><td class="rdcol"></td>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array('X' . $i . $j . 'X', $arrs)) {
                            $loss1 = 'X' . $i . $j . 'X';
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X' . $i . $j . 'X</div><div class="rdR h">' . $arr['' . $loss1 . ''] . '</div></td>';
                        } else {
                            $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">X' . $i . $j . 'X</div><div class="rdR h">' . $loss . '</div></td>';
                        }
                    }
                    $html.= '</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n";
                    
                } else {
                    $html.= '<tr>';
                    for ($j = 0;$j <= 9;$j++) {
                        if (in_array('X' . $i . $j . 'X', $arrs)) {
                            $loss1 = 'X' . $i . $j . 'X';
                            $html.= '<td><div class="rdL"><span class=" h">' . $arr['' . $loss1 . ''] . '</span><br>X' . $i . $j . 'X</div><div class="rdR"><input type="text" id="ezdmX' . $i . $j . 'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        } else {
                            $html.= '<td><div class="rdL"><span class=" h">' . $loss . '</span><br>X' . $i . $j . 'X</div><div class="rdR"><input type="text" id="ezdmX' . $i . $j . 'X" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                        }
                    }
                    $html.= '</tr>';
                }
            }
        } elseif ($types == 97) {
            for ($i = 0;$i <= 9;$i++) {
                if ($type1 == 2) {
                    $html.= '<tr><td class="rdcol"></td>';
                    for ($j = 0;$j <= 9;$j++) {
                        $html.= '<td id="e' . $i . $j . '" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">XX' . $i . $j . '</div><div class="rdR h">' . $loss . '</div></td>';
                    }
                    $html.= '</tr>';
                    //echo "$i*$j=".$i*$j." "; echo "<br>\n";
                    
                } else {
                    $html.= '<tr>';
                    for ($j = 0;$j <= 9;$j++) {
                        $html.= '<td><div class="rdL"><span class=" h">' . $loss . '</span><br>XX' . $i . $j . '</div><div class="rdR"><input type="text" id="ezdmXX' . $i . $j . '" onkeyup="inputs(this)" maxlength="4" /></div></td>';
                    }
                    $html.= '</tr>';
                }
            }
        }
        //$arrs=array('datas'=>$html);
        echo json_encode($html);
    }
    //下注得到赔率和可下数
    public function ajax_odd() {
        $uid = session('userid');
        $where['uid'] = $uid;
        //判断用户余额
        $money = user();
        if (!floatval($money) > 0) {
            echo -999;
            exit;
        }
        //判断当前期号是否开启或者过期
        $status = mStatus1();
        if ($status[0] != 1) {
            echo -19; //管理员已关闭下注功能！
            exit();
        }
        $num = I('post.num'); //号码
        $sendqz = I('post.sendqz'); //全转
        $sizixian = I('post.sizixian');
        if (empty($num)) {
            echo -2;
            exit;
        }
        //判断并得到改号码类型
        $data = $this->haoma($num, $sizixian); //0(数字)类型1类型2号码3.2定 4定
        //dump($data);exit;
        if ($data['code'] == 400) {
            echo $data['status'];
            exit;
        }
        $qishu = session('qishu');

        if(empty($sendqz)){//全转时不判断该号码是否禁止下注
            //判断改号码是否禁止购买
            $where['qishu'] = $qishu;
            $where['p_type'] = $data[0];
            $where['name'] = $num;
            $prohibit = M('prohibit')->field('p_id')->where($where)->find();
            //var_dump($prohibit);exit;
            if (!empty($prohibit)) {
                echo -5; //该号码禁止销售
                exit;
            }
        }


        //得到这期该号码购买情况
        if (empty($sendqz)) {
            $where1['qishu'] = $qishu;
            $where1['mingxi_1'] = $data[3];
            $where1['mingxi_2'] = $data[2];
            $where1['js'] = '0';
            $bets = M('bet')->field('money')->where($where1)->sum('money');
        }
        // echo json_encode($where2);exit;
        //会员赔率和股东原始赔率
        $where2['uid'] = $uid;
        $loss = M('uloss')->where($where2)->find();
        $where4['qishu'] = $qishu;
        $datas = M('opentime')->field('m_status,fengpan,m_sales,m_loss,2ding_xiane,3ding_xiane,4ding_xiane,2xian_xiane,3xian_xiane,4xian_xiane,m_odds')->where($where4)->order('id desc')->find();
        //$datas=M('opentime')->where('qishu = "'.$qishu.'"')->find();
        if (empty($datas)) {
            echo -2;
            exit;
        }
        //得到改号码股东是否修改赔率和销售上限
        $where3['qishu'] = $qishu;
        $where3['name'] = $data[2];
        $where3['type'] = $data[0];
        $markets = M('markets')->field('markets,loss')->where($where3)->find();
        $user = M('user')->where($uid)->find();
        //会员下级赔率
        $datas['m_loss']=$user['loss'];
        $arrs = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);

        if ($arrs['code'] == 400) {
            echo -5;
            exit;
        }
        $arrs[1]=$arrs[1]-$bets;
        //返回 赔率，每码上限，单注上限，最小下注上限，会员回水,号码;
        echo json_encode($arrs);
        exit; //["49", "1", "1", "1", "0", "123"]
        
    }
    //公共方法得到改号码类型
    private function haoma($num, $sizixian) {
        $num1 = preg_replace("/X/", "", $num); //正则匹配替换
        $num_arr_x = explode('X', $num); //分割
        $status = strstr($num, 'X'); //是否包含x
        //存在x,是定1.判断长度，2.除了x还有几位数，3.规整类型
        //现,1.判断长度，2.规整类型
        //echo $num1;exit;
        if ((strlen($num) <= 4) && (strlen($num1) > 1)) {
            if (($sizixian == 1) && (empty($status))) { //现类型、不包含x
                $len = strlen($num);
                $type = '现';
                if ($len . $type == '4现') {
                    $type1 = '4现';
                    $num = $this->strings($num);
                    $types = 4;
                } elseif ($len . $type == '3现') {
                    $type1 = '3现';
                    $num = $this->strings($num);
                    $types = 3;
                } elseif ($len . $type == '2现') {
                    $type1 = '2现';
                    $num = $this->strings($num);
                    $types = 2;
                } elseif ($len . $type == '4定') {
                    $type1 = '4定';
                    $types = 1;
                }
                $type22 = $type1;
            } elseif ((empty($status)) && (strlen($num) <= 4)) { //不包含x、长度4
                if (strlen($num) < 4) {
                    $type = '现';
                } else {
                    $type = '定';
                }
                $len = strlen($num1);
                if ($len . $type == '4现') {
                    $type1 = '4现';
                    $num = $this->strings($num);
                    $types = 4;
                } elseif ($len . $type == '3现') {
                    $type1 = '3现';
                    $num = $this->strings($num);
                    $types = 3;
                } elseif ($len . $type == '2现') {
                    $type1 = '2现';
                    $num = $this->strings($num);
                    $types = 2;
                } elseif ($len . $type == '4定') {
                    $type1 = '4定';
                    $types = 1;
                }
                $type22 = $type1;
            } elseif ((!empty($status)) && (strlen($num) == 4)) { //包含x、长度4
                $type = '定';
                $len = strlen($num1);
                $haoma1 = substr($num, 0, 1);
                $haoma2 = substr($num, 1, 1);
                $haoma3 = substr($num, 2, 1);
                $haoma4 = substr($num, 3, 1);
                if ($len == 2) { //赔率类型判断--6种
                    $types = 5;
                } elseif ($len == 3) { //赔率类型判断--4种
                    $types = 6;
                }
                if ($len == 2) { //赔率类型判断--6种
                    $type11 = '2定';
                    if ($haoma1 == 'X' && $haoma2 == 'X') {
                        $type1 = 'XX口口';
                    } elseif ($haoma3 == 'X' && $haoma4 == 'X') {
                        $type1 = '口口XX';
                    } elseif ($haoma1 == 'X' && $haoma4 == 'X') {
                        $type1 = 'X口口X';
                    } elseif ($haoma2 == 'X' && $haoma3 == 'X') {
                        $type1 = '口XX口';
                    } elseif ($haoma2 == 'X' && $haoma4 == 'X') {
                        $type1 = '口X口X';
                    } elseif ($haoma1 == 'X' && $haoma3 == 'X') {
                        $type1 = 'X口X口';
                    }
                } elseif ($len == 3) { //赔率类型判断--4种
                    $type11 = '3定';
                    if ($haoma1 == 'X') {
                        $type1 = 'X口口口';
                    } elseif ($haoma2 == 'X') {
                        $type1 = '口X口口';
                    } elseif ($haoma3 == 'X') {
                        $type1 = '口口X口';
                    } elseif ($haoma4 == 'X') {
                        $type1 = '口口口X';
                    }
                }
                $type22 = $type11;
            } else {
                $arr = array('code' => 400, 'status' => '-2');
                return $arr;
                exit;
            }
        } else {
            $arr = array('code' => 400, 'status' => '-2');
            return $arr;
            exit;
        }
        if (empty($types) || empty($type1)) { //没有该号码类型
            $arr = array('code' => 400, 'status' => '-4');
            return $arr;
            exit;
        } else { //得到改号码是否禁止销售
            $qishu = session('qishu');
            $where['qishu'] = $qishu;
            $data = M('opentime')->field('m_status,fengpan,2ding_xiane,3ding_xiane,4ding_xiane,2xian_xiane,3xian_xiane,4xian_xiane')->where($where)->order('id desc')->find();
            if (empty($data) || $data['m_status'] != 1 || (time() > strtotime($data['fengpan']))) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            }
            if (($type22 == '2定') && ($data['2ding_xiane'] != 1)) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            } elseif (($type22 == '3定') && ($data['3ding_xiane'] != 1)) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            } elseif (($type22 == '4定') && ($data['4ding_xiane'] != 1)) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            } elseif (($type22 == '2现') && ($data['2xian_xiane'] != 1)) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            } elseif (($type22 == '3现') && ($data['3xian_xiane'] != 1)) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            } elseif (($type22 == '4现') && ($data['4xian_xiane'] != 1)) {
                $arr = array('code' => 400, 'status' => '-5');
                return $arr;
                exit;
            }
        }
        $type2 = $len . $type;
        $arr = array('code' => 200, $types, $type1, $num, $type2, $type); //状态1类型2类型3号码
        return $arr;
        exit;
    }
    //转换
    private function strings($str) {
        $str1 = substr($str, 0, 1);
        $str2 = substr($str, 1, 1);
        $str3 = substr($str, 2, 1);
        $str4 = substr($str, 3, 1);
        if (!empty($str1) || $str1 == '0') {
            $arr[] = $str1;
        }
        if (!empty($str2) || $str2 == '0') {
            $arr[] = $str2;
        }
        if (!empty($str3) || $str3 == '0') {
            $arr[] = $str3;
        }
        if (!empty($str4) || $str4 == '0') {
            $arr[] = $str4;
        }
        asort($arr);
        $string = implode('', $arr);
        return $string;
    }
    //公共方法得到号码的赔率
    private function haomas($datas, $types, $num, $data2, $bets, $status8, $types1, $prohibits) { //股东赔率/单注上限
        $loss = json_decode($datas['m_loss']); //赔率
        $market = json_decode($datas['m_sales']); //单注上限
        if ($types1 == 4) {
            //判断改号码是否禁止购买
            if (!empty($prohibits)) {
                if (in_array($num, $prohibits)) {
                    $arrs = array('code' => 400);
                    return $arrs;
                    exit;
                }
            }
            //得到这期该号码购买情况
            if (!empty($bets)) {
                foreach ($bets as $k4 => $v4) {
                    if ($v4['mingxi_2'] == $num) {
                        $money = $v4['moneys'];
                        break;
                    }
                }
            }
            if (($status8 == '4定') && ($datas['4ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            }
        } else {
            if ($bets) { //得到该号码的销售总数
                //foreach($bets as $k=>$v){
                $money = $bets;
                //}
                
            }
            if (($status8 == '2定') && ($datas['2ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '3定') && ($datas['3ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '4定') && ($datas['4ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '2现') && ($datas['2xian_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '3现') && ($datas['3xian_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '4现') && ($datas['4xian_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            }
            if ($types == 2 || $types == 3 || $types == 4) {
                $where3['numbers'] = $num;
                $where3['type'] = $types;
                $number = M('number')->field('types')->where($where3)->find();
            }
        }
        //return $status8;exit;
        //得到该号码类型
        // $where3['numbers']=$num;
        // $where3['type']=$types;
        // $number=M('number')->field('types')->where($where3)->find();
        if ($types == 1) {
            $loss1 = $loss->ding41;
            $xhz1 = $loss->ding42; //下滑基数
            $xhz2 = $loss->ding43; //每增加数
            $xhz3 = $loss->ding44; //下滑值
            $market1 = $market->ding41;
            $market2 = $market->ding42;
            $market3 = $market->ding43;
        } elseif ($types == 2) {
            $market1 = $market->tong21;
            $market2 = $market->tong22;
            $market3 = $market->tong23;
            if ($number['types'] == 1) {
                $loss1 = $loss->tong211;
                $xhz1 = $loss->tong212; //下滑基数
                $xhz2 = $loss->tong213; //每增加数
                $xhz3 = $loss->tong214; //下滑值
                //$market1=$market->tong22;
                
            } elseif ($number['types'] == 2) {
                $loss1 = $loss->tong221;
                $xhz1 = $loss->tong222; //下滑基数
                $xhz2 = $loss->tong223; //每增加数
                $xhz3 = $loss->tong224; //下滑值
                //$marke1t=$market->tong22;
                
            }
        } elseif ($types == 3) {
            $market1 = $market->tong31;
            $market2 = $market->tong32;
            $market3 = $market->tong33;
            if ($number['types'] == 1) {
                $loss1 = $loss->tong311;
                $xhz1 = $loss->tong312; //下滑基数
                $xhz2 = $loss->tong313; //每增加数
                $xhz3 = $loss->tong314; //下滑值
                //$market1=$market->tong32;
                
            } elseif ($number['types'] == 2) {
                $loss1 = $loss->tong321;
                $xhz1 = $loss->tong322; //下滑基数
                $xhz2 = $loss->tong323; //每增加数
                $xhz3 = $loss->tong324; //下滑值
                //$market1=$market->tong32;
                
            } elseif ($number['types'] == 3) {
                $loss1 = $loss->tong331;
                $xhz1 = $loss->tong332; //下滑基数
                $xhz2 = $loss->tong333; //每增加数
                $xhz3 = $loss->tong334; //下滑值
                //$market1=$market->tong32;
                
            }
        } elseif ($types == 4) {
            $market1 = $market->tong41;
            $market2 = $market->tong42;
            $market3 = $market->tong43;
            if ($number['types'] == 1) {
                $loss1 = $loss->tong411;
                $xhz1 = $loss->tong412; //下滑基数
                $xhz2 = $loss->tong413; //每增加数
                $xhz3 = $loss->tong414; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 2) {
                $loss1 = $loss->tong421;
                $xhz1 = $loss->tong422; //下滑基数
                $xhz2 = $loss->tong423; //每增加数
                $xhz3 = $loss->tong424; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 4) { //三数相同
                $loss1 = $loss->tong431;
                $xhz1 = $loss->tong432; //下滑基数
                $xhz2 = $loss->tong433; //每增加数
                $xhz3 = $loss->tong434; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 3) { //二数相同
                $loss1 = $loss->tong441;
                $xhz1 = $loss->tong442; //下滑基数
                $xhz2 = $loss->tong443; //每增加数
                $xhz3 = $loss->tong444; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 5) { //数一样
                $loss1 = $loss->tong451;
                $xhz1 = $loss->tong452; //下滑基数
                $xhz2 = $loss->tong453; //每增加数
                $xhz3 = $loss->tong454; //下滑值
                // $market1=$market->tong42;
                
            }
        } elseif ($types == 5) {
            $loss1 = $loss->ding21;
            $xhz1 = $loss->ding22; //下滑基数
            $xhz2 = $loss->ding23; //每增加数
            $xhz3 = $loss->ding24; //下滑值
            $market1 = $market->ding21;
            $market2 = $market->ding22;
            $market3 = $market->ding23;
        } elseif ($types == 6) {
            $loss1 = $loss->ding31;
            $xhz1 = $loss->ding32; //下滑基数
            $xhz2 = $loss->ding33; //每增加数
            $xhz3 = $loss->ding34; //下滑值
            $market1 = $market->ding31;
            $market2 = $market->ding32;
            $market3 = $market->ding33;
        }
        //股东修改赔率和单注上限
        if ($types1 == 4) {
            //得到改号码股东是否修改赔率和销售上限
            if (!empty($data2)) {
                foreach ($data2 as $k1 => $v1) {
                    if ($v1['name'] == $num) {
                        if(!empty($v1['loss'])){
                            $loss1 = $v1['loss'];
                        }
                         if(!empty($v1['markets'])){
                            $market1 = $v1['markets'];
                        }
                        //$market1 = $v1['markets'];
                        break;
                    }
                }
            }
        } else {
            if ($data2) {
                $c_loss = $data2['loss'];
                $c_markets = $data2['markets'];
                if (!empty($c_loss)) {
                    $loss1 = $c_loss;
                }
                if (!empty($c_markets)) {
                    $market1 = $c_markets;
                }
            }
        }
        //判断总数是否超过每码销售值
        if (!empty($money) && $datas['m_odds'] == 1) {
            if ($money >= $market1) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
            if ($money >= $xhz1) {
                $loss1 = $loss1 - $xhz3;
            }
            //销售数
            if ($money >= ($xhz1 + $xhz2)) { //得到该号码的下滑值
                $money1 = $money - $xhz1;
                $money2 = floor($money1 / $xhz2);
                if ($money2 >= 1) {
                    $loss1 = $loss1 - ($money2 * $xhz3);
                    if (($loss1 + $xhz3) < $xhz3) {
                        $arrs = array('code' => 400);
                        return $arrs;
                        exit;
                    }
                }
            }
            //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            if (($market1 - $money) < $market2) {
                $market2 = $market1 - $money;
            }
        } else {
            if ($money >= $market1) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
            //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            if (($market1 - $money) < $market2) {
                $market2 = $market1 - $money;
            }
        }
        $loss3 = 0;
        $arr = array($loss1, $market1, $market2, $market3, $loss3, $num); //赔率，每码上限，单注上限，会员回水,号码
        return $arr;
    }
    //用户配置赔率
    private function haomas1($datas, $loss1, $types, $num, $data2, $bets, $status8, $types1, $prohibits) {
        $loss = json_decode($loss1['loss']);
        $loss4 = json_decode($datas['m_loss']); //赔率
        $market = json_decode($datas['m_sales']); //单注上限
        if ($types1 == 4) {
            //判断改号码是否禁止购买
            if (!empty($prohibits)) {
                if (in_array($num, $prohibits)) {
                    $arrs = array('code' => 400);
                    return $arrs;
                    exit;
                }
            }
            //得到这期该号码购买情况
            if (!empty($bets)) {
                foreach ($bets as $k4 => $v4) {
                    if ($v4['mingxi_2'] == $num) {
                        $money = $v4['moneys'];
                        break;
                    }
                }
            }
            if (($status8 == '4定') && ($datas['4ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            }
        } else {
            if ($bets) { //得到该号码的销售总数
                //foreach($bets as $k=>$v){
                $money = $bets;
                //}
                
            }
            if (($status8 == '2定') && ($datas['2ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '3定') && ($datas['3ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '4定') && ($datas['4ding_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '2现') && ($datas['2xian_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '3现') && ($datas['3xian_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            } elseif (($status8 == '4现') && ($datas['4xian_xiane'] != 1)) {
                $arr = array('code' => 400);
                return $arr;
                exit;
            }
            //得到该号码类型
            // $where3['numbers']=$num;
            // $where3['type']=$types;
            // $number=M('number')->field('types')->where($where3)->find();
            if ($types == 2 || $types == 3 || $types == 4) {
                $where3['numbers'] = $num;
                $where3['type'] = $types;
                $number = M('number')->field('types')->where($where3)->find();
            }
        }
        if ($types == 1) {
            $loss3 = $loss[0]->loss4;
            $loss2 = $loss[0]->ding4;
            $market1 = $market->ding41;
            $market2 = $market->ding42;
            $market3 = $market->ding43;
            $xhz1 = $loss4->ding42; //下滑基数
            $xhz2 = $loss4->ding43; //每增加数
            $xhz3 = $loss4->ding44; //下滑值
            /////////四定
            $pl3 = $loss4->ding41; //股东赔率
            if ($pl3 > 3000) {
                $pl13 = $loss4->ding41 - 2500;
                $sums3 = ($pl3) - ($pl13);
                for ($i3 = 0;$i3 <= $sums3;$i3++) {
                    if ($i3 < 10) {
                        $g3 = '0.00' . $i3;
                    } elseif ($i3 >= 10 && $i3 <= 99) {
                        $g3 = '0.0' . $i3;
                    } else {
                        $g3 = '0.' . $i3;
                    }
                    if ($g3 == '0.000') {
                        $g3 = 0;
                    }
                    $f3[] = $g3;
                }
                $a41 = 250;
                for ($a41a = 0;$a41a < $a41;$a41a++) {
                    $c3 = $pl3 - ($a41a . '0');
                    if ($c3 < 1) {
                        $c3 = 0;
                    }
                    $d3[] = $c3;
                }
                $d3[] = $pl13;
                for ($h3 = 0;$h3 < count($d3);$h3++) {
                    if ($loss3 == $f3[$h3]) {
                        $loss2 = $d3[$h3];
                    }
                }
            }
        } elseif ($types == 2) {
            // //得到该号码类型
            $market1 = $market->tong21;
            $market2 = $market->tong22;
            $market3 = $market->tong23;
            if ($number['types'] == 1) {
                $loss3 = $loss[1]->loss21;
                $loss2 = $loss[1]->tong21;
                $xhz1 = $loss4->tong212; //下滑基数
                $xhz2 = $loss4->tong213; //每增加数
                $xhz3 = $loss4->tong214; //下滑值
                // $market2=$market->tong22;
                $pl6 = $loss4->tong211;
                if ($pl6 > 3) {
                    for ($i6 = 0;$i6 <= 250;$i6++) {
                        if ($i6 < 10) {
                            $g6 = '0.00' . $i6;
                        } elseif ($i6 >= 10 && $i6 <= 99) {
                            $g6 = '0.0' . $i6;
                        } else {
                            $g6 = '0.' . $i6;
                        }
                        if ($g6 == '0.000') {
                            $g6 = 0;
                        }
                        $f6[] = $g6;
                    }
                    for ($a6 = 0;$a6 < count($f6);$a6++) {
                        $arr = '0.' . $a6;
                        $arr6 = explode(".", $arr);
                        if ($a6 > 9 && $a6 <= 99) {
                            //echo $arr[3];
                            $c6 = $pl6 - ('0.' . $arr6[1]);
                        } elseif ($a6 > 99 && $a6 <= 199) {
                            $c6 = $pl6 - ('1.' . substr($arr6[1], -2));
                        } elseif ($a6 > 199) {
                            $c6 = $pl6 - ('2.' . substr($arr6[1], -2));
                        } else {
                            $c6 = $pl6 - ('0.0' . $a6);
                        }
                        if ($c6 < 1) {
                            $c6 = 0;
                        }
                        $d6[] = $c6;
                    }
                    for ($h6 = 0;$h6 < count($d6);$h6++) {
                        if ($loss3 == $f6[$h6]) {
                            $loss2 = $d6[$h6];
                        }
                    }
                }
            } elseif ($number['types'] == 2) {
                $loss3 = $loss[1]->loss22;
                $loss2 = $loss[1]->tong22;
                $xhz1 = $loss4->tong222; //下滑基数
                $xhz2 = $loss4->tong223; //每增加数
                $xhz3 = $loss4->tong224; //下滑值
                //$market2=$market->tong22;
                $pl7 = $loss4->tong221;
                for ($i7 = 0;$i7 <= 250;$i7++) {
                    if ($i7 < 10) {
                        $g7 = '0.00' . $i7;
                    } elseif ($i7 >= 10 && $i7 <= 99) {
                        $g7 = '0.0' . $i7;
                    } else {
                        $g7 = '0.' . $i7;
                    }
                    if ($g7 == '0.000') {
                        $g7 = 0;
                    }
                    $f7[] = $g7;
                }
                for ($a7 = 0;$a7 < count($f7);$a7++) {
                    $arr = '0.' . $a7;
                    $arr7 = explode(".", $arr);
                    if ($a7 > 9 && $a7 <= 99) {
                        //echo $arr[3];
                        $c7 = $pl7 - (('0.' . $arr7[1]) * 2);
                    } elseif ($a7 > 99 && $a7 <= 199) {
                        $c7 = $pl7 - (('1.' . substr($arr7[1], -2)) * 2);
                    } elseif ($a7 > 199) {
                        $c7 = $pl7 - (('2.' . substr($arr7[1], -2)) * 2);
                    } else {
                        $c7 = $pl7 - (('0.0' . $a7) * 2);
                    }
                    if ($c7 < 1) {
                        $c7 = 0;
                    }
                    $d7[] = $c7;
                }
                for ($h7 = 0;$h7 < count($d7);$h7++) {
                    if ($loss3 == $f7[$h7]) {
                        $loss2 = $d7[$h7];
                    }
                }
            }
        } elseif ($types == 3) {
            $market1 = $market->tong31;
            $market2 = $market->tong32;
            $market3 = $market->tong33;
            if ($number['types'] == 1) {
                $loss3 = $loss[2]->loss31;
                $loss2 = $loss[2]->tong31;
                $xhz1 = $loss4->tong312; //下滑基数
                $xhz2 = $loss4->tong313; //每增加数
                $xhz3 = $loss4->tong314; //下滑值
                //$market2=$market->tong32;
                $pl4 = $loss4->tong311;
                $pl14 = $loss4->tong311 - 2.5;
                // $pl14=35;
                $sums4 = ($pl4 . '0') - ($pl14 . '0');
                for ($i4 = 0;$i4 <= 250;$i4++) {
                    if ($i4 < 10) {
                        $g4 = '0.00' . $i4;
                    } elseif ($i4 >= 10 && $i4 <= 99) {
                        $g4 = '0.0' . $i4;
                    } else {
                        $g4 = '0.' . $i4;
                    }
                    if ($g4 == '0.000') {
                        $g4 = 0;
                    }
                    $f4[] = $g4;
                }
                // for($a4=0;$a4<count($f4);$a4++){
                //     $arr='0.'.$a4;
                //     $arr1=explode(".",$arr);
                //   if($a4>9 && $a4<99){
                //       //echo $arr[3];
                //       $c4= $pl4-(('0.'.$arr1[1])*5);
                //   }elseif($a4>99 && $a4<199){
                //     $c4= $pl4-(('1.'.substr($arr1[1],-2))*5);
                //   }elseif($a4>199){
                //     $c4= $pl4-(('2.'.substr($arr1[1],-2))*5);
                //   }else{
                //     $c4= $pl4-(('0.0'.$a4)*5);
                //   }
                //     $d4[]=$c4;
                // }
                for ($a4 = 0;$a4 < count($f4);$a4++) {
                    $ar4 = '0.' . $a4;
                    $arr1 = explode(".", $ar4);
                    if ($a4 > 9 && $a4 < 99) {
                        //echo $arr[3];
                        $c4 = $pl4 - (('0.' . $arr1[1]) * 5);
                    } elseif ($a4 > 99 && $a4 < 199) {
                        $c4 = $pl4 - (('1.' . substr($arr1[1], -2)) * 5);
                    } elseif ($a4 > 199) {
                        $c4 = $pl4 - (('2.' . substr($arr1[1], -2)) * 5);
                    } else {
                        $c4 = $pl4 - (('0.0' . $a4) * 5);
                    }
                    $d4[] = $c4;
                }
                for ($h4 = 0;$h4 < count($d4);$h4++) {
                    if ($loss3 == $f4[$h4]) {
                        $loss2 = $d4[$h4];
                    }
                }
            } elseif ($number['types'] == 2) {
                $loss3 = $loss[2]->loss32;
                $loss2 = $loss[2]->tong32;
                $xhz1 = $loss4->tong322; //下滑基数
                $xhz2 = $loss4->tong323; //每增加数
                $xhz3 = $loss4->tong324; //下滑值
                //$market2=$market->tong32;
                $pl8 = $loss4->tong321;
                $pl18 = $loss4->tong321 - 2.5;
                $sums8 = ($pl8 . '0') - ($pl18 . '0');
                for ($i8 = 0;$i8 <= 250;$i8++) {
                    if ($i8 < 10) {
                        $g8 = '0.00' . $i8;
                    } elseif ($i8 >= 10 && $i8 <= 99) {
                        $g8 = '0.0' . $i8;
                    } else {
                        $g8 = '0.' . $i8;
                    }
                    if ($g8 == '0.000') {
                        $g8 = 0;
                    }
                    $f8[] = $g8;
                }
                // for($a8=0;$a8<count($f8);$a8++){
                //     $arr8=$a8;
                //     if($a8<=9){
                //         $c8=$pl8-('0.'.substr($arr8,-1,1));
                //     }elseif($a8>9 && $a8<=99){
                //         $c8=$pl8-(substr($arr8,-2,1).'.'.substr($arr8,-1,1));
                //     }else{
                //         $c8=$pl8-(substr($arr8,-3,2).'.'.substr($arr8,-1,1));
                //     }
                //     if($c8<1){
                //      $c8=0;
                //     }
                //     $d8[]=$c8;
                // }
                for ($a8 = 0;$a8 < count($f8);$a8++) {
                    $ar8 = '0.' . $a8;
                    $arr1 = explode(".", $ar8);
                    if ($a8 > 9 && $a8 < 99) {
                        //echo $arr[3];
                        $c8 = $pl8 - (('0.' . $arr1[1]) * 8);
                    } elseif ($a8 > 99 && $a8 < 199) {
                        $c8 = $pl8 - (('1.' . substr($arr1[1], -2)) * 8);
                    } elseif ($a8 > 199) {
                        $c8 = $pl8 - (('2.' . substr($arr1[1], -2)) * 8);
                    } else {
                        $c8 = $pl8 - (('0.0' . $a8) * 8);
                    }
                    $d8[] = $c8;
                }
                for ($h8 = 0;$h8 < count($d8);$h8++) {
                    if ($loss3 == $f8[$h8]) {
                        $loss2 = $d8[$h8];
                    }
                }
            } elseif ($number['types'] == 3) {
                $loss3 = $loss[2]->loss33;
                $loss2 = $loss[2]->tong33;
                $xhz1 = $loss4->tong332; //下滑基数
                $xhz2 = $loss4->tong333; //每增加数
                $xhz3 = $loss4->tong334; //下滑值
                //$market2=$market->tong32;
                $pl9 = $loss4->tong331;
                $pl19 = 35;
                $sums9 = ($pl9 . '0') - ($pl19 . '0');
                for ($i9 = 0;$i9 <= 250;$i9++) {
                    if ($i9 < 10) {
                        $g9 = '0.00' . $i9;
                    } elseif ($i9 >= 10 && $i9 <= 99) {
                        $g9 = '0.0' . $i9;
                    } else {
                        $g9 = '0.' . $i9;
                    }
                    if ($g9 == '0.000') {
                        $g9 = 0;
                    }
                    $f9[] = $g9;
                }
                for ($a9 = 0;$a9 < count($f9);$a9++) {
                    //   $ar9='0.'.$a9;
                    //   $arr1=explode(".",$ar9);
                    // if($a9>9 && $a9<99){
                    //     //echo $arr[3];
                    //     $c9= $pl9-(('0.'.$arr1[1])*5);
                    // }elseif($a9>99 && $a9<199){
                    //   $c9= $pl9-(('1.'.substr($arr1[1],-2))*5);
                    // }elseif($a9>199){
                    //   $c9= $pl9-(('2.'.substr($arr1[1],-2))*5);
                    // }else{
                    //   $c9= $pl9-(('0.0'.$a9)*5);
                    // }
                    //   $d9[]=$c9;
                    $arr9 = $a9 * 1;
                    if ($a9 <= 9) {
                        $c9 = $pl9 - ('0.' . substr($arr9, -1, 1));
                    } elseif ($a9 > 9 && $a9 <= 99) {
                        $c9 = $pl9 - (substr($arr9, -2, 1) . '.' . substr($arr9, -1, 1));
                    } else {
                        $c9 = $pl9 - (substr($arr9, -3, 2) . '.' . substr($arr9, -1, 1));
                    }
                    if ($c9 < 1) {
                        $c9 = 0;
                    }
                    $d9[] = $c9;
                }
                for ($h9 = 0;$h9 < count($d9);$h9++) {
                    if ($loss3 == $f9[$h9]) {
                        $loss2 = $d9[$h9];
                    }
                }
            }
        } elseif ($types == 4) {
            $market1 = $market->tong41;
            $market2 = $market->tong42;
            $market3 = $market->tong43;
            if ($number['types'] == 1) {
                $loss3 = $loss[3]->loss41;
                $loss2 = $loss[3]->tong41;
                $xhz1 = $loss4->tong412; //下滑基数
                $xhz2 = $loss4->tong413; //每增加数
                $xhz3 = $loss4->tong414; //下滑值
                //$market2=$market->tong42;
                $pl5 = $loss4->tong411;
                for ($i5 = 0;$i5 <= 250;$i5++) {
                    if ($i5 < 10) {
                        $g5 = '0.00' . $i5;
                    } elseif ($i5 >= 10 && $i5 <= 99) {
                        $g5 = '0.0' . $i5;
                    } else {
                        $g5 = '0.' . $i5;
                    }
                    if ($g5 == '0.000') {
                        $g5 = 0;
                    }
                    $f5[] = $g5;
                }
                for ($a5 = 0;$a5 < count($f5);$a5++) {
                    $ar5 = '0.' . $a5;
                    $arr5 = explode(".", $ar5);
                    if ($a5 < 10) {
                        $as5 = 0;
                        $c5 = $pl5 - (('0.' . $arr5[1]) * 4);
                    } elseif ($a5 >= 10 && $a5 <= 19) {
                        $c5 = $pl5 - (('1.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 20 && $a5 <= 29) {
                        $c5 = $pl5 - (('2.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 30 && $a5 <= 39) {
                        $c5 = $pl5 - (('3.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 40 && $a5 <= 49) {
                        $c5 = $pl5 - (('4.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 50 && $a5 <= 59) {
                        $c5 = $pl5 - (('5.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 60 && $a5 <= 69) {
                        $c5 = $pl5 - (('6.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 70 && $a5 <= 79) {
                        $c5 = $pl5 - (('7.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 80 && $a5 <= 89) {
                        $c5 = $pl5 - (('8.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 90 && $a5 <= 99) {
                        $c5 = $pl5 - (('9.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 100 && $a5 <= 109) {
                        $c5 = $pl5 - (('10.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 110 && $a5 <= 119) {
                        $c5 = $pl5 - (('11.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 120 && $a5 <= 129) {
                        $c5 = $pl5 - (('12.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 130 && $a5 <= 139) {
                        $c5 = $pl5 - (('13.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 140 && $a5 <= 149) {
                        $c5 = $pl5 - (('14.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 150 && $a5 <= 159) {
                        $c5 = $pl5 - (('15.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 160 && $a5 <= 169) {
                        $c5 = $pl5 - (('16.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 170 && $a5 <= 179) {
                        $c5 = $pl5 - (('17.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 180 && $a5 <= 189) {
                        $c5 = $pl5 - (('18.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 190 && $a5 <= 199) {
                        $c5 = $pl5 - (('19.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 200 && $a5 <= 209) {
                        $c5 = $pl5 - (('20.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 210 && $a5 <= 219) {
                        $c5 = $pl5 - (('21.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 220 && $a5 <= 229) {
                        $c5 = $pl5 - (('22.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 230 && $a5 <= 239) {
                        $c5 = $pl5 - (('23.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 240 && $a5 <= 249) {
                        $c5 = $pl5 - (('24.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 250 && $a5 <= 259) {
                        $c5 = $pl5 - (('25.' . substr($arr5[1], -1)) * 4);
                    }
                    $d5[] = $c5;
                }
                for ($h5 = 0;$h5 < count($d5);$h5++) {
                    if ($loss3 == $f5[$h5]) {
                        $loss2 = $d5[$h5];
                    }
                }
            } elseif ($number['types'] == 2) {
                $loss3 = $loss[3]->loss42;
                $loss2 = $loss[3]->tong42;
                $xhz1 = $loss4->tong422; //下滑基数
                $xhz2 = $loss4->tong423; //每增加数
                $xhz3 = $loss4->tong424; //下滑值
                //$market2=$market->tong42;
                $pl10 = $loss4->tong421;
                for ($i10 = 0;$i10 <= 250;$i10++) {
                    if ($i10 < 10) {
                        $g10 = '0.00' . $i10;
                    } elseif ($i10 >= 10 && $i10 <= 99) {
                        $g10 = '0.0' . $i10;
                    } else {
                        $g10 = '0.' . $i10;
                    }
                    if ($g10 == '0.000') {
                        $g10 = 0;
                    }
                    $f10[] = $g10;
                }
                // for($a10=0;$a10<count($f10);$a10++){
                //     $arr10=$a10*4;
                //     if($a10<=9){
                //         $c10=$pl10-('0.'.substr($arr10,-1,1));
                //     }elseif($a10>9 && $a10<=99){
                //         $c10=$pl10-(substr($arr10,-2,1).'.'.substr($arr10,-1,1));
                //     }else{
                //         $c10=$pl10-(substr($arr10,-3,2).'.'.substr($arr10,-1,1));
                //     }
                //     if($c10<1){
                //      $c10=0;
                //     }
                //     $d10[]=$c10;
                // }
                for ($a10 = 0;$a10 < count($f10);$a10++) {
                    $ar5 = '0.' . $a10;
                    $arr10 = explode(".", $ar5);
                    if ($a10 < 10) {
                        $as5 = 0;
                        $c10 = $pl10 - (('0.' . $arr10[1]) * 2);
                    } elseif ($a10 >= 10 && $a10 <= 19) {
                        $c10 = $pl10 - (('1.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 20 && $a10 <= 29) {
                        $c10 = $pl10 - (('2.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 30 && $a10 <= 39) {
                        $c10 = $pl10 - (('3.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 40 && $a10 <= 49) {
                        $c10 = $pl10 - (('4.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 50 && $a10 <= 59) {
                        $c10 = $pl10 - (('5.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 60 && $a10 <= 69) {
                        $c10 = $pl10 - (('6.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 70 && $a10 <= 79) {
                        $c10 = $pl10 - (('7.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 80 && $a10 <= 89) {
                        $c10 = $pl10 - (('8.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 90 && $a10 <= 99) {
                        $c10 = $pl10 - (('9.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 100 && $a10 <= 109) {
                        $c10 = $pl10 - (('10.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 110 && $a10 <= 119) {
                        $c10 = $pl10 - (('11.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 120 && $a10 <= 129) {
                        $c10 = $pl10 - (('12.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 130 && $a10 <= 139) {
                        $c10 = $pl10 - (('13.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 140 && $a10 <= 149) {
                        $c10 = $pl10 - (('14.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 150 && $a10 <= 159) {
                        $c10 = $pl10 - (('15.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 160 && $a10 <= 169) {
                        $c10 = $pl10 - (('16.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 170 && $a10 <= 179) {
                        $c10 = $pl10 - (('17.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 180 && $a10 <= 189) {
                        $c10 = $pl10 - (('18.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 190 && $a10 <= 199) {
                        $c10 = $pl10 - (('19.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 200 && $a10 <= 209) {
                        $c10 = $pl10 - (('20.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 210 && $a10 <= 219) {
                        $c10 = $pl10 - (('21.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 220 && $a10 <= 229) {
                        $c10 = $pl10 - (('22.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 230 && $a10 <= 239) {
                        $c10 = $pl10 - (('23.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 240 && $a10 <= 249) {
                        $c10 = $pl10 - (('24.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 250 && $a10 <= 259) {
                        $c10 = $pl10 - (('25.' . substr($arr10[1], -1)) * 2);
                    }
                    $d10[] = $c10;
                }
                for ($h10 = 0;$h10 < count($d10);$h10++) {
                    if ($loss3 == $f10[$h10]) {
                        $loss2 = $d10[$h10];
                    }
                }
            } elseif ($number['types'] == 4) {
                $loss3 = $loss[3]->loss43;
                $loss2 = $loss[3]->tong43;
                $xhz1 = $loss4->tong432; //下滑基数
                $xhz2 = $loss4->tong433; //每增加数
                $xhz3 = $loss4->tong434; //下滑值
                //$market2=$market->tong42;
                $pl11 = $loss4->tong431;
                for ($i11 = 0;$i11 <= 250;$i11++) {
                    if ($i11 < 11) {
                        $g11 = '0.00' . $i11;
                    } elseif ($i11 >= 11 && $i11 <= 99) {
                        $g11 = '0.0' . $i11;
                    } else {
                        $g11 = '0.' . $i11;
                    }
                    if ($g11 == '0.000') {
                        $g11 = 0;
                    }
                    $f11[] = $g11;
                }
                for ($a11 = 0;$a11 < count($f11);$a11++) {
                    $ar11 = '0.' . $a11;
                    $arr11 = explode(".", $ar11);
                    if ($a11 < 10) {
                        $c11 = $pl11 - (('0.' . $arr11[1]) * 4);
                    } elseif ($a11 >= 10 && $a11 <= 19) {
                        $c11 = $pl11 - (('1.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 20 && $a11 <= 29) {
                        $c11 = $pl11 - (('2.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 30 && $a11 <= 39) {
                        $c11 = $pl11 - (('3.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 40 && $a11 <= 49) {
                        $c11 = $pl11 - (('4.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 50 && $a11 <= 59) {
                        $c11 = $pl11 - (('5.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 60 && $a11 <= 69) {
                        $c11 = $pl11 - (('6.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 70 && $a11 <= 79) {
                        $c11 = $pl11 - (('7.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 80 && $a11 <= 89) {
                        $c11 = $pl11 - (('8.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 90 && $a11 <= 99) {
                        $c11 = $pl11 - (('9.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 100 && $a11 <= 109) {
                        $c11 = $pl11 - (('10.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 110 && $a11 <= 119) {
                        $c11 = $pl11 - (('11.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 120 && $a11 <= 129) {
                        $c11 = $pl11 - (('12.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 130 && $a11 <= 139) {
                        $c11 = $pl11 - (('13.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 140 && $a11 <= 149) {
                        $c11 = $pl11 - (('14.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 150 && $a11 <= 159) {
                        $c11 = $pl11 - (('15.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 160 && $a11 <= 169) {
                        $c11 = $pl11 - (('16.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 170 && $a11 <= 179) {
                        $c11 = $pl11 - (('17.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 180 && $a11 <= 189) {
                        $c11 = $pl11 - (('18.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 190 && $a11 <= 199) {
                        $c11 = $pl11 - (('19.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 200 && $a11 <= 209) {
                        $c11 = $pl11 - (('20.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 210 && $a11 <= 219) {
                        $c11 = $pl11 - (('21.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 220 && $a11 <= 229) {
                        $c11 = $pl11 - (('22.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 230 && $a11 <= 239) {
                        $c11 = $pl11 - (('23.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 240 && $a11 <= 249) {
                        $c11 = $pl11 - (('24.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 250 && $a11 <= 259) {
                        $c11 = $pl11 - (('25.' . substr($arr11[1], -1)) * 4);
                    }
                    $d11[] = $c11;
                }
                for ($h11 = 0;$h11 < count($d11);$h11++) {
                    if ($loss3 == $f11[$h11]) {
                        $loss2 = $d11[$h11];
                    }
                }
            } elseif ($number['types'] == 3) {
                $loss3 = $loss[3]->loss44;
                $loss2 = $loss[3]->tong44;
                $xhz1 = $loss4->tong442; //下滑基数
                $xhz2 = $loss4->tong443; //每增加数
                $xhz3 = $loss4->tong444; //下滑值
                //$market2=$market->tong42;
                $pl12 = $loss4->tong441;
                for ($i12 = 0;$i12 <= 250;$i12++) {
                    if ($i12 < 12) {
                        $g12 = '0.00' . $i12;
                    } elseif ($i12 >= 12 && $i12 <= 99) {
                        $g12 = '0.0' . $i12;
                    } else {
                        $g12 = '0.' . $i12;
                    }
                    if ($g12 == '0.000') {
                        $g12 = 0;
                    }
                    $f12[] = $g12;
                }
                for ($a12 = 0;$a12 < count($f12);$a12++) {
                    $ar12 = '0.' . $a12;
                    $arr12 = explode(".", $ar12);
                    if ($a12 < 10) {
                        $c12 = $pl12 - (('0.' . $arr12[1]) * 4);
                    } elseif ($a12 >= 10 && $a12 <= 19) {
                        $c12 = $pl12 - (('1.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 20 && $a12 <= 29) {
                        $c12 = $pl12 - (('2.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 30 && $a12 <= 39) {
                        $c12 = $pl12 - (('3.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 40 && $a12 <= 49) {
                        $c12 = $pl12 - (('4.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 50 && $a12 <= 59) {
                        $c12 = $pl12 - (('5.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 60 && $a12 <= 69) {
                        $c12 = $pl12 - (('6.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 70 && $a12 <= 79) {
                        $c12 = $pl12 - (('7.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 80 && $a12 <= 89) {
                        $c12 = $pl12 - (('8.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 90 && $a12 <= 99) {
                        $c12 = $pl12 - (('9.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 100 && $a12 <= 109) {
                        $c12 = $pl12 - (('10.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 110 && $a12 <= 119) {
                        $c12 = $pl12 - (('11.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 120 && $a12 <= 129) {
                        $c12 = $pl12 - (('12.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 130 && $a12 <= 139) {
                        $c12 = $pl12 - (('13.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 140 && $a12 <= 149) {
                        $c12 = $pl12 - (('14.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 150 && $a12 <= 159) {
                        $c12 = $pl12 - (('15.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 160 && $a12 <= 169) {
                        $c12 = $pl12 - (('16.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 170 && $a12 <= 179) {
                        $c12 = $pl12 - (('17.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 180 && $a12 <= 189) {
                        $c12 = $pl12 - (('18.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 190 && $a12 <= 199) {
                        $c12 = $pl12 - (('19.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 200 && $a12 <= 209) {
                        $c12 = $pl12 - (('20.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 210 && $a12 <= 219) {
                        $c12 = $pl12 - (('21.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 220 && $a12 <= 229) {
                        $c12 = $pl12 - (('22.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 230 && $a12 <= 239) {
                        $c12 = $pl12 - (('23.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 240 && $a12 <= 249) {
                        $c12 = $pl12 - (('24.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 250 && $a12 <= 259) {
                        $c12 = $pl12 - (('25.' . substr($arr12[1], -1)) * 4);
                    }
                    $d12[] = $c12;
                }
                for ($h12 = 0;$h12 < count($d12);$h12++) {
                    if ($loss3 == $f12[$h12]) {
                        $loss2 = $d12[$h12];
                    }
                }
            } elseif ($number['types'] == 5) {
                $loss3 = $loss[3]->loss45;
                $loss2 = $loss[3]->tong45;
                $xhz1 = $loss4->tong452; //下滑基数
                $xhz2 = $loss4->tong453; //每增加数
                $xhz3 = $loss4->tong454; //下滑值
                //$market2=$market->tong42;
                $pl13 = $loss4->tong451;
                for ($i13 = 0;$i13 <= 250;$i13++) {
                    if ($i13 < 12) {
                        $g13 = '0.00' . $i13;
                    } elseif ($i13 >= 12 && $i13 <= 99) {
                        $g13 = '0.0' . $i13;
                    } else {
                        $g13 = '0.' . $i13;
                    }
                    if ($g13 == '0.000') {
                        $g13 = 0;
                    }
                    $f13[] = $g13;
                }
                // for($a13=0;$a13<count($f13);$a13++){
                //     $arr13=$a13*4;
                //     if($a13<=9){
                //         $c13=$pl13-('0.'.substr($arr13,-1,1));
                //     }elseif($a13>9 && $a13<=99){
                //         $c13=$pl13-(substr($arr13,-2,1).'.'.substr($arr13,-1,1));
                //     }else{
                //         $c13=$pl13-(substr($arr13,-3,2).'.'.substr($arr13,-1,1));
                //     }
                //     if($c13<1){
                //      $c13=0;
                //     }
                //     $d13[]=$c13;
                // }
                for ($a13 = 0;$a13 < count($f13);$a13++) {
                    $ar13 = '0.' . $a13;
                    $arr13 = explode(".", $ar13);
                    if ($a13 < 10) {
                        $c13 = $pl13 - (('0.' . $arr13[1]) * 4);
                    } elseif ($a13 >= 10 && $a13 <= 19) {
                        $c13 = $pl13 - (('1.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 20 && $a13 <= 29) {
                        $c13 = $pl13 - (('2.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 30 && $a13 <= 39) {
                        $c13 = $pl13 - (('3.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 40 && $a13 <= 49) {
                        $c13 = $pl13 - (('4.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 50 && $a13 <= 59) {
                        $c13 = $pl13 - (('5.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 60 && $a13 <= 69) {
                        $c13 = $pl13 - (('6.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 70 && $a13 <= 79) {
                        $c13 = $pl13 - (('7.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 80 && $a13 <= 89) {
                        $c13 = $pl13 - (('8.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 90 && $a13 <= 99) {
                        $c13 = $pl13 - (('9.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 100 && $a13 <= 109) {
                        $c13 = $pl13 - (('10.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 110 && $a13 <= 119) {
                        $c13 = $pl13 - (('11.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 120 && $a13 <= 129) {
                        $c13 = $pl13 - (('12.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 130 && $a13 <= 139) {
                        $c13 = $pl13 - (('13.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 140 && $a13 <= 149) {
                        $c13 = $pl13 - (('14.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 150 && $a13 <= 159) {
                        $c13 = $pl13 - (('15.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 160 && $a13 <= 169) {
                        $c13 = $pl13 - (('16.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 170 && $a13 <= 179) {
                        $c13 = $pl13 - (('17.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 180 && $a13 <= 189) {
                        $c13 = $pl13 - (('18.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 190 && $a13 <= 199) {
                        $c13 = $pl13 - (('19.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 200 && $a13 <= 209) {
                        $c13 = $pl13 - (('20.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 210 && $a13 <= 219) {
                        $c13 = $pl13 - (('21.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 220 && $a13 <= 229) {
                        $c13 = $pl13 - (('22.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 230 && $a13 <= 239) {
                        $c13 = $pl13 - (('23.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 240 && $a13 <= 249) {
                        $c13 = $pl13 - (('24.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 250 && $a13 <= 259) {
                        $c13 = $pl13 - (('25.' . substr($arr13[1], -1)) * 4);
                    }
                    $d13[] = $c13;
                }
                for ($h13 = 0;$h13 < count($d13);$h13++) {
                    if ($loss3 == $f13[$h13]) {
                        $loss2 = $d13[$h13];
                    }
                }
            }
        } elseif ($types == 5) {
            $loss2 = $loss[4]->ding2;
            $loss3 = $loss[4]->loss2;
            $market1 = $market->ding21;
            $market2 = $market->ding22;
            $market3 = $market->ding23;
            $xhz1 = $loss4->ding22; //下滑基数
            $xhz2 = $loss4->ding23; //每增加数
            $xhz3 = $loss4->ding24; //下滑值
            $pl = $loss4->ding21;
            for ($i = 0;$i <= 250;$i++) {
                if ($i < 10) {
                    $g = '0.00' . $i;
                } elseif ($i >= 10 && $i <= 99) {
                    $g = '0.0' . $i;
                } else {
                    $g = '0.' . $i;
                }
                if ($g == '0.000') {
                    $g = 0;
                }
                $f[] = $g;
            }
            for ($a14 = 0;$a14 < count($f);$a14++) {
                $arr14 = $a14;
                if ($a14 <= 9) {
                    $c14 = $pl - ('0.' . substr($arr14, -1, 1));
                } elseif ($a14 > 9 && $a14 <= 99) {
                    $c14 = $pl - (substr($arr14, -2, 1) . '.' . substr($arr14, -1, 1));
                } else {
                    $c14 = $pl - (substr($arr14, -3, 2) . '.' . substr($arr14, -1, 1));
                }
                if ($c14 < 1) {
                    $c14 = 0;
                }
                $d14[] = $c14;
            }
            for ($h = 0;$h < count($d14);$h++) {
                if ($loss3 == $f[$h]) {
                    $loss2 = $d14[$h];
                }
            }
        } elseif ($types == 6) {
            $loss2 = $loss[5]->ding3;
            $loss3 = $loss[5]->loss3;
            $market1 = $market->ding31;
            $market2 = $market->ding32;
            $market3 = $market->ding33;
            $xhz1 = $loss4->ding32; //下滑基数
            $xhz2 = $loss4->ding33; //每增加数
            $xhz3 = $loss4->ding34; //下滑值
            $pl2 = $loss4->ding31;
            for ($i2 = 0;$i2 <= 250;$i2++) {
                if ($i2 < 10) {
                    $g2 = '0.00' . $i2;
                } elseif ($i2 >= 10 && $i2 <= 99) {
                    $g2 = '0.0' . $i2;
                } else {
                    $g2 = '0.' . $i2;
                }
                if ($g2 == '0.000') {
                    $g2 = 0;
                }
                $f2[] = $g2;
            }
            for ($a2 = 0;$a2 < count($f2);$a2++) {
                $arr = '0.' . $a2;
                $arr2 = explode(".", $arr);
                if ($a2 > 9 && $a2 < 99) {
                    $c2 = $pl2 - (($arr2[1]) * 1);
                } elseif ($a2 > 99 && $a2 < 199) {
                    $c2 = $pl2 - (('1' . substr($arr2[1], -2)) * 1);
                } elseif ($a2 > 199) {
                    $c2 = $pl2 - (('2' . substr($arr2[1], -2)) * 1);
                } else {
                    $c2 = $pl2 - ($a2 * 1);
                }
                if ($c2 < 1) {
                    $c2 = 0;
                }
                $d2[] = $c2;
            }
            for ($h2 = 0;$h2 < count($d2);$h2++) {
                if ($loss3 == $f2[$h2]) {
                    $loss2 = $d2[$h2];
                }
            }
        }
        if ($types1 == 4) {
            //得到改号码股东是否修改赔率和销售上限
            if (!empty($data2)) {
                foreach ($data2 as $k1 => $v1) {
                    if ($v1['name'] == $num) {
                        // $loss2 = $v1['loss'];
                        // $market1 = $v1['markets'];
                        if (!empty($v1['loss'])) {
                                $loss2 = $v1['loss'];
                            }
                            if (!empty($v1['markets'])) {
                                $market1 = $v1['markets'];
                            }
                        break;
                    }
                }
            }
        } else {
            if ($data2) {
                $c_loss = $data2['loss'];
                $c_markets = $data2['markets'];
                if (!empty($c_loss)) {
                    $loss2 = $c_loss;
                }
                if (!empty($c_markets)) {
                    $market1 = $c_markets;
                }
            }
        }
        //判断总数是否超过每码销售值
        //echo $money.'==>'.$datas['m_odds'];exit;
        //if(!empty($money) && ($datas['m_odds']==1)){
        if (!empty($money) && $datas['m_odds'] == 1) {
            if ($money >= $market1) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
            if ($money >= $xhz1) {
                $loss2 = $loss2 - $xhz3;
            }
            //销售数
            if ($money >= ($xhz1 + $xhz2)) { //得到该号码的下滑值
                $money1 = $money - $xhz1;
                $money2 = floor($money1 / $xhz2);
                if ($money2 >= 1) {
                    $loss2 = $loss2 - ($money2 * $xhz3);
                    if (($loss2 + $xhz3) < $xhz3) {
                        $arrs = array('code' => 400);
                        return $arrs;
                        exit;
                    }
                }
            }
            //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            if (($market1 - $money) < $market2) {
                $market2 = $market1 - $money;
            }
        } else {
            if ($money >= $market1) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
            //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            if (($market1 - $money) < $market2) {
                $market2 = $market1 - $money;
            }
        }
        //$arr=array($money,$market1);
        $arr = array($loss2, $market1, $market2, $market3, $loss3, $num); //赔率，每码上限，单注上限，会员回水,号码
        return $arr;
    }
    //检查号码规则
    private function findOrder1() {
        if (!empty($_POST['action']) && $_POST['action'] == 'findOrder1') {
            $uid = session('userid');
            $where['uid'] = $uid;
            //判断账号余额
            $yue = M('user')->field('money')->where($where)->find();
            if (!floatval($yue['money']) > 0) {
                echo -999;
                exit;
            }
            $num = (string)$_POST['num']; //号码
            $sizixian = $_POST['sizixian'];
            $num1 = preg_replace("/X/", "", $num); //正则匹配替换
            $num_arr_x = explode('X', $num); //分割
            $status = strstr($num, 'X'); //是否包含x
            //存在x,是定1.判断长度，2.除了x还有几位数，3.规整类型
            //现,1.判断长度，2.规整类型
            //echo strlen($num).'===>'.strlen($num1).'<br/>';
            if ((strlen($num) <= 4) && (strlen($num1) > 1)) {
                if (($sizixian == 1) && (empty($status))) { //现类型、不包含x
                    $len = strlen($num);
                    $type = '现';
                    $where['co_types'] = $len . $type;
                } elseif ((empty($status)) && (strlen($num) <= 4)) { //不包含x、长度4
                    if (strlen($num) < 4) {
                        $type = '现';
                    } else {
                        $type = '定';
                    }
                    $len = strlen($num1);
                    $where['co_types'] = $len . $type;
                } elseif ((!empty($status)) && (strlen($num) == 4)) { //包含x、长度4
                    $len = strlen($num1);
                    $haoma1 = substr($num, 0, 1);
                    $haoma2 = substr($num, 1, 1);
                    $haoma3 = substr($num, 2, 1);
                    $haoma4 = substr($num, 3, 1);
                    if ($len == 2) { //赔率类型判断--6种
                        if ($haoma1 == 'x' && $haoma2 == 'x') {
                            $type = 'XX口口';
                            $where['co_types'] = $type;
                        } elseif ($haoma3 == 'x' && $haoma4 == 'x') {
                            $type = '口口XX';
                            $where['co_types'] = $type;
                        } elseif ($haoma1 == 'x' && $haoma4 == 'x') {
                            $type = 'X口口X';
                            $where['co_types'] = $type;
                        } elseif ($haoma2 == 'x' && $haoma3 == 'x') {
                            $type = '口XX口';
                            $where['co_types'] = $type;
                        } elseif ($haoma2 == 'x' && $haoma4 == 'x') {
                            $type = '口X口X';
                            $where['co_types'] = $type;
                        } elseif ($haoma1 == 'x' && $haoma3 == 'x') {
                            $type = 'X口X口';
                            $where['co_types'] = $type;
                        }
                    } elseif ($len == 3) { //赔率类型判断--4种
                        if ($haoma1 == 'x') {
                            $type = 'X口口口';
                            $where['co_types'] = $type;
                        } elseif ($haoma2 == 'x') {
                            $type = '口X口口';
                            $where['co_types'] = $type;
                        } elseif ($haoma3 == 'x') {
                            $type = '口口X口';
                            $where['co_types'] = $type;
                        } elseif ($haoma4 == 'x') {
                            $type = '口口口X';
                            $where['co_types'] = $type;
                        }
                    }
                } else {
                    echo -2;
                    exit;
                }
                //得到用户的赔率
                //判断该号码买了多少、这期的类型限制购买多少
                // $data=M('config')->where($where)->find();
                // echo json_encode($data);exit;
                echo 1;
                exit;
            } else {
                echo -2;
                exit;
            }
        } else {
            echo -2;
            exit;
        }
    }
    private function unm2($num, $type) {
        $haoma1 = substr($num, 0, 1);
        $haoma2 = substr($num, 1, 1);
        $haoma3 = substr($num, 2, 1);
        $haoma4 = substr($num, 3, 1);
        if ($type == '2定') { //赔率类型判断--6种
            if ($haoma1 == 'X' && $haoma2 == 'X') {
                $type1 = 'XX口口';
            } elseif ($haoma3 == 'X' && $haoma4 == 'X') {
                $type1 = '口口XX';
            } elseif ($haoma1 == 'X' && $haoma4 == 'X') {
                $type1 = 'X口口X';
            } elseif ($haoma2 == 'X' && $haoma3 == 'X') {
                $type1 = '口XX口';
            } elseif ($haoma2 == 'X' && $haoma4 == 'X') {
                $type1 = '口X口X';
            } elseif ($haoma1 == 'X' && $haoma3 == 'X') {
                $type1 = 'X口X口';
            }
        } elseif ($type == '3定') { //赔率类型判断--4种
            if ($haoma1 == 'X') {
                $type1 = 'X口口口';
            } elseif ($haoma2 == 'X') {
                $type1 = '口X口口';
            } elseif ($haoma3 == 'X') {
                $type1 = '口口X口';
            } elseif ($haoma4 == 'X') {
                $type1 = '口口口X';
            }
        } else {
            $type1 = $type;
        }
        return $type1;
    }
    private function haomas2($data, $types, $num, $leixing, $prohibits, $bet, $markets1, $numbers) {
        // $uid=session('userid');
        // $qishu=session('qishu');
        //判断改号码是否禁止购买
        if (!empty($prohibits)) {
            if (in_array($num, $prohibits)) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
        }
        //得到这期该号码购买情况
        if (!empty($bet)) {
            foreach ($bet as $k4 => $v4) {
                if ($v4['mingxi_2'] == $num) {
                    $money = $v4['moneys'];
                    break;
                }
            }
        }
        // $where1['qishu']=$qishu;
        // $where1['mingxi_1']=$leixing;
        // $where1['mingxi_2']=$num;
        // $where1['js']='0';
        // $bets=$bet->field('money')->where($where1)->sum('money');
        //得到改号码股东是否修改赔率和销售上限
        if (!empty($markets1)) {
            foreach ($markets1 as $k1 => $v1) {
                if ($v1['name'] == $num) {
                    $markets['markets'] = $v1['markets'];
                    $markets['loss'] = $v1['loss'];
                    break;
                }
            }
        }
        //得到该号码类型
        if (!empty($numbers)) {
            foreach ($numbers as $k2 => $v2) {
                if ($v2['numbers'] == $num) {
                    $number['types'] = $v2['types'];
                    break;
                }
            }
        }
        $loss = json_decode($data['m_loss']); //赔率
        $market = json_decode($data['m_sales']); //单注上限
        // if($bets){//得到该号码的销售总数
        //     $money=$bets;
        // }
        if ($types == 1) {
            $loss1 = $loss->ding41;
            $xhz1 = $loss->ding42; //下滑基数
            $xhz2 = $loss->ding43; //每增加数
            $xhz3 = $loss->ding44; //下滑值
            $market1 = $market->ding41;
            $market2 = $market->ding42;
            $market3 = $market->ding43;
        } elseif ($types == 2) {
            $market1 = $market->tong21;
            $market2 = $market->tong22;
            $market3 = $market->tong23;
            if ($number['types'] == 1) {
                $loss1 = $loss->tong211;
                $xhz1 = $loss->tong212; //下滑基数
                $xhz2 = $loss->tong213; //每增加数
                $xhz3 = $loss->tong214; //下滑值
                //$market1=$market->tong22;
                
            } elseif ($number['types'] == 2) {
                $loss1 = $loss->tong221;
                $xhz1 = $loss->tong222; //下滑基数
                $xhz2 = $loss->tong223; //每增加数
                $xhz3 = $loss->tong224; //下滑值
                //$marke1t=$market->tong22;
                
            }
        } elseif ($types == 3) {
            $market1 = $market->tong31;
            $market2 = $market->tong32;
            $market3 = $market->tong33;
            if ($number['types'] == 1) {
                $loss1 = $loss->tong311;
                $xhz1 = $loss->tong312; //下滑基数
                $xhz2 = $loss->tong313; //每增加数
                $xhz3 = $loss->tong314; //下滑值
                //$market1=$market->tong32;
                
            } elseif ($number['types'] == 2) {
                $loss1 = $loss->tong321;
                $xhz1 = $loss->tong322; //下滑基数
                $xhz2 = $loss->tong323; //每增加数
                $xhz3 = $loss->tong324; //下滑值
                //$market1=$market->tong32;
                
            } elseif ($number['types'] == 3) {
                $loss1 = $loss->tong331;
                $xhz1 = $loss->tong332; //下滑基数
                $xhz2 = $loss->tong333; //每增加数
                $xhz3 = $loss->tong334; //下滑值
                //$market1=$market->tong32;
                
            }
        } elseif ($types == 4) {
            $market1 = $market->tong41;
            $market2 = $market->tong42;
            $market3 = $market->tong43;
            if ($number['types'] == 1) {
                $loss1 = $loss->tong411;
                $xhz1 = $loss->tong412; //下滑基数
                $xhz2 = $loss->tong413; //每增加数
                $xhz3 = $loss->tong414; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 2) {
                $loss1 = $loss->tong421;
                $xhz1 = $loss->tong422; //下滑基数
                $xhz2 = $loss->tong423; //每增加数
                $xhz3 = $loss->tong424; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 4) {
                $loss1 = $loss->tong431;
                $xhz1 = $loss->tong432; //下滑基数
                $xhz2 = $loss->tong433; //每增加数
                $xhz3 = $loss->tong434; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 3) {
                $loss1 = $loss->tong441;
                $xhz1 = $loss->tong442; //下滑基数
                $xhz2 = $loss->tong443; //每增加数
                $xhz3 = $loss->tong444; //下滑值
                //$market1=$market->tong42;
                
            } elseif ($number['types'] == 5) {
                $loss1 = $loss->tong451;
                $xhz1 = $loss->tong452; //下滑基数
                $xhz2 = $loss->tong453; //每增加数
                $xhz3 = $loss->tong454; //下滑值
                // $market1=$market->tong42;
                
            }
        } elseif ($types == 5) {
            $loss1 = $loss->ding21;
            $xhz1 = $loss->ding22; //下滑基数
            $xhz2 = $loss->ding23; //每增加数
            $xhz3 = $loss->ding24; //下滑值
            $market1 = $market->ding21;
            $market2 = $market->ding22;
            $market3 = $market->ding23;
        } elseif ($types == 6) {
            $loss1 = $loss->ding31;
            $xhz1 = $loss->ding32; //下滑基数
            $xhz2 = $loss->ding33; //每增加数
            $xhz3 = $loss->ding34; //下滑值
            $market1 = $market->ding31;
            $market2 = $market->ding32;
            $market3 = $market->ding33;
        }
        //股东修改赔率和单注上限
        if ($markets) {
            $c_loss = $markets['loss'];
            $c_markets = $markets['markets'];
            if (!empty($c_loss)) {
                $loss1 = $c_loss;
            }
            if (!empty($c_markets)) {
                $market1 = $c_markets;
            }
        }
        //if(!empty($money) && ($data['m_odds']==1)){
        if (!empty($money) && ($data['m_odds'] == 1)) {
            if ($money >= $market1) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
            if ($money >= $xhz1) {
                $loss1 = $loss1 - $xhz3;
            }
            //销售数
            if ($money >= ($xhz1 + $xhz2)) { //得到该号码的下滑值
                $money1 = $money - $xhz1;
                $money2 = floor($money1 / $xhz2);
                if ($money2 >= 1) {
                    $loss1 = $loss1 - ($money2 * $xhz3);
                    if (($loss1 + $xhz3) < $xhz3) {
                        $arrs = array('code' => 400);
                        return $arrs;
                        exit;
                    }
                }
            }
            //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            if (($market1 - $money) < $market2) {
                $market2 = $market1 - $money;
            }
        } else {
            if (!empty($money)) {
                if ($money >= $market1) {
                    $arrs = array('code' => 400);
                    return $arrs;
                    exit;
                }
                //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
                if (($market1 - $money) < $market2) {
                    $market2 = $market1 - $money;
                }
            }
        }
        $loss3 = 0;
        $arr = array('code' => 200, $loss1, $market1, $market2, $market3, $loss3, $num); //赔率，每码上限，单注上限，会员回水,号码
        return $arr;
    }
    private function haomas3($data, $types, $num, $leixing, $loss1, $prohibits, $bet, $markets1, $numbers) {
        // $uid=session('userid');
        // $qishu=session('qishu');
        //判断改号码是否禁止购买
        //判断改号码是否禁止购买
        if (!empty($prohibits)) {
            if (in_array($num, $prohibits)) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
        }
        //得到这期该号码购买情况
        if (!empty($bet)) {
            foreach ($bet as $k4 => $v4) {
                if ($v4['mingxi_2'] == $num) {
                    $money = $v4['moneys'];
                    break;
                }
            }
        }
        // $where1['qishu']=$qishu;
        // $where1['mingxi_1']=$leixing;
        // $where1['mingxi_2']=$num;
        // $where1['js']='0';
        // $bets=$bet->field('money')->where($where1)->sum('money');
        //得到改号码股东是否修改赔率和销售上限
        if (!empty($markets1)) {
            foreach ($markets1 as $k1 => $v1) {
                if ($v1['name'] == $num) {
                    $markets['markets'] = $v1['markets'];
                    $markets['loss'] = $v1['loss'];
                    break;
                }
            }
        }
        //得到该号码类型
        if (!empty($numbers)) {
            foreach ($numbers as $k2 => $v2) {
                if ($v2['numbers'] == $num) {
                    $number['types'] = $v2['types'];
                    break;
                }
            }
        }
        // $where['qishu']=$qishu;
        // $where['p_type']=$types;
        // $where['name']=$num;
        //  $prohibit=$prohibits->field('p_id')->where($where)->find();
        //  if($prohibit){
        //    $arrs=array('code'=>400);
        //    return $arrs;
        //    exit;
        //  }
        //得到这期该号码购买情况
        // $where1['qishu']=$qishu;
        // $where1['mingxi_1']=$leixing;
        // $where1['mingxi_2']=$num;
        // $where1['js']='0';
        // $bets=$bet->field('money')->where($where1)->sum('money');
        // return $bets;
        // exit;
        //得到改号码股东是否修改赔率和销售上限
        // $where2['qishu']=$qishu;
        // $where2['name']=$num;
        // $where2['type']=$types;
        // $markets=$markets1->field('loss,markets')->where($where2)->find();
        $loss = json_decode($loss1['loss']);
        $loss4 = json_decode($data['m_loss']); //赔率
        $market = json_decode($data['m_sales']); //单注上限
        // if($bets){//得到该号码的销售总数
        //   //foreach($bets as $k=>$v){
        //     $money=$bets;
        //  // }
        // }
        //得到该号码类型
        // if($types==2 || $types==3 || $types==4){
        //   $where3['numbers']=$num;
        //   $where3['type']=$types;
        //   $number=$numbers->field('types')->where($where3)->find();
        //  }
        // $where3['numbers']=$num;
        // $where3['type']=$types;
        // $number=$numbers->field('types')->where($where3)->find();
        //
        if ($types == 1) {
            $loss3 = $loss[0]->loss4;
            $loss2 = $loss[0]->ding4;
            $market1 = $market->ding41;
            $market2 = $market->ding42;
            $market3 = $market->ding43;
            $xhz1 = $loss4->ding42; //下滑基数
            $xhz2 = $loss4->ding43; //每增加数
            $xhz3 = $loss4->ding44; //下滑值
            /////////四定
            $pl3 = $loss4->ding41; //股东赔率
            if ($pl3 > 3000) {
                $pl13 = $loss4->ding41 - 2500;
                $sums3 = ($pl3) - ($pl13);
                for ($i3 = 0;$i3 <= $sums3;$i3++) {
                    if ($i3 < 10) {
                        $g3 = '0.00' . $i3;
                    } elseif ($i3 >= 10 && $i3 <= 99) {
                        $g3 = '0.0' . $i3;
                    } else {
                        $g3 = '0.' . $i3;
                    }
                    if ($g3 == '0.000') {
                        $g3 = 0;
                    }
                    $f3[] = $g3;
                }
                $a41 = 250;
                for ($a41a = 0;$a41a < $a41;$a41a++) {
                    $c3 = $pl3 - ($a41a . '0');
                    if ($c3 < 1) {
                        $c3 = 0;
                    }
                    $d3[] = $c3;
                }
                $d3[] = $pl13;
                for ($h3 = 0;$h3 < count($d3);$h3++) {
                    if ($loss3 == $f3[$h3]) {
                        $loss2 = $d3[$h3];
                    }
                }
            }
        } elseif ($types == 2) {
            // //得到该号码类型
            $market1 = $market->tong21;
            $market2 = $market->tong22;
            $market3 = $market->tong23;
            if ($number['types'] == 1) {
                $loss3 = $loss[1]->loss21;
                $loss2 = $loss[1]->tong21;
                $xhz1 = $loss4->tong212; //下滑基数
                $xhz2 = $loss4->tong213; //每增加数
                $xhz3 = $loss4->tong214; //下滑值
                // $market2=$market->tong22;
                $pl6 = $loss4->tong211;
                if ($pl6 > 3) {
                    for ($i6 = 0;$i6 <= 250;$i6++) {
                        if ($i6 < 10) {
                            $g6 = '0.00' . $i6;
                        } elseif ($i6 >= 10 && $i6 <= 99) {
                            $g6 = '0.0' . $i6;
                        } else {
                            $g6 = '0.' . $i6;
                        }
                        if ($g6 == '0.000') {
                            $g6 = 0;
                        }
                        $f6[] = $g6;
                    }
                    for ($a6 = 0;$a6 < count($f6);$a6++) {
                        $arr = '0.' . $a6;
                        $arr6 = explode(".", $arr);
                        if ($a6 > 9 && $a6 <= 99) {
                            //echo $arr[3];
                            $c6 = $pl6 - ('0.' . $arr6[1]);
                        } elseif ($a6 > 99 && $a6 <= 199) {
                            $c6 = $pl6 - ('1.' . substr($arr6[1], -2));
                        } elseif ($a6 > 199) {
                            $c6 = $pl6 - ('2.' . substr($arr6[1], -2));
                        } else {
                            $c6 = $pl6 - ('0.0' . $a6);
                        }
                        if ($c6 < 1) {
                            $c6 = 0;
                        }
                        $d6[] = $c6;
                    }
                    for ($h6 = 0;$h6 < count($d6);$h6++) {
                        if ($loss3 == $f6[$h6]) {
                            $loss2 = $d6[$h6];
                        }
                    }
                }
            } elseif ($number['types'] == 2) {
                $loss3 = $loss[1]->loss22;
                $loss2 = $loss[1]->tong22;
                $xhz1 = $loss4->tong222; //下滑基数
                $xhz2 = $loss4->tong223; //每增加数
                $xhz3 = $loss4->tong224; //下滑值
                //$market2=$market->tong22;
                $pl7 = $loss4->tong221;
                for ($i7 = 0;$i7 <= 250;$i7++) {
                    if ($i7 < 10) {
                        $g7 = '0.00' . $i7;
                    } elseif ($i7 >= 10 && $i7 <= 99) {
                        $g7 = '0.0' . $i7;
                    } else {
                        $g7 = '0.' . $i7;
                    }
                    if ($g7 == '0.000') {
                        $g7 = 0;
                    }
                    $f7[] = $g7;
                }
                for ($a7 = 0;$a7 < count($f7);$a7++) {
                    $arr = '0.' . $a7;
                    $arr7 = explode(".", $arr);
                    if ($a7 > 9 && $a7 <= 99) {
                        //echo $arr[3];
                        $c7 = $pl7 - (('0.' . $arr7[1]) * 2);
                    } elseif ($a7 > 99 && $a7 <= 199) {
                        $c7 = $pl7 - (('1.' . substr($arr7[1], -2)) * 2);
                    } elseif ($a7 > 199) {
                        $c7 = $pl7 - (('2.' . substr($arr7[1], -2)) * 2);
                    } else {
                        $c7 = $pl7 - (('0.0' . $a7) * 2);
                    }
                    if ($c7 < 1) {
                        $c7 = 0;
                    }
                    $d7[] = $c7;
                }
                for ($h7 = 0;$h7 < count($d7);$h7++) {
                    if ($loss3 == $f7[$h7]) {
                        $loss2 = $d7[$h7];
                    }
                }
            }
        } elseif ($types == 3) {
            $market1 = $market->tong31;
            $market2 = $market->tong32;
            $market3 = $market->tong33;
            if ($number['types'] == 1) {
                $loss3 = $loss[2]->loss31;
                $loss2 = $loss[2]->tong31;
                $xhz1 = $loss4->tong312; //下滑基数
                $xhz2 = $loss4->tong313; //每增加数
                $xhz3 = $loss4->tong314; //下滑值
                //$market2=$market->tong32;
                $pl4 = $loss4->tong311;
                $pl14 = $loss4->tong311 - 2.5;
                // $pl14=35;
                $sums4 = ($pl4 . '0') - ($pl14 . '0');
                for ($i4 = 0;$i4 <= 250;$i4++) {
                    if ($i4 < 10) {
                        $g4 = '0.00' . $i4;
                    } elseif ($i4 >= 10 && $i4 <= 99) {
                        $g4 = '0.0' . $i4;
                    } else {
                        $g4 = '0.' . $i4;
                    }
                    if ($g4 == '0.000') {
                        $g4 = 0;
                    }
                    $f4[] = $g4;
                }
                for ($a4 = 0;$a4 < count($f4);$a4++) {
                    $ar4 = '0.' . $a4;
                    $arr1 = explode(".", $ar4);
                    if ($a4 > 9 && $a4 < 99) {
                        //echo $arr[3];
                        $c4 = $pl4 - (('0.' . $arr1[1]) * 5);
                    } elseif ($a4 > 99 && $a4 < 199) {
                        $c4 = $pl4 - (('1.' . substr($arr1[1], -2)) * 5);
                    } elseif ($a4 > 199) {
                        $c4 = $pl4 - (('2.' . substr($arr1[1], -2)) * 5);
                    } else {
                        $c4 = $pl4 - (('0.0' . $a4) * 5);
                    }
                    $d4[] = $c4;
                }
                for ($h4 = 0;$h4 < count($d4);$h4++) {
                    if ($loss3 == $f4[$h4]) {
                        $loss2 = $d4[$h4];
                    }
                }
            } elseif ($number['types'] == 2) {
                $loss3 = $loss[2]->loss32;
                $loss2 = $loss[2]->tong32;
                $xhz1 = $loss4->tong322; //下滑基数
                $xhz2 = $loss4->tong323; //每增加数
                $xhz3 = $loss4->tong324; //下滑值
                //$market2=$market->tong32;
                $pl8 = $loss4->tong321;
                for ($i8 = 0;$i8 <= 250;$i8++) {
                    if ($i8 < 10) {
                        $g8 = '0.00' . $i8;
                    } elseif ($i8 >= 10 && $i8 <= 99) {
                        $g8 = '0.0' . $i8;
                    } else {
                        $g8 = '0.' . $i8;
                    }
                    if ($g8 == '0.000') {
                        $g8 = 0;
                    }
                    $f8[] = $g8;
                }
                for ($a8 = 0;$a8 < count($f8);$a8++) {
                    $ar8 = '0.' . $a8;
                    $arr1 = explode(".", $ar8);
                    if ($a8 > 9 && $a8 < 99) {
                        //echo $arr[3];
                        $c8 = $pl8 - (('0.' . $arr1[1]) * 8);
                    } elseif ($a8 > 99 && $a8 < 199) {
                        $c8 = $pl8 - (('1.' . substr($arr1[1], -2)) * 8);
                    } elseif ($a8 > 199) {
                        $c8 = $pl8 - (('2.' . substr($arr1[1], -2)) * 8);
                    } else {
                        $c8 = $pl8 - (('0.0' . $a8) * 8);
                    }
                    $d8[] = $c8;
                }
                for ($h8 = 0;$h8 < count($d8);$h8++) {
                    if ($loss3 == $f8[$h8]) {
                        $loss2 = $d8[$h8];
                    }
                }
            } elseif ($number['types'] == 3) {
                $loss3 = $loss[2]->loss33;
                $loss2 = $loss[2]->tong33;
                $xhz1 = $loss4->tong332; //下滑基数
                $xhz2 = $loss4->tong333; //每增加数
                $xhz3 = $loss4->tong334; //下滑值
                //$market2=$market->tong32;
                $pl9 = $loss4->tong331;
                for ($i9 = 0;$i9 <= 250;$i9++) {
                    if ($i9 < 10) {
                        $g9 = '0.00' . $i9;
                    } elseif ($i9 >= 10 && $i9 <= 99) {
                        $g9 = '0.0' . $i9;
                    } else {
                        $g9 = '0.' . $i9;
                    }
                    if ($g9 == '0.000') {
                        $g9 = 0;
                    }
                    $f9[] = $g9;
                }
                for ($a9 = 0;$a9 < count($f9);$a9++) {
                    $arr9 = $a9 * 1;
                    if ($a9 <= 9) {
                        $c9 = $pl9 - ('0.' . substr($arr9, -1, 1));
                    } elseif ($a9 > 9 && $a9 <= 99) {
                        $c9 = $pl9 - (substr($arr9, -2, 1) . '.' . substr($arr9, -1, 1));
                    } else {
                        $c9 = $pl9 - (substr($arr9, -3, 2) . '.' . substr($arr9, -1, 1));
                    }
                    if ($c9 < 1) {
                        $c9 = 0;
                    }
                    $d9[] = $c9;
                }
                for ($h9 = 0;$h9 < count($d9);$h9++) {
                    if ($loss3 == $f9[$h9]) {
                        $loss2 = $d9[$h9];
                    }
                }
            }
        } elseif ($types == 4) {
            $market1 = $market->tong41;
            $market2 = $market->tong42;
            $market3 = $market->tong43;
            if ($number['types'] == 1) {
                $loss3 = $loss[3]->loss41;
                $loss2 = $loss[3]->tong41;
                $xhz1 = $loss4->tong412; //下滑基数
                $xhz2 = $loss4->tong413; //每增加数
                $xhz3 = $loss4->tong414; //下滑值
                //$market2=$market->tong42;
                $pl5 = $loss4->tong411;
                for ($i5 = 0;$i5 <= 250;$i5++) {
                    if ($i5 < 10) {
                        $g5 = '0.00' . $i5;
                    } elseif ($i5 >= 10 && $i5 <= 99) {
                        $g5 = '0.0' . $i5;
                    } else {
                        $g5 = '0.' . $i5;
                    }
                    if ($g5 == '0.000') {
                        $g5 = 0;
                    }
                    $f5[] = $g5;
                }
                for ($a5 = 0;$a5 < count($f5);$a5++) {
                    $ar5 = '0.' . $a5;
                    $arr5 = explode(".", $ar5);
                    if ($a5 < 10) {
                        $as5 = 0;
                        $c5 = $pl5 - (('0.' . $arr5[1]) * 4);
                    } elseif ($a5 >= 10 && $a5 <= 19) {
                        $c5 = $pl5 - (('1.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 20 && $a5 <= 29) {
                        $c5 = $pl5 - (('2.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 30 && $a5 <= 39) {
                        $c5 = $pl5 - (('3.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 40 && $a5 <= 49) {
                        $c5 = $pl5 - (('4.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 50 && $a5 <= 59) {
                        $c5 = $pl5 - (('5.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 60 && $a5 <= 69) {
                        $c5 = $pl5 - (('6.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 70 && $a5 <= 79) {
                        $c5 = $pl5 - (('7.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 80 && $a5 <= 89) {
                        $c5 = $pl5 - (('8.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 90 && $a5 <= 99) {
                        $c5 = $pl5 - (('9.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 100 && $a5 <= 109) {
                        $c5 = $pl5 - (('10.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 110 && $a5 <= 119) {
                        $c5 = $pl5 - (('11.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 120 && $a5 <= 129) {
                        $c5 = $pl5 - (('12.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 130 && $a5 <= 139) {
                        $c5 = $pl5 - (('13.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 140 && $a5 <= 149) {
                        $c5 = $pl5 - (('14.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 150 && $a5 <= 159) {
                        $c5 = $pl5 - (('15.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 160 && $a5 <= 169) {
                        $c5 = $pl5 - (('16.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 170 && $a5 <= 179) {
                        $c5 = $pl5 - (('17.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 180 && $a5 <= 189) {
                        $c5 = $pl5 - (('18.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 190 && $a5 <= 199) {
                        $c5 = $pl5 - (('19.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 200 && $a5 <= 209) {
                        $c5 = $pl5 - (('20.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 210 && $a5 <= 219) {
                        $c5 = $pl5 - (('21.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 220 && $a5 <= 229) {
                        $c5 = $pl5 - (('22.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 230 && $a5 <= 239) {
                        $c5 = $pl5 - (('23.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 240 && $a5 <= 249) {
                        $c5 = $pl5 - (('24.' . substr($arr5[1], -1)) * 4);
                    } elseif ($a5 >= 250 && $a5 <= 259) {
                        $c5 = $pl5 - (('25.' . substr($arr5[1], -1)) * 4);
                    }
                    $d5[] = $c5;
                }
                for ($h5 = 0;$h5 < count($d5);$h5++) {
                    if ($loss3 == $f5[$h5]) {
                        $loss2 = $d5[$h5];
                    }
                }
            } elseif ($number['types'] == 2) {
                $loss3 = $loss[3]->loss42;
                $loss2 = $loss[3]->tong42;
                $xhz1 = $loss4->tong422; //下滑基数
                $xhz2 = $loss4->tong423; //每增加数
                $xhz3 = $loss4->tong424; //下滑值
                //$market2=$market->tong42;
                $pl10 = $loss4->tong421;
                for ($i10 = 0;$i10 <= 250;$i10++) {
                    if ($i10 < 10) {
                        $g10 = '0.00' . $i10;
                    } elseif ($i10 >= 10 && $i10 <= 99) {
                        $g10 = '0.0' . $i10;
                    } else {
                        $g10 = '0.' . $i10;
                    }
                    if ($g10 == '0.000') {
                        $g10 = 0;
                    }
                    $f10[] = $g10;
                }
                // for($a10=0;$a10<count($f10);$a10++){
                //     $arr10=$a10*4;
                //     if($a10<=9){
                //         $c10=$pl10-('0.'.substr($arr10,-1,1));
                //     }elseif($a10>9 && $a10<=99){
                //         $c10=$pl10-(substr($arr10,-2,1).'.'.substr($arr10,-1,1));
                //     }else{
                //         $c10=$pl10-(substr($arr10,-3,2).'.'.substr($arr10,-1,1));
                //     }
                //     if($c10<1){
                //      $c10=0;
                //     }
                //     $d10[]=$c10;
                // }
                for ($a10 = 0;$a10 < count($f10);$a10++) {
                    $ar5 = '0.' . $a10;
                    $arr10 = explode(".", $ar5);
                    if ($a10 < 10) {
                        $as5 = 0;
                        $c10 = $pl10 - (('0.' . $arr10[1]) * 2);
                    } elseif ($a10 >= 10 && $a10 <= 19) {
                        $c10 = $pl10 - (('1.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 20 && $a10 <= 29) {
                        $c10 = $pl10 - (('2.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 30 && $a10 <= 39) {
                        $c10 = $pl10 - (('3.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 40 && $a10 <= 49) {
                        $c10 = $pl10 - (('4.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 50 && $a10 <= 59) {
                        $c10 = $pl10 - (('5.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 60 && $a10 <= 69) {
                        $c10 = $pl10 - (('6.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 70 && $a10 <= 79) {
                        $c10 = $pl10 - (('7.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 80 && $a10 <= 89) {
                        $c10 = $pl10 - (('8.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 90 && $a10 <= 99) {
                        $c10 = $pl10 - (('9.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 100 && $a10 <= 109) {
                        $c10 = $pl10 - (('10.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 110 && $a10 <= 119) {
                        $c10 = $pl10 - (('11.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 120 && $a10 <= 129) {
                        $c10 = $pl10 - (('12.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 130 && $a10 <= 139) {
                        $c10 = $pl10 - (('13.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 140 && $a10 <= 149) {
                        $c10 = $pl10 - (('14.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 150 && $a10 <= 159) {
                        $c10 = $pl10 - (('15.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 160 && $a10 <= 169) {
                        $c10 = $pl10 - (('16.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 170 && $a10 <= 179) {
                        $c10 = $pl10 - (('17.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 180 && $a10 <= 189) {
                        $c10 = $pl10 - (('18.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 190 && $a10 <= 199) {
                        $c10 = $pl10 - (('19.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 200 && $a10 <= 209) {
                        $c10 = $pl10 - (('20.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 210 && $a10 <= 219) {
                        $c10 = $pl10 - (('21.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 220 && $a10 <= 229) {
                        $c10 = $pl10 - (('22.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 230 && $a10 <= 239) {
                        $c10 = $pl10 - (('23.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 240 && $a10 <= 249) {
                        $c10 = $pl10 - (('24.' . substr($arr10[1], -1)) * 2);
                    } elseif ($a10 >= 250 && $a10 <= 259) {
                        $c10 = $pl10 - (('25.' . substr($arr10[1], -1)) * 2);
                    }
                    $d10[] = $c10;
                }
                for ($h10 = 0;$h10 < count($d10);$h10++) {
                    if ($loss3 == $f10[$h10]) {
                        $loss2 = $d10[$h10];
                    }
                }
            } elseif ($number['types'] == 4) {
                $loss3 = $loss[3]->loss43;
                $loss2 = $loss[3]->tong43;
                $xhz1 = $loss4->tong432; //下滑基数
                $xhz2 = $loss4->tong433; //每增加数
                $xhz3 = $loss4->tong434; //下滑值
                //$market2=$market->tong42;
                $pl11 = $loss4->tong431;
                for ($i11 = 0;$i11 <= 250;$i11++) {
                    if ($i11 < 11) {
                        $g11 = '0.00' . $i11;
                    } elseif ($i11 >= 11 && $i11 <= 99) {
                        $g11 = '0.0' . $i11;
                    } else {
                        $g11 = '0.' . $i11;
                    }
                    if ($g11 == '0.000') {
                        $g11 = 0;
                    }
                    $f11[] = $g11;
                }
                for ($a11 = 0;$a11 < count($f11);$a11++) {
                    $ar11 = '0.' . $a11;
                    $arr11 = explode(".", $ar11);
                    if ($a11 < 10) {
                        $c11 = $pl11 - (('0.' . $arr11[1]) * 4);
                    } elseif ($a11 >= 10 && $a11 <= 19) {
                        $c11 = $pl11 - (('1.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 20 && $a11 <= 29) {
                        $c11 = $pl11 - (('2.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 30 && $a11 <= 39) {
                        $c11 = $pl11 - (('3.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 40 && $a11 <= 49) {
                        $c11 = $pl11 - (('4.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 50 && $a11 <= 59) {
                        $c11 = $pl11 - (('5.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 60 && $a11 <= 69) {
                        $c11 = $pl11 - (('6.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 70 && $a11 <= 79) {
                        $c11 = $pl11 - (('7.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 80 && $a11 <= 89) {
                        $c11 = $pl11 - (('8.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 90 && $a11 <= 99) {
                        $c11 = $pl11 - (('9.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 100 && $a11 <= 109) {
                        $c11 = $pl11 - (('10.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 110 && $a11 <= 119) {
                        $c11 = $pl11 - (('11.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 120 && $a11 <= 129) {
                        $c11 = $pl11 - (('12.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 130 && $a11 <= 139) {
                        $c11 = $pl11 - (('13.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 140 && $a11 <= 149) {
                        $c11 = $pl11 - (('14.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 150 && $a11 <= 159) {
                        $c11 = $pl11 - (('15.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 160 && $a11 <= 169) {
                        $c11 = $pl11 - (('16.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 170 && $a11 <= 179) {
                        $c11 = $pl11 - (('17.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 180 && $a11 <= 189) {
                        $c11 = $pl11 - (('18.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 190 && $a11 <= 199) {
                        $c11 = $pl11 - (('19.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 200 && $a11 <= 209) {
                        $c11 = $pl11 - (('20.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 210 && $a11 <= 219) {
                        $c11 = $pl11 - (('21.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 220 && $a11 <= 229) {
                        $c11 = $pl11 - (('22.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 230 && $a11 <= 239) {
                        $c11 = $pl11 - (('23.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 240 && $a11 <= 249) {
                        $c11 = $pl11 - (('24.' . substr($arr11[1], -1)) * 4);
                    } elseif ($a11 >= 250 && $a11 <= 259) {
                        $c11 = $pl11 - (('25.' . substr($arr11[1], -1)) * 4);
                    }
                    $d11[] = $c11;
                }
                for ($h11 = 0;$h11 < count($d11);$h11++) {
                    if ($loss3 == $f11[$h11]) {
                        $loss2 = $d11[$h11];
                    }
                }
            } elseif ($number['types'] == 3) {
                $loss3 = $loss[3]->loss44;
                $loss2 = $loss[3]->tong44;
                $xhz1 = $loss4->tong442; //下滑基数
                $xhz2 = $loss4->tong443; //每增加数
                $xhz3 = $loss4->tong444; //下滑值
                //$market2=$market->tong42;
                $pl12 = $loss4->tong441;
                for ($i12 = 0;$i12 <= 250;$i12++) {
                    if ($i12 < 12) {
                        $g12 = '0.00' . $i12;
                    } elseif ($i12 >= 12 && $i12 <= 99) {
                        $g12 = '0.0' . $i12;
                    } else {
                        $g12 = '0.' . $i12;
                    }
                    if ($g12 == '0.000') {
                        $g12 = 0;
                    }
                    $f12[] = $g12;
                }
                for ($a12 = 0;$a12 < count($f12);$a12++) {
                    $ar12 = '0.' . $a12;
                    $arr12 = explode(".", $ar12);
                    if ($a12 < 10) {
                        $c12 = $pl12 - (('0.' . $arr12[1]) * 4);
                    } elseif ($a12 >= 10 && $a12 <= 19) {
                        $c12 = $pl12 - (('1.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 20 && $a12 <= 29) {
                        $c12 = $pl12 - (('2.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 30 && $a12 <= 39) {
                        $c12 = $pl12 - (('3.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 40 && $a12 <= 49) {
                        $c12 = $pl12 - (('4.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 50 && $a12 <= 59) {
                        $c12 = $pl12 - (('5.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 60 && $a12 <= 69) {
                        $c12 = $pl12 - (('6.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 70 && $a12 <= 79) {
                        $c12 = $pl12 - (('7.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 80 && $a12 <= 89) {
                        $c12 = $pl12 - (('8.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 90 && $a12 <= 99) {
                        $c12 = $pl12 - (('9.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 100 && $a12 <= 109) {
                        $c12 = $pl12 - (('10.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 110 && $a12 <= 119) {
                        $c12 = $pl12 - (('11.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 120 && $a12 <= 129) {
                        $c12 = $pl12 - (('12.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 130 && $a12 <= 139) {
                        $c12 = $pl12 - (('13.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 140 && $a12 <= 149) {
                        $c12 = $pl12 - (('14.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 150 && $a12 <= 159) {
                        $c12 = $pl12 - (('15.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 160 && $a12 <= 169) {
                        $c12 = $pl12 - (('16.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 170 && $a12 <= 179) {
                        $c12 = $pl12 - (('17.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 180 && $a12 <= 189) {
                        $c12 = $pl12 - (('18.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 190 && $a12 <= 199) {
                        $c12 = $pl12 - (('19.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 200 && $a12 <= 209) {
                        $c12 = $pl12 - (('20.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 210 && $a12 <= 219) {
                        $c12 = $pl12 - (('21.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 220 && $a12 <= 229) {
                        $c12 = $pl12 - (('22.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 230 && $a12 <= 239) {
                        $c12 = $pl12 - (('23.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 240 && $a12 <= 249) {
                        $c12 = $pl12 - (('24.' . substr($arr12[1], -1)) * 4);
                    } elseif ($a12 >= 250 && $a12 <= 259) {
                        $c12 = $pl12 - (('25.' . substr($arr12[1], -1)) * 4);
                    }
                    $d12[] = $c12;
                }
                for ($h12 = 0;$h12 < count($d12);$h12++) {
                    if ($loss3 == $f12[$h12]) {
                        $loss2 = $d12[$h12];
                    }
                }
            } elseif ($number['types'] == 5) {
                $loss3 = $loss[3]->loss45;
                $loss2 = $loss[3]->tong45;
                $xhz1 = $loss4->tong452; //下滑基数
                $xhz2 = $loss4->tong453; //每增加数
                $xhz3 = $loss4->tong454; //下滑值
                //$market2=$market->tong42;
                $pl13 = $loss4->tong451;
                for ($i13 = 0;$i13 <= 250;$i13++) {
                    if ($i13 < 12) {
                        $g13 = '0.00' . $i13;
                    } elseif ($i13 >= 12 && $i13 <= 99) {
                        $g13 = '0.0' . $i13;
                    } else {
                        $g13 = '0.' . $i13;
                    }
                    if ($g13 == '0.000') {
                        $g13 = 0;
                    }
                    $f13[] = $g13;
                }
                // for($a13=0;$a13<count($f13);$a13++){
                //     $arr13=$a13*4;
                //     if($a13<=9){
                //         $c13=$pl13-('0.'.substr($arr13,-1,1));
                //     }elseif($a13>9 && $a13<=99){
                //         $c13=$pl13-(substr($arr13,-2,1).'.'.substr($arr13,-1,1));
                //     }else{
                //         $c13=$pl13-(substr($arr13,-3,2).'.'.substr($arr13,-1,1));
                //     }
                //     if($c13<1){
                //      $c13=0;
                //     }
                //     $d13[]=$c13;
                // }
                for ($a13 = 0;$a13 < count($f13);$a13++) {
                    $ar13 = '0.' . $a13;
                    $arr13 = explode(".", $ar13);
                    if ($a13 < 10) {
                        $c13 = $pl13 - (('0.' . $arr13[1]) * 4);
                    } elseif ($a13 >= 10 && $a13 <= 19) {
                        $c13 = $pl13 - (('1.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 20 && $a13 <= 29) {
                        $c13 = $pl13 - (('2.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 30 && $a13 <= 39) {
                        $c13 = $pl13 - (('3.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 40 && $a13 <= 49) {
                        $c13 = $pl13 - (('4.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 50 && $a13 <= 59) {
                        $c13 = $pl13 - (('5.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 60 && $a13 <= 69) {
                        $c13 = $pl13 - (('6.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 70 && $a13 <= 79) {
                        $c13 = $pl13 - (('7.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 80 && $a13 <= 89) {
                        $c13 = $pl13 - (('8.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 90 && $a13 <= 99) {
                        $c13 = $pl13 - (('9.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 100 && $a13 <= 109) {
                        $c13 = $pl13 - (('10.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 110 && $a13 <= 119) {
                        $c13 = $pl13 - (('11.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 120 && $a13 <= 129) {
                        $c13 = $pl13 - (('12.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 130 && $a13 <= 139) {
                        $c13 = $pl13 - (('13.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 140 && $a13 <= 149) {
                        $c13 = $pl13 - (('14.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 150 && $a13 <= 159) {
                        $c13 = $pl13 - (('15.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 160 && $a13 <= 169) {
                        $c13 = $pl13 - (('16.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 170 && $a13 <= 179) {
                        $c13 = $pl13 - (('17.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 180 && $a13 <= 189) {
                        $c13 = $pl13 - (('18.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 190 && $a13 <= 199) {
                        $c13 = $pl13 - (('19.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 200 && $a13 <= 209) {
                        $c13 = $pl13 - (('20.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 210 && $a13 <= 219) {
                        $c13 = $pl13 - (('21.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 220 && $a13 <= 229) {
                        $c13 = $pl13 - (('22.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 230 && $a13 <= 239) {
                        $c13 = $pl13 - (('23.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 240 && $a13 <= 249) {
                        $c13 = $pl13 - (('24.' . substr($arr13[1], -1)) * 4);
                    } elseif ($a13 >= 250 && $a13 <= 259) {
                        $c13 = $pl13 - (('25.' . substr($arr13[1], -1)) * 4);
                    }
                    $d13[] = $c13;
                }
                for ($h13 = 0;$h13 < count($d13);$h13++) {
                    if ($loss3 == $f13[$h13]) {
                        $loss2 = $d13[$h13];
                    }
                }
            }
        } elseif ($types == 5) {
            $loss2 = $loss[4]->ding2;
            $loss3 = $loss[4]->loss2;
            $market1 = $market->ding21;
            $market2 = $market->ding22;
            $market3 = $market->ding23;
            $xhz1 = $loss4->ding22; //下滑基数
            $xhz2 = $loss4->ding23; //每增加数
            $xhz3 = $loss4->ding24; //下滑值
            $pl = $loss4->ding21;
            for ($i = 0;$i <= 250;$i++) {
                if ($i < 10) {
                    $g = '0.00' . $i;
                } elseif ($i >= 10 && $i <= 99) {
                    $g = '0.0' . $i;
                } else {
                    $g = '0.' . $i;
                }
                if ($g == '0.000') {
                    $g = 0;
                }
                $f[] = $g;
            }
            for ($a14 = 0;$a14 < count($f);$a14++) {
                $arr14 = $a14;
                if ($a14 <= 9) {
                    $c14 = $pl - ('0.' . substr($arr14, -1, 1));
                } elseif ($a14 > 9 && $a14 <= 99) {
                    $c14 = $pl - (substr($arr14, -2, 1) . '.' . substr($arr14, -1, 1));
                } else {
                    $c14 = $pl - (substr($arr14, -3, 2) . '.' . substr($arr14, -1, 1));
                }
                if ($c14 < 1) {
                    $c14 = 0;
                }
                $d14[] = $c14;
            }
            for ($h = 0;$h < count($d14);$h++) {
                if ($loss3 == $f[$h]) {
                    $loss2 = $d14[$h];
                }
            }
        } elseif ($types == 6) {
            $loss2 = $loss[5]->ding3;
            $loss3 = $loss[5]->loss3;
            $market1 = $market->ding31;
            $market2 = $market->ding32;
            $market3 = $market->ding33;
            $xhz1 = $loss4->ding32; //下滑基数
            $xhz2 = $loss4->ding33; //每增加数
            $xhz3 = $loss4->ding34; //下滑值
            $pl2 = $loss4->ding31;
            for ($i2 = 0;$i2 <= 250;$i2++) {
                if ($i2 < 10) {
                    $g2 = '0.00' . $i2;
                } elseif ($i2 >= 10 && $i2 <= 99) {
                    $g2 = '0.0' . $i2;
                } else {
                    $g2 = '0.' . $i2;
                }
                if ($g2 == '0.000') {
                    $g2 = 0;
                }
                $f2[] = $g2;
            }
            for ($a2 = 0;$a2 < count($f2);$a2++) {
                $arr = '0.' . $a2;
                $arr2 = explode(".", $arr);
                if ($a2 > 9 && $a2 < 99) {
                    $c2 = $pl2 - (($arr2[1]) * 1);
                } elseif ($a2 > 99 && $a2 < 199) {
                    $c2 = $pl2 - (('1' . substr($arr2[1], -2)) * 1);
                } elseif ($a2 > 199) {
                    $c2 = $pl2 - (('2' . substr($arr2[1], -2)) * 1);
                } else {
                    $c2 = $pl2 - ($a2 * 1);
                }
                if ($c2 < 1) {
                    $c2 = 0;
                }
                $d2[] = $c2;
            }
            for ($h2 = 0;$h2 < count($d2);$h2++) {
                if ($loss3 == $f2[$h2]) {
                    $loss2 = $d2[$h2];
                }
            }
        }
        //股东修改赔率和单注上限
        if ($markets) {
            $c_loss = $markets['loss'];
            $c_markets = $markets['markets'];
            if (!empty($c_loss)) {
                $loss2 = $c_loss;
            }
            if (!empty($c_markets)) {
                $market1 = $c_markets;
            }
        }
        //判断总数是否超过每码销售值
        //if(!empty($money) && ($data['m_odds']==1)){
        if (!empty($money) && ($data['m_odds'] == 1)) {
            if ($money >= $market1) {
                $arrs = array('code' => 400);
                return $arrs;
                exit;
            }
            if ($money >= $xhz1) {
                $loss2 = $loss2 - $xhz3;
            }
            //销售数
            if ($money >= ($xhz1 + $xhz2)) { //得到该号码的下滑值
                $money1 = $money - $xhz1;
                $money2 = floor($money1 / $xhz2);
                if ($money2 >= 1) {
                    $loss2 = $loss2 - ($money2 * $xhz3);
                    if (($loss2 + $xhz3) < $xhz3) {
                        $arrs = array('code' => 400);
                        return $arrs;
                        exit;
                    }
                }
            }
            //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            if (($market1 - $money) < $market2) {
                $market2 = $market1 - $money;
            }
        } else {
            if (!empty($money)) {
                if ($money >= $market1) {
                    $arrs = array('code' => 400);
                    return $arrs;
                    exit;
                }
                //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
                if (($market1 - $money) < $market2) {
                    $market2 = $market1 - $money;
                }
            }
            // if($money>=$market1){
            //   $arrs=array('code'=>400);
            //   return $arrs;
            //   exit;
            // }
            // //该号码的上限减去总下注金额小于 单注金额 那么可下值就是该号码剩下金额
            //   if(($market1-$money)<$market2){
            //       $market2=$market1-$money;
            //   }
            
        }
        $arr = array('code' => 200, $loss2, $market1, $market2, $market3, $loss3, $num); //赔率，每码上限，单注上限，会员回水,号码
        return $arr;
    }
    //下注
    public function xiazhu() {
        $xiazhu = I('post.action');
        if ($xiazhu != 'xiazhu') {
            echo -2; //方法提交
            exit();
        }
        $qishu = session('qishu');
        $status = mStatus1();
        if ($status[0] != 1) {
            echo -19; //管理员已关闭下注功能！
            exit();
        }
        $sendqz = I('post.sendqz'); //全转
        $number = I('post.number');
        $money = I('post.money');
        $limit = I('post.limit');
        $zhuan24 = I('post.zhuan24');
//        var_dump($number);
//        var_dump($limit);
//        var_dump($money);
//        exit;
        //$limit=I('post.limit');
        if (empty($number) || empty($money)) {
            echo -2; //方法提交
            exit();
        }
        if ($money > $limit) {
            echo -3; //下注金额超过上限！
            exit();
        }
        $uid = session('userid');
        $username = session('unames');
        $num = $number;
        $sizixian = I('post.sizixian');
        $moneys = user(); //当前用户的积分
        if ($money > $moneys) { //下注积分大于
            echo -4;
            exit();
        }
        //判断并得到改号码类型
        $data = $this->haoma($num, $sizixian); //0(数字)类型1类型2号码
        //echo($data[0]);exit;
        if ($data['code'] == 400) {
            echo -2;
            exit;
        }
        //会员赔率和股东原始赔率
        $where2['uid'] = $uid;
        $loss = M('uloss')->where($where2)->find();
        $where4['qishu'] = $qishu;
        $datas = M('opentime')->field('m_odds,fengpan,m_status,m_loss,m_sales,2ding_xiane,3ding_xiane,4ding_xiane,2xian_xiane,3xian_xiane,4xian_xiane')->where($where4)->order('id desc')->find();
        if (empty($datas) || $datas['m_status'] != 1) {
            echo -2;
            exit;
        } //|| time()>strtotime($datas['fengpan'])
        // echo $sendqz;
        // echo $data[3];exit;
        $did = date("YmdHis") . mt_rand("1000", "9999");
        if ($sendqz == 1 && $data[3] == '4定') { //得到全转号码
            $haoma1 = substr($data[2], 0, 1);
            $haoma2 = substr($data[2], 1, 1);
            $haoma3 = substr($data[2], 2, 1);
            $haoma4 = substr($data[2], 3, 1);
            //得到全转号码
            $arr = array($haoma1, $haoma2, $haoma3, $haoma4);
            //$count=0;
            for ($a = 0;$a < 4;++$a) {
                $i = $arr[$a];
                for ($b = 0;$b < 4;++$b) {
                    $j = $arr[$b];
                    for ($c = 0;$c < 4;++$c) {
                        $k = $arr[$c];
                        for ($d = 0;$d < 4;++$d) {
                            $l = $arr[$d];
                            if ($i != $j && $i != $k && $i != $l && $j != $k && $j != $l && $k != $l) {
                                //$count++;
                                $haomaArrs.= $i . $j . $k . $l . ',';
                                $haomaArrs1[] = $i . $j . $k . $l;
                                // if($count%6==0){
                                //  print_r("\n");
                                // }
                                
                            }
                        }
                    }
                }
            }
            if ($money * count($haomaArrs1) > $moneys) { //下注积分大于
                echo -4;
                exit();
            }
            // echo $haomaArrs;
            // var_dump($haomaArrs1);exit;
            //判断改号码是否禁止购买
      
            //if(empty($sendqz)){//全转时不判断该号码是否禁止下注
                $where['qishu'] = $qishu;
                $where['p_type'] = $data[0];
                $where['name'] = array('in', $haomaArrs);
                $prohibit = M('prohibit')->field('name')->where($where)->select();
                if (!empty($prohibit)) {
                    foreach ($prohibit as $k1 => $v1) {
                        if ($v1['name']) {
                            $prohibits[] = $v1['name'];
                        }
                    }
                }
           // }
          
            //得到这期该号码购买情况
            $where1['qishu'] = $qishu;
            $where1['mingxi_1'] = $data[3];
            $where1['mingxi_2'] = array('in', $haomaArrs);
            $where1['js'] = '0';
            $bet1 = M('bet');
            $bets = $bet1->field('mingxi_2,sum(money) as moneys')->where($where1)->group('mingxi_2')->select();
            //得到改号码股东是否修改赔率和销售上限
            $where3['qishu'] = $qishu;
            $where3['name'] = array('in', $haomaArrs);
            $where3['type'] = $data[0];
            $markets = M('markets')->field('name,markets,loss')->where($where3)->select();
            //dump($markets);exit;

            $types = 4;
            //dump($markets);exit;
            //dump($prohibit);exit;
            // $arrs=$this->haomas($datas,$data[0],$v='1234',$markets,$bets,$data[3],$types,$prohibits);
            // dump($arrs);exit;
            //得到上级代理是否配置拦货
            //1.拦货金额、2.占成、3.回水、
            $topUid = M('user')->field('top_uid')->where(array('uid' => $uid))->find();
            if ($topUid) {
                $ubets = M('ubet')->where(array('au_id' => $topUid['top_uid']))->find();
                // $t1 = '4定';
                // $toparr = $this->uprocess($ubets, $t1, $money); //数组0 拦货金额 1占成
                // $data1['topmoney'] = $toparr[0]; //拦货金额
                // $data1['topzanc'] = $toparr[1]; //代理占成
                // $data1['topwin'] = 0;
            }
             //  foreach ($haomaArrs1 as $k => $v) {
             //    $arrs[] = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibits);
             //  //$arrs[]=$this->haomas1($datas,$loss,$data[0],$v,$markets,$bets,$data[3],$types,$prohibits);
             // }
             // dump($arrs);exit;
            $t1 = '4定';
            $data1['topmoney'] = 0; //拦货金额
            $data1['topzanc'] = 0; //代理占成
            $data1['topwin'] = 0;
            foreach ($haomaArrs1 as $k => $v) {
                if ($ubets) {
                    $toparr = $this->uprocess($ubets, $t1, $money,$v); //数组0 拦货金额 1占成
                    $data1['topmoney'] = $toparr[0]; //拦货金额
                    $data1['topzanc'] = $toparr[1]; //代理占成
                    //$data1['topwin'] = 0;
                }
                $data1['did'] = $did;
                $data1['mingxi_1'] = $data[3];
                $data1['mingxi_3'] = $data[4];
                $data1['types'] = '4定';
                $data1['mingxi_2'] = $v;
                $data1['uid'] = $uid;
                $data1['username'] = $username;
                $data1['addtime'] = time();
                $data1['qishu'] = $qishu;
                $data1['money'] = $money;
                $data1['js'] = 0;
                $data1['index_id'] = 2;
                $user = M('user')->where($uid)->find();
                $top_dl['au_id']=$user['top_uid'];
                $user_dl = M('admin')->where($top_dl)->find();
                $top_zd['au_id']=$user_dl['top_uid'];
                $user_zd = M('admin')->where($top_zd)->find();
                $arrs = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibits);
                //总代理赔率
                $datas['m_loss']=$user_zd['m_loss'];
                $arrs_zd = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibit);
                //代理赔率
                $datas['m_loss']=$user_dl['m_loss'];
                $arrs_dl = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibit);
                //会员赔率
                $datas['m_loss']=$user['m_loss'];
                $arrs_hui = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibit);
                //会员下级赔率
                $datas['m_loss']=$user['loss'];
                $arrs_huiyuan = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibit);
                $arrs[]=$arrs_zd[0];
                $arrs[]=$arrs_dl[0];
                $arrs[]=$arrs_hui[0];
                $arrs[]=$arrs_huiyuan[0];
//                if (empty($loss) || empty($loss['loss'])) { //用户配置为空-->走股东
//                    $arrs = $this->haomas($datas, $data[0], $v, $markets, $bets, $data[3], $types, $prohibits);
//                } else { //赔率，每码上限，单注上限，会员回水,号码
//                    $arrs = $this->haomas1($datas, $loss, $data[0], $v, $markets, $bets, $data[3], $types, $prohibits);
//                }

                if ($arrs['code'] != 400) {
                    $data1['js'] = 0;
                    $moneys1+= $money;
                    $data1['odds'] = $arrs[9];
                    $data1['odds_zd'] = $arrs[6];
                    $data1['odds_dl'] = $arrs[7];
                    $data1['odds_hy'] = $arrs[8];
                    $data1['loss'] = $arrs[4];
                    $data1['win'] = $money * $arrs[4];
                    $data1['topwin'] = $arrs[4] * $data1['topmoney']; //拦货回水

                    //$data1['topzanc'] = $toparr[1];
                } else {
                    $data1['js'] = 4;
                    $data1['odds'] = 0;
                    $data1['odds_zd'] = 0;
                    $data1['odds_dl'] = 0;
                    $data1['odds_hy'] = 0;
                    $data1['loss'] = 0;
                    $data1['win'] = 0;
                    $data1['topwin'] = 0;
                }
                $dds = $bet1->add($data1); //插入k_bet
                
            }
            if (!empty($moneys1)) {
                //k_user扣钱
                //$umoney=user();
                $where4['uid'] = $uid;
                $udata['money'] = $moneys - $moneys1;
                $dd = M('user')->where($where4)->save($udata);
                //echo 6;exit;
                
            }
            echo 6;
            exit;
        } else {
            //判断改号码是否禁止购买
            echo 2;
            $where['qishu'] = $qishu;
            $where['p_type'] = $data[0];
            $where['name'] = $data[2];
            $prohibit = M('prohibit')->field('p_id')->where($where)->find();
            //dump($prohibit);exit;
            if (!empty($prohibit)) {
                echo -6; //该号码禁止销售
                exit;
            }
            //得到这期该号码购买情况
            $where1['qishu'] = $qishu;
            $where1['mingxi_1'] = $data[3];
            $where1['mingxi_2'] = $data[2];
            $where1['js'] = '0';
            $bets = M('bet')->field('money')->where($where1)->sum('money');
            // echo json_encode($where2);exit;
            // var_dump($datas);
            // var_dump($bets);exit;
            //得到改号码股东是否修改赔率和销售上限
            $where3['qishu'] = $qishu;
            $where3['name'] = $data[2];
            $where3['type'] = $data[0];
            $markets = M('markets')->field('markets,loss')->where($where3)->find();
            $user = M('user')->where($uid)->find();
            $top_dl['au_id']=$user['top_uid'];
            $user_dl = M('admin')->where($top_dl)->find();
            $top_zd['au_id']=$user_dl['top_uid'];
            $user_zd = M('admin')->where($top_zd)->find();
            $arrs = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);

            //总代理赔率
            $datas['m_loss']=$user_zd['m_loss'];
            $arrs_zd = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);
            //代理赔率
            $datas['m_loss']=$user_dl['m_loss'];
            $arrs_dl = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);
            //会员赔率
            $datas['m_loss']=$user['m_loss'];
            $arrs_hui = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);
            //会员下级赔率
            $datas['m_loss']=$user['loss'];
            $arrs_huiyuan = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);
            $arrs[]=$arrs_zd[0];
            $arrs[]=$arrs_dl[0];
            $arrs[]=$arrs_hui[0];
            $arrs[]=$arrs_huiyuan[0];
//            if (empty($loss) || empty($loss['loss'])) { //用户配置为空-->走股东
//                $arrs = $this->haomas($datas, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);
//            } else { //赔率，每码上限，单注上限，会员回水,号码
//                $arrs = $this->haomas1($datas, $loss, $data[0], $data[2], $markets, $bets, $data[3], $types, $prohibit);
//            }
            if ($arrs['code'] == 400) {
                echo -6;
                exit;
            }
            //返回 赔率，每码上限，单注上限，最小下注上限，会员回水,号码
            //$moneys=$money;
            if ($money < $arrs[3]) {
                echo -31;
                exit;
            }
            //得到上级代理是否配置拦货
            //1.拦货金额、2.占成、3.回水、
            $topUid = M('user')->field('top_uid')->where(array('uid' => $uid))->find();
            if ($topUid) {
                $ubets = M('ubet')->where(array('au_id' => $topUid['top_uid']))->find();
                $t1 = $data[3];
                $toparr = $this->uprocess($ubets, $t1, $money,$data[2]); //数组0 拦货金额 1占成
                $bet['topmoney'] = $toparr[0]; //拦货金额
                $bet['topzanc'] = $toparr[1]; //代理占成
                $bet['topwin'] = $arrs[4] * $toparr[0];
            }
            $bet['uid'] = $uid;
            $bet['username'] = $username;
            $bet['did'] = $did;
            $bet['addtime'] = time();
            $bet['qishu'] = $qishu;
            $bet['money'] = $money;
            $bet['js'] = 0;
            $bet['index_id'] = 2;
            $bet['mingxi_1'] = $data[3];
            $bet['mingxi_2'] = $data[2];
            $bet['mingxi_3'] = $data[4];
            $bet['types'] = $data[1];
            $bet['odds'] = $arrs[9];
            $bet['odds_zd'] = $arrs[6];
            $bet['odds_dl'] = $arrs[7];
            $bet['odds_hy'] = $arrs[8];
            $bet['loss'] = $arrs[4];
            $bet['win'] = $money * $arrs[4];
            $bet['assets'] = $moneys;
	        $bet['type'] = '';
            //下注添加操作
            $dd = M('bet')->add($bet);
            if (!empty($dd)) {
                //k_user扣钱
                $where5['uid'] = $uid;
                $data1['money'] = $moneys - $money;
                $dd = M('user')->where($where5)->save($data1);
                //echo 6;exit;
                
            }
        }
        echo 6;
        exit;
    }
    //下注代理拦货数据汇总
    private function uprocess($data,$typs,$money,$haoma) {
        $arr[0] = 0;
        $arr[1] = 0;
        $arr[2] = 0;
		//return $arr;exit;
        if ($data) {
            $uid=session('userid');
			$user = M('user');
			$topUid = $user->field('top_uid')->where(array('uid' => $uid))->find();
			if($topUid){
				$uarr=$user->where(array('top_uid' => $topUid['top_uid']))->select();
				foreach($uarr as $k=>$v){
				 $uids.=$v['uid'].',';
				}
				$where['uid']=array('in',rtrim($uids, ','));
			
			
            $where['mingxi_1']=$typs;
            $where['mingxi_2']=$haoma;
			$where['qishu'] = session('qishu');
            $where['js']=0;
            $sums=M('bet')->where($where)->sum('topmoney');
		}else{
			return $arr;exit;
		}
            if ($data['percent'] >= 1) {
                if ($data['ding21'] >= 1 && $typs == '2定') {
                    $moneys = $money * ($data['percent'] / 100);
   
                    if(empty($sums)){
                        if ($moneys > $data['ding21']) {
                            $lmoney = $data['ding21']; //拦货金额
                        } else {
                            $lmoney = $moneys; //拦货金额
                        }
                    }else{
						$lmoneys = $data['ding21']-$sums; //剩余
					
                        if ($moneys  && $sums<$data['ding21']) {
							if ($lmoneys<$data['ding21'] && $moneys<=$lmoneys) {
								$lmoney = $moneys; //拦货金额
							}elseif($lmoneys<$data['ding21'] && $moneys>$lmoneys){
								$lmoney =$lmoneys;
							}
                        }      
                    }
                } elseif ($data['ding31'] >= 1 && $typs == '3定') {
                    $moneys = $money * ($data['percent'] / 100);
                    
                    if(empty($sums)){
                        if ($moneys > $data['ding31']) {
                            $lmoney = $data['ding31']; //拦货金额
                        } else {
                            $lmoney = $moneys; //拦货金额
                        }
                    }else{
                        $lmoneys = $data['ding31']-$sums; //剩余
					
                        if ($moneys  && $sums<$data['ding31']) {
							if ($lmoneys<$data['ding31'] && $moneys<=$lmoneys) {
								$lmoney = $moneys; //拦货金额
							}elseif($lmoneys<$data['ding31'] && $moneys>$lmoneys){
								$lmoney =$lmoneys;
							}
                        }       
                    }
                } elseif ($data['ding41'] >= 1 && $typs == '4定') {
                    $moneys = $money * ($data['percent'] / 100);
                    
                    if(empty($sums)){
                        if ($moneys > $data['ding41']) {
                            $lmoney = $data['ding41']; //拦货金额
                        } else {
                            $lmoney = $moneys; //拦货金额
                        }
                    }else{
                        $lmoneys = $data['ding41']-$sums; //剩余
					
                        if ($moneys  && $sums<$data['ding41']) {
							if ($lmoneys<$data['ding41'] && $moneys<=$lmoneys) {
								$lmoney = $moneys; //拦货金额
							}elseif($lmoneys<$data['ding41'] && $moneys>$lmoneys){
								$lmoney =$lmoneys;
							}
                        }      
                    }
                } elseif ($data['xian21'] >= 1 && $typs == '2现') {
                    $moneys = $money * ($data['percent'] / 100);
                    
                    if(empty($sums)){
                        if ($moneys > $data['xian21']) {
                            $lmoney = $data['xian21']; //拦货金额
                        } else {
                            $lmoney = $moneys; //拦货金额
                        }
                    }else{
                        $lmoneys = $data['xian21']-$sums; //剩余
					
                        if ($moneys  && $sums<$data['xian21']) {
							if ($lmoneys<$data['xian21'] && $moneys<=$lmoneys) {
								$lmoney = $moneys; //拦货金额
							}elseif($lmoneys<$data['xian21'] && $moneys>$lmoneys){
								$lmoney =$lmoneys;
							}
                        }      
                    }
                } elseif ($data['xian31'] >= 1 && $typs == '3现') {
                    $moneys = $money * ($data['percent'] / 100);
                    
                    if(empty($sums)){
                        if ($moneys > $data['xian31']) {
                            $lmoney = $data['xian31']; //拦货金额
                        } else {
                            $lmoney = $moneys; //拦货金额
                        }
                    }else{
                        $lmoneys = $data['xian31']-$sums; //剩余
					
                        if ($moneys  && $sums<$data['xian31']) {
							if ($lmoneys<$data['xian31'] && $moneys<=$lmoneys) {
								$lmoney = $moneys; //拦货金额
							}elseif($lmoneys<$data['xian31'] && $moneys>$lmoneys){
								$lmoney =$lmoneys;
							}
                        }       
                    }
                } elseif ($data['xian41'] >= 1 && $typs == '4现') {
                    $moneys = $money * ($data['percent'] / 100);
                    
                    if(empty($sums)){
                        if ($moneys > $data['xian41']) {
                            $lmoney = $data['xian41']; //拦货金额
                        } else {
                            $lmoney = $moneys; //拦货金额
                        }
                    }else{
                        $lmoneys = $data['xian41']-$sums; //剩余
					
                        if ($moneys  && $sums<$data['xian41']) {
							if ($lmoneys<$data['xian41'] && $moneys<=$lmoneys) {
								$lmoney = $moneys; //拦货金额
							}elseif($lmoneys<$data['xian41'] && $moneys>$lmoneys){
								$lmoney =$lmoneys;
							}
                        }     
                    }
                }
            }
            $arr[0] = $lmoney;
            $arr[1] = $data['percent'];
            $arr[2] = $money - $lmoney;
        } else {
            $arr[0] = 0;
            $arr[1] = 0;
            $arr[2] = 0;
        }
        return $arr; //0拦货金额，1占成
        
    }



    private function unm1($num) {
        $haoma1 = substr($num, 0, 1);
        $haoma2 = substr($num, 1, 1);
        $haoma3 = substr($num, 2, 1);
        $haoma4 = substr($num, 3, 1);
        //if($len==2){//赔率类型判断--6种
        if ($haoma1 == 'X' && $haoma2 == 'X') {
            $type = 'XX口口';
        } elseif ($haoma3 == 'X' && $haoma4 == 'X') {
            $type = '口口XX';
        } elseif ($haoma1 == 'X' && $haoma4 == 'X') {
            $type = 'X口口X';
        } elseif ($haoma2 == 'X' && $haoma3 == 'X') {
            $type = '口XX口';
        } elseif ($haoma2 == 'X' && $haoma4 == 'X') {
            $type = '口X口X';
        } elseif ($haoma1 == 'X' && $haoma3 == 'X') {
            $type = 'X口X口';
        }
        //}
        return $type;
    }
    //下注_二定模式二
    public function xiazhu_erding() {
        //判断是否停止下注
        //判断参数来源
        //下注金额的上限和下限
        // if(empty($_POST['haoma'])  || empty($_POST['money']) || empty($_POST['action'])){
        //     echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
        // }
        $status = mStatus1();
        if ($status[0] != 1) {
            echo -19; //管理员已关闭下注功能！
            exit();
        }
        $uid = session('userid');
        $uname = session('unames');
        $qishu = session('qishu');
        $money = I('post.money');
        $haoma = I('post.haoma'); //下注号码
        $moneys2 = I('post.moneys');
        $moneys1 = user();
        if ($moneys2 > $moneys1) {
            echo -4;
            exit;
        }
        $did = date("YmdHis") . mt_rand("1000", "9999");
        $bet['uid'] = $uid;
        $bet['username'] = $uname;
        $bet['did'] = $did;
        $bet['addtime'] = time();
        $bet['qishu'] = $qishu;
        $bet['money'] = $money;
        $bet['js'] = 0;
        $bet['index_id'] = 2;
        $bet['mingxi_3'] = '定'; //类型
        $bet['mingxi_1'] = '2定'; //类型
        $weishu = 2;
         $t1 = '2定';
        //得到用户下的赔率配置
        $where['uid'] = $uid;
        $data = M('uloss')->where($where)->find(); //用户赔率
        $where1['qishu'] = $qishu;
        $data1 = M('opentime')->field('m_odds,m_status,fengpan,m_loss,m_sales,2ding_xiane')->where($where1)->order('id desc')->find(); //原始赔率
        if ($data1['2ding_xiane'] != 1 || empty($data1) || $data1['m_status'] != 1 || time() > strtotime($data1['fengpan'])) {
            echo -7;
            exit;
        }
        $bets = M('bet');
        $prohibits = M('prohibit');
        $markets1 = M('markets');
        //得到上级代理是否配置拦货
        //1.拦货金额、2.占成、3.回水、
        $topUid = M('user')->field('top_uid')->where(array('uid' => $uid))->find();
        if ($topUid) {
            $ubets = M('ubet')->where(array('au_id' => $topUid['top_uid']))->find();
            $t1 = '2定';
            // $toparr = $this->uprocess($ubets, $t1, $money,$haoma); //数组0 拦货金额 1占成
            // $bet['topmoney'] = $toparr[0]; //拦货金额
            // $bet['topzanc'] = $toparr[1]; //代理占成
            // $bet['topwin'] = 0;
        }
        $user = M('user')->where($uid)->find();
        $top_dl['au_id']=$user['top_uid'];
        $user_dl = M('admin')->where($top_dl)->find();
        $top_zd['au_id']=$user_dl['top_uid'];
        $user_zd = M('admin')->where($top_zd)->find();
        //$moneys1=user();//当前用户的积分
        if (strlen($haoma) == 4) {
            if ($topUid) {
                $toparr = $this->uprocess($ubets, $t1, $money,$haoma); //数组0 拦货金额 1占成
                $bet['topmoney'] = $toparr[0]; //拦货金额
                $bet['topzanc'] = $toparr[1]; //代理占成
                //$bet['topwin'] = $odds[1] * $toparr[0];
            }
            //$sum1=1;
            $bet['mingxi_2'] = $haoma;
            $bet['types'] = $this->unm1($haoma);
            $data1['m_loss']=$user['loss'];
            $odds = get_odd3($haoma, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
            $data1['m_loss']=$user_zd['m_loss'];
            $odds_zd = get_odd3($haoma, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
            $data1['m_loss']=$user_dl['m_loss'];
            $odds_dl = get_odd3($haoma, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
            $data1['m_loss']=$user['m_loss'];
            $odds_hy = get_odd3($haoma, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
            // var_dump($odds);
            // var_dump($weishu);
            if ($odds['code'] != 400 && $money <= $odds[2] && $money >= $odds[3]) {
                if ($money > $moneys1) { //下注积分大于
                    $bet['js'] = 4;
                    $bet['odds'] = 0;
                    $bet['loss'] = 0;
                    $bet['win'] = 0;
                } else {
                    $bet['odds'] = $odds[0];
                    $bet['odds_zd'] = $odds_zd[0];
                    $bet['odds_dl'] = $odds_dl[0];
                    $bet['odds_hy'] = $odds_hy[0];
                    $bet['loss'] = $odds[1];
                    $bet['win'] = $money * $odds[1];
                    $bet['topwin'] = $odds[1] * $toparr[0];
                    $moneys+= $money;
                }
            } else {
                $bet['js'] = 4;
                $bet['odds'] = 0;
                $bet['odds_zd'] = 0;
                $bet['odds_dl'] = 0;
                $bet['odds_hy'] = 0;
                $bet['loss'] = 0;
                $bet['win'] = 0;
            }
            $dd = $bets->add($bet); //插入k_bet
            
        } elseif (strlen($haoma) > 4) {
            for ($i = 0;$i < strlen($haoma);$i++) {
                if ($cc = substr($haoma, $i * 4, 4)) {
                    $bet['mingxi_2'] = $cc;
                    $bet['types'] = $this->unm1($cc);
                    if($topUid){
                        $toparr = $this->uprocess($ubets, $t1, $money,$cc); //数组0 拦货金额 1占成
                        $bet['topmoney'] = $toparr[0]; //拦货金额
                        $bet['topzanc'] = $toparr[1]; //代理占成
                        $bet['topwin'] = 0;
                    }
                    //分别查赔率
                    $data1['m_loss']=$user['loss'];
                    $odds = get_odd3($cc, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    $data1['m_loss']=$user_zd['m_loss'];
                    $odds_zd = get_odd3($cc, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    $data1['m_loss']=$user_dl['m_loss'];
                    $odds_dl = get_odd3($cc, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    $data1['m_loss']=$user['m_loss'];
                    $odds_hy = get_odd3($cc, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    //$datas[]=$odds;
                    if ($odds['code'] != 400 && $money <= $odds[2] && $money >= $odds[3]) {
                        $bet['js'] = 0;
                        $bet['odds'] = $odds[0];
                        $bet['odds_zd'] = $odds_zd[0];
                        $bet['odds_dl'] = $odds_dl[0];
                        $bet['odds_hy'] = $odds_hy[0];
                        $bet['loss'] = $odds[1];
                        $bet['win'] = $money * $odds[1];
                        $bet['topwin'] = $odds[1] * $toparr[0];
                        $moneys+= $money;
                    } else {
                        $bet['js'] = 4;
                        $bet['odds'] = 0;
                        $bet['odds_zd'] = 0;
                        $bet['odds_dl'] = 0;
                        $bet['odds_hy'] = 0;
                        $bet['loss'] = 0;
                        $bet['win'] = 0;
                    }
		            $bet['type'] = '';
                    $dd = $bets->add($bet); //插入k_bet
                    $odds = '';
                }
            }
        }
        //var_dump($datas);exit;
        //k_user扣钱
        // $moneys=$sum1*$money;
        if (!empty($moneys)) {
            $umoney = user();
            //k_user扣钱
            $where4['uid'] = $uid;
            $udata['money'] = $umoney - $moneys;
            $dd = M('user')->where($where4)->save($udata);
            //echo 6;exit;
            
        }
        // $res = $betmodel->setTable('k_user')->where("uid = '".$uid."'")->update('money =  money -'.$moneys);
        echo 6;
    }
    //下注_二定模式一
    public function xiazhu_erding1() {
        //判断是否停止下注
        //判断参数来源
        //下注金额的上限和下限
        // if(empty($_POST['haoma'])  || empty($_POST['money']) || empty($_POST['action'])){
        //     echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
        // }
        $status = mStatus1();
        if ($status[0] != 1) {
            echo -19; //管理员已关闭下注功能！
            exit();
        }
        $uid = session('userid');
        $uname = session('unames');
        $qishu = session('qishu');
        $haoma = I('post.haoma'); //下注号码
        $moneys2 = I('post.moneys');
        $moneys1 = user();
        if ($moneys2 > $moneys1) {
            echo -4;
            exit;
        }
        $did = date("YmdHis") . mt_rand("1000", "9999");
        $bet['uid'] = $uid;
        $bet['username'] = $uname;
        $bet['did'] = $did;
        $bet['addtime'] = time();
        $bet['qishu'] = $qishu;
        $bet['js'] = 0;
        $bet['index_id'] = 2;
        $bet['mingxi_3'] = '定'; //类型
        $bet['mingxi_1'] = '2定'; //类型
        $weishu = 2;
         $t1 = '2定';
        //得到用户下的赔率配置
        $where['uid'] = $uid;
        $data = M('uloss')->where($where)->find(); //用户赔率
        $where1['qishu'] = $qishu;
        $data1 = M('opentime')->field('m_odds,m_status,fengpan,m_loss,m_sales,2ding_xiane')->where($where1)->find(); //原始赔率
        if ($data1['2ding_xiane'] != 1 || empty($data1) || $data1['m_status'] != 1 || time() > strtotime($data1['fengpan'])) {
            echo -7;
            exit;
        }
        // $moneys=user();
        $bets = M('bet');
        $prohibits = M('prohibit');
        $markets1 = M('markets');
        //得到上级代理是否配置拦货
        //1.拦货金额、2.占成、3.回水、
        $topUid = M('user')->field('top_uid')->where(array('uid' => $uid))->find();
        if ($topUid) {
            $ubets = M('ubet')->where(array('au_id' => $topUid['top_uid']))->find();
            $t1 = '2定';
            // $toparr = $this->uprocess($ubets, $t1, $money); //数组0 拦货金额 1占成
            // $bet['topmoney'] = $toparr[0]; //拦货金额
            // $bet['topzanc'] = $toparr[1]; //代理占成
            // $bet['topwin'] = 0;
        }
        $user = M('user')->where($uid)->find();
        $top_dl['au_id']=$user['top_uid'];
        $user_dl = M('admin')->where($top_dl)->find();
        $top_zd['au_id']=$user_dl['top_uid'];
        $user_zd = M('admin')->where($top_zd)->find();
        if (strlen($haoma) > 11) {
            $strs = explode('|', $haoma);
            for ($a = 0;$a < count($strs);$a++) {
                $strs1 = explode(',', $strs[$a]);
                if ($strs1[0] && $strs1[1]) {
                    $haoma1 = str_replace('ezdm', '', $strs1[0]); //下注号码
                    if ($topUid) {
                        $toparr = $this->uprocess($ubets, $t1, $money,$haoma1); //数组0 拦货金额 1占成
                        $bet['topmoney'] = $toparr[0]; //拦货金额
                        $bet['topzanc'] = $toparr[1]; //代理占成
                        $bet['topwin'] = 0;

                    }


                    $bet['mingxi_2'] = $haoma1;
                    $money = $strs1[1]; //下注金额
                    $bet['money'] = $money;
                    //分别查赔率
                    $data1['m_loss']=$user['loss'];
                    $odds = get_odd3($haoma1, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    $data1['m_loss']=$user_zd['m_loss'];
                    $odds_zd = get_odd3($haoma1, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    $data1['m_loss']=$user_dl['m_loss'];
                    $odds_dl = get_odd3($haoma1, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    $data1['m_loss']=$user['m_loss'];
                    $odds_hy = get_odd3($haoma1, $weishu, $bet['mingxi_3'], $data, $data1, $qishu, $prohibits, $markets1, $bets);
                    if ($odds['code'] != 400 && $money <= $odds[2] && $money >= $odds[3]) {
                        if ($money > $moneys1) { //下注积分大于
                            $bet['js'] = 4;
                            $bet['odds'] = 0;
                            $bet['odds_zd'] = 0;
                            $bet['odds_dl'] = 0;
                            $bet['odds_hy'] = 0;
                            $bet['loss'] = 0;
                            $bet['win'] = 0;
                        } else {
                            $bet['types'] = $this->unm1($haoma1);
                            $bet['odds'] = $odds[0];
                            $bet['odds_zd'] = $odds_zd[0];
                            $bet['odds_dl'] = $odds_dl[0];
                            $bet['odds_hy'] = $odds_hy[0];
                            $bet['loss'] = $odds[1];
                            $bet['win'] = $money * $odds[1];
                            $bet['topwin'] = $odds[1] * $toparr[0];
                            $moneys+= $strs1[1]; //下注总金额
                            
                        }
                    } else {
                        $bet['js'] = 4;
                        $bet['odds'] = 0;
                        $bet['loss'] = 0;
                        $bet['win'] = 0;
                    }
                    $result = $bets->add($bet); //插入k_bet
                    
                }
            }
        }
        //k_user扣钱
        if (!empty($moneys)) {
            //k_user扣钱
            $umoney = user();
            $where4['uid'] = $uid;
            $udata['money'] = $umoney - $moneys;
            $dd = M('user')->where($where4)->save($udata);
            //echo 6;exit;
            
        }
        echo 6;
    }
    //下注_快选
    public function xiazhu_kuaixuan() {
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
        $status = mStatus1();
        if ($status[0] != 1) {
            echo -19; //管理员已关闭下注功能！
            exit();
        }
        $uid = session('userid');
        $uname = session('unames');
        $qishu = session('qishu');
        $types = I('post.types');
        $money = I('post.money');
        $moneys2 = I('post.moneys');
        $haoma = I('post.haoma'); //下注号码
        $moneys1 = user();
        if ($moneys2 > $moneys1) {
            echo -4;
            exit;
        }
        $did = date("YmdHis") . mt_rand("1000", "9999");
        // $bet['uid'] = $uid;
        // $bet['username']  = $uname;
        // $bet['did'] = $did;
        // $bet['addtime'] = time();
        // $bet['qishu'] = $qishu;
        // $bet['money'] = $money;
        // $bet['js']  = 0;
        // $bet['index_id']  = 2;
        //会员赔率和股东原始赔率
        $where2['uid'] = $uid;
        $loss = M('uloss')->where($where2)->find();
        $datas = M('opentime')->field('m_odds,m_status,fengpan,m_loss,m_sales,2ding_xiane,3ding_xiane,4ding_xiane,2xian_xiane,3xian_xiane,4xian_xiane')->where('qishu = "' . $qishu . '"')->order("id DESC")->find();
        $m_sales = json_decode($datas['m_sales']); //单注上限
        switch ($types) {
            case '1':
                $mingxi_3 = '定';
                $weishu = 5;
                $mingxi_1 = '2定';
                $liexings = '2ding_xiane';
                $m_sales1 = $m_sales->ding23;
                $m_sales2 = $m_sales->ding22;
            break;
            case '2':
                $mingxi_3 = '定';
                $weishu = 6;
                $mingxi_1 = '3定';
                $liexings = '3ding_xiane';
                $m_sales1 = $m_sales->ding33;
                $m_sales2 = $m_sales->ding32;
            break;
            case '3':
                $mingxi_3 = '定';
                $weishu = 1;
                $mingxi_1 = '4定';
                $liexings = '4ding_xiane';
                $m_sales1 = $m_sales->ding43;
                $m_sales2 = $m_sales->ding42;
            break;
            case '4':
                $mingxi_3 = '现';
                $weishu = 2;
                $mingxi_1 = '2现';
                $liexings = '2xian_xiane';
                $number1 = M('number21');
                $m_sales1 = $m_sales->tong23;
                $m_sales2 = $m_sales->tong22;
            break;
            case '5':
                $mingxi_3 = '现';
                $weishu = 3;
                $mingxi_1 = '3现';
                $liexings = '3xian_xiane';
                $number1 = M('number31');
                $m_sales1 = $m_sales->tong33;
                $m_sales2 = $m_sales->tong32;
            break;
            case '6':
                $mingxi_3 = '现';
                $weishu = 4;
                $mingxi_1 = '4现';
                $liexings = '4xian_xiane';
                $number1 = M('number41');
                $m_sales1 = $m_sales->tong43;
                $m_sales2 = $m_sales->tong42;
				$xian=1;
            break;
        }

        $t1 = $mingxi_1;
        //得到上级代理是否配置拦货
        //1.拦货金额、2.占成、3.回水、
        $topUid = M('user')->field('top_uid')->where(array('uid' => $uid))->find();
        if ($topUid) {
            $ubets = M('ubet')->where(array('au_id' => $topUid['top_uid']))->find();
            $t1 = $mingxi_1;
            //$toparr = $this->uprocess($ubets, $t1, $money); //数组0 拦货金额 1占成
            // $bet['topmoney']=$toparr[0];//拦货金额
            // $bet['topzanc']=$toparr[1];//代理占成
            // $bet['topwin']  =0;
            
        }
        if (empty($datas) || $datas['' . $liexings . ''] != 1 || $datas['m_status'] != 1) {
            echo -7;
            exit;
            //echo '<script type="text/javascript">alert("下注失败！该类型号码禁止销售！");</script>';exit();
            
        }
        if ($money < $m_sales1) {
            echo -9;
            exit;
        }
        if ($money > $m_sales2) {
            echo -10;
            exit;
        }
        $data = explode(',', $haoma);
        $counts = count($data);
        if (($money * $counts) > $moneys1) {
            echo -4;
            exit;
        }
        if ($counts < 1) {
            echo -2;
            exit;
        }
		
		 //得到号码类型
        $hmlx=$this->haoma($data[0],$xian);
        if($mingxi_1=='2定' && $hmlx[3]!='2定'){
            echo -2;
            exit;
        }elseif($mingxi_1=='3定' && $hmlx[3]!='3定'){
            echo -2;
            exit;
        }elseif($mingxi_1=='4定' && $hmlx[3]!='4定'){
            echo -2;
            exit;
        }elseif($mingxi_1=='2现' && $hmlx[3]!='2现'){
            echo -2;
            exit;
        }elseif($mingxi_1=='3现' && $hmlx[3]!='3现'){
            echo -2;
            exit;
        }elseif($mingxi_1=='4现' && $hmlx[3]!='4现'){
            echo -2;
            exit;
        }
		
		
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
        // dump($mingxi_1);exit;
        //$prohibits=M('prohibit');
        //判断改号码是否禁止购买
        $where['qishu'] = $qishu;
        $where['p_type'] = $weishu;
        $prohibit = M('prohibit')->field('name')->where($where)->select();
        if (!empty($prohibit)) {
            foreach ($prohibit as $k1 => $v1) {
                if ($v1['name']) {
                    $prohibits[] = $v1['name'];
                }
            }
        }
        $bets = M('bet');
        //下注金额汇总
        $where5['qishu'] = $qishu;
        $where5['mingxi_1'] = $mingxi_1;
        $where5['js'] = '0';
        $bets1 = $bets->field('mingxi_2,sum(money) as moneys')->where($where5)->group('mingxi_2')->select();
        //得到改号码股东是否修改赔率和销售上限
        $where2['qishu'] = $qishu;
        //$where2['name']=$num;
        $where2['type'] = $weishu;
        $markets1 = M('markets')->field('name,markets,loss')->where($where2)->select();
        //dump($markets1);exit;
        //得到该号码类型
        if ($weishu == 2 || $weishu == 3 || $weishu == 4) {
            // $where3['numbers']=$num;
            $where3['type'] = $weishu;
            $numbers = $number1->field('types,numbers')->where($where3)->select();
        }
          //$arrs=$this->haomas3($datas,$weishu,$data[0],$mingxi_1,$loss,$prohibits,$bets1,$markets1,$numbers);
         //dump($arrs);exit;
        // $bet1=M('bet');
        //$markets1=M('markets');
        //set_time_limit(0);
        //$numbers=M('number');
         foreach ($data as $k => $v) {
            if ($ubets) {
                $toparr = $this->uprocess($ubets, $t1, $money,$v);//数组0 拦货金额 1占成
                $bet[$k]['topmoney'] = $toparr[0]; //拦货金额
                $bet[$k]['topzanc'] = $toparr[1]; //代理占成
                $bet[$k]['topwin'] = 0;
            }
            // $bet[$k]['topmoney'] = $toparr[0]; //拦货金额
            // $bet[$k]['topzanc'] = $toparr[1]; //代理占成
            // $bet['mingxi_1']=$mingxi_1;
            // $bet['mingxi_3']=$mingxi_3;
            // $bet['types']=$this->unm2($v,$mingxi_1);
            // $bet['mingxi_2'] = $v;
            $bet[$k]['mingxi_1'] = $mingxi_1;
            $bet[$k]['mingxi_3'] = $mingxi_3;
            $bet[$k]['types'] = $this->unm2($v, $mingxi_1);
            $bet[$k]['mingxi_2'] = $v;
             $user = M('user')->where($uid)->find();
             $top_dl['au_id']=$user['top_uid'];
             $user_dl = M('admin')->where($top_dl)->find();
             $top_zd['au_id']=$user_dl['top_uid'];
             $user_zd = M('admin')->where($top_zd)->find();
             $datas['m_loss']=$user['loss'];
             $arrs = $this->haomas2($datas, $weishu, $v, $mingxi_1, $prohibits, $bets1, $markets1, $numbers);
             $datas['m_loss']=$user_zd['m_loss'];
             $arrs_zd = $this->haomas2($datas, $weishu, $v, $mingxi_1, $prohibits, $bets1, $markets1, $numbers);
             $datas['m_loss']=$user_dl['m_loss'];
             $arrs_dl = $this->haomas2($datas, $weishu, $v, $mingxi_1, $prohibits, $bets1, $markets1, $numbers);
             $datas['m_loss']=$user['m_loss'];
             $arrs_hy = $this->haomas2($datas, $weishu, $v, $mingxi_1, $prohibits, $bets1, $markets1, $numbers);
//            if (empty($loss) || empty($loss['loss'])) { //用户配置为空-->走股东
//                $arrs = $this->haomas2($datas, $weishu, $v, $mingxi_1, $prohibits, $bets1, $markets1, $numbers);
//                var_dump($arrs);exit;
//            } else { //赔率，每码上限，单注上限，会员回水,号码
//                $arrs = $this->haomas3($datas, $weishu, $v, $mingxi_1, $loss, $prohibits, $bets1, $markets1, $numbers);
//            }
            $bet[$k]['uid'] = $uid;
            $bet[$k]['username'] = $uname;
            $bet[$k]['did'] = $did;
            $bet[$k]['addtime'] = time();
            $bet[$k]['qishu'] = $qishu;
            $bet[$k]['money'] = $money;
            $bet[$k]['js'] = 0;
            $bet[$k]['index_id'] = 2;
            if ($arrs['code'] != 400 && $money <= $arrs[1] && $money >= $arrs[3]) {
                // if($money > $moneys1){
                //   $bet['js'] = 4;
                //   $bet['odds'] =1;
                //   $bet['loss'] = 1;
                //   $bet['win']  =1;
                // }else{
                //}
                // $bet['js'] = 0;
                // $moneys+=$money;
                // $bet['odds'] =$arrs[0];
                // $bet['loss'] = $arrs[4];
                // $bet['win']  =$money * $arrs[4];
                $bet[$k]['js'] = 0;
                $moneys+= $money;
                $bet[$k]['odds'] = $arrs[0];
                $bet[$k]['odds_zd'] = $arrs_zd[0];
                $bet[$k]['odds_dl'] = $arrs_dl[0];
                $bet[$k]['odds_hy'] = $arrs_hy[0];
                $bet[$k]['loss'] = $arrs[4];
                $bet[$k]['win'] = $money * $arrs[4];
                $bet[$k]['topwin'] = $arrs[4] * $toparr[0];
            } else {
                //$bet['js'] = 4;
                // $bet['odds'] =0;
                // $bet['loss'] = 0;
                // $bet['win']  =0;
                $bet[$k]['js'] = 4;
                $bet[$k]['odds'] = 0;
                $bet[$k]['odds_zd'] = 0;
                $bet[$k]['odds_dl'] = 0;
                $bet[$k]['odds_hy'] = 0;
                $bet[$k]['loss'] = 0;
                $bet[$k]['win'] = 0;
                $bet[$k]['topwin'] = 0;
            }
            //$dd = $bets->add($bet);//插入k_bet
         
        }

        // var_dump($bet);exit;
        $bets->addAll($bet); //插入k_bet
        //$moneys=$sum1*$money;
        if (!empty($moneys)) {
            //k_user扣钱
            $umoney = user();
            $where4['uid'] = $uid;
            $udata['money'] = $umoney - $moneys;
            $dd = M('user')->where($where4)->save($udata);
            //echo 6;exit;
            
        }
        echo 6;
        exit;
    }
    //下注明细
    public function xiazhumingxi() {
        $qishu = I('get.qishu');
        $type1 = I('get.type1');
        $uid = session('userid');
        $where['uid'] = $uid;
        if (empty($qishu)) {
            $where['qishu'] = session('qishu');
        } else {
            $where['qishu'] = $qishu;
        }
        $haoma = I('get.haoma');
        $xian = I('get.xian');
        $type = I('get.type');
        $types = I('get.types');
        $ks1 = I('get.ks1');
        $ks2 = I('get.ks2');
        if ($type1 == 2) {
            $where['status'] = 1;
        }
        $where['js'] = array('in', '0,1,2');
        //号码搜索
        if (!empty($haoma)) {
            $where['mingxi_2'] = array('like', '%' . $haoma . '%');
        }
        if (!empty($xian) && $xian == 1) {
            $where['mingxi_3'] = '现';
        }
        if (!empty($ks1) && !empty($ks2)) {
            if ($type == '1') {
                $where['money'] = array(array('egt', ($ks1)), array('elt', ($ks2)), 'and');
            } elseif ($type == '2') {
                $where['js'] = 2;
            } else {
                $where['odds'] = array(array('egt', ($ks1)), array('elt', ($ks2)), 'and');
            }
        }
        if (!empty($types)) {
            if ($types == '1') {
                $where['types'] = array('in', '口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
            } elseif ($types == '三定位') {
                $where['types'] = array('in', '口口口X,口口X口,口X口口,X口口口');
            } elseif ($types == '四定位') {
                $where['types'] = '4定';
            } elseif ($types == '四字现') {
                $where['types'] = '4现';
            } elseif ($types == '三字现') {
                $where['types'] = '3现';
            } elseif ($types == '二字现') {
                $where['types'] = '2现';
            } else {
                $where['types'] = $types;
            }
        }
        //dump($where);exit;
        $bets = M('bet');
        $count = $bets->where($where)->count();
        $Page = new \Think\Page1($count,50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); // 分页显示输出
        $field = 'id,did,username,addtime,mingxi_1,mingxi_2,mingxi_3,odds,odds_hy,money,js,status,win';
        $data1 = $bets->field($field)->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $keren = $this->huiyuan($data1);
        if ($data1) {
            foreach ($data1 as $k => $v) {
                $v['zj'] = 0;
                $v['yingkui'] = 0;

                if ($v['status'] == 1 && $v['js'] == 0) { //中奖
                    $v['zj'] = $v['money'] * $v['odds'];
                    $v['win'] = 0;
                    $v['yingkui'] = $v['zj'] - $v['money'];
                    //$win=$v['win'];
                    
                } else {
                    $v['yingkui'] = $v['win'] - $v['money'];
                }

                //数据汇总
                // $data1['sum1']+=1;
                // $data1['zj1']+=$v['zj'];
                // $data1['money1']+=$v['money'];
                // $data1['win1']+=$win;
                // $data1['yingkui1']+=$v['yingkui'];

				$v['t_status']=1;
                if($v['addtime']+($times['m_retreat']*60) <time()){
                     $v['t_status']=2;
                }
                $data1[$k] = $v;
                $data1[$k]['addtime'] = date('Y-m-d H:i:s', $v['addtime']);
            }
            $data1[0]['wins'] = $keren;

            $data['data'] = $data1;
            $data['code'] = 200;
        } else {
            $data['code'] = 400;
        }
        $data['sum'] = $count;
        $data['show'] = $show;
        $data['qishu'] = $qishu;
        $this->ajaxReturn($data);
    }
    //历史订单
    public function getQishu() {
        $data1 = M('opentime')->field('qishu,m_status')->order('id desc')->limit(4)->select();
        if ($data1) {
            foreach ($data1 as $k => $v) {
                $qishu.= $v['qishu'] . ',';
                $datas[$v['qishu']] = $v['m_status']; //分组
                
            }
            $where2['qishu'] = array('in', rtrim($qishu, ','));
        } else {
            $where2['qishu'] = ' ';
        }
        $uid = session('userid');
        $where2['uid'] = session('userid');
        $where2['js'] = array('in', '0,1');
        $data = M('bet')->field('win,qishu,addtime,money,odds,odds_hy,status')->where($where2)->order('id desc')->select();

        if (!empty($data) && !empty($data1)) {
            if ($datas) {
                foreach ($datas as $k1 => $v1) {
                    foreach ($data as $k2 => $v2) {
                        if ($k1 == $v2['qishu']) {
                            if ($v1 == 3) {
                                $data3['status'] = 3;
                            } else {
                                $data3['status'] = 1;
                            }
                            // $money=$money+$v2['money'];
                            // $data3['money']=intval($money);
                            $data3['money']+= $v2['money'];
                            $data3['sum']+= 1;
                            $data3['md'] = date('Y-m-d', ($v2['addtime']));
                            $data3['qishu'] = $v2['qishu'];
                            $bets = M('bet');
                            $zongjilu= $bets->where(array('qishu'=>$v2['qishu'],'uid'=>$uid))->where('js<>2')->select();
                            $zonghuishui = $this->huiyuan($zongjilu);
                            $win+= $v2['win'];
                            $data3['win'] = intval($win);
                            //$data3['win']+=$v2['win'];
                            if ($v2['status'] == 1) {
                                $moneys = $moneys + $v2['money'] * $v2['odds'];
                                $data3['moneys'] = intval($moneys);
                            }
                            //盈亏
                            $data3['yingkui'] = intval($data3['moneys'] + $data3['win'] - $data3['money']);
                            $data3['win'] = $zonghuishui;
                        }
                    }
                    if ($data3) {
                        if ($v1 == 3) {
                            //每期汇总
                            $data2['sum1']+= $data3['sum']; //下注笔数
                            $data2['money1']+= $data3['money']; //金额
                            $data2['win1']+= $data3['win']; //回水
                            $data2['moneys1']+= $data3['moneys']; //中奖汇总
                            $data2['sums1']+= 1; //
                            //盈亏
                            $data2['yingkui1']+= $data3['yingkui'];
                        } else {
                            //每期汇总
                            $data2['sum1']+= 0; //下注笔数
                            $data2['money1']+= 0; //金额
                            $data2['win1']+= 0; //回水
                            $data2['moneys1']+= 0; //中奖汇总
                            $data2['sums1']+= 0; //
                            //盈亏
                            $data2['yingkui1']+= 0;
                        }
                        $data2['data'][] = $data3;
                        $money = '';
                        $moneys = '';
                        $win = '';
                        $data3 = '';
                    }
                }
                $data2['code'] = 200;
            }
        } else {
            $data2['code'] = 400;
            $data2['data'] = '';
        }
        //dump($data2);exit;
        $this->ajaxReturn($data2);
    }
    //密码修改
    public function findUser() {
        $where['uid'] = session('userid');
        $password = I('post.name');
        $data = M('user')->where($where)->find();
        if (!empty($data)) {
            if ($data['password'] == MD5(MD5($password))) {
                $status['code'] = false;
            } else {
                $status['code'] = true;
            }
        } else {
            $status['code'] = true;
        }
        $this->ajaxReturn($status);
    }
    //修改密码
    public function saveUser() {
        $where['uid'] = session('userid');
        $psw1 = I('post.newpassword');
        $psw2 = I('post.newpassword2');
        if ($psw1 == $psw2) {
            $data['password'] = MD5(MD5($psw1));
            $dd = M('user')->where($where)->save($data);
            if (empty($dd)) {
                $status['code'] = 4001;
            } else {
                $status['code'] = 200;
                $status['urls'] = '/index.php/Login/retreats';
            }
        } else {
            $status['code'] = 4002;
        }
        $this->ajaxReturn($status);
    }
    //赔率保存
    public function user1() {
        //同时修改当前用户的赔率
        $ding41=I('post.ding41');
        $tong211=I('post.tong211');
        $tong221=I('post.tong221');
        $tong311=I('post.tong311');
        $tong321=I('post.tong321');
        $tong331=I('post.tong331');
        $tong411=I('post.tong411');
        $tong421=I('post.tong421');
        $tong431=I('post.tong431');
        $tong441=I('post.tong441');
        $tong451=I('post.tong451');
        $ding21=I('post.ding21');
        $ding31=I('post.ding31');

        $uid = session('userid');
        $where['uid'] = $uid;
        $user = M('user')->field('lock,m_loss')->where($where)->find();
		$about = I('post.about');
        $udata['about']=$about;
        $dd1=M('user')->where($where)->save($udata);
        $qishu=session('qishu');
        $datas=M('opentime')->where($qishu)->limit(1)->find();
        $m_loss['m_loss'] = json_decode($datas['m_loss']);
        $huiyuan = json_decode($user['m_loss']);

        //赔率 1初始赔率2赔率下降阀值3销售增量4赔率下调步长
        $loss['ding41']=$ding41;
        $loss['ding42']=$m_loss['m_loss']->ding42;
        $loss['ding43']=$m_loss['m_loss']->ding43;
        $loss['ding44']=$m_loss['m_loss']->ding44;//四定

        $loss['tong211']=$tong211;
        $loss['tong212']=$m_loss['m_loss']->tong212;
        $loss['tong213']=$m_loss['m_loss']->tong213;
        $loss['tong214']=$m_loss['m_loss']->tong214;
        $loss['tong221']=$tong211;
        $loss['tong222']=$m_loss['m_loss']->tong222;
        $loss['tong223']=$m_loss['m_loss']->tong223;
        $loss['tong224']=$m_loss['m_loss']->tong224;//二同

        $loss['tong311']=$tong311;
        $loss['tong312']=$m_loss['m_loss']->tong312;
        $loss['tong313']=$m_loss['m_loss']->tong313;
        $loss['tong314']=$m_loss['m_loss']->tong314;
        $loss['tong321']=$tong321;
        $loss['tong322']=$m_loss['m_loss']->tong322;
        $loss['tong323']=$m_loss['m_loss']->tong323;
        $loss['tong324']=$m_loss['m_loss']->tong324;
        $loss['tong331']=$tong331;
        $loss['tong332']=$m_loss['m_loss']->tong332;
        $loss['tong333']=$m_loss['m_loss']->tong333;
        $loss['tong334']=$m_loss['m_loss']->tong334;//三同

        $loss['tong411']=$tong411;
        $loss['tong412']=$m_loss['m_loss']->tong412;
        $loss['tong413']=$m_loss['m_loss']->tong413;
        $loss['tong414']=$m_loss['m_loss']->tong414;
        $loss['tong421']=$tong421;
        $loss['tong422']=$m_loss['m_loss']->tong422;
        $loss['tong423']=$m_loss['m_loss']->tong423;
        $loss['tong424']=$m_loss['m_loss']->tong424;
        $loss['tong431']=$tong431;
        $loss['tong432']=$m_loss['m_loss']->tong432;
        $loss['tong433']=$m_loss['m_loss']->tong433;
        $loss['tong434']=$m_loss['m_loss']->tong434;
        $loss['tong441']=$tong441;
        $loss['tong442']=$m_loss['m_loss']->tong442;
        $loss['tong443']=$m_loss['m_loss']->tong443;
        $loss['tong444']=$m_loss['m_loss']->tong444;
        $loss['tong451']=$tong451;
        $loss['tong452']=$m_loss['m_loss']->tong452;
        $loss['tong453']=$m_loss['m_loss']->tong453;
        $loss['tong454']=$m_loss['m_loss']->tong454;//四同

        $loss['ding21']=$ding21;
        $loss['ding22']=$m_loss['m_loss']->ding22;
        $loss['ding23']=$m_loss['m_loss']->ding23;
        $loss['ding24']=$m_loss['m_loss']->ding24;//二定
        $loss['ding31']=$ding31;
        $loss['ding32']=$m_loss['m_loss']->ding32;
        $loss['ding33']=$m_loss['m_loss']->ding33;
        $loss['ding34']=$m_loss['m_loss']->ding34;//三定
        $data_loss['loss']=json_encode($loss);

        //$users->where($uid)->save($data_loss);
        if ($user['lock'] == 2) {
            $arr['code'] = 400;
        } else {
//            $uloss = M("uloss");
//            $loss1 = $uloss->where($where)->find();
//            if (empty($loss1)) {
//                $data3['uid'] = $uid;
//                $loss2 = $uloss->add($data3);
//            } else {
//                $loss2 = $uloss->where($where)->save($data3);
//            }
            if($ding41 > $huiyuan->ding41){
                $arr['code'] = 500;
            }elseif($ding31 > $huiyuan->ding31 ){
                $arr['code'] = 500;
            }elseif($ding21 > $huiyuan->ding21 ){
                $arr['code'] = 500;
            }elseif($tong211 > $huiyuan->tong211 ){
                $arr['code'] = 500;
            }elseif($tong311 > $huiyuan->tong311 ){
                $arr['code'] = 500;
            }elseif($tong321 > $huiyuan->tong321 ){
                $arr['code'] = 500;
            }elseif($tong331 > $huiyuan->tong331 ){
                $arr['code'] = 500;
            }else{
                $users=M('user');
                $users->where($uid)->save($data_loss);
                $arr['code'] = 200;
            }
        }
		if($dd1){
			$arr['code'] = 200;
		}
        $this->ajaxReturn($arr);
    }
    //清空打印数据
    public function dataEmpty() {
        $where['uid'] = session('userid');
        $where['qishu'] = session('qishu');
        $where['js'] = 0;
        $data['index_id'] = 1;
        $dd = M('bet')->where($where)->save($data);
        echo 1;
    }
    //删除号码
    public function delHaoma() {
        $id = I('post.delid');
        $uid = session('userid');
        if ($id) {
            $ids = strtr($id, '|', ',');
            $where['id'] = array('in', $ids);
            $where['uid'] = $uid;
            $data['js'] = 5;
            $bets = M('bet');
            $dd = $bets->where($where)->save($data);
        }
        echo '111';
    }
    //删除号码
    public function delsHaoma() {
        $qishu = session('qishu');
        $uid = session('userid');
        $where['uid'] = $uid;
        $where['qishu'] = $qishu;
        $where['js'] = 5;
        $bets = M('bet');
        $data = $bets->where($where)->select();
        if ($data) {
            $data1['code'] = 200;
            $data1['data'] = $data;
        } else {
            $data1['code'] = 400;
        }
        $this->ajaxReturn($data1);
    }
    //本期停押所有的号码
    public function arrhaoma() {
        $qishu = session('qishu');
        $uid = session('userid');
        $where['uid'] = $uid;
        $where['qishu'] = $qishu;
        $where['js'] = 4;
        $bets = M('bet');
        $data = $bets->where($where)->select();
        if ($data) {
            $data1['code'] = 200;
            $data1['data'] = $data;
        } else {
            $data1['code'] = 400;
        }
        $this->ajaxReturn($data1);
    }
    //赔率页面显示
    public function findOdds() {
        $type = I('post.type');
        $where['qishu'] = session('qishu');
        if (empty($type)) {
            $where['type'] = 1;
        } else {
            $where['type'] = $type;
        }
        $data = M('markets')->field('loss,name')->where($where)->select();
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if ($v['loss']) {
                    $data1[] = $v;
                }
            }
            if (!empty($data1)) {
                foreach (array_chunk($data1, 5) as $val) {
                    $html.= '<tr>';
                    foreach ($val as $k1 => $v1) {
                        if ($k1 % 2 != 0) {
                            $html.= '<td class="fh">' . $v1['name'] . '</td><td class="fh">' . $v1['loss'] . '</td>';
                        } else {
                            $html.= '<td>' . $v1['name'] . '</td><td>' . $v1['loss'] . '</td>';
                        }
                    }
                    if (5 - count($val) != 0) {
                        for ($a = 0;$a < (5 - count($val));$a++) {
                            if ($a % 2 != 0) {
                                $html.= '<td class="fh">--</td><td class="fh">--</td>';
                            } else {
                                $html.= '<td>--</td><td>--</td>';
                            }
                        }
                    }
                    $html.= '</tr>';
                }
                $data2['code'] = 200;
                $data2['data'] = $html;
            }
        } else {
            $data2['code'] = 400;
        }
        $this->ajaxReturn($data2);
    }
    //得到当前用户状态
    public function ustatus1() {
        $t = ustatus();
        echo $t;
    }

    public function huiyuan($zongji){
        $ding4=0;
        $ding3=0;
        $ding2=0;
        $xian2=0;
        $huiyuanhuishuiding4=0;
        $huiyuanhuiding4=0;
        $huiyuanhuishuiding3=0;
        $huiyuanhuiding3=0;
        $huiyuanhuishuiding2=0;
        $huiyuanhuiding2=0;
        $huiyuanhuishuixian2=0;
        $huiyuanhuixian2=0;
        $xian3tong=0;
        $xian3shui=0;
        $xian3huishui=0;
        $xian31tong=0;
        $xian31shui=0;
        $xian31huishui=0;
        $xian32tong=0;
        $xian32shui=0;
        $xian32huishui=0;
        $zongding2112=0;
        $zongding3112=0;
        $zongding4112=0;
        $zongxian2112=0;
        $zongxian31212=0;
        $zongxian32212=0;
        $zongxian33212=0;
        foreach($zongji as $item=>$value)
        {
            if($value['mingxi_1'] == '4定' && $value['js'] !=2)
            {
                $ding4=intval($value['money']);
                $huiyuanhuishuiding4=intval($value['odds_hy']);
                $huiyuanhuiding4=intval($value['odds']);
                $zongding4112+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
            }
            else if($value['mingxi_1'] == '3定' && $value['js'] !=2)
            {
                $ding3=intval($value['money']);
                $huiyuanhuishuiding3=intval($value['odds_hy']);
                $huiyuanhuiding3=intval($value['odds']);
                $zongding3112+=$ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
            }
            else if($value['mingxi_1'] == '2定' && $value['js'] !=2)
            {
                $ding2=intval($value['money']);
                $huiyuanhuishuiding2=intval($value['odds_hy']);
                $huiyuanhuiding2=intval($value['odds']);
                $zongding2112+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
            }
            else if($value['mingxi_1'] == '2现' && $value['js'] !=2)
            {
                $xian2=intval($value['money']);
                $huiyuanhuishuixian2=intval($value['odds_hy']);
                $huiyuanhuixian2=intval($value['odds']);
                $zongxian2112+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
            }
            else if($value['mingxi_1'] == '3现' && $value['js'] !=2)
            {
                $t=array_count_values(str_split($value['mingxi_2']));
                if(max($t) == 1)
                {
                    $xian3tong=$value['money'];
                    $xian3shui=intval($value['odds']);
                    $xian3huishui=intval($value['odds_hy']);
                    $zongxian31212+=$xian3tong * ($xian3huishui - $xian3shui) * 0.02;

                }
                else if(max($t) == 2)
                {
                    $xian31tong=$value['money'];
                    $xian31shui=intval($value['odds']);
                    $xian31huishui=intval($value['odds_hy']);
                    $zongxian32212+=$xian31tong * ($xian31huishui - $xian31shui) * 0.017;


                }
                else if(max($t) == 3)
                {
                    $xian32tong=$value['money'];
                    $xian32shui=intval($value['odds']);
                    $xian32huishui=intval($value['odds_hy']);
                    $zongxian33212+=$xian32tong * ($xian32huishui - $xian32shui) * 0.014;

                }
            }
        }
        return $zonghuishui4=$zongding4112 + $zongding3112 + $zongding2112 + $zongxian2112 + $zongxian31212 + $zongxian32212 + $zongxian33212;
    }
}
