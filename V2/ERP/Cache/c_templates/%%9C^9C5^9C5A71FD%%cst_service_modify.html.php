<?php /* Smarty version 2.6.26, created on 2019-05-15 17:03:07
         compiled from crm/cst_service_modify.html */ ?>
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
		<input type="hidden" name="service_id" value="<?php echo $this->_tpl_vars['one']['service_id']; ?>
">
      <div class="form-group text-left">
        <label class="col-sm-2 control-label">服务类型</label>
        <div class="col-sm-8">
          <select data-placeholder="选择服务类型..." name="services" class="chosen-select services" style="width: 200px;" tabindex="2">
            <option value="">请选服务类型</option>
					  <?php $_from = $this->_tpl_vars['services']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
					  <option value="<?php echo $this->_tpl_vars['v']['dict_id']; ?>
" hassubinfo="true"><?php echo $this->_tpl_vars['v']['name']; ?>
</option>
					  <?php endforeach; endif; unset($_from); ?>
          </select>
        </div>
      </div>
		<div class="form-group text-left">
        <label class="col-sm-2 control-label">服务方式</label>
        <div class="col-sm-10">
          <select data-placeholder="选择服务方式..." name="servicesmodel" class="chosen-select servicesmodel" style="width: 200px;" tabindex="2">
            <option value="">请选服服务方式</option>
					  <?php $_from = $this->_tpl_vars['servicesmodel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
					  <option value="<?php echo $this->_tpl_vars['v']['dict_id']; ?>
" hassubinfo="true"><?php echo $this->_tpl_vars['v']['name']; ?>
</option>
					  <?php endforeach; endif; unset($_from); ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">服务时间</label>
        <div class="col-sm-10">
          <input name="service_time" class="form-control datepicker" type="text" value="<?php echo $this->_tpl_vars['one']['service_time']; ?>
"/>
          <span class="help-block m-b-none"></span> </div>
      </div>
		<div class="form-group">
        <label class="col-sm-2 control-label">花费时间</label>
        <div class="col-sm-10">
          <input name="tlen" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['tlen']; ?>
" required/>
          <span class="help-block m-b-none">请输服务花费时间单位为分钟</span> </div>
      </div>
		<div class="form-group">
        <label class="col-sm-2 control-label">服务内容</label>
        <div class="col-sm-10">
				<textarea name="content" class="form-control"><?php echo $this->_tpl_vars['one']['content']; ?>
</textarea>
			</div>
      </div>		
      <div class="form-group text-left">
        <label class="col-sm-2 control-label">客户名称</label>
        <div class="col-sm-10">
          <select data-placeholder="选择分类..." name="customer_id" class="chosen-select customer" style="width: 200px;" tabindex="2">
            <option value="">请选分类字典</option>
					  <?php $_from = $this->_tpl_vars['customer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
					  <option value="<?php echo $this->_tpl_vars['v']['customer_id']; ?>
" hassubinfo="true"><?php echo $this->_tpl_vars['v']['name']; ?>
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
$(document).ready(function () {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
	
	$(".datepicker").datetimepicker({
		language: "zh-CN",
		autoclose: true,//选中之后自动隐藏日期选择框
		clearBtn: true,//清除按钮
		todayBtn: true,//今日按钮
		format: "yyyy-mm-dd hh:ii:ss",
	});
	
	$('.chosen-select').chosen({search_contains: true});
	$(".customer").val("<?php echo $this->_tpl_vars['one']['customer_id']; ?>
").trigger("chosen:updated");
	$(".services").val("<?php echo $this->_tpl_vars['one']['services']; ?>
").trigger("chosen:updated");
	$(".servicesmodel").val("<?php echo $this->_tpl_vars['one']['servicesmodel']; ?>
").trigger("chosen:updated");
	
	$("body").on("click", ".save-form", function() {
		FormData=$("form").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/crm/CstService/cst_service_modify/",
			data:FormData,
			dataType:"json",
			success: function(data){
				if(data.rtnstatus=='success'){
					layer.msg('操作成功', {icon: 1}); 		
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
});
</script>
</body>
</html>