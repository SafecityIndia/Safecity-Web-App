<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Legal_ipc_model extends CI_Model {

	protected $ipc_table_name = 'legal_ipc';
	protected $cat_trans_table = 'categories_translation';

	public function getIPCSections($country_id,$city_id,$lang_id,$category_id)
	{
		/*$this->db->select('ipc.country_id, ipc.city_id, ipc.category_id, ipc.lang_id, ipc.ipc_sections, ct.title');
        $this->db->from($this->ipc_table_name . ' as ipc');
        $this->db->join($this->cat_trans_table . ' as ct',' ipc.category_id=ct.category_id AND ipc.lang_id=ct.lang_id','left');
        $wherecond = "((ipc.country_id ='".$country_id."' AND ipc.city_id ='".$city_id."' AND ct.lang_id='".$lang_id."' AND ipc.category_id IN (".$category_id.")) OR (ipc.country_id ='".$country_id."' AND ipc.city_id IS NULL AND ct.lang_id='".$lang_id."' AND ipc.category_id IN (".$category_id.") ))";
        $this->db->where($wherecond);*/

        $this->db->select('ipc.country_id, ipc.city_id, ipc.category_id, ipc.lang_id, ipc.ipc_sections, ct.title');
        $this->db->from($this->ipc_table_name . ' as ipc');
        $this->db->join($this->cat_trans_table . ' as ct',' ipc.category_id=ct.category_id AND ct.lang_id='.$lang_id,'left');
        $wherecond = "((ipc.country_id ='".$country_id."' AND ipc.city_id ='".$city_id."' AND ipc.category_id IN (".$category_id.")) OR (ipc.country_id ='".$country_id."' AND ipc.city_id IS NULL AND ipc.category_id IN (".$category_id.") ))";
        $this->db->where($wherecond);
        
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return 0;
        }
	}
}