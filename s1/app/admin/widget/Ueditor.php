<?php
/*
ThinkPHP5.0+整合百度编辑器Ueditor1.4.3.3+
作者：符工@邦明
日期：西元二零一七年元月五日
网址：http://bbs.df81.com/
不要怀念哥，哥只是个搬运工
*/

namespace app\admin\widget;

use think\Controller;
use think\Image;
use think\Request;

class Ueditor extends WidgetBase
{
    /**
     * 构造方法
     */
    public function __construct()
    {

        // 执行父类构造方法
        parent::__construct();

        $this->view->engine->layout(true);

    }
    /**
     * 显示编辑器
     */
    public function index($name = '', $value = '')
    {

        $widget_config['editor_height'] = '300px';
        $widget_config['editor_resize_type'] = 1;

        $this->assign('widget_config', $widget_config);
        $this->assign('widget_data', compact('name', 'value'));

        return $this->fetch('admin@widget/ueditor/index');
    }
}
