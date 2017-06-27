<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//登录页面
Route::get("/",'LoginController@index');
//登录验证
Route::post("login/handle",'LoginController@handle');
Route::get("login/quit",'LoginController@quit');
//获取路由
Route::post("login/getPath",'LoginController@getPath');
//上传图片
Route::any("public/upload",'PublicController@upload');

Route::group(['middleware' =>"AdminLogin"], function () {
Route::get('system/index', 'SystemController@index');
Route::get('system/add', 'SystemController@add');
Route::post('systems/system/add', 'SystemController@add');
Route::get('system/update/{id}', 'SystemController@update');
Route::post('systems/system/update', 'SystemController@update');
Route::get('system/delete/{id}','SystemController@delete');
Route::get('system/edit/{id}','SystemController@edit');

//系统管理中权限路由
Route::get('auth/index', 'AuthController@index');
Route::get('auth/assign/{id}', 'AuthController@assign');
Route::post('auth/edit', 'AuthController@edit');

//系统管理中角色路由
Route::get('role/index', 'RoleController@index');
Route::get('role/add', 'RoleController@add');
Route::post('systems/role/add', 'RoleController@add');
Route::post('systems/role/update', 'RoleController@update');
Route::get('role/update/{id}', 'RoleController@update');
Route::get('role/delete/{id}', 'RoleController@delete');
Route::post('role/getRoleName/', 'RoleController@getRoleName');

//系统管理中的密码修改路由
Route::get('login/wordEdit', 'LoginController@wordEdit');
Route::post('login/wordUpdate', 'LoginController@wordUpdate');

//信息反馈
Route::get("note/index", 'NoteController@index');
//处理反馈的信息
Route::post("note/changeStatus", 'NoteController@changeStatus');
//发布信息列表
Route::get("project/check", 'ProjectController@check');
//发布详情
Route::get("project/detail/{publishId}", 'ProjectController@detail');
//保存详情
Route::post("project/save", 'ProjectController@save');
//项目列表
Route::get("project/publish", 'ProjectController@publish');
//添加项目
Route::get("project/add", 'ProjectController@add');
//添加项目
Route::post("project/saveAdd", 'ProjectController@saveAdd');
//项目详情
Route::get("project/getDetail/{projectId}", 'ProjectController@getDetail');
//保存项目详情
Route::post("project/getSave", 'ProjectController@getSave');
//删除项目
Route::get("project/delete/{projectId}", 'ProjectController@delete');
//收藏详情
Route::get("project/getCollect/{projectId}", 'ProjectController@getCollect');
//项目留言列表
Route::get("message/index", 'MessageController@index');
//留言详情
Route::get("message/detail/{messageId}", 'MessageController@detail');
//保存回复留言
Route::post("message/save", 'MessageController@save');
});