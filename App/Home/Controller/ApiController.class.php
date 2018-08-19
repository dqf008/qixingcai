<?php
/*Belong:公共控制器
* module:公共类
* author:
* role:系统管理员|会员中心用户
*/
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
	public function login(){
		$where['username']=trim(I('post.uname'));
    	$upassword=trim(I('post.upassword'));
    	$user=M('user')->where($where)->find();
    	if(empty($user)){//账号不存在
    		$data['code']="112";
    		$data['msg']="账号不存在";
    		$this->ajaxReturn($data);
    	}elseif($user['status']==2){
    		$data['code']="113";
    		$data['msg']="账号禁止登录！";
    		$this->ajaxReturn($data);
        }elseif((MD5(MD5($upassword)))!=$user['password']){//密码不正确
        	$data['code']="114";
    		$data['msg']="密码不正确";
    		$this->ajaxReturn($data);
    	}else{//登录成功
            //现在期号
            foreach($user as $k=>$v){
            	if(empty($v)){
            		$user[$k]="";
            	}
            }
            $opentime=M('opentime')->order('id desc')->find();
    		$data['code']="0";
    		$data['msg']="登录成功";
    		$data['user']=$user;
    		$data['qishu']=$opentime['qishu'];
    		$this->ajaxReturn($data);
    	}
	}
	
	public function load(){
		$file = "./jubaopen.apk";
		if(file_exists($file)){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}else{
			$this->error('找不到文件');
		}
		
	}

	public function lists(){
		  $userid=I('post.userid');
		  $unames=I('post.unames');
          $qishu=I('post.qishu');
      if(!$userid && !$qishu && !$unames){
        $data['code']="112";
        $data['msg']="缺少参数";
        $this->ajaxReturn($data);
      }
      $where['uid']=$userid; 
      $where['qishu']=$qishu;
      $where['js']=0;
      //$where['index_id']=2;

      $bets=M('bet');
      $where1['js']=0;
      $where1['qishu']=array('not in',$qishu);
      $umoney=$bets->where($where1)->sum('money');
      $data['moneys']=user()-$umoney;//用户总积分

        $dd=$bets->field('id,did,money,addtime,mingxi_1,mingxi_2,mingxi_3,odds,index_id')->where($where)->order('id desc')->select();
       
        if(!empty($dd)){
          foreach($dd as $k=>$v){
               $data['moneys1']+=$v['money'];
              if($v['index_id']==2){
                $data1['odds']=$v['odds'];
				$data1['mingxi_1']=$v['mingxi_1'];
                $data1['mingxi_2']=$v['mingxi_2'];
                $data1['mingxi_3']=$v['mingxi_3'];
                $data1['addtime']=$v['addtime'];
                $data1['did']=$v['did'];
                $data1['money']=$v['money'];
                $data1['id']=$v['id'];
                $data['data'][]=$data1;
                $money+=$v['money'];
              }
               
            }
             $data['code']="200";
            if($data['data']){

            $count=count($data['data']);//笔数
            //$data['moneys']=user();//用户总积分
            $data['count']=$count;//笔数
            $data['money']=$money;//总金额
            $data['time']=date('Y-m-d H:i',$data['data'][$count-1]['addtime']);//下注时间
            $data['did']=$data['data'][$count-1]['did'];//下注编号
            }else{
              $data['code']="400";
            } 
        }else{
          $data['moneys1']=0;
          $data['money']=0;
          $data['code']="400";
        }
        $data['moneys2']=$data['moneys']-$data['moneys1'];
        $data['username']=$unames;
        $this->ajaxReturn($data);
	}
	
	
	
	public function alllists(){
		  $userid=I('post.userid');
		  $unames=I('post.unames');
          $qishu=I('post.qishu');
      if(!$userid && !$qishu && !$unames){
        $data['code']="112";
        $data['msg']="缺少参数";
        $this->ajaxReturn($data);
      }
      $where['uid']=$userid; 
      $where['qishu']=$qishu;
      $where['js']=0;
      $bets=M('bet');
	  
	  //参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
	  
      $dd=$bets->field('id,did,money,addtime,mingxi_1,mingxi_2,mingxi_3,odds,index_id')->where($where)->order('id desc')->limit($firstRow, $num)->select();
       
        if(!empty($dd)){
          foreach($dd as $k=>$v){
               //$data['moneys1']+=$v['money'];
              //if($v['index_id']==2){
                $data1['odds']=$v['odds'];
				$data1['mingxi_1']=$v['mingxi_1'];
                $data1['mingxi_2']=$v['mingxi_2'];
                $data1['mingxi_3']=$v['mingxi_3'];
                $data1['addtime']=$v['addtime'];
                $data1['did']=$v['did'];
                $data1['money']=$v['money'];
                $data1['id']=$v['id'];
                $data['data'][]=$data1;
                $money+=$v['money'];
              //}
               
            }
             $data['code']="200";
            if($data['data']){

            $count=count($data['data']);//笔数
            $data['count']=$count;//笔数
            $data['money']=$money;//总金额
            $data['time']=date('Y-m-d H:i',$data['data'][$count-1]['addtime']);//下注时间
            $data['did']=$data['data'][$count-1]['did'];//下注编号
            }else{
              $data['code']="300";
            } 
        }else{
          $data['moneys1']=0;
          $data['money']=0;
          $data['code']="400";
        }
        $data['moneys2']=$data['moneys']-$data['moneys1'];
        $data['username']=$unames;
        $this->ajaxReturn($data);
	}
	
	
	
	
	
}