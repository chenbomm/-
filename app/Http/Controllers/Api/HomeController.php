<?php

namespace App\Http\Controllers\Api;

use App\Model\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //小说首页banner图
    public function banners(Request $request){
        $num=$request->input('num',3);
        $novel=new Novel();
        $list=$novel->getBanner($num);
        $return=[
            'code'=>2000,
            'msg'=>'获取banner图成功',
            'data'=>$list
        ];
        return json_encode($return);
    }
    //最新小说
    public function newsList(Request $request){
        $num=$request->input('num',3);
        $novel=new Novel();
        $news=$novel->getNews($num);
        $return=[
            'code'=>2000,
            'msg'=>'获取列表成功',
            'data'=>$news
        ];
        return json_encode($return);
    }
    //点击量最高小说
    public function clicksList(Request $request){
    $num=$request->input('num',3);
    $novel=new Novel();
    $clicks=$novel->getClicks($num);
    $return=[
        'code'=>2000,
        'msg'=>'获取点击最高成功',
        'data'=>$clicks
    ];
    return json_encode($return);
    }
}
