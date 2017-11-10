<?php /* Smarty version 2.6.26, created on 2017-11-02 15:58:58
         compiled from customer/lookup_search.html */ ?>

<div class="pageHeader">
	<form action="<?php echo @ACT; ?>
/Customer/lookup_search/" method="post" onsubmit="return dwzSearch(this, 'dialog');">
	<div class="searchBar">
		<ul class="searchContent">
			<li>
				<label>客户名称：</label>
				<input name="name" type="text"/>
			</li>
			<li>
				<label>联系电话：</label>
				<input name="tel" type="text"/>
			</li>
		</ul>
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent">
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
				<th width="120">名称</th>
				<th width="120">经济类型</th>
				<th width="120">所属行业</th>
				<th width="120">联系人</th>
				<th width="120">电话</th>
				<th width="120">传真</th>
				<th width="120">邮箱</th>
				<th width="150">地址</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<tr target="sid_user" rel="<?php echo $this->_tpl_vars['v']['id']; ?>
">
				<td><input name="ids" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" type="checkbox"></td>
				<td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['ecotype']]; ?>
</td>
				<td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['trade']]; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['linkman']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['tel']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['fax']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['email']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['address']; ?>
</td>
				<td>
					<a class="btnSelect" href="javascript:$.bringBack({id:'<?php echo $this->_tpl_vars['v']['id']; ?>
', name:'<?php echo $this->_tpl_vars['v']['name']; ?>
'})" title="查找带回">选择</a>
				</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	
	<div class="panelBar">
<form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/Supplier/lookup_search/">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="200">200</option>
			</select>
			<span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>

	</div>
</div>