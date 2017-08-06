<?php /* Smarty version 2.6.26, created on 2017-07-31 14:21:11
         compiled from fin_bank_account/fin_bank_account_show.html */ ?>

<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_account_show" method="post">
	<div class="searchBar">
		<ul class="searchContent">
			<li>
				<label>我的客户：</label>
				<input name="customer" type="text"/>
			</li>
			<li>
			<select class="combox" name="province">
				<option value="">所有省市</option>
				<option value="北京">北京</option>
				<option value="上海">上海</option>
				<option value="天津">天津</option>
				<option value="重庆">重庆</option>
				<option value="广东">广东</option>
			</select>
			</li>
		</ul>
		
		<!--<table class="searchContent">
			<tr>
				<td>
					我的客户：<input type="text" name="keyword" />
				</td>
				<td>
					<select class="combox" name="province">
						<option value="">所有省市</option>
						<option value="北京">北京</option>
						<option value="上海">上海</option>
						<option value="天津">天津</option>
						<option value="重庆">重庆</option>
						<option value="广东">广东</option>
					</select>
				</td>
				<td>
					建档日期：<input type="text" class="date" readonly="true" />
				</td>
			</tr>
		</table>-->
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
				<li><a class="button" href="<?php echo @ACT; ?>
/FinBankAccount/search/" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_account_add/type/<?php echo $this->_tpl_vars['type']; ?>
/" target="dialog"><span>添加</span></a></li>
			<li><a class="delete" href="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_account_del/type/<?php echo $this->_tpl_vars['type']; ?>
/id/{sid_user}/" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_account_modify/type/<?php echo $this->_tpl_vars['type']; ?>
/id/{sid_user}/" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="50">编号</th>
				<th width="50">排序</th>
				<th width="120">开户银行</th>
                <th width="120">卡号</th>
                <th width="120">开户人</th>
                <th width="200">开户行地址</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<tr target="sid_user" rel="<?php echo $this->_tpl_vars['v']['id']; ?>
">
				<td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['sort']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['card']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['holders']; ?>
</td>
                <td><?php echo $this->_tpl_vars['v']['address']; ?>
</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	
	<div class="panelBar">
<form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_account_show/type/<?php echo $this->_tpl_vars['type']; ?>
">
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