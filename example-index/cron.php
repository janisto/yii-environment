<?php

// Set environment
require_once(dirname(__FILE__) . '/protected/extensions/environment/Environment.php');
$env = new Environment();
$env->init();
Yii::createConsoleApplication($env->console)->run();

// When you execute a PHP script from the command line, it inherits the environment variables defined in your shell.
// That means you can set an environment variable using the export command like so:
// export YII_ENVIRONMENT='TEST'

// Shell: php /path/to/cron.php command
