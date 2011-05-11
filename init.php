<?php defined('SYSPATH') or die('No direct script access.');

require_once Kohana::find_file('vendor','firePHP');

Kohana::$log->attach(new Log_FirePHP);
