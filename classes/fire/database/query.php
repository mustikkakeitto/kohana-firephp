<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Database query override.
 * 
 * FirePHP module has to be initiated before Database in order
 * for this to work
 * 
 * Originally forked from github.com/pedrosland/kohana-firephp
 * [!!] This is a complete rewrite
 * 
 * @package	Fire
 * @author		Kemal Delalic <github.com/kemo>
 * @author		Mathew Davies <github.com/ThePixelDeveloper>
 * @version	1.0.0.
 */
class Fire_Database_Query extends Kohana_Database_Query {
	
	/*
	public function execute($db = NULL)
	{
		$return = parent::execute($db);
		
		// TODO Add the log call here
		
		return $return;
	}
	*/
}
