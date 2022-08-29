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

namespace app\admin\logic;

use think\Db;

/**
 * 系统消息逻辑
 */
class SysMsgType extends AdminBase
{

    /**
     * 获取消息列表
     */
    public function getSysMsgTypeList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysMsgType->getList($where, true, 'create_time desc', $paginate);
        is_object($list) && $list = $list->toArray();
        return $list;
    }

    /**
     * 消息删除
     */
    public function getSysMsgTypeInfo($where = [])
    {
        return $this->modelSysMsgType->getInfo($where, true);
    }

    /**
     * 消息删除
     */
    public function sysMsgTypeDel($where = [])
    {
        return $this->modelSysMsgType->deleteInfo($where, true) ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysMsgType->getError()];
    }


    /**更新修改
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/9/8 0008 10:25
     */
    public function sysMsgTypeAdd($data = [])
    {
        $validate_result = $this->validateSysMsgType->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysMsgType->getError()];
        }
        $result = $this->modelSysMsgType->setInfo($data);
        $result && action_log('添加', 'name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysMsgType->getError()];
    }

    /**更新修改
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/9/8 0008 10:25
     */
    public function sysMsgTypeEdit($data = [])
    {

        $validate_result = $this->validateSysMsgType->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysMsgType->getError()];
        }

        $url = url('show');
        $result = $this->modelSysMsgType->setInfo($data);
        $result && action_log('编辑', 'name：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysMsgType->getError()];
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {
        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['bus_name'] = ['like', '%' . $data['keywords'] . '%'];

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

    /**把对应的业务提醒扫描出来
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/10/28 0028 15:33
     */
    public function sysMsgTypeScan()
    {
        $list = $this->modelSysMsgType->getList([], 'name,type,hours,remind_sms,remind_sys,remind_email,remind_weixin', '', false);
        foreach ($list as $key => $row) {
            $intoData = array();
            $where = array();
            switch ($row['type']) {
                //线索跟进
                case 'cst_clue':
                    $endtime = date_calc(format_time(), '+ ' . $row['hours'] . '', 'hours', 'Y-m-d H:i:s');
                    $where['next_time'] = ['between', [format_time(), $endtime]];
                    if (tableExists('cst_clue')) {
                        $buslist = Db::name('cst_clue')->field('id,name,next_time,owner_user_id')->where($where)->select();
                        foreach ($buslist as $one) {
                            $intoData = [
                                'bus_type' => $row['type'],
                                'bus_type_name' => $row['name'],
                                'remind_time' => format_time(),//开妈提醒时间
                                'remind_sms' => $row['remind_sms'],
                                'remind_sys' => $row['remind_sys'],
                                'remind_email' => $row['remind_email'],
                                'remind_weixin' => $row['remind_weixin'],
                                'bus_id' => $one['id'],
                                'bus_name' => $row['name'] . ':' . $one['name'] . ',跟进时间于' . $one['next_time'],
                                'deal_user_id' => $one['owner_user_id'],
                                'deal_time' => $one['next_time'],
                            ];
                            $this->sysMsgTypeScanAdd($intoData);
                        }
                    }
                    break;
                //客户跟进
                case 'cst_customer':
                    $endtime = date_calc(format_time(), '+ ' . $row['hours'] . '', 'hours', 'Y-m-d H:i:s');
                    $where['next_time'] = ['between', [format_time(), $endtime]];
                    if (tableExists('cst_customer')) {
                        $buslist = Db::name('cst_customer')->field('id,name,next_time,owner_user_id')->where($where)->select();
                        foreach ($buslist as $one) {
                            $intoData = [
                                'bus_type' => $row['type'],
                                'bus_type_name' => $row['name'],
                                'remind_time' => format_time(),//开妈提醒时间
                                'remind_sms' => $row['remind_sms'],
                                'remind_sys' => $row['remind_sys'],
                                'remind_email' => $row['remind_email'],
                                'remind_weixin' => $row['remind_weixin'],
                                'bus_id' => $one['id'],
                                'bus_name' => $row['name'] . ':' . $one['name'] . ',跟进时间于' . $one['next_time'],
                                'deal_user_id' => $one['owner_user_id'],
                                'deal_time' => $one['next_time'],
                            ];
                            $this->sysMsgTypeScanAdd($intoData);
                        }
                    }
                    break;
                //商机跟进
                case 'cst_chance':
                    $endtime = date_calc(format_time(), '+ ' . $row['hours'] . '', 'hours', 'Y-m-d H:i:s');
                    $where['next_time'] = ['between', [format_time(), $endtime]];
                    if (tableExists('cst_chance')) {
                        $buslist = Db::name('cst_chance')->field('id,name,next_time,owner_user_id')->where($where)->select();
                        foreach ($buslist as $one) {
                            $intoData = [
                                'bus_type' => $row['type'],
                                'bus_type_name' => $row['name'],
                                'remind_time' => format_time(),//开妈提醒时间
                                'remind_sms' => $row['remind_sms'],
                                'remind_sys' => $row['remind_sys'],
                                'remind_email' => $row['remind_email'],
                                'remind_weixin' => $row['remind_weixin'],
                                'bus_id' => $one['id'],
                                'bus_name' => $row['name'] . ':' . $one['name'] . ',跟进时间于' . $one['next_time'],
                                'deal_user_id' => $one['owner_user_id'],
                                'deal_time' => $one['next_time'],
                            ];
                            $this->sysMsgTypeScanAdd($intoData);
                        }
                    }
                    break;
                //销售合同到期
                case 'sal_contract_expire':
                    $endtime = date_calc(format_time(), '+ ' . $row['hours'] . '', 'hours', 'Y-m-d H:i:s');
                    $where['end_date'] = ['between', [format_time(), $endtime]];
                    if (tableExists('sal_contract')) {
                        $buslist = Db::name('sal_contract')->field('id,name,contract_no,end_date,create_user_id')->where($where)->select();
                        foreach ($buslist as $one) {
                            $intoData = [
                                'bus_type' => $row['type'],
                                'bus_type_name' => $row['name'],
                                'remind_time' => format_time(),//开妈提醒时间
                                'remind_sms' => $row['remind_sms'],
                                'remind_sys' => $row['remind_sys'],
                                'remind_email' => $row['remind_email'],
                                'remind_weixin' => $row['remind_weixin'],
                                'bus_id' => $one['id'],
                                'bus_name' => $row['name'] . ':' . $one['name'] . '于' . $one['end_date'] . '到期!',
                                'deal_user_id' => $one['create_user_id'],
                                'deal_time' => $one['end_date'],
                            ];
                            $this->sysMsgTypeScanAdd($intoData);
                        }
                    }
                    break;
                //日程开始提醒
                case 'oa_schedule':
                    $tablename='oa_schedule';
                    $endtime = date_calc(format_time(), '+ ' . $row['hours'] . '', 'hours', 'Y-m-d H:i:s');
                    $where['start_time'] = ['between', [format_time(), $endtime]];
                    if (tableExists($tablename)) {
                        $buslist = Db::name($tablename)->field('id,name,start_time,owner_user_id')->where($where)->select();
                        foreach ($buslist as $one) {
                            $intoData = [
                                'bus_type' => $row['type'],
                                'bus_type_name' => $row['name'],
                                'remind_time' => format_time(),//开始提醒时间
                                'remind_sms' => $row['remind_sms'],
                                'remind_sys' => $row['remind_sys'],
                                'remind_email' => $row['remind_email'],
                                'remind_weixin' => $row['remind_weixin'],
                                'bus_id' => $one['id'],
                                'bus_name' => $row['name'] . ':' . $one['name'] . ',开始时间：' . $one['start_time'],
                                'deal_user_id' => $one['owner_user_id'],
                                'deal_time' => $one['start_time'],//业务实际的时间
                            ];
                            $this->sysMsgTypeScanAdd($intoData);
                        }
                    }
                    break;
                default :
                    break;
            }
        }

    }

    /**消息的写入
     * @param array $data
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/10/28 0028 17:09
     */
    public function sysMsgTypeScanAdd($data = [])
    {
        $uniquekey = md5($data['bus_type'] . $data['bus_id'] . $data['deal_user_id'] . $data['deal_time']);
        $info = $this->modelSysMsg->getValue(['uniquekey' => $uniquekey], 'uniquekey');
        $data['uniquekey'] = $uniquekey;
        if (empty($info)) {
            Db::name('sys_msg')->insert($data);
        }
    }

}
