<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Chats extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu/menu_model');
        $this->load->model('chat/chat_model');
    }

    public function getDatetimeNow() {
        //$tz_object = new DateTimeZone('Asia/Kolkata');
        //date_default_timezone_set('Asia/Kolkata');
        $datetime = new DateTime();
        //$datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }

    public function getUserUpdateLogin_post()
    {
        $client_id    = (int) trim($this->security->xss_clean($this->input->post('client_id')), '"');
        $from_user_id = (int) trim($this->security->xss_clean($this->input->post('from_user_id')), '"');
        $to_user_id   = (int) trim($this->security->xss_clean($this->input->post('to_user_id')), '"');
        $guest_login_details_id = (int) trim($this->security->xss_clean($this->input->post('guest_login_details_id')), '"');
        $sent_by      = $this->input->post('sent_by')??'web';

        $fetch_chat_data = [];
        $SyncUsersDetail = [];
        $is_admin_online = true;

        $update_guest_login_data = [
            'last_activity'    =>  $this->getDatetimeNow()
        ];
        $update_guest_user_login = $this->chat_model->update_guest_login_details($guest_login_details_id, $update_guest_login_data);

        if ($update_guest_user_login) {
            //get chat history
            //echo $client_id .'='. $from_user_id .'='. $to_user_id.'=';
            $fetch_chat_data = $this->chat_model->fetch_chat_history($client_id, $from_user_id, $to_user_id, $sent_by);

            /*$fetch_admin_chat_data = $this->chat_model->fetch_admin_chat_history($client_id, $from_user_id, $to_user_id, $sent_by);

            if (count($fetch_admin_chat_data) >= 0) {
                $is_admin_online = true;
            }*/

            //if admin not set than sync chat with admin
            if ($to_user_id == 0) {
                $SyncUsersDetail = $this->chat_model->getSyncUsersDetail($client_id, $from_user_id);
                if($SyncUsersDetail) {
                    $to_user_id = $SyncUsersDetail[0]->admin_id;
                    //$is_admin_online = true;
                }
            }
        }

        $this->response([
            'status'          => $update_guest_user_login?true:false,
            'message'         => $update_guest_user_login?'User logged in successfully':'Failed to User log in',
            'admin_sync'      => $SyncUsersDetail?true:false,
            'is_admin_online' => $is_admin_online,
            'to_user_id'      => $to_user_id,
            'chat_history'    => $fetch_chat_data
        ]);
    }

    public function getUserTypingStatus_post()
    {
        $guest_id = $this->security->xss_clean($this->input->post('guest_id'));
        $guest_login_details_id = $this->security->xss_clean($this->input->post('guest_login_details_id'));

        $update_user_typing_stat_data = [
            'is_type'    =>  0
        ];
        $update_user_typing_stat = $this->chat_model->update_guest_login_details($update_user_typing_stat_data);

        if ($is_type == 'yes') {
            $typing_msg = 'Typing';
        }
        else {
            $typing_msg = 'Not Typing';
        }

        $this->response([
            'status' => true,
            'message' => $typing_msg
        ]);
    }

    public function index_post()
    {
        $client_id = (int) trim($this->security->xss_clean($this->input->post('client_id')), '"');
        $inc_id    = (int) trim($this->security->xss_clean($this->input->post('incident_id')),'"');

        //$data['incident_data'] = $this->menu_model->getIncidentData($inc_id);
        $guest_user_exist = $this->chat_model->getGuestUserByID($inc_id, $client_id);

        if ($guest_user_exist) {

            $guest_login_id_exist = $this->chat_model->fetch_guest_login_details($client_id, $inc_id);
            if($guest_login_id_exist) {
                $update_guest_login_data = [
                    'last_activity'    =>  $this->getDatetimeNow()
                ];

                $guest_user_login = $this->chat_model->update_guest_login_details($guest_login_id_exist, $update_guest_login_data);
            }
            else {
                $guest_login_data = [
                    'client_id' =>  $client_id,
                    'guest_id'  =>  $inc_id
                ];
                $guest_user_login = $this->chat_model->guest_login_details($guest_login_data);
            }
            /*$guest_login_data = [
                'client_id' =>  $client_id,
                'guest_id'  =>  $inc_id
            ];
            $guest_user_login = $this->chat_model->guest_login_details($guest_login_data);*/
            $guest_data['guest_login_details_id'] = $guest_user_login;
            $guest_data['guest_id'] = $guest_user_exist;
        }
        else {
            //$guest_ip = getHostByName(getHostName());
            $register_user_data = [
                'client_id'     =>  $client_id,
                'guest_name'    =>  $inc_id
                //'guest_address' =>  '' //$guest_ip
            ];
            $user_registered = $this->chat_model->reg_user($register_user_data);
            if($user_registered) {
                $guest_login_data = [
                    'client_id'    =>  $client_id,
                    'guest_id'    =>  $inc_id
                ];
                $guest_user_login = $this->chat_model->guest_login_details($guest_login_data);
                $guest_data['guest_login_details_id'] = $guest_user_login;
                $guest_data['guest_id'] = $inc_id;
            }
        }

        $this->response([
            'status' => $guest_user_exist?true:false,
            'message' => $guest_user_exist?'Chat started with existing user':'Chat started with new user',
            'data' => $guest_data
        ]);
    }

    public function getUsersChatHistory_post()
    {
        $client_id    = (int) trim($this->security->xss_clean($this->input->post('client_id')), '"');
        $to_user_id   = (int) trim($this->security->xss_clean($this->input->post('to_user_id')), '"');
        $from_user_id = (int) trim($this->security->xss_clean($this->input->post('from_user_id')), '"');
        $sent_by      = $this->security->xss_clean($this->input->post('sent_by'));

        /*$update_chat_status = [
            'status'    =>  '0'
        ];*/

        $fetch_chat_data = $this->chat_model->fetch_chat_history($client_id, $from_user_id, $to_user_id, $sent_by);

        $this->response([
            'status'  => true,
            'message' => 'Chat History with current user',
            'data'    => $fetch_chat_data
        ]);
    }

    public function insertUserChat_post()
    {
        $client_id    = (int) trim($this->security->xss_clean($this->input->post('client_id')), '"');
        $to_user_id   = (int) trim($this->security->xss_clean($this->input->post('to_user_id')), '"');
        $from_user_id = (int) trim($this->security->xss_clean($this->input->post('from_user_id')), '"');
        $chat_message = $this->security->xss_clean($this->input->post('chat_message'));
        $sent_by = $this->security->xss_clean($this->input->post('sent_by'));

        $insert_chat_data = [
            'client_id'    =>  $client_id,
            'to_user_id'    => $to_user_id,
            'from_user_id'  => $from_user_id,
            'chat_message'  => $chat_message,
            'sent_by'       => $sent_by,
            'status'        => 1
        ];

        $inserted_user_chat = $this->chat_model->insert_user_chat($insert_chat_data);

        $this->response([
            'status' => true,
            'message' => 'Chat Insert',
            'data' => $inserted_user_chat
        ]);
    }

    public function getSyncChat_post()
    {
        $client_id = (int) trim($this->security->xss_clean($this->input->post('client_id')), '"');
        $guest_id  = (int) trim($this->security->xss_clean($this->input->post('guest_id')), '"');

        $SyncUsersDetail = $this->chat_model->getSyncUsersDetail($client_id, $guest_id);

        if($SyncUsersDetail) {
            $admin_user = '0';
            $update_sync_msg = [
                'to_user_id'    => $SyncUsersDetail[0]->user_id
            ];
            $update_msg = $this->chat_model->updateSyncUsersMsg($client_id, $guest_id, $admin_user, $update_sync_msg);
        }

        $this->response([
            'status'  => $SyncUsersDetail?true:false,
            'message' => $SyncUsersDetail?'Admin User Found':'Admin User Not Found',
            'data'    => $SyncUsersDetail
        ]);
    }

    public function deleteSyncChat_post()
    {
        $client_id    = (int) trim($this->security->xss_clean($this->input->post('client_id')), '"');
        $from_user_id = (int) trim($this->security->xss_clean($this->input->post('from_user_id')), '"');
        $to_user_id   = (int) trim($this->security->xss_clean($this->input->post('to_user_id')), '"');

        $update_chat_status = [
            'status'    =>  '0'
        ];
        $delete_chat_msg = $this->chat_model->update_user_status($client_id, $from_user_id, $to_user_id, $update_chat_status);

        $update_sync_status = [
            'sync_status'    =>  '0'
        ];
        $UnSyncUsersDetail = $this->chat_model->deleteSyncUsersDetail($client_id, $from_user_id, $update_sync_status);

        $this->response([
            'status'  => $UnSyncUsersDetail?true:false,
            'message' => $UnSyncUsersDetail?'Chat conversation open':'Chat conversation closed'
        ]);
    }

    public function adminchatHistoryCron_get()
    {
        $update_status = [
            'users_guest.status'      =>  'history',
            'users_guest.sync_status' =>  '0'
        ];
        $ug_update_record = $this->chat_model->update_guestUser_status($update_status);
        log_message('info', 'Old Chats moved to history tab in admin.');
        $this->response([
            'status'  => $ug_update_record?true:false,
            'message' => $ug_update_record?'Old chat moved to history successfully':'Error on Old chat moved to history'
        ]);
    }
}