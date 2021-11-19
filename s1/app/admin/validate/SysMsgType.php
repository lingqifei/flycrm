<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

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
