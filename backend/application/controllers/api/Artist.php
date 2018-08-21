<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Masters', 'masters');
		$this->load->model('Api');
		$this->load->helper('api');
	}

	public function artists() {

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'GET')
		{
			validate_jwt_token();

			$offset = $this->uri->segment(4);
			$limit = $this->uri->segment(5);
			
			$formdata = json_decode($this->input->raw_input_stream);

			$result = $this->Api->getdata_by_table_cond_limit_sorting('artists', 'count(*) as total_count');

			$total_count = $result->row()->total_count;

			$res = $this->Api->getdata_by_table_cond_limit_sorting('artists', 'id, name', 'name asc', 
				$limit, $offset);

			if($res)
			{
				$artist_data['data'] = $res->result();
				$artist_data['total_count'] = $total_count;

				response(['status' => TRUE, 'message' => '', 'data' => $artist_data], 200);
			}
			else
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
			}
		}
		else
		{
			if(strtoupper($request_method) == 'OPTIONS')
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
			}
			else
			{
				response(['status' => FALSE, 'error' => 'Method not allowed'], 405);
			}
		}

	}

	public function artist_detail() {

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'GET')
		{
			$formdata = json_decode($this->input->raw_input_stream);

			$artist_id = $this->uri->segment(4);

			$res = $this->masters->get_definecol_bytbl_cond('id, name', 'artists', ['id' => 
				$artist_id]);

			if($res)
			{
				$artist_data = $res->row();

				response(['status' => TRUE, 'message' => 'success', 'data' => $artist_data], 200);
			}
			else
			{
				response(['status' => TRUE, 'message' => 'no data vailable', 'data' => [] ], 200);
			}
		}
		else
		{
			if(strtoupper($request_method) == 'OPTIONS')
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
			}
			else
			{
				response(['status' => FALSE, 'error' => 'Method not allowed'], 405);
			}
		}
	}

	public function tracks() {

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'GET')
		{
			$formdata = json_decode($this->input->raw_input_stream);

			$artist_id = $this->uri->segment(4);

			$res = $this->masters->get_definecol_bytbl_cond('id, name', 'tracks', ['artists_id' => 
				$artist_id]);

			if($res)
			{
				$tracks = $res->result();

				response(['status' => TRUE, 'message' => 'success', 'data' => $tracks], 200);
			}
			else
			{
				response(['status' => TRUE, 'message' => 'no data available', 'data' => [] ], 200);
			}
		}
		else
		{
			if(strtoupper($request_method) == 'OPTIONS')
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
			}
			else
			{
				response(['status' => FALSE, 'error' => 'Method not allowed'], 405);
			}
		}
	}

	public function albums() {

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'GET')
		{
			$formdata = json_decode($this->input->raw_input_stream);

			$artist_id = $this->uri->segment(4);

			$res = $this->masters->get_definecol_bytbl_cond('id, name', 'albums', ['artists_id' => 
				$artist_id]);

			if($res)
			{
				$albums = $res->result();

				response(['status' => TRUE, 'message' => 'success', 'data' => $albums], 200);
			}
			else
			{
				response(['status' => TRUE, 'message' => 'no data vailable', 'data' => [] ], 200);
			}
		}
		else
		{
			if(strtoupper($request_method) == 'OPTIONS')
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
			}
			else
			{
				response(['status' => FALSE, 'error' => 'Method not allowed'], 405);
			}
		}
	}

	public function search() {

		$request_method = $this->input->server('REQUEST_METHOD');

		if(strtoupper($request_method) == 'GET')
		{
			//validate_jwt_token();

			$term = $this->uri->segment(4);
			
			$formdata = json_decode($this->input->raw_input_stream);

			$where = "name like '%{$term}%'";

			$res = $this->masters->get_definecol_bytbl_cond('id, name', 'artists', $where);

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
		else
		{
			if(strtoupper($request_method) == 'OPTIONS')
			{
				response(['status' => TRUE, 'message' => '', 'data' => [] ], 200);
			}
			else
			{
				response(['status' => FALSE, 'error' => 'Method not allowed'], 405);
			}
		}

	}

}