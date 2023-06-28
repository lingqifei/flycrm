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

namespace app\admin\controller;

/**
 * 行为日志控制器
 */
class Log extends AdminBase
{
    
    /**
     * 日志列表
     */
    public function show()
    {
        
        $this->assign('list', $this->logicLog->getLogList());
        
        return $this->fetch('show');
    }

    /**
     * 日志列表
     */
    public function show_json()
    {
        $where = $this->logicLog->getWhere($this->param);
       return $this->logicLog->getLogList($where);

    }
  
    /**
     * 日志删除
     */
    public function del($id = 0)
    {
        
        $this->jump($this->logicLog->logDel(['id' => $id]));
    }
  
    /**
     * 日志清空
     */
    public function clear()
    {
        $where['id']=['>','0'];
        $this->jump($this->logicLog->logDel($where));
    }
}
