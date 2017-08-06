<?php /* Smarty version 2.6.26, created on 2017-07-22 22:08:20
         compiled from cst_website/cst_website_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/CstWebsite/cst_website_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">

			<p>
				<label>客户名称：</label>
				<input name="org.id" value="<?php echo $this->_tpl_vars['one']['cusID']; ?>
" type="hidden"/>
				<input name="org.name" type="text" value="<?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['one']['cusID']]; ?>
" class="required"/>
				<a class="btnLook" href="<?php echo @ACT; ?>
/Supplier/lookup_search/" lookupGroup="org">选择客户</a>	
			</p>
			<p>
				<label>网站名称：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" name="name" class="required">
			</p>
			<p>
				<label>网站地址：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['url']; ?>
" name="url" class="required">
			</p>
			<p>
				<label>FTP地址：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['ftp_ip']; ?>
" name="ftp_ip" class="required">
			</p>
			<p>
				<label>ICP帐号：</label>
					<input type="text" value="<?php echo $this->_tpl_vars['one']['icp_account']; ?>
" name="icp_account" class="required">
			</p>

			<p>
				<label>FTP帐号：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['ftp_account']; ?>
" name="ftp_account" class="">
			</p>	
			<p>
				<label>ICP密码：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['icp_pwd']; ?>
" name="icp_pwd">
			</p>	
			<p>
				<label>FTP密码：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['ftp_pwd']; ?>
" name="ftp_pwd">
			</p>	
			<p>
				<label>ICP备案号：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['icp_num']; ?>
" name="icp_num">
			</p>	
			<div class="divider"></div>
			<fieldset>
				<legend>介绍：</legend>
					<dl class="nowrap">
						<textarea name="intro" cols="80" rows="5"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
					</dl>	
			</fieldset>	
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