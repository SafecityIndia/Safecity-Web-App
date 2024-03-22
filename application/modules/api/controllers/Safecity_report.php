<?php

/*
Author : Dinesh Patil
Created Date : 28-07-2020
*/

header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Safecity_report extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['commonquery']);
	}


	/* [ Start : 28-07-2020 ] Create an function for get safety tips list */
	public function getSafetyTipsList_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='f37bb11eea4742fcc5ad46ba33b0e0d4eea4350d')
		{
			$this->form_validation->set_rules('user_id', 'User Id', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);
			}else{

				# Get safety tips data from safety_tips_report table
				$safety_tips_arr = $this->commonquery->getRecordFromTable('safety_tips_report', array('id', 'safety_tip_title', 'safety_tip_desc', 'location', 'exact_location', 'added_date'), array('status' => '1', 'user_id' => $this->input->post('user_id')), '', 'added_date DESC');

				if(!empty($safety_tips_arr)){

					foreach ($safety_tips_arr as $get_data) {

						$time_show = $this->commonquery-> humanTiming(strtotime($get_data['added_date']));

						$safety_tips_data[] = array(

							'id' 				=> $get_data['id'],
							'safety_tip_title' 	=> $get_data['safety_tip_title'],
							'safety_tip_desc' 	=> (strlen($get_data['safety_tip_desc']) > '140') ? substr($get_data['safety_tip_desc'],0,140)."...": $get_data['safety_tip_desc'],
							'location' 			=> (!empty($get_data['location']) ? $get_data['location'] : $get_data['exact_location']),
							'added_date' 		=> $time_show,

						);

					}

					$response_data = array(
						'status' => true,
						'message' => 'user safety tips list',
						'data' => (!empty($safety_tips_data) ? $safety_tips_data : '')
					);
				}else{
					$response_data = array(
						'status' => false,
						'message' => 'no record found'
					);

				}
			}
			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}
	}

	/* [ End : 25-07-2020 ] Create an function for Content */

	/* [ Start : 28-07-2020 ] Create an function for add safety tips */
	public function writeSafetyTips_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');

		if($security_key=='d659f8e1043f236a54e442f6b17661e95c2eecb4')
		{
			$this->form_validation->set_rules('client_id', 'Client Id', 'required');
			$this->form_validation->set_rules('country_id', 'Country Id', 'required');
			$this->form_validation->set_rules('language_id', 'Languate Id', 'required');
			$this->form_validation->set_rules('user_id', 'User Id', 'required');
			// $this->form_validation->set_rules('report_type', 'Report Type', 'required');
			//$this->form_validation->set_rules('location', 'Location', 'required');
			//$this->form_validation->set_rules('landmark', 'Landmark', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			//$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('exact_location', 'Exact Location', 'required');
			$this->form_validation->set_rules('map_lat', 'Latitude', 'required');
			$this->form_validation->set_rules('map_lon', 'Longitude', 'required');
			$this->form_validation->set_rules('safety_tip_title', 'Title', 'required');
			$this->form_validation->set_rules('safety_tip_desc', 'Description', 'required');


			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				$is_mobile_visible = (empty($this->input->post('identification')) || $this->input->post('identification') != 'Webapp' ? 1 : '');
				$post_data = array(

					'user_id' 			=> $this->input->post('user_id'),

					//added by sonam - 27-08-2020
					'identification' 	=> (!empty($this->input->post('identification')) ? $this->input->post('identification') : 'Mobile'), 
					'country_id' 	=> (!empty($this->input->post('country_id')) ? $this->input->post('country_id') : ''), 
					'language_id' 	=> (!empty($this->input->post('language_id')) ? $this->input->post('language_id') : ''),
					'client_id' 	=> (!empty($this->input->post('client_id')) ? $this->input->post('client_id') : ''),
					'location_city_state' 	=> ($this->input->post('location').' '.$this->input->post('city').' '.$this->input->post('state')), 
					//added by sonam - 27-08-2020

					'location' 			=> $this->input->post('location')??'',
					'landmark' 			=> $this->input->post('landmark')??'',
					'city' 				=> ucfirst($this->input->post('city')??''),
					'state' 			=> ucfirst($this->input->post('state')??''),
					'country' 			=> ucfirst($this->input->post('country')??''),
					'exact_location' 	=> $this->input->post('exact_location')??'',
					'map_lat' 			=> $this->input->post('map_lat'),
					'map_lon' 			=> $this->input->post('map_lon'),
					'safety_tip_title' 	=> $this->input->post('safety_tip_title'),
					'safety_tip_desc' 	=> $this->input->post('safety_tip_desc'),
					'is_mobile_visible' => $is_mobile_visible,
					'added_date' 		=> date('Y-m-d H:i:s')

				);

				$this->commonquery->addRecord('safety_tips_report', $post_data);
				
				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Thank you for submitting a safety tip. You are helping us build safer cities'
				);
			}

			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}

	}

	/* [ End : 28-07-2020 ] Create an function for add safety tips */

	/* [ Start : 28-07-2020 ] Create an function for update safety tips */
	public function editSafetyTips_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');

		if($security_key=='1eafff14a417cb2230a07b15ee57b682451d9147')
		{
			// $this->form_validation->set_rules('country_id', 'Country Id', 'required');
			// $this->form_validation->set_rules('language_id', 'Languate Id', 'required');
			$this->form_validation->set_rules('user_id', 'User Id', 'required');
			$this->form_validation->set_rules('id', 'Safety Tip Id', 'required');
			$this->form_validation->set_rules('report_type', 'Report Type', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('landmark', 'Landmark', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('exact_location', 'Exact Location', 'required');
			$this->form_validation->set_rules('safety_tip_title', 'Title', 'required');
			$this->form_validation->set_rules('safety_tip_desc', 'Description', 'required');


			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				$post_data = array(

					'user_id' 			=> $this->input->post('user_id'),

					//added by sonam - 27-08-2020
					'identification' 	=> (!empty($this->input->post('identification')) ? $this->input->post('identification') : 'Android'), 
					'country_id' 	=> (!empty($this->input->post('country_id')) ? $this->input->post('country_id') : ''), 
					'language_id' 	=> (!empty($this->input->post('language_id')) ? $this->input->post('language_id') : ''),
					'location_city_state' 	=> ($this->input->post('location').' '.$this->input->post('city').' '.$this->input->post('state')), 
					//added by sonam - 27-08-2020
					
					'location' 			=> $this->input->post('location'),
					'landmark' 			=> $this->input->post('landmark'),
					'city' 				=> ucfirst($this->input->post('city')),
					'state' 			=> ucfirst($this->input->post('state')),
					'country' 			=> ucfirst($this->input->post('country')),
					'exact_location' 	=> $this->input->post('exact_location'),
					'safety_tip_title' 	=> $this->input->post('safety_tip_title'),
					'safety_tip_desc' 	=> $this->input->post('safety_tip_desc'),
					'report_type' 		=> $this->input->post('report_type'),
					'updated_date' 		=> date('Y-m-d H:i:s')

				);

				$this->commonquery->updateRecord('safety_tips_report', $post_data, array('id' => $this->input->post('id')));

				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Edit Safety Tips'
				);
			}

			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}

	}

	/* [ End : 28-07-2020 ] Create an function for update safety tips */

	/* [ Start : 28-07-2020 ] Create an function for delete safety tips */
	public function deleteSafetyTips_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');

		if($security_key=='071f26375758d3f3560a1b0691941ff62ae29acd')
		{
			$this->form_validation->set_rules('id', 'Safety Tip Id', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				$post_data = array(

					'status' 			=> '2'

				);

				$this->commonquery->updateRecord('safety_tips_report', $post_data, array('id' => $this->input->post('id')));

				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Delete Safety Tips'
				);
			}

			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}

	}

	/* [ End : 28-07-2020 ] Create an function for delete safety tips */


	/* [ Start : 28-07-2020 ] Create an function for get safety tips by id */
	public function getSafetyTipsById_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');

		if($security_key=='2e2da14d4af021cd267cd61de81b2260628f8cb4')
		{
			$this->form_validation->set_rules('id', 'Safety Tip Id', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
			
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{

				# Get safety tips data from safety_tips_report table
				$return_arr = [];
				$safety_tip_arr = $this->commonquery->getIdByParameter('safety_tips_report', array('*'), array('id' => $this->input->post('id')));
				if(!empty($safety_tip_arr)){
					$time_show = $this->commonquery->humanTiming(strtotime($safety_tip_arr['added_date']));
					$return_arr['data'] = $safety_tip_arr;
					$return_arr['data']['added_date'] = $time_show;
				}
			
				/*$return_arr[$key]['date_estimate'] = (!empty($value['date_estimate']) && $value['date_estimate']  == '1') ? 'Yes' : 'No';
				$return_arr[$key]['time_estimate'] = (!empty($value['time_estimate']) && $value['time_estimate'] == '1') ? 'Yes' : 'No';*/


				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Get Safety Tips',
					'data'		=> (!empty($return_arr['data']) ? $return_arr['data'] : '')
				);
			}

			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}

	}

	/* [ End : 28-07-2020 ] Create an function for get safety tips by id */

	/* [ Start : 11-08-2020 ] Create an function for get all safety tips */
	public function getAllSafetyTips_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');

		if($security_key=='c86c38648cf225ad895f634c3dc922d09e1ca27a')
		{
			//$this->form_validation->set_rules('id', 'Safety Tip Id', 'required');

			
				# Get safety tips data from safety_tips_report table
				$safety_tip_arr = $this->commonquery->getRecordFromTable('safety_tips_report', array('id', 'safety_tip_title', 'safety_tip_desc', 'location', 'landmark', 'city', 'state', 'country', 'exact_location', 'added_date'), array('status' => '1'),'','');
				// echo "<pre>";
				// print_r($safety_tip_arr);
				if(!empty($safety_tip_arr))
				{
					$tips_arr =[];
				// exit;
				foreach ($safety_tip_arr as $get_data) {

						$time_show = $this->commonquery-> humanTiming(strtotime($get_data['added_date']));

						$tips_arr[] = array(

							'id' 				=> $get_data['id'],
							'safety_tip_title' 				=> $get_data['safety_tip_title'],
							'safety_tip_desc' 	=> (strlen($get_data['safety_tip_desc']) > '140') ? substr($get_data['safety_tip_desc'],0,140)."...": $get_data['safety_tip_desc'],
							'location' 			=> (!empty($get_data['location']) ? $get_data['location'] :''),
							'landmark' 				=> $get_data['landmark'],
							'country' 				=> $get_data['country'],
							'city' 					=> $get_data['city'],
							'state' 				=> $get_data['state'],
							'exact_location' 		=> $get_data['exact_location'],
							'added_date' 		    => $time_show,

						);

					}

				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Get Safety Tips',
					'data'		=> (!empty($tips_arr) ? $tips_arr : ''),

				);
			
			$this->response($response_data, 200 );
		}
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}

	}
	/* [ End : 11-08-2020 ] Create an function for get all safety  tips */


	/* [ Start : 19-08-2020 ] Create an function for get safety tips report by user_id */
	public function getSafetyTipsReportByUserId_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');

		if($security_key=='89d22d02f34bae184422a71fc3296faf83ba2838')
		{
			$this->form_validation->set_rules('user_id', 'Safety Tips User Id', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
			
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{

				# Get incident report data from incident_report table
				$incident_report_arr = $this->commonquery->getRecordsByUserID('safety_tips_report', array('*'), array('user_id' => $this->input->post('user_id')));
				// $incident_report_arr['date_estimate'] = ($incident_report_arr['date_estimate'] == '1') ? 'Yes' : 'No';
				// $incident_report_arr['time_estimate'] = ($incident_report_arr['time_estimate'] == '1') ? 'Yes' : 'No';
				$incident_report_arr['date_estimate'] = (isset($incident_report_arr['date_estimate']) && !empty($incident_report_arr['date_estimate']) && $incident_report_arr['date_estimate'] == 1) ? 'Yes' : 'No';
				$incident_report_arr['time_estimate'] = (isset($incident_report_arr['time_estimate']) && !empty($incident_report_arr['time_estimate']) && $incident_report_arr['time_estimate'] == 1) ? 'Yes' : 'No';
				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Get Safety Tips Report',
					'data'		=> (!empty($incident_report_arr) ? $incident_report_arr : '')
				);
			}

			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}
	}
	/* [ End : 19-08-2020 ] Create an function for get safety tips report by user_id */


	/* [ Start : 22-08-2020 ] Create an function for get incident report by id */
	public function searchSafetyTips_post()
	{

		// echo "<pre>";
		$return_arr=[];
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}
		// print_r($_POST);
		// exit;

		$security_key = $this->input->post('security_key');

		if($security_key=='5c93e42352c3f75b5eb7d0b0441bb79612aa4004')
		{
			$this->form_validation->set_rules('inc_loc', 'Incident Location', 'required');
			

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{

				# Get incident report data from incident_report table
				$volArr = [];
				$ftype = $this->input->post('inc_loc');
            	$explode_type = explode(',', $ftype);
            	foreach ($explode_type as $key1 => $value1) {
	                $volArr[] = 'location_city_state like "%'.$value1.'%"';
	            }
	            $ftypeStr = implode(' OR ', $volArr);

				// $safety_report_arr = $this->commonquery->searchByParameters('safety_tips_report', array('*'), array('status' => '1'), array('location' => $this->input->post('inc_loc')));
				$safety_report_arr = $this->commonquery->searchByWhereInParameters('safety_tips_report',$ftypeStr);
				if(!empty($safety_report_arr))
				{
					foreach ($safety_report_arr as $key => $value) {
						$time_show = $this->commonquery->humanTiming(strtotime($value['added_date']));
						$return_arr[$key] = $value;
						$return_arr[$key]['added_date'] = $time_show;
					
						/*$return_arr[$key]['date_estimate'] = (!empty($value['date_estimate']) && $value['date_estimate']  == '1') ? 'Yes' : 'No';
						$return_arr[$key]['time_estimate'] = (!empty($value['time_estimate']) && $value['time_estimate'] == '1') ? 'Yes' : 'No';*/

					}
				} else {
					$safety_report_arr = [];
				}
				
				$response_data 	= array(
					'status' 	=> true,
					'message' 	=> 'Search Safety Tip Report',
					'data'		=> (!empty($return_arr) ? $return_arr : '')
				);
			}

			$this->response($response_data, 200 );
		}else{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}

	}
	/* [ End : 12-08-2020 ] Create an function for get incident report by id */
}