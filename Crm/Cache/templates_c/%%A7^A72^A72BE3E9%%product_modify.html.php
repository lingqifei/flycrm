<?php /* Smarty version 2.6.26, created on 2017-02-06 21:01:46
         compiled from product/product_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/Product/product_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<fieldset>
				<legend>基础信息：</legend>
			<p>
				<label>产品编号：</label>
				<input name="pro_number" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['pro_number']; ?>
" alt="请输产品编号"/>
			</p>
			<p>
				<label>产品名称：</label>
				<input name="name" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" alt="请输名称"/>
			</p>
			<p>
				<label>产品价格：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['price']; ?>
" name="price" class="required digits">
			</p>
			<p>
				<label>产品分类：</label>
				<input name="district.typeID" value="<?php echo $this->_tpl_vars['one']['typeID']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['type'][$this->_tpl_vars['one']['typeID']]; ?>
" name="district.typeName" type="text"/>
				<a class="btnLook" href="<?php echo @ACT; ?>
/ProType/lookup_tree_html/" lookupGroup="district">分类选择</a>	
			</p>

			<p>
				<label>产品型号：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['model']; ?>
" name="model" class="required">
			</p>	
			<p>
				<label>产品规格：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['norm']; ?>
" name="norm" class="required">
			</p>	
			<p>
				<label>供应商家：</label>
					<input name="org.id" value="<?php echo $this->_tpl_vars['one']['supID']; ?>
" type="hidden"/>
					<input name="org.name" type="text" value="<?php echo $this->_tpl_vars['supplier'][$this->_tpl_vars['one']['supID']]; ?>
" class="required"/>
					<a class="btnLook" href="<?php echo @ACT; ?>
/Supplier/lookup_search/" lookupGroup="org">选择供应商</a>	
			</p>
			<p>
				<label>产品图片：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['image']; ?>
" name="image" class="required">
			</p>	
			<p>
				<label>是否启用：</label>
				<input type="checkbox" name="visible" value="1"  <?php if ($this->_tpl_vars['one']['visible'] == 1): ?> checked <?php endif; ?>/>
			</p>
			<div class="divider"></div>
			<fieldset>
				<legend>产品介绍：</legend>
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