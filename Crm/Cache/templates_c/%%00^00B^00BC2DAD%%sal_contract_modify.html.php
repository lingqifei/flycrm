<?php /* Smarty version 2.6.26, created on 2017-04-11 12:18:56
         compiled from sal_contract/sal_contract_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/SalContract/sal_contract_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		
		<div class="pageFormContent" layoutH="56">
			<fieldset>
			<legend>基础信息：</legend>
			<p>
				<label>合同编号：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['con_number']; ?>
" name="con_number" class="required" >
			</p>
			<p>
				<label>主题：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['title']; ?>
" name="title" class="required">
			</p>	
			<p>
				<label>金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['money']; ?>
" name="money" class="required digits">
			</p>		
			<p>
				<label>客户名称：</label>
				<input id="cusID" name="org.id" value="<?php echo $this->_tpl_vars['one']['cusID']; ?>
" type="hidden"/>
				<input name="org.name" value="<?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['one']['cusID']]; ?>
" type="text" class="required"/>
				<a class="btnLook" href="<?php echo @ACT; ?>
/Customer/lookup_search/" lookupGroup="org">选择供应商</a>	
			</p>
			
			<p>
				<label>联系人：</label>
				<input name="linkman.id" value="<?php echo $this->_tpl_vars['one']['linkmanID']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['one']['linkmanID']]; ?>
" name="linkman.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_select/cusID/{cusID}/" warn="请选择客户名称" lookupGroup="linkman"/>
			</p>
			<p>
				<label>销售机会：</label>
				<input name="chance.id" value="<?php echo $this->_tpl_vars['one']['chanceID']; ?>
" type="hidden"/>
				<input name="chance.title" value="<?php echo $this->_tpl_vars['chance'][$this->_tpl_vars['one']['chanceID']]; ?>
" type="text" postField="keyword" suggestFields="title" 
					suggestUrl="<?php echo @ACT; ?>
/CstChance/cst_chance_select/cusID/{cusID}/" warn="请选择客户名称" lookupGroup="chance"/>
			</p>
			<p>
				<label>有效期起始：</label>
				<input type="text" name="bdt" class="date required" value="<?php echo $this->_tpl_vars['one']['bdt']; ?>
" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
			</p>
			<p>
				<label>有效期终止：</label>
				<input type="text" name="edt" class="date required" value="<?php echo $this->_tpl_vars['one']['edt']; ?>
" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span class="info">yyyy-MM-dd</span>
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