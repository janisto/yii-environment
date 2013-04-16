<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files
 */

return array(

	// Set Yii framework path relative to Environment.php
	'yiiFramework'=>dirname(__FILE__) . '/../../../yii/framework',

	// Include yiilite if this is set to true. Performance boost if APC cache is in use.
	'yiiLite'=>false,

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug'=>false,
	'yiiTraceLevel'=>0,

	// Static function Yii::setPathOfAlias()
	'yiiSetPathOfAlias'=>array(
		// uncomment the following to define a path alias
		//'local'=>'path/to/local-folder'
	),

	// Web application configuration.
	'web'=>array(

		// This is the main Web application configuration. Any writable
		// CWebApplication properties can be configured here.
		'config'=>array(

			'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
			'name'=>'My Web Application',

			// Preloading 'log' component
			'preload'=>array(
				'log',
			),

			// Autoloading model and component classes
			'import'=>array(
				'application.models.*',
				'application.components.*',
			),

			// Application modules
			'modules'=>array(
			),

			// Application components
			'components'=>array(
			
				// Enable cookie-based authentication
				'user'=>array(
					'allowAutoLogin'=>true,
				),

				// Session cache. Requires cache application component.
				// Storing sessions in APC is significantly faster than the default file-based session handling.
				'session'=>array(
					'class' => 'CCacheHttpSession',
				),
				
				// URL manager
				'urlManager'=>array(
					'showScriptName'=>false,
					'urlFormat'=>'path',
					'rules'=>array(
						'<controller:\w+>/<id:\d+>'=>'<controller>/view',
						'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
						'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
					),
				),
				
				// Use 'site/error' action to display errors
				'errorHandler'=>array(
					'errorAction'=>'site/error',
				),

			),

			// Application-level parameters that can be accessed using Yii::app()->params['paramName']
			'params'=>array(
				'adminEmail'=>'webmaster@example.com',
			),

		),

	),

	// Console application configuration.
	'console'=>array(

		// This is the main Console application configuration. Any writable
		// CConsoleApplication properties can be configured here.
		'config'=>array(

			'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
			'name'=>'My Console Application',

			// Preloading 'log' component
			'preload'=>array(
				'log',
			),

			// Autoloading model and component classes
			'import'=>array(
				'application.models.*',
				'application.components.*',
			),

			// Application components
			'components'=>array(
			),

			// Application-level parameters that can be accessed using Yii::app()->params['paramName']
			'params'=>array(
				'adminEmail'=>'webmaster@example.com',
			),

		),
	),
);