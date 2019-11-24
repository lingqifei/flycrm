<?php /* Smarty version 2.6.26, created on 2019-09-29 18:07:18
         compiled from erp/fin_rece_record_add.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox-content">
    <form class="form-horizontal" method="post" action="#">
      <div class="form-group text-left">
        <label class="col-sm-2 control-label">客户名称</label>
        <div class="col-sm-8">
          <select data-placeholder="选择分类..." name="customer_id" class="chosen-select customer-chosen-select" style="width: 200px;" tabindex="2">
            <option value="">请选客户</option>
					  <?php $_from = $this->_tpl_vars['customer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> 
            <option value="<?php echo $this->_tpl_vars['v']['customer_id']; ?>
" hassubinfo="true"><?php echo $this->_tpl_vars['v']['name']; ?>
</option>
					  <?php endforeach; endif; unset($_from); ?>
          </select>
          <input type="hidden" name="customer_name">
        </div>
      </div>
      <div class="form-group text-left">
        <label class="col-sm-2 control-label">销售合同</label>
        <div class="col-sm-8">
          <select data-placeholder="请选客户销售合同..." name="contract_id" class="chosen-select contract-chosen-select" style="width: 200px;" tabindex="1">
            <option value="">请选客户销售合同</option>
          </select>
          <input type="hidden" name="contract_name">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">总金额</label>
        <div class="col-sm-8">
          <input name="contract_money" class="form-control" type="text" readonly/>
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">去零金额</label>
        <div class="col-sm-8">
          <input name="contract_zero_money" class="form-control" type="text" readonly/>
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">已经回款金额</label>
        <div class="col-sm-8">
          <input name="contract_back_money" class="form-control" type="text" readonly/>
          <input type="hidden" name="contract_owe_money">
		  </div>
		  	
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">已开发票金额</label>
        <div class="col-sm-8">
          <input name="contract_invoice_money" class="form-control" type="text" readonly/>
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">回款款日期</label>
        <div class="col-sm-10">
          <input name="back_date" class="form-control datepicker" type="text"  placeholder="选择回款日期"/>
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">期次</label>
        <div class="col-sm-8">
          <input name="stages" class="form-control" type="text" placeholder="请输入回款期次" />
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">回款金额</label>
        <div class="col-sm-8">
          <input name="back_money" class="form-control calculate" type="text"/>
          <span class="help-block m-b-none"></span> </div>
      </div>
		<div class="form-group">
        <label class="col-sm-2 control-label">去零金额</label>
        <div class="col-sm-8">
          <input name="zero_money" class="form-control calculate" type="text" value="0"/>
          <span class="help-block m-b-none"></span> </div>
      </div>
		<div class="form-group">
        <label class="col-sm-2 control-label">尚欠金额</label>
        <div class="col-sm-8">
          <input name="owe_money" class="form-control" type="text" readonly/>
          <span class="help-block m-b-none"></span> </div>
      </div>	
      <div class="form-group text-left">
        <label class="col-sm-2 control-label">回款账户</label>
        <div class="col-sm-8">
          <select data-placeholder="选择回款账户..." name="bank_id" class="chosen-select bank-chosen-select" style="width: 200px;" tabindex="2">
            <option value="">请选回款账户</option>
					  <?php $_from = $this->_tpl_vars['bank']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            		<option value="<?php echo $this->_tpl_vars['v']['bank_id']; ?>
" hassubinfo="true"><?php echo $this->_tpl_vars['v']['name']; ?>
 <?php echo $this->_tpl_vars['v']['card']; ?>
</option>
					  <?php endforeach; endif; unset($_from); ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
          <button class="btn btn-w-m btn-info save-form" type="button">保存数据</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- 自定义js --> 
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 
<script>
var chance_url="<?php echo @ACT; ?>
/crm/SalContract/sal_contract_select_back/";
$(document).ready(function () {
	$('.chosen-select').chosen({search_contains: true});
	$(".customer-chosen-select").val("<?php echo $this->_tpl_vars['contract']['customer_id']; ?>
").trigger("chosen:updated");
	$(".contract-chosen-select").val("<?php echo $this->_tpl_vars['contract']['contract_id']; ?>
").trigger("chosen:updated");

	findSalContractChosenSelect('contract-chosen-select',chance_url,"<?php echo $this->_tpl_vars['contract']['customer_id']; ?>
");
	contract_id=$('.contract-chosen-select option:selected').val();
	contract_get_one(contract_id);
	
	//选择用户跳出关联订单
	$('.customer-chosen-select').on('change', function(e, params) {
		change_val=$(this).val();
		findSalContractChosenSelect('contract-chosen-select',chance_url,change_val);
		contract_id=$('.contract-chosen-select option:selected').val();
		contract_get_one(contract_id);
	});
	
	//选择用户跳出关联订单
	$('.contract-chosen-select').on('change', function(e, params) {
		change_val=$(this).val();
		contract_id=$('.contract-chosen-select option:selected').val();
		contract_get_one(contract_id);
	});
	
	//调用关联订单数据
	function contract_get_one(contract_id){
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/crm/SalContract/sal_contract_get_one_json/",
			data:{"contract_id":contract_id},
			dataType:"json",
			success: function(data){
				$(".form-horizontal input[name='contract_money']").val(data.money);
				$(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
				$(".form-horizontal input[name='contract_back_money']").val(data.back_money);
				$(".form-horizontal input[name='contract_owe_money']").val(data.owe_money);
				$(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);
				$(".form-horizontal input[name='back_money']").val(data.owe_money);
				$(".form-horizontal input[name='owe_money']").val(0);//默认为尚欠为0
				$(".form-horizontal input[name='contract_name']").val(data.title);
			},    
			complete: function() { },
		});		
	}
	
	$("body").on("click", ".save-form", function() {
		FormData=$("form").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/erp/FinReceRecord/fin_rece_record_add/",
			data:FormData,
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1}); 		
				}else{
					layer.msg(data.message, {icon: 5}); 		
				}
			},    
			complete: function() { 
				setTimeout(function(){
					//关闭窗口
					var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
					parent.layer.close(index);
				 },800);

   		  },
		});		
	});
	$("body").on("keyup", ".calculate", function() {
		//查询本行的数据
		var contract_money=$(".form-horizontal input[name='contract_money']").val();
		var contract_back_money=$(".form-horizontal input[name='contract_back_money']").val();
		var contract_owe_money=$(".form-horizontal input[name='contract_owe_money']").val();
		var contract_zero_money=$(".form-horizontal input[name='contract_zero_money']").val();
		var contract_invoice_money=$(".form-horizontal input[name='contract_invoice_money']").val();
		var back_money=$(".form-horizontal input[name='back_money']").val();
		var zero_money=$(".form-horizontal input[name='zero_money']").val();
		
		var owe_money = parseFloat(contract_owe_money)-parseFloat(back_money)-parseFloat(zero_money);
		if(owe_money<0){
			layer.msg('本次回款的金额和去零金额不能超过 '+contract_owe_money, {icon: 5}); 	
		}
		$(".form-horizontal input[name='owe_money']").val(owe_money);
		console.log(owe_money);
	});
});
</script>
</body>
</html>