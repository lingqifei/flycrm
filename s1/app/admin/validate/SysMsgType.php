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
 * 系统消息验证器
 */
class SysMsgType extends AdminBase
{

    // 验证规则
    protected $rule =   [
        'name'      => 'require',
        'type'        => 'require|unique:sys_msg_type',
        'url'        => 'require',
        'hours'        => 'require',
    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '提醒类型名称不能为空',
        'type.require'       => '提醒类型标识不能为空',
        'type.unique'       => '提醒类型标识已经存在了',
        'url.require'       => '业务地址不能为空',
        'hours.require'       => '提醒提前时间不能为空',

    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','type','url','hours'],
        'edit'       =>  ['name','url','hours'],
    ];
    
}
