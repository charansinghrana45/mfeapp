<?php defined('BASEPATH') or die("no direct access allowed.");


if ( ! function_exists('response'))
{
	function response($response = [], $code = 200) 
	{

		$CI = & get_instance();
		$CI->output
		        ->set_status_header($code)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->set_header('Access-Control-Allow-Origin: http://localhost:4200')
		        ->set_header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token , Authorization')
		        ->set_header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE')
		        ->_display();
		exit;
	}
}