<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

    // Naveen Functions Start 

	public function common_insert($tbl,$post_arr)
	{
		$this->db->insert($tbl, $post_arr);
		return $this->db->insert_id();
	}

	public function common_update($tbl,$update_data,$where_data)
	{
		$val = $this->db->update($tbl, $update_data, $where_data);
		return $this->db->affected_rows();
		// return $val;
	}

    public function common_delete($tbl,$where_data)
    {
        $val = $this->db->delete($tbl, $where_data);  
        // return $this->db->affected_rows();
        return $val;
    }

    public function get_joins_records($table, $columns, $joins, $where_arr, $order_col,$limit_arr = array())
    {
        $this->db->select($columns)->from($table);
        if (is_array($joins) && count($joins) > 0)
        {
            foreach($joins as $k => $v)
            {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }
        if (is_array($where_arr) && count($where_arr) > 0)
        {
            $this->db->where($where_arr);
        }
        if(!empty($order_col)){
            $this->db->order_by($order_col);
        }

        if(is_array($limit_arr) && count($limit_arr )> 0)
        {
            $this->db->limit($limit_arr['limit'], $limit_arr['offset']);
        }
        
        return $this->db->get()->result();
    }

	public function getdata_by_table($tbl)
	{
		return $this->db->get_where($tbl,array('delete_status'=>'0'));
	}
	public function getdata_by_table_cond($tbl,$where)
	{
		return $this->db->get_where($tbl,$where);
	}

	public function getdata_by_table_nostatus($tbl)
	{
		return $this->db->get($tbl);
	}

	public function getdata_by_table_sorting($tbl,$order_col)
    {
        $query = $this->db->order_by($order_col)->get($tbl);
        // return $this->db->last_query();
        return $query->num_rows()? $query : false ; 
    }

	public function getSingleRecord($tbl,$where)
	{
		$query = $this->db->get_where($tbl,$where);
		return ($query->num_rows()>0)? $query->row() : false ;
	}

	public function get_valuebycol($tname,$ret_col,$whr_arr)
    {
        $this->db->select($ret_col);
        $query = $this->db->get_where($tname,$whr_arr);
             
        if($query->num_rows()>0)
        {
            $r = $query->row();
            return $r->$ret_col;
        }else{
            return false;
        }
    }

    public function get_definecol_bytbl($col_fields,$tbl)
    {
        $this->db->select($col_fields);
        $query = $this->db->get($tbl);
        return $query->num_rows()? $query : false ; 
    }

    public function get_definecol_bytbl_cond($col_fields,$tbl,$where_arr)
    {
        $this->db->select($col_fields);
        $query = $this->db->get_where($tbl,$where_arr);
        // return $this->db->last_query();
        return $query->num_rows()? $query : false ; 
    }

    public function get_definecol_bytbl_cond_sorting($col_fields,$tbl,$where_arr,$order_col)
    {
        $this->db->select($col_fields);
        $query = $this->db->order_by($order_col)->get_where($tbl,$where_arr);
        // return $this->db->last_query();
        return $query->num_rows()? $query : false ; 
    }

    public function check_exist($tname,$whr_arr)
    {
        $query = $this->db->get_where($tname,$whr_arr);
          return ($query->num_rows()>0)? true:false;   
    }

     public function check_exist_pk($tname,$whr_arr, $ret_col)
    {
        $query = $this->db->get_where($tname,$whr_arr);

        return ($query->num_rows()>0)? $query->row()->$ret_col:false;   
    }

    public function getFundingbankdata()
	{
		$this->db->select('funding_bank_master.*, apps_countries.country_name, bcd.bank_name, continents.name as continent_name');
		$this->db->from('funding_bank_master');
        $this->db->join('apps_countries', 'apps_countries.id = funding_bank_master.country_id');
        $this->db->join('continents', 'continents.id = funding_bank_master.region_id');
        $this->db->join('suppliers_bank as sb', 'sb.id = funding_bank_master.bank_id');
        $this->db->join('bank_contact_deatils as bcd', 'sb.bank_id = bcd.id', 'left');
		$this->db->where('funding_bank_master.delete_status','0');
		$query = $this->db->get();
		
		return ($query->num_rows()>0)? $query : false ;
	}


    public function getSuppBank(){
        return $this->db->select('sb.id, bcd.bank_name, ac.country_name')
                        ->from('suppliers_bank as sb')
                        ->join('bank_contact_deatils as bcd', 'sb.bank_id = bcd.id', 'left')
                        ->join('apps_countries as ac','sb.country_id = ac.id', 'left')
                        ->where(['sb.status'=> '1', 'sb.delete_status'=> '0'])
                        ->get();
    }
    public function SuppBankOnId(int $id){
        return $this->db->select('sb.id, bcd.bank_name, ac.country_name')
                        ->from('suppliers_bank as sb')
                        ->join('bank_contact_deatils as bcd', 'sb.bank_id = bcd.id', 'left')
                        ->join('apps_countries as ac','sb.country_id = ac.id', 'left')
                        ->where(['sb.status'=> '1', 'sb.delete_status'=> '0', 'sb.id'=> $id])
                        ->get();
    }

	public function insert_batch($data = array())
    {
        $insert = $this->db->insert_batch('user_tfra_attachement',$data);
        return $insert?true:false;
    }

    public function Currency_TF_buyers()
	{
		$this->db->where('id >=', 1);
		$this->db->where('id <=', 4);
		$result = $this->db->get_where('currency_master',array('status'=>'1'));
		return $result->result();
	}
	public function holidays(){
		$query = $this->db->get_where('Holiday',['delete_status' => 0]);
		return $query->result();
	}
	public function holiday_change($id, $value){
		$query = $this->db
						->where('HID', $id )
						->update('Holiday', $value);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}
	public function holiday_insert($data){
		$query = $this->db->insert('Holiday', $data);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}

	 public function getdata_by_table_cond_limit_sorting($tbl,$where_arr,$order_col,$start,$limit)
    {
        $this->db->select();
        $this->db->limit($start,$limit);
        $query = $this->db->order_by($order_col)->get_where($tbl,$where_arr);
        
        // return $this->db->last_query();
        return $query->num_rows()? $query : false ;
    }

    public function getnumrow_by_table_cond($tbl,$where_arr)
    {
        $this->db->select();
        $query = $this->db->get_where($tbl,$where_arr);
        
        return $query->num_rows()? $query->num_rows() : false ;
    }

    
 public function get_definecol_bytbl_groupby($col_fields,$tbl,$grp_by)
    {
        $this->db->select($col_fields);
        $this->db->group_by($grp_by);
        $query = $this->db->get($tbl);
        return $query->num_rows()? $query : false ; 
    }

    // Asad Code

    public function getdata_ratecheck()
    {
        $this->db->select('user_ratecheck.*,userdetails.Name,userdetails.lname,userdetails.MobileId');
        $this->db->from('user_ratecheck');
        $this->db->join('userdetails', 'userdetails.UserID = user_ratecheck.userid');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        return $query->result_array();
    }


    public function upload_files($path, $files_arr,$file_size,$allowed_types)
    {
        $config_file = array(
            'upload_path'   => $path,
            'allowed_types' => $allowed_types,
            'overwrite'     => 1,
            'max_size'      => $file_size                  
        );

        $this->load->library('upload', $config_file);

        $mul_file = array();

        foreach ($files_arr['name'] as $key => $fname) {
            $_FILES['mul_file[]']['name']= $files_arr['name'][$key];
            $_FILES['mul_file[]']['type']= $files_arr['type'][$key];
            $_FILES['mul_file[]']['tmp_name']= $files_arr['tmp_name'][$key];
            $_FILES['mul_file[]']['error']= $files_arr['error'][$key];
            $_FILES['mul_file[]']['size']= $files_arr['size'][$key];

            $fileName = uniqid() .'_'. $fname;
            $mul_file[] = preg_replace('/\s+/', '_', $fileName);
            $config_file['file_name'] = $fileName;

            $this->upload->initialize($config_file);

            if ($this->upload->do_upload('mul_file[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $mul_file;
    }
    
    public function common_insert_batch($tbl,$post_arr)
    {
        $this->db->insert_batch($tbl, $post_arr);
        return $this->db->affected_rows();
    }

    public function getRows_using_IN($tbl,$where_in_id_arr,$select_col='',$where_arr='')
    {
        //Note: Send all parameter from where you call this function either blank or real value.

        if($select_col!=''){
            $this->db->select($select_col);
        }
        if($where_arr!=''){
            $this->db->where($where_arr);
        }
        $this->db->where_in('id', $where_in_id_arr);
        $result = $this->db->get($tbl);
        return $result->result();
    }

    public function notifications_admin()
    {
        $all_notification = $this->getdata_by_table_sorting('open_notification','id DESC');
        return json_encode($all_notification->result());
    }

    public function getHolidayList()
    {
        $holiday_query =$this->Masters->getdata_by_table_nostatus('Holiday');
        $k=0;
        foreach ($holiday_query->result() as $value) {
            if($value->type=='IND'){
                $hdate = dmY($value->holiday_date);
                $all_list['IND'][$k] = $hdate;
            }else{
                $hdate = dmY($value->holiday_date);
                $all_list['US'][$k] = $hdate;
            }
            $k++;
        }
        return $all_list;
    }   

    //Add wht from add_funding_bank page
    //Code Start: Added by Saurabh on 24-05-2018

    public function addWht($value)
    {
        $wht = $value['wht'];
        $countryTo = $value['countryTo'];
        $countryFrom = $value['countryFrom'];
        $data=array();
        $data['wht'] = $wht;
        $data['country_to'] = $countryTo;
        $data['country_from'] =$countryFrom;
        $data['created_by'] = $this->session->userdata('vuser_log_data')['UserID'];
        $this->db->insert('country_wht',$data);
    }

    public function getLastWht(){
        $this->db->select('id');
        $this->db->order_by('id','DESC');
        $query=$this->db->get('country_wht');
        return $query->row_array();
    }

    public function getWht($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query=$this->db->get('country_wht');
        return $query->row_array();
    }

    public function updateWht($data){
        extract($data);
        $arr=array('wht'=>$wht,'country_to'=>$country_to,'country_from'=>$country_from);
        $this->db->where('id',$wht_id);
        $this->db->update('country_wht',$arr);
    }

    public function cover_letter_data($supp_id){
        $data_array=$this->db->select('sc.amount, sc.curr_id, sc.lc_tenor as usance_tenor,sc.days_no as free_usance_tenor,sc.lc_confirm as confirm,sc.usance,scp.confirmation as confirmation,scp.quote as usance_intrest,ud.Name,ud.lname,ud.CompanyName as company,ud.EmailID as user_email,bcd.bank_name as lc_bank')
         ->from('suppliers_credit as sc')
         ->join('supplier_accept_price as scp','sc.id=scp.supp_id','left')
         ->join('userdetails as ud','sc.user_id=ud.UserID','left')
         ->join('bank_contact_deatils as bcd', 'sc.lc_bank_id=bcd.id','left')
         ->where(['sc.id'=> $supp_id,'sc.status'=>1, 'sc.delete_status'=>0,'scp.status'=>1, 'scp.delete_status'=>0,'ud.status'=>1, 'ud.delete_status'=>0])->get()->row_array();
         return $data_array;
    }

    //Add wht from add_funding_bank page
    //Code End: Added by Saurabh on 12-05-2018 


    //Added For Leads Module |start

    public function get_all_data_by_table($tablename)
    {
        $this->db->from($tablename);
              
       return $this->db->get(); 
    }

    public function get_partial_data_by_table($tablename, $neededcolumns, $wharecond = array())
    {
        
        $this->db->from($tablename);

        $this->db->select($neededcolumns);
              
       return $this->db->get(); 
    }
    //Added For Leads Module |end

}
