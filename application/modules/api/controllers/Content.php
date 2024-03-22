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

class Content extends REST_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['commonquery']);
	}

	
	/* [ Start : 25-07-2020 ] Create an function for Content */
	public function getContent_post()
	{

		$received_data = json_decode(file_get_contents('php://input'), true);
		if (!empty($received_data)) {
			foreach ($received_data as $post_key => $post_value) {
				$_POST[$post_key] = $post_value;
			}
		}

		$security_key = $this->input->post('security_key');
		if($security_key=='4c9e2c48e289bc7d7f772e553c1cd1ff2fb1ee9e')
        {
			$this->form_validation->set_rules('content_type', 'Content Type', 'required');
			$this->form_validation->set_rules('language_id', 'Language', 'required');
			$this->form_validation->set_rules('screen_no', 'Screen No', 'required');

			
			if ($this->form_validation->run($this) == FALSE)
			{
				$arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
				$response_data = array(
					'status' => false,
					'message' => $arr[0]
				);

			}else{
				
				# Get content data from content table
				$content_arr = $this->commonquery->getIdByParameter('content', array('short_desc', 'long_desc'), array('content_type' => strtolower($this->input->post('content_type')), 'screen_no' => $this->input->post('screen_no'), 'language_id' => $this->input->post('language_id'), 'status' => '1'));

				if(!empty($content_arr)){
					$response_data 	= array(
						'status' 	=> true,
						'message' 	=> 'content data',
						'data' 		=> $content_arr
					);
				}else{
					$response_data 	= array(
						'status' 	=> false,
						'message' 	=> 'No record found'
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

	

}