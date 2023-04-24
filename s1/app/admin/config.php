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

empty(STATIC_DOMAIN) ? $static = [] :  $static['__STATIC__'] = STATIC_DOMAIN . SYS_DS_PROS . SYS_STATIC_DIR_NAME;

//配置文件
return [
    
    // 视图输出字符串内容替换
    'view_replace_str' => $static,
    
    /* 存储驱动,若无需使用云存储则为空 */
    'storage_driver' => "",

	/* 不需要权限控制方法 */
	'allow_url_diy'=>'admin/SysMsgType/scanbus;admin/SysUser/lookup;',

    /* 模板布局配置 */
    'template'  =>  [
        'layout_on'     =>  true,
        'layout_name'   =>  'layout',
        'tpl_cache'     =>  false,
    ],

];
