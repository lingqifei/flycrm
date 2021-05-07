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
        $where = [];
        if(!empty($this->param['keywords'])){
            $where['name|username|ip|url|describe']=['like','%'.$this->param['keywords'].'%'];
        }
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
