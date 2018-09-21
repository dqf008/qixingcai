<?php
namespace Home\Controller;
use Think\Controller;
class DataController extends CommonController {
    public function index(){
    
        $qishu=I('get.qishu');//搜索期数
        $uname=I('get.uname');//用户名称
        $number=I('get.number');//下注号码
        $xian=I('get.xian');//号码类型
        $condition=I('get.condition');//赔率、金额和退码
        $start=I('get.start');//开始
        $finish=I('get.finish');//结束
        $category=I('get.category');//号码类型
        $types=I('get.types');//下注类型
        $userid=I('get.uid');//会员搜索
        $uid=getUser();//当前用户下所有的会员
        $qishus=qishus();//所有期数
        //dump($uid);
        if(!empty($uid) && isset($uid)){
            if(!empty($userid) && isset($userid)){
                $where['uid']=$userid;//当前会员
            }else{
                $where['uid']=array('in',$uid);//当前用户下所有的会员 
            }
        $where['js']=array('not in','4,5');//下注号码状态
        if(!empty($qishu)){//期号
            $where['qishu']=$qishu;
            $where1['qishu']=$qishu;
            $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }else{
            $where['qishu']=$qishus[0]['qishu'];
            $qishu=$qishus[0]['qishu'];
            $where1['qishu']=$qishu;
            $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }   
        if(!empty($uname)){//会员名称
            $where['username']=array('like','%'.$uname.'%');
        }
        if(!empty($number)){//下注号码
            $where['mingxi_2']=array('like','%'.$number.'%');
            if(!empty($xian)){//号码类型
                $where['mingxi_3']=$xian;
            }
        }
        if(!empty($condition) && $condition=='tm' ){//赔率、金额、退码
            $where['js']=2;
        }elseif(!empty($condition) && $condition=='pl' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
               $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
               //$where['odds']=array('between',array($start),array($finish)); 
            }
            
        }elseif(!empty($condition) && $condition=='je' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
                $where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and');
            }
        }
        if(!empty($category)){
            if($category=='1'){
              $where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
            }elseif($category=='三定位'){
              $where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
            }elseif($category=='四定位'){
              $where['types']='4定';
            }elseif($category=='四字现'){
              $where['types']='4现';
            }elseif($category=='三字现'){
              $where['types']='3现';
            }elseif($category=='二字现'){
              $where['types']='2现';
            }else{
              $where['types']=$category;
            }
        }
  
        $bets=M('bet');
        $count      = $bets->where($where)->count();
        $page1=$count/72;
        $Page       = new \Think\Page($count,72);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       
        $Page->parameter .= "&qishu=".$qishu;
        $Page->parameter .= "&uname=".$uname;
        $Page->parameter .= "&number=".$number; 
        $Page->parameter .= "&xian=".$xian;
        $Page->parameter .= "&condition=".$condition;
        $Page->parameter .= "&start=".$start;
        $Page->parameter .= "&finish=".$finish;
        $Page->parameter .= "&types=".$types;
        $Page->parameter .= "&category=".$category;
        $show       = $Page->show();// 分页显示输出
        
        $field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,odds_hy,money,js,status,topmoney,topwin';

