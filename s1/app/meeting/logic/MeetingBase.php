<?php
/*
*
* meeting.logic  逻辑层基础类
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2025 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
* @link ：http://www.07fly.xyz
* @Date:2022-12-20 09:50:11
*/
namespace app\meeting\logic;
use app\common\logic\LogicBase;

/**
 * 模块基类
 */
class MeetingBase extends LogicBase{
    /**
     * 数据排序设置
     */
    public function setSort($model = null, $param = null)
    {

        $model_str = LAYER_MODEL_NAME . $model;

        $obj = $this->$model_str;

        $result = $obj->setFieldValue(['id' => (int)$param['id']], 'sort', (int)$param['value']);

        $result && action_log('数据排序', '数据排序调整' . '，model：' . $model . '，id：' . $param['id'] . '，value：' . $param['value']);

        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
    }

    /**
     * 字段数据设置
     */
    public function setField($model = null, $param = null)
    {
        $model_str = LAYER_MODEL_NAME . $model;

        $obj = $this->$model_str;

        $result = $obj->setFieldValue(['id' => (int)$param['id']], $param['name'], (int)$param['value']);

        $result && action_log('数据更新', '数据更新调整' . '，model：' . $model . '，id：' . $param['id'] . '，name：' . $param['name'] . '，value：' . $param['value']);

        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
    }
}
?>