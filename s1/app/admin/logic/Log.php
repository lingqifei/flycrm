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

namespace app\admin\logic;

/**
 * 行为日志逻辑
 */
class Log extends AdminBase
{
    
    /**
     * 获取日志列表
     */
    public function getLogList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {

        return $this->modelActionLog->getList($where, true, 'create_time desc',$paginate);
    }
  
    /**
     * 日志删除
     */
    public function logDel($where = [])
    {
        
        return $this->modelActionLog->deleteInfo($where,true) ? [RESULT_SUCCESS, '日志删除成功'] : [RESULT_ERROR, $this->modelActionLog->getError()];
    }
    
    /**
     * 日志添加
     */
    public function logAdd($name = '', $describe = '')
    {
        
        $sys_user_info = session('sys_user_info');
        $request = request();
        $data['sys_user_id'] = $sys_user_info['id'];
        $data['username']  = $sys_user_info['username'];
        $data['ip']        = $request->ip();
        $data['url']       = $request->url();
        $data['name']      = $name;
        $data['describe']  = $describe;
        $url = url('logList');
        $this->modelActionLog->is_update_cache_version = false;
        return $this->modelActionLog->setInfo($data) ? [RESULT_SUCCESS, '日志添加成功', $url] : [RESULT_ERROR, $this->modelActionLog->getError()];
    }
}
