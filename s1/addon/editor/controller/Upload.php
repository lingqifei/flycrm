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

namespace addon\editor\controller;

use app\common\controller\AddonBase;

use addon\editor\logic\Upload as LogicUpload;

/**
 * 编辑器插件上传控制器
 */
class Upload extends AddonBase
{

    /**
     * 图片上传
     */
    public function pictureUpload()
    {
        
        $UploadLogic = new LogicUpload();
        
        $result = $UploadLogic->pictureUpload();
        
        return throw_response_exception($result);
    }

    /**
     * 图片上传=.editormd
     */
    public function pictureUploadEditormd()
    {

        $UploadLogic = new LogicUpload();

        $result = $UploadLogic->pictureUploadEditormd();

        return throw_response_exception($result);
    }

}
