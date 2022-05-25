<?php
/*
*
* crm.rpc.RpcBase  crm内部接口 = 客户管理
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.net/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\admin\controller\rpc;

use app\common\controller\ControllerBase;

/**
 * 计划任务执行脚本
 */
class CronJob extends ControllerBase
{

    /**系统消息发送=>插件提醒
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/19 0019 17:43
     */
    public function sys_msg_plug()
    {
        $where['deal_status'] = 0;//未处理
        $where['remind_sys'] = 1;//需要系统插件
        $where['deal_user_id'] = $this->param['deal_user_id'];//当前登录人
        $where = $this->logicSysMsg->getWhere($where);
        $list['data'] = $this->logicSysMsg->getSysMsgList($where, '', 'id asc', false);
        return $list;
    }

    /**系统公告=>插件提醒
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/19 0019 17:43
     */
    public function oa_notify_plug()
    {
        //转入的id标记已经读
        if (!empty($this->param['id'])) {
            $this->logicOaNotifyUser->oaNotifyUserRead($this->param);
            $info = $this->logicOaNotifyUser->getOaNotifyUserInfo(['a.id' => $this->param['id']]);
            $this->assign('info', $info);
            return $this->fetch('oa_notify_user/detail');
        }
        $where['read_state'] = 0;//未读
        $where['owner_user_id'] = $this->param['owner_user_id'];//当前登录人
        $list['data'] = $this->logicOaNotifyUser->getOaNotifyUserList($where, 'a.*,n.name,n.create_user_id', '', false);
        return $list;
    }

    /**扫描业务数据，根据条件创建添加到系统消息
     * 调用执行：http://localhost/admin/rpc.CronJob/sys_msg_scanbus
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/25 0025 14:48
     */
    public function sys_msg_scanbus()
    {
        $this->logicSysMsgType->sysMsgTypeScan();
    }

    /**公告通知=》微信模板消息
     * 调用执行：http://localhost/admin/rpc.CronJob/sys_msg_scanbus
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/19 0019 17:43
     */
    public function notify_weixin()
    {
        $where['a.read_state'] = 0;
        $list = $this->logicOaNotifyUser->getOaNotifyUserList($where, 'a.*,n.name,n.content,n.create_user_id', 'a.id desc', false);
        foreach ($list as $row) {
            $this->logicOaNotifyUser->send_weixin_msg($row);
        }
    }
}
