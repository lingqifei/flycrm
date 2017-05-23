<?php /* Smarty version 2.6.26, created on 2017-05-22 09:11:36
         compiled from sal_contract/sal_contract_show_box.html */ ?>
<div class="pageHeader">
  <form id="pagerForm" onsubmit="return divSearch(this, 'jbsxBox_cus');" action="<?php echo @ACT; ?>
/SalContract/sal_contract_show_box/" method="post">
  <input type="hidden" name="pageNum" value="1" />
  <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
  <input type="hidden" name="orderField" value="${param.orderField}" />
  <input type="hidden" name="cusID" value="<?php echo $this->_tpl_vars['cusID']; ?>
" />
    <div class="searchBar">
      <table class="searchContent">
        <tr>
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
    </div>
  </form>
</div>
<div class="pageContent">
  <div class="panelBar">
    <ul class="toolBar">
      <li><a class="add" href="<?php echo @ACT; ?>
/SalContract/sal_contract_add/" target="dialog" rel="sal_contract_add" title="合同添加"><span>添加</span></a></li>
      <li class="line">line</li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/SalContract/sal_contract_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>删除</span></a></li>
      <li class="line">line</li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/SalContract/sal_contract_modify/id/{sid_user}/" target="dialog" rel="sal_contract_modify" title="合同修改"><span>修改</span></a></li>
      <li class="line">line</li>
      <li><a class="pro" href="javascript:;"><span><?php echo $this->_tpl_vars['count_str']; ?>
</span></a></li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="148" rel="jbsxBox_cus">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
	 	<th width="100">主题</th>
		<th width="80">合同编号</th>
        <th width="80">接收人</th>
        <th width="80">销售机会</th>
        <th width="80">合同金额</th>
		<th width="80">去零金额</th>
		<th width="80">回款金额</th>
		<th width="80">交付金额</th>
		<th width="80">开票金额</th>
		<th width="80">有效期起始</th>
		<th width="80">有效期终止</th>
		<th width="60">我方代表</th>
		<th width="60">状态</th>
		<th width="80">付款状态</th>
		<th width="80">交付状态</th>
		<th width="80">开票状态</th>
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
/SalContract/sal_contract_show_one/id/<?php echo $this->_tpl_vars['v']['id']; ?>
/" class="btnLook" rel="sal_contract_show_one" title="<?php echo $this->_tpl_vars['v']['name']; ?>
" width="880" height="480">查看合同订单</a><?php echo $this->_tpl_vars['v']['title']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['con_number']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['v']['linkmanID']]; ?>
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
  
      
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/SalContract/sal_contract_show/">
      <input type="hidden" name="pageNum" value="1" />
      <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
      <input type="hidden" name="orderField" value="${param.orderField}" />
    </form>
    <div class="pages"> <span>显示</span>
      <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value},'jbsxBox_cus')">
      <option value="20" <?php if ($this->_tpl_vars['numPerPage'] == '20'): ?> selected="selected" <?php endif; ?>>20</option>
      <option value="50" <?php if ($this->_tpl_vars['numPerPage'] == '50'): ?> selected="selected" <?php endif; ?>>50</option>
      <option value="100" <?php if ($this->_tpl_vars['numPerPage'] == '100'): ?> selected="selected" <?php endif; ?>>100</option>
      <option value="200" <?php if ($this->_tpl_vars['numPerPage'] == '200'): ?> selected="selected" <?php endif; ?>>200</option>
      <option value="500" <?php if ($this->_tpl_vars['numPerPage'] == '500'): ?> selected="selected" <?php endif; ?>>500</option>
      </select>
      <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span> </div>
    <div class="pagination" argetType="dialog" rel="jbsxBox_cus" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>