<?php

namespace lqf;

use think\Db;

class Wxlogin
{

    # 你自己的
    private $app_id = 'wx8169e32518af802d';
    # 也是你自己的
    private $app_secret = '0d57c6e9ed08146e3a0ccab6c914b5ab';

    public function __construct($app_id='', $app_secret='')
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
    }	/**
 * 获取微信授权链接
 *
 * @param string $redirect_uri 跳转地址
 * @param mixed $state 参数
 */
    public function get_authorize_url( $redirect_uri = '', $state = '' ) {
        $redirect_uri = urlencode( $redirect_uri );
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect";
    }

    /**
     * 获取授权token
     *
     * @param string $code 通过get_authorize_url获取到的code
     */
    public function get_access_token($code = '') {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->https_request( $token_url );
        $jsoninfo = json_decode( $token_data, true );
        return $jsoninfo;
    }

    /**
     * 获取授权后的微信用户信息
     *
     * @param string $access_token
     * @param string $open_id
     */
    public function get_user_info( $access_token = '', $open_id = '' ) {
        if ( $access_token && $open_id ) {
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->https_request( $info_url );
            $jsoninfo = json_decode( $info_data, true );
            return $jsoninfo;
        }
    }
    public function https_request( $url, $data = null ) {
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
        if ( !empty( $data ) ) {
            curl_setopt( $curl, CURLOPT_POST, 1 );
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
        }
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $output = curl_exec( $curl );
        curl_close( $curl );
        return $output;
    }
}