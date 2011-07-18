<?php defined('SYSPATH') or die('No direct script access.');

// Find and include the vendor
require_once Kohana::find_file('vendor/FirePHPCore','FirePHP.class');

// Attach a Fire_Log writer to Kohana
Kohana::$log->attach(new Fire_Log);

// Disable FirePHP logging in production phase
if (Kohana::$environment > Kohana::PRODUCTION)
{
	FirePHP::getInstance()->setEnabled(FALSE);
}