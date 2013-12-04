<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'anubhavjain',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),		
	),

	// application components
	'components'=>array(		
		/*'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),*/
		/*'request' => array(
            'baseUrl' => '',
        ),*/
		// uncomment the following to enable URLs in path-format
		'session' => array (
    		'autoStart' => true,
			'sessionName'=> 'jm',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'.html',
			'rules'=>array(
            	'gii'=>'gii',
            	'gii/<controller:\w+>'=>'gii/<controller>',
            	'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				'programs/forthcomingPrograms/<leveltype>'=>'programs/forthcomingPrograms',
				'programs/recentPrograms/<leveltype>'=>'programs/recentPrograms',
		
			/*'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			*/	
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>require(dirname(__FILE__).'../../../db.php'),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
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
	'params'=>require(dirname(__FILE__).'../../../settings.php'),
);