<?php /* Smarty version 2.6.26, created on 2019-09-29 15:58:17
         compiled from sysmanage/message_show_cron.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="ibox-content">
  <ul class="sortable-list connectList agile-list">
    <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
    <div class="row line-h20 mr-b-5">
      <div class="col-xs-12"><?php echo $this->_tpl_vars['v']['msg_type']; ?>
:<a href="javascript:void(0)" class="single_operation" data-url="<?php echo $this->_tpl_vars['v']['url']; ?>
" data-act="view"><?php echo $this->_tpl_vars['v']['msg_title']; ?>
</a></div>
      <div class="col-xs-6"> <i class="fa fa-clock-o"></i><?php echo $this->_tpl_vars['v']['content']; ?>
</div>
      <div class="col-xs-6 text-right"><a href="javascript:void(0)" class="btn btn-xs btn-info btn-rounded single_operation" data-id="<?php echo $this->_tpl_vars['v']['id']; ?>
" data-act="read">标记已读</a></div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
  </ul>
</div>
</body>
</html>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 
<script type="text/javascript">
$(document).ready(function () {
	$("body").on("click", ".single_operation", function() {
		message_id =$(this).attr("data-id");
		single_act =$(this).attr("data-act")
		single_url =$(this).attr("data-url")
		if(single_act=="view"){
			parent.layer.open({
				type: 2,
				title: '查看通知',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: single_url
			});			
			return false;	
		}else if(single_act=="read"){
			act_url="<?php echo @ACT; ?>
/sysmanage/Message/message_read/";
			$.ajax({
				type: "POST",
				url: act_url,
				data:{"message_id":message_id},
				dataType:"json",
				beforeSend: function() {
						layer.msg('数据处理中',{
									time:1000,
									icon: 16,
									shade: 0.01
								  }
								 );
				},
				success: function(data){
					if(data.statusCode=='200'){
						window.location.reload();

					}
				}
			});
		}

	});
	
	
});
</script>