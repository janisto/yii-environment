<?php

// Set environment
require_once(dirname(__FILE__) . '/../../protected/extensions/environment/Environment.php');
$env = new Environment('TEST'); // override mode
// Run Yii app
require_once($env->yiitPath);
require_once(dirname(__FILE__).'/WebTestCase.php'); // example test case
$env->runYiiStatics(); // like Yii::setPathOfAlias()
Yii::createWebApplication($env->web);
