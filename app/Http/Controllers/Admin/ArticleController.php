<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\ArticleCategory;
use App\Model\ArticleContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    protected $category=null;
    protected $article=null;
    protected $content=null;
    //构造函数
    public function __construct(){
        $this->category=new ArticleCategory();
        $this->article=new Article();
        $this->content=new ArticleContent();
//        $this->article=new Article();
    }
    //文章列表页面
    public function list(){
        $assign['list']=$this->article->getList();
//        dd($assign);
        return view('admin.article.list',$assign);
    }
    //文章添加页面
    public function add(){
        $assign['category']=$this->category->getCategoryList();
        return view('admin.article.add',$assign);
    }
    //执行添加
    public function doAdd(Request $request){
        $params=$request->all();
//        dd($params);
        unset($params['_token']);
        $content=$params['content'];
        unset($params['content']);
        try{
            DB::beginTransaction();//开始事务
            //执行文章添加
            $id=$this->article->doAdd($params);
            //执行文章内容添加
            $data=[
                'a_id'=>$id,
                'content'=>$content
            ];
            $this->content->doAdd($data);
            DB::commit();//提交事务
        }catch (\Exception $e){

            DB::rollback();//事务回滚

            \Log::info('文章添加失败 '.$e->getMessage());

            return redirect()->back()->with('msg',$e->getMessage());

        }
        return redirect('/admin/article/list');
    }
    //编辑页面
    public function edit($id){
        $assign['category']=$this->category->getCategoryList();
        $assign['content']=$this->content->getInfo($id);
        $assign['info']=$this->article->getInfo($id);
        return view('admin.article.edit',$assign);
    }
    //执行编辑操作
    public function doEdit(Request $request){
        $params=$request->all();
        unset($params['_token']);
        $content=$params['content'];
        unset($params['content']);
        $id=$params['id'];
        try{
            DB::beginTransaction();//开始事务
            //执行文章编辑
            $this->article->doEdit($params,$id);
            //执行文章内容编辑
            $data=[
                'content'=>$content
            ];
            $this->content->doEdit($data,$id);
            DB::commit();//提交事务
        }catch (\Exception $e){

            DB::rollback();//事务回滚

            \Log::info('文章添加失败 '.$e->getMessage());

            return redirect()->back()->with('msg',$e->getMessage());

        }
        return redirect('/admin/article/list');
    }
        //执行删除
    public function del($id){
        //事务的执行
        try{
            DB::beginTransaction();//开始事务
            $this->article->del($id);

            $this->content->del($id);

            DB::commit();//提交事务
            \Log::info('文章删除成功');
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            \Log::info('文章删除失败 '.$e->getMessage());
        }
        return redirect('/admin/article/list');
    }
}
