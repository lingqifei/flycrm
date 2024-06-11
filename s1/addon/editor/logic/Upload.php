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

namespace addon\editor\logic;

use app\common\logic\File as LogicFile;
use think\Image;

/**
 * 编辑器插件上传逻辑
 */
class Upload
{

    /**
     * 图片上传
     */
    public function pictureUpload()
    {
        $fileLogic = get_sington_object('fileLogic', LogicFile::class);

        $result = $fileLogic->pictureUpload('imgFile');

        if (false === $result) : return [RESULT_ERROR => DATA_NORMAL, RESULT_MESSAGE => '文件上传失败']; endif;

        $url = get_picture_url($result['id']);

        return [RESULT_ERROR => DATA_DISABLE, RESULT_URL => $url];
    }

    /**
     * 图片上传=>Editormd
     */
    public function pictureUploadEditormd()
    {

        $fileLogic = get_sington_object('fileLogic', LogicFile::class);

        $result = $fileLogic->pictureUpload('editormd-image-file');

        if (false === $result) {
            $data['success'] = 0;
            $data['message'] = '上传失败';
            $data['url'] = '';
        } else {
            $url = get_picture_url($result['id']);
            $data['success'] = 1;
            $data['message'] = '上传成功';
            $data['url'] = $url;
        }
        return $data;
    }
}
