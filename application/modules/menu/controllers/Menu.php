<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// include_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Category (CategoryController)
 * Category Class to control all Category related operations.
 * @author : Amita Hadawale
 * @version : 1.1
 * @since : 22 March 2020
 */
class Menu extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['commonquery']);
        $this->load->library("pagination");
        $this->load->helper('url');
        $this->load->helper('cias');
        $this->load->model('menu/menu_model');
        $this->load->model('emergency_helpline_model');
        $this->load->model('legal_ipc_model');

        $lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
        $this->lang->load('menu',$lang);
        $this->lang->load('help',$lang);
        $this->lang->load('home',$lang);
    }

    public function privacy_policy()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'privacy_policy';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['privacy_data'] = $PData['data'];
            $data1['title'] = $PData['title'];
            // $this->loadViews("privacy_policy", $this->global, NULL , NULL);
            $this->load->view('privacy_policy',$data1);
        }
    }

    public function terms_of_use()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'term_and_conditions';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['terms_data'] = $PData['data'];
            $data1['title'] = $PData['title'];
            // $this->loadViews("terms_of_use", $this->global, NULL , NULL);
            $this->load->view('terms_of_use',$data1);
        }
    }

    // API integration
    public function getHelplineNbr()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Content-type: text/javascript');

        $client_id = $this->input->post('client_id');
        $country_id = $this->input->post('country_id');
        $city_id = $this->input->post('city_id')??null;
        $lang_id = $this->input->post('lang_id');
        // $category_id = $this->input->post('category_id');
        $inc_id = $this->input->post('inc_id');
        $this->form_validation->set_rules('client_id', 'Client Id', 'required');
        $this->form_validation->set_rules('country_id', 'Country Id', 'required');
        //$this->form_validation->set_rules('city_id', 'City Id', 'required');
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
                $getNbrs = $this->emergency_helpline_model->getHelplineNbr($client_id,$country_id,$lang_id,$category_id,$gender_id,$city_id);
                if($getNbrs) $data['helpline'] = $getNbrs;

                // get IPC sections on basis of language id & category id
                $getIPCs = $this->legal_ipc_model->getIPCSections($client_id,$lang_id,$category_id);
                if($getIPCs) $data['CategoryVal'] = $getIPCs;

                $data_arr = ['helpline' => $data['helpline'], 'CategoryVal' => $data['CategoryVal']];

                // echo "<pre>";
                // print_r($data);
                echo json_encode($data_arr,JSON_PRETTY_PRINT);
            }
        }
    }

    public function help_after_form()
    {
        if(isset($_GET['inc']) && !empty($_GET['inc'])){
            $this->global['pageTitle'] = 'Safecity Webapp';

            // get incident data by incident ID
            $lang_id =  $_COOKIE['language_id'];
            $incident_data = $this->menu_model->getIncidentData($_GET['inc'], $lang_id);
            if($incident_data){
                $mainData = [];
                $mainData['category_names'] = $incident_data[0]['categories'];
                $client_id =  $_COOKIE['client_id'];
                $country_id =  $_COOKIE['country_id'];
                $category_id =  $incident_data[0]['incident_category_ids'];
                $city_id =  $_COOKIE['city_id'];

                if(isset($client_id) && isset($lang_id) && isset($country_id)){
                    // get helpline number on basis of client id, country id, language id & category id
                    $getNbrs = $this->emergency_helpline_model->getHelplineNbr($client_id,$country_id,$lang_id,$category_id,$incident_data[0]['gender_id'],$city_id);
                    if($getNbrs) $mainData['helpline'] = $getNbrs;

                    // get IPC sections on basis of language id & category id
                    $getIPCs = $this->legal_ipc_model->getIPCSections($country_id,$city_id,$lang_id,$category_id);
                    if($getIPCs) $mainData['CategoryVal'] = $getIPCs;
                    $this->load->view('help_pf', $mainData);

                    /*if(isset($_SERVER['HTTP_REFERER'])) {
                        //do what you need to do here if it's set
                        $this->load->view('help_pf', $mainData);
                    }
                    else
                    {
                        //echo "Unauthorised Access";
                        //redirect('401_override');
                        $this->show401('Unauthorized Request','401');
                    }*/
                }

            }
        } else redirect('home');
    }

    public function help()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $data = $data1 = [];
        $data['security_key'] = '99402b5fff8f2a45890fb8bf6de094ee00a210ce';
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['city_id'] =  $_COOKIE['city_id'];

        $url = base_url() . 'api/common_controller/emergencyHelpList';
        $PData = postAPIData($url,$data);

        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['number_list'] = $PData['data'];
            // $this->loadViews("help", $this->global, NULL , NULL);
        } else {
            //echo "Data is not available for selected city(".$_COOKIE['city'].") and country(".$_COOKIE['country'].")";
            $data1 = array('er_msg'=>'failed', 'title'=>'Helpline is not available for selected country and city');
        }
        $this->load->view('help',$data1);
    }

    public function about_safecity()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'about_safecity';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $this->global['about_data'] = $PData['data'];
            $this->global['title'] = $PData['title'];
            $this->loadViews("about_safecity", $this->global, NULL , NULL);
        }
    }

    public function contact_us()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'contact_us';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $this->global['contact_data'] = $PData['data'];
            $this->global['title'] = $PData['title'];
            $this->loadViews("contact_us", $this->global, NULL , NULL);
        }
    }

    public function volunteer_with_us()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $this->loadViews("volunteer_with_us", $this->global, NULL , NULL);
    }

    public function donate()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'donate';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $this->global['donate_data'] = $PData['data'];
            $this->global['title'] = $PData['title'];
            $this->loadViews("donate", $this->global, NULL , NULL);
        }
    }

    public function faqs()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $data = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'faq';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $this->global['faq_list'] = $PData['data'];
            $this->global['title'] = $PData['title'];
            $this->loadViews("faqs", $this->global, NULL , NULL);
        }
    }

    public function legal_resources()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'legal';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
		// echo "<pre>";
		// print_r($PData);
		// echo "</pre>";
		// exit;
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['legalData'] = $PData['data'];
            $data1['title'] = $PData['title'];
            // $this->loadViews("legal_resources", $data1, NULL , NULL);
            $this->load->view("legal_resources", $data1);
        }
    }

    public function filling_fir()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
        $data['type'] =  'fir';
        $data['content_for'] =  'web';

        $url = base_url() . 'api/faq/getClientResourceList';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            $data1['firData'] = $PData['data'];
            $data1['title'] = $PData['title'];
            $this->load->view("filling_fir", $data1);
        }
    }

    public function wellness_resources()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $this->load->view("wellness_resources");
    }

    public function legal_resources_old($country_id=null,$language_id=null)
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $cId = (isset($country_id) && !empty($country_id) ? $country_id : $_COOKIE['country_id']);
        $lId = (isset($language_id) && !empty($language_id) ? $language_id : $_COOKIE['language_id']);

        $this->global['country_id'] = $cId;
        $this->global['language_id'] = $lId;

        $getCountry = $this->commonquery->getRecordFromTable('countries',array('*'));
        if(!empty($getCountry)){
            $this->global['countryData'] = $getCountry;
        }

        $getData = $this->commonquery->getRecordFromTable('legal_ipc',array('*'),array('country_id' => $cId, 'language_id' => $lId));
        if(!empty($getData)){
            $this->global['legalData'] = $getData;
        }
        $this->loadViews("legal_resources", $this->global, NULL , NULL);
    }

    public function filling_fir_old($country_id=null,$language_id=null)
    {
        $this->global['pageTitle'] = 'Safecity Webapp';

        $cId = (isset($country_id) && !empty($country_id) ? $country_id : $_COOKIE['country_id']);
        $lId = (isset($language_id) && !empty($language_id) ? $language_id : $_COOKIE['language_id']);

        $this->global['country_id'] = $cId;
        $this->global['language_id'] = $lId;

        $getCountry = $this->commonquery->getRecordFromTable('countries',array('*'));
        if(!empty($getCountry)){
            $this->global['countryData'] = $getCountry;
        }

        $getData = $this->commonquery->getRecordFromTable('legal_FIR',array('*'),array('country_id' => $cId, 'language_id' => $lId));
        if(!empty($getData)){
            $this->global['legalFIRData'] = $getData;
        }
        // echo "<pre>";
        // print_r($getData);
        // exit();
        $this->loadViews("filling_fir", $this->global, NULL , NULL);
    }
	
	public function emergency_helpline()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $data = $data1 = [];
        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  $_COOKIE['client_id'];
        $data['lang_id'] =  $_COOKIE['language_id'];
        $data['country_id'] =  $_COOKIE['country_id'];
		if($data['country_id']==111){
			$data['type'] =  'emergency';
			$data['content_for'] =  'web';

			$url = base_url() . 'api/faq/getClientResourceList';
			$PData = postAPIData($url,$data);
			
			if($PData['er_msg'] == 'success' || $PData['code'] == 200){
				$data1['consent_data'] = $PData['data'];
				$data1['title'] = $PData['title'];

				$this->load->view('emergency_helpline',$data1);
			}
		}else{
			redirect('home');
		}
    }
}

?>