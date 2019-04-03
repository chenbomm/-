<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //商品品牌表
    protected $table="jy_brand";
    public $timestamps=false;
    //获取列表数据
    public static function getList(){
        return self::get()->toArray();
    }
    //添加商品品牌
    public static function creates($data){
        return self::insert($data);
    }
    //执行删除的操作
    public static function del($id){
        return self::where('id',$id)->delete();
    }
    //获取修改的数据
    public static function doEdit($id){
        return self::where('id',$id)->first();
    }
    //执行修改
    public static function doUpdate($id,$data){
        return self::where('id',$id)->update($data);
    }
}
