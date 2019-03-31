<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    //
    protected $table = "novel";

    //获取列表
    public function getList(){

    	return self::select("novel.id",'c_name','author_name','c_id','a_id','name','image_url','status','tags','clicks')
    			->join('category','novel.c_id','category.id')//连分类表
    			->join('author','novel.a_id','=','author.id')
    			->paginate(4);
    }


    //小说添加
    public function addRecord($data){
    	
    	return self::insert($data);
    }

    // 执行删除操作
    public function delRecord($id){
    	return self::where('id',$id)->delete();
    }

    //小说修改
    public function editRecord($data, $id)
    {
    	return self::where('id',$id)->update($data);    
    }


     //获取小说详情
    public function getNovelInfo($id)
    {
    	return self::where('id', $id)->first();
    }
   //获取banner图
    public function getBanner($num=3){
        $list=self::select('id','image_url')
            ->orderBy('id','desc')
            ->limit($num)
            ->get()
            ->toArray();
        return $list;
    }
    //获取最新小说
    public function getNews($num=3){
        $list=self::select('novel.id','name','image_url','author_name','tags','desc')
            ->leftJoin('author','novel.a_id','=','author.id')
            ->orderBy('novel.id','desc')
            ->limit($num)
            ->get()
            ->toArray();
        return $list;

    }
    //获取首页点击排行
    public function getClicks($num=3){
        $list=self::select('novel.id','name','image_url','author_name','tags','desc')
            ->leftJoin('author','novel.a_id','=','author.id')
            ->orderBy('novel.clicks','desc')
            ->limit($num)
            ->get()
            ->toArray();
        return $list;
    }
    //通过分类查询小说列表
    public function getNovelByCid($cid){
        $list=self::select('novel.id','name','image_url','author_name','tags','status','clicks')
            ->leftJoin('author','novel.a_id','=','author.id')
            ->where('c_id',$cid)
            ->orderBy('novel.id','desc')
            ->get()
            ->toArray();
        return $list;
    }
    //通过小说名字和作者名字获取小说列表
    public function getNovelByName($name){
        $list=self::select('novel.id','name','image_url','author_name','tags','status','clicks')
            ->leftJoin('author','novel.a_id','=','author.id')
            ->where('name','like','%'.$name.'%')
            ->orwhere('author_name',$name)
            ->orderBy('id','desc')
            ->get()
            ->toArray();
        return $list;
    }
    //获取小说详情接口
    public function getNovelDetail($id){
        $list=self::select('novel.id','name','image_url','author_name','status','desc','c_name')
            ->leftJoin('author','novel.a_id','=','author.id')
            ->leftJoin('category','novel.c_id','=','category.id')
            ->where('novel.id',$id)
            ->first();
        return $list;
    }
}
