<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('/', 'index/Index/index');

//用户删除
// Route::get('users/delete/:id','admin/User/delete');
// 用户rolelist 列表
Route::get('users/rolelist/:id','admin/User/rolelist');
// 用户savelist 角色保存
Route::put('users/saverole/:id','admin/User/saverole');



//角色删除
// Route::get('role/delete/:id','admin/Role/delete');
// 用户nodelist 列表
Route::get('role/rolelist/:id','admin/Role/nodelist');
// 用户nodelist 角色保存
Route::put('role/saverole/:id','admin/Role/savenode');


//节点删除
Route::get('node/delete/:id','admin/Node/delete');

// 节点 增该查
Route::resource('node','admin/Node');

//角色 改查增
Route::resource('role','admin/Role');

// user路由
// 用户列表路由 增改查
Route::resource('users','admin/User');

// 后台登录
// Route::get('adminlogin','admin/Login');

// 角色列表路由
Route::resource('roles','admin/Role');

// 空路由
// Route::get('/admin/:name','admin/Index', ['name' => '\w+']);

return [

];
