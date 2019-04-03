<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    //文章内容表
    protected $table="jy_article_content";
    public $timestamps=false;

    //添加
    public function doAdd($data){
        return self::insert($data);
    }
    //获取编辑数据
    public function getInfo($id){
        return self::where('a_id',$id)->first();
    }
    //执行编辑添加
    public function doEdit($data,$aid){
        return self::where('a_id',$aid)->update($data);
    }
    //删除
    public function del($id){
        return self::where('a_id',$id)->delete();
    }
}
