<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Myprofile extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin_model");
    }

    public function index()
    {
        $id      = $this->session->userdata('user_id');
        $data['profile_data'] = $this->admin_model->get($id);
        $data['roles'] = $this->admin_model->getRoles($id);
        $data['permissions'] = $this->admin_model->getPermissions($id);
        $data['pageTitle'] = 'Safecity Webapp';
        $this->load->view('my-profile', $data);
    }

    public function editProfile()
    {
        $id      = $this->session->userdata('user_id');
        $data['profile_data'] = $this->admin_model->get($id);
        $data['pageTitle'] = 'Safecity Webapp';
        $this->load->view('edit-profile', $data);
    }

     public function updateProfile()
    {
            $picture = '';
            $errors =  array();
            $json_data = array();
            $this->load->library('form_validation');
            $this->load->helper(array(
            'form',
            'url'
            ));
        if ($this->input->is_ajax_request()) {
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('first_name', 'First Name','required');
                $this->form_validation->set_rules('last_name', 'Last name','required');
                $this->form_validation->set_rules('user_name', 'User name','required');
                $this->form_validation->set_rules('email', 'Email','required');

                if ($this->form_validation->run() == FALSE) {
                foreach ($this->input->post() as $key => $value)
                {
                    $errors[$key] = form_error($key);
                }
                $json_data['errors'] = array_filter($errors); 
                $json_data['status'] = FALSE; 
                echo json_encode($json_data);
            }else 
            {

              $match_email =   $this->admin_model->check_email($this->input->post('email'));
                
                 if (empty($match_email)) {
                      
                    $id  = $this->session->userdata('user_id');
                    if(!empty($_FILES['profile_pic']['name'])){

                    $config['upload_path'] = 'assets/uploads/admin_avatars/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $_FILES['profile_pic']['name'];
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                        if($this->upload->do_upload('profile_pic')){
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                        }else{
                            $json_data = array(
                            'status' => false,
                            'success_alert' => 'image not upload',
                            );
                            echo json_encode($json_data);
                        }
                    }

                    $data['first_name'] = $this->input->post('first_name');
                    $data['last_name'] = $this->input->post('last_name');
                    $data['username'] = $this->input->post('user_name');
                    $data['email'] = $this->input->post('email');
                    $data['avatar'] = !empty($picture)? $picture : $this->input->post('profile_pic') ;
                   
                    $result = $this->admin_model->update_data('admins','id',$id,$data);
                    $json_data = array(
                    'status' => true,
                    'success_alert' => 'Data updated successfully',
                    );
                   
                 }else{
                     $json_data = array(
                    'status' => false,
                    'success_alert' => 'email id must be unique',
                    );
                 }

                echo json_encode($json_data);
                exit;
            }
        }else{
            echo 'No direct access';
        }
    }

         public function update_password()
    {

            $errors =  array();
            $json_data = array();
            $this->load->library('form_validation');
            $this->load->helper(array(
            'form',
            'url'
            ));
        if ($this->input->is_ajax_request()) {
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('old_password', 'old_password','required');
                $this->form_validation->set_rules('new_password', 'new_password','required');
                $this->form_validation->set_rules('confirm_password', 'confirm_password','required');


                if ($this->form_validation->run() == FALSE) {
                foreach ($this->input->post() as $key => $value)
                {
                    $errors[$key] = form_error($key);
                }
                $json_data['errors'] = array_filter($errors); 
                $json_data['status'] = FALSE; 
                echo json_encode($json_data);
            }else 
            {
                $id  = $this->session->userdata('user_id');
                $user_password = $_SESSION['user_data']->password;
                $old_password = $this->input->post('old_password');
                $data['password'] = $this->input->post('new_password');
                $result = $this->admin_model->verify_user($old_password,$user_password);
                
                if (!empty($result)) {
                    $result = $this->admin_model->update($id,$data);
                    $json_data = array(
                    'status' => true,
                    'success_alert' => 'Data updated successfully',
                    );

                 }else{
                    $json_data = array(
                    'status' => false,
                    'success_alert' => 'current password not match',
                    );
                
                 }
             echo json_encode($json_data);
            exit;

       
            }
        }else{
            echo 'No direct access';
        }
    }
}