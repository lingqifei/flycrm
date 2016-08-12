<?php /* Smarty version 2.6.26, created on 2016-06-30 15:06:32
         compiled from fin_income_record/fin_income_record_show.html */ ?>
<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);"
	action="<?php echo @ACT; ?>
/FinIncomeRecord/fin_income_record_show" method="post">
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td><select class="combox" name="searchKeyword">
              <option value="name"  <?php if ($this->_tpl_vars['searchKeyword'] == 'name'): ?> selected="selected" <?php endif; ?>>名称</option>
            </select></td>
          <td><input type="text" name="searchValue" value="<?php echo $this->_tpl_vars['searchValue']; ?>
" /></td>
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
      <table class="subBar">
        <tr>
          <td> 说明： </td>
          <td class="info"> 共计收入：<?php echo $this->_tpl_vars['total_money']; ?>
 &nbsp;&nbsp;</td>
        </tr>
      </table>
    </div>
  </form>
</div>
<div class="pageContent">
  <div class="panelBar">
    <ul class="toolBar">
      <li><a class="add"
		href="<?php echo @ACT; ?>
/FinIncomeRecord/fin_income_record_add/" target="navTab"
		rel="fin_income_record_add" title="收入记录添加"><span>添加</span></a></li>
      <li> <a class="delete" href="<?php echo @ACT; ?>
/FinIncomeRecord/fin_income_record_del/" postType="string" title="确定要删除吗?"  target="selectedTodo" rel="ids"><span>删除选择</span></a></li>
    </ul>
  </div>
  <ul>
    <table class="table" width="100%" layoutH="138">
      <thead>
        <tr>
          <th width="22"><input type="checkbox" group="ids"
					class="checkboxCtrl"></th>
          <th align="left" width="42">编号</th>
          <th align="left" width="200">费用类别</th>
          <th align="left" width="200">金额</th>
          <th align="left" width="200">银行帐号</th>
          <th align="left" width="100">产生日期</th>
          <th align="left" width="200">备注</th>
          <th align="left">创建人</th>
          <th align="left">创建时间</th>
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
        <td align="left"><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['type'][$this->_tpl_vars['v']['typeID']]; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['blankaccount']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['crt_date']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['intro']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['create_user']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['adt']; ?>
</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
        </tbody>
      
    </table>
    <div class="panelBar">
      <form id="pagerForm" method="post"
		action="<?php echo @ACT; ?>
/FinIncomeRecord/fin_income_record_show/">
        <input
		type="hidden" name="pageNum" value="1" />
        <input type="hidden"
		name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
        <input type="hidden"
		name="orderField" value="${param.orderField}" />
      </form>
      <div class="pages"><span>显示</span>
        <select class="combox"
		name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="200">200</option>
        </select>
        <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span></div>
      <div class="pagination" targetType="navTab"
		totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
"
		pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
    </div>
  </ul>
</div>