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
    public function delUploadFile($data=[])
    {

        if(!empty($data['pathname'])){
            if(file_exists($data['pathname'])){
                unlink($data['pathname']);
            }
        }
        return [RESULT_SUCCESS, '删除成功'];
    }

}
