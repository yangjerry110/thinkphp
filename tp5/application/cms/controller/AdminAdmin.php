<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-07-04 13:54:20
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-07-05 17:15:17
* @后台管理员操作
*/

namespace app\cms\controller;
//use \think\View;
use think\Controller;
use think\Validate;
use think\Config;
use think\Cache;
use app\common\controller\Common;

/**
** @ 后台管理员相关操作的类
 */

class adminAdmin extends controller
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

   /**
   ** @ 列表函数
    */
   public function list()
   {
        //获取管理员列表
        $adminUserList = db('adminUser')->paginate(10);
        $this->data['adminUser'] = $adminUserList;
        //print_r($data);exit;
        return $this->fetch('list',$this->data);
   }

   /*
   ** 新增管理员
    */
   public function add()
   {
        $data = $this->data;

        //获取权限列表
        $adminPowerAll = Config::get('adminpower');
        $data['adminPowerAll'] = $adminPowerAll;
        //print_r($data);exit;
        return $this->fetch('add',$data);
   }

   /**
   ** @ 创建管理员
    */
   public function create()
   {
        $adminUserName = input('adminUserName');
        $adminUserPower = input('adminUserPower/a');
        $adminPassWord = input('adminPassWord');
        //print_r($adminUserPower);exit;
        //
        
        $checkDataReturn = $this->checkData($adminUserPower,$adminUserName,$adminPassWord);
        //print_r($checkDataReturn);exit;
        if($checkDataReturn['error'])
        {
            return $checkDataReturn;
        }
        else
        {
            $data = [
                'userName' => $adminUserName,
                'passWord' => hash('sha256',$adminPassWord),
            ];
            
             //获取刚刚插入的数据的主键值，并添加数据
             $adminUserId = db('adminUser')->insertGetId($data);
             //echo $adminUserId;exit;
            if(!$adminUserId)
            {
                $result = [
                    'error' => '3',
                    'data' => '添加失败！重新提交',
                ];
            }
            else
            {
                $powerData = [
                    'adminUserId' =>  $adminUserId,
                    'adminUserPower' => implode(',',$adminUserPower),
                ];
                //print_r($powerData);exit;
                if(!db('adminUserPower')->insert($powerData))
                {
                    $result = [
                    'error' => '3',
                    'data' => '添加失败！重新提交',
                    ];
                }
                else
                {
                    $result = [
                    'error' => '0',
                    'data' => '添加成功',
                    ];
                }
            }
        }
        

        return $result;
   }

   /**
    * @修改管理员展示页面
    */
   public function userEditShow()
   {
      $id = input('id');
      $adminUserInfo = db('adminUser')->where('id',$id)->select()[0];
      $adminPowerInfo = db('adminUserPower')->where('adminUserId',$id)->select()[0];
      //print_r($adminPowerInfo);exit;
      $this->data['adminUserInfo'] = $adminUserInfo;
      //获取权限列表
      $this->data['adminPowerAll'] = Config::get('adminpower');
      foreach($this->data['adminPowerAll'] as $key => $value)
      {
        if($adminPowerInfo['adminUserPower'] == $value['power'])
        {
          $this->data['adminPowerAll'][$key]['isChecked'] = '1';
        }
      }
      //print_r($this->data);exit;
      return $this->fetch('add',$this->data);
      //print_r($adminUserInfo);exit;
   }

   /**
    * @修改管理员
    */
   public function adminEdit()
   {
      $id = input('id');

      //后台管理员详情
      $adminUserInfo = db('adminUser')->where('id',$id)->select()[0];
      $adminUserName = input('adminUserName');
      $adminUserPower = input('adminUserPower/a');
      $adminPassWord = input('adminPassWord');

       //$checkDataReturn = $this->checkData($adminUserPower,$adminUserName,$adminPassWord);
       $checkDataReturn = 1;
        //print_r($checkDataReturn);exit;
        if($checkDataReturn['error'])
        {
            return $checkDataReturn;
        }
        else
        {
            if($adminPassWord && $adminUserInfo['userName'] != $adminUserName)
            {
              $data = [
                'userName' => $adminUserName,
                'passWord' => hash('sha256',$adminPassWord),
              ];
            }
            elseif($adminUserInfo['userName'] != $adminUserName && empty($adminPassWord))
            {
              $data = [
                'userName' => $adminUserName,
                //'passWord' => hash('sha256',$adminPassWord),
              ];
            }
            elseif($adminUserInfo['userName'] == $adminUserName && $adminPassWord)
            {
              $data = [
                //'userName' => $adminUserName,
                'passWord' => hash('sha256',$adminPassWord),
              ];
            }
            elseif($adminUserInfo['userName'] == $adminUserName && empty($adminPassWord))
            {
              $data = [
                //'userName' => $adminUserName,
              ];
            }
            //print_r($data);exit;
            if(empt($data))
            {
               if(db('adminUserPower')->where('adminUserId',$id)->update(['adminUserPower'=>implode(',',$adminUserPower)]))
                  {
                    $result = [
                          'error' => '0',
                          'data' => '修改成功',
                          ];
                  }
                  else
                  {
                    $result = [
                          'error' => '3',
                          'data' => '修改失败！重新提交',
                          ];
                  }
            }
            else
            {
              if(db('adminUser')->where('id',$id)->update($data))
              {
                  if(db('adminUserPower')->where('adminUserId',$id)->update(['adminUserPower'=>implode(',',$adminUserPower)]))
                  {
                    $result = [
                          'error' => '0',
                          'data' => '修改成功',
                          ];
                  }
                  else
                  {
                    $result = [
                          'error' => '3',
                          'data' => '修改失败！重新提交',
                          ];
                  }
              }
              else
              {
                $result = [
                        'error' => '2',
                        'data' => '修改失败！重新提交',
                        ];
              }
            }

            return $result;

        }
   }

   /**
    * @修改的时候，参数验证
    */
   public function checkDataEdit()
   {

   }

   /**
   ** 传递过来的参数验证
   ** @param adminUserName 传递过来的管理员名称
   ** @param adminPassWord 传递过来的管理员的密码
   ** @param adminUserPower 传递过来的管理员的权限
    */
   public function checkData($adminUserPower,$adminUserName,$adminPassWord)
   {
        //echo $adminUserName;exit;
          $validate = new Validate([
            '管理员名称' => 'require',
            '管理员密码' => 'require|min:6',
            '管理员权限' => 'require',
          ]);

          $data = [
            '管理员名称' => $adminUserName,
            '管理员密码' => $adminPassWord,
            '管理员权限' => $adminUserPower,
          ];

       
     
        
        $checkAdminName = db('adminUser')->where('userName',$adminUserName)->value('id');

        if(!$validate->check($data))
          {
                $result = [
                    'error' => '1',
                    'data' => $validate->getError(),
                ];
           }
           elseif($checkAdminName)
           {
                 $result = [
                    'error' => '2',
                    'data' => '管理员用户名重复',
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

   /**
    * @删除后台管理员
    */
   public function deleteUser()
   {
      $id = input('id');
      $deleteResult = db('adminUser')->where('id',$id)->delete();
      if($deleteResult)
      {
        $result = [
          'error' => 0,
          'data' => '删除成功！',
        ];
      }
      return $result;
   }



}
?>
