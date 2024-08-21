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

/**
 * 编码规则管理逻辑
 */
class SysSeqnum extends AdminBase
{

    // 面包屑
    public static $crumbs = [];

    // 编码规则管理结构
    public static $deptSelect = [];

    /**
     * 获取编码规则管理列表
     */
    public function getSysSeqnumList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
    {
        $where['org_id'] = ['>', 0];
        return $this->modelSysSeqnum->getList($where, $field, $order, $paginate);
    }

    /**
     * 获取编码规则管理信息
     */
    public function getSysSeqnumInfo($where = [], $field = true)
    {
        return $this->modelSysSeqnum->getInfo($where, $field);
    }

    /**
     * 编码规则管理添加
     */
    public function sysSeqnumAdd($data = [])
    {
        $validate_result = $this->validateSysSeqnum->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysSeqnum->getError()];
        }
        $result = $this->modelSysSeqnum->setInfo($data);
        $result && action_log('新增', '新增编码规则管理，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '添加成功', $result] : [RESULT_ERROR, $this->modelSysSeqnum->getError()];
    }

    /**
     * 编码规则管理编辑
     */
    public function sysSeqnumEdit($data = [])
    {

        $validate_result = $this->validateSysSeqnum->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysSeqnum->getError()];
        }
        $url = url('show');
        $result = $this->modelSysSeqnum->setInfo($data);
        $result && action_log('编辑', '编辑编码规则管理，name：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysSeqnum->getError()];
    }

    /**
     * 编码规则管理删除
     */
    public function sysSeqnumDel($where = [])
    {
        $result = $this->modelSysSeqnum->deleteInfo($where, true);
        $result && action_log('删除', '删除编码规则管理，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysSeqnum->getError()];
    }
}