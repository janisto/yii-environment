<?php

require_once(dirname(__FILE__) . '/../../vendor/janisto/yii-environment/Environment.php');

/**
 * This is an application Environment when you use composer.
 */

class AppEnvironment extends Environment
{
	const CONFIG_DIR = '../../../protected/config/'; // relative to Environment.php
}