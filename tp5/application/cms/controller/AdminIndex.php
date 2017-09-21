<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 14:15:28
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-07-04 14:31:12
* @后台会员首页的相关的函数
*/

namespace app\cms\controller;
//use \think\View;
use think\Controller;
use think\Validate;
use think\Config;
use think\Cache;
use app\common\controller\Common;

/**
*  后台首页
*/
class adminIndex extends controller
{
    //重定义构造函数，继承父类的构造函数，不能有些函数用不了，因为子类自己定义了构造函数，则不会继承父类的构造函数了
  public function __construct()
  {
     parent::__construct();
        //print_r($_SERVER);exit;
        //跨模块调用common里面的方法
        //$event = \think\Loader::controller('common/Common','event');
        //$getAdminMenu = $event->getAdminMenu();
        $common = new Common;
        $getAdminMenu = $common->getAdminMenu();
        //print_r($getAdminMenu);exit;
        $data = [
            'type' => 'admin',
            'leftMenu' => $getAdminMenu,
        ];
        $this->data = $data;
  }

    /*
    ** 后台首页
     */
    public function index()
    {
        //print_r(Config::get("database"));exit;
        //getAdminMenu();
        
        //Cache::rm('adminId');
        //Cache::rm('adminName');

       
        //print_r($data);exit;
        return $this->fetch('index',$this->data);
    }
    
}

?>
