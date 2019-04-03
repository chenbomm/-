<?php

namespace App\Http\Controllers\Admin;

use App\Model\Categorys;
use App\Tools\ToolsAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorysController extends Controller
{
    //商品分类页面
    public function list($fid=0){
        return view('admin.categorys.list');
    }
    //获得商品分类列表接口数据
    public function getListData($fid=0){
        $return=[
            'code'=>2000,
            'msg'=>'成功'
        ];
        $list=Categorys::getCategorysByFid($fid);
        $return['data']=$list;
        return json_encode($return);
    }
    //商品分类添加页面
    public function add(){
        $list=Categorys::getCategorysList();

        $assign['list']=ToolsAdmin::buildTreeString($list,0,0,'f_id');

       return view('admin.categorys.add',$assign);
    }
    //执行商品分类添加的操作
    public function doAdd(Request $request){
        $params=$request->all();
        //校验
        if (!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');
        }
        unset($params['_token']);
        $res=Categorys::doAdd($params);
        if (!$res){
            return redirect()->back()->with('msg','分类添加失败');
        }
        return redirect('/admin/categorys/list');
    }
    //执行删除的操作
    public function del($id){
        $return=[
            'code'=>2000,
            'msg'=>'成功'
        ];
        $res=Categorys::del($id);
        if (!$res){
            $return=[
                'code'=>4000,
                'msg'=>'删除失败'
            ];
        }
        return json_encode($return);
    }
    //商品编辑页面
    public function edit($id){
        $assign['info']=Categorys::getCateInfo($id);
        //上级分类的树形结构
        $list=Categorys::getCategorysList();
        $assign['list']=ToolsAdmin::buildTreeString($list,0,0,'f_id');
        return view('admin.categorys.edit',$assign);
    }
    //执行编辑页面
    public function doEdit(Request $request){
        $params=$request->all();
        //校验
        if (!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');
        }
        unset($params['_token']);
        $id=$params['id'];
        $res=Categorys::doEdit($params,$id);
        if (!$res){
            return redirect()->back()->with('msg','分类添加失败');
        }
        return redirect('/admin/categorys/list');
    }
}
