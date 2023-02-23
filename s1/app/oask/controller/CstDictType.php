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
* 字典分类管理-控制器
*/

class CstDictType extends OaskBase
{

    /**
     * 字典分类列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 字典分类列表-》json数据
     * @return
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['title|intro'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        $list = $this->logicCstDictType->getCstDictTypeList($where);
        return $list;
    }


    /**
     * 字典分类添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicCstDictType->cstDictTypeAdd($this->param));

        return $this->fetch('add');
    }

    /**
     * 字典分类编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicCstDictType->cstDictTypeEdit($this->param));

        $info = $this->logicCstDictType->getCstDictTypeInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 字典分类删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicCstDictType->cstDictTypeDel($where));
    }

    /**
     * 禁用
     */
    public function set_visible()
    {
        $this->jump($this->logicOaskBase->setField('CstDictType', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicOaskBase->setSort('CstDictType', $this->param));
    }

}
