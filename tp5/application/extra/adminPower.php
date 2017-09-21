<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 15:14:06
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-07-05 17:28:57
* @后台权限列表
*/


    return [
        'user' => [
            'power' => 'userList,userInfo,userEdit,userExit',
            'name' => '会员操作权限',
        ],
        'article' => [
            'power' => 'articleList,articleInfo',
            'name' => '文章操作权限',
        ],
        'adminAct' => [
            'power' => 'adminList,adminDis',
            'name' => '管理员操作权限',
        ],
    ];


?>
