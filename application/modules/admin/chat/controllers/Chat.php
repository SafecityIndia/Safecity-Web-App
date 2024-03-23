<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('chat/chat_model');
    }

    public function index()
    {
        $data['pageTitle']     = 'Safecity Webapp';
        $data['statusesCount'] = $this->chat_model->getStatusesCount($this->client_id);
        $this->load->view('chat', $data);
    }

    public function details()
    {
        $data = ['pageTitle' => 'Safecity Webapp'];
        $this->load->view('chat-detailed', $data);
    }

    public function getDataTable()
    {
        $draw  = (int) $this->input->post('draw')??1;
        $start = $this->input->post('start')??0;
        $length = $this->input->post('length')??10;
        $status = $this->input->post('status')??'active';
        $client_id = $this->client_id??1;

        // Get Results
        $result = $this->chat_model->get_guestUsers($start, $length, $status, $client_id);

        $data   = [
            'draw'              => $draw,
            'recordsTotal'      => $this->chat_model->count_guestUsers($status, $client_id),//$result['total_records'],
            'recordsFiltered'   => $this->chat_model->count_guestUsers_filtered($status, $client_id),//$result['filtered_records'],
            'data'              => $result
        ];

        return $this->jsonResponse($data, 200);
        //output to json format
        //echo json_encode($output);
    }

    public function getGuestDetails()
    {
        //print_r($_POST);
        //print_r($_GET);
        //die;

        $client_id = $this->client_id??1;
        $guest_id  = $this->input->get('guest_id');

        // Get Categories
        $guest_detail = $this->chat_model->getGuestUserByID($guest_id, $client_id);

        $data = ['guest_detail' => $guest_detail];
        return $this->jsonResponse(['success' => true, 'data' => $data], 200);
    }

    public function syncGuestUser()
    {
        $client_id = $this->client_id??1;
        $guest_id  = $this->input->post('guest_id');

        /*$sync_current_guest = [
            'client_id' => $client_id,
            'user_id' => $_SESSION['user_id'],
            'guest_id' => $guest_id,
            'status' => '1'
        ];
        $guest_detail = $this->chat_model->insertGuestAdminSync($sync_current_guest);*/

        $ug_record_id = $this->chat_model->getGuestIDByUserName($guest_id, $client_id);
        if ($ug_record_id) {
            $update_user_guest = [
                'admin_id'     =>  $_SESSION['user_id'],
                'sync_status'  =>  '1'
            ];
            $update_ug_detail = $this->chat_model->updateUserGuest($ug_record_id, $update_user_guest);
            return $this->jsonResponse(['success' => true, 'data' => $update_ug_detail], 200);
        }
        else {
            return $this->jsonResponse(['success' => false, 'data' => $ug_record_id], 200);
        }
    }

    public function chatHistory()
    {
        $client_id    = $this->client_id;
        $to_user_id   = $this->input->post('to_user_id');
        $from_user_id = $this->input->post('from_user_id');

        $ug_record_id = $this->chat_model->getGuestIDByUserName($to_user_id, $client_id);
        if ($ug_record_id) {
            //set chat in history
            $update_chat_status = [
                'status'      =>  '0'
            ];
            $delete_chat_msg = $this->chat_model->update_user_status($client_id, $from_user_id, $to_user_id, $update_chat_status);

            //user_guest update
            $update_user_guest = [
                'status'      =>  'history',
                'sync_status' =>  '0'
            ];
            $update_ug_detail = $this->chat_model->updateUserGuest($ug_record_id, $update_user_guest);
            return $this->jsonResponse(['success' => true, 'data' => $update_ug_detail], 200);
        }
        else {
            return $this->jsonResponse(['success' => false, 'data' => $ug_record_id], 200);
        }
    }

    public function chatTrash()
    {
        $client_id  = $this->client_id;
        $to_user_id = $this->input->post('to_user_id');

        $ug_record_id = $this->chat_model->getGuestIDByUserName($to_user_id, $client_id);
        if ($ug_record_id) {
            $update_user_guest = [
                'status'     =>  'trashed'
            ];
            $update_ug_detail = $this->chat_model->updateUserGuest($ug_record_id, $update_user_guest);
            return $this->jsonResponse(['success' => true, 'data' => $update_ug_detail], 200);
        }
        else {
            return $this->jsonResponse(['success' => false, 'data' => $ug_record_id], 200);
        }
    }

    public function chatDelete()
    {
        $client_id  = $this->client_id;
        $to_user_id = $this->input->post('to_user_id');

        $ug_record_id = $this->chat_model->getGuestIDByUserName($to_user_id, $client_id);
        if ($ug_record_id) {
            $update_user_guest = [
                'is_deleted'     =>  0
            ];
            $update_ug_detail = $this->chat_model->updateUserGuest($ug_record_id, $update_user_guest);
            return $this->jsonResponse(['success' => true, 'data' => $update_ug_detail], 200);
        }
        else {
            return $this->jsonResponse(['success' => false, 'data' => $ug_record_id], 200);
        }
    }

    public function chatRestore()
    {
        $client_id  = $this->client_id;
        $to_user_id = $this->input->post('to_user_id');

        $ug_record_id = $this->chat_model->getGuestIDByUserName($to_user_id, $client_id);
        if ($ug_record_id) {
            $update_user_guest = [
                'is_deleted'     =>  1
            ];
            $update_ug_detail = $this->chat_model->updateUserGuest($ug_record_id, $update_user_guest);
            return $this->jsonResponse(['success' => true, 'data' => $update_ug_detail], 200);
        }
        else {
            return $this->jsonResponse(['success' => false, 'data' => $ug_record_id], 200);
        }
    }

}