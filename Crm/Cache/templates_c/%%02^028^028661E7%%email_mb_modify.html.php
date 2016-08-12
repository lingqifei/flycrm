<?php /* Smarty version 2.6.26, created on 2016-06-30 14:58:02
         compiled from email/email_mb_modify.html */ ?>
<h2 class="contentTitle">模板修改</h2>
<div class="pageContent">
  <form method="post" action="<?php echo @ACT; ?>
/EmailSend/email_mb_modify/id/<?php echo $this->_tpl_vars['one']['id']; ?>
/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>标题：</dt>
				<dd><input type="text"  name="name" class="required" value="<?php echo $this->_tpl_vars['one']['name']; ?>
"/>
                	 <span class="info">&nbsp;发送邮件标题：零起网络还是不错</span>
                </dd>
			</dl>
			<dl>
				<dt>内容：</dt>
				<dd><textarea name="content" cols="100" rows="20" class="editor"><?php echo $this->_tpl_vars['one']['content']; ?>
</textarea>
                	<span class="info">&nbsp;发送内容：零起飞网络提供网站建设，网站推广，网站优化等服务</span>
                </dd>
			</dl>
				
		</div>
    <div class="formBar">
      <ul>
        <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
        <li>
          <div class="buttonActive">
            <div class="buttonContent">
              <button type="submit">保存</button>
            </div>
          </div>
        </li>
        <li>
          <div class="button">
            <div class="buttonContent">
              <button type="button" class="close">取消</button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </form>
</div>