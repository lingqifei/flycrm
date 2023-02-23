<?php
/*
*
* oa.workflow  oa系统-频道模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\oask\controller;

/**
 * 请示申请管理-控制器
 */
class Workflow extends OaskBase
{

    /**
     * 请示申请列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        if (!empty($this->param['listtype'])) {
            $this->assign('listtype', $this->param['listtype']);
        } else {
            $this->assign('listtype', 'self_create');
        }
        $this->common_data();
        return $this->fetch('show');
    }

    /**
     * 请示申请列表-》json数据
     * @return
     */
    public function show_json()
    {
        $where = [];
        $where = $this->logicWorkflow->getWhere($this->param);
        $list = $this->logicWorkflow->getWorkflowList($where);
        return $list;
    }


    /**
     * 请示申请添加
     * @return mixed|string
     */
    public function add()
    {
        IS_POST && $this->jump($this->logicWorkflow->workflowAdd($this->param));
        $this->common_data();
        return $this->fetch('add');
    }

    /**
     * 请示申请编辑
     * @return mixed|string
     */

    public function edit()
    {
        IS_POST && $this->jump($this->logicWorkflow->workflowEdit($this->param));
        $info = $this->logicWorkflow->getWorkflowInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        $this->common_data();
        return $this->fetch('edit');
    }

    /**
     * 请示申请删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicWorkflow->workflowDel($where));
    }

    /**
     * 详细
     * @return mixed|string
     */

    public function detail()
    {
        $info = $this->logicWorkflow->getWorkflowInfo(['id' => $this->param['id']]);
        $workflow=$this->logicWorkflowDeal->getWorkflowDealList(['workflow_id' => $this->param['id']],'','',false);
        $this->assign('info', $info);
        $this->assign('workflow', $workflow);
        $this->common_data();
        return $this->fetch('detail');
    }

    /**
     * 提交审批
     */
    public function audit_send()
    {
        $this->jump($this->logicWorkflow->setWorkflowAuditSend($this->param));
    }

    /**
     * 取消审核
     */
    public function audit_cancel()
    {
        $this->jump($this->logicWorkflow->setWorkflowCancel($this->param));
    }


    /**
     * 公共数据
     * Author: lingqifei created by at 2020/6/15 0015
     */
    public function common_data()
    {
        $sys_user = $this->logicSysUser->getSysUserList('','','',false);
        $this->assign('sys_user_list', $sys_user);
        $this->assign('sys_user_id', SYS_USER_ID);

        $level_list = $this->logicWorkflow->getLevel();
        $this->assign('level_list', $level_list);

        $status_list = $this->logicWorkflow->getStatus();
        $this->assign('status_list', $status_list);
    }

}
