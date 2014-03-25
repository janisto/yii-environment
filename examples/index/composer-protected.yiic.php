<?php
/**
 * This is the bootstrap file for console application.
 */

// Composer autoload
$composerAutoload = dirname(__FILE__) . '/../vendor/autoload.php';
require_once($composerAutoload);

// Set environment
require_once(dirname(__FILE__) . '/config/AppEnvironment.php');
$env = new AppEnvironment();
$env->init();
Yii::createConsoleApplication($env->console)->run();
