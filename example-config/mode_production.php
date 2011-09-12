<?php

/**
 * Production configuration
 * Usage:
 * - Online website
 * - Production DB
 * - Standard production error pages (404, 500, etc.)
 */

return array(

	// Set yiiPath (relative to Environment.php)
	//'yiiPath'=>dirname(__FILE__) . '/../../../yii/framework/yii.php',
	//'yiitPath'=>dirname(__FILE__) . '/../../../yii/framework/yiit.php',
	//'yiilitePath'=>dirname(__FILE__) . '/../../../yii/framework/yiilite.php',

	// Include yiilite if this is set to true. Performance boost if APC cache is in use.
	'yiiLite'=>true,

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

		// This is the specific Web application configuration for this mode.
		// Supplied config elements will be merged into the main config array.
		'config'=>array(

			// Modules
			'modules'=>array(
			),

			// Application components
			'components'=>array(

				// Cache
				'cache'=>array(
					'class'=>'CApcCache',
				),

				// Database
				'db'=>array(
					'connectionString'=>'mysql:host=PROD_HOST;dbname=PROD_DB',
					'emulatePrepare'=>true,
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'schemaCachingDuration'=>3600,
					'enableParamLogging'=>false,
				),

				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
						// Save log messages on file
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'web.log',
							'levels'=>'error, warning',
						),
						// Send errors via email to the system admin
						array(
							'class'=>'CEmailLogRoute',
							'levels'=>'error, warning',
							'emails'=>'webadmin@example.com',
						),
					),
				),

			),

			// Application-level parameters that can be accessed using Yii::app()->params['paramName']
			'params'=>array(
			),

		),
	),

	// Console application configuration.
	'console'=>array(

		// This is the specific Console application configuration for this mode.
		// Supplied config elements will be merged into the console config array.
		'config'=>array(

			// Application components
			'components'=>array(

				// Cache
				'cache'=>array(
					'class'=>'CApcCache',
				),

				// Database
				'db'=>array(
					'connectionString'=>'mysql:host=PROD_HOST;dbname=PROD_DB',
					'emulatePrepare'=>true,
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'schemaCachingDuration'=>3600,
					'enableParamLogging'=>false,
				),

				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
						// Save log messages on file
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'console.log',
							'levels'=>'error, warning',
						),
						// Send errors via email to the system admin
						array(
							'class'=>'CEmailLogRoute',
							'levels'=>'error, warning',
							'emails'=>'webadmin@example.com',
						),
					),
				),

			),

			// Application-level parameters that can be accessed using Yii::app()->params['paramName']
			'params'=>array(
			),

		),
	),
);