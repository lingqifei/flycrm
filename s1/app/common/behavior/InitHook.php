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