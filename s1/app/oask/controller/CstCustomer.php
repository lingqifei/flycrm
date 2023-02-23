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
 * 客户列表管理-控制器
 */
class CstCustomer extends OaskBase
{

	/**
	 * 客户列表列表=》查询
	 * @return mixed|string
	 */
	public function search()
	{
		if (IS_POST) {

			if(empty($this->param['keywords'])){
				$where['id']=['=',0];
			}else{
				$where['name|linkman|link_body|mobile|weixin|qicq|address|remark']=['like', '%' . $this->param['keywords'] . '%'];
			}

			$orderby = $this->logicCstCustomer->getOrderby($this->param);
			$list = $this->logicCstCustomer->getCstCustomerList($where, "*,TIMESTAMPDIFF(DAY,link_time,DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%S')) as nodays", $orderby);
			return $list;
		}
		$this->common_data();
		return $this->fetch('search');
	}

    /**
     * 客户列表列表=》列表
     * @return mixed|string
     */
    public function show()
    {
        if (!empty($this->param['listtype'])) {
            $this->assign('listtype', $this->param['listtype']);
        } else {
            $this->assign('listtype', 'selfson');
        }
        $this->common_data();
        return $this->fetch('show');
    }

	/**
	 * 客户列表列表=》列表
	 * @return mixed|string
	 */
	public function show_trace()
	{
		$this->common_data();
		return $this->fetch('show_trace');
	}

    /**
     * 客户列表列表=》模板
     * @return mixed|string
     */
    public function show_public()
    {

        if (IS_POST) {
            $where = $this->logicCstCustomer->getWhere($this->param);
            $where['openstatus'] = ['=', '0'];
            $orderby = $this->logicCstCustomer->getOrderby($this->param);
            $list = $this->logicCstCustomer->getCstCustomerList($where, "*,TIMESTAMPDIFF(DAY,link_time,DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%S')) as nodays", $orderby);
            return $list;
        }
        $this->common_data();
        return $this->fetch('show_public');
    }

    /**
     * 客户列表列表=》垃圾客户
     * @return mixed|string
     */
    public function show_rubbish()
    {

        if (IS_POST) {
            $where = $this->logicCstCustomer->getWhere($this->param);
            $where['openstatus'] = ['=', '-1'];
            $orderby = $this->logicCstCustomer->getOrderby($this->param);
            $list = $this->logicCstCustomer->getCstCustomerList($where, '*,TIMESTAMPDIFF(DAY,link_time,DATE_FORMAT(NOW(), \'%Y-%m-%d %H:%i:%S\')) as nodays', $orderby);
            return $list;
        }

        $this->common_data();
        return $this->fetch('show_rubbish');
    }


    /**
     * 客户列表列表-》json数据
     * @return
     */
    public function show_json()
    {

        $where = $this->logicCstCustomer->getWhere($this->param);
        $where['openstatus'] = ['=', '1'];
        $orderby = $this->logicCstCustomer->getOrderby($this->param);
        $list = $this->logicCstCustomer->getCstCustomerList($where, '*,TIMESTAMPDIFF(DAY,link_time,DATE_FORMAT(NOW(), \'%Y-%m-%d %H:%i:%S\')) as nodays', $orderby);
        return $list;
    }


    /**
     * 客户列表添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicCstCustomer->cstCustomerAdd($this->param));

        $this->common_data();

        return $this->fetch('add');
    }

    /**
     * 客户列表编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicCstCustomer->cstCustomerEdit($this->param));

        $this->common_data();
        $info = $this->logicCstCustomer->getCstCustomerInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        return $this->fetch('edit');
    }

    /**
     * 客户详细展示
     * @return mixed|string
     */

    public function detail()
    {

        //详细=>关联数据调用
        if (!empty($this->param['type'])) {
            $list = $this->logicCstCustomer->getCstCustomerDetail($this->param);
            return $list;
        }
        $this->common_data();
        $info = $this->logicCstCustomer->getCstCustomerInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        return $this->fetch('detail');
    }

	/**
	 * 客户详细展示
	 * @return mixed|string
	 */

	public function detail_trace()
	{

		//详细=>关联数据调用
		if (!empty($this->param['type'])) {
			$list = $this->logicCstCustomer->getCstCustomerDetail($this->param);
			return $list;
		}
		$this->common_data();
		$info = $this->logicCstCustomer->getCstCustomerInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail_trace');
	}

