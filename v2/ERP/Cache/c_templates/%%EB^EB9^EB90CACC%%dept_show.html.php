<?php /* Smarty version 2.6.26, created on 2019-11-20 11:14:18
         compiled from sysmanage/dept_show.html */ ?>
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
			<h5><i class="fa fa-home"></i>部门管理</h5>
          <div class="ibox-tools">
          	  <a class="single_operation" data-act="add" href="javascript:void(0)">
              <button type="button" class="btn btn-xs btn-primary"><i class='fa fa-plus'></i> 添加</button>
              </a> 
            <a href="?"><button type="button" class="btn btn-xs btn-danger"> <i class='fa fa-refresh'></i>刷新</button></a> 
			  </div>
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
		dept_id =$(this).attr("data-id");
		single_act =$(this).attr("data-act")
		if(single_act=="add"){
			layer.open({
				type: 2,
				title: '添加部门',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/sysmanage/Dept/dept_add/pid/'+dept_id,
				end: function () {
				
				}
			});			
			return false;		
		}else if(single_act=="modify"){
			layer.open({
				type: 2,
				title: '修改部门信息',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/sysmanage/Dept/dept_modify/id/'+dept_id,
				end: function () {
				
				}
			});			
			return false;		
		}else if(single_act=="del"){
			$.ajax({
				type: "POST",
				url: "<?php echo @ACT; ?>
/sysmanage/Dept/dept_del/",
				data:{"id":dept_id},
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
/sysmanage/Dept/dept_modify_sort/",
			data:{"sort":sort,"id":id},
			dataType:"json",
			success: function(data){
				if(data.rtnstatus=='success'){
					layer.msg('操作成功', {icon: 1});   
				}
				console.log(data.rtnstatus);
			}
		});
	});
	//更改名称
	$("body").on("blur", ".treeName", function() {
		id =$(this).attr("data-id");
		value =$(this).val();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/sysmanage/Dept/dept_modify_name/",
			data:{"name":value,"id":id},
			dataType:"json",
			success: function(data){
				if(data.rtnstatus=='success'){
					layer.msg('操作成功', {icon: 1});   
				}
				console.log(data.rtnstatus);
			}
		});
	});
});
</script>