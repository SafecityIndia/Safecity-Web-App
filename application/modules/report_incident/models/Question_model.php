<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Question_model extends CI_Model {

    /*public function get_questions_with_options($question_id_arr)
    {
    	$this->db->select('q.id as question_id, q.question, q.subtext, q.properties, q.has_logic_dependency, q.is_category, q.tags, o.id as option_id, o.title, o.is_main, o.parent_id, o.textbox_placeholder');
    	$this->db->from('questions as q');
    	$this->db->join('options as o', 'q.id = o.question_id', 'left');
    	$this->db->where_in('q.id', $question_id_arr);
    	$query = $this->db->get();
        return $query->result_array();
    }*/

    public function get_questions_with_options($question_id_arr, $lang_id=1, $country_id=101)
    {
        $query = 'q.id as question_id, q.has_logic_dependency, q.is_category,q.tags,qt.country_id,COALESCE(qt.question,qt1.question) as question,COALESCE(qt.subtext, qt1.subtext) as subtext,COALESCE(qt.lang_id, qt1.lang_id) as lang_id,COALESCE(qt.properties, qt1.properties) as properties,o.id as option_id, o.order_no, o.is_main, o.parent_id, o.suboption_properties, o.suboption_of, o.tags as option_tag,';

		if($country_id==111){
			$query .= 'COALESCE(ot.jordan_title,ot1.jordan_title) as title ,';
		}else{
			$query .= 'COALESCE(ot.title,ot1.title) as title ,';
		}

		
		
		$query .= ' COALESCE(ot.textbox_placeholder,ot1.textbox_placeholder) as textbox_placeholder, COALESCE(ot.for_countries, ot1.for_countries) as for_countries, COALESCE(ot.not_for_countries, ot1.not_for_countries) as not_for_countries';
		
		$this->db->select($query);
		
        $this->db->from('questions as q');
        $this->db->join('question_translation as qt', 'q.id=qt.question_id and qt.lang_id='.$lang_id, 'left');
        $this->db->join('question_translation as qt1', 'q.id=qt1.question_id and qt1.is_default=1', 'left');
        $this->db->join('options as o', 'q.id = o.question_id', 'left');
        $this->db->join('option_translation as ot', 'o.id=ot.option_id and ot.lang_id='.$lang_id, 'left');
		if($lang_id==6){
			$this->db->join('option_translation as ot1', 'o.id=ot1.option_id and ot1.is_default = 0 AND ot1.lang_id = '.$lang_id.' ', 'left');
		}else{
			$this->db->join('option_translation as ot1', 'o.id=ot1.option_id and ot1.is_default=1', 'left');
		}
        
        $this->db->where_in('q.id', $question_id_arr);
        // To select options based on country
        $this->db->group_start();
        $this->db->where('ot.not_for_countries IS NULL');
        $this->db->or_where('ot1.not_for_countries IS NULL');
            $this->db->or_group_start();
                $this->db->where("!FIND_IN_SET($country_id, ot.not_for_countries)");
                $this->db->where("!FIND_IN_SET($country_id, ot1.not_for_countries)");
                $this->db->group_start();
                    $this->db->where("FIND_IN_SET($country_id, ot.for_countries)");
                    $this->db->where("FIND_IN_SET($country_id, ot1.for_countries)");
                    $this->db->or_group_start();
                        $this->db->where('ot.for_countries', "0");
                        $this->db->where('ot1.for_countries', "0");
                    $this->db->group_end();
                $this->db->group_end();
            $this->db->group_end();
        $this->db->group_end();
        // To select options based on country end
        //$this->db->or_where('q.id', 27);
		
		
		
		//added by Vandana
		if($country_id==111){
			$this->db->where('qt.country_id', 111);
			$this->db->where('qt1.country_id', 111);
			$this->db->where('o.country_id IS NULL');
			
			// $this->db->where('ot.country_id', 111);
            // $this->db->where('ot1.country_id', 111);
		}else{
			$this->db->where('qt.country_id IS NULL');
			$this->db->where('qt1.country_id IS NULL');
			$this->db->where('o.country_id IS NULL');
			
			// $this->db->where('ot.country_id IS NULL');
			// $this->db->where('ot1.country_id IS NULL');

		}
		//added by Vandana
		
        $query = $this->db->get();
		// echo $this->db->last_query();exit;
        return $query->result_array();
    }
	
	
	public function admin_get_questions_with_options($question_id_arr, $lang_id=1, $country_id=101)
    {
        $query = 'q.id as question_id, q.has_logic_dependency, q.is_category,q.tags,qt.country_id,COALESCE(qt.question,qt1.question) as question,COALESCE(qt.subtext, qt1.subtext) as subtext,COALESCE(qt.lang_id, qt1.lang_id) as lang_id,COALESCE(qt.properties, qt1.properties) as properties,o.id as option_id, o.order_no, o.is_main, o.parent_id, o.suboption_properties, o.suboption_of, o.tags as option_tag,';

		if($country_id==111){
			$query .= 'COALESCE(ot.jordan_title,ot1.jordan_title) as title ,';
		}else{
			$query .= 'COALESCE(ot.title,ot1.title) as title ,';
		}

		
		
		$query .= ' COALESCE(ot.textbox_placeholder,ot1.textbox_placeholder) as textbox_placeholder, COALESCE(ot.for_countries, ot1.for_countries) as for_countries, COALESCE(ot.not_for_countries, ot1.not_for_countries) as not_for_countries';
		
		$this->db->select($query);
		
        $this->db->from('questions as q');
        $this->db->join('question_translation as qt', 'q.id=qt.question_id and qt.lang_id='.$lang_id, 'left');
        $this->db->join('question_translation as qt1', 'q.id=qt1.question_id and qt1.is_default=1', 'left');
        $this->db->join('options as o', 'q.id = o.question_id', 'left');
        $this->db->join('option_translation as ot', 'o.id=ot.option_id and ot.lang_id='.$lang_id, 'left');
		if($lang_id==6){
			$this->db->join('option_translation as ot1', 'o.id=ot1.option_id and ot1.is_default = 0 AND ot1.lang_id = '.$lang_id.' ', 'left');
		}else{
			$this->db->join('option_translation as ot1', 'o.id=ot1.option_id and ot1.is_default=1', 'left');
		}
        
        $this->db->where_in('q.id', $question_id_arr);
        // To select options based on country
        $this->db->group_start();
        $this->db->where('ot.not_for_countries IS NULL');
        $this->db->or_where('ot1.not_for_countries IS NULL');
            $this->db->or_group_start();
                $this->db->where("!FIND_IN_SET($country_id, ot.not_for_countries)");
                $this->db->where("!FIND_IN_SET($country_id, ot1.not_for_countries)");
                $this->db->group_start();
                    $this->db->where("FIND_IN_SET($country_id, ot.for_countries)");
                    $this->db->where("FIND_IN_SET($country_id, ot1.for_countries)");
                    $this->db->or_group_start();
                        $this->db->where('ot.for_countries', "0");
                        $this->db->where('ot1.for_countries', "0");
                    $this->db->group_end();
                $this->db->group_end();
            $this->db->group_end();
        $this->db->group_end();
        // To select options based on country end
        //$this->db->or_where('q.id', 27);
		
		
		
		//added by Vandana
		if($country_id==111){
			$this->db->where('qt.country_id', 111);
			$this->db->where('qt1.country_id', 111);
			$this->db->where('o.country_id IS NULL');
			
			// $this->db->where('ot.country_id', 111);
            // $this->db->where('ot1.country_id', 111);
		}else{
			$this->db->where('qt.country_id IS NULL');
			$this->db->where('qt1.country_id IS NULL');
			$this->db->where('o.country_id IS NULL');
			
			// $this->db->where('ot.country_id IS NULL');
			// $this->db->where('ot1.country_id IS NULL');

		}
		//added by Vandana
		
        $query = $this->db->get();
		// echo $this->db->last_query();exit;
        return $query->result_array();
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

    public function formatQuestionOptions($question_with_options)
    {
        $questions = [];
        foreach ($question_with_options as $question_option) {
			
            if(empty($questions[$question_option['question_id']]['question'])) {

                // Fill the question with id as the key
                $questions[$question_option['question_id']]['question'] = [
                    "id"                   => $question_option['question_id'],
                    "question"             => $question_option['question'],
                    "subtext"              => $question_option['subtext'],
                    "properties"           => $question_option['properties'],
                    "has_logic_dependency" => $question_option['has_logic_dependency'],
                    "is_category"          => $question_option['is_category'],
                    "tags"                 => $question_option['tags']
                ];

            }

            // Fill in all the options inside the questions
            $option = [
                'id' => $question_option['option_id'],
                'question_id' => $question_option['question_id'],
                'order_no' => $question_option['order_no'],
                'title' => $question_option['title'],
                'is_main' => $question_option['is_main']??0,
                'parent_id' => $question_option['parent_id']??0,
                'suboption_properties' => $question_option['suboption_properties'],
                'textbox_placeholder' => $question_option['textbox_placeholder'],
                "tags"                 => $question_option['option_tag']
            ];

            if($question_option['suboption_of']!=0) {
                $questions[$question_option['question_id']]['suboptions'][$question_option['suboption_of']][] = $option;
            }
            else
                $questions[$question_option['question_id']]['options'][] = $option;
        }
        return $questions;
    }

    public function getUniqueTags()
    {
    	$this->db->distinct('tags');
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function get_genders($lang_id=1)
    {
        $query = $this->db->query("SELECT GROUP_CONCAT(o.id SEPARATOR ',') as ids, GROUP_CONCAT(ot.title SEPARATOR ',') as titles FROM `questions` as q JOIN options as o ON o.question_id=q.id JOIN option_translation ot ON ot.option_id=o.id where q.tags like '%gender%' AND ot.lang_id=".$lang_id);
        return $query->result_array();
    }
    public function get_categories($lang_id=1)
    {
        $this->db->select('category_id,title');
        $this->db->from('categories_translation');
        $this->db->where('lang_id', $lang_id);
        //$this->db->where_in('title', $category_ids);
        $query = $this->db->get();
        return $query->result_array();
    }
}