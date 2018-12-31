<?php /* Smarty version 2.6.26, created on 2018-12-31 16:33:58
         compiled from sysmanage/role_check_power.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><i class="fa fa-home"></i> 权限菜单</h5>
        </div>
        <div class="ibox-content">
			<form id="pagerForm" method="post" class="form-inline">
			  <input type="hidden" name="role_id" value="1">
          <div class="treeClassBody"><?php echo $this->_tpl_vars['treeHtml']; ?>
</div>
				<div class="ibox-content"><button type="button" class="btn btn-info save-data">保存数据</button></div>
			</form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
	$("body").on("click", ".children_method", function() {//最后一栏目选择
		$(this).nextAll().prop("checked", $(this).prop('checked'));
		$(this).parents('.children_menu').prop("checked", $(this).prop('checked'));
		$(this).parents('.children_method').prop("checked", $(this).prop('checked'));
	});
	$("body").on("click", ".children_menu", function() {//最后一栏目选择
		chk= $(this).prop('checked');
		$(this).parent().parent().parent().find('input').prop("checked", $(this).prop('checked'));
		$(this).parents('.children_menu').prop("checked", $(this).prop('checked'));
	});
	
	////获取窗口索引关闭窗口
	var list_add_index = parent.layer.getFrameIndex(window.name); 
	
	//保存数据
	$("body").on("click", ".save-data", function() {
		FormData=$("#pagerForm").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/sysmanage/Role/role_check_power_save/",
			data:FormData,
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1}); 	
					setTimeout(function(){
						parent.layer.close(list_add_index);
					 },800);
				}else{
					layer.msg(data.message, {icon: 5});
					return false;
				}
			}
		});			
	});
	

	
});
</script>