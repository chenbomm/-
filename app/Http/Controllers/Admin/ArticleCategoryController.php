<?php

namespace App\Http\Controllers\Admin;

use App\Model\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleCategoryController extends Controller
{
    protected $articleCategory=null;
    //构造函数
    public function __construct(){
        $this->articleCategory=new ArticleCategory();
    }

    //文章分类列表
    public function list(){
        $assign['list']=$this->articleCategory->getCategoryList();
        return view('admin.article.category.list',$assign);
    }
    //添加列表
    public function add(){
        return view('admin.article.category.add');
    }
    //执行添加
    public function doAdd(Request $request){
        $params=$request->all();
        if (!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');
        }
        unset($params['_token']);

        $res=$this->articleCategory->doAdd($params);

        if (!$res){
            return redirect()->back()->with('msg','分类添加失败');
        }
            return redirect('/admin/article/category/list');
    }
    //删除
    public function del($id){
        $res=$this->articleCategory->del($id);
        return redirect('/admin/article/category/list');
    }
    //编辑页面
    public function edit($id){
        $assign['info']=$this->articleCategory->edit($id);
        return view('admin.article.category.edit',$assign);
    }
    //执行编辑
    public function doEdit(Request $request){
        $params=$request->all();
        if (!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');
        }
        unset($params['_token']);
        $id=$params['id'];
        $res=$this->articleCategory->doEdit($params,$id);

        if (!$res){
            return redirect()->back()->with('msg','分类编辑失败');
        }
        return redirect('/admin/article/category/list');
    }
}
