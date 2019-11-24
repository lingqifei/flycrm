<?php /* Smarty version 2.6.26, created on 2019-09-29 18:16:45
         compiled from sysmanage/sys_config.html */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>系统配置</title>
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
     <h5>系统参数</h5>
     <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#"> <i class="fa fa-wrench"></i> </a>
      <ul class="dropdown-menu dropdown-user">
       <li><a href="form_basic.html#">选项1</a> </li>
       <li><a href="form_basic.html#">选项2</a> </li>
      </ul>
      <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
    </div>
    <div class="ibox-content">
     <form class="form-horizontal" method="post" action="<?php echo @ACT; ?>
/sysmanage/SysConfig/sys_config/">
      <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
      <div class="form-group">
       <label class="col-sm-2 control-label"><?php echo $this->_tpl_vars['v']['name']; ?>
</label>
       <div class="col-sm-8"><?php echo $this->_tpl_vars['v']['namevalue']; ?>
</div>
       <div class="col-sm-2"><span class="help-block m-b-none"><?php echo $this->_tpl_vars['v']['varname']; ?>
</span> </div>
      </div>
      <?php endforeach; endif; unset($_from); ?>
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