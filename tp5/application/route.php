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

