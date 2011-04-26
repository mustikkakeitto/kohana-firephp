<?php

class Kohana_Fire {

	protected static $_instance;
	
	public static function instance()
	{
		if (Fire::$_instance === NULL)
		{
			require_once Kohana::find_file('vendor','firePHP');
			
			Fire::$_instance = FirePHP::getInstance(TRUE);
		}
		
		return Fire::$_instance;
	}
	
}