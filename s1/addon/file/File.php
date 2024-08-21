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
        if (empty($param['addons_model'])) {
            $param['addons_model'] = 'admin';
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
        return ['name' => 'File', 'title' => '文件上传', 'describe' => '文件上传插件', 'author' => 'niaomuniao', 'version' => '1.0'];
    }

    /**
     * 插件配置信息
     */
    public function addonConfig($param)
    {
        $addons_config['maxwidth'] = '150px';
        $addons_config['height'] = '85px';

        //图片类型
        $imgsTypes = array('img', 'imgs', 'imgpath');
        //判断上传类型,判断是否是图片类型
        if (in_array($param['type'], $imgsTypes)) {
            $addons_config['allow_postfix'] = '*.jpg; *.png; *.gif; *.jpeg; *.JPG; *.PNG; *.GIF; *.JPEG;';
        } else {
            $addons_config['allow_postfix'] = '*.jpg; *.png; *.gif; *.jpeg; *.JPG; *.PNG; *.GIF; *.JPEG; *.zip; *.rar; *.tar; *.gz; *.7z; *.doc; *.docx; *.txt; *.xml; *.xlsx; *.xls;*.mp4;*.pdf;';
        }
        //配置上传地址
        //1、模板指定了固定的地址
        //2、模板没有指定地址，则自动判断,默认为
        if (!empty($param['url'])) {

            $addons_config['upload_url'] = url($param['url'], array('session_id' => session_id()));

        } else {
            //自动判断,默认为admin
            $model = empty($param['addons_model']) ? 'admin' : $param['addons_model'];

            //判断上传类型,判断是否是图片类型,还是文件上传
            if (in_array($param['type'], $imgsTypes)) {
                $methodName = 'pictureUpload';
            } else {
                $methodName = 'fileUpload';
            }
            $addons_config['upload_url'] = url($model . '/File/' . $methodName, array('session_id' => session_id()));
        }
        //配置上传大小
        $addons_config['max_size'] = 50 * 1024;
        return $addons_config;
    }
}
