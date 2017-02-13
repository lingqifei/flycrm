<?php /* Smarty version 2.6.26, created on 2016-11-18 21:36:35
         compiled from fin_pay_plan/fin_pay_plan_modify.html */ ?>
<h2 class="contentTitle">确认付款</h2>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/FinPayPlan/fin_pay_plan_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="97">
			<fieldset>
			<legend>基础信息：</legend>	
			<p>
				<label>供应商名称：</label>
				<input id="supID"  name="org.id" value="<?php echo $this->_tpl_vars['one']['supID']; ?>
" type="hidden"/>
				<input name="org.name" type="text" class="required" value="<?php echo $this->_tpl_vars['one']['sup_name']; ?>
" readonly="true"/>
			</p>
			
			<p>
				<label>采购订单：</label>
				<input name="order.id" value="<?php echo $this->_tpl_vars['one']['posID']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['posorder']['title']; ?>
" name="order.name" type="text"  readonly="true"/>
			</p>
			<p>
				<label>计划付款日期：</label>
				<input type="text" name="plandate" value="<?php echo $this->_tpl_vars['one']['plandate']; ?>
" class="required" readonly="true"/>
			</p>
			<p>
				<label>总金额：</label>
				<input type="text" name="order.money" value="<?php echo $this->_tpl_vars['posorder']['money']; ?>
" class="required" readonly="true"/>
			</p>
 			<p>
				<label>付款期次：</label>
				<input type="text" name="stages" value="<?php echo $this->_tpl_vars['one']['stages']; ?>
" class="required" readonly="true"/>	
			</p>
			<p>
				<label>已付金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['posorder']['pay_money']; ?>
" name="order.pay_money" readonly="true">
			</p>	
			<p>
				<label>发票金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['posorder']['bill_money']; ?>
" name="order.bill_money" class="required" readonly="true"/>	
			</p>
			<p>
				<label>去零金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['posorder']['zero_money']; ?>
" name="order.zero_money" readonly="true">
			</p>
			<p>
				<label>付款金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['money']; ?>
" name="plan_money" class="required digits" readonly="true">
			</p>
			<p>
				<label>付款日期：</label>
				<input type="text" name="paydate" class="date required" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
			</p>
            <p>
            	<label>付款帐户：</label>
				<input name="blank.id" value="" type="hidden"/>
				<input class="required" name="blank.card" type="text" postField="keyword" suggestFields="card" 
					suggestUrl="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_accoun_select/" warn="请选择采购订单" lookupGroup="blank"/>
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