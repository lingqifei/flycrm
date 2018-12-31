<?php
/**
 * @CopyRight  (C)2006-2011 07fly Development team Inc.
**/
//用户配置
 return array (

	'URLMode'   => 0,			
	'ActionDir' => 'hiddenDir/',
	'htmlExt'  => '.html',
	'ReWrite'  => true,
	'Router'  => '',
	'Debug'     => true,  
	'Session'   => true,
	'pageSize'  =>10,
	'xml'=>array(
		'path'=>EXTEND.'xml',
		'root'=>'niaomuniao',
	),	
	'DB'=>array(
		'Persistent'=>false,
		'DBtype'    => 'Mysql',
		'DBcharSet' => 'utf8',
		'DBhost'    => 'localhost',
		'DBport'    => '3306',
		'DBuser'    => 'root',
		'DBpsw'     => 'root',
		'DBname'    => '07fly_erp'
	),
	'setSmarty'=>array(
		'template_dir'    => VIEW.'template',
		'compile_dir'     => _mkdir(CACHE. 'c_templates'),
		'left_delimiter'  => '#{',
		'right_delimiter' => '}#',
	),	
); 
?>