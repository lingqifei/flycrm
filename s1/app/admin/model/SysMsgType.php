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
class SysMsgType extends AdminBase
{

    /**
     * 扫描=》线索跟进提醒
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanCstClue($data = [])
    {
        $endtime = date_calc(format_time(), '+ ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $where['next_time'] = ['between', [format_time(), $endtime]];
        if (tableExists('cst_clue')) {
            $buslist = Db::name('cst_clue')->field('id,name,next_time,owner_user_id')->where($where)->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],//业务类型标记
                    'bus_type_name' => $data['name'],//业务类型名称
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间

                    'bus_id' => $one['id'],//业务id
                    'bus_name' => $data['name'] . ':' . $one['name'] . ',跟进时间于' . $one['next_time'],
                    'deal_user_id' => $one['owner_user_id'],//业务处理人员
                    'deal_time' => $one['next_time'],//业务处理最后时间
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }

    /**
     * 扫描=》客户跟进提醒
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanCstCustomer($data = [])
    {
        $endtime = date_calc(format_time(), '+ ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $where['next_time'] = ['between', [format_time(), $endtime]];
        if (tableExists('cst_customer')) {
            $buslist = Db::name('cst_customer')->field('id,name,next_time,owner_user_id')->where($where)->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => $data['name'] . ':' . $one['name'] . ',跟进时间于' . $one['next_time'],
                    'deal_user_id' => $one['owner_user_id'],
                    'deal_time' => $one['next_time'],
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }

    /**
     * 扫描=》跟进记录提醒
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanCstChance($data = [])
    {
        $endtime = date_calc(format_time(), '+ ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $where['next_time'] = ['between', [format_time(), $endtime]];
        if (tableExists('cst_chance')) {
            $buslist = Db::name('cst_chance')->field('id,name,next_time,owner_user_id')->where($where)->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => $data['name'] . ':' . $one['name'] . ',跟进时间于' . $one['next_time'],
                    'deal_user_id' => $one['owner_user_id'],
                    'deal_time' => $one['next_time'],
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }

    /**
     * 扫描=》销售合同到期提醒
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanSalContractExpire($data = [])
    {
        $endtime = date_calc(format_time(), '+ ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $where['end_date'] = ['between', [format_time(), $endtime]];
        if (tableExists('sal_contract')) {
            $buslist = Db::name('sal_contract')->field('id,name,contract_no,end_date,owner_user_id')->where($where)->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => $data['name'] . ':' . $one['name'] . '于' . $one['end_date'] . '到期!',
                    'deal_user_id' => $one['owner_user_id'],
                    'deal_time' => $one['end_date'],
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }

    /**
     * 扫描=》销售订单到期提醒
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanSalOrderExpire($data = [])
    {
        $endtime = date_calc(format_time(), '+ ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $where['end_date'] = ['between', [format_time(), $endtime]];
        if (tableExists('sal_order')) {
            $buslist = Db::name('sal_order')->field('id,name,order_no,end_date,create_user_id')->where($where)->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => $data['name'] . ':' . $one['name'] . '于' . $one['end_date'] . '到期!',
                    'deal_user_id' => $one['owner_user_id'],
                    'deal_time' => $one['end_date'],
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }

    /**
     * 扫描=》日程提醒
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanOaSchedule($data = [])
    {
        $tablename = 'oa_schedule';
        $starttime = date_calc(format_time(), '- ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $endtime = date_calc(format_time(), '+ ' . $data['hours'] . '', 'hours', 'Y-m-d H:i:s');
        $where['start_time'] = ['between', [$starttime, $endtime]];
        if (tableExists($tablename)) {
            $buslist = Db::name($tablename)->field('id,name,start_time,owner_user_id')->where($where)->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => $data['name'] . ':' . $one['name'] . ',开始时间：' . $one['start_time'],
                    'deal_user_id' => $one['owner_user_id'],
                    'deal_time' => $one['start_time'],//业务实际的时间
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }

    /**
     * 扫描=》工单处理
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanOaService($data = [])
    {
        $tablename = 'oa_service';
        $starttime = strtotime('- ' . $data['hours'] . 'hours', time());
        $endtime = strtotime('+ ' . $data['hours'] . 'hours', time());
        $where['create_time'] = ['between', [$starttime, $endtime]];
        $where['status'] = ['=', 0];//表示未处理
        if (tableExists($tablename)) {
            $buslist = Db::name($tablename)->field('id,name,create_time,deal_user_id,notify_user_id')
                ->where($where)
                ->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => '负责工单待处理:' . $one['name'] . ',开始时间：' . format_time(),
                    'deal_user_id' => $one['deal_user_id'],
                    'deal_time' => format_time(),//业务实际的时间
                ];
                $this->sysMsgTypeScanAdd($intoData);
                $notify_user = str2arr($one['notify_user_id']);
                if (!empty($notify_user)) {
                    foreach ($notify_user as $notifyid) {
                        $intoData['deal_user_id'] = $notifyid;
                        $intoData['bus_name'] = '通知工单:' . $one['name'] . ',开始时间：' . format_time();

                        $this->sysMsgTypeScanAdd($intoData);
                    }
                }
            }
        }
    }

    /**
     * 扫描=》提醒审批处理
     * @param $data
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 10:40
     */
    public function scanWorkflowBusinessHistory($data = [])
    {
        $tablename = 'workflow_business_history';
        $starttime = strtotime('- ' . $data['hours'] . 'hours', time());
        $endtime = strtotime('+ ' . $data['hours'] . 'hours', time());
        $where['create_time'] = ['between', [$starttime, $endtime]];
        $where['deal_status'] = ['=', 0];//表示待处理的审批单
        if (tableExists($tablename)) {
            $buslist = Db::name($tablename)->field('id,create_time,deal_user_id')
                ->where($where)
                ->select();
            foreach ($buslist as $one) {
                $intoData = [
                    'bus_type' => $data['type'],
                    'bus_type_name' => $data['name'],
                    'remind_sms' => $data['remind_sms'],
                    'remind_sys' => $data['remind_sys'],
                    'remind_email' => $data['remind_email'],
                    'remind_weixin' => $data['remind_weixin'],
                    'remind_nums' => $data['remind_nums'],//提醒的总次数
                    'remind_interval' => $data['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_id' => $one['id'],
                    'bus_name' => '有新的审批单待处理,开始时间：' . format_time(),
                    'deal_user_id' => $one['deal_user_id'],
                    'deal_time' => format_time(),//业务实际的时间
                ];
                $this->sysMsgTypeScanAdd($intoData);
            }
        }
    }
    /**
     * 消息的写入系统表
     * @param array $data
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/10/28 0028 17:09
     */
    public function sysMsgTypeScanAdd($data = [])
    {
        $uniquekey = md5($data['bus_type'] . $data['bus_id'] . $data['deal_user_id'] . $data['deal_time']);
        //$info = $this->modelSysMsg->getValue(['uniquekey' => $uniquekey], 'uniquekey');
        $info = Db::name('sys_msg')->where('uniquekey', $uniquekey)->value('uniquekey');
        $data['uniquekey'] = $uniquekey;
        if (empty($info)) {
            Db::name('sys_msg')->insert($data);
        }
    }
}
