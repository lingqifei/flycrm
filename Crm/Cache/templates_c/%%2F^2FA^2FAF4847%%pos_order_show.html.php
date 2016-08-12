<?php /* Smarty version 2.6.26, created on 2016-06-30 15:05:24
         compiled from pos_order/pos_order_show.html */ ?>

<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/PosOrder/pos_order_show/" method="post">
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
/PosOrder/pos_order_add/" target="navTab" rel="pos_order_add" title="采购订单添加"><span>添加</span></a></li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/PosOrder/pos_order_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>批量删除</span></a></li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/PosOrder/pos_order_modify/id/{sid_user}/" target="navTab" rel="pos_order_modify" title="采购订单修改"><span>修改</span></a></li>
      <li class="line">line</li>
      <li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出</span></a></li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="138">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
	 	<th width="100">主题</th>
		<th width="80">订单编号</th>
        <th width="120">客户名称</th>
        <th width="80">联系人</th>
		<th width="100">采购时间</th>
		<th width="100">预计到货时间</th>
        <th width="80">总金额</th>
		<th width="80">去零金额</th>
		<th width="80">回款金额</th>
		<th width="80">付款金额</th>
		<th width="80">入库金额</th>
		<th width="80">已收票金额</th>
		<th width="60">我方代表</th>
		<th width="60">订单状态</th>
		<th width="80">付款状态</th>
		<th width="80">收货状态</th>
		<th width="80">开票状态</th>
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
	  <td><?php echo $this->_tpl_vars['v']['title']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['pos_number']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['supplier'][$this->_tpl_vars['v']['supID']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['v']['linkmanID']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['bdt']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['edt']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['zero_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['back_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['pay_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['into_money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['bill_money']; ?>
</td>

	  <td><?php echo $this->_tpl_vars['users'][$this->_tpl_vars['v']['our_userID']]; ?>
</td>
	   <td><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['v']['status']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['pay_status'][$this->_tpl_vars['v']['pay_status']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['into_status'][$this->_tpl_vars['v']['into_status']]; ?>
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
/PosOrder/pos_order_show/">
      <input type="hidden" name="pageNum" value="1" />
      <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
      <input type="hidden" name="orderField" value="${param.orderField}" />
    </form>
    <div class="pages"> <span>显示</span>
      <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
      </select>
      <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span> </div>
    <div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>