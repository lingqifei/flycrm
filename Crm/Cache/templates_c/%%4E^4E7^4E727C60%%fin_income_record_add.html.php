<?php /* Smarty version 2.6.26, created on 2016-12-14 20:44:31
         compiled from fin_income_record/fin_income_record_add.html */ ?>
<h2 class="contentTitle">收入记录添加</h2>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/FinIncomeRecord/fin_income_record_add/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent nowrap" layoutH="97">
			<fieldset>
			<legend>基础信息：</legend>	
			<dl>
				<label>费用类型：</label>
                <?php echo $this->_tpl_vars['parentID']; ?>
		
			</dl>
			<dl>
				<label>产生日期：</label>
				<input type="text" name="crt_date" class="date required" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
			</dl>
			<dl>
				<label>总金额：</label>
				<input type="text" name="money" class="required"/>
			</dl>
            <dl>
            	<label>付款帐户：</label>
				<input name="blank.id" value="" type="hidden"/>
				<input class="required" name="blank.card" type="text" postField="keyword" suggestFields="card" 
					suggestUrl="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_accoun_select/" warn="请选择采购订单" lookupGroup="blank"/>
            </dl>
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