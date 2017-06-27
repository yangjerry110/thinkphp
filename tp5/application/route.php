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

