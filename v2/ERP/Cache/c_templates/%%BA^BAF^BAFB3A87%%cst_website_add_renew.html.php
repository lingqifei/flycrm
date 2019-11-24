<?php /* Smarty version 2.6.26, created on 2019-10-21 14:09:17
         compiled from crm/cst_website_add_renew.html */ ?>
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
      <input type="hidden" name="website_id" value="<?php echo $this->_tpl_vars['one']['website_id']; ?>
">
      <div class="form-group">
        <label class="col-sm-2 control-label">续费年限</label>
        <div class="col-sm-10">
          <input name="year_num" class="form-control" type="text" placeholder="请输入需要续费几年，只能输入为数字"/>
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">续费金额</label>
        <div class="col-sm-10">
          <input name="money" class="form-control" type="text" placeholder="请输入续费需要的金额"/>
          <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">介绍</label>
        <div class="col-sm-10">
          <textarea name="intro" class="form-control"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
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
	
	$("body").on("click", ".save-form", function() {
		FormData=$("form").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/crm/CstWebsite/cst_website_add_renew/",
			data:FormData,
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
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