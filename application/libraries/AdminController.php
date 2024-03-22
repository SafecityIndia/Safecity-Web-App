<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class AdminController extends CI_Controller {

	protected $client_id;

	/**
	 * This is default constructor of the class
	 */
	public function __construct()
	{
		parent::__construct();
	    $this->load->library('ion_auth');
	    $this->load->library('ion_auth_acl');

	    // Check if already logged in
	    if (!$this->ion_auth->logged_in()) {
	    	if($this->input->is_ajax_request()) {
	    		print_r($this->jsonResponse(['status' => false, 'message' => 'Unauthorized request'], 401));
	    		exit;
	    	}
	    	$this->data['message'] = 'Please login to continue.';
	    	return redirect('auth/login', 'refresh');
	    }

	    // Check if logged in user has Permission to access url
	    $path = str_replace(base_url(), "", current_url());
	    $this->config->load('middlewares');
	    $middlewares = $this->config->item('middlewares');
	    foreach ($middlewares as $url => $permission) {
	    	$url = str_replace('/*', '', $url);
	    	if(strpos($path, $url) !== false) {
		    	if(!$this->ion_auth_acl->has_permission($permission)) {
				    if ($this->input->is_ajax_request()) {
				    	print_r($this->jsonResponse(['status' => false, 'message' => 'Unauthorized request!'], 403));
				    	exit;
				    }
		    		return show_error('Unauthorized request', 403, 'Unauthorized');
		    	}
	    	}
	    }

	    // Check if request is related to subclient
	    $uri_string = uri_string();
	    $nonclient_uris = ['admin/incidents', 'admin/forms', 'admin/safety-tips', 'admin/clients', 'admin/pages', 'admin/chats', 'admin/user-profiles', 'admin/my-profile'];
	    if(in_array($uri_string, $nonclient_uris))
	    	$_SESSION['is_subclient'] = false;
	    else if(strpos($uri_string, '/clients'))
	    	$_SESSION['is_subclient'] = true;
	    if(!isset($_SESSION['is_subclient']))
	    	$_SESSION['is_subclient'] = false;

	    // Set client id for requests
	    $user_data = $_SESSION['user_data'];
	    $this->client_id = $user_data->client_id;
	    if($_SESSION['is_subclient'])
	    	$this->client_id = $user_data->sub_client_id??1;
	}

	/**
	 * Get Logged In User Details
	 * @return Object
	 */
	protected function getLoggedInUser()
	{
		return $this->ion_auth->user()->row();
	}

	/**
	 * Returns JSON response with content type and status header
	 * @param  Array   $data
	 * @param  integer $statusCode
	 * @return CI_RESPONSE
	 */
	protected function jsonResponse($data, $statusCode=200)
	{
		return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header($statusCode)
                    ->set_output(json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));
	}

	protected function show404()
	{
		$this->output->set_status_header('404');
		$this->data['is_admin'] = true;
		return $this->load->view('errors/html/error_404', $this->data);
	}

}