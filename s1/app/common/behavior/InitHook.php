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


namespace app\common\behavior;

use think\Hook;

/**
 * 初始化钩子信息行为
 */
class InitHook
{

    /**
     * 行为入口
     */
    public function run()
    {
        
        $hook  = model(SYS_COMMON_DIR_NAME . SYS_DS_PROS . ucwords(SYS_HOOK_DIR_NAME));

        $list = auto_cache('hook_list', create_closure($hook, 'column', ['id,name,addon_list']));
        $addon_list=[];
        foreach ($list as $v) {
          $addon_list[$v['name']] = get_addon_class($v['addon_list']);  
        }
       Hook::import($addon_list);
    }
}