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
class SysMsg extends AdminBase
{

    /**
     * 获取消息列表
     */
    public function getSysMsgList($where = [], $field = '', $orderby = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysMsg->getList($where, $field, $orderby, $paginate);
        foreach ($list as $key => &$row) {
            $row['bus_url'] = $this->modelSysMsg->getSysMsgBusUrl($row['bus_type'], $row['bus_id']);
            $row['deal_user_name'] = $this->modelSysUser->getValue($row['deal_user_id'], 'realname');
        }
        is_object($list) && $list = $list->toArray();
        return $list;
    }

    /**更新修改
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/9/8 0008 10:25
     */
    public function sysMsgAdd($data = [])
    {
        $validate_result = $this->validateSysMsg->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysMsg->getError()];
        }
        $data['deal_user_id'] = SYS_USER_ID;
        $result = $this->modelSysMsg->setInfo($data);
        $result && action_log('添加', 'name：' . $data['bus_name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysMsg->getError()];
    }

    /**更新修改
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/9/8 0008 10:25
     */
    public function sysMsgEdit($data = [])
    {
        $validate_result = $this->validateSysMsg->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysMsg->getError()];
        }
        $url = url('show');
        $result = $this->modelSysMsg->setInfo($data);
        $result && action_log('编辑', 'name：' . $data['bus_name']);
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysMsg->getError()];
    }

    /**
     * 消息删除
     */
    public function sysMsgDel($data = [])
    {
        if (!empty($data['id'])) {
            $where['id'] = ['in', $data['id']];
            $result = $this->modelSysMsg->deleteInfo($where, true);
            $result && action_log('删除', '删除提醒消息，where：' . http_build_query($where));
            return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysMsg->getError()];
        } else {
            return [RESULT_ERROR, '参数不能为空'];
        }
    }

    /**
     * 消息设置为处理
     */
    public function sysMsgSetDeal($data = [])
    {
        if (!empty($data['id'])) {
            $where['id'] = ['in', $data['id']];
            $result = $this->modelSysMsg->updateInfo($where, ['deal_status' => 1]);
            return $result ? [RESULT_SUCCESS, '设置成功'] : [RESULT_ERROR, $this->modelSysMsg->getError()];
        } else {
            return [RESULT_ERROR, '参数不能为空'];
        }
    }

    /**
     * 消息删除
     */
    public function getSysMsgInfo($where = [])
    {
        return $this->modelSysMsg->getInfo($where, true);
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {
        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['bus_name'] = ['like', '%' . $data['keywords'] . '%'];

        //处理状态
        if (isset($data['deal_status'])) {
            if (!empty($data['deal_status']) || is_numeric($data['deal_status'])) {
                $where['deal_status'] = ['=', '' . $data['deal_status'] . ''];
            }
        }

        //处理时间范围 参数格式： 2022-01-01 00:00:00-2022-02-01 00:00:00
        if (!empty($data['deal_time'])) {
            $range_date = str2arr($data['deal_time'], "-");
            $where['deal_time'] = ['between', $range_date];
        }

        //处理人
        if (isset($data['deal_user_id'])) {
            if (!empty($data['deal_user_id']) || is_numeric($data['deal_user_id'])) {
                $where['deal_user_id'] = ['=', '' . $data['deal_user_id'] . ''];
            }
        }

        //提醒系统
        if (isset($data['remind_sys'])) {
            if (!empty($data['remind_sys']) || is_numeric($data['remind_sys'])) {
                $where['remind_sys'] = ['=', '' . $data['remind_sys'] . ''];
            }
        }
        //消息类型
        if (isset($data['bus_type'])) {
            if (!empty($data['bus_type']) || is_numeric($data['bus_type'])) {
                $where['bus_type'] = ['=', '' . $data['bus_type'] . ''];
            }
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
        if ($orderField == 'create_time') {
            $order_by = "create_time $orderDirection";
        } else if ($orderField == 'update_time') {
            $order_by = "update_time $orderDirection";
        } else if ($orderField == 'deal_time') {
            $order_by = "deal_time $orderDirection";
        } else {
            $order_by = "id desc";
        }
        return $order_by;
    }

    /**
     * 消息=>发送
     */
    public function sysMsgSend()
    {
        $where['deal_status'] = ['=',0];//未处理
        $where['remind_status'] = ['=',1];//提醒中
        $where['remind_time'] = ['<=',format_time()];//提醒时间要小于等于当前时间
        $where['remind_nums'] = ['>',0];//提醒次数要大于0
        $list = $this->modelSysMsg->getList($where, '', 'remind_nums desc', false);
        $updatalist=[];
        foreach ($list as $key => &$row) {
            //业务的链接地址
            $row['bus_url'] = $this->modelSysMsg->getSysMsgBusUrl($row['bus_type'], $row['bus_id']);
            $row['deal_user_name'] = $this->modelSysUser->getValue($row['deal_user_id'], 'realname');

            //微信通知
            if(!empty($row['remind_weixin'])){
                d('微信通知:');
                $this->modelSysMsgSend->weixin_teplate_send($row);
            }

            //设置下次提醒时间
            $next_time= date_calc(format_time(), '+ ' . $row['remind_interval'] . '', 'hours', 'Y-m-d H:i:s');
            $updatalist[]=[
                'id'=>$row['id'],
                'remind_time'=>$next_time,//下次提醒的时间
                'remind_nums'=>$row['remind_nums']-1,//剩余提醒次数
                'send_nums'=>$row['send_nums']+1,//发送次数
                'send_time'=>format_time(),//发送次数
            ];
        }
        d($updatalist);
        $res=$this->modelSysMsg->setList($updatalist,true);
        d($res);
    }

}
