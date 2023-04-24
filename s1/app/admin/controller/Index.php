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
 * 首页控制器
 */
class Index extends AdminBase
{

    /**
     * 管理首页方法
     */
    public function index()
    {
        $this->view->engine->layout(false);
        // 获取首页数据
        $index_data = $this->logicAdminBase->getIndexData();
        $this->assign('info', $index_data);
        return $this->fetch('index');
    }

    /**
     * 管理首页方法
     */
    public function main()
    {
        // 获取首页数据
        $index_data = $this->logicAdminBase->getIndexData();
        $this->assign('info', $index_data);
        return $this->fetch('main');
    }

}