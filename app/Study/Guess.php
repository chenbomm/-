<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class Guess extends Model
{
    //
    protected $table='study_guess';
    //添加
    public function add($data){
        return self::insert($data);
    }
    //列表
    public function getList(){
        return self::get()->toArray();
    }
    //竞赛
    public function getInfo($id){
        return self::where('id',$id)->first();
    }
}
