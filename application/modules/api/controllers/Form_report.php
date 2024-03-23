<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Form_report extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_form/form_report_model');
        $this->load->helper('filter_helper');
    }
}