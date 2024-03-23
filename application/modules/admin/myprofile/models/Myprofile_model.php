<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Myprofile_model extends CI_Model
{

    var $admins       = "admins";


    public function getUserByID()
    {
        $user_id      = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->where('id',$user_id);
        $query = $this->db->get($this->admins);
        $result = $query->result();
        //echo $this->db->last_query();die;
        return $result;
    }

}

  