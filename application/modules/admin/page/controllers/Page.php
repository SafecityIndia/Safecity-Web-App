<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('resources_model');
        $this->load->model('client_model');
		$this->load->model('legal_model');
        $this->load->model('country_model');
    }

    public function index()
    {
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
        $data['countries'] = $this->country_model->getByIds($country_id_arr);
        $this->load->view('page', $data);
    }

    public function getDataTable()
    {
        $draw         = (int) $this->input->post('draw')??1;
        $start        = $this->input->post('start')??0;
        $length       = $this->input->post('length')??10;
        if($_SESSION['user_id']==30){
			$country_id   = 111;
		}else{
			$country_id   = $this->input->post('country_id')??'';
		}
        $lang_id      = $this->input->post('lang_id')??'';
        $title        = $this->input->post('title')??'';
        $updated_by   = $this->input->post('updated_by')??'';
        $updated_on   = $this->input->post('updated_on')??'';
        $created_on   = $this->input->post('created_on')??'';
        $search       = $this->input->post('search')??'';

        $result = $this->resources_model->getDataTableResults($start, $length, $title, $this->client_id, $country_id, $lang_id, $updated_by, $updated_on, $created_on, $search);

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
        $id = $this->input->post('id')??1;
        $resource_details = $this->resources_model->get($id, $this->client_id);
        $i = 0;
        foreach ($resource_details as $detail) {
            $resource_details[$i]->content = html_entity_decode($detail->content);
            $i++;
        }
        //$resource_details = html_entity_decode($resource_details['content']);
        return $this->jsonResponse(['success' => true, 'data' => $resource_details], 200);
    }

	public function getlegalDetails()
    {
        $id = $this->input->post('id')??1;
        $resource_details = $this->legal_model->get($id, $this->client_id);
        $i = 0;
        foreach ($resource_details as $detail) {
            $resource_details[$i]->content = html_entity_decode($detail->content);
            $i++;
        }
        //$resource_details = html_entity_decode($resource_details['content']);
        return $this->jsonResponse(['success' => true, 'data' => $resource_details], 200);
    }
	
	public function remove_element_by_value($arr, $val) {
	   $return = array(); 
	   foreach($arr as $k => $v) {
		  if(is_array($v)) {
			 $return[$k] = $this->remove_element_by_value($v, $val); //recursion
			 continue;
		  }
		  if($v == $val) continue;
		  $return[$k] = $v;
	   }
	   return $return;
	}
	
	public function getlanguageDetails()
    {
        $id = $this->input->post('country_id');
		$all_languages = $this->client_model->getLanguages($this->client_id);
        $resource_details = $this->legal_model->getLanguage($id, $this->client_id);
		
		foreach($resource_details as $val){
			foreach($all_languages as $key=>$lval){
				if($lval['id'] == $val->language_id){
					// echo $lval['id'].'-----------'.$val->language_id.'-------Key: '.$key;
					// echo "<br />";
					unset($all_languages[$key]);      
				}
			}
		}
		
		
        $html = '';
        foreach ($all_languages as $val) {
            $html .='<option value='.$val['id'].'>'.$val['name'].'</option>';
        }
        //$resource_details = html_entity_decode($resource_details['content']);
        return $this->jsonResponse(['success' => true, 'data' => $html], 200);
    }

    public function uploadEditorImage()
    {
        $upload_path = 'assets/uploads/editor_images';
        $config['upload_path']          = realpath(FCPATH.$upload_path);
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = date('YmdHis');
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            return $this->jsonResponse($error, 500);
        }
        else
        {
            $upload_data = $this->upload->data();
            $data = array('location' => base_url() . $upload_path.'/'. $upload_data['file_name']);
            return $this->jsonResponse($data, 200);
        }
    }

    public function update()
    {
        $type        = $this->input->post('type');
        $resource_id = $this->input->post('resource_id');

        if($type=='single') {
            $report_id  = $this->input->post('report_id');
            $title      = $this->input->post('title', FALSE);
            $description = $this->input->post('content', FALSE);

            $data = [
                'title'   => $title,
                'content' => $description
            ];
            if($report_id!=0) {
                // Update Record
                $result = $this->resources_model->updateContent($report_id, $data, $this->client_id);
            } else {
                $data['order_no']           = 1;
                $data['content_for']        = 'web';
                $data['client_resource_id'] = $resource_id;
                // Create Record
                $result = $this->resources_model->createContent($data);
            }

            // Set Updation
            $this->resources_model->update($resource_id, [
                'updated_by'    => $this->getLoggedInUser()->id,
                'updated_on'    => date('Y-m-d H:i:s')
            ], $this->client_id);
        } else {
            $title       = $this->input->post('title', FALSE);
            $records     = $this->input->post('records', FALSE);
            $contents_arr = array();
            $i = 1;
            foreach ($records as $record) {
                $contents_arr[] = [
                    'order_no'   => $i,
                    'content_for' => 'web',
                    'client_resource_id' => $resource_id,
                    'title'       => $record['title'],
                    'content'     => $record['content']
                ];
                $i++;
            }
            // Start transaction
            $this->db->trans_start();
            // Delete all of the resource contents
            $this->resources_model->deleteAllContent($resource_id, $this->client_id);
            // Add all new resource contents
            $this->resources_model->saveContents($contents_arr);
            // Update Actual Resource Title
            $this->resources_model->update($resource_id, [
                'title'         => $title,
                'updated_by'    => $this->getLoggedInUser()->id,
                'updated_on'    => date('Y-m-d H:i:s')
            ], $this->client_id);
            // transaction end
            $this->db->trans_complete();
            $result = $this->db->trans_status();
        }

        if($result)
            return  $this->jsonResponse([
                        'status' => true,
                        'message' => 'Content updated succesfully',
                    ]);
        else
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
    }
	
	public function updatelegal()
    {
        $type        = $this->input->post('type');
        $resource_id = $this->input->post('resource_id');

        if($type=='single') {
            $report_id  = $this->input->post('report_id');
            $title      = $this->input->post('title', FALSE);
            $description = $this->input->post('content', FALSE);

            $data = [
                'title'   => $title,
                'content' => $description
            ];
            if($report_id!=0) {
                // Update Record

					$result = $this->legal_model->updateContent($report_id, $data, $this->client_id);
			
                
            } else {
                $data['order_no']           = 1;
                $data['content_for']        = 'web';
                $data['client_resource_id'] = $resource_id;
                // Create Record
		
					$result = $this->legal_model->createContent($data);
			
            }

            // Set Updation
				$this->legal_model->update($resource_id, [
                'updated_by'    => $this->getLoggedInUser()->id,
                'updated_on'    => date('Y-m-d H:i:s')
				], $this->client_id);
			
           
        } else {
            $title       = $this->input->post('title', FALSE);
            $records     = $this->input->post('records', FALSE);
            $contents_arr = array();
            $i = 1;
            foreach ($records as $record) {
                $contents_arr[] = [
                    'order_no'   => $i,
                    'content_for' => 'web',
                    'client_resource_id' => $resource_id,
                    'title'       => $record['title'],
                    'content'     => $record['content']
                ];
                $i++;
            }
	   
			// Start transaction
			$this->db->trans_start();
			// Delete all of the resource contents
			$this->legal_model->deleteAllContent($resource_id, $this->client_id);
			// Add all new resource contents
			$this->legal_model->saveContents($contents_arr);
			// Update Actual Resource Title
			$this->legal_model->update($resource_id, [
				'title'         => $title,
				'updated_by'    => $this->getLoggedInUser()->id,
				'updated_on'    => date('Y-m-d H:i:s')
			], $this->client_id);
			// transaction end
			$this->db->trans_complete();
			$result = $this->db->trans_status();
        }

        if($result)
            return  $this->jsonResponse([
                        'status' => true,
                        'message' => 'Content updated succesfully',
                    ]);
        else
            return  $this->jsonResponse([
                        'status' => false,
                        'message' => 'Something went wrong!',
                    ]);
    }
	
	public function legal_view()
    {
        $client_id = $this->client_id;
        $data = ['pageTitle' => 'Safecity Webapp'];
		if($_SESSION['user_id']==30){
			$data['languages'] = $this->client_model->getJordanLanguages($client_id);
		}else{
			$data['languages'] = $this->client_model->getLanguages($client_id);
		}
        
        $data['countries'] = $this->country_model->get();
        $this->load->view('legal_view', $data);
    }
	
	public function getlegalDataTable()
    {
        $draw         = (int) $this->input->post('draw')??1;
        $start        = $this->input->post('start')??0;
        $length       = $this->input->post('length')??10;
		if($_SESSION['user_id']==30){
			$country_id   = 111;
		}else{
			$country_id   = $this->input->post('country_id')??'';
		}
        $lang_id      = $this->input->post('lang_id')??'';
        $title        = $this->input->post('title')??'';
        $updated_by   = $this->input->post('updated_by')??'';
        $updated_on   = $this->input->post('updated_on')??'';
        $created_on   = $this->input->post('created_on')??'';
        $search       = $this->input->post('search')??'';

        $result = $this->legal_model->getDataTableResults($start, $length, $title, $this->client_id, $country_id,$lang_id, $updated_by, $updated_on, $created_on, $search);
		
		
        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => $result['total_records'],
            'recordsFiltered'   => $result['filtered_records'],
            'data'              => $result['results']
        ];
        return $this->jsonResponse($data, 200);
    }
	
	public function add_new_language(){
		$client_id = $this->client_id;
		$data = ['pageTitle' => 'Safecity Webapp'];
		if($_SESSION['user_id']==30){
			$data['languages'] = $this->client_model->getJordanLanguages($client_id);
		}else{
			$data['languages'] = $this->client_model->getLanguages($client_id);
		}
        
        $data['countries'] = $this->country_model->get();
		$this->load->view('add_new_language', $data);
	}
	
	public function addLanguage()
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
                $this->form_validation->set_rules('language_id', 'Language','required');
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
				//check if combination already exist
				$condition_array = array('lang_id' => $this->input->post('language_id'), 'country_id' => $this->input->post('country'));
				$this->db->select('*');
				$this->db->from('legal_resources');
				$this->db->where($condition_array);
				$query = $this->db->get();
				if ($query->num_rows() > 0)
				{
					$json_data = array(
						'country' => $this->input->post('country'),
						'language' => $this->input->post('language'),
						'status' => true,
						'success_exist' => 'Data already exist',
					);
					echo json_encode($json_data);
					exit;
				}else{
					$insertdata['is_default'] = 1 ;
					$insertdata['type'] = 'legal';
					$insertdata['mode'] = 'multiple';
					$insertdata['client_id'] = $this->client_id;
					$insertdata['country_id'] = $this->input->post('country');
					$insertdata['lang_id'] = $this->input->post('language_id');
					$insertdata['title'] = '';
					$insertdata['footer'] = '';
					$insertdata['updated_by'] = $this->getLoggedInUser()->id;
					$this->db->insert('legal_resources', $insertdata);
					
					// echo $this->db->last_query();exit;
					$json_data = array(
						'country' => $this->input->post('country'),
						'language' => $this->input->post('language'),
						'status' => true,
						'success_alert' => 'Data added successfully',
					);
					echo json_encode($json_data);
					exit;
				}
            }
        }else{
            echo 'No direct access';
        }
    }

}