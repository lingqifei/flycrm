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


namespace app\common\logic;

use think\Image;

/**
 * 文件上传处理逻辑
 */
class Upload extends LogicBase
{

    private $files_path = '';

    public function __construct()
    {
        $this->files_path = PATH_UPLOAD . 'files' . DS;
        !is_dir($this->files_path) && mkdir($this->files_path, 0755, true);
    }

    /**
     * 客户列表列上传=》上传文件到目录
     * @param array $data
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function uploadFile($data = [])
    {
        if (!empty($data['uploadfilefather'])) {
            $this->files_path = $this->files_path . $data['uploadfilefather'] . DS;
        }
        if (!empty($data['uploadfilepath'])) {
            $this->files_path = $this->files_path . $data['uploadfilepath'] . DS;
        }
        !is_dir($this->files_path) && mkdir($this->files_path, 0755, true);
        $object_info = request()->file('file');
        $object = $object_info->move($this->files_path, '');//保留原文件名 savename=‘’设置为空
        $object->getpathName();//保存路径
        return [RESULT_SUCCESS, '上传成功'];
    }

    /**
     * 上传目录文件列表=>获取目录文件
     * @param array $data
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function getUploadFile($data = [])
    {
        $result['data'] = [];
        if (!empty($data['uploadfilefather'])) {
            $this->files_path = $this->files_path . $data['uploadfilefather'] . DS;
        }
        if (!empty($data['uploadfilepath'])) {
            $this->files_path = $this->files_path . $data['uploadfilepath'] . DS;
        }
        //获取里面的文件包名
        $fp = new \lqf\Dir();
        $dirlist = $fp->listFile($this->files_path);//查看目录列表文件，必须是以斜杠结束

        foreach ($dirlist as $key => &$row) {
            $row['size'] = format_bytes($row['size']);
            $row['uptime'] = date("Y/m/d H:i:s", $row['mtime']);
        }
        $result['data'] = $dirlist;
        return $result;
    }

    /**
     * 上传目录文件列表=>删除目录文件
     * @param array $data
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function delUploadFile($data = [])
    {
        //按路径+文件名删除
        if (!empty($data['pathname'])) {
            if (file_exists($data['pathname'])) {
                unlink($data['pathname']);
            }
        }
        if (!empty($data['uploadfilefather'])) {
            $this->files_path = $this->files_path . $data['uploadfilefather'] . DS;
        }
        //按文件名删除
        if (!empty($data['uploadfilepath']) && !empty($data['basename'])) {
            $data['pathname'] = $this->files_path . $data['uploadfilepath'] . DS . $data['basename'];
            if (file_exists($data['pathname'])) {
                unlink($data['pathname']);
            }
        }
        return [RESULT_SUCCESS, '删除成功'];
    }


}
