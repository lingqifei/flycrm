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

namespace app\common\service;

/**
 * 云存储服务
 */
class Storage extends ServiceBase implements BaseInterface
{
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '云存储服务', 'service_class' => 'Storage', 'service_describe' => '系统云存储服务，用于整合多个云储存平台', 'author' => 'lingqifei', 'version' => '1.0'];
    }

    protected function pictureDel($path)
    {
        $info = explode(SYS_DS_PROS,$path);
        $file_url = PATH_PICTURE . $path;
        unlink(str_replace('\\','/',$file_url));

        $big_path       = PATH_PICTURE . $info[0] . DS . 'thumb' . DS . 'big_'       . $info[1];
        $medium_path    = PATH_PICTURE . $info[0] . DS . 'thumb' . DS . 'medium_'    . $info[1];
        $small_path     = PATH_PICTURE . $info[0] . DS . 'thumb' . DS . 'small_'     . $info[1];

        $big_path = str_replace('\\','/',$big_path);
        $medium_path = str_replace('\\','/',$medium_path);
        $small_path = str_replace('\\','/',$small_path);

        file_exists($big_path)      && unlink($big_path);
        file_exists($medium_path)   && unlink($medium_path);
        file_exists($small_path)    && unlink($small_path);
    }

    protected function fileDel($path)
    {
        $file_url = PATH_FILE . $path;
        unlink(str_replace('\\','/',$file_url));
    }

}
