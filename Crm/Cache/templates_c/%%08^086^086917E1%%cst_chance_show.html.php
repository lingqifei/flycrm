<?php /* Smarty version 2.6.26, created on 2016-06-30 15:03:07
         compiled from cst_chance/cst_chance_show.html */ ?>

<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/CstChance/cst_chance_show/" method="post">
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td> 客户名称：
            <input type="text" name="cus_name" size="15" />
          </td>
          <td><select class="combox" name="searchKeyword">
              <option value="title">机会主题</option>
              <option value="intro">客户需求</option>
			  <option value="chance">可能性</option>
			  <option value="money">预计金额</option>
            </select>
          </td>
		  <td><input type="text" name="searchValue" /></td>		
          <td> 建档时间：
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
/CstChance/cst_chance_add/" target="navTab" rel="cst_chance_add" title="销售机会添加"><span>添加</span></a></li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/CstChance/cst_chance_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>批量删除</span></a></li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/CstChance/cst_chance_modify/id/{sid_user}/" target="navTab" rel="cst_chance_modify"  title="销售机会修改"><span>修改</span></a></li>
      <li class="line">line</li>
      <li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出</span></a></li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="138">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
		<th width="120">机会主题</th>
        <th width="120">客户名称</th>
        <th width="80">联系人</th>
        <th width="80">发现时间</th>
        <th width="150">客户需求</th>
        <th width="80">预计签单时间</th>
        <th width="60">预计金额</th>
        <th width="60">可能性</th>
		<th width="60">当前阶段</th>
		<th width="100">状态</th>
		<th width="80">建档人员</th>
		<th width="80">建档时间</th>
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
	  <td><?php echo $this->_tpl_vars['v']['cst_name']; ?>
 </td>
	  <td><?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['v']['linkmanID']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['finddt']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['intro']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['billdt']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['money']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['v']['chance']; ?>
%</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['salestage']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['v']['status']]; ?>
</td>
	  <td><?php echo $this->_tpl_vars['users'][$this->_tpl_vars['v']['create_userID']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['adt']; ?>
</td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/CstChance/cst_chance_show/">
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