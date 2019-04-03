<?php

namespace App\Http\Controllers\Admin;

use App\Model\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    //商品品牌列表页面
    public function list(){
        return view('admin.brand.list');
    }
    //获取商品数据
    public function getListData(Request $request){
        $list=Brand::getList();
        $return=[
            'rode'=>2000,
            'msg'=>'成功',
            'data'=>$list
        ];
        return json_encode($return);
    }
    //商品添加页面
    public function add(){
        return view('admin.brand.add');
    }
    //执行商品品牌添加
    public function doAdd(Request $request){
        $params=$request->all();
        if (!isset($params['brand_name'])||empty($params['brand_name'])){
            return redirect()->back()->with('msg','商品品牌不能为空');
        }
        unset($params['_token']);

        $res=Brand::creates($params);
        if(!$res){
            return redirect()->back()->with('msg','商品添加失败');
        }
        return redirect('/admin/brand/list');
    }
    //执行删除的操作
    public function del($id){
        $res=Brand::del($id);
        $return=[
            'code'=>2000,
            'msg'=>'成功'
        ];
        if (!$res){
            $return=[
                'code'=>4000,
                'msg'=>'删除失败'
            ];
        }
        return json_encode($return);
    }
    //获取修改页面
    public function edit($id){
        $assign['info']=Brand::doEdit($id);
        return view('admin.brand.edit',$assign);
    }
    //执行修改页面
    public function doEdit(Request $request){
        $params=$request->all();
        if (!isset($params['brand_name'])||empty($params['brand_name'])){
            return redirect()->back()->with('msg','商品品牌不能为空');
        }
        unset($params['_token']);

        $id=$params['id'];

        $res=Brand::doUpdate($id,$params);

        if(!$res){
            return redirect()->back()->with('msg','商品修改失败');
        }
        return redirect('/admin/brand/list');
    }
    //修改属性的接口
    public function changeAttr(Request $request){
        $params=$request->all();
        $return=[
            'code'=>2000,
            'msg'=>'成功'
        ];
        //组装要修改的数据值
        $data=[
            $params['key']=>$params['value']
        ];
        $res=Brand::doUpdate($params['id'],$data);
        if (!$res){
            $return=[
                'code'=>4000,
                'msg'=>'属性修改失败'
            ];
        }
        return json_encode($return);
    }
}
