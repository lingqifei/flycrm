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
class MetRoom extends MeetingBase
{
    // 验证规则
    protected $rule = [

        'name' => 'require',
        'nums' => 'require|number',
        'address' => 'require',

    ];

    // 验证提示
    protected $message = [

        'name.require' => '名称不能为空',
        'nums.require' => '可容纳人数不能为空',
        'nums.number' => '可容纳人数必须为数字',
        'address.require' => '地点不能为空',
    ];

    // 应用场景
    protected $scene = [

        'add' => ['name', 'nums', 'address'],
        'edit' => ['name', 'nums', 'address'],
    ];
}

?>