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
*/
namespace app\material\controller;

/**
* 商品分类管理-控制器
*/

class MaterialCategory extends MaterialBase
{

    /**
     * 商品分类列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 商品分类列表-》json数据
     * @return
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['pid'])) {
            //$ids=$this->logicSysDept->getDeptAllSon($this->param['pid']);
            $where['pid'] = ['in', $this->param['pid']];
        }else{
            $where['pid'] = ['in', '0'];
        }
        $list = $this->logicMaterialCategory->getMaterialCategoryList($where);
        return $list;
    }

    /**
     * 商品分类列表-》tree数据
     */
    public function get_list_tree()
    {
        $tree=$this->logicMaterialCategory->getMaterialCategoryListTree();
        return $tree;
    }

    /**
     * 商品分类添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicMaterialCategory->materialCategoryAdd($this->param));
        //获取菜单Select结构数据
        $type_select=$this->logicMaterialCategory->getMaterialCategoryTreeSelect();
        $this->assign('type_select', $type_select);

        if (!empty($this->param['id'])) {
            $this->assign('pid', $this->param['id']);
        }else{
            $this->assign('pid', '0');
        }
        return $this->fetch('add');
    }

    /**
     * 商品分类编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicMaterialCategory->materialCategoryEdit($this->param));

        $info = $this->logicMaterialCategory->getMaterialCategoryInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        //获取菜单Select结构数据
        $type_select=$this->logicMaterialCategory->getMaterialCategoryTreeSelect();
        $this->assign('type_select', $type_select);

        return $this->fetch('edit');
    }

    /**
     * 商品分类删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicMaterialCategory->materialCategoryDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicMaterialBase->setField('MaterialCategory', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicMaterialBase->setSort('MaterialCategory', $this->param));
    }

}
