<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Form_model extends CI_Model {

	protected $table_name = 'forms';

    public function getForms($client_id, $lang_id, $country_id=101)
    {
        // Load required models
        $this->load->model('report_incident/question_model');
        $this->load->model('report_incident/category_model');

        // Get all forms for client and language
        $forms = $this->get_by_client_and_language($country_id,$client_id, $lang_id);
        
        // Get all question ids required by each of the forms
        $question_id_arr = [];
        foreach ($forms as $form) {
            if($form->question_ids_json=='')
                continue;
            $flows = json_decode($form->question_ids_json);
            foreach ($flows as $flow_obj) {
                if($form->type!='logic') {
                    $this->question_model->getQuestionIdRecursive((array) $flow_obj, $question_id_arr);
                }/* else {
                    foreach ($flow_obj as $obj) {
                        $this->getQuestionIdRecursive((array) $obj, $question_id_arr);
                    }
                }*/
            }
        }
        $uniq_ques_ids = array_unique($question_id_arr);
		

        if(count($uniq_ques_ids)>0) {
            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids, $lang_id, $country_id);
            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options); 
        } else {
            $questions = [];
        }
       
        // Get Categories
        $categories = $this->category_model->getClientCategories($client_id, $lang_id,$country_id);

        return ['forms' => $forms, 'questions' => $questions, 'categories' => $categories, 'form_query' => $uniq_ques_ids, 'lang_id' => $lang_id];
    }

    public function get_by_client_and_language($country_id,$client_id, $lang_id, $name='')
    {
        $this->db->select('f.id, f.client_id, f.lang_id, f.type, f.question_ids_json, f.is_submit, f.name, f.created_on, ft.content as thank_you_web');
        $this->db->from($this->table_name.' as f');
        $this->db->join('form_thankyou as ft', 'f.id=ft.form_id and ft.lang_id='.$lang_id, 'left');
        $this->db->where('client_id', $client_id);
		if(@$country_id==111){
			$this->db->where('f.country_id', $country_id);
		}else{
			$this->db->where('f.country_id IS NULL');
		}
        if($name!='')
        $this->db->where('name', $name);
		$this->db->order_by("f.id", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getQuestionIdRecursive($flow_arr, &$question_id_arr)
    {
        foreach ($flow_arr as $parent_key => $parent_value) {
            if($parent_key=='question_id') {
                $question_id_arr[] = $parent_value;
            }
            else if(is_array($parent_value)) {
                foreach ($parent_value as $child_key => $child_value) {
                    $this->getQuestionIdRecursive((array) $child_value, $question_id_arr);
                }
            }
        }
    }

    public function getTotalRecords($is_submit='')
    {
    	if($is_submit!='')
    		$this->db->where('is_submit', $is_submit);
    	return $this->db->count_all_results($this->table_name);
    }

    /** DataTables */

    public function dataTableQuery()
    {
    	$this->db->select('f.*, l.id as language_id, l.name as language');
    	$this->db->from($this->table_name.' as f');
        $this->db->join('client_languages as cl', 'f.client_id=cl.client_id', 'left');
        $this->db->join('languages as l', 'cl.language_id=l.id', 'left');
    	return $this->db;
    }

    public function dataTableFilter($is_submit='', $language_id='')
    {
    	if($is_submit!='')
    		$this->db->where('is_submit', $is_submit);
    	if($language_id!='')
    		$this->db->where('l.id', $language_id);
    }

    public function getDataTableResults($start=0, $length=10, $is_submit='', $language_id='')
    {
    	// Get Total Count
    	$total_count = $this->getTotalRecords($is_submit);

    	// Get total count after filtering
    	$this->dataTableQuery();

    	// Set filters
    	$this->dataTableFilter($is_submit, $language_id);
    	$filtered_records = $this->db->count_all_results();

    	$this->dataTableQuery();
    	// Set Filters
    	$this->dataTableFilter($is_submit, $language_id);
    	
    	// Get limited records
    	$this->db->limit($length, $start);
    	$query = $this->db->get();
    	$results = $query->result_array();
    	return [
    		'total_records' 	=> $total_count,
    		'filtered_records'  => $filtered_records,
    		'results' 			=> $results,
    	];
    }

}