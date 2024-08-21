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

namespace app\admin\logic;

use think\Db;

/**
 * 系统消息逻辑
 */
class SysEmail extends AdminBase
{

    public function getEmailParam()
    {
        return ['mail_username' => '发件人邮箱', 'mail_realname' => '发件人名称', 'mail_password' => '密码', 'mail_smtp' => 'SMTP服务器', 'mail_port' => '端口',];
    }

    /**
     * 获得邮件配置信息
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2024/2/26 11:20
     */
    public function getSysEmailConf()
    {
        //$where['org_id'] = ['=', SYS_ORG_ID];
        $info = $this->modelSysEmail->getInfo([], true);
        !empty($info['config']) && $info['config'] = json_decode($info['config'], true);
        return $info;
    }

    /**
     * 设置邮件配置
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2024/2/26 11:20
     */
    public function setSysEmailConf($data = [])
    {
        $where['org_id'] = SYS_ORG_ID;
        $info = $this->modelSysEmail->getInfo($where, true);
        $updata['config'] = json_encode($data['param']);
        if (empty($info)) {
            $updata['org_id'] = SYS_ORG_ID;
            $result = $this->modelSysEmail->setInfo($updata);
        } else {
            $result = $this->modelSysEmail->updateInfo($where, $updata);
        }
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelSysEmailLog->getError()];
    }

    /*
     * 发送系统邮件,
     * 同时保存发送记录
     * $data['address','title','content']
     */
    public function sendSysEmail($data = [])
    {
        if (empty($data['address'])) {
            throw_response_error('接收邮件不能为空');
        }
        if (empty($data['title'])) {
            throw_response_error('标题不能为空');
        }
        if (empty($data['content'])) {
            throw_response_error('内容不能为空');
        }

        $result = true;
        $config = $this->getSysEmailConf();
        if (empty($config)) {
            throw_response_error('请先配置邮件服务');
        }
        $this->modelSysEmail->setConfig($config['config']);

        //数组转成数组
        $addressArray = str2arr($data['address']);
        $logDataList = [];
        foreach ($addressArray as $address) {
            $sendParam['address'] = $address;
            $sendParam['title'] = $data['title'];
            $sendParam['content'] = $data['content'];
            $result = $this->modelSysEmail->sendEmail($sendParam);
            //发送记录
            $logDataList[] = [
                'receiver' => $address,
                'title' => $data['title'],
                'content' => $data['content'],
            ];
        }
        //添加发送记录
        $this->modelSysEmailLog->setList($logDataList);
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelSysEmailLog->getError()];
    }

    /**
     * 邮件发送记录列表
     */
    public function getSysEmailLogList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysEmailLog->getList($where, true, 'create_time desc', $paginate);
        return $list;
    }

    /**
     * 消息删除
     */
    public function getSysEmailLogInfo($where = [])
    {
        return $this->modelSysEmailLog->getInfo($where, true);
    }

    /**
     * 消息删除
     */
    public function sysEmailLogDel($data = [])
    {
        $where['id'] = ['in', $data['id']];
        return $this->modelSysEmailLog->deleteInfo($where, true) ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysEmailLog->getError()];
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {
        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['receiver|title|content'] = ['like', '%' . $data['keywords'] . '%'];
        if (!empty($data['status'])) {
            $where['status'] = ['=', '' . $data['status'] . ''];
        }
        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by = "";
        //排序操作
        if (!empty($data['orderField'])) {
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        } else {
            $orderField = "";
            $orderDirection = "";
        }
        if ($orderField == 'by_name') {
            $order_by = "a.name $orderDirection";
        } else if ($orderField == 'by_url') {
            $order_by = "a.url $orderDirection";
        } else {
            $order_by = "a.create_time asc";
        }
        return $order_by;
    }
}