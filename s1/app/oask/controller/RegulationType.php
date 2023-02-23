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
* 规章制度分类管理-控制器
*/

class RegulationType extends OaskBase
{

    /**
     * 规章制度分类列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        if (!empty($this->param['listtype'])) {
            $tree=$this->logicRegulationType->getRegulationTypeListTree();
            return  $tree;
        }
        return $this->fetch('show');
    }

    /**
     * 规章制度分类列表-》json数据
     * @return
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['title|intro'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['pid'])) {
            //$ids=$this->logicSysDept->getDeptAllSon($this->param['pid']);
            $where['pid'] = ['in', $this->param['pid']];
        }else{
            $where['pid'] = ['in', '0'];
        }
        $list = $this->logicRegulationType->getRegulationTypeList($where);
        return $list;
    }

    /**
     * 规章制度分类列表-》tree数据
     */
    public function get_list_tree()
    {
        $tree=$this->logicRegulationType->getRegulationTypeListTree();
        return $tree;
    }

    /**
     * 规章制度分类添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicRegulationType->regulationTypeAdd($this->param));
        //获取菜单Select结构数据
        $type_select=$this->logicRegulationType->getRegulationTypeTreeSelect();
        $this->assign('type_select', $type_select);

        if (!empty($this->param['id'])) {
            $this->assign('pid', $this->param['id']);
        }else{
            $this->assign('pid', '0');
        }
        return $this->fetch('add');
    }

    /**
     * 规章制度分类编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicRegulationType->regulationTypeEdit($this->param));

        $info = $this->logicRegulationType->getRegulationTypeInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        //获取菜单Select结构数据
        $type_select=$this->logicRegulationType->getRegulationTypeTreeSelect();
        $this->assign('type_select', $type_select);

        return $this->fetch('edit');
    }

    /**
     * 规章制度分类删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicRegulationType->regulationTypeDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicOaskBase->setField('RegulationType', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicOaskBase->setSort('RegulationType', $this->param));
    }

}
