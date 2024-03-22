<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Legal_model extends CI_Model {

	protected $table_name = 'legal_resources';
	protected $detail_table_name = 'legal_resource_contents';

	// Other tables
	protected $countries_table = 'countries';
	protected $languages_table = 'languages';
	protected $admins_table    = 'admins';

	public function get($id, $client_id=1)
	{
		$this->db->select('cr.id, cr.mode, c.name as country, l.name as language, cr.created_on, cr.updated_on, COALESCE(crc.id, 0) as content_id, cr.type, cr.title as resource_title, COALESCE(crc.order_no, 1) as order_no, COALESCE(crc.title, "") as title, COALESCE(crc.content, "") as content');
		$this->db->from($this->table_name.' as cr');
		$this->db->join($this->detail_table_name.' as crc', 'crc.client_resource_id=cr.id AND crc.content_for="web"', 'left');
		$this->db->join($this->countries_table.' as c', 'c.id=cr.country_id');
		$this->db->join($this->languages_table.' as l', 'l.id=cr.lang_id');
		$this->db->where('cr.id', $id);
		$this->db->where('cr.client_id', $client_id);
		//$this->db->where('crc.content_for', 'web');
		$this->db->order_by('crc.order_no');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getLanguage($country_id, $client_id=1)
	{
		$this->db->select('cr.id, cr.mode, c.name as country, l.name as language, l.id as language_id');
		$this->db->from($this->table_name.' as cr');
		$this->db->join($this->countries_table.' as c', 'c.id=cr.country_id');
		$this->db->join($this->languages_table.' as l', 'l.id=cr.lang_id');
		$this->db->where('c.id', $country_id);
		$this->db->where('cr.client_id', $client_id);
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Get Record of Specific type, client, language and country
	 * @param  String  $type
	 * @param  integer $lang_id
	 * @param  integer $country_id
	 * @param  integer $client_id
	 * @return QueryBuilder
	 */
	public function getResourceQueryBuilder($type, $lang_id=1, $country_id=1, $client_id=1)
	{
		
		//check if country and lang condition match then show that else use lang_id=1 [default language]
		
		// $this->db->select('cr.id, cr.mode, c.name as country, l.name as language, cr.created_on, cr.updated_on, COALESCE(crc.id, 0) as content_id, cr.type, cr.title as resource_title, COALESCE(crc.order_no, 1) as order_no, COALESCE(crc.title, "") as title, COALESCE(crc.content, "") as content');
		// $this->db->from($this->detail_table_name.' as crc');
		// $this->db->where('cr.id', $id);
		// $this->db->where('cr.client_id', $client_id);
		// $query = $this->db->get();
		// $res = $query->result();
		
		//check for condition if both contry and lang_id exist then both condition else check if lang_id not exist then by default lang_id = 1
		
		
		$this->db->from($this->table_name);
		$this->db->where('type', $type);
		//$this->db->where('client_id', $client_id);
		$this->db->where('lang_id', $lang_id);
		$this->db->group_start();
		$this->db->where('country_id', $country_id);
		$this->db->group_end();
		$this->db->order_by("
			(CASE
		  		WHEN client_id=$client_id and lang_id=$lang_id THEN 0
		  		WHEN client_id=$client_id and lang_id!=$lang_id THEN 1
		    	WHEN country_id=$country_id AND client_id=1 AND lang_id=$lang_id THEN 2
		    	WHEN country_id=$country_id AND client_id=1 AND lang_id!=$lang_id THEN 3
		    	WHEN lang_id=$lang_id THEN 4
		    	ELSE 5
		 	END)
		");
		$this->db->limit(1);
		return $this->db;
	}

	/**
	 * Get Record of Specific type, client, language and country
	 * @param  String  $type
	 * @param  integer $lang_id
	 * @param  integer $country_id
	 * @param  integer $client_id
	 * @return Object
	 */
	public function getByType(...$params)
	{
		$this->getResourceQueryBuilder(...$params);
		$query = $this->db->get();
		return $query->row();
	}

	/**
	 * Get Record of Specific type, client, language and country
	 * @param  String  $type
	 * @param  integer $lang_id
	 * @param  integer $country_id
	 * @param  integer $client_id
	 * @return Array
	 */
	public function getPageTypeData(...$params)
	{
		$this->db->select('cr.*');
		$this->db->from($this->table_name.' as cr');
		$this->db->where('cr.lang_id', $params[1]);
		$this->db->where('cr.country_id', $params[2]);
		$query = $this->db->get();
		$result = $query->result_array();
		if($result[0]['id'] ==''){
			$params[1] = 1;
		}
		
		
		// Get client resource sql query
		$this->getResourceQueryBuilder(...$params);
		$resource_subquery = $this->db->get_compiled_select();
		// Get Resource detail using subquery
		$this->db->select('crc.*, c.title as client_resource_title');
		$this->db->from('('.$resource_subquery.') as c');
		$this->db->join($this->detail_table_name.' as crc', 'crc.client_resource_id=c.id');
		$this->db->where('crc.content_for', 'web');
		$this->db->order_by('crc.order_no', 'asc');
		$query = $this->db->get();
		// return $this->db->last_query();exit;
		return $query->result_array();
	}

	/**
	 * Get comma separated distinct country ids
	 * @param  integer $client_id
	 * @return String
	 */
	public function getCountryIds($client_id)
	{
		$this->db->select('GROUP_CONCAT(DISTINCT(country_id)) as country_ids');
		$this->db->where('client_id', $client_id);
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->row()->country_ids;
	}

    public function getTotalRecords($client_id)
	{
		$this->db->where('client_id', $client_id);
		return $this->db->count_all_results($this->table_name);
	}

	/** DataTables */

    public function dataTableQuery()
	{
		$this->db->select('cr.*, c.name as country_name, ln.id as lang_id, ln.name as lang_name, COALESCE(CONCAT(a.first_name, " ", a.last_name), "Anonymous") as updated_by');
		$this->db->from($this->table_name.' as cr');
		$this->db->join($this->countries_table.' as c', 'cr.country_id = c.id', 'left');
		$this->db->join($this->languages_table.' as ln', 'cr.lang_id = ln.id', 'left');
		$this->db->join($this->admins_table.' as a', 'a.id=cr.updated_by', 'left');
		return $this->db;
	}

    public function dataTableFilter($title='', $client_id='', $country_id='', $lang_id='', $updated_by='', $updated_on='', $created_on='', $search='')
	{
		$this->db->like('cr.type', 'legal');
		if($title != '')
			$this->db->like('cr.title', 'both');
		if($client_id != '')
			$this->db->where('cr.client_id', $client_id);
		if($lang_id != '')
			$this->db->where('cr.lang_id', $lang_id);
		if($country_id != '')
			$this->db->where('cr.country_id', $country_id);
		if($updated_by!='')
			$this->db->where('cr.updated_by', $updated_by);
		if($updated_on!='')
			$this->db->where('cr.updated_on', $updated_on);
		if($created_on!='')
			$this->db->where('cr.created_on', $created_on);
	}

	public function getDataTableResults($start=0, $length=10, $title='', $client_id='', $country_id='', $lang_id='', $updated_by='', $updated_on='', $created_on='', $search='')
	{
		// Get Total Count
		$total_count = $this->getTotalRecords($client_id);

		$this->dataTableQuery();

		// Set filters
		$this->dataTableFilter($title, $client_id, $country_id, $lang_id, $updated_by, $updated_on, $created_on, $search);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		$this->dataTableFilter($title, $client_id, $country_id, $lang_id, $updated_by, $updated_on, $created_on, $search);
		// Get limited records
		$this->db->limit($length, $start);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;	
		$results = $query->result_array();

		return [
			'total_records' 	=> $total_count,
			'filtered_records'  => $filtered_records,
			'results' 			=> $results,
		];
	}

	/**
	 * Update Resource
	 * @param  integer $id
	 * @param  array $data_arr
	 * @return Boolean
	 */
	public function update($id, $data_arr, $client_id=1)
	{
		$this->db->where('id', $id);
		$this->db->where('client_id', $client_id);
		return $this->db->update($this->table_name, $data_arr);
	}

    /**
	 * Update Resource content
	 * @param  integer $id
	 * @param  array $data_arr
	 * @return Boolean
	 */
    public function updateContent($id, $data_arr, $client_id=1)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->detail_table_name, $data_arr);
    }

    /**
     * Insert Content
     * @param  Array    $data_arr
     * @return Boolean
     */
    public function createContent($data_arr)
    {
    	return $this->db->insert($this->detail_table_name, $data_arr);
    }

    /**
     * Batch Insert Contents
     * @param  Array $assoc_arr
     * @return Boolean
     */
    public function saveContents($assoc_arr)
    {
    	return $this->db->insert_batch($this->detail_table_name, $assoc_arr);
    }

    /**
     * Delete all content for specified resource
     * @param  integer $resource_id
     * @return mixed
     */
    public function deleteAllContent($resource_id, $client_id=1)
    {
    	$this->db->where('client_resource_id', $resource_id);
    	return $this->db->delete($this->detail_table_name);
    }

}