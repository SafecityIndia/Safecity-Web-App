<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Country_model extends CI_Model {

	protected $table_name = 'countries';

	/**
	 * Get Autocomplete results
	 * @param  string $query  User text query
	 * @return Array
	 */
	public function getAutocomplete($query)
	{
		$this->db->select('*, id as country_id, name as country_name');
		$this->db->from($this->table_name);
		$this->db->like('name', $query, 'both');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Get all countries
	 * @return Array
	 */
	public function get()
	{
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
		$this->db->select('*, id as country_id, name as country_name');
		$this->db->from($this->table_name);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	/**
	 * Get Record Details
	 * @param  Array $id_arr
	 * @return Array
	 */
	public function getByIds($id_arr)
	{
		$this->db->from($this->table_name);
		$this->db->where_in('id', $id_arr);
		$query = $this->db->get();
		return $query->result_array();
	}

}