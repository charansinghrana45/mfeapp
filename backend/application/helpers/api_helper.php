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
		        ->set_header('Access-Control-Allow-Origin: *')
		        ->set_header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token , Authorization')
		        ->set_header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE')
		        ->_display();
		exit;
	}
}


/** 
 * Get hearder Authorization
 * */
if ( ! function_exists('get_authorization_header'))
{

	function get_authorization_header(){
	        $headers = null;
	        if (isset($_SERVER['Authorization'])) {
	            $headers = trim($_SERVER["Authorization"]);
	        }
	        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
	            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	        } elseif (function_exists('apache_request_headers')) {
	            $requestHeaders = apache_request_headers();
	            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
	            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
	            //print_r($requestHeaders);
	            if (isset($requestHeaders['Authorization'])) {
	                $headers = trim($requestHeaders['Authorization']);
	            }
	        }
	        return $headers;
	    }
}

/**
 * get access token from header
 * */
if ( ! function_exists('get_bearer_token'))
{
	function get_bearer_token() {
	    $headers = get_authorization_header();
	    // HEADER: Get the access token from the header
	    if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            return $matches[1];
	        }
	    }
	    return null;
	}
}

/**
 * validate token and return payload
 * */
if ( ! function_exists('validate_jwt_token'))
{
	function validate_jwt_token() {
		$token = get_bearer_token();
		try {

			if(!$token) {
				throw new Exception('Unauthenticated Request');
			}

			$decoded = \Firebase\JWT\JWT::decode($token, JWT_SECRETE_KEY, array('HS256'));
		}
		catch(Exception $e){
			response(['status' => FALSE, 'error' => $e->getMessage()], 401);
		}
	}
}