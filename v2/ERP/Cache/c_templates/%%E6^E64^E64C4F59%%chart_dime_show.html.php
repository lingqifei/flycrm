<?php /* Smarty version 2.6.26, created on 2019-09-29 16:01:52
         compiled from erp/chart_dime_show.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'erp/chart_dime_show.html', 76, false),)), $this); ?>
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
                    <h5><i class="fa fa-home"></i> 多维度汇总列表</h5>
                    <div class="ibox-tools"></div>
                </div>
                <div class="ibox-content table-responsive">
                    <div class="row">
                        <form id="pagerForm" method="post" class="form-inline"
                            action="<?php echo @ACT; ?>
/erp/ChartDime/chart_dime_show/">
                            <div class="col-sm-3 m-b-xs"><a href="?">
                                <button type="button" class="btn btn-default"><i class="fa fa-refresh"></i>刷新</button>
                            </a></div>
                            <div class="col-sm-9 m-b-xs text-right"> 录入日期：
                                <div class="input-group pd-b-5">
                                    <input type="text" name="create_date_b" class="form-control datepicker"
                                        style="width: 100px;" value="<?php echo $this->_tpl_vars['create_date_b']; ?>
">
                                </div>
                                <div class="input-group pd-b-5">
                                    <input type="text" name="create_date_e" class="form-control datepicker"
                                        style="width: 100px;" value="<?php echo $this->_tpl_vars['create_date_e']; ?>
">
                                </div>
                                <div class="input-group"> <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary ajaxSearchForm"><i class="fa fa-search"></i> 搜索</button>
                  </span></div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>概要统计</h5>
                                </div>
                                <div class="ibox-content no-padding">
                                    <table class="table table-hover" width="100%">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>今天</th>
                                            <th>7天</th>
                                            <th>1个月</th>
                                            <th>所有时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>新增客户</td>
                                            <td><?php echo $this->_tpl_vars['customer']['today']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['customer']['seven']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['customer']['month']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['customer']['all']['total_num']; ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>跟单记录</td>
                                            <td><?php echo $this->_tpl_vars['trace']['today']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['trace']['seven']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['trace']['month']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['trace']['all']['total_num']; ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>新增合同</td>
                                            <td><?php echo $this->_tpl_vars['contract']['today']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['contract']['seven']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['contract']['month']['total_num']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['contract']['all']['total_num']; ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>合同总金额</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['today']['total_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['seven']['total_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['month']['total_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['all']['total_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>回款总金额</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['today']['total_back_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['seven']['total_back_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['month']['total_back_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['all']['total_back_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>去零总金额</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['today']['total_zero_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['seven']['total_zero_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['month']['total_zero_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['all']['total_zero_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>未收总金额</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['today']['total_owe_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['seven']['total_owe_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['month']['total_owe_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['all']['total_owe_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>交付总金额</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['today']['total_deliver_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['seven']['total_deliver_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['month']['total_deliver_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['all']['total_deliver_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                        </tr>
                                        <tr>
                                            <td>开票总金额</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['today']['total_invoice_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['seven']['total_invoice_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['month']['total_invoice_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                            <td class="text-danger"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['all']['total_invoice_money'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script>