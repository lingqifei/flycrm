<?php /* Smarty version 2.6.26, created on 2019-05-01 14:01:16
         compiled from sysmanage/role_add.html */ ?>
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
      <div class="form-group">
       <label class="col-sm-2 control-label">名称</label>
       <div class="col-sm-8">
        <input name="name" class="form-control" type="text" placeholder="请输入名称" required/>
        <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
       <label class="col-sm-2 control-label">父级</label>
       <div class="col-sm-8"> <?php echo $this->_tpl_vars['parentID']; ?>
 <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
       <label class="col-sm-2 control-label">排序</label>
       <div class="col-sm-8">
        <input name="sort" class="form-control" type="digits" placeholder="栏目排序号"/>
        <span class="help-block m-b-none"></span> </div>
      </div>
      <div class="form-group">
       <label class="col-sm-2 control-label">是否启用</label>
       <div class="col-sm-8">
        <div class="checkbox i-checks">
          <input type="checkbox" name="visible" value="1" >
        </div>
       </div>
      </div>
		 <div class="form-group">
       <label class="col-sm-2 control-label">部门介绍</label>
       <div class="col-sm-8">
        <textarea name="intro" class="form-control" cols="80" rows="2"><?php echo $this->_tpl_vars['one']['intro']; ?>
</textarea>
        <span class="help-block m-b-none"></span> </div>
      </div>		 
      <div class="form-group">
       <div class="col-sm-offset-2 col-sm-8">
        <button class="btn  btn-w-m btn-info save-form" type="button">保存数据</button>
       </div>
      </div>
     </form>
    </div>
   </div>
  </div>
 </div>
</div>
</body>
</html>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 
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
/sysmanage/Role/role_add/",
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