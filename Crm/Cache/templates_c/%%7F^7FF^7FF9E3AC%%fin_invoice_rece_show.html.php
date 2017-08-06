<?php /* Smarty version 2.6.26, created on 2017-07-31 14:20:58
         compiled from fin_invoice_rece/fin_invoice_rece_show.html */ ?>
<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);"
	action="<?php echo @ACT; ?>
/FinInvoiceRece/fin_invoice_rece_show/" method="post">
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
/FinInvoiceRece/fin_invoice_rece_add/" target="dialog"
		rel="fin_invoice_rece_add" title="收票记录添加" width='850' height='450'><span>添加</span></a></li>
      <li> <a class="delete" href="<?php echo @ACT; ?>
/FinInvoiceRece/fin_invoice_rece_del/" postType="string" title="确定要删除吗?"  target="selectedTodo" rel="ids"><span>删除</span></a></li>
    </ul>
  </div>
  <ul>
    <table class="table" width="100%" layoutH="138">
      <thead>
        <tr>
          <th width="22"><input type="checkbox" group="ids"
					class="checkboxCtrl"></th>
          <th align="left" width="42">编号</th>
          <th align="left" width="200">供应商</th>
          <th align="left" width="200">采购单</th>
          <th align="left" width="100">收票日期</th>
          <th align="left" width="100">其次</th>
          <th align="left">发票金额</th>
          <th align="left" width="200">发票内容</th>
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
        <td align="left"><?php echo $this->_tpl_vars['supplier'][$this->_tpl_vars['v']['id']]; ?>
</td>
        <td align="left"><a target="dialog"  href="<?php echo @ACT; ?>
/PosOrder/pos_order_show_one/id/<?php echo $this->_tpl_vars['v']['posID']; ?>
/" rel="pos_order_show_one" title="采购订单详细" width="880" height="480"><?php echo $this->_tpl_vars['posorder'][$this->_tpl_vars['v']['id']]; ?>
</a></td>
        <td align="left"><?php echo $this->_tpl_vars['v']['recedate']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['stages']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['name']; ?>
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
/FinInvoiceRece/fin_invoice_rece_show/">
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