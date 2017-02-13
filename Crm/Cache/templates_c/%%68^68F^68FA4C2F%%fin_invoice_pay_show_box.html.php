<?php /* Smarty version 2.6.26, created on 2017-02-08 16:16:52
         compiled from fin_invoice_pay/fin_invoice_pay_show_box.html */ ?>
<div class="pageHeader">
  <form id="pagerForm" onsubmit="return divSearch(this,'jbsxBox');"
	action="<?php echo @ACT; ?>
/FinInvoicePay/fin_invoice_pay_show_box/" method="post">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
    <input type="hidden" name="orderField" value="${param.orderField}" />
    <input type="hidden" name="busID" value="<?php echo $this->_tpl_vars['busID']; ?>
" />
    <input type="hidden" name="busType" value="<?php echo $this->_tpl_vars['busType']; ?>
" />
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
    </div>
  </form>
</div>
<div class="pageContent">
  <div class="panelBar">
    <ul class="toolBar">
      <li class="line">line</li>
      <li> <a class="pro" href="javascript:;"><span>发票总金额: <font color="red"><?php echo $this->_tpl_vars['total_money']; ?>
</font></span></a> </li>
      <li class="line">line</li>
    </ul>
  </div>
  <ul>
    <table class="table" width="100%" layoutH="145" rel="jbsxBox">
      <thead>
        <tr>
          <th width="22"><input type="checkbox" group="ids"
					class="checkboxCtrl"></th>
          <th align="left" width="100">发票编号</th>
          <th align="left" width="150">发票内容</th>
          <th align="left" width="60">发票金额</th>
          <th align="left" width="150">客户名称</th>
          <th align="left" width="80">开票日期</th>
          <th align="left" width="60">开票其次</th>
          <th align="left">开票人</th>
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
        <td align="left"><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['v']['id']]; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['paydate']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['stages']; ?>
</td>
        <td align="left"><?php echo $this->_tpl_vars['v']['create_user']; ?>
</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
        </tbody>
      
    </table>
    <div class="panelBar">
      <div class="pages"><span>显示</span>
        <select class="combox" name="numPerPage"  onchange="navTabPageBreak({numPerPage:this.value}, 'jbsxBox')">
          <option value="20" <?php if ($this->_tpl_vars['numPerPage'] == '20'): ?> selected="selected" <?php endif; ?>>20</option>
          <option value="50" <?php if ($this->_tpl_vars['numPerPage'] == '50'): ?> selected="selected" <?php endif; ?>>50</option>
          <option value="100" <?php if ($this->_tpl_vars['numPerPage'] == '100'): ?> selected="selected" <?php endif; ?>>100</option>
          <option value="200" <?php if ($this->_tpl_vars['numPerPage'] == '200'): ?> selected="selected" <?php endif; ?>>200</option>
          <option value="500" <?php if ($this->_tpl_vars['numPerPage'] == '500'): ?> selected="selected" <?php endif; ?>>500</option>
        </select>
        <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条,金额合计:<font color="#FF0000"><?php echo $this->_tpl_vars['total_money']; ?>
</font> </span></div>
      <div class="pagination" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" targetType="dialog" rel="jbsxBox" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
"
		pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
    </div>
  </ul>
</div>