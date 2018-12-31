<?php
/*
 *
 * crm.ContractList  客户销售合同管理   
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.top/crm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.top 
 */	
class PosContractList extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/sysmanage/Auth');
		$this->contract=_instance('Action/erp/PosContract');
	}	
	
	public function pos_contract_list(){
		$contract_id= $this->_REQUEST("contract_id");
		$totalSql= "select sum(cost_price) as total_cost_price,sum(goods_money) as total_goods_money,sum(num) as total_num 
				   from pos_contract_list  where contract_id='$contract_id'";	
		$totalRs = $this->C($this->cacheDir)->findOne($totalSql);
		
		$sql	= "select * from pos_contract_list where contract_id='$contract_id'";	
		$list	= $this->C($this->cacheDir)->findAll($sql);
		return array('list'=>$list,'totalSum'=>$totalRs);
	}

	public function pos_contract_list_json(){
		$assArr = $this->pos_contract_list();
		echo json_encode($assArr);
	}		

	public function pos_contract_list_add(){
		$contract_id= $this->_REQUEST("contract_id");
		if(empty($_POST)){
			$list['contract']=$this->contract->pos_contract_get_one($contract_id);
			$smarty = $this->setSmarty();
			$smarty->assign($list);
			$smarty->display('erp/pos_contract_list_add.html');	
		}else{
			
			$sku_id		= $this->_REQUEST("sku_id");
			$sku_name	= $this->_REQUEST("sku_name");
			$goods_id	= $this->_REQUEST("goods_id");
			$goods_name	= $this->_REQUEST("goods_name");
			$cost_price	= $this->_REQUEST("cost_price");
			$num		= $this->_REQUEST("num");
			$goods_money= $this->_REQUEST("goods_money");
			$remarks	= $this->_REQUEST("remarks");
			$total_goods_money=array_sum($goods_money);
			
			$contract_money= $this->_REQUEST("contract_money");
			if($contract_money<$total_goods_money){
				$this->L("Common")->ajax_json_error("明细商品总金额不能超过合同金额");
				return false;
			}
			
			//删除数据
			$this->C($this->cacheDir)->delete('pos_contract_list',"contract_id='$contract_id'");
			
			foreach($sku_id as $i=>$sku_one_id){
				$into_data=array(
					'contract_id'=>$contract_id,
					'sku_id'=>$sku_id[$i],
					'sku_name'=>$sku_name[$i],
					'goods_id'=>$goods_id[$i],
					'goods_name'=>$goods_name[$i],
					'cost_price'=>$cost_price[$i],
					'num'=>$num[$i],
					'goods_money'=>$goods_money[$i],
					'remarks'=>$remarks[$i],
					'create_time'=>NOWTIME,
					'create_user_id'=>SYS_USER_ID,
				);	
				$this->C($this->cacheDir)->insert('pos_contract_list',$into_data);
			}
			$this->C($this->cacheDir)->modify('pos_contract',array('rece_status'=>'2'),"contract_id='$contract_id'");
			//更新合同执行状态
			$this->contract->pos_contract_modify_status($contract_id);	
			$this->L("Common")->ajax_json_success("操作成功");
		}
	}	

	public function pos_contract_list_del($contract_id=null){
		$contract_id=($contract_id)?$contract_id:$this->_REQUEST('contract_id');
		$this->C($this->cacheDir)->delete('pos_contract_list',"contract_id in ($contract_id)");
		$this->C($this->cacheDir)->modify('pos_contract',array('rece_status'=>'1'),"contract_id='$contract_id'");
		//更新合同执行状态
		$this->contract->pos_contract_modify_status($contract_id);		
		$this->L("Common")->ajax_json_success("操作成功");
	}
		
}
?>