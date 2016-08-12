<?php /* Smarty version 2.6.26, created on 2016-07-22 15:01:30
         compiled from role/role_modify.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/Role/role_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>权限名称：</label>
				<input name="name" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" alt="请输权限名称"/>
			</p>
			<p>
				<label>排位序号：</label>
				<input type="text"  name="sort" class="required digits" value="<?php echo $this->_tpl_vars['one']['sort']; ?>
">
			</p>
			<div class="divider"></div>			
			<fieldset>
				<legend>权限介绍：</legend>
					<dl class="nowrap">
						<textarea name="intro" cols="80" rows="2"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
					</dl>	
			</fieldset>	
			<fieldset>
				<legend>权限维护：</legend>
					<dl class="nowrap">
						<?php echo $this->_tpl_vars['menu']; ?>

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
<script language="JavaScript"> 
    //判断所有的checkbox的选中状态 
    //@id : checkbox的id 
    function checkedStatus(id){ 
		var status = document.getElementById(id).checked; 
		tag="sub"+id;
        //获取checkbox，如果子节点没有设置id，就得不到一部分checkbox 
        var temp = document.getElementById(tag); 
		var inputs	 = temp.getElementsByTagName("input");
		for(var i = 0; i < inputs.length; i++){ 
			inputs[i].checked =status;
		
		}
        //设置checkbox的下级checkbox的状态 
       // setChildCheckBox(temp); 

        //设置checkbox的上级checkbox的状态 
       // setParentCheckBox(temp); 
    } 

</script>