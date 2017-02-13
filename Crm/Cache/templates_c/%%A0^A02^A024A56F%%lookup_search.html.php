<?php /* Smarty version 2.6.26, created on 2016-11-18 21:34:11
         compiled from user/lookup_search.html */ ?>
<div class="pageHeader">
  <form action="<?php echo @ACT; ?>
/Supplier/lookup_search/" method="post" onsubmit="return dwzSearch(this, 'dialog');">
    <div class="searchBar">
      <ul class="searchContent">
        <li>
          <label>客户名称：</label>
          <input name="name" type="text"/>
        </li>
        <li>
          <label>联系电话：</label>
          <input name="tel" type="text"/>
        </li>
      </ul>
      <div class="subBar">
        <ul>
          <li>
            <div class="buttonActive">
              <div class="buttonContent">
                <button type="submit">检索</button>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </form>
</div>
<div class="pageContent">
  <table class="table" width="100%" layoutH="138">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
        <th width="120">帐号</th>
        <th width="120">姓名</th>
        <th width="40">性别</th>
        <th width="120">手机</th>
        <th width="120">QQ</th>
        <th width="150">邮箱</th>
        <th width="120">部门</th>
        <th width="120">职务</th>
        <th width="120">权限</th>
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
      <td><?php echo $this->_tpl_vars['v']['account']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
      <td><?php if ($this->_tpl_vars['v']['gender'] == 1): ?> 男 <?php else: ?> 女 <?php endif; ?> </td>
      <td><?php echo $this->_tpl_vars['v']['mobile']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['qicq']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['email']; ?>
</td>
      <td><?php echo $this->_tpl_vars['dept'][$this->_tpl_vars['v']['deptID']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['position'][$this->_tpl_vars['v']['positionID']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['role'][$this->_tpl_vars['v']['roleID']]; ?>
</td>
      <td><a class="btnSelect" href="javascript:$.bringBack({id:'<?php echo $this->_tpl_vars['v']['id']; ?>
', name:'<?php echo $this->_tpl_vars['v']['name']; ?>
'})" title="查找带回">选择</a> </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/Supplier/lookup_search/">
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