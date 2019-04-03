<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdPositionController extends Controller
{
    protected $position=null;
    //构造函数
    public function __construct()
    {
        $this->position=new AdPosition();
    }

    //广告位列表
    public function list(){
        $assign['list']=$this->position->list();
        return view('admin.ad.position.list',$assign);
    }
    //添加页面
    public function add(){
        return view('admin.ad.position.add');
    }
    //执行添加
    public function doAdd(Request $request){
        $params=$request->all();

        $params=$this->delToken($params);

        $res=$this->storeData($this->position,$params);

        if (!$res){
            return redirect()->back()->with('msg','广告位添加失败');
        }
        return redirect('/admin/ad/position/list');
    }
    //执行删除的操作
    public function del($id){
        $this->position->del($id);
        return redirect('/admin/ad/position/list');
    }
    //执行编辑页面
    public function edit($id){
        $assign['info']=$this->position->edit($id);
        return view('admin.ad.position.edit',$assign);
    }
    //执行编辑
    public function doEdit(Request $request){
        $params=$request->all();
        $params=$this->delToken($params);
        $position=AdPosition::find($params['id']);
        $res=$this->storeData($position,$params);
        if (!$res){
            return redirect()->back()->with('msg','广告位编辑失败');
        }
        return redirect('/admin/ad/position/list');
    }
}
