<?php
return array (
/** set your paypal credential **/
'client_id' =>'AZKve4jQHCOudq689u_UKzbOdyUS4mizjBMew84_junXOLyxOVQNKLQJ45ZNDZH1JN-8OLI9MchqJO9y',
'secret' => 'EF3-HghWz5iZCHyMr8USVAvU7i7d_hTnwKUCEzMKfhosHLUVYUYq0bww-hja8I9-lpwQPp60GFYDMToH',
/**
* SDK configuration 
*/
'settings' => array(
	/**
	* Available option 'sandbox' or 'live'
	*/
	'mode' => 'sandbox',
	/**
	* Specify the max request time in seconds
	*/
	'http.ConnectionTimeOut' => 1000,
	/**
	* Whether want to log to a file
	*/
	'log.LogEnabled' => true,
	/**
	* Specify the file that want to write on
	*/
	'log.FileName' => storage_path() . '/logs/paypal.log',
	/**
	* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
	*
	* Logging is most verbose in the 'FINE' level and decreases as you
	* proceed towards ERROR
	*/
	'log.LogLevel' => 'FINE'
	),
);