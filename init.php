<?php defined('SYSPATH') or die('No direct script access.');

require_once Kohana::find_file('vendor','FirePHP');

Kohana::$log->attach(new Fire_Log);
