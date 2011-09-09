<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// Set environment
require_once(dirname(__FILE__) . '/protected/extensions/environment/Environment.php');
$env = new Environment('TEST'); // override mode
$env->init();
Yii::createWebApplication($env->web)->run();
