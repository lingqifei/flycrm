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
 * 文件处理逻辑
 */
class File extends LogicBase
{

    /**
     * 图片上传
     * small,medium,big
     */
    public function pictureUpload($name = 'file', $thumb_config = ['small' => 100, 'medium' => 500, 'big' => 1000])
    {

        $object_info = request()->file($name);
        //没有文件上传
        if (empty($object_info)) {
            return false;
        }

        $sha1 = $object_info->hash();
        $picture_info = $this->modelPicture->getInfo(['sha1' => $sha1], 'id,name,path,sha1');
        if (!empty($picture_info)) {
            return $picture_info;
        }
        //*****************为兼容复制图片上传***********************************
        // 如果文件没有后缀，尝试从文件内容推测MIME类型并附加一个合适的后缀
        // 目的是为兼容复制图片上传
        if ($object_info->getExtension() == 'tmp') {
            // 根据文件MIME类型添加后缀，这里只是一个示例，实际中需要确保MIME类型判断准确
            $mime = $object_info->getInfo('type');
            switch ($mime) {
                case 'image/jpeg':
                    $extension = '.jpg';
                    break;
                case 'image/png':
                    $extension = '.png';
                    break;
                case 'image/gif':
                    $extension = '.gif';
                    break;
                // 其他情况...
                default:
                    // 如果无法确定，可以拒绝上传或设定一个默认后缀
                    $extension = '.unknown';
            }
            // 更新文件名以包含后缀
            $filenameWithExt = date('Ymd') . DS . uniqid() . $extension;
        } else {
            $filenameWithExt = date('Ymd') . DS . uniqid();
        }
        //*****************为兼容复制图片上传***********************************

        // 尝试移动文件并保存到指定目录
        $object = $object_info->move(PATH_PICTURE, $filenameWithExt, true);
        $save_name = $object->getSaveName();
        $save_path = PATH_PICTURE . $save_name;
        $picture_dir_name = substr($save_name, 0, strrpos($save_name, DS));
        $filename = $object->getFilename();

        //缩略图生成
        $thumb_dir_path = PATH_PICTURE . $picture_dir_name . DS . 'thumb';
        !file_exists($thumb_dir_path) && @mkdir($thumb_dir_path, 0777, true);
        Image::open($save_path)->thumb($thumb_config['small'], $thumb_config['small'])->save($thumb_dir_path . DS . 'small_' . $filename);
        Image::open($save_path)->thumb($thumb_config['medium'], $thumb_config['medium'])->save($thumb_dir_path . DS . 'medium_' . $filename);
        Image::open($save_path)->thumb($thumb_config['big'], $thumb_config['big'])->save($thumb_dir_path . DS . 'big_' . $filename);

        $data = ['name' => $filename, 'path' => $picture_dir_name . SYS_DS_PROS . $filename, 'sha1' => $sha1];
        $result = $this->modelPicture->setInfo($data);

        unset($object);

        $url = $this->checkStorage($result);
        if ($result) {
            $data['id'] = $result;
            $url && $data['url'] = $url;
            return $data;
        }
        return false;
    }


    /**
     * 图片上传
     * small,medium,big
     */
    public function pictureUploadEditor($name = 'file', $thumb_config = ['small' => 100, 'medium' => 500, 'big' => 1000])
    {

        $object_info = request()->file($name);

        $sha1 = $object_info->hash();

        $picture_info = $this->modelPicture->getInfo(['sha1' => $sha1], 'id,name,path,sha1');

        if (!empty($picture_info)) {
            return $picture_info;
        }

        $object = $object_info->move(PATH_PICTURE);

        $save_name = $object->getSaveName();
        $save_path = PATH_PICTURE . $save_name;

        $picture_dir_name = substr($save_name, 0, strrpos($save_name, DS));
        $filename = $object->getFilename();

        //生成水印
        $water_img = PATH_UPLOAD . 'water' . DS . 'logo.png';
        Image::open($save_path)->water($water_img, \think\Image::WATER_CENTER)->save($save_path);

        //保存数据库
        $data = ['name' => $filename, 'path' => $picture_dir_name . SYS_DS_PROS . $filename, 'sha1' => $sha1];
        $result = $this->modelPicture->setInfo($data);
        unset($object);

        $url = $this->checkStorage($result);
        if ($result) {
            $data['id'] = $result;
            $url && $data['url'] = $url;
            return $data;
        }

        return false;
    }

    /**
     * 文件上传
     */
    public function fileUpload($name = 'file')
    {

        $object_info = request()->file($name);

        $sha1 = $object_info->hash();

        $file_info = $this->modelFile->getInfo(['sha1' => $sha1], 'id,name,path,sha1');

        if (!empty($file_info)) {

            return $file_info;
        }

        $object = $object_info->move(PATH_FILE);

        $save_name = $object->getSaveName();

        $file_dir_name = substr($save_name, 0, strrpos($save_name, DS));

        $filename = $object->getFilename();

        $data = ['name' => $filename, 'path' => $file_dir_name . SYS_DS_PROS . $filename, 'sha1' => $sha1];

        $result = $this->modelFile->setInfo($data);

        unset($object);

        $url = $this->checkStorage($result, 'uploadFile');

        if ($result) {

            $data['id'] = $result;

            $url && $data['url'] = $url;

            return $data;
        }

        return false;
    }

