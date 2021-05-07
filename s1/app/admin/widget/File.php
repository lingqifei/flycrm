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
 * 文件上传小物件
 */
class File extends WidgetBase
{

    /**
     * 显示文件上传视图
     */
    public function index($name = '', $value = '', $type = '')
    {

        $this->assign('widget_data', compact('name', 'value', 'type'));

        $widget_config['maxwidth'] = '150px';

        $widget_config['allow_postfix'] = $type == 'img' ? '*.jpg; *.png; *.gif;' : '*.jpg; *.png; *.gif; *.zip; *.rar; *.tar; *.gz; *.7z; *.doc; *.docx; *.txt; *.xml; *.xlsx; *.xls;*.mp4;';

        $widget_config['max_size'] = 50 * 1024;
        
        $this->assign('widget_config', $widget_config);

        return $this->fetch('admin@widget/file/' . $type);
    }
}
