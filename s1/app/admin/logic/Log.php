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
