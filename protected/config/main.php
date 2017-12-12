<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Bookone',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'071089',
			'ipFilters'=>array(), 
		),
	),

	'defaultController'=>'site',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=78.108.80.117;dbname=b160739_bookone',
			'emulatePrepare' => true,
			'username' => 'u160739',
			'password' => 'ZqE7v128Sp',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'out' => 'site/out',
				'book/<id:\d+>/<url>' => 'book/view',
				'category/<action:(index|view|ajaxgetsub|updateurl|list|ajaxbooks|create|update|admin|delete|ajaxsavetext)>' => 'category/<action>',
				'category/<url>/page/<page:\d+>' => 'category/list',
				'category/<url>' => 'category/list',

				'city/list' => 'city/index',

				'<gorod>/online/list' => 'shopOnline/index',
				'<gorod>/online/<url>' => 'shopOnline/view',

				'<gorod>/shop/list' => 'company/index',
				'<gorod>/shop/<url>' => 'company/view',

				'<gorod>/library/list' => 'library/index',
				'<gorod>/library/<url>' => 'library/view',

				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);