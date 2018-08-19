<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){

    
// $haoma1='11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx,11xx,22xx,33xx,44xx,55xx,66xx,77xx';
//   $did = date("YmdHis") . mt_rand("1000", "9999");
// $haoma2=explode(',',$haoma1);
// $bet['uid'] = 1;
// $bet['username']  = 'user1';
// $bet['did'] = $did;
// $bet['addtime'] = time();
// $bet['qishu'] = '88';
// $bet['money'] = 10;
// $bet['js']  = 0;
// $bet['index_id']  = 2;

// $bet['mingxi_3']='定';//类型
// $bet['mingxi_1']='2定';//类型
// echo time();
// $bets=M('bet');
// for($a=0;$a<count($haoma2);$a++){
//     // $bet[$a]['uid'] = 1;
//     // $bet[$a]['username']  = 'user1';
//     // $bet[$a]['did'] = $did;
//     // $bet[$a]['addtime'] = time();
//     // $bet[$a]['qishu'] = '88';
//     // $bet[$a]['money'] = 10;
//     // $bet[$a]['js']  = 0;
//     // $bet[$a]['index_id']  = 2;

//     // $bet[$a]['mingxi_3']='定';//类型
//     // $bet[$a]['mingxi_1']='2定';//类型
//     // //
//     //$bet['mingxi_2'] = $haoma2[$a];
    
//     // $bet[$a]['p_type'] = 5;
//     // $bet[$a]['qishu'] = '88';
//     // $bet[$a]['numbers'] = 1;
//     // $bet[$a]['p_time']  = time();
//     // $bet[$a]['name']  = $haoma2[$a];
   
//          $odds = get_odd3($haoma,5,$bet['mingxi_3'],$data,$data1,$qishu);
//             // var_dump($haoma);
//             // var_dump($weishu);
           
//             if($odds['code']!=400 && $money<=$odds[2] && $money>=$odds[3]){
//               if($money > $moneys1){//下注积分大于
//                   $bet['js'] = 4;
//                   $bet['odds'] =0;
//                   $bet['loss'] = 0;
//                   $bet['win']  =0;
//               }else{
//                 $bet['js']  = 0;
//                 $bet['odds'] = $odds[0];
//                 $bet['loss'] = $odds[1];
//                 $bet['win']  = $money * $odds[1];
//                 $moneys+=$money;
//               }
               
//             }else{
//                 $bet['js'] = 4;
//                 $bet['odds'] =0;
//                 $bet['loss'] = 0;
//                 $bet['win']  =0;
//             }
//             //   var_dump($bet);
//             // exit;
//             $dd =$bets->add($bet);//插入k_bet
    
    
// }
// echo '<br/>';

// //$dd=M('prohibit')->addAll($bet);
// //$dd=M('bet')->addAll($bet);
// echo time();
// //dump($bet);
// exit;

        //////////////
        // echo mb_substr("4179011",0,4,"UTF-8");//hp点
        // exit;
        // $arr14=123;
        // //$c14= substr($arr14,-2);
        // $c14= (substr($arr14,-1,1).'.'.substr($arr14,-2,1));
        // dump($c14);exit;
        // 赔率换算
        //  for($i=0;$i<=250;$i++){
        //     if($i<10){
        //         $g='0.00'.$i;
        //     }elseif($i>=10 && $i<=99){
        //         $g='0.0'.$i;
        //     }else{
        //        $g='0.'.$i; 
        //     }
        //     if($g=='0.000'){
        //         $g=0;
        //     }
        //    $f[]= $g; 
        // }

        // $pl=98;
        
        // for($a14=0;$a14<count($f);$a14++){
        //     $arr14=$a14;
        //     if($a14<=9){
        //         $c14=$pl-('0.'.substr($arr14,-1,1));
        //         echo $pl.'--'.('0.'.substr($arr14,-1,1));
        //     }elseif($a14>9 && $a14<=99){
        //         $c14=$pl-(substr($arr14,-2,1).'.'.substr($arr14,-1,1));
        //     }else{
        //         $c14=$pl-(substr($arr14,-3,2).'.'.substr($arr14,-1,1));
        //     }
              
        //     $d14[]=$c14; 
        // }
        //  dump($d14);exit;


        
    //得到赔率和销售数
    // $qishu=M('opentime')->field('qishu')->order('id desc')->find();
    // $where['qishu']=$qishu['qishu'];
    // //销售数
    // $market=M('market')->field('a_peryard')->where($where)->select();
    // //四定
    // $market1=$market[0]['a_peryard'];
    // //二现
    // $market2=$market[1]['a_peryard'];
    // //三现
    // $market3=$market[2]['a_peryard'];
    // //四现
    // $market4=$market[3]['a_peryard'];
    // //二定
    // $market5=$market[4]['a_peryard'];
    // //三定
    // $market6=$market[5]['a_peryard'];
    // ////赔率
    // $loss=M('loss')->field('l_initial')->where($where)->select();
    // //四定
    // $loss1=$loss[0]['l_initial'];
    // //二现
    // $loss2=$loss[1]['l_initial'];
    // $loss3=$loss[2]['l_initial'];
    // //三现
    // $loss4=$loss[3]['l_initial'];
    // $loss5=$loss[4]['l_initial'];
    // $loss6=$loss[5]['l_initial'];
    // //四现
    // $loss7=$loss[6]['l_initial'];   
    // $loss8=$loss[7]['l_initial'];   
    // $loss9=$loss[8]['l_initial'];   
    // $loss10=$loss[9]['l_initial'];   
    // $loss11=$loss[10]['l_initial'];   
    // //二定
    // $loss12=$loss[11]['l_initial'];
    // //三定
    // $loss13=$loss[12]['l_initial'];
    // //搜索条件 期数
    // //搜索条件 1.类型2.号码排序 3.号码状态 4.号码全文搜索 
    // $type=1;
    // $orders='id asc';
    // if($status){
    //     $status='';
    // }
    // if($haoma){
    //     $haoma='';
    // }
    // //分页
    // $numbers=M('number');

    // $count      = $numbers->where(array('type'=>$type))->count();

    // $Page       = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)

    // $show       = $Page->show();// 分页显示输出

    // $number=$numbers->where(array('type'=>$type))->limit($Page->firstRow.','.$Page->listRows)->order($orders)->select();



    //dump($number);
    // foreach(array_chunk($number, 5) as $val)
    // {
    //     foreach($val as $v=>$a)
    //     {
    //         echo $a['numbers'],"\t";
    //     }
    //     echo "<br/>";
    // }
// $arr = array("8", "2", "1");
// sort($arr);
// print_r($arr);

  //   $moeny=1;
  //   $moenys='1000.00';
  // if(!empty( $moenys>=$moeny)){
  //           $data12['au_moeny']=$moeny;
  //           $data12['au_money']=$moenys-$moeny;
  //       }



  //       dump($data12);

       $this->display();
    }

     //登录操作
    public  function register(){
        // $uname=I('post.uname');
        // $password=I('post.upwds');
        // $where['u_name']=$uname;
        // //$where['u_type']='admin';

        // $user=M('user');
        // $data=$user->where($where)->find();
        // //dump($data);exit;
        // if(empty($data) || $data['u_status']==2 || $data['u_status']==3){
        //     $this->redirect('Login/index');    
        //     //$this->error('没有此账号');
        // }else if($data['u_password']==MD5(MD5($password.$data['u_random']))){
        //      session('uname',$data['u_name']);   
        //      session('uid',$data['u_id']);
        //      session('isLoinhainian8',true); 
        //      $this->redirect('Index/index');
        // }else{
        // 	//$this->error('密码不正确');
        //     $this->redirect('Login/index');   
        // }

        $where['au_name']=trim(I('post.uname'));
        $upassword=trim(I('post.upassword'));
        //$where['au_type']=array('in','agency,agencys');
        //$upasswords=MD5(MD5($upassword));
        $admin=M('admin');
        $user=$admin->where($where)->find();
        //dump($user);exit;
        if(empty($user)){//账号不存在
            $arr=array('code'=>false,'titles'=>'账号不存在！');
        }elseif($user['au_status']==2){
            $arr=array('code'=>false,'titles'=>'账号禁止登录！');
        }elseif((MD5(MD5($upassword.$user['au_random'])))!=$user['password']){//密码不正确
            $arr=array('code'=>false,'titles'=>'密码不正确！');
        }else{//登录成功
            $session_id=session_id();
            $data1['au_session']=$session_id;
            $data1['login_ip']=get_client_ip();
            $data1['login_time']=time();
            $data1['login_sum']=$user['login_sum']+1;
            $admin->where(array('au_id'=>$user['au_id']))->save($data1);
            session('auIP',$session_id);
            session('auid',$user['au_id']);
            session('autype',$user['au_type']);
            session('auname',$user['au_name']);
            session('auqishus',$user['au_qishu']);
            session('aumarkets',$user['au_market']);
            session('auips',$user['login_ip']);
            session('autime',$user['login_time']);
            session('ausum',$user['login_sum']);
            session('isLoinhainian8',true);
            //session('uid',$user['u_id']);
            $arr=array('code'=>true,'urls'=>'/Index/index');
        }

        $status=json_encode($arr);
        echo $status;
        //$this->ajaxReturn($arr);
    }

    //退出操作
    public function logout(){
        session('auIP',' ');
        session('auid',' ');
        session('autype',' ');
        session('auname',' ');
        session('isLoinhainian8',false);
        session_unset();
        session_destroy();
        $this->redirect('Login/index'); 

    }
     public function logout1(){
        session('auIP',' ');
        session('auid',' ');
        session('autype',' ');
        session('auname',' ');
        session('isLoinhainian8',false);
        session_unset();
        session_destroy();

    }

}
