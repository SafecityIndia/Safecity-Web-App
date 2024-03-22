<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// include_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Report_incident (ReportIncidentController)
 * Category Class to control all Category related operations.
 * @author : Amita Hadawale
 * @version : 1.1
 * @since : 22 March 2020
 */
class Report_incident extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('form_model');
        $this->load->model('category_model');
        $this->load->model('incident_report_model');
        $this->load->model('city_model');
        $this->load->model('country_model');

        // language changes 29-10-2020 start - sonam
        $lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
        $this->lang->load('menu', $lang);
        $this->lang->load('onboarding', $lang);
        $this->lang->load('dynamic_form', $lang);
        $this->lang->load('validation', $lang);
        // language changes 29-10-2020 end - sonam
    }

	public function welcome(){
		$this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
		$data['type'] =  'welcome';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
		
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['consent_data'] = $PData['data'];
            $data1['title'] = $PData['title'];

            $this->load->view('welcome',$data1);
        }
	}
	
	public function experience(){
		$this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
		
        $data['type'] =  'experience';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
		
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['consent_data'] = $PData['data'];
            $data1['title'] = $PData['title'];

            $this->load->view('experience',$data1);
        }
	}
	
	public function protection_policy(){
		$this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'protection_policy';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
		
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['consent_data'] = $PData['data'];
            $data1['title'] = $PData['title'];

            $this->load->view('protection_policy',$data1);
        }
	}	
	
    public function onboarding()
    {
        $country_name = $city_name = '';
        $country_id  = get_cookie('country_id')??101; // Default India
        $city_id     = get_cookie('city_id')??1325873; // Default Mumbai
        $client_id   = 1;
        $ngo_id     = 0;
        
        if($country_id!=0) {
            $country        = $this->country_model->getById($country_id);
            $country_name   = $country->country_name??'';
            $ngo_id         = $country->ngo_id??0;
           
            /*if($country_id == 101)
                $ngo_id = '1,2,3,4,5,6';*/
        }

        if($city_id!=0) {
            $city = $this->city_model->getById($city_id);
            $city_name = $city->city_name??'';
            $client_id = $city->client_id??1;
           // $ngo_id = $city->ngo_id??0;
        }
        
        $pageTitle = 'Safecity Webapp';
        $this->load->view("onboarding", compact('pageTitle', 'client_id', 'country_id', 'country_name', 'city_id', 'city_name','ngo_id'));
    }
	
	public function brazilonboarding()
    {
        $country_name = $city_name = '';
        $country_id  = 31; // Default India
        // $city_id     = get_cookie('city_id')??181664; // Default Mumbai
        $city_id     = 181664; // Default Mumbai
        $client_id   = 1;
        $ngo_id     = 0;
        
        if($country_id!=0) {
			
            $country        = $this->country_model->getById($country_id);
            $country_name   = $country->country_name??'';
            $ngo_id         = $country->ngo_id??0;
           
            /*if($country_id == 101)
                $ngo_id = '1,2,3,4,5,6';*/
        }

        if($city_id!=0) {
            $city = $this->city_model->getById($city_id);
            $city_name = $city->city_name??'';
            $client_id = $city->client_id??1;
           // $ngo_id = $city->ngo_id??0;
        }
        
        $pageTitle = 'Safecity Webapp';
        $this->load->view("brazilonboarding", compact('pageTitle', 'client_id', 'country_id', 'country_name', 'city_id', 'city_name','ngo_id'));
    }
	
	public function kuwaitonboarding()
    {
        $country_name = $city_name = '';
        $country_id  = 117; // Default India
        // $city_id     = get_cookie('city_id')??181664; // Default Mumbai
        $city_id     = 1570167; // Default Mumbai
        $client_id   = 1;
        $ngo_id     = 0;
        
        if($country_id!=0) {
			
            $country        = $this->country_model->getById($country_id);
            $country_name   = $country->country_name??'';
            $ngo_id         = $country->ngo_id??0;
           
            /*if($country_id == 101)
                $ngo_id = '1,2,3,4,5,6';*/
        }

        if($city_id!=0) {
            $city = $this->city_model->getById($city_id);
            $city_name = $city->city_name??'';
            $client_id = $city->client_id??1;
           // $ngo_id = $city->ngo_id??0;
        }
        
        $pageTitle = 'Safecity Webapp';
        $this->load->view("kuwaitonboarding", compact('pageTitle', 'client_id', 'country_id', 'country_name', 'city_id', 'city_name','ngo_id'));
    }

    public function consent()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'consent';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['consent_data'] = $PData['data'];
            $data1['title'] = $PData['title'];

            $this->load->view('consent',$data1);
        }
    }

    public function ngo()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['ngo_id'] =  $_COOKIE['ngo_id'];
        $data['type'] =  'ngo';
        $data['content_for'] =  'web';
		
        $url = base_url() . 'api/ngo/getNgoDetails';
        $PData = postAPIData($url,$data);
		// print_r($PData);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['ngo_data'] = $PData['data'];
        }
        $this->load->view('ngo',$data1);
        //}
    }

    public function index()
    { 
        $client_id      = get_cookie('client_id')??1;
        $lang_id        = get_cookie('language_id')??1;
        $country_id     = get_cookie('country_id')??101;

        $data_arr = $this->form_model->getForms($client_id, $lang_id, $country_id);
        $data = ['pageTitle' => 'Safecity Webapp'];
        $data['lang_id'] = $lang_id;
        $data['forms']       = json_encode($data_arr['forms'], JSON_UNESCAPED_UNICODE);
        $data['questions']   = json_encode($data_arr['questions'], JSON_UNESCAPED_UNICODE);
        $data['categories']  = json_encode($data_arr['categories'], JSON_UNESCAPED_UNICODE);
       // echo '<pre>',print_r($data['questions']); exit;
        // print "<pre>";
        // print_r($data_arr);
        // print "</pre>";exit;
        $this->load->view('share_incident_form', $data);
    }

    public function saveIncident()
    { 
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');

        // Load ion auth to check if admin is logged in

        $admin_id = 0;
        $user_id = $this->input->post('user_id')??0;
        if($user_id==0) {
            $this->load->library('ion_auth');
            if($this->ion_auth->logged_in()) {
                $admin_id = $this->ion_auth->user()->row()->id;
            }
        }

        $primary_tags = ['sharing_for', 'age', 'gender', 'description', 'date', 'time_from', 'incident_categories', 'reported_to_police', 'attack_reason', 'additional_detail', 'incident_address'];
        $answers_jsons = $this->input->post('answers_json');
        $incident_id = $this->input->post('incident_id');
        $answers_jsons = json_decode($answers_jsons);
        $incident_arr = [
            'is_public' => 1,
            'client_id' => get_cookie('client_id')??1,
            'lang_id'   => get_cookie('language_id')??1,
            'user_id'   => $this->input->post('user_id')??0,
            'admin_id'  => $admin_id,
            'is_mobile_visible' => $this->input->post('user_id')?1:null,
            'total_forms' => 1
        ];
        $detail_arr = [];
        foreach ($answers_jsons as $answer_json) {
            $question_answer = $answer_json->currentQuestion;
            $answerJson = $question_answer->answerJson;
            $question_id = $question_answer->id;
            $question = $question_answer->question;
            $question_type = json_decode($question_answer->properties)->type;
            $question_tags = $question_answer->tags;
            // incident details data
            $detail_arr[] = ['incident_id' => $incident_id, 'form_type' => $answerJson->form_type, 'question_id' => $question_id, 'question_type' => $question_type, 'question_tag' => $question_tags, 'question' => $question, 'answer_id' => $answerJson->option_id, 'answer' => $answerJson->answer??'', 'other_answers' => isset($answerJson->other_answers)?json_encode($answerJson->other_answers):null, 'answer_json' => json_encode($answerJson)];
            // incident record data
            if($incident_id==0) {
                $tags_arr = explode(',', $question_tags);
                foreach ($tags_arr as $tag) {
                    if(in_array($tag, $primary_tags)) {
                        if($tag=='date') {
                            $date_arr =  explode('/', $answerJson->answer);
                            $incident_arr[$tag] = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];
                            $incident_arr['is_date_estimate'] = $answerJson->isEstimate?1:0;
                            $answerJson->answer = $incident_arr[$tag];
                        } else if($tag=='time_from') {
                            $time_arr = explode('-', $answerJson->answer);
                            $start_time = date('H:i:s', strtotime($time_arr[0]));
                            $end_time = count($time_arr)>1?date('H:i:s', strtotime($time_arr[1])):null;
                            $incident_arr['time_from'] = $start_time;
                            $incident_arr['time_to'] = $end_time;
                            $incident_arr['is_time_estimate'] = $answerJson->isEstimate?1:0;
                            $answerJson->answer = $incident_arr['time_from'].$end_time!=null?'-'.$end_time:'';
                        } else if($tag == 'incident_address') {
                            $incident_arr['building'] = $answerJson->address->building;
                            $incident_arr['landmark'] = $answerJson->address->landmark;
                            $incident_arr['area'] = $answerJson->address->area;
                            $incident_arr['city'] = $answerJson->address->city;
                            $incident_arr['state'] = $answerJson->address->state;
                            $incident_arr['country'] = $answerJson->address->country;
                            $incident_arr['latitude'] = $answerJson->address->latitude;
                            $incident_arr['longitude'] = $answerJson->address->longitude;
                        }
                        /*else if($tag == 'incident_lat_lng') {
                        }*/
                        else if($tag == 'sharing_for') {
                            $incident_arr['sharing_for'] = $answerJson->option_id;
                        }
                        else if($tag == 'gender') {
                            $incident_arr['gender_id'] = $answerJson->option_id;
                        }
                        else if($tag == 'incident_categories') {
                            $incident_arr['incident_category_ids'] = $answerJson->option_id;
                        }
                        else {
                            $incident_arr[$tag] = $answerJson->answer;
                        }
                        break;
                    }
                }
            }
        }

        $this->db->trans_start();
        // Save incident
        if($incident_id==0) {
            $result_id = $this->incident_report_model->save($incident_arr);
            if($result_id>0) {
                $incident_id = $result_id;
            }
            $detail_arr = array_map(function($detail) use ($incident_id) {
                $detail['incident_id'] = $incident_id;
                return $detail;
            }, $detail_arr);
        } else {
            // Update form count (indicates form type: primary/secondary,etc)
            $this->incident_report_model->updateTotalForms($incident_id);
        }

        // Save incident details
        $this->incident_report_model->saveDetails($detail_arr);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            echo json_encode(['succes' => false, 'message' => 'Something went wrong!']);
        else
            echo json_encode(['success' => true, 'incident_id' => $incident_id]);
    }

}