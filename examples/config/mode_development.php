<?php

/**
 * Development configuration
 * Usage:
 * - Local website
 * - Local DB
 * - Show all details on each error
 * - Gii module enabled
 */

return array(

	// Set Yii framework path relative to Environment.php
	'yiiFramework'=>dirname(__FILE__) . '/../../../../yii/framework',

	// Include yiilite if this is set to true. Performance boost if APC cache is in use.
	'yiiLite'=>false,

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug'=>true,
	'yiiTraceLevel'=>3,

	// Web application configuration.
	'web'=>array(

		// This is the specific Web application configuration for this mode.
		// Supplied config elements will be merged into the main config array.
		'config'=>array(

			// Modules
			'modules'=>array(
				'gii'=>array(
					'class'=>'system.gii.GiiModule',
					'password'=>'PASSWORD',
					// If removed, Gii defaults to localhost only. Edit carefully to taste.
					'ipFilters'=>array('127.0.0.1','::1',),
				),
			),

			// Application components
			'components'=>array(

				// Database
				'db'=>array(
					'tablePrefix'=>'xxx_',
					'connectionString'=>'mysql:host=DEV_HOST;dbname=DEV_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>true,
					'enableParamLogging'=>true,
					'schemaCachingDuration'=>5,
				),


				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
						// Save log messages on file
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'web.log',
							'levels'=>'error, warning, info',
						),
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'web_trace.log',
							'levels'=>'trace',
						),
						// Show log messages on web pages
						array(
							'class'=>'CWebLogRoute',
							'categories'=>'system.db.CDbCommand', //queries
							'levels'=>'error, warning, trace, info',
							//'showInFireBug'=>true,
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
					'connectionString'=>'mysql:host=DEV_HOST;dbname=DEV_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>true,
					'enableParamLogging'=>true,
				),

				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
						// Save log messages on file
						array(
							'class'=>'CFileLogRoute',
							'logFile'=>'console.log',
							'levels'=>'error, warning, info',
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