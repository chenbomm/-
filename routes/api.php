<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('index',function(){
	return 'Api请求接口成功';
});
/***************************[首页]*******************************/
//首页banner图接口
Route::post('home/banners','Api\HomeController@banners');
//获取最新小说接口
Route::post('home/news','Api\HomeController@newsList');
//获取点击量最高的小说接口
Route::post('home/clicks','Api\HomeController@clicksList');
//分类列表接口
Route::post('category/list','Api\CategoryController@getCategory');
//获取分类小说接口
Route::post('book/list','Api\CategoryController@getBook');
//获取搜索接口
Route::post('search/list','Api\SearchController@getSearchList');
//获取书单接口
Route::post('books/list','Api\NovelController@bookList');
//获取详情信息
Route::post('detail/list/{id}','Api\DetailController@detail');