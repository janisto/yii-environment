<?php

require('Environment.php');

/**
 * This is an example Environment when you want to use a custom ENV_VAR
 * or CONFIG_DIR, or want to use other than the predefined modes.
 *
 * If you use the extended class, don't forget to require and create it from your
 * bootstrap file, instead of the base Environment class.
 */

class ExampleEnvironment extends Environment
{
	// Environment settings
	const ENV_VAR = 'EXAMPLE_ENVIRONMENT';	// environment variable
	const CONFIG_DIR = '/path/to/config/';	// relative to Environment.php
	
	// Valid modes
	//const MODE_DEVELOPMENT = 100;			// these are already in standard Environment
	//const MODE_TEST = 200;
	const MODE_QUALITY_ASSURANCE = 250;		// this is a new one for some QA-environment
	//const MODE_STAGING = 300;
	//const MODE_PRODUCTION = 400;
}