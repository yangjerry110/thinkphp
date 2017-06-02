<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-05-19 15:59:58
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-05-29 17:07:50
*/

namespace app\james\controller;
//use \think\View;
use think\Controller;
use think\Validate;

/**
* 首页
*/
class index extends controller
{
    
    public function index()
    {
        $data = [
            'name' => '詹姆斯官网',
        ];
        return $this->fetch('index',$data);
    }
}

?>
