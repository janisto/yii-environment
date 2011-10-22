<?php

/**
 * Local configuration override.
 * Use this to override elements in the config array (combined from main.php and mode_x.php)
 * NOTE: When using a version control system, do NOT commit this file to the repository.
 */

return array(

	// Set Yii framework path relative to Environment.php
	'yiiFramework'=>dirname(__FILE__) . '/../../../../yii/framework',

	// Include yiilite if this is set to true. Performance boost if APC cache is in use.
	'yiiLite'=>false,

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug'=>true,
	'yiiTraceLevel'=>3,

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

			// Application components
			'components'=>array(

				// Database
				'db'=>array(
					'connectionString'=>'mysql:host=LOCAL_HOST;dbname=LOCAL_DB',
					'emulatePrepare'=>true,
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					//'schemaCachingDuration'=>3600,
					'enableParamLogging'=>true,
				),

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

				// Database
				'db'=>array(
					'connectionString'=>'mysql:host=LOCAL_HOST;dbname=LOCAL_DB',
					'emulatePrepare'=>true,
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					//'schemaCachingDuration'=>3600,
					'enableParamLogging'=>true,
				),

			),

		),
	),
);