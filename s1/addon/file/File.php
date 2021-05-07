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
namespace addon\file;

use app\common\controller\AddonBase;
use addon\AddonInterface;

/**
 * 文件上传插件
 */
class File extends AddonBase implements AddonInterface
{

    /**
     * 实现钩子
     */
    public function File($param = [])
    {
        if(empty($param['addons_model'])){
            $param['addons_model']='admin';
        }else{
            $param['addons_model']=$param['addons_model'];
        }
        $this->assign('addons_data', $param);

        $this->assign('addons_config', $this->addonConfig($param));

        $this->fetch('index/' . $param['type']);
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

        return ['name' => 'File', 'title' => '文件上传', 'describe' => '文件上传插件', 'author' => 'Jack', 'version' => '1.0'];
    }

    /**
     * 插件配置信息
     */
    public function addonConfig($param)
    {

        $addons_config['maxwidth'] = '150px';
        $addons_config['height'] = '85px';

        $addons_config['allow_postfix'] = $param['type'] == 'img' ? '*.jpg; *.png; *.gif;' : '*.jpg; *.png; *.gif; *.zip; *.rar; *.tar; *.gz; *.7z; *.doc; *.docx; *.txt; *.xml; *.xlsx; *.xls;*.mp4;';

        $addons_config['max_size'] = 50 * 1024;

        return $addons_config;
    }
}
