<?php /* Smarty version 2.6.26, created on 2017-07-17 18:23:08
         compiled from supplier/supplier_show.html */ ?>

<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/Supplier/supplier_show/" method="post">
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td><select class="combox" name="searchKeyword">
              <option value="name">供应商名称</option>
              <option value="tel">联系电话</option>
              <option value="zipcode">邮编</option>
              <option value="address">办工地址</option>
              <option value="intro">供应商简介</option>
            </select>
          </td>
          <td><input type="text" name="searchValue" />
          </td>
          <td> 建档日期：
            <input type="text" class="date" name="bdt" readonly="true" />
            -
            <input type="text" class="date" name="edt" readonly="true" />
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
          <td><ul>
              <li><a class="button" href="<?php echo @ACT; ?>
/Supplier/advanced_search/" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
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
/Supplier/supplier_add/" target="navTab"><span>添加</span></a></li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/Supplier/supplier_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>批量删除</span></a></li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/Supplier/supplier_modify/id/{sid_user}/" target="navTab"><span>修改</span></a></li>
      <li class="line">line</li>
      <li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出</span></a></li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="138">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
        <th width="120">名称</th>
        <th width="120">经济类型</th>
        <th width="120">所属行业</th>
        <th width="120">联系人</th>
        <th width="120">电话</th>
        <th width="120">传真</th>
        <th width="120">邮箱</th>
        <th width="150">地址</th>
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
      <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['ecotype']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['trade']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['linkman']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['tel']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['fax']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['email']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['address']; ?>
</td>
      <td><a title="联系人" target="ajaxTodo" href="demo/common/ajaxDone.html?id=xxx" class="btnAssign">联系人</a> <a title="报价管理" target="navTab" href="demo_page4.html?id=xxx" class="btnInfo">报价管理</a> </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/Supplier/supplier_show/">
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