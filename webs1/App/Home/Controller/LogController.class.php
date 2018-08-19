<?php
namespace Home\Controller;
use Think\Controller;
class LogController extends Controller {
    public function index(){
      
        $this->display();
    }
    //会员操作日志
    public function user(){
    	
    	$this->display();

    }

    //拦货金额日志
    public function order(){
    	
    	$this->display();

    }
    //会员快选日志
    // public function user1(){
    	
    // 	$this->display();

    // }
    //会员快选日志
    public function users(){
    	
    	$this->display();

    }



}