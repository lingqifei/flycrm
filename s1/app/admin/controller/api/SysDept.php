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

namespace app\admin\controller\api;

use app\admin\controller\api\AdminApiBase;

/**
 * 系统部门
 */
class SysDept extends AdminApiBase
{
    /**消息列表
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/7/23 0023 9:49
     */
    public function show_json(){
		$where = $this->logicSysMsg->getWhere($this->param['matchObj']);
        $orderby = $this->logicSysMsg->getOrderby($this->param['sortObj']);
		$list = $this->logicSysMsg->getSysMsgList($where,true,$orderby);
		return $this->apiReturn($list);
	}

    /**
     * 删除
     * @return mixed|string
     */
    public function del()
    {
        $result = $this->logicSysMsg->sysMsgDel(['id' => $this->param['req']['id']]);
        return $this->apiReturn($result);
    }

    /**
     * 数组列表
     */
    public function get_list_tree()
    {
        $tree=$this->logicSysDept->getSysDeptListTree();
        return $this->apiReturn($tree);
    }
}
