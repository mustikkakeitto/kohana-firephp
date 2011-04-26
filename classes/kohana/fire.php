<?php

class Kohana_Fire {

	protected static $_instance;
	
	public static function instance()
	{
		if (Fire::$_instance === NULL)
		{
			Fire::$_instance = FirePHP::getInstance(TRUE);
		}
		
		return Fire::$_instance;
	}
	
}