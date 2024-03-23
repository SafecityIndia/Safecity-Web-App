<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Amita Hadawale
 * @version : 1.1
 * @since : 22 March 2020
 */
class Errors extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('pageNotFound');
        }
    }

    /** 404 Page */
    public function notFound()
    {
        $this->load->library('ion_auth');
        $this
            ->output
            ->set_status_header('404');
        $this->data['content']  = 'custom404view'; // View name
        $this->data['is_admin'] = $this->ion_auth->logged_in();
        $this
            ->load
            ->view('errors/html/error_404', $this->data);
    }

}

?>