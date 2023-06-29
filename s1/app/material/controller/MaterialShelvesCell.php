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
 * 货架格断列表管理-控制器
 */
class MaterialShelvesCell extends MaterialBase
{

    /**
     * 构造方法
     */
    public function __construct()
    {
        // 执行父类构造方法
        parent::__construct();

        if (!empty($this->param['shelves_id'])) {
            $this->assign('shelves_id', $this->param['shelves_id']);
        } else {
            $this->assign('shelves_id', '0');
        }
        if (!empty($this->param['shelves_name'])) {
            $this->assign('shelves_name', $this->param['shelves_name']);
        } else {
            $this->assign('shelves_name', '');
        }
        if (!empty($this->param['shelves_code'])) {
            $this->assign('shelves_code', $this->param['shelves_code']);
        } else {
            $this->assign('shelves_code', '');
        }
    }

    /**
     * 货架格断列表列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 货架格断列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicMaterialShelvesCell->getWhere($this->param);
        $orderby = $this->logicMaterialShelvesCell->getOrderby($this->param);
        $list = $this->logicMaterialShelvesCell->getMaterialShelvesCellList($where, true, $orderby);
        return $list;
    }


    /**
     * 货架格断列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicMaterialShelvesCell->materialShelvesCellAdd($this->param));

        return $this->fetch('add');
    }

    /**
     * 货架格断列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicMaterialShelvesCell->materialShelvesCellEdit($this->param));

        $info = $this->logicMaterialShelvesCell->getMaterialShelvesCellInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 货架格断列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicMaterialShelvesCell->materialShelvesCellDel($this->param));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicMaterialBase->setField('MaterialShelvesCell', $this->param));
    }


}
