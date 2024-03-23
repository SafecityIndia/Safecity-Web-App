<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Safety_tips extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('safety_tips/safety_tips_report_model');
        $this->load->helper('filter_helper');
    }

    /**
     * GET safety tips
     * @return JSONArray
     */
    public function index_post()
    {
        // Validate request
        if($this->post('city')==null)
            $this->form_validation->set_rules('area', 'Area', 'required');

        $this->form_validation->set_rules('lang_id', 'Language Id', 'required');
        //$this->form_validation->set_rules('client_id', 'Client Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $map_bounds = $this->post('map_bound')??[];
        if(!is_array($map_bounds))
            $map_bounds = json_decode($map_bounds, true);
        $map_zoom = $this->post('map_zoom')??1;
        $city = $this->post('city')??'';
        $area = $this->post('area')??'';
        $lang_id = $this->post('lang_id')??1;
        $client_id = $this->post('client_id')??1;
        $offset = (int) $this->post('offset')??0;

        // Filters
        $start_date = $end_date = '';
        $reported_on = $this->post('reported_on');
        $date_result = calculateDateFilter($reported_on);
        $start_date = $date_result['start_date']??'';
        $end_date = $date_result['end_date']??'';

        if($map_zoom>=15) {
            // Get total count
            $total_safety_tips = $this->safety_tips_report_model->getSafetyTipsCounts($map_bounds, $city, $area, $start_date, $end_date, $lang_id, $client_id);
            $limit = 10;

            // Get limited records
            $safety_tips = $this->safety_tips_report_model->getSafetyTipsByLocation($map_bounds, $city, $area, $start_date, $end_date, $lang_id, $client_id, $limit, $offset);
        } else {
            $limit = 20;
            // Get latest 20 records
            $safety_tips = $this->safety_tips_report_model->getSafetyTipsByLocation('', '', '', $start_date, $end_date, $lang_id, $client_id, $limit, 0);
            $total_safety_tips = count($safety_tips);
        }

        $current_count = count($safety_tips);
        $this->response([
            'status' => true,
            'message' => 'Safety tip reports list',
            'total' => $total_safety_tips,
            'limit' => $limit,
            'offset' => $offset,
            'showing' => ($current_count==0?0:(($offset+1).' to '.($offset+$current_count))).' of '.$total_safety_tips,
            'current_count' => $current_count,
            'data' => array_values($safety_tips),
        ]);
    }

    public function getMapCooordinates_post()
    {
        $map_bounds = $this->post('map_bound')??[];
        if(!is_array($map_bounds))
            $map_bounds = json_decode($map_bounds, true);
        $client_id = $this->post('client_id')??1;

        // Date Filter
        $reported_on = $this->post('reported_on');
        $date_result = calculateDateFilter($reported_on);
        $start_date = $date_result['start_date']??'';
        $end_date = $date_result['end_date']??'';

        $safety_tips = $this->safety_tips_report_model->getMapCoordinates($map_bounds, $start_date, $end_date, $client_id);
        $this->response([
            'status'  => true,
            'message' => 'Safety tips reports list',
            'data'    => $safety_tips
        ]);
    }

    /**
     * GET Safety Tip Details
     * @return JSONArray
     */
    public function getDetailedSafetyTipReport_post()
    {
        // Validate Request
        $this->form_validation->set_rules('safety_tip_id', 'Safety Tip Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $safety_tip_id = $this->post('safety_tip_id');
        $lang_id  = $this->post('lang_id')??1;
        $safety_tip = $this->safety_tips_report_model->getDetailedReport($safety_tip_id, $lang_id);

        $this->response([
            'status' => true,
            'message' => 'Safety Tip Details',
            'data' => $safety_tip,
        ]);
    }

    /**
     * UPDATE Safety Tip
     * @return JSONArray
     */
    public function updateSafetyTipReport_post()
    {
        // Validate Request
        $this->form_validation->set_rules('safety_tip_id', 'Safety Tip Id', 'required');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        //$this->form_validation->set_rules('location_city_state', 'City State', 'required');
        //$this->form_validation->set_rules('location', 'location', 'required');
        //$this->form_validation->set_rules('landmark', 'landmark', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        //$this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('country', 'country', 'required');
        //$this->form_validation->set_rules('exact_location', 'Exact location', 'required');
        $this->form_validation->set_rules('map_lat', 'Latitude', 'required');
        $this->form_validation->set_rules('map_lon', 'Longitude', 'required');
        $this->form_validation->set_rules('safety_tip_title', 'Title', 'required');
        $this->form_validation->set_rules('safety_tip_desc', 'Description', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $safety_tip_id = $this->post('safety_tip_id');
        $user_id       = $this->post('user_id');
        $data_arr = array(
            'location_city_state' => $this->post('location_city_state')??'',
            'location' => $this->post('location')??'',
            'landmark' => $this->post('landmark')??'',
            'city' => $this->post('city'),
            'state' => $this->post('state')??'',
            'country' => $this->post('country'),
            'exact_location' => $this->post('exact_location')??'',
            'map_lat' => $this->post('map_lat'),
            'map_lon' => $this->post('map_lon'),
            'safety_tip_title' => $this->post('safety_tip_title'),
            'safety_tip_desc' => $this->post('safety_tip_desc'),
            'updated_date' => date('Y-m-d H:i:s'),
            'status'     => 'pending_approval'
        );
        $result = $this->safety_tips_report_model->updateReport($safety_tip_id, $user_id, $data_arr);
        $this->response([
            'status' => $result?true:false,
            'message' => $result?'Safety Tip updated successfully':'Failed to update safety tip',
        ]);
    }

    /**
     * GET Safety tips shared by specific mobile user
     * @return JSONArray
     */
    public function getUserSafetyTips_post()
    {
        // Validate Request
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $user_id = $this->post('user_id');
        $lang_id = $this->post('lang_id')??1;
        $safety_tips = $this->safety_tips_report_model->getUserReports($user_id, $lang_id);
        $this->response([
            'status' => true,
            'message' => 'User Safety Tip reports list',
            'data' => array_values($safety_tips),
        ]);
    }

    /**
     * DELETE safety tip
     * @return JSONArray
     */
    public function deleteUserSafetyTip_post()
    {
        // Validate Request
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        $this->form_validation->set_rules('safety_tip_id', 'Incident Id', 'required');
        $this->form_validation->set_rules('delete_from', 'Delete From', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true)
            return $this->response($validator_arr);

        $user_id       = $this->post('user_id');
        $safety_tip_id = $this->post('safety_tip_id');
        $delete_from   = $this->post('delete_from');
        if($delete_from=='mobile')
            $result = $this->safety_tips_report_model->unsetMobileVisibility($safety_tip_id, $user_id);
        else
            $result = $this->safety_tips_report_model->deleteUserReports($safety_tip_id, $user_id);
        $this->response([
            'status' => $result?true:false,
            'message' => $result?'Safety Tip deleted successfully':'Failed to delete safety tip',
        ]);
    }

}