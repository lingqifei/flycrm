<?php /* Smarty version 2.6.26, created on 2017-04-14 18:00:16
         compiled from cst_dict/cst_dict_add.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/CstDict/cst_dict_add/type/<?php echo $this->_tpl_vars['type']; ?>
/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>名称：</label>
				<input name="name" class="required" type="text" size="30" value="" alt="请输名称"/>
			</p>
			<p>
				<label>排位序号：</label>
				<input type="text" value="" name="sort" class="required digits">
			</p>
			<p>
				<label>是否启用：</label>
				<input type="checkbox" name="visible" value="1" />
			</p>
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