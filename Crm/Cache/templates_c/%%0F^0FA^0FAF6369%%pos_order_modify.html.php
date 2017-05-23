<?php /* Smarty version 2.6.26, created on 2017-05-22 17:58:48
         compiled from pos_order/pos_order_modify.html */ ?>
<div class="pageContent">
  <form method="post" action="<?php echo @ACT; ?>
/PosOrder/pos_order_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
    <div class="pageFormContent" layoutH="50">
      <fieldset>
        <legend>基础信息：</legend>
        <p>
          <label>订单编号：</label>
          <input type="text" value="<?php echo $this->_tpl_vars['one']['pos_number']; ?>
" name="pos_number" class="required" >
        </p>
        <p>
          <label>主题：</label>
          <input type="text" value="<?php echo $this->_tpl_vars['one']['title']; ?>
" name="title" class="required">
        </p>
        <p>
          <label>供应商名称：</label>
          <input id="supID"  name="sup.id" value="<?php echo $this->_tpl_vars['one']['supID']; ?>
" type="hidden"/>
          <input name="sup.name" type="text" value="<?php echo $this->_tpl_vars['one']['sup_name']; ?>
" class="required"/>
          <a class="btnLook" href="<?php echo @ACT; ?>
/Supplier/lookup_search/" lookupGroup="sup">选择供应商</a> </p>
        <p>
          <label>联系人：</label>
          <input name="linkman.id" value="<?php echo $this->_tpl_vars['one']['linkmanID']; ?>
" type="hidden"/>
          <input class="required" value="<?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['one']['linkmanID']]; ?>
" name="linkman.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/SupLinkman/sup_linkman_select/supID/{supID}/" warn="请选择联系人名称" lookupGroup="linkman"/>
        </p>
        <p>
          <label>采购时间：</label>
          <input type="text" name="bdt" value="<?php echo $this->_tpl_vars['one']['bdt']; ?>
" class="date required" readonly="true"/>
          <a class="inputDateButton" href="javascript:;">选择</a> <span class="info">yyyy-MM-dd</span> </p>
        <p>
          <label>预计到货时间：</label>
          <input type="text" name="edt" value="<?php echo $this->_tpl_vars['one']['edt']; ?>
" class="date required" readonly="true"/>
          <a class="inputDateButton" href="javascript:;">选择</a> <span class="info">yyyy-MM-dd</span> </p>
        <p>
          <label>我方代表：</label>
          <input id="our_userID" name="our.id" value="<?php echo $this->_tpl_vars['one']['our_userID']; ?>
" type="hidden"/>
          <input name="our.name" value="<?php echo $this->_tpl_vars['users'][$this->_tpl_vars['one']['our_userID']]; ?>
" type="text" class="required"/>
          <a class="btnLook" href="<?php echo @ACT; ?>
/User/lookup_search/" lookupGroup="our">选择客服务</a> </p>
        <p>
          <label>总金额：</label>
          <input type="text" value="<?php echo $this->_tpl_vars['one']['money']; ?>
" name="money" class="required digits">
        </p>
        <p>
          <label>去零金额：</label>
          <input type="text" value="<?php echo $this->_tpl_vars['one']['zero_money']; ?>
" name="zero_money" class="required digits">
        </p>
        <p>
          <label>已付金额：</label>
          <input type="text" value="<?php echo $this->_tpl_vars['one']['pay_money']; ?>
" name="pay_money" class="required digits">
        </p>
      </fieldset>
      <div class="divider"></div>
      <fieldset>
        <legend>备注：</legend>
        <dl class="nowrap">
          <textarea name="intro" cols="80" rows="5"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
        </dl>
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