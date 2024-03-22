<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        $this->load->view('dashboard', $data);
    }

}