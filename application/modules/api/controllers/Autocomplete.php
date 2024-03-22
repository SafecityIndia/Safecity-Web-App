<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Autocomplete extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('city_model');
        $this->load->model('organization_model');
        $this->load->model('language_model');
    }

    public function cities_post()
    {
        // Validate request
        $this->form_validation->set_rules('query', 'Query', 'required');
        $this->form_validation->set_rules('country_id', 'Country', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true) 
            return $this->response($validator_arr);

        $query         = $this->input->post('query');
        $countryId     = $this->input->post('country_id');
        $cities        = $this->city_model->getAutocomplete($query, $countryId);

        $this->response([
            'status' => true,
            'message' => 'City lists',
            'data' => count($cities)>0?$cities:[],
        ]);
    }

    /**
     * Returns an autocomplete result for organizations based on provided query
     * @return JSONArray
     */
    public function organizations_post() 
    {
        // Validate request
        $this->form_validation->set_rules('query', 'Query', 'required');
        $this->form_validation->set_rules('country_id', 'Country', 'required');
        $this->form_validation->set_rules('city_id', 'City Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true) 
            return $this->response($validator_arr);

        $query         = $this->input->post('query');
        $countryId     = $this->input->post('country_id');
        $cityId        = $this->input->post('city_id');
        $organizations = $this->organization_model->getAutocomplete($query, $countryId, $cityId);
        
        $this->response([
            'status' => true,
            'message' => 'Organization lists',
            'data' => count($organizations)>0?$organizations:[],
        ]);
    }

    /**
     *  Verify is the user provided passcode of organization is valid
     * @return JSONArray
     */
    public function verifyOrganizationPasscode_post()
    {
        // Validate request
        $this->form_validation->set_rules('id', 'Organization id', 'required');
        $this->form_validation->set_rules('passcode', 'Passcode', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true) 
            return $this->response($validator_arr);
        $id       = $this->input->post('id');
        $passcode = $this->input->post('passcode');
        $organizationCount = $this->organization_model->verifyPasscode($id, $passcode);
        $this->response([
            'status'   => true,
            'message'  => 'Organization Passcode Authorization',
            'is_valid' => $organizationCount>0?true:false
        ]);
    }

    /**
     * Returns an autocomplete result for languages based on provided query
     * @return JSONArray
     */
    public function languages_post() 
    {
        // Validate request
        $this->form_validation->set_rules('client_id', 'Client Id', 'required');
        if(($validator_arr = runFormValidator($this->form_validation)) !== true) 
            return $this->response($validator_arr);
        $clientId  = $this->input->post('client_id');
        $languages = $this->language_model->getAutocomplete($clientId);
        $this->response([
            'status' => true,
            'message' => 'Languages lists',
            'data' => count($languages)>0?$languages:[],
        ]);
    }

}