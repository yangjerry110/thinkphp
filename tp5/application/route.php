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

/*
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
*/

use think\Route;

//处理图片上传
Route::rule('image/upload','images/ImageClass/upload','POST',['ext'=>'html']);

Route::rule('test/:id','test/Test/test','GET',['ext'=>'html']);

//数据库插入练习
Route::rule('testmysql/:id','test/TestMySql/test','GET',['ext'=>'html']);

//数据库查询练习
Route::rule('selectmysql/:id','test/TestMySql/test1','GET',['ext'=>'html']);

//数据库更新练习
Route::rule('updatemysql/:id','test/TestMySql/test2','GET',['ext'=>'html']);

//数据库删除练习
Route::rule('deletemysql/:id','test/TestMySql/test3','GET',['ext'=>'html']);

//数据库分组练习
Route::rule('groupmysql/:id','test/TestMySql/test4','GET',['ext'=>'html']);

//模型练习，以及模板练习
Route::rule('testNew/:id','test/TestNew/index','GET',['ext'=>'html']);

//ajax练习
Route::rule('testAjax/:id','test/TestNew/testAjax','POST',['ext'=>'html']);

//詹姆斯网站
//首页
Route::rule('james/index','james/Index/index','GET',['ext'=>'html']);

//后台会员退出
Route::rule('admin/loginOut','cms/AdminLogin/userExit','GET',['ext'=>'html']);

//后台会员登陆
Route::rule('admin/login','cms/AdminLogin/index','GET',['ext'=>'html']);

//后台会员登陆验证
Route::rule('admin/loginCheck','cms/AdminLogin/loginCheck','POST',['ext'=>'html']);

//后台首页
Route::rule('admin/index','cms/AdminIndex/index','GET',['ext'=>'html']);

//后台会员退出
Route::rule('admin/userExit','cms/AdminLogin/userExit','GET',['ext'=>'html']);

//后台会员文章详情
Route::rule('admin/articleInfo','cms/AdminArticle/info','GET',['ext'=>'html']);

//后台会员文章列表
Route::rule('admin/articleList','cms/AdminArticle/list','GET',['ext'=>'html']);

//管理员会员列表
Route::rule('admin/adminList','cms/AdminAdmin/list','GET',['ext'=>'html']);

//新增管理员
Route::rule('admin/adminAdd','cms/AdminAdmin/add','GET',['ext'=>'html']);

//创建管理员
Route::rule('admin/adminCreate','cms/AdminAdmin/create','POST',['ext'=>'html']);

//新增文章
Route::rule('admin/articleAdd','cms/AdminArticle/add','POST',['ext'=>'html']);

//新增文章显示页面
Route::rule('admin/articleAddShow','cms/AdminArticle/addShow','GET',['ext'=>'html']);

//文章编辑显示页面
Route::rule('admin/articleEditShow','cms/AdminArticle/editShow','GET',['ext'=>'html']);

//文章编辑提交页面
Route::rule('admin/articleEdit','cms/AdminArticle/edit','POST',['ext'=>'html']);

//文章删除页面
Route::rule('admin/articleDelete','cms/AdminArticle/deleteArticle','POST',['ext'=>'html']);

//后台管理删除
Route::rule('admin/userDelete','cms/AdminAdmin/deleteUser','POST',['ext'=>'html']);

//后台管理员编辑显示页面
Route::rule('admin/userEditShow','cms/AdminAdmin/userEditShow','GET',['ext'=>'html']);

//后台管理员编辑提交页面
Route::rule('admin/adminEdit','cms/AdminAdmin/adminEdit','POST',['ext'=>'html']);
