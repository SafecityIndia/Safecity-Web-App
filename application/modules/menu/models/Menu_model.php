<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getHelplineNbr($client_id,$country_id,$lang_id,$category_id,$gender_id,$city_id)
	{
		$category_id = $category_id.',"All"';
		$SQL = "SELECT * FROM emergency_helpline WHERE client_id='".$client_id."' AND  (country_id='".$country_id."' AND city_id='".$city_id."') OR (country_id='".$country_id."' OR city_id=NULL) AND lang_id='".$lang_id."' AND category_id in (".$category_id.") ";

		if($gender_id==4) $SQL .= 'AND gender_status in (3,2)';
		else if($gender_id==5) $SQL .= 'AND gender_status in (1,2)';

		$SQL .= ' ORDER BY emergency_no+0';

		$query = $this->db->query($SQL);
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	public function getIPCSections($client_id,$lang_id,$category_id)
	{
		$SQL = "SELECT cc.client_id,cc.category_id,cc.lang_id,cc.ipc_sections,ct.title from categories_translation as ct, client_categories as cc where cc.category_id=ct.category_id and cc.lang_id=ct.lang_id and cc.lang_id=".$lang_id." and cc.client_id=".$client_id." and cc.category_id in (".$category_id.")";
		$query = $this->db->query($SQL);
		return $query->result_array();
	}

	public function getIncidentData($id, $lang_id=1)
	{
		$this->db->select("gender_id,incident_category_ids,COALESCE(GROUP_CONCAT(DISTINCT ct.title SEPARATOR ' | '), GROUP_CONCAT(DISTINCT ct1.title SEPARATOR ' | ')) as categories");
        $this->db->from("incident_reports as ir");
        $this->db->join('categories_translation as ct', 'FIND_IN_SET(ct.category_id, ir.incident_category_ids) AND ct.lang_id='.$lang_id, 'left');
		$this->db->join('categories_translation as ct1', 'FIND_IN_SET(ct1.category_id, ir.incident_category_ids) AND ct1.is_default=1', 'left');
        $this->db->where('ir.id', $id);
        $sql = $this->db->get_compiled_select();
        $query = $this->db->query($sql);
		return $query->result_array();
	}

	public function categoryFilter($category_id,$column_name)
	{
		$category_id = $category_id.',All';
		$cat_arr = explode(',', $category_id);
		$cat_query = '';
		foreach ($cat_arr as $cat_id) {
			if($cat_query=='')
				$cat_query .= "FIND_IN_SET('".$cat_id."', category_id)";
			else
				$cat_query .= " OR FIND_IN_SET('".$cat_id."', category_id)";
		}
		return $cat_query;
	}

	public function IPCFilter($category_id,$column_name)
	{
		$cat_arr = explode(',', $category_id);
		$cat_query = '';
		foreach ($cat_arr as $cat_id) {
			if($cat_query=='')
				$cat_query .= "FIND_IN_SET('".$cat_id."', $column_name)";
			else
				$cat_query .= " OR FIND_IN_SET('".$cat_id."', $column_name)";
		}
		return $cat_query;
	}

}

