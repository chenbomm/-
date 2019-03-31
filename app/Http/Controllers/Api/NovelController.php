<?php

namespace App\Http\Controllers\Api;

use App\Model\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovelController extends Controller
{
    //获取书单接口
    public function bookList(Request $request){
        $novel=new Novel();
        $list=$novel->getList()->toArray();
        $return=[
            'code'=>2000,
            'msg'=>'获取表单成功',
            'data'=>[
                'page'=>$list['current_page'],//当前页
                'total_page'=>$list['last_page'],//总页数
                'list'=>$list['data']
            ]
        ];
        return json_encode($return);
    }
}
