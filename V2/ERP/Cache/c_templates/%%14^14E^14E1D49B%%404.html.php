<?php /* Smarty version 2.6.26, created on 2018-12-31 16:06:56
         compiled from 404.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="middle-box text-center animated fadeInDown">
  <h1><i class="fa fa-lock text-danger"></i></h1>
  <h3 class="font-bold">亲，你没有权限得哟！</h3>
  <div class="error-desc"> 抱歉，你没有权限访问，请您联系管理员或者上级人员~~
    <form class="form-inline m-t" role="form">
      <div class="form-group">
        <input type="email" class="form-control" placeholder="请输入您需要查找的内容 …">
      </div>
      <button type="submit" class="btn btn-primary">搜索</button>
    </form>
  </div>
</div>
</body>
</html>