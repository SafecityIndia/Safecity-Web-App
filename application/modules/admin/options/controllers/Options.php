<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Options extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('resources_model');
        $this->load->model('client_model');
        $this->load->model('country_model');
    }

    public function index()
    {
		if($_SESSION['user_id']==30){
			$country_id = 111;
		}else{
			$country_id = 101;
		}
		
		// Load required models
        $this->load->model('report_incident/question_model');
        $this->load->model('report_incident/category_model');

        // Get all forms for client and language
        $forms = $this->get_by_client_and_language($country_id=101,$client_id=1, $lang_id=1);
        
		
		
        // Get all question ids required by each of the forms
        $question_id_arr = [];
        
		$res = $this->db->query('SELECT * FROM `question_translation` WHERE `country_id` IS NULL and `lang_id` = 1')->result();
		
		foreach($res as $val){
			$question_id_arr[] = $val->id;
		}
		
        $uniq_ques_ids = array_unique($question_id_arr);
		
        if(count($uniq_ques_ids)>0) {
            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->admin_get_questions_with_options($uniq_ques_ids, $lang_id=1, $country_id=101);
            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options); 
        } else {
            $questions = [];
        }
		
        $client_id = $this->client_id;
        $data = ['pageTitle' => 'Safecity Webapp'];
		if($_SESSION['user_id']==30){
			$data['languages'] = $this->client_model->getJordanLanguages($client_id);
			$country_id_arr =  explode(',', 111);
		}else{
			$data['languages'] = $this->client_model->getLanguages($client_id);
			 // Get all country ids
			$country_ids = $this->resources_model->getCountryIds($client_id);
			$country_id_arr =  explode(',', $country_ids);
		}
        
        $data['questions'] = $questions;
        $data['countries'] = $this->country_model->getByIds($country_id_arr);
        $this->load->view('options', $data);
    }

	public function get_by_client_and_language($country_id,$client_id, $lang_id, $name='')
    {
        $this->db->select('f.id, f.client_id, f.lang_id, f.type, f.question_ids_json, f.is_submit, f.name, f.created_on, ft.content as thank_you_web');
        $this->db->from('forms as f');
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
	
   public function updateTitle()
    {
            $errors =  array();
            $json_data = array();
            $this->load->library('form_validation');
            $this->load->helper(array(
            'form',
            'url'
            ));
        if ($this->input->is_ajax_request()) {
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('optiontitle', 'Title','required');
            if ($this->form_validation->run() == FALSE) {
				foreach ($this->input->post() as $key => $value)
				{
					$errors[$key] = form_error($key);
				}
				$json_data['errors'] = array_filter($errors); 
				$json_data['status'] = FALSE; 
				echo json_encode($json_data);
            }else 
            {	
				$this->db->where('option_id', $this->input->post('optionid'));
				$this->db->where('lang_id', $this->input->post('language'));
				if($this->input->post('country')==101){
					$this->db->update('option_translation', array('title' => $this->input->post('optiontitle')));
				}else{
					$this->db->update('option_translation', array('jordan_title' => $this->input->post('optiontitle')));
				}
				// echo $this->db->last_query();exit;
				$json_data = array(
					'country' => $this->input->post('country'),
					'language' => $this->input->post('language'),
					'status' => true,
					'status' => true,
					'modalid' => $this->input->post('optionid'),
					'success_alert' => 'Data updated successfully',
				);
				echo json_encode($json_data);
                exit;
            }
        }else{
            echo 'No direct access';
        }
    }
	
	
		public function getForm()
    {
		// Load required models
        $this->load->model('report_incident/question_model');
        $this->load->model('report_incident/category_model');
		if($this->input->post('country')!=''){
			$country_id = $this->input->post('country');
		}else{
			$country_id = 101;
		}
		
		if($this->input->post('language')!=''){
			$language = $this->input->post('language');
		}else{
			$language = 1;
		}
		
		
        // Get all forms for client and language
        $forms = $this->get_by_client_and_language($country_id,$client_id=1, $language);
		
        // Get all question ids required by each of the forms
        $question_id_arr = [];
        
		if($_SESSION['user_id']==30){
			$res = $this->db->query('SELECT * FROM `question_translation` WHERE `country_id` = 111 and `lang_id` = "'.$language.'" ')->result();
		}else{
			$res = $this->db->query('SELECT * FROM `question_translation` WHERE `country_id` IS NULL and `lang_id` = "'.$language.'" ')->result();
		}
		// echo $this->db->last_query();
		foreach($res as $val){
			$question_id_arr[] = $val->question_id;
		}
		
        $uniq_ques_ids = array_unique($question_id_arr);
		
        if(count($uniq_ques_ids)>0) {
            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->admin_get_questions_with_options($uniq_ques_ids, $language, $country_id);
			
            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options); 
        } else {
            $questions = [];
        }
		
        $client_id = $this->client_id;
        $data = ['pageTitle' => 'Safecity Webapp'];
		if($_SESSION['user_id']==30){
			$data['languages'] = $this->client_model->getJordanLanguages($client_id);
			$country_id_arr =  explode(',', 111);
		}else{
			$data['languages'] = $this->client_model->getLanguages($client_id);
			 // Get all country ids
			$country_ids = $this->resources_model->getCountryIds($client_id);
			$country_id_arr =  explode(',', $country_ids);
		}
        
        $data['questions'] = $questions;
        $data['countries'] = $this->country_model->getByIds($country_id_arr);
		$i = 1;
		$html = '';
		foreach($questions as $val){
			if(@$questions[$i]['question']['question']!='' && (@$questions[$i]['question']['properties'] !=''))
			{
				$html .= '<div class="col-12">
						<div class="form-group">
						<div class="label fs-15" style="margin-bottom:10px;">'.$i.'&nbsp;&nbsp;&nbsp;&nbsp;'.''.@$questions[$i]['question']['question'].' ';
						
				$html .= '</div>';
				foreach(@$questions[$i]['options'] as $optionval){
					if($optionval['title']!=''){
					$html .= '<div class="form-group row">
	<div class="col-sm-5">
	  <input type="text" class="form-control" readonly disabled id="'.@$optionval['order_no'].'" value="'.@$optionval['title'].'" style="margin-bottom:10px;" />
	</div>
	<label for="'.@$optionval['order_no'].'" class="col-sm-2 col-form-label"><a class="exportRecordBtn" data-attr="'.@$optionval['id'].'" id="exportRecordBtn" data-target="#exportRecordModal'.@$optionval['id'].'">
		Edit
	</a></label>
  </div>';
  foreach(@$questions[$i]['suboptions'][@$optionval['id']] as $suboption){
  $html .='<div class="form-group row" style="margin-left:10px;">
	<div class="col-sm-5">
	  <input type="text" class="form-control" readonly disabled id="'.@$suboption['order_no'].'" value="'.@$suboption['title'].'" style="margin-bottom:10px;" />
	</div>
	<label for="'.@$suboption['order_no'].'" class="col-sm-2 col-form-label"><a class="suboptionRecordBtn" data-attr="'.@$suboption['id'].'" id="suboptionRecordBtn" data-target="#suboptionModal'.@$suboption['id'].'">
		Edit
	</a></label>
  </div>
  
    	<div class="modal fade" id="suboptionModal'.@$suboption['id'].'" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						'.$optionval['title'].'
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<form id="update_optiontitle" class="update_optiontitle" method="post">
						<div class="download-incident">
						<div class="row">
							<div class="col-md-12">
								<div class="newrangein">
									<div class="dropdown ">
										<div class="input-group input-daterange">
											<div class="row">
												<div class="col-12">
													<input type="hidden" value="'.$suboption['id'].'" id="optionid" name="optionid" class="form-control">
													<input type="text"  value="'.$suboption['title'].'" id="optiontitle" data-required="true" name="optiontitle" value="" class="form-control">
													<div class="invalid-msg text-danger"></div>
												</div>
											</div>
									   </div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<br />
							</div>
						</div>
						<div class="invalid-msg text-danger">Errro</div>
							<button type="submit" class="btn btn-primary" id="savetitle" >Update</button>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>';
  }									
    $html .='<div class="modal fade" id="exportRecordModal'.@$optionval['id'].'" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
					'.@$questions[$i]['question']['question'].'
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				<form id="update_optiontitle" class="update_optiontitle" method="post">
                    <div class="download-incident">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="newrangein">
                                <div class="dropdown ">
                                    <div class="input-group input-daterange">
            							<div class="row">
            							    <div class="col-12">
                                                <input type="hidden" value="'.$optionval['id'].'" id="optionid" name="optionid" class="form-control">
                                                <input type="text" value="'.$optionval['title'].'" id="optiontitle" data-required="true" name="optiontitle" value="" class="form-control">
												<div class="invalid-msg text-danger"></div>
                                            </div>
            							</div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <br />
                        </div>
                    </div>
                    <div class="invalid-msg text-danger">Errro</div>
						<button type="submit" class="btn btn-primary" id="savetitle" >Update</button>
                    </div>
				</form>
                </div>
            </div>
        </div>
    </div>';
					}
				}
				$html .= '</div>
					</div>';
			}
		$i++;
		}
        echo $html;exit;
    }
}