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

namespace app\admin\controller\rpc;

use app\common\controller\ControllerBase;

/**
 * 计划任务执行脚本
 */
class CronJob extends ControllerBase
{

    /**
     * 后台页面插件提醒=》系统消息发送
     * index.html调用执行
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
//        $list['nums'] = count($list['data']);
        return $list;
    }

    /**
     * 后台页面插件提醒=》系统公告
     * index.html调用执行
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
//        $list['nums'] = count($list['data']);
        return $list;
    }

    /**
     * 定时任务=》扫描业务数提醒=》推送到系统消息中去
     * 调用执行：http://您的域名/admin/rpc.CronJob/sys_msg_scanbus
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/25 0025 14:48
     */
    public function sys_msg_scanbus()
    {
        $this->logicSysMsgType->sysMsgTypeScan();
    }

    /**
     * 定时任务=》系统消息发送
     * 调用执行：http://localhost/admin/rpc.CronJob/sys_msg_send
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/25 0025 14:48
     */
    public function sys_msg_send()
    {
        $this->logicSysMsg->sysMsgSend();
    }

    /**
     * 定时任务=》公告通知=》微信模板消息
     * 调用执行：http://localhost/admin/rpc.CronJob/notify_weixin
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
