<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Logic_combination_model extends CI_Model {

	public function get_combination_json($form_id, $question_id, $ans_ids,$lang_id,$country_id)
	{
		$ans_id_arr = explode(',', $ans_ids);
		sort($ans_id_arr);
		$ans_ids = implode(',', $ans_id_arr);
	    $this->db->select('lc.id, lc.form_id, lc.question_id, lc.ans_ids, COALESCE(lcp.comb_json, lc.comb_json) as comb_json');
	    $this->db->from('logic_combinations as lc');
	    $this->db->join('logic_combinations as lcp', 'lc.parent_id=lcp.id', 'left');
	    $this->db->where('lc.form_id', $form_id);
	    $this->db->where('lc.question_id', $question_id);
	    $this->db->where('lc.ans_ids', $ans_ids);
		if(@$lang_id==6 && $country_id!=111){
			$this->db->where('lc.lang_id', $lang_id);
		}else{
			$this->db->where('lc.lang_id IS NULL');
		}
	    $query = $this->db->get();
	    return $query->result();
	}

	public function get_all_combination_json($form_id)
	{
		$this->db->select('COALESCE(lcp.comb_json, lc.comb_json) as comb_json, lc.id, lc.form_id, lc.question_id, lc.ans_ids');
		$this->db->from('logic_combinations as lc');
		$this->db->join('logic_combinations as lcp', 'lc.parent_id=lcp.id', 'left');
		$this->db->where('lc.form_id', $form_id);
		$query = $this->db->get();
		return $query->result();
	}

}