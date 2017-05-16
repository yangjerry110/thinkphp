<?php
/* 
* @Author: yangjie-jerry
* @Date:   2017-05-12 16:36:04
* @Last Modified by:   yangjie-jerry
* @Last Modified time: 2017-05-16 14:47:44
*/
namespace app\Test\controller;
use think\Db;
/**
* 数据库练习
*/
class TestMySql
{
    
    public function __construct()
    {
        # code...
    }

    public function test()
    {
        $data = ['name' => '111','content' => '222'];
        echo db('test')->insert($data);
    }

    public function test1()
    {
        $sqlResult = db('test')->where('id',1)->select();
        print_r($sqlResult);exit;
    }

    public function test2()
    {
        $id = input('id');
        $sqlResult = db('test')
                                ->where('id',$id)
                                ->update([
                                    'name'=>'5555',
                                    'content'=>'333'
                                    ]);
        echo $sqlResult;exit;
    }

    public function test3()
    {
        $id = input('id');
        $sqlResult = db('test')->where('id',$id)->delete();
        echo $sqlResult;exit;
    }

    public function test4()
    {
        $sqlResult = db('test')->field('id,max(name)')
                                              ->group('content')
                                              ->select();
        print_r($sqlResult);exit;
    }
}

?>
