<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Organization_model extends CI_Model {

	protected $table_name = 'organisations';

	public function getAutocomplete($query, $country_id='', $city_id='')
	{
		$this->db->select('o.id, o.name, (o.passcode IS NOT NULL) as has_passcode, c.id as client_id');
		$this->db->from($this->table_name.' as o');
		$this->db->join('clients as c', 'c.type_id=o.id AND c.type="organisation"');
		$this->db->like('name', $query, 'both');
		if($country_id!='')
			$this->db->where('country_id', $country_id);
		if($city_id!='')
			$this->db->where('city_id', $city_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function verifyPasscode($id, $passcode)
	{
		$this->db->where('id', $id);
		$this->db->where('passcode', $passcode);
		return $this->db->count_all_results($this->table_name);
	}

}