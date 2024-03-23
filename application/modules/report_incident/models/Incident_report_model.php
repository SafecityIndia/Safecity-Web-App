<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Incident_report_model extends CI_Model {

	protected $table_name = 'incident_reports';

	/**
	 * Save Data
	 * @param  Array $data_arr
	 * @return Mixed
	 */
	public function save($data_arr)
	{
		$result = $this->db->insert($this->table_name, $data_arr);
		if($result) {
			$insert_id = $this->db->insert_id();
   			return $insert_id;
		} else {
			return 0;
		}

	}

	/**
	 * Batch Insert Details
	 * @param  Array $assoc_arr
	 * @return Boolean
	 */
	public function save_batch($assoc_arr)
	{
		return $this->db->insert_batch($this->table_name, $assoc_arr);
	}

	public function getLastInsertedId()
	{
		return $this->db->insert_id();
	}

	public function getLastIncidentId()
	{
		return $this->db->select('id')->from($this->table_name)->order_by('id', 'desc')->get()->row();
	}

	/**
	 * Update Data
	 * @param  integer $report_id
	 * @param  array   $data_arr
	 * @param  string  $user_id
	 * @return Boolean
	 */
	public function update($report_id, $data_arr, $user_id='', $client_id=1)
	{
		$this->db->where('id', $report_id);
		if($user_id!='')
			$this->db->where('user_id', $user_id);
		else
			$this->db->where('client_id', $client_id);
		return $this->db->update($this->table_name, $data_arr);
	}

	/**
	 * Batch Insert Details
	 * @param  Array $assoc_arr
	 * @return Boolean
	 */
	public function saveDetails($assoc_arr)
	{
		return $this->db->insert_batch('incident_details', $assoc_arr);
	}

	/**
	 * Batch Update Details
	 * @param  array   $assoc_arr
	 * @return Boolean
	 */
	public function updateDetails($assoc_arr)
	{
		return $this->db->update_batch('incident_details', $assoc_arr, 'id');
	}

	public function getIncidentMapCoordinates($map_bounds, $cat_ids='', $start_date='', $end_date='', $time_arr = [], $client_id=1)
	{
		$this->db->select('id, latitude, longitude');
		$this->db->where('client_id', $client_id);

		// Rectangular Query
		$this->db->where('latitude >', (float) $map_bounds['sw']['lat']);
		$this->db->where('latitude <', (float) $map_bounds['ne']['lat']);
		$this->db->where('longitude >', (float) $map_bounds['sw']['lng']);
		$this->db->where('longitude <', (float) $map_bounds['ne']['lng']);

		// Category Filter
		if($cat_ids!='')
			$this->categoryFilter($cat_ids);

		// Date filter
		if($start_date!='' && $end_date!='')
			$this->reportedDateFilter($start_date, $end_date);

		// Time Filter
		if(count($time_arr)!=0)
			$this->reportedTimeFilter($time_arr);

		$this->db->where('status', 'published');

		$this->db->from($this->table_name);
		//echo $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $query->result_array();
	}

	/** Get total incidents after filtering */
	public function getIncidentCounts($map_bounds, $city, $area, $cat_ids='', $start_date='', $end_date='', $time_arr = [], $lang_id=1, $client_id=1)
	{
		$this->db->where('client_id', $client_id);
		if($map_bounds!='') {
			// Rectangular Query
			$this->db->where('latitude >', (float) $map_bounds['sw']['lat']);
			$this->db->where('latitude <', (float) $map_bounds['ne']['lat']);
			$this->db->where('longitude >', (float) $map_bounds['sw']['lng']);
			$this->db->where('longitude <', (float) $map_bounds['ne']['lng']);
		}
		else if($area!='')
			$this->db->like('area', $area);
		else if($city!='')
			$this->db->like('city', $city);

		// Category Filter
		if($cat_ids!='')
			$this->categoryFilter($cat_ids);

		// Date filter
		if($start_date!='' && $end_date!='')
			$this->reportedDateFilter($start_date, $end_date);

		// Time Filter
		if(count($time_arr)!=0)
			$this->reportedTimeFilter($time_arr);

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
	public function getReports($map_bounds='', $city='', $area='', $cat_ids='', $start_date='', $end_date='', $time_arr = [], $lang_id=1, $client_id=1, $limit=100, $offset=0)
	{
		$this->getListingQueryBuilder($lang_id);

		// Filter the listings
		$this->db->where('client_id', $client_id);
		if($map_bounds!='') {
			// Rectangular Query
			$this->db->where('ir.latitude >', (float) $map_bounds['sw']['lat']);
			$this->db->where('ir.latitude <', (float) $map_bounds['ne']['lat']);
			$this->db->where('ir.longitude >', (float) $map_bounds['sw']['lng']);
			$this->db->where('ir.longitude <', (float) $map_bounds['ne']['lng']);
		}
		else if($area!='')
			$this->db->like('ir.area', $area);
		else if($city!='')
			$this->db->like('ir.city', $city);

		// Category Filter
		if($cat_ids!='')
			$this->categoryFilter($cat_ids);

		// Date filter
		if($start_date!='' && $end_date!='')
			$this->reportedDateFilter($start_date, $end_date);

		// Time Filter
		if(is_array(@$time_arr)){
			if(count(@$time_arr)!=0)
				$this->reportedTimeFilter($time_arr);
		}

		// Show only published incidents
		$this->db->where('ir.status', 'published');

		// Things after ir.id are just to fix "only_full_group_by" error
		$this->db->group_by(["ir.id", "ot.title", "ot1.title"]);
		$this->db->order_by('ir.date', 'desc');
		//if($map_bounds=='')
			$this->db->limit($limit, $offset);

		// Get SQL
		$subquery = $this->db->get_compiled_select();
		/*echo $subquery;
		exit;*/

		$this->db->reset_query();

		// Get SQL for records with details
		$SQL = $this->getAnswersSql($subquery, true, $lang_id);

		$query = $this->db->query($SQL);
		return $query->result_array();
	}

	private function getListingQueryBuilder($lang_id=1)
	{
		$this->db->select('ir.id, ir.status, ir.admin_id, ir.building, ir.landmark, ir.area, ir.city, ir.state, ir.country, ir.latitude, ir.longitude, ir.created_on, ir.description, ir.additional_detail, ir.age, ir.gender_id, COALESCE(ot.title, ot1.title) as gender, ir.date as incident_date, ir.is_date_estimate, ir.time_from, ir.time_to, ir.is_time_estimate, COALESCE(GROUP_CONCAT(ct.title), GROUP_CONCAT(ct1.title)) as categories');
		$this->db->from('incident_reports as ir');
		$this->db->join('option_translation as ot', 'ot.option_id=ir.gender_id AND ot.lang_id='.$lang_id, 'left');
		$this->db->join('option_translation as ot1', 'ot1.option_id=ir.gender_id AND ot1.is_default=1', 'left');
		// $this->db->join('categories_translation as ct', 'FIND_IN_SET(ct.category_id, ir.incident_category_ids) AND ct.lang_id='.$lang_id, 'left');
		// $this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=1', 'left');
		
		if($_COOKIE['country_id']==111){
			$this->db->join('categories_translation as ct', 'FIND_IN_SET(ct.category_id, ir.incident_category_ids) AND ct.country_id IS NOT NULL AND ct.lang_id='.$lang_id, 'left');
			$this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=0 AND ct1.country_id IS NOT NULL', 'left');
		}else{
			$this->db->join('categories_translation as ct', 'FIND_IN_SET(ct.category_id, ir.incident_category_ids) AND ct.country_id IS NULL AND ct.lang_id='.$lang_id, 'left');
			$this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=1 AND ct1.country_id IS NULL', 'left');
		}
		return $this->db;
	}

	private function getAnswersSql($subquery, $onlyBasicInfo=false, $lang_id=1)
	{
		$SQL = "SELECT incident.*, COALESCE(CONCAT(a.first_name, ' ', a.last_name), 'Anonymous') as posted_by, icd.id as detail_id, icd.question_tag, COALESCE(GROUP_CONCAT(ot.title), GROUP_CONCAT(ot1.title), icd.answer) as answer, icd.form_type, icd.question_type, icd.question_id, icd.answer_id, icd.answer_tag, icd.other_answers, COALESCE(qt.question, qt1.question) as question FROM ($subquery) as incident";
		$SQL .= " LEFT JOIN incident_details as icd ON icd.incident_id=incident.id";
		if($onlyBasicInfo) {
			$SQL .= "  AND icd.question_tag IN ('medical_help', 'reported_to_police', 'attack_reason', 'physically_hurt', 'who_was_perpetrator')";
		}

		// Get Questions
		$SQL .= " LEFT JOIN question_translation as qt ON qt.question_id=icd.question_id AND qt.lang_id=$lang_id";
		$SQL .= " LEFT JOIN question_translation as qt1 ON qt1.question_id=icd.question_id AND qt1.is_default=1";

		// Get Answers
		$SQL .= " LEFT JOIN option_translation as ot ON FIND_IN_SET(ot.option_id, icd.answer_id) AND ot.lang_id=$lang_id";
		$SQL .= " LEFT JOIN option_translation as ot1 ON FIND_IN_SET(ot1.option_id, icd.answer_id) AND ot1.is_default=1";
		$SQL .= " LEFT JOIN admins as a ON a.id=incident.admin_id";
		// Things after icd.question are just to fix "only_full_group_by" error
		$SQL .= " GROUP BY incident.id, icd.question, incident.gender, incident.categories, icd.question_tag, icd.form_type, icd.question_type, icd.question_id, qt.question, qt1.question, icd.answer_id, icd.answer_tag, icd.other_answers, icd.id";
		$SQL .= " ORDER BY incident.incident_date desc";
		return $SQL;
	}

	private function categoryFilter($cat_ids)
	{
		$cat_arr = explode(',', $cat_ids);
		$cat_query = '';
		foreach ($cat_arr as $cat_id) {
			if($cat_query=='')
				$cat_query .= "(FIND_IN_SET('".$cat_id."', incident_category_ids)";
			else
				$cat_query .= " OR FIND_IN_SET('".$cat_id."', incident_category_ids)";
		}
		return $this->db->where($cat_query.')');
	}

	private function reportedDateFilter($start_date, $end_date)
	{
		return $this->db->where("date BETWEEN '".$start_date."' AND '".$end_date."'");
	}

	private function reportedTimeFilter($time_arr=[])
	{
		if(count($time_arr)==0) return;

		$this->db->group_start();
		foreach ($time_arr as $time) {
			$start_time = $time['start_time'];
			$end_time   = $time['end_time'];
			$this->db->or_group_start()
					->where("time_from BETWEEN '".$start_time."' AND '".$end_time."'")
					->or_where("time_to BETWEEN '".$start_time."' AND '".$end_time."'")
					->group_end();
		}
		return $this->db->group_end();
	}

	/**
	 * Get Incident report detail
	 * @param  integer  $report_id
	 * @param  integer  $lang_id
	 * @return Array
	 */
	public function getDetailedReport($report_id, $lang_id=1)
	{
		// $this->getListingQueryBuilder($lang_id);
		// $this->db->where('ir.id', $report_id);
		// if($_SESSION['user_data']->company=='LANGUAGE'){
			// $this->db->where('ir.country', 'Jordan');
			// $this->db->where('ct.country_id', 111);
			// $this->db->where('ct1.country_id', 111);
		// }else{
			// $this->db->where('ct.country_id IS NULL');
			// $this->db->where('ct1.country_id IS NULL');
		// }
		// $this->db->group_by(["ir.id", "ot.title", "ot1.title"]);

		// // Get SQL
		// $subquery = $this->db->get_compiled_select();
		// $this->db->reset_query();

		// // Get SQL for records with details
		// $SQL = $this->getAnswersSql($subquery, false, $lang_id);

		// $query = $this->db->query($SQL);
		// return $query->result_array();
		
		
		$this->getListingQueryBuilder($lang_id);
		$this->db->where('ir.id', $report_id);
		$this->db->group_by(["ir.id", "ot.title", "ot1.title"]);

		// Get SQL
		$subquery = $this->db->get_compiled_select();
		$this->db->reset_query();

		// Get SQL for records with details
		$SQL = $this->getAnswersSql($subquery, false, $lang_id);

		$query = $this->db->query($SQL);
		return $query->result_array();
	}

	/**
	 * Get Incidents reported by specific user and has mobile visibility
	 * @param  integer $user_id
	 * @param  integer $lang_id
	 * @return Array
	 */
	public function getUserReports($user_id=1, $lang_id=1)
	{
		$this->getListingQueryBuilder($lang_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('is_mobile_visible', 1);

		// Show only published incidents
		$this->db->where('status', 'published');

		// Things after ir.id are just to fix "only_full_group_by" error
		$this->db->group_by(["ir.id", "ot.title", "ot1.title"]);

		// Get SQL
		$subquery = $this->db->get_compiled_select();
		$this->db->reset_query();

		// Get SQL for records with details
		$SQL = $this->getAnswersSql($subquery, true, $lang_id);
		$query = $this->db->query($SQL);
		return $query->result_array();
	}

	/**
	 * Hide Incident report for mobile visibility when requested by specific user
	 * @param  integer $report_id
	 * @param  integer $user_id
	 * @return Array
	 */
	public function unsetMobileVisibility($report_id, $user_id)
	{
		$this->db->where('id', $report_id);
		$this->db->where('user_id', $user_id);
		return $this->db->update($this->table_name, ['is_mobile_visible' => 0]);
	}

	/**
	 * Delete Incident report/s
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

	public function getStatusesCount($client_id=1)
	{
		$this->db->select("SUM(IF(status='pending_approval', 1, 0)) AS'pending_approval', SUM(IF(status='saved', 1, 0)) AS 'saved', SUM(IF(status='approved', 1, 0)) AS 'approved', SUM(IF(status='published', 1, 0)) AS 'published', SUM(IF(status='rejected', 1, 0)) AS 'rejected', SUM(IF(status='trashed', 1, 0)) AS 'trashed'");
		$this->db->where('client_id', $client_id);
		$this->db->where('country !=','Jordan');
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function getLanguageStatusesCount($client_id=1)
	{
		$this->db->select("SUM(IF(status='pending_approval', 1, 0)) AS'pending_approval', SUM(IF(status='saved', 1, 0)) AS 'saved', SUM(IF(status='approved', 1, 0)) AS 'approved', SUM(IF(status='published', 1, 0)) AS 'published', SUM(IF(status='rejected', 1, 0)) AS 'rejected', SUM(IF(status='trashed', 1, 0)) AS 'trashed'");
		$this->db->where('client_id', $client_id);
		$this->db->where('country', 'Jordan');
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function getLanguageDataTableResults($start=0, $length=10, $status='', $type='', $location='', $category='', $start_date='', $end_date='', $search='', $client_id=1)
	{
		// Get Total Count
		$total_count = $this->getLanguageTotalRecords($status, $client_id);

		// Get total count after filtering
		$this->dataLanguageTableQuery();
		$this->db->where('ir.client_id', $client_id);
		$this->db->where('ir.country', 'Jordan');
		$this->db->where('ct1.country_id', 111);
		$this->db->group_by("id");
		// Set filters
		$this->dataLanguageTableFilter($status, $type, $location, $category, $start_date, $end_date, $search);
		$filtered_records = $this->db->count_all_results();

		$this->dataLanguageTableQuery();
		$this->db->where('ir.client_id', $client_id);
		$this->db->where('ir.country', 'Jordan');
		$this->db->where('ct1.country_id', 111);
		// Set Filters
		$this->dataLanguageTableFilter($status, $type, $location, $category, $start_date, $end_date, $search);
		$this->db->group_by(["id"]);
		$this->db->order_by('created_on', 'desc');
		//$this->db->order_by('time_from', 'desc');

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
	 * Update Incident Report Statuses
	 * @param  integer/array  $incident_id
	 * @param  string 		  $status
	 * @return integer
	 */
	public function updateStatus($incident_id, $status, $client_id=1)
	{
		if(is_array($incident_id))
			$this->db->where_in('id', $incident_id);
		else
			$this->db->where('id', $incident_id);
		$this->db->where('client_id', $client_id);
		return $this->db->update($this->table_name, ['status' => $status]);
	}

	public function updateTotalForms($incident_id)
	{
		$this->db->set('total_forms', 'total_forms+1', FALSE);
		$this->db->where('id', $incident_id);
		return $this->db->update($this->table_name);
	}

	public function getTotalRecords($status='', $client_id=1)
	{
		$this->db->where('status', $status);
		$this->db->where('client_id', $client_id);
		return $this->db->count_all_results($this->table_name);
	}

	/** DataTables */

	public function dataTableQuery()
	{
		$this->db->select('ir.*, GROUP_CONCAT(ct1.title SEPARATOR " | ") as categories, COALESCE(CONCAT(a.first_name, " ", a.last_name), "Anonymous") as posted_by');
		$this->db->from('incident_reports as ir');
		// $this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=1', 'left');
		$this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.lang_id = ir.lang_id AND ct1.country_id IS NULL', 'left');
		$this->db->join('admins as a', 'a.id=ir.admin_id', 'left');
		return $this->db;
	}
	
	public function getVolunteerCount(){
		$this->db->select('ir.id, ir.status, ir.incident_category_ids, ir.age, ir.description, ir.date, ir.is_date_estimate, ir.time_from, ir.time_to, ir.is_time_estimate, ir.building, ir.landmark, ir.area, ir.city, ir.state, ir.country, ir.latitude, ir.longitude, icd.answer_id, icd.question_id, icd.question_tag, icd.answer_json');
		$this->db->from($this->table_name.' as ir');
		$this->db->join('incident_details as icd', 'icd.incident_id=ir.id', 'left');
		 
		$this->db->where('icd.answer_id', '153');
		$this->db->group_by('ir.id, icd.id');
		$this->db->order_by('ir.id', 'desc');
		
		$countquery = $this->db->get();
		return $total_count = count($countquery->result_array());
	}
	
	public function getVolunteerDataTableResults($start=0, $length=10, $category='', $client_id=1)
	{
		$total_count =  $this->getVolunteerCount();
	
		$this->db->select('ir.id, ir.status, ir.incident_category_ids, ir.age, ir.description, ir.date, ir.is_date_estimate, ir.time_from, ir.time_to, ir.is_time_estimate, ir.building, ir.landmark, ir.area, ir.city, ir.state, ir.country, ir.latitude, ir.longitude, GROUP_CONCAT(ct1.title SEPARATOR " | ") as categories, icd.answer_id, icd.question_id, icd.question_tag, icd.answer_json');
		$this->db->from($this->table_name.' as ir');
		$this->db->join('incident_details as icd', 'icd.incident_id=ir.id', 'left');
		 $this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=1', 'left');
		$this->db->where('icd.answer_id', '153');
		$this->db->group_by('ir.id, icd.id');
		$this->db->order_by('ir.id', 'desc');
		
		// $query = $this->db->get();
		// $query->result_array();
		
		// $this->db->where('status', $status);
		// $this->db->where('client_id', $client_id);
		
	
		// $total_count = $this->getTotalRecords($status, $client_id);

		// Get total count after filtering
		// $this->dataTableQuery();
		// $this->db->where('ir.client_id', $client_id);
		// $this->db->where('ct1.country_id IS NULL ');
		// $this->db->group_by("id");
		// // Set filters
		// $this->dataTableFilter($status, $type, $location, $category, $start_date, $end_date, $search);
		// $filtered_records = $this->db->count_all_results();

		// $this->dataTableQuery();
		// $this->db->where('ir.client_id', $client_id);
		// $this->db->where('ct1.country_id IS NULL ');
		// // Set Filters
		// $this->dataTableFilter($status, $type, $location, $category, $start_date, $end_date, $search);
		// $this->db->group_by(["id"]);
		// $this->db->order_by('created_on', 'desc');
		// //$this->db->order_by('time_from', 'desc');
		
		
		// // Get limited records
		// $this->db->limit($length, $start);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		$results = $query->result_array();
		return [
			'total_records' 	=> $total_count,
			// 'filtered_records'  => $filtered_records,
			'results' 			=> $results,
		];
	}

	public function dataTableFilter($status='', $type='', $location='', $category='', $start_date='', $end_date='', $search='')
	{
		if($status!='')
			$this->db->where('status', $status);
		if($type!='')
			$this->db->where('total_forms', $type);
		if($location!='')
			$this->db->like('city', $location, 'both');
		if($category!='')
			$this->db->where('FIND_IN_SET(incident_category_ids, '.$category.')');
		if($start_date!='')
			$this->db->where('date >=', $start_date);
		if($end_date!='')
			$this->db->where('date <=', $end_date);
		if($search!='') {
			$this->db->group_start();
			$this->db->like('description', $search);
			$this->db->or_like('ir.id', $search);
			$this->db->or_like('date', $search);
			$this->db->or_like('additional_detail', $search);
			$this->db->or_like('ct1.title', $search);
			$this->db->or_like('a.first_name', $search);
			$this->db->or_like('a.last_name', $search);
			// Search for Addreses
			$this->db->or_like('building', $search);
			$this->db->or_like('landmark', $search);
			$this->db->or_like('area', $search);
			$this->db->or_like('city', $search);
			$this->db->or_like('state', $search);
			$this->db->or_like('country', $search);
			$this->db->group_end();
		}

	}

	public function getDataTableResults($start=0, $length=10, $status='', $type='', $location='', $category='', $start_date='', $end_date='', $search='', $client_id=1)
	{
		// Get Total Count
		$total_count = $this->getTotalRecords($status, $client_id);

		// Get total count after filtering
		$this->dataTableQuery();
		$this->db->where('ir.client_id', $client_id);
		$this->db->where('ct1.country_id IS NULL ');
		$this->db->group_by("id");
		// Set filters
		$this->dataTableFilter($status, $type, $location, $category, $start_date, $end_date, $search);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		$this->db->where('ir.client_id', $client_id);
		$this->db->where('ir.country !=', 'Jordan');
		//$this->db->where('ct1.country_id IS NULL ');
		// Set Filters
		$this->dataTableFilter($status, $type, $location, $category, $start_date, $end_date, $search);
		$this->db->group_by(["id"]);
		$this->db->order_by('created_on', 'desc');
		//$this->db->order_by('time_from', 'desc');

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

	public function export($start=0, $length=10, $status='', $start_date='', $end_date='')
	{
		// Get Total Count
		$total_count = $this->getTotalRecordsExport($status);

		// Get total count after filtering
		$this->dataTableQuery();
		$this->db->group_by("id");
		// Set filters
		$this->exportFilter($status, $start_date, $end_date);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		// Set Filters
		$this->exportFilter($status, $start_date, $end_date);
		$this->db->group_by(["id"]);
		$this->db->order_by('created_on', 'desc');
		//$this->db->order_by('time_from', 'desc');

		// Get limited records
		$this->db->limit($length, $start);
		$query = $this->db->get();
		$results = $query->result_array();
		return [
			'total_records' 	=> $total_count,
			'filtered_records'  => $filtered_records,
			'results' 			=> $results,
		];
	}

	public function getTotalRecordsExport($status='')
	{
		if($status!='') {
			if(is_array($status))
				$this->db->where_in('status', $status);
			else
				$this->db->where('status', $status);
		}
		return $this->db->count_all_results($this->table_name);
	}

	public function exportFilter($status='', $start_date='', $end_date='')
	{
		if($status!='') {
			if(is_array($status))
				$this->db->where_in('status', $status);
			else
				$this->db->where('status', $status);
		}
		if($start_date!='')
			$this->db->where('date >=', $start_date);
		if($end_date!='')
			$this->db->where('date <=', $end_date);
	}

	public function fetchResultByIds($id_arr)
	{
		$this->dataTableQuery();
		if(is_array($id_arr))
				$this->db->where_in('ir.id', $id_arr);
			else
				$this->db->where('ir.id', $id_arr);
	    $this->db->group_by(["id"]);
		$this->db->order_by('created_on', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getNgoData($ngo_id, $from_date, $to_date)
	{
		$this->db->select('ir.id, ir.status, ir.incident_category_ids, ir.age, ir.description, ir.date, ir.is_date_estimate, ir.time_from, ir.time_to, ir.is_time_estimate, ir.building, ir.landmark, ir.area, ir.city, ir.state, ir.country, ir.latitude, ir.longitude, icd.answer_id, icd.question_id, icd.question_tag, qt.question, GROUP_CONCAT(ot.title SEPARATOR " | ") as answer');
		$this->db->from($this->table_name.' as ir');
		$this->db->join('incident_details as icd', 'icd.incident_id=ir.id', 'left');
		$this->db->join('option_translation as ot', 'FIND_IN_SET(ot.option_id, icd.answer_id) AND ot.lang_id=1', 'left');
		$this->db->join('question_translation as qt', 'qt.question_id=icd.question_id AND qt.lang_id=1', 'left');
		$this->db->where('ir.created_on >=', $from_date);
		$this->db->where('ir.created_on <=', $to_date);
		$this->db->where('ir.ngo_id', $ngo_id);
		$this->db->group_by('ir.id, icd.id');
		//$this->db->limit(200);
		$this->db->order_by('ir.id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getLanguageTotalRecords($status='', $client_id=1)
	{
		$this->db->where('status', $status);
		$this->db->where('client_id', $client_id);
		$this->db->where('country', 'Jordan');
		return $this->db->count_all_results($this->table_name);
	}
	
	
	public function dataLanguageTableQuery()
	{
		$this->db->select('ir.*, GROUP_CONCAT(ct1.title SEPARATOR " | ") as categories, COALESCE(CONCAT(a.first_name, " ", a.last_name), "Anonymous") as posted_by');
		$this->db->from('incident_reports as ir');
		// $this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=1', 'left');
		$this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.lang_id = ir.lang_id AND ct1.country_id IS NOT NULL', 'left');
		$this->db->join('admins as a', 'a.id=ir.admin_id', 'left');
		return $this->db;
	}
	
	public function dataLanguageTableFilter($status='', $type='', $location='', $category='', $start_date='', $end_date='', $search='')
	{
		if($status!='')
			$this->db->where('status', $status);
		if($type!='')
			$this->db->where('total_forms', $type);
		if($location!='')
			$this->db->like('city', $location, 'both');
		if($category!='')
			$this->db->where('FIND_IN_SET(incident_category_ids, '.$category.')');
		if($start_date!='')
			$this->db->where('date >=', $start_date);
		if($end_date!='')
			$this->db->where('date <=', $end_date);
		if($search!='') {
			$this->db->group_start();
			$this->db->like('description', $search);
			$this->db->or_like('ir.id', $search);
			$this->db->or_like('date', $search);
			$this->db->or_like('additional_detail', $search);
			$this->db->or_like('ct1.title', $search);
			$this->db->or_like('a.first_name', $search);
			$this->db->or_like('a.last_name', $search);
			// Search for Addreses
			$this->db->or_like('building', $search);
			$this->db->or_like('landmark', $search);
			$this->db->or_like('area', $search);
			$this->db->or_like('city', $search);
			$this->db->or_like('state', $search);
			$this->db->or_like('country', $search);
			$this->db->group_end();
		}

	}

	// public function get_category_ids($category_ids,$lang_id=1)
	// {
	// 	$this->db->select('GROUP_CONCAT(category_id SEPARATOR " , ") as categories');
	// 	$this->db->from('categories_translation');
	// 	$this->db->where('lang_id', $lang_id);
	// 	$this->db->where_in('title', $category_ids);
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }
}