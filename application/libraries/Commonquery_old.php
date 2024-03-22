<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Author : Dinesh Patil
Created Date : 25-07-2020
*/

class Commonquery  
{
    protected $CI;

    public function __construct() 
    {
       $this->CI =& get_instance();
    }


    # Get all record passing parameter as per required 
    public function getRecordFromTable($table, $fields, $where, $search_cnd, $orderby)
    {
        $this->CI->db->select($fields);
        $this->CI->db->from($table);
        if(!empty($search_cnd)){
            $this->CI->db->or_like($search_cnd);
        }
        if(!empty($where)){
            $this->CI->db->where($where);
        }
        if(!empty($orderby)){
            $this->CI->db->order_by($orderby);
        }
        $sql = $this->CI->db->get();
        if($sql->num_rows() > 0){
            return $sql->result_array();
        }else{
            return 0;
        }              
    }

    public function getIdByParameter($table, $fields, $where)
    {
        $this->CI->db->select($fields);
        $this->CI->db->from($table);
        $this->CI->db->where($where);
        $sql = $this->CI->db->get();
        // echo $this->CI->db->last_query();
        // exit;
        return $sql->row_array();
    }

    # Insert record
    public function addRecord($table_name,$data)
    {
        $this->CI->db->insert($table_name,$data);
        $lastid = $this->CI->db->insert_id();
        return $lastid;
    }

    #Update record
    public function updateRecord($table_name,$data,$where)
    {
        if(!empty($where))  {
            $this->CI->db->where($where);
          $this->CI->db->update($table_name, $data);
          return 1;
        }        
        return 0;
    }

    # Delete record
    public function deleteRecord($table_name,$where,$where_value)
    {
        if(!empty($where_value)) {
            $this->CI->db->where($where, $where_value);
            $this->CI->db->delete($table_name);
            return 1;
        }
        return 0;
    }

    public function humanTiming ($time)
    {
        // echo $time;exit;
        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s ago':' ago');
        }

    }

    public function searchByParameters($table, $fields, $where, $condition)
    {
        $this->CI->db->select($fields);
        $this->CI->db->from($table);
        $this->CI->db->where($where);
        $this->CI->db->like($condition);
        $sql = $this->CI->db->get();
        if($sql->num_rows() > 0){
            return $sql->result_array();
        }else{
            return 0;
        }
    }

}
