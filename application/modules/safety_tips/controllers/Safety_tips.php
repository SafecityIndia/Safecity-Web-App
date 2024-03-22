<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// include_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Category (CategoryController)
 * Category Class to control all Category related operations.
 * @author : Amita Hadawale
 * @version : 1.1
 * @since : 22 March 2020
 */
class Safety_tips extends BaseController
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

        $lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
        $this->lang->load('validation', $lang);
        $this->lang->load('menu',$lang);
        $this->lang->load('share_safety_tip',$lang);
    }

    public function SafetyLocation()
    {
        $lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
        $this->lang->load('dynamic_form', $lang);
        $this->global['pageTitle'] = 'Safecity Webapp';
        // $this->loadViews("safety_location", $this->global, NULL , NULL);   
        //$this->load->view('safety_location');
        $this->load->view('safety_address'); 
    }

    /*public function SafetyLocation()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        // $this->loadViews("safety_location", $this->global, NULL , NULL);   
        $this->load->view('safety_location');
    }*/

    public function SafetyMap()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        // $this->loadViews("safety_map", $this->global, NULL , NULL);        
        $this->load->view('safety_map');     
    }

    public function SafetyTip()
    { 
        $this->global['pageTitle'] = 'Safecity Webapp';
        // $this->loadViews("safety_tip", $this->global, NULL , NULL);        
        $this->load->view('safety_tip');     
    }

    public function safetyTipTitle()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        // $this->loadViews("safety_tip_title", $this->global, NULL , NULL);        
        $this->load->view('safety_tip_title');     
    }

    public function thankYou()
    {
        $this->global['pageTitle'] = 'Safecity Webapp'; 
        $this->load->view("thank_you");
    }

    public function storeTips()
    {
        $this->global['pageTitle'] = 'Safecity Webapp'; 
        $data = [];
        $data['security_key'] = 'd659f8e1043f236a54e442f6b17661e95c2eecb4';
        $data['user_id'] = 0;
        $data['country_id'] = $_COOKIE['country_id'];
        $data['language_id'] = $_COOKIE['language_id'];
        $data['client_id'] = $_COOKIE['client_id'];
        $data['identification'] = 'Webapp';
        $data['location'] = $_COOKIE['localitySafe'];
        $data['landmark'] = $_COOKIE['landmarkSafe'];
        $data['city'] = $_COOKIE['citySafe'];
        $data['state'] = $_COOKIE['stateSafe'];
        $data['country'] = $_COOKIE['countrySafe'];
        $data['exact_location'] = $_COOKIE['address_safety'];
        $data['map_lat'] = $_COOKIE['lat_safety'];
        $data['map_lon'] = $_COOKIE['longi_safety'];
        $data['safety_tip_title'] = $_COOKIE['safetyTipT'];
        $data['safety_tip_desc'] = $_COOKIE['safetyTipD'];

        $url = base_url() . 'api/safecity_report/writeSafetyTips';
        $PData = postAPIData($url,$data);
        if($PData['er_msg'] == 'success' || $PData['code'] == 200){
            redirect('thankYou');
        }
    }

}

?>