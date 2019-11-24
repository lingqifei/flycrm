<?php /* Smarty version 2.6.26, created on 2019-11-18 18:15:14
         compiled from sysmanage/sys_data.html */ ?>
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
          <h5><i class="fa fa-home"></i>数据备份/恢复</h5>
          <div class="ibox-tools"> 
			  		<a href="<?php echo @ACT; ?>
/sysmanage/SysData/sys_data_back/" ><button type="button" class="btn btn-xs btn-primary"> 数据库备份</button></a> 
			  	  <a href="<?php echo @ACT; ?>
/sysmanage/SysData/sys_data_res/"><button type="button" class="btn btn-xs btn-info"> 数据库还原</button></a> 
			  	  <a href="javascript:void(0)" class="single_operation" data-act="init"><button type="button" class="btn btn-xs btn-danger">权限初始化</button></a> 
				</div>
        </div>
        <div class="ibox-content">
          <table class="table table-striped table-bordered table-hover dataTables-example">
            <thead>
              <tr>
                <th>全选</th>
                <th>表名</th>
                <th>数据量</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
            
            <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <tr target="sid_user" rel="<?php echo $this->_tpl_vars['v']['name']; ?>
">
              <td><input name="ids" value="<?php echo $this->_tpl_vars['v']['name']; ?>
" type="checkbox"></td>
              <td><?php echo $this->_tpl_vars['v']['name']; ?>
</td>
              <td><?php echo $this->_tpl_vars['v']['cnt']; ?>
</td>
              <td>优化 | 修复 | 结构</td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
              </tbody>
            
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 全局js --> 
<script src="<?php echo @APP; ?>
/View/template/js/jquery.min.js?v=2.1.4"></script> 
<script src="<?php echo @APP; ?>
/View/template/js/bootstrap.min.js?v=3.3.6"></script>
<!-- layer javascript --> 
<script src="<?php echo @APP; ?>
/View/template/js/plugins/layer/layer.min.js"></script> 
<!-- 自定义js --> 
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 
</body>
<script>
$(document).ready(function () {
	$("body").on("click", ".single_operation", function() {
		act_url="<?php echo @ACT; ?>
/sysmanage/SysData/sys_data_role_init/";
		customer_id =$(this).attr("data-id");
		single_act =$(this).attr("data-act")
		if(single_act=="init"){
			$.ajax({
				type: "POST",
				url: act_url,
				data:{"customer_id":customer_id},
				dataType:"json",
				async: false,
				success: function(data){
					if(data.statusCode=='200'){
						layer.msg('操作成功', {icon: 1}); 
					}
				}
			});
			return false;			
		}else if(single_act=="detail"){
			act_url="<?php echo @ACT; ?>
/crm/CstCustomer/cst_customer_detail/customer_id/"+customer_id+"/";
			window.location.href=act_url;
		}else if(single_act=="offline"){
			act_url="<?php echo @ACT; ?>
/crm/CstCustomer/cst_customer_modify_offline/";
		}
	});	
});
</script>
<!-- Mirrored from www.upfine.cn/theme/hplus/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
</html>