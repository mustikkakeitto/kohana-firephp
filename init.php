<?php defined('SYSPATH') or die('No direct script access.');

require_once Kohana::find_file('vendor/FirePHPCore','FirePHP.class');

Kohana::$log->attach(new Fire_Log);