        $data=$bets->field($field)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        }
        //dump($data);
        if($data){
           

            // $datas1['sum']=count($data);
            // $datas1['moneys']='0.00';
            // $datas1['win']='0.00';
            // foreach($data as $k=>$v){
            //     $datas1['money']+=$v['money'];
            //     if($v['status']==1){
            //        $datas1['moneys']+=$v['money']*$v['odds']; 
            //     }
            //     $datas1['win']+=$v['win'];
                
            // }
            //加工数据-->1得到所有代理配置拦货数据
            
            // $lanhuo=M('ubet')->select();
            // if($lanhuo){
            //     $data1=$this->process($data,$lanhuo,$opentime); 
            // }
            
            $data1=$this->process($data,$opentime);
            $datas1['sum']=0;
            $datas1['moneys']='0.00';
            $datas1['win']='0.00';
            foreach($data1 as $k=>$v){
                   
                if($v['js']==0){
                     if($v['money']){
                        $datas1['sum']+=1;
                    }
                    $datas1['money']+=$v['money'];
                     if($v['status']==1){
                       $datas1['moneys']+=$v['moneys']; 
                    }
                    $datas1['win']+=$v['win'];
                    $datas1['yingkui']+=$v['yingkui'];
                }
               
            }
            //dump($data1);
        }
       //dump($page1);
        $this->assign('opentime',$opentime['m_status']);//汇总数据
        $this->assign('page1',intval($page1));//汇总数据
        $this->assign('data1',$datas1);//汇总数据
        $this->assign('uname',$uname);//用户名称搜索
        $this->assign('qishu',$qishu);//搜索期数
        $this->assign('number',$number);//下注号码
        $this->assign('xian',$xian);//现
        $this->assign('condition',$condition);//赔率、金额退码
        $this->assign('start',$start);//赔率、金额退码
        $this->assign('finish',$finish);//赔率、金额退码
        $this->assign('category',$category);//下注号码类型
        $this->assign('types',$types);//下注类型
        $this->assign('qishus',$qishus);//所有期数
        $this->assign('data',$data1);//数据
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display();
    }
    //处理数据
    private function process($data,$qishus){
        foreach($data as $k1=>$v1){
            $data[$k1]['lmoney']=0;
            $data[$k1]['lmoneys']=0;
            $data[$k1]['lyingkui']=0;
            $data[$k1]['umoneys']=0;
            $data[$k1]['uyingkui']=0;
            if($v1['status']==1){//中奖
                $umoneys=$v1['money']*$v1['odds'];//中奖
                $lmoneys=$v1['topmoney']*$v1['odds'];//中奖
            }else{
                $umoneys=$v1['money'];//中奖
                $lmoneys=$v1['topmoney'];//中奖 
            } 
            //中奖金额+回水-下注 下注-中奖金额-回水
            if($qishus['m_status']==3){//期号开奖
                $uyingkui=$v1['money']-$umoneys-$v1['win'];
                $lyingkui=$v1['topmoney']-$lmoneys-$v1['topwin'];
            }
            $data[$k1]['umoneys']=$umoneys;//中奖
            $data[$k1]['uyingkui']=$uyingkui;//盈亏
          
            $data[$k1]['lmoney']=$v1['topmoney'];
            $data[$k1]['lmoneys']=$lmoneys;
            $data[$k1]['lhuishui']=$v1['topwin'];
            $data[$k1]['lyingkui']=$lyingkui;
            $data[$k1]['money']=$v1['money']-$v1['topmoney'];//下注
            $data[$k1]['moneys']=$data[$k1]['umoneys']-$lmoneys;//中奖
            $data[$k1]['yingkui']=$data[$k1]['uyingkui']-$lyingkui;//盈亏
            $data[$k1]['win']=$v1['win']-$v1['topwin'];//回水

        }//循环

        return $data;
    }

    //拦货明细
    public function intercept(){
        $qishu=I('get.qishu');//搜索期数
        $uname=I('get.uname');//用户名称
        $number=I('get.number');//下注号码
        $xian=I('get.xian');//号码类型
        $condition=I('get.condition');//赔率、金额和退码
        $start=I('get.start');//开始
        $finish=I('get.finish');//结束
        $category=I('get.category');//号码类型
        $types=I('get.types');//下注类型
        $userid=I('get.uid');//会员搜索
        $uid=getUser();//当前用户下所有的会员
        $qishus=qishus();//所有期数
        //dump($uid);
        if(!empty($uid) && isset($uid)){
            if(!empty($userid) && isset($userid)){
                $where['uid']=$userid;//当前会员
            }else{
                $where['uid']=array('in',$uid);//当前用户下所有的会员 
            }
        $where['js']=array('not in','4,5');//下注号码状态
        if(!empty($qishu)){//期号
            $where['qishu']=$qishu;
            $where1['qishu']=$qishu;
            $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }else{
            $where['qishu']=$qishus[0]['qishu'];
            $qishu=$qishus[0]['qishu'];
            $where1['qishu']=$qishu;
            $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }   
        if(!empty($uname)){//会员名称
            $where['username']=array('like','%'.$uname.'%');
        }
        if(!empty($number)){//下注号码
            $where['mingxi_2']=array('like','%'.$number.'%');
            if(!empty($xian)){//号码类型
                $where['mingxi_3']=$xian;
            }
        }
        if(!empty($condition) && $condition=='tm' ){//赔率、金额、退码
            $where['js']=2;
        }elseif(!empty($condition) && $condition=='pl' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
               $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
               //$where['odds']=array('between',array($start),array($finish)); 
            }
            
        }elseif(!empty($condition) && $condition=='je' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
                $where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and');
            }
        }
        if(!empty($category)){
            if($category=='1'){
              $where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
            }elseif($category=='三定位'){
              $where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
            }elseif($category=='四定位'){
              $where['types']='4定';
            }elseif($category=='四字现'){
              $where['types']='4现';
            }elseif($category=='三字现'){
              $where['types']='3现';
            }elseif($category=='二字现'){
              $where['types']='2现';
            }else{
              $where['types']=$category;
            }
        }
  
        $bets=M('bet');
        $count      = $bets->where($where)->count();
        $page1=$count/72;
        $Page       = new \Think\Page($count,72);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       
        $Page->parameter .= "&qishu=".$qishu;
        $Page->parameter .= "&uname=".$uname;
        $Page->parameter .= "&number=".$number; 
        $Page->parameter .= "&xian=".$xian;
        $Page->parameter .= "&condition=".$condition;
        $Page->parameter .= "&start=".$start;
        $Page->parameter .= "&finish=".$finish;
        $Page->parameter .= "&types=".$types;
        $Page->parameter .= "&category=".$category;
        $show       = $Page->show();// 分页显示输出
         $field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';
        $data=$bets->field($field)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        }

        if($data){
            $data1=$this->process($data,$opentime);
            //加工数据-->1得到所有代理配置拦货数据
            // $lanhuo=M('ubet')->select();
            // if($lanhuo){
            //     $data1=$this->process1($data,$lanhuo,$opentime); 
            // }
            // if($data1){
               
            // }
            // dump($data1);
            $datas1['moneys']='0.00';
            $datas1['win']='0.00';
            $datas1['sum']=0;
            foreach($data1 as $k=>$v){
                if($v['js']==0){
                    if($v['lmoney']>0){
                        $datas1['sum']+=1;
                    }
                    $datas1['money']+=$v['lmoney'];
                    if($v['status']==1){
                       $datas1['moneys']+=$v['lmoneys']; 
                    }
                    $datas1['win']+=$v['lhuishui'];
                    $datas1['yingkui']+=$v['lyingkui'];
                } 
            }
             
            // dump($data1);
        }
       //dump($page1);
        $this->assign('opentime',$opentime['m_status']);//汇总数据
        $this->assign('page1',intval($page1));//汇总数据
        $this->assign('data1',$datas1);//汇总数据
        $this->assign('uname',$uname);//用户名称搜索
        $this->assign('qishu',$qishu);//搜索期数
        $this->assign('number',$number);//下注号码
        $this->assign('xian',$xian);//现
        $this->assign('condition',$condition);//赔率、金额退码
        $this->assign('start',$start);//赔率、金额退码
        $this->assign('finish',$finish);//赔率、金额退码
        $this->assign('category',$category);//下注号码类型
        $this->assign('types',$types);//下注类型
        $this->assign('qishus',$qishus);//所有期数
        $this->assign('data',$data1);//数据
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display();
    }

    //拦货中奖明细
    public function intercepts(){
        $qishu=I('get.qishu');//搜索期数
        $uname=I('get.uname');//用户名称
        $number=I('get.number');//下注号码
        $xian=I('get.xian');//号码类型
        $condition=I('get.condition');//赔率、金额和退码
        $start=I('get.start');//开始
        $finish=I('get.finish');//结束
        $category=I('get.category');//号码类型
        $types=I('get.types');//下注类型
        $userid=I('get.uid');//会员搜索
        $uid=getUser();//当前用户下所有的会员
        $qishus=qishus();//所有期数
        //dump($uid);
        if(!empty($uid) && isset($uid)){
            if(!empty($userid) && isset($userid)){
                $where['uid']=$userid;//当前会员
            }else{
                $where['uid']=array('in',$uid);//当前用户下所有的会员 
            }
        $where['status']=1;//下注号码状态
        if(!empty($qishu)){//期号
            $where['qishu']=$qishu;
            $where1['qishu']=$qishu;
            $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }else{
            $where['qishu']=$qishus[0]['qishu'];
            $qishu=$qishus[0]['qishu'];
            $where1['qishu']=$qishu;
            $opentime=M('opentime')->field('m_status')->where($where1)->find();
        }   
        if(!empty($uname)){//会员名称
            $where['username']=array('like','%'.$uname.'%');
        }
        if(!empty($number)){//下注号码
            $where['mingxi_2']=array('like','%'.$number.'%');
            if(!empty($xian)){//号码类型
                $where['mingxi_3']=$xian;
            }
        }
        if(!empty($condition) && $condition=='tm' ){//赔率、金额、退码
            $where['js']=2;
        }elseif(!empty($condition) && $condition=='pl' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
               $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
               //$where['odds']=array('between',array($start),array($finish)); 
            }
            
        }elseif(!empty($condition) && $condition=='je' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
                $where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and');
            }
        }
        if(!empty($category)){
            if($category=='1'){
              $where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
            }elseif($category=='三定位'){
              $where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
            }elseif($category=='四定位'){
              $where['types']='4定';
            }elseif($category=='四字现'){
              $where['types']='4现';
            }elseif($category=='三字现'){
              $where['types']='3现';
            }elseif($category=='二字现'){
              $where['types']='2现';
            }else{
              $where['types']=$category;
            }
        }
  
        $bets=M('bet');
        $count      = $bets->where($where)->count();
        $page1=$count/72;
        $Page       = new \Think\Page($count,72);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       
        $Page->parameter .= "&qishu=".$qishu;
        $Page->parameter .= "&uname=".$uname;
        $Page->parameter .= "&number=".$number; 
        $Page->parameter .= "&xian=".$xian;
        $Page->parameter .= "&condition=".$condition;
        $Page->parameter .= "&start=".$start;
        $Page->parameter .= "&finish=".$finish;
        $Page->parameter .= "&types=".$types;
        $Page->parameter .= "&category=".$category;
        $show       = $Page->show();// 分页显示输出
        $field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';

        $data=$bets->field($field)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        }

        if($data){
            $data1=$this->process($data,$opentime);
            //加工数据-->1得到所有代理配置拦货数据
            // $lanhuo=M('ubet')->select();
            // if($lanhuo){
            //     $data1=$this->process1($data,$lanhuo,$opentime); 
            // }
            //$datas1['sum']=count($data);
            $datas1['moneys']='0.00';
            $datas1['win']='0.00';
            $datas1['sum']=0;
            foreach($data1 as $k=>$v){
                if($v['js']==0){
                if($v['lmoney']>0){
                    $datas1['sum']+=1;
                }
                $datas1['money']+=$v['lmoney'];
                if($v['status']==1){
                   $datas1['moneys']+=$v['lmoneys']; 
                }
                $datas1['win']+=$v['lhuishui'];
                $datas1['yingkui']+=$v['lyingkui'];
                }
                
            }
            
            
            // dump($data1);
        }
       //dump($page1);
        $this->assign('opentime',$opentime['m_status']);//汇总数据
        $this->assign('page1',intval($page1));//汇总数据
        $this->assign('data1',$datas1);//汇总数据
        $this->assign('uname',$uname);//用户名称搜索
        $this->assign('qishu',$qishu);//搜索期数
        $this->assign('number',$number);//下注号码
        $this->assign('xian',$xian);//现
        $this->assign('condition',$condition);//赔率、金额退码
        $this->assign('start',$start);//赔率、金额退码
        $this->assign('finish',$finish);//赔率、金额退码
        $this->assign('category',$category);//下注号码类型
        $this->assign('types',$types);//下注类型
        $this->assign('qishus',$qishus);//所有期数
        $this->assign('data',$data1);//数据
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display();
    }

        //处理数据
    private function process1($data,$lanhuo,$qishus){
        foreach($data as $k1=>$v1){
            $data[$k1]['lmoney']=0;
            $data[$k1]['lmoneys']=0;
            $data[$k1]['lyingkui']=0;
            $data[$k1]['umoneys']=0;
            $data[$k1]['uyingkui']=0;
             if($v1['status']==1){
                    $umoneys=$v1['money']*$v1['odds'];//中奖
                } 
                    

                //中奖金额+回水-下注 下注-中奖金额-回水
                if($qishus['m_status']==3){
                    $uyingkui=$v1['money']-$umoneys-$v1['win'];
                    //$uyingkui=$umoneys+$v1['win']-$v1['money'];
                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                }
                $data[$k1]['umoneys']=$umoneys;
                $data[$k1]['uyingkui']=$uyingkui;
            foreach($lanhuo as $k=>$v){
               
                if($v['au_id']==$v1['top_uid']){
                      //拦货类型是否配置  在进行拦货换算
                    if($v['percent']>=1){//判断分成比是否配置了

                        if($v['ding21']>=1 && $v1['mingxi_1']=='2定' && $v1['js']=='0'){

                            $moneys=$v1['money']*($v['percent']/100);
                            if($moneys>$v['ding21']){
                                $lmoney=$v['ding21'];//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$v['ding21'];//拦货金额佣金
                                if($v1['status']==1){
                                    $lmoneys=$v['ding21']*$v1['odds'];//我拦货的中奖金额
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }else{
                                $lmoney=$moneys;//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$lmoney;//拦货金额佣金 
                                 if($v1['status']==1){
                                    $lmoneys=$lmoney*$v1['odds'];//我拦货的中奖金额
                                    //$arr['moneys']=intval($moneys); 
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }
                        }elseif($v['ding31']>=1 && $v1['mingxi_1']=='3定' && $v1['js']=='0'){

                            $moneys=$v1['money']*($v['percent']/100);
                            if($moneys>$v['ding31']){
                                $lmoney=$v['ding31'];//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$v['ding31'];//拦货金额佣金
                                if($v1['status']==1){
                                    $lmoneys=$v['ding31']*$v1['odds'];//我拦货的中奖金额
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                   // $lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }else{
                                $lmoney=$moneys;//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$lmoney;//拦货金额佣金 
                                 if($v1['status']==1){
                                    $lmoneys=$lmoney*$v1['odds'];//我拦货的中奖金额
                                    //$arr['moneys']=intval($moneys); 
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }
                        }elseif($v['ding41']>=1 && $v1['mingxi_1']=='4定' && $v1['js']=='0'){
                             $moneys=$v1['money']*($v['percent']/100);
                            if($moneys>$v['ding41']){
                                $lmoney=$v['ding41'];//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$v['ding41'];//拦货金额佣金
                                if($v1['status']==1){
                                    $lmoneys=$v['ding41']*$v1['odds'];//我拦货的中奖金额
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }else{
                                $lmoney=$moneys;//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$lmoney;//拦货金额佣金 
                                 if($v1['status']==1){
                                    $lmoneys=$lmoney*$v1['odds'];//我拦货的中奖金额
                                    //$arr['moneys']=intval($moneys); 
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }
                        }elseif($v['xian21']>=1 && $v1['mingxi_1']=='2现' && $v1['js']=='0'){

                              $moneys=$v1['money']*($v['percent']/100);
                            if($moneys>$v['xian21']){
                                $lmoney=$v['xian21'];//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$v['xian21'];//拦货金额佣金
                                if($v1['status']==1){
                                    $lmoneys=$v['xian21']*$v1['odds'];//我拦货的中奖金额
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }else{
                                $lmoney=$moneys;//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$lmoney;//拦货金额佣金 
                                 if($v1['status']==1){
                                    $lmoneys=$lmoney*$v1['odds'];//我拦货的中奖金额
                                    //$arr['moneys']=intval($moneys); 
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }
                        }elseif($v['xian31']>=1 && $v1['mingxi_1']=='3现' && $v1['js']=='0'){

                            $moneys=$v1['money']*($v['percent']/100);
                            if($moneys>$v['xian31']){
                                $lmoney=$v['xian31'];//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$v['xian31'];//拦货金额佣金
                                if($v1['status']==1){
                                    $lmoneys=$v['xian31']*$v1['odds'];//我拦货的中奖金额
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }else{
                                $lmoney=$moneys;//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$lmoney;//拦货金额佣金 
                                 if($v1['status']==1){
                                    $lmoneys=$lmoney*$v1['odds'];//我拦货的中奖金额
                                    //$arr['moneys']=intval($moneys); 
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }
                        }elseif($v['xian41']>=1 && $v1['mingxi_1']=='4现' && $v1['js']=='0'){
                              $moneys=$v1['money']*($v['percent']/100);
                            if($moneys>$v['xian41']){
                                $lmoney=$v['xian41'];//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$v['xian41'];//拦货金额佣金
                                if($v1['status']==1){
                                    $lmoneys=$v['xian41']*$v1['odds'];//我拦货的中奖金额
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }else{
                                $lmoney=$moneys;//拦货金额
                                $loss=$v1['win']/$v1['money'];//金额平均佣金
                                $lhuishui=$loss*$lmoney;//拦货金额佣金 
                                 if($v1['status']==1){
                                    $lmoneys=$lmoney*$v1['odds'];//我拦货的中奖金额
                                    //$arr['moneys']=intval($moneys); 
                                }  
                                //中奖金额+回水-下注 下注-中奖金额-回水
                                if($qishus['m_status']==3){
                                    $lyingkui=$lmoney-$lmoneys-$lhuishui;
                                    //$lyingkui=$lmoneys+$lhuishui-$lmoney;
                                    //$ding21Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                }
                                $status1=1;
                            }
                        }


                    }
                }//判断
            }//下注数据循环
            $data[$k1]['status1']=$status1;
            $data[$k1]['lmoney']=$lmoney;
            $data[$k1]['lmoneys']=$lmoneys;
            $data[$k1]['lhuishui']=$lhuishui;
            $data[$k1]['lyingkui']=$lyingkui;
            $data[$k1]['money']=$v1['money']-$lmoney;
            $data[$k1]['moneys']=$data[$k1]['umoneys']-$lmoneys;
            $data[$k1]['yingkui']=$data[$k1]['uyingkui']-$lyingkui;
            $data[$k1]['win']=$v1['win']-$lhuishui;
            $lmoney='';
            $lmoneys='';
            $lyingkui='';
        }//代理拦货配置循环

        return $data;
    }
    //下载数据
    // public function download(){
    //      $qishu1=I('post.qishu');//搜索期数
    //     $userid=I('post.userid');//搜索用户ID
    //     $category=I('post.category');//搜索类型
    //     $names=I('post.names');//搜索号码和订单号
    //     $qishu=qishus();//所有期数
    //     $arrs=users($userid);//所有下级会员ID（搜索下级用户ID）
    //     if(!empty($qishu1)){
    //         $where['qishu']=$qishu1;
    //         $qishu1=$qishu1;
    //     }else{
    //         $where['qishu']=$qishu[0]['qishu'];
    //         $qishu1=$qishu[0]['qishu'];
    //     }   
    //     if(!empty($category)){
    //         $where['mingxi_1']=$category; 
    //     }
    //     if(!empty($arrs[0])){
    //         $where['uid']=array('in',$arrs[0]); 
    //     }
    //     if(!empty($category)){
    //         $where['mingxi_1']=$category; 
    //     }
    //     if(!empty($names)){
    //         $map['mingxi_2']=array('like','%'.$names.'%');
    //         $map['did']=array('like','%'.$names.'%');
    //         $map['_logic'] = 'OR';
    //         $where['_complex'] = $map;
    //     }
    //     if(!empty($arrs[0])){
            
    //         $bets=M('bet');
    //         $count      = $bets->where($where)->count();
    //         $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    //         $show       = $Page->show();// 分页显示输出
    //         $field='did,username,addtime,mingxi_1,mingxi_2,odds,money,qishu,id';

    //         $data=$bets->field($field)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
            
    //     }
    //     $data=D('Download')->getDate($data);
    //     // var_dump($data);
    //     // exit;
    // }
    //中奖明细
    public function lotteryOrder(){
        $qishu=I('get.qishu');//搜索期数
        $uname=I('get.uname');//用户名称
        $number=I('get.number');//下注号码
        $xian=I('get.xian');//号码类型
        $condition=I('get.condition');//赔率、金额和退码
        $start=I('get.start');//开始
        $finish=I('get.finish');//结束
        $category=I('get.category');//号码类型
        $types=I('get.types');//下注类型
        $userid=I('get.uid');//会员搜索
        $uid=getUser();//当前用户下所有的会员
        $qishus=qishus();//所有期数
        //dump($uid);
        if(!empty($uid) && isset($uid)){
            if(!empty($userid) && isset($userid)){
                $where['uid']=$userid;//当前会员
            }else{
                $where['uid']=array('in',$uid);//当前用户下所有的会员 
            }
        //$where['status']=array('in','0,1');//状态
        $where['status']=1;//状态
        if(!empty($qishu)){//期号
            $where['qishu']=$qishu;
            $where['qishu']=$qishu;
            $opentime['m_status']=3;
        }else{
            $where['qishu']=$qishus[0]['qishu'];
            $qishu=$qishus[0]['qishu'];
            $opentime['m_status']=3;
        }   
        if(!empty($uname)){//会员名称
            $where['username']=array('like','%'.$uname.'%');
        }
        if(!empty($number)){//下注号码
            $where['mingxi_2']=array('like','%'.$number.'%');
            if(!empty($xian)){//号码类型
                $where['mingxi_3']=$xian;
            }
        }
        $where['js']=0;
        if(!empty($condition) && $condition=='tm' ){//赔率、金额、退码
           // $where['k_bet.js']=2;
        }elseif(!empty($condition) && $condition=='pl' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
               $where['odds']=array(array('egt',intval($start)),array('elt',intval($finish)),'and'); 
               //$where['odds']=array('between',array($start),array($finish)); 
            }
            
        }elseif(!empty($condition) && $condition=='je' ){//赔率、金额、退码
            if(!empty($start) && !empty($finish)){
                $where['money']=array(array('egt',intval($start)),array('elt',intval($finish)),'and');
            }
        }
        if(!empty($category)){
            if($category=='1'){
              $where['types']=array('in','口口XX,口X口X,口XX口,X口X口,X口口X,XX口口');
            }elseif($category=='三定位'){
              $where['types']=array('in','口口口X,口口X口,口X口口,X口口口');
            }elseif($category=='四定位'){
              $where['types']='4定';
            }elseif($category=='四字现'){
              $where['types']='4现';
            }elseif($category=='三字现'){
              $where['types']='3现';
            }elseif($category=='二字现'){
              $where['types']='2现';
            }else{
              $where['types']=$category;
            }
        }
  
        $bets=M('bet');
        $count      = $bets->where($where)->count();
        $Page       = new \Think\Page($count,50);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $page1=$count/50;
        
        $show       = $Page->show();// 分页显示输出
        $field='win,did,username,tuima_time,addtime,mingxi_1,mingxi_2,odds,money,js,status,topwin,topmoney';

        $data=$bets->field($field)->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
           
        }

        
        if($data){
            $data1=$this->process($data,$opentime); 
            // $datas1['sum']=count($data);
            // $datas1['moneys']='0.00';
            // $datas1['win']='0.00';
            // foreach($data as $k=>$v){
            //     $datas1['money']+=$v['money'];
            //     if($v['status']==1){
            //        $datas1['moneys']+=$v['money']*$v['odds']; 
            //     }
            //     $datas1['win']+=$v['win'];
            // }
            //加工数据-->1得到所有代理配置拦货数据
            
            // $lanhuo=M('ubet')->select();
            // if($lanhuo){
            //     $data1=$this->process($data,$lanhuo,$opentime); 
            // }else{
            //     $data1=$data;
            // }
            // dump($data1);
            // dump($data);
            $datas1['sum']=0;
            $datas1['moneys']='0.00';
            $datas1['win']='0.00';
            foreach($data1 as $k=>$v){
                $datas1['sum']+=1;
                if($v['js']==0){
                    // if($v['money']){
                    //     $datas1['sum']+=1;
                    // }
                    $datas1['money']+=$v['money'];
                    if($v['status']==1){
                       $datas1['moneys']+=$v['moneys']; 
                    }
                    $datas1['win']+=$v['win'];
                    $datas1['yingkui']+=$v['yingkui'];
                }
            }
        }
       //dump($data1);
        $this->assign('page1',intval($page1));//汇总数据
        $this->assign('data1',$datas1);//汇总数据
        $this->assign('uname',$uname);//用户名称搜索
        $this->assign('qishu',$qishu);//搜索期数
        $this->assign('number',$number);//下注号码
        $this->assign('xian',$xian);//现
        $this->assign('condition',$condition);//赔率、金额退码
        $this->assign('start',$start);//赔率、金额退码
        $this->assign('finish',$finish);//赔率、金额退码
        $this->assign('category',$category);//下注号码类型
        $this->assign('types',$types);//下注类型
        $this->assign('qishus',$qishus);//所有期数
        $this->assign('data',$data1);//数据
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display();  
    }
    //中奖下注数据导出
   // public function download1(){

    //     $qishu1=I('get.qishu');//搜索期数
    //     $userid=I('get.userid');//搜索用户ID
    //     $category=I('get.category');//搜索类型
    //     $names=I('get.names');//搜索号码和订单号
    //     $qishu=qishus();//所有期数
    //     $arrs=users($userid);//所有下级会员ID（搜索下级用户ID）
    //     if(!empty($qishu1)){
    //         $where['qishu']=$qishu1;
    //         $qishu1=$qishu1;
    //     }else{
    //         $where['qishu']=$qishu[0]['qishu'];
    //         $qishu1=$qishu[0]['qishu'];
    //     }   
    //     if(!empty($category)){
    //         $where['mingxi_1']=$category; 
    //     }
    //     if(!empty($arrs[0])){
    //         $where['uid']=array('in',$arrs[0]); 
    //     }
    //     if(!empty($names)){
    //         $map['mingxi_2']=array('like','%'.$names.'%');
    //         $map['did']=array('like','%'.$names.'%');
    //         $map['_logic'] = 'OR';
    //         $where['_complex'] = $map;
    //     }
    //     $where['status']=1;
    //     if(!empty($arrs[0])){
            
    //         $bets=M('bet');
    //         $count      = $bets->where($where)->count();
    //         $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    //         $show       = $Page->show();// 分页显示输出
    //         $field='did,username,addtime,mingxi_1,mingxi_2,odds,money,id,qishu';

    //         $data=$bets->field($field)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
            
    //     }

    //     $dd=D('Download')->getDate($data);
    // }
    //拦货明细
    public function  canvassOrder(){
        $qishu1=I('get.qishu');//搜索期数
        $userid=I('get.userid');//搜索用户ID
        $category=I('get.category');//搜索类型
        $names=I('get.names');//搜索号码和订单号
        $qishu=qishus();//所有期数
        $arrs=users($userid);//所有下级会员ID（搜索下级用户ID）
        if(!empty($qishu1)){
            $where['qishu']=$qishu1;
            $qishu1=$qishu1;
        }else{
            $where['qishu']=$qishu[0]['qishu'];
            $qishu1=$qishu[0]['qishu'];
        }   
        if(!empty($arrs[0])){
            $where['uid']=array('in',$arrs[0]); 
        }
        if(!empty($names)){
            $map['mingxi_2']=array('like','%'.$names.'%');
            $map['did']=array('like','%'.$names.'%');
            $map['_logic'] = 'OR';
            $where['_complex'] = $map;
        }
        if(!empty($arrs[0])){
            
            $bets=M('bet');
            $count      = $bets->where($where)->count();
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出
            $field='did,username,addtime,mingxi_1,mingxi_2,odds,money';

            $data=$bets->field($field)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
            
        }

        $this->assign('names',$names);//input搜索
        $this->assign('qishu1',$qishu1);//搜索期数
        $this->assign('userid',$userid);//搜索用户ID
        $this->assign('user',$arrs[1]);//所有下级会员
        $this->assign('qishu',$qishu);//所有期数
        $this->assign('data',$data);//数据
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display(); 
    }





    //月份账数据管理
    // public function may(){
        
    //     $this->display();    
    // }
    //开奖号码列表
    public function lists(){
        // $where['m_status']=1;
        $data=M('opentime')->order('id desc')->select();
        //dump($data);
        $this->assign('data',$data);
    	$this->display();
    }

    //日报表-->显示所属会员当天下注数据汇总
    public function reports(){
        $qishu1=I('get.qishu');//搜索期数
        $userid=I('get.userid');//搜索用户ID

        $qishu=qishus();//所有期数
        $arrs=users($userid);//所有下级会员ID（搜索下级用户ID）
        //dump($arrs);
        //$uid=getUser();
        if(!empty($qishu1)){
            $where['qishu']=$qishu1;
            $qishu1=$qishu1;
        }else{
            $where['qishu']=$qishu[0]['qishu'];
            $qishu1=$qishu[0]['qishu'];
        }   
        if(!empty($arrs[0])){
            $where['uid']=array('in',$arrs[0]); 
        }
        //dump($arrs);
        if(!empty($arrs[0])){
            $where['js']=array('in','0,1');
            $bets=M('bet');
            // $count      = $bets->where($where)->count();
            // $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            // $show       = $Page->show();// 分页显示输出

            $data=$bets->field('uid,username,types,money,js,status,win,odds')->where($where)->select();
            if(!empty($data) && isset($data)){
                $uidarr=explode(',',$arrs[0]);
                foreach($uidarr as $k=>$v){

                    foreach($data as $k1=>$v1){
                        
                        if($v==$v1['uid']){
                           
                            $data1['username']=$v1['username'];
                            if($v1['status']==1){
                                $data1['moneys']+=$v1['money']*$v1['odds'];
                            }else{
                                //if($data1['moneys']){
                                   $data1['moneys']+=0;  
                                //}
                            }

                            $data1['money']+=$v1['money'];
                            $data1['sum']+=1;
                        }
                    }
                    if($data1){
                        // if($data1['moneys']){
                        //      $data1['moneys']='0';  
                        // }
                        $data2[]=$data1;
                        $data3['moneys']+=$data1['moneys'];
                        $data3['money']+=$data1['money'];
                        $data3['sum']+=$data1['sum'];
                        $data1='';  
                    }
                   
                }
            }
            
        }
        //dump($data3);
        $titles=utype();//下级标题
        $this->assign('titles',$titles[0]);//标题
        $this->assign('qishu1',$qishu1);//搜索期数
        $this->assign('userid',$userid);//搜索用户ID
        $this->assign('user',$arrs[1]);//所有下级会员
        //$this->assign('qishu',$qishu);//所有期数
        $this->assign('data',$data2);//数据
        $this->assign('data1',$data3);//汇总数据

        $this->display();
    }

    //月报表
    public function reports1(){
        $qishu1=I('get.qishu1');//搜索期数
        $qishu2=I('get.qishu2');//搜索期数
        $userid=I('get.userid');//搜索用户ID
 
        $qishu=qishus();//所有期数
        $arrs=users($userid);//所有下级会员ID（搜索下级用户ID）
        $titles=utype();//下级标题

        if(!empty($qishu1) && !empty($qishu2)){
            $where['qishu']=array(array('egt',($qishu1)),array('elt',($qishu2)),'and');
           
        }  
        if(!empty($arrs[0])){
            $where['uid']=array('in',$arrs[0]); 
        }
        //dump($arrs);
        if(!empty($arrs[0])){
            if(isset($qishu) && !empty($qishu)){
                foreach($qishu as $k=>$v){   
                    $qishuarr[$v['qishu']]=date('m-d',strtotime($v['kaipan']));//分组
                } 
            }
            $where['js']=array('in','0,1');
            $bets=M('bet');
            // $count      = $bets->where($where)->count();
            // $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            // $show       = $Page->show();// 分页显示输出
            if(!empty($arrs[0])){
                $data=$bets->field('uid,qishu,username,money,js,status,odds')->where($where)->select();
            }
            if(!empty($data) && isset($data)){
                $uidarr=explode(',',$arrs[0]);
                foreach($qishuarr as $k=>$v){

                    foreach($data as $k1=>$v1){
                        
                        if($k==$v1['qishu']){
                           
                            $data1['username']=$v1['username'];
                            if($v1['status']==1){
                                $data1['moneys']+=$v1['money']*$v1['odds'];
                            }else{
                               $data1['moneys']+=0;  
                            }

                            $data1['money']+=$v1['money'];
                            $data1['sum']+=1;
                        }
                    }
                    if($data1){
                        $data1['name']=$v.'('.$k.')';
                        $data2[]=$data1;
                        $data3['moneys']+=$data1['moneys'];
                        $data3['money']+=$data1['money'];
                        $data3['sum']+=$data1['sum'];
                        $data1='';  
                    }
                   
                }
            }
            
        }
        //dump($data2);
        $this->assign('titles',$titles[0]);//标题
        $this->assign('qishu1',$qishu1);//搜索期数
        $this->assign('qishu2',$qishu2);//搜索期数
        $this->assign('userid',$userid);//搜索用户ID
        $this->assign('user',$arrs[1]);//所有下级会员
         $this->assign('qishu3',array_reverse($qishu));//所有期数
        $this->assign('qishu4',$qishu);//所有期数
        $this->assign('data',$data2);//数据
        $this->assign('data1',$data3);//汇总数据

        $this->display();
    }


    //积分清零操作
    public function addMoenys2(){
        $type=session('autype');
        $uid=I('get.uid');
        if($type=='agencys' && !empty($uid)){//总代理
            $where['au_type']='agency';
            $where['au_id']=array('in',$uid);
            $data['au_money']=0;
            $dd=M('admin')->where($where)->save($data);
        }elseif($type=='agency' && !empty($uid)){
            $where['u_type']='member';
            $where['uid']=array('in',$uid);
            $data['money']=0;
            $dd=M('user')->where($where)->save($data);
        }
        echo '1';
    }

    //等级报表数汇总
    //等级报表数汇总
    public function ureports(){
        $unames=I('get.unames');//空
        $qishu1=I('get.qishu');//空
        if(!empty($qishu1)){
            $where1['qishu']=$qishu1;
            $qishus=M('opentime')->field('qishu,m_status')->where($where1)->find();
        }else{
            $qishus=M('opentime')->field('qishu,m_status,m_loss')->order('id desc')->find();//进入这里
            $where1['qishu']=$qishus['qishu'];
        }
        if($unames){
            $where2['au_name']=$unames;
            $udata=M('admin')->field('au_id,au_type')->where($where2)->find();
            if($udata){
                $utype=$udata['au_type'];
                //$uagency=user3($udata['au_id'],$auid);
                $data=users2($udata['au_id'],$udata['au_type']);//当前下级账号类型
                if(!empty($data[0])){
                    $where1['uid']=array('in',$data[0]);
                }else{
                    $where1['uid']='-1';
                }
            }else{
                $where1['uid']='-1';
            }

        }else{
            //进入这里
            $auid=session('auid');
            $autype=session('autype');
            $data=users2($auid,$autype);//当前下级账号类型
            if(!empty($data[0])){
                $where1['uid']=array('in',$data[0]);//array(2) { ["qishu"]=> string(1) "2" ["uid"]=> array(2) { [0]=> string(2) "in" [1]=> string(11) "21,25,26,27" } }
            }else{
                $where1['uid']='-1';
            }
            $utype=$autype;
        }
        //得到最近一期的所有下注数据

        $where1['js']=0;
        set_time_limit(0);
        $datas=M('bet')->field('uid,win,money as moneys,js,qishu,odds,odds_hy,odds_dl,odds_zd,mingxi_1,mingxi_2,status,topmoney,topwin')->where($where1)->select();
        //$data = array(3) { [0]=> array(3) { ["au_id"]=> string(3) "121" ["au_name"]=> string(6) "shi002" ["au_type"]=> string(7) "agencys" } [1]=> array(3) { ["au_id"]=> string(3) "125" ["au_name"]=> string(6) "shi007" ["au_type"]=> string(7) "agencys" } [2]=> array(3) { ["au_id"]=> string(3) "126" ["au_name"]=> string(6) "shi100" ["au_type"]=> string(7) "agencys" } }
        if(!empty($datas) && !empty($data[1])){
            $datas1=$data[1];
            $guanliyuanhuishui = $this->gudong($qishus['qishu']);
            if($utype=='agency'){
                foreach($datas1 as $k1=>$v1){
                    foreach($datas as $k2=>$v2){
                        if($v2['uid']==$v1['uid']){
                            if($unames == '')
                            {
                                $bets=M('bet');
                                $zongjilu=$bets->where(['qishu'=>$v2['qishu'], 'uid'=>$v1['uid']])->select();
                                //获取四定赔率
                                $zongding4=$bets->where(['qishu'=>$v2['qishu'], 'mingxi_1'=>'4定'])->find();
                                $huiyuanhuiding4=intval($zongding4['odds_hy']);
                                $huiyuanhuishuiding4=intval($zongding4['odds_dl']);
                                //获取三定赔率
                                $zongding3=$bets->where(['qishu'=>$v2['qishu'], 'mingxi_1'=>'3定'])->find();
                                $huiyuanhuiding3=intval($zongding3['odds_hy']);
                                $huiyuanhuishuiding3=intval($zongding3['odds_dl']);
                                //获取二定赔率
                                $zongding2=$bets->where(['qishu'=>$v2['qishu'], 'mingxi_1'=>'2定'])->find();
                                $huiyuanhuiding2=intval($zongding2['odds_hy']);
                                $huiyuanhuishuiding2=intval($zongding2['odds_dl']);
                                //获取二现
                                $zongxian2=$bets->where(['qishu'=>$v2['qishu'], 'mingxi_1'=>'2现'])->find();
                                $huiyuanhuixian2=intval($zongxian2['odds_hy']);
                                $huiyuanhuishuixian2=intval($zongxian2['odds_dl']);
                                //获取三现赔率
                                $qixian=$v2['qishu'];
                                $xianid=$v2['uid'];
                                $zongxian=$this->abc($qixian, $xianid);
                                //获取三现
                                $ding4=0;
                                $ding3=0;
                                $ding2=0;
                                $xian2=0;
                                foreach($zongjilu as $item=>$value)
                                {
                                    if($value['mingxi_1'] == '4定')
                                    {
                                        $ding4+=intval($value['money']);
                                    }
                                    else if($value['mingxi_1'] == '3定')
                                    {
                                        $ding3+=intval($value['money']);
                                    }
                                    else if($value['mingxi_1'] == '2定')
                                    {
                                        $ding2+=intval($value['money']);
                                    }
                                    else if($value['mingxi_1'] == '2现')
                                    {
                                        $xian2+=intval($value['money']);
                                    }
                                }
                                $ding4huishui=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
                                $ding3huishui=$ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
                                $ding2huishui=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
                                $xian2huishui=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
                                $zonghuishui=$ding4huishui + $ding3huishui + $ding2huishui + $xian2huishui + $zongxian;
                            }
                            $arr['sum']+=1;
                            $win+=$v2['win'];
                            $arr['win']=intval($win);
                            $win1+=$v2['topwin'];
                            $arr['uwin']=intval($win1);
                            $money+=$v2['moneys'];
                            $arr['money']=intval($money);
                            $money1+=$v2['topmoney'];
                            $arr['umoney']=intval($money1);
                            if($v2['status']==1){
                                $moneys+=$v2['moneys']*$v2['odds'];
                                $arr['moneys']=intval($moneys);
                                $moneys1+=$v2['topmoney']*$v2['odds'];
                                //$arr['umoneys']=intval($moneys);
                            }
                            if($qishus['m_status']==3){
                                $arr['yingkuis']=$arr['moneys']+$arr['win']-$arr['money'];
                                $arr['yingkui']=$arr['money']-$arr['moneys']-$arr['win'];
                                $arr['uyingkuis']=$moneys1+$arr['uwin']-$arr['umoney'];
                                $arr['uyingkui']=$arr['umoney']-$moneys1-$arr['uwin'];
                            }
                        }
                    }
                    $datas1[$k1]['au_name']=$v1['username'];
                    if($arr){
                        $data2['umoney']+=$arr['umoney'];//下注笔数
                        $data2['sum']+=$arr['sum'];//下注笔数
                        $data2['money']+=$arr['money'];//金额
                        $data2['win1']+=$arr['win'];//回水
                        $data2['moneys1']+=$arr['moneys'];//中奖汇总
                        $data2['sums1']+=1;//
                        $data2['huishui']+=$zonghuishui;//
                        //盈亏
                        if($qishus['m_status']==3){
                            $data2['yingkui']+=$arr['yingkui'];
                            $data2['yingkuis']+=$arr['yingkuis'];
                            $data2['uyingkui']+=$arr['uyingkui'];
                            $data2['uyingkuis']+=$arr['uyingkuis'];
                        }

                        $datas1[$k1]['sum']=$arr['sum'];
                        $datas1[$k1]['money']=$arr['money'];
                        $datas1[$k1]['yingkui']=$arr['yingkui'];
                        $datas1[$k1]['yingkuis']=$arr['yingkuis'];
                        $datas1[$k1]['umoney']=$arr['umoney'];
                        $datas1[$k1]['uyingkui']=$arr['uyingkui'];
                        $datas1[$k1]['uyingkuis']=$arr['uyingkuis'];
                        $datas1[$k1]['huishui'] = $zonghuishui;
                    }
                    unset($arr);
                    $win='';
                    $win1='';
                    $money='';
                    $money1='';
                    $moneys='';
                    $moneys1='';
                    $zonghuishui='';
                }
            }else{
                foreach($datas1 as $k1=>$v1){
                    if($udata){
                        $uids=users2($udata['au_id'],$udata['au_type'],$v1['au_id']);
                    }else{
                        $uids=users($v1['au_id']);
                    }
                    if(!empty($uids[0])){
                        $uidarr=explode(',',$uids[0]);
                        //var_dump($uids[0]);string(8) "21,25,27"
                        //var_dump($uidarr);array(3) { [0]=> string(2) "21" [1]=> string(2) "25" [2]=> string(2) "27" } int(10)
                        $xin = [];
                        foreach($datas as $k2=>$v2){
                            $arr['qishu']=$v2['qishu'];
                            if(in_array($v2['uid'],$uidarr)){
                                $xin[]=$v2;
                                $arr['sum']+=1;
                                $win+=$v2['win']-$v2['topwin'];
                                $arr['win']=intval($win);
                                $money+=$v2['moneys']-$v2['topmoney'];
                                $arr['money']=intval($money);
                                $money1+=$v2['topmoney'];
                                $arr['umoney']=intval($money1);
                                //代理回水
                                $huishui+=$v2['top1'];
                                $huishui2+=$v2['top2'];
                                $arr['huishui']=$huishui;
                                $arr['huishui2']=$huishui2;
                                if($v2['status']==1){
                                    $moneys+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];
                                    $arr['moneys']=intval($moneys);
                                }
                                if($qishus['m_status']==3){
                                    $arr['yingkuis']=$arr['moneys']+$arr['win']-$arr['money'];
                                    $arr['yingkui']=$arr['money']-$arr['moneys']-$arr['win'];
                                }
                            }
                        }
                        if($unames == '')
                        {
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
                            //$utype
                            if($utype == 'agencys')
                            {
                                $zongding25=0;
                                $zongding35=0;
                                $zongding45=0;
                                $zongxian25=0;
                                $zongxian3115=0;
                                $zongxian3215=0;
                                $zongxian3315=0;

                                foreach($xin as $item=>$value)
                                {
                                    if($value['mingxi_1'] == '4定')
                                    {
                                        $ding4=intval($value['moneys']);
                                        $huiyuanhuishuiding4=intval($value['odds_zd']);
                                        $huiyuanhuiding4=intval($value['odds_dl']);
                                        $zongding45+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
                                    }
                                    else if($value['mingxi_1'] == '3定')
                                    {
                                        $ding3=intval($value['moneys']);
                                        $huiyuanhuishuiding3=intval($value['odds_zd']);
                                        $huiyuanhuiding3=intval($value['odds_dl']);
                                        $zongding35 += $ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
                                    }
                                    else if($value['mingxi_1'] == '2定')
                                    {
                                        $ding2=intval($value['moneys']);
                                        $huiyuanhuishuiding2=intval($value['odds_zd']);
                                        $huiyuanhuiding2=intval($value['odds_dl']);
                                        $zongding25+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
                                    }
                                    else if($value['mingxi_1'] == '2现')
                                    {
                                        $xian2=intval($value['moneys']);
                                        $huiyuanhuishuixian2=intval($value['odds_zd']);
                                        $huiyuanhuixian2=intval($value['odds_dl']);
                                        $zongxian25+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
                                    }
                                    else if($value['mingxi_1'] == '3现')
                                    {
                                        $t=array_count_values(str_split($value['mingxi_2']));
                                        if(max($t) == 1)
                                        {
                                            $xian3tong=$value['moneys'];
                                            $xian3shui=intval($value['odds_dl']);
                                            $xian3huishui=intval($value['odds_zd']);
                                            $xian3115+=$xian3tong * ($xian3huishui - $xian3shui) * 0.02;

                                        }
                                        else if(max($t) == 2)
                                        {
                                            $xian31tong=$value['moneys'];
                                            $xian31shui=intval($value['odds_dl']);
                                            $xian31huishui=intval($value['odds_zd']);
                                            $zongxian3215+=$xian31tong * ($xian31huishui - $xian31shui) * 0.017;
                                        }
                                        else if(max($t) == 3)
                                        {
                                            $xian32tong=$value['moneys'];
                                            $xian32shui=intval($value['odds_dl']);
                                            $xian32huishui=intval($value['odds_zd']);
                                            $zongxian3315+=$xian3tong * ($xian3huishui - $xian3shui) * 0.014;
                                        }
                                    }
                                }
                                $zonghuishui25=$zongding45 + $zongding35 + $zongding25 + $zongxian25 + $zongxian3115 + $zongxian3215 + $zongxian3315;
                            }
                            else if($utype == 'partner')
                            {
                                $guanliyuan1 = M('opentime')->where(['qishu'=>$qishus['qishu']])->find();
                                $gudonghuishui=json_decode($guanliyuan1['m_loss']);

                                $zonghuishui = $this->dagudong($xin,$gudonghuishui);
                            }

                        }
                        if($arr){//会员的销售额-佣金-中奖金额=会员的盈亏
                            $data2['umoney']+=$arr['umoney'];//代理回水
                            $data2['huishui']+=$arr['huishui'];//代理回水
                            $data2['huishui2']+=$zonghuishui25;//总代回水
                            $data2['huishuis']+=$zonghuishui;//股东回水
                            $data2['huishuiss']=$guanliyuanhuishui;//股东回水
                            $data2['sum']+=$arr['sum'];//下注笔数
                            $data2['money']+=$arr['money'];//金额
                            $data2['win1']+=$arr['win'];//回水
                            $data2['moneys1']+=$arr['moneys'];//中奖汇总
                            $data2['sums1']+=1;//
                            //盈亏
                            if($qishus['m_status']==3){
                                $data2['yingkui']+=$arr['yingkui'];
                                $data2['yingkuis']+=$arr['yingkuis'];
                            }
                            $datas1[$k1]['huishui']=$arr['huishui'];
                            $datas1[$k1]['huishui2']=$arr['huishui2'];
                            $datas1[$k1]['qishu']=$arr['qishu'];

                            $datas1[$k1]['sum']=$arr['sum'];
                            $datas1[$k1]['money']=$arr['money'];
                            $datas1[$k1]['yingkui']=$arr['yingkui'];
                            $datas1[$k1]['yingkuis']=$arr['yingkuis'];
                            $datas1[$k1]['huishui2']=$zonghuishui25;
                            $datas1[$k1]['huishuis']=$zonghuishui;

                        }
                        $arr='';
                        $win='';
                        $money='';
                        $moneys='';
                        $money1='';
                    }
                    unset($uidarr);
                    unset($uids);
                    unset($arr);
                    $win='';
                    $win1='';
                    $money='';
                    $money1='';
                    $moneys='';
                    $moneys1='';
                }
                foreach($datas1 as $k3=>$v3){
                    if($v3['au_id']){
                        $where3['au_id']=$v3['au_id'];
                        $where3['qishu']=$v3['qishu'];
                        $v3['huishui']=M('backwater')->where($where3)->sum('sums');
                    }
                    $datas1[$k3]=$v3;
                }

            }//if
        }
        //       dump($datas1);exit;
        $this->assign('huishui',$huishui);
        $this->assign('uyingkuis',$uyingkuis);
        $this->assign('uyingkui',$uyingkui);
        $this->assign('umoney',$umoney);
        $this->assign('data',$data2);
        $this->assign('datas',$datas1);
        $this->assign('qishu1',$qishus['qishu']);
        $this->assign('utype',$utype);
        $this->display();
    }
    private function dagudong($qishu,$gudonghuishui)
    {;
        $zongding213=0;
        $zongding313=0;
        $zongding413=0;
        $zongxian213=0;
        $zongxian3123=0;
        $zongxian3223=0;
        $zongxian3323=0;

        foreach($qishu as $item=>$value)
        {
            if($value['mingxi_1'] == '4定')
            {
                $ding4=intval($value['moneys']);
                $huiyuanhuishuiding4=intval($gudonghuishui->ding41);
                $huiyuanhuiding4=intval($value['odds_zd']);
                $zongding413+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
            }
            else if($value['mingxi_1'] == '3定')
            {
                $ding3=intval($value['moneys']);
                $huiyuanhuishuiding3=intval($gudonghuishui->ding31);
                $huiyuanhuiding3=intval($value['odds_zd']);
                $zongding313+=$ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
            }
            else if($value['mingxi_1'] == '2定')
            {
                $ding2=intval($value['moneys']);
                $huiyuanhuishuiding2=intval($gudonghuishui->ding21);
                $huiyuanhuiding2=intval($value['odds_zd']);
                $zongding213+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
            }
            else if($value['mingxi_1'] == '2现')
            {
                $xian2=intval($value['moneys']);
                $huiyuanhuishuixian2=intval($gudonghuishui->tong211);
                $huiyuanhuixian2=intval($value['odds_zd']);
                $zongxian213+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
            }
            else if($value['mingxi_1'] == '3现')
            {
                $t=array_count_values(str_split($value['mingxi_2']));
                if(max($t) == 1)
                {
                    $xian3tong=$value['moneys'];
                    $xian3shui=intval($value['odds_zd']);
                    $xian3huishui=intval($gudonghuishui->tong311);
                    $zongxian3123+=$xian3tong * ($xian3huishui - $xian3shui) * 0.02;

                }
                else if(max($t) == 2)
                {
                    $xian31tong=$value['moneys'];
                    $xian31shui=intval($value['odds_zd']);
                    $xian31huishui=intval($gudonghuishui->tong321);
                    $zongxian3223+=$xian31tong * ($xian31huishui - $xian31shui) * 0.017;


                }
                else if(max($t) == 3)
                {
                    $xian32tong=$value['moneys'];
                    $xian32shui=intval($value['odds_zd']);
                    $xian32huishui=intval($gudonghuishui->tong331);
                    $zongxian3323+=$xian32tong * ($xian32huishui - $xian32shui) * 0.014;

                }
            }
        }
        return $zonghuishui=$zongding413 + $zongding313 + $zongding213 + $zongxian213 + $zongxian3123 + $zongxian3223 + $zongxian3323;
    }
    private function abc($qishu,$id){
        //获取三现
        $bets = M('bet');
        $zongxian3= $bets->where(array('qishu'=>$qishu,'mingxi_1'=>'3现','uid'=>$id))->select();
        $a=[];
        $b=[];
        $c=[];
        foreach($zongxian3 as $xian3=>$xian33){
            $t = array_count_values(str_split($xian33['mingxi_2']));
            $xian3tong=0;
            $xian3shui=0;
            $xian3huishui=0;
            //三现
            if(max($t) ==1){
                $a[] = array('zhi'=>$xian33['mingxi_2'],'hui'=>$xian33['odds_hy'],'huiyuan'=>$xian33['odds_dl'],'money'=>$xian33['money']);
            }
            foreach($a as $xian31=>$xian311){
                $xian3tong+=intval($xian311['money']);
                $xian3shui=intval($xian311['hui']);
                $xian3huishui=intval($xian311['huiyuan']);
            }
            $xian31tong=0;
            $xian31shui=0;
            $xian31huishui=0;
            if(max($t) == 2){
                $b[] = array('zhi'=>$xian33['mingxi_2'],'hui'=>$xian33['odds_hy'],'huiyuan'=>$xian33['odds_dl'],'money'=>$xian33['money']);
            }
            foreach($b as $xian32=>$xian321){
                $xian31tong+=intval($xian321['money']);
                $xian31shui=intval($xian321['hui']);
                $xian31huishui=intval($xian321['huiyuan']);
            }
            $xian32tong=0;
            $xian32shui=0;
            $xian32huishui=0;
            if(max($t) == 3){
                $c[] = array('zhi'=>$xian33['mingxi_2'],'hui'=>$xian33['odds_hy'],'huiyuan'=>$xian33['odds_dl'],'money'=>$xian33['money']);
            }
            foreach($c as $xian32=>$xian331){
                $xian32tong+=intval($xian331['money']);
                $xian32shui=intval($xian331['hui']);
                $xian32huishui=intval($xian331['huiyuan']);
            }
            //三现
            $huishuixian341 = $xian3tong * ($xian3huishui-$xian3shui) * 0.02;
            //三现二同
            $huishuixian342 = $xian31tong * ($xian31huishui-$xian31shui) * 0.017;
            //三现三同
            $huishuixian343 = $xian32tong * ($xian32huishui-$xian32shui) * 0.014;

        }
            return   $zongxian3huishui = $huishuixian341 + $huishuixian342 + $huishuixian343;
    }
    protected function gudong($qishu){
        $opentime = M('opentime');
        $admin = M('admin');
        $user = M('user');
        $bet = M('bet');
        $suoyou = $bet->where(['qishu'=>$qishu])->select();

        $guanliyuan = $opentime->where(['qishu'=>$qishu])->find();
        $gudonghuishui=json_decode($guanliyuan['m_loss']);
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

        $zongding21=0;
        $zongding31=0;
        $zongding41=0;
        $zongxian21=0;
        $zongxian312=0;
        $zongxian322=0;
        $zongxian332=0;

        foreach($suoyou as $item=>$value)
        {
            if($value['mingxi_1'] == '4定')
            {
                $ding4=intval($value['money']);
                $huiyuanhuishuiding4=intval($gudonghuishui->ding41);
                $huiyuanhuiding4=intval($value['odds_zd']);
                $zongding41+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
            }
            else if($value['mingxi_1'] == '3定')
            {
                $ding3=intval($value['money']);
                $huiyuanhuishuiding3=intval($gudonghuishui->ding31);
                $huiyuanhuiding3=intval($value['odds_zd']);
                $zongding31+=$ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
            }
            else if($value['mingxi_1'] == '2定')
            {
                $ding2=intval($value['money']);
                $huiyuanhuishuiding2=intval($gudonghuishui->ding21);
                $huiyuanhuiding2=intval($value['odds_zd']);
                $zongding21+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
            }
            else if($value['mingxi_1'] == '2现')
            {
                $xian2=intval($value['money']);
                $huiyuanhuishuixian2=intval($gudonghuishui->tong211);
                $huiyuanhuixian2=intval($value['odds_zd']);
                $zongxian21+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
            }
            else if($value['mingxi_1'] == '3现')
            {
                $t=array_count_values(str_split($value['mingxi_2']));
                if(max($t) == 1)
                {
                    $xian3tong=$value['money'];
                    $xian3shui=intval($value['odds_zd']);
                    $xian3huishui=intval($gudonghuishui->tong311);
                    $zongxian312+=$xian3tong * ($xian3huishui - $xian3shui) * 0.02;

                }
                else if(max($t) == 2)
                {
                    $xian31tong=$value['money'];
                    $xian31shui=intval($value['odds_zd']);
                    $xian31huishui=intval($gudonghuishui->tong321);
                    $zongxian322+=$xian31tong * ($xian31huishui - $xian31shui) * 0.017;


                }
                else if(max($t) == 3)
                {
                    $xian32tong=$value['money'];
                    $xian32shui=intval($value['odds_zd']);
                    $xian32huishui=intval($gudonghuishui->tong331);
                    $zongxian332+=$xian32tong * ($xian32huishui - $xian32shui) * 0.014;

                }
            }

        }
        $zonghuishui1=$zongding41 + $zongding31 + $zongding21 + $zongxian21 + $zongxian312 + $zongxian322 + $zongxian332;

        $zongding2=0;
        $zongding3=0;
        $zongding4=0;
        $zongxian2=0;
        $zongxian311=0;
        $zongxian321=0;
        $zongxian331=0;

        foreach($suoyou as $item=>$value)
        {
            if($value['mingxi_1'] == '4定')
            {
                $ding4=intval($value['money']);
                $huiyuanhuishuiding4=intval($value['odds_zd']);
                $huiyuanhuiding4=intval($value['odds_dl']);
                $zongding4+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
            }
            else if($value['mingxi_1'] == '3定')
            {
                $ding3=intval($value['money']);
                $huiyuanhuishuiding3=intval($value['odds_zd']);
                $huiyuanhuiding3=intval($value['odds_dl']);
                $zongding3 += $ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
            }
            else if($value['mingxi_1'] == '2定')
            {
                $ding2=intval($value['money']);
                $huiyuanhuishuiding2=intval($value['odds_zd']);
                $huiyuanhuiding2=intval($value['odds_dl']);
                $zongding2+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
            }
            else if($value['mingxi_1'] == '2现')
            {
                $xian2=intval($value['money']);
                $huiyuanhuishuixian2=intval($value['odds_zd']);
                $huiyuanhuixian2=intval($value['odds_dl']);
                $zongxian2+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
            }
            else if($value['mingxi_1'] == '3现')
            {
                $t=array_count_values(str_split($value['mingxi_2']));
                if(max($t) == 1)
                {
                    $xian3tong=$value['money'];
                    $xian3shui=intval($value['odds_dl']);
                    $xian3huishui=intval($value['odds_zd']);
                    $xian311+=$xian3tong * ($xian3huishui - $xian3shui) * 0.02;

                }
                else if(max($t) == 2)
                {
                    $xian31tong=$value['money'];
                    $xian31shui=intval($value['odds_dl']);
                    $xian31huishui=intval($value['odds_zd']);
                    $zongxian321+=$xian31tong * ($xian31huishui - $xian31shui) * 0.017;
                }
                else if(max($t) == 3)
                {
                    $xian32tong=$value['money'];
                    $xian32shui=intval($value['odds_dl']);
                    $xian32huishui=intval($value['odds_zd']);
                    $zongxian331+=$xian3tong * ($xian32huishui - $xian32shui) * 0.014;
                }
            }
        }
        $zonghuishui2=$zongding4 + $zongding3 + $zongding2 + $zongxian2 + $zongxian311 + $zongxian321 + $zongxian331;

        $zongding211=0;
        $zongding311=0;
        $zongding411=0;
        $zongxian211=0;
        $zongxian3121=0;
        $zongxian3221=0;
        $zongxian3321=0;

        foreach($suoyou as $item=>$value)
        {
            if($value['mingxi_1'] == '4定')
            {
                $ding4=intval($value['money']);
                $huiyuanhuishuiding4=intval($value['odds_dl']);
                $huiyuanhuiding4=intval($value['odds_hy']);
                $zongding411+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
            }
            else if($value['mingxi_1'] == '3定')
            {
                $ding3=intval($value['money']);
                $huiyuanhuishuiding3=intval($value['odds_dl']);
                $huiyuanhuiding3=intval($value['odds_hy']);
                $zongding311+=$ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
            }
            else if($value['mingxi_1'] == '2定')
            {
                $ding2=intval($value['money']);
                $huiyuanhuishuiding2=intval($value['odds_dl']);
                $huiyuanhuiding2=intval($value['odds_hy']);
                $zongding211+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
            }
            else if($value['mingxi_1'] == '2现')
            {
                $xian2=intval($value['money']);
                $huiyuanhuishuixian2=intval($value['odds_dl']);
                $huiyuanhuixian2=intval($value['odds_hy']);
                $zongxian211+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
            }
            else if($value['mingxi_1'] == '3现')
            {
                $t=array_count_values(str_split($value['mingxi_2']));
                if(max($t) == 1)
                {
                    $xian3tong=$value['money'];
                    $xian3shui=intval($value['odds_hy']);
                    $xian3huishui=intval($value['odds_dl']);
                    $zongxian3121+=$xian3tong * ($xian3huishui - $xian3shui) * 0.02;

                }
                else if(max($t) == 2)
                {
                    $xian31tong=$value['money'];
                    $xian31shui=intval($value['odds_hy']);
                    $xian31huishui=intval($value['odds_dl']);
                    $zongxian3221+=$xian31tong * ($xian31huishui - $xian31shui) * 0.017;


                }
                else if(max($t) == 3)
                {
                    $xian32tong=$value['money'];
                    $xian32shui=intval($value['odds_hy']);
                    $xian32huishui=intval($value['odds_dl']);
                    $zongxian3321+=$xian32tong * ($xian32huishui - $xian32shui) * 0.014;

                }
            }




        }
        $zonghuishui3=$zongding411 + $zongding311 + $zongding211 + $zongxian211 + $zongxian3121 + $zongxian3221 + $zongxian3321;

        $zongding2112=0;
        $zongding3112=0;
        $zongding4112=0;
        $zongxian2112=0;
        $zongxian31212=0;
        $zongxian32212=0;
        $zongxian33212=0;

        foreach($suoyou as $item=>$value)
        {
            if($value['mingxi_1'] == '4定')
            {
                $ding4=intval($value['money']);
                $huiyuanhuishuiding4=intval($value['odds_hy']);
                $huiyuanhuiding4=intval($value['odds']);
                $zongding4112+=$ding4 * ($huiyuanhuishuiding4 - $huiyuanhuiding4) * 0.0001;
            }
            else if($value['mingxi_1'] == '3定')
            {
                $ding3=intval($value['money']);
                $huiyuanhuishuiding3=intval($value['odds_hy']);
                $huiyuanhuiding3=intval($value['odds']);
                $zongding3112+=$ding3 * ($huiyuanhuishuiding3 - $huiyuanhuiding3) * 0.001;
            }
            else if($value['mingxi_1'] == '2定')
            {
                $ding2=intval($value['money']);
                $huiyuanhuishuiding2=intval($value['odds_hy']);
                $huiyuanhuiding2=intval($value['odds']);
                $zongding2112+=$ding2 * ($huiyuanhuishuiding2 - $huiyuanhuiding2) * 0.01;
            }
            else if($value['mingxi_1'] == '2现')
            {
                $xian2=intval($value['money']);
                $huiyuanhuishuixian2=intval($value['odds_hy']);
                $huiyuanhuixian2=intval($value['odds']);
                $zongxian2112+=$xian2 * ($huiyuanhuishuixian2 - $huiyuanhuixian2) * 0.1;
            }
            else if($value['mingxi_1'] == '3现')
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
        $zonghuishui4=$zongding4112 + $zongding3112 + $zongding2112 + $zongxian2112 + $zongxian31212 + $zongxian32212 + $zongxian33212;

        return $zonghuishui4 + $zonghuishui3 + $zonghuishui2 + $zonghuishui1;
    }
   private function getDatas1($auid,$autype,$datas,$qishus){
        //会员得到代理配置
        $data=user3($auid,$autype);

        if(!empty($data)){
            //判断代理是否配置拦货
            $where['au_id']=$data;
            $user=M('ubet')->where($where)->find(); 
            if(!empty($user)){//是否存在配置(拦货)
                //拦货类型是否配置  在进行拦货换算
                if($user['percent']>=1){//判断分成比是否配置了
                     if($user['ding21']>=1){

                            foreach($datas as $k1=>$v1){
                                //会员id判断对比
                                if($v1['mingxi_1']=='2定'){

                                    if($v1['uid']==$auid){

                                        $moneys=$v1['moneys']*($user['percent']/100);
                                        if($moneys>$user['ding21']){//
                                            $ding21Money+=$user['ding21'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding21Loss+=$loss*$user['ding21'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $ding21Moneys+=$user['ding21']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
                                                $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
                                            }
                                        }else{
                                            $ding21Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding21Loss+=$loss*$moneys;//拦货金额佣金 
                                            if($v1['status']==1){
                                                $ding21Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
                                                $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
                                            }
                                        }
                                    } 
                                }
                                  
                            } 
                        }
                        if($user['ding31']>=1){
                            
                             foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='3定'){
                                    //会员id判断对比
                                    if($v1['uid']==$auid){
                                        $moneys=$v1['moneys']*($user['percent']/100);
                                        if($moneys>$user['ding31']){
                                            $ding31Money+=$user['ding31'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding31Loss+=$loss*$user['ding31'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $ding31Moneys+=$user['ding31']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding31Yingkuis=$ding31Moneys+$ding31Loss-$ding31Money;
                                                $ding31Yingkui=$ding31Money-$ding31Loss-$ding31Moneys;
                                            }
                                        }else{
                                            $ding31Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding31Loss+=$loss*$moneys;//拦货金额佣金 
                                            if($v1['status']==1){
                                                $ding31Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding31Yingkuis=$ding31Moneys+$ding31Loss-$ding31Money;
                                                $ding31Yingkui=$ding31Money-$ding31Loss-$ding31Moneys;
                                            }
                                        }
                                    }
                                }
                                   
                            } 
                        }
                        if($user['ding41']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='4定'){
                                    //会员id判断对比
                                   if($v1['uid']==$auid){
                                        $moneys=$v1['moneys']*($user['percent']/100);
                                        if($moneys>$user['ding41']){
                                            $ding41Money+=$user['ding41'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding41Loss+=$loss*$user['ding41'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $ding41Moneys+=$user['ding41']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding41Yingkuis=$ding41Moneys+$ding41Loss-$ding41Money;
                                                $ding41Yingkui=$ding41Money-$ding41Loss-$ding41Moneys;
                                            }
                                        }else{
                                            $ding41Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding41Loss+=$loss*$moneys;//拦货金额佣金 
                                            if($v1['status']==1){
                                                $ding41Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding41Yingkuis=$ding41Moneys+$ding41Loss-$ding41Money;
                                                $ding41Yingkui=$ding41Money-$ding41Loss-$ding41Moneys;
                                            }
                                        }
                                    }  
                                }
                                 
                            } 
                        }
                        if($user['xian21']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='2现'){
                                    //会员id判断对比
                                    if($v1['uid']==$auid){
                                        $moneys=$v1['moneys']*($user['percent']/100);
                                        if($moneys>$user['xian21']){
                                            $xian21Money+=$user['xian21'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian21Loss+=$loss*$user['xian21'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $xian21Moneys+=$user['xian21']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian21Yingkuis=$xian21Moneys+$xian21Loss-$xian21Money;
                                                $xian21Yingkui=$xian21Money-$xian21Loss-$xian21Moneys;
                                            }
                                        }else{
                                            $xian21Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian21Loss+=$loss*$moneys;//拦货金额佣金 
                                             if($v1['status']==1){
                                                $xian21Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian21Yingkuis=$xian21Moneys+$xian21Loss-$xian21Money;
                                                $xian21Yingkui=$xian21Money-$xian21Loss-$xian21Moneys;
                                            }
                                        }
                                    }  
                                }
                                 
                            }
                        }
                        if($user['xian31']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='3现'){
                                    //会员id判断对比
                                    if($v1['uid']==$auid){
                                        $moneys=$v1['moneys']*($user['percent']/100);
                                        if($moneys>$user['xian31']){
                                            $xian31Money+=$user['xian31'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian31Loss+=$loss*$user['xian31'];//拦货金额佣金
                                             if($v1['status']==1){
                                                $xian31Moneys+=$user['xian31']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian31Yingkuis=$xian31Moneys+$xian31Loss-$xian31Money;
                                                $xian31Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                            }
                                        }else{
                                            $xian31Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian31Loss+=$loss*$moneys;//拦货金额佣金 
                                             if($v1['status']==1){
                                                $xian31Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian31Yingkuis=$xian31Moneys+$xian31Loss-$xian31Money;
                                                $xian31Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                            }
                                        }
                                    }  
                                }
                                 
                            }
                        }
                        if($user['xian41']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='4现'){
                                    //会员id判断对比
                                    if($v1['uid']==$auid){
                                        $moneys=$v1['moneys']*($user['percent']/100);
                                        if($moneys>$user['xian41']){
                                            $xian41Money+=$user['xian41'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian41Loss+=$loss*$user['xian41'];//拦货金额佣金
                                             if($v1['status']==1){
                                                $xian41Moneys+=$user['xian41']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian41Yingkuis=$xian41Moneys+$xian41Loss-$xian41Money;
                                                $xian41Yingkui=$xian41Money-$xian41Loss-$xian41Moneys;
                                            }
                                        }else{
                                            $xian41Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian41Loss+=$loss*$moneys;//拦货金额佣金
                                             if($v1['status']==1){
                                                $xian41Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian41Yingkuis=$xian41Moneys+$xian41Loss-$xian41Money;
                                                $xian41Yingkui=$xian41Money-$xian41Loss-$xian41Moneys;
                                            } 
                                        }
                                    }  
                                }
                                 
                            }
                        }//内部判断
                    $umoneys=$ding21Money+$ding31Money+$ding41Money+$xian21Money+$xian31Money+$xian41Money;    
                    $uloss=$ding21Loss+$ding31Loss+$ding41Loss+$xian21Loss+$xian31Loss+$xian41Loss;    
                    $yingkuis=$ding21Yingkuis+$ding31Yingkuis+$ding41Yingkuis+$xian21Yingkuis+$xian31Yingkuis+$xian41Yingkuis;    
                    $yingkui=$ding21Yingkui+$ding31Yingkui+$ding41Yingkui+$xian21Yingkui+$xian31Yingkui+$xian41Yingkui;    
                    

                }//分成
            }//是否配置拦货

        }//判断是否存在代理

        return $arr=array($umoneys,$uloss,$yingkuis,$yingkui);//代理拦货金额和佣金
    }
    //处理代理数据
    private function getDatas($auid,$autype,$datas,$qishus){
        //按照类型得到下级代理和会员
        $data=user3($auid,$autype);
        //return $data;exit;
        if(!empty($data)){
            //判断代理是否配置拦货
            $where['au_id']=array('in',$data);
            $user=M('ubet')->where($where)->select(); 
              
            if(!empty($user)){
                    //$uidArr=user4($user[1]['au_id']);
                    //$user1=M('user')->field('uid')->where(array('top_uid'=>$user[0]['au_id']))->select();
                        //return $user;exit;
                        
                foreach($user as $k=>$v){
                    $uidArr=user4($v['au_id']);
                    // if($v['ding41']>=1){

                    // }
                   
                  
                    //拦货类型是否配置  在进行拦货换算
                    if($v['percent']>=1 && $uidArr){//判断分成比是否配置了

                        if($v['ding21']>=1){

                            foreach($datas as $k1=>$v1){

                                 
                                //会员id判断对比
                                if($v1['mingxi_1']=='2定'){

                                    if(in_array($v1['uid'],$uidArr)){

                                        $moneys=$v1['moneys']*($v['percent']/100);
                                        if($moneys>$v['ding21']){//
                                            $ding21Money+=$v['ding21'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding21Loss+=$loss*$v['ding21'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $ding21Moneys+=$v['ding21']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
                                                $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
                                            }
                                        }else{
                                            $ding21Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding21Loss+=$loss*$moneys;//拦货金额佣金 
                                            if($v1['status']==1){
                                                $ding21Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
                                                $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
                                            }
                                        }
                                    } 
                                }
                                  
                            } 
                        }
                        if($v['ding31']>=1){
                            
                             foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='3定'){
                                    //会员id判断对比
                                    if(in_array($v1['uid'],$uidArr)){
                                        $moneys=$v1['moneys']*($v['percent']/100);
                                        if($moneys>$v['ding31']){
                                            $ding31Money+=$v['ding31'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding31Loss+=$loss*$v['ding31'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $ding31Moneys+=$v['ding31']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding31Yingkuis=$ding31Moneys+$ding31Loss-$ding31Money;
                                                $ding31Yingkui=$ding31Money-$ding31Loss-$ding31Moneys;
                                            }
                                        }else{
                                            $ding31Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding31Loss+=$loss*$moneys;//拦货金额佣金 
                                            if($v1['status']==1){
                                                $ding31Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding31Yingkuis=$ding31Moneys+$ding31Loss-$ding31Money;
                                                $ding31Yingkui=$ding31Money-$ding31Loss-$ding31Moneys;
                                            }
                                        }
                                    }
                                }
                                   
                            } 
                        }
                        if($v['ding41']>=1){

                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='4定'){

                                    //会员id判断对比
                                    if(in_array($v1['uid'],$uidArr)){
                                        $moneys=$v1['moneys']*($v['percent']/100);
                                        if($moneys>$v['ding41']){
                                            $ding41Money+=$v['ding41'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding41Loss+=$loss*$v['ding41'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $ding41Moneys+=$v['ding41']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding41Yingkuis=$ding41Moneys+$ding41Loss-$ding41Money;
                                                $ding41Yingkui=$ding41Money-$ding41Loss-$ding41Moneys;
                                            }
                                        }else{
                                            $ding41Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $ding41Loss+=$loss*$moneys;//拦货金额佣金 
                                            if($v1['status']==1){
                                                $ding41Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $ding41Yingkuis=$ding41Moneys+$ding41Loss-$ding41Money;
                                                $ding41Yingkui=$ding41Money-$ding41Loss-$ding41Moneys;
                                            }
                                        }
                                    }  
                                }
                                 
                            } 
                        }
                        if($v['xian21']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='2现'){
                                    //会员id判断对比
                                    if(in_array($v1['uid'],$uidArr)){
                                        $moneys=$v1['moneys']*($v['percent']/100);
                                        if($moneys>$v['xian21']){
                                            $xian21Money+=$v['xian21'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian21Loss+=$loss*$v['xian21'];//拦货金额佣金
                                            if($v1['status']==1){
                                                $xian21Moneys+=$v['xian21']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian21Yingkuis=$xian21Moneys+$xian21Loss-$xian21Money;
                                                $xian21Yingkui=$xian21Money-$xian21Loss-$xian21Moneys;
                                            }
                                        }else{
                                            $xian21Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian21Loss+=$loss*$moneys;//拦货金额佣金 
                                             if($v1['status']==1){
                                                $xian21Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian21Yingkuis=$xian21Moneys+$xian21Loss-$xian21Money;
                                                $xian21Yingkui=$xian21Money-$xian21Loss-$xian21Moneys;
                                            }
                                        }
                                    }  
                                }
                                 
                            }
                        }
                        if($v['xian31']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='3现'){
                                    //会员id判断对比
                                    if(in_array($v1['uid'],$uidArr)){
                                        $moneys=$v1['moneys']*($v['percent']/100);
                                        if($moneys>$v['xian31']){
                                            $xian31Money+=$v['xian31'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian31Loss+=$loss*$v['xian31'];//拦货金额佣金
                                             if($v1['status']==1){
                                                $xian31Moneys+=$v['xian31']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian31Yingkuis=$xian31Moneys+$xian31Loss-$xian31Money;
                                                $xian31Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                            }
                                        }else{
                                            $xian31Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian31Loss+=$loss*$moneys;//拦货金额佣金 
                                             if($v1['status']==1){
                                                $xian31Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian31Yingkuis=$xian31Moneys+$xian31Loss-$xian31Money;
                                                $xian31Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
                                            }
                                        }
                                    }  
                                }
                                 
                            }
                        }
                        if($v['xian41']>=1){
                            foreach($datas as $k1=>$v1){
                                if($v1['mingxi_1']=='4现'){
                                    //会员id判断对比
                                    if(in_array($v1['uid'],$uidArr)){
                                        $moneys=$v1['moneys']*($v['percent']/100);
                                        if($moneys>$v['xian41']){
                                            $xian41Money+=$v['xian41'];//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian41Loss+=$loss*$v['xian41'];//拦货金额佣金
                                             if($v1['status']==1){
                                                $xian41Moneys+=$v['xian41']*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian41Yingkuis=$xian41Moneys+$xian41Loss-$xian41Money;
                                                $xian41Yingkui=$xian41Money-$xian41Loss-$xian41Moneys;
                                            }
                                        }else{
                                            $xian41Money+=$moneys;//拦货金额
                                            $loss=$v1['win']/$v1['moneys'];//金额平均佣金
                                            $xian41Loss+=$loss*$moneys;//拦货金额佣金
                                             if($v1['status']==1){
                                                $xian41Moneys+=$moneys*$v1['odds'];//我拦货的中奖金额
                                                //$arr['moneys']=intval($moneys); 
                                            }  
                                            //中奖金额+回水-下注 下注-中奖金额-回水
                                            if($qishus['m_status']==3){
                                                $xian41Yingkuis=$xian41Moneys+$xian41Loss-$xian41Money;
                                                $xian41Yingkui=$xian41Money-$xian41Loss-$xian41Moneys;
                                            } 
                                        }
                                    }  
                                }
                                 
                            }
                        }//内部判断
                    $umoneys=$ding21Money+$ding31Money+$ding41Money+$xian21Money+$xian31Money+$xian41Money;    
                    $uloss=$ding21Loss+$ding31Loss+$ding41Loss+$xian21Loss+$xian31Loss+$xian41Loss;    
                    $yingkuis=$ding21Yingkuis+$ding31Yingkuis+$ding41Yingkuis+$xian21Yingkuis+$xian31Yingkuis+$xian41Yingkuis;    
                    $yingkui=$ding21Yingkui+$ding31Yingkui+$ding41Yingkui+$xian21Yingkui+$xian31Yingkui+$xian41Yingkui;    
                    

                    }else{//判断拦货分成

                    }
                    
                }//循环
            }//判断配置

        }//判断是否有代理和会员

        return $arr=array($umoneys,$uloss,$yingkuis,$yingkui);//代理拦货金额和佣金
        
    }


    //等级报表数汇总
    public function ureports1(){
        $date = date('Y-m-d H:i:s'); //当前时间
        $firstday = date('Y-m-01', strtotime($date));
        $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));

        $stime=strtotime($firstday);
        $etime=strtotime($lastday);
        //搜索
        $qishu1=I('get.qishu1');
        $qishu2=I('get.qishu2');
       
        //本月所有的期数  1开启 2.关闭 3.开奖
        $opentime=M('opentime');
        // if(!empty($qishu1) && !empty($qishu2)){
        //     $where['qishu']=array(array('egt',($qishu1)),array('elt',($qishu2)),'and');
        // }else{
        //     $where['m_time']=array(array('egt',($stime)),array('elt',($etime)),'and');
        // }
        // $where2['m_time']=array(array('egt',($stime)),array('elt',($etime)),'and');
        // $qishu3=$opentime->field('qishu')->where($where2)->order('id desc')->select();
        // if(!empty($qishus)){
        //     foreach($qishus as $k3=>$v3){
        //         $qishu3[]=$v3['qishu'];
        //     } 
        // }
        //dump($qishu3);
        //$dataqishu=$opentime->field('qishu,m_time,m_status')->where($where)->select();
        $dataqishu=qishus();//得到期数
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
            if(!empty($dataqishu)){
                //得到所有期数
                foreach($dataqishu as $k=>$v){
                    $qishu.=$v['qishu'].',';
                    $datas1[$v['qishu']]=$v['m_status'].','.$v['m_time'];//分组
                } 

                $where1['qishu']=array('in',rtrim($qishu,','));
            }else{
                $where1['qishu']='-1';
            }    
        }
       

         set_time_limit(0);
        //得到所有权限下会有和下注数据汇总
        $utype=session('autype');
        $bets=M('bet');
        $udata=users();
        //dump($udata);
        $where1['js']='0';
        if($udata[0]){
            $where1['uid']=array('in',$udata[0]);
        }else{
            $where1['uid']='-1';
        }
        

        $datas=$bets->field('uid,win,qishu,money as moneys,odds,status,mingxi_1,topmoney,topwin')->where($where1)->select();
        //dump($datas);
        if($utype=='agency'){
            $where2['au_id']=session('auid');
            $umoney=M('backwater')->field('sum(sums) as sums1,qishu')->where($where2)->group('qishu')->select();
        }else{
            $where2['au_ids']=session('auid');
            $umoney=M('backwater')->field('sum(sums) as sums1,qishu')->where($where2)->group('qishu')->select();
            $where3['au_id']=session('auid');
            $umoney1=M('backwater')->field('sum(sums) as sums1,qishu')->where($where3)->group('qishu')->select();
        }
        
       // dump($umoney1);
       // if($utype=='admin'){//得到股东数据汇总
            
        //}elseif($utype=='partner'){//得到总代数据汇总   

       // }elseif($utype=='agencys'){//得到代理数据汇总

       // }elseif($utype=='agency'){//得到代理数据汇总

        //}
        //dump($where1);
        //dump($datas);
        $utypes=session('autype');
        $auid=session('auid');
        //得到所有下级代理
        $dailis=user5($utypes,$auid);
        //dump($utype);exit;
        if(!empty($datas1) || !empty($datas)){
              foreach($datas1 as $k1=>$v1){ 
                   $t1=explode(',',$v1);
                    foreach($datas as $k2=>$v2){ 
                        if($k1==$v2['qishu']){
                            if($t1[0]==3){
                                $data3['status']=3; 
                            }else{
                                $data3['status']=1;
                            }
                            if($utype=='agency'){
                                $umoney1+=$v2['topmoney'];
                                $data3['umoney']=intval($umoney1); 
                                     
                                $getDatas='';
                                $money+=$v2['moneys'];
                                $data3['money']=intval($money); 
                                $data3['sum']+=1;
                                $data3['md']=date('m-d',($t1[1]));
                                $data3['qishu']=$v2['qishu'];
                                $win+=$v2['win'];
                                $win1+=$v2['topwin'];
                                $data3['win1']=intval($win1);
                                $data3['win']=intval($win);
                                if($v2['status']==1){
                                  //$data3['moneys']+=$v2['moneys']*$v2['odds'];  
                                  $moneys+=($v2['moneys'])*$v2['odds'];  
                                  $data3['moneys']=intval($moneys); 
                                  $moneys1+=$v2['topmoney']*$v2['odds']; 
                                }
                                if($t1[0]==3){
                                //盈亏
                                $data3['yingkuis']=$data3['moneys']+$data3['win']-$data3['money'];
                                $data3['yingkui']=$data3['money']-$data3['moneys']-$data3['win'];
                                $data3['uyingkuis']=$moneys1+$data3['win1']-$data3['umoney'];
                                $data3['uyingkui']=$data3['umoney']-$moneys1-$data3['win1'];
                                }
								
                            }else{
                                 $umoney11+=$v2['topmoney'];
                                $data3['umoney']=intval($umoney11); 

                                //$data3['umoney']+=$v2['topmoney'];
                                     
                               $getDatas='';
                                $money+=$v2['moneys']-$v2['topmoney'];
                                $data3['money']=intval($money); 
                                $data3['sum']+=1;
                                $data3['md']=date('m-d',($t1[1]));
                                $data3['qishu']=$v2['qishu'];
                                $win+=$v2['win']-$v2['topwin'];
                                //$win1+=$v2['topwin'];
								 $win1+=$v2['topwin'];
                                $data3['win1']=intval($win1);
                                $data3['win']=intval($win);
                                 //代理回水
                                $huishui+=$v2['top1'];
                                $huishui2+=$v2['top2'];
                                $data3['huishui']=$huishui;
                                $data3['huishui2']=$huishui2; 
                                if($v2['status']==1){
                                  //$data3['moneys']+=$v2['moneys']*$v2['odds'];  
                                  $moneys+=($v2['moneys']-$v2['topmoney'])*$v2['odds'];  
                                  $data3['moneys']=intval($moneys); 
                                  $moneys1+=$v2['topmoney']*$v2['odds']; 
                                }
                                if($t1[0]==3){
                                //盈亏
                                $data3['yingkuis']=$data3['moneys']+$data3['win']-$data3['money'];
                                $data3['yingkui']=$data3['money']-$data3['moneys']-$data3['win'];
                                $data3['uyingkuis']=$moneys1+$data3['win1']-$data3['umoney'];
                                $data3['uyingkui']=$data3['umoney']-$moneys1-$data3['win1'];

                               }
                          }  
                        }  
                        //$t1=''; 
                    }
					

                    if($data3){
                      // if($v1==3){
                        //每期汇总 
                        $data2['sum1']+=$data3['sum'];//下注笔数
                        $data2['money1']+=$data3['money'];//金额
                         $data2['umoney']+=$data3['umoney'];//中奖汇总
                        if($t1[0]==3){
                        
                        // $data2['win1']+=$data3['win'];//回水
                       
                        // $data2['sums1']+=1;//
                        //盈亏
                        $data2['yingkui1']+=$data3['yingkui'];
                        $data2['yingkuis']+=$data3['yingkuis'];
                        $data2['uyingkui']+=$data3['uyingkui'];
                        $data2['uyingkuis']+=$data3['uyingkuis'];
                        }
    //                     ["umoney"] => int(20)
    // ["uyingkuis"] => float(460)
    // ["uyingkui"] => float(-460)
                      // }else{
                      //    //每期汇总 
                      //   $data2['sum1']+=0;//下注笔数
                      //   $data2['money1']+=0;//金额
                      //   $data2['win1']+=0;//回水
                      //   $data2['moneys1']+=0;//中奖汇总
                      //   $data2['sums1']+=0;//
                      //   //盈亏
                      //   $data2['yingkui1']+=0;
                      // }
                      
                      $data2['data'][]=$data3;  

                      $data3=''; 
                      $moneys='';
                      $moneys1='';
                      $money='';
                      $money1='';
                      $win='';
                      $win1='';
                      $t1='';
					  $umoney1='';

                    }
                    unset($data3);
                    $moneys='';
                      $moneys1='';
                      $money='';
                      $money1='';
                      $win='';
                      $win1='';
                      $t1='';
					   $umoney1='';
                  
                } 

                $data2['code']=200;
                if(!empty($data2['data']) && !empty($umoney)){
                    foreach($umoney as $k3=>$v3){
                        foreach($data2['data'] as $k4=>$v4){
                            if($v4['qishu']==$v3['qishu']){
                                $v4['huishui']=$v3['sums1'];
                                $data2['data'][$k4]=$v4;
                            }
                        }
                    }
                }
                if(!empty($data2['data']) && !empty($umoney1)){
                    foreach($umoney1 as $k5=>$v5){
                        foreach($data2['data'] as $k6=>$v6){
                            if($v6['qishu']==$v5['qishu']){
                                $v6['huishui1']=$v5['sums1'];
                                $data2['data'][$k6]=$v6;
                            }
                        }
                    }
                }
        }else{
             $data2['code']=400;
        }



        //dump($data2['data']);

        $this->assign('sum',$data2['sum1']);
        $this->assign('money',$data2['money1']);
        $this->assign('yingkui',$data2['yingkui1']);
        $this->assign('yingkuis',$data2['yingkuis']);
         $this->assign('umoney',$data2['umoney']);
        $this->assign('uyingkui',$data2['uyingkui']);
        $this->assign('uyingkuis',$data2['uyingkuis']);
        $this->assign('data',$data2['data']);
        $this->assign('qishu3',array_reverse($dataqishu));//所有期数
        $this->assign('qishu4',$dataqishu);//所有期数
        $this->assign('qishu1',$qishu1);//所有期数
        $this->assign('qishu2',$qishu2);//所有期数
        $this->display();
    }
    //处理代理数据
    private function getDatas2($auid,$autype,$datas,$qishus){
        //按照类型得到下级代理和会员
         $uidArr=user4($auid);
         if(!empty($auid) && !empty($user)){
            if(in_array($datas['uid'],$uidArr)){

                $moneys=$datas['moneys']*($user['percent']/100);
                if($moneys>$user['ding21']){//
                    $ding21Money+=$user['ding21'];//拦货金额
                    $loss=$datas['win']/$datas['moneys'];//金额平均佣金
                    $ding21Loss+=$loss*$user['ding21'];//拦货金额佣金
                    if($datas['status']==1){
                        $ding21Moneys+=$user['ding21']*$datas['odds'];//我拦货的中奖金额
                        //$arr['moneys']=intval($moneys); 
                    }  
                    //中奖金额+回水-下注 下注-中奖金额-回水
                    if($qishus==3){
                        $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
                        $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
                    }
                }else{
                    $ding21Money+=$moneys;//拦货金额
                    $loss=$datas['win']/$datas['moneys'];//金额平均佣金
                    $ding21Loss+=$loss*$moneys;//拦货金额佣金 
                    if($datas['status']==1){
                        $ding21Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
                        //$arr['moneys']=intval($moneys); 
                    }  
                    //中奖金额+回水-下注 下注-中奖金额-回水
                    if($qishus==3){
                        $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
                        $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
                    }
                }
            } 


         }


         return $arr=array($umoneys,$yingkuis,$yingkui);//代理拦货金额和佣金
        // if(!empty($auid)){
        //     //判断代理是否配置拦货
        //     $where['au_id']=$auid;
        //     $user=M('ubet')->where($where)->find(); 
                
        //     if(!empty($user)){
        //        // foreach($user as $k=>$v){
        //             $uidArr=user4($auid);
                    
                    
        //             //拦货类型是否配置  在进行拦货换算
        //             if($user['percent']>=1 && $uidArr){//判断分成比是否配置了
        //                 if($user['ding21']>=1){

        //                     //foreach($datas as $k1=>$v1){
        //                         //会员id判断对比
        //                         if($datas['mingxi_1']=='2定'){

        //                             if(in_array($datas['uid'],$uidArr)){

        //                                 $moneys=$datas['moneys']*($user['percent']/100);
        //                                 if($moneys>$user['ding21']){//
        //                                     $ding21Money+=$user['ding21'];//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $ding21Loss+=$loss*$user['ding21'];//拦货金额佣金
        //                                     if($datas['status']==1){
        //                                         $ding21Moneys+=$user['ding21']*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
        //                                         $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
        //                                     }
        //                                 }else{
        //                                     $ding21Money+=$moneys;//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $ding21Loss+=$loss*$moneys;//拦货金额佣金 
        //                                     if($datas['status']==1){
        //                                         $ding21Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $ding21Yingkuis=$ding21Moneys+$ding21Loss-$ding21Money;
        //                                         $ding21Yingkui=$ding21Money-$ding21Loss-$ding21Moneys;
        //                                     }
        //                                 }
        //                             } 
        //                         }
                                  
        //                     //} 
        //                 }
        //                 if($user['ding31']>=1){
                            
        //                      //foreach($datas as $k1=>$v1){
        //                         if($datas['mingxi_1']=='3定'){
        //                             //会员id判断对比
        //                             if(in_array($datas['uid'],$uidArr)){
        //                                 $moneys=$datas['moneys']*($user['percent']/100);
        //                                 if($moneys>$user['ding31']){
        //                                     $ding31Money+=$user['ding31'];//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $ding31Loss+=$loss*$user['ding31'];//拦货金额佣金
        //                                     if($datas['status']==1){
        //                                         $ding31Moneys+=$user['ding31']*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $ding31Yingkuis=$ding31Moneys+$ding31Loss-$ding31Money;
        //                                         $ding31Yingkui=$ding31Money-$ding31Loss-$ding31Moneys;
        //                                     }
        //                                 }else{
        //                                     $ding31Money+=$moneys;//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $ding31Loss+=$loss*$moneys;//拦货金额佣金 
        //                                     if($datas['status']==1){
        //                                         $ding31Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $ding31Yingkuis=$ding31Moneys+$ding31Loss-$ding31Money;
        //                                         $ding31Yingkui=$ding31Money-$ding31Loss-$ding31Moneys;
        //                                     }
        //                                 }
        //                             }
        //                         }
                                   
        //                     //} 
        //                 }
        //                 if($user['ding41']>=1){
        //                     //foreach($datas as $k1=>$v1){
        //                         if($datas['mingxi_1']=='4定'){
        //                             //会员id判断对比
        //                             if(in_array($datas['uid'],$uidArr)){
        //                                 $moneys=$datas['moneys']*($user['percent']/100);
        //                                 if($moneys>$user['ding41']){
        //                                     $ding41Money+=$user['ding41'];//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $ding41Loss+=$loss*$user['ding41'];//拦货金额佣金
        //                                     if($datas['status']==1){
        //                                         $ding41Moneys+=$user['ding41']*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $ding41Yingkuis=$ding41Moneys+$ding41Loss-$ding41Money;
        //                                         $ding41Yingkui=$ding41Money-$ding41Loss-$ding41Moneys;
        //                                     }
        //                                 }else{
        //                                     $ding41Money+=$moneys;//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $ding41Loss+=$loss*$moneys;//拦货金额佣金 
        //                                     if($datas['status']==1){
        //                                         $ding41Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $ding41Yingkuis=$ding41Moneys+$ding41Loss-$ding41Money;
        //                                         $ding41Yingkui=$ding41Money-$ding41Loss-$ding41Moneys;
        //                                     }
        //                                 }
        //                             }  
        //                         }
                                 
        //                     //} 
        //                 }
        //                 if($user['xian21']>=1){
        //                    // foreach($datas as $k1=>$v1){
        //                         if($datas['mingxi_1']=='2现'){
        //                             //会员id判断对比
        //                             if(in_array($datas['uid'],$uidArr)){
        //                                 $moneys=$datas['moneys']*($user['percent']/100);
        //                                 if($moneys>$user['xian21']){
        //                                     $xian21Money+=$user['xian21'];//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $xian21Loss+=$loss*$user['xian21'];//拦货金额佣金
        //                                     if($datas['status']==1){
        //                                         $xian21Moneys+=$user['xian21']*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $xian21Yingkuis=$xian21Moneys+$xian21Loss-$xian21Money;
        //                                         $xian21Yingkui=$xian21Money-$xian21Loss-$xian21Moneys;
        //                                     }
        //                                 }else{
        //                                     $xian21Money+=$moneys;//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $xian21Loss+=$loss*$moneys;//拦货金额佣金 
        //                                      if($datas['status']==1){
        //                                         $xian21Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $xian21Yingkuis=$xian21Moneys+$xian21Loss-$xian21Money;
        //                                         $xian21Yingkui=$xian21Money-$xian21Loss-$xian21Moneys;
        //                                     }
        //                                 }
        //                             }  
        //                         }
                                 
        //                     //}
        //                 }
        //                 if($user['xian31']>=1){
        //                     //foreach($datas as $k1=>$v1){
        //                         if($datas['mingxi_1']=='3现'){
        //                             //会员id判断对比
        //                             if(in_array($datas['uid'],$uidArr)){
        //                                 $moneys=$datas['moneys']*($user['percent']/100);
        //                                 if($moneys>$user['xian31']){
        //                                     $xian31Money+=$user['xian31'];//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $xian31Loss+=$loss*$user['xian31'];//拦货金额佣金
        //                                      if($datas['status']==1){
        //                                         $xian31Moneys+=$user['xian31']*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $xian31Yingkuis=$xian31Moneys+$xian31Loss-$xian31Money;
        //                                         $xian31Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
        //                                     }
        //                                 }else{
        //                                     $xian31Money+=$moneys;//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $xian31Loss+=$loss*$moneys;//拦货金额佣金 
        //                                      if($datas['status']==1){
        //                                         $xian31Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $xian31Yingkuis=$xian31Moneys+$xian31Loss-$xian31Money;
        //                                         $xian31Yingkui=$xian31Money-$xian31Loss-$xian31Moneys;
        //                                     }
        //                                 }
        //                             }  
        //                         }
                                 
        //                     //}
        //                 }
        //                 if($user['xian41']>=1){
        //                     //foreach($datas as $k1=>$v1){
        //                         if($datas['mingxi_1']=='4现'){
        //                             //会员id判断对比
        //                             if(in_array($datas['uid'],$uidArr)){
        //                                 $moneys=$datas['moneys']*($user['percent']/100);
        //                                 if($moneys>$user['xian41']){
        //                                     $xian41Money+=$user['xian41'];//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $xian41Loss+=$loss*$user['xian41'];//拦货金额佣金
        //                                      if($datas['status']==1){
        //                                         $xian41Moneys+=$user['xian41']*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $xian41Yingkuis=$xian41Moneys+$xian41Loss-$xian41Money;
        //                                         $xian41Yingkui=$xian41Money-$xian41Loss-$xian41Moneys;
        //                                     }
        //                                 }else{
        //                                     $xian41Money+=$moneys;//拦货金额
        //                                     $loss=$datas['win']/$datas['moneys'];//金额平均佣金
        //                                     $xian41Loss+=$loss*$moneys;//拦货金额佣金
        //                                      if($datas['status']==1){
        //                                         $xian41Moneys+=$moneys*$datas['odds'];//我拦货的中奖金额
        //                                         //$arr['moneys']=intval($moneys); 
        //                                     }  
        //                                     //中奖金额+回水-下注 下注-中奖金额-回水
        //                                     if($qishus==3){
        //                                         $xian41Yingkuis=$xian41Moneys+$xian41Loss-$xian41Money;
        //                                         $xian41Yingkui=$xian41Money-$xian41Loss-$xian41Moneys;
        //                                     } 
        //                                 }
        //                             }  
        //                         }
                                 
        //                     //}
        //                 }//内部判断
        //             $umoneys=$ding21Money+$ding31Money+$ding41Money+$xian21Money+$xian31Money+$xian41Money;    
        //             //$uloss=$ding21Loss+$ding31Loss+$ding41Loss+$xian21Loss+$xian31Loss+$xian41Loss;    
        //             $yingkuis=$ding21Yingkuis+$ding31Yingkuis+$ding41Yingkuis+$xian21Yingkuis+$xian31Yingkuis+$xian41Yingkuis;    
        //             $yingkui=$ding21Yingkui+$ding31Yingkui+$ding41Yingkui+$xian21Yingkui+$xian31Yingkui+$xian41Yingkui;    
                    

        //             }else{//判断拦货分成

        //             }
                    
        //        // }//循环
        //     }//判断配置

        // }//判断是否有代理和会员

        // return $arr=array($umoneys,$yingkuis,$yingkui);//代理拦货金额和佣金
        
    }


public function getData($uid,$bets,$stime,$etime,$qishu){
   if(!empty($uid)){
    $where['uid']=array('in',$uid);
    $where['qishu']=array('in',$qishu);
    $where['addtime']=array(array('egt',$stime),array('elt',$etime+86400),'and');
    $where['js']='0';
    $data=$bets->field('win,odds,money,status')->where($where)->select(); 
    if(!empty($data)){
      $arr['sum']=count($data);
      foreach($data as $k=>$v){
        $arr['win']+=$v['win'];
        $arr['money']+=$v['money'];
        if($v['status']==1){
            $arr['zj']+=$v['money']*$v['odds'];
        }
      }
      $arr['kuiying']=$arr['zj']+$arr['win']-$arr['money'];
    }   

   }else{
    $arr['sum']=0;
    $arr['win']=0;
    $arr['money']=0;
    $arr['zj']=0;
    $arr['kuiying']=0;
   }

   return $arr;
}

//回水设置管理页面
public function backwater(){
    $uid=session('auid');
    $utype=session('autype');
    $where['au_ids']=$uid;
    $data=M('backwater')->where($where)->join('LEFT JOIN k_admin ON k_admin.au_id = k_backwater.au_id')->select();

    $this->assign('data',$data); 
    $this->display();
}
//添加回水
public function addBackwater(){
    $data=users();
    $qishus=qishus();
    $where['id']=I('get.mid');
    $data1=M('backwater')->where($where)->find();
    //dump($qishus);
    $this->assign('data1',$data1); 
    $this->assign('data',$data[1]); 
    $this->assign('qishus',$qishus); 
    $this->display();
}
//
public function saveBackwater(){
    $mid=I('post.mid');
    $auid=I('post.auid');
    $qishu=I('post.qishu');
    $sums=I('post.sums');
    $qishus=explode(',',$qishu);
    $where['qid']=$qishus[0];
    $where['qishu']=$qishus[1];
    $where['au_id']=$auid;
    $backwater=M('backwater');
    $dd=$backwater->where($where)->find();
    $data['qid']=$qishus[0];
    $data['qishu']=$qishus[1];
    $data['sums']=$sums;
    $data['au_id']=$auid;
    $data['time']=time();
    $data['au_ids']=session('auid');
    if(empty($dd) || $dd['id']==$mid){
        if(empty($mid)){
          $dd1=$backwater->add($data);    
        }else{
          $where1['id']=$mid;
          $dd1=$backwater->where($where1)->save($data); 
        }
        if(empty($dd1)){
            $arr['code']=400;
            $arr['titles']='失败';
        }else{
            $arr['code']=200;
            $arr['titles']='成功';
        }
    }else{
        $arr['code']=400;
        $arr['titles']='用户回水存在！';
    }
    
    $this->ajaxReturn($arr);
}

}