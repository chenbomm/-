<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //文章表
    protected $table="jy_article";

    //添加
    public function doAdd($data){
        return self::insertGetId($data);
    }
    //获取文章
    public function getList(){
        $list=self::select('jy_article.id','jy_article_category.cate_name','title','publish_at','clicks','status')
            ->leftJoin('jy_article_category','jy_article.cate_id','=','jy_article_category.id')
            ->paginate(3);

        return $list;
    }
    //获取编辑内容
    public function getInfo($id){
        return self::where('id',$id)->first();
    }
    //执行编辑操作
    public function doEdit($data,$id){
        return self::where('id',$id)->update($data);
    }
    //删除
    public function del($id){
        return self::where('id',$id)->delete();
    }
}
