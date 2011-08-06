<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Simple wrapper to allow static calls.
 *
 * @package		Fire
 * @author		Kemal Delalic <github.com/kemo>
 * @author		Mathew Davies <github.com/ThePixelDeveloper>
 * @version		1.0.0.
 */
abstract class Fire_Helper {

	/**
	 * Log object with label to firebug console
	 *
	 * @see FirePHP::LOG
	 * @param mixed $object
	 * @param string|null $label
	 * @param array $options
	 * @return true
	 * @throws Exception
	 */
	public static function log($object, $label=null, $options=array())
	{
		return FirePHP::getInstance()->log($object, $label, $options);
	}


	/**
	 * Log object with label to firebug console
	 *
	 * @see FirePHP::INFO
	 * @param mixed $object
	 * @param string|null $label
	 * @param array $options
	 * @return true
	 * @throws Exception
	 */
	public static function info($object, $label=null, $options=array())
	{
		return FirePHP::getInstance()->info($object, $label, $options);
	}

	/**
	 * Log object with label to firebug console
	 *
	 * @see FirePHP::WARN
	 * @param mixed $object
	 * @param string|null $label
	 * @param array $options
	 * @return true
	 * @throws Exception
	 */
	public static function warn($object, $label=null, $options=array())
	{
		return FirePHP::getInstance()->warn($object, $label, $options);
	}

	/**
	 * Log object with label to firebug console
	 *
	 * @see FirePHP::ERROR
	 * @param mixed $object
	 * @param string|null $label
	 * @param array $options
	 * @return true
	 * @throws Exception
	 */
	public static function error($object, $label=null, $options=array())
	{
		return FirePHP::getInstance()->error($object, $label, $options);
	}

	/**
	 * Dumps key and variable to firebug server panel
	 *
	 * @see FirePHP::DUMP
	 * @param string $key
	 * @param mixed $variable
	 * @param array $options
	 * @return true
	 * @throws Exception
	 */
	public static function dump($key, $variable, $options = array())
	{
		return FirePHP::getInstance()->dump($key, $variable, $options);
	}

	/**
	 * Log a trace in the firebug console
	 *
	 * @see FirePHP::TRACE
	 * @param string $label
	 * @return true
	 * @throws Exception
	 */
	public static function trace($label)
	{
		return FirePHP::getInstance()->trace($label);
	}

	/**
	 * Log a table in the firebug console
	 *
	 * @see FirePHP::TABLE
	 * @param string $label
	 * @param string $table
	 * @param array $options
	 * @return true
	 * @throws Exception
	 */
	public static function table($label, $table, $options = array())
	{
		return FirePHP::getInstance()->table($label, $table, $options);
	}

	/**
	 * Log varible to Firebug
	 *
	 * @see http://www.firephp.org/Wiki/Reference/Fb
	 * @param mixed $object The variable to be logged
	 * @return true Return TRUE if message was added to headers, FALSE otherwise
	 * @throws Exception
	 */
	public static function fb($object)
	{
		return FirePHP::getInstance()->fb($object);
	}
}