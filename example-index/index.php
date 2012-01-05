<?php
/**
 * This is the bootstrap file for web application.
 */

// Set environment
require_once(dirname(__FILE__) . '/protected/extensions/environment/Environment.php');
$env = new Environment();
//$env = new Environment('PRODUCTION'); // override mode
$env->init();
Yii::createWebApplication($env->web)->run();
//$env->showDebug(); // show produced environment configuration