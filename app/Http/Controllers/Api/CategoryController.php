<?php

namespace App\Http\Controllers\Api;

use App\Model\Category;
use App\Model\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //获取分类列表接口
    public function getCategory(){
        $category=new Category();
        $cList=$category->getCategory();
        $return=[
            'code'=>2000,
            'msg'=>'获取分类成功',
            'data'=>$cList
        ];
        return json_encode($return);
    }
    //通过分类查询小说列表接口
    public function getBook(Request $request){
        $cId=$request->input('c_id',1);
        $novel=new Novel();
        $list=$novel->getNovelByCid($cId);
        $return=[
            'code'=>2000,
            'msg'=>'获取分类列表成功',
            'data'=>$list
        ];
        return json_encode($return);
    }
}
