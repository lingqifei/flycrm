<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Contactsor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 通讯录列表管理=》逻辑层
 */
class Contacts extends OaskBase
{

    private $files_path = '';

    public function __construct()
    {

    }

    /**
     * 通讯录列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getContactsList($where = [], $field = true, $order = 'update_time desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelContacts->getList($where, $field, $order, $paginate);

        foreach ($list as &$row) {
            $row['type_name']=$this->modelContactsType->getValue(['id'=>$row['type_id']],'name');
        }
        return $list;
    }

    /**
     * 通讯录列表添加
     * @param array $data
     * @return array
     */
    public function contactsAdd($data = [])
    {

        $validate_result = $this->validateContacts->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateContacts->getError()];
        }
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelContacts->setInfo($data);

        $url = url('show');
        $result && action_log('新增', '新增通讯录列表：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelContacts->getError()];
    }

    /**
     * 通讯录列表编辑
     * @param array $data
     * @return array
     */
    public function contactsEdit($data = [])
    {

        $validate_result = $this->validateContacts->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateContacts->getError()];
        }

		$result = $this->modelContacts->setInfo($data);

        $result && action_log('编辑', '编辑通讯录列表，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelContacts->getError()];
    }

    /**
     * 通讯录列表删除
     * @param array $where
     * @return array
     */
    public function contactsDel($data = [])
    {
        if(!empty($data['id'])){
            $where['id'] = ['=',$data['id']];
        }else{
            $where['id'] = ['=',0];
        }
        $result = $this->modelContacts->deleteInfo($where, true);
        $result && action_log('删除', '删除通讯录列表，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelContacts->getError()];
    }

    /**通讯录列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getContactsInfo($where = [], $field = true)
    {
        $info= $this->modelContacts->getInfo($where, $field);
        $info['create_user_name'] = $this->logicSysUser->getValue(['id'=>$info['create_user_id']],'realname');
        return $info;
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name|mobile|email|address|remark'] = ['like', '%' . $data['keywords'] . '%'];
        !empty($data['pid']) && $where['type_id'] = ['=', '' . $data['pid'] . ''];
        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by = "";
        if (!empty($data['orderField'])) {
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        } else {
            $orderField = "";
            $orderDirection = "";
        }
        if ($orderField == 'by_link') {
            $order_by = "link_time $orderDirection";
        } else if ($orderField == 'by_next') {
            $order_by = "next_time $orderDirection";
        } else if ($orderField == 'by_nodays') {
            $order_by = "nodays $orderDirection";
        } else {
            $order_by = "id desc";
        }
        return $order_by;
    }


}
