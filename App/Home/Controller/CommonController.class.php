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
		$true=I('session.isLoinhainan9');//登入标示
		$uIP=I('session.uIP');//登入标示
		//1.验证登陆标示
		if(!$true || session('userid')=='' || session('uIP')==''){
			$this->redirect("Login/index");
		}
		// $uIP=I('session.uIP');//登入标示
		// $where['uid']=session('userid');
		// $user=M('user')->field('usession')->where($where)->find();
		// if($uIP!=$user['usession']){
			
		// 	echo '<script>alert("该账号异地登陆了，被迫下线！");window.location.href="/index.php/Login/retreats";</script>';
		// 	//$this->redirect("Login/index");
		// }
		$ustatus=ustatus();

		$titles=mStatus1();
	//dump($titles);
	$this->assign('ustatus',$ustatus);
	$this->assign('status',$titles[5]);
	$this->assign('time',$titles[1]);
	$this->assign('titles',$titles[2]);
	$this->assign('time1',$titles[3]);
	$this->assign('titles1',$titles[4]);
	$this->assign('status1',$titles[0]);
		//2.验证用户是否被禁止使用了
		//3.权限认证
       // $auth=new \Think\Auth();//加载类库
       // if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME, session('uid'))){
       	
       //      $this->error('你没有权限');
       // }
       //   import('ORG.Util.Auth');//加载类库
       // $auth=new Auth();
       // if(!$auth->check(MODULE_NAME.'-'.ACTION_NAME,session('uid'))){
       //      $this->error('你没有权限');
       // }

	}
	
}