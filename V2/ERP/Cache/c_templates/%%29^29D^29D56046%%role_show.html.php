<?php /* Smarty version 2.6.26, created on 2019-05-01 13:39:17
         compiled from sysmanage/role_show.html */ ?>
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
          <h5><i class="fa fa-home"></i>角色管理</h5>
          <div class="ibox-tools"> <a href="<?php echo @ACT; ?>
/sysmanage/Role/role_add/" >
            <button type="button" class="btn btn-xs btn-primary"><i class='fa fa-plus'></i> 添加</button>
            </a> <a href="?">
            <button type="button" class="btn btn-xs btn-danger"> <i class='fa fa-refresh'></i>刷新</button>
            </a> </div>
        </div>
        <div class="ibox-content">
          <div class="treeClassBody"><?php echo $this->_tpl_vars['treeHtml']; ?>
</div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script>
<script type="text/javascript">
$(document).ready(function () {

	$("body").on("click", ".single_operation", function() {
		role_id =$(this).attr("data-id");
		single_act =$(this).attr("data-act")
		if(single_act=="power"){
			layer.open({
				type: 2,
				title: '权限维护',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/sysmanage/Role/role_check_power/role_id/'+role_id,
				end: function () {
				
				}
			});			
			return false;		
		}else if(single_act=="add"){
			layer.open({
				type: 2,
				title: '添加权限',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/sysmanage/Role/role_add/role_id/'+role_id,
				end: function () {
				
				}
			});			
			return false;		
		}else if(single_act=="modify"){
			layer.open({
				type: 2,
				title: '修改权限',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/sysmanage/Role/role_modify/role_id/'+role_id,
				end: function () {
				
				}
			});			
			return false;		
		}else if(single_act=="del"){
			$.ajax({
				type: "POST",
				url: "<?php echo @ACT; ?>
/index.php/sysmanage/Role/role_del/",
				data:{"role_id":role_id},
				dataType:"json",
				success: function(data){
					if(data.statusCode=='200'){
						layer.msg('操作成功', {icon: 1});   
					}
					console.log(data.message);
				}
			});
		}
	});
	
	//更改排序
	$("body").on("blur", ".treeSort", function() {
		id =$(this).attr("data-id");
		sort =$(this).val();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/index.php/sysmanage/Role/role_modify_sort/",
			data:{"sort":sort,"id":id},
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1});   
				}
				console.log(data.message);
			}
		});
	});
	//更改排序
	$("body").on("blur", ".treeName", function() {
		id =$(this).attr("data-id");
		value =$(this).val();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/index.php/sysmanage/Role/role_modify_name/",
			data:{"name":value,"id":id},
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1});   
				}
				console.log(data.message);
			}
		});
	});
	//更改排序
	$("body").on("blur", ".treeUrl", function() {
		id =$(this).attr("data-id");
		value =$(this).val();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/index.php/sysmanage/Dept/dept_modify_url/",
			data:{"url":value,"id":id},
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1});   
				}
				console.log(data.message);
			}
		});
	});
});
</script>