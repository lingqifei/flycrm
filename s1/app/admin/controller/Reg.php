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
