<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Safetytip extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("safety_tips/safety_tips_report_model");
    }

    public function index()
    {
        $data = ['pageTitle' => 'SSafecity Webapp'];
        $data['statusesCount'] = $this->safety_tips_report_model->getStatusesCount($this->client_id);
        $this->load->view('safetytip', $data);
    }

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

        $status = $this->input->post('status')??'pending_approval';
        $search_term = $this->input->post('search_term')??'';
        $start_date     = $this->input->post('start_date')??'';
        $end_date     = $this->input->post('end_date')??'';
        $result = $this->safety_tips_report_model->getDataTableResults($start, $length, $status, $start_date, $end_date, $search_term, $this->client_id);
        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => $result['total_records'],
            'recordsFiltered'   => $result['filtered_records'],
            'data'              => $result['results']
        ];
        return $this->jsonResponse($data, 200);
    }

    public function updateStatus()
    {
        $report_id = $this->input->post('report_id');
        $status    = $this->input->post('status');
        if($status!='delete')
            $result      = $this->safety_tips_report_model->updateStatus($report_id, $status, $this->client_id);
        else
            $result      = $this->safety_tips_report_model->deleteUserReports($report_id, '', $this->client_id);
        if($result) {
            return $this->jsonResponse([
                        'status' => true,
                        'message' => 'Status updated succesfully',
                    ]);
        } else {
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
        }
    }

    public function store()
    {
        $title      = $this->input->post('title');
        $description = $this->input->post('description');
        $address    = $this->input->post('address');
        $building   = $this->input->post('building');
        $landmark   = $this->input->post('landmark');
        $area       = $this->input->post('area');
        $city       = $this->input->post('city');
        $state      = $this->input->post('state');
        $country    = $this->input->post('country');
        $latitude   = $this->input->post('latitude');
        $longitude  = $this->input->post('longitude');

        $data = [
            'user_id'             => 0,
            'admin_id'            => $this->getLoggedInUser()->id,
            'client_id'           => 1,
            'country_id'          => 102,
            'language_id'         => 1,
            'identification'      => "Webapp",
            'location_city_state' => $area.', '.$city.', '.$state,
            'location'            => $area,
            'landmark'            => $landmark,
            'city'                => $city,
            'state'               => $state,
            'country'             => $country,
            'exact_location'      => $building.' '.$landmark.', '.$area.', '.$city.', '.$state.', '.$country,
            'map_lat'             => $latitude,
            'map_lon'             => $longitude,
            'safety_tip_title'    => $title,
            'safety_tip_desc'     => $description,
            'added_date'          => date('Y-m-d H:i:s'),
            'updated_by'          => $this->getLoggedInUser()->id,
            'updated_date'        => date('Y-m-d H:i:s')
        ];

        // Update Record
        $result = $this->safety_tips_report_model->createReport($data);
        if($result!==FALSE)
            return  $this->jsonResponse([
                        'status' => true,
                        'message' => 'Safety Tip created succesfully',
                        'report_id' => $result
                    ]);
        else
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
    }

    public function update()
    {
        $report_id  = $this->input->post('report_id');
        $title      = $this->input->post('title');
        $description = $this->input->post('description');
        $address    = $this->input->post('address');
        $building   = $this->input->post('building');
        $landmark   = $this->input->post('landmark');
        $area       = $this->input->post('area');
        $city       = $this->input->post('city');
        $state      = $this->input->post('state');
        $country    = $this->input->post('country');
        $latitude   = $this->input->post('latitude');
        $longitude  = $this->input->post('longitude');

        $data = [
            'location_city_state' => $area.', '.$city.', '.$state,
            'location'            => $area,
            'landmark'            => $landmark,
            'city'                => $city,
            'state'               => $state,
            'country'             => $country,
            'exact_location'      => $building.' '.$landmark.', '.$area.', '.$city.', '.$state.', '.$country,
            'map_lat'             => $latitude,
            'map_lon'             => $longitude,
            'safety_tip_title'    => $title,
            'safety_tip_desc'     => $description,
            'updated_by'          => $this->getLoggedInUser()->id,
            'updated_date'        => date('Y-m-d H:i:s')
        ];

        // Update Record
        $result = $this->safety_tips_report_model->updateReport($report_id, '', $data, $this->client_id);
        if($result)
            return  $this->jsonResponse([
                        'status' => true,
                        'message' => 'Safety Tip updated succesfully',
                        'report_id' => $report_id
                    ]);
        else
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
    }

    public function export()
    {
        $statuses       = $this->input->get('statuses')??'';
        $start          = $this->input->get('start')??'';
        $end            = $this->input->get('end')??'';
        $record_ids     = $this->input->get('record_ids')??'';
        $record_id_arr  = [];
        if($record_ids!='')
            $record_id_arr  = explode(',', $record_ids);
        $status_arr = '';
        if($statuses!='')
            $statuses = explode(',', $statuses);
        if(count($record_id_arr)>0) {
            $result['results'] = $this->safety_tips_report_model->fetchResultByIds($record_id_arr, $this->client_id);
        } else {
            $result = $this->safety_tips_report_model->getDataTableResults(0, 'all', $statuses, $start, $end, '', $this->client_id);
        }

        $filename = 'safety-tips-'.date('YmdHis').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // file creation
        $file = fopen('php://output','w');
        $header = array("id","status","posted_by","title","description","area","city","state","country","latitude","longitude","created_on","updated_on");
        fputcsv($file, $header);
        foreach ($result['results'] as $record) {
            $export_data = [
                $record['id'],
                $record['status'],
                $record['posted_by'],
                $record['safety_tip_title'],
                $record['safety_tip_desc'],
                $record['location'],
                $record['city'],
                $record['state'],
                $record['country'],
                $record['map_lat'],
                $record['map_lon'],
                $record['added_date'],
                $record['updated_date']
            ];
            fputcsv($file, $export_data);
        }
        fclose($file);
        exit;
    }

    public function downloadSampleImportCSV()
    {
        $this->load->helper('download');
        force_download(FCPATH.'assets/uploads/import-safety-tips-format.csv', NULL);
    }

    public function import()
    {
        // Starting script
        $time_start = microtime(true);;

        $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
        $error_arr      = [];
        if(!in_array($_FILES['import_file']['type'], $mimes)){
            $error_arr[] = 'Invalid file, please provide a valid csv file';
        } else {
            //$file = fopen('http://localhost/SafeCityWebApp/others/dynamic%20form/import-safety-tips-format.csv', 'r');
            $file = fopen($_FILES['import_file']['tmp_name'], 'r');
        }

        $line           = 1;
        $header         = [];
        $data_arr       = [];
        while ($file && ($result = fgetcsv($file)) !== false)
        {
            if($line==1) {
                $header = $result;
                $line++;
                continue;
            }

            try {
                // Fetch relevant data
                $status         = 'pending_approval';
                $title          = trim($result[0]);
                $description    = trim($result[1]);
                $building       = trim($result[2]);
                $landmark       = trim($result[3]);
                $area           = trim($result[4]);
                $city           = trim($result[5]);
                $state          = trim($result[6]);
                $country        = trim($result[7]);
                $latitude       = trim($result[8]);
                $longitude      = trim($result[9]);

                // Create data array to store in DB
                $data = [
                    'status'              => 'pending_approval',
                    'user_id'             => 0,
                    'admin_id'            => $this->getLoggedInUser()->id,
                    'client_id'           => $this->client_id??1,
                    'country_id'          => 102,
                    'language_id'         => 1,
                    'identification'      => "Webapp",
                    'location_city_state' => $area.', '.$city.', '.$state,
                    'location'            => $area,
                    'landmark'            => $landmark,
                    'city'                => $city,
                    'state'               => $state,
                    'country'             => $country,
                    'exact_location'      => $building.' '.$landmark.', '.$area.', '.$city.', '.$state.', '.$country,
                    'map_lat'             => $latitude,
                    'map_lon'             => $longitude,
                    'safety_tip_title'    => $title,
                    'safety_tip_desc'     => $description,
                    'added_date'          => date('Y-m-d H:i:s'),
                    'updated_by'          => $this->getLoggedInUser()->id,
                    'updated_date'        => date('Y-m-d H:i:s')
                ];
                // Validate Requests
                if(empty($data['safety_tip_title']))
                    $error_arr[] = "Row $line: Please provide valid title";
                if(empty($data['safety_tip_desc']))
                    $error_arr[] = "Row $line: Please provide valid description";
                if(empty($data['map_lat']) || empty($data['map_lon']) || is_numeric($data['map_lat'] || is_numeric($data['map_lon'])))
                    $error_arr[] = "Row $line: please provide valid coordinates";
                if(empty($data['location']) || empty($data['city']) || empty($data['state']) || empty($data['country'])) {
                    $error_arr[] = "Row $line: Country, city, state and area is required";
                }
                $data_arr[] = $data;
            } catch (Exception $e) {
                $error_arr[] = "Row $line: Something went wrong";
            }
            $line++;
        }
        fclose($file);

        // Show Validation error if any
        if(count($error_arr)>0) {
            $response =  [
                            'status' => false,
                            'message' => 'Please fix records and resubmit',
                            'validations' => $error_arr
                        ];
            if (!$this->input->is_ajax_request()) {
                $this->session->set_flashdata('upload_failed', $response);
                redirect($_SERVER['HTTP_REFERER']);
            }
            else
                return $this->jsonResponse($response);
        }

        // Insert Data in DB
        $this->db->trans_start();
        $inserted_records = $this->safety_tips_report_model->saveDetails($data_arr);
        $this->db->trans_complete();

        // Script end
        $time_end = microtime(true);
        $execution_time = round(($time_end - $time_start)/60, 3);

        // Return appropriate response
        if ($this->db->trans_status() === FALSE) {
            $response =  [
                            'status' => false,
                            'message' => 'Something went wrong whilte inserting in DB',
                        ];
            if (!$this->input->is_ajax_request())
                $this->session->set_flashdata('upload_failed', $response);
            else
                return $this->jsonResponse($response);
        }
        else {
            $response = [
                        'status' => true,
                        'message' => $inserted_records.' Records Imported succesfully in '.$execution_time.' seconds',
                    ];

            if (!$this->input->is_ajax_request())
                $this->session->set_flashdata('upload_success', $response);
            else
                return $this->jsonResponse($response);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    /** By Piyush */

    public function insert()
    {
        $this->form_validation->set_rules(
            'safety_tip_desc',
            'safety tip desc',
            'required'
        );
        $this->form_validation->set_rules(
            'safety_tip_title',
            'safety tip title',
            'required'
        );
        $this->form_validation->set_rules('location', 'location', 'required');
        $this->form_validation->set_rules('landmark', 'landmark', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('country', 'country', 'required');

        if ($this->form_validation->run() == false) {
            foreach ($this->input->post() as $key => $value) {
                $errors[$key] = form_error($key);
            }
            $json_data['errors'] = array_filter($errors); // Some might be empty
            $json_data['status'] = false;
            echo json_encode($json_data);
            exit();
        } else {
            $data = [
                'safety_tip_desc' => $this->input->post('safety_tip_desc'),
                'safety_tip_title' => $this->input->post('safety_tip_title'),
                'location' => $this->input->post('location'),
                'landmark' => $this->input->post('landmark'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'location_city_state' => '',
                'identification' => 'Webapp',
                'language_id' => 1,
            ];

            $this->safety_tips_report_model->insert_data(
                'safety_tips_report',
                $data
            );
            redirect('admin/safety-tips');
        }
    }

}
