<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    //广告位表
    protected $table="jy_ad_position";
    public $timestamps=false;
    //执行添加
    public function add($data){
        return self::insert($data);
    }
    //展示列表
    public function list(){
        return self::get()->toArray();
    }
    //删除
    public function del($id){
        return self::where('id',$id)->delete();
    }
    //获取编辑数据
    public function edit($id){
        return self::where('id',$id)->first();
    }
   
}
