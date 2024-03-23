<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function getClientCategories($client_id, $language_id,$country_id)
	{
		$this->db->select('c.*, COALESCE(ct.title, ct1.title) as title, COALESCE(ct.lang_id, ct1.lang_id) as lang_id');
		$this->db->from('categories as c');
		$this->db->join('client_categories as cc', 'c.id = cc.category_id AND cc.client_id='.$client_id);
		$this->db->join('categories_translation as ct', 'c.id = ct.category_id AND ct.lang_id='.$language_id, 'left');
		
		if($country_id==111){
			$this->db->join('categories_translation as ct1', 'c.id = ct1.category_id AND ct1.is_default=0');
			$this->db->where('ct.country_id', 111);
			$this->db->where('ct1.country_id', 111);
		}else{
			$this->db->join('categories_translation as ct1', 'c.id = ct1.category_id AND ct1.is_default=1');
			$this->db->where('ct.country_id IS NULL');
			$this->db->where('ct1.country_id IS NULL');
		}
		$query = $this->db->get();
	    return $query->result_array();
	}

}