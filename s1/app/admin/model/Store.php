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
namespace app\admin\model;

use think\Cookie;
use \lqf\Http;

/**
 * 升级模型
 */
class Store extends AdminBase
{
    private $server_url = 'http://www.07fly.xyz';
    private $file;
    private $reqKey;

    /**
     * 析构函数
     */
    function __construct()
    {
        $this->file = new \lqf\File();
        $this->server_url = $this->modelSysKey->ininServerUrl();
        $this->reqKey = $this->modelSysKey->getReqKey();
    }

    /**
     * 获取云应用插件列表
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getCloudStoreList($postdata = [])
    {
        $url = $this->server_url . "/api/Store/store_list";
        $postdata['user_token'] = Cookie::get('user_token');
        $postdata['http_host'] = $_SERVER['HTTP_HOST'];
        $postdata['user_info'] = Cookie::Get('stroe_user');
        $postdata['req_key'] =$this->reqKey;
        $result = $this->getRemoteCotent($url, $postdata);
        return $result;
    }

    /**
     * 获取云应用帐号
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getCloudUserLogin($postdata = [])
    {
        $url = $this->server_url . "/api/common/login";
        $postdata['req_key'] =$this->reqKey;
        $result = $this->getRemoteCotent($url, $postdata);
        return $result;
    }

    /**
     * 获取云应用=>AppInfo
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getCloudAppInfo($postdata = [])
    {
        $postdata['user_token'] = Cookie::get('user_token');
        $postdata['http_host'] = $_SERVER['HTTP_HOST'];
        $postdata['req_key'] =$this->reqKey;
        $url = $this->server_url . "/api/store/app_info";
        $result = curl_post($url, $postdata);
        $result = json_decode($result, true);
        return $result;
    }

    /**
     * 获取云应用=>AppOrderInfo
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getCloudAppOrderInfo($postdata = [])
    {
        $postdata['user_token'] = Cookie::get('user_token');
        $postdata['http_host'] = $_SERVER['HTTP_HOST'];
        $postdata['req_key'] =$this->reqKey;
        $url = $this->server_url . "/api/store/app_order";
        $result = $this->getRemoteCotent($url, $postdata);
        return $result;
    }

    /**
     * 获取云应用=>AppOrderPaid
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getCloudAppOrderCheck($postdata = [])
    {
        $postdata['user_token'] = Cookie::get('user_token');
        $postdata['http_host'] = $_SERVER['HTTP_HOST'];
        $postdata['req_key'] =$this->reqKey;
        $url = $this->server_url . "/api/store/app_order_pay_check";
        $result = $this->getRemoteCotent($url, $postdata);
        return $result;
    }

    /**
     * 获取云应用=>AppOrderInfo
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getCloudAppDownFile($postdata = [])
    {
        //模块下载目录
        $path = PATH_DATA . 'app/download/';
        !is_dir($path) && mkdir($path, 0755, true);

        $postdata['user_token'] = Cookie::get('user_token');
        $postdata['http_host'] = $_SERVER['HTTP_HOST'];
        $postdata['req_key'] =$this->reqKey;
        $url = $this->server_url . "/api/store/store_down";

        $fileName = data_md5_key($postdata['app_id']) . '.zip';
        $saveFile = $path . $fileName;
        $result = Http::down($url, $saveFile, $postdata);
        return array('code' => 1, 'filename' => $fileName, 'filepath' => $result, 'dirpath' => $path);

    }

    /**
     *获得远程请求远程地址内容
     * @param $url
     * @param array $postdata
     * @return Array()
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/12/25 0025
     */
    public function getRemoteCotent($url, $postdata = [])
    {
        $result = curl_post($url, $postdata);
        $result = json_decode($result, true);
//        if (httpcode($url)==200) {
//            $result=curl_post($url,$postdata);
//            $result = json_decode($result, true);
//        }else{
//            $result =['code' => 0, 'msg' => '网络通信异常'];
//        }
        return $result;
    }
}
