<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

	//echo "hello Laravel";exit;
    return view('welcome');
});

//学习类的路由组
Route::prefix('study')->group(function(){

    //红包首页路由
    Route::get('bonus/index','Study\BonusController@index');
    //红包添加路由
    Route::post('bonus/add','Study\BonusController@addBonus');
    //红包列表
    Route::get('bonus/list','Study\BonusController@getList');

    Route::get('bonus/record/list','Study\BonusController@getBonusRecord');

    Route::any('get/bonus', 'Study\BonusController@getBonus'); //获取红包的路由

//球赛
    Route::get('guess/add','Study\GuessController@add');//添加页面
    Route::post('guess/doAdd','Study\GuessController@doAdd');//执行添加
    Route::get('guess/list','Study\GuessController@list');//展示页面
    Route::get('guess/guess','Study\GuessController@guess');//竞猜页面
    Route::post('guess/doGuess','Study\GuessController@doGuess');//竞猜添加页面
    Route::get('guess/result','Study\GuessController@checkResult');
//抽奖
    Route::get('lottery/index','Study\LotteryController@lottery');//抽奖页面
    Route::any('lottery/do','Study\LotteryController@doLottery');//执行抽奖
    Route::get('lottery/list/{phone}','Study\LotteryController@list');//抽奖结果页面




});



//登陆页面
Route::get('admin/login','Admin\LoginController@index');
//执行登陆
Route::post('admin/doLogin','Admin\LoginController@doLogin');
//用户退出
Route::get('admin/logout','Admin\LoginController@logout');

Route::get('403',function(){
    return view('403');
});

