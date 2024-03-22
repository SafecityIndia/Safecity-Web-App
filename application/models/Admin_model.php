<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	protected $table_name = 'admins';
	protected $permission_mapping_table = 'admins_permissions';
	protected $role_table = 'roles';
	protected $role_pivot_table = 'admin_role';

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('ion_auth_acl');
	}

	public function ignoreSoftDeleted()
	{
		$this->db->where('deleted_on', NULL);
	}

	public function setIonAuthExtraWhereHook()
	{
		$this->ion_auth->set_hook('extra_where', 'check_where', $this, 'ignoreSoftDeleted', []);
	}

	public function get($id)
	{
		return $this->ion_auth->user($id)->row();
	}

	/**
	 * Get Roles for user id or logged in user
	 * @param  integer $id
	 * @return ArrayObject
	 */
	public function getRoles($id=FALSE)
	{
		return $this->ion_auth->get_users_groups($id)->result();
	}

	/**
	 * Assign role to User
	 * @param integer  $id 		 User Id
	 * @param integer  $role_id  Role/Group Id
	 * @return Boolean
	 */
	public function addRole($id, $role_id)
	{
		return $this->ion_auth->add_to_group($role_id, $id);
	}

	/**
	 * Deny specific role
	 * @param  integer $id      User Id
	 * @param  integer $role_id Permission Id
	 * @return Boolean
	 */
	public function denyRole($id, $role_id)
	{
		$this->db->where('user_id', $id);
		$this->db->where('perm_id', $role_id);
		$total = $this->db->count_all_results($this->permission_mapping_table);
		if($total>0)
			return $this->db->update($this->permission_mapping_table, ['value' => 0]);
		return $this->db->insert($this->permission_mapping_table, [
			'user_id' => $id,
			'perm_id' => $role_id,
			'value'   => 0
		]);
	}

	/**
	 * Remove all roles for given user id
	 * @param  integer $id
	 * @return Boolean
	 */
	public function removeAllRoles($id)
	{
		return $this->ion_auth->remove_from_group(NULL, $id);
	}

	/**
	 * Get Permissions for user id or logged in user
	 * @param integer $id
	 * @return Array
	 */
	public function getPermissions($id=FALSE)
	{
		return $this->ion_auth_acl->get_user_permissions($id);
	}

	/**
	 * Get permission by keyname
	 * @param  string $key
	 * @return Object
	 */
	public function getPermissionByKey($key)
	{
		$this->db->where('perm_key', $key);
		$this->db->from('permissions');
		$query = $this->db->get();
		return $query->row();
	}

	/**
	 * Allow provided permissions for the given user id
	 * @param integer $id
	 * @param array $permission_ids
	 * @return Boolean
	 */
	public function addPermissions($id, $permission_ids)
	{
		$data = array_map(function($permission_id) use ($id) {
					return [
						'user_id' => $id,
						'perm_id' => $permission_id,
						'value'   => 1,
					];
				}, $permission_ids);
		return $this->db->insert_batch($this->permission_mapping_table, $data);
	}

	/**
	 * Remove all permissions for given user id
	 * @param  integer $id
	 * @return Boolean
	 */
	public function removeAllPermissions($id)
	{
		return $this->db->delete($this->permission_mapping_table, ['user_id' => $id]);
	}

	/**
	 * Create Admin User
	 * @param  array $data_arr
	 * @param  array $role_id_arr
	 * @return Mixed                Returns new id or false if failed
	 */
	public function create($data_arr, $role_id_arr)
	{
		$this->setIonAuthExtraWhereHook();
		return $this->ion_auth->create_user($data_arr['username'], $data_arr['password'], $data_arr['email'], $data_arr, $role_id_arr);
	}

	/**
	 * Update Data
	 * @param  integer $report_id
	 * @param  array   $data_arr
	 * @param  string  $user_id
	 * @return Boolean
	 */
	public function update($id, $data_arr, $user_id='')
	{
		$result = $this->ion_auth->update($id, $data_arr);
		if(!$result)
			return $this->ion_auth->errors_array();
		return true;
	}

	public function softDelete($id, $client_id=1)
	{
		$this->db->where('client_id', $client_id);
		return $this->db->where('id', $id)->update($this->table_name, ['deleted_on' => date('Y-m-d H:i:s')]);
	}

	/**
	 * Get total record counts
	 * @param  string $client_id
	 * @return integer
	 */
	public function getTotalRecords($client_id=1)
	{
		$this->db->where('client_id', $client_id);
		return $this->db->where('deleted_on', null)->count_all_results($this->table_name);
	}

	/** DataTables */

	public function dataTableQuery()
	{
		$this->db->select('a.*, r.name as role_name');
		$this->db->from($this->table_name.' as a');
		$this->db->join($this->role_pivot_table.' as ra', 'ra.admin_id=a.id');
		$this->db->join($this->role_table.' as r', 'ra.role_id=r.id');
		$this->db->where('a.deleted_on', null);
		return $this->db;
	}

	public function dataTableFilter($search='')
	{
		if($search!='') {
			$this->db->group_start();
			$this->db->like('username', $search);
			$this->db->or_like('email', $search);
			$this->db->or_like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->or_like('company', $search);
			$this->db->or_like('phone', $search);
			$this->db->group_end();
		}

	}

	public function fetchResultByIds($id_arr)
	{
		$this->dataTableQuery();
		$this->db->where_in('st.id', $id_arr);
		$this->db->order_by('added_date', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDataTableResults($start=0, $length=10, $search='', $client_id=1)
	{
		// Get Total Count
		$total_count = $this->getTotalRecords($client_id);

		// Get total count after filtering
		$this->dataTableQuery();

		// Set filters
		$this->dataTableFilter($search);
		$this->db->where('client_id', $client_id);
		$filtered_records = $this->db->count_all_results();

		$this->dataTableQuery();
		// Set Filters
		$this->dataTableFilter($search);
		$this->db->where('client_id', $client_id);
		//$this->db->order_by('added_date', 'desc');

		// Get limited records
		if($length!='all')
			$this->db->limit($length, $start);
		$query = $this->db->get();
		$results = $query->result_array();
		return [
			'total_records' 	=> $total_count,
			'filtered_records'  => $filtered_records,
			'results' 			=> $results,
		];
	}


	public function update_data($table,$column,$match_value,$data)
    {
        $this->db->where($column, $match_value);
        $this->db->update($table, $data);
    }


	public function verify_user($password,$user_password)
    {
    	return $this->ion_auth->verify_password($password, $user_password);
    }

    	public function check_email($email)
    {
    	$id  = $this->session->userdata('user_id');
		$this->db->select('id');
		$this->db->from('admins');
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		return $query->result_array();
    }

}