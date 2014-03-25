<?php

/**
 * Production configuration
 * Usage:
 * - Online website
 * - Production DB
 * - Standard production error pages (404, 500, etc.)
 */

return array(

	// Web application configuration.
	'web'=>array(

		// This is the specific Web application configuration for this mode.
		// Supplied config elements will be merged into the main config array.
		'config'=>array(

			// Application components
			'components'=>array(

				// Database
				'db'=>array(
					'tablePrefix'=>'xxx_',
					'connectionString'=>'mysql:host=PROD_HOST;dbname=PROD_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>false,
					'enableParamLogging'=>false,
					'schemaCachingDuration'=>3600,
				),

				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
						// Save log messages on file
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'web_error.log',
							'levels'=>'error',
						),
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'web_warning.log',
							'levels'=>'warning',
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

				// Database. Don't use schema cache.
				'db'=>array(
					'tablePrefix'=>'xxx_',
					'connectionString'=>'mysql:host=PROD_HOST;dbname=PROD_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>false,
					'enableParamLogging'=>false,
				),

				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
						// Save log messages on file
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'console_error.log',
							'levels'=>'error',
						),
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'console_warning.log',
							'levels'=>'warning',
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