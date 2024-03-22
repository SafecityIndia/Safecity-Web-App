<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Helplines extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("emergency_helpline_model");
		$this->load->model('client_model');
		$this->load->model('legal_model');
        $this->load->model('country_model');
		$this->load->model('report_incident/Category_model');
    }

    public function index()
    {
		$client_id = $this->client_id;
        $data = ['pageTitle' => 'Help Lines'];
        $permissions = $this->ion_auth_acl->permissions('full');
        if($this->client_id!=1) {
            $permissions = array_filter($permissions, function($permission) {
                return $permission['key']!='client_all';
            });
        }
        $data['permissions'] = $permissions;
		
		if($_SESSION['user_id']==30){
			$data['languages'] = $this->client_model->getJordanLanguages($client_id);
		}else{
			$data['languages'] = $this->client_model->getLanguages($client_id);
		}
        
        $data['countries'] = $this->country_model->get();
		
        $this->load->view('helplines', $data);
    }
	
	public function getCategory(){
		$client_id = $this->client_id;
		$language = $this->input->post('language')??1;
		$country = $this->input->post('country')??101;
		
		$categories = $this->Category_model->getClientCategories($client_id, $language, $country);
		
		$html = '<option value="All">All</option>';
        foreach ($categories as $val) {
            $html .='<option value='.$val['id'].'>'.$val['title'].'</option>';
        }
        //$resource_details = html_entity_decode($resource_details['content']);
        return $this->jsonResponse(['success' => true, 'data' => $html], 200);
	}

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

		if($_SESSION['user_id']==30){
			$country_id   = 111;
		}else{
			$country_id   = $this->input->post('country_id')??'';
		}
        $lang_id      = $this->input->post('lang_id')??'';
        $gender       = $this->input->post('gender')??'';
		
        $title        = $this->input->post('title')??'';
        $updated_by   = $this->input->post('updated_by')??'';
        $updated_on   = $this->input->post('updated_on')??'';
        $created_on   = $this->input->post('created_on')??'';
        $search       = $this->input->post('search')??'';
		
        $result = $this->emergency_helpline_model->getDataTableResults($start, $length, $title, $this->client_id, $country_id,$lang_id, $gender, $updated_by, $updated_on, $created_on, $search);
        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => $result['total_records'],
            'recordsFiltered'   => $result['filtered_records'],
            'data'              => $result['results']
        ];
        return $this->jsonResponse($data, 200);
    }

    public function getDetails()
    {
        $id = $this->input->post('id')??1;
        $user_details = $this->admin_model->get($id);
        $user_details->roles = $this->admin_model->getRoles($id);
        $user_details->permissions = $this->admin_model->getPermissions($id);
        return $this->jsonResponse(['status' => true, 'data' => $user_details], 200);
    }

    public function store()
    {
        if (isset($_FILES['avatar']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            $new_name                       = time().$_FILES["avatar"]['name'];
            $config['file_name']            = $new_name;
            $config['upload_path']          = FCPATH.'assets/uploads/admin_avatars';
            $config['allowed_types']        = 'jpg|png';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('avatar'))
            {
                return  $this->jsonResponse([
                        'status' => false,
                        'message' => $this->upload->display_errors(),
                    ]);
            } else {
                $avatar = $this->upload->data()['file_name'];
            }
        } else {
            $avatar = '';
        }
        $first_name     = $this->input->post('first_name');
        $last_name      = $this->input->post('last_name');
        $username       = $this->input->post('username');
        $email          = $this->input->post('email');
        $password       = $this->input->post('password')??'';
        $role_name      = $this->input->post('role')??'admin';
        $role_id        = $this->input->post('role_id')??2;
        $permission_ids = $this->input->post('permissions')??'';

        $data = [
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'client_id'     => $this->client_id??1,
            'username'      => $username,
            'email'         => $email,
            'password'      => $password,
            'created_by'    => $this->getLoggedInUser()->id,
            'created_on'    => strtotime('now'),
            'avatar'        => $avatar
        ];

        // Update User Detail
        $id = $this->admin_model->create($data, [$role_id]);
        if(!$id)
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);

        // Update User Permissions if role is not superadmin
        if($role_name!='superadmin') {
            $result = $this->admin_model->addPermissions($id, explode(',', $permission_ids));
            if(!$result)
                return  $this->jsonResponse([
                            'status' => false,
                            'message' => 'User created but Failed to update Permissions',
                        ]);
        } else if ($this->client_id!=1) {
            // Remove Client permission from client superadmins
            $permission = $this->admin_model->getPermissionByKey('client_all');
            $this->admin_model->denyRole($id, $permission->id);
        }

        // Return Success
        return  $this->jsonResponse([
                    'status'  => true,
                    'message' => 'User updated succesfully',
                    'id'      => $id
                ]);
    }

    public function update()
    {
        // Upload avatar
        if (isset($_FILES['avatar']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            $new_name                       = time().$_FILES["avatar"]['name'];
            $config['file_name']            = $new_name;
            $config['upload_path']          = FCPATH.'assets/uploads/admin_avatars';
            $config['allowed_types']        = 'jpg|png';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('avatar'))
            {
                return  $this->jsonResponse([
                        'status' => false,
                        'message' => $this->upload->display_errors(),
                    ]);
            } else {
                $avatar = $this->upload->data()['file_name'];
            }
        } else {
            $avatar = '';
        }
        $id             = $this->input->post('id');
        $first_name     = $this->input->post('first_name');
        $last_name      = $this->input->post('last_name');
        $username       = $this->input->post('username');
        $email          = $this->input->post('email');
        $password       = $this->input->post('password')??'';
        $role_name      = $this->input->post('role')??'admin';
        $role_id        = $this->input->post('role_id')??2;
        $permission_ids = $this->input->post('permissions')??'';

        $data = [
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'username'      => $username,
            'email'         => $email,
            'updated_by'    => $this->getLoggedInUser()->id,
            'updated_date'  => date('Y-m-d H:i:s')
        ];
        if($avatar)
            $data['avatar'] = $avatar;

        if($password!='')
            $data['password'] = $password;

        // Update User Detail
        $result = $this->admin_model->update($id, $data);
        if($result!==true)
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Failed to update user!',
                        'errors' => $result
                    ]);


        // Update User Role
        $this->admin_model->removeAllRoles($id);
        $result = $this->admin_model->addRole($id, $role_id);
        if(!$result)
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Failed to update Permissions',
                    ]);

        // Update User Permissions if role is not superadmin
        if($role_name!='superadmin') {
            $this->admin_model->removeAllPermissions($id);
            $result = $this->admin_model->addPermissions($id, explode(',', $permission_ids));
            if(!$result)
                return  $this->jsonResponse([
                            'status' => false,
                            'message' => 'Failed to update Permissions',
                        ]);
        } else if ($this->client_id!=1) {
            // Remove Client permission from client superadmins
            $permission = $this->admin_model->getPermissionByKey('client_all');
            $this->admin_model->denyRole($id, $permission->id);
        }

        // Return Success
        return  $this->jsonResponse([
                    'status'  => true,
                    'message' => 'User updated succesfully',
                    'id'      => $id
                ]);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->admin_model->softDelete($id, $this->client_id);
        if(!$result)
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Failed to delete User',
                    ]);

        // Return Success
        return  $this->jsonResponse([
                    'status'  => true,
                    'message' => 'User deleted succesfully',
                    'id'      => $id
                ]);
    }
	
	public function getlanguageDetails()
    {
        $id = $this->input->post('country_id');
		$all_languages = $this->client_model->getLanguages($this->client_id);
        $resource_details = $this->legal_model->getLanguage($id, $this->client_id);
		
		// foreach($resource_details as $val){
			// foreach($all_languages as $key=>$lval){
				// if($lval['id'] == $val->language_id){
					// // echo $lval['id'].'-----------'.$val->language_id.'-------Key: '.$key;
					// // echo "<br />";
					// unset($all_languages[$key]);      
				// }
			// }
		// }
		
		
        $html = '';
        foreach ($all_languages as $val) {
            $html .='<option value='.$val['id'].'>'.$val['name'].'</option>';
        }
        //$resource_details = html_entity_decode($resource_details['content']);
        return $this->jsonResponse(['success' => true, 'data' => $html], 200);
    }
	
	public function addHelpline()
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
			$this->form_validation->set_rules('country', 'Country','required');
			$this->form_validation->set_rules('language_id', 'Language','required');
			$this->form_validation->set_rules('gender', 'Gender','required');
			$this->form_validation->set_rules('title', 'Emergency Title','required');
			$this->form_validation->set_rules('emerg_no', 'Emergency Number','required');
			
		if ($this->form_validation->run() == FALSE) {
			foreach ($this->input->post() as $key => $value)
			{
				$errors[$key] = form_error($key);
			}
			$json_data['errors'] = array_filter($errors); 
			$json_data['status'] = FALSE; 
			print_r($json_data);
			echo json_encode($json_data);
		}else 
		{
			//check if combination already exist
			// $condition_array = array('lang_id' => $this->input->post('language_id'), 'country_id' => $this->input->post('country'));
			// $this->db->select('*');
			// $this->db->from('legal_resources');
			// $this->db->where($condition_array);
			// $query = $this->db->get();
			// if ($query->num_rows() > 0)
			// {
				// $json_data = array(
					// 'country' => $this->input->post('country'),
					// 'language' => $this->input->post('language'),
					// 'status' => true,
					// 'success_exist' => 'Data already exist',
				// );
				// echo json_encode($json_data);
				// exit;
			// }else{
				
				$insertdata['client_id'] = $this->client_id;
				$insertdata['country_id'] = $this->input->post('country');
				$insertdata['lang_id'] = $this->input->post('language_id');
				
				if($this->input->post('category_id') !=''){
					$insertdata['category_id'] = $this->input->post('category_id');
				}
				$insertdata['gender_status'] = $this->input->post('gender');
				$insertdata['emergency_title'] = $this->input->post('title');
				$insertdata['emergency_no'] = $this->input->post('emerg_no');
				$insertdata['status'] = '1';
				$insertdata['added_by'] = $this->getLoggedInUser()->id;
				$insertdata['updated_by'] = $this->getLoggedInUser()->id;
				$insertdata['added_date'] = date('Y-m-d H:i:s');
				$insertdata['updated_date'] = date('Y-m-d H:i:s');
				
				$this->db->insert('emergency_helpline', $insertdata);
				
				// echo $this->db->last_query();exit;
				$json_data = array(
					'country' => $this->input->post('country'),
					'language' => $this->input->post('language'),
					'status' => true,
					'success_alert' => 'Data added successfully',
				);
				echo json_encode($json_data);
				exit;
			// }
		}
	}else{
		echo 'No direct access';
	}
    }

}
