<?php /* Smarty version 2.6.26, created on 2016-11-18 21:33:54
         compiled from pos_order/pos_order_add.html */ ?>
<h2 class="contentTitle">采购订单添加</h2>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/PosOrder/pos_order_add/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="97">
			<fieldset>
			<legend>基础信息：</legend>
			<p>
				<label>订单编号：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['number']; ?>
" name="pos_number" class="required" >
			</p>
			<p>
				<label>主题：</label>
				<input type="text" value="" name="title" class="required">
			</p>		
			<p>
				<label>供应商名称：</label>
				<input id="supID"  name="org.id" value="" type="hidden"/>
				<input name="org.name" type="text" class="required"/>
				<a class="btnLook" href="<?php echo @ACT; ?>
/Supplier/lookup_search/" lookupGroup="org">选择供应商</a>	
			</p>
			
			<p>
				<label>联系人：</label>
				<input name="linkman.id" value="" type="hidden"/>
				<input class="required" name="linkman.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/SupLinkman/sup_linkman_select/supID/{supID}/" warn="请选择联系人名称" lookupGroup="linkman"/>
			</p>
			<p>
				<label>采购时间：</label>
				<input type="text" name="bdt" class="date required" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
			</p>
			<p>
				<label>预计到货时间：</label>
				<input type="text" name="edt" class="date required" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
			</p>
			<p>
				<label>我方代表：</label>
				<input id="our_userID" name="our.id" value="" type="hidden"/>
				<input name="our.name" type="text" class="required"/>
				<a class="btnLook" href="<?php echo @ACT; ?>
/User/lookup_search/" lookupGroup="our">选择客户</a>	
			</p>
			<p>
				<label>总金额：</label>
				<input type="text" value="" name="money" class="required digits">
			</p>	
			<p>
				<label>去零金额：</label>
				<input type="text" value="" name="zero_money" class="required digits">
			</p>
			<p>
				<label>已付金额：</label>
				<input type="text" value="" name="pay_money" class="required digits">
			</p>
			</fieldset>
			<div class="divider"></div>			
		
			<fieldset>
				<legend>备注：</legend>
					<dl class="nowrap">
						<textarea name="intro" cols="80" rows="5"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
					</dl>	
			</fieldset>		
			
		</div>
			<div class="formBar">
				<ul>
					<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
					<li>
						<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
					</li>
				</ul>
			</div>
	</form>
</div>