<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ngo_model extends CI_Model {

	protected $table_name = 'ngo';

	
	public function getNgoDetails($ngo_ids){   
		
            $this->db->where_in('id', explode(',', $ngo_ids));
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->result_array();
	}

}