<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Incident extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
		ini_set('memory_limit', '-1');
        parent::__construct();
        $this->load->model('report_incident/question_model');
        $this->load->model('report_incident/category_model');
        $this->load->model('report_incident/incident_report_model');
    }

    public function index()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        
        if($_SESSION['user_data']->company=='LANGUAGE'){
			$categories = $this->category_model->getClientCategories($this->client_id, 1,111);
			$data['categories'] = json_encode($categories);
			$data['statusesCount'] = $this->incident_report_model->getLanguageStatusesCount($this->client_id);
		}else{
			$categories = $this->category_model->getClientCategories($this->client_id, 1,NULL);
			$data['categories'] = json_encode($categories);
			$data['statusesCount'] = $this->incident_report_model->getStatusesCount($this->client_id);
		}
        $this->load->view('incident', $data);
    }
	
	public function incident_reports()
    {
		$categories = $this->category_model->getClientCategories($this->client_id, 1,NULL);
		$data['categories'] = json_encode($categories);
        $data = ['pageTitle' => 'Safecity Webapp'];
		$categories = $this->category_model->getClientCategories($this->client_id, 1,NULL);
		$data['categories'] = json_encode($categories);
		$data['statusesCount'] = $this->incident_report_model->getStatusesCount($this->client_id);
        $this->load->view('incident_reports', $data);
    }
	
	public function getreportDataTable()
	{
		// $status = $this->input->post('status')??'pending_approval';
		// $type   = $this->input->post('type')??'';
		// $location = '';
		
		$category = $this->input->post('category')??'';
		$form_filter = $this->input->post('formfilter')??'';
		// $start_date     = $this->input->post('start_date')??'';
		// $end_date     = $this->input->post('end_date')??'';
			
		// @$sql = "SELECT ide.question_id,ir.*,ide.incident_id,ide.form_type,ide.question,ide.answer FROM incident_reports as ir JOIN incident_details ide ON ide.incident_id = ir.id order by ir.date DESC";
		$params['draw'] = @$_REQUEST['draw'];
		$start = @$_REQUEST['start'];
		$length = @$_REQUEST['length'];
		
		$search_value = @$_REQUEST['search']['value'];
		if(isset($_REQUEST["order"]))
		{
			$column_index = $_REQUEST['order']['0']['column'];
			if(@$_REQUEST['columns'][$column_index]['data']=='0'){
				$column_name = 'date';
			}else{
				$column_name = @$_REQUEST['columns'][$column_index]['data'];
			}
			
		}
		// echo @$column_name;exit;
		if(!empty($search_value)){
				// count all data
				if(@$category ==''){
					$countsql = "SELECT ide.question_id,ir.*,ide.incident_id,ide.form_type,ide.question,ide.answer FROM incident_reports as ir JOIN incident_details ide ON ide.incident_id = ir.id where ( incident_id like '%".$search_value."%' OR  status like '%".$search_value."%' OR  client_id like '%".$search_value."%' OR  lang_id like '%".$search_value."%' OR  user_id like '%".$search_value."%' OR  age like '%".$search_value."%' OR  description like '%".$search_value."%' OR  incident_category_ids like '%".$search_value."%' OR  reported_to_police like '%".$search_value."%' OR  reported_to_police like '%".$search_value."%' OR  additional_detail like '%".$search_value."%' OR  building like '%".$search_value."%' OR  building like '%".$search_value."%' OR  area like '%".$search_value."%' OR  city like '%".$search_value."%' OR  state like '%".$search_value."%' OR  country like '%".$search_value."%' OR  latitude like '%".$search_value."%' OR  longitude like '%".$search_value."%' OR  platform like '%".$search_value."%' OR  app_version like '%".$search_value."%' OR  question like '%".$search_value."%' OR  answer like '%".$search_value."%' OR  date like '%".$search_value."%' ) ";
				}else{
					$countsql = "SELECT ide.question_id,ir.*,ide.incident_id,ide.form_type,ide.question,ide.answer FROM incident_reports as ir 
					JOIN incident_details ide ON ide.incident_id = ir.id 
					WHERE FIND_IN_SET($category, ir.incident_category_ids) > 0 AND ( incident_id like '%".$search_value."%' OR  status like '%".$search_value."%' OR  client_id like '%".$search_value."%' OR  lang_id like '%".$search_value."%' OR  user_id like '%".$search_value."%' OR  age like '%".$search_value."%' OR  description like '%".$search_value."%' OR  incident_category_ids like '%".$search_value."%' OR  reported_to_police like '%".$search_value."%' OR  reported_to_police like '%".$search_value."%' OR  additional_detail like '%".$search_value."%' OR  building like '%".$search_value."%' OR  building like '%".$search_value."%' OR  area like '%".$search_value."%' OR  city like '%".$search_value."%' OR  state like '%".$search_value."%' OR  country like '%".$search_value."%' OR  latitude like '%".$search_value."%' OR  longitude like '%".$search_value."%' OR  platform like '%".$search_value."%' OR  app_version like '%".$search_value."%' OR  question like '%".$search_value."%' OR  answer like '%".$search_value."%' OR  date like '%".$search_value."%' ) ";
				}
				
				if(@$form_filter !=''){
					@$countsql .= " AND ide.form_type = '".@$form_filter."' ";
				}
				
				if(isset($_REQUEST["order"]))
				{
					$countsql .= 'ORDER BY '.$column_name.' '.$_REQUEST['order']['0']['dir'].' ';
				}else {
					$countsql .= 'ORDER BY ir.date DESC ';
				}
				
				$total_count = $this->db->query($countsql)->result_array();
				$datasql = $countsql;
				if(@$length!=-1){
					@$datasql .= " limit $start, $length"; 
				}
				$data = $this->db->query($datasql)->result_array();
			}else{
				// count all data
				if(@$category ==''){
					$countsql = " SELECT ide.question_id,ir.*,ide.incident_id,ide.form_type,ide.question,ide.answer FROM incident_reports as ir JOIN incident_details ide ON ide.incident_id = ir.id ";
				}else{
					$countsql = " SELECT ide.question_id,ir.*,ide.incident_id,ide.form_type,ide.question,ide.answer FROM incident_reports as ir JOIN incident_details ide ON ide.incident_id = ir.id WHERE FIND_IN_SET($category, ir.incident_category_ids) > 0 ";
				}
				
				if(@$form_filter !=''){
					@$countsql .= " AND ide.form_type = '".@$form_filter."' ";
				}
				
				if(isset($_REQUEST["order"]))
				{
					$countsql .= 'ORDER BY '.$column_name.' '.$_REQUEST['order']['0']['dir'].' ';
				}else {
					$countsql .= 'ORDER BY ir.date DESC ';
				}
				$total_count = $this->db->query($countsql)->result_array();
				
				$datasql = $countsql;
				if(@$length!=-1){
					@$datasql .= " limit $start, $length"; 
				}
				
				$data = $this->db->query($datasql)->result_array();
		}
		
		$i = 0;
		foreach(@$data as $val){
			if(@$val['country']=='Jordan'){
				$catsql = "SELECT ir.id,ir.incident_category_ids, GROUP_CONCAT(ct1.title SEPARATOR ' | ') as categories
				FROM incident_reports as ir
				LEFT JOIN categories_translation as ct1 ON FIND_IN_SET(ct1.category_id, ir.incident_category_ids)
				WHERE ir.id = '".@$val['id']."' 
				AND ct1.lang_id = '".@$val['lang_id']."' 
				AND ct1.country_id = 'Jordan'
				GROUP BY id";
			}else{
				$catsql = "SELECT ir.id,ir.incident_category_ids, GROUP_CONCAT(ct1.title SEPARATOR ' | ') as categories
				FROM incident_reports as ir
				LEFT JOIN categories_translation as ct1 ON FIND_IN_SET(ct1.category_id, ir.incident_category_ids)
				WHERE ir.id = '".@$val['id']."' 
				AND ct1.lang_id = '".@$val['lang_id']."' 
				AND ct1.country_id IS NULL
				GROUP BY id";
			}
			
			$catdata = $this->db->query($catsql)->result_array();
			$data[$i]['incident_category_ids'] = @$catdata[0]['categories'];
			// echo "<pre>";
			// print_r($catdata);
			// echo "</pre>";
			$i++;
		}
		// exit;
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// exit;
		$json_data = array(
			"draw" => intval($params['draw']),
			"recordsTotal" => count(@$total_count),
			"recordsFiltered" => count(@$total_count),
			"data" => $data   // total data array
		);
		return $this->jsonResponse($json_data, 200);
	}
	
	public function exportReport()
    {
		set_time_limit(0);
        // $statuses       = $this->input->get('statuses')??'';
        // $start          = $this->input->get('start')??'';
        // $end            = $this->input->get('end')??'';
        // $record_ids     = $this->input->get('record_ids')??'';
        // $record_id_arr  = [];
        // if($record_ids!='')
            // $record_id_arr  = explode(',', $record_ids);
        // $status_arr = '';
        // if($statuses!='')
            // $statuses = explode(',', $statuses);
        // if(count($record_id_arr)>0) {
            // $result['results'] = $this->incident_report_model->fetchResultByIds($record_id_arr);
        // } else {
            // $result = $this->incident_report_model->export(0, 'all', $statuses, $start, $end);
        // }
		$countsql = " SELECT ide.question_id,ir.*,ide.incident_id,ide.form_type,ide.form_type,ide.question,ide.answer FROM incident_reports as ir JOIN incident_details ide ON ide.incident_id = ir.id ";
		
		$result = $this->db->query($countsql)->result_array();
		// foreach(@$result as $val){
			// if(@$val['country']=='Jordan'){
				// $catsql = "SELECT ir.id,ir.incident_category_ids, GROUP_CONCAT(ct1.title SEPARATOR ' | ') as categories
				// FROM incident_reports as ir
				// LEFT JOIN categories_translation as ct1 ON FIND_IN_SET(ct1.category_id, ir.incident_category_ids)
				// WHERE ir.id = '".@$val['id']."' 
				// AND ct1.lang_id = '".@$val['lang_id']."' 
				// AND ct1.country_id = 'Jordan'
				// GROUP BY id";
			// }else{
				// $catsql = "SELECT ir.id,ir.incident_category_ids, GROUP_CONCAT(ct1.title SEPARATOR ' | ') as categories
				// FROM incident_reports as ir
				// LEFT JOIN categories_translation as ct1 ON FIND_IN_SET(ct1.category_id, ir.incident_category_ids)
				// WHERE ir.id = '".@$val['id']."' 
				// AND ct1.lang_id = '".@$val['lang_id']."' 
				// AND ct1.country_id IS NULL
				// GROUP BY id";
			// }
			
			// $catdata = $this->db->query($catsql)->result_array();
			// $result[$i]['incident_category_ids'] = @$catdata[0]['categories'];
			// // echo "<pre>";
			// // print_r($catdata);
			// // echo "</pre>";
			// $i++;
		// }     
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// exit;
		
        $filename = 'incidentreport-'.date('YmdHis').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		// header('Content-Length: ' . filesize($file));
        // file creation
        $file = fopen('php://output','w');
        // file creation
        $file = fopen('php://output','w');
        $header = array("Report ID","Status","Form Type","Question","Answer","Client ID","Lang ID","User ID","Age","Description","Categories","Reported To Police","Attack Reason","Additional Details","Building","Landmark","Area","City","State","Country","Lattitude","Longitude","Platform","App Version","Date");
        fputcsv($file, $header);
        foreach ($result as $record) {
            $export_data = [
                $record['incident_id'],
                $record['status'],
                $record['form_type'],
                $record['question'],
                $record['answer'],
                $record['client_id'],
                $record['lang_id'],
                $record['user_id'],
                $record['age'],
                $record['description'],
                $record['incident_category_ids'],
                $record['reported_to_police'],
                $record['attack_reason'],
                $record['additional_detail'],
                $record['building'],
                $record['landmark'],
                $record['area'],
                $record['city'],
                $record['state'],
                $record['country'],
                $record['latitude'],
                $record['longitude'],
                $record['platform'],
                $record['app_version'],
                $record['date']
            ];
            fputcsv($file, $export_data);
        }
        fclose($file);
        exit;
    }

    public function createIncidentIndex()
    {
        $this->load->view('create_incident');
    }
	
	public function volunteer_incidents()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        
        if($_SESSION['user_data']->company=='LANGUAGE'){
			$categories = $this->category_model->getClientCategories($this->client_id, 1,111);
			$data['categories'] = json_encode($categories);
			$data['statusesCount'] = $this->incident_report_model->getLanguageStatusesCount($this->client_id);
		}else{
			$categories = $this->category_model->getClientCategories($this->client_id, 1,NULL);
			$data['categories'] = json_encode($categories);
			$data['statusesCount'] = $this->incident_report_model->getStatusesCount($this->client_id);
		}
        $this->load->view('volunteer_incidents', $data);
    }

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

        $status = $this->input->post('status')??'pending_approval';
        $type   = $this->input->post('type')??'';
        $location = '';
        $category = $this->input->post('category')??'';
        $search_term = $this->input->post('search_term')??'';
        $start_date     = $this->input->post('start_date')??'';
        $end_date     = $this->input->post('end_date')??'';
        if($_SESSION['user_data']->company=='LANGUAGE'){
			$result = $this->incident_report_model->getLanguageDataTableResults($start, $length, $status, $type, $location, $category, $start_date, $end_date, $search_term, $this->client_id);
		}else{
			$result = $this->incident_report_model->getDataTableResults($start, $length, $status, $type, $location, $category, $start_date, $end_date, $search_term, $this->client_id);
		}
		
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// exit;
		
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
        $incident_id = $this->input->post('incident_id');
        $status      = $this->input->post('status');
        if($status!='delete')
            $result      = $this->incident_report_model->updateStatus($incident_id, $status, $this->client_id);
        else
            $result      = $this->incident_report_model->deleteUserReports($incident_id, '', $this->client_id);
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

    public function updateIncident()
    {
        $incident_id   = $this->input->post('incident_id');
        $incident_data = $this->input->post('incident_data');

        $incident_arr = [
            'updated_by' => $this->getLoggedInUser()->id,
            'updated_on' => date('Y-m-d H:i:s')
        ];
        $primary_tags = ['sharing_for', 'age', 'gender', 'description', 'date', 'time_from', 'incident_categories', 'reported_to_police', 'attack_reason', 'additional_detail', 'incident_address'];
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
                    else {
                        $incident_arr[$tag] = $answer;
                    }
                    break;
                }
            }
        }

        $this->db->trans_start();
        // Update Incident
        $result = $this->incident_report_model->update($incident_id, $incident_arr, '', $this->client_id);

        // Update incident details
        $result = $this->incident_report_model->updateDetails($incident_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
        else
            return  $this->jsonResponse([
                        'status' => true,
                        'message' => 'Incident updated succesfully',
                    ]);
    }

    public function getQuestionsOptions()
    {
        $uniq_ques_ids = $this->input->post('question_ids');
        $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids);
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
            $result['results'] = $this->incident_report_model->fetchResultByIds($record_id_arr);
        } else {
            $result = $this->incident_report_model->export(0, 'all', $statuses, $start, $end);
        }

        $filename = 'incident-'.date('YmdHis').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // file creation
        $file = fopen('php://output','w');
        $header = array("id","status","posted_by","date","category","age","time from","time to","description","Additional Details","area","city","state","country","latitude","longitude","created_on","updated_on");
        fputcsv($file, $header);
        foreach ($result['results'] as $record) {
            $export_data = [
                $record['id'],
                $record['status'],
                $record['posted_by'],
                $record['date'],
                $record['categories'],
                $record['age'],
                $record['time_from'],
                $record['time_to'],
                $record['description'],
                $record['additional_detail'],
                $record['area'],
                $record['city'],
                $record['state'],
                $record['country'],
                $record['latitude'],
                $record['longitude'],
                $record['created_on'],
                $record['updated_on']
            ];
            fputcsv($file, $export_data);
        }
        fclose($file);
        exit;
    }

    /*public function downloadSampleImportCSV()
    {
        $this->load->helper('download');
        force_download(FCPATH.'assets/uploads/import-incident-format.csv', NULL);
    }*/

    public function downloadSampleImportCSV()
    {

        $filename = 'import-incident-formats.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // file creation
        $file = fopen('php://output','w');
        $this->load->model('report_incident/form_model');
        $this->load->model('report_incident/logic_combination_model');

        // Get all of the combination questions (primary)
        $forms = $this->form_model->getForms($this->client_id, 1);
        $new_flows = [];
        foreach ($forms['forms'] as $form) {
            if($form->type=='logic') {
                // Fetch all logical questions
                $form_combs = $this->logic_combination_model->get_all_combination_json($form->id);
                foreach ($form_combs as $form_comb) {
                    $comb_flows = json_decode($form_comb->comb_json);
                    $new_flows = array_merge($new_flows, $comb_flows);
                }
            }
        }
        // Fetch the question ids now for logical questions
        $question_id_arr = [];
        foreach ($new_flows as $new_flow_obj) {
            $this->form_model->getQuestionIdRecursive((array) $new_flow_obj, $question_id_arr);
        }
        $uniq_ques_ids = array_unique($question_id_arr);
        if(count($uniq_ques_ids)>0) {
            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids, 1);
            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options);
        } else {
            $questions = [];
        }
        // Merge logical + primary questions
        $all_questions = array_merge($questions, $forms['questions']);

        $header = [];
        // Create CSV header with question tags
        //array_walk($all_questions, function($question, $question_key) use (&$header) {
        array_walk($forms['questions'], function($question, $question_key) use (&$header) {
            if($question['question']['tags']=='incident_address') {
                $header = array_merge($header, ['building', 'landmark', 'area', 'city', 'state', 'country', 'latitude', 'longitude']);
            } else {
                $header[] = $question['question']['tags']!=''?$question['question']['tags']:$question['question']['id'];
            }
            if($question['question']['tags']=='time_from')
                $header[] = 'time_to';
        });
        fputcsv($file, $header);
        fclose($file);
        exit;
    }

    public function import()
    {

        $time_start = microtime(true);;

        $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
        $error_arr      = [];
         if(!in_array($_FILES['import_file']['type'], $mimes)){
              $error_arr[] = 'Invalid file, please provide a valid csv file';
        } else {
            //$file = fopen('http://localhost/SafeCityWebApp/others/dynamic%20form/import-safety-tips-format.csv', 'r');
            $file = fopen($_FILES['import_file']['tmp_name'], 'r');
        }

        // Get questions (primary)
        $this->load->model('report_incident/form_model');
        $this->load->model('report_incident/logic_combination_model');
        $forms = $this->form_model->getForms($this->client_id, 1);
        $new_flows = [];
        foreach ($forms['forms'] as $form) {
            if($form->type=='logic') {
                // Fetch all logical questions
                $form_combs = $this->logic_combination_model->get_all_combination_json($form->id);
                foreach ($form_combs as $form_comb) {
                    $comb_flows = json_decode($form_comb->comb_json);
                    $new_flows = array_merge($new_flows, $comb_flows);
                }
            }
        }
        // Fetch the question ids now for logical questions
        $question_id_arr = [];
        foreach ($new_flows as $new_flow_obj) {
            $this->form_model->getQuestionIdRecursive((array) $new_flow_obj, $question_id_arr);
        }
        $uniq_ques_ids = array_unique($question_id_arr);
        if(count($uniq_ques_ids)>0) {
            // Get all the questions and the options from the database
            $question_with_options = $this->question_model->get_questions_with_options($uniq_ques_ids, 1);
            // Format the questions as required by application
            $questions = $this->question_model->formatQuestionOptions($question_with_options);
        } else {
            $questions = [];
        }
        // Merge logical + primary questions
        $all_questions = array_merge($questions, $forms['questions']);

        // Format questions to get by tag if exists rather than id
        $questions = [];
        array_walk($forms['questions'], function($question, $question_key) use (&$questions) {
            $questions[$question['question']['tags']??$question['question']['id']] = $question;
        });

        // Get genders
        $get_genders = $this->question_model->get_genders(1);

        // Get last Id
        $line           = 1;
        $header         = [];
        $data_arr       = [];
        $detail_arr     = [];
        $inserted       = 0;
        $skipped        = 0;
        $failed_arr     = [];
        while ($file && ($result = fgetcsv($file)) !== false)
        {
            if($line==1) {
                foreach ($result as $key => $head_column ) {
                    $header[$head_column] = $key;
                }

                $line++;
                continue;
            }
            $category = explode(',', $result[$header['incident_categories']]);
            $category_ids = implode(',', $category);
            try {
                $record_arr =[
                    'status'              => 'published',
                    'client_id'           => $this->client_id??1,
                    'user_id'             => 0,
                    'admin_id'            => $this->getLoggedInUser()->id,
                    'lang_id'             => 1,
                    'sharing_for'         => $result[$header['sharing_for']]??null,
                    'description'         => $result[$header['description']],
                    'date'                => date('Y-m-d', strtotime($result[$header['date']]))??null,
                    'time_from'           => date('H:i:s', strtotime($result[$header['time_from']]))??null,
                    'time_to'             => date('H:i:s', strtotime($result[$header['time_to']]))??null,
                    'building'            => $result[$header['building']??100]??'',
                    'landmark'            => $result[$header['landmark']??100]??'',
                    'area'                => $result[$header['area']??100]??'',
                    'city'                => $result[$header['city']??100]??'',
                    'state'               => $result[$header['state']??100]??'',
                    'country'             => $result[$header['country']??100]??'',
                    'latitude'            => $result[$header['latitude']??100]??'',
                    'longitude'           => $result[$header['longitude']??100]??'',
                    'age'                 => $result[$header['age']]??'',
                    'attack_reason'       => $result[$header['attack_reason']??100]??'',
                    'additional_detail'   => $result[$header['additional_detail']??100]??'',
                ];


                // Validate Requests
                $get_category_ids = $this->incident_report_model->get_category_ids($category,1);

                $explode_get_genders=explode(',', $get_genders[0]['titles']);
                $explode_get_genders_ids=explode(',', $get_genders[0]['ids']);
                $explode_get_category_ids=explode(',', $get_category_ids[0]['categories']);
                if(count($category)==count($explode_get_category_ids) && !empty($get_category_ids[0]['categories'])){

                    $record_arr['incident_category_ids'] =str_replace(' ', '', $get_category_ids[0]['categories']);
                }else{
                   $error_arr[] = "Row $line: Please provide valid category";
                }
                if(in_array($result[$header['gender']], $explode_get_genders)){
                    $key = array_search($result[$header['gender']], $explode_get_genders);
                    $record_arr['gender_id'] =$explode_get_genders_ids[$key];

                }else{
                    $error_arr[] = "Row $line: please provide valid gender";
                }
                if(empty($record_arr['description']))
                    $error_arr[] = "Row $line: Please provide valid title";
                if(empty($record_arr['latitude']) || empty($record_arr['longitude']) || is_numeric($record_arr['latitude'] || is_numeric($record_arr['longitude'])))
                    $error_arr[] = "Row $line: please provide valid coordinates";
                if(empty($record_arr['attack_reason']))
                    $error_arr[] = "Row $line: Please provide valid attack reason";
                if(empty($record_arr['area']) || empty($record_arr['city']) || empty($record_arr['state']) || empty($record_arr['country'])) {
                    $error_arr[] = "Row $line: Country, city, state and area is required";
                }
                $data_arr[] = $record_arr;

                // Set detail data
                foreach ($header as $tag => $col_no ) {
                    if(in_array($tag, ['time_to', 'building', 'landmark', 'area', 'city', 'state', 'latitude', 'longitude']))
                        continue;
                    if($tag=='country')
                        $tag = 'incident_address';
                    else if($tag=='gender_id')
                        $tag = 'gender';
                    else if($tag=='incident_category_ids')
                        $tag = 'incident_categories';
                    $question = $questions[$tag]['question'];
                    $question_type = json_decode($question['properties'], true)['type'];
                    $answer_id =  '';
                    $text_fields = ['text', 'estimate-datepicker', 'estimate-time-or-rangepicker', 'incident-address-form'];
                    if(!in_array($question_type, $text_fields)) {
                        foreach ($questions[$tag]['options'] as $option) {
                            if(strrpos($option['title'], $result[$col_no])!==false)
                                $answer_id = $option['id'];
                        };
                        $answer_id   = $answer_id??$result[$col_no];
                    } else if(in_array($question_type, $text_fields)) {
                        $answer_id = 0;
                    }
                    if($tag=='incident_categories')
                        $answer_id = $record_arr['incident_category_ids'];
                    if($answer_id==='')
                        continue;
                    $detail_arr[] = [
                        'incident_id'   => $line,
                        'form_type'     => 'primary',
                        'question_id'   => $question['id'],
                        'question_type' => json_decode($question['properties'], true)['type'],
                        'question_tag'  => $question['tags'],
                        'question'      => $question['question'],
                        'answer_id'     => $answer_id??0,
                        'answer'        => $result[$col_no],
                        'other_answers' => '{}',
                        'answer_json'   => '{}'
                    ];
                }
            } catch (Exception $e) {
                $error_arr[] = "Row $line: Something went wrong";
            }
            $line++;
        }
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

        // Insert Incident Data in DB
        $this->db->trans_start();
        $inserted_records =$this->incident_report_model->save_batch($data_arr);

        // Figure out incident id to update in detail array
        // Get first inserted id
        $first_id = $this->incident_report_model->getLastInsertedId();
        $last_id  = $first_id + (count($data_arr)-1);
        $current_id = $first_id;

        // Save Incident Details
        $i = 0;
        $last_detail_id = $detail_arr[0]['incident_id'];
        foreach ($detail_arr as $detail) {
            if($detail['incident_id']!=$last_detail_id) {
                $current_id++;
                $last_detail_id = $detail['incident_id'];
            }
            $detail_arr[$i]['incident_id'] = $current_id;
            $i++;
        }
        $this->incident_report_model->saveDetails($detail_arr);
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

    /** Start of Import Old Records */
    /**
     * memoize
     * @var array
     */
    private $reverseGeoData = [];
    private function setGeoData()
    {
        $file = fopen('http://localhost/SafeCityWebApp/others/navicat_incident_results_location.csv', 'r');
        $line = 1;
        while ($file && ($result = fgetcsv($file)) !== false)
        {
            if($line==1) {
                foreach ($result as $key => $head_column ) {
                    $header[$head_column] = $key;
                }
                //print_r($header);
                $line++;
                continue;
            }

            $address_data = [
                'country'  => $result[$header['country']],
                'state'    => $result[$header['state']],
                'city'     => $result[$header['city']],
                'area'     => $result[$header['area']],
                'landmark' => $result[$header['landmark']],
                'building' => $result[$header['building']]
            ];
            $lat = $result[$header['latitude']];
            $lng = $result[$header['longitude']];

            $this->reverseGeoData[$lat.'-'.$lng] = $address_data;
        }
    }

    /**
     * Create new csv with address data
     * fetching from google api
     */
    public function setLocationOldData()
    {
        ini_set('max_execution_time', 0);

        $this->setGeoData();
        /*print_r($this->reverseGeoData);
        exit;*/
        $rfile = fopen('http://localhost/SafeCityWebApp/others/navicat_incident_results_location.csv', 'r');
        $wfile = fopen(FCPATH.'/others/navicat_incident_results_location_new.csv', 'w');
        $line     = 1;
        $header   = [];
        $data_arr = [];
        $requests = 0;
        $start_time = microtime(true);
        $err_arr    = [];

        while ($rfile && ($result = fgetcsv($rfile)) !== false)
        {
            try {
                if($line==1) {
                    setheader:
                    foreach ($result as $key => $head_column ) {
                        $header[$head_column] = $key;
                    }
                    if(!isset($header['country'])) {
                        $result[] = 'building';
                        $result[] = 'landmark';
                        $result[] = 'area';
                        $result[] = 'city';
                        $result[] = 'state';
                        $result[] = 'country';
                        fputcsv($wfile, $result);
                        $header = [];
                        goto setheader;
                    }
                    $line++;
                    continue;
                }
                if(!isset($result[$header['country']]) && isset($result[$header['latitude']]) && isset($result[$header['longitude']])) {
                    $address_arr = $this->reverseGeoCode($result[$header['latitude']], $result[$header['longitude']]);
                    // Add to csv
                    $result[] = $address_arr['building']??'';
                    $result[] = $address_arr['landmark']??'';
                    $result[] = $address_arr['area']??'';
                    $result[] = $address_arr['city']??'';
                    $result[] = $address_arr['state']??'';
                    $result[] = $address_arr['country']??'';
                    fputcsv($wfile, $result);
                } else {
                    echo "check line: ".$line.' <br>';
                    print_r($result);
                    echo "<br>";
                }
                $line++;
                $requests++;
            } catch (Exception $e) {
                echo 'error at line:'.$line.'<br>';
            }
        }
        fclose($rfile);
        fclose($wfile);
        echo "Created File succesfully";
    }

    /**
     * Call Google Geocoding API to fetch address
     * by reverse geocoding
     * @param  string $lat
     * @param  string $lng
     * @return Array
     */
    private function reverseGeoCode($lat, $lng)
    {
        if(isset($this->reverseGeoData[$lat.'-'.$lng]))
            return $this->reverseGeoData[$lat.'-'.$lng];
        // Skip Api Call
        /*$address_data = [
            'country'  => 'India',
            'state'    => '',
            'city'     => '',
            'area'     => '',
            'landmark' => '',
            'building' => ''
        ];
        return $address_data;*/
        // Make api call
        $ch = curl_init("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $address_data = [
            'country'  => 'India',
            'state'    => '',
            'city'     => '',
            'area'     => '',
            'landmark' => '',
            'building' => ''
        ];
        $data = json_decode($data, true);
        if($data['status']=='OK') {
            $address_components = $data['results'][0]['address_components'];
            foreach ($address_components as $address_compnent) {
                switch ($address_compnent['types'][0]) {
                    case 'country':
                        $address_data['country'] = $address_compnent['long_name'];
                        break;

                    case 'administrative_area_level_1':
                        $address_data['state'] = $address_compnent['long_name'];
                        break;

                    case 'locality':
                        $address_data['city'] = $address_compnent['long_name'];
                        break;

                    case 'sublocality_level_1':
                        $address_data['area'] = $address_compnent['long_name'];
                        break;

                    case 'political':
                        $address_data['area'] = $address_data['area']==''?$address_compnent['long_name']:$address_data['area'];
                        break;

                    case 'sublocality_level_3':
                    case 'sublocality':
                        $address_data['landmark'] = $address_compnent['long_name'];
                        break;

                    case 'postal_code':
                        $address_data['landmark'] = $address_data['landmark']==''?$address_compnent['long_name']:$address_data['landmark'];

                    default:
                        break;
                }
            }
        } else {
            echo "Google api error ".$data['status']." <br>";
        }
        $this->reverseGeoCode[$lat.'-'.$lng] = $address_data;
        // Google api allows only 50 requests/sec
        // Sleep for 25ms to respect google's rate limiting
        usleep(25 * 1000);
        return $address_data;
    }

    /**
     * Script to import old Data from CSV
     */
    public function importOldData()
    {
        ini_set('max_execution_time', 0);

        $file = fopen('http://localhost/SafeCityWebApp/others/navicat_incident_results_location.csv', 'r');

        $line           = 1;
        $header         = [];
        $data_arr       = [];
        $inserted       = 0;
        $skipped        = 0;
        $failed_arr     = [];
        while ($file && ($result = fgetcsv($file)) !== false)
        {
            if($line==1) {
                foreach ($result as $key => $head_column ) {
                    $header[$head_column] = $key;
                }
                //print_r($header);
                $line++;
                continue;
            }
            $category = explode(' | ', $result[$header['category_id']]);
            $newCatIdArr = $this->mapOldCategories($category);
            if(count($newCatIdArr)==0) {
                $skipped++;
                $line++;
                continue;
            }
            $category_ids = implode(',', $newCatIdArr);
            $incident_datetime = explode(' ', $result[$header['incident_date']]);
            $record_arr =           [
                'old_id'                => $result[$header['id']]??null,
                'status'                => 'published',
                'client_id'             => 1,
                'lang_id'               => 1,
                'description'           => $result[$header['incident_title']].' : '.$result[$header['incident_description']],
                'date'                  => date('Y-m-d', strtotime($incident_datetime[0]))??null,
                'time_from'             => date('H:i:s', strtotime($incident_datetime[1]))??null,
                'incident_category_ids' => $category_ids,
                'building'              => $result[$header['building']??100]??'',
                'landmark'              => $result[$header['landmark']??100]??'',
                'area'                  => $result[$header['area']??100]??'',
                'city'                  => $result[$header['city']??100]??'',
                'state'                 => $result[$header['state']??100]??'',
                'country'               => $result[$header['country']??100]??'',
                'latitude'              => $result[$header['latitude']??100]??'',
                'longitude'             => $result[$header['longitude']??100]??'',
            ];

            $data_arr[] = $record_arr;
            if($this->incident_report_model->save($record_arr)){
                $inserted++;
            } else {
                $failed_arr[] = $record_arr['old_id'];
            }
            /*if($line>=13)
                break;*/
            $line++;
        }
        fclose($file);
        return $this->jsonResponse([
            'inserted' => $inserted,
            'skipped'   => $skipped,
            'failed'   => count($failed_arr),
            'failed_ids' => $failed_arr,
        ], 200);
    }

    private function mapOldCategories($oldCatIdArr)
    {
        $newCatIdArr = [];
        foreach ($oldCatIdArr as $catId) {
            $newCatId = '';
            switch ($catId) {
                case 1:
                case 2:
                case 10:
                    $newCatId = 11;
                    break;

                case 3:
                    $newCatId = 7;
                    break;

                case 4:
                case 20:
                    $newCatId = 5;
                    break;

                case 6:
                    $newCatId = 6;
                    break;

                case 8:
                    $newCatId = 9;
                    break;

                case 9:
                    $newCatId = 8;
                    break;

                case 11:
                    $newCatId = 1;
                    break;

                case 15:
                    $newCatId = 14;
                    break;

                case 17:
                    $newCatId = 2;
                    break;

                case 21:
                    $newCatId = 12;
                    break;

                case 24:
                    $newCatId = 3;
                    break;

                case 26:
                    $newCatId = 13;
                    break;

                default:
                    $newCatId = '';
                    break;
            }
            if($newCatId!='')
                $newCatIdArr[] = $newCatId;
        }
        return array_unique($newCatIdArr);
    }
    // public function export()
    // {
    //     $statuses       = $this->input->get('statuses')??'';
    //     $start          = $this->input->get('start')??'';
    //     $end            = $this->input->get('end')??'';
    //     $record_ids     = $this->input->get('record_ids')??'';
    //     $record_id_arr  = [];
    //     if($record_ids!='')
    //         $record_id_arr  = explode(',', $record_ids);
    //     $status_arr = '';
    //     if($statuses!='')
    //         $statuses = explode(',', $statuses);
    //     if(count($record_id_arr)>0) {
    //         $result['results'] = $this->incident_report_model->fetchResultByIds($record_id_arr);
    //     } else {
    //         $result = $this->incident_report_model->export(0, 'all', $statuses, $start, $end);
    //     }

    //     $filename = 'incident-'.date('YmdHis').'.csv';
    //     header("Content-Description: File Transfer"); 
    //     header("Content-Disposition: attachment; filename=$filename"); 
    //     header("Content-Type: application/csv; ");
    //     // file creation 
    //     $file = fopen('php://output','w');
    //     $header = array("id","status","posted_by","date","category","age","time from","time to","description","Additional Details","area","city","state","country","latitude","longitude","created_on","updated_on"); 
    //     fputcsv($file, $header);
    //     foreach ($result['results'] as $record) {
    //         $export_data = [
    //             $record['id'],
    //             $record['status'],
    //             $record['posted_by'],
    //             $record['date'],
    //             $record['categories'],
    //             $record['age'],
    //             $record['time_from'],
    //             $record['time_to'],
    //             $record['description'],
    //             $record['additional_detail'],
    //             $record['area'],
    //             $record['city'],
    //             $record['state'],
    //             $record['country'],
    //             $record['latitude'],
    //             $record['longitude'],
    //             $record['created_on'],
    //             $record['updated_on']
    //         ];
    //         fputcsv($file, $export_data); 
    //     }
    //     fclose($file);
    //     exit;
    // }


    //  public function import()
    // {
       
    //     $time_start = microtime(true);;
        
    //     $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    //     $error_arr      = [];
    //     if(!in_array($_FILES['import_file']['type'], $mimes)){
    //           $error_arr[] = 'Invalid file, please provide a valid csv file';
    //     } else {
    //         //$file = fopen('http://localhost/SafeCityWebApp/others/dynamic%20form/import-safety-tips-format.csv', 'r');
    //         $file = fopen($_FILES['import_file']['tmp_name'], 'r'); 

    //     }

    //     $line           = 1;
    //     $header         = [];
    //     $data_arr       = [];
    //     $inserted       = 0;
    //     $skipped        = 0;
    //     $failed_arr     = [];
    //     $get_genders=$this->question_model->get_genders(1);
    //     $get_categories=$this->question_model->get_categories(1);
    //     while ($file && ($result = fgetcsv($file)) !== false)
    //     {
    //         if($line==1) {
    //             foreach ($result as $key => $head_column ) {
    //                 $header[$head_column] = $key;
    //             }
                
    //             $line++;
    //             continue;
    //         }
    //         // print_r($header);
    //         // exit;
    //         $category = explode(',', $result[$header['category_id']]);
    //         // $newCatIdArr = $this->mapOldCategories($category);
    //         // if(count($newCatIdArr)==0) {
    //         //     $skipped++;
    //         //     $line++;
    //         //     continue;
    //         // }
    //         //$category_ids = implode(',', $newCatIdArr);
    //         $category_ids = implode(',', $category);
    //         //$incident_datetime = explode(' ', $result[$header['incident_date']]);
    //         try {
    //         $record_arr =[
    //             'status'                => 'published',
    //             'client_id'             => $this->client_id??1,
    //             'user_id'             => 0,
    //             'admin_id'            => $this->getLoggedInUser()->id,
    //             'lang_id'               => 1,
    //             'description'           => $result[$header['incident_description']],
    //             'date'                  => date('Y-m-d', strtotime($result[$header['incident_date']]))??null,
    //             'time_from'             => date('H:i:s', strtotime($result[$header['time_from']]))??null,
    //             'time_to'             => date('H:i:s', strtotime($result[$header['time_to']]))??null,
    //             'building'              => $result[$header['building']??100]??'',
    //             'landmark'              => $result[$header['landmark']??100]??'',
    //             'area'                  => $result[$header['area']??100]??'',
    //             'city'                  => $result[$header['city']??100]??'',
    //             'state'                 => $result[$header['state']??100]??'',
    //             'country'               => $result[$header['country']??100]??'',
    //             'latitude'              => $result[$header['latitude']??100]??'',
    //             'longitude'             => $result[$header['longitude']??100]??'',
    //             'age'             => $result[$header['age']]??'',
    //             'attack_reason'             => $result[$header['attack_reason']??100]??'',
    //             'additional_detail'             => $result[$header['additional_detail']??100]??'',
    //         ];

                
    //         // Validate Requests
    //             // $get_category_ids=$this->incident_report_model->get_category_ids($category,1);
                
    //             $explode_get_genders=explode(',', $get_genders[0]['titles']);
    //             $explode_get_genders_ids=explode(',', $get_genders[0]['ids']);
    //             // $explode_get_category_ids=explode(',', $get_category_ids[0]['categories']);
    //             // if(count($category)==count($explode_get_category_ids) && !empty($get_category_ids[0]['categories'])){
                    
    //             //     $record_arr['incident_category_ids'] =str_replace(' ', '', $get_category_ids[0]['categories']);
    //             // }else{
    //             //    $error_arr[] = "Row $line: Please provide valid category";
    //             // }

    //             //print_r($get_categories);exit;
    //             //$explode_categiries=explode(',', $get_categories[0]['titles']);
    //             $match_categories=[];
    //             foreach ($get_categories as $key => $value) {
    //                 if(in_array($value['title'], $category)){
    //                     array_push($match_categories,$value['category_id']);
    //                 }

    //             }
    //             if(count($category)==count($match_categories) && !empty($match_categories[0])){
                    
    //                 $record_arr['incident_category_ids'] =implode(',', $match_categories);
    //             }else{
    //                $error_arr[] = "Row $line: Please provide valid category";
    //             }
    //             if(in_array($result[$header['gender']], $explode_get_genders)){
    //                 $key = array_search($result[$header['gender']], $explode_get_genders);
    //                 $record_arr['gender_id'] =$explode_get_genders_ids[$key];
                    
    //             }else{
    //                 $error_arr[] = "Row $line: please provide valid gender";
    //             }
    //             if(empty($record_arr['description']))
    //                 $error_arr[] = "Row $line: Please provide valid title";
    //             if(empty($record_arr['latitude']) || empty($record_arr['longitude']) || is_numeric($record_arr['latitude'] || is_numeric($record_arr['longitude'])))
    //                 $error_arr[] = "Row $line: please provide valid coordinates";
    //             if(empty($record_arr['attack_reason']))
    //                 $error_arr[] = "Row $line: Please provide valid attack reason";
    //             if(empty($record_arr['area']) || empty($record_arr['city']) || empty($record_arr['state']) || empty($record_arr['country'])) {
    //                 $error_arr[] = "Row $line: Country, city, state and area is required";
    //             }
    //             $data_arr[] = $record_arr;
    //         } catch (Exception $e) {
    //             $error_arr[] = "Row $line: Something went wrong";
    //         }
    //         $line++;
    //     }
    //     fclose($file);
    //     // Show Validation error if any
    //     if(count($error_arr)>0) {
    //         $response =  [
    //                         'status' => false,
    //                         'message' => 'Please fix records and resubmit',
    //                         'validations' => $error_arr
    //                     ];
    //         if (!$this->input->is_ajax_request()) {
    //             $this->session->set_flashdata('upload_failed', $response);
    //             redirect($_SERVER['HTTP_REFERER']);   
    //         }
    //         else
    //             return $this->jsonResponse($response);
    //     }
    //     //print_r($data_arr);exit;
    //        // Insert Data in DB
    //     $this->db->trans_start();
    //     $inserted_records =$this->incident_report_model->save_batch($data_arr);
    //     $this->db->trans_complete();
    //     // Script end
    //     $time_end = microtime(true);
    //     $execution_time = round(($time_end - $time_start)/60, 3);

    //     // Return appropriate response
    //     if ($this->db->trans_status() === FALSE) {
    //         $response =  [
    //                         'status' => false,
    //                         'message' => 'Something went wrong whilte inserting in DB',
    //                     ];
    //         if (!$this->input->is_ajax_request())
    //             $this->session->set_flashdata('upload_failed', $response);
    //         else
    //             return $this->jsonResponse($response);
    //     }
    //     else {
    //         $response = [
    //                     'status' => true,
    //                     'message' => $inserted_records.' Records Imported succesfully in '.$execution_time.' seconds',
    //                 ];

    //         if (!$this->input->is_ajax_request())
    //             $this->session->set_flashdata('upload_success', $response);
    //         else
    //             return $this->jsonResponse($response);
    //     }
    //     redirect($_SERVER['HTTP_REFERER']);
    // }
	
	
	public function getVolunteerDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;

        
        $category = $this->input->post('category')??'';
        
        if($_SESSION['user_data']->company=='LANGUAGE'){
			$result = $this->incident_report_model->getLanguageDataTableResults($start, $length, $status, $type, $location, $category, $start_date, $end_date, $search_term, $this->client_id);
		}else{
			$result = $this->incident_report_model->getVolunteerDataTableResults($start, $length,$category, $this->client_id);
		}
		
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// exit;
		$volunteercodes = array();
		$i = 0;
		foreach ($result['results'] as $incident_detail) {
			$temp = array();
			$answer_json = json_decode($incident_detail['answer_json'],true);
			
			// echo "<pre>";
			// print_r($answer_json);
			// // print_r($answer_jsonn);
			// // print_r($answer_jsonnn);
			// // print_r($incident_detail);
			// echo "</pre>";
			
			$answer_json = $answer_json['other_answers'];
			$answer_jsonn = $answer_json['153'];
			$answer_jsonnn = $answer_json['answer_id'];
			
			if($answer_jsonn!=''){
				$temp['volunteer_code'] = strtoupper(trim($answer_jsonn));
				$temp['categories'] = $incident_detail['categories'];
			}
			
			if($answer_jsonnn!=''){
				$temp['volunteer_code'] = strtoupper(trim($answer_jsonnn));
				$temp['categories'] = $incident_detail['categories'];
			}
			
			if(count($temp) > 0){
				$volunteercodes[] = $temp;
			}
			
			$i++;
		}
		// array_values($volunteercodes);
		
		// echo "<pre>";
			// // print_r($volunteercodes);
			// // print_r(array_unique($volunteercodes));
			// // print_r($incident_detail);
			// echo "</pre>";
		// exit;
		
        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => count($volunteercodes),
            'recordsFiltered'   => count($volunteercodes),
            'data'              => $volunteercodes
        ];
        return $this->jsonResponse($data, 200);

    }
}