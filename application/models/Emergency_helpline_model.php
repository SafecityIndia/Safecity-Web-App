<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Emergency_helpline_model extends CI_Model {

	protected $table_name = 'emergency_helpline';
	
	protected $countries_table = 'countries';
	protected $languages_table = 'languages';
	protected $category_table    = 'categories_translation';
	/**
	 * Get Autocomplete results
	 * @param  string $query  User text query
	 * @param  string $country_id
	 * @param  string $state_id
	 * @return Array
	 */

	public function getHelplineNbr($client_id,$country_id,$lang_id,$category_id,$gender_id,$city_id)
	{
		$category_id = $category_id.',"All"';
		$SQL = "SELECT * FROM emergency_helpline WHERE client_id='".$client_id."' AND  (country_id='".$country_id."' AND city_id='".$city_id."') OR (country_id='".$country_id."' AND city_id IS NULL) AND lang_id='".$lang_id."' AND category_id in (".$category_id.") ";
		
		//if(!empty($city_id)) $SQL .= ' AND city_id in ('.$city_id.')';
		//AND (country_id='204' AND city_id = 131059) OR (country_id='204' OR city_id = NULL)

		if($gender_id==4) $SQL .= 'AND gender_status in (3,2)';
		else if($gender_id==5) $SQL .= 'AND gender_status in (1,2)';
		//else $SQL .= 'AND gender_status in (1,3)';
		//$SQL .= 'AND gender_status in (2)';
		
		$SQL .= ' ORDER BY emergency_no+0';

		/*echo "<pre>";
		print_r($SQL);
		exit();*/

		$query = $this->db->query($SQL);
		//echo $this->db->last_query();die;
		//return $query->result_array();

		if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return 0;
        }
	}

	# Get all record passing parameter as per required 
    public function getHelplineNbr_help($country_id,$city_id,$lang_id)
    {
        /*$this->db->select('emergency_title, emergency_no');
        $this->db->from($this->table_name);
        $this->db->where('lang_id',$lang_id);
        $this->db->where(array('country_id'=>$country_id, 'city_id'=>$city_id));
        $this->db->or_where(array('country_id'=>$country_id, 'city_id'=>NULL));*/

        $SQL = "SELECT * FROM emergency_helpline WHERE (country_id='".$country_id."' AND city_id='".$city_id."') OR (country_id='".$country_id."' AND city_id IS NULL) AND lang_id='".$lang_id."' ";
        
        $query = $this->db->query($SQL);
        //$query = $this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return 0;
        }
    }
	
	public function getDataTableResults($start=0, $length=10, $title='', $client_id='', $country_id='', $lang_id='',  $gender='', $updated_by='', $updated_on='', $created_on='', $search='')
	{
		// Get Total Count
		$total_count = $this->getTotalRecords($client_id);

		// Get total count after filtering
		$this->dataTableQuery();

		// Set filters
		$this->dataTableFilter($title, $client_id, $country_id, $lang_id, $gender, $updated_by, $updated_on, $created_on, $search);
		$this->db->where('client_id', $client_id);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		// Set Filters
		$this->dataTableFilter($title, $client_id, $country_id, $lang_id, $gender, $updated_by, $updated_on, $created_on, $search);
		$this->db->where('client_id', $client_id);
		//$this->db->order_by('added_date', 'desc');

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
	
	public function getTotalRecords($client_id=1)
	{
		$this->db->where('client_id', $client_id);
		return $this->db->where('status', '1')->count_all_results($this->table_name);
	}
	
	public function dataTableQuery()
	{
		$this->db->select("`a`.*, `c`.`name` as `country`, `ln`.`name` as `language`, `ct`.`title` as `category`,
			CASE gender_status
				 WHEN 1 THEN 'FEMALE'
				 WHEN 2 THEN 'BOTH'
				 WHEN 3 THEN 'MALE'
				 ELSE NULL
			END as gender ");
		$this->db->from($this->table_name.' as a');
		$this->db->join($this->countries_table.' as c', 'a.country_id = c.id', 'left');
		$this->db->join($this->languages_table.' as ln', 'a.lang_id = ln.id', 'left');
		$this->db->join($this->category_table.' as ct', 'a.category_id = ct.id', 'left');
		$this->db->where('a.status', '1');
		return $this->db;
	}
	
	public function dataTableFilter($title='', $client_id='', $country_id='', $lang_id='', $gender='', $updated_by='', $updated_on='', $created_on='', $search='')
	{
		if($title != '')
			$this->db->like('a.emergency_title', 'both');
		if($client_id != '')
			$this->db->where('a.client_id', $client_id);
		if($gender != '')
			$this->db->where('a.gender_status', $gender);
		if($lang_id != '')
			$this->db->where('a.lang_id', $lang_id);
		if($country_id != '')
			$this->db->where('a.country_id', $country_id);
		if($updated_by!='')
			$this->db->where('a.updated_by', $updated_by);
		if($updated_on!='')
			$this->db->where('a.updated_date', $updated_on);
		if($created_on!='')
			$this->db->where('a.added_date', $created_on);
	}
}