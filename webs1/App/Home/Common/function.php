

<?php

function mStatus1(){
    //最后一期是关闭销售状态
    $mission=M('opentime')->order('id desc')->find();

    if($mission['m_status']==3 || $mission['m_status']==2){//状态开奖了
      $titles='已封盘，尚未开盘';
      $titles1='已关盘';
      $status=2;
    }elseif($mission['m_status']==1){
      $status=1;
      if(strtotime($mission['fengpan'])>time() || time()<=strtotime($mission['kaijiang'])){//封盘时间减去当前时间==离开盘时间
        $titles1='离停盘还有:';
          $time1=strtotime($mission['fengpan'])-time();  
      //}elseif(time()<=strtotime($mission['kaijiang'])){////封盘时间减去当前时间==离开盘时间
        $titles2='离开奖还有:';
       // $titles1='已停盘';
          $time2=strtotime($mission['kaijiang'])-time();
      }else{
          $status=2;
      }

    }
    $arr=array($status,$time1,$titles1,$time2,$titles2);
    return $arr;
    //未开始销售状态
    // if($mission['ok']==1){
    //     $status=5;
    // }else{
    //     $status=3;
    //     //$time=intval($mission['m_seal'])-intval(time());
    //     if(strtotime($mission['fengpan'])>time()){
    //     //  echo '过了封盘时间，等待开奖';
    //     // }else{//开奖时间实时更新
    //         $status=1;
    //         $time=strtotime($mission['fengpan'])-time();    
    //     }
    // }
    // $arr=array($status,$time);
    // return $arr;
    
}
function  getUser(){
    //超管(admin),股东(partner),总代理(agencys),代理(agency),测试(demo)用户类型
    $admin=M('admin');
    $user=M('user');
   
    $utype=session('autype');
    $uid=session('auid');
    if($utype=='admin'){//超管
        //$where['status']=1;
        $users=$user->field('uid')->where($where)->select();
    }elseif($utype=='partner'){//股东
        $where['top_uid']=$uid;
        $where['au_type']='agencys';
        $admins=$admin->field('au_id')->where($where)->select();//得到总代理
        if(!empty($admins)){
            foreach($admins as $k=>$v){
                if($v['au_id']){
                    $uid2.=$v['au_id'].',';
                }
            }
            $where1['top_uid']=array('in',rtrim($uid2,','));//得到所有代理
            $admins1=$admin->field('au_id')->where($where1)->select();
            if(!empty($admins1)){
                foreach($admins1 as $k1=>$v1){
                    if($v1['au_id']){
                        $uid1.=$v1['au_id'].',';
                    }
                }
                $where2['top_uid']=array('in',rtrim($uid1,','));//得到所有会员
                //$where2['status']=1;
                $users=$user->field('uid')->where($where2)->select();
            }
        }
    }elseif($utype=='agencys'){//总代理
        $where['top_uid']=$uid;
        $where['au_type']='agency';
        $admins=$admin->field('au_id')->where($where)->select();//得到所有代理

        if(!empty($admins)){
            foreach($admins as $k=>$v){
                if($v['au_id']){
                    $uid1.=$v['au_id'].',';
                }
            }
            $where1['top_uid']=array('in',rtrim($uid1,','));//得到所有会员
            //return $where1;exit;
            //$where1['status']=1;
            $users=$user->field('uid')->where($where1)->select();
        }
    }elseif($utype=='agency'){//代理
        $where['top_uid']=$uid;//得到所有会员
        //$where['status']=1;
        $users=$user->field('uid')->where($where)->select();
    }

    if(!empty($users)){
        foreach($users as $k2=>$v2){
            if($v2['uid']){
                $arruid.=$v2['uid'].',';
            }
        }
        $userid=rtrim($arruid,',');
    }

    return $userid;
}
function users1($id){//得到所有股东及分成比
    $where['au_type']='partner';
    $where['qishu']=array('lt',$id);
    $data=M('admin')->field('au_name,au_proportion')->where($where)->select();
    return $data;
}
//
function users2($userids,$utype,$userid = 0){
//超管(admin),股东(partner),总代理(agencys),代理(agency),测试(demo)用户类型
        $admin=M('admin');
        $users=M('user');
        if($utype=='admin'){//超管(admin)
            $where3['top_uid']=$userids;//得打的股东
            $user=$admin->field('au_id,au_name,au_type')->where($where3)->select();
            if(!empty($userid)){
                $where['top_uid']=$userid; //得到的是总代理
                $user1=$admin->field('au_id,au_name')->where($where)->select();
                if($user1){//总代理
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$admin->field('au_id,au_name')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['au_id']){
                                $uid1.=$values1['au_id'].',';
                            }
                        }//代理
                        $where2['top_uid']=array('in',rtrim($uid1,','));
                        $user3=$users->field('uid,username')->where($where2)->select();
                        if($user3){
                            foreach($user3 as $keys2=>$values2){
                                if($values2['uid']){
                                    $uid2.=$values2['uid'].',';
                                }
                            }
                             $arruid=rtrim($uid2,',');
                        }
                    }
                }
            }else{
                
                $user4=$users->field('uid,username')->select();
                if($user4){
                    foreach($user4 as $keys3=>$values3){
                        if($values3['uid']){
                            $uid3.=$values3['uid'].',';
                        }
                    }
                     $arruid=rtrim($uid3,',');
                }
            }              
           
             
        }elseif($utype=='partner'){//股东
            $where3['top_uid']=$userids;
            $user=$admin->field('au_id,au_name,au_type')->where($where3)->select();
            if(!empty($userid)){
                $where['top_uid']=$userid; 
                $user1=$admin->field('au_id,au_name')->where($where)->select();
                if($user1){//代理用户ID
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$users->field('uid,username')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['uid']){
                                $uid1.=$values1['uid'].',';
                            }
                        }
                         $arruid=rtrim($uid1,',');
                    }
                   
                }
            }else{
                $user1=$user;
                if($user1){//总代理
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$admin->field('au_id,au_name')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['au_id']){
                                $uid1.=$values1['au_id'].',';
                            }
                        }//代理
                        $where2['top_uid']=array('in',rtrim($uid1,','));
                        $user3=$users->field('uid,username')->where($where2)->select();
                        if($user3){
                            foreach($user3 as $keys2=>$values2){
                                if($values2['uid']){
                                    $uid2.=$values2['uid'].',';
                                }
                            }
                             $arruid=rtrim($uid2,',');
                        }
                    }
                }
            }  
        }elseif($utype=='agencys'){//总代理
            $where3['top_uid']=$userids;  
            $user=$admin->field('au_id,au_name,au_type')->where($where3)->select();
            if(!empty($userid)){
                $where['top_uid']=$userid;
                $user1=$users->field('uid,username')->where($where)->select();
                if($user1){
                    foreach($user1 as $keys=>$values){
                        if($values['uid']){
                            $uid.=$values['uid'].',';
                        }
                    }
                    $arruid=rtrim($uid,',');
                } 
            }else{
                $user1=$user;
                if($user1){//代理用户ID
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$users->field('uid,username')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['uid']){
                                $uid1.=$values1['uid'].',';
                            }
                        }
                         $arruid=rtrim($uid1,',');
                    }
                   
                }
            }   
                
           
        }elseif($utype=='agency'){//代理
            $where1['top_uid']=$userids; 
            $user=$users->field('uid,username,u_type')->where($where1)->select();
            if(!empty($userid)){
                $arruid=$userid;
            }else{
                $user1=$user;
                if($user1){
                    foreach($user1 as $keys=>$values){
                        if($values['uid']){
                            $uid.=$values['uid'].',';
                        }
                    }
                    $arruid=rtrim($uid,',');
                } 
            }
        }
        $arrs=array($arruid,$user);
        return $arrs;

}
function users($userid=0){
//超管(admin),股东(partner),总代理(agencys),代理(agency),测试(demo)用户类型
        $admin=M('admin');
        $users=M('user');
        if(session('autype')=='admin'){//超管(admin)
            $where3['top_uid']=session('auid');//得打的股东
            $user=$admin->field('au_id,au_name,au_type')->where($where3)->select();
            if(!empty($userid)){
                $where['top_uid']=$userid; //得到的是总代理
                $user1=$admin->field('au_id,au_name')->where($where)->select();
                if($user1){//总代理
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$admin->field('au_id,au_name')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['au_id']){
                                $uid1.=$values1['au_id'].',';
                            }
                        }//代理
                        $where2['top_uid']=array('in',rtrim($uid1,','));
                        $user3=$users->field('uid,username')->where($where2)->select();
                        if($user3){
                            foreach($user3 as $keys2=>$values2){
                                if($values2['uid']){
                                    $uid2.=$values2['uid'].',';
                                }
                            }
                             $arruid=rtrim($uid2,',');
                        }
                    }
                }
            }else{
                
                $user4=$users->field('uid,username')->select();
                if($user4){
                    foreach($user4 as $keys3=>$values3){
                        if($values3['uid']){
                            $uid3.=$values3['uid'].',';
                        }
                    }
                     $arruid=rtrim($uid3,',');
                }
            }              
           
             
        }elseif(session('autype')=='partner'){//股东
            $where3['top_uid']=session('auid');
            $user=$admin->field('au_id,au_name,au_type')->where($where3)->select();
            if(!empty($userid)){
                $where['top_uid']=$userid; 
                $user1=$admin->field('au_id,au_name')->where($where)->select();
                if($user1){//代理用户ID
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$users->field('uid,username')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['uid']){
                                $uid1.=$values1['uid'].',';
                            }
                        }
                         $arruid=rtrim($uid1,',');
                    }
                   
                }
            }else{
                $user1=$user;
                if($user1){//总代理
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$admin->field('au_id,au_name')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['au_id']){
                                $uid1.=$values1['au_id'].',';
                            }
                        }//代理
                        $where2['top_uid']=array('in',rtrim($uid1,','));
                        $user3=$users->field('uid,username')->where($where2)->select();
                        if($user3){
                            foreach($user3 as $keys2=>$values2){
                                if($values2['uid']){
                                    $uid2.=$values2['uid'].',';
                                }
                            }
                             $arruid=rtrim($uid2,',');
                        }
                    }
                }
            }  
        }elseif(session('autype')=='agencys'){//总代理
            $where3['top_uid']=session('auid');  
            $user=$admin->field('au_id,au_name,au_type')->where($where3)->select();
            if(!empty($userid)){
                $where['top_uid']=$userid;
                $user1=$users->field('uid,username')->where($where)->select();
                if($user1){
                    foreach($user1 as $keys=>$values){
                        if($values['uid']){
                            $uid.=$values['uid'].',';
                        }
                    }
                    $arruid=rtrim($uid,',');
                } 
            }else{
                $user1=$user;
                if($user1){//代理用户ID
                    foreach($user1 as $keys=>$values){
                        if($values['au_id']){
                            $uid.=$values['au_id'].',';
                        }
                    }
                    $where1['top_uid']=array('in',rtrim($uid,','));
                    $user2=$users->field('uid,username')->where($where1)->select();
                    if($user2){
                        foreach($user2 as $keys1=>$values1){
                            if($values1['uid']){
                                $uid1.=$values1['uid'].',';
                            }
                        }
                         $arruid=rtrim($uid1,',');
                    }
                   
                }
            }   
                
           
        }elseif(session('autype')=='agency'){//代理
            $where1['top_uid']=session('auid'); 
            $user=$users->field('uid,username,u_type')->where($where1)->select();
            if(!empty($userid)){
                $arruid=$userid;
            }else{
                $user1=$user;
                if($user1){
                    foreach($user1 as $keys=>$values){
                        if($values['uid']){
                            $uid.=$values['uid'].',';
                        }
                    }
                    $arruid=rtrim($uid,',');
                } 
            }
        }
        $arrs=array($arruid,$user);
        return $arrs;

}

