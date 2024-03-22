<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class State_model extends CI_Model {

	protected $table_name = 'states';

	/**
	 * Get all states in a country
	 * @param  integer $country_id
	 * @return Array            
	 */
	public function getByCountry($country_id)
	{
		$this->db->where('country_id', $country_id);
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->result_array();
	}

}