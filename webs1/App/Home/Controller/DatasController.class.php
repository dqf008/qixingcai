<?php
namespace Home\Controller;
use Think\Controller;
class DatasController extends Controller {
    public function index(){
        $qishu1=I('get.qishu');//搜索期数
        $userid=I('get.userid');//搜索期数

        $arrs=users($userid);//所有下级会员ID（搜索下级用户ID）
        if(!empty($arrs[0])){
            $where['uid']=array('in',$arrs[0]);
        }else{
            $where['uid']='-1';
        }
        $where['js']='0';
    if(!empty($qishu1)){ 
        $where['qishu']=$qishu1;
        $where1['qishu']=$qishu1;
    }else{
        $time=date('Y-m-d',time());
        $stime=strtotime($time);
        $etime=$stime+86399;
        //今日期数汇总
       // $where1['m_time']=array(array('egt',($stime)),array('elt',($etime)),'and');
        //$qishus=M('opentime')->field('qishu')->where($where1)->order('id desc')->select();
         $qishus=qishus();//得到期数
        // if(!empty($qishus)){
        //     foreach($qishus as $k=>$v){
        //         $qishu.=$v['qishu'].',';
        //     } 
        //     $where['qishu']=array('in',rtrim($qishu,','));
        // }
        $where['qishu']=$qishus[0]['qishu'];
        $where['add_time']=array(array('egt',($stime)),array('elt',($etime)),'and');
        $where1['qishu']=$qishus[0]['qishu'];
    }
    //dump($where);exit;
    set_time_limit(0);
      
        if(!empty($arrs[0])){
            $data1=M('bet')->field('mingxi_1,types,money as moneys,status,win,odds,topmoney,topwin')->where($where)->select();
        }
         //dump($data1);exit;
        if($data1){
           $data=$this->getDatas($data1);
           $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }

        //2018-01-01 16:23:53
        //2018-01-01 16:24:07
        
        //   echo date('Y-m-d H:i:s').'<br/>';
        // echo date('Y-m-d H:i:s').'<br/>';
        // dump($data);exit;
        $utype1=utype1();//当前用户类型
        $titles=utype();//下级标题
        $this->assign('titles',$titles[0]);//
        $this->assign('utitle',$utype1[0]);//
        $this->assign('stime',$stime);//时间搜索
        $this->assign('etime',$etime);//时间搜索
        $this->assign('qishu1',$qishu1);//搜索期
        $this->assign('qishu',$qishu);//所有期数
        $this->assign('user',$arrs[1]);//所有期数
        $this->assign('userid',$userid);//
        $this->assign('data',$data);
        $this->assign('opentime',$opentime['m_status']);
        
        $this->display();
    }
    //数据加工
    private function getDatas($data1){
        foreach($data1 as $k=>$v){
                $money+=$v['moneys']-$v['topmoney'];
                $data['money']=intval($money);
                $win+=$v['win']-$v['topwin'];
                $data['win']=intval($win);
                $data['sum']+=1;
                if($v['status']==1){
                    $money1+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                    $data['money1']=intval($money1);
                }
                if($v['mingxi_1']=='2定'){
                    if($v['types']=='口口XX'){
                        $ding21m+=$v['moneys']-$v['topmoney'];;//销售
                        $ding21w+=$v['win']-$v['topwin'];;//回水
                        $data[1][0]=intval($ding21m);;//销售
                        $data[1][1]=intval($ding21w);;//回水
                        $data[1][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding21ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[1][3]=intval($ding21ms);//中奖
                        }
                    }elseif($v['types']=='口X口X'){
                        $ding22m+=$v['moneys']-$v['topmoney'];//销售
                        $ding22w+=$v['win']-$v['topwin'];//回水
                        $data[2][0]=intval($ding22m);;//销售
                        $data[2][1]=intval($ding22w);;//回
                        $data[2][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding22ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[2][3]=intval($ding22ms);//中奖
                        }
                    }elseif($v['types']=='口XX口'){
                        $ding23m+=$v['moneys']-$v['topmoney'];//销售
                        $ding23w+=$v['win']-$v['topwin'];//回水
                        $data[3][0]=intval($ding23m);;//销售
                        $data[3][1]=intval($ding23w);;//回
                        $data[3][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding23ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[3][3]=intval($ding23ms);//中奖
                        }
                    }elseif($v['types']=='X口X口'){
                        $ding24m+=$v['moneys']-$v['topmoney'];//销售
                        $ding24w+=$v['win']-$v['topwin'];//回水
                        $data[4][0]=intval($ding24m);;//销售
                        $data[4][1]=intval($ding24w);;//回
                        $data[4][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding24ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[4][3]=intval($ding24ms);//中奖
                        }
                    }elseif($v['types']=='X口口X'){
                        $ding25m+=$v['moneys']-$v['topmoney'];//销售
                        $ding25w+=$v['win']-$v['topwin'];//回水
                        $data[5][0]=intval($ding25m);;//销售
                        $data[5][1]=intval($ding25w);;//回
                        $data[5][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding25ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[5][3]=intval($ding25ms);//中奖
                        }
                    }elseif($v['types']=='XX口口'){
                        $ding26m+=$v['moneys']-$v['topmoney'];//销售
                        $ding26w+=$v['win']-$v['topwin'];//回水
                        $data[6][0]=intval($ding26m);;//销售
                        $data[6][1]=intval($ding26w);;//回
                        $data[6][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding26ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[6][3]=intval($ding26ms);//中奖
                        }
                    }
                }elseif($v['mingxi_1']=='3定'){
                    if($v['types']=='口口口X'){
                        $ding27m+=$v['moneys']-$v['topmoney'];//销售
                        $ding27w+=$v['win']-$v['topwin'];//回水
                        $data[7][0]=intval($ding27m);;//销售
                        $data[7][1]=intval($ding27w);;//回
                        $data[7][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding27ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[7][3]=intval($ding27ms);//中奖
                        }
                    }elseif($v['types']=='口X口口'){
                        $ding28m+=$v['moneys']-$v['topmoney'];//销售
                        $ding28w+=$v['win']-$v['topwin'];//回水
                        $data[8][0]=intval($ding28m);;//销售
                        $data[8][1]=intval($ding28w);;//回
                        $data[8][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding28ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[8][3]=intval($ding28ms);//中奖
                        }
                    }elseif($v['types']=='口口X口'){
                        $ding29m+=$v['moneys']-$v['topmoney'];//销售
                        $ding29w+=$v['win']-$v['topwin'];//回水
                        $data[9][0]=intval($ding29m);;//销售
                        $data[9][1]=intval($ding29w);;//回
                        $data[9][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding29ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[9][3]=intval($ding29ms);//中奖
                        }
                    }elseif($v['types']=='X口口口'){
                        $ding210m+=$v['moneys']-$v['topmoney'];//销售
                        $ding210w+=$v['win']-$v['topwin'];//回水
                        $data[10][0]=intval($ding210m);;//销售
                        $data[10][1]=intval($ding210w);;//回
                        $data[10][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding210ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[10][3]=intval($ding210ms);//中奖
                        }
                    }
                }else{
                    if($v['types']=='4定'){
                        $ding211m+=$v['moneys']-$v['topmoney'];//销售
                        $ding211w+=$v['win']-$v['topwin'];//回水
                        $data[11][0]=intval($ding211m);;//销售
                        $data[11][1]=intval($ding211w);;//回
                        $data[11][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding211ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[11][3]=intval($ding211ms);//中奖
                        }
                    }elseif($v['types']=='2现'){
                        $ding212m+=$v['moneys']-$v['topmoney'];//销售
                        $ding212w+=$v['win']-$v['topwin'];//回水
                        $data[12][0]=intval($ding212m);;//销售
                        $data[12][1]=intval($ding212w);;//回
                        $data[12][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding212ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[12][3]=intval($ding212ms);//中奖
                        }
                    }elseif($v['types']=='3现'){
                        $ding213m+=$v['moneys']-$v['topmoney'];//销售
                        $ding213w+=$v['win']-$v['topwin'];//回水
                        $data[13][0]=intval($ding213m);;//销售
                        $data[13][1]=intval($ding213w);;//回
                        $data[13][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding213ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[13][3]=intval($ding213ms);//中奖
                        }
                    }elseif($v['types']=='4现'){
                        $ding214m+=$v['moneys']-$v['topmoney'];//销售
                        $ding214w+=$v['win']-$v['topwin'];//回水
                        $data[14][0]=intval($ding214m);;//销售
                        $data[14][1]=intval($ding214w);;//回
                        $data[14][2]+=1;
                        //中奖
                        if($v['status']==1){
                            $ding214ms+=($v['moneys']-$v['topmoney'])*$v['odds'];//中奖
                            $data[14][3]=intval($ding214ms);//中奖
                        }
                    }
                }
    
                $data['ding21']=$data[1][0]+$data[2][0]+$data[3][0]+$data[4][0]+$data[5][0]+$data[6][0];
                $data['ding22']=$data[1][1]+$data[2][1]+$data[3][1]+$data[4][1]+$data[5][1]+$data[6][1];
                $data['ding23']=$data[1][2]+$data[2][2]+$data[3][2]+$data[4][2]+$data[5][2]+$data[6][2];
                $data['ding24']=$data[1][3]+$data[2][3]+$data[3][3]+$data[4][3]+$data[5][3]+$data[6][3];
                //3定
                $data['ding31']=$data[7][0]+$data[8][0]+$data[9][0]+$data[10][0];
                $data['ding32']=$data[7][1]+$data[8][1]+$data[9][1]+$data[10][1];
                $data['ding33']=$data[7][2]+$data[8][2]+$data[9][2]+$data[10][2];
                $data['ding34']=$data[7][3]+$data[8][3]+$data[9][3]+$data[10][3];
            }    
                return $data;
    }
    //月分账
    public function monthDatas(){
        $qishu1=I('get.qishu1');//搜索期数
        $qishu2=I('get.qishu2');//搜索期数
        $userid=I('get.userid');//搜索下级会员
        // $stime=I('get.stime');
        // $etime=I('get.etime');
        $arrs=users($userid);//得到下级会员
        $qishus=qishus();//得到期数
        if(!empty($qishu1) && !empty($qishu2)){
            $where1['qishu']=array(array('egt',($qishu1)),array('elt',($qishu2)),'and');
            $where4['qishu']=array(array('egt',($qishu1)),array('elt',($qishu2)),'and');
           $dd=M('opentime')->field('qishu,m_status,m_time')->where($where4)->select();
           if(!empty($dd)){
                //得到所有期数
                foreach($dd as $k=>$v){
                    $qishu.=$v['qishu'].',';
                    $datas1[$v['qishu']]=$v['m_status'].','.$v['m_time'];//分组
                } 

                $where1['qishu']=array('in',rtrim($qishu,','));
            }else{
                 $where1['qishu']='-1';
            }
        }else{
            if(!empty($qishus)){
                foreach($qishus as $k=>$v){
                    $qishu.=$v['qishu'].',';
                     $datas1[$v['qishu']]=$v['m_status'].','.$v['m_time'];//分组
                } 
                $where1['qishu']=array('in',rtrim($qishu,','));
            }else{
                 $where1['qishu']='-1';
            }
        }
        // if(isset($qishus) && !empty($qishus)){
        //     foreach($qishus as $k=>$v){   
        //             $qishuarr[$v['qishu']]=date('m-d',strtotime($v['kaipan']));//分组
        //         } 
        // }
        $userID=I('get.uid');//会员查看月表

        if(!empty($userID)){
            $where1['uid']=$userID;
        }elseif(!empty($arrs[0])){
            $where1['uid']=array('in',$arrs[0]);
        }else{
            $where1['uid']='-1';
        }
        if(empty($stime) || empty($etime)){
            $stime=date('Y-m-d',time());
            $etime=date('Y-m-d',time());

        }
       
        //echo $stime;
        //$where['addtime']=array(array('egt',strtotime($stime)),array('elt',strtotime($etime)+86400),'and');

        // $uid=getUser();
        // $where1['uid']=array('in',$uid);
        set_time_limit(0);
        $where1['js']='0';
          //echo date('Y-m-d H:i:s').'<br/>';
        
       
        if(!empty($arrs[0]) || !empty($userID)){
            $arr=M('bet')->field('mingxi_1,qishu,types,money as moneys,status,win,odds,topmoney,topwin')->where($where1)->select(); 
        }
        // echo date('Y-m-d H:i:s').'<br/>';
        //   exit;//dump($arr);
        //dump($qishuarr);
        
       //dump($qishu);
         if(isset($datas1) && !empty($datas1)){



            foreach($datas1 as $k1=>$v1){  
             $t1=explode(',',$v1); 
                foreach($arr as $k2=>$v2){ 
                    if($k1==$v2['qishu']){
                        if($t1[0]==3){
                            $data['status']=3; 
                            // $money2+=$v2['moneys'];
                            // $data['money2']=intval($money2);
                          }else{
                            $data['status']=1;
                          }
                        $data['qishu']=$v2['qishu'];
                        // $data['money']+=$v2['moneys'];
                        // $data['win']+=$v2['win'];
                        // $data['sum']+=$v2['sum'];
                        // if($v2['status']==1){
                        //     $data['money1']+=$v2['moneys']*$v2['odds'];//中奖
                        // }
                        // if($t1[0]==3){
                        //     $data['status']=3; 
                        //   }else{
                        //     $data['status']=1;
                        //   }
                        $money+=$v2['moneys']-$v2['topmoney'];
                        $data['money']=intval($money);
                        $win+=$v2['win']-$v2['topwin'];

                        $data['win']=intval($win);
			//$data['sum'] = intval($data['sum']);
                        $data['sum'] = intval($data['sum']) + 1;
                        if($v2['status']==1){
                            $money1+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                            $data['money1']=intval($money1);
                        }
                         if($v2['mingxi_1']=='2定'){
                            if($v2['types']=='口口XX'){
                                $ding21m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding21w+=$v2['win']-$v2['topwin'];//回水
                                $data[1][0]+=($ding21m);;//销售
                                $data[1][1]+=($ding21w);;//回水
                                $data[1][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding21ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[1][3]+=($ding21ms);//中奖
                                }
                            }elseif($v2['types']=='口X口X'){
                                $ding22m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding22w+=$v2['win']-$v2['topwin'];//回水
                                $data[2][0]+=($ding22m);;//销售
                                $data[2][1]+=($ding22w);;//回
                                $data[2][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding22ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[2][3]+=($ding22ms);//中奖
                                }
                            }elseif($v2['types']=='口XX口'){
                                $ding23m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding23w+=$v2['win']-$v2['topwin'];//回水
                                $data[3][0]+=($ding23m);;//销售
                                $data[3][1]+=($ding23w);;//回
                                $data[3][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding23ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[3][3]+=($ding23ms);//中奖
                                }
                            }elseif($v2['types']=='X口X口'){
                                $ding24m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding24w+=$v2['win']-$v2['topwin'];//回水
                                $data[4][0]+=($ding24m);;//销售
                                $data[4][1]+=($ding24w);;//回
                                $data[4][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding24ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[4][3]+=($ding24ms);//中奖
                                }
                            }elseif($v2['types']=='X口口X'){
                                $ding25m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding25w+=$v2['win']-$v2['topwin'];//回水
                                $data[5][0]+=($ding25m);;//销售
                                $data[5][1]+=($ding25w);;//回
                                $data[5][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding25ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[5][3]+=($ding25ms);//中奖
                                }
                            }elseif($v2['types']=='XX口口'){
                                $ding26m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding26w+=$v2['win']-$v2['topwin'];//回水
                                $data[6][0]+=($ding26m);;//销售
                                $data[6][1]+=($ding26w);;//回
                                $data[6][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding26ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[6][3]+=($ding26ms);//中奖
                                }
                            }
                        }elseif($v2['mingxi_1']=='3定'){
                            if($v2['types']=='X口口口'){
                                $ding27m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding27w+=$v2['win']-$v2['topwin'];//回水
                                $data[7][0]+=($ding27m);;//销售
                                $data[7][1]+=($ding27w);;//回
                                $data[7][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding27ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[7][3]+=($ding27ms);//中奖
                                }
                            }elseif($v2['types']=='口X口口'){
                                $ding28m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding28w+=$v2['win']-$v2['topwin'];//回水
                                $data[8][0]+=($ding28m);;//销售
                                $data[8][1]+=($ding28w);;//回
                                $data[8][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding28ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[8][3]+=($ding28ms);//中奖
                                }
                            }elseif($v2['types']=='口口X口'){
                                $ding29m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding29w+=$v2['win']-$v2['topwin'];//回水
                                $data[9][0]+=($ding29m);;//销售
                                $data[9][1]+=($ding29w);;//回
                                $data[9][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding29ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[9][3]+=($ding29ms);//中奖
                                }
                            }elseif($v2['types']=='口口口X'){
                                $ding210m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding210w+=$v2['win']-$v2['topwin'];//回水
                                $data[10][0]+=($ding210m);;//销售
                               $data[10][1]+=($ding210w);;//回
                                $data[10][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding210ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[10][3]+=($ding210ms);//中奖
                                }
                            }
                        }else{
                            if($v2['types']=='4定'){
                                $ding211m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding211w+=$v2['win']-$v2['topwin'];//回水
				$data = [
					11 => [],
				];
                                $data[11][0]+=$ding211m;//销售
                                $data[11][1]+=$ding211w;//回
                                $data[11][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding211ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[11][3]+=$ding211ms;//中奖
                                }
                            }elseif($v2['types']=='2现'){
                                $ding212m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding212w+=$v2['win']-$v2['topwin'];//回水
                                $data[12][0]+=($ding212m);;//销售
                                $data[12][1]+=($ding212w);;//回
                                $data[12][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding212ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[12][3]+=($ding212ms);//中奖
                                }
                            }elseif($v2['types']=='3现'){
                                $ding213m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding213w+=$v2['win']-$v2['topwin'];//回水
                                $data[13][0]+=($ding213m);;//销售
                                $data[13][1]+=($ding213w);;//回
                                $data[13][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding213ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[13][3]+=($ding213ms);//中奖
                                }
                            }elseif($v2['types']=='4现'){
                                $ding214m+=$v2['moneys']-$v2['topmoney'];//销售
                                $ding214w+=$v2['win']-$v2['topwin'];//回水
                                $data[14][0]+=($ding214m);;//销售
                                $data[14][1]+=($ding214w);;//回
                                $data[14][2]+=1;
                                //中奖
                                if($v2['status']==1){
                                    $ding214ms+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];//中奖
                                    $data[14][3]+=($ding214ms);//中奖
                                }
                            }
                        }

                       

                    } 
                    $ding21m=''; 
                    $ding21ms=''; 
                    $ding21w='';
                    $ding22m=''; 
                    $ding22ms=''; 
                    $ding22w='';
                    $ding23m=''; 
                    $ding23ms=''; 
                    $ding23w='';
                    $ding24m=''; 
                    $ding24ms=''; 
                    $ding24w='';
                    $ding25m=''; 
                    $ding25ms=''; 
                    $ding25w='';  
                    $ding26m=''; 
                    $ding26ms=''; 
                    $ding26w='';
                    $ding27m=''; 
                    $ding27ms=''; 
                    $ding27w='';
                    $ding28m=''; 
                    $ding28ms=''; 
                    $ding28w='';
                    $ding29m=''; 
                    $ding29ms=''; 
                    $ding29w='';  
                    $ding210m=''; 
                    $ding210ms=''; 
                    $ding210w=''; 
                    $ding211m=''; 
                    $ding211ms=''; 
                    $ding211w='';
                    $ding212m=''; 
                    $ding212ms=''; 
                    $ding212w='';
                    $ding213m=''; 
                    $ding213ms=''; 
                    $ding213w='';  
                    $ding214m=''; 
                    $ding214ms=''; 
                    $ding214w='';  
                }  
                if($data){
                    $data[1][0]= intval($data[1][0]);
                    $data[1][1]= intval($data[1][1]);
                    $data[1][2]= intval($data[1][2]);
                    $data[1][3]= intval($data[1][3]);
                    $data[2][0]= intval($data[2][0]);
                    $data[2][1]= intval($data[2][1]);
                    $data[2][2]= intval($data[2][2]);
                    $data[2][3]= intval($data[2][3]);
                    $data[3][0]= intval($data[3][0]);
                    $data[3][1]= intval($data[3][1]);
                    $data[3][2]= intval($data[3][2]);
                    $data[3][3]= intval($data[3][3]);
                    $data[4][0]= intval($data[4][0]);
                    $data[4][1]= intval($data[4][1]);
                    $data[4][2]= intval($data[4][2]);
                    $data[4][3]= intval($data[4][3]);
                    $data[5][0]= intval($data[5][0]);
                    $data[5][1]= intval($data[5][1]);
                    $data[5][2]= intval($data[5][2]);
                    $data[5][3]= intval($data[5][3]);
                    $data[6][0]= intval($data[6][0]);
                    $data[6][1]= intval($data[6][1]);
                    $data[6][2]= intval($data[6][2]);
                    $data[6][3]= intval($data[6][3]);
                    $data[7][0]= intval($data[7][0]);
                    $data[7][1]= intval($data[7][1]);
                    $data[7][2]= intval($data[7][2]);
                    $data[7][3]= intval($data[7][3]);
                    $data[8][0]= intval($data[8][0]);
                    $data[8][1]= intval($data[8][1]);
                    $data[8][2]= intval($data[8][2]);
                    $data[8][3]= intval($data[8][3]);
                    $data[9][0]= intval($data[9][0]);
                    $data[9][1]= intval($data[9][1]);
                    $data[9][2]= intval($data[9][2]);
                    $data[9][3]= intval($data[9][3]);
                    $data[10][0]= intval($data[10][0]);
                    $data[10][1]= intval($data[10][1]);
                    $data[10][2]= intval($data[10][2]);
                    $data[10][3]= intval($data[10][3]);
                    $data[11][0]= intval($data[11][0]);
                    $data[11][1]= intval($data[11][1]);
                    $data[11][2]= intval($data[11][2]);
                    $data[11][3]= intval($data[11][3]);
                    $data[12][0]= intval($data[12][0]);
                    $data[12][1]= intval($data[12][1]);
                    $data[12][2]= intval($data[12][2]);
                    $data[12][3]= intval($data[12][3]);
                    $data[13][0]= intval($data[13][0]);
                    $data[13][1]= intval($data[13][1]);
                    $data[13][2]= intval($data[13][2]);
                    $data[13][3]= intval($data[13][3]);
                    $data[14][0]= intval($data[14][0]);
                    $data[14][1]= intval($data[14][1]);
                    $data[14][2]= intval($data[14][2]);
                    $data[14][3]= intval($data[14][3]);

                    $data['ding21']=$data[1][0]+$data[2][0]+$data[3][0]+$data[4][0]+$data[5][0]+$data[6][0];
                    $data['ding22']=$data[1][1]+$data[2][1]+$data[3][1]+$data[4][1]+$data[5][1]+$data[6][1];
                    $data['ding23']=$data[1][2]+$data[2][2]+$data[3][2]+$data[4][2]+$data[5][2]+$data[6][2];
                    $data['ding24']=$data[1][3]+$data[2][3]+$data[3][3]+$data[4][3]+$data[5][3]+$data[6][3];
                    //3定
                    $data['ding31']=$data[7][0]+$data[8][0]+$data[9][0]+$data[10][0];
                    $data['ding32']=$data[7][1]+$data[8][1]+$data[9][1]+$data[10][1];
                    $data['ding33']=$data[7][2]+$data[8][2]+$data[9][2]+$data[10][2];
                    $data['ding34']=$data[7][3]+$data[8][3]+$data[9][3]+$data[10][3];
                    if($t1[0]==3){
                    //汇总数据
                    $datas['money1']+=$data['money1'];
                    $datas['money']+=$data['money'];
                    $datas['win']+=$data['win'];
                    $datas['sum']+=$data['sum'];
                    //二定
                   

                    
                    $datas[1][0]+=$data[1][0];//销售
                    $datas[1][1]+=$data[1][1];//回水
                    $datas[1][2]+=$data[1][2];//笔数
                    $datas[1][3]+=$data[1][3];//中奖

                    $datas[2][0]+=$data[2][0];//销售
                    $datas[2][1]+=$data[2][1];//回水
                    $datas[2][2]+=$data[2][2];//笔数
                    $datas[2][3]+=$data[2][3];//中奖

                    $datas[3][0]+=$data[3][0];//销售
                    $datas[3][1]+=$data[3][1];//回水
                    $datas[3][2]+=$data[3][2];//笔数
                    $datas[3][3]+=$data[3][3];//中奖

                    $datas[4][0]+=$data[4][0];//销售
                    $datas[4][1]+=$data[4][1];//回水
                    $datas[4][2]+=$data[4][2];//笔数
                    $datas[4][3]+=$data[4][3];//中奖

                    $datas[5][0]+=$data[5][0];//销售
                    $datas[5][1]+=$data[5][1];//回水
                    $datas[5][2]+=$data[5][2];//笔数
                    $datas[5][3]+=$data[5][3];//中奖

                    $datas[6][0]+=$data[6][0];//销售
                    $datas[6][1]+=$data[6][1];//回水
                    $datas[6][2]+=$data[6][2];//笔数
                    $datas[6][3]+=$data[6][3];//中奖

                    //三定
                    $datas[7][0]+=$data[7][0];//销售
                    $datas[7][1]+=$data[7][1];//回水
                    $datas[7][2]+=$data[7][2];//笔数
                    $datas[7][3]+=$data[7][3];//中奖

                    $datas[8][0]+=$data[8][0];//销售
                   $datas[8][1]+=$data[8][1];//回水
                    $datas[8][2]+=$data[8][2];//笔数
                    $datas[8][3]+=$data[8][3];//中奖

                    $datas[9][0]+=$data[9][0];//销售
                    $datas[9][1]+=$data[9][1];//回水
                    $datas[9][2]+=$data[9][2];//笔数
                    $datas[9][3]+=$data[9][3];//中奖

                    $datas[10][0]+=$data[10][0];//销售
                    $datas[10][1]+=$data[10][1];//回水
                    $datas[10][2]+=$data[10][2];//笔数
                    $datas[10][3]+=$data[10][3];//中奖

                    //其他
                    $datas[11][0]+=$data[11][0];//销售
                    $datas[11][1]+=$data[11][1];//回水
                    $datas[11][2]+=$data[11][2];//笔数
                    $datas[11][3]+=$data[11][3];//中奖

                    $datas[12][0]+=$data[12][0];//销售
                    $datas[12][1]+=$data[12][1];//回水
                    $datas[12][2]+=$data[12][2];//笔数
                    $datas[12][3]+=$data[12][3];//中奖

                    $datas[13][0]+=$data[13][0];//销售
                    $datas[13][1]+=$data[13][1];//回水
                    $datas[13][2]+=$data[13][2];//笔数
                    $datas[13][3]+=$data[13][3];//中奖

                    $datas[14][0]+=$data[14][0];//销售
                    $datas[14][1]+=$data[14][1];//回水
                    $datas[14][2]+=$data[14][2];//笔数
                    $datas[14][3]+=$data[14][3];//中奖
                    //
                    $datas['ding21']+=$data['ding21'];
                    $datas['ding22']+=$data['ding22'];
                    $datas['ding23']+=$data['ding23'];
                    $datas['ding24']+=$data['ding24'];

                    $datas['ding31']+=$data['ding31'];
                    $datas['ding32']+=$data['ding32'];
                    $datas['ding33']+=$data['ding33'];
                    $datas['ding34']+=$data['ding34'];
                   }
                    ////
                    $data['name']=date('m-d',$t1[1]).'('.$k1.')';
                    $data1[]=$data;
                }  
               
                $data='';  
                $money1='';
                $money='';
                $win='';
            } 
        }
       //dump($datas);
       //  $data2=$data1;
       // if(isset($data2) && !empty($data2)){
       //      $couts=count($data2);
       //      foreach ($data2[0] as $key => $val) {
       //          if (isset($data2[1][$key])) {
       //              $data2[0][$key] += $data2[1][$key];
       //          }
       //           if (isset($data2[2][$key])) {
       //              $data2[0][$key] += $data2[2][$key];
       //          }
       //           if (isset($data2[3][$key])) {
       //              $data2[0][$key] += $data2[3][$key];
       //          }
       //           if (isset($data2[4][$key])) {
       //              $data2[0][$key] += $data2[4][$key];
       //          }
       //           if (isset($data2[5][$key])) {
       //              $data2[0][$key] += $data2[5][$key];
       //          }
       //           if (isset($data2[6][$key])) {
       //              $data2[0][$key] += $data2[6][$key];
       //          }
       //           if (isset($data2[7][$key])) {
       //              $data2[0][$key] += $data2[7][$key];
       //          }
       //           if (isset($data2[8][$key])) {
       //              $data2[0][$key] += $data2[8][$key];
       //          }
       //           if (isset($data2[9][$key])) {
       //              $data2[0][$key] += $data2[9][$key];
       //          }
       //           if (isset($data2[10][$key])) {
       //              $data2[0][$key] += $data2[10][$key];
       //          }
       //           if (isset($data2[11][$key])) {
       //              $data2[0][$key] += $data2[11][$key];
       //          }
       //      }
       // }

