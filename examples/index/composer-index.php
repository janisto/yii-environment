<?php
/**
 * This is the bootstrap file for web application.
 */

// Composer autoload
$composerAutoload = dirname(__FILE__) . '/vendor/autoload.php';
require_once($composerAutoload);

// Set environment
require_once(dirname(__FILE__) . '/protected/config/AppEnvironment.php');
$env = new AppEnvironment();
$env->init();
Yii::createWebApplication($env->web)->run();
//$env->showDebug(); // show produced environment configuration
