<?php

 /*
Author : Dinesh Patil
Created Date : 11-01-2020
*/

/*header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;*/

if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

date_default_timezone_set('Asia/Kolkata');

class User extends REST_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['commonquery']);
	}
	
	/* [ Start : 25-07-2020 ] Create an function for Registration / modified on 17-09-2020 */
	public function userRegistration_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='80b9d8f6dc4beeebd22ba44af9f247eadf13170b')
        {
			$this->form_validation->set_rules('country_id', 'Country', 'required');
			$this->form_validation->set_rules('language_id', 'Language', 'required');
			$this->form_validation->set_rules('city_id', 'City', 'required');
			$this->form_validation->set_rules('organisation_id', 'Organisation', 'required');
			$this->form_validation->set_rules('age', 'Age', 'required');

			
			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				if($this->input->post('age') == 1 || $this->input->post('age') > 0){
					$user_post_data = array(

						'country_id' 	=> $this->input->post('country_id'),
						'language_id' 	=> $this->input->post('language_id'),
						'city_id' 	=> $this->input->post('city_id'),
						'organisation_id' 	=> $this->input->post('organisation_id'),
						'age' 			=> "1",
						'created_date' 	=> date('Y-m-d H:i:s')

					);

					$user_id = $this->commonquery->addRecord('user', $user_post_data);

					$response_data 	= array(
						'status' 	=> true,
						'message' 	=> 'Registration successfully',
						'data'		=> array('id'=> $user_id)
					);
				}else{
					$response_data 	= array(
						'status' 	=> false,
						'message' 	=> 'You must be 18 years old or above'
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
	/* [ End : 25-07-2020 ] Create an function for Registration / modified on 17-09-2020*/

	
	/* [ Start : 17-09-2020 ] Create an function for Cities */
	public function getCities_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='b0e886281185cfc68a2c119f04c5b7b105f632dd')
        {
			$this->form_validation->set_rules('country_id', 'Country', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				$cities_arr = $this->commonquery->getRecordFromTable('cities', array('*', 'name as city_name'), array('country_id' => $this->input->post('country_id')), '', 'name ASC');
				if(!empty($cities_arr)){
					$response_data = array(
						'status' => true,
						'message' => 'City List',
						'data' => $cities_arr
					);
				}else{
					$response_data = array(
						'status' => false,
						'message' => 'Data not found'
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
	/* [ End : 17-09-2020 ] Create an function for Cities*/


	
	/* [ Start : 17-09-2020 ] Create an function for Cities */
	public function getOrganisations_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='b571bb06f3e196ce95f08c70324b9dd5b2d334c5')
        {
			$this->form_validation->set_rules('country_id', 'Country', 'required');
			$this->form_validation->set_rules('city_id', 'Country', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				$org_arr = $this->commonquery->getRecordFromTable('organisations', array('*'), array('country_id' => $this->input->post('country_id'), 'city_id' => $this->input->post('city_id')), '', 'name ASC');
				if(!empty($org_arr)){
					$response_data = array(
						'status' => true,
						'message' => 'Organisations List',
						'data' => $org_arr
					);
				}else{
					$response_data = array(
						'status' => false,
						'message' => 'Data not found'
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
	/* [ End : 17-09-2020 ] Create an function for Cities*/

	

}