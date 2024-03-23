<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_user extends AdminController
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
        $data = ['pageTitle' => 'User Profiles'];
        $permissions = $this->ion_auth_acl->permissions('full');
        if($this->client_id!=1) {
            $permissions = array_filter($permissions, function($permission) {
                return $permission['key']!='client_all';
            });
        }
        $data['permissions'] = $permissions;
        $this->load->view('admin_user', $data);
    }

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

        $search_term = $this->input->post('search_term')??'';
        $result = $this->admin_model->getDataTableResults($start, $length, $search_term, $this->client_id);
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

}
