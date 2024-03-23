<?php
/*header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

use chriskacerguis\RestServer\RestController;*/

if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

date_default_timezone_set('Asia/Kolkata');

class Faq extends REST_Controller {
//class Faq extends RestController {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['commonquery']);
		$this->load->model('menu/menu_model');
		$this->load->model('emergency_helpline_model');
		$this->load->model('legal_ipc_model');
	}

	/* [ Start : 24-08-2020 ] Create an function for get faq list */
	public function getFaqList_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='bfa10fab2a9ed2e54f245c3c65a7dd7221c6850c')
		{
			$this->form_validation->set_rules('client_id', 'Client Id', 'required');
			$this->form_validation->set_rules('language_id', 'Language Id', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);
			}
			else
			{
				$faq_arr = $this->commonquery->getRecordFromTable('faq_list', array('*'), array('language_id' => $this->input->post('language_id'), 'client_id' => $this->input->post('client_id')), '', 'added_date DESC');
				if(!empty($faq_arr)){
					$response_data = array(
						'status' => true,
						'message' => 'FAQ List',
						'data' => $faq_arr
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

	/* [ End : 24-08-2020 ] Create an function for faq list */


	/* [ Start : 10-09-2020 ] Create an function for get incident report list */
	public function getLegalIPC_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='32ab49c2d09216b9d6f97097ada40951655b2d79')
		{
			$this->form_validation->set_rules('country_id', 'Country Id', 'required');
			$this->form_validation->set_rules('language_id', 'Language Id', 'required');
			$this->form_validation->set_rules('category', 'Category', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);
			}
			else
			{
				$landr_arr = $this->commonquery->getRecordFromTable('legal_ipc', array('*'), array('country_id' => $this->input->post('country_id'), 'language_id' => $this->input->post('language_id'), 'category' => trim($this->input->post('category'))), '', 'added_date DESC');
				if(!empty($landr_arr)){
					$response_data = array(
						'status' => true,
						'message' => 'Legal & resources List',
						'data' => json_decode($landr_arr[0]['legal_desc'],true)
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
	/* [ End : 10-09-2020 ] Create an function for incident report list */


	/* [ Start : 14-09-2020 ] Create an function for get incident report list */
	public function getLegalFIR_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='09aa6739b6c86b4acbf32aba659a52f9220faaf5')
		{
			$this->form_validation->set_rules('country_id', 'Country Id', 'required');
			$this->form_validation->set_rules('language_id', 'Language Id', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);
			}
			else
			{
				$returnArr = [];
				$landr_arr = $this->commonquery->getRecordFromTable('legal_FIR', array('*'), array('country_id' => $this->input->post('country_id'), 'language_id' => $this->input->post('language_id')), '', 'added_date ASC');
				if(!empty($landr_arr)){
					foreach ($landr_arr as $key => $value) {
						$returnArr[$key]['id'] = $value['id'];
						$returnArr[$key]['country_id'] = $value['country_id'];
						$returnArr[$key]['language_id'] = $value['language_id'];
						$returnArr[$key]['fir_desc'] = json_decode($value['fir_desc'],true);
						$returnArr[$key]['added_date'] = $value['added_date'];
						$returnArr[$key]['updated_date'] = $value['updated_date'];
					}
					$response_data = array(
						'status' => true,
						'message' => 'Legal FIR List',
						'data' => $returnArr
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
	/* [ End : 14-09-2020 ] Create an function for incident report list */


	/* [ Start : 18-09-2020 ] Create an function for get faq list */

	public function getClientResourceList_post()
	{
		$this->form_validation->set_rules('client_id', 'Client Id', 'required');
		$this->form_validation->set_rules('country_id', 'Country Id', 'required');
		$this->form_validation->set_rules('lang_id', 'Language Id', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('content_for', 'Content For', 'required');
		if(($validator_arr = runFormValidator($this->form_validation)) !== true) 
		    return $this->response($validator_arr);

		
		// Get Request Data
		$country_id = $this->input->post('country_id')??101;
		$lang_id    = $this->input->post('lang_id')??1;
		$client_id  = $this->input->post('client_id')??1;
		$type 	    = trim($this->input->post('type'));
		
		if($type=='legal'){
			
			// $this->db->select('*');
			// $this->db->from('legal_resource'.' as crc');
			// $this->db->where('cr.lang_id', $lang_id);
			// $this->db->where('cr.country_id', $country_id);
			// $query = $this->db->get();
			// $res = $query->result();
			
			// return $res;exit;
			
			$this->load->model('legal_model');
			$result = $this->legal_model->getPageTypeData($type, $lang_id, $country_id, $client_id);
			$last_query = $this->db->last_query();
		}else{
			$this->load->model('resources_model');
			$result = $this->resources_model->getPageTypeData($type, $lang_id, $country_id, $client_id);
		}
		
		
		/*if(empty($result))
			return  $this->response([
						'status'  => false,
						'message' => 'Data not found'
					]);*/
		return  $this->response([
			'status'  => true,
			'message' => ucfirst($type).' List',
			'title'   => $result?$result[0]['client_resource_title']:'',
			'data'    => $result
		]);
	}

	/*public function getClientResourceList_post()
	{
		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='8140c7e293aaa1c933b29b53a2a9140cf176dcfd')
		{
			$this->form_validation->set_rules('client_id', 'Client Id', 'required');
			$this->form_validation->set_rules('country_id', 'Country Id', 'required');
			$this->form_validation->set_rules('lang_id', 'Language Id', 'required');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('content_for', 'Content For', 'required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status'  => false,
					'message' => $arr[0]
				);
			}
			else
			{
				$content_for = $this->input->post('content_for');
				$content_for = 'web';
				//$country_id = 102; //$this->input->post('country_id')
				$country_id = $this->input->post('country_id')??101;
				$country_id = 101;
				$lang_id    = $this->input->post('lang_id')??1;
				$client_id  = $this->input->post('client_id')??1;
				$whereInArr = [$content_for,'all'];
				$getData = $this->commonquery->getRecordFromTable('client_resources', array('*'), array('client_id' => $client_id, 'country_id' => $country_id, 'lang_id' => $lang_id, 'type' => trim($this->input->post('type'))), '', '');
				
				if(!empty($getData)) {
					$getListData = $this->commonquery->getRecordFromTable('client_resource_contents', array('*'), array('client_resource_id' => $getData[0]['id'], 'content_for' => $content_for), '', 'order_no ASC');
					if(!empty($getListData)){
						$response_data = array(
							'status'  => true,
							'message' => ucfirst($this->input->post('type')).' List',
							'title'   => $getData[0]['title'],
							'data'    => $getListData
						);
					} else {
						$getDataByLang1 = $this->commonquery->getRecordFromTable('client_resources', array('*'), array('client_id' => $client_id, 'country_id' => $country_id, 'lang_id' => '1', 'type' => trim($this->input->post('type'))), '', '');
						if(!empty($getDataByLang1)) {
							$getListData1 = $this->commonquery->getRecordFromTable('client_resource_contents', array('*'), array('client_resource_id' => $getDataByLang1[0]['id'], 'content_for' => $content_for), '', 'order_no ASC');
						}
						else {
							$getListData1 = $this->commonquery->getRecordFromTable('client_resource_contents', array('*'), array('client_resource_id' => $getListData[0]['id'], 'content_for' => 'all'), '', 'order_no ASC');
						}
						
						$response_data = array(
							'status'  => true,
							'message' => ucfirst($this->input->post('type')).' List',
							'title'   => $getDataByLang1[0]['title'],
							'data'    => $getListData1
						);
					}
				} else {
					$response_data = array(
						'status'  => false,
						'message' => 'Data not found'
					);

				}
			}
			$this->response($response_data, 200 );
		} else {
			$response_data = array(
				'status' => false,
				'message' => 'Invalid Security Key'
			);	
			$this->response($response_data,400);
		}
	}*/
	/* [ End : 18-09-2020 ] Create an function for faq list */

	public function getHelplineNbr_post()
    {
		$client_id  = $this->input->post('client_id');
		$country_id = $this->input->post('country_id');
		$city_id = $this->input->post('city_id')??null;
		$lang_id    = $this->input->post('lang_id');
        // $category_id = $this->input->post('category_id');
		$inc_id = $this->input->post('inc_id');
        $this->form_validation->set_rules('client_id', 'Client Id', 'required');
        $this->form_validation->set_rules('country_id', 'Country Id', 'required');
        $this->form_validation->set_rules('lang_id', 'Language Id', 'required');
        // $this->form_validation->set_rules('category_id', 'Category Id', 'required');
        $this->form_validation->set_rules('inc_id', 'Incident Id', 'required');
        if ($this->form_validation->run($this) == FALSE){
            $arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
            return $this->response([
                'status' => false,
                'message' => $arr[0]
            ]);
        } else {
            // get incident data by incident ID
            $incident_data = $this->menu_model->getIncidentData($inc_id);
            if($incident_data){
                $data = ['helpline' => [], 'CategoryVal' => []];
                $category_id =  $incident_data[0]['incident_category_ids'];
                $gender_id =  $incident_data[0]['gender_id'];
                
                // get helpline number on basis of client id, country id, language id & category id
                //$getNbrs = $this->menu_model->getHelplineNbr($client_id,$country_id,$lang_id,$category_id,$gender_id);
                $getNbrs = $this->emergency_helpline_model->getHelplineNbr($client_id,$country_id,$lang_id,$category_id,$gender_id,$city_id);
                if($getNbrs) $data['helpline'] = $getNbrs;
                
                // get IPC sections on basis of language id & category id
                //$getIPCs = $this->menu_model->getIPCSections($client_id,$lang_id,$category_id);
                $getIPCs = $this->legal_ipc_model->getIPCSections($country_id,$city_id,$lang_id,$category_id);
                if($getIPCs) $data['CategoryVal'] = $getIPCs;

                $data_arr = ['helpline' => $data['helpline'], 'CategoryVal' => $data['CategoryVal']];

                // echo "<pre>";
                // print_r($data);
                //echo json_encode($data_arr,JSON_PRETTY_PRINT);
                $this->response($data_arr, 200);
            }
        }
    }
	
}