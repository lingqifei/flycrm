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

namespace app\common\service\vod\driver;

use app\common\service\vod\Driver;
use app\common\service\Vod;
require_once 'alivod/aliyun-php-sdk-core/Config.php';
use OSS\OssClient;

/**
 * 阿里云Vod
 */
class Alivod extends Vod implements Driver
{
    
    /**
     * 驱动基本信息
     */
    public function driverInfo()
    {
        
        return ['driver_name' => '阿里云VOD驱动', 'driver_class' => 'Alivod', 'driver_describe' => '阿里云视频点播', 'author' => 'lingqifei', 'version' => '1.0'];
    }
    
    /**
     * 获取驱动参数
     */
    public function getDriverParam()
    {
        
        return ['ak_id' => '阿里云accessKeyId', 'ak_secret' => '阿里云accessKeySecret'];
    }
    
    /**
     * 获取配置信息
     */
    public function config()
    {
        
        return $this->driverConfig('Alivod');
    }
    
    /**
     * 初始化客户端
     */
    public function initVodClient()
    {
        
        $config = $this->config();
        
        $profile = \DefaultProfile::getProfile('cn-shanghai', $config['ak_id'], $config['ak_secret']);
        
        return new \DefaultAcsClient($profile);
    }
    
    /**
     * 获取视频上传地址和凭证
     */
    public function createUploadVideo($title = "测试视频点播", $file_name = "./upload/file/test.mp4", $description = "", $cover_url = "", $tags = "")
    {
        
        $client = $this->initVodClient();
        
        $request = new \vod\Request\V20170321\CreateUploadVideoRequest();
        
        $request->setTitle($title);                 // 视频标题(必填参数)
        $request->setFileName($file_name);          // 视频源文件名称，必须包含扩展名(必填参数)
        $request->setDescription($description);     // 视频源文件描述(可选)
        $request->setCoverURL($cover_url);          // 自定义视频封面(可选)
        $request->setTags($tags);                   // 视频标签，多个用逗号分隔(可选)
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }
    
    /**
     * 上传视频文件
     */
    public function uploadVideo($object = null, $local_file_name = './test.mp4')
    {
        
        $address = json_decode(base64_decode($object->UploadAddress),true);
        $auth    = json_decode(base64_decode($object->UploadAuth),true);
        
        $oss = new OssClient($auth['AccessKeyId'], $auth['AccessKeySecret'], $address['Endpoint'], false, $auth['SecurityToken']);

        $info = $oss->uploadFile($address['Bucket'], $address['FileName'], $local_file_name);
        
        return $info;
    }
}