       // dump($data1);
    // dump(array_reverse($qishu));
        $titles=utype();//下级标题
        $this->assign('titles',$titles[0]);//
        $this->assign('stime',$stime);//搜索时间条件
        $this->assign('etime',$etime);//搜索时间条件
        $this->assign('qishu1',$qishu1);//搜索期数
        $this->assign('qishu2',$qishu2);//搜索期数
        $this->assign('userid',$userid);//搜索用户ID
        $this->assign('userID',$userID);//会员搜索ID
         $this->assign('user',$arrs[1]);//所有下级用户
         $this->assign('qishu3',array_reverse($qishus));//所有期数
         $this->assign('qishu4',$qishus);//所有期数
         $this->assign('data',$data1);//数据
        $this->assign('data2',$datas);//数据的汇总   
        $this->display();

    }
    //月分账
    public function contribute(){
        $qishu1=I('get.qishu');//搜索期数
        $userid=I('get.userid');//搜索下级会员
        $arrs=users($userid);//得到下级会员
        $qishu=qishus();//得到期数
        if(!empty($qishu1)){
            $where['qishu']=$qishu1;
            $qishu1=$qishu1; 
        }else{
           $where['qishu']=$qishu[0]['qishu'];
           $qishu1=$qishu[0]['qishu'];        
        }
        if(!empty($arrs)){
            //$where['uid']=array('in',$arrs[0]);
        }
           
        if(!empty($arrs)){
            $arr=M('bet')->where($where)->select();
            if($arr){
                foreach($arr as $k=>$v){   
                    $datas[date('m',strtotime($v['addtime']))]='';//分组
                }  
                if($datas){
                    foreach($datas as $k1=>$v1){ 
                        foreach($arr as $k2=>$v2){ 
                            if($k1==date('m',strtotime($v2['addtime']))){
                                $data['money']+=$v2['money'];
                                $data['sum']+=1;
                                $data['md']=date('m',strtotime($v2['addtime'])).'('.$v2['qishu'].')';
                                $data2['sums']+=1;
                                $data2['moneys']+=$v2['money'];
                            }  
                        }  
                        $data1[]=$data;
                    } 
                }
            }            
        }

      
     
        $this->assign('qishu1',$qishu1);//搜索期数
        $this->assign('userid',$userid);//搜索用户ID
        $this->assign('user',$arrs[1]);//所有下级用户
        $this->assign('qishu',$qishu);//所有期数
        $this->assign('data1',$data1);//数据
        //$this->assign('data2',$data2);//数据的汇总      
        $this->display();
    }

    //贡献
    public function contribution(){
        $this->display(); 
    }

    //公共方法
    private function getData($v){

    }

    //号码销售统计
    public function haomaData(){
    

        $qishu1=I('get.qishu');
        $type=I('get.type');
        $types=I('get.types');
        switch ($types) {
            case 91:
            $where['types']='口口XX'; 
            break;
            case 92:
            $where['types']='口X口X'; 
            break;
            case 93:
            $where['types']='口XX口'; 
            break;
            case 94:
            $where['types']='X口X口'; 
            break;
            case 95:
            $where['types']='X口口X'; 
            break;
            case 96:
            $where['types']='XX口口'; 
            break;
            case 97:
            $where['types']='口口口X'; 
            break;
            case 98:
            $where['types']='口口X口'; 
            break;
            case 99:
            $where['types']='口X口口'; 
            break;
            case 100:
            $where['types']='X口口口'; 
            break;
            case 101:
            $where['types']='4定'; 
            $t1='0';
            break;
            case 102:
            $where['types']='4定'; 
            $t1='1';
            break;
            case 103:
            $where['types']='4定';
            $t1='2'; 
            break;
            case 104:
            $where['types']='4定'; 
            $t1='3';
            break;
            case 105:
            $where['types']='4定'; 
            $t1='4';
            break;
            case 106:
            $where['types']='4定'; 
            $t1='5';
            break;
            case 107:
            $where['types']='4定';
            $t1='6'; 
            break;
            case 108:
            $where['types']='4定';
            $t1='7'; 
            break;
            case 109:
            $where['types']='4定'; 
            $t1='8';
            break;
            case 110:
            $where['types']='4定'; 
            $t1='9';
            break;
            default:
            $where['types']='口口XX'; 
            $type=2;
                break;
        }
        $qishu=qishus();
        //得到当前期的下注
        if(empty($qishu1)){
            $where['qishu']=$qishu[0]['qishu']; 
        }else{
            $where['qishu']=$qishu1; 
        }
        $where['js']=0; 
        //dump($where);
        //$where['qishu']=11;
        $data=M('bet')->field('sum(money) as moneys, sum(topmoney) as topmoneys,mingxi_2')->where($where)->group('mingxi_2')->select();
        if(!empty($data)){
            foreach($data as $k=>$v){
                $data1[]=$v['mingxi_2'];
                $xiazhu[$v['mingxi_2']]=$v['moneys']-$v['topmoneys'];
            }
        }
        //dump($type);
     
        //列表数据
        if(empty($type)|| $type==2){

           for ($i=0;$i<=9;$i++){
                $html.='<tr>';
                $html.='<td style="text-align:center;">'.$i.'头销量</td>'; 
                for ($j=0;$j<=9;$j++){
                    switch ($types) {
                        case 91:
                         $name='头';
                         $haoma1=$i.$j.'XX'; 
                        break;
                        case 92:
                         $name='头';
                         $haoma1=$i.'X'.$j.'X';
                        //$where['types']='口X口X'; 
                        break;
                        case 93:
                        $haoma1=$i.'XX'.$j;
                        $name='头';
                        //$where['types']='口XX口'; 
                        break;
                        case 94:
                        $haoma1='X'.$i.'X'.$j;
                        $name='百位';
                        //$where['types']='X口X口'; 
                        break;
                        case 95:
                        $haoma1='X'.$i.$j.'X';
                        $name='百位';
                        //$where['types']='X口口X'; 
                        break;
                        case 96:
                        $haoma1='XX'.$i.$j;
                        $name='十位';
                        //$where['types']='XX口口'; 
                        break;
                        default:
                         $haoma1=$i.$j.'XX';
                         $name='头';
                        break;
                    }
                   
                    $html.='<td style="background-color:#CEFFE7;text-align:center;">'.$haoma1.'(号码)</td>';
                }
                 $html.='<td style="text-align:center;">'.$i.$name.'合计(金额)</td>'; 
                $html.='</tr>';
                $html.='<tr><td>&nbsp;</td>';
                for ($j=0;$j<=9;$j++){
                     switch ($types) {
                        case 91:
                         $haoma=$i.$j.'XX'; 
                        break;
                        case 92:
                         $haoma=$i.'X'.$j.'X';
                        break;
                        case 93:
                        $haoma=$i.'XX'.$j; 
                        break;
                        case 94:
                        $haoma='X'.$i.'X'.$j;
                        break;
                        case 95:
                        $haoma='X'.$i.$j.'X'; 
                        break;
                        case 96:
                        $haoma='XX'.$i.$j;
                        break;
                        default:
                         $haoma=$i.$j.'XX';
                        break;
                    }
                   //$haoma=$i.$j.'XX';
                    if(in_array(''.$haoma.'',$data1)){
                        if(intval($xiazhu[''.$haoma.'']) <=10){
                            $html.='<td style="text-align:center;background-color:#6ed86e">'.$xiazhu[''.$haoma.''].'</td>';
                        }elseif( intval($xiazhu[''.$haoma.'']) >50){
                            $html.='<td style="text-align:center;background-color:red"">'.$xiazhu[''.$haoma.''].'</td>';
                        }else{
                          $html.='<td style="text-align:center;background-color:#d8922f"">'.$xiazhu[''.$haoma.''].'</td>';  
                        }
                        
                        $moneys1+=$xiazhu[''.$haoma.''];
                    }else{
                        $html.='<td style="text-align:center;">&nbsp</td>';
                    }
                    $money0+=0;
                    $money1+=0;
                    $money2+=0;
                    $money3+=0;
                    $money4+=0;
                    $money5+=0;
                    $money6+=0;
                    $money7+=0;
                    $money8+=0;
                    $money9+=0;
                    switch ($j) {
                        case 0:
                        $money0+=$xiazhu[''.$haoma.''];
                            break;
                        case 1:
                        $money1+=$xiazhu[''.$haoma.''];
                            break;
                        case 2:
                        $money2+=$xiazhu[''.$haoma.''];
                            break;
                        case 3:
                        $money3+=$xiazhu[''.$haoma.''];
                            break;
                        case 4:
                        $money4+=$xiazhu[''.$haoma.''];
                            break;
                        case 5:
                        $money5+=$xiazhu[''.$haoma.''];
                            break;
                        case 6:
                        $money6+=$xiazhu[''.$haoma.''];
                            break;
                        case 7:
                        $money7+=$xiazhu[''.$haoma.''];
                            break;
                        case 8:
                        $money8+=$xiazhu[''.$haoma.''];
                            break;
                        case 9:
                        $money9+=$xiazhu[''.$haoma.''];
                            break;
                        default:
                           
                            break;
                    }
                   
                } 
                //$html.='<td style="text-align:center;">'.$moneys1.'</td>';
                if(intval($moneys1) <=10){
                    $html.='<td style="text-align:center;background-color:#6ed86e">'.$moneys1.'</td>';
                }elseif( intval($moneys1) >50){
                    $html.='<td style="text-align:center;background-color:red"">'.$moneys1.'</td>';
                }else{
                  $html.='<td style="text-align:center;background-color:#d8922f"">'.$moneys1.'</td>';  
                }
                $html.='</tr>';
                $sum+=$moneys1;
                $moneys1='';
            }
            switch ($types) {
                        case 91:
                         $name1='百位';
                        break;
                        case 92:
                         $name1='十位';
                        //$where['types']='口X口X'; 
                        break;
                        case 93:
                        $name1='尾';
                        //$where['types']='口XX口'; 
                        break;
                        case 94:
                        //$haoma1='X'.$i.'X'.$j;
                        $name1='尾';
                        //$where['types']='X口X口'; 
                        break;
                        case 95:
                       // $haoma1='X'.$i.$j.'X';
                        $name1='十位';
                        //$where['types']='X口口X'; 
                        break;
                        case 96:
                        $haoma1='XX'.$i.$j;
                        $name1='尾';
                        //$where['types']='XX口口'; 
                        break;
                        default:
                         $name1='百位';
                        break;
                    }
             $html.='<tr><td>&nbsp;</td><td style="text-align:center;">0'.$name1.'合计(金额)</td><td style="text-align:center;">1'.$name1.'合计(金额)</td><td style="text-align:center;">2'.$name1.'合计(金额)</td><td style="text-align:center;">3'.$name1.'合计(金额)</td><td style="text-align:center;">4'.$name1.'合计(金额)</td><td style="text-align:center;">5'.$name1.'合计(金额)</td><td style="text-align:center;">6'.$name1.'合计(金额)</td><td style="text-align:center;">7'.$name1.'合计</td><td style="text-align:center;">8'.$name1.'合计(金额)</td><td style="text-align:center;">9'.$name1.'合计(金额)</td><td style="text-align:center;">总额合计(金额)</td></tr>';

             $html.='<tr><td>&nbsp;</td>';
            if(intval($money0) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money0.'</td>';
            }elseif( intval($money0) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money0.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money0.'</td>';  
            }
            if(intval($money1) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money1.'</td>';
            }elseif( intval($money1) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money1.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money1.'</td>';  
            }
            if(intval($money2) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money2.'</td>';
            }elseif( intval($money2) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money2.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money2.'</td>';  
            }
            if(intval($money3) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money3.'</td>';
            }elseif( intval($money3) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money3.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money3.'</td>';  
            }
            if(intval($money4) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money4.'</td>';
            }elseif( intval($money4) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money4.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money4.'</td>';  
            }
            if(intval($money5) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money5.'</td>';
            }elseif( intval($money5) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money5.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money5.'</td>';  
            }
            if(intval($money6) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money6.'</td>';
            }elseif( intval($money6) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money6.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money6.'</td>';  
            }
            if(intval($money7) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money7.'</td>';
            }elseif( intval($money7) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money7.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money7.'</td>';  
            }
            if(intval($money8) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money8.'</td>';
            }elseif( intval($money8) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money8.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money8.'</td>';  
            }
            if(intval($money9) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money9.'</td>';
            }elseif( intval($money9) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money9.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money9.'</td>';  
            }
            if(intval($sum) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$sum.'</td>';
            }elseif( intval($sum) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$sum.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$sum.'</td>';  
            }
             // $html.='<td style="text-align:center;">'.$money0.'</td>';
             // $html.='<td style="text-align:center;">'.$money1.'</td>';
             // $html.='<td style="text-align:center;">'.$money2.'</td>';
             // $html.='<td style="text-align:center;">'.$money3.'</td>';
             // $html.='<td style="text-align:center;">'.$money4.'</td>';
             // $html.='<td style="text-align:center;">'.$money5.'</td>';
             // $html.='<td style="text-align:center;">'.$money6.'</td>';
             // $html.='<td style="text-align:center;">'.$money7.'</td>';
             // $html.='<td style="text-align:center;">'.$money8.'</td>';
             // $html.='<td style="text-align:center;">'.$money9.'</td>';
             // $html.='<td style="text-align:center;">'.$sum.'</td>';
             $html.='</tr>';
        }elseif($type==3){
            for ($i=0;$i<=9;$i++){
                 for ($j1=0;$j1<=9;$j1++){
                $html.='<tr>';
                $html.='<td style="text-align:center;">'.$i.'头销量</td>'; 
                for ($j=0;$j<=9;$j++){
                    switch ($types) {
                        case 97:
                         $name='头';
                         $haoma1=$i.$j1.$j.'X'; 
                        break;
                        case 98:
                         $name='头';
                         $haoma1=$i.$j1.'X'.$j;
                        //$where['types']='口X口X'; 
                        break;
                        case 99:
                        $haoma1=$i.'X'.$j1.$j;
                        $name='头';
                        //$where['types']='口XX口'; 
                        break;
                        case 100:
                        $haoma1='X'.$i.$j1.$j;
                        $name='百位';
                        //$where['types']='X口X口'; 
                        break;
                        default:
                         $haoma1=$i.$j1.$i.'X'; 
                         $name='头';
                        break;
                    }
                   
                    $html.='<td style="background-color:#CEFFE7;text-align:center;">'.$haoma1.'(号码)</td>';
                }
                 $html.='<td style="text-align:center;">'.$i.$name.'合计(金额)</td>'; 
                $html.='</tr>';
           
               $html.='<tr><td>&nbsp;</td>';
                for ($j=0;$j<=9;$j++){
                    switch ($types) {
                        case 97:
                         //$haoma=$i.$j.$i.'X'; 
                         $haoma=$i.$j1.$j.'X'; 
                        break;
                        case 98:
                         //$haoma=$i.$j.'X'.$i;
                         $haoma=$i.$j1.'X'.$j;
                        break;
                        case 99:
                        //$haoma=$i.'X'.$j.$i; 
                        $haoma=$i.'X'.$j1.$j; 
                        break;
                        case 100:
                        //$haoma='X'.$i.$j.$i;
                        $haoma='X'.$i.$j1.$j;
                        break;
                        default:
                         //$haoma=$i.$j.$i.'X'; 
                         $haoma=$i.$j1.$j.'X'; 
                        break;
                    }
                   //$haoma=$i.$j.'XX';
                    if(in_array(''.$haoma.'',$data1)){
                        //$html.='<td style="text-align:center;">'.$xiazhu[''.$haoma.''].'</td>';
                        if(intval($xiazhu[''.$haoma.'']) <=10){
                            $html.='<td style="text-align:center;background-color:#6ed86e">'.$xiazhu[''.$haoma.''].'</td>';
                        }elseif( intval($xiazhu[''.$haoma.'']) >50){
                            $html.='<td style="text-align:center;background-color:red"">'.$xiazhu[''.$haoma.''].'</td>';
                        }else{
                          $html.='<td style="text-align:center;background-color:#d8922f"">'.$xiazhu[''.$haoma.''].'</td>';  
                        }
                        $moneys1+=$xiazhu[''.$haoma.''];
                    }else{
                        $html.='<td style="text-align:center;">&nbsp</td>';
                    }
                    switch ($j) {
                        case 0:
                        $money0+=$xiazhu[''.$haoma.''];
                            break;
                        case 1:
                        $money1+=$xiazhu[''.$haoma.''];
                            break;
                        case 2:
                        $money2+=$xiazhu[''.$haoma.''];
                            break;
                        case 3:
                        $money3+=$xiazhu[''.$haoma.''];
                            break;
                        case 4:
                        $money4+=$xiazhu[''.$haoma.''];
                            break;
                        case 5:
                        $money5+=$xiazhu[''.$haoma.''];
                            break;
                        case 6:
                        $money6+=$xiazhu[''.$haoma.''];
                            break;
                        case 7:
                        $money7+=$xiazhu[''.$haoma.''];
                            break;
                        case 8:
                        $money8+=$xiazhu[''.$haoma.''];
                            break;
                        case 9:
                        $money9+=$xiazhu[''.$haoma.''];
                            break;
                        default:
                           
                            break;
                    }
                   
                } 
                //$html.='<td style="text-align:center;">'.$moneys1.'</td>';
                if(intval($moneys1) <=10){
                    $html.='<td style="text-align:center;background-color:#6ed86e">'.$moneys1.'</td>';
                }elseif( intval($moneys1) >50){
                    $html.='<td style="text-align:center;background-color:red"">'.$moneys1.'</td>';
                }else{
                  $html.='<td style="text-align:center;background-color:#d8922f"">'.$moneys1.'</td>';  
                }
                $html.='</tr>';
                $sum+=$moneys1;
                $moneys1='';
                
                }
            }
            switch ($types) {
                        case 97:
                         $name1='十位';
                        break;
                        case 98:
                         $name1='尾';//百位
                        //$where['types']='口X口X'; 
                        break;
                        case 99:
                        $name1='尾';
                        //$where['types']='口XX口'; 
                        break;
                        case 100:
                        //$haoma1='X'.$i.'X'.$j;
                        $name1='尾';
                        //$where['types']='X口X口'; 
                        break;
                        default:
                         $name1='百位';
                        break;
                    }
             $html.='<tr><td>&nbsp;</td><td style="text-align:center;">0'.$name1.'合计(金额)</td><td style="text-align:center;">1'.$name1.'合计(金额)</td><td style="text-align:center;">2'.$name1.'合计(金额)</td><td style="text-align:center;">3'.$name1.'合计(金额)</td><td style="text-align:center;">4'.$name1.'合计(金额)</td><td style="text-align:center;">5'.$name1.'合计(金额)</td><td style="text-align:center;">6'.$name1.'合计(金额)</td><td style="text-align:center;">7'.$name1.'合计(金额)</td><td style="text-align:center;">8'.$name1.'合计(金额)</td><td style="text-align:center;">9'.$name1.'合计(金额)</td><td style="text-align:center;">总额合计(金额)</td></tr>';

            $html.='<tr><td>&nbsp;</td>';

            if(intval($money0) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money0.'</td>';
            }elseif( intval($money0) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money0.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money0.'</td>';  
            }
            if(intval($money1) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money1.'</td>';
            }elseif( intval($money1) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money1.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money1.'</td>';  
            }
            if(intval($money2) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money2.'</td>';
            }elseif( intval($money2) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money2.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money2.'</td>';  
            }
            if(intval($money3) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money3.'</td>';
            }elseif( intval($money3) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money3.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money3.'</td>';  
            }
            if(intval($money4) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money4.'</td>';
            }elseif( intval($money4) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money4.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money4.'</td>';  
            }
            if(intval($money5) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money5.'</td>';
            }elseif( intval($money5) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money5.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money5.'</td>';  
            }
            if(intval($money6) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money6.'</td>';
            }elseif( intval($money6) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money6.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money6.'</td>';  
            }
            if(intval($money7) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money7.'</td>';
            }elseif( intval($money7) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money7.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money7.'</td>';  
            }
            if(intval($money8) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money8.'</td>';
            }elseif( intval($money8) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money8.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money8.'</td>';  
            }
            if(intval($money9) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money9.'</td>';
            }elseif( intval($money9) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money9.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money9.'</td>';  
            }
            if(intval($sum) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$sum.'</td>';
            }elseif( intval($sum) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$sum.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$sum.'</td>';  
            } 
            $html.='</tr>';
            // $html.='<tr><td>&nbsp;</td><td style="text-align:center;">'.$money0.'</td><td style="text-align:center;">'.$money1.'</td><td style="text-align:center;">'.$money2.'</td><td style="text-align:center;">'.$money3.'</td><td style="text-align:center;">'.$money4.'</td><td style="text-align:center;">'.$money5.'</td><td style="text-align:center;">'.$money6.'</td><td style="text-align:center;">'.$money7.'</td><td style="text-align:center;">'.$money8.'</td><td style="text-align:center;">'.$money9.'</td><td style="text-align:center;">'.$sum.'</td></tr>';
           
        }elseif($type==4){
            for ($i=0;$i<=9;$i++){
                 for ($j1=0;$j1<=9;$j1++){
                $html.='<tr>';
                $html.='<td style="text-align:center;">'.$t1.'头销量</td>'; 
                for ($j=0;$j<=9;$j++){
                    // switch ($types) {
                    //     case 101:
                          $name=$t1.'头';
                         $haoma1=$t1.$i.$j1.$j; 
                    //     break;
                    //     case 98:
                    //      $name='头';
                    //      $haoma1=$t1.$i.$j1.$j; 
                    //     //$where['types']='口X口X'; 
                    //     break;
                    //     case 99:
                    //     $haoma1=$t1.$i.$j1.$j; 
                    //     $name='头';
                    //     //$where['types']='口XX口'; 
                    //     break;
                    //     case 100:
                    //     $haoma1=$t1.$i.$j1.$j; 
                    //     $name='百位';
                    //     //$where['types']='X口X口'; 
                    //     break;
                    //     default:
                    //      $haoma1=$t1.$i.$j1.$j; 
                    //      $name='头';
                    //     break;
                    // }
                   
                    $html.='<td style="background-color:#CEFFE7;text-align:center;">'.$haoma1.'(号码)</td>';
                }
                 $html.='<td style="text-align:center;">'.$name.'合计(金额)</td>'; 
                $html.='</tr>';
           
               $html.='<tr><td>&nbsp;</td>';
                for ($j=0;$j<=9;$j++){
                    // switch ($types) {
                    //     case 97:
                         //$haoma=$i.$j.$i.'X'; 
                          $haoma=$t1.$i.$j1.$j;  
                    //     break;
                    //     case 98:
                    //      //$haoma=$i.$j.'X'.$i;
                    //      $haoma=$i.$j1.'X'.$j;
                    //     break;
                    //     case 99:
                    //     //$haoma=$i.'X'.$j.$i; 
                    //     $haoma=$i.'X'.$j1.$j; 
                    //     break;
                    //     case 100:
                    //     //$haoma='X'.$i.$j.$i;
                    //     $haoma='X'.$i.$j1.$j;
                    //     break;
                    //     default:
                    //      //$haoma=$i.$j.$i.'X'; 
                    //      $haoma=$i.$j1.$j.'X'; 
                    //     break;
                    // }
                   //$haoma=$i.$j.'XX';
                    if(in_array(''.$haoma.'',$data1)){
                        //$html.='<td style="text-align:center;">'.$xiazhu[''.$haoma.''].'</td>';
                        if(intval($xiazhu[''.$haoma.'']) <=10){
                            $html.='<td style="text-align:center;background-color:#6ed86e">'.$xiazhu[''.$haoma.''].'</td>';
                        }elseif( intval($xiazhu[''.$haoma.'']) >50){
                            $html.='<td style="text-align:center;background-color:red"">'.$xiazhu[''.$haoma.''].'</td>';
                        }else{
                          $html.='<td style="text-align:center;background-color:#d8922f"">'.$xiazhu[''.$haoma.''].'</td>';  
                        }
                        $moneys1+=$xiazhu[''.$haoma.''];
                    }else{
                        $html.='<td style="text-align:center;">&nbsp</td>';
                    }
                    switch ($j) {
                        case 0:
                        $money0+=$xiazhu[''.$haoma.''];
                            break;
                        case 1:
                        $money1+=$xiazhu[''.$haoma.''];
                            break;
                        case 2:
                        $money2+=$xiazhu[''.$haoma.''];
                            break;
                        case 3:
                        $money3+=$xiazhu[''.$haoma.''];
                            break;
                        case 4:
                        $money4+=$xiazhu[''.$haoma.''];
                            break;
                        case 5:
                        $money5+=$xiazhu[''.$haoma.''];
                            break;
                        case 6:
                        $money6+=$xiazhu[''.$haoma.''];
                            break;
                        case 7:
                        $money7+=$xiazhu[''.$haoma.''];
                            break;
                        case 8:
                        $money8+=$xiazhu[''.$haoma.''];
                            break;
                        case 9:
                        $money9+=$xiazhu[''.$haoma.''];
                            break;
                        default:
                           
                            break;
                    }
                   
                } 
                //$html.='<td style="text-align:center;">'.$moneys1.'</td>';
                if(intval($moneys1) <=10){
                    $html.='<td style="text-align:center;background-color:#6ed86e">'.$moneys1.'</td>';
                }elseif( intval($moneys1) >50){
                    $html.='<td style="text-align:center;background-color:red"">'.$moneys1.'</td>';
                }else{
                  $html.='<td style="text-align:center;background-color:#d8922f"">'.$moneys1.'</td>';  
                }
                $html.='</tr>';
                $sum+=$moneys1;
                $moneys1='';
                
                }
            }
            
            $name1='尾';
             $html.='<tr><td>&nbsp;</td><td style="text-align:center;">0'.$name1.'合计(金额)</td><td style="text-align:center;">1'.$name1.'合计(金额)</td><td style="text-align:center;">2'.$name1.'合计(金额)</td><td style="text-align:center;">3'.$name1.'合计(金额)</td><td style="text-align:center;">4'.$name1.'合计(金额)</td><td style="text-align:center;">5'.$name1.'合计(金额)</td><td style="text-align:center;">6'.$name1.'合计(金额)</td><td style="text-align:center;">7'.$name1.'合计(金额)</td><td style="text-align:center;">8'.$name1.'合计(金额)</td><td style="text-align:center;">9'.$name1.'合计(金额)</td><td style="text-align:center;">总额合计(金额)</td></tr>';

            $html.='<tr><td>&nbsp;</td>';

            if(intval($money0) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money0.'</td>';
            }elseif( intval($money0) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money0.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money0.'</td>';  
            }
            if(intval($money1) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money1.'</td>';
            }elseif( intval($money1) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money1.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money1.'</td>';  
            }
            if(intval($money2) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money2.'</td>';
            }elseif( intval($money2) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money2.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money2.'</td>';  
            }
            if(intval($money3) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money3.'</td>';
            }elseif( intval($money3) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money3.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money3.'</td>';  
            }
            if(intval($money4) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money4.'</td>';
            }elseif( intval($money4) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money4.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money4.'</td>';  
            }
            if(intval($money5) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money5.'</td>';
            }elseif( intval($money5) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money5.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money5.'</td>';  
            }
            if(intval($money6) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money6.'</td>';
            }elseif( intval($money6) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money6.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money6.'</td>';  
            }
            if(intval($money7) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money7.'</td>';
            }elseif( intval($money7) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money7.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money7.'</td>';  
            }
            if(intval($money8) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money8.'</td>';
            }elseif( intval($money8) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money8.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money8.'</td>';  
            }
            if(intval($money9) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$money9.'</td>';
            }elseif( intval($money9) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$money9.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$money9.'</td>';  
            }
            if(intval($sum) <=10){
                $html.='<td style="text-align:center;background-color:#6ed86e">'.$sum.'</td>';
            }elseif( intval($sum) >50){
                $html.='<td style="text-align:center;background-color:red"">'.$sum.'</td>';
            }else{
              $html.='<td style="text-align:center;background-color:#d8922f"">'.$sum.'</td>';  
            } 
            $html.='</tr>';
           
           
        }
        
        $this->assign('qishu1',$qishu1);
        $this->assign('qishu',$qishu);
        $this->assign('html',$html);
        $this->assign('types',$types);
        $this->assign('type',$type);
        $this->display();
    }





}
