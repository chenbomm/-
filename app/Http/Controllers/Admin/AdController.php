<?php

namespace App\Http\Controllers\Admin;

use App\Model\Ad;
use App\Model\AdPosition;
use App\Tools\ToolsAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    protected $position=null;
    protected $ad=null;
    //构造函数
    public function __construct()
    {
    $this->position=new AdPosition();
    $this->ad=new Ad();
    }

    //列表
    public function list(){
        $assign['info']=$this->ad->getAdList();
        return view('admin.ad.list',$assign);
    }
    //添加页面
    public function add(){
        $assign['list']=$this->position->list();
        return view('admin.ad.add',$assign);
    }
    //执行添加的操作
    public function doAdd(Request $request){
        $params=$request->all();
        if (!isset($params['image_url'])||empty($params['image_url'])){
            return redirect()->back()->with('msg','请上传图片');
        }
        $params['image_url']=ToolsAdmin::uploadFile($params['image_url']);
        $params=$this->delToken($params);
        $ad=new Ad();
        $res=$this->storeData($ad,$params);
       if (!$res){
           return redirect()->back()->with('msg','添加广告失败');
       }
       return redirect('/admin/ad/list');
    }
    //删除
    public function del($id){
        $ad=new Ad();
        $this->delData($ad,$id);
        return redirect('/admin/ad/list');
    }
    //编辑页面
    public function edit($id){
        $ad=new Ad();
        $assign['info']=$this->getDataInfo($ad,$id);
        $assign['position']=$this->position->list();
        return view('admin.ad.edit',$assign);
    }
    //执行编辑功能
    public function doEdit(Request $request){
        $params=$request->all();
       //只有当图片上传选中的时候我们才上传图片
        if (isset($params['image_url']) && !empty($params['image_url'])){
            $params['image_url']=ToolsAdmin::uploadFile($params['image_url']);
        }
        $params=$this->delToken($params);
        $ad=Ad::find($params['id']);//先查出来对象
        $res=$this->storeData($ad,$params);
        if (!$res){
            return redirect()->back()->with('msg','修改广告失败');
        }
        return redirect('/admin/ad/list');

    }
}
