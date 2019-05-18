<?php /* Smarty version 2.6.26, created on 2019-05-02 17:18:50
         compiled from sysmanage/sys_password_modify.html */ ?>
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
          <h5>密码修改</h5>
        </div>
        <div class="ibox-content">
          <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
              <label class="col-sm-2 control-label">旧密码</label>
              <div class="col-sm-8">
                <input name="oldpassword" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" placeholder="请输之前登录密码" required/>
                <span class="help-block m-b-none"></span> </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">新密码</label>
              <div class="col-sm-8">
                <input name="newpassword" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['name_en']; ?>
" placeholder="请输新的登录密码" required/>
                <span class="help-block m-b-none"></span> </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">密码确认</label>
              <div class="col-sm-8">
                <input name="newpassword1" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['name_en']; ?>
" placeholder="请再次输入新的登录密码" required/>
                <span class="help-block m-b-none"></span> </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-8">
                <button class="btn btn-sm btn-info save-form" type="button">保存数据</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 
<!-- iCheck --> 
<script src="<?php echo @APP; ?>
/View/template/js/plugins/iCheck/icheck.min.js"></script> 
<script>
	//数据保存
	$("body").on("click", ".save-form", function() {
		FormData=$("form").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/sysmanage/Sys/sys_password_modify/",
			data:FormData,
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1}); 		
				}else{
					layer.msg(data.message, {icon: 5}); 		
				}
			}
		});		
	});
    </script>
</body>
</html>