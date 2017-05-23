<?php /* Smarty version 2.6.26, created on 2017-05-18 15:13:33
         compiled from cst_chance/cst_chance_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/CstChance/cst_chance_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		
		<div class="pageFormContent" layoutH="56">
			<fieldset>
			<legend>基础信息：</legend>
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
				<label>当前阶段：</label>
				<input name="salestage.id" value="<?php echo $this->_tpl_vars['one']['salestage']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['salestage']]; ?>
" name="salestage.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/salestage/" lookupGroup="salestage"/>
			</p>

			<p>
				<label>发现时间：</label>
				<input type="text" name="finddt" value="<?php echo $this->_tpl_vars['one']['finddt']; ?>
" class="date" dateFmt="yyyy-MM-dd HH:mm:ss" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
			</p>
			<p>
				<label>预计签单时间：</label>
				<input type="text" name="billdt" value="<?php echo $this->_tpl_vars['one']['billdt']; ?>
" class="date" dateFmt="yyyy-MM-dd HH:mm:ss" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
			</p>
			<p>
				<label>预计金额：</label>
				<input type="text" name="money" value="<?php echo $this->_tpl_vars['one']['money']; ?>
" class="required digits" size="10">
			</p>			
			<p>
				<label>可能性：</label>
				<input type="text" name="chance" value="<?php echo $this->_tpl_vars['one']['chance']; ?>
" class="required digits" min="1" max="100" size="10" alt="50%">
			</p>	
			<p>
				<label>当前状态：</label>
				<?php echo $this->_tpl_vars['status']; ?>

			</p>	
			</fieldset>
			<div class="divider"></div>			
			<fieldset>
				<legend>主题：</legend>
					<dl class="nowrap">
						<input name="title" class="required" type="text" size="50" value="<?php echo $this->_tpl_vars['one']['title']; ?>
" alt="请输联系主题内容"/>
					</dl>	
				<legend>具体需求：</legend>
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