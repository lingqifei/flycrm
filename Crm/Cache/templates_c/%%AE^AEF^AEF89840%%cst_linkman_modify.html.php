<?php /* Smarty version 2.6.26, created on 2017-05-13 08:22:34
         compiled from cst_linkman/cst_linkman_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
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
				<label>姓名：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" name="name" class="required">
			</p>
			<p>
				<label>性别：</label>
				<input type="radio" name="gender" value="1" <?php if ($this->_tpl_vars['one']['gender'] == 1): ?> checked <?php endif; ?>/>男
				<input type="radio" name="gender" value="2" <?php if ($this->_tpl_vars['one']['gender'] == 2): ?> checked <?php endif; ?>/>女
			</p>
			<p>
				<label>所在职位：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['postion']; ?>
" name="postion" class="required">
			</p>
			<p>
				<label>手机：</label>
					<input type="text" value="<?php echo $this->_tpl_vars['one']['mobile']; ?>
" name="mobile" class="required phone">
			</p>

			<p>
				<label>联系电话：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['tel']; ?>
" name="tel" class="phone">
			</p>	
			<p>
				<label>QQ：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['qicq']; ?>
" name="qicq">
			</p>	
			<p>
				<label>邮箱：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['email']; ?>
" name="email" class="email">
			</p>	
			<p>
				<label>邮编：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['zipcode']; ?>
" name="zipcode">
			</p>	
			<p>
				<label>联系地址：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['address']; ?>
" name="address" >
			</p>
			<div class="divider"></div>
			<fieldset>
				<legend>介绍：</legend>
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