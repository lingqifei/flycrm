<?php /* Smarty version 2.6.26, created on 2017-05-22 22:48:53
         compiled from fin_invoice_pay/fin_invoice_pay_add.html */ ?>
<div class="pageContent">
  <form method="post" action="<?php echo @ACT; ?>
/FinInvoicePay/fin_invoice_pay_add/" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
    <div class="pageFormContent" layoutH="50">
      <fieldset>
        <legend>基础信息：</legend>
        <p>
          <label>客户名称：</label>
          <input id="cusID" name="cus.id" value="" type="hidden"/>
          <input name="cus.name" type="text" class="required"/>
          <a class="btnLook" href="<?php echo @ACT; ?>
/Customer/lookup_search/" lookupGroup="cus">选择客户</a> </p>
        <p>
          <label>订单总金额：</label>
          <input type="text" name="order.money" class="required" readonly="true"/>
        </p>
        <p>
          <label>合同订单：</label>
          <input name="order.id" value="" type="hidden"/>
          <input name="order.type" value="" type="hidden"/>
          <input class="required" name="order.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/FinInvoicePay/fin_invoice_get_customer_business/cusID/{cusID}/" warn="请选择订单" lookupGroup="order"/>
        </p>
        <p>
          <label>去零金额：</label>
          <input type="text" value="" name="order.zero_money" readonly="true">
        </p>
        <p>
          <label>开票日期：</label>
          <input type="text" name="paydate" class="date required"/>
          <a class="inputDateButton" href="javascript:;">选择</a> </p>
        <p>
          <label>已回款金额：</label>
          <input type="text" value="" name="order.back_money" readonly="true">
        </p>
        <p>
          <label>开票期次：</label>
          <input type="text" name="stages" class="required"/>
        </p>
        <p>
          <label>已开票金额：</label>
          <input type="text" name="order.bill_money" class="required" readonly="true"/>
        </p>
        <p>
          <label>发票内容：</label>
          <input type="text" value="" name="name" class="required">
        </p>
        <p>
          <label>发票编号：</label>
          <input name="invo_number" value="" type="text"/>
        </p>
        <p>
          <label>发票金额：</label>
          <input name="order.now_bill_money" value="" type="text"/>
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