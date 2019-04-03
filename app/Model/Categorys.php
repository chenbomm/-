<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    //商品分类表
    protected $table="jy_category";
    public $timestamps=false;
    //获取分类列表的数据
    public static function getCategorysList(){
        $list=self::get()->toArray();
        return $list;
    }
    //通过fid查询子类分类
    public static function getCategorysByFid($fid=0){
        $list=self::where('f_id',$fid)->get()->toArray();
        return $list;
    }
    //添加分类的数据
    public static function doAdd($data){
        return self::insert($data);
    }
    //执行删除的操作
    public static function del($id){
        return self::where('id',$id)->delete();
    }
    //获取编辑的信息
    public static function getCateInfo($id){
        return self::where('id',$id)->first();
    }
    //执行编辑分类的数据
    public static function doEdit($data,$id){
        return self::where('id',$id)->update($data);
    }
}
