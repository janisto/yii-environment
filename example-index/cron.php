<?php

// Set environment
require_once(dirname(__FILE__) . '/protected/extensions/environment/Environment.php');
$env = new Environment();
$env->init();
Yii::createConsoleApplication($env->console)->run();

// Shell: php /path/to/cron.php command
