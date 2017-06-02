<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 15:14:06
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-06-02 15:00:15
* @后台权限列表
*/


    return [
        'user' => [
            'power' => 'userList,userInfo,userEdit',
            'name' => '会员操作权限',
        ],
        'article' => [
            'power' => 'articleList,articleInfo',
            'name' => '文章操作权限',
        ],
    ];


?>
