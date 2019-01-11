<?php
namespace Admin\Controller;
use Think\Controller;
class ThreeController extends Controller {
    public function connectionRedis(){
        $redis = new \Redis();
        $redis -> connect("127.0.0.1",6379);
        $redis -> auth("menglongli");
        $redis->set("title","long");
        $get = $redis->get("title");
        dump($get);
    }
    /**
     * 最近三小时数据
     */
      public function hours(){
        $users_charge=M("users_charge");                //今日线上充值金额
        $arr = [];
        $h = date("H");   //当前小时
        $d = date("d");   //当前天
        for($i=0,$j=1;$i<=2,$j<=3;$i++,$j++){
            $da = date("d");   //当前天
            if($h==00) {
                $h=24;
                $da = $d-1;
            }
            $ha = $h-$i;
            if($ha<0){
                $ha = 24 + $ha;
                $da = $d-1;
            }
            $hh = $h-$j;
            if($hh<0){
                $hh = 24 + $hh;
                $da = $d-1;
            }
            if($ha==24) $ha = "00";
            if($hh==24) $hh = "00";
            $hour_start = date("Y-m-$da $ha:00:00");
            $hour_ent = date("Y-m-$da $hh:00:00");
            $hourtime_start = strtotime($hour_start);       //整点时间
            $hourtime_ent = strtotime($hour_ent);           //整点时间
            $res = $users_charge
                ->field("money,addtime")
                ->where("status='1' and addtime<'{$hourtime_start}' and addtime>'{$hourtime_ent}'")
                ->select();
            $money = [];
            $coin = [];
            foreach ($res as $k =>$v){
                $v['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
                $money[] = $v;
            }
            $arr[$i]['hour_start'] = $hour_start;
            $arr[$i]['hour_ent'] = $hour_ent;
            $arr[$i]['money'] = $money;
            $arr[$i]['coin'] = $coin;
        }
        $this->assign("arr",$arr);
        $this->display();
    }
}