<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2023-02-06
 */

namespace app\material\validate;

/**
 * 货架格断管理=》验证器
 */
class MaterialShelvesCell extends MaterialBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'shelves_id'      => 'require|integer',
        'start_num'      => 'require|integer',
        'end_num'      => 'require|gt:start_num',
        'shelves_cell_code'      => 'require|unique:material_shelves_cell',

    ];

    // 验证提示
    protected $message  =   [
        'name.require'      => '名称不能为空',
        'shelves_id.require'      => '选择的货架不能为空',
        'start_num.require'      => '开始编号不能为空',
        'start_num.integer'      => '开始编号必须为数字',
        'end_num.integer'      => '结束编号必须为数字',
        'end_num.require'      => '结束编号不能为空',
        'end_num.gt'      => '结束编号要大于开始编号',
        'shelves_cell_code.require'      => '货架格子编号不能为空',
        'shelves_cell_code.unique'      => '货架格子编号不能重复',
    ];

    // 应用场景
    protected $scene = [
        'add'       =>  ['shelves_id','start_num','end_num'],
        'edit'       =>  ['shelves_cell_code'],
    ];

}
