<?php

/**
 * Test configuration
 * Usage:
 * - Local website
 * - Local DB
 * - Standard production error pages (404, 500, etc.)
 */

return array(

	// Set Yii framework path relative to Environment.php
	'yiiFramework'=>dirname(__FILE__) . '/../../../../yii/framework',

	// Include yiilite if this is set to true. Performance boost if APC cache is in use.
	'yiiLite'=>false,

	// Set YII_DEBUG and YII_TRACE_LEVEL flags
	'yiiDebug'=>true,
	'yiiTraceLevel'=>1,

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
					'connectionString'=>'mysql:host=TEST_HOST;dbname=TEST_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>false,
					'enableParamLogging'=>false,
					'schemaCachingDuration'=>3600,
				),

				// URL Manager
				'urlManager' => array(
					'showScriptName' => true,
				),
				
				// Fixture Manager for testing
				'fixture'=>array(
					'class'=>'system.test.CDbFixtureManager',
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
						array(
							'class'=>'CFileLogRoute',
							'categories'=>'system.db.CDbCommand', // queries
							'logFile'=>'web_db.log',
							'levels'=>'error, warning, trace, info',
						),
					),
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
					'connectionString'=>'mysql:host=TEST_HOST;dbname=TEST_DB',
					'username'=>'',
					'password'=>'',
					'charset'=>'utf8',
					'emulatePrepare'=>true,
					'enableProfiling'=>false,
					'enableParamLogging'=>false,
				),

				// Fixture Manager for testing
				'fixture'=>array(
					'class'=>'system.test.CDbFixtureManager',
				),
				
				// Application Log
				'log'=>array(
					'class'=>'CLogRouter',
					'routes'=>array(
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
		),
	),
);