<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Commor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\material\logic;

use app\common\logic\TableField;
use think\Db;

/**
 * 共享数据管理=》逻辑层
 */
class Comm extends MaterialBase
{


    /**suggest根据关联数据
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/2 0002 11:20
     */
    public function getSuggestDataList($data = [])
    {
        $list = [];
        $where = [];
        if (!empty($data['datatype'])) {
            switch ($data['datatype']) {
                case "customer":
                    if (empty($data['keywords'])) {
                        $where['openstatus'] = ['=', '1'];
                    } else {
                        $where['name|linkman|link_body|mobile|weixin|qicq|address|remark'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('cst_customer')) {
                        $list = Db::name('cst_customer')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "supplier":
                    if (!empty($data['keywords'])) {
                        $where['name|linkman|mobile|weixin|qicq|address|remark'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('sup_supplier')) {
                        $list = Db::name('sup_supplier')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "linkman":
                    if (!empty($data['customer_id'])) {
                        $where['customer_id'] = ['=', $data['customer_id']];
                    }
                    if (!empty($data['keywords'])) {
                        $where['name|mobile|qicq|address|remark'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('cst_linkman')) {
                        $list = Db::name('cst_linkman')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "chance":
                    if (!empty($data['customer_id'])) {
                        $where['customer_id'] = ['=', $data['customer_id']];
                    }
                    if (!empty($data['keywords'])) {
                        $where['name|remark'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('cst_chance')) {
                        $list = Db::name('cst_chance')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "store":
                    if (!empty($data['keywords'])) {
                        $where['name'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('material_store')) {
                        $list = Db::name('material_store')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "brand":
                    if (!empty($data['keywords'])) {
                        $where['name'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('material_brand')) {
                        $list = Db::name('material_brand')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;

                case "colour":
                    if (!empty($data['keywords'])) {
                        $where['name'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('material_colour')) {
                        $list = Db::name('material_colour')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "quality":
                    if (!empty($data['keywords'])) {
                        $where['name'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('material_quality')) {
                        $list = Db::name('material_quality')->field('id,name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "shelves":
                    if (!empty($data['keywords'])) {
                        $where['name|shelves_code'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    if (tableExists('material_shelves')) {
                        $list = Db::name('material_shelves')->field('id,name,shelves_code')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "shelves_cell":
                    if (!empty($data['keywords'])) {
                        $where['name|shelves_code'] = ['like', '%' . $data['keywords'] . '%'];
                    }
                    $where['use_status']=['=',1];//只显未用的
                    if (tableExists('material_shelves_cell')) {
                        $list = Db::name('material_shelves_cell')->field('id,shelves_cell_code as name')
                            ->where($where)
                            ->select();
                    }
                    break;
                case "collectmoney":
                    $list = $this->getCollectMoney($data);//需要收款的业务
                    break;
                case "paymentmoney":
                    $list = $this->getPaymentMoney($data);//需要付款的业务
                    break;

                case "receinvoice":
                    $list = $this->getReceInvoice($data);//可以收票
                    break;

                case "payinvoice":
                    $list = $this->getPayInvoice($data);//可以开票
                    break;
            }
        }
        return $list;
    }


    /**需要收款的业务
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/3 0003 9:10
     */
    public function getCollectMoney($data = [])
    {

        $list = [];
        $tmp = [];
        $map['customer_id'] = ['=', $data['customer_id']];

        //销售合同
        if ($this->tableExists('sal_contract')) {
            $unpaid_list = Db::name('sal_contract')
                ->where($map)
                ->where('money>back_money')//合同金额大于回款金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'id' => $row['id'],
                    'bus_type' => 'sal_contract',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                ];
            }
        }
        //销售订单
        if ($this->tableExists('sal_order')) {
            $unpaid_list = Db::name('sal_order')
                ->where($map)
                ->where('money>back_money')//合同金额大于回款金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'sal_order',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                ];
            }
        }
        //项目表
        if ($this->tableExists('project')) {
            $unpaid_list = Db::name('project')
                ->where($map)
                ->where('sell_money>back_money')//合同金额大于回款金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'project',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                ];
            }
        }
        $list = $tmp;
        return $list;
    }

    /**需要付款的业务
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/3 0003 9:10
     */
    public function getPaymentMoney($data = [])
    {

        $tmp = [];
        $map['supplier_id'] = ['=', $data['supplier_id']];
        if ($this->tableExists('pos_contract')) {
            $unpaid_list = Db::name('pos_contract')
                ->where($map)
                ->where('money>pay_money')//合同金额大于付款金额
                ->field('id,name,money,pay_money,invoice_money,zero_money,purchase_date')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'pos_contract',
                    'bus_type_name' => '采购合同',
                    'bus_date' => $row['purchase_date'],
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                    'money' => $row['money'],
                    'pay_money' => $row['pay_money'],
                    'zero_money' => $row['zero_money'],
                    'invoice_money' => $row['invoice_money'],
                ];
            }
        }

        if ($this->tableExists('project_purchase')) {
            $unpaid_list = Db::name('project_purchase')
                ->where($map)
                ->where('money>pay_money')//合同金额大于付款金额
                ->field('id,name,money,pay_money,invoice_money,zero_money,purchase_date')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'project_purchase',
                    'bus_type_name' => '项目采购单',
                    'bus_date' => $row['purchase_date'],
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                    'money' => $row['money'],
                    'pay_money' => $row['pay_money'],
                    'zero_money' => $row['zero_money'],
                    'invoice_money' => $row['invoice_money'],
                ];
            }
        }
        $list = $tmp;
        return $list;
    }


    /**
     * 需要开票的业务=》针对客户
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/3 0003 9:10
     */
    public function getPayInvoice($data = [])
    {
        $tmp = [];
        $map['customer_id'] = ['=', $data['customer_id']];
        if ($this->tableExists('sal_contract')) {
            $unpaid_list = Db::name('sal_contract')
                ->where($map)
                ->where('money>invoice_money')//合同金额大于开票金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'sal_contract',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                ];
            }
        }

        //项目表
        if ($this->tableExists('project')) {
            $unpaid_list = Db::name('project')
                ->where($map)
                ->where('sell_money>invoice_money')//合同金额大于回款金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'project',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                ];
            }
        }
        $list = $tmp;
        return $list;
    }


    /**需要收票的业务
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/3 0003 9:10
     */
    public function getReceInvoice($data = [])
    {

        $tmp = [];
        $map['supplier_id'] = ['=', $data['supplier_id']];
        if ($this->tableExists('pos_contract')) {
            $unpaid_list = Db::name('pos_contract')
                ->where($map)
                ->where('money>invoice_money')//合同金额大于付款金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'pos_contract',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                ];
            }
        }

        if ($this->tableExists('project_purchase')) {
            $unpaid_list = Db::name('project_purchase')
                ->where($map)
                ->where('money>invoice_money')//合同金额大于付款金额
                ->field('id,name')
                ->select();
            foreach ($unpaid_list as &$row) {
                $tmp[] = [
                    'bus_type' => 'project_purchase',
                    'bus_id' => $row['id'],
                    'name' => $row['name'],
                    'id' => $row['id'],
                ];
            }
        }
        $list = $tmp;
        return $list;
    }

    /**选中后回调数据=>ajax加载业务详细
     * @param array $data
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/3 0003 10:29
     */
    public function getSuggestDataInfo($data = [])
    {
        $info = [];
        if (!empty($data['bus_type'])) {
            switch ($data['bus_type']) {
                case "sal_contract":
                    if (tableExists('sal_contract')) {
                        $info = Db::name('sal_contract')->field('*')
                            ->where(['id' => $data['id']])
                            ->find();
                    }
                    break;
                case "sal_order":
                    if (tableExists('sal_order')) {
                        $info = Db::name('sal_order')->field('*')
                            ->where(['id' => $data['id']])
                            ->find();
                        break;
                    }
                case "project":
                    if (tableExists('project')) {
                        $info = Db::name('project')->field('id,sell_money as money,back_money,invoice_money,zero_money')
                            ->where(['id' => $data['id']])
                            ->find();
                        break;
                    }
                case "pos_contract":
                    if (tableExists('pos_contract')) {
                        $info = Db::name('pos_contract')->field('*')
                            ->where(['id' => $data['id']])
                            ->find();
                    }
                    break;
                case "project_purchase":
                    if (tableExists('project_purchase')) {
                        $info = Db::name('project_purchase')->field('id,money,pay_money,invoice_money,zero_money')
                            ->where(['id' => $data['id']])
                            ->find();
                    }
                    break;
            }
        }
        return $info;
    }

}
