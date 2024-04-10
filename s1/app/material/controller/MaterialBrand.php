<?php
/*
*
* 零起飞企业管理系统（07FLY-ESM）
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
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
* 品牌列表管理-控制器
*/

class MaterialBrand extends MaterialBase
{
    /**
     * 品牌列表列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 品牌列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicMaterialBrand->getWhere($this->param);
        $orderby = $this->logicMaterialBrand->getOrderby($this->param);
        $list = $this->logicMaterialBrand->getMaterialBrandList($where,true,$orderby);
        return $list;
    }


    /**
     * 品牌列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicMaterialBrand->materialBrandAdd($this->param));

        return $this->fetch('add');
    }

    /**
     * 品牌列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicMaterialBrand->materialBrandEdit($this->param));

        $info = $this->logicMaterialBrand->getMaterialBrandInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 品牌列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicMaterialBrand->materialBrandDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicMaterialBase->setField('MaterialBrand', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicMaterialBase->setSort('MaterialBrand', $this->param));
    }

    /**
     * 品牌列表列表=》模板=》查找带回
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
