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
 * 密钥模型
 */
class SysKey extends AdminBase
{
    /**
     * 析构函数
     */
    function __construct()
    {
        $this->file = new \lqf\File();
        $this->server_url = $this->ininServerUrl();

        //授权码目录
        $path = PATH_DATA . 'key/';;
        !is_dir($path) && mkdir($path, 0755, true);
        $this->key_path = $path;
    }

    public function getKeyPath()
    {
        return $this->key_path;
    }

    public function getSysKeyFile()
    {
        return $this->key_path . 'syskey';
    }

    //初始化服务器地址
    public  function ininServerUrl()
    {
        if (DOMAIN == 'http://127.0.0.1:8002') {//生产
            $server = ['http://127.0.0.1:8002'];
        } else if (DOMAIN == 'http://test.07fly.xyz') {//测试
            $server = ['http://test.07fly.xyz'];
        } else { //运营
            $server = [
                "http://www.07fly.xyz",
                "http://soft.s5.07fly.com",
            ];
        }
        foreach ($server as $oneurl) {
            if (httpcode($oneurl) == '200') {
                return $oneurl;
                break;
            }
        }
    }

    //获取服务器信息
    public function getAuthParams()
    {
        //获取服务器主机名
        $param = [
            'hostname' => gethostname(),
            'sys_version' => php_uname(),
            'sys_type' => php_uname('s'),
            'server_name' => $_SERVER['SERVER_NAME'],
            'http_host' => $_SERVER['HTTP_HOST'],
            'server_ip' => GetHostByName($_SERVER['SERVER_NAME']),
            'document_root' => getenv('DOCUMENT_ROOT'),
        ];
        return $param;
    }

    /**
     * 返回当前授权码
     * @return string
     * Author: lingqifei created by at 2020/5/16 0016
     */
    public function getSysKey()
    {
        $syskey = $this->key_path . 'syskey';
        $txt = $this->file->read_file($syskey);
        if ($txt) {
            return $txt;
        } else {
            return '';
        }
    }

    /**
     * 获取当前服务器唯一识别码
     * @return bool|string
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2025/1/1 10:42
     */
    public function getReqKey()
    {
        $reqkey = $this->key_path . 'reqkey';
        $txt = $this->file->read_file($reqkey);
        if ($txt) {
            return $txt;
        } else {
            return '';
        }
    }

    /**
     * 验证平台信息
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function getSignalInfo()
    {
        $url = $this->server_url . "/authorize/api.AuthDomain/signal_check.html?u=07fly.xyz&k=07fly.xyz";
        if (httpcode($url) == 200) {
            $rtn = array('code' => 1, 'msg' => '<span class="text-success">通信正常</span>');
        } else {
            $rtn = array('code' => 0, 'msg' => '<span class="text-danger">通信异常</span>');
        }
        return $rtn;
    }

    /**
     * 验证授权信息
     * @return Array|array
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2025/1/1 11:31
     */
    public function getAuthCheckInfo()
    {
        $domain = $_SERVER['HTTP_HOST'];
        $syskey = $this->getSysKey();
        $postdata['r'] = $this->getReqKey();
        $url = $this->server_url . "/authorize/api.AuthDomain/client_check?u=$domain&k=$syskey";
        $result = $this->getRemoteCotent($url, $postdata);
        return $result;
    }

    //获取服务器的唯一标识
    public function getClientReqKeyStr()
    {
        $param = $this->getAuthParams();
        $postdata['s'] = base64_encode(json_encode($param));//请求参数加密
        $url = $this->server_url . "/authorize/api.AuthDomain/client_key";
        $result = $this->getRemoteCotent($url, $postdata);
        return $result;
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


    public function setReqKey()
    {
        $filepath = $this->key_path . 'reqkey';
        $res = $this->getClientReqKeyStr();
        file_put_contents($filepath, $res['data']);
        return $res;
    }

    public function delReqKey()
    {
        $filepath = $this->key_path . 'reqkey';
        file_put_contents($filepath,'');
    }

    //获取授权信息
    public function getAuthConfigData()
    {
        $res = $this->getAuthCheckInfo();
        if ($res['code'] == 1) {
            $data['seo_title'] = config('seo_title');
            $data['seo_description'] = config('seo_description');
            $data['seo_keywords'] = config('seo_keywords');
            $data['login_title'] = config('login_title');
            $data['login_desc'] = config('login_desc');
            $data['login_demo'] = config('login_demo');
            $data['login_copyright'] = config('login_copyright');
            $data['main_title'] = config('main_title');
            $data['main_weburl'] = config('main_weburl');
            $data['top_links'] = '';
            $data['top_links_right']='';
            $data['is_grant'] = 1;
        } else {
            $data['seo_title'] = '07FLY-ERP是一款开放式的管理平台，能快速搭建适合自己的是一款开放式的管理平台-零起飞ERP';
            $data['seo_description'] = '07FLY-ERP是一款开放式的管理平台，能容纳管理各种数据、实现信息互通共享；能快速搭建适合自己的是一款开放式的管理平台，能容纳管理各种数据、实现信息互通共享；';
            $data['seo_keywords'] = 'CMS（会员中心）、办工OA、客户CRM、进销ERP、财务管理FMS、项目管理PMS';
            $data['login_title'] = '零起飞企业管理系统';
            $data['login_desc'] = '软件集ERP、CRM、OA在线办公等主要功能，PC和手机端一体化管理';
            $data['login_demo'] = '<font color="red">为您提供“专心、耐心、细心、贴心、放心”五心级服务</font>';
            $data['login_copyright'] = '<a href="http://www.07fly.xyz">技术支持:零起飞网络</a>';
            $data['main_title'] = '零起飞网络中心';
            $data['main_weburl'] = 'http://www.07fly.xyz/';
            $data['top_links'] = '
					<a href="http://v1.07fly.xyz/" target="_blank" title="07FLY-CRM开源系统V1版本">V1版本</a>
                    <a href="http://v2.07fly.xyz/" target="_blank" title="07FLY-CRM开源系统V2版本">V2版本</a>
                    <a href="http://erp.07fly.xyz/" target="_blank" title="07FLY-ERP企业管理系统">S1版本</a>
                    <a href="http://djt.07fly.xyz/" target="_blank" title="旅行社ERP管理软件地接版">地接通</a>
                  ';
            $data['top_links_right']  = '<li><a href="'.url('admin/Store/apps').'" class="J_menuItem" target="_blank"><i class="fa fa-fire"></i>应用</a></li>';
            $data['top_links_right'] .= '<li><a href="http://www.07fly.xyz/" target="_blank" title="零起飞网络">官网</a></li>';
            $data['is_grant'] = 0;
        }
        $data['document'] = '<a target="_blank" href="http://www.07fly.xyz">http://www.07fly.xyz</a>';
        return $data;
    }
}