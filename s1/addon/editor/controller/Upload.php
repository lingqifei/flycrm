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
