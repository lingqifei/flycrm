<?php /* Smarty version 2.6.26, created on 2018-12-31 16:09:19
         compiled from sysmanage/sys_password_modify.html */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>密码修改</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo @APP; ?>
/View/template/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="<?php echo @APP; ?>
/View/template/css/font-awesome.css?v=4.4.0" rel="stylesheet">
<link href="<?php echo @APP; ?>
/View/template/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?php echo @APP; ?>
/View/template/css/animate.css" rel="stylesheet">
<link href="<?php echo @APP; ?>
/View/template/css/style.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
  <div class="col-sm-12">
   <div class="ibox float-e-margins">
    <div class="ibox-title">
     <h5>密码修改</h5>
    </div>
    <div class="ibox-content">
     <form class="form-horizontal" method="post" action="<?php echo @ACT; ?>
/sysmanage/Sys/sys_password_modify/">
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
        <button class="btn btn-sm btn-info" type="submit">保存数据</button>
       </div>
      </div>
     </form>
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

<!-- 自定义js --> 
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 

<!-- iCheck --> 
<script src="<?php echo @APP; ?>
/View/template/js/plugins/iCheck/icheck.min.js"></script> 
<script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>
</html>