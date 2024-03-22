<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
// Chat Controller
// include_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Category (CategoryController)
 * Category Class to control all Category related operations.
 * @author : Amita Hadawale
 * @version : 1.1
 * @since : 22 March 2020
 */
class Chat extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['commonquery']);
        $this->load->library("pagination");
        $this->load->helper('url');
        $this->load->helper('cias');
        $this->load->model('menu/menu_model');
        $this->load->model('chat/chat_model');
    }

    /*public function index()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $this->load->view('chatbox');
    }*/

    /*public function index()
    {
        /*Array ( [to_user_id] => 4 [to_user_name] => user1 )*/
        // $this->show_ChatBox($data);
        /*$inc_id = $_POST['incident_id'];
        $data['incident_data'] = $this->menu_model->getIncidentData($inc_id);
        $guest_user_exist = $this->chat_model->getGuestUserByID($inc_id);
        
        if (empty($guest_user_exist)) {
            
            $guest_ip = getHostByName(getHostName());

            $register_user_data = [
                'guest_name'    =>  $inc_id,
                'guest_address' =>  $guest_ip
            ];

            $user_registered = $this->chat_model->reg_user($register_user_data);
            
            if($user_registered) {
                $guest_login_data = [
                    'guest_id'    =>  $inc_id
                ];
                $guest_user_login = $this->chat_model->guest_login_details($guest_login_data);
                $_SESSION['guest_login_details_id'] = $guest_user_login;
                $_SESSION['guest_id'] = $inc_id;
                $this->show_ChatBox();
            }
        }
        else {
            $guest_login_data = [
                'guest_id'    =>  $inc_id
            ];
            $guest_user_login = $this->chat_model->guest_login_details($guest_login_data);
            $_SESSION['guest_login_details_id'] = $guest_user_login;
            $_SESSION['guest_id'] = $guest_user_exist;
            $this->show_ChatBox();
        }
    }*/

    /*public function show_ChatBox()
    {
        $this->global['pageTitle'] = 'Safecity Webapp';
        $this->load->view('chat');
    }*/

    /*public function insert_user_chat()
    {
        $to_user_id = $this->security->xss_clean($this->input->post('to_user_id'));
        $chat_message = $this->security->xss_clean($this->input->post('chat_message'));        
        $from_user_id = $_SESSION['guest_id'];

        $insert_chat_data = [
            'to_user_id'    => $to_user_id,
            'from_user_id'  => $from_user_id,
            'chat_message'  => $chat_message,
            'status'        => 1
        ];

        $inserted_user_chat = $this->chat_model->insert_user_chat($insert_chat_data);
        echo json_encode($inserted_user_chat);
    }*/

    /*public function fetch_user_chat_history()
    {
        $to_user_id = $this->security->xss_clean($this->input->post('to_user_id'));
        $from_user_id = $_SESSION['guest_id'];

        $fetch_chat_data = $this->chat_model->fetch_user_chat_history($from_user_id, $to_user_id);
        //print_r($fetch_chat_data);die;
        echo json_encode($fetch_chat_data);
    }*/

    /*public function chat_guest_update_login()
    {
        $update_guest_login_data = [
            'last_activity'    =>  $this->getDatetimeNow()
        ];
        $update_guest_user_login = $this->chat_model->update_guest_login_details($update_guest_login_data);
    }

    function getDatetimeNow() {
        $tz_object = new DateTimeZone('Asia/Kolkata');
        //date_default_timezone_set('Asia/Kolkata');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }*/
}

?>