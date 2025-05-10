<?php
/*
* [modulename].controller  控制器
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @Copyright Copyright (C) 2017-2025 07FLY Network Technology Co,LTD.
* @License For licensing, see LICENSE.html
* @Author ：kfrs <goodkfrs@QQ.com> 574249366
* @Version ：1.1.0
* @Link ：http://www.07fly.xyz
* @Date:[datetime]
*/

namespace app\[spacename]\controller;

use app\common\controller\ControllerBase;

/**
 * 模块基类
 */
class Index extends [ModuleBase]
{
    /**
     * 模块首页
     */
    public function index()
    {
        $info = "it is work!";
        $this->assign('info', $info);
        return $this->fetch('index');
    }
    public function add()
    {
        IS_POST && $this->jump($this->logicIndex->indexAdd($this->param));
        return $this->fetch('add');
    }
    public function edit()
    {
        IS_POST && $this->jump($this->logicIndex->sysUserEdit($this->param));
        $info = $this->logicIndex->getIndexInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        return $this->fetch('edit');
    }
    public function del()
    {
        $this->jump($this->logicIndex->indexDel($this->param));
    }
}

?>