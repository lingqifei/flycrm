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

namespace addon\editor;

use app\common\controller\AddonBase;
use addon\AddonInterface;

/**
 * 富文本编辑器插件
 */
class Editor extends AddonBase implements AddonInterface
{
    
    /**
     * 实现钩子
     */
    public function ArticleEditor($param = [])
    {

        //指定模块
        if(empty($param['addons_model'])){
            $param['addons_model']='admin';
        }else{
            $param['addons_model']=$param['addons_model'];
        }

        //指定编辑类型
        if(empty($param['type'])){
            $param['type']='index';
        }else{
            $param['type']=$param['type'];
        }

        $this->assign('addons_data', $param);
        
        $this->assign('addons_config', $this->addonConfig($param));

        $this->fetch('index/' . $param['type']);
    }

    /**
     * 实现钩子
     */
    public function MarkdownEditor($param = [])
    {
        $this->assign('addons_data', $param);

        $this->assign('addons_config', $this->addonConfig($param));

        $this->fetch('index/markdown');
    }

    /**
     * 插件安装
     */
    public function addonInstall()
    {
        
        return [RESULT_SUCCESS, '安装成功'];
    }
    
    /**
     * 插件卸载
     */
    public function addonUninstall()
    {
        
        return [RESULT_SUCCESS, '卸载成功'];
    }
    
    /**
     * 插件基本信息
     */
    public function addonInfo()
    {
        
        return ['name' => 'Editor', 'title' => '文本编辑器', 'describe' => '富文本编辑器', 'author' => 'lingqifei', 'version' => '1.0'];
    }
    
    /**
     * 插件配置信息
     */
    public function addonConfig($param)
    {
        
        $addons_config['editor_height'] = '300px';
        $addons_config['editor_resize_type'] = 1;
        
        [$param];
        
        return $addons_config;
    }
}
