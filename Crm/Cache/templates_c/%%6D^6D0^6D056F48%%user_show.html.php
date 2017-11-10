<?php /* Smarty version 2.6.26, created on 2017-11-02 15:57:49
         compiled from user/user_show.html */ ?>
<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/User/user_show/" method="post">
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td><select class="combox" name="searchKeyword">
              <option value="name">联系人姓名</option>
              <option value="postion">职务</option>
              <option value="mobile">电话</option>
              <option value="zipcode">邮编</option>
              <option value="address">联系地址</option>
              <option value="intro">介绍</option>
            </select>
          </td>
          <td><input type="text" name="searchValue" />
          </td>
          <td> 建档日期：
            <input type="text" class="date" readonly="true" />
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
/User/user_add/" target="navTab" rel="user_add"><span>添加</span></a></li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/User/user_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>批量删除</span></a></li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/User/user_modify/id/{sid_user}/" target="navTab" rel="user_modify"><span>修改</span></a></li>
      <li class="line">line</li>
      <li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出</span></a></li>
    </ul>
  </div>
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
      <td><a>发送短信</a> <a>发送邮件</a> </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/User/user_show/">
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