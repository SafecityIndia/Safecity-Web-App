<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Client extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model');
    }

    public function index()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        $this->load->view('client', $data);
    }

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

        // Filters
        $search_term = $this->input->post('search_term')??'';

        // Get Results
        $result = $this->client_model->getDataTableResults($start, $length, $search_term);
        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => $result['total_records'],
            'recordsFiltered'   => $result['filtered_records'],
            'data'              => $result['results']
        ];
        return $this->jsonResponse($data, 200);
    }

    public function manageClient()
    {
        $sub_client_id = $this->input->get('client_id');
        $client_details = $this->client_model->get($sub_client_id);
        if(!$client_details)
            return $this->show404();
        $user_data = $_SESSION['user_data'];
        $user_data->sub_client_id = $sub_client_id;
        $_SESSION['user_data']   = $user_data;
        $_SESSION['client_data'] = $client_details;
        header("Location: ".base_url().'admin/clients/incidents');
        die();
    }

    public function incidents()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        $this->load->view('client-incident', $data);
    }

}