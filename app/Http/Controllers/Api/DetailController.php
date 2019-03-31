<?php

namespace App\Http\Controllers\Api;

use App\Model\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    //获取小说详情接口
    public function detail($id){
        $novel=new Novel();
        $list=$novel->getNovelDetail($id)->toArray();
        $return=[
            'code'=>2000,
            'msg'=>'获取成功',
            'data'=>$list
        ];
        return json_encode($return);
    }
}
