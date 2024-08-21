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
class SysMsg extends AdminBase
{

    /**
     * 系统消息添加
     * @param $bus_type  //业务类型
     * @param $bus_id   //业务id
     * @param $bus_name //业务名称
     * @param $deal_user_id //提醒的人员
     * @param $deal_time    //业务开始时间
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/1 12:14
     */
    public function sysMsgAddApi($bus_type = '', $bus_id = '', $bus_name = '', $deal_user_id = '', $deal_time = '')
    {
        $info = Db::name('sys_msg_type')->where(['type' => $bus_type])->find();
        if ($info) {
            if(is_array($deal_user_id)){
                $user_arr=$deal_user_id;
            }else{
                $user_arr=str2arr($deal_user_id);
            }
            foreach ($user_arr as $user_id){
                $intoData = [
                    'bus_type_name' => $info['name'],
                    'remind_sms' => $info['remind_sms'],
                    'remind_sys' => $info['remind_sys'],
                    'remind_email' => $info['remind_email'],
                    'remind_weixin' => $info['remind_weixin'],
                    'remind_nums' => $info['remind_nums'],//提醒的总次数
                    'remind_interval' => $info['remind_interval'],//提醒间隔时间
                    'remind_time' => format_time(),//开始提醒时间
                    'bus_type' => $bus_type,
                    'bus_id' => $bus_id,
                    'bus_name' => $bus_name,
                    'deal_user_id' => $user_id,
                    'deal_time' => $deal_time,//业务实际的时间
                ];
                Db::name('sys_msg')->insert($intoData);
            }
        }else{
            throw_response_error('业务类型未知~');
        }
    }


    /**
     * 回显 =>业务订单详细
     * @param array $data
     * @return array
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/9 0009
     */
    public function getSysMsgBusUrl($bus_type, $bus_id)
    {
        $url = '';
        //判断模块
        if ($this->appExists('erp')) {
            $model_name = 'erp';
        } else {
            $model_name = 'crm';
        }
        //根据关联业务类型
        if (!empty($bus_type)) {
            switch ($bus_type) {
                case "cst_customer":
                    if (tableExists('cst_customer')) {
                        //$info = Db::name('cst_customer')->where(['id' => $bus_id])->find();
                        $url = url($model_name . '/CstCustomer/detail', array('id' => $bus_id));
                    }
                    break;
                case "cst_chance":
                    if (tableExists('cst_chance')) {
                        //$info = Db::name('cst_chance')->field('customer_id,id')->where(['id' => $bus_id])->find();
                        $url = url($model_name . '/CstChance/detail', array('id' => $bus_id));
                    }
                    break;
                case "cst_clue":
                    if (tableExists('cst_clue')) {
                        //$info = Db::name('cst_clue')->where(['id' => $bus_id])->find();
                        $url = url($model_name . '/CstClue/detail', array('id' => $bus_id));
                    }
                    break;
                case "sal_contract":
                    if (tableExists('sal_contract')) {
                        //$info = Db::name('sal_contract')->where(['id' => $bus_id])->find();
                        $url = url($model_name . '/SalContract/detail', array('id' => $bus_id));
                    }
                    break;
                case "sal_contract_expire":
                    if (tableExists('sal_contract')) {
                        //$info = Db::name('sal_contract')->where(['id' => $bus_id])->find();
                        $url = url($model_name . '/SalContract/detail', array('id' => $bus_id));
                    }
                    break;
                case "sal_order":
                    //$info = Db::name('sal_order')->where(['id' => $bus_id])->find();
                    $url = url($model_name . '/SalOrder/detail', array('id' => $bus_id));
                    break;
                //日程详细
                case "oa_schedule":
                    $url = url('oa/OaSchedule/detail', array('id' => $bus_id));
                    break;
                //工单详细
                case "oa_service":
                    $url = url('oa/OaService/detail', array('id' => $bus_id));
                    break;
                //任务详细
                case "oa_task":
                    $url = url('oa/OaTask/detail', array('id' => $bus_id));
                    break;
                //工作报告详细
                case "oa_work_report":
                    $url = url('oa/OaWorkReport/detail', array('id' => $bus_id));
                    break;
                //办公审批
                case "workflow_business_history":
                    $url = url('oa/WorkflowBusinessHistory/detail', array('id' => $bus_id));
                    break;
                default:
                    break;
            }
        }
        return $url;
    }

    /**
     * 应用表是否存在
     * @param $table
     * @return bool
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/6/18 0018 17:00
     */
    public function appExists($appname)
    {
        $condition['name'] = $appname;
        $condition['visible'] = 1;
        $module = $this->modelSysModule->getValue($condition, 'name');
        if (file_exists($module)) {
            return true;
        } else {
            return false;
        }
    }
}
