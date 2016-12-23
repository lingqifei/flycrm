<?php /* Smarty version 2.6.26, created on 2016-12-23 18:05:39
         compiled from customer/customer_show_one.html */ ?>
<div class="tabs">
  <div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/Customer/customer_show/" method="post">
      <div class="searchBar">
        <table class="searchContent">
          <tr>
            <td>客户名称：</td>
            <td><?php echo $this->_tpl_vars['one']['name']; ?>
</td>
            <td> 客户来源：</td>
            <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['source']]; ?>
</td>
             <td> 客户等级：</td>
            <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['source']]; ?>
</td>
            <td> 经济类型：</td>
            <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['source']]; ?>
</td>            
            <td> 所在行业：</td>
            <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['source']]; ?>
</td>    
          </tr>
        </table>
        <div class="subBar"></div>
        <div class="subBar"></div>
        <div class="subBar"></div>
      </div>
    </form>
  </div>
  <div class="tabsHeader">
    <div class="tabsHeaderContent">
      <ul>
        <li><a href="javascript:;"><span>客户管理</span></a></li>
        <li><a href="javascript:;"><span>销售管理</span></a></li>
        <li><a href="javascript:;"><span>合同管理</span></a></li>
        <li><a href="javascript:;"><span>订单管理</span></a></li>
        <li><a href="javascript:;"><span>随访</span></a></li>
      </ul>
    </div>
  </div>
  <div class="tabsContent">
    <div>
      <div layoutH="146" style="float:left; display:block; overflow:auto; width:240px; border:solid 1px #CCC; line-height:21px; background:#fff">
        <ul class="tree treeFolder">
          <li><a href="javascript">客户管理</a>
            <ul>
              <li><a href="<?php echo @ACT; ?>
/Customer/customer_show/" target="ajax" rel="jbsxBox">客户记录</a></li>
              <li><a href="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_show/" target="ajax" rel="jbsxBox">联系人</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div id="jbsxBox" class="unitBox" style="margin-left:246px;"> 
       <!--#include virtual="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_show/" --> 
      </div>
    </div>
    <div>
      <div class="pageHeader" style="border:1px #B8D0D6 solid">
        <form id="pagerForm" onsubmit="return divSearch(this, 'jbsxBox');" action="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_show/" method="post">
          <input type="hidden" name="pageNum" value="1" />
          <input type="hidden" name="numPerPage" value="${model.numPerPage}" />
          <input type="hidden" name="orderField" value="${param.orderField}" />
          <input type="hidden" name="orderDirection" value="${param.orderDirection}" />
          <div class="searchBar">
            <table class="searchContent">
              <tr>
                <td class="dateRange"> 尿检日期:
                  <input type="text" value="" readonly="readonly" class="date" name="dateStart">
                  <span class="limit">-</span>
                  <input type="text" value="" readonly="readonly" class="date" name="dateEnd"></td>
                <td> 尿检结果：
                  <input type="radio" name="njjg" value="" checked="checked" />
                  全部
                  <input type="radio" name="njjg" value="1"/>
                  阴性
                  <input type="radio" name="njjg" value="2"/>
                  阳性 </td>
                <td> 病人编号：
                  <input type="text" name="keyword" /></td>
                <td><div class="buttonActive">
                    <div class="buttonContent">
                      <button type="submit">检索</button>
                    </div>
                  </div></td>
              </tr>
            </table>
          </div>
        </form>
      </div>
      <div class="panelBar">
        <ul class="toolBar">
          <li><a class="add" href="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_add/cusID/<?php echo $this->_tpl_vars['one']['id']; ?>
/" target="dialog" rel="cst_linkman_add" width="850" height="450" title="添加<?php echo $this->_tpl_vars['cus_name']; ?>
联系人"><span>添加</span></a></li>
          <li class="line">line</li>
          <li><a class="delete" href="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_del/" postType="string" title="确实要删除选择这些记录吗?" target="selectedTodo" rel="ids" ><span>删除</span></a></li>
          <li class="line">line</li>
          <li><a class="edit" href="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_modify/id/{sid_user}/" target="dialog" rel="cst_linkman_modify" width="850" height="450"><span>修改</span></a></li>
          <li class="line">line</li>
        </ul>
      </div>
      <table class="table" width="100%" layoutH="260">
        <thead>
          <tr>
            <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
            <th width="120">客户</th>
            <th width="120">姓名</th>
            <th width="120">性别</th>
            <th width="120">职务</th>
            <th width="120">手机</th>
            <th width="120">QQ</th>
            <th width="150">邮箱</th>
          </tr>
        </thead>
        <tbody>
        
        <?php $_from = $this->_tpl_vars['linkman']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <tr target="sid_user" rel="<?php echo $this->_tpl_vars['v']['id']; ?>
">
          <td><input name="ids" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" type="checkbox"></td>
          <td><?php echo $this->_tpl_vars['v']['cst_name']; ?>
</td>
          <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
          <td><?php if ($this->_tpl_vars['v']['gender'] == 1): ?> 男 <?php else: ?> 女 <?php endif; ?> </td>
          <td><?php echo $this->_tpl_vars['v']['postion']; ?>
</td>
          <td><?php echo $this->_tpl_vars['v']['mobile']; ?>
</td>
          <td><?php echo $this->_tpl_vars['v']['qicq']; ?>
</td>
          <td><?php echo $this->_tpl_vars['v']['email']; ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
        
      </table>
      <div class="panelBar">
        <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_show/">
          <input type="hidden" name="pageNum" value="1" />
          <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['linkman']['numPerPage']; ?>
" />
          <input type="hidden" name="orderField" value="${param.orderField}" />
        </form>
        <div class="pages"> <span>显示</span>
          <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value},'jbsxBox')">
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
          </select>
          <span>条，共<?php echo $this->_tpl_vars['linkman']['totalCount']; ?>
条</span> </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['linkman']['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['linkman']['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['linkman']['currentPage']; ?>
"></div>
      </div>
    </div>
    <div>病人服药情况</div>
    <div>基线调查</div>
    <div>随访</div>
  </div>
  <div class="tabsFooter">
    <div class="tabsFooterContent"></div>
  </div>
</div>