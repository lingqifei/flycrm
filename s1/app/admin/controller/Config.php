<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 配置控制器
 */
class Config extends AdminBase
{

    /**
     * 系统设置
     */
    public function setting()
    {

        IS_POST && $this->jump($this->logicConfig->settingSave($this->param));

        $where = empty($this->param['group']) ? ['group' => 1] : ['group' => $this->param['group']];

        $this->getConfigCommonData();

        $this->assign('list', $this->logicConfig->getConfigListAll($where, true, 'sort', false));

        $this->assign('group', $where['group']);

        return $this->fetch('setting');
    }

    /**
     * 配置列表
     */
    public function configList()
    {

        $this->getConfigCommonData();

        $data = $this->logicConfig->getConfigListFilter($this->param);

        $this->assign('list', $data['list']);

        $this->assign('group', $data['group']);

        return $this->fetch('config_list');
    }

    /**
     * 配置列表=>数据
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['title|name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['group'])) {
            $where['group'] = ['=', $this->param['group']];
        }
        $data = $this->logicConfig->getConfigList($where);
        return $data;
    }

    /**
     * 获取通用数据
     */
    public function getConfigCommonData()
    {

        $config_group_list = parse_config_array('config_group_list');

        $config_type_list = parse_config_array('config_type_list');

        $this->assign('config_group_list', $config_group_list);

        $this->assign('config_type_list', $config_type_list);
    }

    /**
     * 配置添加
     */
    public function configAdd()
    {

        IS_POST && $this->jump($this->logicConfig->configAdd($this->param));

        $this->getConfigCommonData();

        !empty($this->param['group']) && $this->assign('info', ['group' => $this->param['group']]);

        return $this->fetch('config_add');
    }

    /**
     * 配置编辑
     */
    public function configEdit()
    {

        IS_POST && $this->jump($this->logicConfig->configEdit($this->param));

        $info = $this->logicConfig->getConfigInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        $this->getConfigCommonData();

        return $this->fetch('config_edit');
    }

    /**
     * 数据状态设置
     */
    public function configDel()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicConfig->configDel($where));
    }

    /**
     * 数据状态设置
     */
    public function set_visible()
    {

        $this->jump($this->logicAdminBase->setField('Config', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {

        $this->jump($this->logicAdminBase->setSort('Config', $this->param));
    }
}
