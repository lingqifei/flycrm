<?php /* Smarty version 2.6.26, created on 2017-05-22 15:41:57
         compiled from fin_rece_record/fin_rece_record_show.html */ ?>
<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);"
	action="<?php echo @ACT; ?>
/FinReceRecord/fin_rece_record_show/" method="post">
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
/FinReceRecord/fin_rece_record_add/" target="dialog"
		rel="fin_rece_record_add" title="回款记录添加" width='850' height='450'><span>添加</span></a></li>
        <li class="line">line</li>
      <li> <a class="delete" href="<?php echo @ACT; ?>
/FinReceRecord/fin_rece_record_del/" postType="string" title="确定要删除吗?"  target="selectedTodo" rel="ids"><span>删除</span></a></li>
      <li class="line">line</li>
    </ul>
  </div>
  <ul>
    <table class="table" width="100%" layoutH="138">
      <thead>
        <tr>
          <th width="22"><input type="checkbox" group="ids"
					class="checkboxCtrl"></th>
          <th align="left" width="42">编号</th>
          <th align="left" width="200">客户名称</th>
          <th align="left" width="200">合同订单</th>
          <th align="left" width="100">回款日期</th>
          <th align="left" width="100">其次</th>
          <th align="left">金额</th>
          <th align="left">回款帐号</th>
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
        <td align="left"><?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['v']['id']]; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['business']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['paydate']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['stages']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['blankaccount']; ?>
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
/FinReceRecord/fin_rece_record_show/">
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
          <option value="20" <?php if ($this->_tpl_vars['numPerPage'] == '20'): ?> selected="selected" <?php endif; ?>>20</option>
          <option value="50" <?php if ($this->_tpl_vars['numPerPage'] == '50'): ?> selected="selected" <?php endif; ?>>50</option>
          <option value="100" <?php if ($this->_tpl_vars['numPerPage'] == '100'): ?> selected="selected" <?php endif; ?>>100</option>
          <option value="200" <?php if ($this->_tpl_vars['numPerPage'] == '200'): ?> selected="selected" <?php endif; ?>>200</option>
          <option value="500" <?php if ($this->_tpl_vars['numPerPage'] == '500'): ?> selected="selected" <?php endif; ?>>500</option>
        </select>
        <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条,金额合计:<font color="#FF0000"><?php echo $this->_tpl_vars['total_money']; ?>
</font> </span></div>
      <div class="pagination" targetType="navTab"
		totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
"
		pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
    </div>
  </ul>
</div>