function qishus(){
    $data=M('opentime')->field('id,qishu,kaipan,m_status,m_time')->order('id desc')->select();
    return $data;
}

function news(){//->field('qishu')->order('id desc')
    $where['n_id']=1;
    $where['n_status']=1;
    $data=M('news')->where($where)->find();
    // if($data['n_status']!=1){
    //     $data='';
    // }
    return $data;
}
function utype($t=''){//超管(admin),股东(partner),总代理(agencys),代理(agency)
    if(empty($t)){
        $utype=session('autype');
    }else{
        $utype=$t;
    }
    
    if($utype=='admin'){
        $title='股东';
        $type='partner';
    }elseif($utype=='partner'){
        $title='总代理'; 
        $type='agencys';
    }elseif($utype=='agencys'){
        $title='代理'; 
        $type='agency';
    }elseif($utype=='agency'){
        $title='会员'; 
    }
    $arr=array($title,$type);
    return  $arr;
}
function utype1(){//超管(admin),股东(partner),总代理(agencys),代理(agency)
    // if(empty($t)){
        $utype=session('autype');
    // }else{
    //     $utype=$t;
    // }
    
    if($utype=='admin'){
        $title='超级管理员';
        $type='partner';
    }elseif($utype=='partner'){
        $title='股东'; 
        $type='agencys';
    }elseif($utype=='agencys'){
        $title='总代理'; 
        $type='agency';
    }elseif($utype=='agency'){
        $title='代理'; 
    }
    $arr=array($title,$type);
    return  $arr;
}

 function getUtype($userid){
    $utype=session('autype');
    $admin=M('admin');
    if($utype=='admin'){
        $type='partner';
    }elseif($utype=='partner'){
        $type='agencys';
    }elseif($utype=='agencys'){
        $type='agency';
    }
    $where['au_type']=$type;
    $data=$admin->field('au_id,au_name')->where($where)->select();
    // //得到相对应的会员
    // if(!empty($data)){
    //     foreach($){

    //     }
    // }
    $arr=array($data);
    return  $arr;
 }
 //超级管理员-->到得会员数据
 function  getUser1($userid){
    $utype=session('autype');
    $admin=M('admin');
    if($utype=='admin'){
        $where['top_uid']=$userid;
        $user=$admin->field('au_id,au_name')->where($where)->select();
        if($user1){//总代理
            foreach($user1 as $keys=>$values){
                if($values['au_id']){
                    $uid.=$values['au_id'].',';
                }
            }
            $where1['top_uid']=array('in',rtrim($uid,','));
            $user2=$admin->field('au_id,au_name')->where($where1)->select();
            if($user2){
                foreach($user2 as $keys1=>$values1){
                    if($values1['au_id']){
                        $uid1.=$values1['au_id'].',';
                    }
                }//代理
                $where2['top_uid']=array('in',rtrim($uid1,','));
                $user3=$users->field('uid,username')->where($where2)->select();
                if($user3){
                    foreach($user3 as $keys2=>$values2){
                        if($values2['uid']){
                            $uid2.=$values2['uid'].',';
                        }
                    }
                     $arruid=rtrim($uid2,',');
                }
            }
        } 
    }elseif($utype=='partner'){
        $type='agencys';
    }elseif($utype=='agencys'){
        $type='agency';
    }
 }

