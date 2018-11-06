<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends CommonController
{
    //超管(admin),股东(partner),总代理(agencys),代理(agency)用户类型
    public function index()
    {
        $utype=session('autype');
        $uid=session('auid');
        $uid1=I('get.uid');
        $admins=M('admin');

        if( !empty($uid1))
        {
            $where['au_id']=$uid1;
            //得到当前用户的信用度
            $user=$admins->field('au_id,au_money,au_moneys,au_type')->where($where)->find();
            if( !empty($user) && $user['au_type'] == 'agency')
            {
                $where1['top_uid']=$user['au_id'];

                $users=M('user');
                $count=$users->where($where1)->count();
                $Page=new \Think\Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $show=$Page->show();// 分页显示输出
                $data=$users->where($where1)->order('uid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            }
            else if( !empty($user))
            {
                $where1['top_uid']=$user['au_id'];
                $utype1=utype($user['au_type']);//当前下级账号类型
                $where1['au_type']=$utype1[1];

                $count=$admins->where($where1)->count();
                $Page=new \Think\Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $show=$Page->show();// 分页显示输出
                $data=$admins->where($where1)->order('au_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            }
        }
        else
        {
            //if($utype!='admin'){
            //$where['top_uid']=$uid;
            //}
            //得到当前用户的信用度
            $where['au_id']=$uid;
            $where['au_type']=$utype;
            $user=$admins->field('au_id,au_money,au_moneys,au_type')->where($where)->find();
            if( !empty($user))
            {
                $utype1=utype();//当前下级账号类型
                $where1['top_uid']=$uid;
                $where1['au_type']=$utype1[1];
                $count=$admins->where($where1)->count();
                $Page=new \Think\Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $show=$Page->show();// 分页显示输出
                $data=$admins->where($where1)->order('au_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            }
        }

        $utype1=utype();//当前用户类型
        if($utype == $user['au_type'])
        {
            $utypes=$utype;
        }

        $this->assign('utype', $utypes);//当前用户类型
        $this->assign('utype1', $utype1[0]);//下一级用户类型
        $this->assign('user', $user);//当前用户详情
        $this->assign('data', $data);//下级用户数据
        $this->assign('count', $count);//
        $this->assign('show', $show);//
        $this->display();
    }

    //添加页面下级用户-->总代理添加代理
    public function addUser()
    {
        $admins=M('admin');
        //修改操作
        $where['au_id']=I('get.uid');
        $admins=M('admin');
        $user=$admins->field('au_id,au_name,au_money,au_moneys,au_phone,au_remark,au_proportion,au_qishu,au_market,m_loss')->where($where)->find();
        $user_loss_m=json_decode($user['m_loss']);
        //上级的账号积分
        $utype=session('autype');
        if($utype == 'admin')
        {
            $where1['au_type']='partner';
            $users=$admins->where($where1)->sum('au_proportion');
            //$status1=true;
        }
        else if($utype == 'partner')
        {
            $where1['au_id']=session('auid');
            $where1['au_type']=session('autype');
            $status=true;
            $user1=$admins->field('au_id,au_money,au_moneys')->where($where1)->find();
            $qi=qishus();
            $qishu['qishu']=$qi[0]['qishu'];
            $opentimes = M('opentime')->where($qishu)->find();
            $loss = json_decode($opentimes['m_loss']);
        }else if($utype == 'agencys')
        {
            $where1['au_id']=session('auid');
            $where1['au_type']=session('autype');
            $status=true;
            $user1=$admins->field('au_id,au_money,au_moneys,m_loss')->where($where1)->find();
            $admin_loss=$admins->where($where1)->find();
            $loss = json_decode($admin_loss['m_loss']);
        }


        $this->assign('users', $users);
        $this->assign('data', $user);
        $this->assign('data1', $user1);
        $this->assign('status', $status);
        $this->assign('status1', $status1);
        $this->assign('loss', $loss);
        $this->assign("user_loss_m", $user_loss_m);
        $this->display();
    }

    //保存下级操作
    public function saveUser()
    {
        //超管(admin),股东(partner),总代理(agencys),代理(agency)
        $uname=I('post.name');
        $moeny=I('post.integral');
        $password=I('post.password');
        $uphone=I('post.phone');
        $uremark=I('post.content');
        $proportion=I('post.proportion');
        $uid=I('post.uid');
        $qishu=I('post.qishu');
        $market=I('post.market');
        $zancheng=I('post.zancheng');
        //赔率操作
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
        $admins=M('admin');
        $utype=session('autype');
        $auid=session('auid');
        if(empty($uname))
        {
            $arr['code']=true;
            $arr['titles']='保存不成功！';
            $arr['urls']='/User/index';
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        $data['au_name']=$uname;
        $data['au_phone']=$uphone;
        $data['au_remark']=$uremark;
        $data['au_proportion']=$proportion;
        $data['au_market']=$market;
        $data['au_qishu']=$qishu;
        $qi=qishus();
        $qishu['qishu']=$qi[0]['qishu'];
        $opentimes = M('opentime')->where($qishu)->find();
        $top_id['au_id'] = $auid;
        $top_loss = $admins->where($top_id)->find();
        if($top_loss['au_type'] =='partner'){
            $sx_loss = json_decode($opentimes['m_loss']);
        }else if($top_loss['au_type'] =='agencys'){
            $sx_loss = json_decode($top_loss['m_loss']);
        }
        //赔率 1初始赔率2赔率下降阀值3销售增量4赔率下调步长
        if($ding41 > $sx_loss->ding41)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong211 > $sx_loss->tong211)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong221 > $sx_loss->tong221)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong311 > $sx_loss->tong311)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong321 > $sx_loss->tong321)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong331 > $sx_loss->tong331)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong411 > $sx_loss->tong411)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong421 > $sx_loss->tong421)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong431 > $sx_loss->tong431)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong441 > $sx_loss->tong441)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($tong451 > $sx_loss->tong451)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($ding21 > $sx_loss->ding21)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        if($ding31 > $sx_loss->ding31)
        {
            $arr=['code'=>false, 'titles'=>'不能大于上级设置的赔率！', 'urls'=>'/User/index'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        $m_loss['m_loss'] = json_decode($opentimes['m_loss']);
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
        if($utype == 'admin')
        {//添加股东
            $data['au_type']='partner';
            $uwhere1['au_type']='partner';

            $users=$admins->where($uwhere1)->sum('au_proportion');
            if($users + $proportion > 100)
            {
                $arr['code']=true;
                $arr['titles']='填写的分成比不能超过100！';
                $arr['urls']='/User/index';
                $stats=json_encode($arr);
                echo $stats;
                exit;
            }
        }
        else if($utype == 'partner')
        {
            $data['au_type']='agencys';
            $data['au_money']=$moeny;
        }
        else if($utype == 'agencys')
        {
            $data['au_type']='agency';

        }
        $where1['au_id']=$auid;
        $where1['au_type']=$utype;
        $user1=$admins->field('au_moneys,au_money,au_proportion,au_sum')->where($where1)->find();
        if($utype == 'agencys' && !empty($user1) && empty($uid))
        {
            $moneys=$user1['au_money'] - $user1['au_moneys'];
            if($moeny > $moneys)
            {
                $arr['code']=true;
                $arr['titles']='填写的信用积分不能大于你的账号信用积分!';
                $arr['urls']='/User/index';
                $stats=json_encode($arr);
                echo $stats;
                exit;
            }
            $data['au_money']=$moeny;
        }
        else if($utype == 'agencys' && !empty($user1) && !empty($uid))
        {
            $where2['au_id']=$uid;//用户ID
            $admins11=$admins->where($where2)->find();
            $moneys=$user1['au_money'] - $user1['au_moneys'];
            $moneys11=$admins11['au_money'] - $admins11['au_moneys'];
            if(($moeny - $moneys11) > $moneys)
            {
                $arr['code']=true;
                $arr['titles']='填写的信用积分不能大于你的账号信用积分!';
                $arr['urls']='/User/index';
                $stats=json_encode($arr);
                echo $stats;
                exit;
            }
            $data['au_money']=$moeny;
        }
        if($utype == 'agencys')
        {
            $data['au_proportion']=$zancheng;
        }
        if( !empty($uid))
        {
            $where['au_id']=$uid;//用户ID
            if( !empty($password))
            {
                $random=$this->generate_password();
                $data['au_random']=$random;
                $data['password']=MD5(MD5($password.$random));//密码
            }

            $user=$admins->where($where)->save($data);
            //$user=1;
            if( !empty($user))
            {
                if($utype == 'agencys' && !empty($uid))
                {
                    //上级
                    $data3['au_moneys']=$user1['au_moneys'] + ($moeny - $moneys11);
                    $dd=$admins->where($where1)->save($data3);
                }
                //dump($where1);exit;
                //操作日志
                $data2['log_ip']=get_client_ip();
                $data2['uid']=$auid;
                $data2['log_type']=2;
                $utype=utype();
                $data2['contents']='修改'.$utype[0].':'.$uname;
                // $data2['contents']='修改代理'. $uname.',信用积分'.$data['au_moeny'];
                $log=M('log')->add($data2);

                $arr=['code'=>true, 'titles'=>'修改成功', 'urls'=>'/User/index'];
                $stats=json_encode($arr);
            }
            else
            {
                $arr=['code'=>true, 'titles'=>'修改成功', 'urls'=>'/User/index'];
                $stats=json_encode($arr);
            }
            $data_loss['m_loss']=json_encode($loss);
            $save_user = $admins->where($where)->save($data_loss);
            if(!empty($save_user)){
                $arr=['code'=>true, 'titles'=>'修改成功', 'urls'=>'/User/index'];
                $stats=json_encode($arr);
            }
        }
        else
        {
            $random=$this->generate_password();
            $data['au_random']=$random;
            $data['password']=MD5(MD5($password.$random));//密码
            $data['top_uid']=$auid;
            $data['m_loss']=json_encode($loss);
            //$data['au_time']=time();
            $ip=get_client_ip();
            $data['au_ip']=$ip;
            if($utype == 'admin')
            {//添加股东
                $qishus=M('opentime')->order('id desc')->find();
                if($qishus)
                {
                    $data['qishu']=$qishus['qishu'];
                }

            }
            $data['au_session']='';
            $user=$admins->add($data);
            if( !empty($user))
            {//上级
                if($utype == 'agencys' && empty($uid))
                {
                    //上级
                    $data1['au_moneys']=$user1['au_moneys'] + $moeny;
                    //$dd=$admins->where($where1)->save($data3);
                }
                $data1['au_sum']=$user1['au_sum'] + 1;
                $dd=$admins->where($where1)->save($data1);

                //操作日志
                $data2['log_ip']=$ip;
                $data2['uid']=$auid;
                $data2['log_type']=2;
                $utype=utype();
                $data2['contents']='添加'.$utype[0].':'.$uname;
                $log=M('log')->add($data2);

                $arr=['code'=>true, 'titles'=>'添加成功', 'urls'=>'/User/index'];
                $stats=json_encode($arr);
            }
            else
            {
                $arr=['code'=>true, 'titles'=>'添加失败', 'urls'=>'/User/index'];
                $stats=json_encode($arr);
            }
        }

        echo $stats;
    }

    //代理-->会员
    public function user1()
    {
        //超管(admin),股东(partner),总代理(agencys),代理(agency),测试(demo)用户类型
        $admins=M('admin');
        if(session('autype') == 'agency')
        {//代理--->会员
            $where['top_uid']=session('auid');
            $users=M('user');
            $count=$users->where($where)->count();
            $Page=new \Think\Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show=$Page->show();// 分页显示输出
            $data=$users->where($where)->order('uid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        }
        //得到当前用户的信用度
        $where1['au_id']=session('auid');
        $user=$admins->field('au_money,au_moneys')->where($where1)->find();

        $this->assign('user', $user);
        $this->assign('data', $data);
        $this->assign('show', $show);
        $this->assign('count', $count);
        $this->display();
    }

    //添加页面-->代理添加会员
    public function addUser1()
    {
        //修改操作
        $where['uid']=I('get.uid');
        $user=M('user')->where($where)->find();
        //上级积分
        $where1['au_id']=session('auid');
        $where1['au_type']=session('autype');
        $admins=M('admin');
        $user1=$admins->where($where1)->find();

        $qishu=qishus();
        //赔率和单注上限（1直码/2两同/3三同/4四同/5两定/6三定）
        $wheres['qishu']=$qishu[0]['qishu'];
        $datas=M('opentime')->where($wheres)->limit(1)->find();
        if($datas['m_loss'])
        {
            $loss=json_decode($user1['m_loss']);
            $market=json_decode($datas['m_sales']);
        }
        $where2['uid']=I('get.uid');
        $user = M('user')->where($where2)->find();
        if($user['m_loss']){
            $user_loss_m=json_decode($user['m_loss']);
        }
        $configs=M("uloss")->where($where2)->find();
        // dump($loss);
        if($configs)
        {
            $uloss=json_decode($configs['loss']);
            //四定
            $uloss1=$uloss[0]->loss4;
            //var_dump($uloss1);
            $uloss2=$uloss[1]->loss21;
            $uloss3=$uloss[1]->loss22;
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
        if($loss)
        {
            /////////四定
            $pl3=$loss->ding41;
            if($pl3 > 3000)
            {
                $pl13=$loss->ding41 - 2500;
                $sums3=($pl3) - ($pl13);
                for($i3=0; $i3 <= $sums3; $i3++)
                {
                    if($i3 < 10)
                    {
                        $g3='0.00'.$i3;
                    }
                    else if($i3 >= 10 && $i3 <= 99)
                    {
                        $g3='0.0'.$i3;
                    }
                    else
                    {
                        $g3='0.'.$i3;
                    }
                    if($g3 == '0.000')
                    {
                        $g3=0;
                    }

                    $f3[]=$g3;

                }
                for($a3=$pl3; $a3 > $pl13; $a3--)
                {
                    if($a3 == 9800 || $a3 == 9700 || $a3 == 9600 || $a3 == 9500 || $a3 == 9400 || $a3 == 9300 || $a3 == 9200 || $a3 == 9100 || $a3 == 9000 || $a3 == 8900 || $a3 == 8800 || $a3 == 8700 || $a3 == 8600 || $a3 == 8500 || $a3 == 8400 || $a3 == 8300 || $a3 == 8200 || $a3 == 8100 || $a3 == 8000 || $a3 == 7900 || $a3 == 7800 || $a3 == 7700 || $a3 == 7600 || $a3 == 7500 || $a3 == 7400 || $a3 == 7300 || $a3 == 7200 || $a3 == 7100 || $a3 == 7000 || $a3 == 6900 || $a3 == 6800 || $a3 == 6700 || $a3 == 6600 || $a3 == 6500 || $a3 == 6400 || $a3 == 6300 || $a3 == 6200 || $a3 == 6100 || $a3 == 6000 || $a3 == 5900 || $a3 == 5800 || $a3 == 5700 || $a3 == 5600 || $a3 == 5500 || $a3 == 5400 || $a3 == 5300 || $a3 == 5200 || $a3 == 5100 || $a3 == 5000 || $a3 == 4900 || $a3 == 4800 || $a3 == 4700 || $a3 == 4600 || $a3 == 4500 || $a3 == 4400 || $a3 == 4300 || $a3 == 4200 || $a3 == 4100 || $a3 == 4000 || $a3 == 3900 || $a3 == 3800 || $a3 == 3700 || $a3 == 3600 || $a3 == 3500 || $a3 == 3400 || $a3 == 3300 || $a3 == 3200 || $a3 == 3100 || $a3 == 3000)
                    {
                        for($b3=0; $b3 < 10; $b3++)
                        {
                            $c3=$a3 - ($b3.'0');
                            $d3[]=$c3;
                        }
                    }
                }
                $d3[]=$pl13;
                for($h3=0; $h3 < count($d3); $h3++)
                {
                    if($uloss1 == $f3[$h3])
                    {
                        $j1.='<option value="'.$f3[$h3].'/'.$d3[$h3].'" selected>'.$f3[$h3].'/'.$d3[$h3].'</option>';
                    }
                    else
                    {
                        $j1.='<option value="'.$f3[$h3].'/'.$d3[$h3].'">'.$f3[$h3].'/'.$d3[$h3].'</option>';
                    }
                }

            }
            /////////二现

            $pl6=$loss->tong211;
            //$pl16=$loss->tong211-3;
            if($pl6 > 3)
            {
                //$sums6=($pl6.'0')-($pl16.'0');
                for($i6=0; $i6 <= 250; $i6++)
                {
                    if($i6 < 10)
                    {
                        $g6='0.00'.$i6;
                    }
                    else if($i6 >= 10 && $i6 <= 99)
                    {
                        $g6='0.0'.$i6;
                    }
                    else
                    {
                        $g6='0.'.$i6;
                    }
                    if($g6 == '0.000')
                    {
                        $g6=0;
                    }

                    $f6[]=$g6;


                }

                for($a6=0; $a6 < count($f6); $a6++)
                {

                    $arr='0.'.$a6;
                    $arr6=explode(".", $arr);
                    if($a6 > 9 && $a6 <= 99)
                    {
                        //echo $arr[3];
                        $c6=$pl6 - ('0.'.$arr6[1]);
                    }
                    else if($a6 > 99 && $a6 <= 199)
                    {
                        $c6=$pl6 - ('1.'.substr($arr6[1], -2));
                    }
                    else if($a6 > 199)
                    {
                        $c6=$pl6 - ('2.'.substr($arr6[1], -2));
                    }
                    else
                    {
                        $c6=$pl6 - ('0.0'.$a6);
                    }

                    $d6[]=$c6;
                }
                for($h6=0; $h6 < count($d6); $h6++)
                {
                    if($uloss2 == $d6[$h6])
                    {
                        $j2.='<option value="'.$f6[$h6].'/'.$d6[$h6].'" selected>'.$f6[$h6].'/'.$d6[$h6].'</option>';
                    }
                    else
                    {
                        $j2.='<option value="'.$f6[$h6].'/'.$d6[$h6].'">'.$f6[$h6].'/'.$d6[$h6].'</option>';
                    }
                }

            }

            $pl7=$loss->tong221;
            // $pl17=$loss->tong221-3;
            // $sums7=($pl7.'0')-($pl17.'0');
            for($i7=0; $i7 <= 250; $i7++)
            {
                if($i7 < 10)
                {
                    $g7='0.00'.$i7;
                }
                else if($i7 >= 10 && $i7 <= 99)
                {
                    $g7='0.0'.$i7;
                }
                else
                {
                    $g7='0.'.$i7;
                }
                if($g7 == '0.000')
                {
                    $g7=0;
                }

                $f7[]=$g7;

            }

            for($a7=0; $a7 < count($f7); $a7++)
            {

                $arr='0.'.$a7;
                $arr7=explode(".", $arr);
                if($a7 > 9 && $a7 <= 99)
                {
                    //echo $arr[3];
                    $c7=$pl7 - (('0.'.$arr7[1]) * 2);
                }
                else if($a7 > 99 && $a7 <= 199)
                {
                    $c7=$pl7 - (('1.'.substr($arr7[1], -2)) * 2);
                }
                else if($a7 > 199)
                {
                    $c7=$pl7 - (('2.'.substr($arr7[1], -2)) * 2);
                }
                else
                {
                    $c7=$pl7 - (('0.0'.$a7) * 2);
                }

                $d7[]=$c7;
            }
            for($h7=0; $h7 < count($d7); $h7++)
            {
                if($uloss3 == $d7[$h7])
                {
                    $j3.='<option value="'.$f7[$h7].'/'.$d7[$h7].'" selected>'.$f7[$h7].'/'.$d7[$h7].'</option>';
                }
                else
                {
                    $j3.='<option value="'.$f7[$h7].'/'.$d7[$h7].'">'.$f7[$h7].'/'.$d7[$h7].'</option>';
                }

            }
            /////////三现

            $pl4=$loss->tong311;
            $pl14=$loss->tong311 - 2.5;
            // $pl14=35;
            $sums4=($pl4.'0') - ($pl14.'0');
            for($i4=0; $i4 <= 250; $i4++)
            {
                if($i4 < 10)
                {
                    $g4='0.00'.$i4;
                }
                else if($i4 >= 10 && $i4 <= 99)
                {
                    $g4='0.0'.$i4;
                }
                else
                {
                    $g4='0.'.$i4;
                }
                if($g4 == '0.000')
                {
                    $g4=0;
                }

                $f4[]=$g4;

            }

            for($a4=0; $a4 < count($f4); $a4++)
            {

                $arr='0.'.$a4;
                $arr1=explode(".", $arr);
                if($a4 > 9 && $a4 < 99)
                {
                    //echo $arr[3];
                    $c4=$pl4 - (('0.'.$arr1[1]) * 5);
                }
                else if($a4 > 99 && $a4 < 199)
                {
                    $c4=$pl4 - (('1.'.substr($arr1[1], -2)) * 5);
                }
                else if($a4 > 199)
                {
                    $c4=$pl4 - (('2.'.substr($arr1[1], -2)) * 5);
                }
                else
                {
                    $c4=$pl4 - (('0.0'.$a4) * 5);
                }

                $d4[]=$c4;
            }

            for($h4=0; $h4 < count($d4); $h4++)
            {

                if($uloss4 == $f4[$h4])
                {
                    $j4.='<option value="'.$f4[$h4].'/'.$d4[$h4].'" selected>'.$f4[$h4].'/'.$d4[$h4].'</option>';
                }
                else
                {
                    $j4.='<option value="'.$f4[$h4].'/'.$d4[$h4].'">'.$f4[$h4].'/'.$d4[$h4].'</option>';
                }

            }

            $pl8=$loss->tong321;
            $pl18=$loss->tong321 - 2.5;
            $sums8=($pl8.'0') - ($pl18.'0');
            for($i8=0; $i8 <= 250; $i8++)
            {
                if($i8 < 10)
                {
                    $g8='0.00'.$i8;
                }
                else if($i8 >= 10 && $i8 <= 99)
                {
                    $g8='0.0'.$i8;
                }
                else
                {
                    $g8='0.'.$i8;
                }
                if($g8 == '0.000')
                {
                    $g8=0;
                }

                $f8[]=$g8;

            }

            for($a8=0; $a8 < count($f8); $a8++)
            {
                $arr8=$a8;
                if($a8 <= 9)
                {
                    $c8=$pl8 - ('0.'.substr($arr8, -1, 1));
                }
                else if($a8 > 9 && $a8 <= 99)
                {
                    $c8=$pl8 - (substr($arr8, -2, 1).'.'.substr($arr8, -1, 1));
                }
                else
                {
                    $c8=$pl8 - (substr($arr8, -3, 2).'.'.substr($arr8, -1, 1));
                }

                $d8[]=$c8;
            }
            for($h8=0; $h8 < count($d8); $h8++)
            {

                if($uloss5 == $f8[$h8])
                {
                    $j5.='<option value="'.$f8[$h8].'/'.$d8[$h8].'" selected>'.$f8[$h8].'/'.$d8[$h8].'</option>';
                }
                else
                {
                    $j5.='<option value="'.$f8[$h8].'/'.$d8[$h8].'">'.$f8[$h8].'/'.$d8[$h8].'</option>';
                }

            }
            $pl9=$loss->tong331;
            $pl19=35;
            $sums9=($pl9.'0') - ($pl19.'0');
            for($i9=0; $i9 <= 250; $i9++)
            {
                if($i9 < 10)
                {
                    $g9='0.00'.$i9;
                }
                else if($i9 >= 10 && $i9 <= 99)
                {
                    $g9='0.0'.$i9;
                }
                else
                {
                    $g9='0.'.$i9;
                }
                if($g9 == '0.000')
                {
                    $g9=0;
                }

                $f9[]=$g9;

            }
            for($a9=0; $a9 < count($f9); $a9++)
            {

                $arr='0.'.$a9;
                $arr9=explode(".", $arr);
                if($a9 > 9 && $a9 < 99)
                {
                    //echo $arr[3];
                    $c9=$pl9 - (('0.'.$arr9[1]) * 2);
                }
                else if($a9 > 99 && $a9 < 199)
                {
                    $c9=$pl9 - (('1.'.substr($arr9[1], -2)) * 2);
                }
                else if($a9 > 199)
                {
                    $c9=$pl9 - (('2.'.substr($arr9[1], -2)) * 2);
                }
                else
                {
                    $c9=$pl9 - (('0.'.$a9) * 2);
                }

                $d9[]=$c9;
            }

            // $d9[]=35;
            for($h9=0; $h9 < count($d9); $h9++)
            {

                if($uloss6 == $f9[$h9])
                {
                    $j6.='<option value="'.$f9[$h9].'/'.$d9[$h9].'" selected>'.$f9[$h9].'/'.$d9[$h9].'</option>';
                }
                else
                {
                    $j6.='<option value="'.$f9[$h9].'/'.$d9[$h9].'">'.$f9[$h9].'/'.$d9[$h9].'</option>';
                }

            }

            /////////四现

            $pl5=$loss->tong411;
            $pl15=320;
            $sums5=$pl5 - $pl15;
            for($i5=0; $i5 <= 250; $i5++)
            {
                if($i5 < 10)
                {
                    $g5='0.00'.$i5;
                }
                else if($i5 >= 10 && $i5 <= 99)
                {
                    $g5='0.0'.$i5;
                }
                else
                {
                    $g5='0.'.$i5;
                }
                if($g5 == '0.000')
                {
                    $g5=0;
                }

                $f5[]=$g5;

            }

            for($a5=0; $a5 < count($f5); $a5++)
            {

                $arr='0.'.$a5;
                $arr5=explode(".", $arr);
                if($a5 > 9 && $a5 < 100)
                {
                    //echo $arr[3];
                    $c5=$pl5 - (('0.'.$arr5[1]) * 4);
                }
                else if($a5 > 100 && $a5 < 200)
                {
                    $c5=$pl5 - (('1.'.substr($arr5[1], -2)) * 4);
                }
                else if($a5 > 200)
                {
                    $c5=$pl5 - (('2.'.substr($arr5[1], -2)) * 4);
                }
                else
                {
                    $c5=$pl5 - (('0.'.$arr5[1]) * 4);
                }

                $d5[]=$c5;
            }

            // $d5[]=320;
            for($h5=0; $h5 < count($d5); $h5++)
            {
                if($uloss7 == $f5[$h5])
                {
                    $j7.='<option value="'.$f5[$h5].'/'.$d5[$h5].'" selected>'.$f5[$h5].'/'.$d5[$h5].'</option>';
                }
                else
                {
                    $j7.='<option value="'.$f5[$h5].'/'.$d5[$h5].'">'.$f5[$h5].'/'.$d5[$h5].'</option>';
                }

            }


            $pl10=$loss->tong421;
            $pl110=580;
            $sums10=$pl10 - $pl110;
            for($i10=0; $i10 <= 250; $i10++)
            {
                if($i10 < 10)
                {
                    $g10='0.00'.$i10;
                }
                else if($i10 >= 10 && $i10 <= 99)
                {
                    $g10='0.0'.$i10;
                }
                else
                {
                    $g10='0.'.$i10;
                }
                if($g10 == '0.000')
                {
                    $g10=0;
                }

                $f10[]=$g10;


            }
            for($a10=0; $a10 < count($f10); $a10++)
            {

                $arr='0.'.$a10;
                $arr10=explode(".", $arr);
                if($a10 > 9 && $a10 < 99)
                {
                    //echo $arr[3];
                    $c10=$pl10 - (('0.'.$arr10[1]) * 8);
                }
                else if($a10 > 99 && $a10 < 199)
                {
                    $c10=$pl10 - (('1.'.substr($arr10[1], -2)) * 8);
                }
                else if($a10 > 199)
                {
                    $c10=$pl10 - (('2.'.substr($arr10[1], -2)) * 8);
                }
                else
                {
                    $c10=$pl10 - (('0.'.$a10) * 8);
                }

                $d10[]=$c10;
            }

            for($h10=0; $h10 < count($d10); $h10++)
            {

                if($uloss8 == $f10[$h10])
                {
                    $j8.='<option value="'.$f10[$h10].'/'.$d10[$h10].'" selected>'.$f10[$h10].'/'.$d10[$h10].'</option>';
                }
                else
                {
                    $j8.='<option value="'.$f10[$h10].'/'.$d10[$h10].'">'.$f10[$h10].'/'.$d10[$h10].'</option>';
                }

            }


            $pl11=$loss->tong431;
            $pl111=580;
            $sums11=$pl11 - $pl111;
            for($i11=0; $i11 <= 250; $i11++)
            {
                if($i11 < 11)
                {
                    $g11='0.00'.$i11;
                }
                else if($i11 >= 11 && $i11 <= 99)
                {
                    $g11='0.0'.$i11;
                }
                else
                {
                    $g11='0.'.$i11;
                }
                if($g11 == '0.000')
                {
                    $g11=0;
                }

                $f11[]=$g11;


            }
            for($a11=0; $a11 < count($f11); $a11++)
            {

                $arr='0.'.$a11;
                $arr11=explode(".", $arr);
                if($a11 > 9 && $a11 < 99)
                {
                    //echo $arr[3];
                    $c11=$pl11 - (($arr11[1]) * 2);
                }
                else if($a11 > 99 && $a11 < 199)
                {
                    $c11=$pl11 - (('1'.substr($arr11[1], -2)) * 2);
                }
                else if($a11 > 199)
                {
                    $c11=$pl11 - (('2'.substr($arr11[1], -2)) * 2);
                }
                else
                {
                    $c11=$pl11 - ($a11 * 2);
                }

                $d11[]=$c11;
            }

            for($h11=0; $h11 < count($d11); $h11++)
            {

                if($uloss9 == $f11[$h11])
                {
                    $j9.='<option value="'.$f11[$h11].'/'.$d11[$h11].'" selected>'.$f11[$h11].'/'.$d11[$h11].'</option>';
                }
                else
                {
                    $j9.='<option value="'.$f11[$h11].'/'.$d11[$h11].'">'.$f11[$h11].'/'.$d11[$h11].'</option>';
                }

            }


            $pl12=$loss->tong441;
            $pl121=1110;
            $sums12=$pl12 - $pl121;
            for($i12=0; $i12 <= 250; $i12++)
            {
                if($i12 < 12)
                {
                    $g12='0.00'.$i12;
                }
                else if($i12 >= 12 && $i12 <= 99)
                {
                    $g12='0.0'.$i12;
                }
                else
                {
                    $g12='0.'.$i12;
                }
                if($g12 == '0.000')
                {
                    $g12=0;
                }

                $f12[]=$g12;


            }
            // $d12[]=1110;
            for($a12=0; $a12 < count($f12); $a12++)
            {

                $arr='0.'.$a12;
                $arr12=explode(".", $arr);
                if($a12 > 9 && $a12 < 99)
                {
                    //echo $arr[3];
                    $c12=$pl12 - (($arr12[1]) * 2);
                }
                else if($a12 > 99 && $a12 < 199)
                {
                    $c12=$pl12 - (('1'.substr($arr12[1], -2)) * 2);
                }
                else if($a12 > 199)
                {
                    $c12=$pl12 - (('2'.substr($arr12[1], -2)) * 2);
                }
                else
                {
                    $c12=$pl12 - ($a12 * 2);
                }

                $d12[]=$c12;
            }

            for($h12=0; $h12 < count($d12); $h12++)
            {

                if($uloss10 == $f12[$h12])
                {
                    $j10.='<option value="'.$f12[$h12].'/'.$d12[$h12].'" selected>'.$f12[$h12].'/'.$d12[$h12].'</option>';
                }
                else
                {
                    $j10.='<option value="'.$f12[$h12].'/'.$d12[$h12].'">'.$f12[$h12].'/'.$d12[$h12].'</option>';
                }
            }

            $pl13=$loss->tong451;
            // $pl121=1110;
            // $sums12=$pl12-$pl121;
            for($i13=0; $i13 <= 250; $i13++)
            {
                if($i13 < 12)
                {
                    $g13='0.00'.$i13;
                }
                else if($i13 >= 12 && $i13 <= 99)
                {
                    $g13='0.0'.$i13;
                }
                else
                {
                    $g13='0.'.$i13;
                }
                if($g13 == '0.000')
                {
                    $g13=0;
                }

                $f13[]=$g13;


            }

            for($a13=0; $a13 < count($f13); $a13++)
            {

                $arr='0.'.$a13;
                $arr13=explode(".", $arr);
                if($a13 > 9 && $a13 < 99)
                {
                    //echo $arr[3];
                    $c13=$pl13 - (($arr13[1]) * 10);
                }
                else if($a13 > 99 && $a13 < 199)
                {
                    $c13=$pl13 - (('1'.substr($arr13[1], -2)) * 10);
                }
                else if($a13 > 199)
                {
                    $c13=$pl13 - (('2'.substr($arr13[1], -2)) * 10);
                }
                else
                {
                    $c13=$pl13 - ($a13 * 10);
                }

                $d13[]=$c13;
            }

            for($h13=0; $h13 < count($d13); $h13++)
            {

                if($uloss11 == $f13[$h13])
                {
                    $j11.='<option value="'.$f13[$h13].'/'.$d13[$h13].'" selected>'.$f13[$h13].'/'.$d13[$h13].'</option>';
                }
                else
                {
                    $j11.='<option value="'.$f13[$h13].'/'.$d13[$h13].'">'.$f13[$h13].'/'.$d13[$h13].'</option>';
                }
            }
            // echo $j8;
            /////////////二定
            $pl=$loss->ding21;
            // $pl1=80;
            // $sums=($pl.'0')-($pl1.'0');
            for($i=0; $i <= 250; $i++)
            {
                if($i < 10)
                {
                    $g='0.00'.$i;
                }
                else if($i >= 10 && $i <= 99)
                {
                    $g='0.0'.$i;
                }
                else
                {
                    $g='0.'.$i;
                }
                if($g == '0.000')
                {
                    $g=0;
                }

                $f[]=$g;
            }
            for($a14=0; $a14 < count($f); $a14++)
            {
                $arr14=$a14;
                if($a14 <= 9)
                {
                    $c14=$pl - ('0.'.substr($arr14, -1, 1));
                }
                else if($a14 > 9 && $a14 <= 99)
                {
                    $c14=$pl - (substr($arr14, -2, 1).'.'.substr($arr14, -1, 1));
                }
                else
                {
                    $c14=$pl - (substr($arr14, -3, 2).'.'.substr($arr14, -1, 1));
                }

                $d14[]=$c14;
            }

            for($h=0; $h < count($d14); $h++)
            {
                if($uloss12 == $f[$h])
                {
                    $j12.='<option value="'.$f[$h].'/'.$d14[$h].'" selected>'.$f[$h].'/'.$d14[$h].'</option>';
                }
                else
                {
                    $j12.='<option value="'.$f[$h].'/'.$d14[$h].'">'.$f[$h].'/'.$d14[$h].'</option>';
                }

            }

            /////////三定
            $pl2=$loss->ding31;
            // $pl12=750;
            // $sums2=($pl2)-($pl12);
            for($i2=0; $i2 <= 250; $i2++)
            {
                if($i2 < 10)
                {
                    $g2='0.00'.$i2;
                }
                else if($i2 >= 10 && $i2 <= 99)
                {
                    $g2='0.0'.$i2;
                }
                else
                {
                    $g2='0.'.$i2;
                }
                if($g2 == '0.000')
                {
                    $g2=0;
                }
                $f2[]=$g2;

            }

            for($a2=0; $a2 < count($f2); $a2++)
            {

                $arr='0.'.$a2;
                $arr2=explode(".", $arr);
                if($a2 > 9 && $a2 < 99)
                {
                    //echo $arr[3];
                    $c2=$pl2 - (($arr2[1]) * 1);
                }
                else if($a2 > 99 && $a2 < 199)
                {
                    $c2=$pl2 - (('1'.substr($arr2[1], -2)) * 1);
                }
                else if($a2 > 199)
                {
                    $c2=$pl2 - (('2'.substr($arr2[1], -2)) * 1);
                }
                else
                {
                    $c2=$pl2 - ($a2 * 1);
                }

                $d2[]=$c2;
            }

            for($h2=0; $h2 < count($d2); $h2++)
            {
                if($uloss13 == $f2[$h2])
                {
                    $j13.='<option value="'.$f2[$h2].'/'.$d2[$h2].'" selected>'.$f2[$h2].'/'.$d2[$h2].'</option>';
                }
                else
                {
                    $j13.='<option value="'.$f2[$h2].'/'.$d2[$h2].'">'.$f2[$h2].'/'.$d2[$h2].'</option>';
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

        $this->assign('data', $user);
        $this->assign('data1', $user1);
        $this->assign('user_loss_m', $user_loss_m);
        $this->display();
    }

    //保存操作(代理添加会员)
    public function saveUser1()
    {
        $username=I('post.name');
        $phone=I('post.phone');
        $password=I('post.password');
        $integral=I('post.integral');
        $content=I('post.content');
        $uid=I('post.uid');
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

        $admins=M('admin');
        $users=M('user');
        $qi=qishus();
        $qishu['qishu']=$qi[0]['qishu'];
        $datas=M('opentime')->where($qishu)->limit(1)->find();
        $m_loss['m_loss'] = json_decode($datas['m_loss']);
        //操作用户
        $where1['au_id']=session('auid');
        $where1['au_type']=session('autype');
        $user1=$admins->field('au_moneys,au_money,au_proportion,au_sum,m_loss')->where($where1)->find();
        $sx_loss = json_decode($user1['m_loss']);
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
        //上级分配积分下级
        if(empty($uid) && !empty($user1))
        {
            $money1=$user1['au_money'] - $user1['au_moneys'];
            if($integral > $money1)
            {
                $arr=['code'=>false, 'titles'=>'积分大于账号积分！', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
                echo $stats;
                exit;
            }
            $data['money']=$integral;
            $data['usermoney']=$integral;
        }
        else if( !empty($user1) && !empty($uid))
        {
            $where['uid']=$uid;//用户ID
            $user2=$users->field('money,moneys')->where($where)->find();
            $money1=$user1['au_money'];

            if(($integral - $user2['money']) > $money1)
            {
                $arr=['code'=>false, 'titles'=>'积分大于账号积分！', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
                echo $stats;
                exit;
            }
            if($user2['money'] > 0)
            {
                $data['money']=$user2['money'] + ($integral - $user2['money']);
                $data['usermoney']=$user2['money'] + ($integral - $user2['money']);
            }
            else
            {
                $data['money']=$user2['money'] + $integral;
                $data['usermoney']=$user2['money'] + $integral;
            }

            //dump($data);exit;
        }
        else
        {
            $arr=['code'=>false, 'titles'=>'参数不齐，操作不成功', 'urls'=>'/User/user1'];
            $stats=json_encode($arr);
            echo $stats;
            exit;
        }
        // if(!empty($user1['au_money']) && ($user1['au_money']>=$integral)){
        //     $data['money']=$integral;
        //     //$data['au_moeny']=$moeny;
        //     $data3['au_money']=$user1['au_money']-$integral;
        //     $data3['au_moneys']=$user1['au_moneys']+$integral;
        // }


        $data['about']=$content;
        $data['mobile']=$phone;

        if(empty($uid))
        {
            if(empty($username) || empty($password))
            {
                $arr=['code'=>false, 'titles'=>'参数不齐，操作不成功', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
                echo $stats;
                exit;
            }
            $data['username']=$username;
            $data['password']=MD5(MD5($password));
        }
        else
        {
            if( !empty($username))
            {
                $data['username']=$username;
            }
            if( !empty($password))
            {
                $data['password']=MD5(MD5($password));
            }


        }
        // dump($data);
        // dump($user2['money']);
        //exit;
        if( !empty($uid))
        {
            if(session('autype') == 'agency')
            {
                $user=$users->where($where)->save($data);
            }

            //$user=1;
            if( !empty($user))
            {
                //上级
                $data3['au_moneys']=$user1['au_moneys'] - ($user2['money'] - $integral);
                //dump($data3);exit;
                $user1=$admins->where($where1)->save($data3);
                //操作日志
                $data2['log_ip']=get_client_ip();
                $data2['uid']=session('auid');
                $data2['log_type']=2;
                $data2['contents']='修改会员'.$username.',信用积分'.$integral;
                $log=M('log')->add($data2);

                $arr=['code'=>true, 'titles'=>'修改成功', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
            }
            else
            {
                $arr=['code'=>false, 'titles'=>'修改失败', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
            }
            $data_loss['m_loss']=json_encode($loss);
            $save_user = $users->where($uid)->save($data_loss);
            if(!empty($save_user)){
                $arr=['code'=>true, 'titles'=>'修改成功', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
            }
        }
        else
        {
            $data['utime']=time();
            $data['u_type']='member';
            $data['top_uid']=session('auid');
            $data['m_loss']=json_encode($loss);
            if(session('autype') == 'agency')
            {
                $data['usession']='';
                $id=M('user')->add($data);
            }
            if( !empty($id))
            {
                //上级
                $data3['au_moneys']=$user1['au_moneys'] + $integral;
                $data3['au_sum']=$user1['au_sum'] + 1;
                $user1=$admins->where($where1)->save($data3);
                //操作日志
                $data2['log_ip']=get_client_ip();
                $data2['uid']=session('auid');
                $data2['log_type']=2;
                $data2['contents']='添加会员'.$username.',信用积分'.$integral - ($user2['money'] - $user2['moneys']);
                $log=M('log')->add($data2);


                $arr=['code'=>true, 'titles'=>'添加成功', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
            }
            else
            {
                $arr=['code'=>false, 'titles'=>'添加失败', 'urls'=>'/User/user1'];
                $stats=json_encode($arr);
            }

        }
        echo $stats;

    }

    //查找用户是否存在
    public function findUser()
    {
        $name=I('post.name');
        $uid=I('post.uid');
        $where['au_name']=$name;

        $user=M('admin')->field('au_id')->where($where)->find();
        if(empty($user))
        {
            $arr=['code'=>false];
            $stats=json_encode($arr);
        }
        else if($user['au_id'] == $uid)
        {
            $arr=['code'=>false];
            $stats=json_encode($arr);
        }
        else
        {
            $arr=['code'=>true];
            $stats=json_encode($arr);
        }

        echo $stats;
    }

    //查找用户是否存在
    public function findUser1()
    {
        $name=I('post.name');
        $uid=I('post.uid');
        $where['username']=$name;

        $user=M('user')->field('uid')->where($where)->find();
        if(empty($user))
        {
            $arr=['code'=>false];
            $stats=json_encode($arr);
        }
        else if($user['uid'] == $uid)
        {
            $arr=['code'=>false];
            $stats=json_encode($arr);
        }
        else
        {
            $arr=['code'=>true];
            $stats=json_encode($arr);
        }

        echo $stats;
    }

    //随机码
    private function generate_password($length=6)
    {// 密码字符集，可任意添加你需要的字符
        $chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
        $password='';
        for($i=0; $i < $length; $i++)
        {
            // 这里提供两种字符获取方式
            // 第一种是使用substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组$chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            $password.=$chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    //下级数据
    public function findsUser()
    {

        $where['top_uid']=I('get.uid');
        $field='uid,username,money,mobile,login_time';
        $data=M('user')->field($field)->where($where)->select();

        //dump($data);
        $this->assign('data', $data);
        $this->display();
    }
    //账号删除操作
    //超管(admin),股东(partner),总代理(agencys),代理(agency)用户类型
    public function delsUser()
    {
        $uid=I('post.uid');

        $admins=M('admin');
        $utype=session('autype');
        if(empty($uid) || empty($utype))
        {
            $arr['code']=400;
            $this->ajaxReturn($arr);
            exit;
        }
        if($utype == 'admin')
        {
            // $where['au_id']=$uid;
            // $where['au_type']='partner';
            // //得到股东
            // $data=$admins->field('au_id')->where($where)->select();

            //dump($uid);exit;
            if( !empty($uid))
            {
                // foreach($data as $k=>$v){
                //     if($v['au_id']){
                //       $uid2.=$v['au_id'].',';
                //     }
                // }
                $where1['top_uid']=['in', rtrim($uid, ',')];//得到所有总代理
                $data1=$admins->field('au_id')->where($where1)->select();
                if( !empty($data1))
                {
                    foreach($data1 as $k1=>$v1)
                    {
                        if($v1['au_id'])
                        {
                            $uid3.=$v1['au_id'].',';
                        }
                    }
                    $where2['top_uid']=['in', rtrim($uid3, ',')];//得到所有代理
                    $data2=$admins->field('au_id')->where($where2)->select();
                    if( !empty($data2))
                    {
                        foreach($data2 as $k2=>$v2)
                        {
                            if($v2['au_id'])
                            {
                                $uid4.=$v2['au_id'].',';
                            }
                        }
                        $where3['top_uid']=['in', rtrim($uid4, ',')];//得到所有代理
                        $data3=M('user')->where($where3)->select();
                        if( !empty($data3))
                        {
                            $dd=M('user')->where($where3)->delete();
                            foreach($data3 as $k3=>$v3)
                            {
                                if($v3['uid'])
                                {
                                    $uid5.=$v3['uid'].',';
                                }
                            }
                        }

                        //dump($uid5);exit;

                        $where4['uid']=['in', rtrim($uid5, ',')];//得到所有代理
                        $dd=M('bet')->where($where4)->delete();
                    }

                }
            }

            $uidarr=$uid.$uid2.$uid3.$uid4;
            $where4['au_id']=['in', rtrim($uidarr, ',')];//得到所有代理
            $dd=$admins->where($where4)->delete();
        }
        else if($utype == 'partner')
        {
            // $where['au_id']=$uid;
            // $where['au_type']='agencys';
            //   //得到所有总代理
            //   $data1=$admins->field('au_id')->where($where)->select();
            if( !empty($uid))
            {
                // foreach($data1 as $k1=>$v1){
                //     if($v1['au_id']){
                //       $uid3.=$v1['au_id'].',';
                //     }
                // }
                $where2['top_uid']=['in', rtrim($uid, ',')];//得到所有代理
                $data2=$admins->field('au_id')->where($where2)->select();
                if( !empty($data2))
                {
                    foreach($data2 as $k2=>$v2)
                    {
                        if($v2['au_id'])
                        {
                            $uid4.=$v2['au_id'].',';
                        }
                    }
                    $where3['top_uid']=['in', rtrim($uid4, ',')];//得到所有代理
                    $data3=M('user')->where($where3)->select();
                    if( !empty($data3))
                    {

                        foreach($data3 as $k3=>$v3)
                        {
                            if($v3['uid'])
                            {
                                $uid5.=$v3['uid'].',';
                            }
                        }
                        $dd=M('user')->where($where3)->delete();
                    }

                    //dump($uid5);exit;

                    $where4['uid']=['in', rtrim($uid5, ',')];//得到所有代理
                    $dd=M('bet')->where($where4)->delete();
                    // $where3['top_uid']=array('in',rtrim($uid4,','));//得到所有代理
                    // $dd=M('user')->where($where3)->delete();
                    // $where4['uid']=array('in',rtrim($uid4,','));//得到所有代理
                    // $dd=M('bet')->where($where4)->delete();
                }

            }


            $uidarr=$uid.$uid3.$uid4;
            $where4['au_id']=['in', rtrim($uidarr, ',')];//得到所有代理
            $dd=$admins->where($where4)->delete();

        }
        else if($utype == 'agencys')
        {
            // $where['au_id']=$uid;
            // $where['au_type']='agency';
            //   //得到所有代理
            //   $data1=$admins->field('au_id')->where($where)->select();
            if( !empty($uid))
            {
                // foreach($data1 as $k1=>$v1){
                //     if($v1['au_id']){
                //       $uid3.=$v1['au_id'].',';
                //     }
                // }
                $where3['top_uid']=['in', rtrim($uid, ',')];//得到所有代理
                $data3=M('user')->where($where3)->select();
                if( !empty($data3))
                {

                    foreach($data3 as $k3=>$v3)
                    {
                        if($v3['uid'])
                        {
                            $uid5.=$v3['uid'].',';
                        }
                    }
                    $dd=M('user')->where($where3)->delete();
                }

                //dump($uid5);exit;

                $where4['uid']=['in', rtrim($uid5, ',')];//得到所有代理
                $dd=M('bet')->where($where4)->delete();
                // $dd=M('user')->where($where3)->delete();
                // $where4['uid']=array('in',rtrim($uid3,','));//得到所有代理
                // $dd=M('bet')->where($where4)->delete();
            }


            //$uidarr=$uid;
            $where5['au_id']=['in', rtrim($uid, ',')];//得到所有代理
            $dd=$admins->where($where5)->delete();

        }
        else if($utype == 'agency')
        {
            $where3['top_uid']=['in', rtrim($uid, ',')];//得到所有代理
            $data3=M('user')->where($where3)->select();
            if( !empty($data3))
            {

                foreach($data3 as $k3=>$v3)
                {
                    if($v3['uid'])
                    {
                        $uid5.=$v3['uid'].',';
                    }
                }
                $dd=M('user')->where($where3)->delete();
            }
            // $dd=M('user')->where($where3)->delete();
            $where4['uid']=['in', rtrim($uid5, ',')];//得到会员
            $dd=M('bet')->where($where4)->delete();
        }
        $arr['code']=200;
        $this->ajaxReturn($arr);
    }
    // //会员删除操作
    // public function delsUser1(){
    //     $where['uid']=I('post.id');
    //     $users=M('user');
    //     $data=$users->field('top_uid')->where($where)->find();
    //     $where2['au_id']=$data['top_uid'];
    //     if($data){//修改上级的sum
    //          $admins=M('admin');
    //         $data1=$admins->field('au_sum')->where($where2)->find();
    //         if($data1['au_sum']){
    //             $data2['au_sum']=$data1['au_sum']-1;
    //             $dd=$admins->where($where2)->save($data2);
    //         }
    //         $dd=$users->where($where)->delete();
    //     }


    //      echo '1';
    // }
    //账号状态修改操作
    public function auditUser()
    {
        $auid11=I('post.inID');
        $where['au_id']=$auid11;
        $status=I('post.status');
        $data['au_status']=$status;
        $admin=M('admin');
        $data1=$admin->where($where)->save($data);
        //得到当前角色类型
        $types=session('autype');
        //dump($data1);exit;
        if($types == 'admin')
        {//股东下所有账号
            $where1['top_uid']=$auid11;
            $where1['au_type']='agencys';
            $data2=$admin->where($where1)->select();
            //dump($where1);exit;
            if($data2)
            {//股东下所有的代理
                foreach($data2 as $k=>$v)
                {
                    $auid.=$v['au_id'].',';
                }
                $where3['top_uid']=['in', rtrim($auid, ',')];

                $where3['au_type']='agency';
                $data3=$admin->where($where3)->select();
                if($data3)
                {//股东下所有的代理
                    foreach($data3 as $k1=>$v1)
                    {
                        $auid1.=$v1['au_id'].',';
                    }
                    // $where4['top_uid']=array('in',rtrim($auid1,','));
                    // //$where4['au_type']='agency';
                    // $data4=$admin->where($where4)->select();
                    // if($data4){//股东下所有的代理
                    //   foreach($data4 as $k2=>$v2){
                    //     $auid2.=$v2['au_id'].',';
                    //   }
                    //所有会员
                    $where5['top_uid']=['in', rtrim($auid1, ',')];
                    $data5['status']=$status;
                    M('user')->where($where5)->save($data5);
                    // }
                }
            }
            $id=$auid.$auid1;
            //dump($id);exit;
            $where4['au_id']=['in', $id];

            $dd=$admin->where($where4)->save($data);


        }
        else if($types == 'partner')
        {//总代理下所有账号
            $where1['top_uid']=$auid11;
            $where1['au_type']='agency';
            $data2=$admin->where($where1)->select();
            if($data2)
            {//股东下所有的代理
                foreach($data2 as $k=>$v)
                {
                    $auid.=$v['au_id'].',';
                }
                //   $where3['top_uid']=array('in',rtrim($auid,','));
                // //$where3['au_type']='agency';
                // $data3=$admin->where($where3)->select();
                // if($data3){//股东下所有的代理
                //   foreach($data3 as $k1=>$v1){
                //     $auid1.=$v1['au_id'].',';
                //   }
                //所有会员
                $where5['top_uid']=['in', rtrim($auid, ',')];
                $data5['status']=$status;
                M('user')->where($where5)->save($data5);
                //}
            }
            $id=$auid;
            $where4['au_id']=['in', $id];
            $dd=$admin->where($where4)->save($data);
        }
        else if($types == 'agencys')
        {//代理下所有账号

            //所有会员
            $where5['top_uid']=$auid11;
            $data5['status']=$status;
            M('user')->where($where5)->save($data5);

        }
        echo '1';
    }

    //会员账号状态修改操作
    public function auditUser1()
    {
        $where['uid']=I('post.inID');
        $data['status']=I('post.status');
        $data1=M('user')->where($where)->save($data);
        echo '1';
    }
    // //账号删除操作
    // public function delsUser(){
    //     $where['u_id']=I('post.id');
    //     $data=M('admin')->where($where)->find();
    // }
    //添加信用积分
    public function addMoenys()
    {
        $uid=rtrim(I('get.uid'), ',');

        if( !empty($uid))
        {
            $admins=M('admin');
            $where['au_id']=['in', $uid];
            $datas=$admins->where($where)->select();
            if($datas)
            {
                foreach($datas as $key=>$value)
                {
                    if($value['au_name'])
                    {
                        $data.=$value['au_name'].'、';
                    }
                }

            }
            //上级的账号积分
            $counts=count($datas);
            $utype=session('autype');
            if($utype != 'admin' && $utype != 'partner')
            {
                $status=true;
            }
            $where1['au_id']=session('auid');
            $where1['au_type']=$utype;
            $data1=$admins->field('au_id,au_money,au_moneys')->where($where1)->find();

        }
        //dump($status);
        $this->assign('counts', $counts);
        $this->assign('status', $status);
        $this->assign('uid', $uid);
        $this->assign('moenys', ($data1['au_money'] - $data1['au_moneys']));
        $this->assign('data', $data);
        $this->display();
    }

    //保存积分
    public function saveMoneys()
    {
        $money=I('post.money');
        $uid=I('post.uid');
        $utype=session('autype');
        $auid=session('auid');
        $where['top_uid']=$auid;
        $admins=M('admin');
        if(empty($money) || empty($uid))
        {
            $arr=['code'=>false, 'titles'=>'错误操作！', 'urls'=>'/User/index'];
        }
        else if($utype == 'partner')
        {//股东
            $uid1=explode(',', $uid);
            if(count($uid1) > 1)
            {
                for($a=0; $a < count($uid1); $a++)
                {
                    if($uid1[$a])
                    {
                        //查到以前的数据
                        $where['au_id']=$uid1[$a];
                        $admin=$admins->field('au_money,au_moneys')->where($where)->find();
                        if($admin)
                        {
                            $data['au_money']=$admin['au_money'] + $money;
                            $admin1=$admins->where($where)->save($data);
                            if($admin1)
                            {
                                $sum+=1;
                                $au_name.=$admin['au_name'].'/';
                            }
                        }
                        $data['au_money']='';
                    }
                }
            }
            else
            {
                //查到以前的数据
                $where['au_id']=$uid;
                $admin=$admins->field('au_money,au_moneys')->where($where)->find();
                if($admin)
                {
                    $data['au_money']=$admin['au_money'] + $money;
                    $admin1=$admins->where($where)->save($data);
                    if($admin1)
                    {
                        $sum+=1;
                        $au_name.=$admin['au_name'].'/';
                    }
                }
            }

            if($sum)
            {//操作日志
                $data2['log_ip']=get_client_ip();
                $data2['uid']=session('auid');
                $data2['log_type']=2;
                $data2['contents']='代理账号'.$au_name.'充值信用积分'.$money;
                $log=M('log')->add($data2);

                $arr=['code'=>true, 'titles'=>'添加成功！', 'urls'=>'/User/index'];
            }
            else
            {
                $arr=['code'=>false, 'titles'=>'添加失败！', 'urls'=>'/User/index'];
            }

        }
        else if($utype == 'agencys' || $utype == 'agency')
        {
            $where1['au_id']=$auid;
            $where1['au_type']=$utype;
            $data=$admins->field('au_money,au_moneys')->where($where1)->find();

            $uid1=explode(',', $uid);
            $counts=count($uid1);
            $moneys=$money * $counts;
            if(empty($money) || $moneys > ($data['au_money'] - $data['au_moneys']))
            {
                $arr=['code'=>false, 'titles'=>'没有填写信用额度/或者大于你的账号信用积分！', 'urls'=>'/User/index'];
            }
            else
            {
                if($counts)
                {
                    for($a=0; $a < count($uid1); $a++)
                    {
                        if($uid1[$a])
                        {
                            //查到以前的数据
                            $where['au_id']=$uid1[$a];
                            $admin=$admins->field('au_name,au_money,au_moneys')->where($where)->find();
                            if($admin)
                            {
                                $data1['au_money']=$admin['au_money'] + $money;
                                $admin1=$admins->where($where)->save($data1);
                                if($admin1)
                                {
                                    $sum+=1;
                                    $au_name.=$admin['au_name'].'/';
                                }
                            }
                            $data['au_money']='';
                        }
                    }
                }
                else
                {
                    //查到以前的数据
                    $where['au_id']=$uid;
                    $admin=$admins->field('au_name,au_money,au_moneys')->where($where)->find();
                    if($admin)
                    {
                        $data1['au_money']=$admin['au_money'] + $money;
                        $admin1=$admins->where($where)->save($data1);
                        if($admin1)
                        {
                            $sum+=1;
                            $au_name.=$admin['au_name'].'/';
                        }
                    }
                }
                //  $num=count($uid1);
                if($sum)
                {
                    //上级减少积分
                    $data3['au_moneys']=$data['au_moneys'] + ($sum * $money);
                    $moenys1=$admins->where($where1)->save($data3);
                    //操作日志
                    $data2['log_ip']=get_client_ip();
                    $data2['uid']=session('auid');
                    $data2['log_type']=2;
                    $data2['contents']='账号'.$au_name.'充值信用积分'.$money;
                    $log=M('log')->add($data2);

                    $arr=['code'=>true, 'titles'=>'添加成功！', 'urls'=>'/User/index'];
                }
                else
                {
                    $arr=['code'=>false, 'titles'=>'添加失败！', 'urls'=>'/User/index'];
                }
            }

        }


        $stats=json_encode($arr);
        echo $stats;
    }

    //账号积分清零操作
    public function delsMoenys()
    {
        $uid=I('post.uid');
        $admins=M('admin');
        if(empty($uid))
        {
            $arr=['code'=>false, 'titles'=>'操作失败！', 'urls'=>'/User/index'];
        }
        else
        {
            $uid1=explode(',',$uid);
            $counts=count($uid1);
            if($counts)
            {
                for($a=0; $a < count($uid1); $a++)
                {
                    if($uid1[$a])
                    {
                        //查到以前的数据
                        $where['au_id']=$uid1[$a];
                        $admin=$admins->field('au_type,top_uid,au_name,au_money,au_moneys')->where($where)->find();
                        if($admin)
                        {

                            $data['au_money']=0;
                            $data['au_moneys']='';
                            $admin1=$admins->where($where)->save($data);
                            if($admin['au_type'] != 'admin' && $admin['au_type'] != 'partner')
                            {
                                //得到上级
                                $where1['au_id']=$admin['top_uid'];
                                $admin2=$admins->field('top_uid,au_name,au_money,au_moneys')->where($where1)->find();
                                $data1['au_moneys']=$admin2['au_moneys'] - ($admin['au_money'] - $admin['au_moneys']);
                            }
                            if($admin1)
                            {
                                $admins->where($where1)->save($data1);
                                $sum+=1;
                                $au_name.=$admin['au_name'].'、';
                            }
                        }

                    }
                }

                if($sum)
                {//操作日志
                    $data2['log_ip']=get_client_ip();
                    $data2['uid']=session('auid');
                    $data2['log_type']=2;
                    $data2['contents']='账号'.$au_name.'清零信用积分'.$money;
                    $log=M('log')->add($data2);

                    $arr=['code'=>true, 'titles'=>'操作成功！', 'urls'=>'/User/index'];
                }
                else
                {
                    $arr=['code'=>false, 'titles'=>'操作失败！', 'urls'=>'/User/index'];
                }
            }
            else
            {
                $arr=['code'=>false, 'titles'=>'操作失败！', 'urls'=>'/User/index'];
            }


        }

        $stats=json_encode($arr);
        echo $stats;

    }


    //添加信用积分页面-->会员
    public function addMoenys1()
    {
        $uid=rtrim(I('get.uid'), ',');
        if( !empty($uid))
        {
            $user=M('user');
            $where['uid']=['in', $uid];
            $datas=$user->where($where)->select();
            if($datas)
            {
                foreach($datas as $key=>$value)
                {
                    if($value['username'])
                    {
                        $data.=$value['username'].'、';
                    }
                }
            }
            $count=count($datas);
            $where1['au_id']=session('auid');
            $where1['au_type']=session('autype');
            $data1=M('admin')->field('au_money,au_moneys')->where($where1)->find();
            $moneys=$data1['au_money'] - $data1['au_moneys'];

        }

        $this->assign('uid', $uid);
        $this->assign('data', $data);
        $this->assign('moneys', $moneys);
        $this->assign('count', $count);
        $this->display();
    }

    //保存积分
    public function saveMoneys1()
    {
        $money=I('post.money');
        $uid=I('post.uid');
        //
        $admins=M('admin');
        $where1['au_id']=session('auid');
        $where1['au_type']=session('autype');
        $data=$admins->field('au_money,au_moneys')->where($where1)->find();
        if(empty($money) || empty($uid))
        {
            $arr=['code'=>false, 'titles'=>'错误操作！', 'urls'=>'/User/user1'];
        }
        else
        {
            $users=M('user');
            $uid1=explode(',', $uid);
            $counts=count($uid1);
            $moneys=$counts * $money;
            if($moneys > ($data['au_money'] - $data['au_moneys']))
            {
                $arr=['code'=>false, 'titles'=>'填写信用额度大于你的账号信用积分！', 'urls'=>'/User/user1'];
            }
            else
            {
                if($counts)
                {
                    for($a=0; $a < count($uid1); $a++)
                    {
                        if($uid1[$a])
                        {
                            //查到以前的数据
                            $where['uid']=$uid1[$a];
                            $user=$users->field('username,money,usermoney')->where($where)->find();
                            if($user)
                            {
                                $data1['money']=$user['money'] + $money;
                                $data1['usermoney']=$user['usermoney'] + $money;
                                $user1=$users->where($where)->save($data1);
                                if($user1)
                                {
                                    $sum+=1;
                                    $au_name.=$user['username'].'、';
                                }
                            }
                            $data['money']='';
                        }
                    }
                }
                else
                {
                    //查到以前的数据
                    $where['uid']=$uid;
                    $user=$users->field('username,money')->where($where)->find();
                    if($user)
                    {
                        $data1['au_money']=$user['money'] + $money;
                        $user1=$users->where($where)->save($data1);
                        if($user1)
                        {
                            $sum+=1;
                            $au_name.=$user['username'].'、';
                        }
                    }
                }
                //  $num=count($uid1);
                if($sum)
                {
                    //上级减少积分
                    $data3['au_moneys']=$data['au_moneys'] + ($sum * $money);
                    $moenys1=$admins->where($where1)->save($data3);
                    //操作日志
                    $data2['log_ip']=get_client_ip();
                    $data2['uid']=session('auid');
                    $data2['log_type']=2;
                    $data2['contents']='账号'.$au_name.'充值信用积分'.$money;
                    $log=M('log')->add($data2);

                    $arr=['code'=>true, 'titles'=>'添加成功！', 'urls'=>'/User/user1'];
                }
                else
                {
                    $arr=['code'=>false, 'titles'=>'添加失败！', 'urls'=>'/User/user1'];
                }
            }
        }

        $stats=json_encode($arr);
        echo $stats;
    }

    //会员账号积分清零操作
    public function delsMoenys1()
    {
        $uid=I('post.uid');
        $users=M('user');
        if(empty($uid))
        {
            $arr=['code'=>false, 'titles'=>'操作失败！', 'urls'=>'/User/user1'];
        }
        else
        {
            $uid1=explode(',', $uid);
            $counts=count($uid1);
            $admins=M('admin');
            if($counts)
            {
                for($a=0; $a < $counts; $a++)
                {
                    if($uid1[$a])
                    {
                        //查到以前的数据
                        $where['uid']=$uid1[$a];
                        $admin=$users->field('top_uid,username,money,moneys')->where($where)->find();
                        if($admin)
                        {
                            $data['money']='0';
                            $data['moneys']='0';
                            $data['usermoney']='0';
                            $admin1=$users->where($where)->save($data);
                            $where1['au_id']=$admin['top_uid'];
                            $admin2=$admins->field('au_moneys')->where($where1)->find();
                            $data1['au_moneys']=$admin2['au_moneys'] - ($admin['money'] - $admin['moneys']);
                            if($admin1)
                            {
                                $admin2=$admins->where($where1)->save($data1);
                                $sum+=1;
                                $au_name.=$admin['username'].'';
                            }
                        }

                    }
                }

                if($sum)
                {//操作日志
                    $data2['log_ip']=get_client_ip();
                    $data2['uid']=session('auid');
                    $data2['log_type']=2;
                    $data2['contents']='会员账号'.$au_name.'清零信用积分'.$money;
                    $log=M('log')->add($data2);

                    $arr=['code'=>true, 'titles'=>'操作成功！', 'urls'=>'/User/user1'];
                }
                else
                {
                    $arr=['code'=>false, 'titles'=>'操作失败！', 'urls'=>'/User/user1'];
                }
            }
            else
            {
                $arr=['code'=>false, 'titles'=>'操作失败！', 'urls'=>'/User/user1'];
            }


        }

        $stats=json_encode($arr);
        echo $stats;

    }

    //管理员信息查看页面
    public function findAdmins()
    {
        $where['au_id']=session('auid');
        $where['au_type']=session('autype');
        $data=M('admin')->field('au_name,au_money,au_phone')->where($where)->find();
        //dump($data);
        $this->assign('data', $data);
        $this->display();
    }

    //保存操作
    public function saveAdmins()
    {
        $password=I('post.password');
        $phone=I('post.phone');
        if( !empty($password))
        {
            $random=$this->generate_password();
            $data['au_random']=$random;
            $data['password']=MD5(MD5($password.$random));//密码
        }
        $data['au_phone']=$phone;
        $where['au_id']=session('auid');
        $where['au_type']=session('autype');
        $data1=M('admin')->where($where)->save($data);
        if($data1)
        {
            $arr=['code'=>true, 'titles'=>'修改成功！', 'urls'=>'/Login/logout'];
        }
        else
        {
            $arr=['code'=>false, 'titles'=>'修改失败，没有改动的内容！', 'urls'=>'/Login/logout'];
        }

        $this->ajaxReturn($arr);
    }

    //会员管理
    public function datas()
    {
        //权限下所有的会员
        $uid=getUser();
        if( !empty($uid) && isset($uid))
        {
            $where['uid']=['in', $uid];
            $users=M('user');
            $count=$users->where($where)->count();
            $Page=new \Think\Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show=$Page->show();// 分页显示输出
            $data=$users->where($where)->order('uid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        }
        // dump();
        // dump();
        $this->assign('data', $data);//下级用户数据
        $this->assign('count', $count);//
        $this->assign('show', $show);//
        $this->display();
    }

    //锁定操作
    public function lockUser1()
    {
        $where['uid']=I('post.inID');
        $data['lock']=I('post.status');
        $data1=M('user')->where($where)->save($data);
        echo '1';
    }

    //代理揽货配置
    public function addConfig()
    {
        $uid=session('auid');
        $where['au_type']='agency';
        $where['au_id']=$uid;
        //$where['top_id']=session('auid');
        $admin=M('admin')->field('au_id,au_name,au_proportion')->where($where)->find();

        $data=M('ubet')->where($where)->find();
        //var_dump($data);

        $this->assign('data1', $data);
        $this->assign('data', $admin);
        $this->display();
    }

    //保存配置
    public function saveUpercent()
    {
        $uid=session('auid');
        $data['percent']=I('post.percent');
        $data['ding21']=I('post.ding21');
        $data['ding22']=I('post.ding22');
        $data['ding23']=I('post.ding23');
        $data['ding24']=I('post.ding24');
        $data['ding25']=I('post.ding25');
        $data['ding26']=I('post.ding26');
        $data['ding31']=I('post.ding31');
        $data['ding32']=I('post.ding32');
        $data['ding33']=I('post.ding33');
        $data['ding34']=I('post.ding34');
        $data['ding41']=I('post.ding41');
        $data['xian21']=I('post.xian21');
        $data['xian31']=I('post.xian31');
        $data['xian41']=I('post.xian41');
        $data['time']=time();

        $where['au_id']=session('auid');
        //$where['top_id']=session('auid');

        $ubet=M('ubet');
        $dd=$ubet->field('id')->where($where)->find();
        if(empty($dd))
        {
            $data['au_id']=$uid;
            $dds=$ubet->add($data);
        }
        else
        {
            $dds=$ubet->where($where)->save($data);
        }
        if($dds)
        {
            $arr['code']=true;
        }
        else
        {
            $arr['code']=false;
        }
        $this->ajaxReturn($arr);
        //var_dump($_POST);

    }


}
