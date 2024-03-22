<?php header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Ngo extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['commonquery']);
        $this->load->helper('cookie');
        $this->load->helper('filter_helper');
        $this->load->model('Ngo_model');
        $this->load->model('report_incident/incident_report_model');
        $this->load->model('report_incident/Category_model');
    }

    public function getNgoDetails_post()
    {
    	$ngo_id = $this->input->post('ngo_id');
    	$NgoDetails = $this->Ngo_model->getNgoDetails($ngo_id);
        
        foreach ($NgoDetails as $key => $value) {
            if($value['logo']){
                $NgoDetails[$key]['logo']=base_url().'assets/'.$value['logo'];
            }
        }
    	$response_data = array(
						'status' => true,
						'message' => 'Ngo Details',
						'data' => $NgoDetails
					);
    	$this->response($response_data, 200 );

    }

    public function getNgoData_get($ngo_id)
    {
        $from_date = $this->input->get('from_date').' 00:00:00'??date('Y-m-d 00:00:00');
        $to_date = $this->input->get('to_date').' 23:59:59'??date('Y-m-d 23:59:59');
        $categories = $this->Category_model->getClientCategories(1, 1);
        $mapped_cats = [];
        foreach ($categories as $category) {
            $mapped_cats[$category['id']] = $category['title'];
        }
        
        $data = $this->incident_report_model->getNgoData($ngo_id, $from_date, $to_date);
        $incidents = [];
        $current_inc_id = 0;
        $incident_count = 0;
        $i = 0;
        foreach ($data as $incident_detail) {
            if($incident_detail['id']!=$current_inc_id) {
                // New incident record
                $i = 0;
                $incident_count++;
            }
            $current_inc_id = $incident_detail['id'];
            
            // Get Categories
            $inc_cats = explode(',', $incident_detail['incident_category_ids']);
            $inc_cat_arr = [];
            foreach ($inc_cats as $inc_cat_id) {
                if(isset($mapped_cats[$inc_cat_id]))
                    $inc_cat_arr[] = $mapped_cats[$inc_cat_id];
            }

            // Set basic/common data
            if($i==0) {
                $incidents[$incident_count-1]['id'] = $current_inc_id;
                $incidents[$incident_count-1]['status'] = $incident_detail['status'];
                $incidents[$incident_count-1]['categories'] = implode('|', $inc_cat_arr);
                $incidents[$incident_count-1]['age'] = $incident_detail['age'];
                $incidents[$incident_count-1]['description'] = $incident_detail['description'];
                $incidents[$incident_count-1]['date'] = $incident_detail['date'];
                $incidents[$incident_count-1]['is_date_estimate'] = $incident_detail['is_date_estimate'];
                $incidents[$incident_count-1]['time_from'] = $incident_detail['time_from'];
                $incidents[$incident_count-1]['time_to'] = $incident_detail['time_to'];
                $incidents[$incident_count-1]['is_time_estimate'] = $incident_detail['is_time_estimate'];
                $incidents[$incident_count-1]['address'] = [
                    'building' => $incident_detail['building'],
                    'landmark' => $incident_detail['landmark'],
                    'area' => $incident_detail['area'],
                    'city' => $incident_detail['city'],
                    'state' => $incident_detail['state'],
                    'country' => $incident_detail['country'],
                ];
                $incidents[$incident_count-1]['latitude'] = $incident_detail['latitude'];
                $incidents[$incident_count-1]['longitude'] = $incident_detail['longitude'];
            }

            // Set other dynamic question and answers
            $question = $incident_detail['question'];
            $answer = $incident_detail['answer'];
            $ignore_question_tags = ['incident_categories'];
            if($question!='' && $answer!='' && !in_array($incident_detail['question_tag'], $ignore_question_tags)) {
                $incidents[$incident_count-1]['questions'][$i]['question']  = $question; 
                $incidents[$incident_count-1]['questions'][$i]['answer']    = $answer; 
                $i++;
            }
        }
        return $this->response(['success' => true, 'incidents' => $incidents]);
    }

}