<?php
/*
*
* 零起飞企业管理系统（07FLY-ESM）
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创板材 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD All rights reserved.
* @license    For licensing, see LICENSE.html
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
* @Date: 2023-02-06
*/
namespace app\material\controller;

/**
* 板材列表管理-控制器
*/

class MaterialBorad extends MaterialBase
{
    /**
     * 板材列表列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 板材列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicMaterialBorad->getWhere($this->param);
        $orderby = $this->logicMaterialBorad->getOrderby($this->param);
        $list = $this->logicMaterialBorad->getMaterialBoradList($where,true,$orderby);
        return $list;
    }


    /**
     * 板材列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicMaterialBorad->materialBoradAdd($this->param));

        return $this->fetch('add');
    }

    /**
     * 板材列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicMaterialBorad->materialBoradEdit($this->param));

        $info = $this->logicMaterialBorad->getMaterialBoradInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 板材=》锁定
     */
    public function lock()
    {
        $this->param['use_status']=2;//锁定
        $this->jump($this->logicMaterialBorad->materialBoradUptStatus($this->param));
    }

    /**
     * 板材=》使用
     */
    public function used()
    {
        $this->param['use_status']=3;//使用
        $this->jump($this->logicMaterialBorad->materialBoradUptStatus($this->param));
    }

    /**
     * 板材=》废掉
     */
    public function discard()
    {
        $this->param['use_status']=4;//废掉
        $this->jump($this->logicMaterialBorad->materialBoradUptStatus($this->param));
    }

    /**
     * 板材列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicMaterialBorad->materialBoradDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicMaterialBase->setField('MaterialBorad', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicMaterialBase->setSort('MaterialBorad', $this->param));
    }

    /**
     * 板材列表列表=》模板=》查找带回
     * @return mixed|string
     */
    public function lookup()
    {
        if (!empty($this->param['type'])) {
            $this->assign('type', $this->param['type']);
        }else{
            $this->assign('type', 'purchase');
        }
        if (!empty($this->param['group'])) {
            $this->assign('group', $this->param['type']);
        }else{
            $this->assign('group', 'lookup-group');
        }
        return $this->fetch('lookup');
    }

}
