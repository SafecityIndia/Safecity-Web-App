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

class Common_controller extends REST_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['commonquery']);
		$this->load->model('emergency_helpline_model');
	}

	
	/* [ Start : 25-07-2020 ] Create an function for language list */
	public function languagesList_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='07b337e9971f28d49c9c4b0449ea071131f4a3b6')
        {

			# Get language data from laguage table
			//$lang_arr = $this->commonquery->getRecordFromTable('languages', array('id', 'name'), '', '', 'name');

        	// Updated by Alok (21-Nov-2020)
			$this->db->select('l.*');
			$this->db->from('languages as l');
			$this->db->join('client_languages as cl', 'cl.language_id=l.id');
			$this->db->where('cl.client_id', 1);
			$this->db->order_by('name');
			$query = $this->db->get();
			$lang_arr = $query->result_array();
				
			$lang_list_data = array();

			if(!empty($lang_arr)){

				foreach($lang_arr as $lang_list){

	                $lang_list_data[] = array(
	                    'id'            => $lang_list['id'],
	                    'name'         => $lang_list['name']
	                );

				}
					
				$response_data = array(
					'status' => true,
					'message' => 'language list',
					'data' => $lang_list_data
				);

			}else{
				$response_data = array(
					'status' => false,
					'message' => 'No record found'
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

	/* [ End : 25-07-2020 ] Create an function for language list */

	/* [ Start : 25-07-2020 ] Create an function for country list */
	public function countryList_post()
	{	
		$received_data = json_decode(file_get_contents('php://input'), true);		
        
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}
		$security_key = $this->input->post('security_key');
               
		if($security_key=='2be6704a76b7a502e2e56dd371228f2ad1d8afcc')
        {
 
			# Get country data from countries table
			$country_arr = $this->commonquery->getRecordFromTable('countries', array('id', 'name','ngo_id'),'','','');
				
			$country_list_data = array();

			if(!empty($country_arr)){

				foreach($country_arr as $country_list){

	                $country_list_data[] = array(
	                    'country_id'    => $country_list['id'],
	                    'country_name'  => $country_list['name'],
                            'ngo_id'        => $country_list['ngo_id']
	                );

				}
					
				$response_data = array(
					'status' => true,
					'message' => 'country list',
					'data' => $country_list_data
				);

			}else{
				$response_data = array(
					'status' => false,
					'message' => 'No record found'
				);
			}

			$this->response($response_data, 200 );
		}
		else
		{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}
	}

	/* [ End : 25-07-2020 ] Create an function for language list */

	/* [ Start : 31-07-2020 ] Create an function for emergency helpline list */
	public function emergencyHelpList_post()
	{	
		$received_data = json_decode(file_get_contents('php://input'), true);		
        
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}
		$security_key = $this->input->post('security_key');
		if($security_key=='99402b5fff8f2a45890fb8bf6de094ee00a210ce')
        {
 			$this->form_validation->set_rules('country_id', 'Country', 'required');
 			//$this->form_validation->set_rules('city_id', 'City', 'required');
 			$this->form_validation->set_rules('lang_id', 'Language', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				# Get emergency helpline no data from emergency_helpline table
				//$emergency_arr = $this->commonquery->getRecordFromTable('emergency_helpline', array('emergency_title', 'emergency_no'), array('country_id' => $this->input->post('country_id'),'lang_id' => $this->input->post('lang_id')),'','');

				$country_id = $this->input->post('country_id');
				$city_id = $this->input->post('city_id')??null;
				$lang_id    = $this->input->post('lang_id');

				$emergency_arr = $this->emergency_helpline_model->getHelplineNbr_help($country_id, $city_id, $lang_id);
					
				$helpline_list_data = array();

				if(!empty($emergency_arr)){

					foreach($emergency_arr as $get_data){

		                $helpline_list_data[] = array(
		                    'emergency_title'	=> $get_data['emergency_title'],
		                    'emergency_no'		=> $get_data['emergency_no']
		                );

					}
						
					$response_data = array(
						'status' => true,
						'message' => 'emergency helpline no list',
						'data' => $helpline_list_data
					);

				}else{
					$response_data = array(
						'status' => false,
						'message' => 'No record found'
					);
				}
			}

			$this->response($response_data, 200 );
		}
		else
		{
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}
	}

	/* [ End : 31-07-2020 ] Create an function for emergency helpline list */

}