<?php /* Smarty version 2.6.26, created on 2016-12-16 21:08:53
         compiled from cst_service/cst_service_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/CstService/cst_service_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
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
				<label>服务类型：</label>
				<input name="services.id" value="<?php echo $this->_tpl_vars['one']['services']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['services']]; ?>
" name="services.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/services/" lookupGroup="services"/>
			</p>
			<p>
				<label>服务方式：</label>
				<input name="servicesmodel.id" value="<?php echo $this->_tpl_vars['one']['servicesmodel']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['servicesmodel']]; ?>
" name="servicesmodel.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/servicesmodel/" lookupGroup="servicesmodel"/>
			</p>
			<p>
				<label>开始时间：</label>
				<input type="text" name="bdt"  value="<?php echo $this->_tpl_vars['one']['bdt']; ?>
" class="date" dateFmt="yyyy-MM-dd HH:mm:ss" readonly="true"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
			</p>
			<p>
				<label>花费时间：</label>
				<input type="text" name="tlen"  value="<?php echo $this->_tpl_vars['one']['tlen']; ?>
"  class="digits" alt="默认为分钟"/>
			</p>
			<p>
				<label>处理状态：</label>
				<?php echo $this->_tpl_vars['status']; ?>

			</p>
			</fieldset>
			<div class="divider"></div>
			
			
			<fieldset>
				<legend>服务内容：</legend>
					<dl class="nowrap">
						<textarea name="content" cols="120" rows="3"><?php echo $this->_tpl_vars['one']['content']; ?>
</textarea>
					</dl>	
			</fieldset>	
			<fieldset>
				<legend>备注：</legend>
					<dl class="nowrap">
						<textarea name="intro" cols="120" rows="3"><?php echo $this->_tpl_vars['one']['intro']; ?>
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