<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 15:14:06
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-06-02 17:39:10
* @应用公共文件
*/

use think\Config;
use think\Cache;

function getAdminMenu()
{
    //获取登录的后台管理员id
    $adminId = Cache::get('adminId');
    $adminName = Cache::get('adminName');

    if(empty($adminId))
    {
        $this->redirect('cms/AdminLogin/index');
    }

    //echo $adminId;exit;
    $adminMenuAll = Config::get('adminmenu');
    $adminPowerAll = Config::get('adminpower');
    //print_r($adminPowerAll);exit;

    //获得登陆的后台管理员的权限
    $adminPowerListByNow = db('adminUserPower')
                                                     ->field('adminUserPower')
                                                     ->where('adminUserId',$adminId)
                                                     ->value('adminUserPower','id');

    //转化取得的当前登录的后台管理员的权限为数组
    //print_r($adminPowerListByNow);exit;
    $adminPowerListByNowForArray = explode(',',$adminPowerListByNow);

      //判断取得权限与所有的权限集合进行匹配,去除没有的权限
      foreach ($adminMenuAll as $key => $value) 
      {
        //print_r($value);//exit;
         foreach ($value['list'] as $k => $v) 
         {
            //echo $k.'<br/>';
            //echo $v.'<br/>';
             if(in_array($k,$adminPowerListByNowForArray))
             {
                $adminMenuByNow[$key]['list'][$k] = $v;
                $adminMenuByNow[$key]['name'] = $adminMenuAll[$key]['name'];
;
             }
         }
      }

      if($adminName == 'admin')
      {
        $adminMenuByNow = $adminMenuAll;
      }

      return $adminMenuByNow;

      //print_r($adminMenuByNow);exit;




}