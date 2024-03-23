<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Category extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_incident/category_model');
    }

    public function index_get()
    {
        $lang_id = $this->get('lang_id')??1;
    	$categories = $this->category_model->getClientCategories(1, $lang_id, $_COOKIE['country_id']);
    	$this->response([
    	    'status' => true,
    	    'message' => 'Categories list',
    	    'data' => $categories,
    	]);
    }

}