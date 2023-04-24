<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\validate;

/**
 * 系统公告管理=》验证器
 */
class OaNotify extends AdminBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'content'      => 'require',

    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '标题不能为空',
        'content.require'      => '内容不能为空',
    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','content'],
        'edit'       =>  ['name','content'],
    ];

}
