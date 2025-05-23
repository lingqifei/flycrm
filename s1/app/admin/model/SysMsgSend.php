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

use think\Db;

/**
 * 系统提醒
 */
class SysMsgSend extends AdminBase
{
    /**
     * 系统消息添加
     * @param $data //业务类型
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 12:14
     */
    public function weixin_teplate_send($data = [])
    {
        $message = [
            'username' => '123456',
            'template_id' => 'bwLwn1YE1q4seB9D0S-rhaab4CsL2GjiV2RWjFjuqfI',
            'url' => DOMAIN . $data['bus_url'],
            'miniprogram' => '',
            'data' => [
                'first' => [
                    'value' => '系统消息通知',
                    'color' => '',
                ],
                'keyword1' => [
                    'value' => $data['bus_name'],
                    'color' => '#ff0000',
                ],
                'keyword2' => [
                    'value' => '待处理',
                    'color' => '',
                ],
                'keyword3' => [
                    'value' => $data['deal_time'],
                    'color' => '',
                ],
                'keyword4' => [
                    'value' => $data['deal_time'],
                    'color' => '',
                ],
                'remark' => [
                    'value' => $data['bus_name'],
                    'color' => '',
                ],
            ],
        ];
        $post_url = 'http://www.07fly.xyz' . url('api/Member/member_template_send');
        $post_data['access_token'] = get_access_token();
        $post_data['template_data'] = $message;
        $res = curl_post($post_url, $post_data, 'post');
        d($res);
    }

    /**
     * 邮件发送
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/12/4 21:14
     */
    public function email_teplate_send($data = [])
    {
        $sendParam['address'] = $data['email'];
        $sendParam['title'] = $data['bus_type_name'];
        $sendParam['content'] = $data['bus_name'];
        $this->logicSysEmail->sendSysEmail($sendParam);
    }
}
