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

namespace app\oask\controller;

/**
* 门店列表管理-控制器
*/

class Shop extends OaskBase
{

    /**
     * 门店列表列表=》模板
     * @return mixed|string
     */
    public function show()
    {

        if(!empty($this->param['listtype'])){
            $this->assign('listtype', $this->param['listtype']);
        }else{
            $this->assign('listtype', 'selfson');
        }
        $this->common_data();
        return $this->fetch('show');
    }

    /**
     * 门店列表列表=》模板
     * @return mixed|string
     */
    public function show_public()
    {

        if(IS_POST){
            $where =[];
            $where =$this->logicShop->getWhere($this->param);
            $where['openstatus']=['=','0'];
            $orderby = $this->logicShop->getOrderby($this->param);
            $list = $this->logicShop->getShopList($where,"*",$orderby);
            return $list;
        }

        $this->common_data();
        return $this->fetch('show_public');
    }

    /**
     * 门店列表列表=》垃圾门店
     * @return mixed|string
     */
    public function show_rubbish()
    {

        if(IS_POST){
            $where = $this->logicShop->getWhere($this->param);
            $where['openstatus']=['=','-1'];
            $orderby = $this->logicShop->getOrderby($this->param);
            $list = $this->logicShop->getShopList($where,'*,TIMESTAMPDIFF(DAY,link_time,DATE_FORMAT(NOW(), \'%Y-%m-%d %H:%i:%S\')) as nodays',$orderby);
            return $list;
        }

        $this->common_data();
        return $this->fetch('show_rubbish');
    }


    /**
     * 门店列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicShop->getWhere($this->param);
        $orderby = $this->logicShop->getOrderby($this->param);
        $list = $this->logicShop->getShopList($where,'*',$orderby);
        return $list;
    }


    /**
     * 门店列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicShop->shopAdd($this->param));

        $this->common_data();

        return $this->fetch('add');
    }

    /**
     * 门店列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicShop->shopEdit($this->param));

        $this->common_data();

        $info = $this->logicShop->getShopInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 门店详细展示
     * @return mixed|string
     */

    public function detail()
    {

        //详细=>关联数据调用
        if(!empty($this->param['type'])){
            $list=$this->logicShop->getShopDetail($this->param);
            return $list;
        }
        $this->common_data();
        $info = $this->logicShop->getShopInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        return $this->fetch('detail');
    }

    /**
     * 门店列表删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicShop->shopDel($where));
    }

    /**
     * 公共数据
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/6/21 0021
     */
    public function common_data(){
        $dict= $this->logicCstDict->getCstDictListTypeall();
        $this->assign('dict', $dict);
        $sys_user=$this->logicSysUser->getSysUserSubList();
        $this->assign('sys_user_list', $sys_user);
        $this->assign('sys_user_id', SYS_USER_ID);

    }

    /**
     * 下载导出
     */
    public function download()
    {
        $where =$this->logicShop->getWhere($this->param);
        if (!empty($this->param['openstatus'])) {
            $where['openstatus'] = ['=', $this->param['openstatus']];
        }
        $this->logicShop->getShopListDown($where);
    }

    /**
     * 上传
     */
    public function upload()
    {

        $this->jump([RESULT_SUCCESS,'功能开发中~~']);
    }

}
