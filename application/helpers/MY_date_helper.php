<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Timespan
 *
 * Returns a span of seconds in this format:
 *	10 days 14 hours 36 minutes 47 seconds
 *
 * @access	public
 * @param	integer	a number of seconds
 * @param	integer	Unix timestamp
 * @return	integer
 */	
if ( ! function_exists('time_since'))
{
	function time_since($time)
	{

		$now = time();
		$now_day = date("j", $now);
		$now_month = date("n", $now);
		$now_year = date("Y", $now);

		$time_day = date("j", $time);
		$time_month = date("n", $time);
		$time_year = date("Y", $time);
		$time_since = "";

		switch(TRUE) 
		{
			case ($time == 0):
				$time_since = 'Never';
				break;
			case ($now-$time < 60):
				// RETURNS SECONDS
				$seconds = $now-$time;
	                        // Append "s" if plural
				$time_since = $seconds > 1 ? "$seconds seconds" : "$seconds second";
				break;
			case ($now-$time < 45*60): // twitter considers > 45 mins as about an hour, change to 60 for general purpose
				// RETURNS MINUTES
				$minutes = round(($now-$time)/60);
				$time_since = $minutes > 1 ? "$minutes minutes" : "$minutes minute";
				break;
			case ($now-$time < 86400):
				// RETURNS HOURS
				$hours = round(($now-$time)/3600);
				$time_since = $hours > 1 ? "about $hours hours" : "about $hours hour";
				break;
			case ($now-$time < 1209600):
				 // RETURNS DAYS
				 $days = round(($now-$time)/86400);
				 $time_since = "$days days";
				 break;
			case (mktime(0, 0, 0, $now_month-1, $now_day, $now_year) < mktime(0, 0, 0, $time_month, $time_day, $time_year)):
				 // RETURNS WEEKS
				 $weeks = round(($now-$time)/604800);
				 $time_since = "$weeks weeks";
				 break;
			case (mktime(0, 0, 0, $now_month, $now_day, $now_year-1) < mktime(0, 0, 0, $time_month, $time_day, $time_year)):
				 // RETURNS MONTHS
				 if($now_year == $time_year) { $subtract = 0; } else { $subtract = 12; }
				 $months = round($now_month-$time_month+$subtract);
				 $time_since = "$months months";
				 break;
			default:
			// RETURNS YEARS
				if ($now_month < $time_month) 
				{
					$subtract = 1;
				} 
				elseif ($now_month == $time_month) 
				{
					if ($now_day < $time_day) 
					{ 
						$subtract = 1; 
					} 
					else 
					{ 
						$subtract = 0; 
					}
				} 
				else 
				{
					$subtract = 0;
				}
				$years = $now_year-$time_year-$subtract;
				$time_since = "$years years";
				break;
		}
	
		return $time_since .' ago';
	}
}