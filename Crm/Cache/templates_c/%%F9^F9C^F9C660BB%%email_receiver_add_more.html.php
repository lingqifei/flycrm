<?php /* Smarty version 2.6.26, created on 2016-11-18 21:40:00
         compiled from email/email_receiver_add_more.html */ ?>
<h2 class="contentTitle">批量添加接收地址</h2>
<div class="pageContent">
  <form method="post" action="<?php echo @ACT; ?>
/EmailSend/email_receiver_add_more/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <div class="pageFormContent nowrap" layoutH="97">
      <dl>
        <dt>分组：</dt>
        <dd><?php echo $this->_tpl_vars['groupoption']; ?>
 <span class="info">&nbsp;邮件地址分组选择</span> </dd>
      </dl>
      <dl>
        <dt>内容：</dt>
        <dd>
          <textarea name="content" cols="100" rows="10" class="editor"><?php echo $this->_tpl_vars['one']['content']; ?>
</textarea>
          <span class="info">&nbsp;格式：名称,帐号<br />格式一个发送记录为行中间用逗号分隔。</span> </dd>
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