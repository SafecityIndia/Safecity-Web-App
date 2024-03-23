<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Incident_report extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_incident/incident_report_model');
        $this->load->model('report_incident/form_model');
        $this->load->model('report_incident/question_model');
        $this->load->model('report_incident/logic_combination_model');
        $this->load->helper('filter_helper');
    }

    /**
     * GET reported incidents
     * @return JSONArray
     */
    public function index_post()
    {
        // Validate Request
        if($this->post('city')==null)
            $this->form_validation->set_rules('area', 'Area', 'required');

        $this->form_validation->set_rules('lang_id', 'Language Id', 'required');
        $this->form_validation->set_rules('client_id', 'Client Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        // Retrieve data
        $map_bounds = $this->post('map_bound')??[];
        if(!is_array($map_bounds))
            $map_bounds = json_decode($map_bounds, true);
        $map_zoom = $this->post('map_zoom')??1;
        $city = $this->post('city')??'';
        $area = $this->post('area')??'';
        $latitude = $this->post('latitude')??'';
        $longitude = $this->post('longitude')??'';
        $distance = $this->post('distance')??'';
        $lang_id = $this->post('lang_id')??1;
        $client_id = $this->post('client_id')??1;
        $offset = (int) $this->post('offset')??0;

        // Category Filter
        $cat_ids = $this->post('categories_ids');

        // Date Filter
        $reported_on = $this->post('reported_on');
        $date_result = calculateDateFilter($reported_on);
        $start_date = $date_result['start_date'];
        $end_date = $date_result['end_date'];

        // Time Filter
        $reported_time_arr = [];
        if(trim($this->post('reported_time'))!='')
            $reported_time_arr = explode(',', $this->post('reported_time'));

        $time_arr = [];
        foreach ($reported_time_arr as $reported_time) {
            $time_result = calculateTimeFilter($reported_time);
            $start_time = $time_result['start_time'];
            $end_time = $time_result['end_time'];
            $time_arr[] = ['start_time' => $start_time, 'end_time' => $end_time];
        }

        if($map_zoom>=15) {
            $limit = 10;
            // Get total incident count
            $total_incidents = $this->incident_report_model->getIncidentCounts($map_bounds, $city, $area, $cat_ids, $start_date, $end_date, $time_arr, $lang_id, $client_id);
            // Get limited incident records
            $incidents = $this->incident_report_model->getReports($map_bounds, $city, $area, $cat_ids, $start_date, $end_date, $time_arr, $lang_id, $client_id, $limit, $offset);
            // Format Records
            $incident_arr = $this->formatIncidentDetails($incidents);

            $current_count = count($incident_arr);
        } else {
            $limit = 20;
            $incidents = [];
            //$incidents = $this->incident_report_model->getReports($map_bounds, $city, $area, $cat_ids, $start_date, $end_date, $time_arr, $lang_id, $client_id, $limit, $offset);
            $incidents = $this->incident_report_model->getReports('', '', '', $cat_ids, $start_date, $end_date, $time_arr, $lang_id, $client_id, $limit, 0);
            // Format Records
            $incident_arr = $this->formatIncidentDetails($incidents);

            $current_count = count($incident_arr);
            $total_incidents = $current_count;
        }


        // Mapping Coordinates
        //$map_incidents = $this->incident_report_model->getIncidentMapCoordinates($map_bounds, $cat_ids, $start_date, $end_date, $time_arr, 1);
        $map_incidents = [];
        $this->response([
            'status' => true,
            'message' => 'Incident reports list',
            'total' => $total_incidents,
            'limit' => $limit,
            'offset' => $offset,
            'showing' => ($current_count==0?0:(($offset+1).' to '.($offset+$current_count))).' of '.$total_incidents,
            'current_count' => $current_count,
            'data' => array_values($incident_arr),
            'map_data' => $map_incidents
        ]);
    }

    public function getMapCooordinates_post()
    {
        $map_bounds = $this->post('map_bound')??[];
        if(!is_array($map_bounds))
            $map_bounds = json_decode($map_bounds, true);
        $client_id = $this->post('client_id')??1;

        // Category Filter
        $cat_ids = $this->post('categories_ids')??'';

        // Date Filter
        $reported_on = $this->post('reported_on');
        $date_result = calculateDateFilter($reported_on);
        $start_date = $date_result['start_date']??'';
        $end_date = $date_result['end_date']??'';

        // Time Filter
        $reported_time_arr = [];
        if(trim($this->post('reported_time'))!='')
            $reported_time_arr = explode(',', $this->post('reported_time'));

        $time_arr = [];
        foreach ($reported_time_arr as $reported_time) {
            $time_result = calculateTimeFilter($reported_time);
            $start_time = $time_result['start_time'];
            $end_time = $time_result['end_time'];
            $time_arr[] = ['start_time' => $start_time, 'end_time' => $end_time];
        }


        $incidents = $this->incident_report_model->getIncidentMapCoordinates($map_bounds, $cat_ids, $start_date, $end_date, $time_arr, 1);
        $this->response([
            'status'  => true,
            'message' => 'Incident reports list',
            'data'    => $incidents
        ]);
    }

    public function update_post()
    {
        $incident_id   = $this->input->post('incident_id');
        $incident_data = json_decode($this->input->post('incident_data'), true);

        $incident_arr = [
            'updated_on' => date('Y-m-d H:i:s'),
            'status'     => 'pending_approval'
        ];
        $primary_tags = ['sharing_for', 'age', 'gender', 'description', 'date', 'time_from', 'incident_categories', 'reported_to_police', 'attack_reason', 'additional_detail', 'incident_address', 'how_u_know_us'];
        foreach ($incident_data as $incident_detail) {
            $question_tags = $incident_detail['question_tag'];
            $answer_id     = $incident_detail['answer_id'];
            $answer        = $incident_detail['answer'];
            $answer_json   = json_decode($incident_detail['answer_json']??'{}');

            $tags_arr = explode(',', $question_tags);
            foreach ($tags_arr as $tag) {
                if(in_array($tag, $primary_tags)) {
                    if($tag=='date') {
                        //$date_arr =  explode('/', $answer);
                        //$incident_arr[$tag] = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];
                        $incident_arr[$tag] = $answer;
                        $incident_arr['is_date_estimate'] = $answer_json->isEstimate?1:0;
                        $incident_detail['answer'] = $incident_arr[$tag];
                    } else if($tag=='time_from') {
                        $time_arr = explode('-', $answer);
                        $start_time = date('H:i:s', strtotime($time_arr[0]));
                        $end_time = count($time_arr)>1?date('H:i:s', strtotime($time_arr[1])):null;
                        $incident_arr['time_from'] = $start_time;
                        $incident_arr['time_to'] = $end_time;
                        $incident_arr['is_time_estimate'] = $answer_json->isEstimate?1:0;
                        $incident_detail['answer'] = $incident_arr['time_from'].$end_time!=null?'-'.$end_time:'';
                    } else if($tag == 'incident_address') {
                        $incident_arr['building'] = $answer_json->address->building;
                        $incident_arr['landmark'] = $answer_json->address->landmark;
                        $incident_arr['area'] = $answer_json->address->area;
                        $incident_arr['city'] = $answer_json->address->city;
                        $incident_arr['state'] = $answer_json->address->state;
                        $incident_arr['country'] = $answer_json->address->country;
                        $incident_arr['latitude'] = $answer_json->address->latitude;
                        $incident_arr['longitude'] = $answer_json->address->longitude;
                    }
                    else if($tag == 'sharing_for') {
                        $incident_arr['sharing_for'] = $answer_id;
                    }
                    else if($tag == 'gender') {
                        $incident_arr['gender_id'] = $answer_id;
                    }
                    else if($tag == 'incident_categories') {
                        $incident_arr['incident_category_ids'] = $answer_id;
                    }
                    else if($tag == 'how_u_know_us' && isset($answer_id) && $answer_id>0) {
                        $incident_arr['ngo_id'] = (int) $answer_id;
                    }
                    else {
                        $incident_arr[$tag] = $answer;
                    }
                    break;
                }
            }
        }


        $this->db->trans_start();
        // Update Incident
        $result = $this->incident_report_model->update($incident_id, $incident_arr);

        // Update incident details
        $result = $this->incident_report_model->updateDetails($incident_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            return  $this->response([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
        else
            return  $this->response([
                        'status' => true,
                        'message' => 'Incident updated succesfully',
                    ]);
    }

    /**
     * GET Incident Details
     * @return JSONArray
     */
    public function getDetailedIncidentReport_post()
    {
        // Validate Request
        $this->form_validation->set_rules('incident_id', 'Incident Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $incident_id = $this->post('incident_id');
        $lang_id  = $this->post('lang_id')??1;
        $incident = $this->incident_report_model->getDetailedReport($incident_id, $lang_id);

        // Format Records
        $incident_arr = $this->formatIncidentDetails($incident, true);
        if(count($incident_arr)==0) {
            return $this->response([
                'status' => true,
                'message' => 'Incident Details',
                'data' => $incident_arr,
            ]);
        }

        $incident_id = $incident[0]['id'];
        $this->response([
            'status' => true,
            'message' => 'Incident Details',
            'data' => $incident_arr[$incident_id],
        ]);
    }

    /**
     * GET all reported incidents by a specific users
     * @return JSONArray
     */
    public function getUserIncident_post()
    {
        // Validate Request
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $user_id = $this->post('user_id');
        $lang_id = $this->post('lang_id')??1;
        $incidents = $this->incident_report_model->getUserReports($user_id, $lang_id);
        $incident_arr = $this->formatIncidentDetails($incidents);
        $this->response([
            'status' => true,
            'message' => 'User Incident reports list',
            'data' => array_values($incident_arr),
        ]);
    }

    /**
     * DELETE incident report
     * @return JSONArray
     */
    public function deleteUserIncident_post()
    {
        // Validate Request
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        $this->form_validation->set_rules('incident_id', 'Incident Id', 'required');
        $this->form_validation->set_rules('delete_from', 'Delete From', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $user_id     = $this->post('user_id');
        $incident_id = $this->post('incident_id');
        $delete_from = $this->post('delete_from');
        if($delete_from=='mobile')
            $result = $this->incident_report_model->unsetMobileVisibility($incident_id, $user_id);
        else
            $result = $this->incident_report_model->deleteUserReports($incident_id, $user_id);
        $this->response([
            'status' => $result?true:false,
            'message' => $result?'Incident deleted successfully':'Failed to delete incident',
        ]);
    }

    /**
     * Helper to merge incident details in incident records itself
     * @param  Array $incidents
     * @return Array
     */
    private function formatIncidentDetails($incidents, $categorize = false)
    {
        $incident_arr = [];
        foreach ($incidents as $incident) {
            if(!isset($incident_arr[$incident['id']])) {
                // Save incident
                $incident_arr[$incident['id']] = $incident;

                // Unique categories
                $cat_ans = explode(',', $incident['categories']);
                $incident_arr[$incident['id']]['categories'] = implode(' | ', array_unique($cat_ans));

                // Unset Data not required in main list (duplicates/irrelevant)
                unset($incident_arr[$incident['id']]['question']);
                unset($incident_arr[$incident['id']]['question_id']);
                unset($incident_arr[$incident['id']]['question_type']);
                unset($incident_arr[$incident['id']]['answer_id']);
                unset($incident_arr[$incident['id']]['form_type']);
                unset($incident_arr[$incident['id']]['other_answers']);
                unset($incident_arr[$incident['id']]['question_tag']);
                unset($incident_arr[$incident['id']]['answer']);
            }
            // Save just the answer list
            $unique_answer = explode(',', $incident['answer']);
            $incident_detail_list =  [
                'detail_id'   => $incident['detail_id'],
                'question_id' => $incident['question_id'],
                'question_type' => $incident['question_type'],
                'question' => $incident['question'],
                'question_tag' => $incident['question_tag'],
                'answer'       => implode(',', array_unique($unique_answer)),
                'answer_id'       => $incident['answer_id'],
                'answer_tag'       => $incident['answer_tag'],
                'other_answers' => $incident['other_answers']
            ];
            if($categorize)
                $incident_arr[$incident['id']]['answers'][$incident['form_type']][$incident['question_tag']!==''?$incident['question_tag']:$incident['question_id']] = $incident_detail_list;
            else
                $incident_arr[$incident['id']]['answers'][] = $incident_detail_list;
        }
        return $incident_arr;
    }

    /**
     * Get All Forms
     * @return Array
     */
    public function getForms_post()
    {
        $client_id = $this->input->post('client_id')??1;
        $lang_id = $this->input->post('lang_id')??1;
        $country_id = $this->input->post('country_id')??101;
        if(!$client_id || !$lang_id)
            $data_arr = ['forms' => [], 'questions' => []];
        else
            $data_arr = $this->form_model->getForms($client_id, $lang_id, $country_id);
        return $this->response($data_arr);
    }

    /** Get logical question API */
    public function getLogicalQuestions_post()
    {
        $form_id = $this->input->post('form_id');
        $question_id = $this->input->post('question_id');
        $ans_ids = $this->input->post('ans_ids');
        $lang_id = $this->input->post('lang_id')??1;
        $country_id = $this->input->post('country_id')??101;
        $combinations = $this->logic_combination_model->get_combination_json($form_id, $question_id, $ans_ids,$lang_id,$country_id);
        if(count($combinations)>0) {
            $comb_json_arr = json_decode($combinations[0]->comb_json);
            if(count($comb_json_arr)==0) {
                echo json_encode(['comb_json' => [], 'questions' => []]);
                return false;
            }

            // Get unique question ids
            $question_id_arr = [];
            $question_counter = -1;
            foreach ($comb_json_arr as $comb_json_obj) {
                $question_counter++;
                if(isset($comb_json_obj->for_countries) && !in_array($country_id, $comb_json_obj->for_countries)) {
                    unset($comb_json_arr[$question_counter]);
                    continue;
                }
                $this->question_model->getQuestionIdRecursive((array) $comb_json_obj, $question_id_arr);
            }
            $uniq_ques_ids = array_unique($question_id_arr);

            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids, $lang_id, $country_id);

            // ReIndex keys (to return a proper json array)
            $comb_json_arr = array_values($comb_json_arr);

            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options);

            $this->response(['comb_json' => $comb_json_arr, 'questions' => $questions]);
        } else {
            $this->response(['comb_json' => [], 'questions' => []]);
        }
    }

    public function saveIncident_post()
    {  
        // Load ion auth to check if admin is logged in
        $admin_id = 0;
        $user_id = $this->input->post('user_id')??0;
        $lang_id = $this->input->post('lang_id')??1;
        $client_id = $this->input->post('client_id')??1;
        if($user_id==0) {
            $this->load->library('ion_auth');
            if($this->ion_auth->logged_in()) {
                $admin_id = $this->ion_auth->user()->row()->id;
            }
        }

        $primary_tags = ['sharing_for', 'age', 'gender', 'description', 'date', 'time_from', 'incident_categories', 'reported_to_police', 'attack_reason', 'additional_detail', 'incident_address', 'how_u_know_us'];
        $answers_jsons = $this->input->post('answers_json');
        $incident_id = $this->input->post('incident_id');
        $answers_jsons = json_decode($answers_jsons);
        $incident_arr = [
            'is_public' => 1,
            'client_id' => $client_id,
            'lang_id'   => $lang_id,
            'user_id'   => $this->input->post('user_id')??0,
            'admin_id'  => $admin_id,
            'is_mobile_visible' => $this->input->post('user_id')?1:null,
            'total_forms' => 1,
            'platform'   => $this->input->post('platform')??'web',
            'app_version'   => $this->input->post('app_version')??'1.0',
        ];
        $detail_arr = [];
        foreach ($answers_jsons as $answer_json) {
            $question_answer = $answer_json->currentQuestion;
            $answerJson = $question_answer->answerJson;
            $question_id = $question_answer->id;
            $question = $question_answer->question;
            $question_type = json_decode($question_answer->properties)->type;
            $question_tags = $question_answer->tags;
            // incident details data
            $detail_arr[] = ['incident_id' => $incident_id, 'form_type' => $answerJson->form_type, 'question_id' => $question_id, 'question_type' => $question_type, 'question_tag' => $question_tags, 'question' => $question, 'answer_id' => $answerJson->option_id, 'answer' => $answerJson->answer??'', 'other_answers' => isset($answerJson->other_answers)?json_encode($answerJson->other_answers):null, 'answer_json' => json_encode($answerJson)];
            // incident record data
            if($incident_id==0) {
                $tags_arr = explode(',', $question_tags);
                foreach ($tags_arr as $tag) {
                    if(in_array($tag, $primary_tags)) {
                        if($tag=='date') {
                            $date_arr =  explode('/', $answerJson->answer);
                            $incident_arr[$tag] = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];
                            $incident_arr['is_date_estimate'] = $answerJson->isEstimate?1:0;
                            $answerJson->answer = $incident_arr[$tag];
                        } else if($tag=='time_from') {
                            $time_arr = explode('-', $answerJson->answer);
                            $start_time = date('H:i:s', strtotime($time_arr[0]));
                            $end_time = count($time_arr)>1?date('H:i:s', strtotime($time_arr[1])):null;
                            $incident_arr['time_from'] = $start_time;
                            $incident_arr['time_to'] = $end_time;
                            $incident_arr['is_time_estimate'] = $answerJson->isEstimate?1:0;
                            $answerJson->answer = $incident_arr['time_from'].$end_time!=null?'-'.$end_time:'';
                        } else if($tag == 'incident_address') {
                            $incident_arr['building'] = $answerJson->address->building;
                            $incident_arr['landmark'] = $answerJson->address->landmark;
                            $incident_arr['area'] = $answerJson->address->area;
                            $incident_arr['city'] = $answerJson->address->city;
                            $incident_arr['state'] = $answerJson->address->state;
                            $incident_arr['country'] = $answerJson->address->country;
                            $incident_arr['latitude'] = $answerJson->address->latitude;
                            $incident_arr['longitude'] = $answerJson->address->longitude;
                        }
                        /*else if($tag == 'incident_lat_lng') {
                        }*/
                        else if($tag == 'sharing_for') {
                            $incident_arr['sharing_for'] = $answerJson->option_id;
                        }
                        else if($tag == 'gender') {
                            $incident_arr['gender_id'] = $answerJson->option_id;
                        }
                        else if($tag == 'incident_categories') {
                            $incident_arr['incident_category_ids'] = $answerJson->option_id;
                        }
                        else if($tag == 'how_u_know_us'){
                            if($answerJson->answer == 'An NGO'){
                                if(isset($answerJson->option_id) && $answerJson->option_id>0)
                                    $incident_arr['ngo_id'] = (int) $answerJson->option_id;
                            }
                        }
                        else {
                            $incident_arr[$tag] = $answerJson->answer;
                        }
                        break;
                    }
                }
            }
        }

        $this->db->trans_start();
        // Save incident
        if($incident_id==0) {
            $result_id = $this->incident_report_model->save($incident_arr);
            if($result_id>0) {
                $incident_id = $result_id;
            }
            $detail_arr = array_map(function($detail) use ($incident_id) {
                $detail['incident_id'] = $incident_id;
                return $detail;
            }, $detail_arr);
        } else {
            // Update form count (indicates form type: primary/secondary,etc)
            $this->incident_report_model->updateTotalForms($incident_id);
        }

        // Save incident details
        $this->incident_report_model->saveDetails($detail_arr);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            return $this->response(['succes' => false, 'message' => 'Something went wrong!']);
        else
            return $this->response(['success' => true, 'incident_id' => $incident_id]);
    }

}