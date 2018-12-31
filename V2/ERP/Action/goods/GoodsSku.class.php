<?php
 /*
 *
 * admin.GoodsSku  商品SKU库   
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
class GoodsSku extends Action {

	private $cacheDir = ''; //缓存目录
	private $auth;
	public function __construct() {
		$this->auth = _instance( 'Action/sysmanage/Auth' );
	}

	public function goods_sku_add_save($goods_id,$datalist){
		//print_r($datalist);
		//统一删除商品所有图片
		$this->C($this->cacheDir)->delete('fly_goods_sku',"goods_id='$goods_id'");
		if(!empty($datalist['sku_name'])){
			foreach($datalist['sku_name'] as $key=>$sku){
				$into_data=array(
					'goods_id'=>$goods_id,
					'sku_name'=>$datalist['sku_name'][$key],
					'sku_value_items'=>$datalist['sku_value_items'][$key],
					'market_price'=>$datalist['sku_market_price'][$key],
					'sale_price'=>$datalist['sku_sale_price'][$key],
					'cost_price'=>$datalist['sku_cost_price'][$key],
					'stock'=>$datalist['sku_stock'][$key],
					'create_date'=>NOWTIME,
					'update_date'=>NOWTIME,
				);
				$this->C($this->cacheDir)->insert('fly_goods_sku',$into_data);
				//$sql = "insert into fly_goods_img(goods_id,img_path) values('$goods_id','$row')";
				//$this->C($this->cacheDir)->update($sql);
			}			
		}
	}
	//得到商品的所有sku
	public function goods_sku_list($id){
		if(empty($id)) $id=0;
		$sql	="select * from fly_goods_sku where goods_id='$id'";	
		$list	=$this->C($this->cacheDir)->findAll($sql);
		return $list;
	}
	

	

} //
?>