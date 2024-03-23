<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Questions extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_incident/question_model');
    }

    /**
     * Get Questions with all of there options
     * @return [type] [description]
     */ 
    public function getQuestionOptions_post()
    {
        $uniq_ques_ids = $this->post('ques_id');
        // Get all the questions and the options from the database
        $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids);
        // Format the questions as required by application
        $questions = $this->question_model->formatQuestionOptions($question_with_options);
        $this->response([
            'status'  => true,
            'data'    => $questions,
            'message' => 'Questions with options',
        ]);
    }

}