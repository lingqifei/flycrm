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

namespace app\common\service\sms\driver;

use app\common\service\sms\Driver;
use app\common\service\Sms;

/**
 * 腾讯短信服务驱动
 */
class Tencent extends Sms implements Driver
{

    /**
     * 驱动基本信息
     */
    public function driverInfo()
    {

        return ['driver_name' => '腾讯短信服务驱动', 'driver_class' => 'Tencent', 'driver_describe' => '腾讯短信驱动', 'author' => 'LingQiFei', 'version' => '1.0'];
    }

    /**
     * 获取驱动参数
     */
    public function getDriverParam()
    {

        return ['app_id' => '腾讯短信appID','app_key' => '腾讯短信密钥appKey', ];
    }

    /**
     * 获取配置信息
     */
    public function config()
    {

        return $this->driverConfig('Tencent');
    }

    /**
     * 发送短信
     */
    public function sendSms($parameter = [])
    {

        $tencent_config = $this->config();

        $sms = new tencent\SmsApi($tencent_config['app_id'], $tencent_config['app_key']);

        /**
         * @param string $nationCode  国家码，如 86 为中国
         * @param string $phoneNumber 不带国家码的手机号
         * @param int    $templId     模板 id
         * @param array  $params      模板参数列表，如模板 {1}...{2}...{3}，那么需要带三个参数
         * @param string $sign        签名，如果填空串，系统会使用默认签名
         * @param string $extend      扩展码，可填空串
         * @param string $ext         服务端原样返回的参数，可填空串
         * @return string 应答json字符串，详细内容参见腾讯云协议文档
         *
         * 如：$sms->sendSms($nationCode, $phoneNumber, $templId = 0, $params, $sign = "", $extend = "", $ext = "")
         */

        $response = $sms->sendSms(
            $parameter['nationCode'],
            $parameter['mobile'],
            $parameter['template_id'],
            $parameter['params_array'],
            $parameter['sign']
        );
        $result	=json_decode($response,true);
        if(strstr($result["result"], '0') !== false){
            return true;
        }else{
            return false;
        }
//        $response=json_decode($response);
//        print_r($response);
//        exit;
    }

}
