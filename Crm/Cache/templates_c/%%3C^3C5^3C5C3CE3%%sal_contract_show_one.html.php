<?php /* Smarty version 2.6.26, created on 2017-07-31 14:22:24
         compiled from sal_contract/sal_contract_show_one.html */ ?>
<div class="tabs">
  <div class="tabsHeader">
    <div class="tabsHeaderContent">
      <ul>
        <li><a href="javascript:;"><span>合同详细</span></a></li>
        <li><a href="javascript:;"><span>合同业务</span></a></li>
        <li><a href="javascript:;"><span>合同流程</span></a></li>
        <li><a href="javascript:;"><span>帮助说明</span></a></li>
      </ul>
    </div>
  </div>
  
  <div class="tabsContent">
  	<div>
    	<form method="post" action="<?php echo @ACT; ?>
/SalOrder/sal_order_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		
		<div id="div_print" class="pageFormContent" layoutH="90">
			<fieldset>
			<legend>基础信息：</legend>
			<p>
				<label>订单编号：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['one']['con_number']; ?>
" name="con_number" readonly="readonly">
				
			</p>
			<p>
				<label>客户名称：</label>
				<input id="cusID" name="org.id" value="<?php echo $this->_tpl_vars['one']['cusID']; ?>
" type="hidden"/>
				<input name="org.name" value="<?php echo $this->_tpl_vars['customer'][$this->_tpl_vars['one']['cusID']]; ?>
" type="text" readonly="true"/>	
			</p>
			<p>
				<label>订单标题：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['title']; ?>
" name="title" readonly="readonly">
			</p>	
			<p>
				<label>订单金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['money']; ?>
" name="money" readonly="readonly">
			</p>
			<p>
				<label>去零金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['zero_money']; ?>
" name="zero_money" readonly="readonly">
			</p>
			<p>
				<label>回款金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['back_money']; ?>
" name="back_money" readonly="readonly">
			</p>
			<p>
				<label>交付金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['pay_money']; ?>
" name="pay_money" readonly="readonly">
			</p>	
			<p>
				<label>开票金额：</label>
				<input type="text" value="<?php echo $this->_tpl_vars['one']['bill_money']; ?>
" name="pay_money" readonly="readonly">
			</p>	         		
			<p>
				<label>联系人：</label>
				<input name="linkman.id" value="<?php echo $this->_tpl_vars['one']['linkmanID']; ?>
" type="hidden"/>
				<input name="linkman.name"  value="<?php echo $this->_tpl_vars['linkman'][$this->_tpl_vars['one']['linkmanID']]; ?>
" type="text" readonly="readonly">
			</p>
			<p>
				<label>销售机会：</label>
				<input name="chance.id" value="<?php echo $this->_tpl_vars['one']['chanceID']; ?>
" type="hidden"/>
				<input value="<?php echo $this->_tpl_vars['chance'][$this->_tpl_vars['one']['chanceID']]; ?>
" name="chance.title" type="text" readonly="true">
			</p>
			<p>
				<label>有效期起始：</label>
				<input type="text" name="bdt" value="<?php echo $this->_tpl_vars['one']['bdt']; ?>
" readonly="true"/>
			</p>
			<p>
				<label>有效期终止：</label>
				<input type="text" name="edt" value="<?php echo $this->_tpl_vars['one']['edt']; ?>
" readonly="true"/>
			</p>
			<p>
				<label>我方代表：</label>
				<input id="our_userID" name="our.id" value="<?php echo $this->_tpl_vars['one']['our_userID']; ?>
" type="hidden"/>
				<input name="our.name" type="text" class="required" value="<?php echo $this->_tpl_vars['users'][$this->_tpl_vars['one']['our_userID']]; ?>
" readonly="true"/>
			</p>          
			</fieldset>
 			<div class="divider"></div>
			<fieldset>
				<legend>订单状态：</legend>
                <p>
                    <label>执行状态：</label>
                    <span class="info"><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['one']['status']]; ?>
</span>
                </p>            
                <p>
                    <label>付款状态：</label>
                    <span class="info"><?php echo $this->_tpl_vars['pay_status'][$this->_tpl_vars['one']['pay_status']]; ?>
</span>
                </p>   
                <p>
                    <label>交付状态：</label>
                    <span class="info"><?php echo $this->_tpl_vars['deliver_status'][$this->_tpl_vars['one']['deliver_status']]; ?>
</span>
                </p>            
                <p>
                    <label>开票状态：</label>
                    <span class="info"><?php echo $this->_tpl_vars['bill_status'][$this->_tpl_vars['one']['bill_status']]; ?>
</span>
                </p>  
			</fieldset>		
			<div class="divider"></div>
			<fieldset>
				<legend>备注：</legend>
                <p><span class="info"><?php echo $this->_tpl_vars['one']['intro']; ?>
</span></p>
			</fieldset>		
			
		</div>
		<div class="formBar">
			<ul>
            	<li><a class="buttonActive" href="javascript:$.printBox('div_print')"><span>打印</span></a></li>
				<li>
                	<div class="buttonActive">
                    	<div class="buttonContent">
                        	<button type="button" onClick="javascript:div_print()">打印</button>
                        </div>
                    </div>
                </li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
    </div>
    <div>
      <div>
        <div layoutH="36" style="float:left; display:block; overflow:auto; width:140px; border:solid 1px #CCC; line-height:21px; background:#fff">
          <ul class="tree treeFolder">
            <li><a href="<?php echo @ACT; ?>
/FinReceRecord/fin_rece_record_show_box/busID/<?php echo $this->_tpl_vars['one']['id']; ?>
/busType/sal_contract/" target="ajax" rel="jbsxBox">回款记录</a></li>
            <li><a href="<?php echo @ACT; ?>
/FinInvoicePay/fin_invoice_pay_show_box/busID/<?php echo $this->_tpl_vars['one']['id']; ?>
/busType/sal_contract/" target="ajax" rel="jbsxBox">开票记录</a></li>
            <li><a href="<?php echo @ACT; ?>
/SalOrderDetail/sal_order_detail_show_box/orderID/<?php echo $this->_tpl_vars['one']['id']; ?>
/" target="ajax" rel="jbsxBox">交付记录</a></li>

          </ul>
        </div>
        <div id="jbsxBox" class="unitBox" style="margin-left:146px;">
          
        </div>
      </div>
    </div>
    
    <div></div>
    <div></div>
  </div>
  <div class="tabsFooter">
    <div class="tabsFooterContent"></div>
  </div>
</div>
<script src="<?php echo @APP; ?>
/View/ui/js/jquery.jqprint-0.3.js" type="text/javascript" ></script> 
<script language="javascript">
function  div_print(){
        $("#div_print").jqprint();
    }
</script>