<?php
 return array (

	'URLMode'   => 0,			
	'ActionDir' => 'hiddenDir/',
	'htmlExt'  => '.html',
	'ReWrite'  => true,
	'Router'  => '',
	'Debug'     => true,  
	'Session'   => true,
	'pageSize'  =>10,
	'DB'=>array(
		'Persistent'=>false,
		'DBtype'    => 'Mysql',
		'DBcharSet' => 'UTF-8',
		'DBhost'    => 'localhost',
		'DBport'    => '3306',
		'DBuser'    => 'root',
		'DBpsw'     => 'root',
		'DBname'    => 'test_07flyerp'
	),
	'setSmarty'=>array(
		'template_dir'    => VIEW.'template',
		'compile_dir'     => _mkdir(CACHE. 'c_templates'),
		'left_delimiter'  => '#{',
		'right_delimiter' => '}#',
	),	
); 
