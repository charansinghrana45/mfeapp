<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Model
{
	 public function getdata_by_table_cond_limit_sorting($tbl, $columns ='', $order_col = '', $start = null, $limit = null, $where_arr = array())
	{
	    $this->db->select($columns);
	    $this->db->from($tbl);
	    $this->db->where($where_arr);

	    if($order_col) {
	    	$this->db->order_by($order_col);
		}

	    if($start) {
	    	$this->db->limit($start, $limit);
		}
	    $query = $this->db->get();

	    return $query->num_rows()? $query : false ;
	}
}