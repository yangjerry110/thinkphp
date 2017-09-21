<?php
/* 
* @Author: Jerry Yang
* @Date:   2017-06-01 15:10:33
* @Last Modified by:   Jerry Yang
* @Last Modified time: 2017-07-04 13:58:42
* @配置后台菜单
*/



    return [
        'user' => [
            'list' => [
                 'userList' => '会员列表',
                 'userInfo' => '会员详情',
                 'userEdit' => '会员信息修改',
                 'userExit' => '会员退出',
            ],
            'name' => '会员操作',
        ],
        'article' => [
            'list' => [
                'articleList' => '文章列表',
                'articleInfo' => '文章详情',
            ],
            'name' => '文章操作',
        ],
        'admin' => [
            'list' => [
                'adminList' => '管理员列表',
                'adminDis' => '分配管理员权限',
            ],
            'name' => '管理员操作',
        ],
    ];


?>
