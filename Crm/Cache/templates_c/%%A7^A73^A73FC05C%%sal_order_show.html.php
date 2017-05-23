<?php /* Smarty version 2.6.26, created on 2017-05-20 21:29:55
         compiled from sal_order/sal_order_show.html */ ?>

<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/SalOrder/sal_order_show/" method="post">
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td> 客户名称：
            <input type="text" name="cus_name" size="15" />
          </td>
          <td><select class="combox" name="searchKeyword">
              <option value="title">主题</option>
              <option value="intro">内容</option>
            </select>
          </td>
		  <td><input type="text" name="searchValue" /></td>		 
          <td> 联系时间：
            <input type="text" class="date" name="bdt" size="15" readonly="true" />
            -
            <input type="text" class="date" name="edt" size="15" readonly="true" />
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
/SalOrder/sal_order_add/" target="dialog" rel="sal_order_add" title="订单添加" width="850" height="450"><span>添加</span></a></li>
      <li class="line">line</li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/SalOrder/sal_order_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>删除</span></a></li>
      <li class="line">line</li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/SalOrder/sal_order_modify/id/{sid_user}/" target="dialog" rel="sal_order_modify" title="订单修改" width="850" height="450"><span>修改</span></a></li>
      <li class="line">line</li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="138">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
		<th width="120">订单编号</th>
        <th width="100">客户名称</th>
        <th width="80">销售机会</th>
        <th width="70">总金额</th>
		<th width="70">去零金额</th>
		<th width="70">回款金额</th>
		<th width="70">发货金额</th>
		<th width="70">开票金额</th>
		<th width="90">签订时间</th>
		<th width="90">发货时间</th>
		<th width="70">我方代表</th>
		<th width="70">订单状态</th>
		<th width="70">付款状态</th>
		<th width="70">发货状态</th>
		<th width="70">开票状态</th>
 		<th width="80">操作</th>
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
	  <td><a target="dialog"  href="<?php echo @ACT; ?>
/SalOrder/sal_order_show_one/id/<?php echo $this->_tpl_vars['v']['id']; ?>
/" rel="sal_order_show_one" title="订单明细：<?php echo $this->_tpl_vars['v']['ord_number']; ?>
-<?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['v']['cusID']]; ?>
" width="880" height="480"><?php echo $this->_tpl_vars['v']['ord_number']; ?>
</a></td>
	  <td><?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['v']['cusID']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['chance'][$this->_tpl_vars['v']['chanceID']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['zero_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['back_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['pay_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['bill_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['bdt']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['edt']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['users'][$this->_tpl_vars['v']['our_userID']]; ?>
</td>
	   <td><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['v']['status']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['pay_status'][$this->_tpl_vars['v']['pay_status']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['deliver_status'][$this->_tpl_vars['v']['deliver_status']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['bill_status'][$this->_tpl_vars['v']['bill_status']]; ?>
</td> 
	  <td><?php echo $this->_tpl_vars['operate'][$this->_tpl_vars['v']['id']]; ?>
</td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/SalOrder/sal_order_show/">
      <input type="hidden" name="pageNum" value="1" />
      <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
      <input type="hidden" name="orderField" value="${param.orderField}" />
    </form>
    <div class="pages"> <span>显示</span>
      <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
      <option value="20" <?php if ($this->_tpl_vars['numPerPage'] == '20'): ?> selected="selected" <?php endif; ?>>20</option>
      <option value="50" <?php if ($this->_tpl_vars['numPerPage'] == '50'): ?> selected="selected" <?php endif; ?>>50</option>
      <option value="100" <?php if ($this->_tpl_vars['numPerPage'] == '100'): ?> selected="selected" <?php endif; ?>>100</option>
      <option value="200" <?php if ($this->_tpl_vars['numPerPage'] == '200'): ?> selected="selected" <?php endif; ?>>200</option>
      <option value="500" <?php if ($this->_tpl_vars['numPerPage'] == '500'): ?> selected="selected" <?php endif; ?>>500</option>
      </select>
      <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条,<?php echo $this->_tpl_vars['count_str']; ?>
</span> </div>
    <div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>