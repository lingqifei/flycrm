<?php /* Smarty version 2.6.26, created on 2017-11-02 15:58:33
         compiled from cst_talk/cst_talk_show.html */ ?>
<div class="pageHeader">
  <form onsubmit="return validateCallback(this, dialogAjaxDone);" action="<?php echo @ACT; ?>
/CstTalk/cst_talk_add/" method="post">
    <input type="hidden" name="cusID" value="<?php echo $this->_tpl_vars['cusID']; ?>
" />
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td>沟通结果：</td>
          <td><input name="talk.id" value="" type="hidden"/>
            <input class="required" name="talk.name" type="text" size="40" postField="keyword" suggestFields="name" 
                suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/talk/" lookupGroup="talk"/></td>
          <td><ul>
              <li>
                <div class="buttonActive">
                  <div class="buttonContent">
                    <button type="submit">添加</button>
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
  
  <table class="table" width="100%" layoutH="97">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
        <th width="120">沟通时间</th>
        <th width="180">沟通记录</th>
        <th width="120">沟通人员</th>
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
      <td><?php echo $this->_tpl_vars['v']['adt']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['name']; ?>
</a></td>
      <td><?php echo $this->_tpl_vars['v']['user_name']; ?>
</td>
      
    </tr>
    <?php endforeach; endif; unset($_from); ?>
      </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_show/">
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
条</span> </div>
    <div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>