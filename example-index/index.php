<?php

// Set environment
require_once(dirname(__FILE__) . '/protected/extensions/environment/Environment.php');
$env = new Environment();
//$env = new Environment('PRODUCTION'); // override mode
$env->init();
//$env->showDebug(); // show produced environment configuration
Yii::createWebApplication($env->web)->run();
