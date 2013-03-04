<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'components'=>array(		
		'db'=>array(
			'connectionString' => 'mysql:host=10.178.4.2;dbname=test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'phpadmin',
			'charset' => 'utf8',
		),
	),
);