//得到所有代理用户
function user3($userid,$utype){
   // $utype=session('autype');
    $admin=M('admin');
    if($utype=='admin'){
        $where['au_type']='agency';
        $where['au_status']=1;
        $user=$admin->field('au_id,au_name')->where($where)->select();
        if($user){
            foreach($user as $k=>$v){
                if($v['au_id']){
                    $uid.=$v['au_id'].',';
                }
            }
             $arruid=rtrim($uid,',');
        }
       
    }elseif($utype=='partner'){
        $where['au_type']='agencys';
        $where['top_uid']=$userid;
        $user=$admin->field('au_id,au_name')->where($where)->select();
        if($user){//总代理
            foreach($user as $k=>$v){
                if($v['au_id']){
                    $uid.=$v['au_id'].',';
                }
            }
            $where1['top_uid']=array('in',rtrim($uid,','));
            $where1['au_type']='agency';
            $where1['au_status']=1;
            $user2=$admin->field('au_id,au_name')->where($where1)->select();
            if($user2){
                foreach($user2 as $keys1=>$values1){
                    if($values1['au_id']){
                        $uid1.=$values1['au_id'].',';
                    }
                }//代理
                $arruid=rtrim($uid1,',');
            }
        } 
    }elseif($utype=='agencys'){
        $where['au_type']='agency';
        $where['top_uid']=$userid;
        $where['au_status']=1;
        $user=$admin->field('au_id,au_name')->where($where)->select();
        if($user){
            foreach($user as $k=>$v){
                if($v['au_id']){
                    $uid.=$v['au_id'].',';
                }
            }
             $arruid=rtrim($uid,',');
        }
    }elseif($utype=='agency'){
        $where['au_type']='agency';
        $where['au_id']=$userid;
        $where['au_status']=1;
        $user=$admin->field('au_id,au_name')->where($where)->select();
        if($user){
            foreach($user as $k=>$v){
                if($v['au_id']){
                    $uid.=$v['au_id'].',';
                }
            }
             $arruid=rtrim($uid,',');
        }
    }elseif($utype=='member'){
        $where1['u_type']='member';
        $where1['uid']=$userid;
        $topUid=M('user')->field('top_uid')->where($where1)->find();
        if($topUid){
            $arruid=$topUid['top_uid'];
            //$user=$admin->field('au_id,au_name')->where($where)->select();
        }
        
        // if($user){
        //     foreach($user as $k=>$v){
        //         if($v['au_id']){
        //             $uid.=$v['au_id'].',';
        //         }
        //     }
        //      $arruid=rtrim($uid,',');
        // }
    }

    return $arruid;

}
//得到所有代理用户
function user4($userid){
    $where['top_uid']=$userid;
    $user=M('user')->field('uid')->where($where)->select();
    if($user){
        foreach($user as $k=>$v){
            if($v['uid']){
                $uid[]=$v['uid'];
            }
        }
    } 
    return $uid;    
}
//得到所有代理
function user5($utype,$auid){
    if($utype=='admin'){
        $where['au_type']='agency';
        $data=M('admin')->field('au_id,au_type')->where($where)->select();
    }elseif($utype=='partner'){
        $where['top_uid']=$auid;
        $where['au_type']='agencys';
        $admin=M('admin');
        $data1=$admin->field('au_id,au_type')->where($where)->select();

        if($data1){
            foreach($data1 as $k=>$v){
                if($v['au_id']){
                    $uid.=$v['au_id'].',';
                }
            }
             $arruid=rtrim($uid,',');
            $where1['top_uid']=array('in',$arruid);
            $where1['au_type']='agency';
             //return $uid;
            $data=$admin->field('au_id,au_type')->where($where1)->select();
        }

    }elseif($utype=='agencys'){
        $where['au_type']='agency';
         $where['top_uid']=$auid;
        $data=M('admin')->field('au_id,au_type')->where($where)->select();  
    }elseif($utype=='agency'){
        $where['au_type']='agency';
        $where['au_id']=$auid;
        $data=M('admin')->field('au_id,au_type')->where($where)->select();
    }
    return $data;
}





?>
