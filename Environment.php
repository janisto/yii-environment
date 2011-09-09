<?php

/**
 * @name Environment
 * @author Jani Mikkonen
 * @version 1.0
 * @license public domain (http://unlicense.org)
 * @package extensions.environment
 * @link https://github.com/janisto/yii-environment
 * 
 * Original sources: http://www.yiiframework.com/doc/cookbook/73/
 * 
 */

class Environment
{
	// Environment settings (extend Environment class if you want to change these)
	const SERVER_VAR = 'YII_ENVIRONMENT';	//Apache SetEnv var
	const CONFIG_DIR = '../../config/';		//relative to Environment.php

	// Valid modes (extend Environment class if you want to change or add to these)
	const MODE_DEVELOPMENT = 100;
	const MODE_TEST = 200;
	const MODE_STAGING = 300;
	const MODE_PRODUCTION = 400;

	// Selected mode
	private $_mode;

	// Environment Yii properties
	public $yiiPath;			// path to yii.php
	public $yiitPath;			// path to yiit.php
	public $yiilitePath;		// path to yiilite.php
	public $yiiLite;			// boolean
	public $yiiDebug;			// int
	public $yiiTraceLevel;		// int
	
	// Environment Yii statics to run
	// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#setPathOfAlias-detail
	public $yiiSetPathOfAlias = array();	// array with "$alias=>$path" elements
	
	// Web application config
	public $web = array();		// config array

	// Console application config
	public $console = array();	// config array

	/**
	 * Initilizes the Environment class with the given mode
	 * @param constant $mode used to override automatically setting mode
	 */
	function __construct($mode = null)
	{
		$this->_mode = $this->getMode($mode);
		$this->setEnvironment();
	}
	
	/**
	 * Basic setup for console and web application.
	 */
	public function init()
	{
		// Set debug and trace level
		defined('YII_DEBUG') or define('YII_DEBUG', $this->yiiDebug);
		defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $this->yiiTraceLevel);

		// Include Yii
		if($this->yiiLite) {
			require_once($this->yiilitePath);
		} else {
			require_once($this->yiiPath);
		}

		// Run Yii static functions
		$this->runYiiStatics();
	}
	
	/**
	 * Get current environment mode depending on environment variable.
	 * Override this function if you want to change this method.
	 * @param string $mode
	 * @return string
	 */
	private function getMode($mode = null)
	{
		// If not manually set
		if (!isset($mode)) {
			// Return mode based on Apache server var
			if (isset($_SERVER[constant(get_class($this).'::SERVER_VAR')])) {
				$mode = $_SERVER[constant(get_class($this).'::SERVER_VAR')];
			} else {
				// Defaults to production
				$mode = 'PRODUCTION';
				$_SERVER[constant(get_class($this).'::SERVER_VAR')] = $mode;
			}
		}
		
		// Check if mode is valid
		if (!defined(get_class($this).'::MODE_'.$mode))
			throw new Exception('Invalid Environment mode supplied or selected'.$mode);

		return $mode;
	}

	/**
	 * Sets the environment and configuration for the selected mode
	 */
	private function setEnvironment()
	{
		// Load main config
		$fileMainConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.constant(get_class($this).'::CONFIG_DIR').DIRECTORY_SEPARATOR.'main.php';
		if (!file_exists($fileMainConfig))
			throw new Exception('Cannot find main config file "'.$fileMainConfig.'".');
		$configMain = require($fileMainConfig);

		// Load specific config
		$fileSpecificConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.constant(get_class($this).'::CONFIG_DIR').DIRECTORY_SEPARATOR.'mode_'.strtolower($this->_mode).'.php';
		if (!file_exists($fileSpecificConfig))
			throw new Exception('Cannot find mode specific config file "'.$fileSpecificConfig.'".');
		$configSpecific = require($fileSpecificConfig);

		// Merge specific config into main config
		$config = self::mergeArray($configMain, $configSpecific);

		// If one exists, load local config
		$fileLocalConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.constant(get_class($this).'::CONFIG_DIR').DIRECTORY_SEPARATOR.'local.php';
		if (file_exists($fileLocalConfig)) {
			// Merge local config into previously merged config
			$configLocal = require($fileLocalConfig);
			$config = self::mergeArray($config, $configLocal);
		}

		// Set attributes
		$this->yiiPath = $config['yiiPath'];
		$this->yiitPath = $config['yiitPath'];
		$this->yiilitePath = $config['yiilitePath'];
		$this->yiiLite = $config['yiiLite'];
		$this->yiiDebug = $config['yiiDebug'];
		$this->yiiTraceLevel = $config['yiiTraceLevel'];
		if(isset($config['web']['config']) && !empty($config['web']['config']))
			$this->web = $config['web']['config'];
		$this->web['params']['environment'] = strtolower($this->_mode);
		if(isset($config['console']['config']) && !empty($config['console']['config']))
			$this->console = $config['console']['config'];
		$this->console['params']['environment'] = strtolower($this->_mode);

		// Set Yii statics
		$this->yiiSetPathOfAlias = $config['yiiSetPathOfAlias'];
	}

	/**
	 * Run Yii static functions.
	 * Call this function after including the Yii framework in your bootstrap file.
	 */
	public function runYiiStatics()
	{
		// Yii::setPathOfAlias();
		foreach($this->yiiSetPathOfAlias as $alias => $path) {
			Yii::setPathOfAlias($alias, $path);
		}
	}
	
	/**
	 * Show current Environment class values
	 */
	public function showDebug()
	{
		echo '<div style="position: absolute; bottom: 0; z-index: 99; height: 250px; overflow: auto; background-color: #ddd; color: #000; border: 1px solid #000; margin: 5px; padding: 5px;">
			<pre>'.htmlspecialchars(print_r($this, true)).'</pre></div>';
	}
	
	/**
	 * Merges two arrays into one recursively.
	 * @param array $a array to be merged to
	 * @param array $b array to be merged from
	 * @return array the merged array (the original arrays are not changed.)
	 *
	 * Taken from Yii's CMap::mergeArray, since php does not supply a native
	 * function that produces the required result.
	 * @see http://www.yiiframework.com/doc/api/1.1/CMap#mergeArray-detail
	 */
	private static function mergeArray($a,$b)
	{
		foreach($b as $k=>$v) {
			if(is_integer($k))
				$a[]=$v;
			else if(is_array($v) && isset($a[$k]) && is_array($a[$k]))
				$a[$k]=self::mergeArray($a[$k],$v);
			else
				$a[$k]=$v;
		}
		return $a;
	}

}