<?php /* Smarty version 2.6.26, created on 2016-06-13 16:12:37
         compiled from customer/customer_modify.html */ ?>
<div class="pageContent">
  <form method="post" action="<?php echo @ACT; ?>
/Customer/customer_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <div class="pageFormContent" layoutH="56">
      <fieldset>
      <legend>基础信息：</legend>
      <p>
        <label>客户名称：</label>
        <input name="name" class="required" type="text" size="30" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" alt="请输名称"/>
      </p>
      <p>
        <label>客户来源：</label>
        <input name="source.id" value="<?php echo $this->_tpl_vars['one']['source']; ?>
" type="hidden"/>
        <input class="required" value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['source']]; ?>
" name="source.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/source/" lookupGroup="source"/>
      </p>
      <p>
        <label>客户等级：</label>
        <input name="level.id" value="<?php echo $this->_tpl_vars['one']['level']; ?>
" type="hidden"/>
        <input class="required" value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['level']]; ?>
" name="level.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/level/" lookupGroup="level"/>
      </p>
      <p>
        <label>经济类型：</label>
        <input name="ecotype.id" value="<?php echo $this->_tpl_vars['one']['ecotype']; ?>
" type="hidden"/>
        <input class="required" name="ecotype.name"  value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['ecotype']]; ?>
" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/ecotype/" lookupGroup="ecotype"/>
      </p>
      <p>
        <label>所在行业：</label>
        <input name="trade.id" value="<?php echo $this->_tpl_vars['one']['trade']; ?>
" type="hidden"/>
        <input class="required" name="trade.name" value="<?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['one']['trade']]; ?>
" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/trade/" lookupGroup="trade"/>
      </p>
      <p>
        <label>公司网址：</label>
        <input type="text" name="website" class="url" value="<?php echo $this->_tpl_vars['one']['website']; ?>
" alt="例如:http://www.07fly.com">
      </p>
      <p>
        <label>联系电话：</label>
        <input type="text" value="<?php echo $this->_tpl_vars['one']['tel']; ?>
" name="tel" class="required phone">
      </p>
      <p>
        <label>传真：</label>
        <input type="text" value="<?php echo $this->_tpl_vars['one']['fax']; ?>
" name="fax" class="phone">
      </p>
      <p>
        <label>邮箱：</label>
        <input type="text" value="<?php echo $this->_tpl_vars['one']['email']; ?>
" name="email" class="email">
      </p>
      <p>
        <label>邮编：</label>
        <input type="text" value="<?php echo $this->_tpl_vars['one']['zipcode']; ?>
" name="zipcode">
      </p>
      <p>
        <label>联系地址：</label>
        <input type="text" value="<?php echo $this->_tpl_vars['one']['address']; ?>
" name="address" size="30" >
      </p>
      <div class="divider"></div>
      <fieldset>
      <legend>客户介绍：</legend>
      <dl class="nowrap">
        <textarea name="intro" cols="80" rows="5"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
      </dl>
      </fieldset>
      </fieldset>
    </div>
    <div class="formBar">
      <ul>
        <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
        <li>
          <div class="buttonActive">
            <div class="buttonContent">
              <button type="submit">保存</button>
            </div>
          </div>
        </li>
        <li>
          <div class="button">
            <div class="buttonContent">
              <button type="button" class="close">取消</button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </form>
</div>