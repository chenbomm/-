<?php

namespace App\Http\Controllers\Lottery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{
    //抽奖页面展示
    public function index(){
        return view('/lottery/index');
    }
    //执行抽奖
    public function doLottery(Request $request){
        $phone=$request->input('phone');
        $start=date('Y-m-d 10:00:00',time());
        $end=date('Y-m-d 18:00:00',time());
        $return=[
            'code'=>2000,
            'msg'=>'成功'
        ];
        if (empty($phone)){
            $return=[
                'code'=>4000,
                'msg'=>'手机号不能为空'
            ];
            return json_encode($return);
        }
        //查看用户是否存在
        $user=DB::table('study_lottery_user')->where('phone',$phone)->first();
        if (empty($user)){
            $return=[
                'code'=>4001,
                'msg'=>'用户不存在'
            ];
            return json_encode($return);
        }

        //检测抽奖时间是否过期
        if (time() > strtotime($end) || time() < strtotime($start)){
            $return=[
                'code'=>4002,
                'msg'=>'现在不是抽奖时间，请选择正确的时间抽奖'
            ];
            return json_encode($return);
        }
        //每个用户每天只能抽三次
        $res=DB::table('study_lottery_record')->where('user_id',$user->id)->where('created_id',date('Y-m-d'))->count();
        if ($res >= 3){
            $return=[
                'code'=>4004,
                'msg'=>'今天已经抽奖三次，请明天再来'
            ];
            return json_encode($return);
        }
        //获取抽奖
        $lotterys=DB::table('lottery')->get()->toArray();

        $array=[];
        $precent=[];
        foreach ($lotterys as $k=>$v){

            $array[$v->id]=['lottery_name'=>$v->lottery_name];

            $precent[$v->id]=$v->precent;

//            dd($precent);
        }
        $sum=array_sum($precent);
        $result='';
//        dd($sum);
        foreach ($precent as $m=>$n){

                $sums=mt_rand(1,$sum);
           if ($n>=$sums){
               $result=$m;
               break;
           }else{
                $sum=$sum-$n;
           }
        }
        //添加用户抽奖记录
        $data=[
            'user_id'=>$user->id,
            'lottery_id'=>$result,
            'created_id'=>date('Y-m-d')
        ];
        DB::table('study_lottery_record')->insert($data);
        $return['data']=$array[$result]['lottery_name'];
//        dd($return);
        return json_encode($return);

    }
}
