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

namespace app\oask\validate;

/**
 * 会议=》验证器
 */
class Meeting extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'host_user_id'      => 'require',
        'address'      => 'require',
        'status'      => 'require',
        'begin_time'      => 'require',
        'end_time'      => 'require',
        'remark'      => 'require',

    ];

    // 验证提示
    protected $message  =   [
        'name.require'      => '会议主题不能为空',
        'host_user_id.require'      => '会议主持人不能为空',
        'address.require'      => '会议地址不能为空',
        'status.require'      => '会议状态不能为空',
        'begin_time.require'      => '会议开始时间不能为空',
        'end_time.require'      => '会议结束时间不能为空',

	];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','host_user_id','address','begin_time','end_time','status'],
        'edit'       =>  ['name','host_user_id','address','begin_time','end_time','status'],
    ];

}
