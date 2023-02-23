<?php
// +----------------------------------------------------------------------
// | 07FLY系统 [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | 07FLY承诺基础框架永久开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 开发人生 <574249366@qq.com>
// +----------------------------------------------------------------------
/**
 * 模块基本信息
 */
return [
    // 模块名[必填]
    'name'        => 'oask',
    // 模块标题[必填]
    'title'       => 'OA开源',
    // 模块唯一标识[必填]，格式：module.[应用市场ID].模块名[应用市场分支ID]
    'identifier'  => 'oask.lingqifei',
    // 主题模板[必填]，默认default
    'theme'        => 'default',
    // 模块图标[选填]
    'icon'        => 'aicon ai-mokuaiguanli',
    // 模块简介[选填]
    'intro' => 'oa办公管理系统，包含个人办公、通讯录、行政办公、协同办公、门店管理',
    // 开发者[必填]
    'author'      => 'lingqifei',
    // 开发者网址[选填]
    'author_url'  => 'http://www.07fly.xyz',
    // 版本[必填],格式采用三段式：主版本号.次版本号.修订版本号
    // 主版本号【位数变化：1-99】：当模块出现大更新或者很大的改动，比如整体架构发生变化。此版本号会变化。
    // 次版本号【位数变化：0-999】：当模块功能有新增或删除，此版本号会变化，如果仅仅是补充原有功能时，此版本号不变化。
    // 修订版本号【位数变化：0-999】：一般是 Bug 修复或是一些小的变动，功能上没有大的变化，修复一个严重的bug即发布一个修订版。
    'version'     => '1.0.1',
    //关联数据表是指模块所需要的数据表名称，如果有多个表用英文逗号（,）分隔。如：table1,table2
    'tables'     => 'activity,
activity_reply,
assets,
assets_reply,
assets_type,
attendance,
attendance_type,
company_album,
contacts,
contacts_type,
contract,
contract_reply,
cst_contract,
cst_customer,
cst_dict,
cst_dict_type,
cst_sales,
cst_trace,
document,
document_reply,
hrm_staff,
hrm_staff_care,
hrm_staff_contract,
hrm_staff_licence,
hrm_staff_reward,
hrm_staff_study,
licence,
licence_reply,
meeting,
meeting_reply,
myfile,
notice,
notice_reply,
oa_notify,
oa_notify_user,
other_notes,
other_notes_reply,
regulation,
regulation_reply,
regulation_type,
sequence,
share_file,
shop,
shop_album,
shop_file_dept,
shop_file_dept_reply,
shop_file_inside,
shop_file_inside_reply,
shop_licence,
shop_notes,
shop_staff,
sup_contract,
sup_linkman,
sup_sales,
sup_supplier,
sup_trace,
weburl,
workflow,
workflow_deal',
];