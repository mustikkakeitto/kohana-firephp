<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Database query override. Add this class to your app to override.
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
class Database_Query extends Fire_Database_Query {}
