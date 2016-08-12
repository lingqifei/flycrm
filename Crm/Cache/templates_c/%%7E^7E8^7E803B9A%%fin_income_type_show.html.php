<?php /* Smarty version 2.6.26, created on 2016-06-30 15:05:50
         compiled from fin_income_type/fin_income_type_show.html */ ?>

<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/FinIncomeType/fin_income_type_show" method="post">
	<div class="searchBar">
		
		
		<table class="searchContent">
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
		</table>
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
				<li><a class="button" href="<?php echo @ACT; ?>
/FinIncomeType/search/" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="<?php echo @ACT; ?>
/FinIncomeType/fin_income_type_add/" target="dialog" title="费用收入类型添加"><span>添加</span></a></li>
			<li><a class="delete" href="<?php echo @ACT; ?>
/FinIncomeType/fin_income_type_del/id/{sid_user}/" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="<?php echo @ACT; ?>
/FinIncomeType/fin_income_type_modify/id/{sid_user}/" target="dialog"  title="费用收入类型修改"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
<ul>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="50">排序</th>
				<th width="120">分类名称</th>
				<th>分类介绍</th>
			</tr>
		</thead>
		<tbody>
		<?php echo $this->_tpl_vars['list']; ?>

		</tbody>
	</table>
	
	
</div>