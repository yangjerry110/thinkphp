<?php
/* 
* @Author: yangjie-jerry
* @Date:   2017-05-17 10:40:15
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-05-19 15:43:24
*/

namespace app\Test\controller;
//use \think\View;
use think\Controller;
use think\Validate;
/**
* 
*/
class TestNew extends Controller
{
    
    public function index()
    {
        //$view = new View();
        //$this->name = 'Jerrt Yang';
        $data['name'] = 'Jerry Yang';
        return $this->fetch('index',$data);
    }

    public function testAjax()
    {
        $validate = new Validate([
            'fullName' => 'require|max:5',
            'userName' => 'require|max:5',
            'userPhone' => 'require|regex:^1[34578]\d{9}$',
            'userEmail' => 'require|email',
        ]);

        $data = [
            'fullName' => input('fullName'),
            'userName' => input('userName'),
            'userPhone' => input('userPhone'),
            'userEmail' => input('userEmail'),
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
                'data' => '恭喜您成功注册',
            ];
        }

        return $result;

    }
}
?>
