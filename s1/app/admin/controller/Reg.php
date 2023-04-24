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

use app\common\controller\ControllerBase;

/**
 * 注册控制器
 */
class Reg extends ControllerBase
{
    
    /**
     * 注册
     */
    public function reg()
    {
        IS_POST && $this->jump($this->logicReg->regHandle($this->param));

        // 关闭布局
        $this->view->engine->layout(false);

        return $this->fetch('reg');
    }
    
}
