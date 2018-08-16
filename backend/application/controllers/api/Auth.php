<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;
class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Masters', 'masters');
		$this->load->helper('api');
	}

	public function login() {

		$key = "123456";
		$aud = "http://localhost:4200";

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'POST')
		{
			$formdata = json_decode($this->input->raw_input_stream);
			$email = $formdata->email;
			$password = $formdata->password;

			$columns = 'id, first_name, last_name, email';
			$where = array('email' => $email, 'password' => $password, 'status' => 1, 'delete_status' => 0);
			$user_data = $this->masters->get_definecol_bytbl_cond($columns, 'userdetails', $where);

			if($user_data)
			{
				$user_data = $user_data->row();

				$userid = $user_data->id;
				$email = $user_data->email;
				$fname = $user_data->first_name;
				$lname = $user_data->last_name;

				$token = array(
				    "iss" => base_url()."api/auth/login",
				    "aud" => $aud,
				    "iat" => time(),
				    "exp" => time() + 60*60,
				    "userid"  => $userid,
				    "email" => $email
				);

				$jwt = JWT::encode($token, $key);

				$data = ['id' => $userid, 'email' => $email, 'firstName' => $fname, 'lastName' => $lname];
				response(['status' => TRUE, 'message' => 'Logged in successfully', 'data' => $data, 'token' => $jwt], 200);
			}
			else
			{
				response(['status' => 'FALSE', 'error' => 'Oops! Email or Password is incorrect'], 401);
			}
		}
		else if(strtoupper($request_method) == 'OPTIONS')
		{
			response(['status' => TRUE, 'message' => '', 'data' => ''], 200);
		}
		else
		{
			response(['status' => FALSE, 'error' => 'Method not allowed'], 405);
		}

	}

}