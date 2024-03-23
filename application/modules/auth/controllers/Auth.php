<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends BaseController
{
	/**
	 * This is default constructor of the class
	 */
	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('ion_auth');
	    $this->load->model('admin_model');
	}

	/**
	 * Log the user in
	 */
	public function index()
	{
		echo "Hello Safecity";
	}

	public function login()
	{
		if ($this->ion_auth->logged_in())
		{
			//if Already logged in
			//redirect them back to the admin page
			return redirect('admin', 'refresh');
		}

		// validate form input
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback" style="display:block">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
        	'valid_email' => 'Please enter a valid Email ID'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() === TRUE)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			$this->admin_model->setIonAuthExtraWhereHook();
			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{
				// Set logged in user detail in Session
				$user_data = $this->ion_auth->user()->row();
				$_SESSION['user_data'] = $user_data;
				//$this->session->set_userdata('user_data', $user_data);
				//if the login is successful
				//redirect them back to the admin page
				redirect('admin', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['email'] = [
				'name' => 'email',
				'id' => 'email',
				'type' => 'email',
				'value' => $this->form_validation->set_value('email'),
			];

			$this->data['password'] = [
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
			];

			$this->data['pageTitle'] = 'Safecity Admin Login';

			$this->load->view("login", $this->data);
		}
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		// Check if request is a POST request
		if($this->input->method()!=='post')
			show_404();

		$this->data['pageTitle'] = "Safecity Logout";

		// log the user out
		$this->ion_auth->logout();

		// redirect them to the login page
		redirect('auth/login', 'refresh');
	}

	/**
	 * Forgot password
	 */
	function forgot_password()
    {
	  $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
	  // validate form input
	  // $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
	  if ($this->form_validation->run() == false) {
	    //setup the input
	    $this->data['email'] = array('name'    => 'email',
	                   'id'      => 'email',
	                  );
	    //set any errors and display the form
	    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	    $this->load->view('forgot_password', $this->data);
	  }
	  else {
	  	//run the forgotten password method to email an activation code to the user
	    $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

	    if ($forgotten) { //if there were no errors
	      $this->session->set_flashdata('message', $this->ion_auth->messages());
	      redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
	    }
	    else {
	      $this->session->set_flashdata('message', $this->ion_auth->errors());
	      redirect("auth/forgot_password", 'refresh');
	    }
	  }
    }

    /**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		if ($this->ion_auth->logged_in())
		{
			//if Already logged in
			//redirect them back to the admin page
			return redirect('admin', 'refresh');
		}

		$this->data['title'] = $this->lang->line('reset_password_heading');

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = [
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
				$this->load->view('reset_password', $this->data);
			}
			else
			{
				$identity = $user->{$this->config->item('identity', 'ion_auth')};

				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($identity);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

	function _valid_csrf_nonce()
	{
	    if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
	        return TRUE;
	    } else {
	        return FALSE;
	    }
	}

}