<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-27 13:26:58
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-06-27 13:33:20
* @文章相关的操作
*/

namespace app\cms\controller;
//use \think\View;
use think\Controller;
use think\Validate;
use think\Config;
use think\Cache;
use app\common\controller\Common;

/**
* 文章相关的处理类
*/
class AdminArticle extends controller
{
   /*
   **  文章列表相关的处理
    */
   public function list()
   {

        //跨模块调用common里面的方法
        //$event = \think\Loader::controller('common/Common','event');
        //$getAdminMenu = $event->getAdminMenu();
        $common = new Common;
        $getAdminMenu = $common->getAdminMenu();

        $data = [
            'type' => 'adminArticle',
            'leftMenu' => $getAdminMenu,
        ];
        return $this->fetch('list',$data);
   }
}
?>
