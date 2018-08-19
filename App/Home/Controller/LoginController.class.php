<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        //1四定 2、2现 3、三现 4. 4现 5、二定 6、 三定
        //  2 3 4
        // $where['type']=4;
        // //$where['types']=4;
        // $data=M('number')->where($where)->select();
        // foreach($data as $k=>$v){
        //     $data1['type']=$v['type'];
        //     $data1['numbers']=$v['numbers'];
        //     $data1['types']=$v['types'];
        //     $dd=M('number31')->add($data1);
        // }
        // dump($data);exit;


     //    $num='0xx1';
     //    $sizixian=1;
     //    $num1 = preg_replace("/x/", "", $num);//正则匹配替换
     //    $num_arr_x = explode('x' , $num);//分割

     //    $status=strstr($num,'x');//是否包含x
     //    //存在x,是定1.判断长度，2.除了x还有几位数，3.规整类型
     //    //现,1.判断长度，2.规整类型
     //    echo strlen($num).'===>'.strlen($num1).'<br/>';
     //    if((strlen($num) <=4) && (strlen($num1) >1)){
     //        if(($sizixian==1) && (empty($status))){//现类型、不包含x
     //            $len=strlen($num);
     //            $type='现';
     //            echo $len.$type; 
     //        }elseif((empty($status)) && (strlen($num) ==4)){//不包含x、长度4
     //            $len=strlen($num1);
     //            $type='定';
     //            echo $len.$type;
     //        }elseif((!empty($status)) && (strlen($num) ==4)){//包含x、长度4
     //            $len=strlen($num1);
     //            $haoma1=substr($num,0,1);
     //            $haoma2=substr($num,1,1);
     //            $haoma3=substr($num,2,1);
     //            $haoma4=substr($num,3,1);
     //            if($len==2){//赔率类型判断--6种
     //                if($haoma1=='x' && $haoma2=='x'){
     //                    $type='定XX口口';
     //                    echo $len.$type;  
     //                }elseif($haoma3=='x' && $haoma4=='x'){
     //                    $type='定口口XX';
     //                    echo $len.$type;
     //                }elseif($haoma1=='x' && $haoma4=='x'){
     //                    $type='定X口口X';
     //                    echo $len.$type;
     //                }elseif($haoma2=='x' && $haoma3=='x'){
     //                    $type='定口XX口';
     //                    echo $len.$type;
     //                }elseif($haoma2=='x' && $haoma4=='x'){
     //                    $type='定口X口X';
     //                    echo $len.$type;
     //                }elseif($haoma1=='x' && $haoma3=='x'){
     //                    $type='定X口X口';
     //                    echo $len.$type;
     //                }   
                    
     //            }elseif($len==3){//赔率类型判断--4种
     //                if($haoma1=='x'){
     //                    $type='定X口口口';
     //                    echo $len.$type;  
     //                }elseif($haoma2=='x'){
     //                    $type='定口X口口';
     //                    echo $len.$type;
     //                }elseif($haoma3=='x'){
     //                    $type='定口口X口';
     //                    echo $len.$type;
     //                }elseif($haoma4=='x'){
     //                    $type='定口口口X';
     //                    echo $len.$type;
     //                }
     //            }
     //        }else{
     //            echo '改号码没有'; 
     //        }
     //    }else{
     //        echo '改号码没有'; 
     //    }
     //    //  dump($num1);
     //    // echo $num1;

     //    //字符串分割
     //    // $str='0X1X0X3X0X5X0X7X0X9X1X0X1X2X1X4X1X6X1X8X2X1X2X3X2X5X2X7X2X9X3X0X3X2X3X4X3X6X3X8X4X1X4X3X4X5X4X7X4X9X5X0X5X2X5X4X5X6X5X8X6X1X6X3X6X5X6X7X6X9X7X0X7X2X7X4X7X6X7X8X8X1X8X3X8X5X8X7X8X9X9X0X9X2X9X4X9X6X9X8X';
     //    // echo strlen($str);
     //    //  $sum1='';
     //    // if(strlen($str)>4){
     //    //    for ($i=0;$i<strlen($str);$i++){
     //    //     if($cc=substr($str,$i*4,4)){
     //    //        echo $cc."\n";  
     //    //        $sum+=1;
     //    //     }
              
     //    //    } 
     //    // }

     //    // echo $sum;
     //    //ezdm0XX0,1|ezdm0XX1,22|
     //    $str='ezdm0XX0,1|ezdm0XX1,22|';
     //    if(strlen($str)>10){
     //        $strs=explode('|',$str);
     //        for($a=0;$a<count($strs);$a++){
     //            $strs1=explode(',',$strs[$a]);
     //            if($strs1[0] && $strs1[1]){
     //                $haoma=str_replace('ezdm','',$strs1[0]);//下注号码
     //                $moeny=$strs1[1];//下注金额
     //                $moenys+=$strs1[1];//下注总金额
     //            }
     //        }
            
     //        echo $moenys;
     //    }
     //        // dump($strs);
     //    // echo count($strs);

 
        
     //    // if(($sizixian==1) && (empty($status) && strlen($num)>1)){
     //    //     $len=strlen($num);
     //    //     $type='现';
     //    //     echo $len.$type;
     //    // }elseif(!empty($status) && ((strlen($num) ==4) && (strlen($num1) >1)) ){
     //    //     $len=strlen($num1);
     //    //     $type='定';
     //    //     echo $len.$type;
     //    // // }elseif(empty($status) && strlen($num)>1){
     //    // //     $len=strlen($num);
     //    // //     $type='现';
     //    // //     echo $len.$type;
     //    // }else{
     //    //     echo '改号码没有';  
     //    // }
       
     //    // if((count($num_arr_x) <= 1) && (empty($status))){
     //    //     echo '改号码没有';
     //    // }else{
     //    //    if((!empty($status)) && (strlen($num) ==4)){
     //    //     echo '定';
            
     //    //     }else{
     //    //         echo '现';
     //    //     }   
     //    // }
        
     //    //echo strlen($num);

     //    // echo (count($num_arr_x));
     //    // dump($num1);


     //    // if( (count($num_arr_x) >= 2 || (strlen($num) ==4 && $num1 == $num)) && $_POST['sizixian'] != 1 ){
     //    //             $type = '定';
     //    //                 $weishu = strlen($num1);
     //    //         }else{
     //    //             $type = '现';
     //    //             $num_arr = str_split($num);
     //    //             asort($num_arr);
     //    //                 $num = implode($num_arr);//排序后的字符串num
     //    //                 $weishu = strlen($num);
     //    //         }

     //     //dump($weishu.'==>'.$type);       
     //     // dump($num_arr_x);       
     //     //  dump($num1);       
     //     //  dump($num2);       
     //     // dump($num_arr_x);  





    	// //echo md5(md5('111111'));
     //    // for($a=0;$a<=9;$a++){
     //    //      for($b=0;$b<=9;$b++){
     //    //         //if($a==$b){
     //    //             echo $a.'x'.'x'.$b.'<br/>';
     //    //         //}
     //    //     }
     //    // }
     //    // 
     //    // for ($i=0;$i<=9;$i++){ 
     //    //     $html.='<table><tr><td class="rdcol"></td>';
     //    //     for ($j=0;$j<=9;$j++){
     //    //         $html.='<td id="e'.$i.$j.'" onclick="cgErZiDing.ezdC(this);" class=""><div class="rdL">XX'.$i.$j.'</div><div class="rdR h">92.2</div></td>';
     //    //     } 
     //    //         $html.='</tr></table>';
     //    //         //echo "$i*$j=".$i*$j." "; echo "<br>\n"; 
     //    // } 
     //    // echo $html;

     // echo   MD5(MD5('111111'));exit;
    	$this->display();
    }

    //登录操作
    public function register(){
    	$where['username']=trim(I('post.uname'));
    	$upassword=(I('post.upassword'));
        $user1=M('user');
    	$user=$user1->where($where)->find();
    	if(empty($user)){//账号不存在
    		$arr=array('code'=>false,'titles'=>'账号不存在');
    	}elseif($user['status']==2){
            $arr=array('code'=>false,'titles'=>'账号禁止登录！');
        }elseif((MD5(MD5($upassword)))!=$user['password']){//密码不正确
    		$arr=array('code'=>false,'titles'=>'密码不正确');
    	}else{//登录成功
            //现在期号
            $data=M('opentime')->order('id desc')->find();
            $session_id=session_id();
            $data1['usession']=$session_id;
            $user1->where(array('uid'=>$user['uid']))->save($data1);

            session('uIP',$session_id);
    		session('userid',$user['uid']);
            session('utype',$user['u_type']);
            session('unames',$user['username']);
            session('umoneys',$user['money']);
    		session('isLoinhainan9',true);
    		session('qishu',$data['qishu']);
    		$arr=array('code'=>true,'urls'=>'/Index/rule');
    	}
    	$status=json_encode($arr);
    	echo $status;

    }

    public function retreats(){
        session('uIP','');
        session('userid','');
        session('utype','');
        session('uname','');
        session('qishu','');
        session('umoneys','');
        session('isLoinhainan9',false);

        session_unset();

        session_destroy();

        $this->redirect('Login/index');     
    }
     public function retreats1(){
        session('uIP','');
        session('userid','');
        session('utype','');
        session('uname','');
        session('qishu','');
        session('umoneys','');
        session('isLoinhainan9',false);

        session_unset();

        session_destroy();
    }
}
