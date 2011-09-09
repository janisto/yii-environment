<?php

/**
 * Staging configuration
 * Usage:
 * - Online website
 * - Production DB
 * - All details on error
 */

return array(

	// Set yiiPath (relative to Environment.php)
	//'yiiPath'=>dirname(__FILE__) . '/../../../yii/framework/yii.php',
	//'yiitPath'=>dirname(__FILE__) . '/../../../yii/framework/yiit.php',
	//'yiilitePath'=>dirname(__FILE__) . '/../../../yii/framework/yiilite.php',

	// Include yiilite if this is set to true. Performance boost if APC cache is in use.
	'yiiLite'=>true,

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug'=>true,
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
					'class'=>'system.caching.CApcCache',
				),

				// Database
				'db'=>array(
					'connectionString'=>'mysql:host=STAGE_HOST;dbname=STAGE_DB',
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
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'web_trace.log',
							'levels'=>'trace',
						),
						array(
							'class'=>'CFileLogRoute',
							'categories'=>'system.db.CDbCommand', // queries
							'logFile'=>'web_db.log',
							'levels'=>'error, warning, trace, info',
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
					'class'=>'system.caching.CApcCache',
				),

				// Database
				'db'=>array(
					'connectionString'=>'mysql:host=STAGE_HOST;dbname=STAGE_DB',
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
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'console_trace.log',
							'levels'=>'trace',
						),
						array(
							'class'=>'CFileLogRoute',
							'categories'=>'system.db.CDbCommand', // queries
							'logFile'=>'console_db.log',
							'levels'=>'error, warning, trace, info',
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