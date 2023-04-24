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

namespace app\common\logic;

/**
 * 菜单逻辑
 */
class SysMenu extends LogicBase
{
    /**
     * 获取菜单列表
     */
    public function getSysMenuList($where = [], $field = true, $order = '', $paginate = false)
    {
        $where['org_id'] = ['>',0];
        return $this->modelSysMenu->getList($where, $field, $order, $paginate);
    }
}
