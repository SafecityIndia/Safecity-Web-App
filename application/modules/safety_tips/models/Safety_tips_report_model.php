<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Safety_tips_report_model extends CI_Model {

	protected $table_name = 'safety_tips_report';

	public function getMapCoordinates($map_bounds, $start_date='', $end_date='', $client_id=1)
	{
		$this->db->select('id, map_lat as latitude, map_lon as longitude');
		$this->db->where('client_id', $client_id);

		// Rectangular Query
		$this->db->where('map_lat >', (float) $map_bounds['sw']['lat']);
		$this->db->where('map_lat <', (float) $map_bounds['ne']['lat']);
		$this->db->where('map_lon >', (float) $map_bounds['sw']['lng']);
		$this->db->where('map_lon <', (float) $map_bounds['ne']['lng']);

		// Date filter
		if($start_date!='' && $end_date!='')
			$this->reportedDateFilter($start_date, $end_date);

		$this->db->where('status', 'published');

		$this->db->from($this->table_name);
		//echo $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $query->result_array();
	}

	/** Get total reports after filtering */
	public function getSafetyTipsCounts($map_bounds, $city, $area, $start_date='', $end_date='', $lang_id=1, $client_id=1)
	{
		$this->db->where('client_id', $client_id);
		$this->db->where('language_id', $lang_id);
		if($map_bounds!='') {
			// Rectangular Query
			$this->db->where('map_lat >', $map_bounds['sw']['lat']);
			$this->db->where('map_lat <', $map_bounds['ne']['lat']);
			$this->db->where('map_lon >', $map_bounds['sw']['lng']);
			$this->db->where('map_lon <', $map_bounds['ne']['lng']);
		}
		else if($area!='')
			$this->db->like('location', $area);
		else if($city!='')
			$this->db->like('city', $city);

		// Date filter
		if($start_date!='' && $end_date!='')
			$this->reportedDateFilter($start_date, $end_date);

		// Count only published incidents
		$this->db->where('status', 'published');

		return $this->db->count_all_results($this->table_name);
	}

	/**
	 * Returns results that are within provided distance limit from provided lat lng
	 * @param  String  $city
	 * @param  String  $area
	 * @param  integer $lang_id
	 * @param  integer $client_id
	 * @param  integer $limit
	 * @param  integer $offset
	 * @return Array
	 */
	public function getSafetyTipsByLocation($map_bounds, $city, $area, $start_date='', $end_date='', $lang_id=1, $client_id=1, $limit=100, $offset=0)
	{
		$this->db->select('*, map_lat as latitude, map_lon as longitude');
		$this->db->from($this->table_name);
		$this->db->where('client_id', $client_id);
		$this->db->where('language_id', $lang_id);
		if($map_bounds!='') {
			// Rectangular Query
			$this->db->where('map_lat >', $map_bounds['sw']['lat']);
			$this->db->where('map_lat <', $map_bounds['ne']['lat']);
			$this->db->where('map_lon >', $map_bounds['sw']['lng']);
			$this->db->where('map_lon <', $map_bounds['ne']['lng']);
		}
		else if($area!='') {
			$this->db->like('location', $area);
		}
		else
			$this->db->like('city', $city);

		// Date filter
		if($start_date!='' && $end_date!='')
			$this->reportedDateFilter($start_date, $end_date);

		// Show only published incidents
		$this->db->where('status', 'published');

		$this->db->order_by('added_date', 'desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	private function reportedDateFilter($start_date, $end_date)
	{
		return $this->db->where("added_date BETWEEN '".$start_date."' AND '".$end_date."'");
	}

	/**
	 * Get Safety Tip report detail
	 * @param  integer  $report_id
	 * @param  integer  $lang_id
	 * @return Array
	 */
	public function getDetailedReport($report_id, $lang_id=1)
	{
		$this->db->select('st.*, st.map_lat as latitude, st.map_lon as longitude, COALESCE(CONCAT(a.first_name, " ", a.last_name), "Anonymous") as posted_by');
		$this->db->from($this->table_name.' as st');
		$this->db->join('admins as a', 'a.id=st.admin_id', 'left');
		//$this->db->where('st.language_id', $lang_id);
		$this->db->where('st.id', $report_id);
		$query = $this->db->get();
		return $query->row();
	}

	/**
	 * Create Safety Tip Report
	 * @param  Array $data
	 * @return Mixed
	 */
	public function createReport($data)
	{
	   $result = $this->db->insert($this->table_name, $data);
	   if($result)
	   		return $this->db->insert_id();
	   	else
	   		return $result;
	}

	/**
	 * Update Safety Tip Report
	 * @param  integer $report_id
	 * @param  integer $data_arr
	 * @return Boolean
	 */
	public function updateReport($report_id, $user_id='', $data_arr, $client_id=1)
	{
		$this->db->where('id', $report_id);
		if($user_id!='')
			$this->db->where('user_id', $user_id);
		else
			$this->db->where('client_id', $client_id);
		return $this->db->update($this->table_name, $data_arr);
	}

	/**
	 * Get Safety Tips reported by specific user and has mobile visibility
	 * @param  integer $user_id
	 * @param  integer $lang_id
	 * @return Array
	 */
	public function getUserReports($user_id, $lang_id=1)
	{
		$this->db->select('*, map_lat as latitude, map_lon as longitude');
		$this->db->from($this->table_name);
		//$this->db->where('language_id', $lang_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('is_mobile_visible', 1);
		// Show only published safety tips
		$this->db->where('status', 'published');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Hide Safety Tip report for mobile visibility when requested by specific user
	 * @param  integer $report_id
	 * @param  integer $user_id
	 * @return Boolean
	 */
	public function unsetMobileVisibility($report_id, $user_id)
	{
		$this->db->where('id', $report_id);
		$this->db->where('user_id', $user_id);
		return $this->db->update($this->table_name, ['is_mobile_visible' => 0]);
	}

	/**
	 * Delete Safety Tip report/s
	 * @param  integer|array $report_id
	 * @param  integer $user_id
	 * @return Array
	 */
	public function deleteUserReports($report_id, $user_id='', $client_id=1)
	{
		if(is_array($report_id))
			$this->db->where_in('id', $report_id);
		else
			$this->db->where('id', $report_id);
		if($user_id!='')
			$this->db->where('user_id', $user_id);
		else
			$this->db->where('client_id', $client_id);
		return $this->db->delete($this->table_name);
	}

	public function insert_data($table_name, $data)
	{
	   $this->db->insert($this->table_name, $data);
	   return $this->db->insert_id();
	}

	    function update_data($table,$column,$match_value,$data)
    {
        $this->db->where($column, $match_value);
        $this->db->update($this->table_name, $data);

    }

        function delete_data($tablename,$columnname,$category_id)
    {
        $this->db->where($columnname, $category_id);
        $this->db->delete($this->table_name);
    }

	public function get_detail($id,$lang_id=1)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('language_id', $lang_id);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}


		public function get_safetip_listing($status,$lang_id=1)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('language_id', $lang_id);
		$this->db->where('status', $status);
		$query = $this->db->get();
		return $query->result_array();
	}
		public function get_safetip_search_list($status,$search_txt,$lang_id=1)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('language_id', $lang_id);
		$this->db->where('status', $status);
		$this->db->or_like('safety_tip_title', $search_txt, 'both');
		$this->db->or_like('location_city_state', $search_txt, 'both');
		$query = $this->db->get();
		return $query->result_array();
	}

		public function get_safetip_filter_list($status_bar, $location, $fromdate , $enddate, $lang_id=1)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('language_id', $lang_id);

		if( !empty($status_bar) && !empty($location)  && !empty($fromdate)  && !empty($enddate)  ){
			// echo "4";
		$this->db->where('status', $status_bar);
		$this->db->where('country', $location);
		$this->db->where('date_format(added_date, "%Y-%m-%d") >=', date($fromdate));
		$this->db->where('date_format(added_date, "%Y-%m-%d") <=', date($enddate));


		}elseif( !empty($status_bar) && !empty($fromdate)  && !empty($enddate)  ){
			// echo "2";
		$this->db->where('status', $status_bar);
		$this->db->where('country', $location);
		$this->db->where('date_format(added_date, "%Y-%m-%d") >=', date($fromdate));
		$this->db->where('date_format(added_date, "%Y-%m-%d") <=', date($enddate));


		}elseif( !empty($status_bar) && !empty($location)  && !empty($fromdate)  ){
			// echo "3";
		$this->db->where('status', $status_bar);
		$this->db->where('country', $location);
		$this->db->where('date_format(added_date, "%Y-%m-%d") =', date($fromdate));
		// $this->db->where('added_date', $enddate);


		}elseif (!empty($status_bar) && !empty($location)  ) {
			// echo "1";
		$this->db->where('status', $status_bar);
		$this->db->where('country', $location);

		}

		elseif (!empty($status_bar) && !empty($fromdate)  ) {
			// echo "1";
		$this->db->where('status', $status_bar);
		$this->db->where('date_format(added_date, "%Y-%m-%d") =', date($fromdate));

		}
		elseif( !empty($status_bar) || !empty($location)  || !empty($fromdate)  || !empty($enddate)  ){
			// echo "5";
		$this->db->where('status', $status_bar);
		$this->db->where('country', $location);
		$this->db->where('date_format(added_date, "%Y-%m-%d") =', date($fromdate));
		$this->db->where('date_format(added_date, "%Y-%m-%d") =', date($enddate));


		}

		// $this->db->where('status', $status_bar);
		// $this->db->or_like('safety_tip_title', $search_txt, 'both');
		// $this->db->or_like('location_city_state', $search_txt, 'both');
		$query = $this->db->get();
		 // print_r($this->db->last_query());
		 // exit();
		return $query->result_array();
	}

	public function get_country_list($lang_id=1)
	{
		$this->db->select('country');
		$this->db->from($this->table_name);
		$this->db->where('language_id', $lang_id);
		$this->db->group_by('country');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		return $query->result_array();
	}

	/** Admin stuffs */

	/**
	 * Batch Insert Details
	 * @param  Array $assoc_arr
	 * @return Boolean
	 */
	public function saveDetails($assoc_arr)
	{
		return $this->db->insert_batch($this->table_name, $assoc_arr);
	}

	/**
	 * Update Safety Tip Report Statuses
	 * @param  integer/array  $record_id
	 * @param  string 		  $status
	 * @return integer
	 */
	public function updateStatus($record_id, $status, $client_id=1)
	{
		if(is_array($record_id))
			$this->db->where_in('id', $record_id);
		else
			$this->db->where('id', $record_id);
		$this->db->where('client_id', $client_id);
		return $this->db->update($this->table_name, ['status' => $status]);
	}

	public function getStatusesCount($client_id=1)
	{
		$this->db->select("SUM(IF(status='pending_approval', 1, 0)) AS'pending_approval', SUM(IF(status='saved', 1, 0)) AS 'saved', SUM(IF(status='approved', 1, 0)) AS 'approved', SUM(IF(status='published', 1, 0)) AS 'published', SUM(IF(status='rejected', 1, 0)) AS 'rejected', SUM(IF(status='trashed', 1, 0)) AS 'trashed'");
		$this->db->where('client_id', $client_id);
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getTotalRecords($status='', $client_id=1)
	{
		if($status!='') {
			if(is_array($status))
				$this->db->where_in('status', $status);
			else
				$this->db->where('status', $status);
		}
		$this->db->where('client_id', $client_id);
		return $this->db->count_all_results($this->table_name);
	}

	/** DataTables */

	public function dataTableQuery()
	{
		$this->db->select('st.*, COALESCE(CONCAT(a.first_name, " ", a.last_name), "Anonymous") as posted_by');
		$this->db->from($this->table_name.' as st');
		$this->db->join('admins as a', 'a.id=st.admin_id', 'left');
		return $this->db;
	}

	public function dataTableFilter($status='', $start_date='', $end_date='', $search='')
	{
		if($status!='') {
			if(is_array($status))
				$this->db->where_in('status', $status);
			else
				$this->db->where('status', $status);
		}
		if($start_date!='')
			$this->db->where('added_date >=', $start_date);
		if($end_date!='')
			$this->db->where('added_date <=', $end_date);
		if($search!='') {
			$this->db->group_start();
			$this->db->like('safety_tip_desc', $search);
			$this->db->or_like('safety_tip_title', $search);
			$this->db->or_like('st.id', $search);
			$this->db->or_like('added_date', $search);
			$this->db->or_like('a.first_name', $search);
			$this->db->or_like('a.last_name', $search);
			// Search for Addreses
			$this->db->or_like('location_city_state', $search);
			$this->db->or_like('location', $search);
			$this->db->or_like('landmark', $search);
			$this->db->or_like('city', $search);
			$this->db->or_like('state', $search);
			$this->db->or_like('country', $search);
			$this->db->or_like('exact_location', $search);
			$this->db->group_end();
		}

	}

	public function fetchResultByIds($id_arr, $client_id='')
	{
		$this->dataTableQuery();
		$this->db->where_in('st.id', $id_arr);
		if($client_id!='')
			$this->db->where('client_id', $client_id);
		$this->db->order_by('added_date', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDataTableResults($start=0, $length=10, $status='', $start_date='', $end_date='', $search='', $client_id=1)
	{
		// Get Total Count
		$total_count = $this->getTotalRecords($status, $client_id);

		// Get total count after filtering
		$this->dataTableQuery();

		// Set filters
		$this->dataTableFilter($status, $start_date, $end_date, $search);
		$this->db->where('st.client_id', $client_id);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		// Set Filters
		$this->dataTableFilter($status, $start_date, $end_date, $search);
		$this->db->where('st.client_id', $client_id);
		$this->db->order_by('added_date', 'desc');

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