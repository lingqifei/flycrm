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
 * 广告管理=》验证器
 */
class CstDictType extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'typetag'      => 'require|unique:cst_dict_type',

    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '名称不能为空',
        'typetag.require'      => '分类标识不能为空',
        'typetag.unique'      => '分类标识已存在',
    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','typetag'],
        'edit'       =>  ['name','typetag'],
    ];
    
}
