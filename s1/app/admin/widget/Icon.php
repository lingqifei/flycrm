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

namespace app\admin\widget;

/**
 * 小图标选择小物件
 */
class Icon extends WidgetBase
{

    /**
     * 显示小图标选择视图
     */
    public function index($name = '', $value = '')
    {
        
        $this->assign('widget_data', compact('name', 'value'));

        return $this->fetch('admin@widget/icon/index');
    }
}
