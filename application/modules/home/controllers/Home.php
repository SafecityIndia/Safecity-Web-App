<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// include_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Category (CategoryController)
 * Category Class to control all Category related operations.
 * @author : Amita Hadawale
 * @version : 1.1
 * @since : 22 March 2020
 */
class Home extends BaseController
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
        $this->load->model('home_model');

        $lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
        $this->lang->load('menu',$lang);
        $this->lang->load('home',$lang);
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $this->load->view('home');
    }

    public function getIncidentDesc()
    {
        $data = $data1 = [];
        $url = base_url() . 'api/faq/getClientResourceList';

        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  (!empty($this->input->post('client_id')) ? $this->input->post('client_id') : "");
        $data['lang_id'] =  (!empty($this->input->post('lang_id')) ? $this->input->post('lang_id') : "");
        $data['country_id'] =  (!empty($this->input->post('country_id')) ? $this->input->post('country_id') : "");
        $data['type'] =  'incident_desc';
        $data['content_for'] =  'web';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            echo $PData['data'][0]['content'];
        }
    }

    public function getSafetyTipDesc()
    {
        $data = $data1 = [];
        $url = base_url() . 'api/faq/getClientResourceList';

        $data['security_key'] = '8140c7e293aaa1c933b29b53a2a9140cf176dcfd';
        $data['client_id'] =  (!empty($this->input->post('client_id')) ? $this->input->post('client_id') : "");
        $data['lang_id'] =  (!empty($this->input->post('lang_id')) ? $this->input->post('lang_id') : "");
        $data['country_id'] =  (!empty($this->input->post('country_id')) ? $this->input->post('country_id') : "");
        $data['type'] =  'safetytip_desc';
        $data['content_for'] =  'web';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            echo $PData['data'][0]['content'];
        }
    }

    // code change by sonam - get Country Autocomplete - 23-10-2020 start
    public function getHelpCountryAutocomplete() {
        $json = array();
        $countryName = $this->input->post('query');
        $this->home_model->setCountryName($countryName);
        $getCountries = $this->home_model->getHelpAllCountries();
        foreach ($getCountries as $key => $element) {
            $json[] = array(
                'country_id' => $element['id'],
                'country_name' => $element['name'],
            );
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    // code change by sonam - get Country Autocomplete - 23-10-2020 end


    // get Country Autocomplete
    public function getCountryAutocomplete() {
        $json = array();
        $countryName = $this->input->post('query');
        $this->home_model->setCountryName($countryName);
        $getCountries = $this->home_model->getAllCountries();
        foreach ($getCountries as $key => $element) {
            $json[] = array(
                'country_id' => $element['country_id'],
                'country_name' => $element['country_name'],
            );
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }

    // get City Autocomplete
    public function getCityAutocomplete() {
        $json = array();
        $cityName = $this->input->post('query');
        $countryID = $this->input->post('country_id');
        $this->home_model->setCityName($cityName);
        $this->home_model->setCountryID($countryID);
        $getCities = $this->home_model->getAllCities();
        foreach ($getCities as $key => $element) {
            $json[] = array(
                'city_id' => $element['city_id'],
                'city_name' => $element['city_name'],
            );
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }

    // function getCityIncidentAutocomplete() {
    //     print_r($_GET);
    //     print_r($_POST);
    //     /*$saerch_incidents = $this->home_model->getSearchCities('mu');
    //     print_r($saerch_incidents);die;*/
    //     if (isset($_GET['term'])) {
    //         $saerch_incidents = $this->home_model->getSearchCities($_GET['term']);
    //         print_r($saerch_incidents);die;
    //         if (count($saerch_incidents) > 0) {
    //             foreach ($saerch_incidents as $row)
    //                 print_r($row);
    //                 //$arr_result[] = array('label'=> $row->food_name, 'value'=> $row->id, 'qty'=> 1, 'stock_avail'=> $row->stock_avail, 'price'=> $row->food_price, 'product_id'=> $row->id);
    //             //echo json_encode($arr_result);
    //         }
    //     }
    // }

    /*public function fetch_country()
    {
        $output = '';
        $query = '';

        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
        }
        $data = $this->home_model->fetch_country($query);

        echo json_encode($data);
    }*/

    /*public function fetch_city()
    {
        $output = '';
        $query = '';

        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
        }
        $data = $this->home_model->fetch_city($query);
        echo json_encode($data);
    }*/
}

?>