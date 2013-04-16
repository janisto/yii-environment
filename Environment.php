<?php

/**
 * @name Environment
 * @author Jani Mikkonen <janisto@php.net>
 * @version 1.3.0-dev
 * @license public domain (http://unlicense.org)
 * @package extensions.environment
 * @link https://github.com/janisto/yii-environment
 * 
 * Original sources: http://www.yiiframework.com/doc/cookbook/73/
 */

class Environment
{
	/**
	 * Environment variable. Use Apache SetEnv or export in shell.
	 */
	const ENV_VAR = 'YII_ENVIRONMENT';

	/**
	 * Path to configuration folder relative to Environment.php.
	 */
	const CONFIG_DIR = '../../config/';

	/**
	 * Development mode.
	 */
	const MODE_DEVELOPMENT = 100;

	/**
	 * Test mode.
	 */
	const MODE_TEST = 200;

	/**
	 * Staging mode.
	 */
	const MODE_STAGING = 300;

	/**
	 * Production mode.
	 */
	const MODE_PRODUCTION = 400;

	/**
	 * Selected mode.
	 *
	 * @var string
	 */
	protected $_mode;

	/**
	 * Path to Yii framework folder.
	 *
	 * @var string
	 */
	public $yiiFramework;

	/**
	 * Path to yii.php.
	 *
	 * @var string
	 */
	public $yiiPath;

	/**
	 * Path to yiic.php.
	 *
	 * @var string
	 */
	public $yiicPath;

	/**
	 * Path to yiit.php.
	 *
	 * @var string
	 */
	public $yiitPath;

	/**
	 * Path to yiilite.php.
	 *
	 * @var string
	 */
	public $yiilitePath;

	/**
	 * Replace yii.php with yiilite.php. Performance boost if PHP APC extension is enabled.
	 *
	 * @var boolean
	 */
	public $yiiLite;

	/**
	 * Debug mode for YII_DEBUG.
	 *
	 * @var int
	 */
	public $yiiDebug;

	/**
	 * Trace level for YII_TRACE_LEVEL.
	 *
	 * @var int
	 */
	public $yiiTraceLevel;

	/**
	 * Yii path aliases. Array with "$alias=>$path" elements.
	 *
	 * @var array
	 */
	public $yiiSetPathOfAlias = array();

	/**
	 * Web application configuration array.
	 *
	 * @var array
	 */
	public $web = array();

	/**
	 * Console application configuration array.
	 *
	 * @var array
	 */
	public $console = array();

