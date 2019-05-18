<?php /* Smarty version 2.6.26, created on 2019-05-01 13:39:39
         compiled from sysmanage/user_modify.html */ ?>
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
    <div class="ibox-content">
     <form class="form-horizontal" method="post" action="#">
		 <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['one']['id']; ?>
">
		 <div class="form-group">
       <label class="col-sm-2 control-label">帐号</label>
       <div class="col-sm-8">
        <input name="account" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['account']; ?>
" placeholder="请输入帐号" required/>
        <span class="help-block m-b-none"></span> </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">密码</label>
       <div class="col-sm-8">
        <input name="password" class="form-control" type="text" value="" placeholder="不修改密码此处不用填写" required/>
        <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
       <label class="col-sm-2 control-label">姓名</label>
       <div class="col-sm-8">
        <input name="name" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['name']; ?>
" placeholder="请输入名称" required/>
        <span class="help-block m-b-none"></span> </div>
      </div>
		<div class="form-group">
       <label class="col-sm-2 control-label">姓别</label>
       <div class="col-sm-8">
        <div class="radio i-checks">
          	<input type="radio" name="gender" value="1" <?php if ($this->_tpl_vars['one']['gender'] == 1): ?> checked="checked" <?php endif; ?> />男
				<input type="radio" name="gender" value="2" <?php if ($this->_tpl_vars['one']['gender'] == 2): ?> checked="checked" <?php endif; ?> />女
        </div>
       </div>
      </div>
		 
      <div class="form-group">
       <label class="col-sm-2 control-label">部门</label>
       <div class="col-sm-8"> <?php echo $this->_tpl_vars['dept']; ?>
 <span class="help-block m-b-none"></span> </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">职位</label>
       <div class="col-sm-8"> <?php echo $this->_tpl_vars['position']; ?>
 <span class="help-block m-b-none"></span> </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">角色</label>
       <div class="col-sm-8"> <?php echo $this->_tpl_vars['role']; ?>
 <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
       <label class="col-sm-2 control-label">手机</label>
       <div class="col-sm-8">
        <input name="mobile" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['mobile']; ?>
" placeholder="输入手机号"/>
        <span class="help-block m-b-none"></span> </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">QQ</label>
       <div class="col-sm-8">
        <input name="qicq" class="form-control" type="text" value="<?php echo $this->_tpl_vars['one']['qicq']; ?>
" placeholder="输入QQ号码"/>
        <span class="help-block m-b-none"></span> </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">邮箱</label>
       <div class="col-sm-8">
        <input name="email" class="form-control" type="email" value="<?php echo $this->_tpl_vars['one']['email']; ?>
" placeholder="输入邮箱地址"/>
        <span class="help-block m-b-none"></span> </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">介绍</label>
       <div class="col-sm-8">
        <textarea name="intro" class="form-control" cols="80" rows="2"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
        <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
       <div class="col-sm-offset-2 col-sm-8">
        <button class="btn  btn-w-m btn-info  save-form" type="button">保存数据</button>
       </div>
      </div>
     </form>
    </div>
   </div>
  </div>
 </div>
</div>

<script>
$(document).ready(function () {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
	//数据保存
	$("body").on("click", ".save-form", function() {
		FormData=$("form").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/sysmanage/User/user_modify/",
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