//管理后台RBAC功能类的路由组
Route::middleware(['admin_auth','permission_auth'])->prefix('admin')->group(function(){

    //管理后台首页
    Route::get('home','Admin\HomeController@home')->name('admin.home');

   /*#############################[权限相关]#############################*/
    //权限列表
    Route::get('/permission/list','Admin\PermissionController@list')->name('admin.permission.list');
    //获取权限的数据
    Route::any('/get/permission/list/{fid?}','Admin\PermissionController@getPermissionList')->name('admin.get.permission.list');
    //权限添加
    Route::get('/permission/create','Admin\PermissionController@create')->name('admin.permission.create');
    //执行权限添加
    Route::post('/permission/doCreate','Admin\PermissionController@doCreate')->name('admin.permission.doCreate');
    //删除权限的操作
    Route::get('/permission/del/{id}','Admin\PermissionController@del')->name('admin.permission.del');

    /*#############################[权限相关]#############################*/



    /*#############################[用户相关]#############################*/
    //用户添加页面
    Route::get('/user/add','Admin\AdminUsersController@create')->name('admin.user.add');
    //执行用户添加
    Route::post('/user/store','Admin\AdminUsersController@store')->name('admin.user.store');

    //用户列表页面
    Route::get('/user/list','Admin\AdminUsersController@list')->name('admin.user.list');

    //用户删除操作
    Route::get('/user/del/{id}','Admin\AdminUsersController@delUser')->name('admin.user.del');

    //用户编辑页面
    Route::get('/user/edit/{id}','Admin\AdminUsersController@edit')->name('admin.user.edit');
    //用户执行编辑页面
    Route::post('/user/doEdit','Admin\AdminUsersController@doEdit')->name('admin.user.doEdit');

     /*#############################[用户相关]#############################*/


     /*#############################[角色相关]#############################*/

     //角色列表
     Route::get('/role/list','Admin\RoleController@list')->name('admin.role.list');
     //角色删除
     Route::get('/role/del/{id}','Admin\RoleController@delRole')->name('admin.role.del');

     //角色添加
     Route::get('/role/create','Admin\RoleController@create')->name('admin.role.create');
     //角色执行添加
     Route::post('/role/store','Admin\RoleController@store')->name('admin.role.store');

     //角色编辑
     Route::get('/role/edit/{id}','Admin\RoleController@edit')->name('admin.role.edit');
     //角色执行编辑
     Route::post('/role/doEdit','Admin\RoleController@doEdit')->name('admin.role.doEdit');

     //角色权限编辑
     Route::get('/role/permission/{id}','Admin\RoleController@rolePermission')->name('admin.role.permission');
     //角色权限执行编辑
     Route::post('/role/permission/save','Admin\RoleController@saveRolePermission')->name('admin.role.permission.save');

     /*#############################[角色相关]#############################*/


     /*#############################[小说相关]#############################*/

     //作者列表
     Route::get('author/list','Admin\AuthorController@list')->name('admin.author.list');
     //作者添加
     Route::get('author/create','Admin\AuthorController@create')->name('admin.author.create');
     //作者执行添加
     Route::post('author/store','Admin\AuthorController@store')->name('admin.author.store');
     //作者执行删除
     Route::get('author/del/{id}','Admin\AuthorController@del')->name('admin.author.del');


     //分类列表
     Route::get('category/list','Admin\CategoryController@list')->name('admin.category.list');
     //分类添加
     Route::get('category/create','Admin\CategoryController@create')->name('admin.category.create');
     //分类执行添加
     Route::post('category/store','Admin\CategoryController@store')->name('admin.category.store');
     //分类删除
     Route::get('category/del/{id}','Admin\CategoryController@del')->name('admin.category.del');


      //小说添加
     Route::get('novel/create','Admin\NovelController@create')->name('admin.novel.create');
     //执行小说添加
     Route::post('novel/store','Admin\NovelController@store')->name('admin.novel.store');
     //小说列表
     Route::get('novel/list','Admin\NovelController@list')->name('admin.novel.list');
     //小说编辑
     Route::get('nove/edit/{id}','Admin\NovelController@edit')->name('admin.novel.edit');
     //执行小说编辑
     Route::post('nove/doEdit','Admin\NovelController@doEdit')->name('admin.novel.doEdit');
     //小说的删除
     Route::get('novel/del/{id}','Admin\NovelController@del')->name('admin.novel.del');

     //小说章节添加
     Route::get('chapter/add/{novel_id}','Admin\ChapterController@create')->name('admin.chapter.create');
     //保存小说章节
     Route::post('chapter/store','Admin\ChapterController@store')->name('admin.chapter.store');
     //小说章节列表
     Route::get('chapter/list/{novel_id?}','Admin\ChapterController@list')->name('admin.chapter.list');
     //小说章节删除
     Route::get('chapter/del/{$id}','Admin\ChapterController@del')->name('admin.chapter.del');
     //章节编辑
     Route::get('chapter/edit/{id}','Admin\ChapterController@edit')->name('admin.chapter.edit');
     //执行章节编辑
     Route::post('chapter/doEdit','Admin\ChapterController@doEdit')->name('admin.chapter.doEdit');


      //小说评论列表页面
     Route::get('novel/comment/list','Admin\CommentController@list')->name('admin.novel.comment.list');
     //小说数据
     Route::get('novel/comment/data','Admin\CommentController@getComment')->name('admin.novel.comment.data');
     //小说评论审核
     Route::get('novel/comment/check/{id}','Admin\CommentController@check')->name('admin.novel.comment.check');
     //小说评论删除
     Route::get('novel/comment/del/{id}','Admin\CommentController@del')->name('admin.novel.comment.del');

     
     /*#############################[小说相关]#############################*/

    /*#############################[商品品牌相关]#############################*/
    //品牌列表页面
    Route::any('brand/list','Admin\BrandController@list')->name('admin.brand.list');
    //品牌列表数据
    Route::any('brand/data/list','Admin\BrandController@getListData')->name('admin.brand.data.list');
    //品牌添加页面
    Route::any('brand/add','Admin\BrandController@add')->name('admin.brand.add');
    //执行品牌添加页面
    Route::post('brand/doAdd','Admin\BrandController@doAdd')->name('admin.brand.doAdd');
    //删除品牌
    Route::get('brand/del/{id}','Admin\BrandController@del')->name('admin.brand.del');
    //修改页面
    Route::get('brand/edit/{id}','Admin\BrandController@edit')->name('admin.brand.edit');
    //执行修改
    Route::post('brand/doEdit','Admin\BrandController@doEdit')->name('admin.brand.doEdit');
    //修改品牌的属性值
    Route::post('brand/change/attr','Admin\BrandController@changeAttr')->name('admin.brand.change.attr');
    /*#############################[商品品牌相关]#############################*/

    /*#############################[商品分类相关]#############################*/
    //商品分类页面
    Route::get('categorys/list','Admin\CategorysController@list')->name('admin.categorys.list');
    //获取商品接口分类的数据
    Route::get('categorys/get/data/{fid}','Admin\CategorysController@getListData')->name('admin.categorys.get.data');
    //商品添加页面
    Route::get('categorys/add','Admin\CategorysController@add')->name('admin.categorys.add');
    //执行商品添加页面
    Route::post('categorys/doAdd','Admin\CategorysController@doAdd')->name('admin.categorys.doAdd');
    //商品编辑页面
    Route::get('categorys/edit/{id}','Admin\CategorysController@edit')->name('admin.categorys.edit');
    //执行商品编辑操作
    Route::post('categorys/doEdit','Admin\CategorysController@doEdit')->name('admin.categorys.doEdit');
    //执行商品删除页面
    Route::get('categorys/del/{id}','Admin\CategorysController@del')->name('admin.categorys.del');
    /*#############################[商品分类相关]#############################*/

    /*#############################[文章分类相关]#############################*/
    //文章分类列表
    Route::get('article/category/list','Admin\ArticleCategoryController@list')->name('admin.article.category.list');
    //文章分类添加列表
    Route::get('article/category/add','Admin\ArticleCategoryController@add')->name('admin.article.category.add');
    //文章分类执行添加列表
    Route::post('article/category/doAdd','Admin\ArticleCategoryController@doAdd')->name('admin.article.category.doAdd');
    //文章分类执行删除
    Route::get('article/category/del/{id}','Admin\ArticleCategoryController@del')->name('admin.article.category.del');
    //文章分类编辑页面
    Route::get('article/category/edit/{id}','Admin\ArticleCategoryController@edit')->name('admin.article.category.edit');
    //文章分类执行编辑
    Route::post('article/category/doEdit','Admin\ArticleCategoryController@doEdit')->name('admin.article.category.doEdit');
    /*#############################[文章分类相关]#############################*/
    /*#############################[文章相关]#############################*/
    //列表页面
    Route::get('article/list','Admin\ArticleController@list')->name('admin.article.list');
    //添加页面
    Route::get('article/add','Admin\ArticleController@add')->name('admin.article.add');
    //执行添加页面
    Route::post('article/doAdd','Admin\ArticleController@doAdd')->name('admin.article.doAdd');
    //执行删除页面
    Route::get('article/del/{id}','Admin\ArticleController@del')->name('admin.article.del');
    //编辑页面
    Route::get('article/edit/{id}','Admin\ArticleController@edit')->name('admin.article.edit');
    //执行编辑添加
    Route::post('article/doEdit','Admin\ArticleController@doEdit')->name('admin.article.doEdit');
    /*#############################[文章相关]#############################*/

    /*#############################[广告位相关]#############################*/
    //广告位列表
    Route::get('ad/position/list','Admin\AdPositionController@list')->name('admin.ad.position.list');
    //广告位添加页面
    Route::get('ad/position/add','Admin\AdPositionController@add')->name('admin.ad.position.add');
    //执行添加
    Route::post('ad/position/doAdd','Admin\AdPositionController@doAdd')->name('admin.ad.position.doAdd');
    //执行删除
    Route::get('ad/position/del/{id}','Admin\AdPositionController@del')->name('admin.ad.position.del');
    //执行编辑页面
    Route::get('ad/position/edit/{id}','Admin\AdPositionController@edit')->name('admin.ad.position.edit');
    //执行编辑
    Route::post('ad/position/doEdit','Admin\AdPositionController@doEdit')->name('admin.ad.position.doEdit');
    /*#############################[广告位相关]#############################*/

});

//考试路由
     Route::get('lottery/index','Lottery\LotteryController@index');//展示页面
     Route::any('lottery/do','Lottery\LotteryController@doLottery');//执行抽奖

