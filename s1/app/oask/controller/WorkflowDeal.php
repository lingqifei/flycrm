<?php
/*
*
* oa.workflowDeal  oa系统-频道模型
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
class WorkflowDeal extends OaskBase
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
        $where = $this->logicWorkflowDeal->getWhere($this->param);
        $list = $this->logicWorkflowDeal->getWorkflowDealListPage($where);
        return $list;
    }

    /**
     * 审批详细
     */
    public function approval()
    {
        IS_POST && $this->jump($this->logicWorkflowDeal->workflowDealApproval($this->param));

        $wfinfo = $this->logicWorkflowDeal->getWorkflowDealInfo(['id' => $this->param['id']]);//当前流程
		$info = $this->logicWorkflow->getWorkflowInfo(['id' => $wfinfo['workflow_id']]);//工作流程
		$workflow=$this->logicWorkflowDeal->getWorkflowDealList(['workflow_id' => $wfinfo['workflow_id']],'','',false);

        $this->assign('info', $info);//业务信息
        $this->assign('wfinfo', $wfinfo);//业务审核信息
        $this->assign('workflow', $workflow);//所有流程记录

        $this->common_data();
        return $this->fetch('approval');
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

        $status_list = $this->logicWorkflowDeal->getStatus();
        $this->assign('status_list', $status_list);
    }

}
