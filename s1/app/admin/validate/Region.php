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
 * 行政区域验证器
 */
class Region extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        
        'name'  => 'require',
        'sort'  => 'require|number',
    ];

    // 验证提示
    protected $message  =   [
        
        'name.require'    => '名称不能为空',
        'sort.require'    => '排序值不能为空',
        'sort.number'     => '排序值必须为数字',
    ];

    // 应用场景
    protected $scene = [
        
        'add'  =>  ['name', 'sort'],
        'edit' =>  ['name', 'sort'],
    ];
    
}
