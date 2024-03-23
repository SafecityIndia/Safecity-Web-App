<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model {

	protected $table_name = 'clients';
	protected $incident_table = 'incident_reports';
	protected $safetytip_table = 'safety_tips_report';

	// Other tables for JOIN
	protected $client_languages = 'client_languages';
	protected $languages        = 'languages';

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getJordanLanguages($client_id)
	{
		$this->db->select('l.*');
		$this->db->from($this->languages.' as l');
		$this->db->where('client_id',$client_id);
		$this->db->where('language_id','1');
		$this->db->or_where('language_id','6');
		$this->db->join($this->client_languages.' as cl', 'cl.language_id=l.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getLanguages($client_id)
	{
		$this->db->select('l.*');
		$this->db->from($this->languages.' as l');
		$this->db->join($this->client_languages.' as cl', 'cl.language_id=l.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Get total record counts
	 * @param  string $client_id
	 * @return integer
	 */
	public function getTotalRecords()
	{
		return $this->db->where('deleted_on', null)->count_all_results($this->table_name);
	}

	/** DataTables */

	public function dataTableQuery()
	{
		//$this->db->select('c.*, count(i.id) as total_incidents, count(s.id) as total_safetytips');
		$this->db->select('c.*, (SELECT count(*) from safety_tips_report where client_id=c.id) as total_safetytips, (SELECT count(*) from incident_reports where client_id=c.id) as total_incidents');
		$this->db->from($this->table_name.' as c');
		//$this->db->join($this->incident_table.' as i', 'c.id=i.client_id', 'left');
		//$this->db->join($this->safetytip_table.' as s', 'c.id=s.client_id', 'left');
		$this->db->where('c.deleted_on', null);
		$this->db->where('c.id !=', 1);
		return $this->db;
	}

	public function dataTableFilter($search='')
	{
		if($search!='') {
			$this->db->group_start();
			$this->db->like('username', $search);
			$this->db->or_like('email', $search);
			$this->db->or_like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->or_like('company', $search);
			$this->db->or_like('phone', $search);
			$this->db->group_end();
		}
	}

	public function getDataTableResults($start=0, $length=10, $search='')
	{
		// Get Total Count
		$total_count = $this->getTotalRecords();

		// Get total count after filtering
		$this->dataTableQuery();

		// Set filters
		$this->dataTableFilter($search);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		// Set Filters
		$this->dataTableFilter($search);
		$this->db->order_by('c.created_on', 'desc');

		// Get limited records
		if($length!='all')
			$this->db->limit($length, $start);

		$query = $this->db->get();
		$results = $query->result_array();
		return [
			'total_records' 	=> $total_count,
			'filtered_records'  => $filtered_records,
			'results' 			=> $results,
		];
	}

}