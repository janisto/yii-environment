<?php

/**
 * Staging configuration
 * Usage:
 * - Online website
 * - Production DB
 * - All details on error
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
					'connectionString'=>'mysql:host=STAGE_HOST;dbname=STAGE_DB',
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

				// Database. Don't use schema cache.
				'db'=>array(
					'tablePrefix'=>'xxx_',
					'connectionString'=>'mysql:host=STAGE_HOST;dbname=STAGE_DB',
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