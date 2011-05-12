<?php defined('SYSPATH') or die('No direct script access.');
/**
 * File log writer.
 *
 * @package    	Kohana
 * @author     	Pedro Sland
 * @copyright  	(c) 2008-2009 Pedro Sland
 * @license    	http://kohanaphp.com/license.html
 */
class Fire_Log_Writer extends Log_Writer {

	/**
	 * @var	FirePHP	singleton
	 */
	protected $fire;

	/**
	 * Creates a new file logger.
	 *
	 * @param   string  firePHP options
	 * @return  void
	 */
	public function __construct($options = array())
	{
		$this->fire = FirePHP::getInstance(TRUE);
	}
	
	/**
	 * Writes the profiler data into Firebug if Kohana profiler is on
	 * 
	 * @return	void
	 */ 
	public function __destruct()
	{		
		if (TRUE === Kohana::$profiling)
		{
			$this->profile();
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
					$this->fire->log($message['body']);
				break;
				case Log::DEBUG :
				case Log::INFO :
					$this->fire->info($message['body']);					
				break;								
				case Log::EMERGENCY :
				case Log::CRITICAL :
				case Log::ERROR :
					$this->fire->error($message['body']);
				break;
				case Log::WARNING :					
					$this->fire->warn($message['body']);					
				break;
			}
		}
	}
	
	/**
	 * FirePHP version of profiler
	 * 
	 * @return	void
	 */
	public function profile()
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
			
			$this->fire->table($group, $table);
		}
		
		
		// Application stats
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
		
		$this->fire->table('application', $table);
		
		
		// Log the session
		$this->fire->log(Session::instance()->as_array(), 'Session');
	}
	
} // End Fire_Log_Writer