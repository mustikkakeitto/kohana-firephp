<?php defined('SYSPATH') or die('No direct script access.');
/**
 * File log writer.
 *
 * @package    Kohana
 * @author     Pedro Sland
 * @copyright  (c) 2008-2009 Pedro Sland
 * @license    http://kohanaphp.com/license.html
 */
class Fire_Log_Writer extends Log_Writer {

	// Instance of FirePHP
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
	 * @return	void
	 */ 
	public function __destruct()
	{
		
		if (Kohana::$profiling === TRUE)
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
				case Log::DEBUG :
					
					$this->fire->log($message['body']);
				
				break;
				
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
	 * @return	void
	 */
	public function profile()
	{	
		$application	= Profiler::application();
		$group_stats 	= Profiler::group_stats();
		$group_cols   	= array('min', 'max', 'average', 'total');
		
		// All profiler stats
		foreach (Profiler::groups() as $group => $benchmarks)
		{
			$table = array(
				array_merge(array('Benchmark'), $group_cols),
			);
			
			foreach ($benchmarks as $name => $tokens)
			{
				$stats = Profiler::stats($tokens);
				
				$row =  array($name.' ('.count($tokens).')');
				
				foreach ($group_cols as $key)
				{
					$row[] = number_format($stats[$key]['time'], 6).' s / '
							.number_format($stats[$key]['memory'] / 1024, 4).' kB';
				}
				
				array_push($table, $row);
			}
			
			$this->fire->table($group, $table);
		}
		
		// Log the session
		$this->fire->info(Session::instance()->as_array(), 'Session');
		
		// Group the app stats
		$this->fire->group('Stats: '.$application['count']);
		
		foreach ($group_cols as $key)
		{
			$this->fire->info(
				ucfirst($key).': '.
				number_format($application[$key]['time'], 6).'s '.
				number_format($application[$key]['memory']/1024, 4).'kB'
			);
		}
		
		$this->fire->groupEnd();
	}
	
} // End Log_FirePHP