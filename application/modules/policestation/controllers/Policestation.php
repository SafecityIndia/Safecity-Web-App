<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// include_once APPPATH . '/libraries/BaseController.php';

class Policestation extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

        $lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
        $this->lang->load('menu',$lang);
        $this->lang->load('hospital_police',$lang);  
    }
    
    public function find_loc() 
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        
        // $this->loadViews("hospitals_near_me", $this->global, NULL , NULL);
        // $this->load->view('map');
        // $this->load->view('hospitals_near_me');
        $this->load->view('find_loc');
    }
    
    public function get_map()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        
        // $this->loadViews("hospital_listing", $this->global, NULL , NULL);
        // $this->load->view('map');
        // $this->load->view('hospital_listing');
        $this->load->view('policestation_map');
    }

    public function map_listing()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        
        // $this->loadViews("hospital_listing", $this->global, NULL , NULL);
        // $this->load->view('map');
        // $this->load->view('hospital_maplisting');
        $this->load->view('map_listing');
    }

    // public function policestation_loc()
    // {
    //     $this->global['pageTitle'] = 'Safecity Webapp';
        
    //     // $this->loadViews("hospitals_near_me", $this->global, NULL , NULL);
    //     // $this->load->view('map');
    //     $this->load->view('policestations_near_me');
    // }

    // public function getPolicestationMap()
    // {
    //     $this->global['pageTitle'] = 'Safecity Webapp';        
    //     $this->load->view('police_listing');
    //     // $this->loadViews("police_listing", $this->global, NULL , NULL);

    // }


}

?>