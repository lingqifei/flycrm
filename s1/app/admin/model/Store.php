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
namespace app\admin\model;

use think\Cookie;
use \lqf\Http;

/**
 * 升级模型
 */
class Store extends AdminBase
{
//    private $server_url = "http://soft.s5.07fly.com";
    private $server_url='http://www.07fly.xyz';
    private $file;
    /**
     * 析构函数
     */
    function __construct()
    {
        $this->file = new \lqf\File();
        $this->initServerUrl();
    }

    /**服务器站点
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/2/16 0016 16:51
     */
    function  initServerUrl(){
		if($_SERVER['HTTP_HOST']=='127.0.0.1:8002'){//生产

			$server=['http://127.0.0.1:8002'];

		} else if($_SERVER['HTTP_HOST']=='test.07fly.xyz'){//测试

			$server=['http://erp.07fly.xyz'];

		}else{ //运营
			$server=[
				"http://www.07fly.xyz",
				"http://soft.s5.07fly.com",
			];
		}
		foreach ($server as $oneurl){
			if(httpcode($oneurl)=='200'){
				$this->server_url=$oneurl;
				break;
			}
		}
		//echo $this->server_url;exit;
    }


	/**
	 * 获取云应用插件列表
	 * Author: lingqifei created by at 2021/6/12 0012
	 */
	public function getCloudStoreList($postdata=[])
	{
		$url = $this->server_url . "/api/Store/store_list";
		$result = $this->getRemoteCotent($url,$postdata);
		return $result;
	}

	/**
	 * 获取云应用帐号
	 * Author: lingqifei created by at 2021/6/12 0012
	 */
	public function getCloudUserLogin($postdata=[])
	{
		$url = $this->server_url . "/api/common/login";
		$result = $this->getRemoteCotent($url,$postdata);
		return $result;
	}

	/**
	 * 获取云应用=>AppInfo
	 * Author: lingqifei created by at 2021/6/12 0012
	 */
	public function getCloudAppInfo($postdata=[])
	{
		$postdata['user_token']=Cookie::get('user_token');
		$postdata['http_host']=$_SERVER['HTTP_HOST'];
		$url = $this->server_url . "/api/store/app_info";
		$result=curl_post($url,$postdata);
		$result = json_decode($result, true);

//		$result = $this->getRemoteCotent($url,$postdata);
		return $result;
	}



	/**
	 * 获取云应用=>AppOrderInfo
	 * Author: lingqifei created by at 2021/6/12 0012
	 */
	public function getCloudAppOrderInfo($postdata=[])
	{
		$postdata['user_token']=Cookie::get('user_token');
		$postdata['http_host']=$_SERVER['HTTP_HOST'];
		$url = $this->server_url . "/api/store/app_order";
		$result = $this->getRemoteCotent($url,$postdata);
		return $result;
	}

	/**
	 * 获取云应用=>AppOrderPaid
	 * Author: lingqifei created by at 2021/6/12 0012
	 */
	public function getCloudAppOrderCheck($postdata=[])
	{
		$postdata['user_token']=Cookie::get('user_token');
		$postdata['http_host']=$_SERVER['HTTP_HOST'];
		$url = $this->server_url . "/api/store/app_order_pay_check";
		$result = $this->getRemoteCotent($url,$postdata);
		return $result;
	}


	/**
	 * 获取云应用=>AppOrderInfo
	 * Author: lingqifei created by at 2021/6/12 0012
	 */
	public function getCloudAppDownFile($postdata=[])
	{
		//模块下载目录
		$path = PATH_DATA.'app/download/';
		!is_dir($path) && mkdir($path, 0755, true);

		$postdata['user_token']=Cookie::get('user_token');
		$postdata['http_host']=$_SERVER['HTTP_HOST'];

		$url = $this->server_url . "/api/store/store_down";

		$fileName=data_md5_key($postdata['app_id']).'.zip';

		$saveFile=$path.$fileName;

		$result = Http::down($url, $saveFile, $postdata);

		return array('code'=>1,'filename'=>$fileName,'filepath'=>$result,'dirpath'=>$path);

	}

    /**
     * 获取可以升级的列表
     * Author: lingqifei created by at 2020/6/12 0012
     */
    public function getVersionList($version)
    {
        $url = $this->server_url . "/authorize/api.AuthVersion/get_version?ver=$version&sys=s1";
        $result = $this->getRemoteCotent($url);
        return $result;
    }

    /**获取远程版本详细信息
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function getVersionInfo($version)
    {
        $url = $this->server_url . "/authorize/api.AuthVersion/get_version_info/?ver=$version&sys=s1";
        $result = $this->getRemoteCotent($url);
        return $result;
    }

    /**验证授权信息
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function getAuthorizeInfo($domain,$syskey)
    {
        $url = $this->server_url . "/authorize/api.AuthDomain/client_check.html?u=$domain&k=$syskey";
        $result = $this->getRemoteCotent($url);
//        $result = json_decode($result, true);
        return $result;
    }

    /**验证平台信息
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function getSignalInfo()
    {
        $url = $this->server_url . "/authorize/api.AuthDomain/client_check.html?u=07fly.xyz&k=07fly.xyz";
        if (httpcode($url)==200) {
            $rtn = array('code' => 1, 'msg' => '<span class="text-success">通信正常</span>');
        } else {
            $rtn = array('code' => 0, 'msg' => '<span class="text-danger">通信异常</span>');
        }
        return $rtn;
    }

    /**
     *获得远程请求远程地址内容
     * @param $url
     * @param array $postdata
     * @return Array()
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/12/25 0025
     */
    public function  getRemoteCotent($url, $postdata=[]){

		$result=curl_post($url,$postdata);
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
