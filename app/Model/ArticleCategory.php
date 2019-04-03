<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    //文章分类表
    protected $table="jy_article_category";
    public $timestamps=false;
    //获取分类列表的数据
    public function getCategoryList(){
        return self::get()->toArray();
    }
    //执行添加
    public function doAdd($data){
        return self::insert($data);
    }
    //删除
    public function del($id){
        return self::where('id',$id)->delete();
    }
    //获取编辑内容
    public function edit($id){
        return self::where('id',$id)->first();
    }
    //执行编辑
    public function doEdit($data,$id){
        return self::where('id',$id)->update($data);
    }
}
