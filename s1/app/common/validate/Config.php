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

namespace app\common\validate;

/**
 * 配置验证器
 */
class Config extends ValidateBase
{
    
    // 验证规则
    protected $rule =   [
        'name'          => 'require|unique:config',
        'title'         => 'require',
    ];

    // 验证提示
    protected $message  =   [
        'name.require'         => '标识不能为空',
        'name.unique'          => '标识已经存在',
        'title.require'        => '名称不能为空',
    ];
}
