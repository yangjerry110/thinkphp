<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-29 15:44:37
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-07-04 09:38:23
* @ 图片处理类
*/

/**
* 公共函数模块的函数
*/
namespace app\images\controller;

use think\Controller;
use think\Config;
use think\Cache;
use think\image;



/**
* **   图片处理类
*/
class imageClass extends controller
{
    const IMAGE_PATH = '/thinkphp-my/tp5/public/data/images/';
    const NO_DATA = '没有数据';
    const NOT_TRUE_TYPE = '图片类型不对';
    const NOT_CREATE_FILE = '不能创建文件';
    const NOT_UPLOAD = "上传失败";
    const FILE_TOO_BIG = '上传资源过大!图片最大为2m';
    public $imageType = array('image/gif','image/jpeg','image/png','image/pjpeg');


    /*
    **  上传图片操作
     */
    public function upload()
    {
        //检查上传图片的资源
        $this->checkImage($_FILES['file']);
        //进行上传图片的重组，以及重新命名和重新放置
        return $this->moveImages($_FILES['file']);
    }

    /*
    **  进行上传图片的重组，以及重新命名和重新放置
     */
    public function moveImages($params)
    {
        //获取图片的后缀名
        $imageArray = explode('.',$params['name']);
        $type = end($imageArray);
        //重新生成图片名字
        $imageName = md5 (uniqid(rand (),true));
        $imageDir = date('Y/m/s/H/i/s/',time());

        $thisImagePath = $_SERVER['DOCUMENT_ROOT'].self::IMAGE_PATH.$imageDir;
        $thisImagePathName = $thisImagePath.$imageName.'.'.$type;
        //前端显示路径
        $showThisImagePath = 'http://'.$_SERVER['HTTP_HOST'].self::IMAGE_PATH.$imageDir.$imageName.'.'.$type;
        //print_r($_SERVER);exit;
        //echo $thisImagePath;exit;
        //创建新建的文件夹
        $this->create_dir($thisImagePath);

        if(move_uploaded_file($params['tmp_name'],$thisImagePathName))
        {
            //echo $thisImagePath;exit;
            $result = [
                'error' => '0',
                'data' => $showThisImagePath,
            ];
        }
        else
        {
            $result = [
                'error' => '4',
                'data' => self::NOT_UPLOAD,
            ];
        }

        //print_r($result);exit;
        return $result;

    }

     /** 
     * 创建文件夹 
     * @param String $dirName 文件夹路径名 
     */  
    public function create_dir($dirName, $recursive = 1,$mode=0777) 
    {  
        ! is_dir ( $dirName ) && mkdir ( $dirName,$mode,$recursive );  
    }



    /*
    **  上传的图片资源的判断
     */
    public  function checkImage($params)
    {
        //返回的信息
        $result = array();
        
        if($params['error'])
        {
            $result = [
                'error' => '2',
                'data' => $params['error'],
            ];
            return $result;
        }

        if(!in_array($params['type'],$this->imageType))
        {
            $result = [
                'error' => '1',
                'data' => self::NOT_TRUE_TYPE,
            ];
            return $result;
        }

        if($params['size']>2000)
        {
            $result = [
                'error' => '3',
                'data' => self::FILE_TOO_BIG,
            ];
            return $result;
        }
    }
    

    /*
    **  上传操作 tp5自身的方法
     */
    public function upload_tp5()
    {
        //print_r($_FILES);exit;
        //echo '111';exit;
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info)
        {
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename(); 
        }
        else
        {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }


}


?>
