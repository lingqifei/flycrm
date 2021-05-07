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
namespace app\common\service\sms\driver\tencent;


class SmsApi {

    private $app_id;
    private $app_key;

    /**
     * SmsApi 构造函数.
     * @param $accessKeyId string AccessKeyId，
     * @param $accessKeySecret string AccessKeySecret，
     */
    function  __construct($app_id, $app_key) {
        $this->app_id = $app_id;
        $this->app_key = $app_key;
    }

    /**
     * @param string $nationCode  国家码，如 86 为中国
     * @param string $phoneNumber 不带国家码的手机号
     * @param int    $templId     模板 id
     * @param array  $params      模板参数列表，如模板 {1}...{2}...{3}，那么需要带三个参数
     * @param string $sign        签名，如果填空串，系统会使用默认签名
     * @param string $extend      扩展码，可填空串
     * @param string $ext         服务端原样返回的参数，可填空串
     * @return string 应答json字符串，详细内容参见腾讯云协议文档
     */
    function sendSms($nationCode, $phoneNumber, $templId = 0, $params, $sign = "", $extend = "", $ext = ""){

        $appid = $this->app_id;  //自己的短信appid
        $appkey = $this->app_key; //自己的短信appkey

        $random = rand(100000, 999999);//生成随机数
        $curTime = time();
        $wholeUrl = "https://yun.tim.qq.com/v5/tlssmssvr/sendsms". "?sdkappid=" . $appid . "&random=" . $random;

        // 按照协议组织 post 包体
        $data = new \stdClass();//创建一个没有成员方法和属性的空对象
        $tel = new \stdClass();
        $tel->nationcode = "".$nationCode;
        $tel->mobile = "".$phoneNumber;
        $data->tel = $tel;
        $data->sig=hash("sha256", "appkey=".$appkey."&random=".$random."&time=".$curTime."&mobile=".$phoneNumber);// 生成签名
        $data->tpl_id = $templId;
        $data->params = $params;
        $data->sign = $sign;
        $data->time = $curTime;
        $data->extend = $extend;
        $data->ext = $ext;

        return $this->sendCurlPost($wholeUrl, $data);
}
    /**
     * 发送请求
     *
     * @param string $url 请求地址
     * @param array $dataObj 请求内容
     * @return string 应答json字符串
     */
    public function sendCurlPost($url, $dataObj)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataObj));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($curl);
        if (false == $ret) {
            // curl_exec failed
            $result = "{ \"result\":" . -2 . ",\"errmsg\":\"" . curl_error($curl) . "\"}";
        } else {
            $rsp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "{ \"result\":" . -1 . ",\"errmsg\":\"" . $rsp . " " . curl_error($curl) . "\"}";
            } else {
                $result = $ret;
            }
        }
        curl_close($curl);
        return $result;
    }

}