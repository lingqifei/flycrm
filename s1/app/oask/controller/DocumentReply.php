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
 * 公告评论-控制器
 */
class DocumentReply extends OaskBase
{

	/**
	 * 构造方法
	 */
	public function __construct()
	{
		// 执行父类构造方法
		parent::__construct();

	}


	/**
	 * 监管部门文件列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 监管部门文件列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicDocumentReply->getWhere($this->param);
		$orderby = $this->logicDocumentReply->getOrderby($this->param);
		$list = $this->logicDocumentReply->getDocumentReplyList($where, 'a.*,s.name as shop_name', $orderby);
		return $list;
	}

	/**
	 * 监管部门文件列表-》json数据
	 * @return
	 */
	public function show_file_json()
	{
		$where = $this->logicDocumentReply->getWhere($this->param);
		$list = $this->logicDocumentReply->getDocumentReplyList($where, 'a.*', 'a.create_time desc',false);
		return $list;
	}


	/**
	 * 监管部门文件添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicDocumentReply->documentReplyReplyAdd($this->param));

		if(!empty($this->param['document_id'])){
			$this->assign('document_id',$this->param['document_id']);
		}else{
			$this->assign('document_id',0);
		}

		return $this->fetch('add');
	}

	/**
	 * 监管部门文件编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicDocumentReply->documentReplyReplyEdit($this->param));

		$info = $this->logicDocumentReply->getDocumentReplyInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 监管部门文件删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicDocumentReply->documentReplyReplyDel($where));
	}

}
