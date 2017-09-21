<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-27 13:26:58
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-07-04 14:31:50
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
   **  文章列表相关的处理
    */
   public function list()
   {
      $articleData = db('article')->paginate(10);
      $this->data['articleData'] = $articleData;
      //print_r($this->data);
      return $this->fetch('list',$this->data);
   }

   /*
   ** @增加文章的显示页面
    */
   public function addShow()
   {
    return $this->fetch('add',$this->data);
   }

   /**
    * @增加新文章
    */
   public function add()
   {
      $name = input('name');
      $title = input('title');
      $content = input('content');

      //检查增加文章的时候，提交的数据
      $checkResult = self::checkAddDada($name,$title,$content);
      if($checkResult['error'] != 0)
      {
        $result = [
          'error' => 1,
          'data' => $checkResult['data'],
        ];
      }
      else
      {
        $addData = ['name'=>$name,'title'=>$title,'content'=>$content];
        $dbResult = db('article')->insert($addData);
        if($dbResult)
        {
          $result = [
            'error' => 0,
            'data' => "添加成功！",
          ];
        }
      }

      return $result;


   }

   /**
    * @检查添加文章的时候的数据
    */
   public function checkAddDada($name,$title,$content)
   {
      $validate = new Validate([
            'name' => 'require',
            'title' => 'require',
            'content' => 'require',
          ]);

        $data = [
            'name' => $name,
            'title' => $title,
            'content' => $content,
        ];

        if(!$validate->check($data))
          {
                $result = [
                    'error' => '1',
                    'data' => $validate->getError(),
                ];
           }
           else
           {
              $result = [
                    'error' => '0',
                    'data' => $validate->getError(),
                ];
           }

           return $result;

   }

   /**
    * @编辑文章显示页面
    */
   public function editShow()
   {
      $id = input('id');
      //echo $id;exit;
      $articleInfo = db('article')->where('id',$id)->select()[0];
      //print_r($articleInfo);exit;
      $this->data['info'] = $articleInfo;
      return $this->fetch('add',$this->data);
   }

   /**
    * @编辑文章提交
    */
   public function edit()
   {
      $id = input('id');
      $name = input('name');
      $title = input('title');
      $content = input('content');

      if(empty($id))
      {
          $result = [
            'error' => '1',
            'data' => "不存在此文章",
          ];
          return $result;
      }

      $updateData = [
        'name' => $name,
        'title' => $title,
        'content' => $content,
      ];

      $result = db('article')->where('id',$id)->update($updateData);
      if($result)
      {
        $result = [
          'error' => 0,
          'data' => '修改成功',
        ];
      }

      return $result;

   }

   /**
    * @删除文章
    */
   public function deleteArticle()
   {
      $id = input('id');
      $result = db('article')->where('id',$id)->delete();
      if($result)
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
