<?php /* Smarty version 2.6.26, created on 2017-02-09 15:33:28
         compiled from dept/dept_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/Dept/dept_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>部门名称：</label>
				<input name="name" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" alt="请输部门名称"/>
			</p>
			<p>
				<label>部门电话：</label>
				<input name="tel" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['tel']; ?>
" alt="请输部门电话"/>
			</p>
			<p>
				<label>部门传真：</label>
				<input name="fax" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['fax']; ?>
" alt="请部门传真"/>
			</p>
			<p>
				<label>父级栏目：</label>
				<?php echo $this->_tpl_vars['parentID']; ?>


			</p>
			<p>
				<label>排位序号：</label>
				<input type="text" name="sort" class="required digits" value="<?php echo $this->_tpl_vars['one']['sort']; ?>
">
			</p>
			<p>
				<label>是否启用：</label>
				<input type="checkbox" name="visible" value="1" <?php if ($this->_tpl_vars['one']['visible'] == 1): ?> checked <?php endif; ?> />
			</p>
			<fieldset>
				<legend>部门职能：</legend>
					<dl class="nowrap">
						<textarea name="intro" cols="80" rows="2"><?php echo $this->_tpl_vars['one']['intro']; ?>
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