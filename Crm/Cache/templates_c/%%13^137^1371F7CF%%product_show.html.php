<?php /* Smarty version 2.6.26, created on 2016-12-03 14:14:57
         compiled from product/product_show.html */ ?>

<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/Product/product_show" method="post">
	<div class="searchBar">
      <table class="searchContent">
        <tr>
          <td><select class="combox" name="searchKeyword">
              <option value="name">产品名称</option>
              <option value="pro_number">产品编号</option>
              <option value="model">产品型号</option>
              <option value="norm">规格</option>
              <option value="intro">产品介绍</option>
            </select>
          </td>
          <td><input type="text" name="searchValue" />
          </td>
          <td> 建档日期：
            <input type="text" class="date" name="bdt" readonly="true" />
            -
            <input type="text" class="date" name="edt" readonly="true" />
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
          <td><ul>
              <li><a class="button" href="<?php echo @ACT; ?>
/Product/advanced_search/" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
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
/Product/product_add/" target="navTab" rel="product_add"><span>添加</span></a></li>
			<li><a class="delete" href="<?php echo @ACT; ?>
/Product/product_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>批量删除</span></a></li>
			<li><a class="edit" href="<?php echo @ACT; ?>
/Product/product_modify/type/<?php echo $this->_tpl_vars['type']; ?>
/id/{sid_user}/" target="navTab"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
				<th width="80">编号</th>
				<th width="120">名称</th>
				<th width="120">所属分类</th>
				<th width="120">价格</th>
				<th width="120">型号</th>
				<th width="120">规格</th>
				<th width="120">供应商</th>
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
				<td><?php echo $this->_tpl_vars['v']['pro_number']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['type'][$this->_tpl_vars['v']['typeID']]; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['price']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['model']; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['norm']; ?>
</td>
				<td><?php echo $this->_tpl_vars['supplier'][$this->_tpl_vars['v']['supID']]; ?>
</td>
				<td><?php echo $this->_tpl_vars['v']['url']; ?>
</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	
	<div class="panelBar">
<form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/Product/product_show/type/<?php echo $this->_tpl_vars['type']; ?>
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