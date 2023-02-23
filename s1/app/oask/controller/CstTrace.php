<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * CstLinkmanor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\controller;

/**
* 跟进列表管理-控制器
*/

class CstTrace extends OaskBase
{

    /**
     * 跟进列表列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        if(!empty($this->param['listtype'])){
            $this->assign('listtype', $this->param['listtype']);
        }else{
            $this->assign('listtype', 'selfson');
        }
        $this->common_data();
        return $this->fetch('show');
    }

    /**
     * 跟进列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicCstTrace->getWhere($this->param);
        $orderby = $this->logicCstTrace->getOrderby($this->param);
        $list = $this->logicCstTrace->getCstTraceList($where,'a.*,c.name as customer_name',$orderby);
        return $list;
    }


    /**
     * 跟进列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicCstTrace->cstTraceAdd($this->param));
        $this->common_data();
        return $this->fetch('add');
    }

    /**
     * 跟进列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicCstTrace->cstTraceEdit($this->param));

        $this->common_data();

        $info = $this->logicCstTrace->getCstTraceInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 跟进列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicCstTrace->cstTraceDel($where));
    }



    /**
     * 公共数据
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/6/20 0020
     */
    public function common_data(){
        $dict= $this->logicCstDict->getCstDictListTypeall();
        $this->assign('dict', $dict);

        $sys_user=$this->logicSysUser->getSysUserDeptSelfSon();
        $this->assign('sys_user', $sys_user);

        $customer_list = $this->logicCstCustomer->getCstCustomerSelect();
        $this->assign('customer_list', $customer_list);

        $status_list = $this->logicCstTrace->getStatus();
        $this->assign('status_list', $status_list);

        if(!empty($this->param['customer_id'])){
            $this->assign('customer_id', $this->param['customer_id']);
        }else{
            $this->assign('customer_id', '0');
        }


    }

    /**
     * 下载导出
     */
    public function download()
    {
        $where =$this->logicCstTrace->getWhere($this->param);
        if (!empty($this->param['openstatus'])) {
            $where['openstatus'] = ['=', $this->param['openstatus']];
        }
        $this->logicCstTrace->getCstTraceListDown($where);
    }

}