    /**
     * 客户列表删除
     */
    public function del()
    {
        $this->jump($this->logicCstCustomer->cstCustomerDel($this->param));
    }

    /**
     * 客户转为公海
     */
    public function gotopublic()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicCstCustomer->cstCustomerToPublicl($where));
    }

    /**
     * 客户转为零取
     */
    public function gotopersonal()
    {
        $this->jump($this->logicCstCustomer->cstCustomerToPersonal($this->param));
    }

    /**
     * 客户转为垃圾
     */
    public function gotorubbish()
    {
        $this->jump($this->logicCstCustomer->cstCustomerToRubbish($this->param));
    }

    /**
     * 公共数据
     * Author: lingqifei created by at 2020/6/15 0015
     */
    public function common_data()
    {
        $dict = $this->logicCstDict->getCstDictListTypeall();
        $this->assign('dict', $dict);

        $sys_user = $this->logicSysUser->getSysUserSubList();
        $this->assign('sys_user_list', $sys_user);

        $this->assign('sys_user_id', SYS_USER_ID);

        if(!empty($this->param['customer_id'])){
            $this->assign('customer_id', $this->param['customer_id']);
        }else{
            $this->assign('customer_id', '0');
        }

        if(!empty($this->param['chance_id'])){
            $this->assign('chance_id', $this->param['chance_id']);
        }else{
            $this->assign('chance_id', '0');
        }

        if(!empty($this->param['linkman_id'])){
            $this->assign('linkman_id', $this->param['linkman_id']);
        }else{
            $this->assign('linkman_id', '0');
        }

        //指定是否为公海
        if(!empty($this->param['openstatus'])){
            $this->assign('openstatus', $this->param['openstatus']);
        }else{
            $this->assign('openstatus', '0');
        }

    }

    /**
     * 下载导出
     */
    public function download()
    {
        $where =$this->logicCstCustomer->getWhere($this->param);
        if (!empty($this->param['openstatus'])) {
            $where['openstatus'] = ['=', $this->param['openstatus']];
        }
        $this->logicCstCustomer->getCstCustomerListDown($where);
    }

    /**
     * 上传导出=》私人
     */
    public function upload()
    {

		if(!empty($this->param['ajaxmodel'])){
			switch ($this->param['ajaxmodel']){
				case 'get':
					return	$this->logicUpload->getUploadFile($this->param);
					break;
				case 'del':
					return	$this->jump($this->logicUpload->delUploadFile($this->param));
					break;
				case 'upload':
					return	$this->jump($this->logicUpload->uploadFile($this->param));
					break;
				case 'import':
					$this->param['openstatus']=1;//表示私人
					return	$this->jump($this->logicCstCustomer->getCstCustomerUpload($this->param));
					break;
			}
		}
		$uploadfilepath='customer';
		$uploadtarget=url('CstCustomer/upload',array('ajaxmodel'=>'upload','uploadfilepath'=>$uploadfilepath));
		$this->assign('uploadfilepath', $uploadfilepath);
		$this->assign('ajaxtarget', url());
		$this->assign('uploadtarget', $uploadtarget);

        return $this->fetch('upload/upload');
    }

	/**
	 * 上传导出=>公海
	 */
	public function upload_public()
	{

		if(!empty($this->param['ajaxmodel'])){
			switch ($this->param['ajaxmodel']){
				case 'get':
					return	$this->logicUpload->getUploadFile($this->param);
					break;
				case 'del':
					return	$this->jump($this->logicUpload->delUploadFile($this->param));
					break;
				case 'upload':
					return	$this->jump($this->logicUpload->uploadFile($this->param));
					break;
				case 'import':
					return	$this->jump($this->logicCstCustomer->getCstCustomerUpload($this->param));
					break;
			}
		}
		$uploadfilepath='customer';
		$uploadtarget=url('CstCustomer/upload',array('ajaxmodel'=>'upload','uploadfilepath'=>$uploadfilepath));
		$this->assign('uploadfilepath', $uploadfilepath);
		$this->assign('ajaxtarget', url());
		$this->assign('uploadtarget', $uploadtarget);

		return $this->fetch('upload/upload');
	}

}
