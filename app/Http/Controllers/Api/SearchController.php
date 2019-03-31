<?php

namespace App\Http\Controllers\Api;

use App\Model\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //通过关键字来搜索内容接口
    public function getSearchList(Request $request){
        $name=$request->input('name');
        $search=new Novel();
        $list=$search->getNovelByName($name);
        $toalNum=count($list);
        $return=[
            'code'=>2000,
            'msg'=>'成功',
            'data'=>[
                'list'=>$list,
                'total_num'=>$toalNum
            ]
        ];
        return json_encode($return);
    }
}
