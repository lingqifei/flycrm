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

use lqf\Http;
use think\Cookie;

/**
 * 升级模型
 */
class Upgrade extends AdminBase
{
//    private $server_url = "http://soft.s5.07fly.com";
    private $server_url = 'http://www.07fly.xyz';
    private $file;

    /**
     * 析构函数
     */
    function __construct()
    {
        $this->file = new \lqf\File();
        $this->server_url = $this->modelSysKey->ininServerUrl();
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
        if (httpcode($url) == 200) {
            $result = curl_post($url, $postdata);
            $result = json_decode($result, true);
        } else {
            $result = ['code' => 0, 'msg' => '网络通信异常'];
        }
        return $result;
    }

    /**
     * 获取可以升级的列表
     * Author: lingqifei created by at 2020/6/12 0012
     */
    public function getVersionList($version)
    {
        $url = $this->server_url . "/authorize/api.AuthVersion/get_version_list?ver=$version&sys=s1";
        $result = $this->getRemoteCotent($url);
        return $result;
    }

    /**
     * 获取远程版本详细信息
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function getVersionInfo($version)
    {
        $url = $this->server_url . "/authorize/api.AuthVersion/get_version_info/?ver=$version&sys=s1";
        $postdata['ver'] = $version;
        $postdata['sys'] = 's1';
        $result = Http::get($url, $postdata);
        $result = json_decode($result, true);
        if ($result['code'] == 0) {
            return $result['data'];
        } else {
            return [RESULT_ERROR, $result['msg']];
        }
    }

    /**
     * 获取版本升级文件
     * Author: lingqifei created by at 2021/6/12 0012
     */
    public function getVersionUpgradeFile($version)
    {
        //升级包下载目录
        $path = PATH_DATA . 'upgrade/down/';
        !is_dir($path) && mkdir($path, 0755, true);
        $url = $this->server_url . "/authorize/api.AuthVersion/get_version_file";
        $postdata['ver'] = $version;
        $postdata['sys'] = 's1';
        $savepath = $path . $version . '.zip';
        $result = Http::down($url, $savepath, $postdata);
        if ($result) {
            return array('code' => 1, 'filename' => $version . '.zip', 'filepath' => $result, 'dirpath' => $path);
        } else {
            return array('code' => 0, 'msg' => '升级文件下载失败');
        }
    }
}
