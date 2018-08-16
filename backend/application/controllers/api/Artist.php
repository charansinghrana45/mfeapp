<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Masters', 'masters');
		$this->load->helper('api');
	}

	public function artists() {

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'GET')
		{
			$formdata = json_decode($this->input->raw_input_stream);

			$res = $this->masters->get_definecol_bytbl('id, name', 'artists');

			if($res)
			{
				$artist_data = $res->result();

				response(['status' => TRUE, 'message' => '', 'data' => $artist_data], 200);
			}
			else
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
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