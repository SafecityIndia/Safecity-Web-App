<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class City_model extends CI_Model {

	protected $table_name = 'cities';

	/**
	 * Get Autocomplete results
	 * @param  string $query  User text query
	 * @param  string $country_id
	 * @param  string $state_id
	 * @return Array
	 */
	public function getAutocomplete($query, $country_id='', $state_id='')
	{
		$this->db->select('c.*, c.name as city_name, COALESCE(cl.id, 1) as client_id');
		$this->db->from($this->table_name.' as c');
		$this->db->join('clients as cl', 'cl.type_id=c.id AND cl.type="city"', 'left');
		//$this->db->like('c.name', $query, 'both');
		$this->db->like('c.name', $query, 'after');
		if($country_id!='')
			$this->db->where('country_id', $country_id);
		if($state_id!='')
			$this->db->where('state_id', $state_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Get all cities in a country
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

	/**
	 * Get Record Details
	 * @param  integer $id
	 * @return Object
	 */
	public function getById($id)
	{
		$this->db->select('c.*, c.name as city_name, COALESCE(cl.id, 1) as client_id');
		$this->db->from($this->table_name.' as c');
		$this->db->join('clients as cl', 'cl.type_id=c.id AND cl.type="city"', 'left');
		$this->db->where('c.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

}