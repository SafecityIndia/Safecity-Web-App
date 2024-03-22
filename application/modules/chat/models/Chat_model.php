<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends CI_Model
{
    var $guest_table       = "users_guest";
    var $admin_table       = "login";
    var $chat_table        = "chat_message";
    var $guest_login_table = "guest_login_details";
    var $sync_table        = "chat_sync_user_guest";

    public function getGuestUserByID($guest_user_name, $client_id)
    {
        $this->db->where(array('guest_name'=>$guest_user_name, 'client_id'=>$client_id));
        $query = $this->db->get($this->guest_table);

        $result = $query->result();
        foreach($result as $row)
        {
            $user_name = $row->guest_name;
        }
        //echo $this->db->last_query();die;
        if (!empty($user_name)) {
            return $user_name;
        }
        else {
            return false;
        }
    }

    public function getGuestIDByUserName($guest_user_name, $client_id)
    {
        $this->db->where(array('guest_name'=>$guest_user_name, 'client_id'=>$client_id));
        $query = $this->db->get($this->guest_table);

        $result = $query->result();
        foreach($result as $row)
        {
            $guest_id = $row->guest_id;
        }
        //echo $this->db->last_query();die;
        if (!empty($guest_id)) {
            return $guest_id;
        }
        else {
            return false;
        }
    }

    public function getAdminUserByID($user_id, $client_id)
    {
        $this->db->where(array('user_name'=>$user_name, 'client_id'=>$client_id));
        $query = $this->db->get($this->admin_table);

        $result = $query->result();
        foreach($result as $row)
        {
            $user_name = $row->guest_name;
        }

        return $user_name;
    }

    public function reg_user($register_user_data)
    {
        $query = $this->db->insert($this->guest_table, $register_user_data);
        return $query;
    }

    public function updateUserGuest($guest_id, $update_user_guest)
    {
        $this->db->where('guest_id', $guest_id);
        $this->db->update($this->guest_table, $update_user_guest);
        $updated_status = $this->db->affected_rows();
        
        if($updated_status)
            return $guest_id;
        else
            return false;
    }

    public function guest_login_details($guest_login_data)
    {
        $this->db->insert($this->guest_login_table, $guest_login_data);
        return $this->db->insert_id();
    }

    /*public function insertGuestAdminSync($sync_current_guest)
    {
        $this->db->insert($this->sync_table, $sync_current_guest);
        return $this->db->insert_id();
    }*/

    public function fetch_guest_login_details($client_id, $guest_id)
    {
        $this->db->where(array('client_id'=>$client_id, 'guest_id'=>$guest_id));
        $query = $this->db->get($this->guest_login_table);

        $result = $query->result();
        foreach($result as $row)
        {
            $guest_login_id = $row->login_details_id;
        }

        return $guest_login_id;
    }

    public function update_guest_login_details($guest_login_details_id, $update_guest_login_data)
    {
        $this->db->where('login_details_id', $guest_login_details_id);
        $this->db->update($this->guest_login_table, $update_guest_login_data);
        //return $query;
        $updated_status = $this->db->affected_rows();
        
        if($updated_status)
            return $guest_login_details_id;
        else
            return false;
    }

    public function insert_user_chat($chat_data)
    {
        $query = $this->db->insert($this->chat_table, $chat_data);
        $id = $this->db->insert_id();
        $query = $this->db->get_where($this->chat_table, array('chat_message_id' => $id));
        return $query->result_array();
    }

    public function fetch_chat_history($client_id, $from_user_id, $to_user_id, $sent_by)
    {
        $wherecond = "(((client_id = '" . $client_id . "') AND (from_user_id = '" . $from_user_id . "' AND to_user_id = '" . $to_user_id . "') OR (from_user_id = '" . $to_user_id . "' AND to_user_id = '" . $from_user_id . "')))";
        $this->db->where($wherecond);
        if($sent_by == 'web') {
            $this->db->where('status', '1');
        }
        $query = $this->db->get($this->chat_table);
        return $query->result();
    }

    public function update_user_status($client_id, $from_user_id, $to_user_id, $update_chat_status)
    {
        $wherecond = "(((client_id = '" . $client_id . "') AND (from_user_id = '" . $from_user_id . "' AND to_user_id = '" . $to_user_id . "') OR (from_user_id = '" . $to_user_id . "' AND to_user_id = '" . $from_user_id . "')))";
        $this->db->where($wherecond);
        $this->db->where('status', '1');
        //$this->db->where(array('from_user_id' => $from_user_id, 'client_id'=>$client_id, 'status' => '1'));
        $query1 = $this->db->update($this->chat_table, $update_chat_status);
    }

    public function getSyncUsersDetail($client_id, $guest_id)
    {
        /*$this->db->where(array('client_id'=>$client_id, 'guest_id'=>$guest_id, 'status'=>1));
        $query = $this->db->get($this->sync_table);*/

        $this->db->where(array('client_id'=>$client_id, 'guest_name'=>$guest_id, 'sync_status'=>1));
        $query = $this->db->get($this->guest_table);
        $result = $query->result();
        return $result;
    }

    public function updateSyncUsersMsg($client_id, $guest_id, $admin_user, $update_sync_msg)
    {
        $this->db->where(array('client_id'=>$client_id, 'from_user_id'=>$guest_id, 'to_user_id'=>$admin_user, 'status'=>1));
        $query = $this->db->update($this->chat_table, $update_sync_msg);
    }

    public function deleteSyncUsersDetail($client_id, $guest_id, $update_sync_status)
    {
        /*$this->db->where(array('client_id'=>$client_id, 'guest_id'=>$guest_id, 'status'=>1));
        $query = $this->db->update($this->sync_table, $update_sync_status);*/

        $this->db->where(array('client_id'=>$client_id, 'guest_name'=>$guest_id, 'sync_status'=>1));
        $query = $this->db->update($this->guest_table, $update_sync_status);
    }

    //Chat Admin

    //Datatable1 Custom Query
    //datatable start

    public function _dataTableFilter()
    {
        $search = $this->input->post('chat_search');
        if($search!='') {
            $this->db->group_start();
            $this->db->like('guest_name', $search);
            $this->db->or_like('ct.title', $search);
            $this->db->or_like('lang.name', $search);
            $this->db->or_like('ir.building', $search);
            $this->db->or_like('ir.landmark', $search);
            $this->db->or_like('ir.area', $search);
            $this->db->or_like('ir.city', $search);
            $this->db->or_like('ir.state', $search);
            $this->db->or_like('ir.country', $search);
            $this->db->or_like('adm.first_name', $search);
            $this->db->or_like('adm.last_name', $search);
            $this->db->or_like('ug.status', $search);
            $this->db->or_like('gld.last_activity', $search);
            $this->db->group_end();
        }
    }

    public function getStatusesCount($client_id)
    {
        $this->db->select("SUM(IF(status='active', 1, 0)) AS 'active', SUM(IF(status='history', 1, 0)) AS 'history', SUM(IF((status='trashed' AND is_deleted=1), 1, 0)) AS 'trashed'");
        $this->db->from($this->guest_table);
        $this->db->where('client_id', $client_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_guestUsers_filter($status, $client_id)
    {
        $current_timestamp1 = strtotime(date("Y-m-d H:i:s") . '- 4 second');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp1);
        $this->db->select('ug.guest_name as guest_name, ug.admin_id as admin_user_id, ug.status as guest_status, ug.sync_status as admin_sync_status, ir.*, GROUP_CONCAT(DISTINCT ct.title SEPARATOR " | ") as categories, lang.name as language_name, gld.last_activity as ug_last_activity, IF(gld.last_activity > "' . $current_timestamp . '", "Online", "Offline") AS guest_online_status, IF(ug.admin_id IS NULL, "None", COALESCE(CONCAT(adm.first_name, " ", adm.last_name), "admin_name")) AS admin_name');
        $this->db->from($this->guest_table . ' as ug');
        $this->db->where('ug.status', $status);
        //$this->db->where('ir.lang_id', 1);
        $this->db->where('ug.client_id', $client_id);
        if ($status == 'active') {
            $wherecond = "((ug.admin_id IS NULL) OR (ug.admin_id = '" . $_SESSION['user_id'] . "'))";
            $this->db->where($wherecond);
        }
        if ($status == 'trashed') {
            $this->db->where('ug.is_deleted', 1);
        }
        $this->db->join('incident_reports as ir',' ug.guest_name=ir.id');
        $this->db->join('admins as adm',' ug.admin_id=adm.id','left');
        $this->db->join('categories_translation as ct', 'FIND_IN_SET(ct.category_id, ir.incident_category_ids) AND ct.is_default=1', 'left');
        $this->db->join('guest_login_details as gld', 'ug.guest_name=gld.guest_id', 'left');
        $this->db->join('languages as lang', 'FIND_IN_SET(lang.id, ir.lang_id)', 'left');

        $this->db->group_by('ug.guest_name');
        if ($status == 'active') {
            $this->db->having('guest_online_status','Online');
        }
        $this->db->order_by('ug.guest_name', 'desc');

        return $this->db;
    }

    function get_guestUsers($start, $length, $status, $client_id)
    {
        
        $this->_dataTableFilter();
        
        /*$this->db->select('ug.guest_name as guest_name, ug.admin_id as admin_user_id, ug.status as guest_status, ug.sync_status as admin_sync_status, ir.*, GROUP_CONCAT(DISTINCT ct.title SEPARATOR " | ") as categories, lang.name as language_name, gld.last_activity as ug_last_activity, IF(ug.admin_id IS NULL, "None", COALESCE(CONCAT(adm.first_name, " ", adm.last_name), "admin_name")) AS admin_name');*/
        //$this->db->from('users_guest as ug');

        $this->get_guestUsers_filter($status, $client_id);

        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        }
        else {
            $_POST['length']= $_POST['length'];
        }
        
        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        //$query_count = $query->num_rows();
        //echo $this->db->last_query();die;
        return $query->result();
    }
 
    function count_guestUsers_filtered($status, $client_id)
    {
        $this->_dataTableFilter();
        $this->get_guestUsers_filter($status, $client_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_guestUsers($status, $client_id)
    {
        //$this->db->from($this->guest_table);
        //$this->db->where(array('client_id'=>$client_id, 'status'=>$status));
        $this->_dataTableFilter();
        $this->get_guestUsers_filter($status, $client_id);
        return $this->db->count_all_results();
    }
    //datatable end

    //cron job function to send old chat in history
    public function update_guestUser_status($update_status)
    {
        $current_timestamp1 = strtotime(date("Y-m-d H:i:s") . '- 1 hour');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp1);
        $update_query = "UPDATE users_guest AS ug JOIN guest_login_details AS gld ON ug.guest_name = gld.guest_id SET `ug`.`status` = 'history', `ug`.`sync_status` = '0' WHERE `gld`.`last_activity` < '$current_timestamp' AND `ug`.`is_deleted`=1 AND `ug`.`status`='active'";
        $query = $this->db->query($update_query);
        return $query;
    }
}

