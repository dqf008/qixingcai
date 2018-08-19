<?php
/*Belong:公共控制器
* module:公共类
* author:
* role:系统管理员|会员中心用户
*/
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	
	protected function _initialize(){
		$true=I('session.isLoinhainian8');//登入标示
		$utype=I('session.autype');//登入标示
		$uid=I('session.auid');//登入标示

		$uIP=I('session.auIP');//登入标示
		
		//1.验证登陆标示
		//dump($_SESSION);
		if(!$true){
			$this->redirect("Login/index");
		}
		if(empty($utype) || empty($uid) || empty($uIP)){
			$this->redirect("Login/index");
		}
		
		$where['au_id']=$uid;
		$user=M('admin')->field('au_session')->where($where)->find();
		if($uIP!=$user['au_session']){
			
			//echo '<script>alert("该账号异地登陆了，被迫下线！");window.location.href="/Login/logout";</script>';
			//$this->redirect("Login/index");
		}
		// 
		$titles=mStatus1();

		$this->assign('status',$titles[0]);
		$this->assign('time',$titles[1]);
		$this->assign('titles',$titles[2]);
		$this->assign('time1',$titles[3]);
		$this->assign('titles1',$titles[4]);

	}
	
}
