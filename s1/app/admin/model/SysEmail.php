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
class SysEmail extends AdminBase
{

    //默认配置
    private $config = [
        'host' => 'smtp.exmail.qq.com',
        'username' => 'admin@07fly.com',
        'password' => 'tpVihdnwCwjGvdSV',
        'port' => '465',
        'realname' => '零起飞',
    ];

    //获取邮件服务参数
    public function getConfig()
    {
        $sysEmailConfig = $this->value('config');
        if (!empty($sysEmailConfig)) {
            $config = json_decode($sysEmailConfig, true);
            $this->setConfig($config);
        }
        return $this->config;
    }
    /*
     * 设置邮件服务参数
     */
    public function setConfig($data = [])
    {
        $this->config['username'] = $data['mail_username'];
        $this->config['password'] = $data['mail_password'];
        $this->config['port'] = $data['mail_port'];
        $this->config['realname'] = $data['mail_realname'];
        $this->config['host'] = $data['mail_smtp'];
    }

    /**
     * 发送邮件
     * @param $data ['address'=>'接收邮箱','title'=>'标题','content'=>'内容']
     * @return bool|string
     * @throws \lqf\phpmailerException
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2024/2/26 14:21
     */
    public function sendEmail($data = [])
    {
        $mail = new \lqf\PHPMailer();
        $mail->isSMTP();
        $mail->Host = $this->config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->config['username'];
        $mail->Password = $this->config['password'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = $this->config['port'];
        $mail->CharSet = 'UTF-8';
        $mail->setFrom($this->config['username'], $this->config['realname']);//发件地址，标题
        $mail->addAddress($data['address']);
        $mail->isHTML(true);
        $mail->Subject = $data['title'];
        $mail->Body = $data['content'];
        $mail->AltBody = '07flyCRM';
        if (!$mail->send()) {
            return $mail->ErrorInfo;
        }
        return true;
    }
}