<?php /* Smarty version 2.6.26, created on 2017-02-09 10:49:39
         compiled from cst_service/cst_service_show_box.html */ ?>
<div class="pageHeader">
  <form id="pagerForm" onsubmit="return divSearch(this, 'jbsxBox_cus');" action="<?php echo @ACT; ?>
/CstService/cst_service_show_box/" method="post">
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
              <option value="content">服务内容</option>
              <option value="postion">开始时间</option>
              <option value="tlen">花费时间</option>
            </select>
          </td>
          <td><input type="text" name="searchValue" /></td>
          <td><?php echo $this->_tpl_vars['statusselect']; ?>
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
/CstService/cst_service_add/cusID/<?php echo $this->_tpl_vars['cusID']; ?>
/" rel="cst_service_add"  target="dialog" width="850" height="450"  title="客户服务添加"><span>添加</span></a></li>
      <li class="line">line</li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/CstService/cst_service_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>删除</span></a></li>
      <li class="line">line</li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/CstService/cst_service_modify/id/{sid_user}/" rel="cst_service_modify" target="dialog" width="850" height="450"  title="客户服务修改"><span>修改</span></a></li>
      <li class="line">line</li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="148" rel="jbsxBox_cus">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
        <th width="120">服务类型</th>
        <th width="120">服务方式</th>
        <th width="120">联系人</th>
        <th width="180">开始时间</th>
        <th width="80">花费时间(分)</th>
        <th width="100">状态</th>
        <th width="180">建档时间</th>
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
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['services']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['servicesmodel']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['v']['linkmanID']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['adt']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['tlen']; ?>
</td>
      <td><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['v']['status']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['adt']; ?>
</td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <div class="pages"> <span>显示</span>
      <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value},'jbsxBox_cus')">
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
      </select>
      <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span> </div>
    <div class="pagination" targetType="dialog" rel="jbsxBox_cus" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>