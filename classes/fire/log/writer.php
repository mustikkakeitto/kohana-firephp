<?php defined('SYSPATH') or die('No direct script access.');
/**
 * File log writer.
 * 
 * Originally forked from github.com/pedrosland/kohana-firephp
 * [!!] This is a complete rewrite
 * 
 * @package	Fire
 * @author		Kemal Delalic <github.com/kemo>
 * @author		Mathew Davies <github.com/ThePixelDeveloper>
 * @version	1.0.0.
 */
class Fire_Log_Writer extends Log_Writer {

	/**
	 * @var	FirePHP	singleton
	 */
	protected $_fire;
	
	/**
	 * Should the profiler be displayed
	 * @var bool
	 */
	protected $_profiling;
	
	/**
	 * Should sessions be logged?
	 * @var bool
	 */
	protected $_session;

	/**
	 * Creates a new file logger.
	 *
	 * @param   string  firePHP options
	 * @return  void
	 */
	public function __construct($options = array())
	{
		$this->_profiling 	= Arr::get($options, 'profiling', Kohana::$profiling);
		$this->_session 	= Arr::get($options, 'session', FALSE);
		
		$this->_fire = FirePHP::getInstance(TRUE);
	}
	
	/**
	 * Writes the profiler data into Firebug if Kohana profiler is on
	 * 
	 * @return	void
	 */ 
	public function __destruct()
	{		
		// Log the profiler
		if (TRUE === $this->_profiling)
		{
			$this->log_profiler();
		}
	
		// Log the session?
		if (TRUE === $this->_session)
		{
			$this->log_session();
		}
	}

	/**
	 * Writes each of the messages to the console.
	 *
	 * @param   array   messages
	 * @return  void
	 */
	public function write(array $messages)
	{
		foreach ($messages as $message)
		{
			// Write each message to firePHP
			switch ($message['level'])
			{
				default :
				case Log::NOTICE :
					$this->_fire->log($message['body']);
				break;
				case Log::DEBUG :
				case Log::INFO :
					$this->_fire->info($message['body']);					
				break;								
				case Log::EMERGENCY :
				case Log::CRITICAL :
				case Log::ERROR :
					$this->_fire->error($message['body']);
				break;
				case Log::WARNING :					
					$this->_fire->warn($message['body']);
				break;
			}
		}
	}
	
	/**
	 * Logs the Kohana Profiler 
	 */
	public function log_profiler()
	{
		$group_stats 	= Profiler::group_stats();
		$group_cols   	= array('min', 'max', 'average', 'total');
		
		// All profiler stats
		foreach (Profiler::groups() as $group => $benchmarks)
		{
			$table_head = array_merge(array('Benchmark'), $group_cols);
			
			$table 		= array($table_head);
			
			foreach ($benchmarks as $name => $tokens)
			{
				$stats 	= Profiler::stats($tokens);
				$row 	=  array($name.' ('.count($tokens).')');
				
				foreach ($group_cols as $key)
				{
					$row[] = number_format($stats[$key]['time'], 6).' s / '
						.number_format($stats[$key]['memory'] / 1024, 4).' kB';
				}
				
				array_push($table, $row);
			}
			
			$this->_fire->table($group, $table);
		}
		
		
		// Application stats
		// @todo merge this with other stats
		$application		= Profiler::application();
		$application_cols 	= array('min', 'max', 'average', 'current');
		
		$table 	= array(array_merge(array('Benchmark'), $application_cols));
		$row 	= array('Execution');
		
		foreach ($application_cols as $key)
		{
			$row[] = number_format($application[$key]['time'], 6).' s / '
				.number_format($application[$key]['memory'] / 1024, 4).' kB';
		}
				
		array_push($table, $row);
		
		$this->_fire->table('application', $table);
	}
	
	/**
	 * Logs the current session
	 */
	public function log_session()
	{
		$this->_fire->log(Session::instance()->as_array(), 'Session');
	}
	
} // End Fire_Log_Writer