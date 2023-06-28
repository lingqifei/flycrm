<?php
/*
*
* meeting.validate  模型
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2025 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
* @link ：http://www.07fly.xyz
* @Date:2022-12-20 09:50:11
*/

namespace app\meeting\validate;

/**
 * 模块基类
 */
class MetSummary extends MeetingBase
{
    // 验证规则
    protected $rule = [
        'name' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'host_user_id' => 'require',
        'room_id' => 'require',
        'content' => 'require',
        'resolution' => 'require',

    ];

    // 验证提示
    protected $message = [
        'name.require' => '会议名称不能为空',
        'start_time.require' => '开始时间不能为空',
        'end_time.require' => '结束时间不能为空',
        'host_user_id.require' => '选择主持人员',
        'room_id.require' => '选择预订会议室',
        'content.require' => '会议内容不能为空',
        'resolution.require' => '会议决议不能为空',
    ];

    // 应用场景
    protected $scene = [
        'add' => ['name', 'start_time', 'end_time', 'host_user_id', 'room_id', 'content', 'resolution'],
        'edit' => ['name', 'start_time', 'end_time', 'host_user_id', 'room_id', 'content', 'resolution'],
    ];
}

?>