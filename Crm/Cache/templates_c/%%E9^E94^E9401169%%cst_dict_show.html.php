<?php /* Smarty version 2.6.26, created on 2017-07-17 17:39:11
         compiled from cst_dict/cst_dict_show.html */ ?>

<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/CstDict/cst_dict_show/type/<?php echo $this->_tpl_vars['type']; ?>
/" method="post">
	<div class="searchBar">
		<table class="searchContent">
				<tr>
				  <td> 名称：
					<input type="text" name="name" />
				  </td>
				  <td><ul>
					  <li>
						<div class="buttonActive">
						  <div class="buttonContent">
							<button type="submit">检索</button>
						  </div>
						</div>
					  </li>
					</ul></td>
				</tr>
			  </table>
			  <div class="subBar"></div>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="<?php echo @ACT; ?>
/CstDict/cst_dict_add/type/<?php echo $this->_tpl_vars['type']; ?>
/" target="dialog"><span>添加</span></a></li>
			<li><a class="delete" href="<?php echo @ACT; ?>
/CstDict/cst_dict_del/type/<?php echo $this->_tpl_vars['type']; ?>
/id/{sid_user}/" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="<?php echo @ACT; ?>
/CstDict/cst_dict_modify/type/<?php echo $this->_tpl_vars['type']; ?>
/id/{sid_user}/" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="80">编号</th>
				<th width="120">排序</th>
				<th width="120">名称</th>
				<th>操作</th>
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
				
				<td><?php echo $this->_tpl_vars['v']['url']; ?>
</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	
	<div class="panelBar">
<form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/CstDict/cst_dict_show/type/<?php echo $this->_tpl_vars['type']; ?>
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