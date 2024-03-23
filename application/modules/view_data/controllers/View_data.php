<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class View_data extends BaseController
{

	function __construct()
	{
		parent::__construct();

		$lang = (isset($_COOKIE['language']) && !empty($_COOKIE['language']) ? $_COOKIE['language'] : 'English');
		$this->lang->load('menu', $lang);
	}

	public function index()
	{
		$this->global['pageTitle'] = 'Safecity Webapp';
		$this->load->view('view_data');
	}

}