    /**
     * 云存储
     */
    public function checkStorage($result = 0, $method = 'uploadPicture')
    {

        $storage_driver = config('storage_driver');

        if (empty($storage_driver)) {

            return false;
        }

        $driver = SYS_DRIVER_DIR_NAME . $storage_driver;

        $storage_result = $this->serviceStorage->$driver->$method($result);

        $method != 'uploadPicture' ? $this->modelFile->setFieldValue(['id' => $result], 'url', $storage_result) : $this->modelPicture->setFieldValue(['id' => $result], 'url', $storage_result);

        return $storage_result;
    }

    /**
     * 获取图片URL路径
     */
    public function getPictureUrl($id = 0, $model = 'picture')
    {
        switch ($model) {
            case "portalmember":
                $info = $this->modelMemberPicture->getInfo(['id' => $id], 'path,url');
                break;
            default :
                $info = $this->modelPicture->getInfo(['id' => $id], 'path,url');
        }
        //设置了静态地址
        if (!empty($info['url'])) {
            return config('static_domain') . SYS_DS_PROS . $info['url'];
        }

        //得到根地址
        $root_url = get_file_root_path();
        if (!empty($info['path'])) {
            return $root_url . 'upload/picture/' . $info['path'];

        }
        return $root_url . 'static/module/admin/img/onimg.png';
    }

    /**
     * 获取图片URL路径
     */
    public function getPictureWebUrl($path = '')
    {
        $root_url = get_file_root_path();
        if (!empty($path)) {
            return $root_url . 'upload/picture/' . $path;
        }
        return $root_url . 'static/module/admin/img/onimg.png';
    }

    /**
     * 获取文件URL路径
     */
    public function getFileUrl($id = 0)
    {

        $info = $this->modelFile->getInfo(['id' => $id], 'path,url');

        if (!empty($info['url'])) {

            return config('static_domain') . SYS_DS_PROS . $info['url'];
        }

        if (!empty($info['path'])) {

            $root_url = get_file_root_path();

            return $root_url . 'upload/file/' . $info['path'];
        }
        return '暂无文件';
    }

    /**
     * 获取文件URL路径=>根据路径
     */
    public function getFileWebUrl($path = '')
    {
        if (!empty($path)) {
            $root_url = get_file_root_path();
            return $root_url . 'upload/file/' . $path;
        }
        return '暂无文件';
    }

    /**
     * 获取指定目录下的所有文件
     * @param null $path
     * @return array
     */
    public function getFileByPath($path = null)
    {
        $dirs = new \FilesystemIterator($path);
        $arr = [];
        foreach ($dirs as $v) {
            if ($v->isdir()) {
                $_arr = $this->getFileByPath($path . "/" . $v->getFilename());
                $arr = array_merge($arr, $_arr);
            } else {
                $arr[] = $path . "/" . $v->getFilename();
            }
        }
        return $arr;
    }

    //检查图片是否存在记录
    public function checkPictureExists($param = [])
    {
        return $this->modelPicture->where('sha1', $param['sha1'])->find();
    }

    //检查文件是否存在记录
    public function checkFileExists($param = [])
    {
        return $this->modelFile->where('sha1', $param['sha1'])->find();
    }

    /* 远程图片本地化 $body为html原内容 */
    public function pictureDown($body)
    {
        $img_array = explode('&', $body);
        $root_url = get_file_root_path();
        $img_array = array();
        preg_match_all("/(src)=[\"|\'| ]{0,}(http:\/\/(.*)\.(gif|jpg|jpeg|bmp|png|JPEG|GIF|PNG))[\"|\'| ]{0,}/isU", $body, $img_array);
        $img_array = array_unique($img_array[2]);//也可以自动匹配

        set_time_limit(0);
        $picture_dir = date("Ymd") . "/";
        $imgPath = PATH_PICTURE . $picture_dir;
        $milliSecond = strftime("%H%M%S", time());
        if (!is_dir($imgPath)) @mkdir($imgPath, 0777);
        foreach ($img_array as $key => $value) {
            $value = trim($value);
            $get_file = @file_get_contents($value);
            $filename = $milliSecond . $key . "." . substr($value, -3, 3);
            $saveName = $imgPath . "/" . $filename;
            if ($get_file) {
                $fp = @fopen($saveName, "w");
                @fwrite($fp, $get_file);
                @fclose($fp);
            }
            $file_path = $root_url . 'upload/picture/' . $picture_dir . $filename;
            $body = sr($body, $value, $file_path);
        }
        return $body;
    }

}
