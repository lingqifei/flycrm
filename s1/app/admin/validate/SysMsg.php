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
class SysMsg extends AdminBase
{

    // 验证规则
    protected $rule =   [


        'deal_time'      => 'require',
        'bus_name'        => 'require',
    ];

    // 验证提示
    protected $message  =   [

        'bus_name.require'      => '内容不能为空',
        'deal_time.unique'       => '提醒时间不能为空',

    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['bus_name','deal_time'],
        'edit'       =>  ['bus_name','deal_time'],
    ];
    
}
