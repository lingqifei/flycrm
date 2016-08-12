<?php /* Smarty version 2.6.26, created on 2016-06-13 16:10:29
         compiled from email/email_scheme_run.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/User/user_import/filename/<?php echo $this->_tpl_vars['filename']; ?>
/action/import/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>发送地址共计：</label>
				<?php echo $this->_tpl_vars['from_cnt']; ?>

			</p>
			<p>
				<label>接收地址共计：</label>
				<?php echo $this->_tpl_vars['rece_cnt']; ?>

			</p>
            <iframe name="impordframe" src="" width="100%" height"30%" allowtransparency="true" style="background-color=transparent" title="test" frameborder="0">  
</iframe> 
		</div>
		<div class="formBar">
			<ul>
				<li><a class="buttonActive" href="javascript:show_syslog();"><span>确定导入</span></a></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>

<script type="text/javascript"> 
function show_syslog(){ 
	document.impordframe.location.href="<?php echo @ACT; ?>
/EmailSend/email_scheme_run/id/<?php echo $this->_tpl_vars['id']; ?>
/action/send/total/<?php echo $this->_tpl_vars['rece_cnt']; ?>
/"; 
} 
</script> 