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

empty(STATIC_DOMAIN) ? $static = [] :  $static['__STATIC__'] = STATIC_DOMAIN . SYS_DS_PROS . SYS_STATIC_DIR_NAME;

//配置文件
return [
    
    // 视图输出字符串内容替换
    'view_replace_str' => $static,
    
    /* 存储驱动,若无需使用云存储则为空 */
    'storage_driver' => '',
    
    /* 模板布局配置 */
    'template'  =>  [
        'layout_on'     =>  true,
        'layout_name'   =>  'layout',
        'tpl_cache'     =>  false,
    ],
];
