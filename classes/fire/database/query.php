<?php defined('SYSPATH') or die('No direct script access.');

class Fire_Database_Query extends Kohana_Database_Query {
	
	public function execute($db = NULL)
	{
		$return = parent::execute($db);
		
		// TODO Add the log call here
		
		return $return;
	}
	
}