	/**
	 * Constructor. Initializes the Environment class with the given mode.
	 *
	 * @param $mode
	 */
	public function __construct($mode = null)
	{
		$this->_mode = $this->getMode($mode);
		$this->setEnvironment($this->getConfig());
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
		if ($this->yiiLite) {
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
	 *
	 * @param string $mode
	 * @throws Exception
	 * @return string
	 */
	protected function getMode($mode = null)
	{
		// If not manually set
		if (!isset($mode)) {
			// Return mode based on environment variable
			if (isset($_SERVER[constant(get_class($this).'::ENV_VAR')])) {
				$mode = $_SERVER[constant(get_class($this).'::ENV_VAR')];
			} else {
				// Defaults to production
				$mode = 'PRODUCTION';
				$_SERVER[constant(get_class($this).'::ENV_VAR')] = $mode;
			}
		}

		// Check if mode is valid
		if (!defined(get_class($this).'::MODE_'.$mode)) {
			throw new Exception('Invalid Environment mode supplied or selected'.$mode);
		}

		return $mode;
	}

	/**
	 * Load and merge configuration files into one array.
	 *
	 * @throws Exception
	 * @return array $config array to be processed by setEnvironment.
	 */
	protected function getConfig()
	{
		// Load main config
		$fileMainConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.constant(get_class($this).'::CONFIG_DIR')
			.DIRECTORY_SEPARATOR.'main.php';
		if (!file_exists($fileMainConfig)) {
			throw new Exception('Cannot find main config file "'.$fileMainConfig.'".');
		}
		$configMain = require($fileMainConfig);

		// Load specific config
		$fileSpecificConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.constant(get_class($this).'::CONFIG_DIR')
			.DIRECTORY_SEPARATOR.'mode_'.strtolower($this->_mode).'.php';
		if (!file_exists($fileSpecificConfig)) {
			throw new Exception('Cannot find mode specific config file "'.$fileSpecificConfig.'".');
		}
		$configSpecific = require($fileSpecificConfig);

		// Merge specific config into main config
		$config = self::mergeArray($configMain, $configSpecific);

		// If one exists, load local config
		$fileLocalConfig = dirname(__FILE__).DIRECTORY_SEPARATOR.constant(get_class($this).'::CONFIG_DIR')
			.DIRECTORY_SEPARATOR.'local.php';
		if (file_exists($fileLocalConfig)) {
			// Merge local config into previously merged config
			$configLocal = require($fileLocalConfig);
			$config = self::mergeArray($config, $configLocal);
		}

		return $config;
	}

	/**
	 * Sets the environment and configuration for the selected mode.
	 *
	 * @param array $config configuration array
	 * @throws Exception
	 */
	protected function setEnvironment($config)
	{
		// Normalize the framework path
		$framework = str_replace('\\', DIRECTORY_SEPARATOR, realpath($config['yiiFramework']));
		if (!is_dir($framework)) {
			throw new Exception('Invalid Yii framework path "'.$config['yiiFramework'].'".');
		}

		// Set attributes
		$this->yiiFramework = $framework;
		$this->yiiPath = $framework.DIRECTORY_SEPARATOR.'yii.php';
		$this->yiicPath = $framework.DIRECTORY_SEPARATOR.'yiic.php';
		$this->yiitPath = $framework.DIRECTORY_SEPARATOR.'yiit.php';
		$this->yiilitePath = $framework.DIRECTORY_SEPARATOR.'yiilite.php';
		$this->yiiLite = $config['yiiLite'];
		$this->yiiDebug = $config['yiiDebug'];
		$this->yiiTraceLevel = $config['yiiTraceLevel'];

		if (isset($config['web']['config']) && !empty($config['web']['config'])) {
			$this->web = $config['web']['config'];
		}
		$this->web['params']['environment'] = strtolower($this->_mode);

		if (isset($config['console']['config']) && !empty($config['console']['config'])) {
			$this->console = $config['console']['config'];
		}
		$this->console['params']['environment'] = strtolower($this->_mode);

		$this->yiiSetPathOfAlias = $config['yiiSetPathOfAlias'];
	}

	/**
	 * Run Yii static functions.
	 * Call this function after including the Yii framework in your bootstrap file.
	 *
	 * @see http://www.yiiframework.com/doc/api/1.1/YiiBase#setPathOfAlias-detail
	 */
	public function runYiiStatics()
	{
		foreach ($this->yiiSetPathOfAlias as $alias => $path) {
			Yii::setPathOfAlias($alias, $path);
		}
	}

	/**
	 * Show current Environment class values
	 */
	public function showDebug()
	{
		print '<div style="position: absolute; left: 0; width: 100%; height: 250px; overflow: auto;'
			  .'bottom: 0; z-index: 9999; color: #000; margin: 0; border-top: 1px solid #000;">'
			  .'<pre style="margin: 0; background-color: #ddd; padding: 5px;">'
			  .htmlspecialchars(print_r($this, true)).'</pre></div>';
	}

	/**
	 * Merges two arrays into one recursively.
	 * Taken from Yii's CMap::mergeArray, since php does not supply a native
	 * function that produces the required result.
	 *
	 * @see http://www.yiiframework.com/doc/api/1.1/CMap#mergeArray-detail
	 * @param array $a array to be merged to
	 * @param array $b array to be merged from
	 * @return array the merged array (the original arrays are not changed.)
	 */
	protected static function mergeArray($a, $b)
	{
		foreach ($b as $k => $v) {
			if (is_integer($k)) {
				$a[] = $v;
			} else if (is_array($v) && isset($a[$k]) && is_array($a[$k])) {
				$a[$k] = self::mergeArray($a[$k], $v);
			} else {
				$a[$k] = $v;
			}
		}
		return $a;
	}
}