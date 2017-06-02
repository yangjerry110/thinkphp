<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 14:15:28
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-06-02 17:54:34
* @后台会员首页的相关的函数
*/

namespace app\cms\controller;
//use \think\View;
use think\Controller;
use think\Validate;
use think\Config;
use think\Cache;

/**
*  后台首页
*/
class adminIndex extends controller
{
    /*
    ** 后台首页
     */
    public function index()
    {
        //print_r(Config::get("database"));exit;
        //getAdminMenu();
        
        Cache::rm('adminId');
        Cache::rm('adminName');
        $data = [
            'type' => 'index',
            'leftMenu' => getAdminMenu(),
        ];
        //print_r($data);exit;
        return $this->fetch('index',$data);
    }
    
}

?>
