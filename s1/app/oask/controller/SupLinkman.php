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
namespace app\oask\controller;

/**
* 供应商联系人列表管理-控制器
*/

class SupLinkman extends OaskBase
{

    /**
     * 供应商联系人列表列表=》模板
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
     * 供应商联系人列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicSupLinkman->getWhere($this->param);
        $orderby = $this->logicSupLinkman->getOrderby($this->param);
        $list = $this->logicSupLinkman->getSupLinkmanList($where,'a.*,s.name as supplier_name',$orderby);
        return $list;
    }


    /**
     * 供应商联系人列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicSupLinkman->supLinkmanAdd($this->param));

        if(!empty($this->param['supplier_id'])){
            $this->assign('supplier_id', $this->param['supplier_id']);
        }else{
            $this->assign('supplier_id', '0');
        }

        if(!empty($this->param['chance_id'])){
            $this->assign('chance_id', $this->param['chance_id']);
        }else{
            $this->assign('chance_id', '0');
        }

        $this->common_data();

        return $this->fetch('add');
    }

    /**
     * 供应商联系人列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicSupLinkman->supLinkmanEdit($this->param));

        $this->common_data();

        $info = $this->logicSupLinkman->getSupLinkmanInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 供应商联系人列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSupLinkman->supLinkmanDel($where));
    }


    /**
     * 公共数据
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/6/21 0021
     */
    public function common_data(){
        $dict= $this->logicCstDict->getCstDictListTypeall();
        $this->assign('dict', $dict);

        $sys_user=$this->logicSysUser->getSysUserDeptSelfSon();
        $this->assign('sys_user', $sys_user);

        $supplier_list = $this->logicSupSupplier->getSupSupplierSelect();
        $this->assign('supplier_list', $supplier_list);

        $linkman_list = $this->logicSupLinkman->getSupLinkmanSelect();
        $this->assign('linkman_list', $linkman_list);

    }

    /**
     * 下载导出
     */
    public function download()
    {
        $where =$this->logicSupLinkman->getWhere($this->param);
        if (!empty($this->param['openstatus'])) {
            $where['openstatus'] = ['=', $this->param['openstatus']];
        }
        $this->logicSupLinkman->getSupLinkmanListDown($where);
    }

    /**
     * 上传
     */
    public function upload()
    {
        $this->jump([RESULT_SUCCESS,'功能开发中~~']);
    }

    /**
     * 发短信
     */
    public function sendsms()
    {
        $this->jump([RESULT_SUCCESS,'功能开发中~~']);
    }

}
