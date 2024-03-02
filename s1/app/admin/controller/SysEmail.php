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
 * 系统消息
 */
class SysEmail extends AdminBase
{

    public function config()
    {
        IS_POST && $this->jump($this->logicSysEmail->setSysEmailConf($this->param));
        $config = $this->logicSysEmail->getSysEmailConf($this->param);
        $param = $this->logicSysEmail->getEmailParam();
        $this->assign('param', $param);
        $this->assign('info', $config);
        return $this->fetch('config');

    }

    public function send()
    {
        IS_POST && $this->jump($this->logicSysEmail->sendSysEmail($this->param));
        $this->assign('info', $this->param);
        return $this->fetch('send');

    }

    /**
     * 消息列表
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 消息列表
     */
    public function show_json()
    {
        $where = $this->logicSysEmail->getWhere($this->param);
        $list = $this->logicSysEmail->getSysEmailLogList($where);
        return $list;
    }

    public function del()
    {
        $this->jump($this->logicSysEmail->sysEmailLogDel($this->param));
    }


}
