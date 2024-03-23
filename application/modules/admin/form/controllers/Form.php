<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Form extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_incident/form_model');
        $this->load->model('report_incident/question_model');
        $this->load->model('report_incident/category_model');
        $this->load->model('report_incident/logic_combination_model');
        $this->load->model('client_model');
    }

    public function index()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        $data['languages'] = $this->client_model->getLanguages(1);
        $this->load->view('form', $data);
    }

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

        // Filters
        $lang_id   = $this->input->post('lang_id')??'';
        $is_submit = 1;

        // Get Results
        $result = $this->form_model->getDataTableResults($start, $length, $is_submit, $lang_id);
        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => $result['total_records'],
            'recordsFiltered'   => $result['filtered_records'],
            'data'              => $result['results']
        ];
        return $this->jsonResponse($data, 200);
    }

    public function getDetails()
    {
        $form_name = $this->input->get('name')??'primary';
        $client_id = 1;
        $lang_id   = 1;
        $forms = $this->form_model->get_by_client_and_language($client_id, $lang_id, $form_name);
        // Get all question ids required by each of the forms
        $question_id_arr = [];
        foreach ($forms as $form) {
            if($form->question_ids_json=='')
                continue;
            $flows = json_decode($form->question_ids_json);
            foreach ($flows as $flow_obj) {
                if($form->type!='logic') {
                    $this->form_model->getQuestionIdRecursive((array) $flow_obj, $question_id_arr);
                } else {
                    $form_combs = $this->logic_combination_model->get_all_combination_json($form->id);
                    $new_flows = [];
                    foreach ($form_combs as $form_comb) {
                        $comb_flows = json_decode($form_comb->comb_json);
                        $new_flows = array_merge($new_flows, $comb_flows);
                    }
                    // Fetch the question ids now
                    foreach ($new_flows as $new_flow_obj) {
                        $this->form_model->getQuestionIdRecursive((array) $new_flow_obj, $question_id_arr);
                    }
                    $unique_flow_arr = array_unique($new_flows, SORT_REGULAR);
                    // Set the updated question json to form
                    $form->question_ids_json = json_encode(array_values($unique_flow_arr));
                }
            }
        }
        $uniq_ques_ids = array_unique($question_id_arr);


        if(count($uniq_ques_ids)>0) {
            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids);
            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options); 
        } else {
            $questions = [];
        }

        // Get Categories
        $categories = $this->category_model->getClientCategories($client_id, $lang_id);

        $data = ['forms' => $forms, 'questions' => $questions, 'categories' => $categories];
        return $this->jsonResponse(['success' => true, 'data' => $data], 200);
    }

}