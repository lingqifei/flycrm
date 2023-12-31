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
 * 模块验证器
 */
class SysModule extends AdminBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require|unique:sys_module',
        'identifier'=> 'require|unique:sys_module',
    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '本地模块名不能为空',
        'name.unique'       => '本地模块名已存在',
    ];

    // 应用场景
    protected $scene = [
        'add'       =>  ['name'],
        'edit'      =>  ['name'],
    ];
    
}
