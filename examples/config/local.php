<?php

/**
 * Local configuration override.
 * Use this to override elements in the config array (combined from main.php and mode_x.php)
 * NOTE: When using a version control system, do NOT commit this file to the repository.
 */

return array(

	// Set Yii framework path relative to Environment.php
	'yiiFramework'=>dirname(__FILE__) . '/../../../../yii/framework',

	// Web application configuration.
	'web'=>array(

		// This is the specific Web application configuration for this mode.
		// Supplied config elements will be merged into the main config array.
		'config'=>array(

			// Application components
			'components'=>array(

				// Cache
				'cache'=>array(
					'class'=>'CFileCache',
				),

				// Database
				'db'=>array(
					'tablePrefix'=>'xxx_',
					'connectionString'=>'mysql:host=LOCAL_HOST;dbname=LOCAL_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>true,
					'enableParamLogging'=>true,
					'schemaCachingDuration'=>5,
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

				// Cache
				'cache'=>array(
					'class'=>'CFileCache',
				),

				// Database. Don't use schema cache.
				'db'=>array(
					'tablePrefix'=>'xxx_',
					'connectionString'=>'mysql:host=LOCAL_HOST;dbname=LOCAL_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>true,
					'enableParamLogging'=>true,
				),
			),
		),
	),
);