<?php /* Smarty version 2.6.26, created on 2017-02-08 16:24:00
         compiled from sal_order_detail/sal_order_detail_show_box.html */ ?>
<div class="pageHeader">
  <form id="pagerForm" onsubmit="return divSearch(this, 'jbsxBox');" action="<?php echo @ACT; ?>
/SalOrderDetail/sal_order_detail_show_box/orderID/<?php echo $this->_tpl_vars['orderID']; ?>
/" method="post">
      <input type="hidden" name="pageNum" value="1" />
      <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
      <input type="hidden" name="orderField" value="${param.orderField}" />
      <input type="hidden" name="orderID" value="<?php echo $this->_tpl_vars['orderID']; ?>
" />
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td><select class="combox" name="searchKeyword">
              <option value="ord_number">订单编号</option>
              <option value="pro_number">产品编号</option>
			  <option value="model">规格</option>
			  <option value="norm">型号</option>
			  <option value="price">单价</option>
			  <option value="rebate">折扣</option>
			  <option value="money">金额</option>
            </select>
          </td>
          <td><input type="text" name="searchValue" size="10"/></td>		  
          <td> 建档时间：
            <input type="text" class="date" name="bdt" size="10" readonly="true" />
            -
            <input type="text" class="date" name="edt" size="10" readonly="true" />
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
    </div>
  </form>
</div>
<div class="pageContent">
  <div class="panelBar">
    <ul class="toolBar">
      <li class="line">line</li>
      <li> <a class="pro" href="javascript:;"><span>明细总金额: <font color="red"><?php echo $this->_tpl_vars['total_money']; ?>
</font></span></a> </li>
      <li class="line">line</li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="148" rel="jbsxBox">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
		<th width="100">产品名称</th>
        <th width="120">产品编号</th>
        <th width="80">规格</th>
        <th width="130">型号</th>
        <th width="80">单价</th>
		<th width="80">折扣</th>
        <th width="100">数量</th>
        <th width="100">金额</th>
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
	  <td><?php echo $this->_tpl_vars['v']['pro_number']; ?>
 </td>
	  <td><?php echo $this->_tpl_vars['v']['model']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['norm']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['price']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['rebate']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['number']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['money']; ?>
</td> 
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <div class="pages"> <span>显示</span>
      <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value},'jbsxBox')">
      <option value="20" <?php if ($this->_tpl_vars['numPerPage'] == '20'): ?> selected="selected" <?php endif; ?>>20</option>
      <option value="50" <?php if ($this->_tpl_vars['numPerPage'] == '50'): ?> selected="selected" <?php endif; ?>>50</option>
      <option value="100" <?php if ($this->_tpl_vars['numPerPage'] == '100'): ?> selected="selected" <?php endif; ?>>100</option>
      <option value="200" <?php if ($this->_tpl_vars['numPerPage'] == '200'): ?> selected="selected" <?php endif; ?>>200</option>
      <option value="500" <?php if ($this->_tpl_vars['numPerPage'] == '500'): ?> selected="selected" <?php endif; ?>>500</option>
      </select>
      <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span> </div>
    <div class="pagination" targetType="dialog" rel="jbsxBox" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>