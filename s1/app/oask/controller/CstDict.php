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
* 字典列表管理-控制器
*/

class CstDict extends OaskBase
{

    /**
     * 字典列表列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        $this->get_type_list();
        return $this->fetch('show');
    }

    /**
     * 字典列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicCstDict->getWhere($this->param);
        $orderby = $this->logicCstDict->getOrderby($this->param);
        $list = $this->logicCstDict->getCstDictList($where,true,$orderby);
        return $list;
    }


    /**
     * 字典列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicCstDict->cstDictAdd($this->param));

        $this->get_type_list();

        return $this->fetch('add');
    }

    /**
     * 字典列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicCstDict->cstDictEdit($this->param));

        $this->get_type_list();

        $info = $this->logicCstDict->getCstDictInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 字典列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicCstDict->cstDictDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicOaskBase->setField('CstDict', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicOaskBase->setSort('CstDict', $this->param));
    }


    public function get_type_list(){
        $type_list = $this->logicCstDictType->getCstDictTypeList('', '', 'sort asc',false);
        $this->assign('type_list', $type_list);
    }

}
