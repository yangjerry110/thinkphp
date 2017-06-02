<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 10:25:42
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-06-02 17:36:56
* @后台会员登陆的相关的函数
*/

namespace app\cms\controller;
//use \think\View;
use think\Controller;
use think\Validate;
use think\Config;
use think\Cache;

/**
* 后台登陆
*/
class AdminLogin extends controller
{
    //会员登陆页
    public function index()
    {
        //getAdminMenu();
        //Config::load(APP_PATH.'extra/adminMenu.php');
        //print_r(Config::get());
        //检查是否登录
        if($this->checkLoginStatus())
        {
          echo '111';
          //重定向
          $this->redirect('cms/AdminIndex/index');
          exit;
        }

        $data = ['type' => 'adminLogin'];
        return $this->fetch('index',$data);
    }

    //会员登陆验证
    public function loginCheck()
    {
        $userName =  input('userName');
        $passWord = input('passWord');

         $validate = new Validate([
            '用户名' => 'require',
            '密码' => 'require',
          ]);

         $data = [
            '用户名' => $userName,
            '密码' => $passWord,
         ];

          if(!$validate->check($data))
          {
                $result = [
                    'error' => '1',
                    'data' => $validate->getError(),
                ];
           }
           elseif($this->checkUserPwdByAdmin($userName,$passWord)['error'] != 0)
           {
                $result = [
                    'error' => $this->checkUserPwdByAdmin($userName,$passWord)['error'],
                    'data' => $this->checkUserPwdByAdmin($userName,$passWord)['data'],
                ];
           }
           else
          {
            $result = [
                'error' => '0',
                'data' => '登陆成功',
            ];

            $getAdminId = db('adminUser')->field('id')->where('userName',$userName)->value('id');
            //echo $getAdminId;exit;
            Cache::set('adminId',$getAdminId,86400);
            Cache::set('adminName',$userName,86400);
          }

          return $result;

    }

    /*
    ** 检查是否已经登录
     */
    public function checkLoginStatus()
    {
      $getAdminId = Cache::get('adminId');
      $getadminName = Cache::get('adminName');
      //echo $adminid;exit;
      if(empty($getAdminId))
      {
        //echo '333';
        return false;
      }
      else
      {
        Cache::set('adminId',$getAdminId,86400);
        Cache::set('adminName',$getadminName,86400);
        //echo '222';
        return true;
      }
    }

    /*
    ** 验证后台会员登陆的账号和密码是否匹配
     */
    public function checkUserPwdByAdmin($userName,$passWord)
    {
       //根据会员账号查找对应的密码
       $passWordBySelect = db('adminUser')->field('passWord')
                                                                           ->where('userName',$userName)
                                                                           ->value('passWord','id');

        //如果为空就不存在此账号
        //print_r($passWordBySelect);exit;
        if(empty($passWordBySelect))
        {
            $result = [
                'error' => '2',
                'data' => '您输入的账号不存在，请重新输入',
            ];
        }
        elseif($passWordBySelect != hash('sha256',$passWord))
        {
            $result = [
                'error' => '3',
                'data' => '您输入的密码不正确，请重新输入',
            ];
        }
        else
        {
            $result = [
                'error' => '0',
            ];
        }

        return $result;


    }


}

?>
